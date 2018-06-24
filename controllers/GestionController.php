<?php

namespace app\controllers;

use Yii;
use app\models\Pais;
use app\models\Provincia;
use app\models\Canton;
use app\models\Persona;
use app\models\NivelInteres;
use app\models\GestionCrm;
use app\models\Utilities;
use app\models\Carrera;
use app\models\PersonaGestion;
use yii\helpers\ArrayHelper;

class GestionController extends \app\components\CController {

    public function actionCreate() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $modpersona = new Persona();
        $modcanal = new GestionCrm();
        $mod_carrera = new Carrera();
        $mod_pais = new Pais();
        $pais_id = 57; //Ecuador  
        $con_agente = $modcanal->consultarAgenteAutenticado($per_id);
        $cargo = $modcanal->consultarCargoAgente($con_agente["padm_id"]);
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["getprovincias"])) {
                $provincias = Provincia::find()->select("pro_id AS id, pro_nombre AS name")->where(["pro_estado_logico" => "1", "pro_estado" => "1", "pai_id" => $data['pai_id']])->asArray()->all();
                $message = array("provincias" => $provincias);
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }
            if (isset($data["getcantones"])) {
                $cantones = Canton::find()->select("can_id AS id, can_nombre AS name")->where(["can_estado_logico" => "1", "can_estado" => "1", "pro_id" => $data['prov_id']])->asArray()->all();
                $message = array("cantones" => $cantones);
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }
            if (isset($data["getarea"])) {                
                $area = $mod_pais->consultarCodigoArea($data["codarea"]);
                $message = array("area" => $area);
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }
            if (isset($data["getmodalidad"])) {
                $modalidad = $mod_carrera->consultarModalidad($data["ninter_id"]);
                $message = array("modalidad" => $modalidad);
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }
            if (isset($data["getagente"])) {
                $agente = $modcanal->consultarAgente($data["unidada"], $data["moda_id"], $cargo["car_id"], $per_id);
                $message = array("agente" => $agente);
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }
            if (isset($data["getsubcarrera"])) {
                $subcarrera = $modcanal->consultarSubCarrera($data["car_id"]);
                $message = array("subcarrera" => $subcarrera);
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }
            if (isset($data["getcarrera"])) {
                $carrera = $modcanal->consultarCarreraModalidad($data["unidada"], $data["moda_id"]);
                $message = array("carrera" => $carrera);
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }
        }
        $arr_pais = Pais::find()->select("pai_id AS id, pai_nombre AS value, pai_codigo_fono AS code")->where(["pai_estado_logico" => "1", "pai_estado" => "1"])->asArray()->all();
        $arr_prov = Provincia::provinciaXPais($pais_id);
        $arr_ciu = Canton::cantonXProvincia($arr_prov[0]["id"]);
        $area = $mod_pais->consultarCodigoArea($pais_id);
        $arr_ninteres = NivelInteres::find()->select("nint_id AS id, nint_nombre AS name")->where(["nint_id" => "1", "nint_estado_logico" => "1", "nint_estado" => "1"])->asArray()->all();
        $conocimiento = $modcanal->consultarConocimientoCanal('co');
        $canal = $modcanal->consultarConocimientoCanal('ca');
        $estado_gestion = $modcanal->consultarEstadoGestion(0, 0);
        $operdida = $modcanal->consultarOportunidadPerdida();
        $arr_agente = $modcanal->consultarAgente(1, 1, $cargo["car_id"], $per_id);
        $arr_modalidad = $mod_carrera->consultarModalidad(1);
        $arr_carrerra2 = $modcanal->consultarTipoCarrera();
        $arr_carrerra1 = $modcanal->consultarCarreraModalidad(1, 1);
        $arr_programa1 = $modcanal->consultarCarreraModalidad(2, 1);
        $arr_subcarrera = $modcanal->consultarSubCarrera(1);
        return $this->render('create', [
                    "arr_pais" => $arr_pais,
                    "arr_prov" => ArrayHelper::map($arr_prov, "id", "value"),
                    "arr_ciu" => ArrayHelper::map($arr_ciu, "id", "value"),
                    "area" => $area['name'],
                    "arr_ninteres" => ArrayHelper::map($arr_ninteres, "id", "name"),
                    "arr_conocimiento" => ArrayHelper::map($conocimiento, "id", "name"),
                    "arr_canal" => ArrayHelper::map($canal, "id", "name"),
                    "arr_estgestion" => ArrayHelper::map($estado_gestion, "id", "name"),
                    "arr_operdida" => ArrayHelper::map($operdida, "id", "name"),
                    "arr_agente" => ArrayHelper::map($arr_agente, "id", "name"),
                    "arr_modalidad" => ArrayHelper::map($arr_modalidad, "id", "name"),
                    "arr_carrerra1" => ArrayHelper::map($arr_carrerra1, "id", "name"),
                    "arr_carrerra2" => ArrayHelper::map($arr_carrerra2, "id", "name"),
                    "agente_autentica" => $cargo["car_id"],
                    "agente_cargo" => $cargo["padm_id"],
                    "persona_autentica" => $per_id,
                    "arr_subcarrerra" => ArrayHelper::map($arr_subcarrera, "id", "name"),
                    "arr_programa1" => ArrayHelper::map($arr_programa1, "id", "name"),
        ]);
    }

    public function actionGuardargestion() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $fecproxima = null;
        $celular = null;
        $celular2 = null;
        $telefono = null;
        $celularbeni = null;
        $celularbeni2 = null;
        $telefonobeni = null;
        $correobeni = null;
        $correo = strtolower($data["correo"]);
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $nombre1 = ucwords(strtolower($data["txt_nombre1"]));
            $nombre2 = ucwords(strtolower($data["txt_nombre2"]));
            $apellido1 = ucwords(strtolower($data["txt_apellido1"]));
            $apellido2 = ucwords(strtolower($data["txt_apellido2"]));
            $pais = $data["pais"];
            $provincia = $data["provincia"];
            $ciudad = $data["ciudad"];
            if (!empty($data["celular"])) {
                $celular = $data["celular"];
            }
            if (!empty($data["celular2"])) {
                $celular2 = $data["celular2"];
            }
            if (!empty($data["telefono"])) {
                $telefono = $data["telefono"];
            }
            if (!empty($data["correo"])) {
                $correo = strtolower($data["correo"]);
            }
            $medio = $data["medio"];
            $nivelestudio = $data["nivel"];
            $modalidad = $data["modalidad"];
            if ($nivelestudio == 1) {
                $carrera1 = $data["carrera1"];
                $carrera2 = $data["carrera2"];
                $subcarera = $data["subcarrera"];
            } else {
                $carrera1 = $data["programa1"];
                $carrera2 = $data["programa2"];
                $subcarera = $data["subcarrera"];
            }
            $canal = $data["canal"];
            $beneficiario = $data["beneficiario"];
            $nombrebeni1 = ucwords(strtolower($data["txt_nombrebeni1"]));
            $nombrebeni2 = ucwords(strtolower($data["txt_nombrebeni2"]));
            $apellidobeni1 = ucwords(strtolower($data["txt_apellidobeni1"]));
            $apellidobeni2 = ucwords(strtolower($data["txt_apellidobeni2"]));
            if (!empty($data["celularbeni"])) {
                $celularbeni = $data["celularbeni"];
            }
            if (!empty($data["celular2beni"])) {
                $celularbeni2 = $data["celular2beni"];
            }
            if (!empty($data["telefonobeni"])) {
                $telefonobeni = $data["telefonobeni"];
            }
            if (!empty($data["correobeni"])) {
                $correobeni = strtolower($data["correobeni"]);
            }
            $agente = $data["agente"];
            $fecrecepta = $data["fecrecepcion"] . ' ' . $data["horecepcion"];
            $fecatiende = $data["fecatencion"] . ' ' . $data["horatencion"];
            $estado = $data["estado"];
            $observacion = ucwords(strtolower($data["observacion"]));
            $oportunidad = $data["oportunidad"];
            if (!empty($data["fecproxima"])) {
                $fecproxima = $data["fecproxima"] . ' ' . $data["horproxima"];
            }
            $tipocontacto = $data["tipocontacto"];
            $usuario = @Yii::$app->user->identity->usu_id;

            $con = \Yii::$app->db_crm;
            $transaction = $con->beginTransaction();
            try {
                $mod_pergestion = new PersonaGestion();
                $mod_gestion = new GestionCrm();

                $cons_persona = $mod_pergestion->consultarDatosExiste($celular, $correo, $telefono, $celular2);
                if ($cons_persona["registro"] == 0) {
                    $cons_perbeni = $mod_pergestion->consultarDatosExiste($celularbeni, $correobeni, $telefonobeni, $celularbeni2);
                    if ($cons_perbeni["registro"] == 0) {
                        $resp_persona = $mod_pergestion->insertarPersonaGestion($nombre1, $nombre2, $apellido1, $apellido2, null, null, null, null, null, null, null, $pais, $provincia, $ciudad, null, null, $celular, $correo, null, null, null, null, null, null, null, $telefono, $celular2, null, null, null, null, null, null, null, null, null, null);
                        if ($resp_persona) {
                            if ($beneficiario == 1) {
                                $res_contratante = $mod_gestion->insertarPersonaContratante($resp_persona, null);
                                if ($res_contratante) {
                                    $res_beneficiario = $mod_gestion->insertarPersonaBeneficiaria($resp_persona, null);
                                }
                            } else {
                                $res_contratante = $mod_gestion->insertarPersonaContratante($resp_persona, null);
                                if ($res_contratante) {
                                    $resp_personacont = $mod_pergestion->insertarPersonaGestion($nombrebeni1, $nombrebeni2, $apellidobeni1, $apellidobeni2, null, null, null, null, null, null, null, $pais, $provincia, $ciudad, null, null, $celularbeni, $correobeni, null, null, null, null, null, null, null, $telefonobeni, $celularbeni2, null, null, null, null, null, null, null, null, null, null);
                                    $res_beneficiario = $mod_gestion->insertarPersonaBeneficiaria($resp_personacont, null);
                                }
                            }
                            if ($res_beneficiario) {
                                $gcrm_codigo = $mod_gestion->consultarUltimoCodcrm();
                                $codigocrm = $gcrm_codigo["id"] + 1;
                                $res_gestion = $mod_gestion->insertarGestionCrm($codigocrm, $res_contratante, $res_beneficiario, 0, $usuario, null);
                                if ($res_gestion) {
                                    $res_curricular = $mod_gestion->insertarInforCurricularCrm($res_gestion, $carrera1, $nivelestudio, $modalidad);
                                    if ($res_curricular) {
                                        $res_historial = $mod_gestion->insertarHistSeguimientoCrm($res_gestion, $agente, $res_curricular, $tipocontacto, $fecrecepta, $fecatiende, $estado, $fecproxima, $oportunidad, $observacion, $subcarera, $canal, $medio);
                                        if ($res_historial) {
                                            $exito = 1;
                                        }
                                    }
                                }
                            }
                        }
                        if ($exito) {
                            $transaction->commit();
                            $message = array(
                                "wtmessage" => Yii::t("notificaciones", "La infomación ha sido grabada. "),
                                "title" => Yii::t('jslang', 'Success'),
                            );
                            echo Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                        } else {
                            $transaction->rollback();
                            $message = array(
                                "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $mensaje),
                                "title" => Yii::t('jslang', 'Success'),
                            );
                            echo Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                        }
                    } else {
                        $mensaje = 'Ya hay registros en los campos, celular, teléfonos o correo';
                        $transaction->rollback();
                        $message = array(
                            "wtmessage" => Yii::t("notificaciones", "Error al grabar. " . $mensaje),
                            "title" => Yii::t('jslang', 'Success'),
                        );
                        echo Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                    }
                } else {
                    $mensaje = 'Ya hay registros en los campos, celular, teléfonos o correo';
                    $transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error al grabar. " . $mensaje),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    echo Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $mensaje),
                    "title" => Yii::t('jslang', 'Success'),
                );
                echo Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
            }
            return;
        }
    }

    public function actionListargestion() {
        $per_id = @Yii::$app->session->get("PB_iduser");
        $modcanal = new GestionCrm();
        $estado_gestion = $modcanal->consultarEstadoGestion(0, 3);

        $data = Yii::$app->request->get();

        if ($data['PBgetFilter']) {
            $arrSearch["agente"] = $data['agente'];
            $arrSearch["interesado"] = $data['interesado'];
            $arrSearch["f_atencion"] = $data['f_atencion'];
            $arrSearch["estado"] = $data['estado'];

            $mod_gestion = $modcanal->consultarGestion($arrSearch, 2);
        } else {
            $mod_gestion = $modcanal->consultarGestion($arrSearch, 2);
        }

        return $this->render('listargestion', [
                    'model' => $mod_gestion,
                    'arr_estgestion' => ArrayHelper::map($estado_gestion, "id", "name"),
        ]);
    }

    public function actionListararbol() {
        $modcanal = new GestionCrm();
        $gcrm_id = base64_decode($_GET["codigo"]);
        $interesado = base64_decode($_GET["interesado"]);
        $correo = base64_decode($_GET["correo"]);
        $celular = base64_decode($_GET["celular"]);
        $pais = base64_decode($_GET["pais"]);
        $estado = $modcanal->ConsultarEstadoBloqueo($gcrm_id);
        $mod_gestion = $modcanal->consultarGestionHistorial($gcrm_id);
        return $this->render('listararbol', [
                    'model' => $mod_gestion,
                    'interesado' => $interesado,
                    'correo' => $correo,
                    'celular' => $celular,
                    'pais' => $pais,
                    'estado_cierre' => $estado["est_cierre"],
        ]);
    }

    public function actionView() {
        $modpersona = new Persona();
        $modcanal = new GestionCrm();
        $mod_carrera = new Carrera();
        $mod_pais = new Pais();
        
        $hsco_id = base64_decode($_GET["codigo"]);
        $agente = base64_decode($_GET["agente"]);

        $arra_gestion = $modcanal->consultarDatosGestion($hsco_id);
        $arra_contatante = $modcanal->DatosPersonGestion($arra_gestion['pcon_id'], 1);
        $arra_beneficiario = $modcanal->DatosPersonGestion($arra_gestion['pben_id'], 0);

        $arr_pais = Pais::find()->select("pai_id AS id, pai_nombre AS value, pai_codigo_fono AS code")->where(["pai_estado_logico" => "1", "pai_estado" => "1"])->asArray()->all();
        $arr_prov = Provincia::provinciaXPais($arra_contatante['pai_id_nacimiento']);
        $arr_ciu = Canton::cantonXProvincia($arra_contatante['pro_id_nacimiento']);
        $area = $mod_pais->consultarCodigoArea($arra_contatante['pai_id_nacimiento']);
        $arr_ninteres = NivelInteres::find()->select("nint_id AS id, nint_nombre AS name")->where(["nint_estado_logico" => "1", "nint_estado" => "1"])->asArray()->all();
        $conocimiento = $modcanal->consultarConocimientoCanal('co');
        $canal = $modcanal->consultarConocimientoCanal('ca');
        $estado_gestion = $modcanal->consultarEstadoGestion(0, 3);
        $operdida = $modcanal->consultarOportunidadPerdida();
        $arr_modalidad = $mod_carrera->consultarModalidad(1);
        $arr_carrerra1 = $modcanal->consultarCarreraModalidad(1, 1);
        $tccr_id = $arra_gestion['tccr_id'];
        $arr_subcarrera = $modcanal->consultarSubCarrera($arra_gestion['tipo_carrera']);
        $arr_carrerra2 = $modcanal->consultarTipoCarrera();

        return $this->render('view', [
                    "arr_pais" => ArrayHelper::map($arr_pais, "id", "value"),
                    "arr_prov" => ArrayHelper::map($arr_prov, "id", "value"),
                    "arr_ciu" => ArrayHelper::map($arr_ciu, "id", "value"),
                    "celular" => $arra_contatante['celular'],
                    "celularben" => $arra_beneficiario['celular'],
                    "area" => $area['name'],
                    "convenc" => $arra_contatante['pges_domicilio_telefono'],
                    "telf" => $arra_contatante['pges_domicilio_celular2'],
                    "correo" => $arra_contatante['correo'],
                    "arr_ninteres" => ArrayHelper::map($arr_ninteres, "id", "name"),
                    "arr_conocimiento" => ArrayHelper::map($conocimiento, "id", "name"),
                    "arr_canal" => ArrayHelper::map($canal, "id", "name"),
                    "arr_estgestion" => ArrayHelper::map($estado_gestion, "id", "name"),
                    "arr_operdida" => ArrayHelper::map($operdida, "id", "name"),
                    "agente" => $agente,
                    "arr_modalidad" => ArrayHelper::map($arr_modalidad, "id", "name"),
                    "arr_carrerra1" => ArrayHelper::map($arr_carrerra1, "id", "name"),
                    "arr_carrerra2" => ArrayHelper::map($arr_carrerra2, "id", "name"),
                    "arra_pnomb_con" => $arra_contatante['primer_nombre'],
                    "arra_snomb_con" => $arra_contatante['segundo_nombre'],
                    "arra_papellido_con" => $arra_contatante['primer_apellido'],
                    "arra_sapellido_con" => $arra_contatante['segundo_apellido'],
                    "arra_pnomb_ben" => $arra_beneficiario['primer_nombre'],
                    "arra_snomb_ben" => $arra_beneficiario['segundo_nombre'],
                    "arra_papellido_ben" => $arra_beneficiario['primer_apellido'],
                    "arra_sapellido_ben" => $arra_beneficiario['segundo_apellido'],
                    "pais" => $arra_contatante['pai_id_nacimiento'],
                    "provincia" => $arra_contatante['pro_id_nacimiento'],
                    "ciudad" => $arra_contatante['can_id_nacimiento'],
                    "fec_recepcion" => $arra_gestion['hsco_fecha_recepcion'],
                    "fec_atencion" => $arra_gestion ['hsco_fecha_atenc'],
                    "fec_proxima" => $arra_gestion['hsco_fecha_proxima'],
                    "oper_id" => $arra_gestion['oper_id'],
                    "observacion" => $arra_gestion['hsco_observacion'],
                    "eges_id" => $arra_gestion['eges_id'],
                    "ccan_id" => $arra_gestion['ccan_id'],
                    "iccr_id" => $arra_gestion['iccr_id'],
                    "tsca_id" => $arra_gestion['tsca_id'],
                    "mcon_id" => $arra_gestion['mcon_id'],
                    "mod_id" => $arra_gestion['mod_id'],
                    "nint_id" => $arra_gestion['nint_id'],
                    "car_id" => $arra_gestion['car_id'],
                    "tccr_id" => $tccr_id,
                    "arr_subcarrera" => ArrayHelper::map($arr_subcarrera, "id", "name"),
                    "tcar_id" => $arra_gestion['tipo_carrera'],
        ]);
    }

    public function actionNuevagestion() {
        $modpersona = new Persona();
        $modcanal = new GestionCrm();
        $mod_pais = new Pais();
        $estado_gestion = $modcanal->consultarEstadoGestion(0, 3);
        $operdida = $modcanal->consultarOportunidadPerdida();
        $beni_id = base64_decode($_GET["id"]);
        $datageneral = $modcanal->consultarDatosBeni($beni_id);
        $area = $mod_pais->consultarCodigoArea($datageneral["pai_id_nacimiento"]);
        return $this->render('nuevagestion', [
                    "arr_estgestion" => ArrayHelper::map($estado_gestion, "id", "name"),
                    "arr_operdida" => ArrayHelper::map($operdida, "id", "name"),
                    "area" => $area['name'],
                    "datageneral" => $datageneral,
        ]);
    }

    public function actionGuardarnueva() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $fecproxima = null;
        $nombre2 = null;
        $apellido2 = null;
        $celular = null;
        $celular2 = null;
        $telefono = null;
        $correo = null;
        $fecha_cierre = null;
        $con_gestion = array();
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $gestion = base64_decode($data["gestion"]);
            $benificia = $data["benificiario"];
            $fecrecepta = $data["fecrecepcion"] . ' ' . $data["horecepcion"];
            $fecatiende = $data["fecatencion"] . ' ' . $data["horatencion"];
            $estado = $data["estado"];
            $mod_gestion = new GestionCrm();
            $est_cierre = $mod_gestion->ConsultarEstadoCierre($estado);
            if ($est_cierre["estado_cierre"] == 1) {
                $fecha_cierre = date("Y-m-d H:i:s");
            }
            $observacion = ucwords(strtolower($data["observacion"]));
            $oportunidad = $data["oportunidad"];
            if (!empty($data["fecproxima"])) {
                $fecproxima = $data["fecproxima"] . ' ' . $data["horproxima"];
            }
            $tipocontacto = $data["tipocontacto"]; 
            $usuario = @Yii::$app->user->identity->usu_id;
            // Datos Generales Contacto            
            $nombre1 = ucwords(strtolower($data["txt_nombrebeni1"]));
            if (!empty($data["txt_nombrebeni2"])) {
                $nombre2 = ucwords(strtolower($data["txt_nombrebeni2"]));
            }
            $apellido1 = ucwords(strtolower($data["txt_apellidobeni1"]));
            if (!empty($data["txt_apellidobeni2"])) {
                $apellido2 = ucwords(strtolower($data["txt_apellidobeni2"]));
            }
            if (!empty($data["celular"])) {
                $celular = $data["celular"];
            }
            if (!empty($data["celular2"])) {
                $celular2 = $data["celular2"];
            }
            if (!empty($data["telefono"])) {
                $telefono = $data["telefono"];
            }
            if (!empty($data["correo"])) {
                $correo = strtolower($data["correo"]);
            }
            $con = \Yii::$app->db_crm;
            $transaction = $con->beginTransaction();
            try {
                $mod_pergestion = new PersonaGestion();
                $mod_gestion = new GestionCrm();
                $con_agente = $mod_gestion->consultarAgenteAutenticado($per_id);              
                if ($con_agente > 0) {
                    $con_gestion = $mod_gestion->consultarGestionBeneficiario($gestion);
                    if ($con_gestion) {
                        $res_historial = $mod_gestion->insertarHistSeguimientoCrm($gestion, $con_agente["padm_id"], $con_gestion["iccr_id"], $tipocontacto, $fecrecepta, $fecatiende, $estado, $fecproxima, $oportunidad, $observacion, $con_gestion["tsca_id"], $con_gestion["ccan_id"], $con_gestion["mcon_id"]);
                        if ($res_historial) {                            
                            $res_persona = $mod_pergestion->modificaDatoGeneral($nombre1, $nombre2, $apellido1, $apellido2, $benificia, $celular, $celular2, $telefono, $correo);                                              
                                if ($est_cierre["estado_cierre"] == 1) {
                                    $modifi_gestion = $mod_gestion->modificaEstadoCierre($gestion, $est_cierre["estado_cierre"], $fecha_cierre);
                                    if ($modifi_gestion) {
                                        $exito = 1;
                                    }
                                } else {
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
                        echo Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                    } else {
                        $mensaje = $este;
                        $transaction->rollback();
                        $message = array(
                            "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $mensaje),
                            "title" => Yii::t('jslang', 'Success'),
                        );
                        echo Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                    }
                } else {
                    $transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error al grabar, el usuario autenticado no tiene permisos." . $mensaje),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    echo Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $mensaje),
                    "title" => Yii::t('jslang', 'Success'),
                );
                echo Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
            }
            return;
        }
    }

    public function actionExpexcel() {
        $data = Yii::$app->request->get();
        $arrSearch["agente"] = $data['agente'];
        $arrSearch["interesado"] = $data['interesado'];
        $arrSearch["f_atencion"] = $data['f_atencion'];
        $arrSearch["estado"] = $data['estado'];        
        $arrData = array();
        $arrHeader = array();

        $mod_gestion = new GestionCrm();
        $arrData = $mod_gestion->consultarGestiontodas($arrSearch);        
         if ($arrData) {            
            $nombarch = "GestionesReporte-" . date("YmdHis");
            $content_type = Utilities::mimeContentType("xls");
            header("Content-Type: $content_type");
            header("Content-Disposition: attachment;filename=" . $nombarch . ".xls");
            header('Cache-Control: max-age=0');

            $arrHeader = array(                
                Yii::t("formulario", "Interested"),
                Yii::t("formulario", "Management number"),
                Yii::t("formulario", "Email"),
                Yii::t("formulario", "CellPhone"),
                Yii::t("formulario", "Country"),
                Yii::t("formulario", "Executive"),
                Yii::t("formulario", "Executive-Code"),
                Yii::t("formulario", "Attention Date"),
                Yii::t("formulario", "Attention Next"),
                Yii::t("formulario", "Status")                               
            );
            $nameReport = yii::t("formulario", "Management Report");
            $colPosition = array("C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P");
            Utilities::generarReporteXLS($nombarch, $nameReport, $arrHeader, $arrData, $colPosition);
            return;
        } 
    }

}
