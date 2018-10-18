<?php

namespace app\controllers;

use Yii;
use app\models\Utilities;
use yii\helpers\ArrayHelper;
use yii\base\Exception;
use app\models\Persona;
use app\models\EmpresaPersona;
use \app\modules\admision\models\SolicitudInscripcion;
use app\models\Pais;
use app\modules\admision\models\Interesado;
use app\modules\admision\models\InteresadoEmpresa;
use app\models\Usuario;
use yii\base\Security;
use app\models\UsuaGrolEper;
use app\models\Provincia;
use app\modules\financiero\models\OrdenPago;
use app\modules\financiero\models\DetalleDescuentoItem;
use app\models\Canton;
use app\models\MedioPublicitario;
use app\modules\academico\models\Modalidad;
use app\modules\academico\models\UnidadAcademica;
use yii\helpers\Url;
use app\modules\admision\models\PersonaGestion;
use app\modules\admision\models\Oportunidad;
use app\models\Empresa;
use app\modules\admision\models\TipoOportunidadVenta;
use app\modules\admision\models\EstadoContacto;
use app\modules\admision\models\MetodoIngreso;
use app\modules\financiero\models\Secuencias;
use app\models\InscripcionAdmision;

class InscripcionadmisionController extends \yii\web\Controller {

    public function init() {
        if (!is_dir(Yii::getAlias('@bower')))
            Yii::setAlias('@bower', '@vendor/bower-asset');
        return parent::init();
    }

    public function actionIndex() {
        $this->layout = '@themes/' . \Yii::$app->getView()->theme->themeName . '/layouts/basic.php';
        $per_id = Yii::$app->session->get("PB_perid");
        $mod_persona = Persona::findIdentity($per_id);
        $mod_modalidad = new Modalidad();
        $mod_pergestion = new PersonaGestion();
        $mod_unidad = new UnidadAcademica();
        $modcanal = new Oportunidad();
        $mod_metodo = new MetodoIngreso();
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
                //obtener el codigo de area del pais
                $mod_areapais = new Pais();
                $area = $mod_areapais->consultarCodigoArea($data["codarea"]);
                $message = array("area" => $area);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }

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
            if (isset($data["getmetodo"])) {
                $metodos = $mod_metodo->consultarMetodoUnidadAca_2($data['nint_id']);
                $message = array("metodos" => $metodos);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
        }
        $arr_pais_dom = Pais::find()->select("pai_id AS id, pai_nombre AS value")->where(["pai_estado_logico" => "1", "pai_estado" => "1"])->asArray()->all();
        $pais_id = 1; //Ecuador
        $arr_prov_dom = Provincia::provinciaXPais($pais_id);
        $arr_ciu_dom = Canton::cantonXProvincia($arr_prov_dom[0]["id"]);
        $arr_medio = MedioPublicitario::find()->select("mpub_id AS id, mpub_nombre AS value")->where(["mpub_estado_logico" => "1", "mpub_estado" => "1"])->asArray()->all();
        $arr_ninteres = $mod_unidad->consultarUnidadAcademicasEmpresa(1);
        $arr_modalidad = $mod_modalidad->consultarModalidad(1, 1);
        $arr_conuteg = $mod_pergestion->consultarConociouteg();
        $arr_carrerra1 = $modcanal->consultarCarreraModalidad(1, 1);
        $arr_metodos = $mod_metodo->consultarMetodoUnidadAca_2($arr_ninteres[0]["id"]);
        $_SESSION['JSLANG']['Your information has not been saved. Please try again.'] = Yii::t('notificaciones', 'Your information has not been saved. Please try again.');

