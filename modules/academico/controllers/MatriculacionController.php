<?php

namespace app\modules\academico\controllers;

use Yii;

use app\modules\admision\models\SolicitudInscripcion;
use app\modules\academico\models\Matriculacion;
use yii\helpers\ArrayHelper;


class MatriculacionController extends \app\components\CController {
    public function actionIndex() {
    return $this->render('index', [
           
        ]);    
    }

    public function actionNewhomologacion() {
    return $this->render('newHomologacion', [
           
        ]);    
    }
    
    public function actionNewmetodoingreso() {
        $sins_id = base64_decode($_GET['sids']);
        $mod_solins = new SolicitudInscripcion();
        $mod_matriculacion = new Matriculacion();
        $personaData = $mod_solins->consultarInteresadoPorSol_id($sins_id);
        
        $resp_Periodos = $mod_matriculacion->consultaPeriodoAcademico($personaData["uaca_id"], $personaData["mod_id"], $personaData["eaca_id"]);
        $resp_Paralelos = $mod_matriculacion->consultaParalelo();
        return $this->render('newmetodoingreso', [
                            'personalData' => $personaData,      
                            'arr_periodo' => ArrayHelper::map($resp_Periodos,"id","value"),
                            'arr_paralelo' => ArrayHelper::map($resp_Paralelos,"id","value"),
            
        ]);    
    }
    public function actionView() {
    return $this->render('view', [
           
        ]);    
    }
    public function actionEdit() {
    return $this->render('edit', [
           
        ]);    
    }
    public function actionSave() {
        $usu_id = @Yii::$app->session->get("PB_iduser");
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $par_id = base64_decode($data["par_id"]);            
            $adm_id = base64_decode($data["adm_id"]);       
            $sins_id = base64_decode($data["sins_id"]);  
            $con = \Yii::$app->db_academico;
            $transaction = $con->beginTransaction();            
            try {                                
                    $fecha = date(Yii::$app->params["dateTimeByDefault"]);
                    $descripcion = "Asignación por Matrícula Método Ingreso.";
                    $mod_Matriculacion = new Matriculacion();
                    $resp_matriculacion = $mod_Matriculacion->insertarMatriculacion(null, $adm_id, null, $sins_id, $fecha, $usu_id);
                    if ($resp_matriculacion) {
                        $resp_Asigna = $mod_Matriculacion->insertarAsignacionxMeting($par_id, $resp_matriculacion, null, $descripcion, $fecha, $usu_id);
                        if ($resp_Asigna) {
                            $exito = '1';
                        }
                    }
                    if ($exito) {
                        $transaction->commit();                        
                        $message = array(
                            "wtmessage" => Yii::t("notificaciones", "La información ha sido grabada."),
                            "title" => Yii::t('jslang', 'Success'),
                        );
                        return \app\models\Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                    } else {
                        //$paso = 1;
                        $transaction->rollback();                       
                        if (empty($message)) {
                            $message = array
                                (
                                "wtmessage" => Yii::t("notificaciones", "Error al grabar. " . $mensaje), "title" =>
                                Yii::t('jslang', 'Success'),
                            );
                        }
                        return \app\models\Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                    } 
                    
                }   catch (Exception $ex) {
                $transaction->rollback();                
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $mensaje),
                    "title" => Yii::t('jslang', 'Success'),
                );
                return \app\models\Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
            }
            return;
        }    
    }
    
    
    public function actionUpdate() {
    return $this->render('update', [
           
        ]);    
    }
}