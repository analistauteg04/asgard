<?php

namespace app\modules\marketing\controllers;

use Yii;
use app\models\Utilities;
use yii\helpers\ArrayHelper;
use app\modules\marketing\models\Lista;
use app\modules\academico\Module as academico;
use app\modules\financiero\Module as financiero;

academico::registerTranslations();
financiero::registerTranslations();

class EmailController extends \app\components\CController {

    public function actionIndex() {
        $mod_lista = new Lista();
        $resp_lista = $mod_lista->consultarLista();
        return $this->render('index', [
            'model' => $resp_lista]);        
    }
    
    public function actionListasubscriptores(){
        
        return $this->render('listaSubscriptores', [
                ]);        
    }
    
    public function actionProgramacion() {
        $mod_lista = new Lista();
        $per_id = @Yii::$app->session->get("PB_perid");
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();            
            if (isset($data["gettemplate"])) {
               //$template = $mod_lista->consultarListaTemplate($data["lista"]);
                $message = array("template" => $template);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
        }
        $arr_lista = $mod_lista->consultarListaProgramacion();
        return $this->render('programacion', [            
            "arr_lista" => ArrayHelper::map($arr_lista, "id", "name"),
        ]);
    }
    
}
