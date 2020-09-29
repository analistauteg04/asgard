<?php

namespace app\modules\academico\controllers;

use Yii;
use app\modules\academico\models\Asignatura;
use app\modules\academico\models\DistributivoAcademico;
use app\modules\academico\models\DistributivoAcademicoHorario;
use app\modules\academico\models\SemestreAcademico;
use app\modules\academico\models\UnidadAcademica;
use app\modules\academico\models\TipoDistributivo;
use app\modules\academico\models\PromocionPrograma;
use app\modules\academico\models\ParaleloPromocionPrograma;
use app\modules\academico\models\Modalidad;
use app\modules\academico\models\PeriodoAcademicoMetIngreso;
use yii\helpers\ArrayHelper;
use app\models\Utilities;
use app\modules\academico\Module as academico;
use app\modules\admision\Module as admision;
use app\models\ExportFile;
use app\modules\academico\models\Profesor;
use Exception;

academico::registerTranslations();
admision::registerTranslations();

class DistributivoacademicoController extends \app\components\CController {
    
    
    public function actionIndex() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $emp_id = @Yii::$app->session->get("PB_idempresa");
        $model = NULL;
        $distributivo_model = new DistributivoAcademico();
        $mod_modalidad = new Modalidad();
        $mod_unidad = new UnidadAcademica();
        $mod_periodo = new PeriodoAcademicoMetIngreso();
        $data = Yii::$app->request->get();

