<?php

namespace app\controllers;

use Yii;
use app\models\Utilities;
use app\models\InteresadoEjecutivo;
use yii\helpers\ArrayHelper;
use app\models\Persona;
use yii\helpers\Url;
use app\models\Interesado;

class AsignacionejecutivoController extends \app\components\CController {

    public function actionListarasignacion() {
        $data = Yii::$app->request->get();
        $mod_ejecutivo = new InteresadoEjecutivo();
        $per_id = Yii::$app->session->get("PB_perid");
        //$user_id = Yii::$app->session->get("PB_iduser");        
        $model = null;       
        $resp_ejecutivos = $mod_ejecutivo->consultarAgentes();
        if ($data['PBgetFilter']) {
            $arrSearch["f_ini"] = $data['f_ini'];
            $arrSearch["f_fin"] = $data['f_fin'];
            $arrSearch["ejecutivo"] = $data['ejecutivo'];
            $arrSearch["search"] = $data['search'];
            $model = InteresadoEjecutivo::consultarInteresados($arrSearch);
        } else {
            $model = InteresadoEjecutivo::consultarInteresados();
        }

        return $this->render('listarasignacion', [
                    'model' => $model,
                    'arrEjecutivos' => ArrayHelper::map(array_merge([["id" => "0", "name" => "Todas"]],$resp_ejecutivos), "id", "name"),
        ]);
    }

    public function actionAsignar() {
        $int_id = base64_decode($_GET["int"]);
        $pint_id = base64_decode($_GET["pint"]);
        $asp_id = base64_decode($_GET["asp"]);        
        $nom_interesado = base64_decode($_GET["nom_interesado"]);
        $per_id = Yii::$app->session->get("PB_perid");
        $user_id = Yii::$app->session->get("PB_iduser");        
        $mod_ejecutivo = new InteresadoEjecutivo();
        
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->get();
            $nivel = $data["nivel"];
            $modalidad = $data["modalidad"];
            if (isset($data["getagente"])) {
                $resp_agentes = $mod_ejecutivo->consultarListaEjecutivos($data["nivel"], $data["modalidad"], $per_id);            
                $message = array("agentes" => $resp_agentes);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }
        }
        //Obtener el nivel de interés y modalidad de la persona conectada.                    
        $resp_nivel = $mod_ejecutivo->consultarNivelAgente($per_id);
        $resp_modalidad = $mod_ejecutivo->consultarModalidad($per_id);
        if (empty($nivel) && empty($modalidad)) {
            $resp_nivel_mod = $mod_ejecutivo->consultarNivelModal($per_id);
            if ($resp_nivel_mod) {
                $nivel = $resp_nivel_mod["uaca_id"];
                $modalidad = $resp_nivel_mod["mod_id"];
            }            
        }
        $resp_ejecutivos = $mod_ejecutivo->consultarListaEjecutivos($nivel, $modalidad, $per_id); 
       
