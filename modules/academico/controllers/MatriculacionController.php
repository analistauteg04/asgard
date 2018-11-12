<?php

namespace app\modules\academico\controllers;

use Yii;
use app\modules\admision\models\SolicitudInscripcion;
use app\modules\academico\models\Matriculacion;
use yii\helpers\ArrayHelper;
use app\models\Utilities;


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
        $pmin_id = 0;
        
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["getparalelos"])) {                                
               // \app\models\Utilities::putMessageLogFile('pmin_id ajax: ' . $data["pmin_id"]);
                $resp_Paralelos = $mod_matriculacion->consultarParalelo($data["pmin_id"]);
                $message = array("paralelos" => $resp_Paralelos);               
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);               
            }           
        }               
        $personaData = $mod_solins->consultarInteresadoPorSol_id($sins_id);
        $resp_Periodos = $mod_matriculacion->consultarPeriodoAcadMing($personaData["uaca_id"], $personaData["mod_id"], $personaData["ming_id"]);
        $arr_Paralelos = $mod_matriculacion->consultarParalelo($pmin_id);
        return $this->render('newmetodoingreso', [
                    'personalData' => $personaData,            
                    'arr_periodo' => ArrayHelper::map(array_merge([["id" => "0", "name" => "Seleccionar"]],$resp_Periodos),"id","name"), //ArrayHelper::map($resp_Periodos, "id", "name"),
                    'arr_paralelo' => ArrayHelper::map(array_merge(["id" => "0", "name" => "Seleccionar"],$arr_Paralelos),"id","name"), //ArrayHelper::map($arr_Paralelos, "id", "name"),
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
            $par_id = $data["par_id"];
            $periodo_id = $data["per_id"];
            $adm_id = base64_decode($data["adm_id"]);
            $sins_id = base64_decode($data["sins_id"]);
            $con = \Yii::$app->db_academico;
            $transaction = $con->beginTransaction();
            try {
                if (($periodo_id!=0) and ($par_id!=0)) {   
                    //Verificar que no tenga una matrícula.
                    $mod_Matriculacion = new Matriculacion();
                    $resp_consMatricula = $mod_Matriculacion->consultarMatriculaxId($adm_id, $sins_id);
                    if (!$resp_consMatricula) {
                        $fecha = date(Yii::$app->params["dateTimeByDefault"]);
                        $descripcion = "Asignación por Matrícula Método Ingreso.";
                        \app\models\Utilities::putMessageLogFile('periodo:'.$periodo_id);     
                        \app\models\Utilities::putMessageLogFile('solic:'.$sins_id);     
                        //Buscar el código de planificación académica según el periodo, unidad, modalidad y carrera.
                        $resp_planificacion = $mod_Matriculacion->consultarPlanificacion($sins_id, $periodo_id);
                        if ($resp_planificacion) { //Si existe código de planificación
                            $resp_matriculacion = $mod_Matriculacion->insertarMatriculacion($resp_planificacion["peac_id"], $adm_id, null, $sins_id, $fecha, $usu_id);
                            if ($resp_matriculacion) {
                                $resp_Asigna = $mod_Matriculacion->insertarAsignacionxMeting($par_id, $resp_matriculacion, null, $descripcion, $fecha, $usu_id);
                                if ($resp_Asigna) {
                                    $exito = '1';
                                }
                            }
                        }  else {
                            $mensaje = "¡No existe código de planificación académica para los datos proporcionados.!";
                        }                      
                    } else {
                        $mensaje = "¡Ya existe matrícula.!";
                    }                   
                } else {
                    $mensaje = "¡Seleccione Período Académico y Paralelo.!";
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
            } catch (Exception $ex) {
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
