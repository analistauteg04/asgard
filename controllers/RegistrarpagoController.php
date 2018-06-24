<?php

namespace app\controllers;

use Yii;
use app\models\Utilities;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use app\models\OrdenPago;
use app\models\SolicitudInscripcion;
use app\models\Persona;
use app\models\Interesado;
use yii\helpers\Url;
use yii\base\Exception;
use yii\base\Security;

class RegistrarpagoController extends \app\components\CController {

    /**
     * Function Listarpagosolicadm: Consulta las solicitudes con pagos realizados.
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   Ninguno. 
     * @return  
     */
    public function actionListarpagosolicadm() {
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
            return $this->renderPartial('_listarPagsoladmGrid', [
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
        return $this->render('listarPagosolicAdm', [
                    'model' => $resp_pago,
                    'arrEstados' => $arrEstados
        ]);
    }

    /**
     * Function Validarpagocarga: Vista para mostrar información registrada de los pagos.
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   Ninguno. 
     * @return  
     */
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

        return $this->render('validarPagoCarga', [
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

    /**
     * Function Revisarpagocarga: Vista para la revisión de los pagos subidos.
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   Ninguno. 
     * @return  
     */
    public function actionRevisarpagocarga() {
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

        return $this->render('revisarPagoCarga', [
                    "revision" => array("AP" => Yii::t("formulario", "APPROVED"), "RE" => Yii::t("formulario", "REJECTED")),
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

    /**
     * Function Crearpago: Graba los pagos aprobados.
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   Ninguno. 
     * @return  
     */
    public function actionCrearpago() {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();

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
            $con3 = \Yii::$app->db_academico;
            $transaction3 = $con3->beginTransaction();

            try {
                $usuario_aprueba = @Yii::$app->user->identity->usu_id;   //Se obtiene el id del usuario.                            
                $mod_ordpago = new OrdenPago();
                if ($controladm == '1') {
                    //Insertar en tabla info_carga_prepago
                    $fecha_registro = date(Yii::$app->params["dateTimeByDefault"]);
                    $creadetalle = $mod_ordpago->insertarCargaprepago($opag_id, $fpag_id, $dcar_valor, null, 'PE', null, null, $numero_transaccion, $fecha_transaccion, $fecha_registro);
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

                                //if ($resp_actcabcar) {
                                //actualiza datos de la orden de pago.                                         
                                $resp_opag = $mod_ordpago->actualizaOrdenpago($opag_id, $opag_estado_pagado, $creg_pagado, $fecha_pago_total, $usuario_aprueba);
                                if ($resp_opag) {
                                    if ($creg_estado_pago == 'SP') {
                                        $resp_encuentra = $mod_ordpago->encuentraAspirante($int_id);
                                        if ($resp_encuentra) {
                                            $asp = $resp_encuentra['asp_id'];
                                            $continua = 1;
                                        } else {
                                            //Se asigna al interesado como aspirante
                                            $resp_asp = $mod_ordpago->insertarAspirante($int_id);
                                            if ($resp_asp) {
                                                $asp = $resp_asp;
                                                $resp_inte = $mod_ordpago->actualizaEstadointeresado($int_id);
                                                if ($resp_inte) {
                                                    $continua = 1;
                                                }
                                            }
                                        }
                                        if ($continua == 1) {
                                            //Se obtienen el método de ingreso y el nivel de interés según la solicitud.
                                            $mod_sol = new SolicitudInscripcion();
                                            $resp_sol = $mod_sol->Obtenerdatosolicitud($sins_id);
                                            //Se obtiene el curso para luego registrarlo.
                                            if ($resp_sol) {
                                                //Giovanni Vergara Zarate 18/01/2018 no se va a registrar ya al curso por defecto, debe hacerse desde un administrador
                                                //$resp_curso = $mod_ordpago->consultaCurso($resp_sol["metodo_ingreso"], $resp_sol["nivel_interes"]);
                                                //if ($resp_curso) {
                                                //Registro al curso (temporalmente)                                                     
                                                //$resp_ingcurso = $mod_ordpago->insertarRegistrocurso($resp_curso['cur_id'], $asp);
                                                //if ($resp_ingcurso) {
                                                //envio de correo                                                                    
                                                $mod_persona = new Persona();
                                                $resp_persona = $mod_persona->consultaPersonaId($per_id);
                                                $correo = $resp_persona["usu_user"];
                                                $apellidos = $resp_persona["per_pri_apellido"];
                                                $nombres = $resp_persona["per_pri_nombre"];

                                                //información del aspirante
                                                $identi = $resp_persona["per_cedula"];
                                                $cel_fono = $resp_persona["per_celular"];
                                                $mail_asp = $resp_persona["per_correo"];

                                                $link = "http://www.uteg.edu.ec"; //Url::base(true) . "/formservicio/pago?ord_pago=" . base64_encode($resp_opago);
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
                                                // envio de correo a colecturia de la informacion del aspirante
                                                $asuntos = Yii::t("interesado", "UTEG - Information Candidate");
                                                $bodies = Utilities::getMailMessage("candidateinfo", array("[[nombre]]" => $nombres, "[[apellido]]" => $apellidos, "[[numero_dni]]" => $identi, "[[celular]]" => $cel_fono, "[[mail]]" => $mail_asp), Yii::$app->language);
                                                Utilities::sendEmail($asuntos, Yii::$app->params["adminEmail"], [Yii::$app->params["colecturia"] => "Colecturia"], $asuntos, $bodies);

                                                $exito = 1;
                                                //}
                                                //}
                                            }
                                        }
                                    }
                                } else {
                                    $exito = 1;
                                }
                            } //fin de actualizar detalle cargo
                        } //fin de obtener registros de desglose
                    } //fin  $banderacrea 
                    else { //En el caso cuando no aprueba el pago.
                        //actualizar en detalle_cargo la gestión realizada                                                                            
                        $resp_actdetcar = $mod_ordpago->actualizaDetallecargo($idd, $dcar_estado_revisa, $estado_revision, $observacion, $usuario_aprueba, $valor_det);
                        if ($resp_actdetcar) {
                            $exito = 1;
                        }
                    }
                }  //fin cuando aprueba el pago. 


                if ($exito) {
                    $transaction->commit();
                    $transaction2->commit();
                    $transaction3->commit();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "La infomación ha sido grabada. "),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    echo Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                } else {
                    $transaction->rollback();
                    $transaction2->rollback();
                    $transaction3->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $mensaje),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    echo Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $transaction2->rollback();
                $transaction3->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $mensaje),
                    "title" => Yii::t('jslang', 'Success'),
                );
                echo Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
            }
            return;
        }
    }

