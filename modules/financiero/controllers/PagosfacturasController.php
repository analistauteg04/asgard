<?php

namespace app\modules\financiero\controllers;

use Yii;
use app\models\Utilities;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use app\models\ExportFile;
use app\models\Persona;
use app\models\Usuario;
use yii\helpers\Url;
use yii\base\Exception;
use yii\base\Security;
use app\modules\academico\models\Especies;
use app\modules\financiero\models\FormaPago;
use app\modules\admision\models\Oportunidad;
use app\modules\academico\models\Modalidad;
use app\modules\academico\models\UnidadAcademica;
use app\modules\academico\models\ModuloEstudio;
use app\modules\financiero\models\PagosFacturaEstudiante;
use app\modules\financiero\Module as financiero;
use app\modules\admision\Module as admision;
use app\modules\academico\Module as academico;

admision::registerTranslations();
academico::registerTranslations();

class PagosfacturasController extends \app\components\CController {

    private function estados() {
        return [
            '0' => Yii::t("formulario", "Todos"),
            '1' => Yii::t("formulario", "Pendiente"),
            '2' => Yii::t("formulario", "Aprobado"),
            '3' => Yii::t("formulario", "Rechazado"),
        ];
    }

    private function estadoRechazo() {
        return [
            '0' => Yii::t("formulario", "Seleccione"),
            '3' => Yii::t("formulario", "Rechazado"),
        ];
    }

