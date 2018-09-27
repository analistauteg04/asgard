<?php

namespace app\modules\academico\controllers;

use Yii;
use app\modules\academico\models\Admitido;
use app\modules\academico\models\EstudioAcademico;
use app\modules\admision\models\Interesado;
use yii\helpers\ArrayHelper;


class AdmitidosController extends \app\components\CController {
    public function actionIndex() {
        $per_id = @Yii::$app->session->get("PB_perid");    
        $mod_carrera = new EstudioAcademico();
      
        $data = Yii::$app->request->get();
        if ($data['PBgetFilter']) {
            $arrSearch["f_ini"] = $data['f_ini'];
            $arrSearch["f_fin"] = $data['f_fin'];
            $arrSearch["carrera"] = $data['carrera'];
            $arrSearch["search"] = $data['search'];
            $arrSearch["codigocan"] = $data['codigocan'];
            $mod_aspirante = Admitido::getAdmitidos($arrSearch);

            return $this->renderPartial('index-grid', [
                        "model" => $mod_aspirante,                        
            ]);
        } else {
            $mod_aspirante = Admitido::getAdmitidos();
        }
        if (Yii::$app->request->isAjax) {//
            $data = Yii::$app->request->get();
            if (isset($data["op"]) && $data["op"] == '1') {
                
            }
        }
        $arrCarreras = ArrayHelper::map(array_merge([["id" => "0", "value" => Yii::t("formulario", "Grid")]],$mod_carrera->consultarCarrera()),"id", "value");
        return $this->render('index', [
                    'model' => $mod_aspirante,
                    'arrCarreras' => $arrCarreras,                   
        ]);
    }
}