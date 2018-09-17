<?php

namespace app\modules\admision\controllers;

use Yii;
use app\modules\admision\models\Oportunidad;
use app\modules\admision\models\PersonaGestion;
use app\modules\admision\models\TipoOportunidadVenta;
use app\modules\admision\models\EstadoOportunidad;
use app\modules\academico\models\UnidadAcademica;
use app\modules\academico\models\Modalidad;
use app\models\Empresa;
use yii\helpers\ArrayHelper;

class ActividadesController extends \app\components\CController
{
    public function actionListaractividades()
    {
        $modoportunidad = new Oportunidad();
        $pges_id = base64_decode($_GET["pges_id"]);
        $opor_id = base64_decode($_GET["opor_id"]);
        $persges_mod = new PersonaGestion();
        $contactManage = $persges_mod->consultarPersonaGestion($pges_id);
        $mod_gestion = $modoportunidad->consultarOportunHist($opor_id);
        $mod_oportu = $modoportunidad->consultarOportunidadById($opor_id);
        return $this->render('listaractividad', [
            'model' => $mod_gestion,
            'personalData' => $contactManage,
            'oportuniData' => $mod_oportu,
        ]);
    }

    public function actionView()
    {
        $opor_id = base64_decode($_GET["opid"]);
        $act_id = base64_decode($_GET["acid"]);
        $pges_id = base64_decode($_GET["pgid"]);
        $persges_mod = new PersonaGestion();
        $uni_aca_model = new UnidadAcademica();
        $modTipoOportunidad = new TipoOportunidadVenta();
        $modalidad_model = new Modalidad();
        $state_oportunidad_model = new EstadoOportunidad();
        $oport_model = new Oportunidad();
        $empresa_mod = new Empresa();
        $empresa = $empresa_mod->getAllEmpresa();
        $contactManage = $persges_mod->consultarPersonaGestion($pges_id);
        $modalidad_data = $modalidad_model->consultarModalidad(0);
        $actividad_data = $oport_model->consultarActividadById($act_id);
        $oportunidad_perdidad = $oport_model->consultarOportunidadPerdida();
        $oport_contac = $oport_model->consultarOportunidadById($opor_id);
        $unidad_acad_data = $uni_aca_model->consultarUnidadAcademicas();
        $tipo_oportunidad_data = $modTipoOportunidad->consultarOporxUnidad(1);
        $academic_study_data = $oport_model->consultarCarreraModalidad(1, 1);
        $state_oportunidad_data = $state_oportunidad_model->consultarEstadOportunidad();
        $knowledge_channel_data = $oport_model->consultarConocimientoCanal(1);
        return $this->render('view', [
            'personalData' => $contactManage,
            'oportunidad_contacto' => $oport_contac,
            'actividad_oportunidad' => $actividad_data,
            'arr_modalidad' => ArrayHelper::map($modalidad_data, "id", "name"),
            'arr_oportunidad_perdida' => ArrayHelper::map($oportunidad_perdidad, "id", "name"),
            'arr_linea_servicio' => ArrayHelper::map($unidad_acad_data, "id", "name"),
            'arr_tipo_oportunidad' => ArrayHelper::map($tipo_oportunidad_data, "id", "name"),
            'arr_state_oportunidad' => ArrayHelper::map($state_oportunidad_data, "id", "name"),
            'arr_academic_study' => ArrayHelper::map($academic_study_data, "id", "name"),
            "arr_knowledge_channel" => ArrayHelper::map($knowledge_channel_data, "id", "name"),
            "tipo_dni" => array("CED" => Yii::t("formulario", "DNI Document"), "PASS" => Yii::t("formulario", "Passport")),
            'arr_empresa' => ArrayHelper::map($empresa, "Ids", "Nombre"),
        ]);
    }

