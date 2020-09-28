<?php

namespace app\modules\academico\controllers;

use Yii;
use app\models\ExportFile;
use app\components\CController;
use app\modules\academico\models\Planificacion;
use app\modules\academico\models\Modalidad;
use app\modules\academico\models\RegistroConfiguracion;
use app\modules\academico\models\PeriodoAcademicoMetIngreso;
use app\modules\academico\models\UnidadAcademica;
use app\modules\admision\models\Oportunidad;
use app\models\Persona;
use app\modules\academico\models\ModuloEstudio;
use yii\helpers\ArrayHelper;
use yii\data\ArrayDataProvider;
use yii\base\Exception;
use app\models\Utilities;
use yii\helpers\VarDumper;
use app\modules\academico\Module as academico;
use app\modules\academico\models\PlanificacionEstudiante;

academico::registerTranslations();

class PlanificacionController extends \app\components\CController {

    private function Bloques() {
        return [
            '0' => Yii::t("formulario", "Seleccionar"),
            '1' => Yii::t("formulario", "Bloque 1"),
            '2' => Yii::t("formulario", "Bloque 2"),
        ];
    }

    private function Horas() {
        return [
            '0' => Yii::t("formulario", "Seleccionar"),
            '1' => Yii::t("formulario", "Hora 1"),
            '2' => Yii::t("formulario", "Hora 2"),
            '3' => Yii::t("formulario", "Hora 3"),
            '4' => Yii::t("formulario", "Hora 4"),
            '5' => Yii::t("formulario", "Hora 5"),
            '6' => Yii::t("formulario", "Hora 6"),
        ];
    }