    public function actionRevisionpagos() {
        $mod_pagos = new PagosFacturaEstudiante();
        $mod_unidad = new UnidadAcademica();
        $mod_modalidad = new Modalidad();
        $modestudio = new ModuloEstudio();
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["getmodalidad"])) {
                if (($data["unidad"] == 1) or ( $data["unidad"] == 2)) {
                    $modalidad = $mod_modalidad->consultarModalidad($data["unidad"], 1);
                } else {
                    $modalidad = $modestudio->consultarModalidadModestudio();
                }
                $message = array("modalidad" => $modalidad);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
        }
        $data = Yii::$app->request->get();
        if ($data['PBgetFilter']) {
            $arrSearch["f_ini"] = $data['f_ini'];
            $arrSearch["f_fin"] = $data['f_fin'];
            $arrSearch["unidad"] = $data['unidad'];
            $arrSearch["modalidad"] = $data['modalidad'];
            $arrSearch["search"] = $data['search'];
            $arrSearch["estadopago"] = $data['estadopago'];
            $resp_pago = $mod_pagos->getPagos($arrSearch, false);
            return $this->renderPartial('_index-grid_revisionpago', [
                        "model" => $resp_pago,
            ]);
        }
        $model = $mod_pagos->getPagos(null, false);
        $arr_unidadac = $mod_unidad->consultarUnidadAcademicas();
        $arr_modalidad = $mod_modalidad->consultarModalidad($arr_unidadac[0]["id"], 1);
        return $this->render('index_revisionpago', [
                    'model' => $model,
                    'arr_unidad' => ArrayHelper::map($arr_unidadac, "id", "name"),
                    'arr_modalidad' => ArrayHelper::map($arr_modalidad, "id", "name"),
                    'arr_estado' => $this->estados(),
        ]);
    }

    public function actionViewsaldo() {
        $per_idsession = @Yii::$app->session->get("PB_perid");
        $especiesADO = new Especies();
        $mod_unidad = new UnidadAcademica();
        $mod_modalidad = new Modalidad();
        $modestudio = new ModuloEstudio();
        $modcanal = new Oportunidad();
        $mod_pagos = new PagosFacturaEstudiante();
        $personaData = $especiesADO->consultaDatosEstudiante($per_idsession);
        $arr_unidadac = $mod_unidad->consultarUnidadAcademicas();
        $arr_modalidad = $mod_modalidad->consultarModalidad($personaData['uaca_id'], 1);
        if (($personaData['uaca_id'] == 1) or ( $personaData['uaca_id'] == 2)) {
            $carrera = $modcanal->consultarCarreraModalidad($personaData['uaca_id'], $personaData['mod_id']);
        } else {
            $carrera = $modestudio->consultarCursoModalidad($personaData['uaca_id'], $personaData['mod_id']); // tomar id de impresa
        }
        $personaData['per_cedula'] = '0202501573'; // DEBE BORRARSE LUEGO DE LAS PREUBAS
        $pagospendientesea = $mod_pagos->getPagospendientexest($personaData['per_cedula'], false);
        return $this->render('viewsaldo', [
                    'arr_persona' => $personaData,
                    'arr_unidad' => ArrayHelper::map($arr_unidadac, "id", "name"),
                    'arr_modalidad' => ArrayHelper::map($arr_modalidad, "id", "name"),
                    'arr_carrera' => ArrayHelper::map($carrera, "id", "name"),
                    'model' => $pagospendientesea,
        ]);
    }

    public function actionRechazar() {
        $dpfa_id = base64_decode($_GET["dpfa_id"]);
        $mod_pagos = new PagosFacturaEstudiante();
        $mod_unidad = new UnidadAcademica();
        $mod_modalidad = new Modalidad();

        $model = $mod_pagos->consultarPago($dpfa_id);
        $arr_unidadac = $mod_unidad->consultarUnidadAcademicas();
        $arr_modalidad = $mod_modalidad->consultarModalidad($arr_unidadac[0]["id"], 1);
        return $this->render('rechazar', [
                    'model' => $model,
                    'arr_unidad' => ArrayHelper::map($arr_unidadac, "id", "name"),
                    'arr_modalidad' => ArrayHelper::map($arr_modalidad, "id", "name"),
                    'arrEstados' => $this->estadoRechazo(),
                    'arrObservacion' => array("0" => "Seleccione", "Archivo Ilegible" => "Archivo Ilegible", "Archivo no corresponde al pago" => "Archivo no corresponde al pago", "Archivo con Error" => "Archivo con Error", "Valor pagado no cubre factura" => "Valor pagado no cubre factura"),
        ]);
    }

    public function actionSubirpago() {
        $per_idsession = @Yii::$app->session->get("PB_perid");
        $especiesADO = new Especies();
        $mod_unidad = new UnidadAcademica();
        $mod_modalidad = new Modalidad();
        $modestudio = new ModuloEstudio();
        $modcanal = new Oportunidad();
        $mod_fpago = new FormaPago();
        $mod_pagos = new PagosFacturaEstudiante();
        $personaData = $especiesADO->consultaDatosEstudiante($per_idsession);
        $arr_unidadac = $mod_unidad->consultarUnidadAcademicas();
        $arr_modalidad = $mod_modalidad->consultarModalidad($personaData['uaca_id'], 1);
        if (($personaData['uaca_id'] == 1) or ( $personaData['uaca_id'] == 2)) {
            $carrera = $modcanal->consultarCarreraModalidad($personaData['uaca_id'], $personaData['mod_id']);
        } else {
            $carrera = $modestudio->consultarCursoModalidad($personaData['uaca_id'], $personaData['mod_id']); // tomar id de impresa
        }
        $arr_forma_pago = $mod_fpago->consultarFormaPagosaldo();
        $personaData['per_cedula'] = '0202501573'; // DEBE BORRARSE LUEGO DE LAS PREUBAS
        $pagospendientesea = $mod_pagos->getPagospendientexest($personaData['per_cedula'], false);
        return $this->render('subirpago', [
                    'arr_persona' => $personaData,
                    'arr_unidad' => ArrayHelper::map($arr_unidadac, "id", "name"),
                    'arr_modalidad' => ArrayHelper::map($arr_modalidad, "id", "name"),
                    'arr_carrera' => ArrayHelper::map($carrera, "id", "name"),
                    "arr_forma_pago" => ArrayHelper::map($arr_forma_pago, "id", "value"),
                    'model' => $pagospendientesea,
        ]);
    }

    public function actionCargarpago() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $ids = isset($_GET['ids']) ? base64_decode($_GET['ids']) : NULL;
        $especiesADO = new Especies();
        $est_id = $especiesADO->recuperarIdsEstudiente($per_id);
        $mod_unidad = new UnidadAcademica();
        $mod_modalidad = new Modalidad();
        $mod_persona = new Persona();
        $data_persona = $mod_persona->consultaPersonaId($per_id);
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if ($data["upload_file"]) {
                if (empty($_FILES)) {
                    return json_encode(['error' => Yii::t("notificaciones", "Error to process File {file}. Try again.", ['{file}' => basename($files['name'])])]);
                }
                //Recibe Parámetros
                $files = $_FILES[key($_FILES)];
                $arrIm = explode(".", basename($files['name']));
                $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                if ($typeFile == 'jpg' || $typeFile == 'png' || $typeFile == 'pdf') {
                    $dirFileEnd = Yii::$app->params["documentFolder"] . "pagosfinanciero/" . $data["name_file"] . "." . $typeFile;
                    $status = Utilities::moveUploadFile($files['tmp_name'], $dirFileEnd);
                    if ($status) {
                        return true;
                    } else {
                        return json_encode(['error' => Yii::t("notificaciones", "Error to process File {file}. Try again.", ['{file}' => basename($files['name'])])]);
                    }
                }
            }
            if ($data["procesar_file"]) {
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
        /* $personaData = $especiesADO->consultaDatosEstudiante($per_id);
          $arr_unidadac = $mod_unidad->consultarUnidadAcademicas();
          $arr_modalidad = $mod_modalidad->consultarModalidad($arr_unidadac[0]["id"], 1);
          $model = $especiesADO->getSolicitudesAlumnos($est_id, null, false); */
        return $this->render('subirpago', [
        ]);
    }

    public function actionSaverechazo() {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $mod_pagos = new PagosFacturaEstudiante();
            $id = $data['dpfa_id'];
            $resultado = $data['resultado'];
            $observacion = $data['observacion'];
            if (($resultado == "0") or ( $observacion == "0")) {
                Utilities::putMessageLogFile('ingresa');
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Seleccione un valor para los campos de 'Resultado' y 'Observación'"),
                    "title" => Yii::t('jslang', 'Success'),
                );
                echo Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), false, $message);
                return;
            } else {
                $con = \Yii::$app->db_facturacion;
                $transaction = $con->beginTransaction();
                try {
                    $datos = $mod_pagos->consultarPago($id);
                    Utilities::putMessageLogFile('$cuota:' . $datos['dpfa_num_cuota']);
                    $respago = $mod_pagos->grabarRechazo($id, $resultado, $observacion);

                    if ($respago) {
                        $transaction->commit();

                        $correo_estudiante = $datos['per_correo'];
                        $user = $datos['estudiante'];
                        $tituloMensaje = 'Pagos en Línea';
                        $asunto = 'Pagos en Línea';
                        if (!empty($datos['dpfa_num_cuota'])) {
                            Utilities::putMessageLogFile('$cuota:' . $datos['dpfa_num_cuota']);
                            $body = Utilities::getMailMessage("pagonegadocuota", array(
                                        "[[user]]" => $user,
                                        "[[link]]" => "https://asgard.uteg.edu.ec/asgard/",
                                        "[[motivo]]" => $observacion,
                                        "[[factura]]" => $datos['dpfa_factura'],
                                        "[[cuota]]" => $datos['dpfa_num_cuota'],
                                            ), Yii::$app->language, Yii::$app->basePath . "/modules/financiero");
                        } else {
                            $body = Utilities::getMailMessage("pagonegado", array(
                                        "[[user]]" => $user,
                                        "[[link]]" => "https://asgard.uteg.edu.ec/asgard/",
                                        "[[motivo]]" => $observacion,
                                        "[[factura]]" => $datos['dpfa_factura'],
                                            ), Yii::$app->language, Yii::$app->basePath . "/modules/financiero");
                        }
                        Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [$correo_estudiante => $user], $asunto, $body);
                        Utilities::putMessageLogFile('graba la transaccion');
                        $message = array(
                            "wtmessage" => Yii::t("notificaciones", "La infomación ha sido grabada"),
                            "title" => Yii::t('jslang', 'Success'),
                        );
                        echo Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                    } else {
                        $message = ["info" => Yii::t('exception', 'Error al grabar 0.')];
                        echo Utilities::ajaxResponse('NO_OK', 'alert', Yii::t('jslang', 'Error'), 'false', $message);
                    }
                } catch (Exception $ex) {
                    $transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error al grabar 1."),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    echo Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                }
                return;
            }
            return;
        }
    }

    public function actionSavepagopendiente() {
        //online que sube doc capturar asi el id de la persona   
        $per_idsession = @Yii::$app->session->get("PB_perid");
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $mod_pagos = new PagosFacturaEstudiante();
            $mod_estudiante = new Especies();
            if ($data["upload_file"]) {
                if (empty($_FILES)) {
                    echo json_encode(['error' => Yii::t("notificaciones", "Error to process File {file}. Try again.", ['{file}' => basename($files['name'])])]);
                    return;
                }
                //Recibe Parametros
                $files = $_FILES[key($_FILES)];
                $arrIm = explode(".", basename($files['name']));
                $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                $dirFileEnd = Yii::$app->params["documentFolder"] . "pagosfinanciero/" . $data["per_id"] . "/" . $data["name_file"] . "." . $typeFile;
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
            $pfes_referencia = $data["referencia"];
            $fpag_id = $data["formapago"];
            $pfes_valor_pago = $data["valor"];
            $pfes_fecha_pago = $data["fechapago"];
            $pfes_observacion = $data["observacion"];
            $est_id = $data["estid"];
            $pagado = $data["pagado"];
            $personaData = $mod_estudiante->consultaDatosEstudiante($per_idsession); //$personaData['per_cedula']
            $con = \Yii::$app->db_facturacion;
            $transaction = $con->beginTransaction();
            try {
                $usuario = @Yii::$app->user->identity->usu_id;   //Se obtiene el id del usuario.
                $resp_pagofactura = $mod_pagos->insertarPagospendientes($est_id, $pfes_referencia, $fpag_id, $pfes_valor_pago, $pfes_fecha_pago, $pfes_observacion, $imagen, $usuario);
                if ($resp_pagofactura) {
                    // se graba el detalle
                    $pagados = explode("*", $pagado); //PAGADOS
                    $x = 0;
                    foreach ($pagados as $datos) {
                        //  consultar la informacion seleccionada de cuota factura
                        $personaData['per_cedula'] = '0202501573'; // DEBE BORRARSE CUANDO SE TENGA EL DATO
                        $parametro = explode(";", $pagados[$x]);
                        $resp_consfactura = $mod_pagos->consultarPagospendientesp($personaData['per_cedula'], $parametro[0], $parametro[1]);
                        // insertar el detalle                        
                        $resp_detpagofactura = $mod_pagos->insertarDetpagospendientes($resp_pagofactura, $resp_consfactura['tipofactura'], $resp_consfactura['factura'], $resp_consfactura['descripcion'], $parametro[2], $resp_consfactura['fecha'], $resp_consfactura['saldo'], $resp_consfactura['numcuota'], $resp_consfactura['valorcuota'], $resp_consfactura['fechavence'], $usuario);
                        $x++;
                    }
                    if ($resp_detpagofactura) {
                        $transaction->commit();
                        $message = array(
                            "wtmessage" => Yii::t("notificaciones", "La infomación ha sido grabada. "),
                            "title" => Yii::t('jslang', 'Success'),
                        );
                        echo Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                    }
                } else {
                    $transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error al grabar pago factura.1" . $mensaje),
                        "title" => Yii::t('jslang', 'Error'),
                    );
                    echo Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), false, $message);
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error al grabar pago factura.2" . $mensaje),
                    "title" => Yii::t('jslang', 'Error'),
                );
                echo Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), false, $message);
            }
            return;
        }
    }

}
