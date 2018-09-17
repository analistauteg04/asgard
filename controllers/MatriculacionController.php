<?php

namespace app\controllers;
use \app\models\Matriculacion;
use Yii;
use app\models\SolicitudInscripcion;
use app\models\Interesado;
use yii\helpers\ArrayHelper;

class MatriculacionController extends \app\components\CController {   

    public function actionListarmetodoingreso() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $model_matriculacion = new Matriculacion();
        //$resp_gruporol = $model_interesado->consultagruporol($per_id);                
        $data = Yii::$app->request->get();        
        if ($data['PBgetFilter']) {            
            //$model = 
        } else {
            $model_matriculacion->consultarMetodosIngreso();
            //$model = Interesado::consultaInteresadoxejecutivo($per_id, $resp_gruporol["grol_id"]); 
        }         
        //$arrEstados = ArrayHelper::map(array_merge([["id" => "0", "value" => Yii::t("formulario", "Grid")], ["id" => "5", "value" => Yii::t("formulario", "Pendiente Ficha Datos")], ["id" => "6", "value" => Yii::t("formulario", "Pendiente Crear Solicitud")]], $resp_estados), "id", "value");                
        return $this->render('listarMetodoIngreso', [
                             'model' => $model,
                             'arrEstados' => $arrEstados,
            ]);
    }
    
    public function actionListarpreinteresados() {        
        $model_interesado = new Interesado();        
        $data = Yii::$app->request->get();
        
        if ($data['PBgetFilter']) {
            $arrSearch["f_ini"] = $data['f_ini'];
            $arrSearch["f_fin"] = $data['f_fin'];                        
            $arrSearch["search"] = $data['search'];
            $model = Interesado::consultaPreinteresadas($arrSearch); 
                               
        } else {
            $model = Interesado::consultaPreinteresadas(); 
        }                               
        return $this->render('listarpreinteresados', [
                             'model' => $model,                             
            ]);
    }

}
