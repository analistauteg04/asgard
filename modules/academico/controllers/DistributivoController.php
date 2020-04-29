<?php

namespace app\modules\academico\controllers;

use Yii;
use app\modules\academico\models\Asignatura;
use app\modules\academico\models\Distributivo;
use app\modules\academico\models\SemestreAcademico;
use app\modules\academico\models\UnidadAcademica;
use app\modules\academico\models\TipoDistributivo;
use app\modules\academico\models\Modalidad;
use app\modules\academico\models\PeriodoAcademicoMetIngreso;
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
            Yii::t("formulario", "Description"),
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
            Yii::t("formulario", "Description"),
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
    
    public function actionCarga_horaria() {
        $distributivo_model = new Distributivo();
        $mod_semestre = new SemestreAcademico();
        $mod_tipo = new TipoDistributivo();
        $data = Yii::$app->request->get();
        if ($data['PBgetFilter']) {
            $arrSearch["search"] = $data['search'];                        
            $arrSearch["tipo"] = $data['tipo'];      
            $arrSearch["semestre"] = $data['semestre'];
            $model = $distributivo_model->consultarCargaHoraria($arrSearch);
            return $this->render('carga_horaria-grid', [
                        "model" => $model,
            ]);
        } else {
            $model = $distributivo_model->consultarCargaHoraria();
        }        
        $arr_tipo = $mod_tipo->consultarTipoDistributivo();
        $arr_semestre = $mod_semestre->consultarSemestres();
        return $this->render('carga_horaria', [
                   'mod_tipo' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_tipo), "id", "name"),
                   'mod_semestre' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_semestre), "id", "name"),
                   'model' => $distributivo_model->consultarCargaHoraria(),
        ]);
    }
    
     public function actionExpexcelhoras() {
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
            Yii::t("formulario", "Semester"),
            academico::t("Academico", "Teaching"),
            academico::t("Academico", "Tutorial"),
            academico::t("Academico", "Investigation"),
            academico::t("Academico", "Bonding"),
            academico::t("Academico", "Administrative"),
            academico::t("Academico", "Other activities"),
            academico::t("Academico", "Total Hours")
        );
        $distributivo_model = new Distributivo();        
        $data = Yii::$app->request->get();
        $arrSearch["search"] = $data['search'];                
        $arrSearch["tipo"] = $data['tipo'];
        $arrSearch["semestre"] = $data['semestre'];
        $arrData = array();
        if ($arrSearch["tipo"] ==0 and $arrSearch["semestre"] ==0 and (empty($arrSearch["search"]))) {
            \app\models\Utilities::putMessageLogFile('arrSearch vacío');
            $arrData = $distributivo_model->consultarCargaHorariaReporte(array());
        } else {            
            $arrData = $distributivo_model->consultarCargaHorariaReporte($arrSearch);
        }        
        $nameReport = academico::t("Academico", "Workload");
        Utilities::generarReporteXLS($nombarch, $nameReport, $arrHeader, $arrData, $colPosition);
        exit;
    }
    
    public function actionListarestudiantes() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $distributivo_model = new Distributivo();
        $mod_modalidad = new Modalidad();
        $mod_unidad = new UnidadAcademica();
        $mod_periodo = new PeriodoAcademicoMetIngreso();
        $data = Yii::$app->request->get();
         
        if ($data['PBgetFilter']) {
            $arrSearch["search"] = $data['search'];                        
            $arrSearch["unidad"] = $data['unidad'];      
            $arrSearch["modalidad"] = $data['modalidad'];
            $arrSearch["periodo"] = $data['periodo'];
            $model = $distributivo_model->consultarDistributivoxProfesor($arrSearch,$per_id,1);
            return $this->render('listar_distributivo-grid', [
                        "model" => $model,
            ]);
        } else {
            $model = $distributivo_model->consultarDistributivoxProfesor(null,$per_id,1);
        }        
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["getmodalidad"])) {
                $modalidad = $mod_modalidad->consultarModalidad($data["uaca_id"], 1);
                $message = array("modalidad" => $modalidad);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
        }
        $arr_unidad = $mod_unidad->consultarUnidadAcademicasEmpresa(1);
        $arr_modalidad = $mod_modalidad->consultarModalidad($arr_unidad[0]["id"], 1);
        $arr_periodo = $mod_periodo->consultarPeriodoAcademico();
        return $this->render('listar_distributivo_profesor', [
                   'mod_unidad' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_unidad), "id", "name"),
                   'mod_modalidad' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_modalidad), "id", "name"),
                   'mod_periodo' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_periodo), "id", "name"),
                   'model' => $model,
        ]);
    }
    
    public function actionExpexceldist() {                          
        $per_id = @Yii::$app->session->get("PB_perid");        
                
        ini_set('memory_limit', '256M');
        $content_type = Utilities::mimeContentType("xls");
        $nombarch = "Report-" . date("YmdHis") . ".xls";
        header("Content-Type: $content_type");
        header("Content-Disposition: attachment;filename=" . $nombarch);
        header('Cache-Control: max-age=0');
        $colPosition = array("C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N");
        $arrHeader = array(
            Yii::t("formulario", "Academic unit"),
            Yii::t("formulario", "Mode"),            
            Yii::t("formulario", "DNI"),
            Yii::t("formulario", "Complete Names"),
            Yii::t("formulario", "Period"),
            Yii::t("formulario", "Subject"),                        
            Yii::t("formulario", "Payment Status"),         
        );
        \app\models\Utilities::putMessageLogFile('perid:'.$per_id);
        $distributivo_model = new Distributivo();        
        $data = Yii::$app->request->get();
        $arrSearch["search"] = $data['search'];                        
        $arrSearch["unidad"] = $data['unidad'];      
        $arrSearch["modalidad"] = $data['modalidad'];
        $arrSearch["periodo"] = $data['periodo'];
                 
        $arrData = array();
        if ($arrSearch["unidad"] ==0 and $arrSearch["modalidad"] ==0 and $arrSearch["periodo"] ==0 and (empty($arrSearch["search"]))) {            
            $arrData = $distributivo_model->consultarDistributivoxProfesor(array(),$per_id,0);
        } else {                     
            $arrData = $distributivo_model->consultarDistributivoxProfesor($arrSearch, $per_id,0);
        }        
        $nameReport = academico::t("Academico", "Listado de estudiantes");
        Utilities::generarReporteXLS($nombarch, $nameReport, $arrHeader, $arrData, $colPosition);
        exit;
    }
    
    public function actionExppdfdis() {
        $per_id = @Yii::$app->session->get("PB_perid");        
        $report = new ExportFile();
        $this->view->title = academico::t("Academico", "Listado de estudiantes"); // Titulo del reporte
        $arrHeader = array(
            Yii::t("formulario", "Academic unit"),
            Yii::t("formulario", "Mode"),            
            Yii::t("formulario", "DNI"),
            Yii::t("formulario", "Complete Names"),
            Yii::t("formulario", "Period"),
            Yii::t("formulario", "Subject"),                        
            Yii::t("formulario", "Payment Status"),  
        );
        $distributivo_model = new Distributivo();        
        $data = Yii::$app->request->get();        
        $arrSearch["search"] = $data['search'];                        
        $arrSearch["unidad"] = $data['unidad'];      
        $arrSearch["modalidad"] = $data['modalidad'];
        $arrSearch["periodo"] = $data['periodo'];
        
        $arrData = array();
        if ($arrSearch["unidad"] ==0 and $arrSearch["modalidad"] ==0 and $arrSearch["periodo"] ==0 and (empty($arrSearch["search"]))) {            
            $arrData = $distributivo_model->consultarDistributivoxProfesor(array(),$per_id,0);
        } else {                     
            $arrData = $distributivo_model->consultarDistributivoxProfesor($arrSearch, $per_id,0);
        }        
        $report->orientation = "L"; // tipo de orientacion L => Horizontal, P => Vertical                                
        $report->createReportPdf(
                $this->render('exportpdf', [
                    'arr_head' => $arrHeader,
                    'arr_body' => $arrData,
                ])
        );
        $report->mpdf->Output('Reporte_' . date("Ymdhis") . ".pdf", ExportFile::OUTPUT_TO_DOWNLOAD);
    }   
    public function actionListarestudiantespago() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $distributivo_model = new Distributivo();
        $mod_modalidad = new Modalidad();
        $mod_unidad = new UnidadAcademica();
        $mod_periodo = new PeriodoAcademicoMetIngreso();
        $data = Yii::$app->request->get();
         
        if ($data['PBgetFilter']) {
            $arrSearch["search"] = $data['search'];                        
            $arrSearch["unidad"] = $data['unidad'];      
            $arrSearch["modalidad"] = $data['modalidad'];
            $arrSearch["periodo"] = $data['periodo'];
            $model = $distributivo_model->consultarDistributivoxEstudiante($arrSearch,1);
            return $this->render('_listarestudiantespagogrid', [
                        "model" => $model,
            ]);
        } else {
            $model = $distributivo_model->consultarDistributivoxEstudiante(null,1);
        }        
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["getmodalidad"])) {
                $modalidad = $mod_modalidad->consultarModalidad($data["uaca_id"], 1);
                $message = array("modalidad" => $modalidad);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
        }
        $arr_unidad = $mod_unidad->consultarUnidadAcademicasEmpresa(1);
        $arr_modalidad = $mod_modalidad->consultarModalidad($arr_unidad[0]["id"], 1);
        $arr_periodo = $mod_periodo->consultarPeriodoAcademico();
        return $this->render('listarestudiantepago', [
                   'mod_unidad' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_unidad), "id", "name"),
                   'mod_modalidad' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_modalidad), "id", "name"),
                   'mod_periodo' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_periodo), "id", "name"),
                   'model' => $model,
        ]);
    }
}

