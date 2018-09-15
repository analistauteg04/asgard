<?php

namespace app\controllers;

use Yii;
use app\models\MetodoIngreso;
use app\models\Utilities;
use yii\helpers\ArrayHelper;
use yii\base\Exception;
use yii\base\Security;
use app\models\Persona;
use app\models\Pais;
use app\models\Provincia;
use app\models\Canton;
use app\models\EstudioAcademico;
use app\models\MedioPublicitario;
use app\models\SolicitudCaptacion;
use app\models\Modalidad;
use app\models\Usuario;
use app\models\PreInteresado;
use app\models\UnidadAcademica;
use yii\helpers\Url;

class InscripcionController extends \yii\web\Controller {

    public function actionIndex() {
        $this->layout = '@themes/' . \Yii::$app->getView()->theme->themeName . '/layouts/basic.php';
        $mod_metodo = new MetodoIngreso();
        $per_id = Yii::$app->session->get("PB_perid");
        $mod_persona = Persona::findIdentity($per_id);
        $mod_modalidad = new Modalidad();
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
                $metodos = $mod_metodo->consultarMetodoIngNivelInt($data['nint_id']);
                $message = array("metodos" => $metodos);
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }

            if (isset($data["getarea"])) {
                //obtener el codigo de area del pais
                $mod_areapais = new Pais();
                $area = $mod_areapais->consultarCodigoArea($data["codarea"]);
                $message = array("area" => $area);
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }

