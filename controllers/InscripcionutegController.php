<?php

namespace app\controllers;

use Yii;
use app\models\MetodoIngreso;
use app\models\Utilities;
use yii\helpers\ArrayHelper;
use yii\base\Exception;
use yii\base\Security;
use app\models\NivelInteres;
use app\models\Persona;
use app\models\Pais;
use app\models\Provincia;
use app\models\Canton;
use app\models\Carrera;
use app\models\MedioPublicitario;
use app\models\SolicitudCaptacion;
use app\models\Usuario;
use app\models\PreInteresado;
use yii\helpers\Url;

class InscripcionutegController extends \yii\web\Controller {

    public function actionIndex() {
        $this->layout = '@themes/' . \Yii::$app->getView()->theme->themeName . '/layouts/basic.php';
        $mod_metodo = new MetodoIngreso();
        $per_id = Yii::$app->session->get("PB_perid");
        $mod_persona = Persona::findIdentity($per_id);
        $mod_pais = new Pais();

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

            if (isset($data["getmetodo"])) {
                $metodos = $mod_metodo->obtenerMetodoIngXNivelInt($data['nint_id']);
                $message = array("metodos" => $metodos);
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }

            if (isset($data["getarea"])) {
                //obtener el codigo de area del pais              
                $area = $mod_pais->consultarCodigoArea($data["codarea"]);
                $message = array("area" => $area);
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }
        }
        $arr_pais_dom = Pais::find()->select("pai_id AS id, pai_nombre AS value")->where(["pai_estado_logico" => "1", "pai_estado" => "1"])->asArray()->all();
        $pais_id = 57; //Ecuador
        $arr_prov_dom = Provincia::provinciaXPais($pais_id);
        $arr_ciu_dom = Canton::cantonXProvincia($arr_prov_dom[0]["id"]);
        $mod_carrera = new Carrera();
        $fac_id = 1;
        $arr_ninteres = NivelInteres::find()->select("nint_id AS id, nint_nombre AS name")->where(["nint_estado_logico" => "1", "nint_estado" => "1"])->asArray()->all();
        $arr_metodos = $mod_metodo->obtenerMetodoIngXNivelInt(2);
        $arr_medio = MedioPublicitario::find()->select("mpub_id AS id, mpub_nombre AS value")->where(["mpub_estado_logico" => "1", "mpub_estado" => "1"])->asArray()->all();

