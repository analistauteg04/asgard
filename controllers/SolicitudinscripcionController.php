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
use app\models\EstudioAcademico;
use app\models\SolicitudinsDocumento;
use app\models\Oportunidad;
use yii\base\Exception;
use app\models\Interesado;
use app\models\Modalidad;
use app\models\OtrosServicios;
use yii\helpers\Url;
use yii\base\Security;
use \app\models\ItemMetodoNivel;
use \app\models\DetalleDescuentoItem;
use \app\models\ModuloEstudio;

class SolicitudinscripcionController extends \app\components\CController {

    public function actionListarsolpendiente() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $per_ids = base64_decode($_GET['ids']);
        $mod_ejecutivo = new InteresadoEjecutivo();
        $model_interesado = new Interesado();
       // $fac_id = 1;
        $data = Yii::$app->request->get();
        Utilities::putMessageLogFile('perIds:'.$per_ids);
        Utilities::putMessageLogFile('perId:'.$per_id);
        if ($data['PBgetFilter']) {
            $arrSearch["f_ini"] = $data['f_ini'];
            $arrSearch["f_fin"] = $data['f_fin'];
            $arrSearch["ejecutivo"] = $data['ejecutivo'];
            $arrSearch["search"] = $data['search'];

            if (empty($per_ids)) {  //vista para el interesado
                $resp_gruporol = $model_interesado->consultagruporol($per_id);
                $resp_permiso = $model_interesado->consultapermisoopcion($per_id, 5);
                $model = SolicitudInscripcion::getSolicitudes(1, '', $per_id, $resp_permiso['gmod_id'], $arrSearch);
            } else {   //vista para el jefe o agente.                
                $resp_gruporol = $model_interesado->consultagruporol($per_ids);
                $resp_permiso = $model_interesado->consultapermisoopcion($per_ids, 4);
                $model = SolicitudInscripcion::getSolicitudes(1, '', $per_ids, $resp_permiso['gmod_id'], $arrSearch);
            }
            return $this->renderPartial('_listarsolpendiente_grid', [
                        "model" => $model,
            ]);
        } else {
            if (empty($per_ids)) {  //vista para el agente
                $resp_gruporol = $model_interesado->consultagruporol($per_id);
                $resp_permiso = $model_interesado->consultapermisoopcion($per_id, 5);
                $model = SolicitudInscripcion::getSolicitudes(1, '', $per_id, $resp_permiso['gmod_id']);
            } else {   //vista.
                $resp_gruporol = $model_interesado->consultagruporol($per_ids);
                $resp_permiso = $model_interesado->consultapermisoopcion($per_ids, 4);
                $model = SolicitudInscripcion::getSolicitudes(1, '', $per_ids, $resp_permiso['gmod_id']);
            }
        }
        $resp_ejecutivos = $mod_ejecutivo->consultarAgentes();        
        if (Yii::$app->request->isAjax) {//
            $data = Yii::$app->request->get();
            if (isset($data["op"]) && $data["op"] == '1') {
                
            }
        }
        return $this->render('listarsolpendiente', [
                    'model' => $model,
                    'arrEjecutivo' => ArrayHelper::map(array_merge([["id" => "0", "name" => "Todas"]],$resp_ejecutivos), "id", "name"),                   // 'arrEjecutivo' => $arrEjecutivo,
                    'grupo' => $resp_gruporol["grol_id"],            
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
            return $this->renderPartial('_listarsolprepapro_grid', [
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
    public function actionListarsolicitudxinteresado() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $per_ids = base64_decode($_GET['ids']);
        $mod_carrera = new EstudioAcademico();
        $model = null;
        $fac_id = 1;
        $data = Yii::$app->request->get();

        if ($data['PBgetFilter']) {
            $arrSearch["f_ini"] = $data['f_ini'];
            $arrSearch["f_fin"] = $data['f_fin'];
            $arrSearch["carrera"] = $data['carrera'];
            //$arrSearch["estado"] = $data['estado'];
            $arrSearch["search"] = $data['search'];

            if (empty($per_ids)) {  //vista para el interesado
                $model = SolicitudInscripcion::getSolicitudesXInteresado($per_id, $arrSearch);
            } else {   //vista para el jefe o agente.
                $model = SolicitudInscripcion::getSolicitudesXInteresado($per_ids, $arrSearch);
            }
            return $this->renderPartial('_listarsolicitud_grid', [
                        "model" => $model,
            ]);
        } else {
            if (empty($per_ids)) {  //vista para el interesado
                $model = SolicitudInscripcion::getSolicitudesXInteresado($per_id);
            } else {   //vista para el jefe o agente.
                $model = SolicitudInscripcion::getSolicitudesXInteresado($per_ids);
            }
        }

        $arrCarreras = ArrayHelper::map(array_merge([["id" => "0", "value" => Yii::t("formulario", "Grid")]], $mod_carrera->consultarCarrera()), "id", "value");
        $arrEstados = ArrayHelper::map([["id" => "P", "value" => "Pendiente"], ["id" => "S", "value" => "Pagado"], ["id" => "NA", "value" => "No Disponible"]], "id", "value");
        return $this->render('listarsolicitudxinteresado', [
                    'model' => $model,
                    'arrCarreras' => $arrCarreras,
                    'arrEstados' => $arrEstados
        ]);
    }

    public function actionCreate() {
        $mod_metodo = new MetodoIngreso();
        $per_id = @Yii::$app->session->get("PB_perid");
        $mod_persona = Persona::findIdentity($per_id);
        $mod_carrera = new EstudioAcademico();
        $mod_modalidad = new Modalidad();
        $modcanal = new Oportunidad();
        $modestudio = new ModuloEstudio();
        $modItemMetNivel = new ItemMetodoNivel();
        $modDescuento = new DetalleDescuentoItem();
        
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["getmetodo"])) {                
                $metodos = $mod_metodo->consultarMetodoIngNivelInt($data['nint_id']);
                $message = array("metodos" => $metodos);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }
            if (isset($data["getmodalidad"])) { 
                \app\models\Utilities::putMessageLogFile('nivel interes: ' . $data["nint_id"]); 
                $modalidad = $mod_modalidad->consultarModalidad($data["nint_id"]);                
                $message = array("modalidad" => $modalidad);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }
            if (isset($data["getcarrera"])) { 
                if ($data["unidada"] < 3) {
                    $carrera = $modcanal->consultarCarreraModalidad($data["unidada"], $data["moda_id"]);
                } else {
                    $carrera = $modestudio->consultarCursoModalidad($data["unidada"], $data["moda_id"]);
                }
                $message = array("carrera" => $carrera);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }            
            if (isset($data["getdescuento"])) {                
                $resItem = $modItemMetNivel->consultarXitemMetniv($data["unidada"], $data["moda_id"], $data["metodo"]);
                //if ($resp_item) {                  
                $descuentos = $modDescuento->consultarDesctoxitem($resItem["ite_id"]);                  
                $message = array("descuento" => $descuentos);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
               // }
            }
        }
        $arr_ninteres = UnidadAcademica::find()->select("uaca_id AS id, uaca_nombre AS name")->where(["uaca_estado_logico" => "1", "uaca_estado" => "1"])->asArray()->all();
        $arr_modalidad = $mod_modalidad->consultarModalidad(1);
        $arr_metodos = $mod_metodo->consultarMetodoIngNivelInt($arr_ninteres[0]["id"]);
        $arr_carrera = $modcanal->consultarCarreraModalidad(1, 1);      
        //Descuentos.
        $resp_item = $modItemMetNivel->consultarXitemMetniv(1, 1, 1);
        $arr_descuento = $modDescuento->consultarDesctoxitem($resp_item["ite_id"]);
        return $this->render('create', [
                    "arr_ninteres" => ArrayHelper::map($arr_ninteres, "id", "name"),
                    "arr_metodos" => ArrayHelper::map($arr_metodos, "id", "name"),
                    "txth_extranjero" => $mod_persona->per_nac_ecuatoriano,
                    "arr_carrera" => ArrayHelper::map($arr_carrera, "id", "name"),
                    "arr_modalidad" => ArrayHelper::map($arr_modalidad, "id", "name"),
                    "arr_descuento" => ArrayHelper::map($arr_descuento, "id", "name"), 
                    "item" => $resp_item["ite_id"]
        ]);
    }

