<?php

namespace app\controllers;

use Yii;
use app\models\Utilities;
use yii\helpers\ArrayHelper;
use yii\base\Exception;
use app\models\Persona;
use app\models\EmpresaPersona;
use app\modules\admision\models\ItemMetodoUnidad;
use \app\modules\admision\models\SolicitudInscripcion;
use app\models\Pais;
use app\modules\admision\models\Interesado;
use app\modules\admision\models\InteresadoEmpresa;
use app\models\Usuario;
use yii\base\Security;
use app\models\UsuaGrolEper;
use app\models\Provincia;
use app\modules\financiero\models\OrdenPago;
use app\modules\financiero\models\PersonaBeneficiaria;
use app\modules\financiero\models\SolicitudBotonPago;
use app\modules\financiero\models\DetalleSolicitudBotonPago;
use app\modules\financiero\models\Documento;
use app\modules\financiero\models\Item;
use app\modules\financiero\models\TipoDocumento;
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
//use app\models\Secuencias;
use app\models\InscripcionAdmision;

class PagosfrecuentesController extends \yii\web\Controller {

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
        $mod_solins = new SolicitudInscripcion();
        $modItemMetNivel = new ItemMetodoUnidad();
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
            if (isset($data["getmetodo"])) {
                $metodos = $mod_metodo->consultarMetodoUnidadAca_2($data['nint_id']);
                $message = array("metodos" => $metodos);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
            if (isset($data["getitem"])) {
                if ($data["empresa_id"] != 1) {
                    $metodo = 0;
                } else {
                    if ($data["unidada"] != 1) {
                        $metodo = $data["metodo"];
                    } else {
                        $metodo = 0;
                    }
                }
                $resItem = $modItemMetNivel->consultarXitemPrecio($data["unidada"], $data["moda_id"], $metodo, $data["carrera_id"], $data["empresa_id"]);
                $message = array("items" => $resItem);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
            if (isset($data["getprecio"])) {
                $resp_precio = $mod_solins->ObtenerPrecioXitem($data["ite_id"]);
                $message = array("precio" => $resp_precio["precio"]);
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
        $resp_item = $modItemMetNivel->consultarXitemPrecio(1, 4, 0, 1, 1);
        $resp_precio = $mod_solins->ObtenerPrecioXitem($resp_item[0]["id"]);
        $arr_carrerra1 = $modcanal->consultarCarreraModalidad(1, $arr_modalidad[0]["id"]);
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
                    "arr_item" => ArrayHelper::map($resp_item, "id", "name"),
                    "txt_precio" => $resp_precio['precio'],
                    "arr_modalidad" => ArrayHelper::map($arr_modalidad, "id", "name"),
                    "arr_conuteg" => ArrayHelper::map($arr_conuteg, "id", "name"),
                    "arr_carrerra1" => ArrayHelper::map($arr_carrerra1, "id", "name"),
                    "arr_metodos" => ArrayHelper::map($arr_metodos, "id", "name"),
                    "resp_datos" => $resp_datos,
        ]);
    }