        return $this->render('index', [
                    "tipos_dni" => array("CED" => Yii::t("formulario", "DNI Document"), "PASS" => Yii::t("formulario", "Passport")),
                    "tipos_dni2" => array("CED" => Yii::t("formulario", "DNI Document1"), "PASS" => Yii::t("formulario", "Passport1")),
                    "txth_extranjero" => $mod_persona->per_nac_ecuatoriano,
                    "arr_pais_dom" => ArrayHelper::map($arr_pais_dom, "id", "value"),
                    "arr_prov_dom" => ArrayHelper::map($arr_prov_dom, "id", "value"),
                    "arr_ciu_dom" => ArrayHelper::map($arr_ciu_dom, "id", "value"),
                    "arr_ninteres" => ArrayHelper::map($arr_ninteres, "id", "name"),
                    "arr_metodos" => ArrayHelper::map($arr_metodos, "id", "name"),
                    "arr_medio" => ArrayHelper::map($arr_medio, "id", "value"),
        ]);
    }

    public function actionGuardarinscripcion() {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $pri_nombre = $data["pri_nombre"];
            $pri_apellido = $data["pri_apellido"];
            $tipo_dni = $data["tipo_dni"];
            $cedula = $data["cedula"];
            $correo = $data["correo"];
            $pais = $data["pais"];
            $celular = $data["celular"];
            $carrera = $data["carrera"];
            $mediopub = $data["medio"];
            $pasaporte = $data["pasaporte"];
            $con = \Yii::$app->db;
            $transaction = $con->beginTransaction();
            try {
                $mod_personapreins = new \app\models\PersonaPreins();
                // obtener nacionalidad y codigo de area
                $arr_region = $mod_personapreins->consultaDatosRegion($pais);
                $paisvive = $arr_region["pai_nombre"];
                $mod_personapreins->ppre_pri_nombre = ucwords(strtolower($pri_nombre));
                $mod_personapreins->ppre_pri_apellido = ucwords(strtolower($pri_apellido));
                if ($tipo_dni == "CED") {
                    $dnis = "Cédula";
                    $numidentificacion = $cedula;
                    $mod_personapreins->ppre_cedula = $cedula;
                } elseif ($tipo_dni == "PASS") {
                    $dnis = "Pasaporte";
                    $numidentificacion = $pasaporte;
                    $mod_personapreins->ppre_pasaporte = $pasaporte;
                    $mod_personapreins->ppre_cedula = $pasaporte;
                }
                $mod_personapreins->ppre_nacionalidad = $arr_region["pai_nacionalidad"];
                $mod_personapreins->pai_id_nacimiento = $pais;
                $mod_personapreins->pai_id_domicilio = $pais;
                $mod_personapreins->ppre_celular = $celular;
                $mod_personapreins->ppre_correo = strtolower($correo);
                $mod_personapreins->ppre_tipo_formulario = 'Ot';
                $mod_personapreins->ppre_fecha_registro = date("Y-m-d H:i:s");
                $mod_personapreins->ppre_estado = "1";
                $mod_personapreins->ppre_estado_logico = "1";

                //si existe el registro en persona no permitir registrar.
                $mod_persona = new \app\models\Persona();
                $existe_persona = $mod_persona->ConsultaRegistroExiste(strtolower($correo), $cedula, $pasaporte);
                $username = $existe_persona["per_correo"];
                $dni = $existe_persona["per_cedula"];
                if ($existe_persona["existen"] == 0) {
                    // si existe la cedula o el correo no crea registro en persona_preins               
                    $existe_interesado = $mod_personapreins->ConsultaRegistropreins($cedula, $pasaporte);
                    $ppre_id = $existe_interesado["ppre_id"];
                    if (empty($cedula)) {
                        $pass = $pasaporte;
                    } else {
                        $pass = $cedula;
                    }
                    if (!$existe_interesado["ppre_id"]) {
                        //Verificar que el correo no exista en persona_preins
                        $existecorreo = $mod_personapreins->ConsultaRegistropreinscorreo(strtolower($correo));
                        if (!$existecorreo) {
                            if ($mod_personapreins->save()) {
                                $per_id = $mod_personapreins->ppre_id;
                                $exito = 1;
                            } else {
                                $transaction->rollback();
                                throw new Exception('Error, persona no creada.');
                            }
                        } else {
                            $transaction->rollback();
                            throw new Exception('Error, email ya se encuentra registrado en otra persona.');
                        }
                    } else {
                        //Verificar que no exista otro registro con el mismo correo.
                        $existecorreo = $mod_personapreins->ConsultaRegistropreinscorreo(strtolower($correo));
                        if (($ppre_id == $existecorreo["ppre_id"]) or ( !$existecorreo)) {
                            //Actualizar la preinscripción.     
                            $resp_personapreins = $mod_personapreins->actualizaPreinscripcion($ppre_id, ucwords(strtolower($pri_nombre)), ucwords(strtolower($pri_apellido)), $mod_personapreins->ppre_nacionalidad, $pais, $pais, $celular, strtolower($correo));
                            if ($resp_personapreins) {
                                $per_id = $ppre_id;
                                $exito = 1;
                            } else {
                                $transaction->rollback();
                                throw new Exception('Error al actualizar la pre-inscripción.' . $ppre_id);
                            }
                        } else {  //existe correo con otro ppre_id                            
                            $transaction->rollback();
                            throw new Exception('Error, email ya se encuentra registrado en otra persona.');
                        }
                    }
                    // generar link de verificación.
                    if ($exito == 1) {
                        $link = Url::base(true) . "/inscripcion/crear?ppre_id=" . base64_encode($per_id);
                        // array de files
                        $file1 = Url::base(true) . "/files/archivo.pdf";
                        $rutaFile = array($file1);
                        $link_asgard = Url::base(true) . "/site/login";
                        // enviar correo electrónico para activacion de cuenta.
                        $nombres = $pri_nombre . " " . $pri_apellido;
                        $tituloMensaje = Yii::t("register", "Successful Registration");
                        $asunto = Yii::t("register", "User Register") . " " . Yii::$app->params["siteName"];
                        $asunto1 = Yii::t("interesado", "New Register");
                        $tituloMensaje1 = Yii::t("interesado", "New Register");
                        $body = Utilities::getMailMessage("register", array(
                                    "[[primer_nombre]]" => $mod_personapreins->ppre_pri_nombre,
                                    "[[primer_apellido]]" => $mod_personapreins->ppre_pri_apellido,
                                    "[[dni]]" => $dnis,
                                    "[[numero_dni]]" => $numidentificacion,
                                    "[[pais]]" => $paisvive,
                                    "[[celular]]" => $celular,
                                    "[[mail]]" => $mod_personapreins->ppre_correo,
                                    "[[user]]" => $nombres, "[[username]]" => $mod_personapreins->ppre_correo,
                                    "[[link_verification]]" => $link), Yii::$app->language);
                        $bodyjefe = Utilities::getMailMessage("Reviewadmissions", array("[[link_asgard]]" => $link_asgard), Yii::$app->language);
                        Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [$mod_personapreins->ppre_correo => $pri_apellido . " " . $pri_nombre], $asunto, $body, $rutaFile);
                        Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [Yii::$app->params["soporteEmail"] => "Soporte"], $asunto, $body);
                        Utilities::sendEmail($tituloMensaje1, Yii::$app->params["adminEmail"], [Yii::$app->params["admisiones"] => "Jefe"], $asunto1, $bodyjefe);

                        $transaction->commit();
                        $message = array(
                            "wtmessage" => Yii::t("notificaciones", "La infomación ha sido grabada. Por favor para activar su cuenta revise su correo electrónico y siga los pasos."),
                            "title" => Yii::t('jslang', 'Success'),
                        );
                        echo Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                    }
                } else {
                    //envío de correo con los datos del acceso.
                    $link_asgard = Url::base(true) . "/site/login";
                    $usuario = ucwords(strtolower($pri_nombre)) . " " . ucwords(strtolower($pri_apellido));
                    $tituloMensaje = Yii::t("register", "Existing Record");
                    $asunto = Yii::t("register", "User Register") . " " . Yii::$app->params["siteName"];
                    $body = Utilities::getMailMessage("useraccess", array("[[link_asgard]]" => $link_asgard, "[[usuario]]" => $usuario, "[[username]]" => $username, "[[dni]]" => $dni), Yii::$app->language);
                    Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [$username => $usuario], $asunto, $body);
                    Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [Yii::$app->params["soporteEmail"] => "Soporte"], $asunto, $body);
                    $transaction->rollback();
                    throw new Exception('Error, número de identificación o email ya registrado. Verifique su correo, se ha enviado información de su registro. ');
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => $ex->getMessage(), //Yii::t("notificaciones", "Error al grabar."),
                    "title" => Yii::t('jslang', 'Error'),
                );
                echo Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), true, $message);
            }
        }
    }

    public function actionCrear() {
        $data = Yii::$app->request->get();
        $ppre_id = base64_decode($_GET["ppre_id"]);

        $con = \Yii::$app->db;
        $transaction = $con->beginTransaction();
        try {
            $mod_persona_preins = new \app\models\PersonaPreins();
            $resp_perpreins = $mod_persona_preins->encuentraPersonapreins($ppre_id);
            if ($resp_perpreins) {
                $mod_persona = new \app\models\Persona();
                // obtener nacionalidad y codigo de area
                $arr_region = $mod_persona->consultaDatosRegion($resp_perpreins["pais_nac"]);
                $mod_persona = new \app\models\Persona();
                $mod_persona->per_pri_nombre = ucwords(strtolower($resp_perpreins["pri_nombre"]));
                $mod_persona->per_pri_apellido = ucwords(strtolower($resp_perpreins["pri_apellido"]));
                if (empty($resp_perpreins["pasaporte"])) {
                    $tipo_dni = "CED";
                } else {
                    $tipo_dni = "PASS";
                }

                if ($tipo_dni == "CED") {
                    $mod_persona->per_cedula = $resp_perpreins["cedula"];
                } elseif ($tipo_dni == "PASS") {
                    $mod_persona->per_pasaporte = $resp_perpreins["pasaporte"];
                    $mod_persona->per_cedula = $resp_perpreins["pasaporte"];
                }
                $mod_persona->per_nacionalidad = $arr_region["pai_nacionalidad"];
                $mod_persona->pai_id_nacimiento = $resp_perpreins["pais_nac"];
                $mod_persona->pai_id_domicilio = $resp_perpreins["pais"];
                $mod_persona->per_celular = $resp_perpreins["celular"];
                $mod_persona->per_correo = strtolower($resp_perpreins["correo"]);
                $mod_persona->per_estado = "1";
                $mod_persona->per_estado_logico = "1";
                $correo = $resp_perpreins["correo"];
                $cedula = $resp_perpreins["cedula"];
                $pasaporte = $resp_perpreins["pasaporte"];

                // si existe la cedula o el correo no crea registro                
                $existe_interesado = $mod_persona->ConsultaRegistroExiste(strtolower($correo), $cedula, $pasaporte);
                if (empty($cedula)) {
                    $pass = $pasaporte;
                } else {
                    $pass = $cedula;
                }
                if ($existe_interesado["existen"] == 0) {
                    if ($mod_persona->save()) {
                        $per_id = $mod_persona->per_id;
                        $mod_pint = new PreInteresado();
                        $mod_pint->per_id = $per_id;
                        $mod_pint->pint_estado_preinteresado = "1";
                        $mod_pint->pint_estado = "1";
                        $mod_pint->pint_estado_logico = "1";

                        if ($mod_pint->save()) {
                            $mod_solcap = new SolicitudCaptacion();
                            $mod_solcap->per_id = $per_id;
                            $mod_solcap->pint_id = 1;
                            $mod_solcap->ming_id = "1";
                            $mod_solcap->rcap_fecha_ingreso = $resp_perpreins["fecha_registro"]; //date("Y-m-d H:i:s");
                            $mod_solcap->rcap_estado = "1";
                            $mod_solcap->rcap_estado_logico = "1";

                            if ($mod_solcap->save()) {
                                $mod_usuario = new \app\models\Usuario();
                                $mod_usuario->usu_estado = "0";
                                $mod_usuario->usu_estado_logico = "1";
                                if ($mod_usuario->crearUsuario($correo, $pass, $per_id)) {
                                    $usu_id = $mod_usuario->usu_id;

                                    // tercero se crea los permisos del usuario creado grupo3 rol3
                                    $grupo_rol = new \app\models\UsuaGrol();
                                    $grupo_rol->grol_id = 10;
                                    $grupo_rol->usu_id = $usu_id;
                                    $grupo_rol->ugro_estado = "1";
                                    $grupo_rol->ugro_estado_logico = "1";

                                    if (!$grupo_rol->save()) {
                                        $mod_usuario->delete();
                                        $mod_persona->delete();
                                        throw new Exception('Error grupo no creado.');
                                    }
                                    // generar link de activación
                                    $link = $mod_usuario->generarLinkActivacion();
                                } else {
                                    throw new Exception('Error solicitud de captacion no creada.');
                                }
                            } else {

                                throw new Exception('Error usuario no creado.');
                            }
                            $transaction->commit();
                            $message = array(
                                "wtmessage" => Yii::t("notificaciones", "La infomación ha sido grabada. Por favor para activar su cuenta revise su correo Electrónico y siga los pasos."),
                                "title" => Yii::t('jslang', 'Success'),
                            );
                            echo Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                            //activación del usuario.
                            return $this->redirect($link);
                        } else {
                            throw new Exception('Error pre-interesado no creado.');
                        }
                    } else {
                        throw new Exception('Error persona no creado.');
                    }
                } else {
                    throw new Exception('Error número de identificacion o email ya registrado.');
                }
            }
        } catch (Exception $ex) {
            $transaction->rollback();
            $message = array(
                "wtmessage" => $ex->getMessage(), //Yii::t("notificaciones", "Error al grabar."),
                "title" => Yii::t('jslang', 'Error'),
            );
            echo Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), true, $message);
        }
    }

}