        if ($data['PBgetFilter']) {
            $search = $data['search'];
            $unidad = (isset($data['unidad']) && $data['unidad'] > 0)?$data['unidad']:NULL;
            $modalidad = (isset($data['modalidad']) && $data['modalidad'] > 0)?$data['modalidad']:NULL;
            $periodo = (isset($data['periodo']) && $data['periodo'] > 0)?$data['periodo']:NULL;
            $materia = (isset($data['materia']) && $data['materia'] > 0)?$data['materia']:NULL;
            $jornada = (isset($data['jornada']) && $data['jornada'] > 0)?$data['jornada']:NULL;
            $model = $distributivo_model->getListadoDistributivo($search, $modalidad, $materia, $jornada, $unidad, $periodo);
            return $this->render('index-grid', [
                        "model" => $model,
            ]);
        } else {
            $model = $distributivo_model->getListadoDistributivo();
        }
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["getmodalidad"])) {
                $modalidad = $mod_modalidad->consultarModalidad($data["uaca_id"], $emp_id);
                $message = array("modalidad" => $modalidad);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
            if(isset($data["getjornada"])){
                $jornada = $distributivo_model->getJornadasByUnidadAcad($data["uaca_id"], $data["mod_id"]);
                $message = array("jornada" => $jornada);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
            if(isset($data["gethorario"])){
                $horario = $distributivo_model->getHorariosByUnidadAcad($data["uaca_id"], $data["mod_id"], $data['jornada_id']);
                $message = array("horario" => $horario);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
        }
        $mod_asignatura = Asignatura::findAll(['asi_estado' => 1, 'asi_estado_logico' => 1]);
        $arr_unidad = $mod_unidad->consultarUnidadAcademicasEmpresa($emp_id);
        $arr_modalidad = $mod_modalidad->consultarModalidad($arr_unidad[0]["id"], 1);
        $arr_jornada = $distributivo_model->getJornadasByUnidadAcad($arr_unidad[0]["id"], $arr_modalidad[0]["id"]);
        $arr_periodo = $mod_periodo->consultarPeriodoAcademico();
        return $this->render('index', [
                    'mod_unidad' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_unidad), "id", "name"),
                    'mod_modalidad' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_modalidad), "id", "name"),
                    'mod_periodo' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_periodo), "id", "name"),
                    'mod_materias' => ArrayHelper::map(array_merge([["asi_id" => "0", "asi_nombre" => Yii::t("formulario", "Grid")]], $mod_asignatura), "asi_id", "asi_nombre"),
                    'model' => $model,
                    'mod_jornada' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_jornada), "id", "name"),
        ]);
    }

    public function actionNew() {
        $emp_id = @Yii::$app->session->get("PB_idempresa");
        $mod_modalidad = new Modalidad();
        $mod_unidad = new UnidadAcademica();
        $mod_periodo = new PeriodoAcademicoMetIngreso();
        $distributivo_model = new DistributivoAcademico();
        $arr_unidad = $mod_unidad->consultarUnidadAcademicasEmpresa($emp_id);
        $arr_modalidad = $mod_modalidad->consultarModalidad($arr_unidad[0]["id"], $emp_id);
        $arr_periodo = $mod_periodo->consultarPeriodoAcademico();
        $mod_asignatura = Asignatura::findAll(['asi_estado' => 1, 'asi_estado_logico' => 1]);
        $arr_jornada = $distributivo_model->getJornadasByUnidadAcad($arr_unidad[0]["id"], $arr_modalidad[0]["id"]);
        $mod_profesor = new Profesor();
        $arr_profesor = $mod_profesor->getProfesores();
        $arr_horario = $distributivo_model->getHorariosByUnidadAcad($arr_unidad[0]["id"], $arr_modalidad[0]["id"], $arr_jornada[0]["id"]);
        return $this->render('new', [
            'arr_profesor' => ArrayHelper::map(array_merge([["Id" => "0", "Nombres" => Yii::t("formulario", "Grid")]], $arr_profesor), "Id", "Nombres"),
            'arr_unidad' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_unidad), "id", "name"),
            'arr_modalidad' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_modalidad), "id", "name"),
            'arr_periodo' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_periodo), "id", "name"),
            'arr_materias' => ArrayHelper::map(array_merge([["asi_id" => "0", "asi_nombre" => Yii::t("formulario", "Grid")]], $mod_asignatura), "asi_id", "asi_nombre"),
            'arr_jornada' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_jornada), "id", "name"),
            'arr_horario' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_horario), "id", "name"),
        ]);
    }

    public function actionSave() {
        $usu_id = @Yii::$app->session->get("PB_iduser");
        $fecha_transaccion = date(Yii::$app->params["dateTimeByDefault"]);
        $distributivo_model = new DistributivoAcademico();
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            try {
                $pro_id = $data['profesor'];
                $uaca_id = $data['unidad'];
                $mod_id = $data['modalidad'];
                $paca_id = $data['periodo'];
                $jornada_id = $data['jornada'];
                $horario = $data['horario'];
                $materia = $data['materia'];
                $dataExists = $distributivo_model->existsDistribucionAcademico($pro_id, $materia, $uaca_id, $mod_id, $paca_id, $jornada_id, $horario);
                if(isset($dataExists) && $dataExists != "" && count($dataExists) > 0){
                    $message = array(
                        "wtmessage" => academico::t('distributivoacademico', 'Register already exists in System.'),
                        "title" => Yii::t('jslang', 'Error'),
                    );
                    return Utilities::ajaxResponse('NOOK', 'alert', Yii::t('jslang', 'Error'), 'true', $message);
                }
                $dataHorario = $distributivo_model->getDistribucionAcademicoHorario($uaca_id, $mod_id, $jornada_id, $horario);

                $distributivo_model->uaca_id = $uaca_id;
                $distributivo_model->pro_id = $pro_id;
                $distributivo_model->mod_id = $mod_id;
                $distributivo_model->asi_id = $materia;
                $distributivo_model->paca_id = $paca_id;
                $distributivo_model->daho_id = $dataHorario['daho_id'];    
                $distributivo_model->daca_fecha_registro = $fecha_transaccion;       
                $distributivo_model->daca_estado_logico = '1';
                $distributivo_model->daca_estado = '1';
                $distributivo_model->daca_usuario_ingreso = $usu_id;
                if ($distributivo_model->save()) {
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Your information was successfully saved."),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                } else {
                    throw new Exception('Error en Guardar registro.');
                }
            }catch(Exception $e){
                $message = array(
                    "wtmessage" => Yii::t('notificaciones', 'Your information has not been saved. Please try again.'),
                    "title" => Yii::t('jslang', 'Error'),
                );
                return Utilities::ajaxResponse('NOOK', 'alert', Yii::t('jslang', 'Error'), 'true', $message);
            }
        }
    }

    public function actionView($id) {
        $emp_id = @Yii::$app->session->get("PB_idempresa");
        $mod_modalidad = new Modalidad();
        $mod_unidad = new UnidadAcademica();
        $mod_periodo = new PeriodoAcademicoMetIngreso();
        $distributivo_model = DistributivoAcademico::findOne($id);
        $arr_unidad = $mod_unidad->consultarUnidadAcademicasEmpresa($emp_id);
        $arr_modalidad = $mod_modalidad->consultarModalidad($distributivo_model->uaca_id, $emp_id);
        $arr_periodo = $mod_periodo->consultarPeriodoAcademico();
        $mod_asignatura = Asignatura::findAll(['asi_estado' => 1, 'asi_estado_logico' => 1]);
        $arr_jornada = $distributivo_model->getJornadasByUnidadAcad($distributivo_model->uaca_id, $distributivo_model->mod_id);
        $mod_profesor = new Profesor();
        $arr_profesor = $mod_profesor->getProfesores();
        $arr_horario = $distributivo_model->getHorariosByUnidadAcad($distributivo_model->uaca_id, $distributivo_model->mod_id, $arr_jornada[0]["id"]);
        $mod_horario = DistributivoAcademicoHorario::findOne($distributivo_model->daho_id);
        $horario_values = ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_horario), "id", "name");
        return $this->render('view', [
            'arr_profesor' => ArrayHelper::map(array_merge([["Id" => "0", "Nombres" => Yii::t("formulario", "Grid")]], $arr_profesor), "Id", "Nombres"),
            'arr_unidad' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_unidad), "id", "name"),
            'arr_modalidad' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_modalidad), "id", "name"),
            'arr_periodo' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_periodo), "id", "name"),
            'arr_materias' => ArrayHelper::map(array_merge([["asi_id" => "0", "asi_nombre" => Yii::t("formulario", "Grid")]], $mod_asignatura), "asi_id", "asi_nombre"),
            'arr_jornada' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_jornada), "id", "name"),
            'arr_horario' => $horario_values,
            'pro_id'  => $distributivo_model->pro_id,
            'uaca_id' => $distributivo_model->uaca_id,
            'mod_id'  => $distributivo_model->mod_id,
            'paca_id' => $distributivo_model->paca_id,
            'asi_id'  => $distributivo_model->asi_id,
            'horario' => array_search($mod_horario->daho_horario, $horario_values),
            'jornada' => $mod_horario->daho_jornada,
            'daca_id' => $id,
        ]);
    }

    public function actionEdit($id) {
        $emp_id = @Yii::$app->session->get("PB_idempresa");
        $mod_modalidad = new Modalidad();
        $mod_unidad = new UnidadAcademica();
        $mod_periodo = new PeriodoAcademicoMetIngreso();
        $distributivo_model = DistributivoAcademico::findOne($id);
        $arr_unidad = $mod_unidad->consultarUnidadAcademicasEmpresa($emp_id);
        $arr_modalidad = $mod_modalidad->consultarModalidad($distributivo_model->uaca_id, $emp_id);
        $arr_periodo = $mod_periodo->consultarPeriodoAcademico();
        $mod_asignatura = Asignatura::findAll(['asi_estado' => 1, 'asi_estado_logico' => 1]);
        $arr_jornada = $distributivo_model->getJornadasByUnidadAcad($distributivo_model->uaca_id, $distributivo_model->mod_id);
        $mod_profesor = new Profesor();
        $arr_profesor = $mod_profesor->getProfesores();
        $arr_horario = $distributivo_model->getHorariosByUnidadAcad($distributivo_model->uaca_id, $distributivo_model->mod_id, $arr_jornada[0]["id"]);
        $mod_horario = DistributivoAcademicoHorario::findOne($distributivo_model->daho_id);
        $horario_values = ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_horario), "id", "name");
        return $this->render('edit', [
            'arr_profesor' => ArrayHelper::map(array_merge([["Id" => "0", "Nombres" => Yii::t("formulario", "Grid")]], $arr_profesor), "Id", "Nombres"),
            'arr_unidad' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_unidad), "id", "name"),
            'arr_modalidad' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_modalidad), "id", "name"),
            'arr_periodo' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_periodo), "id", "name"),
            'arr_materias' => ArrayHelper::map(array_merge([["asi_id" => "0", "asi_nombre" => Yii::t("formulario", "Grid")]], $mod_asignatura), "asi_id", "asi_nombre"),
            'arr_jornada' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_jornada), "id", "name"),
            'arr_horario' => $horario_values,
            'pro_id'  => $distributivo_model->pro_id,
            'uaca_id' => $distributivo_model->uaca_id,
            'mod_id'  => $distributivo_model->mod_id,
            'paca_id' => $distributivo_model->paca_id,
            'asi_id'  => $distributivo_model->asi_id,
            'horario' => array_search($mod_horario->daho_horario, $horario_values),
            'jornada' => $mod_horario->daho_jornada,
            'daca_id' => $id,
        ]);
    }

    public function actionUpdate() {
        $usu_id = @Yii::$app->session->get("PB_iduser");
        $fecha_transaccion = date(Yii::$app->params["dateTimeByDefault"]);
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            try {
                $daca_id = $data['id'];
                $pro_id = $data['profesor'];
                $uaca_id = $data['unidad'];
                $mod_id = $data['modalidad'];
                $paca_id = $data['periodo'];
                $jornada_id = $data['jornada'];
                $horario = $data['horario'];
                $materia = $data['materia'];
                $distributivo_model = DistributivoAcademico::findOne($daca_id);
                $dataExists = $distributivo_model->existsDistribucionAcademico($pro_id, $materia, $uaca_id, $mod_id, $paca_id, $jornada_id, $horario);
                if(isset($dataExists) && $dataExists != "" && count($dataExists) > 0){
                    if($dataExists['id'] == $daca_id){
                        $message = array(
                            "wtmessage" => Yii::t("notificaciones", "Your information was successfully saved."),
                            "title" => Yii::t('jslang', 'Success'),
                        );
                        return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                    }
                    $message = array(
                        "wtmessage" => academico::t('distributivoacademico', 'Register already exists in System.'),
                        "title" => Yii::t('jslang', 'Error'),
                    );
                    return Utilities::ajaxResponse('NOOK', 'alert', Yii::t('jslang', 'Error'), 'true', $message);
                }
                $dataHorario = $distributivo_model->getDistribucionAcademicoHorario($uaca_id, $mod_id, $jornada_id, $horario);

                $distributivo_model->pro_id = $pro_id;
                $distributivo_model->mod_id = $mod_id;
                $distributivo_model->asi_id = $materia;
                $distributivo_model->paca_id = $paca_id;
                $distributivo_model->daho_id = $dataHorario['daho_id'];    
                $distributivo_model->daca_fecha_modificacion = $fecha_transaccion;
                $distributivo_model->daca_usuario_modifica = $usu_id;
                if ($distributivo_model->update() !== false) {
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Your information was successfully saved."),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                } else {
                    throw new Exception('Error en Guardar registro.');
                }
            }catch(Exception $e){
                $message = array(
                    "wtmessage" => Yii::t('notificaciones', 'Your information has not been saved. Please try again.'),
                    "title" => Yii::t('jslang', 'Error'),
                );
                return Utilities::ajaxResponse('NOOK', 'alert', Yii::t('jslang', 'Error'), 'true', $message);
            }
        }
    }

    public function actionDelete(){
        if (Yii::$app->request->isAjax) {
            $usu_id = @Yii::$app->session->get("PB_iduser");
            $data = Yii::$app->request->post();
            $fecha_transaccion = date(Yii::$app->params["dateTimeByDefault"]);
            try {
                $id = $data["id"];
                $model = DistributivoAcademico::findOne($id);
                $model->daca_fecha_modificacion = $fecha_transaccion;
                $model->daca_usuario_modifica = $usu_id;
                $model->daca_estado = '0';
                $model->daca_estado_logico = '0';
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Your information was successfully saved."),
                    "title" => Yii::t('jslang', 'Success'),
                );
                if ($model->update() !== false) {
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                } else {
                    throw new Exception('Error SubModulo no ha sido eliminado.');
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

    public function actionExportexcel() {
        $per_id = @Yii::$app->session->get("PB_perid");
        ini_set('memory_limit', '256M');
        $content_type = Utilities::mimeContentType("xls");
        $nombarch = "Report-" . date("YmdHis") . ".xls";
        header("Content-Type: $content_type");
        header("Content-Disposition: attachment;filename=" . $nombarch);
        header('Cache-Control: max-age=0');
        $colPosition = array("C", "D", "E", "F", "G", "H", "I");
        $arrHeader = array(
            academico::t("Academico", "Teacher"),
            Yii::t("formulario", "DNI 1"),
            Yii::t("formulario", "Academic unit"),
            Yii::t("formulario", "Mode"),
            Yii::t("formulario", "Period"),
            Yii::t("formulario", "Subject"),
            academico::t("Academico", "Working day"),
        );
        $distributivo_model = new DistributivoAcademico();
        $data = Yii::$app->request->get();
        $arrSearch["search"] = ($data['search'] != "")?$data['search']:NULL;
        $arrSearch["unidad"] = ($data['unidad'] > 0)?$data['unidad']:NULL;
        $arrSearch["modalidad"] = ($data['modalidad'] > 0)?$data['modalidad']:NULL;
        $arrSearch["periodo"] = ($data['periodo'] > 0)?$data['periodo']:NULL;
        $arrSearch["asignatura"] = ($data['asignatura'] > 0)?$data['asignatura']:NULL;
        $arrSearch["jornada"] = ($data['jornada'] > 0)?$data['jornada']:NULL;

        $arrData = $distributivo_model->getListadoDistributivo($arrSearch["search"], $arrSearch["modalidad"], $arrSearch["asignatura"], $arrSearch["jornada"], $arrSearch["unidad"], $arrSearch["periodo"], true);
        foreach($arrData as $key => $value){
            unset($arrData[$key]["Id"]);
        }
        $nameReport = academico::t("distributivoacademico", "Profesor Lists by Subject");
        Utilities::generarReporteXLS($nombarch, $nameReport, $arrHeader, $arrData, $colPosition);
        exit;
    }

    public function actionExportpdf() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $report = new ExportFile();
        $this->view->title = academico::t("distributivoacademico", "Profesor Lists by Subject"); // Titulo del reporte
        $arrHeader = array(
            academico::t("Academico", "Teacher"),
            Yii::t("formulario", "DNI 1"),
            Yii::t("formulario", "Academic unit"),
            Yii::t("formulario", "Mode"),
            Yii::t("formulario", "Period"),
            Yii::t("formulario", "Subject"),
            academico::t("Academico", "Working day"),
        );
        $distributivo_model = new DistributivoAcademico();
        $data = Yii::$app->request->get();
        $arrSearch["search"] = ($data['search'] != "")?$data['search']:NULL;
        $arrSearch["unidad"] = ($data['unidad'] > 0)?$data['unidad']:NULL;
        $arrSearch["modalidad"] = ($data['modalidad'] > 0)?$data['modalidad']:NULL;
        $arrSearch["periodo"] = ($data['periodo'] > 0)?$data['periodo']:NULL;
        $arrSearch["asignatura"] = ($data['asignatura'] > 0)?$data['asignatura']:NULL;
        $arrSearch["jornada"] = ($data['jornada'] > 0)?$data['jornada']:NULL;

        $arrData = $distributivo_model->getListadoDistributivo($arrSearch["search"], $arrSearch["modalidad"], $arrSearch["asignatura"], $arrSearch["jornada"], $arrSearch["unidad"], $arrSearch["periodo"], true);
        $report->orientation = "P"; // tipo de orientacion L => Horizontal, P => Vertical                                
        $report->createReportPdf(
                $this->render('exportpdf', [
                    'arr_head' => $arrHeader,
                    'arr_body' => $arrData,
                ])
        );
        $report->mpdf->Output('Reporte_' . date("Ymdhis") . ".pdf", ExportFile::OUTPUT_TO_DOWNLOAD);
    }

}