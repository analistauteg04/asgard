<?php

namespace app\modules\academico\controllers;

use Yii;
use app\modules\academico\models\Asignatura;
use app\modules\academico\models\Distributivo;
use app\modules\academico\models\SemestreAcademico;
use app\modules\academico\models\UnidadAcademica;
use yii\helpers\ArrayHelper;
use app\models\Utilities;
use app\modules\academico\Module as academico;
use app\modules\admision\Module as admision;
use app\models\ExportFile;

academico::registerTranslations();
admision::registerTranslations();

class DistributivoController extends \app\components\CController {

    public function actionIndex() {
        $distributivo_model = new Distributivo();
        $mod_semestre = new SemestreAcademico();
        $mod_unidad = new UnidadAcademica();
        $data = Yii::$app->request->get();
        if ($data['PBgetFilter']) {
            $arrSearch["search"] = $data['search'];                        
            $arrSearch["unidad"] = $data['unidad'];      
            $arrSearch["semestre"] = $data['semestre'];
            $model = $distributivo_model->consultarDistributivo($arrSearch);
            return $this->render('index-grid', [
                        "model" => $model,
            ]);
        } else {
            $model = $distributivo_model->consultarDistributivo();
        }        
        $arr_unidad = $mod_unidad->consultarUnidadAcademicasEmpresa(1);
        $arr_semestre = $mod_semestre->consultarSemestres();
        return $this->render('index', [
                   'mod_unidad' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_unidad), "id", "name"),
                   'mod_semestre' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_semestre), "id", "name"),
                   'model' => $distributivo_model->consultarDistributivo(),
        ]);
    }
    
    public function actionExpexcel() {
        ini_set('memory_limit', '256M');
        $content_type = Utilities::mimeContentType("xls");
        $nombarch = "Report-" . date("YmdHis") . ".xls";
        header("Content-Type: $content_type");
        header("Content-Disposition: attachment;filename=" . $nombarch);
        header('Cache-Control: max-age=0');
        $colPosition = array("C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N");
        $arrHeader = array(
            Yii::t("formulario", "DNI 1"),
            academico::t("Academico", "Teacher"),
            academico::t("Academico", "Dedication"),
            Yii::t("formulario", "Academic unit"),
            Yii::t("formulario", "Subject"),
            Yii::t("formulario", "Semester"),            
        );
        $distributivo_model = new Distributivo();        
        $data = Yii::$app->request->get();
        $arrSearch["search"] = $data['search'];                
        $arrSearch["unidad"] = $data['unidad'];
        $arrSearch["semestre"] = $data['semestre'];
        $arrData = array();
        if ($arrSearch["unidad"] ==0 and $arrSearch["semestre"] ==0 and (empty($arrSearch["search"]))) {
            \app\models\Utilities::putMessageLogFile('arrSearch vacío');
            $arrData = $distributivo_model->consultarDistributivoReporte(array());
        } else {            
            $arrData = $distributivo_model->consultarDistributivoReporte($arrSearch);
        }        
        $nameReport = academico::t("Academico", "Distributive List");
        Utilities::generarReporteXLS($nombarch, $nameReport, $arrHeader, $arrData, $colPosition);
        exit;
    }

    public function actionExppdf() {
        $report = new ExportFile();
        $this->view->title = academico::t("Academico", "Distributive List"); // Titulo del reporte
        $arrHeader = array(
            Yii::t("formulario", "DNI 1"),
            academico::t("Academico", "Teacher"),
            academico::t("Academico", "Dedication"),
            Yii::t("formulario", "Academic unit"),
            Yii::t("formulario", "Subject"),
            Yii::t("formulario", "Semester"),
        );
        $distributivo_model = new Distributivo();        
        $data = Yii::$app->request->get();        
        $arrSearch["search"] = $data['search'];                
        $arrSearch["unidad"] = $data['unidad'];
        $arrSearch["semestre"] = $data['semestre'];
        $arrData = array();
        if ($arrSearch["unidad"] ==0 and $arrSearch["semestre"] ==0 and (empty($arrSearch["search"]))) {
            $arrData = $distributivo_model->consultarDistributivoReporte(array());
        } else {
            $arrData = $distributivo_model->consultarDistributivoReporte($arrSearch);
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

