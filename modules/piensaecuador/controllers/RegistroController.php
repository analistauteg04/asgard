<?php

namespace app\modules\piensaecuador\controllers;

use Yii;
use app\models\Utilities;
use yii\helpers\ArrayHelper;
use yii\base\Exception;
use app\models\Pais;
use app\models\Provincia;
use app\models\Canton;
use app\modules\piensaecuador\models\PersonaExterna;
use yii\helpers\Url;


class RegistroController extends \app\components\CController {

    public function actionIndex() {
        $model = new PersonaExterna();
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->get();
            if (isset($data["search"])) {
                return $this->renderPartial('index-grid', [
                    "model" => $model->getAllPersonaExtGrid($data["search"], true)
                ]);
            }
        }
        return $this->render('index', [
            'model' => $model->getAllPersonaExtGrid(NULL, true)
        ]);
    }
}