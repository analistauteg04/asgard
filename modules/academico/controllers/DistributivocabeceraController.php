<?php

namespace app\modules\academico\controllers;

use Yii;
use app\modules\academico\models\DistributivoCabecera;
use app\modules\academico\models\DistributivoAcademico;
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
    private function estados() {
        return [
            '0' => Yii::t("formulario", "Todos"),
            '1' => Yii::t("formulario", "Por aprobar"),
            '2' => Yii::t("formulario", "Aprobado"),
            '3' => Yii::t("formulario", "No aprobado"),            
        ];
    }
    
     private function estadoRevision() {
        return [
            '0' => Yii::t("formulario", "Seleccionar"),
            '2' => Yii::t("formulario", "APPROVED"),
            '3' => Yii::t("formulario", "Not approved"),            
        ];
    }
    
    public function actionIndex() {
        $per_id = @Yii::$app->session->get("PB_perid");        
        $model = NULL;
        $distributivocab_model = new DistributivoCabecera();        
        $mod_periodo = new PeriodoAcademicoMetIngreso();
        $data = Yii::$app->request->get();

        if ($data['PBgetFilter']) {
            $search = $data['search'];            
            $periodo = (isset($data['periodo']) && $data['periodo'] > 0)?$data['periodo']:NULL;   
            $estado = (isset($data['estado']) && $data['estado'] > 0)?$data['estado']:NULL;   
            $model = $distributivocab_model->getListadoDistributivoCab($search, $periodo, $estado);
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
                    'arrEstados' => $this->estados(),
                    'model' => $model,                    
        ]);
    }
        
    public function actionExportexcel() {        
        ini_set('memory_limit', '256M');
        $content_type = Utilities::mimeContentType("xls");
        $nombarch = "Report-" . date("YmdHis") . ".xls";
        header("Content-Type: $content_type");
        header("Content-Disposition: attachment;filename=" . $nombarch);
        header('Cache-Control: max-age=0');
        $colPosition = array("C", "D", "E", "F", "G", "H", "I");
        $arrHeader = array(
            Yii::t("formulario", "Period"),
            Yii::t("formulario", "DNI 1"),
            academico::t("Academico", "Teacher"),
            Yii::t("formulario", "Status"),            
        );
        $distributivocab_model = new DistributivoCabecera();        
        $data = Yii::$app->request->get();        
            
        $arrSearch["search"] = ($data['search'] != "")?$data['search']:NULL;
        $arrSearch["periodo"] = ($data['periodo'] > 0)?$data['periodo']:NULL;
        $arrSearch["estado"] = ($data['estado'] > 0)?$data['estado']:NULL;        

        $arrData = $distributivocab_model->getListadoDistributivoCab($arrSearch["search"] , $arrSearch["periodo"], $arrSearch["estado"], true);
                
        foreach($arrData as $key => $value){
            unset($arrData[$key]["Id"]);
        }
        $nameReport = academico::t("distributivoacademico", "List of Distributive Teachers");
        Utilities::generarReporteXLS($nombarch, $nameReport, $arrHeader, $arrData, $colPosition);
        exit;
    }

    public function actionExportpdf() {        
        $report = new ExportFile();
        $this->view->title = academico::t("distributivoacademico", "List of Distributive Teachers"); // Titulo del reporte
        $arrHeader = array(
            Yii::t("formulario", "Period"),
            Yii::t("formulario", "DNI 1"),
            academico::t("Academico", "Teacher"),
            Yii::t("formulario", "Status"),       
        );
        $distributivocab_model = new DistributivoCabecera();     
        $data = Yii::$app->request->get();
        $arrSearch["search"] = ($data['search'] != "")?$data['search']:NULL;
        $arrSearch["periodo"] = ($data['periodo'] > 0)?$data['periodo']:NULL;
        $arrSearch["estado"] = ($data['estado'] > 0)?$data['estado']:NULL;  

        $arrData = $distributivocab_model->getListadoDistributivoCab($arrSearch["search"] , $arrSearch["periodo"], $arrSearch["estado"], true);
        $report->orientation = "P"; // tipo de orientacion L => Horizontal, P => Vertical                                
        $report->createReportPdf(
                $this->render('exportpdf', [
                    'arr_head' => $arrHeader,
                    'arr_body' => $arrData,
                ])
        );
        $report->mpdf->Output('Reporte_' . date("Ymdhis") . ".pdf", ExportFile::OUTPUT_TO_DOWNLOAD);
    }

    public function actionDeletecab(){        
        $distributivo_model = new DistributivoAcademico();
        $distributivo_cab = new DistributivoCabecera();
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();                                      
            $id = $data["id"];            
            $resCab = $distributivo_cab->obtenerDatosCabecera($id);            
            if ($resCab["estado"] != 2) {   
                $con = \Yii::$app->db_academico;
                $transaction = $con->beginTransaction();
                try {                                           
                    $resInactCab = $distributivo_cab->inactivarDistributivoCabecera($id);                    
                    \app\models\Utilities::putMessageLogFile('$resInactCab:'.$resInactCab);            
                    if ($resInactCab) {
                        // Inactivar distributivo académico
                        $resInactiva = $distributivo_model->inactivarDistributivoAcademico($resCab["pro_id"], $resCab["paca_id"]);
                        if ($resInactiva) {
                            $transaction->commit();
                            $message = array(
                                "wtmessage" => Yii::t("notificaciones", "Your information was successfully saved."),
                                "title" => Yii::t('jslang', 'Success'),
                            );
                            return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'true', $message);
                        } else {
                            $transaction->rollback();
                            $message = array(
                                "wtmessage" => Yii::t('notificaciones', 'Your information has not been saved. Please try again.'),
                                "title" => Yii::t('jslang', 'Error'),
                            );
                            return Utilities::ajaxResponse('NOOK', 'alert', Yii::t('jslang', 'Error'), 'true', $message);
                        }
                    }                                        
                } catch (Exception $ex) {
                    $transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t('notificaciones', 'Your information has not been saved. Please try again.'),
                        "title" => Yii::t('jslang', 'Error'),
                    );
                    return Utilities::ajaxResponse('NOOK', 'alert', Yii::t('jslang', 'Error'), 'true', $message);
                }
            } else { // Tiene estado aprobado
                $message = array(
                        "wtmessage" => Yii::t('notificaciones', 'Imposible eliminar el distributivo, porque se encuentra aprobado.'),
                        "title" => Yii::t('jslang', 'Error'),
                    );
                    return Utilities::ajaxResponse('NOOK', 'alert', Yii::t('jslang', 'Error'), 'true', $message);
            }
            
       }
    }
    
    public function actionReview($id) {                
        $distributivo_model = new DistributivoAcademico();
        $distributivo_cab = new DistributivoCabecera();
        $resCab = $distributivo_cab->obtenerDatosCabecera($id);
        $arr_distributivo = $distributivo_model->getListarDistribProfesor($resCab["paca_id"], $resCab["pro_id"]);
        return $this->render('review', [
            'arr_cabecera' => $resCab,            
            'arr_detalle' => $arr_distributivo,   
            'arr_estado' => $this->estadoRevision(),
        ]);
    }
    
    public function actionSavereview(){                
        $distributivo_cab = new DistributivoCabecera();
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();                                      
            $id = $data["id"];                        
            $estado = $data["resultado"];  
            $observacion = $data["observacion"];  
            $con = \Yii::$app->db_academico;
            $transaction = $con->beginTransaction();
            try {     
                if ($estado !=0) {
                    if ($estado ==3 && empty($observacion)) {
                        $transaction->rollback();
                        $message = array(
                            "wtmessage" => Yii::t('notificaciones', 'Digite una observación de la Revisión.'),
                            "title" => Yii::t('jslang', 'Error'),
                        );
                        return Utilities::ajaxResponse('NOOK', 'alert', Yii::t('jslang', 'Error'), 'true', $message);
                    }
                    $resultado = $distributivo_cab->revisarDistributivo($id, $estado, ucfirst(strtolower($observacion)));   
                    \app\models\Utilities::putMessageLogFile('resultadoREV:'.$resultado);            
                    if ($resultado) {                         
                        $transaction->commit();
                        $message = array(
                            "wtmessage" => Yii::t("notificaciones", "Your information was successfully saved."),
                            "title" => Yii::t('jslang', 'Success'),
                        );
                        return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'true', $message);
                    } else {                        
                        $transaction->rollback();
                        $message = array(
                            "wtmessage" => Yii::t('notificaciones', 'Your information has not been saved. Please try again.'),
                            "title" => Yii::t('jslang', 'Error'),
                        );
                        return Utilities::ajaxResponse('NOOK', 'alert', Yii::t('jslang', 'Error'), 'true', $message);
                    }
                } else {
                    $transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t('notificaciones', 'Seleccione un estado de Revisión.'),
                        "title" => Yii::t('jslang', 'Error'),
                    );
                    return Utilities::ajaxResponse('NOOK', 'alert', Yii::t('jslang', 'Error'), 'true', $message);
                }                

            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => Yii::t('notificaciones', 'Your information has not been saved. Please try again.'),
                    "title" => Yii::t('jslang', 'Error'),
                );
                return Utilities::ajaxResponse('NOOK', 'alert', Yii::t('jslang', 'Error'), 'true', $message);
            }                        
       }
    }
}