<?php

namespace app\modules\academico\controllers;

use Yii;
use app\modules\academico\models\Diploma;
use yii\helpers\ArrayHelper;
use app\models\Utilities;
use app\modules\financiero\models\Secuencias;
use app\modules\academico\Module as academico;

academico::registerTranslations();

class DiplomaController extends \app\components\CController {

    public function actionIndex(){
        $model = new Diploma();
        $arr_carreras = array();
        $arr_modalidades = array();
        $arr_programas = array();
        $data = Yii::$app->request->get();
        if (isset($data["PBgetFilter"]) && $data["PBgetFilter"] == TRUE) {
            return $this->renderPartial('index-grid', [
                "model" => $model->getAllDiplomasGrid($data["search"]),
            ]);
        }
        return $this->render('index', [
            'model' => $model->getAllDiplomasGrid(NULL),
            'arr_carreras' => $arr_carreras,
            'arr_programas' => $arr_programas,
            'arr_modalidades' => $arr_modalidades,
        ]);
    }

    public function actionDiplomadownload(){

    }
}