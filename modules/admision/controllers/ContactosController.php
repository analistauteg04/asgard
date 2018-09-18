<?php

namespace app\modules\admision\controllers;

use Yii;
use app\modules\admision\models\EstadoContacto;
use app\modules\admision\models\PersonaGestion;
use app\modules\admision\models\Oportunidad;
use app\models\Pais;
use app\models\Provincia;
use app\models\Canton;
use app\models\Utilities;
use yii\helpers\ArrayHelper;

class ContactosController extends \app\components\CController
{
    public function actionIndex() {
        $per_id = @Yii::$app->session->get("PB_iduser");
        $estado_contacto = EstadoContacto::find()->select("econ_id AS id, econ_nombre AS name")->where(["econ_estado_logico" => "1", "econ_estado" => "1"])->asArray()->all();
        $modPersonaGestion = new PersonaGestion();
        $data = Yii::$app->request->get();
        if ($data['PBgetFilter']) {
            $arrSearch["search"] = $data['search'];
            $arrSearch["estado"] = $data['estado'];
            $arrSearch["fase"] = $data['fase'];
            $mod_gestion = $modPersonaGestion->consultarClienteCont($arrSearch);
            return $this->render('index-grid', [
                        "model" => $mod_gestion,
            ]);
        } else {
            $mod_gestion = $modPersonaGestion->consultarClienteCont();
        }
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
        }
        return $this->render('index', [
                    'model' => $mod_gestion,
                    'arr_contacto' => ArrayHelper::map(array_merge([["id" => "0", "name" => "Todas"]], $estado_contacto), "id", "name"),
        ]);
    }
    
    public function actionNew() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $modcanal = new Oportunidad();
        $mod_pais = new Pais();
        $pais_id = 1; //Ecuador  
        $con_agente = $modcanal->consultarAgenteAutenticado($per_id);
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["getprovincias"])) {
                $provincias = Provincia::find()->select("pro_id AS id, pro_nombre AS name")->where(["pro_estado_logico" => "1", "pro_estado" => "1", "pai_id" => $data['pai_id']])->asArray()->all();
                $message = array("provincias" => $provincias);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
           
            }
            if (isset($data["getcantones"])) {
                $cantones = Canton::find()->select("can_id AS id, can_nombre AS name")->where(["can_estado_logico" => "1", "can_estado" => "1", "pro_id" => $data['prov_id']])->asArray()->all();
                $message = array("cantones" => $cantones);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                
            }
            if (isset($data["getarea"])) {
                $area = $mod_pais->consultarCodigoArea($data["codarea"]);
                $message = array("area" => $area);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                
            }
            if (isset($data["getsubcarrera"])) {
                $subcarrera = $modcanal->consultarSubCarrera($data["car_id"]);
                $message = array("subcarrera" => $subcarrera);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                
            }
            if (isset($data["getcarrera"])) {
                $carrera = $modcanal->consultarCarreraModalidad($data["unidada"], $data["moda_id"]);
                $message = array("carrera" => $carrera);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
              
            }
        }
        $arr_pais = Pais::find()->select("pai_id AS id, pai_nombre AS value, pai_codigo_fono AS code")->where(["pai_estado_logico" => "1", "pai_estado" => "1"])->asArray()->all();
        $arr_prov = Provincia::provinciaXPais($pais_id);
        $arr_ciu = Canton::cantonXProvincia($arr_prov[0]["id"]);
        $area = $mod_pais->consultarCodigoArea($pais_id);
        $canalconta = $modcanal->consultarConocimientoCanal('1');
        return $this->render('new', [
                    "arr_pais" => $arr_pais,
                    "arr_prov" => ArrayHelper::map($arr_prov, "id", "value"),
                    "arr_ciu" => ArrayHelper::map($arr_ciu, "id", "value"),
                    "area" => $area['name'],
                    "arr_canalconta" => ArrayHelper::map($canalconta, "id", "name"),
                    //"agente_autentica" => $cargo["car_id"],
                    "agente_cargo" => $con_agente["padm_id"],
                    "persona_autentica" => $per_id,
        ]);
    }

    
    public function actionView() {
        $modcanal = new Oportunidad();
        $mod_pais = new Pais();
        $pges_id = base64_decode($_GET["codigo"]);
        $tper = base64_decode($_GET["tper"]);

        $arra_contacto = $modcanal->ConsultarPersonaxGestion($pges_id);
        $arra_para_contacto = $modcanal->consultarDatoContact($pges_id);
        $arr_pais = Pais::find()->select("pai_id AS id, pai_nombre AS value, pai_codigo_fono AS code")->where(["pai_estado_logico" => "1", "pai_estado" => "1"])->asArray()->all();
        $arr_prov = Provincia::provinciaXPais($arra_contacto['pai_id_nacimiento']);
        if (empty($arra_contacto['pro_id_nacimiento']) || $arra_contacto['pro_id_nacimiento'] == '') {
            $arr_ciu = Canton::cantonXProvincia($arr_prov[0]['id']);
        } else {
            $arr_ciu = Canton::cantonXProvincia($arra_contacto['pro_id_nacimiento']);
        }
        $area = $mod_pais->consultarCodigoArea($arra_contacto['pai_id_nacimiento']);
        $conocimiento = $modcanal->consultarConocimientoCanal(1);
        $modestCli = new EstadoContacto();
        $estado_cliente = $modestCli->consultarEstadoContacto();

        return $this->render('view', [
                    "arr_pais" => ArrayHelper::map($arr_pais, "id", "value"),
                    "arr_prov" => ArrayHelper::map($arr_prov, "id", "value"),
                    "arr_ciu" => ArrayHelper::map($arr_ciu, "id", "value"),
                    "tipo_dni" => array("CED" => Yii::t("formulario", "DNI Document"), "PASS" => Yii::t("formulario", "Passport")),
                    "celular" => $arra_contacto['celular'],
                    "cedula" => $arra_contacto['cedula'],
                    "area" => $area['name'],
                    "convenc" => $arra_contacto['pges_domicilio_telefono'],
                    "telf" => $arra_contacto['pges_domicilio_celular2'],
                    "correo" => $arra_contacto['correo'],
                    "arr_conocimiento" => ArrayHelper::map($conocimiento, "id", "name"),
                    "mcon_id" => $arra_contacto['cod_medio_contacto'],
                    "tper_id" => $tper,
                    "arr_estcliente" => ArrayHelper::map($estado_cliente, "id", "name"),
                    "ecli_id" => $arra_contacto['cod_estado'],
                    "arra_pnomb_con" => $arra_contacto['primer_nombre'],
                    "arra_snomb_con" => $arra_contacto['segundo_nombre'],
                    "arra_papellido_con" => $arra_contacto['primer_apellido'],
                    "arra_sapellido_con" => $arra_contacto['segundo_apellido'],
                    "arra_nombre_paracont" => $arra_para_contacto['pgco_nombres'],
                    "pais" => $arra_contacto['pai_id_nacimiento'],
                    "provincia" => $arra_contacto['pro_id_nacimiento'],
                    "ciudad" => $arra_contacto['can_id_nacimiento'],
                    "arr_datosc" => $arra_contacto,
                    "arr_datosb" => $arra_para_contacto,
                    "pges_id" => $pges_id,
        ]);
    }
    
    public function actionEdit() {
        $modcanal = new Oportunidad();
        $mod_pais = new Pais();
        $pges_id = base64_decode($_GET["codigo"]);
        $tper = base64_decode($_GET["tper_id"]);
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
             if (isset($data["getprovincias"])) {
                $provincias = Provincia::find()->select("pro_id AS id, pro_nombre AS name")->where(["pro_estado_logico" => "1", "pro_estado" => "1", "pai_id" => $data['pai_id']])->asArray()->all();
                $message = array("provincias" => $provincias);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
           
            }
            if (isset($data["getcantones"])) {
                $cantones = Canton::find()->select("can_id AS id, can_nombre AS name")->where(["can_estado_logico" => "1", "can_estado" => "1", "pro_id" => $data['prov_id']])->asArray()->all();
                $message = array("cantones" => $cantones);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                
            }
        }

        $arra_contacto = $modcanal->ConsultarPersonaxGestion($pges_id);
        $arra_para_contacto = $modcanal->consultarDatoContact($pges_id);
        $arr_pais = Pais::find()->select("pai_id AS id, pai_nombre AS value, pai_codigo_fono AS code")->where(["pai_estado_logico" => "1", "pai_estado" => "1"])->asArray()->all();
        $arr_prov = Provincia::provinciaXPais($arra_contacto['pai_id_nacimiento']);
        if (empty($arra_contacto['pro_id_nacimiento']) || $arra_contacto['pro_id_nacimiento'] == '') {
            $arr_ciu = Canton::cantonXProvincia($arr_prov[0]['id']);
        } else {
            $arr_ciu = Canton::cantonXProvincia($arra_contacto['pro_id_nacimiento']);
        }
        $area = $mod_pais->consultarCodigoArea($arra_contacto['pai_id_nacimiento']);
        $conocimiento = $modcanal->consultarConocimientoCanal(1);
        $modEstCli = new EstadoContacto();
        $estado_cliente = $modEstCli->consultarEstadoContacto();

        return $this->render('edit', [
                    "arr_pais" => ArrayHelper::map($arr_pais, "id", "value"),
                    "arr_prov" => ArrayHelper::map($arr_prov, "id", "value"),
                    "tipo_dni" => array("CED" => Yii::t("formulario", "DNI Document"), "PASS" => Yii::t("formulario", "Passport")),
                    "arr_ciu" => ArrayHelper::map($arr_ciu, "id", "value"),
                    "cedula" => $arra_contacto['cedula'],
                    "celular" => $arra_contacto['celular'],
                    "area" => $area['name'],
                    "convenc" => $arra_contacto['pges_domicilio_telefono'],
                    "telf" => $arra_contacto['pges_domicilio_celular2'],
                    "correo" => $arra_contacto['correo'],
                    "arr_conocimiento" => ArrayHelper::map($conocimiento, "id", "name"),
                    "mcon_id" => $arra_contacto['cod_medio_contacto'],
                    "pges_id" => $arra_contacto['pges_id'],
                    "tper_id" => $tper,
                    "arr_estcliente" => ArrayHelper::map($estado_cliente, "id", "name"),
                    "ecli_id" => $arra_contacto['cod_estado'],
                    "arra_pnomb_con" => $arra_contacto['primer_nombre'],
                    "arra_snomb_con" => $arra_contacto['segundo_nombre'],
                    "arra_papellido_con" => $arra_contacto['primer_apellido'],
                    "arra_sapellido_con" => $arra_contacto['segundo_apellido'],
                    "pais" => $arra_contacto['pai_id_nacimiento'],
                    "provincia" => $arra_contacto['pro_id_nacimiento'],
                    "ciudad" => $arra_contacto['can_id_nacimiento'],
                    "arr_datosc" => $arra_contacto,
                    "arr_datosb" => $arra_para_contacto,
        ]);
    }
    
    public function actionSave() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $usuario_ingreso = @Yii::$app->session->get("PB_iduser");
        $celular = null;
        $celular2 = null;
        $telefono = null;
        $celularcontacto = null;
        $telefonocontacto = null;
        $correocontacto = null;
        $paiscontacto = null;
        $busqueda = 0;
        $conoce_uteg = null;
        $carrera = null;
        $correo = strtolower($data["correo"]);
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $nombre1 = ucwords(strtolower($data["txt_nombre1"]));
            $nombre2 = ucwords(strtolower($data["txt_nombre2"]));
            $apellido1 = ucwords(strtolower($data["txt_apellido1"]));
            $apellido2 = ucwords(strtolower($data["txt_apellido2"]));

            $tipo_persona = $data["tipo_persona"];
            $empresa = ucwords(strtolower($data["empresa"]));
            $telefono_empresa = $data["telefono_empresa"];
            $direccion = ucwords(strtolower($data["direccion"]));
            $cargo = ucwords(strtolower($data["cargo"]));
            $contacto_empresa = ucwords(strtolower($data["contacto_empresa"]));
            $numero_contacto = ucwords(strtolower($data["numero_contacto"]));

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
            $contacto = $data["contacto"];
            $nombrebeni1 = ucwords(strtolower($data["txt_nombrebeni1"]));
            $nombrebeni2 = ucwords(strtolower($data["txt_nombrebeni2"]));
            $apellidobeni1 = ucwords(strtolower($data["txt_apellidobeni1"]));
            $apellidobeni2 = ucwords(strtolower($data["txt_apellidobeni2"]));

            if (!empty($data["celularbeni"])) {
                $celularcontacto = $data["celularbeni"];
            }
            if (!empty($data["telefonobeni"])) {
                $telefonocontacto = $data["telefonobeni"];
            }
            if (!empty($data["correobeni"])) {
                $correocontacto = strtolower($data["correobeni"]);
            }
            if (!empty($data["paisContacto"])) {
                $paiscontacto = strtolower($data["paisContacto"]);
            }
            $per_nac_ecuatoriano = $data["nacecuador"];
            $agente = $data["agente"];
            $usuario = @Yii::$app->user->identity->usu_id;

            $con = \Yii::$app->db_crm;
            $transaction = $con->beginTransaction();
            try {
                $mod_pergestion = new PersonaGestion();
                $mod_gestion = new Oportunidad();
                if (!empty($celular) || !empty($correo) || !empty($telefono) || !empty($celular2)) {
                    $cons_persona = $mod_pergestion->consultarDatosExiste($celular, $correo, $telefono, $celular2, null, null);
                    if ($cons_persona["registro"] > 0) {
                        $busqueda = 1;
                    }
                }
                if ($busqueda == 0) {
                    //Obtener el número máximo de persona_gestion.                    
                    $resp_consulta = $mod_pergestion->consultarMaxPergest();
                    $resp_persona = $mod_pergestion->insertarPersonaGestion($resp_consulta["maximo"], $tipo_persona, $conoce_uteg, $carrera, $nombre1, $nombre2, $apellido1, $apellido2, null, null, null, null, null, null, null, $pais, $provincia, $ciudad, $per_nac_ecuatoriano, null, $celular, $correo, null, null, null, null, null, null, null, $telefono, $celular2, null, null, null, null, null, null, null, null, null, null, 1, $medio, $empresa, $contacto_empresa, $numero_contacto, $telefono_empresa, $direccion, $cargo, $usuario_ingreso);
                    if ($resp_persona) {
                        if ($contacto == '2') {  //Cuando tiene datos para contactar.
                            $resp_contacto = $mod_pergestion->insertarPersGestionContac($resp_persona, $nombrebeni1, $nombrebeni2, $apellidobeni1, $apellidobeni2, $correocontacto, $telefonocontacto, $celularcontacto, $paiscontacto);
                            if ($resp_contacto) {
                                $exito = 1;
                            }
                        } else {
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
                    } else {
                        $transaction->rollback();
                        $message = array(
                            "wtmessage" => Yii::t("notificaciones", "Error al grabar. " . $mensaje),
                            "title" => Yii::t('jslang', 'Success'),
                        );
                        return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                    }
                } else {
                    $mensaje = 'Registro ya existente';
                    $transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "No se puede guardar el contacto " . $mensaje),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $mensaje),
                    "title" => Yii::t('jslang', 'Success'),
                );
                return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
            }
            return;
        }
    }
    
    public function actionUpdate() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $celular = null;
        $celular2 = null;
        $telefono = null;
        $celular_pcontacto = null;
        $telefono_pcontacto = null;
        $correo_pcontacto = null;
        $pais_pcontacto = null;
        $nombre1_pcontacto = null;
        $nombre2_pcontacto = null;
        $apellido1_pcontacto = null;
        $apellido2_pcontacto = null;
        $conoce_uteg = null;
        $carrera = null;
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $nombre1 = ucwords(strtolower($data["txt_nombre1"]));
            $nombre2 = ucwords(strtolower($data["txt_nombre2"]));
            $apellido1 = ucwords(strtolower($data["txt_apellido1"]));
            $apellido2 = ucwords(strtolower($data["txt_apellido2"]));
            if ($data["cmb_tipo_dni"] == 'CED') {
                $pasaporte = '';
                $cedula = $data["cedula"];
            } else {
                $cedula = '';
                $pasaporte = $data["cedula"];
            }
            $tipo_persona = base64_decode($data["tipo_persona"]);
            $empresa = ucwords(strtolower($data["empresa"]));
            $telefono_empresa = $data["telefono_empresa"];
            $direccion = ucwords(strtolower($data["direccion"]));

            $pais = $data["pais"];
            $pges_id = base64_decode($data["pges_id"]);
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

            //Información de contacto.
            $pgco_id = base64_decode($data["perges_contacto"]);
            if ($pgco_id > 0) {
                $nombre1_pcontacto = ucwords(strtolower($data["txt_nombre1contacto"]));
                $nombre2_pcontacto = ucwords(strtolower($data["txt_nombre2contacto"]));
                $apellido1_pcontacto = ucwords(strtolower($data["txt_apellido1contacto"]));
                $apellido2_pcontacto = ucwords(strtolower($data["txt_apellido2contacto"]));
                if (!empty($data["txt_celularcontacto"])) {
                    $celular_pcontacto = $data["txt_celularcontacto"];
                }
                if (!empty($data["txt_telefonocontacto"])) {
                    $telefono_pcontacto = $data["txt_telefonocontacto"];
                }
                if (!empty($data["txt_correocontacto"])) {
                    $correo_pcontacto = strtolower($data["txt_correocontacto"]);
                }
                if (!empty($data["txt_paiscontacto"])) {
                    $pais_pcontacto = strtolower($data["txt_paiscontacto"]);
                }
            }  //
            $per_nac_ecuatoriano = $data["nacecuador"];
            $agente = $data["agente"];

            $usuario = @Yii::$app->user->identity->usu_id;
            $con = \Yii::$app->db_crm;
            $transaction = $con->beginTransaction();
            try {
                $mod_pergestion = new PersonaGestion();
                $keys_act = [
                    'tper_id', 'cser_id', 'car_id', 'pges_pri_nombre', 'pges_seg_nombre'
                    , 'pges_pri_apellido', 'pges_seg_apellido', 'pges_cedula', 'pges_pasaporte'
                    , 'pai_id_nacimiento', 'pro_id_nacimiento', 'can_id_nacimiento'
                    , 'pges_celular', 'pges_correo', 'pges_domicilio_telefono'
                    , 'pges_domicilio_celular2', 'ccan_id', 'pges_razon_social'
                    , 'pges_contacto_empresa', 'pges_num_empleados', 'pges_telefono_empresa'
                    , 'pges_direccion_empresa', 'pges_cargo', 'pges_nac_ecuatoriano'
                ];
                $values_act = [
                    $tipo_persona, $conoce_uteg, $carrera, $nombre1, $nombre2,
                    $apellido1, $apellido2, $cedula, $pasaporte,
                    $pais, $provincia, $ciudad,
                    $celular, $correo, $telefono,
                    $celular2, $medio, $empresa,
                    $contacto_empresa, $numero_contacto, $telefono_empresa,
                    $direccion, $cargo, $per_nac_ecuatoriano
                ];
                $respPergestion = $mod_pergestion->actualizarPersonaGestion($con, $pges_id, $values_act, $keys_act, 'persona_gestion');
                if ($respPergestion) {
                    if ($pgco_id > 0) {  //Existe información para contactar.
                        //$mensaje = 'Id:'.$pgco_id. ' Nombre1:'.$nombre1_pcontacto. ' Nombre2:'. $nombre2_pcontacto . ' Apellido1:'. $apellido1_pcontacto. ' Apellido2:'.$apellido2_pcontacto . ' Correo:' .$correo_pcontacto . ' Telefono:'. $telefono_pcontacto . ' Celular:' . $celular_pcontacto . ' País:' .$pais_pcontacto;
                        $exito = $mod_pergestion->modificarPercontXid($pgco_id, $nombre1_pcontacto, $nombre2_pcontacto, $apellido1_pcontacto, $apellido2_pcontacto, $correo_pcontacto, $telefono_pcontacto, $celular_pcontacto, $pais_pcontacto);
                    } else {
                        $exito = 1;
                    }
                }
                if ($exito) {
                    $transaction->commit();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "La infomación ha sido actualizada."),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                } else {
                    $transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $mensaje),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $mensaje),
                    "title" => Yii::t('jslang', 'Success'),
                );
                return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
            }
            return;
        }
    }
    
    public function actionListaroportunidad() {
        $per_id = @Yii::$app->session->get("PB_iduser");
        $pges_id = base64_decode($_GET["pgid"]);
        $modGestionCrm = new Oportunidad();
        $data = Yii::$app->request->get();
        $persges_mod = new PersonaGestion();
        $contactManage = $persges_mod->consultarPersonaGestion($pges_id);
        $ListOportXContact = $modGestionCrm->consultarOportunidadesByContact(array(), $pges_id, 2);
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
        }
        return $this->render('listarOportXContact', [
                    'model' => $ListOportXContact,
                    "tipo_dni" => array("CED" => Yii::t("formulario", "DNI Document"), "PASS" => Yii::t("formulario", "Passport")),
                    'personalData' => $contactManage,
        ]);
    }

}