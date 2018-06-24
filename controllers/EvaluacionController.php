<?php

namespace app\controllers;

use Yii;
use app\models\Utilities;
use yii\helpers\ArrayHelper;
use app\models\NivelInteres;
use app\models\Carrera;
use app\models\EvaluacionDesempeno;
use app\models\ExpedienteProfesor;
use app\models\PeriodoAcademico;
use yii\helpers\Url;
use yii\base\Security;

/**
 * 
 *
 * @author Diana Lopez
 */
class EvaluacionController extends \app\components\CController {

    public function actionEvaluar() {
        $mod_exprofesor = new ExpedienteProfesor();
        $mod_evaluacion = new EvaluacionDesempeno();
        $mod_carrera = new Carrera();
        $data = null;
        $mod_periodoacademico = new PeriodoAcademico();
        $dato = Yii::$app->request->get();
        if (isset($dato["search"])) {
            $arrprofesor = $mod_exprofesor->consultaProfesorgrid($dato["search"]);
            return $this->renderPartial('_listaEducaGrid', [
                        "model" => $arrprofesor,
            ]);
        }

        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $datas = Yii::$app->request->get();
            if ($datas['PBgetFilter']) {
                $arrSearch["facultad"] = $datas['facultadeva'];
                $arrSearch["subareaeva"] = $datas['subareaeva'];
                $arrSearch["asignaeva"] = $datas['asignaeva'];
                $arr_carrera = $mod_carrera->consultarCarrera($arrSearch);
                return $this->renderPartial('_listaCarreGrid', [
                            'model' => $arr_carrera,
                ]);
            } else {
                $arr_carrera = $mod_carrera->consultarCarrera();
            }

            if (isset($data["getfacultad"])) {
                $facultad = $mod_carrera->consultarModalidad($data["ninter_id"]);
                $message = array("facultad" => $facultad);
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }

            if (isset($data["getperiodo"])) {
                $periodo = $mod_evaluacion->consultarPeriodo($data["anio_id"]);
                $message = array("periodo" => $periodo);
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }
            if (isset($data["getarea"])) {
                $subarea = $mod_carrera->consultarSubAreaConocimiento($data["area"]);
                $message = array("subarea" => $subarea);
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }

            if (isset($data["getsubarea"])) {
                $materia = $mod_carrera->consultarMateriaArea($data["subarea"], 1);
                $message = array("materia" => $materia);
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'true', $message);
                return;
            }
        }
        $arrprofesor = $mod_exprofesor->consultaProfesorgrid(0);
        $arrperiodo = $mod_evaluacion->consultarPeriodo('');
        $arr_ninteres = NivelInteres::find()->select("nint_id AS id, nint_nombre AS name")->where(["nint_estado_logico" => "1", "nint_estado" => "1"])->asArray()->all();
        $arr_facultad = $mod_carrera->consultarModalidad(1);
        $areaconoce = $mod_carrera->consultarAreaconocimiento();
        $arrhorario = $mod_periodoacademico->consultaHorario();
        $arrmateria = $mod_carrera->consultarMateriaArea(1, 1);
        $arranio = $mod_carrera->consultaAnio();
        $arrbloque = $mod_periodoacademico->consultaBloque();
        $arr_subarea = $mod_carrera->consultarSubAreaConocimiento(1);
        $arr_carrera = $mod_carrera->consultarCarrera();
        $arrgrupo_pos = $mod_evaluacion->consultarGruposgrado();
        return $this->render('evaluar', [
                    'profesor' => $arrprofesor,
                    'periodo' => ArrayHelper::map($arrperiodo, "id", "name"),
                    'arr_ninteres' => ArrayHelper::map($arr_ninteres, "id", "name"),
                    'arr_facultad' => ArrayHelper::map($arr_facultad, "id", "name"),
                    'arr_carrera' => $arr_carrera,
                    'horario' => ArrayHelper::map($arrhorario, "id", "name"),
                    'areaconoce' => ArrayHelper::map($areaconoce, "id", "name"),
                    'materia' => ArrayHelper::map($arrmateria, "id", "name"),
                    'anio' => ArrayHelper::map($arranio, "id", "name"),
                    'bloque' => ArrayHelper::map($arrbloque, "id", "name"),
                    'arr_subarea' => ArrayHelper::map($arr_subarea, "id", "name"),
                    'arrgrupo_pos' => ArrayHelper::map($arrgrupo_pos, "id", "name"),
        ]);
    }

    public function actionGuardarevaluacion() {
        $periodo = 0;
        $bloque = 0;
        $grupo = 0;
        $mes = 0;
        $per_id = @Yii::$app->session->get("PB_perid");
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $profesor = $data["profesor"];
            $nivelestudio = $data["nivelestudio"];
            if ($nivelestudio == 1) {
                $periodo = $data["periodo"];
                $bloque = $data["bloque"];
                $asignatura = $data["asignatura"];
            } else {
                $grupo = $data["grupo"];
                $mes = $data["mes"];
                $asignatura = $data["modulo"];
            }
            $modalidad = $data["facultad"];
            $areaconoce = $data["areaconoce"];
            $subarea = $data["subarea"];
            $hevaluacion = $data["hevaluacion"];
            $aevaluacion = $data["aevaluacion"];
            $cevaluacion = $data["cevaluacion"];
            $directivo = $data["directivo"];
            $promedio = $data["promedio"];
            $carrera = $data['carrera'];
            $usuario = @Yii::$app->user->identity->usu_id;
            $horario = $data['horario'];
            $paralelo = $data['paralelo'];

            $con = \Yii::$app->db_academico;
            $transaction = $con->beginTransaction();
            try {
                $mod_evaluacion = new EvaluacionDesempeno();
                $resp_ingreso = $mod_evaluacion->insertarEvaluacion($profesor, $periodo, $asignatura, $nivelestudio, $modalidad, $areaconoce, $bloque, $subarea, $paralelo, $carrera, $grupo, $mes, $hevaluacion, $aevaluacion, $cevaluacion, $directivo, $promedio, $usuario);
                $edes_id = Yii::$app->db_academico->getLastInsertID('db_academico.evaluacion_desempeno');
                if ($resp_ingreso) {
                    if (!empty($horario)) {
                        for ($i = 0; $i < count($horario); $i++) {
                            //Guardado Datos horario.
                            $hora_inicio = $horario[$i]["hora_inicio"];
                            $hora_fin = $horario[$i]["hora_fin"];
                            $dia = ucwords(strtolower($horario[$i]["semana"]));
                            $res_horario = $mod_evaluacion->insertarHorarioevalua($edes_id, $hora_inicio, $hora_fin, $dia, $usuario);
                            if ($res_horario) {
                                $exito = 1;
                            }
                        }
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
                    echo Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $mensaje),
                    "title" => Yii::t('jslang', 'Success'),
                );
                echo Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
            }
            return;
        }
    }

    public function actionListaevaluacion() {
        $per_id = @Yii::$app->session->get("PB_iduser");
        $mod_evaluacion = new EvaluacionDesempeno();
        $mod_exprofesor = new ExpedienteProfesor();
        $mod_carrera = new Carrera();
        $arrperiodo = $mod_evaluacion->consultarPeriodo('');
        $mod_exprofeconsulta = $mod_exprofesor->consultaProfesor();
        $model = null;
        $data = null;
        $data = Yii::$app->request->get();
        if ($data['PBgetFilter']) {
            $arrSearch["nivelestudio"] = $data['nivelestudio'];
            $arrSearch["facultadest"] = $data['facultadest'];
            $arrSearch["search"] = $data['search'];
            $arrSearch["materiaest"] = $data['materiaest'];
            $mod_conevaluacion = $mod_evaluacion->consultarEvaluaciones($arrSearch);

            return $this->renderPartial('_listaEvaluGrid', [
                        'model' => $mod_conevaluacion,
                        'profesor' => ArrayHelper::map($mod_exprofeconsulta, "id", "name"),
                        'periodo' => ArrayHelper::map($arrperiodo, "id", "name"),
            ]);
        } else {
            $mod_conevaluacion = $mod_evaluacion->consultarEvaluaciones();
        }
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["getfacultad"])) {
                $facultad = $mod_carrera->consultarModalidad($data["ninter_id"]);
                $message = array("facultad" => $facultad);
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }
            if (isset($data["getcarrera"])) {
                $carrera = $mod_carrera->consultarCarrera($data["fac_id"]);
                $message = array("carrera" => $carrera);
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }
            if (isset($data["getmateria"])) {
                $materia = $mod_carrera->consultaMateria($data["car_id"]);
                $message = array("materia" => $materia);
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }
        }
        $arr_ninteres = NivelInteres::find()->select("nint_id AS id, nint_nombre AS name")->where(["nint_estado_logico" => "1", "nint_estado" => "1"])->asArray()->all();
        $arr_facultad = $mod_carrera->consultarModalidad(0);
        $arr_carrera = $mod_carrera->consultarCarrera();
        $arrmateria = $mod_carrera->consultaMateria('');
        return $this->render('listaevaluacion', [
                    'model' => $mod_conevaluacion,
                    'profesor' => ArrayHelper::map($mod_exprofeconsulta, "id", "name"),
                    'periodo' => ArrayHelper::map($arrperiodo, "id", "name"),
                    'arr_ninteres' => ArrayHelper::map($arr_ninteres, "id", "name"),
                    'arr_facultad' => ArrayHelper::map($arr_facultad, "id", "name"),
                    'arr_carrera' => ArrayHelper::map($arr_carrera, "id", "name"),
                    'materia' => ArrayHelper::map($arrmateria, "id", "name"),
        ]);
    }

    public function actionBusquedaprofesor() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $mod_exprofesor = new ExpedienteProfesor();
        $data = Yii::$app->request->get();
        if ($data['PBgetFilter']) {
            $arrSearch["search"] = $data['search'];
            $arrprofesor = $mod_exprofesor->consultaDatosprofesor($arrSearch);

            return $this->render('_listaProfeGrid', [
                        "model" => $arrprofesor,
            ]);
        } else {
            $arrprofesor = $mod_exprofesor->consultaDatosprofesor();
        }
        return $this->render('_formBuscaProfe', [
                    "model" => $arrprofesor,
        ]);
    }

    public function actionExpexcel() {
        $data = Yii::$app->request->get();
        $mod_evaluacion = new EvaluacionDesempeno();
        $arrSearch["nivelestudio"] = $data['nivelestudio'];
        $arrSearch["facultadest"] = $data['facultadest'];
        $arrSearch["search"] = $data['search'];
        $arrSearch["materiaest"] = $data['materiaest'];
        $arrData = array();
        $arrHeader = array();
        $arrData = $mod_evaluacion->EvaluacionExcel($arrSearch);
        if ($arrData) {
            $nombarch = "EvaluacionesReporte-" . date("YmdHis");
            $content_type = Utilities::mimeContentType("xls");
            header("Content-Type: $content_type");
            header("Content-Disposition: attachment;filename=" . $nombarch . ".xls");
            header('Cache-Control: max-age=0');
            $arrHeader = array(
                Yii::t("formulario", "Teacher"),
                Yii::t("formulario", "Academic unit"),
                Yii::t("formulario", "Mode"),               
                Yii::t("formulario", "Subject"),               
                Yii::t("formulario", "Weighted"),
                
            );
            $nameReport = yii::t("formulario", "Evaluations");
            $colPosition = array("C", "D", "E", "F", "G");
            Utilities::generarReporteXLS($nombarch, $nameReport, $arrHeader, $arrData, $colPosition);
            return;
        }
    }

}
