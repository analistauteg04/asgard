<?php

namespace app\modules\academico\controllers;

use Yii;
use yii\base\Exception;
use app\modules\academico\models\Diploma;
use yii\helpers\ArrayHelper;
use app\models\Utilities;
use app\models\ExportFile;
use app\modules\academico\models\Estudiante;
use app\modules\academico\Module as academico;

academico::registerTranslations();

class EstudianteController extends \app\components\CController {

    public function actionIndex() {
        $mod_estudiante = new Estudiante();
        $data = Yii::$app->request->get();
        if ($data['PBgetFilter']) {
            $arrSearch["search"] = $data['search'];
            $arrSearch["f_ini"] = $data['f_ini'];
            $arrSearch["f_fin"] = $data['f_fin'];
            $arrSearch["unidad"] = $data['unidad'];
            $arrSearch["modalidad"] = $data['modalidad'];
            $arrSearch["carrera"] = $data['carrera'];
            //$arr_estudiante = $mod_estudiante->consultarEstudiante($arrSearch);
            return $this->renderPartial('index-grid', [
                        "model" => $arr_estudiante,
            ]);
        } else {
            //$arr_estudiante = $mod_estudiante->consultarEstudiante();
        }
        return $this->render('index', [
        ]);
    }

}