    public function actionEdit()
    {
        $opor_id = base64_decode($_GET["opid"]);
        $act_id = base64_decode($_GET["acid"]);
        $pges_id = base64_decode($_GET["pgid"]);
        $persges_mod = new PersonaGestion();
        $uni_aca_model = new UnidadAcademica();
        $modTipoOportunidad = new TipoOportunidadVenta();
        $modalidad_model = new Modalidad();
        $state_oportunidad_model = new EstadoOportunidad();
        $oport_model = new Oportunidad();
        $empresa_mod = new Empresa();
        $empresa = $empresa_mod->getAllEmpresa();
        $contactManage = $persges_mod->consultarPersonaGestion($pges_id);
        $modalidad_data = $modalidad_model->consultarModalidad(0);
        $actividad_data = $oport_model->consultarActividadById($act_id);
        $oportunidad_perdidad = $oport_model->consultarOportunidadPerdida();
        $oport_contac = $oport_model->consultarOportunidadById($opor_id);
        $unidad_acad_data = $uni_aca_model->consultarUnidadAcademicas();
        $tipo_oportunidad_data = $modTipoOportunidad->consultarOporxUnidad(1);
        $academic_study_data = $oport_model->consultarCarreraModalidad(1, 1);
        $state_oportunidad_data = $state_oportunidad_model->consultarEstadOportunidad();
        $knowledge_channel_data = $oport_model->consultarConocimientoCanal(1);
        return $this->render('edit', [
            'personalData' => $contactManage,
            'oportunidad_contacto' => $oport_contac,
            'actividad_oportunidad' => $actividad_data,
            'arr_modalidad' => ArrayHelper::map($modalidad_data, "id", "name"),
            'arr_oportunidad_perdida' => ArrayHelper::map($oportunidad_perdidad, "id", "name"),
            'arr_linea_servicio' => ArrayHelper::map($unidad_acad_data, "id", "name"),
            'arr_tipo_oportunidad' => ArrayHelper::map($tipo_oportunidad_data, "id", "name"),
            'arr_state_oportunidad' => ArrayHelper::map($state_oportunidad_data, "id", "name"),
            'arr_academic_study' => ArrayHelper::map($academic_study_data, "id", "name"),
            "arr_knowledge_channel" => ArrayHelper::map($knowledge_channel_data, "id", "name"),
            "tipo_dni" => array("CED" => Yii::t("formulario", "DNI Document"), "PASS" => Yii::t("formulario", "Passport")),
            'arr_empresa' => ArrayHelper::map($empresa, "Ids", "Nombre"),
        ]);
    }

    public function actionNewactividad()
    {
        $opor_id = base64_decode($_GET["opid"]);
        $pges_id = base64_decode($_GET["pgid"]);
        $persges_mod = new PersonaGestion();
        $uni_aca_model = new UnidadAcademica();
        $modTipoOportunidad = new TipoOportunidadVenta();
        $modalidad_model = new Modalidad();
        $state_oportunidad_model = new EstadoOportunidad();
        $oport_model = new Oportunidad();
        $empresa_mod = new Empresa();
        $empresa = $empresa_mod->getAllEmpresa();
        $contactManage = $persges_mod->consultarPersonaGestion($pges_id);
        $modalidad_data = $modalidad_model->consultarModalidad(0);
        $oport_contac = $oport_model->consultarOportunidadById($opor_id);
        $oportunidad_perdidad = $oport_model->consultarOportunidadPerdida();
        $unidad_acad_data = $uni_aca_model->consultarUnidadAcademicas();
        $tipo_oportunidad_data = $modTipoOportunidad->consultarOporxUnidad(1);
        $academic_study_data = $oport_model->consultarCarreraModalidad(1, 1);
        $state_oportunidad_data = $state_oportunidad_model->consultarEstadOportunidad();
        $knowledge_channel_data = $oport_model->consultarConocimientoCanal(1);
        return $this->render('new', [
            'personalData' => $contactManage,
            'oportunidad_contacto' => $oport_contac,
            'arr_modalidad' => ArrayHelper::map($modalidad_data, "id", "name"),
            'arr_linea_servicio' => ArrayHelper::map($unidad_acad_data, "id", "name"),
            'arr_oportunidad_perdida' => ArrayHelper::map($oportunidad_perdidad, "id", "name"),
            'arr_tipo_oportunidad' => ArrayHelper::map($tipo_oportunidad_data, "id", "name"),
            'arr_state_oportunidad' => ArrayHelper::map($state_oportunidad_data, "id", "name"),
            'arr_academic_study' => ArrayHelper::map($academic_study_data, "id", "name"),
            "arr_knowledge_channel" => ArrayHelper::map($knowledge_channel_data, "id", "name"),
            "tipo_dni" => array("CED" => Yii::t("formulario", "DNI Document"), "PASS" => Yii::t("formulario", "Passport")),
            'arr_empresa' => ArrayHelper::map($empresa, "Ids", "Nombre"),
        ]);
    }

