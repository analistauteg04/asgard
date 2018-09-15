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
use app\models\MedioPublicitario;
use app\models\Modalidad;
use app\models\UnidadAcademica;
use yii\helpers\Url;
use app\models\PersonaGestion;
use app\models\Oportunidad;
use app\models\ModuloEstudio;
use app\models\Empresa;
use app\models\EstadoContacto;

class InscripcionulinkController extends \yii\web\Controller {

    public function actionIndex() {
        $this->layout = '@themes/' . \Yii::$app->getView()->theme->themeName . '/layouts/basic.php';
        $mod_metodo = new MetodoIngreso();
        $per_id = Yii::$app->session->get("PB_perid");
        $mod_persona = Persona::findIdentity($per_id);
        $mod_pergestion = new PersonaGestion();
        $modestudio = new ModuloEstudio();
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
                //obtener el codigo de area del pais
                $mod_areapais = new Pais();
                $area = $mod_areapais->consultarCodigoArea($data["codarea"]);
                $message = array("area" => $area);
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }
        }
        $arr_pais_dom = Pais::find()->select("pai_id AS id, pai_nombre AS value")->where(["pai_estado_logico" => "1", "pai_estado" => "1"])->asArray()->all();
        $pais_id = 1; //Ecuador
        $arr_prov_dom = Provincia::provinciaXPais($pais_id);
        $arr_ciu_dom = Canton::cantonXProvincia($arr_prov_dom[0]["id"]);
        $arr_medio = MedioPublicitario::find()->select("mpub_id AS id, mpub_nombre AS value")->where(["mpub_estado_logico" => "1", "mpub_estado" => "1"])->asArray()->all();
        $arr_conuteg = $mod_pergestion->consultarConociouteg();
        $arr_carrerra1 = $modestudio->consultarEstudioEmpresa(2);
        return $this->render('index', [
                    "tipos_dni" => array("CED" => Yii::t("formulario", "DNI Document"), "PASS" => Yii::t("formulario", "Passport")),
                    "tipos_dni2" => array("CED" => Yii::t("formulario", "DNI Document1"), "PASS" => Yii::t("formulario", "Passport1")),
                    "txth_extranjero" => $mod_persona->per_nac_ecuatoriano,
                    "arr_pais_dom" => ArrayHelper::map($arr_pais_dom, "id", "value"),
                    "arr_prov_dom" => ArrayHelper::map($arr_prov_dom, "id", "value"),
                    "arr_ciu_dom" => ArrayHelper::map($arr_ciu_dom, "id", "value"),
                    "arr_medio" => ArrayHelper::map($arr_medio, "id", "value"),
                    "arr_conuteg" => ArrayHelper::map($arr_conuteg, "id", "name"),
                    "arr_carrerra1" => ArrayHelper::map($arr_carrerra1, "id", "name"),
        ]);
    }

    public function actionGuardarinscripcion() {
        $mod_empresa = new Empresa();
        $mod_estcontacto = new EstadoContacto();
        $mod_persona = new Persona();
        $celular = null;
        $celular2 = null;
        $telefono = null;
        $celularbeni = null;
        $celularbeni2 = null;
        $telefonobeni = null;
        $correobeni = null;
        $busqueda = 0;
        $pagina = "";
        $conempresa = $mod_empresa->consultarEmpresaId('ulink'); // 2 ulink
        $emp_id = $conempresa["id"]; 
        $gcrm_codigo["id"] = 0;
        $correo = strtolower($data["correo"]);
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $nombre1 = ucwords(strtolower($data["pri_nombre"]));
            $nombre2 = null;
            $apellido1 = ucwords(strtolower($data["pri_apellido"]));
            $apellido2 = null;
            $conestcontacto = $mod_estcontacto->consultarEstadoContacto();
            $econ_id = $conestcontacto[0]["id"];
            $tipo_persona = $mod_persona->consultarTipoPersona('Natural');     
            $empresa = "";
            $telefono_empresa = null;
            $direccion = null;
            $cargo = null;
            $contacto_empresa = null;
            $numero_contacto = null;
            $pais = $data["pais"];
            $provincia = null;
            $ciudad = null;
            $celular = $data["celular"];
            $celular2 = null;
            $telefono = null;
            $correo = strtolower($data["correo"]);
            $medio = 1; // codigo de formulatio pagina web     // hacer funcion que traIGa id       
            $celularbeni = $data["celular"];
            $celularbeni2 = null;
            $telefonobeni = null;
            $correobeni = strtolower($data["correo"]);
            $nivelestudio = 3; //  ver bien esto
            $modalidad = 1;     //  ver bien esto
            $tipo_dni = $data["tipo_dni"];
            $cedula = $data["cedula"];
            $pasaporte = $data["pasaporte"];
            $conoce_uteg = $data["conoce"];
            if ($tipo_dni == "CED") {
                $dnis = "Cédula";
                $numidentificacion = $cedula;
            } elseif ($tipo_dni == "PASS") {
                $dnis = "Pasaporte";
                $numidentificacion = $pasaporte;
            }
            switch ($nivelestudio) { // esto cambiarlo hacer funcion que consulte el usaurio y traer el id           
                case "3":
                    $agente = 17;
                    $tipoportunidad = 8;
                    $pagina = "registerulink";
                    break;
            }
            $subcarera = 1;
            $canal = 1;
            $estado = 1;
            $usuario = 1; // 1 equivale al usuario administrador
            $carrera = $data["carrera"]; // este va ser el modulo de estudio
            $fecha_registro = date(Yii::$app->params["dateTimeByDefault"]);
            $con = \Yii::$app->db_crm;
            $transaction = $con->beginTransaction();
            try {
                $mod_pergestion = new PersonaGestion();
                $mod_gestion = new Oportunidad();
                if (!empty($celular) || !empty($correo) || !empty($telefono) || !empty($cedula) || !empty($pasaporte)) {
                    $cons_persona = $mod_pergestion->consultarDatosExiste($celular, $correo, $telefono, $celular2, $cedula, $pasaporte);
                    $busqueda = 1;
                }
                if ($cons_persona["registro"] == 0 || $busqueda = 0) {
                    $resp_consulta = $mod_pergestion->consultarMaxPergest();
                    $pges_codigo = $resp_consulta["maximo"];
                    $resp_persona = $mod_pergestion->insertarPersonaGestion($pges_codigo, $tipo_persona, $conoce_uteg, $carrera, $nombre1, $nombre2, $apellido1, $apellido2, $cedula, null, $pasaporte, null, null, null, null, $pais, $provincia, $ciudad, null, null, $celular, $correo, null, null, null, null, null, null, null, $telefono, $celular2, null, null, null, null, null, null, null, null, null, null, $econ_id, $medio, $empresa, $contacto_empresa, $numero_contacto, $telefono_empresa, $direccion, $cargo, $usuario);
                    if ($resp_persona) {
                        $gcrm_codigo = $mod_gestion->consultarUltimoCodcrm();
                        $codigocrm = 1 + $gcrm_codigo;
                        $res_oportunidad = $mod_gestion->insertarOportunidad($codigocrm, $emp_id, $resp_persona, $carrera, null, $nivelestudio, $modalidad, $tipoportunidad, $subcarera, $canal, $estado, $fecha_registro, $agente, $usuario);
                        if ($res_oportunidad) {
                            $descripcion = 'Registro subido desde formulario de inscripción';
                            $res_actividad = $mod_gestion->insertarActividad($res_oportunidad, $usuario, $agente, $estado, $fecha_registro, $descripcion, $fecha_registro);
                            if ($res_actividad) {
                                $exito = 1;
                            }
                        }
                    }
                    if ($exito) {
                        $transaction->commit();
                        $tituloMensaje = Yii::t("register", "User Register");
                        $asunto = Yii::t("register", "User Register") . " " . Yii::$app->params["siteName"];
                        $body = Utilities::getMailMessage($pagina, array(
                                    "[[primer_nombre]]" => $nombre1,
                                    "[[primer_apellido]]" => $nombre2,
                                    "[[dni]]" => $dnis,
                                    "[[numero_dni]]" => $numidentificacion,
                                    "[[celular]]" => $celular,
                                    "[[mail]]" => $correo), Yii::$app->language);
                        Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [$correo => $nombre1 . " " . $nombre2], $asunto, $body);
                        Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [Yii::$app->params["soporteEmail"] => "Soporte"], $asunto, $body);
                        $message = array(
                            "wtmessage" => Yii::t("notificaciones", "La infomación ha sido grabada. "),
                            "title" => Yii::t('jslang', 'Success'),
                        );
                        echo Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                    } else {
                        $transaction->rollback();
                        $message = array(
                            "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $este),
                            "title" => Yii::t('jslang', 'Error'),
                        );
                        echo Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), false, $message);
                    }
                } else {
                    $mensaje = 'Ya hay registros en los campos, celular, teléfonos o correo';
                    $transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error al grabar. " . $mensaje),
                        "title" => Yii::t('jslang', 'Error'),
                    );
                    echo Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), false, $message);
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => $ex->getMessage(), Yii::t("notificaciones", "Error al grabar."),
                    "title" => Yii::t('jslang', 'Error'),
                );
                echo Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), true, $message);
            }
        }
    }

}