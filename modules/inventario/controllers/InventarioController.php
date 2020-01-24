<?php

namespace app\modules\inventario\controllers;

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\Utilities;
use yii\helpers\ArrayHelper;
use app\models\ExportFile;
use app\modules\inventario\models\ActivoFijo;

class InventarioController extends \app\components\CController {

    public function actionIndex() {
        $mod_inventario = new ActivoFijo();                
        $data = Yii::$app->request->get();
        if ($data['PBgetFilter']) {                       
            $arrSearch["search"] = $data['search'];
            $arrSearch["emp_id"] = $data['emp_id'];
            $arrSearch["tipo_bien"] = $data['tipo_bien'];            
            $resp_listado = $mod_inventario->consultarInventario($arrSearch);
        } else {
            $resp_listado = $mod_inventario->consultarInventario();
        }
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            /*if (isset($data["get_funciones"])) {
                $resp_funciones = $mod_categoria->consultarFuncion($data["mod_id"]);
                $message = array("funciones" => $resp_funciones);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }    */       
        }
        /*$arr_modelo = $mod_modelo->consultarModelo();
        $arr_categoria = $mod_categoria->consultarFuncion(2);        */
        return $this->render('index', [
                   /* 'arr_modelo' => ArrayHelper::map(array_merge([["id" => "0", "value" => "Todos"]], $arr_modelo), "id", "value"),
                    'arr_categoria' => ArrayHelper::map(array_merge([["id" => "0", "name" => "Todos"]], $arr_categoria), "id", "name"), //array("1" => Yii::t("formulario", "Docencia"), "2" => Yii::t("formulario", "Condiciones Institucionales")),  */
                    'model' => $resp_listado,
        ]);
    }

    public function actionExpexcel() {
        ini_set('memory_limit', '256M');
        $content_type = Utilities::mimeContentType("xls");
        $nombarch = "Report-" . date("YmdHis") . ".xls";
        header("Content-Type: $content_type");
        header("Content-Disposition: attachment;filename=" . $nombarch);
        header('Cache-Control: max-age=0');
        $colPosition = array("C", "D", "E", "F", "G", "H", "I", "J");

        $arrHeader = array(
            repositorio::t("repositorio", "File name"),
            Yii::t("formulario", "Type"),
            Yii::t("formulario", "Description"),
            repositorio::t("repositorio", "Date file"),
            Yii::t("formulario", "Registration Date"),
        );
        $data = Yii::$app->request->get();
        $arrSearch["est_id"] = $data['est_id'];
        $arrSearch["f_ini"] = $data['f_ini'];
        $arrSearch["f_fin"] = $data['f_fin'];
        $arrSearch["search"] = $data['search'];
        $arrSearch["mod_id"] = $data['mod_id'];
        $arrSearch["cat_id"] = $data['cat_id'];
        $arrSearch["comp_id"] = $data['comp_id'];

        $mod_repositorio = new DocumentoRepositorio();
        $arrData = array();
        if (empty($arrSearch)) {
            $arrData = $mod_repositorio->consultarDocumentos(array(), true);
        } else {
            $arrData = $mod_repositorio->consultarDocumentos($arrSearch, true);
        }
        $nameReport = repositorio::t("repositorio", "List Repository of Evidence");
        Utilities::generarReporteXLS($nombarch, $nameReport, $arrHeader, $arrData, $colPosition);
        exit;
    }

    public function actionExppdf() {
        $report = new ExportFile();
        $this->view->title = repositorio::t("repositorio", "List Repository of Evidence"); // Titulo del reporte

        $mod_repositorio = new DocumentoRepositorio();
        $data = Yii::$app->request->get();
        $arr_body = array();
        $arrSearch["est_id"] = $data['est_id'];
        $arrSearch["f_ini"] = $data['f_ini'];
        $arrSearch["f_fin"] = $data['f_fin'];
        $arrSearch["search"] = $data['search'];
        $arrSearch["mod_id"] = $data['mod_id'];
        $arrSearch["cat_id"] = $data['cat_id'];
        $arrSearch["comp_id"] = $data['comp_id'];

        $arr_head = array(
            repositorio::t("repositorio", "File name"),
            Yii::t("formulario", "Type"),
            Yii::t("formulario", "Description"),
            repositorio::t("repositorio", "Date file"),
            Yii::t("formulario", "Registration Date"),
        );
        if (empty($arrSearch)) {
            $arr_body = $mod_repositorio->consultarDocumentos(array(), true);
        } else {
            $arr_body = $mod_repositorio->consultarDocumentos($arrSearch, true);
        }
        $report->orientation = "L"; // tipo de orientacion L => Horizontal, P => Vertical
        $report->createReportPdf(
                $this->render('exportpdf', [
                    'arr_head' => $arr_head,
                    'arr_body' => $arr_body
                ])
        );
        $report->mpdf->Output('Reporte_' . date("Ymdhis") . ".pdf", ExportFile::OUTPUT_TO_DOWNLOAD);
        return;
    }        
}