        return $this->render('asignar', [
                    "nombrescompletos" => $nom_interesado,
                    "arr_nivel" => ArrayHelper::map($resp_nivel, "id", "value"),
                    "arr_modalidad" => ArrayHelper::map($resp_modalidad, "id", "value"),
                    "arr_ejecutivos" => ArrayHelper::map($resp_ejecutivos, "id", "name"),
                    "int_id" => $int_id,
                    "pint_id" => $pint_id,
                    "asp_id" => $asp_id,                    
                    "per_id" => $per_id,                        
        ]);
      
    }

    public function actionCrearasignacion() {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();

            $pint_id = $data["pint_id"];
            $int_id = $data["int_id"];
            $asp_id = $data["asp_id"];
            $ejecutivo_id = $data["ejecutivo_id"];

            $usu_id = Yii::$app->user->identity->usu_id;
            $con = \Yii::$app->db_captacion;
            $transaction = $con->beginTransaction();

            try {
                $mod_inteje = new InteresadoEjecutivo();
                $resp_busca = $mod_inteje->consultarAsignacion($pint_id, $int_id);
                if (!$resp_busca) { //Si no existe asignación se ingresa
                    $resp_inteje = $mod_inteje->insertarAsignacion($pint_id, $int_id, $asp_id, $ejecutivo_id, $usu_id);

                    if ($resp_inteje) {
                        //envío de correo al ejecutivo que se asigna.
                        $mod_persona = new Persona();
                        $resp_persona = $mod_persona->consultaPersonaId($ejecutivo_id);
                        $correo = $resp_persona["usu_user"];
                        $apellidos = $resp_persona["per_pri_apellido"];
                        $nombres = $resp_persona["per_pri_nombre"];
                        $link = Url::base(true);
                        $tituloMensaje = Yii::t("interesado", "UTEG - Registration Online");
                        $asunto = Yii::t("interesado", "Assignment of interested");
                        $body = Utilities::getMailMessage("Assignment", array("[[agente]]" => $nombres . " " . $apellidos, "[[link]]" => $link), Yii::$app->language);
                        Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [$correo => $apellidos . " " . $nombres], $asunto, $body);
                        Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [Yii::$app->params["soporteEmail"] => "Soporte"], $asunto, $body);
                        $exito = 1;
                    }
                }
                if ($exito) {
                    $transaction->commit();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "La infomación ha sido grabada. "),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error al grabar."),
                    "title" => Yii::t('jslang', 'Success'),
                );
                return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
            }
            return;
        }
    }
    
    public function actionReasignar() {
        $int_id = base64_decode($_GET["int"]);
        $pint_id = base64_decode($_GET["pint"]);
        $asp_id = base64_decode($_GET["asp"]);
        $agente = base64_decode($_GET["agente"]);
        $nom_interesado = base64_decode($_GET["nom_interesado"]);
        $per_id = Yii::$app->session->get("PB_perid");
        
        $mod_ejecutivo = new InteresadoEjecutivo();
        
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $nivel = $data["nivel"];
            $modalidad = $data["modalidad"];
            if (isset($data["getagente"])) {
                $resp_agentes = $mod_ejecutivo->consultarListaEjecutivos($data["nivel"], $data["modalidad"], $per_id);            
                $message = array("agentes" => $resp_agentes);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }
        }
        //Obtener el nivel de interés y modalidad de la persona conectada.                    
        $resp_nivel = $mod_ejecutivo->consultarNivelAgente($per_id);
        $resp_modalidad = $mod_ejecutivo->consultarModalidad($per_id);
        if (empty($nivel) && empty($modalidad)) {
            $resp_nivel_mod = $mod_ejecutivo->consultarNivelModal($per_id);
            if ($resp_nivel_mod) {
                $nivel = $resp_nivel_mod["uaca_id"];
                $modalidad = $resp_nivel_mod["mod_id"];
            }            
        }
        $resp_ejecutivos = $mod_ejecutivo->consultarListaEjecutivos($nivel, $modalidad, $per_id); 
       
        return $this->render('reasignar', [
                    "nombrescompletos" => $nom_interesado,
                    "arr_nivel" => ArrayHelper::map($resp_nivel, "id", "value"),
                    "arr_modalidad" => ArrayHelper::map($resp_modalidad, "id", "value"),
                    "arr_ejecutivos" => ArrayHelper::map($resp_ejecutivos, "id", "name"),
                    "int_id" => $int_id,
                    "pint_id" => $pint_id,
                    "asp_id" => $asp_id,
                    "agente" => $agente,
                    "per_id" => $per_id,
        ]);
    }

    public function actionCrearreasignacion() {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();

            $pint_id = $data["pint_id"];
            $int_id = $data["int_id"];
            $asp_id = $data["asp_id"];
            $ejecutivo_id = $data["ejecutivo_id"];

            $usu_id = Yii::$app->user->identity->usu_id;
            $con = \Yii::$app->db_captacion;
            $transaction = $con->beginTransaction();

            try {
                $mod_inteje = new InteresadoEjecutivo();
                $resp_busca = $mod_inteje->consultarAsignacion($pint_id, $int_id);
                $codigo = $resp_busca['ieje_id'];
            
                $mensaje = $codigo;
                if (empty($codigo)) { //Si no existe asignación anterior se muestra mensaje que realice la transacción por la opción Asignación.
                    $exito = 0;
                    $mensaje = 'No existe información. Realice la transacción por la opción Asignación de Agente.'.'/'.$pint_id.'/'.$int_id.'/'.$codigo;
                } else {  $exito = 1;
                    $resp_modifica = $mod_inteje->inactivarAsignacion($codigo);
                    if ($resp_modifica) {  
                        $resp_inteje = $mod_inteje->insertarAsignacion($pint_id, $int_id, $asp_id, $ejecutivo_id, $usu_id);
                        if ($resp_inteje) {
                            //envío de correo al ejecutivo que se asigna.
                            $mod_persona = new Persona();
                            $resp_persona = $mod_persona->consultaPersonaId($ejecutivo_id);
                            $correo = $resp_persona["usu_user"];
                            $apellidos = $resp_persona["per_pri_apellido"];
                            $nombres = $resp_persona["per_pri_nombre"];
                            $link = Url::base(true);
                            $tituloMensaje = Yii::t("interesado", "UTEG - Registration Online");
                            $asunto = Yii::t("interesado", "Assignment of interested");
                            $body = Utilities::getMailMessage("Assignment", array("[[agente]]" => $nombres . " " . $apellidos, "[[link]]" => $link), Yii::$app->language);
                            Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [$correo => $apellidos . " " . $nombres], $asunto, $body);
                            Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [Yii::$app->params["soporteEmail"] => "Soporte"], $asunto, $body);
                            $exito = 1;
                        }                    
                    }                                   
                }
                if ($exito) {
                    $transaction->commit();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "La infomación ha sido grabada. "),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                } else {
                    $transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", $mensaje),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error al grabar."),
                    "title" => Yii::t('jslang', 'Success'),
                );
                return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
            }
            return;
        }
    }
}