<?php

namespace app\modules\academico\controllers;

use Yii;
use app\modules\academico\models\Asignatura;
use app\modules\academico\models\DistributivoCabecera;
use app\modules\academico\models\SemestreAcademico;
use app\modules\academico\models\UnidadAcademica;
use app\modules\academico\models\TipoDistributivo;
use app\modules\academico\models\PromocionPrograma;
use app\modules\academico\models\ParaleloPromocionPrograma;
use app\modules\academico\models\Modalidad;
use app\modules\academico\models\PeriodoAcademicoMetIngreso;
use yii\helpers\ArrayHelper;
use app\models\Utilities;
use app\modules\academico\Module as academico;
use app\modules\admision\Module as admision;
use app\models\ExportFile;
use app\modules\academico\models\Profesor;
use Exception;

academico::registerTranslations();
admision::registerTranslations();

class DistributivocabeceraController extends \app\components\CController {

    public function actionIndex() {
        $per_id = @Yii::$app->session->get("PB_perid");        
        $model = NULL;
        $distributivocab_model = new DistributivoCabecera();        
        $mod_periodo = new PeriodoAcademicoMetIngreso();
        $data = Yii::$app->request->get();

        if ($data['PBgetFilter']) {
            $search = $data['search'];            
            $periodo = (isset($data['periodo']) && $data['periodo'] > 0)?$data['periodo']:NULL;            
            $model = $distributivocab_model->getListadoDistributivoCab($search, $periodo);
            return $this->render('index-grid', [
                        "model" => $model,
            ]);
        } else {
            $model = $distributivocab_model->getListadoDistributivoCab();
        }
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();            
        }        
        $arr_periodo = $mod_periodo->consultarPeriodoAcademico();
        return $this->render('index', [                    
                    'mod_periodo' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_periodo), "id", "name"),                    
                    'model' => $model,                    
        ]);
    }
        
    public function actionExportexcel() {
        $per_id = @Yii::$app->session->get("PB_perid");
        ini_set('memory_limit', '256M');
        $content_type = Utilities::mimeContentType("xls");
        $nombarch = "Report-" . date("YmdHis") . ".xls";
        header("Content-Type: $content_type");
        header("Content-Disposition: attachment;filename=" . $nombarch);
        header('Cache-Control: max-age=0');
        $colPosition = array("C", "D", "E", "F", "G", "H", "I");
        $arrHeader = array(
            academico::t("Academico", "Teacher"),
            Yii::t("formulario", "DNI 1"),
            Yii::t("formulario", "Academic unit"),
            Yii::t("formulario", "Mode"),
            Yii::t("formulario", "Period"),
            Yii::t("formulario", "Subject"),
            academico::t("Academico", "Working day"),
        );
        $distributivo_model = new DistributivoAcademico();
        $data = Yii::$app->request->get();
        $arrSearch["search"] = ($data['search'] != "")?$data['search']:NULL;
        $arrSearch["unidad"] = ($data['unidad'] > 0)?$data['unidad']:NULL;
        $arrSearch["modalidad"] = ($data['modalidad'] > 0)?$data['modalidad']:NULL;
        $arrSearch["periodo"] = ($data['periodo'] > 0)?$data['periodo']:NULL;
        $arrSearch["asignatura"] = ($data['asignatura'] > 0)?$data['asignatura']:NULL;
        $arrSearch["jornada"] = ($data['jornada'] > 0)?$data['jornada']:NULL;

        $arrData = $distributivo_model->getListadoDistributivo($arrSearch["search"], $arrSearch["modalidad"], $arrSearch["asignatura"], $arrSearch["jornada"], $arrSearch["unidad"], $arrSearch["periodo"], true);
        foreach($arrData as $key => $value){
            unset($arrData[$key]["Id"]);
        }
        $nameReport = academico::t("distributivoacademico", "Profesor Lists by Subject");
        Utilities::generarReporteXLS($nombarch, $nameReport, $arrHeader, $arrData, $colPosition);
        exit;
    }

    public function actionExportpdf() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $report = new ExportFile();
        $this->view->title = academico::t("distributivoacademico", "Profesor Lists by Subject"); // Titulo del reporte
        $arrHeader = array(
            academico::t("Academico", "Teacher"),
            Yii::t("formulario", "DNI 1"),
            Yii::t("formulario", "Academic unit"),
            Yii::t("formulario", "Mode"),
            Yii::t("formulario", "Period"),
            Yii::t("formulario", "Subject"),
            academico::t("Academico", "Working day"),
        );
        $distributivo_model = new DistributivoAcademico();
        $data = Yii::$app->request->get();
        $arrSearch["search"] = ($data['search'] != "")?$data['search']:NULL;
        $arrSearch["unidad"] = ($data['unidad'] > 0)?$data['unidad']:NULL;
        $arrSearch["modalidad"] = ($data['modalidad'] > 0)?$data['modalidad']:NULL;
        $arrSearch["periodo"] = ($data['periodo'] > 0)?$data['periodo']:NULL;
        $arrSearch["asignatura"] = ($data['asignatura'] > 0)?$data['asignatura']:NULL;
        $arrSearch["jornada"] = ($data['jornada'] > 0)?$data['jornada']:NULL;

        $arrData = $distributivo_model->getListadoDistributivo($arrSearch["search"], $arrSearch["modalidad"], $arrSearch["asignatura"], $arrSearch["jornada"], $arrSearch["unidad"], $arrSearch["periodo"], true);
        $report->orientation = "P"; // tipo de orientacion L => Horizontal, P => Vertical                                
        $report->createReportPdf(
                $this->render('exportpdf', [
                    'arr_head' => $arrHeader,
                    'arr_body' => $arrData,
                ])
        );
        $report->mpdf->Output('Reporte_' . date("Ymdhis") . ".pdf", ExportFile::OUTPUT_TO_DOWNLOAD);
    }

}