<?php

namespace app\modules\financiero\controllers;

use Yii;
//use app\models\Utilities;
use yii\helpers\ArrayHelper;
//use yii\web\UploadedFile;
use app\modules\financiero\models\OrdenPago;
//use app\modules\admision\models\SolicitudInscripcion;
//use app\models\Persona;
use app\modules\admision\models\Interesado;
//use yii\helpers\Url;
//use yii\base\Exception;
//use yii\base\Security;

class PagosController extends \app\components\CController {

    public function actionIndex() {
        $per_id = @Yii::$app->session->get("PB_iduser");
        $model_interesado = new Interesado();
        $resp_gruporol = $model_interesado->consultagruporol($per_id);
        $mod_pago = new OrdenPago();
        $data = null;
        $data = Yii::$app->request->get();

        if ($data['PBgetFilter']) {
            $arrSearch["f_ini"] = $data['f_ini'];
            $arrSearch["f_fin"] = $data['f_fin'];
            $arrSearch["f_estado"] = $data['f_estado'];
            $arrSearch["search"] = $data['search'];
            $resp_pago = $mod_pago->listarPagosolicitud($arrSearch, $resp_gruporol["grol_id"]);
            return $this->renderPartial('index-grid', [
                        "model" => $resp_pago,
            ]);
        } else {
            $resp_pago = $mod_pago->listarPagosolicitud(null, $resp_gruporol["grol_id"]);
        }
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->get();
            if (isset($data["op"]) && $data["op"] == '1') {
                
            }
        }
        $arrEstados = ArrayHelper::map([["id" => "T", "value" => "Todos"], ["id" => "P", "value" => "Pendiente"], ["id" => "S", "value" => "Pagada"]], "id", "value");
        return $this->render('index', [
                    'model' => $resp_pago,
                    'arrEstados' => $arrEstados
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
