<?php

namespace app\modules\academico\controllers;

use Yii;
use app\modules\admision\models\SolicitudInscripcion;
use app\modules\academico\models\Matriculacion;
use yii\helpers\ArrayHelper;
use app\models\Utilities;
use app\models\ExportFile;
use app\models\Usuario;
use app\models\Persona;
use app\modules\academico\models\Planificacion;
use app\modules\academico\models\Modalidad;
use app\modules\academico\models\RegistroOnline;
use app\modules\academico\models\RegistroOnlineCuota;
use app\modules\academico\models\PlanificacionEstudiante;
use app\modules\academico\models\RegistroOnlineItem;
use app\modules\academico\models\RegistroPagoMatricula;
use yii\data\ArrayDataProvider;
use yii\base\Exception;
use app\modules\academico\Module as Academico;

Academico::registerTranslations();


class MatriculacionController extends \app\components\CController {

    public function actionNewhomologacion() {
        return $this->render('newHomologacion', [
        ]);
    }

    public function actionNewmetodoingreso() {
        $sins_id = base64_decode($_GET['sids']);
        $mod_solins = new SolicitudInscripcion();
        $mod_matriculacion = new Matriculacion();
        $pmin_id = 0;
        
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["getparalelos"])) {                                
               // \app\models\Utilities::putMessageLogFile('pmin_id ajax: ' . $data["pmin_id"]);
                $resp_Paralelos = $mod_matriculacion->consultarParalelo($data["pmin_id"]);
                $message = array("paralelos" => $resp_Paralelos);               
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);               
            }           
        }               
        $personaData = $mod_solins->consultarInteresadoPorSol_id($sins_id);
        $resp_Periodos = $mod_matriculacion->consultarPeriodoAcadMing($personaData["uaca_id"], $personaData["mod_id"], $personaData["ming_id"]);
        $arr_Paralelos = $mod_matriculacion->consultarParalelo($pmin_id);
        return $this->render('newmetodoingreso', [
                    'personalData' => $personaData,            
                    'arr_periodo' => ArrayHelper::map(array_merge([["id" => "0", "name" => "Seleccionar"]],$resp_Periodos),"id","name"), //ArrayHelper::map($resp_Periodos, "id", "name"),
                    'arr_paralelo' => ArrayHelper::map(array_merge(["id" => "0", "name" => "Seleccionar"],$arr_Paralelos),"id","name"), //ArrayHelper::map($arr_Paralelos, "id", "name"),
        ]);
    }


    public function actionSave() {
        $usu_id = @Yii::$app->session->get("PB_iduser");
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $par_id = $data["par_id"];
            $periodo_id = $data["per_id"];
            $adm_id = base64_decode($data["adm_id"]);
            $sins_id = base64_decode($data["sins_id"]);
            $con = \Yii::$app->db_academico;
            $transaction = $con->beginTransaction();
            try {
                if (($periodo_id!=0) and ($par_id!=0)) {   
                    //Verificar que no tenga una matrícula.
                    $mod_Matriculacion = new Matriculacion();
                    $resp_consMatricula = $mod_Matriculacion->consultarMatriculaxId($adm_id, $sins_id);
                    if (!$resp_consMatricula) {
                        $fecha = date(Yii::$app->params["dateTimeByDefault"]);
                        $descripcion = "Asignación por Matrícula Método Ingreso.";
                        \app\models\Utilities::putMessageLogFile('periodo:'.$periodo_id);     
                        \app\models\Utilities::putMessageLogFile('solic:'.$sins_id);     
                        //Buscar el código de planificación académica según el periodo, unidad, modalidad y carrera.
                        $resp_planificacion = $mod_Matriculacion->consultarPlanificacion($sins_id, $periodo_id);
                        if ($resp_planificacion) { //Si existe código de planificación
                            $resp_matriculacion = $mod_Matriculacion->insertarMatriculacion($resp_planificacion["peac_id"], $adm_id, null, $sins_id, $fecha, $usu_id);
                            if ($resp_matriculacion) {
                                $resp_Asigna = $mod_Matriculacion->insertarAsignacionxMeting($par_id, $resp_matriculacion, null, $descripcion, $fecha, $usu_id);
                                if ($resp_Asigna) {
                                    $exito = '1';
                                }
                            }
                        }  else {
                            $mensaje = "¡No existe código de planificación académica para los datos proporcionados.!";
                        }                      
                    } else {
                        $mensaje = "¡Ya existe matrícula.!";
                    }                   
                } else {
                    $mensaje = "¡Seleccione Período Académico y Paralelo.!";
                }
                if ($exito) {
                    $transaction->commit();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "La información ha sido grabada."),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return \app\models\Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                } else {
                    //$paso = 1;
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

    /***********************************************  funciones nuevas matriculacion  *****************************************/

    /**
     * Function controller to /matriculacion/index
     * @author Emilio Moran <emiliojmp9@gmail.com>
     * @param
     * @return
     */
    public function actionIndex() {
        $per_id = Yii::$app->session->get("PB_perid");

        $matriculacion_model = new Matriculacion();
        $today = date("Y-m-d H:i:s");
        $result_process = $matriculacion_model->checkToday($today);

        $usu_id = Yii::$app->session->get("PB_iduser");
        $mod_usuario = Usuario::findIdentity($usu_id);
        if ($mod_usuario->usu_upreg == 0) {
            return $this->redirect(['perfil/index']);
        }

        if (count($result_process) > 0) {
            /*             * Exist a register process */
            $rco_id = $result_process[0]['rco_id'];
            $rco_num_bloques = $result_process[0]['rco_num_bloques'];
            $pla_id = $result_process[0]['pla_id'];

            /*             * Verificando si el estudiante ha pagado */
            $result_pago = RegistroPagoMatricula::checkPagoEstudiante($per_id, $pla_id);

            if (count($result_pago) > 0) {
                $resultIdPlanificacionEstudiante = $matriculacion_model->getIdPlanificacionEstudiante($per_id, $pla_id);
                if (count($resultIdPlanificacionEstudiante) > 0) {
                    /*                     * Exist a register of planificacion_estudiante */
                    $pes_id = $resultIdPlanificacionEstudiante[0]['pes_id'];
                    $pla_id = $resultIdPlanificacionEstudiante[0]['pla_id'];
                    $resultRegistroOnline = $matriculacion_model->checkPlanificacionEstudianteRegisterConfiguracion($per_id, $pes_id, $pla_id);
                    if (count($resultRegistroOnline) > 0) {
                        //Cuando existe un registro en registro_online
                        return $this->redirect('registro');
                    } else {
                        //Cuando no existe registro en registro_online, eso quiere decir que no ha seleccionado las materias aun y registrado

                        /* $con1 = \Yii::$app->db_facturacion; */

                        /* Secuencias::initSecuencia($con1, 1, 1, 1, "RAC", "PAGO REGISTRO ONLINE"); */
                        /*                         * No exist register into registro_online, so with need saved the data into register_online */
                        $data_student = $matriculacion_model->getDataStudent($per_id, $pla_id, $pes_id);
                        $dataPlanificacion = $matriculacion_model->getAllDataPlanificacionEstudiante($per_id, $pla_id, $rco_num_bloques);
                        $num_min = 0;
                        $num_max = 10;
                        if (count($dataPlanificacion) <= 4) {
                            $num_min = count($dataPlanificacion);
                            $num_max = count($dataPlanificacion);
                        } else {
                            $num_min = 4;
                        }

                        $dataProvider = new ArrayDataProvider([
                            'key' => 'Ids',
                            'allModels' => $dataPlanificacion,
                            'pagination' => [
                                'pageSize' => Yii::$app->params["pageSize"],
                            ],
                            'sort' => [
                                'attributes' => ["Subject"],
                            ],
                        ]);

                        return $this->render('index', [
                                    "planificacion" => $dataProvider,
                                    "data_student" => $data_student,
                                    "num_min" => $num_min,
                                    "num_max" => $num_max,
                                    "pes_id" => $pes_id,
                        ]);
                    }
                } else {
                    return $this->render('index-out', [
                                "message" => Academico::t("matriculacion", "There is no planning information (Registration time)"),
                    ]);
                }
            } else {
                return $this->redirect('registropago');
            }
        } else {
            return $this->redirect('registro');
        }
    }

    public function actionRegistropago() {
        $usu_id = Yii::$app->session->get("PB_iduser");
        $mod_usuario = Usuario::findIdentity($usu_id);
        if ($mod_usuario->usu_upreg == 0) {
            return $this->redirect(['perfil/index']);
        }
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if ($data["upload_file"]) {
                if (empty($_FILES)) {
                    return json_encode(['error' => Yii::t("notificaciones", "Error to process File. Try again.")]);
                }
                //Recibe Parámetros
                $files = $_FILES[key($_FILES)];
                $arrIm = explode(".", basename($files['name']));
                $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                $dirFileEnd = Yii::$app->params["documentFolder"] . "pagosmatricula/" . $data["name_file"] . "." . $typeFile;
                $status = Utilities::moveUploadFile($files['tmp_name'], $dirFileEnd);
                if ($status) {
                    return true;
                } else {
                    return json_encode(['error' => Yii::t("notificaciones", "Error to process File " . basename($files['name']) . ". Try again.")]);
                }
            }

            if ($data["procesar_file"]) {
                ini_set('memory_limit', '256M');
                $per_id = Yii::$app->session->get("PB_perid");
                try {
                    $result_pago = RegistroPagoMatricula::checkPagoEstudiante($per_id, $data['pla_id']);
                    if (count($result_pago) > 0) {
                        $model_registro_pago_matricula = RegistroPagoMatricula::findOne(["rpm_id" => $result_pago[0]["rpm_id"]]);
                        $model_registro_pago_matricula->rpm_archivo = "pagosmatricula/" . $data["archivo"];
                        if ($model_registro_pago_matricula->save()) {
                            $message = array(
                                "wtmessage" => Yii::t("notificaciones", "Your information was successfully saved."),
                                "title" => Yii::t('jslang', 'Success'),
                            );
                            return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Success"), false, $message);
                        } else {
                            $message = array(
                                "wtmessage" => Yii::t('notificaciones', 'Your information has not been saved. Please try again.'),
                                "title" => Yii::t('jslang', 'Error'),
                            );
                            return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), true, $message);
                        }
                    } else {
                        $model_registro_pago_matricula = new RegistroPagoMatricula();
                        $model_registro_pago_matricula->per_id = $per_id;
                        $model_registro_pago_matricula->pla_id = $data['pla_id'];
                        // $model_registro_pago_matricula->pes_id = $data['pes_id'];
                        $model_registro_pago_matricula->rpm_archivo = "pagosmatricula/" . $data["archivo"];
                        $model_registro_pago_matricula->rpm_estado_aprobacion = "0";
                        $model_registro_pago_matricula->rpm_estado_generado = "0";
                        $model_registro_pago_matricula->rpm_estado = "1";
                        $model_registro_pago_matricula->rpm_estado_logico = "1";

                        if ($model_registro_pago_matricula->save()) {
                            $message = array(
                                "wtmessage" => Yii::t("notificaciones", "Your information was successfully saved."),
                                "title" => Yii::t('jslang', 'Success'),
                            );
                            return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Success"), false, $message);
                        } else {
                            $message = array(
                                "wtmessage" => Yii::t('notificaciones', 'Your information has not been saved. Please try again.'),
                                "title" => Yii::t('jslang', 'Error'),
                            );
                            return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), true, $message);
                        }
                    }
                } catch (Exception $ex) {
                    $message = array(
                        "wtmessage" => Yii::t('notificaciones', 'Your information has not been saved. Please try again.'),
                        "title" => Yii::t('jslang', 'Error'),
                    );
                    return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), true, $message);
                }
            }
        }
        /*         * Else */ else {

            $per_id = Yii::$app->session->get("PB_perid");

            $matriculacion_model = new Matriculacion();
            $today = date("Y-m-d H:i:s");
            $result_process = $matriculacion_model->checkToday($today);

            if (count($result_process) > 0) {
                /*                 * Exist a register process */
                $pla_id = $result_process[0]['pla_id'];

                /*                 * Verificando si el estudiante ha pagado */
                //$data_planificacion_pago = Matriculacion::getPlanificacionPago($pla_id);
                /* Se obtiene los datos de planificación del estudiante GVG */
                $data_planificacion_pago = Matriculacion::getPlanificacionPago($per_id);

                return $this->render('carga-pago', [
                            "data_planificacion_pago" => $data_planificacion_pago,
                            "pla_id" => $data_planificacion_pago['pla_id'],
                ]);
            } else {
                //Render index-out
                return $this->render('index-out', [
                            "message" => Academico::t("matriculacion", "No es tiempo de registro."),
                ]);
            }
        }
    }

    public function actionList() {
        $model = new RegistroPagoMatricula();
        $arr_status = [-1 => Academico::t("matriculacion", "-- Select Status --"), 0 => Academico::t("matriculacion", "Unregistered Student"), 1 => Academico::t("matriculacion", "Registered Student")];

        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->get();
            return $this->renderPartial('list-grid', [
                        "model" => $model->getAllRegistroMatriculaxGenerarGrid($data["search"], $data["mod_id"], $data["estado"], $data["carrera"], $data["periodo"], true),
            ]);
        }

        $arr_carrera = PlanificacionEstudiante::getCarreras();
        $arr_pla_per = Planificacion::getPeriodosAcademico();

        $arr_modalidad = Planificacion::find()
                ->select(['m.mod_id', 'm.mod_nombre'])
                ->join('inner join', 'modalidad m')
                ->where('pla_estado_logico = 1 and pla_estado = 1 and m.mod_estado =1 and m.mod_estado_logico = 1')
                ->asArray()
                ->all();

        return $this->render('list', [
                    'model' => $model->getAllRegistroMatriculaxGenerarGrid(NULL, NULL, NULL, NULL, NULL, true),
                    'arr_carrera' => array_merge([0 => Academico::t("matriculacion", "-- Select Career --")], ArrayHelper::map($arr_carrera, "pes_id", "pes_carrera")),
                    'arr_pla_per' => array_merge([0 => Academico::t("matriculacion", "-- Select Academic Period --")], ArrayHelper::map($arr_pla_per, "pla_id", "pla_periodo_academico")),
                    'arr_modalidad' => array_merge([0 => Academico::t("matriculacion", "-- Select Modality --")], ArrayHelper::map($arr_modalidad, "mod_id", "mod_nombre")),
                    'arr_status' => $arr_status,
        ]);
    }

    public function actionRegistry($id) {
        $model = RegistroOnline::findOne($id);
        if ($model) {
            $matriculacion_model = new Matriculacion();
            $model_registroPago = new RegistroPagoMatricula();
            $data_student = $matriculacion_model->getDataStudenFromRegistroOnline($model->per_id, $model->pes_id);
            $dataPlanificacion = $matriculacion_model->getPlanificationFromRegistroOnline($id);
            $materiasxEstudiante = PlanificacionEstudiante::findOne($model->pes_id);
            $dataModel = $model_registroPago->getRegistroPagoMatriculaByRegistroOnline($id, $model->per_id);

            return $this->render('registry', [
                        "materiasxEstudiante" => $materiasxEstudiante,
                        "materias" => $dataPlanificacion,
                        "data_student" => $data_student,
                        "ron_id" => $id,
                        "rpm_id" => $dataModel["Id"],
                        "est_id" => $model->per_id,
                        "matriculacion_model" => RegistroPagoMatricula::findOne($dataModel["Id"]),
            ]);
        }
        return $this->redirect('index');
    }

    public function actionUpdatepagoregistro() {
        $data = Yii::$app->request->get();
        if ($data['filename']) {
            if (Yii::$app->session->get('PB_isuser')) {
                $file = $data['filename'];
                $route = str_replace("../", "", $file);
                $url_file = Yii::$app->basePath . "/uploads/pagosmatricula/" . $route;
                $arrfile = explode(".", $url_file);
                $typeImage = $arrfile[count($arrfile) - 1];
                if (file_exists($url_file)) {
                    if (strtolower($typeImage) == "pdf") {
                        header('Pragma: public');
                        header('Expires: 0');
                        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                        header('Cache-Control: private', false);
                        header("Content-type: application/pdf");
                        header('Content-Disposition: attachment; filename="matriculacion_' . time() . '.pdf";');
                        header('Content-Transfer-Encoding: binary');
                        header('Content-Length: ' . filesize($url_file));
                        readfile($url_file);
                    }
                }
            }
            exit();
        }
        if (Yii::$app->request->isAjax) {

            $data = Yii::$app->request->post();
            if ($data["upload_file"]) {
                if (empty($_FILES)) {
                    return json_encode(['error' => Yii::t("notificaciones", "Error to process File. Try again.")]);
                }
                //Recibe Parámetros
                $files = $_FILES[key($_FILES)];
                $arrIm = explode(".", basename($files['name']));
                $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                $dirFileEnd = Yii::$app->params["documentFolder"] . "pagosmatricula/" . $data["name_file"] . "." . $typeFile;
                $status = Utilities::moveUploadFile($files['tmp_name'], $dirFileEnd);
                if ($status) {
                    return true;
                } else {
                    return json_encode(['error' => Yii::t("notificaciones", "Error to process File " . basename($files['name']) . ". Try again.")]);
                }
            }

            try {
                $model_registro_pago_matricula = RegistroPagoMatricula::findOne($data["id_rpm"]);
                $model_registro_pago_matricula->rpm_estado_generado = '1';
                $model_registro_pago_matricula->rpm_hoja_matriculacion = $data["file"];
                $modelPersona = Persona::findOne($model_registro_pago_matricula->per_id);

                if ($model_registro_pago_matricula->save()) {
                    $matriculacion_model = new Matriculacion();
                    $data_student = $matriculacion_model->getDataStudenbyRonId($data["id_ron"]);
                    $body = Utilities::getMailMessage("generado", array(
                                "[[user]]" => $modelPersona->per_pri_nombre . " " . $modelPersona->per_pri_apellido,
                                "[[periodo]]" => $data_student["pla_periodo_academico"],
                                "[[modalidad]]" => $data_student["mod_nombre"]
                                    ), Yii::$app->language, Yii::$app->basePath . "/modules/academico");
                    $titulo_mensaje = "Confirmación de Registro de Matriculación en línea";

                    $from = Yii::$app->params["adminEmail"];
                    $to = array(
                        "0" => $data_student["per_correo"],
                    );
                    $files = array(
                        "0" => Yii::$app->basePath . Yii::$app->params["documentFolder"] . "pagosmatricula/" . $data["file"],
                    );
                    $asunto = "Registro en línea";

                    Utilities::sendEmail($titulo_mensaje, $from, $to, $asunto, $body, $files);

                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Your information was successfully saved."),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Success"), false, $message);
                } else {
                    $message = array(
                        "wtmessage" => Yii::t('notificaciones', 'Your information has not been saved. Please try again.'),
                        "title" => Yii::t('jslang', 'Error'),
                    );
                    return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), true, $message);
                }
            } catch (Exception $ex) {
                $message = array(
                    "wtmessage" => Yii::t('notificaciones', 'Your information has not been saved. Please try again.'),
                    "title" => Yii::t('jslang', 'Error'),
                );
                return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), true, $message);
            }
        }
    }

    /**
     * Function controller to /matriculacion/registro
     * @author Emilio Moran <emiliojmp9@gmail.com>
     * @param
     * @return
     */
    public function actionRegistro() {
        $per_id = Yii::$app->session->get("PB_perid");

        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["pes_id"])) {
                $modelPersona = Persona::findOne($per_id);
                $pes_id = $data["pes_id"];
                $modalidad = $data["modalidad"];
                $carrera = $data["carrera"];
                $materias = $data["materias"];
                $registro_online_model = new RegistroOnline();
                $registro_online_model->per_id = $per_id;
                $registro_online_model->pes_id = $pes_id;
                $registro_online_model->pes_num_orden = 0; //Ya no se usa pero no permite null, por eso tiene valor de 0
                $registro_online_model->ron_anio = date("Y");
                $registro_online_model->ron_modalidad = $modalidad;
                $registro_online_model->ron_carrera = $carrera;
                $registro_online_model->ron_estado_registro = "0"; //Igual esta tampoco ya no se usa
                $registro_online_model->ron_fecha_registro = date(Yii::$app->params['dateByDefault']);
                $registro_online_model->ron_estado = "1";
                $registro_online_model->ron_estado_logico = "1";
                if ($registro_online_model->save()) {
                    $ron_id = $registro_online_model->getPrimaryKey();
                    $materias = explode(",", $materias);
                    foreach ($materias as $materia) {
                        $registro_online_item_model = new RegistroOnlineItem();
                        $registro_online_item_model->ron_id = $ron_id;
                        $registro_online_item_model->roi_materia_nombre = $materia;
                        $registro_online_item_model->roi_estado = "1";
                        $registro_online_item_model->roi_estado_logico = "1";

                        $registro_online_item_model->save();
                    }
                    //Send email
                    $report = new ExportFile();
                    $this->view->title = Academico::t("matriculacion", "Registration"); // Titulo del reporte
                    $matriculacion_model = new Matriculacion();
                    $materiasxEstudiante = PlanificacionEstudiante::findOne($pes_id);
                    $data_student = $matriculacion_model->getDataStudenbyRonId($ron_id);
                    $dataPlanificacion = $matriculacion_model->getPlanificationFromRegistroOnline($ron_id);
                    $dataProvider = new ArrayDataProvider([
                        'key' => 'Ids',
                        'allModels' => $dataPlanificacion,
                        'pagination' => [
                            'pageSize' => Yii::$app->params["pageSize"],
                        ],
                        'sort' => [
                            'attributes' => ["Subject"],
                        ],
                    ]);

                    $path = "Registro_" . date("Ymdhis") . ".pdf";
                    $report->orientation = "P"; // tipo de orientacion L => Horizontal, P => Vertical
                    $report->createReportPdf(
                            $this->render('exportpdf', [
                                "planificacion" => $dataProvider,
                                "data_student" => $data_student,
                                "materiasxEstudiante" => $materiasxEstudiante,
                            ])
                    );

                    $tmp_path = sys_get_temp_dir() . "/" . $path;

                    $report->mpdf->Output($tmp_path, ExportFile::OUTPUT_TO_FILE);

                    $from = Yii::$app->params["adminEmail"];
                    $to = array(
                        "0" => $data_student["per_correo"],
                    );
                    $files = array(
                        "0" => $tmp_path,
                    );
                    $asunto = "Registro en línea";
                    $base = Yii::$app->basePath;
                    $lang = Yii::$app->language;
                    $body = Utilities::getMailMessage("registro", array("[[user]]" => $modelPersona->per_pri_nombre . " " . $modelPersona->per_pri_apellido, "[[periodo]]" => $data_student["pla_periodo_academico"], "[[modalidad]]" => $data_student["mod_nombre"]), Yii::$app->language, Yii::$app->basePath . "/modules/academico");
                    $titulo_mensaje = "Registro de Matriculación en línea";

                    Utilities::sendEmail($titulo_mensaje, $from, $to, $asunto, $body, $files);

                    Utilities::removeTemporalFile($tmp_path);

                    $message = array(
                        "wtmessage" => Yii::t('notificaciones', 'Your information was successfully saved.'),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                }
            }
        }

        $matriculacion_model = new Matriculacion();
        $today = date("Y-m-d H:i:s");
        $result_process = $matriculacion_model->checkToday($today);

        if (count($result_process) > 0) {
            /*             * Exist a register process */
            $pla_id = $result_process[0]['pla_id'];
            $resultIdPlanificacionEstudiante = $matriculacion_model->getIdPlanificacionEstudiante($per_id, $pla_id);
            if (count($resultIdPlanificacionEstudiante) > 0) {
                /*                 * Exist a register of planificacion_estudiante */
                $pes_id = $resultIdPlanificacionEstudiante[0]['pes_id'];

                $data_student = $matriculacion_model->getDataStudenFromRegistroOnline($per_id, $pes_id);
                if ($data_student) {
                    $ron_id = $data_student["ron_id"];
                    $dataPlanificacion = $matriculacion_model->getPlanificationFromRegistroOnline($ron_id);
                    $materiasxEstudiante = PlanificacionEstudiante::findOne($pes_id);
                    $dataProvider = new ArrayDataProvider([
                        'key' => 'Ids',
                        'allModels' => $dataPlanificacion,
                        'pagination' => [
                            'pageSize' => Yii::$app->params["pageSize"],
                        ],
                        'sort' => [
                            'attributes' => ["Subject"],
                        ],
                    ]);

                    return $this->render('registro', [
                                "planificacion" => $dataProvider,
                                "data_student" => $data_student,
                                "title" => Academico::t("matriculacion", "Register saved (Record Time)"),
                                "ron_id" => $ron_id,
                                "materiasxEstudiante" => $materiasxEstudiante,
                    ]);
                } else {
                    return $this->render('index-out', [
                                "message" => Academico::t("matriculacion", "There is no information on the last registration (Registration time)"),
                    ]);
                }
            } else {
                /*                 * Not exist a planificacion_estudiante */
                return $this->render('index-out', [
                            "message" => Academico::t("matriculacion", "There is no planning information (Registration time)"),
                ]);
            }
        } else {
            $resultData = $matriculacion_model->getLastIdRegistroOnline();
            if (count($resultData) > 0) {
                $last_ron_id = $resultData[0]['ron_id'];
                $last_pes_id = $resultData[0]['pes_id'];
                $data_student = $matriculacion_model->getDataStudenFromRegistroOnline($per_id, $last_pes_id);
                $dataPlanificacion = $matriculacion_model->getPlanificationFromRegistroOnline($last_ron_id);
                $materiasxEstudiante = PlanificacionEstudiante::findOne($last_pes_id);
                $dataProvider = new ArrayDataProvider([
                    'key' => 'Ids',
                    'allModels' => $dataPlanificacion,
                    'pagination' => [
                        'pageSize' => Yii::$app->params["pageSize"],
                    ],
                    'sort' => [
                        'attributes' => ["Subject"],
                    ],
                ]);

                return $this->render('registro', [
                            "planificacion" => $dataProvider,
                            "data_student" => $data_student,
                            "title" => Academico::t("matriculacion", "Last register saved (Non-registration time)"),
                            "ron_id" => $ron_id,
                            "materiasxEstudiante" => $materiasxEstudiante,
                ]);
            } else {
                /*                 * If not exist a minimal one register in registro_online */
                return $this->render('index-out', [
                            "message" => Academico::t("matriculacion", "There is no information on the last record (Non-registration time)"),
                ]);
            }
        }
    }

    public function actionExportpdf() {
        $report = new ExportFile();
        $this->view->title = Academico::t("matriculacion", "Registration"); // Titulo del reporte

        $matriculacion_model = new Matriculacion();

        $data = Yii::$app->request->get();

        $ron_id = $data['ron_id'];

        /* return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $ron_id); */

        $data_student = $matriculacion_model->getDataStudenbyRonId($ron_id);
        $dataPlanificacion = $matriculacion_model->getPlanificationFromRegistroOnline($ron_id);
        $dataProvider = new ArrayDataProvider([
            'key' => 'Ids',
            'allModels' => $dataPlanificacion,
            'pagination' => [
                'pageSize' => Yii::$app->params["pageSize"],
            ],
            'sort' => [
                'attributes' => ["Subject"],
            ],
        ]);

        $report->orientation = "P"; // tipo de orientacion L => Horizontal, P => Vertical
        $report->createReportPdf(
                $this->render('exportpdf', [
                    "planificacion" => $dataProvider,
                    "data_student" => $data_student,
                ])
        );
        $report->mpdf->Output('Registro_' . date("Ymdhis") . ".pdf", ExportFile::OUTPUT_TO_DOWNLOAD);
        return;
    }

    public function actionAprobacionpago() {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->get();
            if (isset($data["search"])) {
                $search = $data["search"];
                $pla_periodo_academico = $data["pla_periodo_academico"];
                $mod_id = $data["mod_id"];
                $aprobacion = $data["aprobacion"];
                $dataPagos = Matriculacion::getEstudiantesPagoMatricula($search, $pla_periodo_academico, $mod_id, $aprobacion);
                $dataProvider = new ArrayDataProvider([
                    'key' => 'PesId',
                    'allModels' => $dataPagos,
                    'pagination' => [
                        'pageSize' => Yii::$app->params["pageSize"],
                    ],
                    'sort' => [
                        'attributes' => ["Estudiante"],
                    ],
                ]);
                return $this->renderPartial('aprobacion-pago-grid', [
                            "pagos" => $dataProvider,
                ]);
            }
        }
        
        $arr_pla = Planificacion::getPeriodosAcademico();
        $arr_status = [-1 => Academico::t("matriculacion", "-- Select Status --"), 0 => Academico::t("matriculacion", "Not reviewed"), 1 => Academico::t("matriculacion", "Approved"), 2 => Academico::t("matriculacion", "Rejected")];
        /* print_r($arr_pla); */
        if (count($arr_pla) > 0) {
            $arr_modalidad = Modalidad::findAll(["mod_estado" => 1, "mod_estado_logico" => 1]);
            $pla_periodo_academico = $arr_pla[0]["pla_periodo_academico"];
            $mod_id = $arr_modalidad[0]->mod_id;
            $dataPagos = Matriculacion::getEstudiantesPagoMatricula(null, $pla_periodo_academico, $mod_id);
            $dataProvider = new ArrayDataProvider([
                'key' => 'PesId',
                'allModels' => $dataPagos,
                'pagination' => [
                    'pageSize' => Yii::$app->params["pageSize"],
                ],
                'sort' => [
                    'attributes' => ["Estudiante"],
                ],
            ]);
            return $this->render('aprobacion-pago', [
                        'arr_pla' => (empty(ArrayHelper::map($arr_pla, "pla_periodo_academico", "pla_periodo_academico"))) ? array(Yii::t("matriculacion", "-- Select Academic Period --")) : (ArrayHelper::map($arr_pla, "pla_periodo_academico", "pla_periodo_academico")),
                        'arr_modalidad' => (empty(ArrayHelper::map($arr_modalidad, "mod_id", "mod_nombre"))) ? array(Yii::t("matriculacion", "-- Select Modality --")) : (ArrayHelper::map($arr_modalidad, "mod_id", "mod_nombre")),
                        'pagos' => $dataProvider,
                        'pla_periodo_academico' => $pla_periodo_academico,
                        'mod_id' => $mod_id,
                        'arr_status' => $arr_status,
            ]);
        } else {
            return $this->render('index-out', [
                        "message" => Academico::t("matriculacion", "There is no planning data"),
            ]);
        }
    }

    public function actionUpdateestadopago() {
        $usu_id = @Yii::$app->session->get("PB_iduser");
        $fecha_transaccion = date(Yii::$app->params["dateTimeByDefault"]);
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            try {
                $id = $data["id"];
                $state = $data["state"];
                $registro_pago_matricula_model = RegistroPagoMatricula::findOne($id);
                $registro_pago_matricula_model->rpm_estado_aprobacion = $state;
                $registro_pago_matricula_model->rpm_fecha_transaccion = $fecha_transaccion;
                $registro_pago_matricula_model->rpm_usuario_apruebareprueba = $usu_id;

                if ($registro_pago_matricula_model->save()) {
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Your information was successfully saved."),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                } else {
                    $message = array(
                        "wtmessage" => Yii::t('notificaciones', 'Your information has not been saved. Please try again.'),
                        "title" => Yii::t('jslang', 'Error'),
                    );
                    return Utilities::ajaxResponse('NOOK', 'alert', Yii::t('jslang', 'Error'), 'true', $message);
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

    public function actionDescargarpago() {
        $report = new ExportFile();

        $data = Yii::$app->request->get();

        $rpm_id = $data['rpm_id'];
        $registro_pago_matricula = RegistroPagoMatricula::findOne(["rpm_id" => $rpm_id]);
        $file = Yii::$app->basePath . Yii::$app->params['documentFolder'] . $registro_pago_matricula->rpm_archivo;

        if (file_exists($file)) {
            Yii::$app->response->sendFile($file);
        } else {
            /*             * en caso de que no */
        }
        return;
    }

    public function actionView($id) {
        $model = RegistroOnline::findOne($id);
        if ($model) {
            $matriculacion_model = new Matriculacion();
            $model_registroPago = new RegistroPagoMatricula();
            $data_student = $matriculacion_model->getDataStudenFromRegistroOnline($model->per_id, $model->pes_id);
            $dataPlanificacion = $matriculacion_model->getPlanificationFromRegistroOnline($id);
            $materiasxEstudiante = PlanificacionEstudiante::findOne($model->pes_id);
            $dataModel = $model_registroPago->getRegistroPagoMatriculaByRegistroOnline($id, $model->per_id);

            return $this->render('view', [
                        "materiasxEstudiante" => $materiasxEstudiante,
                        "materias" => $dataPlanificacion,
                        "data_student" => $data_student,
                        "ron_id" => $id,
                        "rpm_id" => $dataModel["Id"],
                        "matriculacion_model" => RegistroPagoMatricula::findOne($dataModel["Id"]),
            ]);
        }
        return $this->redirect('index');
    }

}
