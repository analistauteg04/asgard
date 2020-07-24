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
use app\modules\academico\models\MatriculacionProgramaInscrito;
use app\modules\academico\models\Estudiante;
use app\modules\admision\models\Oportunidad;
use app\modules\admision\models\SolicitudInscripcion;
use app\modules\academico\Module as academico;
use app\modules\financiero\Module as financiero;
use app\modules\admision\Module as admision;

academico::registerTranslations();
admision::registerTranslations();
financiero::registerTranslations();

class EstudianteController extends \app\components\CController {

    public function actionIndex() {
        $mod_estudiante = new Estudiante();
        $mod_programa = new EstudioAcademico();
        $mod_modalidad = new Modalidad();
        $mod_unidad = new UnidadAcademica();
        $modcanal = new Oportunidad();
        $data = Yii::$app->request->get();
        if ($data['PBgetFilter']) {
            $arrSearch["search"] = $data['search'];
            $arrSearch["f_ini"] = $data['f_ini'];
            $arrSearch["f_fin"] = $data['f_fin'];
            $arrSearch["unidad"] = $data['unidad'];
            $arrSearch["modalidad"] = $data['modalidad'];
            $arrSearch["carrera"] = $data['carrera'];
            $arr_estudiante = $mod_estudiante->consultarEstudiante($arrSearch);
            return $this->renderPartial('index-grid', [
                        "model" => $arr_estudiante,
            ]);
        } else {
            $arr_estudiante = $mod_estudiante->consultarEstudiante();
        }
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
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
        return $this->render('index', [
                    'model' => $arr_estudiante,
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
            Yii::t("formulario", "First Names"),
            academico::t("diploma", "DNI"),
            academico::t("Academico", 'Enrollment Number'),
            Yii::t("formulario", "Category"),
            Yii::t("formulario", 'Date Create'),
            academico::t("Academico", "Academic unit"),
            academico::t("matriculacion", "Modality"),
            academico::t("Academico", "Career/Program")            
        );

        $mod_estudiante = new Estudiante();
        $data = Yii::$app->request->get();

        $arrSearch["search"] = $data['search'];
        $arrSearch["f_ini"] = $data['f_ini'];
        $arrSearch["f_fin"] = $data['f_fin'];
        $arrSearch["estadoSol"] = $data['estadoSol'];
        $arrSearch["unidad"] = $data['unidad'];
        $arrSearch["modalidad"] = $data['modalidad'];
        $arrSearch["carrera"] = $data['carrera'];

        $arrData = array();
        if (empty($arrSearch)) {
            $arrData = $mod_estudiante->consultarEstudiante(array(), true);
        } else {
            $arrData = $mod_estudiante->consultarEstudiante($arrSearch, true);
        }

        $nameReport = academico::t("Academico", "List students");
        
        Utilities::generarReporteXLS($nombarch, $nameReport, $arrHeader, $arrData, $colPosition);
        exit;
    }

    public function actionExppdf() {
        $report = new ExportFile();
        $this->view->title = academico::t("Academico", "List students"); // Titulo del reporte

        $mod_estudiante = new Estudiante();
        $data = Yii::$app->request->get();
        $arr_body = array();

        $arrSearch["search"] = $data['search'];
        $arrSearch["f_ini"] = $data['f_ini'];
        $arrSearch["f_fin"] = $data['f_fin'];   
        $arrSearch["unidad"] = $data['unidad'];
        $arrSearch["modalidad"] = $data['modalidad'];
        $arrSearch["carrera"] = $data['carrera'];

        $arr_head = array(
            Yii::t("formulario", "First Names"),
            academico::t("diploma", "DNI"),
            academico::t("Academico", 'Enrollment Number'),
            Yii::t("formulario", "Category"),
            Yii::t("formulario", 'Date Create')  ,
            academico::t("Academico", "Academic unit"),
            academico::t("matriculacion", "Modality"),
            academico::t("Academico", "Career/Program")                      
        );

        if (empty($arrSearch)) {
            $arr_body = $mod_estudiante->consultarEstudiante(array(), true);
        } else {
            $arr_body = $mod_estudiante->consultarEstudiante($arrSearch, true);
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
