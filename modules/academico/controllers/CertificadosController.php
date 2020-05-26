<?php

namespace app\modules\academico\controllers;

use Yii;
use app\models\Utilities;
use app\models\ExportFile;
use app\models\Persona;
use yii\helpers\Url;
use yii\base\Exception;
use yii\helpers\ArrayHelper;
use app\modules\financiero\models\FormaPago;
use app\modules\academico\models\ModuloEstudio;
use app\modules\academico\models\Modalidad;
use app\modules\academico\models\UnidadAcademica;
use app\modules\academico\Module as academico;
use app\modules\academico\models\Especies;
use app\models\Empresa;
use app\modules\academico\Module as Especie;
use app\modules\academico\models\CertificadosGeneradas;
use app\modules\academico\Module as certificados;

certificados::registerTranslations();

Academico::registerTranslations();
Especie::registerTranslations();

class CertificadosController extends \app\components\CController {

    private function estadoPagos() {
        return [
            '0' => Yii::t("formulario", "Todos"),
            '1' => Yii::t("formulario", "Pendiente"),
            '2' => Yii::t("formulario", "Pago Solicitud - Rechazado"),
            '3' => Yii::t("formulario", "Generado"),
        ];
    }

    public function actionIndex() {
        $mod_certificado = new CertificadosGeneradas();
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
            $arrSearch["estdocerti"] = $data['estdocerti'];
            $resp_cert = $mod_certificado->getCertificadosGeneradas($arrSearch, false);
            return $this->renderPartial('_index-grid', [
                        "model" => $resp_cert,
            ]);
        }
        $model = $mod_certificado->getCertificadosGeneradas(null, false);
        $arr_unidadac = $mod_unidad->consultarUnidadAcademicas();
        $arr_modalidad = $mod_modalidad->consultarModalidad($arr_unidadac[0]["id"], 1);
        return $this->render('index', [
                    'model' => $model,
                    'arrEstados' => $this->estadoPagos(),
                    'arr_unidad' => ArrayHelper::map($arr_unidadac, "id", "name"),
                    'arr_modalidad' => ArrayHelper::map($arr_modalidad, "id", "name"),
                    'arr_estadocertificado' => array("0" => "Todos", "1" => "Código Generado", "2" => "Certificado Generado"),
        ]);
    }

    public function actionExpexcelcertificado() {
        ini_set('memory_limit', '256M');
        $content_type = Utilities::mimeContentType("xls");
        $nombarch = "Report-" . date("YmdHis") . ".xls";
        header("Content-Type: $content_type");
        header("Content-Disposition: attachment;filename=" . $nombarch);
        header('Cache-Control: max-age=0');
        $colPosition = array("C", "D", "E", "F", "G", "H", "I", "J");
        $arrHeader = array(
            Especie::t("Especies", "Número"),
            Especie::t("Especies", "Número Especie"),
            Especie::t("Especies", "Student"),            
            Especie::t("Especies", "Academic unit"),
            academico::t("Academico", "Modality"),
            Especie::t("Especies", "Código Certificado"),
            Especie::t("Especies", "Fecha Genarado"),
            Especie::t("Especies", "Certified Status"),               
            
        );
        $mod_certificado = new CertificadosGeneradas();
        $data = Yii::$app->request->get();
        $arrSearch["f_ini"] = $data['f_ini'];
        $arrSearch["f_fin"] = $data['f_fin'];
        $arrSearch["unidad"] = $data['unidad'];
        $arrSearch["modalidad"] = $data['modalidad'];
        $arrSearch["search"] = $data['search'];        
        $arrSearch["estdocerti"] = $data['estdocerti'];

        $arrData = array();
        if (empty($arrSearch)) {
            $arrData = $mod_certificado->getCertificadosGeneradas(array(), true);
        } else {
            $arrData = $mod_certificado->getCertificadosGeneradas($arrSearch, true);
        }
        $nameReport = certificados::t("certificados", "List of generated certificate");
        Utilities::generarReporteXLS($nombarch, $nameReport, $arrHeader, $arrData, $colPosition);
        exit;
    }
    public function actionExppdfcertificado() {
        $report = new ExportFile();
        $arrHeader = array(
            Especie::t("Especies", "Número"),
            Especie::t("Especies", "Número Especie"),
            Especie::t("Especies", "Student"),            
            Especie::t("Especies", "Academic unit"),
            academico::t("Academico", "Modality"),
            Especie::t("Especies", "Código Certificado"),
            Especie::t("Especies", "Fecha Genarado"),
            Especie::t("Especies", "Certified Status"), 
            
        );
        $mod_certificado = new CertificadosGeneradas();
        $data = Yii::$app->request->get();
        $arrSearch["f_ini"] = $data['f_ini'];
        $arrSearch["f_fin"] = $data['f_fin'];
        $arrSearch["unidad"] = $data['unidad'];
        $arrSearch["modalidad"] = $data['modalidad'];
        $arrSearch["search"] = $data['search'];
        $arrSearch["estdocerti"] = $data['estdocerti'];
        $arrData = array();
        if (empty($arrSearch)) {
            $arrData = $mod_certificado->getCertificadosGeneradas(array(), true);
        } else {
            $arrData = $mod_certificado->getCertificadosGeneradas($arrSearch, true);
        }

        $this->view->title = certificados::t("certificados", "List of generated certificate"); // Titulo del reporte                
        $report->orientation = "L"; // tipo de orientacion L => Horizontal, P => Vertical
        $report->createReportPdf(
                $this->render('exportpdf', [
                    'arr_head' => $arrHeader,
                    'arr_body' => $arrData
                ])
        );
        $report->mpdf->Output('Reporte_' . date("Ymdhis") . ".pdf", ExportFile::OUTPUT_TO_DOWNLOAD);
        return;
    }
    public function actionSubircertificado() {
        $cgen_id = base64_decode($_GET["cgen_id"]);
        $mod_certificado = new CertificadosGeneradas();
        $respcertificado = $mod_certificado->consultarCertificadosGeneradas($cgen_id);    
        return $this->render('subircertificado', [    
            'arr_certificado' => $respcertificado,
        ]);
    }
    public function actionSavecertificado() {
        //online que sube doc capturar asi el id de la persona 
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
                $dirFileEnd = Yii::$app->params["documentFolder"] . "certificados/" . $data["per_id"] . "/" . $data["name_file"] . "." . $typeFile;
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
            $cgen_id = $data["cgen_id"];
            $observacion = $data["observacion"];
            //$codigocerti = $data["upload_file"];
            
            //$con = \Yii::$app->db_academico;
            //$transaction = $con->beginTransaction();
            

           /* try {
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
                        "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $mensaje),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    echo Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $transaction2->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $mensaje),
                    "title" => Yii::t('jslang', 'Success'),
                );
                echo Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
            }
            return;*/
        }
    }

}
