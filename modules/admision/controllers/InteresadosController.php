<?php

namespace app\modules\admision\controllers;

use Yii;
use app\modules\admision\models\Interesado;
use app\models\Empresa;
use yii\helpers\ArrayHelper;

class InteresadosController extends \app\components\CController {
    public function actionIndex() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $interesado_model = new Interesado();
        $data = Yii::$app->request->get();

        if ($data['PBgetFilter']) {
            $arrSearch["search"] = $data['search'];
            $model = $interesado_model->consultarInteresados($arrSearch);
        } else {
            $model = $interesado_model->consultarInteresados();
        }
        $empresa_model=new Empresa();        
        $arr_empresas=$empresa_model->getAllEmpresa();
        $arrEmpresa = ArrayHelper::map($arr_empresas, "id", "value");
        return $this->render('index', [
                    'model' => $model,
                    'arr_empresa' => $arrEmpresa,
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
