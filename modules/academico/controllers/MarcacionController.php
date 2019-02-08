<?php

namespace app\modules\academico\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\Utilities;
use app\modules\academico\models\MatriculadosReprobado;

class MarcacionController extends \app\components\CController {

    public function actionMarcacion() {
        $mod_admitido = new MatriculadosReprobado();
        $arr_materia = $mod_admitido->consultarMateriasPorUnidadModalidadCarrera(1, 1, 1, '', '');
        return $this->render('marcacion', [
                    'model' => $arr_materia
        ]);
    }

    public function actionIndex() {
        $mod_admitido = new MatriculadosReprobado();
        $arr_materia = $mod_admitido->consultarMateriasPorUnidadModalidadCarrera(1, 1, 1, '', '');
        return $this->render('index', [
                    'model' => $arr_materia,
                    'arr_periodo' => ArrayHelper::map(array_merge([["id" => "0", "name" => "Todas"], ["id" => "1", "name" => "Periodo 1"]]/*, $periodo*/), "id", "name"),
                    'arr_materia' => ArrayHelper::map(array_merge([["id" => "0", "name" => "Todas"], ["id" => "1", "name" => "Materia 1"]]/*, $materia*/), "id", "name"),
        ]);
    }

}
