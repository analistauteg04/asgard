<?php

namespace app\modules\academico\controllers;

use Yii;
use app\modules\academico\models\Admitido;
use app\modules\academico\models\EstudioAcademico;
use yii\helpers\ArrayHelper;
use app\models\Utilities;
use app\modules\academico\models\Modalidad;
use app\modules\academico\models\UnidadAcademica;
use app\modules\admision\models\Oportunidad;
use app\modules\academico\Module as academico;
use app\modules\financiero\Module as financiero;
use app\modules\admision\Module as admision;
use app\models\ExportFile;

academico::registerTranslations();
admision::registerTranslations();
financiero::registerTranslations();

class AdmitidosController extends \app\components\CController {

    public function actionIndex() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $mod_carrera = new EstudioAcademico();
        $mod_modalidad = new Modalidad();
        $mod_unidad = new UnidadAcademica();
        $modcanal = new Oportunidad();
        $data = Yii::$app->request->get();
        if ($data['PBgetFilter']) {
            $arrSearch["f_ini"] = $data['f_ini'];
            $arrSearch["f_fin"] = $data['f_fin'];
            $arrSearch["search"] = $data['search'];
            $arrSearch["codigocan"] = $data['codigocan'];
            $arrSearch["unidad"] = $data['unidad'];
            $arrSearch["modalidad"] = $data['modalidad'];
            $arrSearch["carrera"] = $data['carrera'];
            $arrSearch["periodo"] = $data['periodo'];
            $mod_aspirante = Admitido::getAdmitidos($arrSearch);
            return $this->renderPartial('index-grid', [
                        "model" => $mod_aspirante,
            ]);
        } else {
            $mod_aspirante = Admitido::getAdmitidos();
        }
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["op"]) && $data["op"] == '1') {
                
            }
            if (isset($data["getmodalidad"])) {
                $modalidad = $mod_modalidad->consultarModalidad($data["nint_id"], 1);
                $message = array("modalidad" => $modalidad);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);            
            }
            if (isset($data["getcarrera"])) {
                $carrera = $modcanal->consultarCarreraModalidad($data["unidada"], $data["moda_id"]);
                $message = array("carrera" => $carrera);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);              
            }
        }       
        $arr_ninteres = $mod_unidad->consultarUnidadAcademicasEmpresa(1);
        $arr_modalidad = $mod_modalidad->consultarModalidad($arr_ninteres[0]["id"], 1);
        $arr_carrerra1 = $modcanal->consultarCarreraModalidad($arr_ninteres[0]["id"], $arr_modalidad[0]["id"]);
        $arrCarreras = ArrayHelper::map(array_merge([["id" => "0", "value" => Yii::t("formulario", "Grid")]], $mod_carrera->consultarCarrera()), "id", "value");
        return $this->render('index', [
                    'model' => $mod_aspirante,
                    'arrCarreras' => $arrCarreras,
                    'arr_ninteres' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_ninteres), "id", "name"),
                    'arr_modalidad' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_modalidad), "id", "name"),
                    'arr_carrerra1' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_carrerra1), "id", "name"),
        ]);
    }

    public function actionExpexcel() {
        ini_set('memory_limit', '256M');
        $content_type = Utilities::mimeContentType("xls");
        $nombarch = "Report-" . date("YmdHis") . ".xls";
        header("Content-Type: $content_type");
        header("Content-Disposition: attachment;filename=" . $nombarch);
        header('Cache-Control: max-age=0');
        $colPosition = array("C", "D", "E", "F", "G", "H", "I", "J", "K", "L");
        $arrHeader = array(
            admision::t("Solicitudes", "Request #"),
            admision::t("Solicitudes", "Application date"), //ingles
            Yii::t("formulario", "DNI 1"),
            Yii::t("formulario", "First Names"),
            Yii::t("formulario", "Last Names"),
            academico::t("Academico", "Income Method"), //ingles
            academico::t("Academico", "Career/Program"),
            admision::t("Solicitudes", "Scholarship"),
            academico::t("Academico", "Period")
        );
        $data = Yii::$app->request->get();
        $arrSearch = array();
        if (count($data) > 0) {
            $arrSearch["f_ini"] = $data['fecha_ini'];
            $arrSearch["f_fin"] = $data['fecha_fin'];
            $arrSearch["search"] = $data['search'];
            $arrSearch["unidad"] = $data['unidad'];
            $arrSearch["modalidad"] = $data['modalidad'];
            $arrSearch["carrera"] = $data['carrera'];
            $arrSearch["periodo"] = $data['periodo'];
        }
        $arrData = array();
        $admitido_model = new Admitido();
        if (count($arrSearch) > 0) {
            $arrData = $admitido_model->consultarReportAdmitidos($arrSearch, true);
        } else {
            $arrData = $admitido_model->consultarReportAdmitidos(array(), true);
        }
        \app\models\Utilities::putMessageLogFile($arrData);
        $nameReport = academico::t("Academico", "Admitted");
        Utilities::generarReporteXLS($nombarch, $nameReport, $arrHeader, $arrData, $colPosition);
        exit;
    }

    public function actionExppdf() {
        $report = new ExportFile();
        $this->view->title = academico::t("Academico", "Admitted");  // Titulo del reporte
        $arrHeader = array(
            admision::t("Solicitudes", "Request #"),
            admision::t("Solicitudes", "Application date"), //ingles
            Yii::t("formulario", "DNI 1"),
            Yii::t("formulario", "First Names"),
            Yii::t("formulario", "Last Names"),
            academico::t("Academico", "Income Method"), //ingles
            academico::t("Academico", "Career/Program"),
            admision::t("Solicitudes", "Scholarship"),
            academico::t("Academico", "Period")
        );
        $data = Yii::$app->request->get();
        $arrSearch = array();
        if (count($data) > 0) {
            $arrSearch["f_ini"] = $data['fecha_ini'];
            $arrSearch["f_fin"] = $data['fecha_fin'];
            $arrSearch["carrera"] = $data['carrera'];
            $arrSearch["search"] = $data['search'];
            $arrSearch["unidad"] = $data['unidad'];
            $arrSearch["modalidad"] = $data['modalidad'];
            $arrSearch["carrera"] = $data['carrera'];
            $arrSearch["periodo"] = $data['periodo'];
        }
        $arrData = array();
        $admitido_model = new Admitido();
        if (count($arrSearch) > 0) {
            $arrData = $admitido_model->consultarReportAdmitidos($arrSearch, true);
        } else {
            $arrData = $admitido_model->consultarReportAdmitidos(array(), true);
        }
        $report->orientation = "L"; // tipo de orientacion L => Horizontal, P => Vertical                                
        $report->createReportPdf(
                $this->render('exportpdf', [
                    'arr_head' => $arrHeader,
                    'arr_body' => $arrData
                ])
        );
        $report->mpdf->Output('Reporte_' . date("Ymdhis") . ".pdf", ExportFile::OUTPUT_TO_DOWNLOAD);
    }

}