    /**
     * Function Listarpagosolicitud: Consulta las solicitudes con pagos realizados.
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>
     * @param   Ninguno. 
     * @return  
     */
    public function actionListarpagosolicitud() {
        $per_id = Yii::$app->session->get("PB_perid");
        $per_ids = base64_decode($_GET['ids']);
        $model_pag = new OrdenPago();
        $data = Yii::$app->request->get();
        if ($data['PBgetFilter']) {
            $arrSearch["f_ini"] = $data['f_ini'];
            $arrSearch["f_fin"] = $data['f_fin'];
            $arrSearch["search"] = $data['search'];

            if (empty($per_ids)) {  //vista para el interesado  
                $rol = 1;
                $resp_pago = $model_pag->listarSolicitud($per_id, null, $rol, $arrSearch);
            } else {
                $rol = 0;
                $resp_pago = $model_pag->listarSolicitud($per_ids, null, $rol, $arrSearch);
            }
            return $this->renderPartial('_listarPagosolicGrid', [
                        "model" => $resp_pago,
            ]);
        } else {
            if (empty($per_ids)) {  //vista para el interesado  
                $rol = 1;
                $resp_pago = $model_pag->listarSolicitud($per_id, null, $rol);
            } else {
                $rol = 0;
                $resp_pago = $model_pag->listarSolicitud($per_ids, null, $rol);
            }
        }
        //verificar rol de la persona que esta en sesión
        $resp_rol = $model_pag->encuentraRol($per_id);
        $data = null;
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->get();
            if (isset($data["op"]) && $data["op"] == '1') {
                
            }
        }
        return $this->render('listarPagoSolicitud', [
                    'model' => $resp_pago,
        ]);
    }

    /**
     * Function Cargar pagos.
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>
     * @param   Ninguno. 
     * @return  
     */
    public function actionCargardocpagos() {
        $ccar_id = base64_decode($_GET["ids"]);
        $model_pag = new OrdenPago();
        $arr_forma_pago = $model_pag->formaPago('2');
        $resp_doc = $model_pag->listarDocumento($ccar_id);
        $data = null;
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->get();
            if (isset($data["op"]) && $data["op"] == '1') {
                
            }
        }
        return $this->render('cargarDocPagos', [
                    "arr_forma_pago" => ArrayHelper::map($arr_forma_pago, "id", "value"), 'model' => $resp_doc,
                    "opago" => $ccar_id,
                    "vista" => $_GET["vista"],
        ]);
    }

    /**
     * Function Crearcargapago: Crea carga pago.
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>
     * @param   Ninguno. 
     * @return  
     */
    public function actionCrearcargapago() {
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

    /**
     * Function ListarPagosolRegadm: Consulta las solicitudes con pagos realizados para registro de pagos por parte de Colecturía.
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   Ninguno. 
     * @return  
     */
    public function actionListarpagosolregadm() {
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
            return $this->renderPartial('_listarPagsolregGrid', [
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
        return $this->render('listarPagosolRegadm', [
                    'model' => $resp_pago,                   
        ]);
    }

    /**
     * Function Registrarpagoadm: Llamada a la vista que permite registrar pagos en efectivo, cheque y tarjeta.
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   Ninguno. 
     * @return  
     */
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
        return $this->render('registrarPagoAdm', [
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

    public function actionExpexcel() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $data = Yii::$app->request->get();
        $per_ids = base64_decode($data['ids']);
        $arrSearch["search"] = $data["search"];
        $arrSearch["f_ini"] = $data["f_ini"];
        $arrSearch["f_fin"] = $data["f_fin"];
        $arrData = array();
        $model_pag = new OrdenPago();
        if (empty($per_ids)) {  //vista para el interesado
            // $arrData = OrdenPago::listarSolicitud($per_id, null, $rol, $arrSearch, true);
            $rol = 1;
            $arrData = $model_pag->listarSolicitud($per_id, null, $rol, $arrSearch, true);
        } else {   //vista para el jefe o agente.
            // $arrData = OrdenPago::listarSolicitud($per_ids, null, $rol, $arrSearch, truee);
            $rol = 0;
            $arrData = $model_pag->listarSolicitud($per_ids, null, $rol, $arrSearch, true);
        }

        $nombarch = "ControlpagosReport-" . date("YmdHis");
        $content_type = Utilities::mimeContentType("xls");
        header("Content-Type: $content_type");
        header("Content-Disposition: attachment;filename=" . $nombarch . ".xls");
        header('Cache-Control: max-age=0');
        $arrHeader = array(
            Yii::t("formulario", "Request #"),
            Yii::t("solicitud_ins", "Application date"),
            Yii::t("solicitud_ins", "Income Method"),
            Yii::t("formulario", "Status"),
            "Pago");
        $nameReport = yii::t("formulario", "Control Payments");
        $colPosition = array("C", "D", "E", "F", "G", "H", "I", "J", "K", "L");
        Utilities::generarReporteXLS($nombarch, $nameReport, $arrHeader, $arrData, $colPosition);
        return;
    }

    /**
     * Function Listarpagoscargados: Consulta las solicitudes con pagos cargados.
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   Ninguno. 
     * @return  
     */
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
            return $this->renderPartial('_listarPagosGrid', [
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
        return $this->render('listarPagosCargados', [
                    'model' => $resp_pago,
                    'arrEstados' => $arrEstados
        ]);
    } 

}
