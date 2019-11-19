<?php

namespace app\modules\academico\controllers;

use Yii;
use app\modules\academico\models\Asignatura;
use app\modules\academico\models\Distributivo;
use app\modules\academico\models\Modalidad;
use app\modules\academico\models\UnidadAcademica;
use yii\helpers\ArrayHelper;
use yii\base\Exception;
use app\models\Utilities;

class DistributivoController extends \app\components\CController {

    public function actionIndex() {
        $distributivo_model = new Distributivo();
        $mod_modalidad = new Modalidad();
        $mod_unidad = new UnidadAcademica();
        if (Yii::$app->request->isAjax) {                        
            $data = Yii::$app->request->post();            
            if (isset($data["getmodalidad"])) {
                //\app\models\Utilities::putMessageLogFile('unidad:'.$data["uaca_id"]);
                $modalidad = $mod_modalidad->consultarModalidad($data["uaca_id"], 1);                
                $message = array("modalidad" => $modalidad);                
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            } 
            $data = Yii::$app->request->get();
            if (isset($data["search"])) {
                return $this->renderPartial('index-grid', [
                            "model" => $distributivo_model->consultarDistributivo($data["search"], true)
                ]);
            }
        }
        $arr_unidad = $mod_unidad->consultarUnidadAcademicasEmpresa(1);
        $arr_modalidad = $mod_modalidad->consultarModalidad($arr_unidad[0]["id"], 1);
        return $this->render('index', [
                   'mod_unidad' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_unidad), "id", "name"),
                   'mod_modalidad' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_modalidad), "id", "name"),
                   'model' => $distributivo_model->consultarDistributivo(NULL, true)
        ]);
    }

   
}

