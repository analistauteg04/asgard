<?php

namespace app\modules\academico\controllers;

use Yii;
use app\models\ExportFile;
use app\modules\academico\models\Admitido;
use app\modules\academico\models\EstudioAcademico;
use yii\helpers\ArrayHelper;
use app\models\Utilities;
use app\modules\academico\models\Modalidad;
use app\modules\academico\models\UnidadAcademica;
use app\modules\academico\models\PromocionPrograma;
use app\modules\academico\models\ParaleloPromocionPrograma;
use app\modules\admision\models\Oportunidad;
use app\modules\admision\models\SolicitudInscripcion;
use app\modules\academico\Module as academico;
use app\modules\financiero\Module as financiero;
use app\modules\admision\Module as admision;


academico::registerTranslations();
admision::registerTranslations();
financiero::registerTranslations();

class MatriculacionposgradosController extends \app\components\CController {

    public function actionIndex() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $mod_programa = new EstudioAcademico();
        $mod_modalidad = new Modalidad();
        $mod_unidad = new UnidadAcademica();
        $modcanal = new Oportunidad();
        $data = Yii::$app->request->get();
        if ($data['PBgetFilter']) {
            $arrSearch["search"] = $data['search'];           
            $arrSearch["unidad"] = $data['unidad'];
            $arrSearch["modalidad"] = $data['modalidad'];
            $arrSearch["programa"] = $data['programa'];         
            $mod_promocion = PromocionPrograma::getPromocion($arrSearch);
            return $this->renderPartial('index-grid', [
                        "model" => $mod_promocion,
            ]);
        } else {
            $mod_promocion = PromocionPrograma::getPromocion();
        }
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["op"]) && $data["op"] == '1') {
                
            }
            if (isset($data["getmodalidad"])) {
                $modalidad = $mod_modalidad->consultarModalidad($data["uni_id"], 1);
                $message = array("modalidad" => $modalidad);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
            if (isset($data["getprograma"])) {
                $programa = $modcanal->consultarCarreraModalidad($data["unidada"], $data["moda_id"]);
                $message = array("programa" => $programa);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
        }
        $arr_unidad = $mod_unidad->consultarUnidadAcademicasEmpresa(1);
        $arr_modalidad = $mod_modalidad->consultarModalidad($arr_unidad[1]["id"], 1);
        $arr_programa1 = $modcanal->consultarCarreraModalidad($arr_unidad[1]["id"], $arr_modalidad[0]["id"]);
        $arrProgramas = ArrayHelper::map(array_merge([["id" => "0", "value" => Yii::t("formulario", "Grid")]], $mod_programa->consultarCarrera()), "id", "value");
        return $this->render('index', [
                    'model' => $mod_promocion,
                    'arrProgramas' => $arrProgramas,
                    'arr_unidad' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_unidad), "id", "name"),
                    'arr_modalidad' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_modalidad), "id", "name"),
                    'arr_programa1' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_programa1), "id", "name"),
        ]);
    }
    
    public function actionNew() {
        $sins_id = base64_decode($_GET['sids']);        
        $mod_solins = new SolicitudInscripcion();
        $mod_promocion = new PromocionPrograma();
        $mod_paralelo = new ParaleloPromocionPrograma();
               
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["getparalelos"])) {                                               
                $resp_Paralelos = $mod_paralelo->consultarParalelosxPrograma($data["promocion_id"]);
                $message = array("paralelos" => $resp_Paralelos);               
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);               
            }           
        }               
        $personaData = $mod_solins->consultarInteresadoPorSol_id($sins_id);
        $resp_programas = $mod_promocion->consultarPromocionxPrograma($personaData["eaca_id"]);
        $arr_Paralelos = $mod_paralelo->consultarParalelosxPrograma(0);
        return $this->render('new', [
                    'personalData' => $personaData,            
                    'arr_promocion' => ArrayHelper::map(array_merge([["id" => "0", "name" => "Seleccionar"]],$resp_programas),"id","name"), 
                    'arr_paralelo' => ArrayHelper::map(array_merge(["id" => "0", "name" => "Seleccionar"],$arr_Paralelos),"id","name"), 
        ]);
    }
    
    public function actionExpexcel() {
        ini_set('memory_limit', '256M');
        $content_type = Utilities::mimeContentType("xls");
        $nombarch = "Report-" . date("YmdHis") . ".xls";
        header("Content-Type: $content_type");
        header("Content-Disposition: attachment;filename=" . $nombarch);
        header('Cache-Control: max-age=0');
        $colPosition = array("C", "D", "E", "F", "G", "H", "I");
        $arrHeader = array(
            Yii::t("formulario", "Code"),
            Yii::t("formulario", "Year"),
            Yii::t("formulario", "Month"),
            academico::t("Academico", "Aca. Uni."),
            academico::t("Academico", "Modality"),
            Yii::t("formulario", "Program"),
            academico::t("Academico", "Parallel")           
        );
        $data = Yii::$app->request->get();
        $arrSearch = array();
        if (count($data) > 0) {            
            $arrSearch["search"] = $data['search'];
            $arrSearch["unidad"] = $data['unidad'];
            $arrSearch["modalidad"] = $data['modalidad'];
            $arrSearch["programa"] = $data['programa'];           
        }
        $arrData = array();
         $promocion = new PromocionPrograma();
        if (count($arrSearch) > 0) {
            $arrData = $promocion->getPromocion($arrSearch, true);
        } else {
            $arrData = $promocion->getPromocion(array(), true);
        }
        \app\models\Utilities::putMessageLogFile($arrData);
        $nameReport = Yii::t("formulario", "Promotion Program");
        Utilities::generarReporteXLS($nombarch, $nameReport, $arrHeader, $arrData, $colPosition);
        exit;
    }

    public function actionExppdf() {
        $report = new ExportFile();
        $this->view->title = Yii::t("formulario", "Promotion Program");  // Titulo del reporte
        $arrHeader = array(
            Yii::t("formulario", "Code"),
            Yii::t("formulario", "Year"),
            Yii::t("formulario", "Month"),
            academico::t("Academico", "Aca. Uni."),
            academico::t("Academico", "Modality"),
            Yii::t("formulario", "Program"),
            academico::t("Academico", "Parallel"),            
        );
        $data = Yii::$app->request->get();
        $arrSearch = array();
        if (count($data) > 0) {
            $arrSearch["search"] = $data['search'];
            $arrSearch["unidad"] = $data['unidad'];
            $arrSearch["modalidad"] = $data['modalidad'];
            $arrSearch["programa"] = $data['programa'];         
        }
        $arrData = array();
        $promocion = new PromocionPrograma();
        
        if (count($arrSearch) > 0) {
            $arrData = $promocion->getPromocion($arrSearch, true);
        } else {
            $arrData = $promocion->getPromocion(array(), true);
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