        return $this->render('index', [
                    "tipos_dni" => array("CED" => Yii::t("formulario", "DNI Document"), "PASS" => Yii::t("formulario", "Passport")),
                    "tipos_dni2" => array("CED" => Yii::t("formulario", "DNI Document1"), "PASS" => Yii::t("formulario", "Passport1")),
                    "txth_extranjero" => $mod_persona->per_nac_ecuatoriano,
                    "arr_pais_dom" => ArrayHelper::map($arr_pais_dom, "id", "value"),
                    "arr_prov_dom" => ArrayHelper::map($arr_prov_dom, "id", "value"),
                    "arr_ciu_dom" => ArrayHelper::map($arr_ciu_dom, "id", "value"),
                    "arr_ninteres" => ArrayHelper::map($arr_ninteres, "id", "name"),
                    "arr_medio" => ArrayHelper::map($arr_medio, "id", "value"),
                    "arr_modalidad" => ArrayHelper::map($arr_modalidad, "id", "name"),
                    "arr_conuteg" => ArrayHelper::map($arr_conuteg, "id", "name"),
                    "arr_carrerra1" => ArrayHelper::map($arr_carrerra1, "id", "name"),
                    "arr_metodos" => ArrayHelper::map($arr_metodos, "id", "name"),
        ]);                        
    }


    public function actionGuardarinscripcion() {
        $error = 0;
        if (Yii::$app->request->isAjax) {
            $pgest = Yii::$app->request->post();
            $data = Yii::$app->request->post();
            $con = \Yii::$app->db_asgard;
            $con1 = \Yii::$app->db_captacion;
            $con2 = \Yii::$app->db_facturacion;
            $transaction = $con->beginTransaction();
            $transaction1 = $con1->beginTransaction();
            $transaction2 = $con2->beginTransaction();
            try {
                // He colocado al inicio la informacion para que cargue al principio
                $emp_id = 1;
                $identificacion = '';
                if (isset($pgest['pges_cedula']) && strlen($pgest['pges_cedula']) > 0) {
                    $identificacion = $pgest['pges_cedula'];
                } else {
                    $identificacion = $pgest['pges_pasaporte'];
                }
                if (isset($identificacion) && strlen($identificacion) > 0) {
                    $id_persona = 0;
                    $mod_persona = new Persona();
                    $keys_per = [
                        'per_pri_nombre', 'per_seg_nombre', 'per_pri_apellido', 'per_seg_apellido', 'per_cedula', 'etn_id', 'eciv_id', 'per_genero', 'pai_id_nacimiento', 'pro_id_nacimiento', 'can_id_nacimiento', 'per_fecha_nacimiento', 'per_celular', 'per_correo', 'tsan_id', 'per_domicilio_sector', 'per_domicilio_cpri', 'per_domicilio_csec', 'per_domicilio_num', 'per_domicilio_ref', 'per_domicilio_telefono', 'pai_id_domicilio', 'pro_id_domicilio', 'can_id_domicilio', 'per_nac_ecuatoriano', 'per_nacionalidad', 'per_foto', 'per_estado', 'per_estado_logico'
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
                    \app\models\Utilities::putMessageLogFile('va a proceder a ingresar la informacion');
                    $id_persona = $mod_persona->consultarIdPersona($pgest['pges_cedula'], $pgest['pges_pasaporte']);
                    if ($id_persona == 0) {
                        $id_persona = $mod_persona->insertarPersona($con, $parametros_per, $keys_per, 'persona');
                    }
                    if ($id_persona > 0) {
                        \app\models\Utilities::putMessageLogFile('ingreso la Persona');
                        $concap = \Yii::$app->db_captacion;
                        $mod_emp_persona = new EmpresaPersona();
                        $keys = ['emp_id', 'per_id', 'eper_estado', 'eper_estado_logico'];
                        $parametros = [$emp_id, $id_persona, 1, 1];
                        $emp_per_id = $mod_emp_persona->consultarIdEmpresaPersona($id_persona, $emp_id);
                        if ($emp_per_id == 0) {
                            $emp_per_id = $mod_emp_persona->insertarEmpresaPersona($con, $parametros, $keys, 'empresa_persona');
                        }
                        if ($emp_per_id > 0) {
                            \app\models\Utilities::putMessageLogFile('ingreso la empresa Persona');
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
                                \app\models\Utilities::putMessageLogFile('ingreso el usuario');
                                $mod_us_gr_ep = new UsuaGrolEper();
                                $grol_id = 30;
                                $keys = ['eper_id', 'usu_id', 'grol_id', 'ugep_estado', 'ugep_estado_logico'];
                                $parametros = [$emp_per_id, $usuario_id, $grol_id, 1, 1];
                                $us_gr_ep_id = $mod_us_gr_ep->consultarIdUsuaGrolEper($emp_per_id, $usuario_id, $grol_id);
                                if ($us_gr_ep_id == 0)
                                    $us_gr_ep_id = $mod_us_gr_ep->insertarUsuaGrolEper($con, $parametros, $keys, 'usua_grol_eper');
                                if ($us_gr_ep_id > 0) {
                                    \app\models\Utilities::putMessageLogFile('ingreso el usuario grol');
                                    $mod_interesado = new Interesado(); // se guarda con estado_interesado 1
                                    $interesado_id = $mod_interesado->consultaInteresadoById($id_persona);
                                    $keys = ['per_id', 'int_estado_interesado', 'int_usuario_ingreso', 'int_estado', 'int_estado_logico'];
                                    $parametros = [$id_persona, 1, $usuario_id, 1, 1];
                                    if ($interesado_id == 0) {
                                        $interesado_id = $mod_interesado->insertarInteresado($concap, $parametros, $keys, 'interesado');
                                    }
                                    if ($interesado_id > 0) {
                                        \app\models\Utilities::putMessageLogFile('ingreso el interesado');
                                        $mod_inte_emp = new InteresadoEmpresa(); // se guarda con estado_interesado 1
                                        $iemp_id = $mod_inte_emp->consultaInteresadoEmpresaById($interesado_id, $emp_id);
                                        if ($iemp_id == 0) {
                                            $iemp_id = $mod_inte_emp->crearInteresadoEmpresa($interesado_id, $emp_id, $usuario_id);
                                        }
                                        if ($iemp_id > 0) {
                                            $eaca_id = NULL;
                                            $mest_id = NULL;
                                            if ($emp_id == 1) {//Uteg 
                                                $eaca_id = $pgest['carrera'];
                                            } elseif ($emp_id == 2 || $emp_id == 3) {
                                                $mest_id = $pgest['carrera'];
                                            }
                                            $num_secuencia = Secuencias::nuevaSecuencia($con, $emp_id, 1, 1, 'SOL');
                                            $sins_fechasol = date(Yii::$app->params["dateTimeByDefault"]);
                                            $rsin_id = 1; //Solicitud pendiente     
                                            $solins_model = new SolicitudInscripcion();
                                            $mensaje = 'intId: ' . $interesado_id . '/uaca: ' . $pgest['unidad_academica'] . '/modalidad: ' . $pgest['modalidad'] . '/ming: ' . $pgest['ming_id'] . '/eaca: ' . $eaca_id . '/mest: ' . $mest_id . '/empresa: ' . $emp_id . '/secuencia: ' . $num_secuencia . '/rsin_id: ' . $rsin_id . '/sins_fechasol: ' . $sins_fechasol . '/usuario_id: ' . $usuario_id;
                                            $sins_id = $solins_model->insertarSolicitud($interesado_id, $pgest['unidad_academica'], $pgest['modalidad'], $pgest['ming_id'], $eaca_id, null, $emp_id, $num_secuencia, $rsin_id, $sins_fechasol, $usuario_id);
                                            //fin de solicitud inscripcion$mest_id
                                            //grabar los documentos
                                            \app\models\Utilities::putMessageLogFile('solicitud: ' . $mensaje);
                                            if ($sins_id) {
                                                \app\models\Utilities::putMessageLogFile('ingreso la solicitud: ' . $sins_id);
                                                                                            
                                                //Obtener el precio de la solicitud.
                                                if ($beca == "1") {
                                                    $precio = 0;
                                                } else {
                                                    $resp_precio = $solins_model->ObtenerPrecio($pgest['ming_id'], $pgest['unidad_academica'], $pgest['modalidad'], $eaca_id);
                                                    if ($resp_precio) {
                                                        $precio = $resp_precio['precio'];
                                                    } else {
                                                        $mensaje = 'No existe registrado ningún precio para la unidad, modalidad y método de ingreso seleccionada.';
                                                        $errorprecio = 0;
                                                    }
                                                }
                                                $mod_ordenpago = new OrdenPago();
                                                //Se verifica si seleccionó descuento.
                                                $val_descuento = 0;
                                                if (!empty($descuento)) {
                                                    $modDescuento = new DetalleDescuentoItem();
                                                    $respDescuento = $modDescuento->consultarValdctoItem($descuento);
                                                    if ($respDescuento) {
                                                        if ($precio == 0) {
                                                            $val_descuento = 0;
                                                        } else {
                                                            if ($respDescuento["ddit_tipo_beneficio"] == 'P') {
                                                                $val_descuento = ($precio * ($respDescuento["ddit_porcentaje"])) / 100;
                                                            } else {
                                                                $val_descuento = $respDescuento["ddit_valor"];
                                                            }
                                                            //Insertar solicitud descuento
                                                            if ($val_descuento > 0) {
                                                                $resp_SolicDcto = $mod_ordenpago->insertarSolicDscto($sins_id, $descuento, $precio, $respDescuento["ddit_porcentaje"], $respDescuento["ddit_valor"]);
                                                            }
                                                        }
                                                    }
                                                }
                                                //Generar la orden de pago con valor correspondiente. Buscar precio para orden de pago.                                                                     
                                                if ($precio == 0) {
                                                    $estadopago = 'S';
                                                } else {
                                                    $estadopago = 'P';
                                                }
                                                $val_total = $precio - $val_descuento;
                                                $resp_opago = $mod_ordenpago->insertarOrdenpago($sins_id, null, $val_total, 0, $val_total, $estadopago, $usuario_id);
                                                if ($resp_opago) {
                                                    //insertar desglose del pago                                    
                                                    $fecha_ini = date(Yii::$app->params["dateByDefault"]);
                                                    \app\models\Utilities::putMessageLogFile('orden pago: '.$resp_opago);
                                                    $resp_dpago = $mod_ordenpago->insertarDesglosepago($resp_opago, $val_total, 0, $val_total, $fecha_ini, null, $estadopago, $usuario_id);
                                                    if ($resp_dpago) {
                                                        $exito = 1;
                                                        \app\models\Utilities::putMessageLogFile('desgloce pago: '.$resp_dpago);
                                                        $usuarioNew = Usuario::findIdentity($usuario_id);
                                                        $link = $usuarioNew->generarLinkActivacion();
                                                        $email_info = array(
                                                            "nombres" => $pgest['pges_pri_nombre'] . " " . $pgest['pges_seg_nombre'],
                                                            "apellidos" => $pgest['pges_pri_apellido'] . " " . $pgest['pges_seg_apellido'],
                                                            "correo" => $pgest['pges_correo'],
                                                            "telefono" => isset($pgest['pges_celular']) ? $pgest['pges_celular'] : $pgest['pges_domicilio_telefono'],
                                                            "identificacion" => isset($pgest['pges_cedula']) ? $pgest['pges_cedula'] : $pgest['pges_pasaporte'],
                                                            "link_asgard" => $link,
                                                        );
                                                        \app\models\Utilities::putMessageLogFile('ingreso el email');
                                                        if ($pgest['unidad_academica'] == 1 and ( $pgest['modalidad'] == 1)) {
                                                            $file1 = Url::base(true) . "/files/Mailing-UTEG-Online.jpg";
                                                            $rutaFile = array($file1);
                                                        } else {
                                                            if ($pgest['unidad_academica'] == 1 and ( $pgest['modalidad'] != 1)) {
                                                                $file1 = Url::base(true) . "/files/Mailing-UTEG-Grado.jpg";
                                                                $rutaFile = array($file1);
                                                            } else {
                                                                if ($pgest['unidad_academica'] == 2) {
                                                                    $file1 = Url::base(true) . "/files/Mailing-UTEG-Posgrado.jpg";
                                                                    $rutaFile = array($file1);
                                                                }
                                                            }
                                                        }
                                                        $tituloMensaje = Yii::t("interesado", "UTEG - Registration");
                                                        $asunto = Yii::t("interesado", "UTEG - Registration Online");
                                                        $body = Utilities::getMailMessage("PaidApplyment", array(), Yii::$app->language);
                                                        Utilities::sendEmail($tituloMensaje, Yii::$app->params["admisiones"], // a quien se envia el correo
                                                                [$email_info['correo'] => $email_info['nombres'] . " " . $email_info['apellidos']], // quien envia el correo
                                                                $asunto, $file1);
                                                        // Fin de funcionalidad de enviar correo                                            
                                                        \app\models\Utilities::putMessageLogFile('mensaje final:' . $exito);
                                                    }
                                                }
                                            }
                                        } else {
                                            $error_message .= Yii::t("formulario", "The enterprise interested hasn't been saved");
                                            $error++;
                                        }
                                    } else {
                                        $error_message .= Yii::t("formulario", "The interested person hasn't been saved");
                                        $error++;
                                    }
                                } else {
                                    $error_message .= Yii::t("formulario", "The rol user have not been saved");
                                    $error++;
                                }
                            } else {
                                $error_message .= Yii::t("formulario", "The user have not been saved");
                                $error++;
                            }
                        } else {
                            $error_message .= Yii::t("formulario", "The enterprise interested hasn't been saved");
                            $error++;
                        }
                    } else {
                        $error++;
                        $error_message .= Yii::t("formulario", "The person have not been saved");
                    }
                } else {
                    $error_message .= Yii::t("formulario", "Update DNI to generate interested");
                    $error++;
                }

                if ($exito == 1) {
                    //$transaction->commit();                    
                    $transaction1->commit();
                    $transaction2->commit();

                    $message = array(
                        "wtmessage" => Yii::t("formulario", "The information have been saved and the information has been sent to your email"),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                } else {
                    //$transaction->rollback();
                    //$transaction1->rollback();
                    //$transaction2->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("formulario", "Mensaje1: " . $mensaje), //$error_message
                        "title" => Yii::t('jslang', 'Bad Request'),
                    );
                    return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Bad Request"), false, $message);
                }
            } catch (Exception $ex) {
                //$transaction->rollback();
                //$transaction1->rollback();
                //$transaction2->rollback();
                $message = array(
                    "wtmessage" => Yii::t("formulario", "Mensaje2: " . $mensaje), //$error_message
                    "title" => Yii::t('jslang', 'Bad Request'),
                );
                return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Bad Request"), false, $message);
            }
            return;
        }
    }
            
     
     public function actionSaveinscripciontemp() {
        if (Yii::$app->request->isAjax) {
            $model = new InscripcionAdmision();
            $data = Yii::$app->request->post();
            $accion = isset($data['ACCION']) ? $data['ACCION'] : "";
            \app\models\Utilities::putMessageLogFile('ha llegado a este controlador');
            if ($data["upload_file"]) {
                if (empty($_FILES)) {
                    return json_encode(['error' => Yii::t("notificaciones", "Error to process File {file}. Try again.", ['{file}' => basename($files['name'])])]);
                }
                //Recibe Parámetros.
                $inscripcion_id = $data["inscripcion_id"];
                $files = $_FILES[key($_FILES)];
                $arrIm = explode(".", basename($files['name']));
                $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                $dirFileEnd = Yii::$app->params["documentFolder"] . "solicitudadmision/" . $inscripcion_id . "/" . $data["name_file"] . "_inscr_" . $inscripcion_id . "." . $typeFile;
                $status = Utilities::moveUploadFile($files['tmp_name'], $dirFileEnd);
                if ($status) {
                    return true;
                } else {
                    return json_encode(['error' => Yii::t("notificaciones", "Error to process File {file}. Try again.", ['{file}' => basename($files['name'])])]);
                }
                $titulo_archivo = "";
                if (isset($data["arc_doc_titulo"]) && $data["arc_doc_titulo"] != "") {
                    $arrIm = explode(".", basename($data["arc_doc_titulo"]));
                    $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                    $titulo_archivo = Yii::$app->params["documentFolder"] . "solicitudadmision/" . $inscripcion_id . "/doc_titulo_per_" . $inscripcion_id . "." . $typeFile;
                }
                $dni_archivo = "";
                if (isset($data["arc_doc_dni"]) && $data["arc_doc_dni"] != "") {
                    $arrIm = explode(".", basename($data["arc_doc_dni"]));
                    $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                    $dni_archivo = Yii::$app->params["documentFolder"] . "solicitudadmision/" . $inscripcion_id . "/doc_dni_per_" . $inscripcion_id . "." . $typeFile;
                }
                $certvota_archivo = "";
                if (isset($data["arc_doc_certvota"]) && $data["arc_doc_certvota"] != "") {
                    $arrIm = explode(".", basename($data["arc_doc_certvota"]));
                    $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                    $certvota_archivo = Yii::$app->params["documentFolder"] . "solicitudadmision/" . $inscripcion_id . "/doc_certvota_per_" . $inscripcion_id . "." . $typeFile;
                }
                $foto_archivo = "";
                if (isset($data["arc_doc_foto"]) && $data["arc_doc_foto"] != "") {
                    $arrIm = explode(".", basename($data["arc_doc_foto"]));
                    $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                    $foto_archivo = Yii::$app->params["documentFolder"] . "solicitudadmision/" . $inscripcion_id . "/doc_foto_per_" . $inscripcion_id . "." . $typeFile;
                }
            }

            $timeSt = time();
            try {
                if (isset($data["arc_doc_titulo"]) && $data["arc_doc_titulo"] != "") {
                    $arrIm = explode(".", basename($data["arc_doc_titulo"]));
                    $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                    $titulo_archivoOld = Yii::$app->params["documentFolder"] . "solicitudadmision/" . $inscripcion_id . "/doc_titulo_per_" . $inscripcion_id . "." . $typeFile;
                    $titulo_archivo = InscripcionAdmision::addLabelTimeDocumentos($inscripcion_id, $titulo_archivoOld, $timeSt);
                    if ($titulo_archivo === false)
                        throw new Exception('Error doc Titulo no renombrado.');
                }
                if (isset($data["arc_doc_dni"]) && $data["arc_doc_dni"] != "") {
                    $arrIm = explode(".", basename($data["arc_doc_dni"]));
                    $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                    $dni_archivoOld = Yii::$app->params["documentFolder"] . "solicitudadmision/" . $inscripcion_id . "/doc_dni_per_" . $inscripcion_id . "." . $typeFile;
                    $dni_archivo = InscripcionAdmision::addLabelTimeDocumentos($inscripcion_id, $dni_archivoOld, $timeSt);
                    if ($dni_archivo === false)
                        throw new Exception('Error doc Dni no renombrado.');
                }
                if (isset($data["arc_doc_certvota"]) && $data["arc_doc_certvota"] != "") {
                    $arrIm = explode(".", basename($data["arc_doc_certvota"]));
                    $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                    $certvota_archivoOld = Yii::$app->params["documentFolder"] . "solicitudadmision/" . $inscripcion_idper_id . "/doc_certvota_per_" . $inscripcion_id . "." . $typeFile;
                    $certvota_archivo = InscripcionAdmision::addLabelTimeDocumentos($inscripcion_id, $certvota_archivoOld, $timeSt);
                    if ($certvota_archivo === false)
                        throw new Exception('Error doc certificado vot. no renombrado.');
                }
                if (isset($data["arc_doc_foto"]) && $data["arc_doc_foto"] != "") {
                    $arrIm = explode(".", basename($data["arc_doc_foto"]));
                    $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                    $foto_archivoOld = Yii::$app->params["documentFolder"] . "solicitudadmision/" . $inscripcion_id . "/doc_foto_per_" . $inscripcion_id . "." . $typeFile;
                    $foto_archivo = InscripcionAdmision::addLabelTimeDocumentos($inscripcion_id, $foto_archivoOld, $timeSt);
                    if ($foto_archivo === false)
                        throw new Exception('Error doc Foto no renombrado.');
                }
                
                
                if ($accion == "create" || $accion == "Create") {
                    //Nuevo Registro
                    $resul = $model->insertarInscripcion($data);
                }else if($accion == "Update"){
                    //Modificar Registro
                    $resul = $model->actualizarInscripcion($data);                
                }
                if ($resul['status']) {
                    $message = array(
                        "wtmessage" => Yii::t("formulario", "The information have been saved"),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message,$resul);

                }else{
                    $message = array(
                        "wtmessage" => Yii::t("formulario", "The information have not been saved"),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return  Utilities::ajaxResponse('NO_OK', 'alert', Yii::t('jslang', 'Error'), 'false', $message,$resul);
                }
                return;

            }catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => $ex->getMessage(),
                    "title" => Yii::t('jslang', 'Error'),
                );
                return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), false, $message);
            }
        }   
    }

}
