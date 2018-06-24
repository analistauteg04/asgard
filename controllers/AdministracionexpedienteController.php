<?php
namespace app\controllers;

use Yii;
use app\models\Utilities;
use app\models\ExpedienteProfesor;
use yii\helpers\ArrayHelper;

class AdministracionexpedienteController extends \app\components\CController {

    public function actionListarexpediente() {  
        $modExpediente = new ExpedienteProfesor();
        $resp_estados = $modExpediente->consultarParametros("pv_estadoexpediente",null);                
        $data = Yii::$app->request->get();
        
        if ($data['PBgetFilter']) {                     
            $arrSearch["estado"] = $data['estadoexp'];
            $arrSearch["search"] = $data['search'];
            $model = $modExpediente->listadoExpediente($arrSearch);                    
        } else {
            $model = $modExpediente->listadoExpediente(); 
        }         
        
        return $this->render('listarExpediente', [
                             "arr_estado" => ArrayHelper::map($resp_estados, "id", "name"), 
                             'model' => $model,
        ]);
    }    
}