    public function actionIndex() {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->get();
            /* if (isset($data["search"])) { */
            $pla_periodo_academico = $data["pla_periodo_academico"];
            $mod_id = $data["mod_id"];
            $dataPlanificaciones = Planificacion::getAllPlanificacionesGrid($search, $pla_periodo_academico, $mod_id);
            $dataProvider = new ArrayDataProvider([
                'key' => 'pla_id',
                'allModels' => $dataPlanificaciones,
                'pagination' => [
                    'pageSize' => Yii::$app->params["pageSize"],
                ],
                'sort' => [
                    'attributes' => ["PeriodoAcademico"],
                ],
            ]);
            return $this->renderPartial('index-grid', [
                        "model" => $dataProvider,
            ]);
            /*   } */
        }
        /*
          $arr_pla = Planificacion::find()
          ->select(['ROW_NUMBER() OVER (ORDER BY pla_periodo_academico) pla_id', 'pla_periodo_academico'])
          ->where('pla_estado_logico = 1 and pla_estado = 1')
          ->groupBy(['pla_periodo_academico'])
          ->all();
         */
        $arr_pla = Planificacion::getPeriodosAcademico();
        /* print_r($arr_pla); */
        //if (count($arr_pla) > 0) {
        $arr_modalidad = Modalidad::findAll(["mod_estado" => 1, "mod_estado_logico" => 1]);
        $pla_periodo_academico = $arr_pla[0]->pla_periodo_academico;
        $mod_id = $arr_modalidad[0]->mod_id;
        $dataPlanificaciones = Planificacion::getAllPlanificacionesGrid(null, $pla_periodo_academico, $mod_id);
        $dataProvider = new ArrayDataProvider([
            'key' => 'pla_id',
            'allModels' => $dataPlanificaciones,
            'pagination' => [
                'pageSize' => Yii::$app->params["pageSize"],
            ],
            'sort' => [
                'attributes' => ["Modalidad"],
            ],
        ]);
        return $this->render('index', [
                    'arr_pla' => (empty(ArrayHelper::map($arr_pla, "pla_periodo_academico", "pla_periodo_academico"))) ? array(Yii::t("planificacion", "-- Select periodo --")) : (ArrayHelper::map($arr_pla, "pla_periodo_academico", "pla_periodo_academico")),
                    'arr_modalidad' => (empty(ArrayHelper::map($arr_modalidad, "mod_id", "mod_nombre"))) ? array(Yii::t("planificacion", "-- Select Modality --")) : (ArrayHelper::map($arr_modalidad, "mod_id", "mod_nombre")),
                    'model' => $dataProvider,
                    'pla_periodo_academico' => $pla_periodo_academico,
                    'mod_id' => $mod_id,
        ]);
        //} 
    }

    public function actionUpload() {
        $usu_id = Yii::$app->session->get("PB_iduser");
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if ($data["upload_file"]) {
                if (empty($_FILES)) {
                    return json_encode(['error' => Yii::t("notificaciones", "Error to process File " . basename($files['name']) . ". Try again.")]);
                }
                //Recibe Parámetros
                $files = $_FILES[key($_FILES)];
                $arrIm = explode(".", basename($files['name']));
                $namefile = substr_replace($data["name_file"], $data["mod_id"], 14, 0);
                $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                if ($typeFile == 'xlsx' || $typeFile == 'csv' || $typeFile == 'xls') {
                    $dirFileEnd = Yii::$app->params["documentFolder"] . "planificacion/" . $namefile . "." . $typeFile;
                    $status = Utilities::moveUploadFile($files['tmp_name'], $dirFileEnd);
                    if ($status) {
                        return true;
                    } else {
                        return json_encode(['error' => Yii::t("notificaciones", "Error to process File " . basename($files['name']) . ". Try again.")]);
                    }
                } else {
                    return json_encode(['error' => Yii::t("notificaciones", "Error to process File " . basename($files['name']) . ". Try again.")]);
                }
            }

            if ($data["procesar_file"]) {
                ini_set('memory_limit', '256M');
                $per_id = Yii::$app->session->get("PB_perid");
                $model_planificacionEstudiante = new PlanificacionEstudiante();
                try {
                    $namefile = substr_replace($data["archivo"], $data["modalidad"], 14, 0);
                    $path = "planificacion/" . $namefile;
                    $modelo_planificacion = new Planificacion();
                    $modelo_planificacion->mod_id = $data["modalidad"];
                    $modelo_planificacion->per_id = $per_id;
                    $modelo_planificacion->pla_fecha_inicio = $data["fechaInicio"];
                    $modelo_planificacion->pla_fecha_fin = $data["fechaFin"];
                    $modelo_planificacion->pla_periodo_academico = $data["periodoAcademico"];
                    $modelo_planificacion->pla_path = $path;
                    $modelo_planificacion->pla_estado = "1";
                    $modelo_planificacion->pla_estado_logico = "1";
                    if ($modelo_planificacion->save()) {
                        /*  return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), true, "guardado"); */
                        $pla_id = $modelo_planificacion->getPrimaryKey();
                        $carga_archivo = $model_planificacionEstudiante->processFile($namefile, $pla_id);
                        /*  return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), true, $carga_archivo); */
                        if ($carga_archivo['status']) {
                            $message = array(
                                "wtmessage" => Yii::t("notificaciones", "Archivo procesado correctamente. " . $carga_archivo['message']),
                                "title" => Yii::t('jslang', 'Success'),
                            );
                            return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Success"), false, $message);
                        } else {
                            /* $modelo_planificacion_saved = Planificacion::findOne($pla_id);
                              $modelo_planificacion_saved->delete(); */
                            $message = array(
                                "wtmessage" => Yii::t("notificaciones", "Error al procesar el archivo1. " . $carga_archivo['message']),
                                "title" => Yii::t('jslang', 'Error'),
                            );

                            return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), true, $message);
                        }
                    }
                } catch (Exception $ex) {
                    /* $modelo_planificacion_saved = Planificacion::findOne($pla_id);
                      $modelo_planificacion_saved->delete(); */
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error al procesar el archivo2."),
                        "title" => Yii::t('jslang', 'Error'),
                    );
                    return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), true, $message);
                }
            };
        } else {
            $arr_modalidad = Modalidad::findAll(["mod_estado" => 1, "mod_estado_logico" => 1]);
            return $this->render('cargar_planificacion', [
                        'arr_modalidad' => (empty(ArrayHelper::map($arr_modalidad, "mod_id", "mod_nombre"))) ? array(Yii::t("planificacion", "-- Select planificacion --")) : (ArrayHelper::map($arr_modalidad, "mod_id", "mod_nombre"))
            ]);
        }
    }

    public function actionDescargarplanificacion() {
        $report = new ExportFile();

        $data = Yii::$app->request->get();

        $pla_id = $data['pla_id'];
        $planificacion = Planificacion::findOne(["pla_id" => $pla_id]);
        $file = Yii::$app->basePath . Yii::$app->params['documentFolder'] . $planificacion->pla_path;
        if (file_exists($file)) {
            Yii::$app->response->sendFile($file);
        } else {
            /*             * en caso de que no */
        }
        return;
    }

    public function actionSave() {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            try {
                $fecha_inicio = $data["pla_fecha_inicio"];
                $fecha_fin = $data["pla_fecha_fin"];
                $periodo_academico = $data["pla_periodo_academico"];
                $estado = $data["estado"];
                $mod_id = $data["mod_id"];

                $planificacion_model = new Planificacion();
                $planificacion_model->pla_fecha_inicio = $fecha_inicio;
                $planificacion_model->pla_fecha_fin = $fecha_fin;
                $planificacion_model->pla_periodo_academico = $periodo_academico;
                $planificacion_model->mod_id = $mod_id;
                $planificacion_model->pla_estado = $estado;
                $planificacion_model->pla_estado_logico = "1";
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Your information was successfully saved."),
                    "title" => Yii::t('jslang', 'Success'),
                );
                if ($planificacion_model->save()) {
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                } else {
                    throw new Exception('Error SubModulo no creado.');
                }
            } catch (Exception $ex) {
                $message = array(
                    "wtmessage" => Yii::t('notificaciones', 'Your information has not been saved. Please try again.'),
                    "title" => Yii::t('jslang', 'Error'),
                );
                return Utilities::ajaxResponse('NOOK', 'alert', Yii::t('jslang', 'Error'), 'true', $message);
            }
        }
    }

    public function actionRegisterprocess() {
        $modelReg = new RegistroConfiguracion();
        $data = Yii::$app->request->get();
        if ($data['PBgetFilter']) {
            $pla_periodo_academico = $data["periodo"];
            $mod_id = $data["mod_id"];
            $model = $modelReg->getRegistroConfList($pla_periodo_academico, $mod_id);
            return $this->renderPartial('register-index-grid', [
                        "model" => $model,
            ]);
        }

        $arr_pla = Planificacion::getPeriodosAcademico();
        $arr_modalidad = Modalidad::findAll(["mod_estado" => 1, "mod_estado_logico" => 1]);
        $model = $modelReg->getRegistroConfList(null, 0);
        return $this->render('register-index', [
                    'arr_pla' => ArrayHelper::map(array_merge([["pla_id" => "0", "pla_periodo_academico" => Yii::t("formulario", "Grid")]], $arr_pla), "pla_id", "pla_periodo_academico"),
                    'arr_modalidad' => ArrayHelper::map(array_merge([["mod_id" => "0", "mod_nombre" => Yii::t("formulario", "Grid")]], $arr_modalidad), "mod_id", "mod_nombre"),
                    'model' => $model,
        ]);
    }

    public function actionNewreg() {
        $modplanificacion = new Planificacion();
        //$arr_pla = ArrayHelper::map(Planificacion::getPeriodosAcademico(), "pla_id", "pla_periodo_academico");
        $_SESSION['JSLANG']['The initial date of registry cannot be greater than end date.'] = academico::t('matriculacion', 'The initial date of registry cannot be greater than end date.');
        //$arr_pla = ArrayHelper::map(Planificacion::findAll(['pla_estado' => 1, 'pla_estado_logico' => 1]), "pla_id", "pla_periodo_academico");
        $arr_pla = $modplanificacion->getPeriodosmodalidad();
        return $this->render('newreg', [
                    //'arr_pla' => $arr_pla,
                    //'arr_pla' => ArrayHelper::map(array_merge([["id" => "0", "name" => "Seleccionar"]],$arr_pla),"id","name"),
                    "arr_pla" => ArrayHelper::map($arr_pla, "id", "name"),
        ]);
    }

    public function actionViewreg() {
        $data = Yii::$app->request->get();
        if (isset($data['id'])) {
            $id = $data['id'];
            $model = RegistroConfiguracion::findOne($id);
            $arr_pla = ArrayHelper::map(Planificacion::findAll(['pla_estado' => 1, 'pla_estado_logico' => 1]), "pla_id", "pla_periodo_academico");
            return $this->render('viewreg', [
                        'model' => $model,
                        'arr_pla' => $arr_pla,
                        'pla_id' => $model->pla_id,
                        'rco_id' => $model->rco_id,
                        'bloque' => ($model->rco_num_bloques == 1) ? 0 : 1,
            ]);
        }
        return $this->redirect('registerprocess');
    }

    public function actionEditreg() {
        $data = Yii::$app->request->get();
        if (isset($data['id'])) {
            $id = $data['id'];
            $model = RegistroConfiguracion::findOne($id);
            $arr_pla = ArrayHelper::map(Planificacion::findAll(['pla_estado' => 1, 'pla_estado_logico' => 1]), "pla_id", "pla_periodo_academico");
            return $this->render('editreg', [
                        'model' => $model,
                        'arr_pla' => $arr_pla,
                        'pla_id' => $model->pla_id,
                        'rco_id' => $model->rco_id,
                        'bloque' => ($model->rco_num_bloques == 1) ? 0 : 1,
            ]);
        }
        return $this->redirect('registerprocess');
    }

    public function actionUpdatereg() {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            try {
                $id = $data["id"];
                $pla_id = $data["pla_id"];
                $finicio = $data["finicio"];
                $ffin = $data["ffin"];
                $bloque = $data["bloque"];
                $model = RegistroConfiguracion::findOne($id);
                $model->pla_id = $pla_id;
                $model->rco_fecha_inicio = $finicio . " 00:00:00";
                $model->rco_fecha_fin = $ffin . " 23:59:59";
                $model->rco_num_bloques = ($bloque == 0) ? 1 : 2;
                $model->rco_fecha_modificacion = date(Yii::$app->params['dateTimeByDefault']);
                $model->rco_usuario_modifica = Yii::$app->session->get("PB_iduser");
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Your information was successfully saved."),
                    "title" => Yii::t('jslang', 'Success'),
                );
                if ($model->update() !== false) {
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                } else {
                    throw new Exception('Error registro no actualizado.');
                }
            } catch (Exception $ex) {
                $message = array(
                    "wtmessage" => Yii::t('notificaciones', 'Your information has not been saved. Please try again.'),
                    "title" => Yii::t('jslang', 'Error'),
                );
                return Utilities::ajaxResponse('NOOK', 'alert', Yii::t('jslang', 'Error'), 'true', $message);
            }
        }
    }

    public function actionSavereg() {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            try {
                $pla_id = $data["pla_id"];
                $finicio = $data["finicio"];
                $ffin = $data["ffin"];
                $bloque = $data["bloque"];
                $model = new RegistroConfiguracion();
                $model->pla_id = $pla_id;
                $model->rco_fecha_inicio = $finicio . " 00:00:00";
                $model->rco_fecha_fin = $ffin . " 23:59:59";
                $model->rco_num_bloques = ($bloque == 0) ? 1 : 2;
                $model->rco_estado = "1";
                $model->rco_estado_logico = "1";
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Your information was successfully saved."),
                    "title" => Yii::t('jslang', 'Success'),
                );
                if ($model->save()) {
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                } else {
                    throw new Exception('Error registro no creado.');
                }
            } catch (Exception $ex) {
                $message = array(
                    "wtmessage" => Yii::t('notificaciones', 'Your information has not been saved. Please try again.'),
                    "title" => Yii::t('jslang', 'Error'),
                );
                return Utilities::ajaxResponse('NOOK', 'alert', Yii::t('jslang', 'Error'), 'true', $message);
            }
        }
    }

    public function actionDeletereg() {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            try {
                $id = $data["id"];
                $model = RegistroConfiguracion::findOne($id);
                $model->rco_estado = '0';
                $model->rco_estado_logico = '0';
                $model->rco_usuario_modifica = Yii::$app->session->get("PB_iduser");
                $model->rco_fecha_modificacion = date(Yii::$app->params['dateTimeByDefault']);
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Your information was successfully saved."),
                    "title" => Yii::t('jslang', 'Success'),
                );
                if ($model->update() !== false) {
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                } else {
                    throw new Exception('Error registro no ha sido eliminado.');
                }
            } catch (Exception $ex) {
                $message = array(
                    "wtmessage" => Yii::t('notificaciones', 'Your information has not been saved. Please try again.'),
                    "title" => Yii::t('jslang', 'Error'),
                );
                return Utilities::ajaxResponse('NOOK', 'alert', Yii::t('jslang', 'Error'), 'true', $message);
            }
        }
    }

    public function actionPlanificacionestudiante() {
        $emp_id = @Yii::$app->session->get("PB_idempresa");
        $mod_periodo = new PlanificacionEstudiante();
        $periodo = $mod_periodo->consultarPeriodoplanifica();
        $uni_aca_model = new UnidadAcademica();
        $modestudio = new ModuloEstudio();
        $modalidad_model = new Modalidad();
        $modcanal = new Oportunidad();
        $unidad_acad_data = $uni_aca_model->consultarUnidadAcademicas();
        $modalidad_data = $modalidad_model->consultarModalidad($unidad_acad_data[0]["id"], $emp_id);
        $academic_study_data = $modcanal->consultarCarreraModalidad($unidad_acad_data[0]["id"], $modalidad_data[0]["id"]);
        $model_plan = $mod_periodo->consultarEstudianteplanifica();
        $data = Yii::$app->request->get();
        if ($data['PBgetFilter']) {
            $arrSearch["estudiante"] = $data['estudiante'];
            $arrSearch["unidad"] = $data['unidad'];
            $arrSearch["modalidad"] = $data['modalidad'];
            /* $arrSearch["carrera"] = $data['carrera']; */
            $arrSearch["periodo"] = $data['periodo'];
            $model_plan = $mod_periodo->consultarEstudianteplanifica($arrSearch);
            return $this->render('planificacionestudiante-grid', [
                        'model' => $model_plan,
            ]);
        }
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["getmodalidad"])) {
                if (($data["nint_id"] == 1) or ( $data["nint_id"] == 2)) {
                    $modalidad = $modalidad_model->consultarModalidad($data["nint_id"], $data["empresa_id"]);
                } else {
                    $modalidad = $modestudio->consultarModalidadModestudio();
                }
                $message = array("modalidad" => $modalidad);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
            if (isset($data["getcarrera"])) {
                if (($data["unidada"] == 1) or ( $data["unidada"] == 2)) {
                    $carrera = $modcanal->consultarCarreraModalidad($data["unidada"], $data["moda_id"]);
                } else {
                    $carrera = $modestudio->consultarCursoModalidad($data["unidada"], $data["moda_id"]); // tomar id de impresa
                }
                $message = array("carrera" => $carrera);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
        }
        return $this->render('planificacionestudiante', [
                    'arr_unidad' => ArrayHelper::map(array_merge([["id" => "0", "name" => "Todas"]], $unidad_acad_data), "id", "name"),
                    'arr_modalidad' => ArrayHelper::map(array_merge([["id" => "0", "name" => "Todas"]], $modalidad_data), "id", "name"),
                    'arr_carrera' => ArrayHelper::map(array_merge([["id" => "0", "name" => "Todas"]], $academic_study_data), "id", "name"),
                    'arr_periodo' => ArrayHelper::map(array_merge([["id" => "0", "name" => "Todas"]], $periodo), "id", "name"),
                    'model' => $model_plan,
        ]);
    }

    public function actionExpexcelplanifica() {
        ini_set('memory_limit', '256M');
        $content_type = Utilities::mimeContentType("xls");
        $nombarch = "Report-" . date("YmdHis") . ".xls";
        header("Content-Type: $content_type");
        header("Content-Disposition: attachment;filename=" . $nombarch);
        header('Cache-Control: max-age=0');
        $colPosition = array("C", "D", "E", "F", "G", "H");
        $arrHeader = array(
            Yii::t("formulario", "DNI 1"),
            Yii::t("formulario", "Student"),
            Yii::t("crm", "Carrera"),
            Yii::t("formulario", "Period"),
        );
        $mod_periodo = new PlanificacionEstudiante();
        $data = Yii::$app->request->get();
        $arrSearch["estudiante"] = $data['estudiante'];
        $arrSearch["unidad"] = $data['unidad'];
        $arrSearch["modalidad"] = $data['modalidad'];
        /* $arrSearch["carrera"] = $data['carrera']; */
        $arrSearch["periodo"] = $data['periodo'];
        $arrData = array();
        if (empty($arrSearch)) {
            $arrData = $mod_periodo->consultarEstudianteplanifica(array(), true);
        } else {
            $arrData = $mod_periodo->consultarEstudianteplanifica($arrSearch, true);
        }
        $nameReport = academico::t("Academico", "Lista de Planificación por Estudiante");
        Utilities::generarReporteXLS($nombarch, $nameReport, $arrHeader, $arrData, $colPosition);
        exit;
    }

    public function actionExppdfplanifica() {
        $report = new ExportFile();
        $this->view->title = academico::t("Academico", "Lista de Planificación por Estudiante"); // Titulo del reporte                
        $arrHeader = array(
            Yii::t("formulario", "DNI 1"),
            Yii::t("formulario", "Student"),
            Yii::t("crm", "Carrera"),
            Yii::t("formulario", "Period"),
        );
        $mod_periodo = new PlanificacionEstudiante();
        $data = Yii::$app->request->get();
        $arrSearch["estudiante"] = $data['estudiante'];
        $arrSearch["unidad"] = $data['unidad'];
        $arrSearch["modalidad"] = $data['modalidad'];
        /* $arrSearch["carrera"] = $data['carrera']; */
        $arrSearch["periodo"] = $data['periodo'];
        $arrData = array();
        if (empty($arrSearch)) {
            $arrData = $mod_periodo->consultarEstudianteplanifica(array(), true);
        } else {
            $arrData = $mod_periodo->consultarEstudianteplanifica($arrSearch, true);
        }
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

    public function actionView() {
        $pla_id = $_GET["pla_id"];
        $per_id = $_GET["per_id"];
        $emp_id = 1;
        $mod_periodo = new PlanificacionEstudiante();
        $periodo = $mod_periodo->consultarPeriodoplanifica();
        $uni_aca_model = new UnidadAcademica();
        //$modestudio = new ModuloEstudio();
        $modalidad_model = new Modalidad();
        $modcanal = new Oportunidad();
        $mod_cabecera = $mod_periodo->consultarCabeceraplanifica($pla_id, $per_id);
        $unidad_acad_data = $uni_aca_model->consultarUnidadAcademicas();
        $modalidad_data = $modalidad_model->consultarModalidad($unidad_acad_data[0]["id"], $emp_id);
        $academic_study_data = $modcanal->consultarCarreraModalidad($unidad_acad_data[0]["id"], $mod_cabecera["mod_id"]);
        $mod_detalle = $mod_periodo->consultarDetalleplanifica($pla_id, $per_id);
        return $this->render('view', [
                    'arr_cabecera' => $mod_cabecera,
                    'model_detalle' => $mod_detalle,
                    'arr_unidad' => ArrayHelper::map($unidad_acad_data, "id", "name"),
                    'arr_modalidad' => ArrayHelper::map($modalidad_data, "id", "name"),
                    'arr_carrera' => ArrayHelper::map($academic_study_data, "id", "name"),
                    'arr_periodo' => ArrayHelper::map($periodo, "id", "name"),
        ]);
    }

    public function actionDeleteplanest() {
        $mod_planestudiante = new PlanificacionEstudiante();
        $usu_autenticado = @Yii::$app->session->get("PB_iduser");
        $estado = 0;
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $pla_id = $data["pla_id"];
            $per_id = $data["per_id"];
            $fecha = date(Yii::$app->params["dateTimeByDefault"]);
            $con = \Yii::$app->db_academico;
            $transaction = $con->beginTransaction();
            try {
                $resp_estado = $mod_planestudiante->eliminarPlanificacionest($pla_id, $per_id, $usu_autenticado, $estado, $fecha);
                if ($resp_estado) {
                    $exito = '1';
                }
                if ($exito) {
                    //Realizar accion
                    $transaction->commit();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Se ha eliminado la planificación del estudiante."),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                } else {
                    $transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error al eliminar planificación del estudiante. "),
                        "title" => Yii::t('jslang', 'Error'),
                    );
                    return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), false, $message);
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error al realizar la acción. "),
                    "title" => Yii::t('jslang', 'Success'),
                );
                return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), false, $message);
            }
        }
    }

    public function actionEdit() {
        $pla_id = $_GET["pla_id"];
        $per_id = $_GET["per_id"];
        $emp_id = 1;
        $mod_periodo = new PlanificacionEstudiante();
        $periodo = $mod_periodo->consultarPeriodoplanifica();
        $uni_aca_model = new UnidadAcademica();
        //$modestudio = new ModuloEstudio();
        $modalidad_model = new Modalidad();
        $modcanal = new Oportunidad();
        $mod_cabecera = $mod_periodo->consultarCabeceraplanifica($pla_id, $per_id);
        $unidad_acad_data = $uni_aca_model->consultarUnidadAcademicas();
        $modalidad_data = $modalidad_model->consultarModalidad($unidad_acad_data[0]["id"], $emp_id);
        $academic_study_data = $modcanal->consultarCarreraModalidad($unidad_acad_data[0]["id"], $mod_cabecera["mod_id"]);
        $mod_detalle = $mod_periodo->consultarDetalleplanifica($pla_id, $per_id);
        return $this->render('edit', [
                    'arr_cabecera' => $mod_cabecera,
                    'model_detalle' => $mod_detalle,
                    'arr_unidad' => ArrayHelper::map($unidad_acad_data, "id", "name"),
                    'arr_modalidad' => ArrayHelper::map($modalidad_data, "id", "name"),
                    'arr_carrera' => ArrayHelper::map($academic_study_data, "id", "name"),
                    'arr_periodo' => ArrayHelper::map($periodo, "id", "name"),
                    'arr_bloque' => $this->Bloques(),
                    'arr_hora' => $this->Horas(),
                    'arr_modalidadh' => ArrayHelper::map(array_merge([["id" => "0", "name" => "Seleccionar"]], $modalidad_data), "id", "name"),
        ]);
    }

    public function actionDeletematest() {
        $mod_planestudiante = new PlanificacionEstudiante();
        $usu_autenticado = @Yii::$app->session->get("PB_iduser");
        $estado = 1;
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $pla_id = $data["pla_id"];
            $per_id = $data["per_id"];
            $bloque = $data["bloque"];
            $hora = $data["hora"];
            $fecha = date(Yii::$app->params["dateTimeByDefault"]);
            $con = \Yii::$app->db_academico;
            $transaction = $con->beginTransaction();
            try {
                $resp_estado = $mod_planestudiante->eliminarPlanmatest($pla_id, $per_id, $bloque, $hora, $usu_autenticado, $estado, $fecha);
                if ($resp_estado) {
                    $exito = '1';
                }
                if ($exito) {
                    //Realizar accion
                    $transaction->commit();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Se ha eliminado la materia del estudiante."),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                } else {
                    $transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error al eliminar materia del estudiante. "),
                        "title" => Yii::t('jslang', 'Error'),
                    );
                    return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), false, $message);
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error al realizar la acción. "),
                    "title" => Yii::t('jslang', 'Success'),
                );
                return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), false, $message);
            }
        }
    }

}
