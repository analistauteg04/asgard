<?php

namespace app\modules\academico\controllers;

use Yii;
use app\modules\academico\models\PeriodoAcademicoMetIngreso;
use app\modules\academico\models\MatriculadosReprobado;
use app\modules\academico\models\EstudioAcademico;
use app\modules\academico\models\Admitido;
use yii\helpers\ArrayHelper;
use app\models\Utilities;
use app\models\Persona;
use app\models\Provincia;
use app\models\Pais;
use app\models\Canton;
use app\models\MedioPublicitario;
use app\modules\academico\models\Modalidad;
use app\modules\academico\models\UnidadAcademica;
use app\modules\admision\models\PersonaGestion;
use app\modules\admision\models\Oportunidad;
use app\modules\admision\models\MetodoIngreso;
use app\models\InscripcionAdmision;
use app\modules\academico\Module as academico;
use app\modules\admision\Module as admision;
use app\models\ExportFile;

academico::registerTranslations();
admision::registerTranslations();

class MatriculadosreprobadosController extends \app\components\CController {

    public function actionIndex() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $mod_carrera = new EstudioAcademico();

        $data = Yii::$app->request->get();
        if ($data['PBgetFilter']) {
            $arrSearch["f_ini"] = $data['f_ini'];
            $arrSearch["f_fin"] = $data['f_fin'];
            $arrSearch["search"] = $data['search'];
            $mod_matreprueba = MatriculadosReprobado::getMatriculadosreprobados($arrSearch);
            return $this->renderPartial('index-grid', [
                        "model" => $mod_matreprueba,
            ]);
        } else {
            $mod_aspirante = MatriculadosReprobado::getMatriculadosreprobados();
        }
        if (Yii::$app->request->isAjax) {//
            $data = Yii::$app->request->get();
            if (isset($data["op"]) && $data["op"] == '1') {
                
            }
        }
        $arrCarreras = ArrayHelper::map(array_merge([["id" => "0", "value" => Yii::t("formulario", "Grid")]], $mod_carrera->consultarCarrera()), "id", "value");
        return $this->render('index', [
                    'model' => $mod_aspirante,
                    'arrCarreras' => $arrCarreras,
        ]);
    }

    public function actionSavereprobadostemp() {
        if (Yii::$app->request->isAjax) {
            $model = new MatriculadosReprobado();
            $data = Yii::$app->request->post();
            try {
                $accion = isset($data['ACCION']) ? $data['ACCION'] : "";
                $repro_temp_id = $data["DATA_1"][0]["twin_id"];
                $accion = isset($data['ACCION']) ? $data['ACCION'] : "";
                if ($accion == "create" || $accion == "Create") {
                    $resul = $model->insertarReprobadoTemp($data["DATA_1"]);
                } else if ($accion == "Update") {
                    //Modificar Registro
                    //$resul = $model->actualizarInscripcion($data);
                    //$model->insertaOriginal($resul["ids"]);
                }
                if ($resul['status']) {
                    $message = array(
                        "wtmessage" => Yii::t("formulario", "The information have been saved"),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message, $resul);
                } else {
                    $message = array(
                        "wtmessage" => Yii::t("formulario", "The information have not been saved."),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t('jslang', 'Error'), 'false', $message, $resul);
                }
                return;
//                if (isset($data["DATA_1"][0]["ruta_doc_titulo"]) && $data["DATA_1"][0]["ruta_doc_titulo"] != "") {
//                    $arrIm = explode(".", basename($data["DATA_1"][0]["ruta_doc_titulo"]));
//                    $typeFile = strtolower($arrIm[count($arrIm) - 1]);
//                    $titulo_archivoOld = Yii::$app->params["documentFolder"] . "solicitudadmision/" . $inscripcion_id . "/doc_titulo_per_" . $inscripcion_id . "." . $typeFile;
//                    $titulo_archivo = InscripcionAdmision::addLabelTimeDocumentos($inscripcion_id, $titulo_archivoOld, $timeSt);
//                    $data["DATA_1"][0]["ruta_doc_titulo"] = $titulo_archivo;
//                    if ($titulo_archivo === false)
//                        throw new Exception('Error doc Titulo no renombrado.');
//                }
//                if (isset($data["DATA_1"][0]["ruta_doc_dni"]) && $data["DATA_1"][0]["ruta_doc_dni"] != "") {
//                    $arrIm = explode(".", basename($data["DATA_1"][0]["ruta_doc_dni"]));
//                    $typeFile = strtolower($arrIm[count($arrIm) - 1]);
//                    $dni_archivoOld = Yii::$app->params["documentFolder"] . "solicitudadmision/" . $inscripcion_id . "/doc_dni_per_" . $inscripcion_id . "." . $typeFile;
//                    $dni_archivo = InscripcionAdmision::addLabelTimeDocumentos($inscripcion_id, $dni_archivoOld, $timeSt);
//                    $data["DATA_1"][0]["ruta_doc_dni"] = $dni_archivo;
//                    if ($dni_archivo === false)
//                        throw new Exception('Error doc Dni no renombrado.');
//                }
//                if (isset($data["DATA_1"][0]["ruta_doc_certvota"]) && $data["DATA_1"][0]["ruta_doc_certvota"] != "") {
//                    $arrIm = explode(".", basename($data["DATA_1"][0]["ruta_doc_certvota"]));
//                    $typeFile = strtolower($arrIm[count($arrIm) - 1]);
//                    $certvota_archivoOld = Yii::$app->params["documentFolder"] . "solicitudadmision/" . $inscripcion_id . "/doc_certvota_per_" . $inscripcion_id . "." . $typeFile;
//                    $certvota_archivo = InscripcionAdmision::addLabelTimeDocumentos($inscripcion_id, $certvota_archivoOld, $timeSt);
//                    $data["DATA_1"][0]["ruta_doc_certvota"] = $certvota_archivo;
//                    if ($certvota_archivo === false)
//                        throw new Exception('Error doc certificado vot. no renombrado.');
//                }
//                if (isset($data["DATA_1"][0]["ruta_doc_foto"]) && $data["DATA_1"][0]["ruta_doc_foto"] != "") {
//                    $arrIm = explode(".", basename($data["DATA_1"][0]["ruta_doc_foto"]));
//                    $typeFile = strtolower($arrIm[count($arrIm) - 1]);
//                    $foto_archivoOld = Yii::$app->params["documentFolder"] . "solicitudadmision/" . $inscripcion_id . "/doc_foto_per_" . $inscripcion_id . "." . $typeFile;
//                    $foto_archivo = InscripcionAdmision::addLabelTimeDocumentos($inscripcion_id, $foto_archivoOld, $timeSt);
//                    $data["DATA_1"][0]["ruta_doc_foto"] = $foto_archivo;
//                    if ($foto_archivo === false)
//                        throw new Exception('Error doc Foto no renombrado.');
//                }
//                if (isset($data["DATA_1"][0]["ruta_doc_certificado"]) && $data["DATA_1"][0]["ruta_doc_certificado"] != "") {
//                    $arrIm = explode(".", basename($data["DATA_1"][0]["ruta_doc_certificado"]));
//                    $typeFile = strtolower($arrIm[count($arrIm) - 1]);
//                    $doc_certificadoOld = Yii::$app->params["documentFolder"] . "solicitudadmision/" . $inscripcion_id . "/doc_certificado_per_" . $inscripcion_id . "." . $typeFile;
//                    $doc_certificado = InscripcionAdmision::addLabelTimeDocumentos($inscripcion_id, $doc_certificadoOld, $timeSt);
//                    $data["DATA_1"][0]["ruta_doc_certificado"] = $doc_certificado;
//                    if ($doc_certificado === false)
//                        throw new Exception('Error doc Certificado no renombrado.');
//                }
//                if (isset($data["DATA_1"][0]["ruta_doc_hojavida"]) && $data["DATA_1"][0]["ruta_doc_hojavida"] != "") {
//                    $arrIm = explode(".", basename($data["DATA_1"][0]["ruta_doc_hojavida"]));
//                    $typeFile = strtolower($arrIm[count($arrIm) - 1]);
//                    $doc_hojaVidaOld = Yii::$app->params["documentFolder"] . "solicitudadmision/" . $inscripcion_id . "/doc_hojavida_per_" . $inscripcion_id . "." . $typeFile;
//                    $doc_hojaVida = InscripcionAdmision::addLabelTimeDocumentos($inscripcion_id, $doc_hojaVidaOld, $timeSt);
//                    $data["DATA_1"][0]["ruta_doc_hojavida"] = $doc_hojaVida;
//                    if ($doc_hojaVida === false)
//                        throw new Exception('Error doc Hoja de Vida no renombrado.');
//                }
            } catch (Exception $ex) {
                $message = array(
                    "wtmessage" => $ex->getMessage(),
                    "title" => Yii::t('jslang', 'Error'),
                );
                return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), false, $message);
            }
        }
    }

    public function actionNewreprobado() {
        $mod_admitido = new MatriculadosReprobado();
        $mod_unidad = new UnidadAcademica();
        $mod_modalidad = new Modalidad();
        $modcanal = new Oportunidad();
        $mod_periodo = new PeriodoAcademicoMetIngreso();
        $dato = Yii::$app->request->get();
        if (isset($dato["search"])) {
            $arradmitido = $mod_admitido->getMatriculados($dato["search"]);
            return $this->renderPartial('newreprobado-grid', [
                        "model" => $arradmitido,
            ]);
        }
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $datas = Yii::$app->request->get();
            if ($datas['PBgetFilter']) {
                $uaca_id = $datas['unidad'];
                $moda_id = $datas['modalidad'];
                $car_id = $datas['carrera'];
                $periodo = $datas['periodo'];
                $arrperio = $mod_periodo->consultarPeriodoanterior($periodo);
                $arr_materia = $mod_admitido->consultarMateriasPorUnidadModalidadCarrera($uaca_id, $moda_id, $car_id, $arrperio[0]["mes"], $arrperio[0]["anio"]);
                return $this->renderPartial('materia-grid', [
                            'model' => $arr_materia,
                ]);
            } else {
                $arr_materia = $mod_admitido->consultarMateriasPorUnidadModalidadCarrera(0, 0, 0, '', '');
            }
            if (isset($data["getmodalidad"])) {
                $modalidad = $mod_modalidad->consultarModalidad($data["nint_id"], 1);
                $message = array("modalidad" => $modalidad);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }
            if (isset($data["getcarrera"])) {
                $carrera = $modcanal->consultarCarreraModalidad($data["unidada"], $data["moda_id"]);
                $message = array("carrera" => $carrera);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }
        }
        $arrperiodo = $mod_periodo->consultarPeriodo();
        $arradmitido = $mod_admitido->getMatriculados(0);
        $arr_ninteres = $mod_unidad->consultarUnidadAcademicasEmpresa(1);
        $arr_modalidad = $mod_modalidad->consultarModalidad($arr_ninteres[0]["id"], 1);
        $arr_carrerra1 = $modcanal->consultarCarreraModalidad($arr_ninteres[0]["id"], $arr_modalidad[0]["id"]);
        $arr_materia = $mod_admitido->consultarMateriasPorUnidadModalidadCarrera(0, 0, 0, '', '');
        return $this->render('newreprobado', [
                    'admitido' => $arradmitido,
                    'arr_carrerra1' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Select")]], $arr_carrerra1), "id", "name"),
                    'arr_modalidad' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Select")]], $arr_modalidad), "id", "name"),
                    'arr_ninteres' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Select")]], $arr_ninteres), "id", "name"),
                    'arr_periodo' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Select")]], $arrperiodo), "id", "name"),
                    'arr_estado_aprobacion' => ArrayHelper::map([["id" => "0", "name" => "Aprobado"]], "id", "name"),
                    'arr_materia' => $arr_materia,
        ]);
    }

    public function actionView() {
        return $this->render('view', [
        ]);
    }

    public function actionEdit() {
        return $this->render('edit', [
        ]);
    }

    public function actionNew() {
        $per_id = Yii::$app->session->get("PB_perid");
        $mod_persona = Persona::findIdentity($per_id);
        $mod_modalidad = new Modalidad();
        $mod_pergestion = new PersonaGestion();
        $mod_unidad = new UnidadAcademica();
        $modcanal = new Oportunidad();
        $mod_metodo = new MetodoIngreso();
        $mod_inscripcion = new InscripcionAdmision();

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
            if (isset($data["getcarrera"])) {
                $carrera = $modcanal->consultarCarreraModalidad($data["unidada"], $data["moda_id"]);
                $message = array("carrera" => $carrera);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
            if (isset($data["getmetodo"])) {
                $metodos = $mod_metodo->consultarMetodoUnidadAca_2($data['nint_id']);
                $message = array("metodos" => $metodos);
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
        $arr_carrerra1 = $modcanal->consultarCarreraModalidad(1, $arr_modalidad[0]["id"]);
        $arr_metodos = $mod_metodo->consultarMetodoUnidadAca_2($arr_ninteres[0]["id"]);
        $_SESSION['JSLANG']['Your information has not been saved. Please try again.'] = Yii::t('notificaciones', 'Your information has not been saved. Please try again.');

        return $this->render('new', [
                    "tipos_dni" => array("CED" => Yii::t("formulario", "DNI Document"), "PASS" => Yii::t("formulario", "Passport")),
                    "tipos_dni2" => array("CED" => Yii::t("formulario", "DNI Document1"), "PASS" => Yii::t("formulario", "Passport1")),
                    "txth_extranjero" => $mod_persona->per_nac_ecuatoriano,
                    "arr_pais_dom" => ArrayHelper::map($arr_pais_dom, "id", "value"),
                    "arr_prov_dom" => ArrayHelper::map($arr_prov_dom, "id", "value"),
                    "arr_ciu_dom" => ArrayHelper::map($arr_ciu_dom, "id", "value"),
                    "arr_ninteres" => ArrayHelper::map($arr_ninteres, "id", "name"),
                    "arr_medio" => ArrayHelper::map($arr_medio, "id", "value"),
                    "arr_modalidad" => ArrayHelper::map($arr_modalidad, "id", "name"),
                    "arr_conuteg" => ArrayHelper::map($arr_conuteg, "id", "name"),
                    "arr_carrerra1" => ArrayHelper::map($arr_carrerra1, "id", "name"),
                    "arr_metodos" => ArrayHelper::map($arr_metodos, "id", "name"),
                    "resp_datos" => $resp_datos,
        ]);
    }

    public function actionSave() {
        $periodo = 0;
        $mod_admitido = new MatriculadosReprobado();
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $ides = $data["ids"];
            $valores = explode("_", $ides);
            $admitido = $valores[0];
            $sins_id = $valores[1];
            $uniacademica = $data["uniacademica"];
            $modalidad = $data["modalidad"];
            $carrera = $data['carreprog'];
            $asigna = $data['materia'];
            $usuario = @Yii::$app->user->identity->usu_id;
            $periodo = $data['periodo'];
            $con = \Yii::$app->db_captacion;
            $transaction = $con->beginTransaction();
            try {
                $mod_reprobado = new MatriculadosReprobado();
                $fecha_creacion = date(Yii::$app->params["dateTimeByDefault"]);
                $resp_matreprobado = $mod_reprobado->consultarReprobado($sins_id);
                if ($resp_matreprobado["encontrado"] == 0) {
                    $resp_ingreso = $mod_reprobado->insertarMatricureprobado($admitido, $periodo, $sins_id, $usuario, $fecha_creacion);
                    $mre_id = Yii::$app->db_captacion->getLastInsertID('db_captacion.matriculados_reprobado');
                    if ($resp_ingreso) {
                        if (!empty($asigna)) {
                            for ($i = 0; $i < strlen($asigna); $i++) {
                                //Guardado Datos Materias reprobadas.                        
                                $asigantura = $asigna[$i];
                                $estado_materia = 2;
                                if ($asigantura != ' ') {
                                    $res_materia = $mod_reprobado->insertarMateriareprueba($mre_id, $asigantura, $estado_materia, $usuario, $fecha_creacion);
                                    if ($res_materia) {
                                        $exito = 1;
                                    } else {
                                        $exito = 0;
                                    }
                                    //$reprobar = $reprobar . ' ' . 'asig.asi_id != ' . $asigna[$i] . ' and ';
                                }
                            }
                            //Guardado Datos Materias aprobadas.                         
                            $estado_materiare = 1;
                            /*$arr_materia = $mod_admitido->consultarMateriarep($uniacademica, $modalidad, $carrera, $reprobar);
                            $arr_materias = ArrayHelper::map($arr_materia, "id", "value");
                            for ($j = 0; $j < count($arr_materias); $j++) {
                                if ($res_materia) {
                                    \app\models\Utilities::putMessageLogFile('xxx..  ' . $arr_materias["value"][$j]);
                                    $res_reprobam = $mod_reprobado->insertarMateriareprueba($mre_id, $arr_materias[$j], $estado_materiare, $usuario, $fecha_creacion);
                                    if ($res_reprobam) {
                                        $exito = 1;
                                    }
                                }
                            }*/
                        }
                    }
                    if ($exito) {
                        $transaction->commit();
                        $message = array(
                            "wtmessage" => Yii::t("notificaciones", "La infomación ha sido grabada. "),
                            "title" => Yii::t('jslang', 'Success'),
                        );
                        echo Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                    } else {
                        $transaction->rollback();
                        $message = array(
                            "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $mensaje),
                            "title" => Yii::t('jslang', 'Success'),
                        );
                        echo Utilities::ajaxResponse('NO_OK', 'Error', Yii::t("jslang", "Error"), false, $message);
                    }
                } else {
                    $transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("Error", "Ya se encuentra ingresada esta persona." . $mensaje),
                        "title" => Yii::t('jslang', 'Error'),
                    );
                    echo Utilities::ajaxResponse('NO_OK', 'Error', Yii::t("jslang", "Error"), false, $message);
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $mensaje),
                    "title" => Yii::t('jslang', 'Success'),
                );
                echo Utilities::ajaxResponse('NO_OK', 'Error', Yii::t("jslang", "Error"), false, $message);
            }
            return;
        }
    }

    public function actionUpdate() {
        return $this->render('update', [
        ]);
    }

    public function actionExpexcel() {
        ini_set('memory_limit', '256M');
        $content_type = Utilities::mimeContentType("xls");
        $nombarch = "Report-" . date("YmdHis") . ".xls";
        header("Content-Type: $content_type");
        header("Content-Disposition: attachment;filename=" . $nombarch);
        header('Cache-Control: max-age=0');
        $colPosition = array("C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P");
        $arrHeader = array(
            Yii::t("formulario", "DNI 1"),
            Yii::t("formulario", "First Names"),
            ' ',
            Yii::t("formulario", "Last Names"),
            ' ',
            Yii::t("formulario", "Email"),
            Yii::t("formulario", "CellPhone"),
            Yii::t("formulario", "Academic unit"),
            Yii::t("formulario", "Mode"),
            academico::t("Academico", "Month Process"),
            academico::t("Academico", "Career/Program"),
            admision::t("Solicitudes", "Income Method"),
            Yii::t("formulario", "Subject")
        );
        $data = Yii::$app->request->get();
        $arrSearch = array();
        if (count($data) > 0) {
            $arrSearch["f_ini"] = $data['fecha_ini'];
            $arrSearch["f_fin"] = $data['fecha_fin'];
            $arrSearch["search"] = $data['search'];
        }
        $arrData = array();
        $mod_matreprueba = new MatriculadosReprobado();
        if (count($arrSearch) > 0) {
            $arrData = $mod_matreprueba->consultarMatriculareprueba($arrSearch, true);
        } else {
            $arrData = $mod_matreprueba->consultarMatriculareprueba(array(), true);
        }
        $nameReport = academico::t("Academico", "List Failed Enrollments");
        Utilities::generarReporteXLS($nombarch, $nameReport, $arrHeader, $arrData, $colPosition);
        exit;
    }

    public function actionExportpdf() {
        $report = new ExportFile();
        $this->view->title = academico::t("Academico", "List Failed Enrollments");  // Titulo del reporte
        $arrHeader = array(
            Yii::t("formulario", "DNI 1"),
            Yii::t("formulario", "First Names"),
            ' ',
            Yii::t("formulario", "Last Names"),
            ' ',
            Yii::t("formulario", "Email"),
            Yii::t("formulario", "CellPhone"),
            Yii::t("formulario", "Academic unit"),
            Yii::t("formulario", "Mode"),
            academico::t("Academico", "Month Process"),
            academico::t("Academico", "Career/Program"),
            admision::t("Solicitudes", "Income Method"),
            Yii::t("formulario", "Subject")
        );
        $data = Yii::$app->request->get();
        $arrSearch = array();
        if (count($data) > 0) {
            $arrSearch["f_ini"] = $data['fecha_ini'];
            $arrSearch["f_fin"] = $data['fecha_fin'];
            $arrSearch["search"] = $data['search'];
        }
        $arrData = array();
        $mod_matreprueba = new MatriculadosReprobado();
        if (count($arrSearch) > 0) {
            $arrData = $mod_matreprueba->consultarMatriculareprueba($arrSearch, true);
        } else {
            $arrData = $mod_matreprueba->consultarMatriculareprueba(array(), true);
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

}
