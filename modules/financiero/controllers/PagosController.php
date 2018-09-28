<?php

namespace app\modules\financiero\controllers;

use Yii;
use app\models\Utilities;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use app\modules\financiero\models\OrdenPago;
use app\modules\admision\models\SolicitudInscripcion;
use app\models\Persona;
use app\modules\admision\models\Interesado;
use yii\helpers\Url;
use yii\base\Exception;
use yii\base\Security;
use app\modules\admision\Module as admision;

admision::registerTranslations();

class PagosController extends \app\components\CController {

    public function actionIndex() {
        $per_id = @Yii::$app->session->get("PB_iduser");
        $model_interesado = new Interesado();
        $resp_gruporol = $model_interesado->consultagruporol($per_id);
        $mod_pago = new OrdenPago();
        $data = null;
        $data = Yii::$app->request->get();
        if ($data['PBgetFilter']) {
            $arrSearch["f_ini"] = $data['f_ini'];
            $arrSearch["f_fin"] = $data['f_fin'];
            $arrSearch["f_estado"] = $data['f_estado'];
            $arrSearch["search"] = $data['search'];
            $resp_pago = $mod_pago->listarPagosolicitud($arrSearch, $resp_gruporol["grol_id"]);
            return $this->renderPartial('index-grid', [
                        "model" => $resp_pago,
            ]);
        } else {
            $resp_pago = $mod_pago->listarPagosolicitud(null, $resp_gruporol["grol_id"]);
        }
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->get();
            if (isset($data["op"]) && $data["op"] == '1') {
                
            }
        }
        $arrEstados = ArrayHelper::map([["id" => "T", "value" => "Todos"], ["id" => "P", "value" => "Pendiente"], ["id" => "S", "value" => "Pagada"]], "id", "value");
        return $this->render('index', [
                    'model' => $resp_pago,
                    'arrEstados' => $arrEstados
        ]);
    }

    public function actionCargardocpagos() {
        //$ccar_id = base64_decode($_GET["ids"]);
        $ccar_id = isset($_GET['ids']) ? base64_decode($_GET['ids']) : 1; //NULL
        $model_pag = new OrdenPago();
        $arr_forma_pago = $model_pag->formaPago('2');
        $resp_doc = $model_pag->listarDocumento($ccar_id);
        $data = null;
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->get();
            if (isset($data["op"]) && $data["op"] == '1') {
                
            }
        }
        return $this->render('cargardocpagos', [
                    "arr_forma_pago" => ArrayHelper::map($arr_forma_pago, "id", "value"), 'model' => $resp_doc,
                    "opago" => $ccar_id,
                    "vista" => $_GET["vista"],
        ]);
    }

    public function actionValidarpagocarga() {
        $per_id = @Yii::$app->session->get("PB_iduser");
        $model_interesado = new Interesado();
        $resp_gruporol = $model_interesado->consultagruporol($per_id);

        $opag_id = $_GET["ido"];

        $mod_cliord = new OrdenPago();
        $resp_cliord = $mod_cliord->consultarOrdenpago($resp_gruporol["grol_id"], $opag_id, 0);

        if ($resp_cliord) {
            $persona_pago = $resp_cliord["per_id"];
            $sins_id = $resp_cliord["sser_id"];
            $nombres = $resp_cliord["nombres"];
            $apellidos = $resp_cliord["apellidos"];
            $valortotal = $resp_cliord["valortotal"];
            $valoraplicado = $resp_cliord["valoraplicado"];
            $rol = $resp_cliord["rol"];
        }

        $mod_pago = new OrdenPago();
        $resp_pago = $mod_pago->listarPagosadmxsolicitud($resp_gruporol["grol_id"], $opag_id, $persona_pago);
        $data = null;

        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->get();
            if (isset($data["op"]) && $data["op"] == '1') {
                
            }
        }

        return $this->render('validarpagocarga', [
                    'model' => $resp_pago,
                    'persona_pago' => $persona_pago,
                    'sins_id' => $sins_id,
                    'nombres' => $nombres,
                    'apellidos' => $apellidos,
                    'valortotal' => $valortotal,
                    'valoraplicado' => $valoraplicado,
                    'opag_id' => $opag_id,
                    'rol' => $rol,
        ]);
    }

    public function actionViewpagacarga() {
        $per_id = @Yii::$app->session->get("PB_iduser");
        $model_interesado = new Interesado();
        $resp_gruporol = $model_interesado->consultagruporol($per_id);

        $opag_id = base64_decode($_GET["ido"]);
        $idd = base64_decode($_GET["idd"]);
        $val = base64_decode($_GET["valor"]);
        $valtotal = base64_decode($_GET["valortotal"]);
        $valpagado = base64_decode($_GET["valorpagado"]);

        $mod_cliord = new OrdenPago();
        $resp_cliord = $mod_cliord->consultarOrdenpago($resp_gruporol["grol_id"], $opag_id, $idd);

        if ($resp_cliord) {
            $sins_id = $resp_cliord["sser_id"];
            $per_id = $resp_cliord["per_id"];
            $nombres = $resp_cliord["nombres"];
            $apellidos = $resp_cliord["apellidos"];
            $valorsubido = $resp_cliord["valorsubido"];
            $estado = $resp_cliord["estado"];
            $observacion = $resp_cliord["observacion"];
            $imagen = $resp_cliord["imagen"];
            $int_id = $resp_cliord["int_id"];
        }

        return $this->render('viewpagacarga', [
                    "revision" => array("AP" => Yii::t("formulario", "APPROVED"), "RE" => Yii::t("formulario", "Rejected")),
                    'opag_id' => $opag_id,
                    'idd' => $idd,
                    'sins_id' => $sins_id,
                    'nombres' => $nombres,
                    'apellidos' => $apellidos,
                    'valor' => $valorsubido,
                    'estado' => $estado,
                    'observacion' => $observacion,
                    'per_id' => $per_id,
                    'imagen' => $imagen,
                    'int_id' => $int_id,
                    'cmb_observacion' => array("" => "Seleccione una opción", "Pago Ilegible" => "Pago Ilegible", "Pago Duplicado" => "Pago Duplicado", "Pago Sin Verificar" => "Pago Sin Verificar"),
                    'val' => $val,
                    'valtotal' => $valtotal,
                    'valpagado' => $valpagado,
        ]);
    }

    public function actionSavepago() {
        //online que sube doc capturar asi el id de la persona 
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $per_id = $_SESSION['personaid'];
            if ($data["upload_file"]) {
                if (empty($_FILES)) {
                    echo json_encode(['error' => Yii::t("notificaciones", "Error to process File {file}. Try again.", ['{file}' => basename($files['name'])])]);
                    return;
                }
                //Recibe Parametros
                $files = $_FILES[key($_FILES)];
                $arrIm = explode(".", basename($files['name']));
                $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                $dirFileEnd = Yii::$app->params["documentFolder"] . "documento/" . $per_id . "/" . $data["name_file"] . "." . $typeFile;
                $status = Utilities::moveUploadFile($files['tmp_name'], $dirFileEnd);
                if ($status) {
                    return true;
                } else {
                    echo json_encode(['error' => Yii::t("notificaciones", "Error to process File {file}. Try again.", ['{file}' => basename($files['name'])])]);
                    return;
                }
            }
            $arrIm = explode(".", basename($data["documento"]));
            $typeFile = strtolower($arrIm[count($arrIm) - 1]);
            $imagen = $arrIm[0] . "." . $typeFile;
            $opag_id = $data["opag_id"];
            $estado_revision = $data["estado_revision"];
            $observacion = ucwords(strtolower($data["observacion"]));
            $banderacrea = $data["banderacrea"];
            $idd = $data["idd"];
            $dcar_estado_revisa = 'RE';
            $opag_estado_pagado = 'P';
            $controladm = $data["controladm"];
            $ccar_total = $data["totpago"];
            $dcar_valor = $data["valor"];
            $fpag_id = $data["forma_pago"];
            $resultadobtn = "";
            $codautorizacion = "";
            $numero_transaccion = $data["numero_transaccion"];
            $fecha_transaccion = $data["fecha_transaccion"];
            $int_id = $data["int_id"];
            $sins_id = $data["sins_id"];
            $per_id = $data["per_id"];

            $con = \Yii::$app->db_facturacion;
            $transaction = $con->beginTransaction();
            $con2 = \Yii::$app->db_captacion;
            $transaction2 = $con2->beginTransaction();

            try {
                $usuario_aprueba = @Yii::$app->user->identity->usu_id;   //Se obtiene el id del usuario.                            
                $mod_ordpago = new OrdenPago();
                if ($controladm == '1') {
                    //Insertar en tabla info_carga_prepago
                    $fecha_registro = date(Yii::$app->params["dateTimeByDefault"]);
                    $creadetalle = $mod_ordpago->insertarCargaprepago($opag_id, $fpag_id, $dcar_valor, $imagen, 'PE', null, null, $numero_transaccion, $fecha_transaccion, $fecha_registro);
                    $idd = $creadetalle;
                }
                //Obtener datos grabados en tablas temporales                        
                $resp_cargo = $mod_ordpago->consultarCargo($idd, $opag_id);
                if ($resp_cargo['existe'] == 'S') {
                    $valor_det = $resp_cargo['valor'];
                    $fpag_id = $resp_cargo['fpag_id'];
                    $fechapago = $resp_cargo['fechapago'];
                    $imagen = $resp_cargo['imagen'];
                    $valortotal = $resp_cargo['valortotal'];
                    $fechapagtotal = $resp_cargo['fechapagotot'];
                    $ccar_id = $resp_cargo['id'];
                    $valorpagado = $resp_cargo['valorpagado'];
                    $num_transaccion = $resp_cargo['icpr_num_transaccion'];
                    $fecha_transaccion = $resp_cargo['icpr_fecha_transaccion'];
                    $total_pagado = $resp_cargo['total_pagado'];
                    if ($banderacrea == 1) {
                        $creg_total = $valortotal;
                        $creg_resultado = 'OK';
                        $creg_fecha_pago_total = $fechapagtotal;
                        $creg_pagado = $total_pagado + $valor_det;
                        if ($valortotal > $creg_pagado) {
                            $creg_estado_pago = 'NP'; //Pago Revisado                           
                        } else {
                            $creg_estado_pago = 'SP'; //Pago Realizado en su totalidad.                          
                        }
                        //Obtención de las cuotas pendientes de pago.
                        $resp_desglose = $mod_ordpago->obtenerDesglosepagopend($opag_id);
                        if ($resp_desglose) {
                            for ($i = 0; $i < count($resp_desglose); $i++) {
                                $valor_sobra = $valor_det;
                                if (($resp_desglose[$i]['valor_desglose'] <= $valor_sobra) and ( $valor_sobra > 0)) {
                                    $valor = ($resp_desglose[$i]['valor_desglose']);
                                    $valor_sobra = $valor_sobra - $valor;
                                } else {
                                    $valor = $valor_sobra;
                                }
                                $fechapago = date(Yii::$app->params["dateTimeByDefault"]);
                                $resp_inspago = $mod_ordpago->insertarRegistropago($resp_desglose[$i]['id'], $fpag_id, $valor, $fechapago, $imagen, $num_transaccion, $fecha_transaccion, $observacion, $estado_revision, $usuario_aprueba, $dcar_estado_revisa);
                                if ($resp_inspago) {
                                    if ($resp_desglose[$i]['valor_desglose'] = $valor_det) {
                                        $resp_actcabcar = $mod_ordpago->actualizaDesglosepago($resp_desglose[$i]['id'], 'S', $usuario_aprueba);
                                    }
                                }
                            }
                            //actualizar en detalle_cargo la gestión realizada.                                                                                    
                            $resp_actcar = $mod_ordpago->actualizaDetallecargo($idd, $dcar_estado_revisa, $estado_revision, $observacion, $usuario_aprueba, $valor_det);
                            if ($resp_actcar) {
                                $totalpagado = ($valorpagado + $valor_det);
                                if ($creg_estado_pago == 'SP') {
                                    $ccar_estado_pagado = 'S';
                                    $opag_estado_pagado = 'S';
                                    $fecha_pago_total = date(Yii::$app->params["dateTimeByDefault"]);
                                } else {
                                    $ccar_estado_pagado = 'P';
                                }
                                //actualiza datos de la orden de pago.                                         
                                $resp_opag = $mod_ordpago->actualizaOrdenpago($opag_id, $opag_estado_pagado, $creg_pagado, $fecha_pago_total, $usuario_aprueba);
                                if ($resp_opag) {
                                    $exito = 1;
                                }
                            } //fin de actualizar detalle cargo
                        } //fin de obtener registros de desglose
                    } //fin  $banderacrea 
                    else { //En el caso cuando no aprueba el pago.
                        //actualizar en detalle_cargo la gestión realizada.                        
                        $resp_actdetcar = $mod_ordpago->actualizaDetallecargo($idd, $dcar_estado_revisa, $estado_revision, $observacion, $usuario_aprueba, $valor_det);
                        if ($resp_actdetcar) {
                            $exito = 1;
                        }
                    }
                }  //fin cuando aprueba el pago. 
                if ($exito) {
                    $transaction->commit();
                    $transaction2->commit();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "La infomación ha sido grabada. "),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    echo Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                } else {
                    $transaction->rollback();
                    $transaction2->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error al grabar1." . $mensaje),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    echo Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $transaction2->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error al grabar2." . $mensaje),
                    "title" => Yii::t('jslang', 'Success'),
                );
                echo Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
            }
            return;
        }
    }

    public function actionEdit() {
        
    }

    public function actionNew() {
        return $this->render('new');
    }

    public function actionSavecarga() {
        $per_id = Yii::$app->session->get("PB_perid");
        $modcargapago = new OrdenPago();
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if ($data["upload_file"]) {
                if (empty($_FILES)) {
                    echo json_encode(['error' => Yii::t("notificaciones", "Error to process File {file}. Try again.", ['{file}' => basename($files['name'])])]);
                    return;
                }
                //Recibe Parametros
                $files = $_FILES[key($_FILES)];
                $arrIm = explode(".", basename($files['name']));
                $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                $dirFileEnd = Yii::$app->params["documentFolder"] . "documento/" . $per_id . "/" . $data["name_file"] . "." . $typeFile;
                $status = Utilities::moveUploadFile($files['tmp_name'], $dirFileEnd);
                if ($status) {
                    return true;
                } else {
                    echo json_encode(['error' => Yii::t("notificaciones", "Error to process File {file}. Try again.", ['{file}' => basename($files['name'])])]);
                    return;
                }
            }
            $arrIm = explode(".", basename($data["documento"]));
            $typeFile = strtolower($arrIm[count($arrIm) - 1]);
            $imagen = $arrIm[0] . "." . $typeFile;
            $opag_id = $_GET["txth_ids"];
            $opag_id = $data["idpago"];
            $ccar_total = $data["totpago"];
            if (empty($ccar_total)) {
                $ccar_total = $data["pago"];
            }
            $dcar_valor = $data["pago"];
            $fpag_id = $data["metodopago"];
            $dcar_num_transaccion = $data["numtransaccion"];
            $dcar_fecha_transaccion = $data["fechatransaccion"];
            $con = \Yii::$app->db_facturacion;
            $transaction = $con->beginTransaction();
            try {
                $dcar_revisado = 'PE';
                $dcar_resultado = '';
                $dcar_observacion = '';
                $fecha_registro = date(Yii::$app->params["dateTimeByDefault"]);
                $creadetalle = $modcargapago->insertarCargaprepago($opag_id, $fpag_id, $dcar_valor, $imagen, $dcar_revisado, $dcar_resultado, $dcar_observacion, $dcar_num_transaccion, $dcar_fecha_transaccion, $fecha_registro);
                if ($creadetalle) {
                    //Envío de correo a colecturia.                
                    $informacion_interesado = $modcargapago->datosBotonpago($opag_id, 'SI');
                    $pri_nombre = $informacion_interesado["nombres"];
                    $pri_apellido = $informacion_interesado["apellidos"];
                    $nombres = $pri_nombre . " " . $pri_apellido;
                    $metodo = $informacion_interesado["curso"];
                    $tituloMensaje = Yii::t("interesado", "UTEG - Registration Online");
                    $asunto = Yii::t("interesado", "UTEG - Registration Online");
                    $bodycolecturia = Utilities::getMailMessage("Paymentraisedcollect", array("[[nombres_completos]]" => $nombres, "[[metodo]]" => $metodo), Yii::$app->language);
                    Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [Yii::$app->params["colecturia"] => "Colecturia"], $asunto, $bodycolecturia);
                    $exito = 1;
                }
                if ($exito == 1) {
                    $transaction->commit();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Documento ha sido cargado."),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    echo \app\models\Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                } else {
                    $transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error: Documento No ha sido cargado."),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    echo \app\models\Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error al grabar."),
                    "title" => Yii::t('jslang', 'Success'),
                );
                echo \app\models\Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
            }
            return;
        }
    }

    public function actionListarpagoscargados() {
        $mod_pago = new OrdenPago();

        $data = null;
        $data = Yii::$app->request->get();
        if ($data['PBgetFilter']) {
            $arrSearch["f_ini"] = $data['f_ini'];
            $arrSearch["f_fin"] = $data['f_fin'];
            $arrSearch["f_estado"] = $data['f_estado'];
            $arrSearch["search"] = $data['search'];
            $resp_pago = $mod_pago->listarPagoscargados($arrSearch);
            return $this->renderPartial('_listarpagoscargados_grid', [
                        "model" => $resp_pago,
            ]);
        } else {
            $resp_pago = $mod_pago->listarPagoscargados();
        }
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->get();
            if (isset($data["op"]) && $data["op"] == '1') {
                
            }
        }
        $arrEstados = ArrayHelper::map([["id" => "T", "value" => "Todos"], ["id" => "P", "value" => "Pendiente"], ["id" => "S", "value" => "Pagada"]/* , ["id" => "NA", "value" => "No Disponible"] */], "id", "value");
        return $this->render('listarpagoscargados', [
                    'model' => $resp_pago,
                    'arrEstados' => $arrEstados
        ]);
    }

    public function actionExpexcel() {
        ini_set('memory_limit', '256M');
        $content_type = Utilities::mimeContentType("xls");
        $nombarch = "Report-" . date("YmdHis") . ".xls";
        header("Content-Type: $content_type");
        header("Content-Disposition: attachment;filename=" . $nombarch . ".xls");
        header('Cache-Control: max-age=0');
        $colPosition = array("C", "D", "E", "F", "G", "H", "I", "J");
        $arrData = array();
        $arrHeader = array(
            Yii::t("formulario", "Request #"),
            admision::t("Solicitudes", "Application date"),
            Yii::t("formulario", "DNI 1"),
            Yii::t("formulario", "First Names"),
            Yii::t("formulario", "Last Names"),
            Yii::t("formulario", "Academic unit"),
            Yii::t("solicitud_ins", "Income Method"),
            Yii::t("formulario", "Status"),
        );
        $data = Yii::$app->request->get();
        $arrSearch["search"] = $data["search"];
        $arrSearch["f_ini"] = $data["f_ini"];
        $arrSearch["f_fin"] = $data["f_fin"];
        $arrSearch["f_estado"] = $data["f_estado"];
        //$arrData = array();
        $model_pag = new OrdenPago();
        if (empty($arrSearch)) {
            $arrData = $model_pag->listarPagoscargadosexcel(array(), true);
        } else {
             $arrData = $model_pag->listarPagoscargadosexcel($arrSearch, true);
        }
        $nameReport = yii::t("formulario", "Application Reports");
        Utilities::generarReporteXLS($nombarch, $nameReport, $arrHeader, $arrData, $colPosition);
        exit;
    }

    public function actionIndexadm() {
        $per_id = @Yii::$app->session->get("PB_iduser");
        $model_interesado = new Interesado();
        $resp_gruporol = $model_interesado->consultagruporol($per_id);
        $mod_pago = new OrdenPago();
        $data = null;
        $data = Yii::$app->request->get();

        if ($data['PBgetFilter']) {
            $arrSearch["f_ini"] = $data['f_ini'];
            $arrSearch["f_fin"] = $data['f_fin'];
            $arrSearch["f_estado"] = $data['f_estado'];
            $arrSearch["search"] = $data['search'];
            $resp_pago = $mod_pago->listarSolicitudesadm($arrSearch, $resp_gruporol["grol_id"]);
            return $this->renderPartial('_indexadm_grid', [
                        "model" => $resp_pago,
            ]);
        } else {
            $resp_pago = $mod_pago->listarSolicitudesadm(null, $resp_gruporol["grol_id"]);
        }
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->get();
            if (isset($data["op"]) && $data["op"] == '1') {
                
            }
        }
        return $this->render('indexadm', [
                    'model' => $resp_pago,
        ]);
    }

    public function actionRegistrarpagoadm() {
        $opag_id = $_GET["ido"];
        $per_id = $_GET["per_id"];

        $mod_opago = new OrdenPago();
        $arr_forma_pago = $mod_opago->formaPago("1");

        $resp_orden = $mod_opago->listarSolicitud($per_id, $opag_id, 0);
        $valor_total = $resp_orden['ipre_precio'];
        $saldo_pendiente = $resp_orden['pendiente'];
        $int_id = $resp_orden['int_id'];
        $sins_id = $resp_orden['solicitud'];

        $resp_doc = $mod_opago->listarDocumento($opag_id);
        $data = null;

        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->get();
            if (isset($data["op"]) && $data["op"] == '1') {
                
            }
        }
        return $this->render('registrarpagoadm', [
                    "arr_forma_pago" => ArrayHelper::map($arr_forma_pago, "id", "value"),
                    'model' => $resp_doc,
                    'saldo_pendiente' => $saldo_pendiente,
                    'valor_total' => $valor_total,
                    'opag_id' => $opag_id,
                    'int_id' => $int_id,
                    'sins_id' => $sins_id,
                    'per_id' => $per_id,
        ]);
    }

    public function actionListarpagosolicitud() {
        $per_id = Yii::$app->session->get("PB_perid");
        //  $per_ids = base64_decode($_GET['ids']);
        $sol_id = base64_decode($_GET['id_sol']);
        $model_pag = new OrdenPago();
        $data = Yii::$app->request->get();
        if ($data['PBgetFilter']) {
            $arrSearch["f_ini"] = $data['f_ini'];
            $arrSearch["f_fin"] = $data['f_fin'];
            $arrSearch["search"] = $data['search'];
            //if (empty($per_ids)) {  //vista para el interesado  
            $rol = 1;
            $resp_pago = $model_pag->listarSolicitud($sol_id, null, $rol, $arrSearch);
            /* } else {
              $rol = 0;
              $resp_pago = $model_pag->listarSolicitud($sol_id, null, $rol, $arrSearch);
              } */
            return $this->renderPartial('_listarpagosolicitud_grid', [
                        "model" => $resp_pago,
            ]);
        } else {
            // if (empty($per_ids)) {  //vista para el interesado  
            $rol = 1;
            $resp_pago = $model_pag->listarSolicitud($sol_id, null, $rol);
            /* } else {
              $rol = 0;
              $resp_pago = $model_pag->listarSolicitud($sol_id, null, $rol);
              } */
        }
        //verificar rol de la persona que esta en sesión
        $resp_rol = $model_pag->encuentraRol($per_id);
        $data = null;
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->get();
            if (isset($data["op"]) && $data["op"] == '1') {
                
            }
        }
        return $this->render('listarpagosolicitud', [
                    'model' => $resp_pago,
        ]);
    }

    public function actionUpdate() {
        
    }

    public function actionCargardocfact() {
        $mod_cargapago = new OrdenPago();
        $sins_id = isset($_GET['ids']) ? base64_decode($_GET['ids']) : 1; //NULL
        $data = null;
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->get();
            if (isset($data["op"]) && $data["op"] == '1') {
                
            }
        }
        $rowData = $mod_cargapago->consultarInteresadoPersona($sins_id);
        return $this->render('cargardocfact', [
                    "sins_id" => $sins_id,
                    "per_id" => isset($rowData[0]['per_id']) ? $rowData[0]['per_id'] : 0,
                    "opag_total" => isset($rowData[0]['opag_total']) ? $rowData[0]['opag_total'] : 0,
        ]);
    }

    public function actionSavefactura() {
        $modcargapago = new OrdenPago();
        $rowData = $modcargapago->consultarInteresadoPersona($sins_id);
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if ($data["upload_file"]) {
                if (empty($_FILES)) {
                    echo json_encode(['error' => Yii::t("notificaciones", "Error to process File {file}. Try again.", ['{file}' => basename($files['name'])])]);
                    return;
                }
                //Recibe Parametros
                $files = $_FILES[key($_FILES)];
                $arrIm = explode(".", basename($files['name']));
                $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                $dirFileEnd = Yii::$app->params["documentFolder"] . "facturas/" . $data["name_perid"] . "/" . $data["name_file"] . "." . $typeFile;
                $status = Utilities::moveUploadFile($files['tmp_name'], $dirFileEnd);
                if ($status) {
                    return true;
                } else {
                    echo json_encode(['error' => Yii::t("notificaciones", "Error to process File {file}. Try again.", ['{file}' => basename($files['name'])])]);
                    return;
                }
            }
            if ($data["procesar_file"]) {
                $carga_archivo = $modcargapago->insertarDtosFactDoct($data);
                if ($carga_archivo['status']) {
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Archivo procesado correctamente." . $carga_archivo['data']),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Success"), false, $message);
                } else {
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error al procesar el archivo. " . $carga_archivo['message']),
                        "title" => Yii::t('jslang', 'Error'),
                    );
                    return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), true, $message);
                }
                return;
            }

            return;
        } else {
            return $this->render('cargarleads', []);
        }
    }

    public function actionDescargafactura() {
        $nombreZip = "facturas_" . time();
        $content_type = Utilities::mimeContentType($nombreZip . ".zip");
        header("Content-Type: $content_type");
        header("Content-Disposition: attachment;filename=" . $nombreZip . ".zip");
        header('Cache-Control: max-age=0');
        $sins_id = isset($_GET['ids']) ? base64_decode($_GET['ids']) : 1;//NULL
        $ruta= OrdenPago::consultarRutaFile($sins_id);
       
        $Path=Yii::$app->basePath ."/uploads/" .$ruta;
        Utilities::putMessageLogFile($Path);

        // se deben zippear 2 files el xml y el pdf
        /*$arr_files = array(
            array("ruta" => Yii::$app->basePath . "/uploads/ficha/silueta_default.png",
                "name" => basename(Yii::$app->basePath . "/uploads/ficha/silueta_default.png")),
            array("ruta" => Yii::$app->basePath . "/uploads/ficha/Silueta-opc-4.png",
                "name" => basename(Yii::$app->basePath . "/uploads/ficha/Silueta-opc-4.png")),
        );*/
        $arr_files = array(
            array("ruta" => Yii::$app->basePath . "/uploads/" .$ruta,
                "name" => basename(Yii::$app->basePath . "/uploads/" .$ruta)),            
        );
        $tmpDir = Utilities::zipFiles($nombreZip, $arr_files);
        $file = file_get_contents($tmpDir);
        Utilities::removeTemporalFile($tmpDir);
        echo $file;
        exit();
    }

}
