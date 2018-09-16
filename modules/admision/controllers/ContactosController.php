<?php

namespace app\modules\admision\controllers;

use Yii;

class ContactosController extends \app\components\CController
{
    public function actionIndex() {
        \app\models\Utilities::putMessageLogFile('hola');
        /*$per_id = @Yii::$app->session->get("PB_iduser");
        $estado_contacto = EstadoContacto::find()->select("econ_id AS id, econ_nombre AS name")->where(["econ_estado_logico" => "1", "econ_estado" => "1"])->asArray()->all();
        $modPersonaGestion = new PersonaGestion();
        $data = Yii::$app->request->get();
        if ($data['PBgetFilter']) {
            $arrSearch["search"] = $data['search'];
            $arrSearch["estado"] = $data['estado'];
            $arrSearch["fase"] = $data['fase'];
            $mod_gestion = $modPersonaGestion->consultarClienteCont($arrSearch);
            return $this->render('_listarContactosGrid', [
                        "model" => $mod_gestion,
            ]);
        } else {
            $mod_gestion = $modPersonaGestion->consultarClienteCont();
        }
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
        }
        return $this->render('listarContactos', [
                    'model' => $mod_gestion,
                    'arr_contacto' => ArrayHelper::map(array_merge([["id" => "0", "name" => "Todas"]], $estado_contacto), "id", "name"),
        ]);*/
    }

}