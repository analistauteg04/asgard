<?php

namespace app\modules\admision\controllers;

use Yii;

class InteresadosController extends \app\components\CController {

    public function actionIndex() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $model_interesado = new Interesado();
        $resp_gruporol = $model_interesado->consultagruporol($per_id);
        $data = Yii::$app->request->get();

        if ($data['PBgetFilter']) {
            $arrSearch["f_ini"] = $data['f_ini'];
            $arrSearch["f_fin"] = $data['f_fin'];
            $arrSearch["estadosol"] = $data['estadosol'];
            $arrSearch["search"] = $data['search'];
            $model = Interesado::consultaInteresadoxejecutivo($per_id, $resp_gruporol["grol_id"], $arrSearch);
        } else {
            $model = Interesado::consultaInteresadoxejecutivo($per_id, $resp_gruporol["grol_id"]);
        }
        $model_solicitud = new SolicitudInscripcion();
        $resp_estados = $model_solicitud->Consultaestadosolicitud();
        $arrEstados = ArrayHelper::map(array_merge([["id" => "0", "value" => Yii::t("formulario", "Grid")], ["id" => "6", "value" => Yii::t("formulario", "Pendiente Crear Solicitud")]], $resp_estados), "id", "value");
        return $this->render('listarinteresados', [
                    'model' => $model,
                    'arrEstados' => $arrEstados,
        ]);
    }

    public function actionView() {
        
    }

    public function actionEdit() {
        
    }

    public function actionNew() {
        return $this->render('new');
    }

    public function actionSave() {
        
    }

    public function actionUpdate() {
        
    }

}