            if (isset($data["getmodalidad"])) {
                $modalidad = $mod_modalidad->consultarModalidad($data["nint_id"]);
                $message = array("modalidad" => $modalidad);
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }
        }
        $arr_pais_dom = Pais::find()->select("pai_id AS id, pai_nombre AS value")->where(["pai_estado_logico" => "1", "pai_estado" => "1"])->asArray()->all();
        $pais_id = 1; //Ecuador
        $arr_prov_dom = Provincia::provinciaXPais($pais_id);
        $arr_ciu_dom = Canton::cantonXProvincia($arr_prov_dom[0]["id"]);
        $mod_carrera = new EstudioAcademico();
        //$fac_id = 1;
        $arr_metodos = $mod_metodo->consultarMetodoIngNivelInt(2);
        $arr_medio = MedioPublicitario::find()->select("mpub_id AS id, mpub_nombre AS value")->where(["mpub_estado_logico" => "1", "mpub_estado" => "1"])->asArray()->all();
        $arr_ninteres = UnidadAcademica::find()->select("uaca_id AS id, uaca_nombre AS name")->where(["uaca_estado_logico" => "1", "uaca_estado" => "1"])->asArray()->all();
        $arr_modalidad = $mod_modalidad->consultarModalidad(1);
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
                    "arr_modalidad" => ArrayHelper::map($arr_modalidad, "id", "name"),
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
            $unidad = $data["unidad"];
            $modalidad = $data["modalidad"];
            $con = \Yii::$app->db;
            $transaction = $con->beginTransaction();
            try {
                $mod_personapreins = new \app\models\PersonaPreins();
                // obtener nacionalidad y codigo de area
                $arr_region = $mod_personapreins->consultaDatosRegion($pais);
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
                $mod_personapreins->uaca_id = $unidad;
                $mod_personapreins->mod_id = $modalidad;
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
                            // $modelo= $existe_interesado["ppre_id"]."-".ucwords(strtolower($pri_nombre))."-".ucwords(strtolower($pri_apellido))."-".$mod_personapreins->ppre_nacionalidad."-".$pais."-".$pais."-".$celular."-".strtolower($correo);
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
                        if (($unidad ==1) && ($modalidad==1)) {
                            $file1 = Url::base(true) . "/files/archivo.pdf";
                            $rutaFile = array($file1);
                        }
                                     
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
                                    "[[pais]]" => 'Ecuador',
                                    "[[celular]]" => $celular,
                                    "[[mail]]" => $mod_personapreins->ppre_correo,
                                    "[[user]]" => $nombres, "[[username]]" => $mod_personapreins->ppre_correo,
                                    "[[link_verification]]" => $link), Yii::$app->language);
                        $bodyjefe = Utilities::getMailMessage("Reviewadmissions", array("[[link_asgard]]" => $link_asgard), Yii::$app->language);
                        //$bodysupervisor = Utilities::getMailMessage("Supervisoradmissions", array("[[link_asgard]]" => $link_asgard), Yii::$app->language);
                        if (!empty($rutaFile)) {
                            Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [$mod_personapreins->ppre_correo => $pri_apellido . " " . $pri_nombre], $asunto, $body, $rutaFile);
                        } else {
                            Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [$mod_personapreins->ppre_correo => $pri_apellido . " " . $pri_nombre], $asunto, $body);
                        }
                        
                        Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [Yii::$app->params["soporteEmail"] => "Soporte"], $asunto, $body);
                        Utilities::sendEmail($tituloMensaje1, Yii::$app->params["adminEmail"], [Yii::$app->params["admisiones"] => "Jefe"], $asunto1, $bodyjefe);
                        //Utilities::sendEmail($tituloMensaje1, Yii::$app->params["adminEmail"], [Yii::$app->params["supervisoradmision1"] => "Supervisor"], $asunto1, $bodysupervisor);
                        //Utilities::sendEmail($tituloMensaje1, Yii::$app->params["adminEmail"], [Yii::$app->params["supervisoradmision2"] => "Supervisor"], $asunto1, $bodysupervisor);

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
                            $mod_solcap->uaca_id = $resp_perpreins["unidad"]; 
                            $mod_solcap->ming_id = $resp_perpreins["modalidad"]; 
                            $mod_solcap->rcap_fecha_ingreso = $resp_perpreins["fecha_registro"]; //date("Y-m-d H:i:s");
                            $mod_solcap->rcap_estado = "1";
                            $mod_solcap->rcap_fecha_creacion = date(Yii::$app->params["dateTimeByDefault"]);
                            $mod_solcap->rcap_estado_logico = "1";
                            if ($mod_solcap->save()) {
                                $mod_usuario = new \app\models\Usuario();
                                $mod_usuario->usu_estado = "0";
                                $mod_usuario->usu_estado_logico = "1";
                                if ($mod_usuario->crearUsuario($correo, $pass, $per_id)) {
                                    $usu_id = $mod_usuario->usu_id;
                                    // tercero se crea los permisos del usuario creado grupo3 rol3
                                    //NO GUARDA REVISAR PORQUE                                    
                                    $empresa_persona = new \app\models\EmpresaPersona();                                    
                                    $empresa_persona->emp_id = 1; //esto ver si no esquemado OJO
                                    $empresa_persona->per_id = $per_id;
                                    $empresa_persona->eper_estado = "1";
                                    $empresa_persona->eper_estado_logico = "1";
                                    // AQUI guardar en empresa_persona                                                            
                                    if ($empresa_persona->save()) {
                                        // crear modelo empresa_persona 
                                        $grupo_rol = new \app\models\UsuaGrolEper();
                                        $grupo_rol->eper_id = $empresa_persona->eper_id;
                                        $grupo_rol->usu_id = $usu_id;
                                        $grupo_rol->grol_id = 10;
                                        $grupo_rol->ugep_estado = "1";
                                        $grupo_rol->ugep_estado_logico = "1";
                                        if (!$grupo_rol->save()) {
                                            $mod_usuario->delete();
                                            $empresa_persona->delete();
                                            $mod_persona->delete();
                                            throw new Exception('Error grupo no creado.');
                                        }
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

    public function actionPago() {
        $this->layout = '@themes/' . \Yii::$app->getView()->theme->themeName . '/layouts/basic.php';
        $Cedula = $_GET['cedula'];
        $IdMateria = $_GET['IdMateria'];
        $status = FALSE;
        $vpos = new \app\components\CVpos();
        $llaveVPOSCryptoPub = Yii::$app->params['VposllaveVPOSCryptoPub'];
        $llaveComercioFirmaPriv = Yii::$app->params['VposllaveComercioFirmaPriv'];
        $vector = Yii::$app->params['Vposvector'];
        // verificar en la base de datos si existe estudiante
        $estudiante = \app\models\Persona::findOne(['per_cedula' => $Cedula]);
        $idEstudiante = $estudiante->per_id;
        $nombre = $estudiante->per_pri_nombre;
        $apellido = $estudiante->per_pri_apellido;
        $correo = $estudiante->per_correo;
        // verificar en la base de datos si existe la materia
        $idInscripcion = "";
        $nombreMateria = "";
        // valoracion del curso
        $precio = "";
        $precioItem = $precio * 100; // no se debe enviar cifras con el punto decimal
        $IVA = $precio * Yii::$app->params['VposIVA'] * 100;
        $ICE = "000";
        $total = $precioItem + $IVA;
        // llenado de arreglo de datos vpos
        $array_send['billingFirstName'] = $nombre;
        $array_send['billingLastName'] = $apellido;
        $array_send['billingEMail'] = $correo;
        $array_send['purchaseOperationNumber'] = $idInscripcion;
        // Parametros Generales
        $array_send['acquirerId'] = Yii::$app->params['VposacquirerId'];
        $array_send['commerceId'] = Yii::$app->params['VposcommerceId'];
        $array_send['purchaseCurrencyCode'] = Yii::$app->params['VpospurchaseCurrencyCode'];
        $array_send['commerceMallId'] = Yii::$app->params['VposcommerceMallId'];
        $array_send['language'] = Yii::$app->params['Vposlanguage'];
        $array_send['billingAddress'] = Yii::$app->params['VposbillingAddress'];
        $array_send['billingZIP'] = Yii::$app->params['VposbillingZIP'];
        $array_send['billingCity'] = Yii::$app->params['VposbillingCity'];
        $array_send['billingState'] = Yii::$app->params['VposbillingState'];
        $array_send['billingCountry'] = Yii::$app->params['VposbillingCountry'];
        $array_send['billingPhone'] = Yii::$app->params['VposbillingPhone'];
        $array_send['shippingAddress'] = Yii::$app->params['VposshippingAddress'];
        $array_send['terminalCode'] = Yii::$app->params['VposterminalCode'];
        //Parametros Reservados Sobre Inclusion de Impuestos IVA
        $array_send['purchaseAmount'] = $total;
        //Monto Neto sin incluir el valor IVA
        $array_send['reserved1'] = $precioItem;
        //Impuesto IVA de la transaccion
        $array_send['reserved2'] = $IVA;
        // Idioma
        $array_send['reserved3'] = Yii::$app->params['Vposlanguage'];
        $array_send['reserved7'] = '000';
        $array_send['reserved8'] = '000';

        //Aqui debe enviar el valor 000.
        $array_send['reserved9'] = '000';
        $array_send['reserved10'] = '000';
        //Aqui se debe enviar el monto que no se ve afectado por el impuesto IVA. Si el monto si aplica el impuesto IVA, enviar el valor 000. 
        $array_send['reserved11'] = $precioItem;
        //Impuestos a los consumos especiales ICE. Si el monto no aplica al ICE, enviar el valor 000. 
        $array_send['reserved12'] = $ICE;
        //Ejemplo envio campos reservados en parametro reserved1.
        $array_send['reserved13'] = 'Valor Reservado ABC';

        //Parametros de Solicitud de Autorizacion a Enviar
        $array_get['XMLREQ'] = "";
        $array_get['DIGITALSIGN'] = "";
        $array_get['SESSIONKEY'] = "";

        // 
        if ($vpos->VPOSSend($array_send, $array_get, $llaveVPOSCryptoPub, $llaveComercioFirmaPriv, $vector)) {
            // registrar en inscripcion el intento de pago
        } else {
            $status = true;
        }
        if ($status) {
            return $this->render('errpago', [
                        'msg' => "Hay un problema con el conector de pago",
            ]);
        } else {
            return $this->render('pago', [
                        'array_get' => $array_get,
                        'idInscripcion' => $idInscripcion,
                        'nombre' => $nombre,
                        'apellido' => $apellido,
                        'nombreMateria' => $nombreMateria,
                        'precio' => $total,
                        'nombreMateria' => $nombreMateria,
            ]);
        }
    }

}