    public function actionGuardarsolinsxinteresado() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $usu_id = @Yii::$app->session->get("PB_iduser");
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
                    return json_encode(['error' => Yii::t("notificaciones", "Error to process File {file}. Try again.", ['{file}' => basename($files['name'])])]);
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
                    return json_encode(['error' => Yii::t("notificaciones", "Error to process File {file}. Try again.", ['{file}' => basename($files['name'])])]);
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
        $con1 = \Yii::$app->db_facturacion;
        $transaction = $con->beginTransaction();
        $transaction1 = $con1->beginTransaction();
        try {
            $titulo_archivo = $data["arc_doc_titulo"];
            $dni_archivo = $data["arc_doc_dni"];
            $certvota_archivo = $data["arc_doc_certvota"];
            $foto_archivo = $data["arc_doc_foto"];
            $es_extranjero = $data["arc_extranjero"];
            $es_nacional = $data["arc_nacional"];
            $beca = $data["beca"];
            $descuento = $data["descuento_id"];
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
            $emp_id = $data["emp_id"];
            $sins_fechasol = date(Yii::$app->params["dateTimeByDefault"]);
            if (($nint_id==3) or empty($nint_id)){
                $ming_id=null; //Curso.
                $rsin_id = 3; //Solicitud pre-aprobada para Educación Continua.  
                $pre_observacion = 'Solicitud Pre-Aprobada por ser de Educación Continua.';
                $fec_preobservacion = $sins_fechasol;
                $subirDocumentos = 0;
            } else {
                $rsin_id = 1; //Solicitud pendiente        
                $pre_observacion = null;
                $fec_preobservacion = null;
            }                                  
            
            $interesado_id = $id_int["int_id"];
            $subirDocumentos = $data["subirDocumentos"];
            $mod_solins = new SolicitudInscripcion();
            $errorprecio = 1;
            //Obtener el precio de la solicitud.
            if ($beca == "1") {
                $precio = 0;
            } else {
                $resp_precio = $mod_solins->ObtenerPrecio($ming_id, $nint_id, $mod_id, $car_id);
                if ($resp_precio) {
                    $precio = $resp_precio['precio'];
                } else {
                    $mensaje = 'No existe registrado ningún precio para la unidad, modalidad y método de ingreso seleccionada.';
                    $errorprecio = 0;
                }
            }
            if ($errorprecio != 0) {
                //Validar que no exista el registro en solicitudes.
                $resp_valida = $mod_solins->Validarsolicitud($interesado_id, $nint_id, $ming_id, $car_id);
                if (empty($resp_valida['existe'])) {
                    $mod_solins->int_id = $interesado_id;
                    $mod_solins->uaca_id = $nint_id;
                    $mod_solins->mod_id = $mod_id;
                    $mod_solins->ming_id = $ming_id;
                    $mod_solins->eaca_id = $car_id;
                    $mod_solins->rsin_id = $rsin_id;
                    $mod_solins->emp_id = $emp_id;
                    $mod_solins->sins_fecha_solicitud = $sins_fechasol;
                    $mod_solins->sins_fecha_preaprobacion = $fec_preobservacion;
                    $mod_solins->sins_fecha_aprobacion = null;
                    $mod_solins->sins_fecha_reprobacion = null;
                    $mod_solins->sins_preobservacion = $pre_observacion;
                    $mod_solins->sins_observacion = "";
                    $mod_solins->sins_estado = "1";
                    $mod_solins->sins_estado_logico = "1";
                    if ($beca == "1") {
                        $mod_solins->sins_beca = "1";
                    }
                    if ($subirDocumentos == 0) {                    
                        $mod_solins->save();
                        \app\models\Utilities::putMessageLogFile($mod_solins->getErrors());                         
                        $id_sins = $mod_solins->sins_id;
                        \app\models\Utilities::putMessageLogFile('solicitud: ' . $id_sins); 
                    } else {
                        if (!empty($titulo_archivo) && !empty($dni_archivo) && !empty($certvota_archivo) && !empty($foto_archivo)) {
                            if ($mod_solins->save()) {                                
                                $mod_solinsxdoc1 = new SolicitudinsDocumento();
                                //1-Título, 2-DNI,3-Cert votación, 4-Foto, 5-Doc-Beca                               
                                $id_sins = $mod_solins->sins_id;
                                $mod_solinsxdoc1->sins_id = $id_sins;
                                $mod_solinsxdoc1->int_id = $interesado_id;
                                $mod_solinsxdoc1->dadj_id = 1;
                                $mod_solinsxdoc1->sdoc_archivo = $titulo_archivo;
                                $mod_solinsxdoc1->sdoc_estado = "1";
                                $mod_solinsxdoc1->sdoc_estado_logico = "1";
                                \app\models\Utilities::putMessageLogFile('solicitud: ' . $id_sins); 
                                \app\models\Utilities::putMessageLogFile('int_id: ' . $interesado_id); 
                                \app\models\Utilities::putMessageLogFile('sdoc_archivo: ' . $titulo_archivo);                                 
                                if ($mod_solinsxdoc1->save()) {     
                                    \app\models\Utilities::putMessageLogFile($mod_solins->getErrors());                                  
                                    $mod_solinsxdoc2 = new SolicitudinsDocumento();
                                    $mod_solinsxdoc2->sins_id = $id_sins;
                                    $mod_solinsxdoc2->int_id = $interesado_id;
                                    $mod_solinsxdoc2->dadj_id = 2;
                                    $mod_solinsxdoc2->sdoc_archivo = $dni_archivo;
                                    $mod_solinsxdoc2->sdoc_estado = "1";
                                    $mod_solinsxdoc2->sdoc_estado_logico = "1";
                                    if ($mod_solinsxdoc2->save()) {                                        
                                        $mod_solinsxdoc3 = new SolicitudinsDocumento();
                                        $mod_solinsxdoc3->sins_id = $id_sins;
                                        $mod_solinsxdoc3->int_id = $interesado_id;
                                        $mod_solinsxdoc3->dadj_id = 4;
                                        $mod_solinsxdoc3->sdoc_archivo = $foto_archivo;
                                        $mod_solinsxdoc3->sdoc_estado = "1";
                                        $mod_solinsxdoc3->sdoc_estado_logico = "1";
                                        if ($mod_solinsxdoc3->save()) {                                            
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
                                                        $envi_correo = 1;
                                                        throw new Exception('Error doc certvot no creado.');
                                                    }
                                                }
                                            }                                            
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
                                                    throw new Exception('Error doc beca no creada.');
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
                                throw new Exception('Error solicitud no creada.');
                            }
                        } else {
                            throw new Exception('Tiene que subir todos los documentos.');
                        }
                    }
                } else {
                    //Solicitud ya se encuentra creada.
                    throw new Exception('Ya se encuentra creada una solicitud con los mismos datos.');
                }
                $mod_ordenpago = new OrdenPago();
                //Se verifica si seleccionó descuento.
                $val_descuento=0;
                if (!empty($descuento)) {
                    $modDescuento = new DetalleDescuentoItem();
                    $respDescuento = $modDescuento->consultarValdctoItem($descuento);
                    if ($respDescuento) {
                        if ($precio == 0) {
                            $val_descuento = 0;
                        } else {
                            if ($respDescuento["ddit_tipo_beneficio"] == 'P') {
                                $val_descuento = ($precio*($respDescuento["ddit_porcentaje"]))/100;
                            } else {
                                $val_descuento = $respDescuento["ddit_valor"];
                                }                                
                            //Insertar solicitud descuento
                            if ($val_descuento>0) {
                                $resp_SolicDcto= $mod_ordenpago->insertarSolicDscto($id_sins, $descuento, $precio, $respDescuento["ddit_porcentaje"], $respDescuento["ddit_valor"]);                                  
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
                $val_total = $precio-$val_descuento;
                $resp_opago = $mod_ordenpago->insertarOrdenpago($id_sins, null, $val_total, 0, $val_total, $estadopago, $usu_id);
                if ($resp_opago) {
                    //insertar desglose del pago                                    
                    $fecha_ini = date(Yii::$app->params["dateByDefault"]);                    
                    $resp_dpago = $mod_ordenpago->insertarDesglosepago($resp_opago, $val_total, 0, $val_total, $fecha_ini, null, $estadopago, $usu_id);
                    if ($resp_dpago) {
                        $exito = 1;
                    }
                }
            }
            if ($exito) {
                $transaction->commit();
                $transaction1->commit();
                
                //Envío de correo con formas de pago.                                   
                $informacion_interesado = $mod_ordenpago->datosBotonpago($resp_opago, 'SI');                        
                $link = Url::base(true) . "/formbotonpago/btnpago?ord_pago=" . base64_encode($resp_opago);
                $link_paypal = Url::base(true) ."/pago/pypal?ord_pago=". base64_encode($resp_opago);
                $link1 = Url::base(true);
                $pri_nombre = $informacion_interesado['nombres'];
                $pri_apellido = $informacion_interesado['apellidos'];
                $correo = $informacion_interesado['email'];
                $nombres = $pri_nombre . " " . $pri_apellido;
                $curso = $informacion_interesado['curso'];
                $preciocurso = $resp_precio['precio'];
                $identificacion = $informacion_interesado['identificacion'];
                $telefono = $informacion_interesado['telefono'];                                             
                if ($nint_id==3) {
                    $metodo = 'el curso '.$curso; 
                }  else {
                     $metodo = $resp_precio['nombre_metodo_ingreso']; 
                }
                $carrera = $informacion_interesado["carrera"];                   

                $tituloMensaje = Yii::t("interesado", "UTEG - Registration Online");
                $asunto = Yii::t("interesado", "UTEG - Registration Online");                      
                $body = Utilities::getMailMessage("Paidinterested", array("[[nombre]]" => $nombres, "[[metodo]]" => $metodo, "[[precio]]" => $val_total, "[[link]]" => $link, "[[link1]]" => $link1, "[[link_pypal]]" => $link_paypal), Yii::$app->language);
                $bodyadmision = Utilities::getMailMessage("Paidadmissions", array("[[nombre]]" => $pri_nombre, "[[apellido]]" => $pri_apellido, "[[correo]]" => $correo, "[[identificacion]]" => $identificacion, "[[curso]]" => $curso, "[[telefono]]" => $telefono), Yii::$app->language);
                $bodycolecturia = Utilities::getMailMessage("Approvedapplicationcollected", array("[[nombres_completos]]" => $nombres, "[[metodo]]" => $metodo), Yii::$app->language);
                Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [$correo => $pri_apellido . " " . $pri_nombre], $asunto, $body);
                Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [Yii::$app->params["admisiones"] => "Jefe"], $asunto, $bodyadmision);
                Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [Yii::$app->params["soporteEmail"] => "Soporte"], $asunto, $body);
                Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [Yii::$app->params["soporteEmail"] => "Soporte"], $asunto, $bodyadmision);
                Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [Yii::$app->params["colecturia"] => "Colecturia"], $asunto, $bodycolecturia);
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "La infomación ha sido grabada. Por favor verifique su correo."),
                    "title" => Yii::t('jslang', 'Success'),
                );
                return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
            } else {
                $transaction->rollback();
                $transaction1->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $mensaje),
                    "title" => Yii::t('jslang', 'Success'),
                );
                return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
            }
        } catch (Exception $ex) {            
            $transaction->rollback();
            $transaction1->rollback();
            //Utilities::putMessageLogFile($mod_solins->getErrors());
            $message = array(
                "wtmessage" => $ex->getMessage(),
                "title" => Yii::t('jslang', 'Error.' . $mensaje),
            );
            return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), false, $message);
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
        $nint = base64_decode($_GET['nint']);        
        $mod_persona = Persona::findIdentity($per_id);
        $nacionalidad = $mod_persona->per_nac_ecuatoriano;

        $mod_solins = new SolicitudInscripcion();
        $resp_arch1 = $mod_solins->Obtenerdocumentosxsolicitud($sins_id, 1);
        $resp_arch2 = $mod_solins->Obtenerdocumentosxsolicitud($sins_id, 2);
        $resp_arch3 = $mod_solins->Obtenerdocumentosxsolicitud($sins_id, 3);
        $resp_arch4 = $mod_solins->Obtenerdocumentosxsolicitud($sins_id, 4);
        $resp_arch5 = $mod_solins->Obtenerdocumentosxsolicitud($sins_id, 5);
        
        $mod_ordenpago = new OrdenPago();
        $resp_ordenpago = $mod_ordenpago->consultarImagenpago($sins_id);
        $img_pago = $resp_ordenpago["imagen_pago"];
        
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
                    "nint_id" => $nint,
                    "img_pago" => $img_pago,
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
                $mod_ordenpago = new OrdenPago();
                $respusuario = $mod_solins->consultaDatosusuario($per_sistema);
                if ($banderapreaprueba == 0) {  //etapa de Aprobación.                                    
                    if ($resultado == 2) { 
                        //consultar estado del pago.     
                        Utilities::putMessageLogFile('solicitud:'.$sins_id);
                        $resp_pago = $mod_ordenpago->consultaOrdenPago($sins_id);    
                        if ($resp_pago["opag_estado_pago"] == 'S') {  
                            Utilities::putMessageLogFile('solicitud:'.$resp_pago["opag_estado_pago"]);
                            $respsolins = $mod_solins->apruebaSolicitud($sins_id, $resultado, $observacion, $banderapreaprueba, $respusuario['usu_id']);                         
                            if ($respsolins) {                                   
                                //Se genera id de aspirante y correo de bienvenida.                                
                                $resp_encuentra = $mod_ordenpago->encuentraAspirante($int_id);                                
                                if ($resp_encuentra) {                                     
                                    $asp = $resp_encuentra['asp_id'];                                  
                                    $continua = 1;
                                } else {
                                    //Se asigna al interesado como aspirante                                    
                                    $resp_asp = $mod_ordenpago->insertarAspirante($int_id);                                                                     
                                    if ($resp_asp) {  
                                        Utilities::putMessageLogFile('inserción');
                                        $asp = $resp_asp;  
                                        $continua = 1; 
                                    }    
                                }                                             
                            }                            
                            if ($continua == 1) {   
                                $resp_inte = $mod_ordenpago->actualizaEstadointeresado($int_id, $respusuario['usu_id']);                                                                             
                                if ($resp_inte) {     
                                    //Se obtienen el método de ingreso y el nivel de interés según la solicitud.                                                
                                    $resp_sol = $mod_solins->Obtenerdatosolicitud($sins_id);
                                    //Se obtiene el curso para luego registrarlo.
                                    if ($resp_sol) {  
                                        $mod_persona = new Persona();
                                        \app\models\Utilities::putMessageLogFile('perId:' . $per_id);   
                                        $resp_persona = $mod_persona->consultaPersonaId($per_id);                                        
                                        $correo = $resp_persona["usu_user"];
                                        $apellidos = $resp_persona["per_pri_apellido"];
                                        $nombres = $resp_persona["per_pri_nombre"];
                                        //información del aspirante.
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
                                        $modalidad = ($resp_sol["nombre_modalidad"]);                            

                                        if ($resp_sol["nivel_interes"]==1){  //Grado
                                            switch ($resp_sol["mod_id"]) {
                                                case 1:
                                                    $file1 = Url::base(true) . "/files/Bienvenida UTEG ONLINE.pdf";
                                                    $rutaFile = array($file1);  
                                                    break;
                                                case 2:
                                                    $file1 = Url::base(true) . "/files/BienvenidaPresencial.pdf";
                                                    $rutaFile = array($file1);  
                                                    break;
                                                case 3:
                                                    $file1 = Url::base(true) . "/files/BienvenidaSemiPresencial.pdf";
                                                    $rutaFile = array($file1);  
                                                    break;
                                            }
                                        } else {
                                            if ($resp_sol["nivel_interes"]==2){   //Posgrado
                                                $file1 = Url::base(true) . "/files/BienvenidaPosgrado.pdf";
                                                $rutaFile = array($file1);  
                                            }
                                        }
                                        $tituloMensaje = Yii::t("interesado", "UTEG - Registration Online");
                                        $asunto = Yii::t("interesado", "UTEG - Registration Online");
                                        $body = Utilities::getMailMessage("Applicantrecord", array("[[nombre]]" => $nombres, "[[apellido]]" => $apellidos, "[[modalidad]]" => $modalidad, "[[link]]" => $link), Yii::$app->language);                                        
                                       // if (!empty($rutaFile)) {
                                       //     Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [$correo => $apellidos . " " . $nombres], $asunto, $body, $rutaFile);
                                       // } else {
                                            Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [$correo => $apellidos . " " . $nombres], $asunto, $body);
                                       // }
                                        Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [Yii::$app->params["soporteEmail"] => "Soporte"], $asunto, $body);
                                        $exito = 1;
                                    }
                                }
                            }
                        } else {
                                $mensaje = 'La solicitud se encuentra pendiente de pago.';
                            }                             
                    } else { //No aprueban la solicitud  
                        $respsolins = $mod_solins->apruebaSolicitud($sins_id, $resultado, $observacion, $banderapreaprueba, $respusuario['usu_id']);                         
                        if ($respsolins) {
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
                } 
            } else {  //Pre-Aprobación de la solicitud                
                if ($resultado == 3) {  
                    //Verificar que se hayan subido los documentos.
                    $respConsulta = $mod_solins->consultarDocumxSolic($sins_id);
                    if ($respConsulta['numDocumentos']>0) {
                        $respsolins = $mod_solins->apruebaSolicitud($sins_id, $resultado, $observacion, $banderapreaprueba, $respusuario['usu_id']);  $mensaje = 3;
                        if ($respsolins) {
                            $exito = 1;
                        }
                    } else {
                        $mensaje='No se han subido los documentos.';
                    }                    
                } else {
                    if ($resultado == 4) {
                        $respsolins = $mod_solins->apruebaSolicitud($sins_id, $resultado, $observacion, $banderapreaprueba, $respusuario['usu_id']);
                        if ($respsolins) {
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
                            $ok = "0";
                        }
                        if ($ok == "1") {
                            Utilities::putMessageLogFile($sins_id);                            
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
            }
            if ($exito) {
                $transaction->commit();
                $transaction2->commit();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "La información ha sido grabada."),
                    "title" => Yii::t('jslang', 'Success'),
                );
                return \app\models\Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
            } else {
                //$paso = 1;
                $transaction->rollback();
                $transaction2->rollback();
                if (empty($message)) {
                    $message = array
                        (
                        "wtmessage" => Yii::t("notificaciones", "Error al grabar. " . $mensaje), "title" =>
                        Yii::t('jslang', 'Success'),
                    );
                }
                return \app\models\Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
            }
          } catch (Exception $ex) {                
                $transaction->rollback();
                $transaction2->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $mensaje),
                    "title" => Yii::t('jslang', 'Success'),
                );
                return \app\models\Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
            }
            return;
        }
    }

    public function actionExpexcel() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $data = Yii::$app->request->get();
        $per_ids = base64_decode($data['ids']);
        $arrSearch["search"] = $data["search"];
        $arrSearch["carrera"] = $data["carrera"];
        $arrSearch["f_ini"] = $data["f_ini"];
        $arrSearch["f_fin"] = $data["f_fin"];
        $arrData = array();
        if (empty($per_ids)) {  //vista para el interesado
            $arrData = SolicitudInscripcion::getSolicitudesXInteresado($per_id, $arrSearch, true);
        } else {   //vista para el jefe o agente.
            $arrData = SolicitudInscripcion::getSolicitudesXInteresado($per_ids, $arrSearch, true);
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
            Yii::t("formulario", "Last Names"),
            Yii::t("solicitud_ins", "Level Inter"),
            Yii::t("solicitud_ins", "Income Method"),
            Yii::t("academico", "Career"),
            Yii::t("formulario", "Status"),
            "Pago");
        $nameReport = yii::t("formulario", "Application Reports");
        $colPosition = array("C", "D", "E", "F", "G", "H", "I", "J", "K", "L");
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

    public function actionListarsolaprobadmin() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $per_ids = base64_decode($_GET['ids']);

        $data = Yii::$app->request->get();

        if ($data['PBgetFilter']) {
            $arrSearch["f_ini"] = $data['f_ini'];
            $arrSearch["f_fin"] = $data['f_fin'];
            $arrSearch["search"] = $data['search'];
            $mod_solicitud = new SolicitudInscripcion();
            $resp_solicitud = $mod_solicitud->Solicitudesaprobadas($arrSearch);

            return $this->renderPartial('_listarSolapradmGrid', [
                        "model" => $resp_solicitud,
            ]);
        } else {
            $mod_solicitud = new SolicitudInscripcion();
            $resp_solicitud = $mod_solicitud->Solicitudesaprobadas();
        }

        return $this->render('listarSolaprobAdmin', [
                    'model' => $resp_solicitud,
        ]);
    }

    public function actionAnular() {
        $sins_id = base64_decode($_GET['ids']);
        $apellidos = base64_decode($_GET['apellidos']);
        $nombres = base64_decode($_GET['nombres']);
        $nivelint = base64_decode($_GET['nint_nombre']);
        $carrera = base64_decode($_GET['car_nombre']);
        $per_id = base64_decode($_GET['perid']);
        $mod_persona = Persona::findIdentity($per_id);
        $nacionalidad = $mod_persona->per_nac_ecuatoriano;

        return $this->render('anular', [
                    "cliente" => $apellidos . ' ' . $nombres,
                    "nivelint" => $nivelint,
                    "carrera" => $carrera,
                    "sins_id" => $sins_id,
                    "per_id" => $per_id,
                    "txth_extranjero" => $nacionalidad,
        ]);
    }

    public function actionGrabaranulacion() {
        $per_sistema = @Yii::$app->session->get("PB_perid");
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $resultado = 5;  //Estado de anulado.
            $sins_id = $data["sins_id"];
            $observacion = ucwords(strtolower($data["observacion"]));
            $banderapreaprueba = 0;
            $estado_pago = 'A';
            $srec_etapa = 'A';

            $con = \Yii::$app->db_captacion;
            $transaction = $con->beginTransaction();
            $con2 = \Yii::$app->db_facturacion;
            $transaction2 = $con2->beginTransaction();
            try {
                $mod_solins = new SolicitudInscripcion();
                $mod_ordpago = new OrdenPago();
                $respusuario = $mod_solins->consultaDatosusuario($per_sistema);
                //Consultar orden de pago y su estado.
                $resp_ordenpago = $mod_ordpago->consultaOrdenPago($sins_id);
                if ($resp_ordenpago["opag_estado_pago"] == "P") {   //Si la orden de pago está pendiente.
                    //La solicitud se coloca en estado de Anulado.                    
                    $respsolins = $mod_solins->apruebaSolicitud($sins_id, $resultado, $observacion, $banderapreaprueba, $respusuario['usu_id']);
                    if ($respsolins) {
                        //Se inserta en solicitudes rechazadas el motivo de la anulación.
                        $resp_rechazo = $mod_solins->Insertarsolicitudrechazada($sins_id, null, null, $srec_etapa, $observacion, $respusuario['usu_id']);
                        if ($resp_rechazo) {
                            $respOrdenPago = $mod_ordpago->actualizaOrdenpago($resp_ordenpago["opag_id"], $estado_pago, null, null, $respusuario['usu_id']);
                            if ($respOrdenPago) {
                                $respDesglose = $mod_ordpago->actualizaDesglosepago($resp_ordenpago["dpag_id"], $estado_pago, $respusuario['usu_id']);
                                if ($respDesglose) {
                                    $respInsertAnula = $mod_ordpago->insertarOrdenAnulada($resp_ordenpago["opag_id"], $sins_id, $observacion, $respusuario['usu_id']);
                                    if ($respInsertAnula) {
                                        $exito = 1;
                                    }
                                }
                            }
                        }
                    }
                } else {
                    $mensaje = "Orden de pago no se encuentra pendiente de pago.";
                }
                if ($exito) {
                    $transaction->commit();
                    $transaction2->commit();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "La información ha sido grabada."),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return \app\models\Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                } else {
                    $transaction->rollback();
                    $transaction2->rollback();
                    if (empty($message)) {
                        $message = array
                            (
                            "wtmessage" => Yii::t("notificaciones", "Error al grabar. " . $mensaje), "title" =>
                            Yii::t('jslang', 'Success'),
                        );
                    }
                    return \app\models\Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $transaction2->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $mensaje),
                    "title" => Yii::t('jslang', 'Success'),
                );
                return \app\models\Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
            }
            return;
        }
    }

    public function actionSubirdocumentos() {
        $solicitud = base64_decode($_GET['solicitud']);
        $apellidos = base64_decode($_GET['apellidos']);
        $nombres = base64_decode($_GET['nombres']);
        $nacionalidad = base64_decode($_GET['nacionalidad']);
        if (empty($nacionalidad)) {
            $nacionalidad=0;
        }
        $per_id = $_GET['ids'];
        $sins_id = $_GET['sins_id'];
        $int_id = $_GET['int_id'];
        $beca = $_GET['beca'];

        return $this->render('subirDocumentos', [
                    "cliente" => $apellidos . ' ' . $nombres,
                    "solicitud" => $solicitud,
                    "txth_extranjero" => $nacionalidad,
                    "per_id" => $per_id,
                    "sins_id" => $sins_id,
                    "int_id" => $int_id,
                    "beca" => $beca,
        ]);
    }

    public function actionGuardardocumentos() {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if ($_SESSION['persona_solicita'] != '') {// tomar el de parametro)
                $per_id = $_SESSION['persona_solicita'];
            } else {
                unset($_SESSION['persona_ingresa']);
                $per_id = Yii::$app->session->get("PB_perid");
            }
            //$per_id = @Yii::$app->session->get("PB_perid");
            $sins_id = $data["sins_id"];
            $interesado_id = $data["interesado_id"];
            $es_extranjero = $data["arc_extranjero"];
            $beca = $data["beca"];
            if ($data["upload_file"]) {
                if (empty($_FILES)) {
                    return json_encode(['error' => Yii::t("notificaciones", "Error to process File {file}. Try again.", ['{file}' => basename($files['name'])])]);
                    return;
                }
                //Recibe Parámetros.
                $files = $_FILES[key($_FILES)];
                $arrIm = explode(".", basename($files['name']));
                $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                $dirFileEnd = Yii::$app->params["documentFolder"] . "solicitudinscripcion/" . $per_id . "/" . $data["name_file"] . "_per_" . $per_id . "." . $typeFile;
                $status = Utilities::moveUploadFile($files['tmp_name'], $dirFileEnd);
                if ($status) {
                    return true;
                } else {
                    return json_encode(['error' => Yii::t("notificaciones", "Error to process File {file}. Try again.", ['{file}' => basename($files['name'])])]);
                    return;
                }
                $titulo_archivo = "";
                if (isset($data["arc_doc_titulo"]) && $data["arc_doc_titulo"] != "") {
                    $arrIm = explode(".", basename($data["arc_doc_titulo"]));
                    $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                    $titulo_archivo = Yii::$app->params["documentFolder"] . "solicitudinscripcion/" . $per_id . "/doc_titulo_per_" . $per_id . "." . $typeFile;
                }
                $dni_archivo = "";
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
            if (!empty($titulo_archivo) && !empty($dni_archivo) && !empty($foto_archivo)) {
                Utilities::putMessageLogFile('aqui entro');
                if (!empty($titulo_archivo)) {
                    Utilities::putMessageLogFile("s1");
                    $mod_solinsxdoc1 = new SolicitudinsDocumento();
                    //1-Título, 2-DNI,3-Cert votación, 4-Foto, 5-Doc-Beca                       
                    $mod_solinsxdoc1->sins_id = $sins_id;
                    $mod_solinsxdoc1->int_id = $interesado_id;
                    $mod_solinsxdoc1->dadj_id = 1;
                    $mod_solinsxdoc1->sdoc_archivo = $titulo_archivo;
                    $mod_solinsxdoc1->sdoc_estado = "1";
                    $mod_solinsxdoc1->sdoc_estado_logico = "1";
                    Utilities::putMessageLogFile('sol:'.$sins_id);
                    if ($mod_solinsxdoc1->save()) {
                        Utilities::putMessageLogFile("s2");
                        $mod_solinsxdoc2 = new SolicitudinsDocumento();
                        $mod_solinsxdoc2->sins_id = $sins_id;
                        $mod_solinsxdoc2->int_id = $interesado_id;
                        $mod_solinsxdoc2->dadj_id = 2;
                        $mod_solinsxdoc2->sdoc_archivo = $dni_archivo;
                        $mod_solinsxdoc2->sdoc_estado = "1";
                        $mod_solinsxdoc2->sdoc_estado_logico = "1";

                        if ($mod_solinsxdoc2->save()) {
                            Utilities::putMessageLogFile("s3");
                            $mod_solinsxdoc3 = new SolicitudinsDocumento();
                            $mod_solinsxdoc3->sins_id = $sins_id;
                            $mod_solinsxdoc3->int_id = $interesado_id;
                            $mod_solinsxdoc3->dadj_id = 4;
                            $mod_solinsxdoc3->sdoc_archivo = $foto_archivo;
                            $mod_solinsxdoc3->sdoc_estado = "1";
                            $mod_solinsxdoc3->sdoc_estado_logico = "1";

                            if ($mod_solinsxdoc3->save()) {
                                Utilities::putMessageLogFile("s4");
                                if ($es_extranjero == "1") {
                                    $mod_solinsxdoc4 = new SolicitudinsDocumento();
                                    $mod_solinsxdoc4->sins_id = $sins_id;
                                    $mod_solinsxdoc4->int_id = $interesado_id;
                                    $mod_solinsxdoc4->dadj_id = 3;
                                    $mod_solinsxdoc4->sdoc_archivo = $certvota_archivo;
                                    $mod_solinsxdoc4->sdoc_estado = "1";
                                    $mod_solinsxdoc4->sdoc_estado_logico = "1";

                                    if (!$mod_solinsxdoc4->save()) {
                                        Utilities::putMessageLogFile("1");
                                        throw new Exception('Error doc certvot no creado.');
                                    }
                                }
                                Utilities::putMessageLogFile("s5");
                                if ($beca == "1") {
                                    $mod_solinsxdoc5 = new SolicitudinsDocumento();
                                    $mod_solinsxdoc5->sins_id = $sins_id;
                                    $mod_solinsxdoc5->int_id = $interesado_id;
                                    $mod_solinsxdoc5->dadj_id = 5;
                                    $mod_solinsxdoc5->sdoc_archivo = $beca_archivo;
                                    $mod_solinsxdoc5->sdoc_estado = "1";
                                    $mod_solinsxdoc5->sdoc_estado_logico = "1";
                                    if (!$mod_solinsxdoc5->save()) {
                                        throw new Exception('Error doc beca no creado.');
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
                    $transaction->commit();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "La infomación ha sido grabada."),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                } else {
                    Utilities::putMessageLogFile($mod_solins->getErrors());
                    throw new Exception('Tiene que subir todos los documentos.Titulo:' . isset($data["arc_doc_titulo"]) . 'Persona:' . $per_id);
                }
            }
        } catch (Exception $ex) {
            Utilities::putMessageLogFile("55");
            $transaction->rollback();
            //Utilities::putMessageLogFile($mod_solins->getErrors());
            $message = array(
                "wtmessage" => $ex->getMessage(),
                "title" => Yii::t('jslang', 'Error'),
            );
            return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), false, $message);
        }
    }


}
