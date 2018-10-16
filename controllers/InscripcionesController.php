<?php

namespace app\controllers;
use Yii;
use app\models\Utilities;
use yii\helpers\ArrayHelper;
use yii\base\Exception;
use app\models\Persona;
use app\models\Pais;
use app\models\Provincia;
use app\models\Canton;
use app\models\MedioPublicitario;
use app\modules\academico\models\Modalidad;
use app\modules\academico\models\UnidadAcademica;
use yii\helpers\Url;
use app\modules\admision\models\PersonaGestion;
use app\modules\admision\models\Oportunidad;
use app\models\Empresa;
use app\modules\admision\models\EstadoContacto;
use app\modules\admision\models\MetodoIngreso;

class InscripcionesController extends \yii\web\Controller {

    public function init() {
        if(!is_dir(Yii::getAlias('@bower')))
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
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["getprovincias"])) {
                $provincias = Provincia::find()->select("pro_id AS id, pro_nombre AS name")->where(["pro_estado_logico" => "1", "pro_estado" => "1", "pai_id" => $data['pai_id']])->asArray()->all();
                $message = array("provincias" => $provincias);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }
            if (isset($data["getcantones"])) {
                $cantones = Canton::find()->select("can_id AS id, can_nombre AS name")->where(["can_estado_logico" => "1", "can_estado" => "1", "pro_id" => $data['prov_id']])->asArray()->all();
                $message = array("cantones" => $cantones);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }            
            if (isset($data["getarea"])) {
                //obtener el codigo de area del pais
                $mod_areapais = new Pais();
                $area = $mod_areapais->consultarCodigoArea($data["codarea"]);
                $message = array("area" => $area);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }

            if (isset($data["getmodalidad"])) {
                $modalidad = $mod_modalidad->consultarModalidad($data["nint_id"],1);
                $message = array("modalidad" => $modalidad);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }
            if (isset($data["getcarrera"])) {
                $carrera = $modcanal->consultarCarreraModalidad($data["unidada"], $data["moda_id"]);
                $message = array("carrera" => $carrera);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }
        }
        $arr_pais_dom = Pais::find()->select("pai_id AS id, pai_nombre AS value")->where(["pai_estado_logico" => "1", "pai_estado" => "1"])->asArray()->all();
        $pais_id = 1; //Ecuador
        $arr_prov_dom = Provincia::provinciaXPais($pais_id);
        $arr_ciu_dom = Canton::cantonXProvincia($arr_prov_dom[0]["id"]);       
        $arr_medio = MedioPublicitario::find()->select("mpub_id AS id, mpub_nombre AS value")->where(["mpub_estado_logico" => "1", "mpub_estado" => "1"])->asArray()->all();
        $arr_ninteres = $mod_unidad->consultarUnidadAcademicasEmpresa(1);
        $arr_modalidad = $mod_modalidad->consultarModalidad(1,1);
        $arr_conuteg = $mod_pergestion->consultarConociouteg();
        $arr_carrerra1 = $modcanal->consultarCarreraModalidad(1, 1);
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
        ]);
    }
    
    public function actionIndexadmisionn() {
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
                return;
            }
            if (isset($data["getcantones"])) {
                $cantones = Canton::find()->select("can_id AS id, can_nombre AS name")->where(["can_estado_logico" => "1", "can_estado" => "1", "pro_id" => $data['prov_id']])->asArray()->all();
                $message = array("cantones" => $cantones);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }            
            if (isset($data["getarea"])) {
                //obtener el codigo de area del pais
                $mod_areapais = new Pais();
                $area = $mod_areapais->consultarCodigoArea($data["codarea"]);
                $message = array("area" => $area);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }

            if (isset($data["getmodalidad"])) {
                $modalidad = $mod_modalidad->consultarModalidad($data["nint_id"],1);
                $message = array("modalidad" => $modalidad);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }
            if (isset($data["getcarrera"])) {
                $carrera = $modcanal->consultarCarreraModalidad($data["unidada"], $data["moda_id"]);
                $message = array("carrera" => $carrera);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }
        }
        $arr_pais_dom = Pais::find()->select("pai_id AS id, pai_nombre AS value")->where(["pai_estado_logico" => "1", "pai_estado" => "1"])->asArray()->all();
        $pais_id = 1; //Ecuador
        $arr_prov_dom = Provincia::provinciaXPais($pais_id);
        $arr_ciu_dom = Canton::cantonXProvincia($arr_prov_dom[0]["id"]);       
        $arr_medio = MedioPublicitario::find()->select("mpub_id AS id, mpub_nombre AS value")->where(["mpub_estado_logico" => "1", "mpub_estado" => "1"])->asArray()->all();
        $arr_ninteres = $mod_unidad->consultarUnidadAcademicasEmpresa(1);
        $arr_modalidad = $mod_modalidad->consultarModalidad(1,1);
        $arr_conuteg = $mod_pergestion->consultarConociouteg();
        $arr_carrerra1 = $modcanal->consultarCarreraModalidad(1, 1);               
        $arr_metodos = $mod_metodo->consultarMetodoIngNivelInt($arr_ninteres[0]["id"]);
        
        return $this->render('indexAdmisionN', [
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
        $mod_empresa = new Empresa();
        $mod_estcontacto = new EstadoContacto();
        $mod_persona = new Persona();
        $mod_oportunidad = new Oportunidad();
        $celular = null;
        $celular2 = null;
        $telefono = null;
        $celularbeni = null;
        $celularbeni2 = null;
        $telefonobeni = null;
        $correobeni = null;
        $busqueda = 0;
        $pagina = "";
        $conempresa = $mod_empresa->consultarEmpresaId('uteg'); // 1 uteg
        $emp_id = $conempresa["id"]; 
        $gcrm_codigo["id"] = 0;
        $mod_modalidad = new Modalidad();
        $mod_unidad = new UnidadAcademica();    
        $correo = strtolower($data["correo"]);
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $nombre1 = ucwords(strtolower($data["pri_nombre"]));
            $nombre2 = null;
            $apellido1 = ucwords(strtolower($data["pri_apellido"]));
            $apellido2 = null;
            $nombres = $nombre1 . ' ' . $apellido1;
            $conestcontacto =  $mod_estcontacto->consultarEstadoContacto(); 
            $econ_id = $conestcontacto[0]["id"];
            $tipo_persona = $mod_persona->consultarTipoPersona('Natural');
            //$tipo_persona = 1; // 1 persona natural // hacer funcion que traIGa id 
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
            $medio = 1; // codigo de formulario pagina web  // hacer funcion que traIGa id       
            $celularbeni = $data["celular"];
            $celularbeni2 = null;
            $telefonobeni = null;
            $correobeni = strtolower($data["correo"]);
            $nivelestudio = $data["unidad"];
            $modalidad = $data["modalidad"];
            $nombre_unidad = $mod_unidad->consultarNombreunidad($nivelestudio);
            $nombre_modalidad = $mod_modalidad->consultarNombremoda($modalidad);
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
            switch ($nivelestudio) { // esto cambiarlo hacer funcion que consulte el usuario y traer el id
                case "1":
                    $tipoportunidad = 1;
                    if ($modalidad == "1") {
                        $agente = $mod_oportunidad->consultarAgentebyCod($nivelestudio, $modalidad, 1); // 1 uteg//15;
                        $pagina = "register_go";
                    } else {
                        $agente = $mod_oportunidad->consultarAgentebyCod($nivelestudio, $modalidad, 1);//14;
                        switch ($modalidad) {
                            case "2":
                                $pagina = "register_gp";
                                break;
                            case "3":
                                $pagina = "register_gs";
                                break;
                            case "4":
                                $pagina = "register_gd";
                                break;
                        }
                    }
                    break;
                case "2":
                    $agente = $mod_oportunidad->consultarAgentebyCod($nivelestudio, $modalidad, 1);//16;
                    $tipoportunidad = 5;
                    $pagina = "register_ps";
                    break;
                /*case "3":
                    $agente = 17;
                    $tipoportunidad = 8;
                    break;*/
            }
            $subcarera = 1;
            $canal = 1;
            $estado = 1;
            $usuario = 1; // 1 equivale al usuario administrador
            $carrera = $data["carrera"];
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
                if ($cons_persona["registro"] == 0 || $busqueda == 0) {
                    $resp_consulta = $mod_pergestion->consultarMaxPergest();
                    $pges_codigo = $resp_consulta["maximo"];
                    $resp_persona = $mod_pergestion->insertarPersonaGestion($pges_codigo, $tipo_persona, $conoce_uteg, $carrera, $nombre1, $nombre2, $apellido1, $apellido2, $cedula, null, $pasaporte, null, null, null, null, $pais, $provincia, $ciudad, null, null, $celular, $correo, null, null, null, null, null, null, null, $telefono, $celular2, null, null, null, null, null, null, null, null, null, null, $econ_id, $medio, $empresa, $contacto_empresa, $numero_contacto, $telefono_empresa, $direccion, $cargo, $usuario);
                    if ($resp_persona) {
                        //$res_gescontacto = $mod_pergestion->insertarPersGestionContac($resp_persona, $nombres, $correo, $telefono, $celular, $pais);
                        //if ($res_gescontacto) {
                        $gcrm_codigo = $mod_gestion->consultarUltimoCodcrm();
                        //$codigocrm = $gcrm_codigo["id"] + 1;
                        $codigocrm = 1 + $gcrm_codigo;
                        // emp_id es el nombre de la ver como capturar esta OJO no olvidar hacerlo
                        $res_oportunidad = $mod_gestion->insertarOportunidad($codigocrm, $emp_id, $resp_persona, null, $carrera, $nivelestudio, $modalidad, $tipoportunidad, $subcarera, $canal, $estado, $fecha_registro, $agente["agente_id"] , $usuario);
                        if ($res_oportunidad) {
                            $oact_id = 1;
                            $descripcion = 'Registro subido desde formulario de inscripción';
                            $res_actividad = $mod_gestion->insertarActividad($res_oportunidad, $usuario, $agente["agente_id"] , $estado, $fecha_registro, $oact_id, $descripcion, $fecha_registro);
                            //$mod_estado = $mod_pergestion->modificarSestaclixId($resp_persona, $ecli_id);
                            if ($res_actividad) {
                                $exito = 1;
                            }
                        }
                        //$exito = 1;
                        //}                        
                    }
                    if ($exito) {
                        $transaction->commit();
                        //$usu$file1ario = ucwords(strtolower($nombre1)) . " " . ucwords(strtolower($nombre2));
                        //$file1 = Url::base(true) . "/files/inscripcion.pdf";
                        //$rutaFile = array($file1);
                        /*$tituloMensaje = Yii::t("register", "User Register");
                        $asunto = Yii::t("register", "User Register") . " " . Yii::$app->params["siteName"];
                        $body = Utilities::getMailMessage($pagina, array(
                                    "[[primer_nombre]]" => $nombre1,
                                    "[[primer_apellido]]" => $apellido1,
                                    "[[dni]]" => $dnis,
                                    "[[numero_dni]]" => $numidentificacion,
                                    "[[celular]]" => $celular,
                                    "[[mail]]" => $correo,
                                    "[[unidad_academica]]" => $nombre_unidad["nombre_unidad"],
                                    "[[modalidad]]" => $nombre_modalidad["nombre_modalidad"]), Yii::$app->language);
                        Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [$correo => $nombre1 . " " . $nombre2], $asunto, $body);
                        Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [Yii::$app->params["soporteEmail"] => "Soporte"], $asunto, $body);*/
                        $message = array(
                            "wtmessage" => Yii::t("notificaciones", "La infomación ha sido grabada. "),
                            "title" => Yii::t('jslang', 'Success'),
                        );
                        return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                    } else {
                        $transaction->rollback();
                        $message = array(
                            "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $este),
                            "title" => Yii::t('jslang', 'Error'),
                        );
                        return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), false, $message);
                    }
                } else {
                    $mensaje = 'Sus datos ya se encuentran registrados, nos contactaremos con usted';
                    $tituloMensaje = Yii::t("register", "Existing Record");
                    $asunto = Yii::t("register", "Existing Record") . " " . Yii::$app->params["siteName"];
                    $body = Utilities::getMailMessage("registeragain", array(
                                    "[[primer_nombre]]" => $nombre1,
                                    "[[primer_apellido]]" => $apellido1,
                                    "[[dni]]" => $dnis,
                                    "[[numero_dni]]" => $numidentificacion,
                                    "[[celular]]" => $celular,
                                    "[[mail]]" => $correo,
                                    "[[unidad_academica]]" => $nombre_unidad["nombre_unidad"],
                                    "[[modalidad]]" => $nombre_modalidad["nombre_modalidad"]), Yii::$app->language);
                    Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [Yii::$app->params["lidercontact"] => $nombre1 . " " . $nombre2], $asunto, $body);
                    Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [Yii::$app->params["adminlider"] => $nombre1 . " " . $nombre2], $asunto, $body);
                    Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [Yii::$app->params["soporteEmail"] => "Soporte"], $asunto, $body);
                        
                    $transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", $mensaje),
                        "title" => Yii::t('jslang', 'OK'),
                    );
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "OK"), false, $message);
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => $ex->getMessage(), Yii::t("notificaciones", "Error al grabar."),
                    "title" => Yii::t('jslang', 'Error'),
                );
                return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), true, $message);
            }
        }
    }
    
    public function Guardarinscripcionsolicitud(){
        $per_id = @Yii::$app->session->get("PB_perid");
        $error = 0;
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $id_opor = $data["id_pgest"];
            $opor_model = new Oportunidad();
            $pgest = $opor_model->consultarPersonaGestionPorOporId($id_opor);
            $con = \Yii::$app->db_asgard;
            $transaction = $con->beginTransaction();
            try {
                $emp_id = $pgest['emp_id'];
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
                    $id_persona = $mod_persona->consultarIdPersona($pgest['pges_cedula'], $pgest['pges_pasaporte']);
                    if ($id_persona == 0) {
                        $id_persona = $mod_persona->insertarPersona($con, $parametros_per, $keys_per, 'persona');
                    }
                    if ($id_persona > 0) {
                        $concap = \Yii::$app->db_captacion;
                        $mod_emp_persona = new EmpresaPersona();
                        $keys = ['emp_id', 'per_id', 'eper_estado', 'eper_estado_logico'];
                        $parametros = [$emp_id, $id_persona, 1, 1];
                        $emp_per_id = $mod_emp_persona->consultarIdEmpresaPersona($id_persona, $emp_id);
                        if ($emp_per_id == 0) {
                            $emp_per_id = $mod_emp_persona->insertarEmpresaPersona($con, $parametros, $keys, 'empresa_persona');
                        }
                        if ($emp_per_id > 0) {
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
                                $mod_us_gr_ep = new UsuaGrolEper();
                                $grol_id = 30;
                                $keys = ['eper_id', 'usu_id', 'grol_id', 'ugep_estado', 'ugep_estado_logico'];
                                $parametros = [$emp_per_id, $usuario_id, $grol_id, 1, 1];
                                $us_gr_ep_id = $mod_us_gr_ep->consultarIdUsuaGrolEper($emp_per_id, $usuario_id, $grol_id);
                                if ($us_gr_ep_id == 0)
                                    $us_gr_ep_id = $mod_us_gr_ep->insertarUsuaGrolEper($con, $parametros, $keys, 'usua_grol_eper');
                                if ($us_gr_ep_id > 0) {
                                    $mod_interesado = new Interesado(); // se guarda con estado_interesado 1
                                    $interesado_id = $mod_interesado->consultaInteresadoById($id_persona);
                                    $keys = ['per_id', 'int_estado_interesado', 'int_usuario_ingreso', 'int_estado', 'int_estado_logico'];
                                    $parametros = [$id_persona, 1, $usuario_id, 1, 1];
                                    if ($interesado_id == 0) {
                                        $interesado_id = $mod_interesado->insertarInteresado($concap, $parametros, $keys, 'interesado');
                                    }
                                    if ($interesado_id > 0) {
                                        $mod_inte_emp = new InteresadoEmpresa(); // se guarda con estado_interesado 1
                                        $iemp_id = $mod_inte_emp->consultaInteresadoEmpresaById($interesado_id, $emp_id);
                                        if ($iemp_id == 0) {
                                            $iemp_id = $mod_inte_emp->crearInteresadoEmpresa($interesado_id, $emp_id, $usuario_id);
                                        }
                                        if ($iemp_id > 0) {
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
                                            $outemail = $mod_interesado->enviarCorreoBienvenida($email_info);
                                            /*if ($outemail == 0) {
                                                $error_message .= Yii::t("formulario", "The email hasn't been sent");
                                                $error++;
                                            }*/
                                        } else {
                                            $error_message .= Yii::t("formulario", "The enterprise interested hasn't been saved");
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
                        "wtmessage" => Yii::t("formulario", "The information have been saved and the information has been sent to your email"),
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

}
