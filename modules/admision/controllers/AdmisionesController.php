<?php

namespace app\modules\admision\controllers;

use Yii;
use \app\models\Interesado;
use app\models\InteresadoEjecutivo;
use app\models\Pais;
use yii\base\Security;
use app\models\Provincia;
use app\models\Canton;
use app\models\Persona;
use \app\modules\admision\models\EstadoOportunidad;
use app\models\EmpresaPersona;
use app\modules\admision\models\Oportunidad;
use app\models\Utilities;
use app\models\EstudioAcademico;
use app\modules\admision\models\PersonaGestion;
use app\modules\admision\models\PersonaTemporal;
use app\models\Modalidad;
use \app\models\Usuario;
use app\models\TipoOportunidadVenta;
use yii\helpers\ArrayHelper;
use app\modules\admision\models\EstadoContacto;
use app\models\UnidadAcademica;
use app\models\UsuaGrolEper;
use app\models\ModuloEstudio;
use app\models\Empresa;
use app\models\TipoCarrera;

class AdmisionesController extends \app\components\CController {

    public function actionCrearcontacto() {
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
        return $this->render('crearContacto', [
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

    public function actionActualizarcontacto() {
        $modcanal = new Oportunidad();
        $mod_pais = new Pais();
        $pges_id = base64_decode($_GET["codigo"]);
        $tper = base64_decode($_GET["tper_id"]);

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

        return $this->render('actualizarContacto', [
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

    public function actionGuardaractuacontactpend() {
        $per_id = @Yii::$app->session->get("PB_perid");
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            //$id_pertemp = $data["id_pertemp"];
            $pertemp = new PersonaTemporal();
            try {
                $updatePerson = $pertemp->actualizarPersonaTemporal($data);
                if ($updatePerson) {
                    $message = array(
                        "wtmessage" => Yii::t("formulario", "The information have been saved"),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                } else {
                    $message = array(
                        "wtmessage" => Yii::t("formulario", "Error"),
                        "title" => Yii::t('jslang', 'Bad Request'),
                    );
                    return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Bad Request"), false, $message);
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => Yii::t("formulario", "Error"),
                    "title" => Yii::t('jslang', 'Bad Request'),
                );
                return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Bad Request"), false, $message);
            }
            return;
        }
    }

    public function actionGuardarcontactopend() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $user_id = @Yii::$app->session->get("PB_iduser");
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $id_pertemp = $data["id_pertemp"];
            $pertemp = new PersonaTemporal();
            $modpt = $pertemp->consultarClienteTempById($id_pertemp);
            $error = 0;
            $con = \Yii::$app->db_crm;
            try {
                $mod_gestion = new Oportunidad();
                $mod_pergestion = new PersonaGestion();
                $secl = $mod_scli->consultarSubestadCli(1);
                $secl_id = $secl[0]['id'];
                $ttper = 1; // natural
                $ccan = 1; //webpage form.                            
                $pergestion_id = $mod_pergestion->consultarIdPersonaGestion($modpt['correo']); //registro                                                                
                if ($pergestion_id == 0) {
                    $keys = [
                        'tper_id', 'pges_pri_nombre', 'pges_seg_nombre', 'pges_pri_apellido'
                        , 'pges_seg_apellido', 'pges_razon_social', 'pges_cedula', 'pges_ruc'
                        , 'pges_pasaporte', 'pges_contacto_empresa', 'etn_id', 'eciv_id'
                        , 'pges_genero', 'pges_nacionalidad', 'pai_id_nacimiento'
                        , 'pro_id_nacimiento', 'can_id_nacimiento', 'pges_nac_ecuatoriano'
                        , 'pges_fecha_nacimiento', 'pges_celular', 'pges_correo'
                        , 'tsan_id', 'pges_domicilio_sector', 'pges_domicilio_cpri'
                        , 'pges_domicilio_csec', 'pges_domicilio_num', 'pges_domicilio_ref'
                        , 'pai_id_domicilio', 'pro_id_domicilio', 'can_id_domicilio'
                        , 'pges_trabajo_nombre', 'pges_trabajo_direccion', 'pges_trabajo_telefono'
                        , 'pges_trabajo_direccion', 'pges_trabajo_telefono', 'pges_trabajo_ext'
                        , 'pges_id_trabajo', 'pro_id_trabajo', 'can_id_trabajo'
                        , 'scli_id', 'ccan_id', 'pges_razon_social', 'pges_contacto_empresa'
                        , 'pges_num_empleados', 'telefono_empresa', 'uaca_id', 'mod_id'
                        , 'pges_estado', 'pges_estado_logico'
                    ];
                    $parameters = [
                        $ttper, $modpt['nombre'], null, $modpt['apellido'],
                        null, null, null, null,
                        null, null, null, null,
                        null, null, null,
                        null, null, null,
                        null, $modpt['celular'], $modpt['correo'],
                        null, null, null,
                        null, null, null,
                        null, null, null,
                        null, null, null,
                        null, null, null,
                        null, null, null,
                        $secl_id, $ccan, null, null,
                        null, null, null, null,
                        1, 1
                    ];
                    $pergestion_id = $mod_pergestion->insertarPersonaGest($con, $parameters, $keys, 'persona_gestion');
                    \app\models\Utilities::putMessageLogFile('el id insertado es: ' . $pergestion_id);
                }
                if ($pergestion_id > 0) {
                    \app\models\Utilities::putMessageLogFile('Persona gestion ingresada');
                    $percontrat_id = $mod_gestion->consultarIdPersonaContratante($pergestion_id);
                    if ($percontrat_id == 0) {
                        $keys = ['pges_id', 'pcon_estado', 'pcon_estado_logico'];
                        $parametros = [$pergestion_id, 1, 1];
                        $pergestion_id = $mod_gestion->insertarPersonaContrat($con, $parametros, $keys, 'persona_contratante');
                    }
                    if ($percontrat_id > 0) {
                        \app\models\Utilities::putMessageLogFile('Persona contratante ingresada');
                        $perben_id = $mod_gestion->consultarIdPersonaBeneficiario($pergestion_id);
                        \app\models\Utilities::putMessageLogFile('Persona beneficiario: ' . $perben_id);
                        if ($perben_id == 0) {
                            $keys = ['pges_id', 'pcon_id', 'pben_estado', 'pben_estado_logico'];
                            $parametros = [$pergestion_id, $percontrat_id, 1, 1];
                            $pergestion_id = $mod_gestion->insertarPersonaBene($con, $parametros, $keys, 'persona_beneficiario');
                        }
                        if ($perben_id > 0) {
                            \app\models\Utilities::putMessageLogFile('Persona beneficiaria ingresada');
                        }
                    } else {
                        $error_message .= Yii::t("formulario", "Contracted person hasn't been saved");
                        $error++;
                    }
                } else {
                    $error_message .= Yii::t("formulario", "Manage person hasn't been saved");
                    $error++;
                }
                if ($error == 0) {
                    $message = array(
                        "wtmessage" => Yii::t("formulario", "The information have been saved"),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                } else {
                    $transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("formulario", "Error: " . $error_message),
                        "title" => Yii::t('jslang', 'Bad Request'),
                    );
                    return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Bad Request"), false, $message);
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => Yii::t("formulario", "Error: " . $error_message),
                    "title" => Yii::t('jslang', 'Bad Request'),
                );
                return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Bad Request"), false, $message);
            }
            return;
        }
    }

    public function actionGuardarinteresado() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $error = 0;
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $id_pgest = $data["id_pgest"];
            $pergest = new PersonaGestion();
            \app\models\Utilities::putMessageLogFile('persona gestion id: ' . $id_pgest);
            $pgest = $pergest->consultarPersonaGestion($id_pgest);
            $con = \Yii::$app->db_asgard;
            $transaction = $con->beginTransaction();
            try {
                $identificacion='';
                \app\models\Utilities::putMessageLogFile('cedula: ' . $pgest['pges_cedula']);                                
                \app\models\Utilities::putMessageLogFile('pasaporte: ' . $pgest['pges_pasaporte']);                                
                if (isset($pgest['pges_cedula']) && strlen($pgest['pges_cedula']) > 0) {
                    $identificacion = $pgest['pges_cedula'];
                } else {
                    $identificacion = $pgest['pges_pasaporte'];
                }
                \app\models\Utilities::putMessageLogFile('identificacion: ' . $identificacion);                
                if (isset($identificacion) && strlen($identificacion) > 0) {
                    $id_persona = 0;
                    $mod_persona = new Persona();
                    $keys_per = [
                        'per_pri_nombre', 'per_seg_nombre', 'per_pri_apellido', 'per_seg_apellido'
                        , 'per_cedula', 'etn_id', 'eciv_id', 'per_genero', 'pai_id_nacimiento', 'pro_id_nacimiento'
                        , 'can_id_nacimiento', 'per_fecha_nacimiento', 'per_celular', 'per_correo'
                        , 'tsan_id', 'per_domicilio_sector', 'per_domicilio_cpri', 'per_domicilio_csec'
                        , 'per_domicilio_num', 'per_domicilio_ref', 'per_domicilio_telefono'
                        , 'pai_id_domicilio', 'pro_id_domicilio', 'can_id_domicilio'
                        , 'per_nac_ecuatoriano', 'per_nacionalidad', 'per_foto', 'per_estado', 'per_estado_logico'
                    ];
                    $parametros_per = [
                        $pgest['pges_pri_nombre'], null, $pgest['pges_pri_apellido'], null,
                        $pgest['pges_cedula'], null, null, null, null, null,
                        null, null, $pgest['pges_celular'], $pgest['pges_correo'],
                        null, null, null, null,
                        null, null, null,
                        null, null, null,
                        null, null, null, 1, 1
                    ];
                    $id_persona = $mod_persona->consultarIdPersona($pgest['pges_cedula'],$pgest['pges_pasaporte']);
                    if ($id_persona == 0) {
                        $id_persona = $mod_persona->insertarPersona($con, $parametros_per, $keys_per, 'persona');
                    }
                    if ($id_persona > 0) {
                        \app\models\Utilities::putMessageLogFile('persona con id: ' . $id_persona);
                        $concap = \Yii::$app->db_captacion;
                        $mod_emp_persona = new EmpresaPersona();
                        $emp_id = 1;
                        $keys = ['emp_id', 'per_id', 'eper_estado', 'eper_estado_logico'];
                        $parametros = [$emp_id, $id_persona, 1, 1];
                        $emp_per_id = $mod_emp_persona->consultarIdEmpresaPersona($id_persona, $emp_id);
                        if ($emp_per_id == 0) {
                            $emp_per_id = $mod_emp_persona->insertarEmpresaPersona($con, $parametros, $keys, 'empresa_persona');
                        }
                        if ($emp_per_id > 0) {
                            \app\models\Utilities::putMessageLogFile('empresa persona con id: ' . $emp_per_id);
                            $usuario = new Usuario();
                            $usuario_id = $usuario->consultarIdUsuario($id_persona, $pgest['pges_correo']);
                            if ($usuario_id == 0) {
                                $security = new Security();
                                $hash = $security->generateRandomString();
                                $passencrypt = base64_encode($security->encryptByPassword($hash, 'Uteg2018'));
                                $keys = ['per_id', 'usu_user', 'usu_sha', 'usu_password', 'usu_estado', 'usu_estado_logico'];
                                $parametros = [$id_persona, $pgest['pges_correo'], $hash, $passencrypt, 1, 1];
                                $usuario_id = $usuario->crearUsuarioTemporal($con, $parametros, $keys, 'usuario');
                            }
                            if ($usuario_id > 0) {
                                \app\models\Utilities::putMessageLogFile('usuario con id: ' . $usuario_id);
                                $mod_us_gr_ep = new UsuaGrolEper();
                                $grol_id = 10;
                                $keys = ['eper_id', 'usu_id', 'grol_id', 'ugep_estado', 'ugep_estado_logico'];
                                $parametros = [$emp_per_id, $usuario_id, $grol_id, 1, 1];
                                $us_gr_ep_id = $mod_us_gr_ep->consultarIdUsuaGrolEper($emp_per_id, $usuario_id, $grol_id);
                                if ($us_gr_ep_id == 0)
                                    $us_gr_ep_id = $mod_us_gr_ep->insertarUsuaGrolEper($con, $parametros, $keys, 'usua_grol_eper');
                                if ($us_gr_ep_id > 0) {
                                    \app\models\Utilities::putMessageLogFile('usua grol con id: ' . $us_gr_ep_id);
                                    $mod_interesado = new Interesado(); // se guarda con estado_interesado 1                        
                                    $interesado_id = $mod_interesado->consultaInteresadoById($id_persona);
                                    $keys = ['per_id', 'int_estado_interesado', 'int_usuario_ingreso', 'int_estado', 'int_estado_logico'];
                                    $parametros = [$id_persona, 1, $usuario_id, 1, 1];
                                    if ($interesado_id == 0) {
                                        $interesado_id = $mod_interesado->insertarInteresado($concap, $parametros, $keys, 'interesado');
                                    }
                                    if ($interesado_id > 0) {
                                        \app\models\Utilities::putMessageLogFile('entro al interesado con id: ' . $interesado_id);
                                        $mod_int_ejecutivo = new InteresadoEjecutivo();
                                        $interesadoEjecutivo_id = $mod_int_ejecutivo->consultarInteresadoEjecutivoById($interesado_id);
                                        if ($interesadoEjecutivo_id == 0) {
                                            $keys = ['int_id', 'asp_id', 'per_id', 'ieje_usuario', 'ieje_estado', 'ieje_estado_logico'];
                                            $parametros = [$interesado_id, null, $per_id, 12, 1, 1]; //12 es andrea bejarano
                                            $interesadoEjecutivo_id = $mod_int_ejecutivo->insertarInteresadoEjecutivo($concap, $parametros, $keys, 'interesado_ejecutivo');
                                        }
                                        if ($interesadoEjecutivo_id > 0) {
                                            \app\models\Utilities::putMessageLogFile('entro al interesado ejecutivo con id: ' . $interesadoEjecutivo_id);
                                            $email_info = array(
                                                "nombre" => $pgest['pges_pri_nombre'],
                                                "apellido" => $pgest['pges_pri_apellido'],
                                                "correo" => $pgest['pges_correo']
                                            );                                            
                                        } else {
                                            $error_message .= Yii::t("formulario", "The executive interested hasn't been saved");
                                            $error++;
                                        }
                                    } else {
                                        $error_message .= Yii::t("formulario", "The interested person hasn't been saved");
                                        $error++;
                                    }
                                } else {
                                    $error_message .= Yii::t("formulario", "The rol user hasn't been saved");
                                    $error++;
                                }
                            } else {
                                $error_message .= Yii::t("formulario", "The user hasn't been saved");
                                $error++;
                            }
                        } else {
                            $error_message .= Yii::t("formulario", "The enterprise person hasn't been saved");
                            $error++;
                        }
                    } else {
                        $error++;
                        $error_message .= Yii::t("formulario", "The person has not been saved");
                    }
                } else {
                    $error_message .= Yii::t("formulario", "Update DNI to generate interested");
                    $error++;
                }

                if ($error == 0) {
                    $message = array(
                        "wtmessage" => Yii::t("formulario", "The information have been saved"),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                } else {
                    //$transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("formulario", "Mensaje: " . $error_message),
                        "title" => Yii::t('jslang', 'Bad Request'),
                    );
                    return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Bad Request"), false, $message);
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => Yii::t("formulario", "Mensaje: " . $error_message),
                    "title" => Yii::t('jslang', 'Bad Request'),
                );
                return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Bad Request"), false, $message);
            }
            return;
        }
    }

    public function actionGuardaroportunidad() {
        $per_id = @Yii::$app->session->get("PB_perid"); //ESTO DESCOMENTAR AL FINAL
        //$per_id = 5;
        $mod_gestion = new Oportunidad();
        //$scli_id = 2;
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $pges_id = base64_decode($data["id_pgest"]);
            $empresa = $data["empresa"];
            $modulo_estudio = null;
            $unidad_academica = $data["id_unidad_academica"];
            $modalidad = $data["id_modalidad"];
            $tipo_oportunidad = $data["id_tipo_oportunidad"];
            $estado_oportunidad = $data["id_estado_oportunidad"];
            $estudio_academico = $data["id_estudio_academico"];
            $canal_conocimiento = $data["canal_conocimiento"];
            $sub_carrera = ($data["sub_carrera"]!=0)?$data["sub_carrera"]:null;
            $usuario = @Yii::$app->user->identity->usu_id;
            $con = \Yii::$app->db_crm;
            $conagente = $mod_gestion->consultarAgenteAutenticado($per_id);
            //$emp_id, $mest_id, $eaca_id, $uaca_id, $mod_id, $eopo_id 
            //$nombreoportunidad = $mod_gestion->consultarNombreOportunidad($empresa, $modulo_estudio, $estudio_academico, $unidad_academica, $modalidad, $estado_oportunidad);
            $nombreoportunidad = $mod_gestion->consultarNombreOportunidad($empresa, $modulo_estudio, $estudio_academico, $unidad_academica, $modalidad, $estado_oportunidad);
  
            $transaction = $con->beginTransaction();
            try {
                $gcrm_codigo = $mod_gestion->consultarUltimoCodcrm();
                //$per_gest = $mod_pergestion->consultarPersonaGestion($pges_id);
                $codportunidad = 1 + $gcrm_codigo;
                $fecha_registro = date(Yii::$app->params["dateTimeByDefault"]);
                if ($agente > 0) {
                    //if ($nombreoportunidad["eopo_nombre"] == '' || $nombreoportunidad["eopo_nombre"] == 'Ganada' || $nombreoportunidad["eopo_nombre"] == 'Perdida') {
                    if ($nombreoportunidad["Ids"] == '' || $nombreoportunidad["Ids"] == '4' || $nombreoportunidad["Ids"] == '5') {
                        $res_gestion = $mod_gestion->insertarOportunidad($codportunidad, $empresa, $pges_id, $modulo_estudio, $estudio_academico, $unidad_academica, $modalidad, $tipo_oportunidad, $sub_carrera, $canal_conocimiento, $estado_oportunidad, $fecha_registro, $agente, $usuario);
                        if ($res_gestion) {
                            $opo_id=$res_gestion;
                            $padm_id=$agente;
                            $eopo_id = $estado_oportunidad; // En curso por defecto
                            $bact_fecha_registro=$fecha_registro;
                            $bact_fecha_proxima_atencion=$fecha_registro;
                            
                            $bact_descripcion = (!$nombreoportunidad["Ids"])?'Inicio de Operaciones':'';
                            $res_actividad=$mod_gestion->insertarActividad($opo_id,$usuario, $padm_id, $eopo_id, $bact_fecha_registro, $bact_descripcion, $bact_fecha_proxima_atencion);
                            if ($res_actividad) {
                                $transaction->commit();
                                $message = array(
                                    "wtmessage" => Yii::t("notificaciones", "La infomación ha sido grabada. "),
                                    "title" => Yii::t('jslang', 'Success'),
                                );
                                return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);                                
                            }else{
                                $transaction->rollback();
                                $message = array(
                                    "wtmessage" => Yii::t("notificaciones", "Error al grabar"),
                                    "title" => Yii::t('jslang', 'Bad Request'),
                                );
                                return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Bad Request"), false, $message);                                
                            }
                            
                        } else {
                            $transaction->rollback();
                            $message = array(
                                "wtmessage" => Yii::t("notificaciones", "Error al grabar"),
                                "title" => Yii::t('jslang', 'Bad Request'),
                            );
                            return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Bad Request"), false, $message);
                        }
                    } else {
                        $transaction->rollback();
                        $message = array(
                            "wtmessage" => Yii::t("notificaciones", "Error al grabar, Existe una oportunidad con estos datos."),
                            "title" => Yii::t('jslang', 'Bad Request'),
                        );
                        return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Bad Request"), false, $message);
                    }
                } else {
                    $transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error al grabar. Usuario no cuenta con permisos"),
                        "title" => Yii::t('jslang', 'Bad Request'),
                    );
                    return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Bad Request"), false, $message);
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $mensaje),
                    "title" => Yii::t('jslang', 'Bad Request'),
                );
                return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Bad Request"), false, $message);
            }
            return;
        }
    }

    public function actionGuardaractoportunidad() {
        //$per_id = @Yii::$app->session->get("PB_perid");
        $mod_oportunidad = new Oportunidad();
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();

            $opo_id = base64_decode($data["opo_id"]);
            $pges_id = base64_decode($data["pgid"]);
            $empresa = $data["empresa"];
            $mest_id = null;
            $eaca_id = null;
            $unidad_academica = $data["uaca_id"];
            $modalidad = $data["modalidad"];
            $tipo_oportunidad = $data["tipoOport"];
            $estado_oportunidad = $data["estado"];
            $carrera_estudio = $data["carreraestudio"];
            if ($unidad_academica < 3) {
                $eaca_id = $carrera_estudio;
            } else {
                $mest_id = $carrera_estudio;
            }
            $canal_conocimiento = $data["canal"];
            $sub_carrera = $data["subcarrera"];
            $usuario = @Yii::$app->user->identity->usu_id;

            $con = \Yii::$app->db_crm;
            $transaction = $con->beginTransaction();
            try {
                $nombreoportunidad = $mod_oportunidad->consultarNombreOportunidad($empresa, $mest_id, $eaca_id, $unidad_academica, $modalidad, $estado_oportunidad);
                //$mensaje = 'opo:' . $opo_id . ' mest_id:' . $mest_id . ' eaca_id:' . $eaca_id . ' unidad:' . $unidad_academica . ' modalidad:' . $modalidad . ' tipoOpor:' . $tipo_oportunidad . ' subCarr:' . $sub_carrera . ' Canal:' . $canal_conocimiento . ' estado:' . $estado_oportunidad . ' usuario:' . $usuario;
                if ($nombreoportunidad["eopo_nombre"] == '' || $nombreoportunidad["eopo_nombre"] == 'Ganada' || $nombreoportunidad["eopo_nombre"] == 'Perdida') {
                    $respuesta = $mod_oportunidad->modificarOportunixId($empresa, $opo_id, $mest_id, $eaca_id, $unidad_academica, $modalidad, $tipo_oportunidad, $sub_carrera, $canal_conocimiento, null, null, null, $usuario, null);
                    if ($respuesta) {
                        $transaction->commit();
                        $message = array(
                            "wtmessage" => Yii::t("notificaciones", "La información ha sido grabada. "),
                            "title" => Yii::t('jslang', 'Success'),
                        );
                        return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                    } else {
                        $transaction->rollback();
                        $message = array(
                            "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $mensaje),
                            "title" => Yii::t('jslang', 'Bad Request'),
                        );
                        return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Bad Request"), false, $message);
                    }
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $mensaje),
                    "title" => Yii::t('jslang', 'Bad Request'),
                );
                return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Bad Request"), false, $message);
            }
            return;
        }
    }

    public function actionListaroportunidades() {
        $per_id = @Yii::$app->session->get("PB_iduser");
        $modoportunidad = new Oportunidad();
        $modEstOport = new EstadoOportunidad();
        $estado_oportunidad = $modEstOport->consultarEstadOportunidad();

        $data = Yii::$app->request->get();

        if ($data['PBgetFilter']) {
            $arrSearch["agente"] = $data['agente'];
            $arrSearch["interesado"] = $data['interesado'];
            // $arrSearch["f_atencion"] = $data['f_atencion'];
            $arrSearch["estado"] = $data['estado'];
            $mod_gestion = $modoportunidad->consultarOportunidad($arrSearch, 2);
        } else {
            $mod_gestion = $modoportunidad->consultarOportunidad($arrSearch, 2);
        }
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
        }
        return $this->render('listarOportunidades', [
                    'model' => $mod_gestion,
                    'arr_estgestion' => ArrayHelper::map(array_merge([["id" => "0", "name" => "Todas"]], $estado_oportunidad), "id", "name"),
        ]);
    }

    public function actionListaractixoport() {
        $modoportunidad = new Oportunidad();
        $pges_id = base64_decode($_GET["pges_id"]);
        $opor_id = base64_decode($_GET["opor_id"]);
        $persges_mod = new PersonaGestion();
        $contactManage = $persges_mod->consultarPersonaGestion($pges_id);
        $mod_gestion = $modoportunidad->consultarOportunHist($opor_id);
        $mod_oportu = $modoportunidad->consultarOportunidadById($opor_id);
        return $this->render('listarActiXOport', [
                    'model' => $mod_gestion,
                    'personalData' => $contactManage,
                    'oportuniData' => $mod_oportu,
        ]);
    }

    public function actionVercontacto() {
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

        return $this->render('verContacto', [
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

    public function actionCrearactividad() {
        $opor_id = base64_decode($_GET["opid"]);
        $pges_id = base64_decode($_GET["pgid"]);
        $persges_mod = new PersonaGestion();
        $uni_aca_model = new UnidadAcademica();
        $modTipoOportunidad = new TipoOportunidadVenta();
        $modalidad_model = new Modalidad();
        $state_oportunidad_model = new EstadoOportunidad();
        $oport_model = new Oportunidad();
        $empresa_mod = new Empresa();
        $empresa = $empresa_mod->getAllEmpresa();
        $contactManage = $persges_mod->consultarPersonaGestion($pges_id);
        $modalidad_data = $modalidad_model->consultarModalidad(0);
        $oport_contac = $oport_model->consultarOportunidadById($opor_id);
        $oportunidad_perdidad = $oport_model->consultarOportunidadPerdida();
        $unidad_acad_data = $uni_aca_model->consultarUnidadAcademicas();
        $tipo_oportunidad_data = $modTipoOportunidad->consultarOporxUnidad(1);
        $academic_study_data = $oport_model->consultarCarreraModalidad(1, 1);
        $state_oportunidad_data = $state_oportunidad_model->consultarEstadOportunidad();
        $knowledge_channel_data = $oport_model->consultarConocimientoCanal(1);
        return $this->render('crearActividad', [
                    'personalData' => $contactManage,
                    'oportunidad_contacto' => $oport_contac,
                    'arr_modalidad' => ArrayHelper::map($modalidad_data, "id", "name"),
                    'arr_linea_servicio' => ArrayHelper::map($unidad_acad_data, "id", "name"),
                    'arr_oportunidad_perdida' => ArrayHelper::map($oportunidad_perdidad, "id", "name"),
                    'arr_tipo_oportunidad' => ArrayHelper::map($tipo_oportunidad_data, "id", "name"),
                    'arr_state_oportunidad' => ArrayHelper::map($state_oportunidad_data, "id", "name"),
                    'arr_academic_study' => ArrayHelper::map($academic_study_data, "id", "name"),
                    "arr_knowledge_channel" => ArrayHelper::map($knowledge_channel_data, "id", "name"),
                    "tipo_dni" => array("CED" => Yii::t("formulario", "DNI Document"), "PASS" => Yii::t("formulario", "Passport")),
                    'arr_empresa' => ArrayHelper::map($empresa, "Ids", "Nombre"),
        ]);
    }

    public function actionVeractividad() {
        $opor_id = base64_decode($_GET["opid"]);
        $act_id = base64_decode($_GET["acid"]);
        $pges_id = base64_decode($_GET["pgid"]);
        $persges_mod = new PersonaGestion();
        $uni_aca_model = new UnidadAcademica();
        $modTipoOportunidad = new TipoOportunidadVenta();
        $modalidad_model = new Modalidad();
        $state_oportunidad_model = new EstadoOportunidad();
        $oport_model = new Oportunidad();
        $empresa_mod = new Empresa();
        $empresa = $empresa_mod->getAllEmpresa();
        $contactManage = $persges_mod->consultarPersonaGestion($pges_id);
        $modalidad_data = $modalidad_model->consultarModalidad(0);
        $actividad_data = $oport_model->consultarActividadById($act_id);
        $oportunidad_perdidad = $oport_model->consultarOportunidadPerdida();
        $oport_contac = $oport_model->consultarOportunidadById($opor_id);
        $unidad_acad_data = $uni_aca_model->consultarUnidadAcademicas();
        $tipo_oportunidad_data = $modTipoOportunidad->consultarOporxUnidad(1);
        $academic_study_data = $oport_model->consultarCarreraModalidad(1, 1);
        $state_oportunidad_data = $state_oportunidad_model->consultarEstadOportunidad();
        $knowledge_channel_data = $oport_model->consultarConocimientoCanal(1);
        return $this->render('verActividad', [
                    'personalData' => $contactManage,
                    'oportunidad_contacto' => $oport_contac,
                    'actividad_oportunidad' => $actividad_data,
                    'arr_modalidad' => ArrayHelper::map($modalidad_data, "id", "name"),
                    'arr_oportunidad_perdida' => ArrayHelper::map($oportunidad_perdidad, "id", "name"),
                    'arr_linea_servicio' => ArrayHelper::map($unidad_acad_data, "id", "name"),
                    'arr_tipo_oportunidad' => ArrayHelper::map($tipo_oportunidad_data, "id", "name"),
                    'arr_state_oportunidad' => ArrayHelper::map($state_oportunidad_data, "id", "name"),
                    'arr_academic_study' => ArrayHelper::map($academic_study_data, "id", "name"),
                    "arr_knowledge_channel" => ArrayHelper::map($knowledge_channel_data, "id", "name"),
                    "tipo_dni" => array("CED" => Yii::t("formulario", "DNI Document"), "PASS" => Yii::t("formulario", "Passport")),
                    'arr_empresa' => ArrayHelper::map($empresa, "Ids", "Nombre"),
        ]);
    }

    public function actionActualizaractividad() {
        $opor_id = base64_decode($_GET["opid"]);
        $act_id = base64_decode($_GET["acid"]);
        $pges_id = base64_decode($_GET["pgid"]);
        $persges_mod = new PersonaGestion();
        $uni_aca_model = new UnidadAcademica();
        $modTipoOportunidad = new TipoOportunidadVenta();
        $modalidad_model = new Modalidad();
        $state_oportunidad_model = new EstadoOportunidad();
        $oport_model = new Oportunidad();
        $empresa_mod = new Empresa();
        $empresa = $empresa_mod->getAllEmpresa();
        $contactManage = $persges_mod->consultarPersonaGestion($pges_id);
        $modalidad_data = $modalidad_model->consultarModalidad(0);
        $actividad_data = $oport_model->consultarActividadById($act_id);
        $oportunidad_perdidad = $oport_model->consultarOportunidadPerdida();
        $oport_contac = $oport_model->consultarOportunidadById($opor_id);
        $unidad_acad_data = $uni_aca_model->consultarUnidadAcademicas();
        $tipo_oportunidad_data = $modTipoOportunidad->consultarOporxUnidad(1);
        $academic_study_data = $oport_model->consultarCarreraModalidad(1, 1);
        $state_oportunidad_data = $state_oportunidad_model->consultarEstadOportunidad();
        $knowledge_channel_data = $oport_model->consultarConocimientoCanal(1);
        return $this->render('actualizarActividad', [
                    'personalData' => $contactManage,
                    'oportunidad_contacto' => $oport_contac,
                    'actividad_oportunidad' => $actividad_data,
                    'arr_modalidad' => ArrayHelper::map($modalidad_data, "id", "name"),
                    'arr_oportunidad_perdida' => ArrayHelper::map($oportunidad_perdidad, "id", "name"),
                    'arr_linea_servicio' => ArrayHelper::map($unidad_acad_data, "id", "name"),
                    'arr_tipo_oportunidad' => ArrayHelper::map($tipo_oportunidad_data, "id", "name"),
                    'arr_state_oportunidad' => ArrayHelper::map($state_oportunidad_data, "id", "name"),
                    'arr_academic_study' => ArrayHelper::map($academic_study_data, "id", "name"),
                    "arr_knowledge_channel" => ArrayHelper::map($knowledge_channel_data, "id", "name"),
                    "tipo_dni" => array("CED" => Yii::t("formulario", "DNI Document"), "PASS" => Yii::t("formulario", "Passport")),
                    'arr_empresa' => ArrayHelper::map($empresa, "Ids", "Nombre"),
        ]);
    }

    public function actionGuardaractividad() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $usu_id = @Yii::$app->user->identity->usu_id;
        $fecproxima = null;
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $mod_gestion = new Oportunidad();
            $fecatiende = $data["fecatencion"] . ' ' . $data["horatencion"];
            $observacion = ucwords(strtolower($data["observacion"]));
            if (!empty($data["fecproxima"])) {
                $fecproxima = $data["fecproxima"] . ' ' . $data["horproxima"];
            }
            // Datos Generales Contacto            
            $con = \Yii::$app->db_crm;
            $transaction = $con->beginTransaction();
            try {
                $padm_class = $mod_gestion->consultarAgenteAutenticado(5);
                $padm_id = $padm_class['padm_id'];
                if ($padm_id > 0) {
                    $opo_id = base64_decode($data['oportunidad']);
                    $eopo_id = $data['estado_oportunidad'];
                    $actividad_id = $mod_gestion->insertarActividad($opo_id, $usu_id, $padm_id, $eopo_id, $fecatiende, $observacion, $fecproxima);
                    if ($actividad_id) {
                        $oporper = null;
                        if ($eopo_id == 5) {
                            $oporper = $data['oportunidad_perdida'];
                        }
                        $out = $mod_gestion->modificarOportunixId(null, $opo_id, null, null, null, null, null, null, null, null, null, $eopo_id, $usu_id, $oporper);
                        if ($out) {
                            $exito = 1;
                        } else {
                            $exito = 0;
                        }
                    }if ($exito) {
                        $transaction->commit();
                        $message = array(
                            "wtmessage" => Yii::t("notificaciones", "La infomación ha sido grabada. "),
                            "title" => Yii::t('jslang', 'Success'),
                        );
                        return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                    } else {
                        $transaction->rollback();
                        $message = array(
                            "wtmessage" => Yii::t("notificaciones", "Error al grabar."),
                            "title" => Yii::t('jslang', 'Success'),
                        );
                        return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                    }
                } else {
                    $transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error al grabar, el usuario autenticado no tiene permisos." . $mensaje),
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

    public function actionGuardaractactividad() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $usu_id = @Yii::$app->user->identity->usu_id;
        $fecproxima = null;
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $mod_gestion = new Oportunidad();
            $fecatiende = $data["fecatencion"] . ' ' . $data["horatencion"];
            $observacion = ucwords(strtolower($data["observacion"]));
            if (!empty($data["fecproxima"])) {
                $fecproxima = $data["fecproxima"] . ' ' . $data["horproxima"];
            }
            // Datos Generales Contacto            
            $con = \Yii::$app->db_crm;
            $transaction = $con->beginTransaction();
            try {
                $padm_class = $mod_gestion->consultarAgenteAutenticado(5);
                $padm_id = $padm_class['padm_id'];
                $act_id = base64_decode($data['bact_id']);
                if ($padm_id > 0) {
                    \app\models\Utilities::putMessageLogFile('argumentos de actualizar: ' . $act_id . "-" . $usu_id . "-" . $padm_id . "-" . $fecatiende . "-" . $observacion . "-" . $fecproxima);
                    $actividad_id = $mod_gestion->actualizarActividad($act_id, $usu_id, $padm_id, $fecatiende, $observacion, $fecproxima);
                    if ($actividad_id) {
                        $exito = 1;
                    }if ($exito) {
                        $transaction->commit();
                        $message = array(
                            "wtmessage" => Yii::t("notificaciones", "La infomación ha sido actualizada. "),
                            "title" => Yii::t('jslang', 'Success'),
                        );
                        return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                    } else {
                        $transaction->rollback();
                        $message = array(
                            "wtmessage" => Yii::t("notificaciones", "Error al grabar."),
                            "title" => Yii::t('jslang', 'Success'),
                        );
                        return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                    }
                } else {
                    $transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error al grabar, el usuario autenticado no tiene permisos." . $mensaje),
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

    public function actionExpexcel() {
        $data = Yii::$app->request->get();
        $arrSearch["agente"] = $data['agente'];
        $arrSearch["interesado"] = $data['interesado'];
        $arrSearch["f_atencion"] = $data['f_atencion'];
        $arrSearch["estado"] = $data['estado'];
        $arrData = array();
        $arrHeader = array();

        $mod_gestion = new Oportunidad();
        $arrData = $mod_gestion->consultarOportuTodas($arrSearch);
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

    public function actionCargarleads() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $mod_gestion = new Oportunidad();
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if ($data["upload_file"]) {
                if (empty($_FILES)) {
                    return json_encode(['error' => Yii::t("notificaciones", "Error to process File {file}. Try again.", ['{file}' => basename($files['name'])])]);
                   
                }
                //Recibe Parámetros
                $files = $_FILES[key($_FILES)];
                $arrIm = explode(".", basename($files['name']));
                $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                if ($typeFile == 'xlsx' || $typeFile == 'csv' || $typeFile == 'xls') {
                    $dirFileEnd = Yii::$app->params["documentFolder"] . "leads/" . $data["name_file"] . "." . $typeFile;
                    $status = Utilities::moveUploadFile($files['tmp_name'], $dirFileEnd);
                    if ($status) {
                        return true;
                    } else {
                        return json_encode(['error' => Yii::t("notificaciones", "Error to process File {file}. Try again.", ['{file}' => basename($files['name'])])]);
                       
                    }
                }
            }
            if ($data["procesar_file"]) {
                $carga_archivo = $mod_gestion->CargarArchivo($data["archivo"], $data["emp_id"], $data["tipo_proceso"]);
                if ($carga_archivo['status']) {
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Archivo procesado correctamente." . $carga_archivo['data']),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Success"), false, $message);
                } else {
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error al procesar el archivo. " . $carga_archivo['message']),
                        "title" => Yii::t('jslang', 'Error'),
                    );
                    return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), true, $message);
                }
                return;
            }
        } else {
            return $this->render('cargarleads', []);
        }
    }

    public function actionListarcontactos() {
        $per_id = @Yii::$app->session->get("PB_iduser");
        $estado_contacto = EstadoContacto::find()->select("econ_id AS id, econ_nombre AS name")->where(["econ_estado_logico" => "1", "econ_estado" => "1"])->asArray()->all();
        $modPersonaGestion = new PersonaGestion();
        $data = Yii::$app->request->get();
        if ($data['PBgetFilter']) {
            $arrSearch["search"] = $data['search'];
            $arrSearch["estado"] = $data['estado'];
            $arrSearch["fase"] = $data['fase'];
            $mod_gestion = $modPersonaGestion->consultarClienteCont($arrSearch);
            return $this->render('_listarContactosGrid', [
                        "model" => $mod_gestion,
            ]);
        } else {
            $mod_gestion = $modPersonaGestion->consultarClienteCont();
        }
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
        }
        return $this->render('listarContactos', [
                    'model' => $mod_gestion,
                    'arr_contacto' => ArrayHelper::map(array_merge([["id" => "0", "name" => "Todas"]], $estado_contacto), "id", "name"),
        ]);
    }

    public function actionListaroportxcontacto() {
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
        return $this->render('listarOportXContacto', [
                    'model' => $ListOportXContact,
                    "tipo_dni" => array("CED" => Yii::t("formulario", "DNI Document"), "PASS" => Yii::t("formulario", "Passport")),
                    'personalData' => $contactManage,
        ]);
    }

    public function actionListarcontactospendientes() {
        $per_id = @Yii::$app->session->get("PB_iduser");
        $modPersonaTemp = new PersonaTemporal();
        $data = Yii::$app->request->get();
        if ($data['PBgetFilter']) {
            $arrSearch["search"] = $data['search'];
            $modGestTemp = $modPersonaTemp->consultarClienteTemp($arrSearch);
            return $this->render('_listarContactosPendGrid', [
                        "model" => $modGestTemp,
            ]);
        } else {
            $modGestTemp = $modPersonaTemp->consultarClienteTemp();
        }
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
        }
        return $this->render('listarContactosPend', [
                    'model' => $modGestTemp,
        ]);
    }

    public function actionDetallecontacto() {
        $ptemp_id = base64_decode($_GET["ptemp_id"]);
        $per_id = Yii::$app->session->get("PB_perid");
        $user_id = Yii::$app->session->get("PB_iduser");
        $pertemp = new PersonaTemporal();
        $model_per_temp = $pertemp->consultarClienteTempById($ptemp_id);
        return $this->render('detalleContacto', [
                    "model" => $model_per_temp,
        ]);
    }

    public function actionCrearoportunidad() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $pges_id = base64_decode($_GET["pgid"]);
        $persges_mod = new PersonaGestion();
        $contactManage = $persges_mod->consultarPersonaGestion($pges_id);
        $uni_aca_model = new UnidadAcademica();
        $modalidad_model = new Modalidad();
        $modTipoOportunidad = new TipoOportunidadVenta();
        $state_oportunidad_model = new EstadoOportunidad();
        //$academic_study = new EstudioAcademico();
        $unidad_acad_data = $uni_aca_model->consultarUnidadAcademicas();
        $modalidad_data = $modalidad_model->consultarModalidad(0);
        $modcanal = new Oportunidad();
        $tipo_oportunidad_data = $modTipoOportunidad->consultarOporxUnidad(1);
        $state_oportunidad_data = $state_oportunidad_model->consultarEstadOportunidad();
        $academic_study_data = $modcanal->consultarCarreraModalidad(1, 1);
        $knowledge_channel_data = $modcanal->consultarConocimientoCanal(1);
        $empresa_mod = new Empresa();
        $empresa = $empresa_mod->getAllEmpresa();
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["getmodalidad"])) {
                $modalidad = $modalidad_model->consultarModalidad($data["nint_id"]);
                $message = array("modalidad" => $modalidad);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                
            }
            if (isset($data["getoportunidad"])) {
                $oportunidad = $modTipoOportunidad->consultarOporxUnidad($data["unidada"]);
                $message = array("oportunidad" => $oportunidad);
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
        $arr_carrerra2 = $modcanal->consultarTipoCarrera();
        $arr_subcarrera = $modcanal->consultarSubCarrera(1);
        return $this->render('crearOportunidad', [
                    'personalData' => $contactManage,
                    'arr_linea_servicio' => ArrayHelper::map($unidad_acad_data, "id", "name"),
                    'arr_modalidad' => ArrayHelper::map($modalidad_data, "id", "name"),
                    'arr_tipo_oportunidad' => ArrayHelper::map($tipo_oportunidad_data, "id", "name"),
                    'arr_state_oportunidad' => ArrayHelper::map($state_oportunidad_data, "id", "name"),
                    'arr_academic_study' => ArrayHelper::map($academic_study_data, "id", "name"),
                    "arr_knowledge_channel" => ArrayHelper::map($knowledge_channel_data, "id", "name"),
                    "tipo_dni" => array("CED" => Yii::t("formulario", "DNI Document"), "PASS" => Yii::t("formulario", "Passport")),
                    "arr_carrerra2" => ArrayHelper::map($arr_carrerra2, "id", "name"),
                    "arr_subcarrerra" => ArrayHelper::map($arr_subcarrera, "id", "name"),
                    'arr_empresa' => ArrayHelper::map($empresa, "Ids", "Nombre"),
        ]);
    }

    public function actionGuardaractuacontacto() {
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

    public function actionGuardarcontacto() {
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

    public function actionVeroportunidad() {
        //$per_id = @Yii::$app->session->get("PB_perid");
        $pges_id = base64_decode($_GET["pges_id"]);
        $opor_id = base64_decode($_GET["opor_id"]);
        $persges_mod = new PersonaGestion();
        $modoportunidad = new Oportunidad();
        $modestudio = new ModuloEstudio();
        $respOportunidad = $modoportunidad->consultarOportunidadById($opor_id);
        $resptipocarrera = $modoportunidad->consultarNombreCarrera($respOportunidad["subcarera_id"]);
        $arr_carrerra1 = $modestudio->consultarEstudioEmpresa($respOportunidad["empresa"]); // tomar id de impresa        
        $contactManage = $persges_mod->consultarPersonaGestion($pges_id);
        $uni_aca_model = new UnidadAcademica();
        $modalidad_model = new Modalidad();
        $state_oportunidad_model = new EstadoOportunidad();
        $unidad_acad_data = $uni_aca_model->consultarUnidadAcademicas();
        $modalidad_data = $modalidad_model->consultarModalidad(0);
        $modcanal = new Oportunidad();
        $tipo_oportunidad_data = TipoOportunidadVenta::find()->select("tove_id AS id, tove_nombre AS name")->where(["tove_estado_logico" => "1", "tove_estado" => "1"])->asArray()->all();
        $state_oportunidad_data = $state_oportunidad_model->consultarEstadOportunidad();
        $academic_study_data = $modcanal->consultarCarreraModalidad(1, 1);
        $knowledge_channel_data = $modcanal->consultarConocimientoCanal(1);
        $empresa_mod = new Empresa();
        $empresa = $empresa_mod->getAllEmpresa();

        return $this->render('verOportunidad', [
                    'personalData' => $contactManage,
                    'arr_linea_servicio' => ArrayHelper::map($unidad_acad_data, "id", "name"),
                    'arr_modalidad' => ArrayHelper::map($modalidad_data, "id", "name"),
                    'arr_tipo_oportunidad' => ArrayHelper::map($tipo_oportunidad_data, "id", "name"),
                    'arr_state_oportunidad' => ArrayHelper::map($state_oportunidad_data, "id", "name"),
                    'arr_academic_study' => ArrayHelper::map($academic_study_data, "id", "name"),
                    "arr_knowledge_channel" => ArrayHelper::map($knowledge_channel_data, "id", "name"),
                    "tipo_dni" => array("CED" => Yii::t("formulario", "DNI Document"), "PASS" => Yii::t("formulario", "Passport")),
                    'arr_empresa' => ArrayHelper::map($empresa, "Ids", "Nombre"),
                    'arr_oportunidad' => $respOportunidad,
                    "arr_modulo_estudio" => ArrayHelper::map($arr_carrerra1, "id", "name"),
                    "opo_id" => $opor_id,
                    "pges_id" => $pges_id,
                    "tipocarrera" => $resptipocarrera,
        ]);
    }

    public function actionActualizaroportunidad() {
        $opor_id = base64_decode($_GET["codigo"]);
        $pges_id = base64_decode($_GET["pgesid"]);
        //$per_id = @Yii::$app->session->get("PB_perid");
        $persges_mod = new PersonaGestion();
        $uni_aca_model = new UnidadAcademica();
        $modalidad_model = new Modalidad();
        $modTipoOportunidad = new TipoOportunidadVenta();
        $state_oportunidad_model = new EstadoOportunidad();
        $modoportunidad = new Oportunidad();
        $empresa_mod = new Empresa();
        $modestudio = new ModuloEstudio();
        $contactManage = $persges_mod->consultarPersonaGestion($pges_id);
        $respOportunidad = $modoportunidad->consultarOportunidadById($opor_id);
        $unidad_acad_data = $uni_aca_model->consultarUnidadAcademicas();
        $modalidad_data = $modalidad_model->consultarModalidad(0);
        $tipo_oportunidad_data = $modTipoOportunidad->consultarOporxUnidad(1);
        $state_oportunidad_data = $state_oportunidad_model->consultarEstadOportunidad();
        $academic_study_data = $modoportunidad->consultarCarreraModalidad(1, 1);
        $knowledge_channel_data = $modoportunidad->consultarConocimientoCanal(1);
        $arr_carrerra2 = $modoportunidad->consultarTipoCarrera();
        $arr_subcarrera = $modoportunidad->consultarSubCarrera(1);
        $arr_moduloEstudio = $modestudio->consultarEstudioEmpresa($respOportunidad["empresa"]); // tomar id de impresa
        $respRolPerAutentica = $modoportunidad->consultarAgenteAutenticado($per_id);
        $empresa = $empresa_mod->getAllEmpresa();
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["getmodalidad"])) {
                $modalidad = $modalidad_model->consultarModalidad($data["ninter_id"]);
                $message = array("modalidad" => $modalidad);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                
            }
            if (isset($data["getoportunidad"])) {
                $oportunidad = $modTipoOportunidad->consultarOporxUnidad($data["unidada"]);
                $message = array("oportunidad" => $oportunidad);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                
            }
            if (isset($data["getsubcarrera"])) {
                $subcarrera = $modoportunidad->consultarSubCarrera($data["car_id"]);
                $message = array("subcarrera" => $subcarrera);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                
            }
            if (isset($data["getcarrera"])) {
                if ($data["unidada"] < 3) {
                    $carrera = $modoportunidad->consultarCarreraModalidad($data["unidada"], $data["moda_id"]);
                } else {
                    $carrera = $modestudio->consultarCursoModalidad($data["unidada"], $data["moda_id"]);
                }
                $message = array("carrera" => $carrera);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
               
            }
        }

        //if (($respOportunidad["per_id"] == $per_id) || ($respRolPerAutentica["rol"] == 'SUP')) {        
        return $this->render('actualizarOportunidad', [
                    'personalData' => $contactManage,
                    'dataOportunidad' => $respOportunidad,
                    'arr_linea_servicio' => ArrayHelper::map($unidad_acad_data, "id", "name"),
                    'arr_modalidad' => ArrayHelper::map($modalidad_data, "id", "name"),
                    'arr_tipo_oportunidad' => ArrayHelper::map($tipo_oportunidad_data, "id", "name"),
                    'arr_state_oportunidad' => ArrayHelper::map($state_oportunidad_data, "id", "name"),
                    'arr_academic_study' => ArrayHelper::map($academic_study_data, "id", "name"),
                    "arr_knowledge_channel" => ArrayHelper::map($knowledge_channel_data, "id", "name"),
                    "tipo_dni" => array("CED" => Yii::t("formulario", "DNI Document"), "PASS" => Yii::t("formulario", "Passport")),
                    "arr_carrerra2" => ArrayHelper::map($arr_carrerra2, "id", "name"),
                    "arr_subcarrerra" => ArrayHelper::map($arr_subcarrera, "id", "name"),
                    'arr_empresa' => ArrayHelper::map($empresa, "Ids", "Nombre"),
                    'arr_moduloEstudio' => ArrayHelper::map($arr_moduloEstudio, "Ids", "Nombre"),
                    'opo_id' => $opor_id,
                    'pges_id' => $pges_id,
                        //'per_id' => $per_id,
        ]);
 
    }

}
