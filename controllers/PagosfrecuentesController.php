<?php

namespace app\controllers;

use Yii;
use app\models\Utilities;
use yii\helpers\ArrayHelper;
use yii\base\Exception;
use app\models\Persona;
use app\modules\admision\models\ItemMetodoUnidad;
use \app\modules\admision\models\SolicitudInscripcion;
use app\models\Pais;
use app\modules\admision\models\Interesado;
use app\models\Provincia;
use app\modules\financiero\models\OrdenPago;
use app\modules\financiero\models\PersonaBeneficiaria;
use app\modules\financiero\models\SolicitudBotonPago;
use app\modules\financiero\models\DetalleSolicitudBotonPago;
use app\modules\financiero\models\Documento;
use app\modules\financiero\models\Item;
use app\models\Canton;
use app\models\MedioPublicitario;
use app\modules\academico\models\Modalidad;
use app\modules\academico\models\UnidadAcademica;
use yii\helpers\Url;
use app\modules\admision\models\PersonaGestion;
use app\modules\admision\models\Oportunidad;
use app\modules\admision\models\MetodoIngreso;
use app\modules\financiero\models\Secuencias;
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
            $mensaje = "";
            $data = Yii::$app->request->post();
            $dataBeneficiario = $data["dataBenList"];
            $dataFactura = $data["dataFacturaList"];
            $cedula = $dataBeneficiario["cedula"];
            $item_ids = $data["dataItems"];
            $transaction = $con1->beginTransaction();

            try {
                if (!empty($item_ids)) {
                    $id_pben = $pben_model->getIdPerBenByCed($con1, $cedula);
                    if (empty($id_pben)) {
                        $id_pbens = $pben_model->insertPersonaBeneficia($con1, $cedula, ucwords(strtolower($dataBeneficiario["nombre"])), ucwords(strtolower($dataBeneficiario["apellido"])), $dataBeneficiario["correo"], $dataBeneficiario["celular"]);
                    } else {
                        $id_actualiza = $pben_model->actualizarPersonaBeneficia($con1, $cedula, ucwords(strtolower($dataBeneficiario["nombre"])), ucwords(strtolower($dataBeneficiario["apellido"])), $dataBeneficiario["correo"], $dataBeneficiario["celular"]);                
                        if ($id_actualiza){                       
                            $id_pbens= $id_pben["id"];                      
                        } else {
                            $id_pbens=0;   //Cuando hubo error en la actualización.                  
                        }
                    }
                    if ($id_pbens > 0) {
                        $idsbp = $sbp_model->insertSolicitudBotonPago($con1, $id_pbens);
                        if ($idsbp > 0) {                        
                            for ($i = 0; $i < count($item_ids); $i++) {                            
                                $item_precio = $item_model->getPrecios($con1, $item_ids[$i]["item_id"]);      
                                $val_iva = 0;
                                //\app\models\Utilities::putMessageLogFile('precio:'.$item_precio["ipre_precio"]);
                                $id_dsbp = $dsbp_model->insertarDetSolBotPag($con1, $idsbp, $item_ids[$i]["item_id"], 1, $item_precio["ipre_precio"], $val_iva);
                                if ($id_dsbp > 0) {
                                    $mensaje = $mensaje . "";
                                }
                            }                        
                            $iddoc = $doc_model->insertDocumento($con1, $dataFactura["tipo_dni_fac"], $idsbp, ucwords(strtolower($dataFactura["nombre_fac"])) . ' ' . ucwords(strtolower($dataFactura["apellidos_fac"])), 
                                                ucwords(strtolower($dataFactura["dir_fac"])), $dataFactura["telfono_fac"], $dataFactura["correo"], 
                                                $dataFactura["total"], null);
                            if ($iddoc > 0) {
                                $transaction->commit();                                
                                $mensaje = $mensaje . "Se ha guardado exitosamente su solicitud de pago.";                                 
                                $message = array(
                                    "wtmessage" => Yii::t("notificaciones", $mensaje),
                                    "title" => Yii::t('jslang', 'Success'),
                                    "rederict" => Yii::$app->response->redirect(['/pagosfrecuentes/botonpago?docid=' . base64_encode($iddoc)]),                                    
                                );
                                return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                            } else {
                                $mensaje = $mensaje . "No se ha guardado el documento de factura";
                            }
                        } else {
                            $mensaje = $mensaje . "No se ha guardado la solicitud del pago";
                        }
                    } else {
                        $mensaje = $mensaje . "No se ha guardado el beneficiario";
                    }
                } else {
                    $mensaje = $mensaje . "No se ha seleccionado ningún item a facturar.";
                }
            } catch (Exception $ex) {
                $transaction->rollBack();
                $message = array(
                    "wtmessage" => $ex->getMessage(), Yii::t("notificaciones", "Error al grabar."),
                    "title" => Yii::t('jslang', 'Error'),
                );
                return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), true, $message);
            }
        }
    }

    public function actionBotonpago() {
        $data = Yii::$app->request->post();
        $dataGet = Yii::$app->request->get();
        $con1 = \Yii::$app->db_facturacion;
        $emp_id = 1;//$data["empresa_id"];
        $modDocumento = new Documento();    
        $referenceID = isset($data["referenceID"])?$data["referenceID"]:null;
        if(!is_null($referenceID)){
            try {
                $transaction = $con1->beginTransaction();
                //OBTENER EL ID DE LA SOLICITUD DE PAGO.                
                $doc_id = $dataGet["docid"];   
                \app\models\Utilities::putMessageLogFile('No es null referenceID:'.$referenceID);
                $response = $this->render('btnpago', array(
                    "referenceID" => $data["resp"]["reference"],
                    "requestID" => $data["requestID"],
                    "ordenPago" => $doc_id,
                    "response" => $data["resp"],
                ));
                if ($data["resp"]["status"]["status"] == "APPROVED"){
                    // MODIFICAR EN TABLA DOCUMENTO
                    $respDoc = $modDocumento->actualizarDocumento($con1, $doc_id);
                    if ($respDoc) {
                        $transaction->commit();      
                        $message = array(
                            "wtmessage" => Yii::t("notificaciones", "Your information was successfully saved."),
                            "title" => Yii::t('jslang', 'Success'),
                        );
                    } else{
                        Utilities::putMessageLogFile("Botón Pagos: Error al actualizar pago. RefId: ". $referenceID);
                        throw new Exception('Error al actualizar pago.');
                    } 
                }else {
                    $message = array(
                        "wtmessage" => $data["resp"]["status"]["message"],
                        "title" => Yii::t('jslang', 'Error'),
                    );
                    return Utilities::ajaxResponse('NOOK', 'alert', Yii::t('jslang', 'Error'), 'true', $message);
                }            
            }catch(Exception $e) {
                $transaction->rollBack();
                Utilities::putMessageLogFile("Botón Pagos: Error . RefId: ". $referenceID .  "Error: " . $e->getMessage());
                $message = array(
                    "wtmessage" => Yii::t('notificaciones', 'Invalid request. Please do not repeat this request again. Contact to Administrator.'),
                    "title" => Yii::t('jslang', 'Error'),
                );
                return Utilities::ajaxResponse('NOOK', 'alert', Yii::t('jslang', 'Error'), 'true', $message);
            }
        }
        Secuencias::initSecuencia($con1, 1, 1, 1, 'BPA',"BOTÓN DE PAGOS DINERS");
        // Info de solicitud del pago.        
        $doc_id =  base64_decode($_GET['docid']);         
        \app\models\Utilities::putMessageLogFile('nùmero documento:'.$doc_id);
        $resultado = $modDocumento->consultarDatosxId($con1, $doc_id);
        $descripcionItem = "Pagos de Varios Items";
        $titleBox = "Pagos varios";//financiero::t("Pagos", "Payment Course/Career/Program: ") . $obj_sol["carrera"];
        $totalpagar = $resultado["doc_valor"];
        \app\models\Utilities::putMessageLogFile('total a pagar'.$resultado["doc_valor"]);
        return $this->render('btnpago', array(
            "referenceID" => str_pad(Secuencias::nuevaSecuencia($con1, 1, 1, 1, 'BPA'), 8, "0", STR_PAD_LEFT),
            "ordenPago" => $doc_id,
            "nombre_cliente" => $resultado["pben_nombre"],
            "apellido_cliente" => $resultado["pben_apellido"],
            "descripcionItem" => $descripcionItem,
            "titleBox" => $titleBox,
            "email_cliente" => $resultado["doc_correo"],
            "total" => $totalpagar,
        ));
    }

}
