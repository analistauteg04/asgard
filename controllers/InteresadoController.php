<?php

namespace app\controllers;

use Yii;
use app\models\SolicitudInscripcion;
use app\models\Interesado;
use yii\helpers\ArrayHelper;

class InteresadoController extends \app\components\CController {   

    public function actionListarinteresados() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $model_interesado = new Interesado();
        $resp_gruporol = $model_interesado->consultagruporol($per_id);                
        $data = Yii::$app->request->get();
        
        if ($data['PBgetFilter']) {
            $arrSearch["f_ini"] = $data['f_ini'];
            $arrSearch["f_fin"] = $data['f_fin'];            
            $arrSearch["estadosol"] = $data['estadosol'];
            $arrSearch["search"] = $data['search'];
            $model = Interesado::consultaInteresadoxejecutivo($per_id, $resp_gruporol["grol_id"], $arrSearch);                    
        } else {
            $model = Interesado::consultaInteresadoxejecutivo($per_id, $resp_gruporol["grol_id"]); 
        }         
        $model_solicitud = new SolicitudInscripcion();
        $resp_estados = $model_solicitud->Consultaestadosolicitud();
        $arrEstados = ArrayHelper::map(array_merge([["id" => "0", "value" => Yii::t("formulario", "Grid")], ["id" => "5", "value" => Yii::t("formulario", "Pendiente Ficha Datos")], ["id" => "6", "value" => Yii::t("formulario", "Pendiente Crear Solicitud")], ["id" => "7", "value" => Yii::t("formulario", "Pagada")], ["id" => "8", "value" => Yii::t("formulario", "Pendiente de Pago")]], $resp_estados), "id", "value");                
        return $this->render('listarInteresados', [
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
        return $this->render('listarPreinteresados', [
                             'model' => $model,                             
            ]);
    }

}