    public function actionSavepayment() {
        $pben_model = new PersonaBeneficiaria();
        $sbp_model = new SolicitudBotonPago();
        $dsbp_model = new DetalleSolicitudBotonPago();
        $item_model = new Item();
        $doc_model = new Documento();        
        if (Yii::$app->request->isAjax) {
            $con1 = \Yii::$app->db_facturacion;
            $item_ids = array();
            $mensaje = "";
            $data = Yii::$app->request->post();
            $dataBeneficiario = $data["dataBenList"];
            $cedula = $dataBeneficiario["cedula"];
            $transaction = $con1->beginTransaction();
            try {                
                \app\models\Utilities::putMessageLogFile('cedula: ' . $cedula);
                \app\models\Utilities::putMessageLogFile('nombre: ' . $dataBeneficiario["nombre"]);
                \app\models\Utilities::putMessageLogFile('apellido: ' . $dataBeneficiario["apellido"]);
                \app\models\Utilities::putMessageLogFile('correo: ' . $dataBeneficiario["correo"]);
                \app\models\Utilities::putMessageLogFile('celular: ' . $dataBeneficiario["celular"]);
                $id_pben=$pben_model->getIdPerBenByCed($cedula);    
                \app\models\Utilities::putMessageLogFile('result: ' . $id_pben["id"]);                
                if(empty($id_pben["id"])){                                    
                \app\models\Utilities::putMessageLogFile('assd: ' . $entro);
                    $id_pbens = $pben_model->insertPersonaBeneficia($con1, $cedula, $dataBeneficiario["nombre"], $dataBeneficiario["apellido"], $dataBeneficiario["correo"], $dataBeneficiario["celular"]);
                }
                if ($id_pbens > 0) {                    
                    /*\app\models\Utilities::putMessageLogFile('sdd: ' . $entro);
                    \app\models\Utilities::putMessageLogFile('ingreso beneficiario');                    
                    // $idsbp=$sbp_model->insertSolicitudBotonPago($con1,$id_pben);
                    if ($idsbp > 0) {
                        $entro = 22;
                        for ($i = 0; $i < count($item_ids); $i++) {
                            $item_precio = $item_model->getPrecios($item_ids[$i]);
                            $id_dsbp = $dsbp_model->insertarDetSolBotPag($con1, $idsbp, $item_ids[$i], $item_precio);
                            if ($id_dsbp > 0) {
                                $mensaje = $mensaje . "";
                            }
                        }
                        $iddoc = $doc_model->insertDocumento($idsbp);
                        if ($iddoc > 0) {
                            $mensaje = $mensaje . "Se ha guardado exitosamente su solicitud de Pago.";
                        } else {
                            $mensaje = $mensaje . "No se ha guardado el documento de factura";
                        }
                    } else {
                        $mensaje = $mensaje . "No se ha guardado la solicitud del boton";
                    }
                } else {
                    $mensaje = $mensaje . "No se ha guardado el beneficiario";
                }*/

                $transaction->commit();
                }
            } catch (Exception $ex) {
                $entro = 7;
                $transaction->rollBack();
            }            
            $message = array(
                "wtmessage" => "ha entrado al servidor - cedula:" . $entro,
                "title" => "Informacion",
            );
            return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Ok'), 'true', $message);
        }
    }

