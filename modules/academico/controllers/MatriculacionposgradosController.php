<?php

namespace app\modules\academico\controllers;

use Yii;
use app\models\ExportFile;
use app\modules\academico\models\Admitido;
use app\modules\academico\models\EstudioAcademico;
use yii\helpers\ArrayHelper;
use app\models\Utilities;
use app\modules\academico\models\Modalidad;
use app\modules\academico\models\UnidadAcademica;
use app\modules\academico\models\PromocionPrograma;
use app\modules\academico\models\ParaleloPromocionPrograma;
use app\modules\admision\models\Oportunidad;
use app\modules\admision\models\SolicitudInscripcion;
use app\modules\academico\Module as academico;
use app\modules\financiero\Module as financiero;
use app\modules\admision\Module as admision;

academico::registerTranslations();
admision::registerTranslations();
financiero::registerTranslations();

class MatriculacionposgradosController extends \app\components\CController {

    public function actionIndex() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $mod_programa = new EstudioAcademico();
        $mod_modalidad = new Modalidad();
        $mod_unidad = new UnidadAcademica();
        $modcanal = new Oportunidad();
        $data = Yii::$app->request->get();
        if ($data['PBgetFilter']) {
            $arrSearch["search"] = $data['search'];
            $arrSearch["unidad"] = $data['unidad'];
            $arrSearch["modalidad"] = $data['modalidad'];
            $arrSearch["programa"] = $data['programa'];
            $mod_promocion = PromocionPrograma::getPromocion($arrSearch);
            return $this->renderPartial('index-grid', [
                        "model" => $mod_promocion,
            ]);
        } else {
            $mod_promocion = PromocionPrograma::getPromocion();
        }
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["op"]) && $data["op"] == '1') {
                
            }
            if (isset($data["getmodalidad"])) {
                $modalidad = $mod_modalidad->consultarModalidad($data["uni_id"], 1);
                $message = array("modalidad" => $modalidad);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
            if (isset($data["getprograma"])) {
                $programa = $modcanal->consultarCarreraModalidad($data["unidada"], $data["moda_id"]);
                $message = array("programa" => $programa);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
        }
        $arr_unidad = $mod_unidad->consultarUnidadAcademicasEmpresa(1);
        $arr_modalidad = $mod_modalidad->consultarModalidad($arr_unidad[1]["id"], 1);
        $arr_programa1 = $modcanal->consultarCarreraModalidad($arr_unidad[1]["id"], $arr_modalidad[0]["id"]);
        $arrProgramas = ArrayHelper::map(array_merge([["id" => "0", "value" => Yii::t("formulario", "Grid")]], $mod_programa->consultarCarrera()), "id", "value");
        return $this->render('index', [
                    'model' => $mod_promocion,
                    'arrProgramas' => $arrProgramas,
                    'arr_unidad' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_unidad), "id", "name"),
                    'arr_modalidad' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_modalidad), "id", "name"),
                    'arr_programa1' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_programa1), "id", "name"),
        ]);
    }

    public function actionNew() {
        $sins_id = base64_decode($_GET['sids']);
        $mod_solins = new SolicitudInscripcion();
        $mod_promocion = new PromocionPrograma();
        $mod_paralelo = new ParaleloPromocionPrograma();

        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["getparalelos"])) {
                $resp_Paralelos = $mod_paralelo->consultarParalelosxPrograma($data["promocion_id"]);
                $message = array("paralelos" => $resp_Paralelos);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
        }
        $personaData = $mod_solins->consultarInteresadoPorSol_id($sins_id);
        $resp_programas = $mod_promocion->consultarPromocionxPrograma($personaData["eaca_id"]);
        $arr_Paralelos = $mod_paralelo->consultarParalelosxPrograma(0);
        return $this->render('new', [
                    'personalData' => $personaData,
                    'arr_promocion' => ArrayHelper::map(array_merge([["id" => "0", "name" => "Seleccionar"]], $resp_programas), "id", "name"),
                    'arr_paralelo' => ArrayHelper::map(array_merge(["id" => "0", "name" => "Seleccionar"], $arr_Paralelos), "id", "name"),
        ]);
    }

    public function actionExpexcel() {
        ini_set('memory_limit', '256M');
        $content_type = Utilities::mimeContentType("xls");
        $nombarch = "Report-" . date("YmdHis") . ".xls";
        header("Content-Type: $content_type");
        header("Content-Disposition: attachment;filename=" . $nombarch);
        header('Cache-Control: max-age=0');
        $colPosition = array("C", "D", "E", "F", "G", "H", "I");
        $arrHeader = array(
            Yii::t("formulario", "Code"),
            Yii::t("formulario", "Year"),
            Yii::t("formulario", "Month"),
            academico::t("Academico", "Aca. Uni."),
            academico::t("Academico", "Modality"),
            Yii::t("formulario", "Program"),
            academico::t("Academico", "Parallel")
        );
        $data = Yii::$app->request->get();
        $arrSearch = array();
        if (count($data) > 0) {
            $arrSearch["search"] = $data['search'];
            $arrSearch["unidad"] = $data['unidad'];
            $arrSearch["modalidad"] = $data['modalidad'];
            $arrSearch["programa"] = $data['programa'];
        }
        $arrData = array();
        $promocion = new PromocionPrograma();
        if (count($arrSearch) > 0) {
            $arrData = $promocion->getPromocion($arrSearch, true);
        } else {
            $arrData = $promocion->getPromocion(array(), true);
        }
        \app\models\Utilities::putMessageLogFile($arrData);
        $nameReport = Yii::t("formulario", "Promotion Program");
        Utilities::generarReporteXLS($nombarch, $nameReport, $arrHeader, $arrData, $colPosition);
        exit;
    }

    public function actionExppdf() {
        $report = new ExportFile();
        $this->view->title = Yii::t("formulario", "Promotion Program");  // Titulo del reporte
        $arrHeader = array(
            Yii::t("formulario", "Code"),
            Yii::t("formulario", "Year"),
            Yii::t("formulario", "Month"),
            academico::t("Academico", "Aca. Uni."),
            academico::t("Academico", "Modality"),
            Yii::t("formulario", "Program"),
            academico::t("Academico", "Parallel"),
        );
        $data = Yii::$app->request->get();
        $arrSearch = array();
        if (count($data) > 0) {
            $arrSearch["search"] = $data['search'];
            $arrSearch["unidad"] = $data['unidad'];
            $arrSearch["modalidad"] = $data['modalidad'];
            $arrSearch["programa"] = $data['programa'];
        }
        $arrData = array();
        $promocion = new PromocionPrograma();

        if (count($arrSearch) > 0) {
            $arrData = $promocion->getPromocion($arrSearch, true);
        } else {
            $arrData = $promocion->getPromocion(array(), true);
        }
        $report->orientation = "L"; // tipo de orientacion L => Horizontal, P => Vertical                                
        $report->createReportPdf(
                $this->render('exportpdf', [
                    'arr_head' => $arrHeader,
                    'arr_body' => $arrData
                ])
        );
        $report->mpdf->Output('Reporte_' . date("Ymdhis") . ".pdf", ExportFile::OUTPUT_TO_DOWNLOAD);
    }

    public function actionNewpromocion() {
        $mod_programa = new EstudioAcademico();
        $mod_modalidad = new Modalidad();
        $mod_unidad = new UnidadAcademica();
        $modcanal = new Oportunidad();
        $data = Yii::$app->request->get();
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["getmodalidad"])) {
                $modalidad = $mod_modalidad->consultarModalidad($data["uni_id"], 1);
                $message = array("modalidad" => $modalidad);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
            if (isset($data["getprograma"])) {
                $programa = $modcanal->consultarCarreraModalidad($data["unidada"], $data["moda_id"]);
                $message = array("programa" => $programa);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
        }
        $arr_unidad = $mod_unidad->consultarUnidadAcademicasEmpresa(1);
        $arr_modalidad = $mod_modalidad->consultarModalidad($arr_unidad[1]["id"], 1);
        $arr_programa1 = $modcanal->consultarCarreraModalidad($arr_unidad[1]["id"], $arr_modalidad[0]["id"]);
        $arrProgramas = ArrayHelper::map(array_merge([["id" => "0", "value" => Yii::t("formulario", "Grid")]], $mod_programa->consultarCarrera()), "id", "value");
        return $this->render('newPromocion', [
                    "mes" => array("0" => Yii::t("formulario", "Select"), "1" => Yii::t("academico", "January"), "2" => Yii::t("academico", "Febrary"), "3" => Yii::t("academico", "March"),
                        "4" => Yii::t("academico", "April"), "5" => Yii::t("academico", "May"), "6" => Yii::t("academico", "June"),
                        "7" => Yii::t("academico", "July"), "8" => Yii::t("academico", "August"), "9" => Yii::t("academico", "September"),
                        "10" => Yii::t("academico", "October"), "11" => Yii::t("academico", "November"), "12" => Yii::t("academico", "December")),
                    "arrProgramas" => $arrProgramas,
                    "arr_unidad" => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Select")]], $arr_unidad), "id", "name"),
                    "arr_modalidad" => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Select")]], $arr_modalidad), "id", "name"),
                    "arr_programa1" => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Select")]], $arr_programa1), "id", "name"),
        ]);
    }

    public function actionSavepromocion() {
        $usu_id = @Yii::$app->session->get("PB_iduser");
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $anio = $data["anio"];
            $mes = $data["mes"];
            $unidad = $data["unidad"];
            $modalidad = $data["modalidad"];
            $programa = $data["programa"];
            $paralelo = $data["paralelo"];
            $cupo = $data["cupo"];
            if ($mes > 0 && $mes < 10) {
                $meses = '0' . $mes;
            }
            $codigo = strtoupper(substr($data["nombreprograma"], 0, 3)) . $anio . $meses;
            $con = \Yii::$app->db_academico;
            $transaction = $con->beginTransaction();
            try {
                //$promocion = new PromocionPrograma();
                //Verificar que no tenga una matrícula.
                $mod_Matriculacion = new PromocionPrograma();
                $resp_consPromocion = $mod_Matriculacion->consultarPromocion($anio, $mes, $unidad, $modalidad, $programa);
                if (!$resp_consPromocion) {
                    $fecha = date(Yii::$app->params["dateTimeByDefault"]);
                    //Buscar el código de planificación académica según el periodo, unidad, modalidad y carrera.
                    $resp_promocion = $mod_Matriculacion->insertarPromocion($anio, $mes, $codigo, $unidad, $modalidad, $programa, $paralelo, $cupo, $usu_id, $fecha);
                    if ($resp_promocion) {
                        for ($i = 0; $i < $paralelo; $i++) {
                            $resp_paralelo = $mod_Matriculacion->insertarParalelo($resp_promocion, $cupo, $cupo, $usu_id, $fecha);
                        }
                        if ($resp_paralelo) {
                            $exito = '1';
                        }
                    }
                } else {
                    $mensaje = "¡Ya existe programación con ese información.!";
                }
                if ($exito) {
                    $transaction->commit();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "La información ha sido grabada."),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return \app\models\Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                } else {
                    $transaction->rollback();
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
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $mensaje),
                    "title" => Yii::t('jslang', 'Success'),
                );
                return \app\models\Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
            }
            return;
        }
    }

    public function actionViewpromocion() {
        $mod_programa = new EstudioAcademico();
        $mod_modalidad = new Modalidad();
        $mod_unidad = new UnidadAcademica();
        $modcanal = new Oportunidad();
        $promocion_id = base64_decode($_GET["ids"]);
        $mod_promocion = new PromocionPrograma();
        $data = Yii::$app->request->get();
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["getmodalidad"])) {
                $modalidad = $mod_modalidad->consultarModalidad($data["uni_id"], 1);
                $message = array("modalidad" => $modalidad);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
            if (isset($data["getprograma"])) {
                $programa = $modcanal->consultarCarreraModalidad($data["unidada"], $data["moda_id"]);
                $message = array("programa" => $programa);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
        }
        $resp_consPromocion = $mod_promocion->consultarPromocionxid($promocion_id);
        $arr_unidad = $mod_unidad->consultarUnidadAcademicasEmpresa(1);
        $arr_modalidad = $mod_modalidad->consultarModalidad($arr_unidad[1]["id"], 1);
        $arr_programa1 = $modcanal->consultarCarreraModalidad($arr_unidad[1]["id"], $arr_modalidad[0]["id"]);
        $arrProgramas = ArrayHelper::map(array_merge([["id" => "0", "value" => Yii::t("formulario", "Grid")]], $mod_programa->consultarCarrera()), "id", "value");

        return $this->render('viewPromocion', [
                    "mes" => array("0" => Yii::t("formulario", "Select"), "1" => Yii::t("academico", "January"), "2" => Yii::t("academico", "Febrary"), "3" => Yii::t("academico", "March"),
                        "4" => Yii::t("academico", "April"), "5" => Yii::t("academico", "May"), "6" => Yii::t("academico", "June"),
                        "7" => Yii::t("academico", "July"), "8" => Yii::t("academico", "August"), "9" => Yii::t("academico", "September"),
                        "10" => Yii::t("academico", "October"), "11" => Yii::t("academico", "November"), "12" => Yii::t("academico", "December")),
                    "arrProgramas" => $arrProgramas,
                    "arr_unidad" => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Select")]], $arr_unidad), "id", "name"),
                    "arr_modalidad" => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Select")]], $arr_modalidad), "id", "name"),
                    "arr_programa1" => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Select")]], $arr_programa1), "id", "name"),
                    "data_promo" => $resp_consPromocion,
        ]);
    }

    public function actionEditpromocion() {
        $mod_programa = new EstudioAcademico();
        $mod_modalidad = new Modalidad();
        $mod_unidad = new UnidadAcademica();
        $modcanal = new Oportunidad();
        $promocion_id = base64_decode($_GET["ids"]);
        $mod_promocion = new PromocionPrograma();
        $data = Yii::$app->request->get();
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["getmodalidad"])) {
                $modalidad = $mod_modalidad->consultarModalidad($data["uni_id"], 1);
                $message = array("modalidad" => $modalidad);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
            if (isset($data["getprograma"])) {
                $programa = $modcanal->consultarCarreraModalidad($data["unidada"], $data["moda_id"]);
                $message = array("programa" => $programa);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
        }
        $resp_consPromocion = $mod_promocion->consultarPromocionxid($promocion_id);
        $arr_unidad = $mod_unidad->consultarUnidadAcademicasEmpresa(1);
        $arr_modalidad = $mod_modalidad->consultarModalidad($resp_consPromocion['uaca_id'], 1);
        $arr_programa1 = $modcanal->consultarCarreraModalidad($resp_consPromocion['uaca_id'], $resp_consPromocion['mod_id']);
        $arrProgramas = ArrayHelper::map(array_merge([["id" => "0", "value" => Yii::t("formulario", "Grid")]], $mod_programa->consultarCarrera()), "id", "value");

        return $this->render('editPromocion', [
                    "mes" => array("0" => Yii::t("formulario", "Select"), "1" => Yii::t("academico", "January"), "2" => Yii::t("academico", "Febrary"), "3" => Yii::t("academico", "March"),
                        "4" => Yii::t("academico", "April"), "5" => Yii::t("academico", "May"), "6" => Yii::t("academico", "June"),
                        "7" => Yii::t("academico", "July"), "8" => Yii::t("academico", "August"), "9" => Yii::t("academico", "September"),
                        "10" => Yii::t("academico", "October"), "11" => Yii::t("academico", "November"), "12" => Yii::t("academico", "December")),
                    "arrProgramas" => $arrProgramas,
                    "arr_unidad" => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Select")]], $arr_unidad), "id", "name"),
                    "arr_modalidad" => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Select")]], $arr_modalidad), "id", "name"),
                    "arr_programa1" => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Select")]], $arr_programa1), "id", "name"),
                    "data_promo" => $resp_consPromocion,
        ]);
    }

    public function actionUpdatepromocion() {
        $usu_id = @Yii::$app->session->get("PB_iduser");
        $fecha_modifica = date(Yii::$app->params["dateTimeByDefault"]);
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $programa_id = $data["progid"];
            $anio = $data["anio"];
            $mes = $data["mes"];
            $unidad = $data["unidad"];
            $modalidad = $data["modalidad"];
            $programa = $data["programa"];
            if ($mes > 0 && $mes < 10) {
                $meses = '0' . $mes;
            }
            $codigo = strtoupper(substr($data["nombreprograma"], 0, 3)) . $anio . $meses;
            $con = \Yii::$app->db_academico;
            $transaction = $con->beginTransaction();
            try {
                $mod_programa = new PromocionPrograma();

                $keys_act = [
                    'ppro_anio', 'ppro_mes', 'ppro_codigo', 'uaca_id', 'mod_id'
                    , 'eaca_id', 'ppro_usuario_modifica', 'ppro_fecha_modificacion'
                ];
                $values_act = [
                    $anio, $mes, $codigo, $unidad, $modalidad,
                    $programa, $usu_id, $fecha_modifica
                ];
                $resp_consPromocion = $mod_programa->consultarPromocion($anio, $mes, $unidad, $modalidad, $programa);
                if (!$resp_consPromocion) {
                    $respPrograma = $mod_programa->actualizarPromocion($con, $programa_id, $values_act, $keys_act, 'promocion_programa');
                } else {
                    $mensaje = "¡Ya existe programación con ese información.!";
                }
                if ($respPrograma) {
                    $exito = 1;
                }
                if ($exito) {
                    $transaction->commit();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "La infomación ha sido actualizada."),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                } else {
                    $transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $mensaje),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error al grabar."),
                    "title" => Yii::t('jslang', 'Success'),
                );
                return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
            }
            return;
        }
    }

    public function actionIndexparalelo() {
        $promocion_id = base64_decode($_GET["ids"]);
        $mod_promocion = new PromocionPrograma();
        $mod_paralelo = new ParaleloPromocionPrograma();
        $resp_consPromocion = $mod_promocion->consultarPromocionxid($promocion_id);
        $mod_paral = ParaleloPromocionPrograma::getParalelos($promocion_id);
        return $this->render('indexParalelo', [
                    'model' => $mod_paral,
                    "data_promo" => $resp_consPromocion,
        ]);
    }

    public function actionDeleteparalelo() {
        $user_id = @Yii::$app->session->get("PB_iduser");
        $mod_paralelo = new ParaleloPromocionPrograma();
        $mod_promocion = new PromocionPrograma();
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $par_id = $data["par_id"];
            $promocion_id = $data["pro_id"];
            $con = \Yii::$app->db_academico;
            $transaction = $con->beginTransaction();
            try {
                //Eliminar en registro
                $registro = $mod_paralelo->deleteParelelo($par_id, $user_id);
                if ($registro) {
                    //Consultar el numero de paralelos en promocion
                    $resp_consPromocion = $mod_promocion->consultarPromocionxid($promocion_id);
                    //Actualizar el numero de paralelos activos en promocion
                    if ($resp_consPromocion['ppro_num_paralelo'] > 0) {
                        $resp_ModPromocion = $mod_promocion->actualizarPromocionparalelo($promocion_id, $resp_consPromocion['ppro_num_paralelo'], $user_id);
                        if ($registro) {
                            $transaction->commit();
                            $message = array(
                                "wtmessage" => Yii::t("notificaciones", "Se ha eliminado el paralelo."),
                                "title" => Yii::t('jslang', 'Success'),
                            );
                            return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                        } else {
                            $transaction->rollback();
                            $message = array(
                                "wtmessage" => Yii::t("notificaciones", "Error al eliminar el paralelo. "),
                                "title" => Yii::t('jslang', 'Error'),
                            );
                            return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), false, $message);
                        }
                    } else {
                        $transaction->rollback();
                        $message = array(
                            "wtmessage" => Yii::t("notificaciones", "Error al eliminar el paralelo. "),
                            "title" => Yii::t('jslang', 'Error'),
                        );
                        return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), false, $message);
                    }
                } else {
                    $transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error al eliminar el paralelo. "),
                        "title" => Yii::t('jslang', 'Error'),
                    );
                    return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), false, $message);
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error al eliminar el paralelo. "),
                    "title" => Yii::t('jslang', 'Success'),
                );
                return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), false, $message);
            }
        }
    }

}
