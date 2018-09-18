<?php

namespace app\modules\admision\controllers;
use app\models\Utilities;
use app\modules\admision\models\SolicitudInscripcion;
use app\modules\admision\models\MetodoIngreso;
use app\modules\admision\models\EstudioAcademico;
use app\modules\admision\models\Modalidad;
use app\modules\admision\models\Oportunidad;
use app\modules\admision\models\ModuloEstudio;
use app\modules\admision\models\ItemMetodoNivel;
use app\modules\admision\models\DetalleDescuentoItem;
use app\modules\admision\models\Persona;
use app\modules\admision\models\UnidadAcademica;
use app\modules\admision\models\SolicitudinsDocumento;
use app\modules\admision\models\OrdenPago;
use app\modules\admision\models\Interesado;
use yii\helpers\Url;
use yii\base\Exception;
use yii\helpers\ArrayHelper;
use Yii;

class SolicitudesController extends \app\components\CController {

    public function actionIndex() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $per_ids = base64_decode($_GET['ids']);                
        $data = Yii::$app->request->get();
        $modSolicitud = new SolicitudInscripcion();
        $modEstacademico = new EstudioAcademico();
        
        if ($data['PBgetFilter']) {
            $arrSearch["f_ini"] = $data['f_ini'];
            $arrSearch["f_fin"] = $data['f_fin'];
            $arrSearch["carrera"] = $data['carrera'];
            $arrSearch["estadoSol"] = $data['estadoSol'];
            $arrSearch["search"] = $data['search'];
                      
            $respSolicitud = $modSolicitud->consultarSolicitudes($arrSearch);                      
        } else {
            $respSolicitud = $modSolicitud->consultarSolicitudes();                      
        }
        $arrCarreras = ArrayHelper::map(array_merge([["id" => "0", "value" => Yii::t("formulario", "Grid")]], $modEstacademico->consultarCarrera()), "id", "value");
        $resp_estados = $modSolicitud->Consultaestadosolicitud();
        $arrEstados = ArrayHelper::map(array_merge([["id" => "0", "value" => Yii::t("formulario", "Grid")]], $resp_estados), "id", "value");         
        return $this->render('index', [
                        'model' => $respSolicitud,
                        'arrCarreras' => $arrCarreras,
                        'arrEstados' => $arrEstados
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
        $inte_id = base64_decode($_GET['id']);
        $mod_carrera = new EstudioAcademico();
        $SolIns_model=new SolicitudInscripcion();
        $model = null;
        $fac_id = 1;
        $data = Yii::$app->request->get();

        if ($data['PBgetFilter']) {
            $arrSearch["f_ini"] = $data['f_ini'];
            $arrSearch["f_fin"] = $data['f_fin'];
            $arrSearch["carrera"] = $data['carrera'];
            $arrSearch["estado"] = $data['estado'];
            $arrSearch["search"] = $data['search'];
            
            $model = $SolIns_model->getSolicitudesXInteresado($inte_id, $arrSearch);      
        } else {
            if (empty($per_ids)) {  //vista para el interesado
                $model = $SolIns_model->getSolicitudesXInteresado($inte_id);            
            }
        }

        $arrCarreras = ArrayHelper::map(array_merge([["id" => "0", "value" => Yii::t("formulario", "Grid")]], $mod_carrera->consultarCarrera()), "id", "value");
        $arrEstados = ArrayHelper::map([["id" => "P", "value" => "Pendiente"], ["id" => "S", "value" => "Pagado"], ["id" => "NA", "value" => "No Disponible"]], "id", "value");
        return $this->render('listarSolicitudxinteresado', [
                    'model' => $model,
                    'arrCarreras' => $arrCarreras,
                    'arrEstados' => $arrEstados
        ]);
    }

    public function actionView() {
        
    }

    public function actionEdit() {
        
    }

    public function actionNew() {
        $mod_metodo = new MetodoIngreso();
        $per_id = @Yii::$app->session->get("PB_perid");
        $mod_persona = Persona::findIdentity($per_id);
        $mod_carrera = new EstudioAcademico();
        $mod_modalidad = new Modalidad();
        $modcanal = new Oportunidad();
        $modestudio = new ModuloEstudio();
        $modItemMetNivel = new ItemMetodoNivel();
        $modDescuento = new DetalleDescuentoItem();
        $modUnidad = new UnidadAcademica();

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
                $descuentos = $modDescuento->consultarDesctoxitem($resItem["ite_id"]);
                $message = array("descuento" => $descuentos);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }
        }
        $arr_unidadac = $modUnidad->consultarUnidadAcademicas();
        $arr_modalidad = $mod_modalidad->consultarModalidad(1);
        $arr_metodos = $mod_metodo->consultarMetodoIngNivelInt($arr_unidadac[0]["id"]);
        $arr_carrera = $modcanal->consultarCarreraModalidad(1, 1);
        //Descuentos.
        $resp_item = $modItemMetNivel->consultarXitemMetniv(1, 1, 1);
        $arr_descuento = $modDescuento->consultarDesctoxitem($resp_item["ite_id"]);
        return $this->render('new', [
                    "arr_unidad" => ArrayHelper::map($arr_unidadac, "id", "name"),
                    "arr_metodos" => ArrayHelper::map($arr_metodos, "id", "name"),
                    "txth_extranjero" => $mod_persona->per_nac_ecuatoriano,
                    "arr_carrera" => ArrayHelper::map($arr_carrera, "id", "name"),
                    "arr_modalidad" => ArrayHelper::map($arr_modalidad, "id", "name"),
                    "arr_descuento" => ArrayHelper::map($arr_descuento, "id", "name"),
                    "item" => $resp_item["ite_id"]
        ]);
    }

    public function actionSave() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $usu_id = @Yii::$app->session->get("PB_iduser");
        $envi_correo = 0;
        $es_nacional = " ";
        $valida = " ";
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
            $marca_desc = $data["marcadescuento"];
            if ($marca_desc == '1' && $marca_desc == '0') {
                $valida = 1;
            }
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
            if ($nint_id > '0'  and $ming_id > '0' and $mod_id > '0' and $car_id > '0' and $valida = 1) {
            $sins_fechasol = date(Yii::$app->params["dateTimeByDefault"]);
            if (($nint_id == 3) or empty($nint_id)) {
                $ming_id = null; //Curso.
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
                                $resp_SolicDcto = $mod_ordenpago->insertarSolicDscto($id_sins, $descuento, $precio, $respDescuento["ddit_porcentaje"], $respDescuento["ddit_valor"]);
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
                $link_paypal = Url::base(true) . "/pago/pypal?ord_pago=" . base64_encode($resp_opago);
                $link1 = Url::base(true);
                $pri_nombre = $informacion_interesado['nombres'];
                $pri_apellido = $informacion_interesado['apellidos'];
                $correo = $informacion_interesado['email'];
                $nombres = $pri_nombre . " " . $pri_apellido;
                $curso = $informacion_interesado['curso'];
                $preciocurso = $resp_precio['precio'];
                $identificacion = $informacion_interesado['identificacion'];
                $telefono = $informacion_interesado['telefono'];
                if ($nint_id == 3) {
                    $metodo = 'el curso ' . $curso;
                } else {
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
            } else {
                $transaction->rollback();
                $transaction1->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error al grabar. Debe seleccionar opciones de las listas"),
                    "title" => Yii::t('jslang', 'Success'),
                );
                return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), false, $message);
            }
        } catch (Exception $ex) {
            $transaction->rollback();
            $transaction1->rollback();      
            $message = array(
                "wtmessage" => $ex->getMessage(),
                "title" => Yii::t('jslang', 'Error.' . $mensaje),
            );
            return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), false, $message);
        }
    }

    public function actionUpdate() {
        
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
    
    public function actionSavedocumentos() {
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
