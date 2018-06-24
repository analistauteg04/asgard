<?php

namespace app\controllers;

use Yii;

use app\models\Usuario;


class UsuarioController extends \app\components\CController {

    public function actionIndex() {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->get();
            if (isset($data["search"])) {
                $arr_usuarios = Usuario::listadoUsuarios($data["search"]);
                return $this->renderPartial('index-grid', [
                            "model" => $arr_usuarios,
                ]);
            }
        }
        $arr_usuarios = Usuario::listadoUsuarios();
        return $this->render('index', [
                    "model" => $arr_usuarios,
        ]);
    }

}