    public function actionSavepagodinner() {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $dataGet = Yii::$app->request->get();
            $con1 = \Yii::$app->db_facturacion;
            $emp_id = @Yii::$app->session->get("PB_idempresa");
            $referenceID = isset($data["referenceID"]) ? $data["referenceID"] : null;
            if (!is_null($referenceID)) {
                try {
                    $transaction = $con1->beginTransaction();
                    $sins_id = $data["sins_id"]; //base64_decode($dataGet["sins_id"]);
                    $solInc_mod = SolicitudInscripcion::findOne($sins_id);
                    $opago_mod = OrdenPago::findOne(["sins_id" => $sins_id, "opag_estado_pago" => "P", "opag_estado" => "1", "opag_estado_logico" => "1"]);

                    $response = $this->render('btnpago', array(
                        "referenceID" => $data["resp"]["reference"],
                        "requestID" => $data["requestID"],
                        "ordenPago" => $opago_mod->opag_id,
                        "response" => $data["resp"],
                    ));
                    if ($data["resp"]["status"]["status"] == "APPROVED") {
                        $opago_mod->opag_estado_pago = "S";
                        $opago_mod->opag_valor_pagado = $opago_mod->opag_total;
                        $opago_mod->opag_fecha_pago_total = date("Y-m-d H:i:s");
                        $opago_mod->opag_usu_modifica = @Yii::$app->session->get("PB_iduser");
                        $opago_mod->opag_fecha_modificacion = date("Y-m-d H:i:s");
                        $message = array(
                            "wtmessage" => Yii::t("notificaciones", "Your information was successfully saved."),
                            "title" => Yii::t('jslang', 'Success'),
                                //"data" => $response,
                        );
                        if ($opago_mod->save()) {
                            $dpag_mod = DesglosePago::findOne(["opag_id" => $opago_mod->opag_id, "dpag_estado_pago" => "P", "dpag_estado" => "1", "dpag_estado_logico" => "1"]);
                            $dpag_mod->dpag_estado_pago = "S";
                            $dpag_mod->dpag_usu_modifica = @Yii::$app->session->get("PB_iduser");
                            $dpag_mod->dpag_fecha_modificacion = date("Y-m-d H:i:s");
                            if ($dpag_mod->save()) {
                                $regpag_mod = new RegistroPago();
                                $regpag_mod->dpag_id = $dpag_mod->dpag_id;
                                $regpag_mod->fpag_id = 6; // boton de pagos
                                $regpag_mod->rpag_valor = $opago_mod->opag_total;
                                $regpag_mod->rpag_fecha_pago = $opago_mod->opag_fecha_pago_total;
                                $regpag_mod->rpag_revisado = "RE";
                                $regpag_mod->rpag_resultado = "AP";
                                $regpag_mod->rpag_num_transaccion = $referenceID;
                                $regpag_mod->rpag_fecha_transaccion = $opago_mod->opag_fecha_pago_total;
                                $regpag_mod->rpag_usuario_transaccion = @Yii::$app->session->get("PB_iduser");
                                $regpag_mod->rpag_codigo_autorizacion = "";
                                $regpag_mod->rpag_estado = "1";
                                $regpag_mod->rpag_estado_logico = "1";
                                if ($regpag_mod->save()) {
                                    $transaction->commit();
                                    return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                                } else {
                                    Utilities::putMessageLogFile("Boton Pagos: Error al crear Registro Pago. RefId: " . $referenceID . " Error: " . json_encode($regpag_mod->errors));
                                    throw new Exception('Error al crear Registro Pago.' . json_encode($regpag_mod->errors));
                                }
                            } else {
                                Utilities::putMessageLogFile("Boton Pagos: Error al actualizar Desglose Pago RefId: " . $referenceID . " Error: " . json_encode($dpag_mod->errors));
                                throw new Exception('Error al actualizar Desglose Pago.' . json_encode($dpag_mod->errors));
                            }
                        } else {
                            Utilities::putMessageLogFile("Boton Pagos: Error al actualizar pago. RefId: " . $referenceID . " Error: " . json_encode($opago_mod->errors));
                            throw new Exception('Error al actualizar pago.' . json_encode($opago_mod->errors));
                        }
                    } else {
                        $message = array(
                            "wtmessage" => $data["resp"]["status"]["message"],
                            "title" => Yii::t('jslang', 'Error'),
                        );
                        return Utilities::ajaxResponse('NOOK', 'alert', Yii::t('jslang', 'Error'), 'true', $message);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                    Utilities::putMessageLogFile("Boton Pagos: Error . RefId: " . $referenceID . "Error: " . $e->getMessage());
                    $message = array(
                        "wtmessage" => Yii::t('notificaciones', 'Invalid request. Please do not repeat this request again. Contact to Administrator.'),
                        "title" => Yii::t('jslang', 'Error'),
                    );
                    return Utilities::ajaxResponse('NOOK', 'alert', Yii::t('jslang', 'Error'), 'true', $message);
                }
            }
            //Secuencias::initSecuencia($con1, $emp_id, 1, 1, 'BPA',"BOTON DE PAGOS DINERS"); 
            // Info de Solicitud Inscripcion
            $sins_id = $data["sins_id"]; //base64_decode($dataGet["sins_id"]);
            \app\models\Utilities::putMessageLogFile('sins_id:' . $sins_id);
            $solInc_mod = SolicitudInscripcion::findOne($sins_id);
            $int_mod = Interesado::findOne($solInc_mod->int_id);
            $per_mod = Persona::findOne($int_mod->per_id);
            $opago_mod = OrdenPago::findOne(["sins_id" => $sins_id, "opag_estado_pago" => "P", "opag_estado" => 1, "opag_estado_logico" => 1]);
            $obj_sol = $solInc_mod::consultarInteresadoPorSol_id($sins_id);
            $descripcionItem = Yii::t("formulario", "Payment of ") . $obj_sol["carrera"]; //financiero::t("Pagos", "Payment of ") . $obj_sol["carrera"];
            $titleBox = Yii::t("formulario", "Payment Course/Career/Program: ") . $obj_sol["carrera"]; //financiero::t("Pagos", "Payment Course/Career/Program: ") . $obj_sol["carrera"];
            $totalpagar = $opago_mod->opag_total;
            \app\models\Utilities::putMessageLogFile('total a pagar:' . $totalpagar);
            $secuencia = 130; //Secuencias::nuevaSecuencia($con1, $emp_id, 1, 1, 'BPA');
            return $this->render('btnpago', array(
                        "referenceID" => $secuencia, //str_pad(Secuencias::nuevaSecuencia($con1, $emp_id, 1, 1, 'BPA'), 8, "0", STR_PAD_LEFT),
                        "ordenPago" => $opago_mod->opag_id,
                        "nombre_cliente" => $per_mod->per_pri_nombre,
                        "apellido_cliente" => $per_mod->per_pri_apellido,
                        "descripcionItem" => $descripcionItem,
                        "titleBox" => $titleBox,
                        "email_cliente" => $per_mod->per_correo,
                        "total" => $totalpagar,
            ));
        }
    }

}
