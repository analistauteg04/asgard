<?php

namespace app\modules\marketing\controllers;

use Yii;
use app\models\Utilities;
use app\modules\admision\Module as PersonaGestion;
use app\modules\academico\Module as academico;
use app\modules\financiero\Module as financiero;

academico::registerTranslations();
financiero::registerTranslations();

class EmailController extends \app\components\CController {

    public function actionIndex() {
        return $this->render('index', []);        
    }
    
    public function actionListasubscriptores(){
        return $this->render('listaSubscriptores', []);        
    }
    
    public function actionProgramacion() {
        $per_id = @Yii::$app->session->get("PB_perid");
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();            
            if (isset($data["gettemplate"])) {
                //$template = $modlista->consultarListaTemplate($data["lista"]);
                $message = array("template" => $template);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
        }
        return $this->render('programacion', [
        ]);
    }
    
}
