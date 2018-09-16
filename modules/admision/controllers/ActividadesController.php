<?php

namespace app\modules\admision\controllers;

use Yii;
use app\modules\admision\models\Oportunidad;
use app\modules\admision\models\PersonaGestion;

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
        return $this->render('new');
    }

    public function actionSave()
    {

    }

    public function actionUpdate()
    {

    }
}