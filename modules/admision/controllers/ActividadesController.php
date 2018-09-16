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
    public function actionIndex()
    {
        $modoportunidad = new Oportunidad();
        $pges_id = base64_decode($_GET["pges_id"]);
        $opor_id = base64_decode($_GET["opor_id"]);
        $persges_mod = new PersonaGestion();
        $contactManage = $persges_mod->consultarPersonaGestion($pges_id);
        $mod_gestion = $modoportunidad->consultarOportunHist($opor_id);
        $mod_oportu = $modoportunidad->consultarOportunidadById($opor_id);
        return $this->render('index', [
            'model' => $mod_gestion,
            'personalData' => $contactManage,
            'oportuniData' => $mod_oportu,
        ]);
    }

    public function actionView()
    {

    }

    public function actionEdit()
    {

    }

    public function actionNew()
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

    }

    public function actionUpdate()
    {

    }
}