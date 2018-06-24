<?php

namespace app\controllers;

use Yii;
use app\models\Utilities;
use app\models\Persona;
use app\models\SolicitudInscripcion;
use app\models\MetodoIngreso;
use app\models\NivelInteres;
use app\models\UnidadAcademica;
use app\models\OrdenPago;
use app\models\InteresadoEjecutivo;
use yii\helpers\ArrayHelper;
use app\models\Carrera;
use app\models\SolicitudinsDocumento;
use app\models\GestionCrm;
use yii\base\Exception;
use app\models\Interesado;
use yii\helpers\Url;
use yii\base\Security;

class SolicitudinscripcionController extends \app\components\CController {

    public function actionListarsolpendiente() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $per_ids = base64_decode($_GET['ids']);
        $mod_ejecutivo = new InteresadoEjecutivo();
        $model_interesado = new Interesado();
        $fac_id = 1;
        $data = Yii::$app->request->get();

        if ($data['PBgetFilter']) {
            $arrSearch["f_ini"] = $data['f_ini'];
            $arrSearch["f_fin"] = $data['f_fin'];
            $arrSearch["ejecutivo"] = $data['ejecutivo'];
            $arrSearch["search"] = $data['search'];

            if (empty($per_ids)) {  //vista para el interesado
                $resp_gruporol = $model_interesado->consultagruporol($per_id);
                $resp_permiso = $model_interesado->consultapermisoopcion($per_id, 4);
                $model = SolicitudInscripcion::getSolicitudes(1, '', $per_id, $resp_permiso['gmod_id'], $arrSearch);
            } else {   //vista para el jefe o agente.                
                $resp_gruporol = $model_interesado->consultagruporol($per_ids);
                $resp_permiso = $model_interesado->consultapermisoopcion($per_ids, 4);
                $model = SolicitudInscripcion::getSolicitudes(1, '', $per_ids, $resp_permiso['gmod_id'], $arrSearch);
            }
            return $this->renderPartial('_listarSolPendienteGrid', [
                        "model" => $model,
            ]);
        } else {
            if (empty($per_ids)) {  //vista para el interesado
                $resp_gruporol = $model_interesado->consultagruporol($per_id);
                $resp_permiso = $model_interesado->consultapermisoopcion($per_id, 4);
                $model = SolicitudInscripcion::getSolicitudes(1, '', $per_id, $resp_permiso['gmod_id']);
            } else {   //vista para el jefe o agente.
                $resp_gruporol = $model_interesado->consultagruporol($per_ids);
                $resp_permiso = $model_interesado->consultapermisoopcion($per_ids, 4);
                $model = SolicitudInscripcion::getSolicitudes(1, '', $per_ids, $resp_permiso['gmod_id']);
            }
        }
        $arrEjecutivo = ArrayHelper::map(array_merge([["id" => "0", "value" => Yii::t("formulario", "Grid")]], $mod_ejecutivo->consultarEjecutivos($per_id)), "id", "value");
        if (Yii::$app->request->isAjax) {//
            $data = Yii::$app->request->get();
            if (isset($data["op"]) && $data["op"] == '1') {
                
            }
        }
        return $this->render('listarsolpendiente', [
                    'model' => $model,
                    'arrEjecutivo' => $arrEjecutivo,
                    'grupo' => $resp_gruporol
        ]);
    }

    public function actionListarsolprepapro() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $per_ids = base64_decode($_GET['ids']);
        $model_interesado = new Interesado();
        $model = null;
        $data = Yii::$app->request->get();
        if ($data['PBgetFilter']) {
            $arrSearch["f_ini"] = $data['f_ini'];
            $arrSearch["f_fin"] = $data['f_fin'];
            $arrSearch["search"] = $data['search'];

            if (empty($per_ids)) {  //vista para el interesado                 
                $resp_permiso = $model_interesado->consultapermisoopcion($per_id, 4);
                $model = SolicitudInscripcion::getSolicitudes(3, 4, $per_id, $resp_permiso['gmod_id'], $arrSearch);
            } else {   //vista para el jefe o agente.                 
                $resp_permiso = $model_interesado->consultapermisoopcion($per_id, 4);
                $model = SolicitudInscripcion::getSolicitudes(3, 4, $per_ids, $resp_permiso['gmod_id'], $arrSearch);
            }
            return $this->renderPartial('_listarSolPreAproGrid', [
                        "model" => $model,
            ]);
        } else {
            if (empty($per_ids)) {  //vista para el interesado                
                $resp_permiso = $model_interesado->consultapermisoopcion($per_id, 4);
                $model = SolicitudInscripcion::getSolicitudes(3, 4, $per_id, $resp_permiso['gmod_id']);
            } else {   //vista para el jefe o agente.                
                $resp_permiso = $model_interesado->consultapermisoopcion($per_id, 4);
                $model = SolicitudInscripcion::getSolicitudes(3, 4, $per_ids, $resp_permiso['gmod_id']);
            }
        }

        if (Yii::$app->request->isAjax) {//
            $data = Yii::$app->request->get();
            if (isset($data["op"]) && $data["op"] == '1') {
                
            }
        }
        return $this->render('listarsolprepapro', [
                    'model' => $model,
        ]);
    }

    /**
     * Function 
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>
     * @param   Ninguno. 
     * @return  Una vista que recibe las solicitudes del usuario logeado.
     */
    public function actionListarsolinteresado() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $per_ids = base64_decode($_GET['ids']);
        $mod_carrera = new Carrera();
        $modcanal = new GestionCrm();
        $model = null;
        $nint_id = 1;
        $data = Yii::$app->request->get();
        if ($data['PBgetFilter']) {
            $arrSearch["f_ini"] = $data['f_ini'];
            $arrSearch["f_fin"] = $data['f_fin'];
            $arrSearch["carrera"] = $data['carrera'];
            $arrSearch["search"] = $data['search'];
            $arrSearch["modalidad"] = $data["modalidad"];
            if (empty($per_ids)) {  //vista para el interesado
                $model = SolicitudInscripcion::ConsultarSolInteresado($per_id, $arrSearch);
            } else {   //vista para el jefe o agente.
                $model = SolicitudInscripcion::ConsultarSolInteresado($per_ids, $arrSearch);
            }
            return $this->renderPartial('_listarSolicitudGrid', [
                        "model" => $model,
            ]);
        } else {
            if (empty($per_ids)) {  //vista para el interesado
                $model = SolicitudInscripcion::ConsultarSolInteresado($per_id);
            } else {   //vista para el jefe o agente.
                $model = SolicitudInscripcion::ConsultarSolInteresado($per_ids);
            }
        }
        //AQUI
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["getmetodo"])) {
                $metodos = $mod_metodo->obtenerMetodoIngXNivelInt($data['nint_id']);
                $message = array("metodos" => $metodos);
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }
            if (isset($data["getmodalidad"])) {
                $modalidad = $mod_carrera->consultarModalidad($data["nint_id"]);
                $message = array("modalidad" => $modalidad);
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
        //AQUI
        $arr_ninteres = UnidadAcademica::find()->select("uaca_id AS id, uaca_nombre AS name")->where(["uaca_estado_logico" => "1", "uaca_estado" => "1"])->asArray()->all();
        $arr_modalidad = $mod_carrera->consultarModalidad($nint_id);
        $arrCarreras = ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $modcanal->consultarCarreraModalidad(1, 1)), "id", "name");
        $arrEstados = ArrayHelper::map([["id" => "P", "value" => "Pendiente"], ["id" => "S", "value" => "Pagado"], ["id" => "NA", "value" => "No Disponible"]], "id", "value");
        return $this->render('listarsolinteresado', [
                    'model' => $model,
                    'arrCarreras' => $arrCarreras,
                    'arrEstados' => $arrEstados,
                    'arr_ninteres' => ArrayHelper::map($arr_ninteres, "id", "name"),
                    'arr_modalidad' => ArrayHelper::map($arr_modalidad, "id", "name"),
        ]);
    }

    public function actionCreate() {
        $mod_metodo = new MetodoIngreso();
        $per_id = @Yii::$app->session->get("PB_perid");
        $mod_persona = Persona::findIdentity($per_id);
        $mod_carrera = new Carrera();
        $modcanal = new GestionCrm();
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["getmetodo"])) {
                $metodos = $mod_metodo->obtenerMetodoIngXNivelInt($data['nint_id']);
                $message = array("metodos" => $metodos);
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }
            if (isset($data["getmodalidad"])) {
                $modalidad = $mod_carrera->consultarModalidad($data["nint_id"]);
                $message = array("modalidad" => $modalidad);
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
        $arr_ninteres = UnidadAcademica::find()->select("uaca_id AS id, uaca_nombre AS name")->where(["uaca_estado_logico" => "1", "uaca_estado" => "1"])->asArray()->all();
        $arr_modalidad = $mod_carrera->consultarModalidad(1);
        $arr_metodos = $mod_metodo->obtenerMetodoIngXNivelInt($arr_ninteres[0]["id"]);
        $arr_carrera = $modcanal->consultarCarreraModalidad(1, 1);
        return $this->render('create', [
                    "arr_ninteres" => ArrayHelper::map($arr_ninteres, "id", "name"),
                    "arr_metodos" => ArrayHelper::map($arr_metodos, "id", "name"),
                    "txth_extranjero" => $mod_persona->per_nac_ecuatoriano,
                    "arr_carrera" => ArrayHelper::map($arr_carrera, "id", "name"),
                    "arr_modalidad" => ArrayHelper::map($arr_modalidad, "id", "name"),
        ]);
    }

    public function actionGuardarsolinteresado() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $envi_correo = 0;
        $es_nacional = " ";
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if ($_SESSION['persona_solicita'] != '') {// tomar el de parametro)
                $per_id = $_SESSION['persona_solicita'];
            } else {
                unset($_SESSION['persona_ingresa']);
                $per_id = Yii::$app->session->get("PB_perid");
            }
            if ($data["upload_file"]) {
                if (empty($_FILES)) {
                    echo json_encode(['error' => Yii::t("notificaciones", "Error to process File {file}. Try again.", ['{file}' => basename($files['name'])])]);
                    return;
                }
                //Recibe Paramentros
                $files = $_FILES[key($_FILES)];
                $arrIm = explode(".", basename($files['name']));
                $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                $dirFileEnd = Yii::$app->params["documentFolder"] . "solicitudinscripcion/" . $per_id . "/" . $data["name_file"] . "_per_" . $per_id . "." . $typeFile;
                $status = Utilities::moveUploadFile($files['tmp_name'], $dirFileEnd);
                if ($status) {
                    return true;
                } else {
                    echo json_encode(['error' => Yii::t("notificaciones", "Error to process File {file}. Try again.", ['{file}' => basename($files['name'])])]);
                    return;
                }
                $titulo_archivo = "";
                if (isset($data["arc_doc_titulo"]) && $data["arc_doc_titulo"] != "") {
                    $arrIm = explode(".", basename($data["arc_doc_titulo"]));
                    $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                    $titulo_archivo = Yii::$app->params["documentFolder"] . "solicitudinscripcion/" . $per_id . "/doc_titulo_per_" . $per_id . "." . $typeFile;
                }
                $dni_archivo = "archivo";
                if (isset($data["arc_doc_dni"]) && $data["arc_doc_dni"] != "") {
                    $arrIm = explode(".", basename($data["arc_doc_dni"]));
                    $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                    $dni_archivo = Yii::$app->params["documentFolder"] . "solicitudinscripcion/" . $per_id . "/doc_dni_per_" . $per_id . "." . $typeFile;
                }
                $certvota_archivo = "";
                if (isset($data["arc_doc_certvota"]) && $data["arc_doc_certvota"] != "") {
                    $arrIm = explode(".", basename($data["arc_doc_certvota"]));
                    $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                    $certvota_archivo = Yii::$app->params["documentFolder"] . "solicitudinscripcion/" . $per_id . "/doc_certvota_per_" . $per_id . "." . $typeFile;
                }
                $foto_archivo = "";
                if (isset($data["arc_doc_foto"]) && $data["arc_doc_foto"] != "") {
                    $arrIm = explode(".", basename($data["arc_doc_foto"]));
                    $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                    $foto_archivo = Yii::$app->params["documentFolder"] . "solicitudinscripcion/" . $per_id . "/doc_foto_per_" . $per_id . "." . $typeFile;
                }
                $beca_archivo = "";
                if (isset($data["arc_doc_beca"]) && $data["arc_doc_beca"] != "") {
                    $arrIm = explode(".", basename($data["arc_doc_beca"]));
                    $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                    $beca_archivo = Yii::$app->params["documentFolder"] . "solicitudinscripcion/" . $per_id . "/doc_beca_per_" . $per_id . "." . $typeFile;
                }
            }
        }
        $con = \Yii::$app->db_captacion;
        $transaction = $con->beginTransaction();
        try {

            $titulo_archivo = $data["arc_doc_titulo"];
            $dni_archivo = $data["arc_doc_dni"];
            $certvota_archivo = $data["arc_doc_certvota"];
            $foto_archivo = $data["arc_doc_foto"];
            $es_extranjero = $data["arc_extranjero"];
            $es_nacional = $data["arc_nacional"];
            $beca = $data["beca"];

            if ($es_extranjero == "0" || $es_nacional == "0") {
                $certvota_archivo = 1;
            }
            if (isset($data["arc_doc_titulo"]) && $data["arc_doc_titulo"] != "") {
                $arrIm = explode(".", basename($data["arc_doc_titulo"]));
                $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                $titulo_archivo = Yii::$app->params["documentFolder"] . "solicitudinscripcion/" . $per_id . "/doc_titulo_per_" . $per_id . "." . $typeFile;
            }

            if (isset($data["arc_doc_dni"]) && $data["arc_doc_dni"] != "") {
                $arrIm = explode(".", basename($data["arc_doc_dni"]));
                $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                $dni_archivo = Yii::$app->params["documentFolder"] . "solicitudinscripcion/" . $per_id . "/doc_dni_per_" . $per_id . "." . $typeFile;
            }

            if (isset($data["arc_doc_certvota"]) && $data["arc_doc_certvota"] != "") {
                $arrIm = explode(".", basename($data["arc_doc_certvota"]));
                $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                $certvota_archivo = Yii::$app->params["documentFolder"] . "solicitudinscripcion/" . $per_id . "/doc_certvota_per_" . $per_id . "." . $typeFile;
            }

            if (isset($data["arc_doc_foto"]) && $data["arc_doc_foto"] != "") {
                $arrIm = explode(".", basename($data["arc_doc_foto"]));
                $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                $foto_archivo = Yii::$app->params["documentFolder"] . "solicitudinscripcion/" . $per_id . "/doc_foto_per_" . $per_id . "." . $typeFile;
            }

            if (isset($data["arc_doc_beca"]) && $data["arc_doc_beca"] != "") {
                $arrIm = explode(".", basename($data["arc_doc_beca"]));
                $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                $beca_archivo = Yii::$app->params["documentFolder"] . "solicitudinscripcion/" . $per_id . "/doc_beca_per_" . $per_id . "." . $typeFile;
            }

            $mod_interesado = new Interesado();
            $id_int = $mod_interesado->getInteresadoxIdPersona($per_id); //REVISAR SI LA VALIDACION ES CORRECTA
            if (!isset($id_int["int_id"])) {
                throw new Exception('Error id interesado no creado.');
            }
            $nint_id = $data["ninteres"];
            $ming_id = $data["metodoing"];
            $mod_id = $data["modalidad"];
            $car_id = $data["carrera"];
            $rsin_id = 1; //Solicitud pendiente            
            $sins_fechasol = date(Yii::$app->params["dateTimeByDefault"]);
            error_log($sins_fechasol);
            $interesado_id = $id_int["int_id"];
            $mod_solins = new SolicitudInscripcion();

            //Validar que no exista el registro en solicitudes
            $resp_valida = $mod_solins->Validarsolicitud($interesado_id, $nint_id, $ming_id, $car_id);
            if (!empty($titulo_archivo) && !empty($dni_archivo) && !empty($certvota_archivo) && !empty($foto_archivo)) {
                if (empty($resp_valida['existe'])) {
                    $mod_solins->int_id = $interesado_id;
                    $mod_solins->nint_id = $nint_id;
                    $mod_solins->mod_id = $mod_id;
                    $mod_solins->ming_id = $ming_id;
                    $mod_solins->car_id = $car_id;
                    $mod_solins->rsin_id = $rsin_id;
                    $mod_solins->sins_fecha_solicitud = $sins_fechasol;
                    $mod_solins->sins_fecha_preaprobacion = null;
                    $mod_solins->sins_fecha_aprobacion = null;
                    $mod_solins->sins_fecha_reprobacion = null;
                    $mod_solins->sins_observacion = "";
                    $mod_solins->sins_estado = "1";
                    $mod_solins->sins_estado_logico = "1";
                    if ($beca == "1") {
                        $mod_solins->sins_beca = "1";
                    }
                    if ($mod_solins->save()) {
                        Utilities::putMessageLogFile("s1");
                        $mod_solinsxdoc1 = new SolicitudinsDocumento();
                        //1-Título, 2-DNI,3-Cert votación, 4-Foto, 5-Doc-Beca
                        $id_sins = $mod_solins->sins_id;
                        $mod_solinsxdoc1->sins_id = $id_sins;
                        $mod_solinsxdoc1->int_id = $interesado_id;
                        $mod_solinsxdoc1->dadj_id = 1;
                        $mod_solinsxdoc1->sdoc_archivo = $titulo_archivo;
                        $mod_solinsxdoc1->sdoc_estado = "1";
                        $mod_solinsxdoc1->sdoc_estado_logico = "1";

                        if ($mod_solinsxdoc1->save()) {
                            Utilities::putMessageLogFile("s2");
                            $mod_solinsxdoc2 = new SolicitudinsDocumento();

                            $mod_solinsxdoc2->sins_id = $id_sins;
                            $mod_solinsxdoc2->int_id = $interesado_id;
                            $mod_solinsxdoc2->dadj_id = 2;
                            $mod_solinsxdoc2->sdoc_archivo = $dni_archivo;
                            $mod_solinsxdoc2->sdoc_estado = "1";
                            $mod_solinsxdoc2->sdoc_estado_logico = "1";

                            if ($mod_solinsxdoc2->save()) {
                                Utilities::putMessageLogFile("s3");
                                $mod_solinsxdoc3 = new SolicitudinsDocumento();
                                $mod_solinsxdoc3->sins_id = $id_sins;
                                $mod_solinsxdoc3->int_id = $interesado_id;
                                $mod_solinsxdoc3->dadj_id = 4;
                                $mod_solinsxdoc3->sdoc_archivo = $foto_archivo;
                                $mod_solinsxdoc3->sdoc_estado = "1";
                                $mod_solinsxdoc3->sdoc_estado_logico = "1";

                                if ($mod_solinsxdoc3->save()) {
                                    Utilities::putMessageLogFile("s4");
                                    if ($es_extranjero == "1") {
                                        if ($es_nacional != "0") {
                                            $mod_solinsxdoc4 = new SolicitudinsDocumento();
                                            $mod_solinsxdoc4->sins_id = $id_sins;
                                            $mod_solinsxdoc4->int_id = $interesado_id;
                                            $mod_solinsxdoc4->dadj_id = 3;
                                            $mod_solinsxdoc4->sdoc_archivo = $certvota_archivo;
                                            $mod_solinsxdoc4->sdoc_estado = "1";
                                            $mod_solinsxdoc4->sdoc_estado_logico = "1";
                                            if (!$mod_solinsxdoc4->save()) {
                                                $mod_solins->delete();
                                                Utilities::putMessageLogFile("1");
                                                $envi_correo = 1;
                                                throw new Exception('Error doc certvot no creado.');
                                            }
                                        }
                                    }
                                    Utilities::putMessageLogFile("s5");
                                    if ($beca == "1") {
                                        $mod_solinsxdoc5 = new SolicitudinsDocumento();
                                        $mod_solinsxdoc5->sins_id = $id_sins;
                                        $mod_solinsxdoc5->int_id = $interesado_id;
                                        $mod_solinsxdoc5->dadj_id = 5;
                                        $mod_solinsxdoc5->sdoc_archivo = $beca_archivo;
                                        $mod_solinsxdoc5->sdoc_estado = "1";
                                        $mod_solinsxdoc5->sdoc_estado_logico = "1";
                                        if (!$mod_solinsxdoc5->save()) {
                                            $mod_solins->delete();
                                            $envi_correo = 1;
                                            throw new Exception('Error doc beca no creado.');
                                        }
                                    }
                                    if ($envi_correo != 1) {
                                        //Envío de correo  
                                        //datos del aspirante
                                        $mod_persona = new Persona();
                                        $resp_persona = $mod_persona->consultaPersonaId($per_id);
                                        $correo = $resp_persona["usu_user"];
                                        $pri_apellido = $resp_persona["per_pri_apellido"];
                                        $pri_nombre = $resp_persona["per_pri_nombre"];
                                        $nombre_completo = $resp_persona["per_pri_apellido"] . " " . $resp_persona["per_seg_apellido"] . " " . $resp_persona["per_pri_nombre"] . " " . $resp_persona["per_seg_nombre"];
                                        //obtener correo del agente asignado
                                        $mod_asigna = new InteresadoEjecutivo();
                                        $resp_asigna = $mod_asigna->buscarAsignacion(0, $interesado_id);

                                        $mod_peragente = new Persona();
                                        $resp_peragente = $mod_peragente->consultaPersonaId($resp_asigna['per_id']);
                                        $pri_apellido_agente = $resp_peragente["per_pri_apellido"];
                                        $pri_nombre_agente = $resp_peragente["per_pri_nombre"];
                                        $correo_agente = $resp_peragente["usu_user"];  //"analistadesarrollo01@uteg.edu.ec";

                                        $link = "http://www.uteg.edu.ec";
                                        $tituloMensaje = Yii::t("interesado", "UTEG - Registration Online");
                                        $asunto = Yii::t("interesado", "UTEG - Registration Online");
                                        $body = Utilities::getMailMessage("Applicantrequest", array("[[link]]" => $link), Yii::$app->language);
                                        $bodyagente = Utilities::getMailMessage("Reviewagent", null, Yii::$app->language);
                                        Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [$correo => $pri_apellido . " " . $pri_nombre], $asunto, $body);
                                        Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [Yii::$app->params["soporteEmail"] => "Soporte"], $asunto, $body);
                                        if (!empty($correo_agente)) {
                                            Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [$correo_agente => $pri_nombre_agente . " " . $pri_apellido_agente], $asunto, $bodyagente);
                                            Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [Yii::$app->params["soporteEmail"] => "Soporte"], $asunto, $bodyagente);
                                        }
                                    }
                                } else {
                                    Utilities::putMessageLogFile("2");
                                    throw new Exception('Error doc foto no creado.');
                                }
                            } else {
                                Utilities::putMessageLogFile("3");
                                throw new Exception('Error doc dni no creado.');
                            }
                        } else {
                            Utilities::putMessageLogFile("4");
                            throw new Exception('Error doc titulo no creado.');
                        }
                    } else {
                        Utilities::putMessageLogFile($mod_solins->getErrors());
                        throw new Exception('Error solicitud no creado.');
                    }

                    $transaction->commit();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "La infomación ha sido grabada. Por favor verifique su correo."),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    echo Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                } else {
                    Utilities::putMessageLogFile($mod_solins->getErrors());
                    throw new Exception('Ya se encuentra creada una solicitud con los mismos datos.');
                }
            } else {
                Utilities::putMessageLogFile($mod_solins->getErrors());
                throw new Exception('Tiene que subir todos los documentos.');
            }
        } catch (Exception $ex) {
            Utilities::putMessageLogFile("55");
            $transaction->rollback();
            $message = array(
                "wtmessage" => $ex->getMessage(), //Yii::t("notificaciones", "Error al grabar."),
                "title" => Yii::t('jslang', 'Error'),
            );
            echo Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), false, $message);
        }
    }

    public function actionResultsolpreapro() {
        $sins_id = base64_decode($_GET['ids']);
        $interesado = base64_decode($_GET['interesado']);
        $per_id = base64_decode($_GET['perid']);
        $apellidos = base64_decode($_GET['apellidos']);
        $nombres = base64_decode($_GET['nombres']);
        $nivelint = base64_decode($_GET['nint_nombre']);
        $carrera = base64_decode($_GET['car_nombre']);
        $fec_prenoapro = base64_decode($_GET['fec_prenopro']);
        $mod_persona = Persona::findIdentity($per_id);
        $nacionalidad = $mod_persona->per_nac_ecuatoriano;

        $mod_solins = new SolicitudInscripcion();
        $resp_arch1 = $mod_solins->Obtenerdocumentosxsolicitud($sins_id, 1);
        $resp_arch2 = $mod_solins->Obtenerdocumentosxsolicitud($sins_id, 2);
        $resp_arch3 = $mod_solins->Obtenerdocumentosxsolicitud($sins_id, 3);
        $resp_arch4 = $mod_solins->Obtenerdocumentosxsolicitud($sins_id, 4);
        $resp_arch5 = $mod_solins->Obtenerdocumentosxsolicitud($sins_id, 5);

        if ($nacionalidad == '1') {
            $tiponacext = 'N';
        } else {
            $tiponacext = 'E';
        }
        $resp_condtitulo = $mod_solins->Consultarconsideraciondoc(1, $tiponacext);
        $resp_conddni = $mod_solins->Consultarconsideraciondoc(2, $tiponacext);
        $resp_rechazo = $mod_solins->consultaSolicitudRechazada($sins_id, 'P');

        return $this->render('resultsolpreapro', [
                    "revision" => array("3" => Yii::t("formulario", "Pre Approved"), "4" => Yii::t("formulario", "Not approved")),
                    "apellidos" => $apellidos,
                    "nombres" => $nombres,
                    "nivelint" => $nivelint,
                    "carrera" => $carrera,
                    "arch1" => $resp_arch1['sdoc_archivo'],
                    "arch2" => $resp_arch2['sdoc_archivo'],
                    "arch3" => $resp_arch3['sdoc_archivo'],
                    "arch4" => $resp_arch4['sdoc_archivo'],
                    "arch5" => $resp_arch5['sdoc_archivo'],
                    "txth_extranjero" => $nacionalidad,
                    "sins_id" => $sins_id,
                    "per_id" => $per_id,
                    "fec_prenoapro" => $fec_prenoapro,
                    "arr_condtitulo" => $resp_condtitulo,
                    "arr_conddni" => $resp_conddni,
                    "resp_rechazo" => $resp_rechazo,
        ]);
    }

    public function actionResultsolaprobar() {
        $sins_id = base64_decode($_GET['ids']);
        $int_id = base64_decode($_GET['int']);
        $apellidos = base64_decode($_GET['apellidos']);
        $nombres = base64_decode($_GET['nombres']);
        $nivelint = base64_decode($_GET['nint_nombre']);
        $carrera = base64_decode($_GET['car_nombre']);
        $per_id = base64_decode($_GET['perid']);
        $fec_repro = base64_decode($_GET['fec_repro']);
        $obs_repro = base64_decode($_GET['obs_repro']);
        $mod_persona = Persona::findIdentity($per_id);
        $nacionalidad = $mod_persona->per_nac_ecuatoriano;

        $mod_solins = new SolicitudInscripcion();
        $resp_arch1 = $mod_solins->Obtenerdocumentosxsolicitud($sins_id, 1);
        $resp_arch2 = $mod_solins->Obtenerdocumentosxsolicitud($sins_id, 2);
        $resp_arch3 = $mod_solins->Obtenerdocumentosxsolicitud($sins_id, 3);
        $resp_arch4 = $mod_solins->Obtenerdocumentosxsolicitud($sins_id, 4);
        $resp_arch5 = $mod_solins->Obtenerdocumentosxsolicitud($sins_id, 5);

        if ($nacionalidad == '1') {
            $tiponacext = 'N';
        } else {
            $tiponacext = 'E';
        }
        $resp_condtitulo = $mod_solins->Consultarconsideraciondoc(1, $tiponacext);
        $resp_conddni = $mod_solins->Consultarconsideraciondoc(2, $tiponacext);
        $resp_rechazo = $mod_solins->consultaSolicitudRechazada($sins_id, 'A');

        return $this->render('resultsolaprobar', [
                    "revision" => array("2" => Yii::t("formulario", "APPROVED"), "4" => Yii::t("formulario", "Not approved")),
                    "apellidos" => $apellidos,
                    "nombres" => $nombres,
                    "nivelint" => $nivelint,
                    "carrera" => $carrera,
                    "arch1" => $resp_arch1['sdoc_archivo'],
                    "arch2" => $resp_arch2['sdoc_archivo'],
                    "arch3" => $resp_arch3['sdoc_archivo'],
                    "arch4" => $resp_arch4['sdoc_archivo'],
                    "arch5" => $resp_arch5['sdoc_archivo'],
                    "txth_extranjero" => $nacionalidad,
                    "sins_id" => $sins_id,
                    "int_id" => $int_id,
                    "per_id" => $per_id,
                    "fec_repro" => $fec_repro,
                    "obs_repro" => $obs_repro,
                    "arr_condtitulo" => $resp_condtitulo,
                    "arr_conddni" => $resp_conddni,
                    "resp_rechazo" => $resp_rechazo,
        ]);
    }

    public function actionGuardaraprobacion() {
        $per_sistema = @Yii::$app->session->get("PB_perid");
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $resultado = $data["resultado"];
            $observacion = ucwords(strtolower($data["observacion"]));
            $banderapreaprueba = $data["banderapreaprueba"];
            $sins_id = $data["sins_id"];
            $int_id = $data["int_id"];
            $per_id = $data["per_id"];
            $condicionesTitulo = $data["condicionestitulo"];
            $condicionesDni = $data["condicionesdni"];
            $titulo = $data["titulo"];
            $dni = $data["dni"];

            $con = \Yii::$app->db_captacion;
            $transaction = $con->beginTransaction();
            $con2 = \Yii::$app->db_facturacion;
            $transaction2 = $con2->beginTransaction();
            try {
                $mod_solins = new SolicitudInscripcion();
                $respusuario = $mod_solins->consultaDatosusuario($per_sistema);
                $respsolins = $mod_solins->apruebaSolicitud($sins_id, $resultado, $observacion, $banderapreaprueba, $respusuario['usu_id']);
                if ($respsolins) {
                    if ($banderapreaprueba == 0) {  //Aprobación
                        if ($resultado == 2) {
                            //Buscar precio para orden de pago                          
                            $resp_precio = $mod_solins->Obtenerdatosolicitud($sins_id);
                            if ($resp_precio) {
                                $precio = $resp_precio['precio'];
                                //Generar Orden de pago                                 
                                $mod_ordenpago = new OrdenPago();
                                if ($precio == 0) {
                                    $estadopago = 'S';
                                } else {
                                    $estadopago = 'P';
                                }
                                $resp_opago = $mod_ordenpago->insertarOrdenpago($sins_id, null, $precio, 0, $precio, $estadopago, $respusuario['usu_id']);
                                if ($resp_opago) {
                                    //insertar desglose del pago                                    
                                    $fecha_ini = date(Yii::$app->params["dateByDefault"]);
                                    $fecha_fin = date('Y-m-d', strtotime($fecha_ini . "+ 30 day"));
                                    $resp_dpago = $mod_ordenpago->insertarDesglosepago($resp_opago, $precio, 0, $precio, $fecha_ini, null, $estadopago, $respusuario['usu_id']);
                                    if ($resp_dpago) {
                                        if ($precio == 0) {  //Se genera id de aspirante y correo de bienvenida.
                                            $resp_encuentra = $mod_ordenpago->encuentraAspirante($int_id);
                                            if ($resp_encuentra) {
                                                $asp = $resp_encuentra['asp_id'];
                                                $continua = 1;
                                            } else {
                                                //Se asigna al interesado como aspirante
                                                $resp_asp = $mod_ordenpago->insertarAspirante($int_id);
                                                if ($resp_asp) {
                                                    $asp = $resp_asp;
                                                    $resp_inte = $mod_ordenpago->actualizaEstadointeresado($int_id);
                                                    if ($resp_inte) {
                                                        $continua = 1;
                                                    }
                                                }
                                            }
                                            if ($continua == 1) {
                                                //Se obtienen el método de ingreso y el nivel de interés según la solicitud.                                                
                                                $resp_sol = $mod_solins->Obtenerdatosolicitud($sins_id);
                                                //Se obtiene el curso para luego registrarlo.
                                                if ($resp_sol) {
                                                    $mod_persona = new Persona();
                                                    $resp_persona = $mod_persona->consultaPersonaId($per_id);
                                                    $correo = $resp_persona["usu_user"];
                                                    $apellidos = $resp_persona["per_pri_apellido"];
                                                    $nombres = $resp_persona["per_pri_nombre"];
                                                    //información del aspirante
                                                    $identi = $resp_persona["per_cedula"];
                                                    $cel_fono = $resp_persona["per_celular"];
                                                    $mail_asp = $resp_persona["per_correo"];

                                                    $link = "http://www.uteg.edu.ec";
                                                    $metodo_ingreso = $resp_sol["nombre_metodo_ingreso"];
                                                    if ($resp_sol["metodo_ingreso"] == 1) {
                                                        $leyenda = "el curso de nivelación";
                                                    }
                                                    if ($resp_sol["metodo_ingreso"] == 2) {
                                                        $leyenda = "la preparación para el examen de admisión";
                                                    }
                                                    $file1 = Url::base(true) . "/files/Bienvenida.pdf";
                                                    $rutaFile = array($file1);
                                                    $tituloMensaje = Yii::t("interesado", "UTEG - Registration Online");
                                                    $asunto = Yii::t("interesado", "UTEG - Registration Online");
                                                    $body = Utilities::getMailMessage("Applicantrecord", array("[[nombre]]" => $nombres, "[[apellido]]" => $apellidos, "[[metodo]]" => $metodo_ingreso, "[[fecha]]" => $resp_curso['fecha'], "[[leyenda]]" => $leyenda, "[[link]]" => $link), Yii::$app->language);
                                                    Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [$correo => $apellidos . " " . $nombres], $asunto, $body, $rutaFile);
                                                    Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [Yii::$app->params["soporteEmail"] => "Soporte"], $asunto, $body);
                                                    $exito = 1;
                                                }
                                            }
                                        } else {
                                            //Envío de correo con formas de pago                                    
                                            $informacion_interesado = $mod_ordenpago->datosBotonpago($resp_opago, 'SI');
                                            $link = Url::base(true) . "/formbotonpago/btnpago?ord_pago=" . base64_encode($resp_opago);
                                            $link1 = Url::base(true);
                                            $pri_nombre = $informacion_interesado["nombres"];
                                            $pri_apellido = $informacion_interesado["apellidos"];
                                            $correo = $informacion_interesado["email"];
                                            $nombres = $pri_nombre . " " . $pri_apellido;
                                            $curso = $informacion_interesado["curso"];
                                            $preciocurso = $informacion_interesado["precio"];
                                            $identificacion = $informacion_interesado["identificacion"];
                                            $telefono = $informacion_interesado["telefono"];
                                            $metodo = $resp_precio['nombre_metodo_ingreso'];
                                            $fechapago = "";
                                            $tituloMensaje = Yii::t("interesado", "UTEG - Registration Online");
                                            $asunto = Yii::t("interesado", "UTEG - Registration Online");
                                            $body = Utilities::getMailMessage("Paidinterested", array("[[nombre]]" => $nombres, "[[metodo]]" => $metodo, "[[precio]]" => $preciocurso, "[[link]]" => $link, "[[link1]]" => $link1), Yii::$app->language);
                                            $bodyadmision = Utilities::getMailMessage("Paidadmissions", array("[[nombre]]" => $pri_nombre, "[[apellido]]" => $pri_apellido, "[[correo]]" => $correo, "[[identificacion]]" => $identificacion, "[[curso]]" => $curso, "[[telefono]]" => $telefono), Yii::$app->language);
                                            $bodycolecturia = Utilities::getMailMessage("Approvedapplicationcollected", array("[[nombres_completos]]" => $nombres, "[[metodo]]" => $metodo), Yii::$app->language);
                                            Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [$correo => $pri_apellido . " " . $pri_nombre], $asunto, $body);
                                            Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [Yii::$app->params["admisiones"] => "Jefe"], $asunto, $bodyadmision);
                                            Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [Yii::$app->params["soporteEmail"] => "Soporte"], $asunto, $body);
                                            Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [Yii::$app->params["soporteEmail"] => "Soporte"], $asunto, $bodyadmision);
                                            Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [Yii::$app->params["colecturia"] => "Colecturia"], $asunto, $bodycolecturia);
                                            $exito = 1;
                                        }
                                    }
                                } else {
                                    $exito = 0;
                                    $mensaje = "Error al generar la orden de pago.";
                                }
                            }
                        } else { //No aprueban la solicitud                           
                            $srec_etapa = "A";  //Aprobación                            
                            //Grabar en tabla de solicitudes rechazadas.
                            if ($titulo == 1) {
                                $obs_rechazo = "No cumple condiciones de aceptación en título.";
                                for ($c = 0; $c < count($condicionesTitulo); $c++) {
                                    $resp_rechtit = $mod_solins->Insertarsolicitudrechazada($sins_id, 1, $condicionesTitulo[$c], $srec_etapa, $obs_rechazo, $respusuario['usu_id']);
                                    if ($resp_rechtit) {
                                        $ok = "1";
                                    } else {
                                        $ok = "0";
                                    }
                                }
                            }
                            if ($dni == 1) {
                                $obs_rechazo = "No cumple condiciones de aceptación en documento de identidad.";
                                for ($a = 0; $a < count($condicionesDni); $a++) {
                                    $resp_rechdni = $mod_solins->Insertarsolicitudrechazada($sins_id, 2, $condicionesDni[$a], $srec_etapa, $obs_rechazo, $respusuario['usu_id']);
                                    if ($resp_rechdni) {
                                        $ok = "1";
                                    } else {
                                        $ok = "0";
                                    }
                                }
                            }
                            if ($ok == "1") {
                                //Se envía correo.
                                $mod_persona = new Persona();
                                $resp_persona = $mod_persona->consultaPersonaId($per_id);
                                $correo = $resp_persona["usu_user"];
                                $pri_apellido = $resp_persona["per_pri_apellido"];
                                $pri_nombre = $resp_persona["per_pri_nombre"];
                                $nombre_completo = $resp_persona["per_pri_apellido"] . " " . $resp_persona["per_seg_apellido"] . " " . $resp_persona["per_pri_nombre"] . " " . $resp_persona["per_seg_nombre"];
                                $estado = "NO APROBADA";
                                //Obtener datos del rechazo.
                                $resp_rechazo = $mod_solins->consultaSolicitudRechazada($sins_id, 'A');
                                if ($resp_rechazo) {
                                    $obs_condicion = "";
                                    for ($r = 0; $r < count($resp_rechazo); $r++) {
                                        if ($obs_condicion <> $resp_rechazo[$r]['observacion']) {
                                            $obs_condicion = $resp_rechazo[$r]['observacion'];
                                            $obs_correo = $obs_correo . "<br/><b>" . $obs_condicion . ":</b><br/>" . "&nbsp;&nbsp;&nbsp;No " . $resp_rechazo[$r]['condicion'];
                                        } else {
                                            $obs_correo = $obs_correo . "<br/>" . "&nbsp;&nbsp;&nbsp; No " . $resp_rechazo[$r]['condicion'];
                                        }
                                    }
                                }
                                $tituloMensaje = Yii::t("interesado", "UTEG - Registration Online");
                                $asunto = Yii::t("interesado", "UTEG - Registration Online");
                                $body = Utilities::getMailMessage("Requestapplicantdenied", array("[[observacion]]" => $obs_correo), Yii::$app->language);
                                $bodyadmision = Utilities::getMailMessage("Requestadmissions", array("[[nombre_aspirante]]" => $nombre_completo, "[[estado_solicitud]]" => $estado), Yii::$app->language);
                                Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [$correo => $pri_apellido . " " . $pri_nombre], $asunto, $body);
                                Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [Yii::$app->params["soporteEmail"] => "Soporte"], $asunto, $body);
                                Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [Yii::$app->params["admisiones"] => "Jefe"], $asunto, $bodyadmision);
                                Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [Yii::$app->params["soporteEmail"] => "Soporte"], $asunto, $bodyadmision);
                                $exito = 1;
                            } else {
                                $message = array
                                    ("wtmessage" => Yii::t("notificaciones", "No ha seleccionado condiciones de No Aprobado."), "title" =>
                                    Yii::t('jslang', 'Success'),
                                );
                            }
                        }
                    } else {  //Pre-Aprobación de la solicitud   
                        if ($resultado == 4) {
                            $srec_etapa = "P";  //Preaprobación                       
                            //Grabar en tabla de solicitudes rechazadas.
                            if ($titulo == 1) {
                                $obs_rechazo = "No cumple condiciones de aceptación en título.";
                                for ($c = 0; $c < count($condicionesTitulo); $c++) {
                                    $resp_rechtit = $mod_solins->Insertarsolicitudrechazada($sins_id, 1, $condicionesTitulo[$c], $srec_etapa, $obs_rechazo, $respusuario['usu_id']);
                                    if ($resp_rechtit) {
                                        $ok = "1";
                                    } else {
                                        $ok = "0";
                                    }
                                }
                            }
                            if ($dni == 1) {
                                $obs_rechazo = "No cumple condiciones de aceptación en documento de identidad.";
                                for ($a = 0; $a < count($condicionesDni); $a++) {
                                    $resp_rechdni = $mod_solins->Insertarsolicitudrechazada($sins_id, 2, $condicionesDni[$a], $srec_etapa, $obs_rechazo, $respusuario['usu_id']);
                                    if ($resp_rechdni) {
                                        $ok = "1";
                                    } else {
                                        $ok = "0";
                                    }
                                }
                            }
                        } else {
                            $ok = "1";
                        }

                        if ($ok == "1") {
                            $link = Url::base(true);
                            $tituloMensaje = Yii::t("interesado", "UTEG - Registration Online");
                            $asunto = Yii::t("interesado", "UTEG - Registration Online");
                            $bodyadmision = Utilities::getMailMessage("Prereviewadmissions", array("[[link_asgard]]" => $link), Yii::$app->language);
                            Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [Yii::$app->params["admisiones"] => "Jefe"], $asunto, $bodyadmision);
                            Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [Yii::$app->params["soporteEmail"] => "Soporte"], $asunto, $bodyadmision);
                            $exito = 1;
                        } else {
                            $message = array
                                ("wtmessage" => Yii::t("notificaciones", "No ha seleccionado condiciones de No Aprobado."), "title" =>
                                Yii::t('jslang', 'Success'),
                            );
                        }
                    }
                }
                if ($exito) {
                    $transaction->commit();
                    $transaction2->commit();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "La información ha sido grabada."),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    echo \app\models\Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                } else {
                    $transaction->rollback();
                    $transaction2->rollback();
                    if (empty($message)) {
                        $message = array
                            (
                            "wtmessage" => Yii::t("notificaciones", "Error al grabar. " . $mensaje . " / " . $paso), "title" =>
                            Yii::t('jslang', 'Success'),
                        );
                    }
                    echo \app\models\Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $transaction2->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $mensaje . " / " . $paso),
                    "title" => Yii::t('jslang', 'Success'),
                );
                echo \app\models\Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
            }
            return;
        }
    }

    public function actionExpexcel() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $data = Yii::$app->request->get();
        $per_ids = base64_decode($data['ids']);
        $arrSearch["search"] = $data["search"];
        $arrSearch["modalidad"] = $data["modalidad"];
        $arrSearch["carrera"] = $data["carrera"];
        $arrSearch["f_ini"] = $data["f_ini"];
        $arrSearch["f_fin"] = $data["f_fin"];
        $arrData = array();
        if (empty($per_ids)) {  //vista para el interesado
            $arrData = SolicitudInscripcion::ConsultarSolInteresado($per_id, $arrSearch, true);
        } else {   //vista para el jefe o agente.
            $arrData = SolicitudInscripcion::ConsultarSolInteresado($per_ids, $arrSearch, true);
        }

        $nombarch = "InscripcionReport-" . date("YmdHis");
        $content_type = Utilities::mimeContentType("xls");
        header("Content-Type: $content_type");
        header("Content-Disposition: attachment;filename=" . $nombarch . ".xls");
        header('Cache-Control: max-age=0');
        $arrHeader = array(
            Yii::t("formulario", "Request #"),
            Yii::t("solicitud_ins", "Application date"),
            Yii::t("formulario", "DNI 1"),
            Yii::t("formulario", "First Names"),
            Yii::t("formulario", "Academic unit"),
            Yii::t("formulario", "Mode"),
            Yii::t("solicitud_ins", "Income Method"),
            ' ',
            Yii::t("academico", "Career"),
            ' ',
            Yii::t("formulario", "Status"),
            "Pago");
        $nameReport = yii::t("formulario", "Application Reports");
        $colPosition = array("C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N");
        Utilities::generarReporteXLS($nombarch, $nameReport, $arrHeader, $arrData, $colPosition);
        return;
    }

    public function actionListarsolaprobada() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $per_ids = base64_decode($_GET['ids']);

        $data = Yii::$app->request->get();

        if ($data['PBgetFilter']) {
            $arrSearch["f_ini"] = $data['f_ini'];
            $arrSearch["f_fin"] = $data['f_fin'];
            $arrSearch["search"] = $data['search'];
            $mod_solicitud = new SolicitudInscripcion();
            $resp_solicitud = $mod_solicitud->Solicitudesaprobadas($arrSearch);

            return $this->renderPartial('_listarsolaprobada_grid', [
                        "model" => $resp_solicitud,
            ]);
        } else {
            $mod_solicitud = new SolicitudInscripcion();
            $resp_solicitud = $mod_solicitud->Solicitudesaprobadas($arrSearch);
        }

        if (Yii::$app->request->isAjax) {//
            $data = Yii::$app->request->get();
            if (isset($data["op"]) && $data["op"] == '1') {
                
            }
        }
        return $this->render('listarsolaprobada', [
                    'model' => $resp_solicitud,
        ]);
    }

}
