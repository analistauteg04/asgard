<?php

namespace app\modules\academico\controllers;

use Yii;
use app\modules\academico\models\Admitido;
use app\modules\academico\models\EstudioAcademico;
use yii\helpers\ArrayHelper;
use app\models\Utilities;
class AdmitidosController extends \app\components\CController {
    public function actionIndex() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $mod_carrera = new EstudioAcademico();

        $data = Yii::$app->request->get();
        if ($data['PBgetFilter']) {
            $arrSearch["f_ini"] = $data['f_ini'];
            $arrSearch["f_fin"] = $data['f_fin'];
            $arrSearch["carrera"] = $data['carrera'];
            $arrSearch["search"] = $data['search'];
            $arrSearch["codigocan"] = $data['codigocan'];
            $mod_aspirante = Admitido::getAdmitidos($arrSearch);
            return $this->renderPartial('index-grid', [
                        "model" => $mod_aspirante,
            ]);
        } else {
            $mod_aspirante = Admitido::getAdmitidos();
        }
        if (Yii::$app->request->isAjax) {//
            $data = Yii::$app->request->get();
            if (isset($data["op"]) && $data["op"] == '1') {
                
            }
        }
        $arrCarreras = ArrayHelper::map(array_merge([["id" => "0", "value" => Yii::t("formulario", "Grid")]], $mod_carrera->consultarCarrera()), "id", "value");
        return $this->render('index', [
                    'model' => $mod_aspirante,
                    'arrCarreras' => $arrCarreras,
        ]);
    }

    public function actionExpexcel() {
        ini_set('memory_limit', '256M');
        $content_type = Utilities::mimeContentType("xls");
        $nombarch = "Report-" . date("YmdHis") . ".xls";
        header("Content-Type: $content_type");
        header("Content-Disposition: attachment;filename=" . $nombarch . ".xls");
        header('Cache-Control: max-age=0');
        $colPosition = array("C", "D", "E", "F", "G", "H", "I", "J", "K", "L");
        $arrHeader = array(
            Yii::t("Solicitudes", "Request #"),//ingles
            Yii::t("Solicitudes", "Application date"),//ingles
            Yii::t("formulario", "DNI 1"),
            Yii::t("formulario", "First Names"),
            Yii::t("formulario", "Last Names"),
            Yii::t("Solicitudes", "Income Method"),//ingles
            Yii::t("Academico", "Career/Program"),//ingles
            Yii::t("Solicitudes", "Scholarship"),//ingles
            Yii::t("Academico", "Registered"),//ingles
        );
        $data = Yii::$app->request->get();
        $arrSearch["f_ini"] = $data['fecha_ini'];
        $arrSearch["f_fin"] = $data['fecha_fin'];
        $arrSearch["carrera"] = $data['carrera'];
        $arrSearch["search"] = $data['search'];
        $arrData = array();
        $admitido_model=new Admitido();
        if (empty($arrSearch)) {
            $arrData = $admitido_model->consultarReportAdmitidos(array(),true);
        } else {
            $arrData = $admitido_model->consultarReportAdmitidos($arrSearch,true);
        }
        \app\models\Utilities::putMessageLogFile($arrData);
        $nameReport = yii::t("formulario", "Application Reports");
        Utilities::generarReporteXLS($nombarch, $nameReport, $arrHeader, $arrData, $colPosition);
        exit;
    }

}