    public function actionSave()
    {
        per_id = @Yii::$app->session->get("PB_perid");
        $usu_id = @Yii::$app->user->identity->usu_id;
        $fecproxima = null;
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $mod_gestion = new Oportunidad();
            $fecatiende = $data["fecatencion"] . ' ' . $data["horatencion"];
            $observacion = ucwords(strtolower($data["observacion"]));
            if (!empty($data["fecproxima"])) {
                $fecproxima = $data["fecproxima"] . ' ' . $data["horproxima"];
            }
            // Datos Generales Contacto            
            $con = \Yii::$app->db_crm;
            $transaction = $con->beginTransaction();
            try {
                $padm_class = $mod_gestion->consultarAgenteAutenticado(5);
                $padm_id = $padm_class['padm_id'];
                if ($padm_id > 0) {
                    $opo_id = base64_decode($data['oportunidad']);
                    $eopo_id = $data['estado_oportunidad'];
                    $actividad_id = $mod_gestion->insertarActividad($opo_id, $usu_id, $padm_id, $eopo_id, $fecatiende, $observacion, $fecproxima);
                    if ($actividad_id) {
                        $oporper = null;
                        if ($eopo_id == 5) {
                            $oporper = $data['oportunidad_perdida'];
                        }
                        $out = $mod_gestion->modificarOportunixId(null, $opo_id, null, null, null, null, null, null, null, null, null, $eopo_id, $usu_id, $oporper);
                        if ($out) {
                            $exito = 1;
                        } else {
                            $exito = 0;
                        }
                    }
                    if ($exito) {
                        $transaction->commit();
                        $message = array(
                            "wtmessage" => Yii::t("notificaciones", "La infomación ha sido grabada. "),
                            "title" => Yii::t('jslang', 'Success'),
                        );
                        return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                    } else {
                        $transaction->rollback();
                        $message = array(
                            "wtmessage" => Yii::t("notificaciones", "Error al grabar."),
                            "title" => Yii::t('jslang', 'Success'),
                        );
                        return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                    }
                } else {
                    $transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error al grabar, el usuario autenticado no tiene permisos." . $mensaje),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $mensaje),
                    "title" => Yii::t('jslang', 'Success'),
                );
                return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
            }
            return;
        }
    }

    public function actionUpdate()
    {
        $per_id = @Yii::$app->session->get("PB_perid");
        $usu_id = @Yii::$app->user->identity->usu_id;
        $fecproxima = null;
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $mod_gestion = new Oportunidad();
            $fecatiende = $data["fecatencion"] . ' ' . $data["horatencion"];
            $observacion = ucwords(strtolower($data["observacion"]));
            if (!empty($data["fecproxima"])) {
                $fecproxima = $data["fecproxima"] . ' ' . $data["horproxima"];
            }
            // Datos Generales Contacto            
            $con = \Yii::$app->db_crm;
            $transaction = $con->beginTransaction();
            try {
                $padm_class = $mod_gestion->consultarAgenteAutenticado(5);
                $padm_id = $padm_class['padm_id'];
                $act_id = base64_decode($data['bact_id']);
                if ($padm_id > 0) {
                    \app\models\Utilities::putMessageLogFile('argumentos de actualizar: ' . $act_id . "-" . $usu_id . "-" . $padm_id . "-" . $fecatiende . "-" . $observacion . "-" . $fecproxima);
                    $actividad_id = $mod_gestion->actualizarActividad($act_id, $usu_id, $padm_id, $fecatiende, $observacion, $fecproxima);
                    if ($actividad_id) {
                        $exito = 1;
                    }
                    if ($exito) {
                        $transaction->commit();
                        $message = array(
                            "wtmessage" => Yii::t("notificaciones", "La infomación ha sido actualizada. "),
                            "title" => Yii::t('jslang', 'Success'),
                        );
                        return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                    } else {
                        $transaction->rollback();
                        $message = array(
                            "wtmessage" => Yii::t("notificaciones", "Error al grabar."),
                            "title" => Yii::t('jslang', 'Success'),
                        );
                        return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                    }
                } else {
                    $transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error al grabar, el usuario autenticado no tiene permisos." . $mensaje),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $mensaje),
                    "title" => Yii::t('jslang', 'Success'),
                );
                return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
            }
            return;
        }
    }
}