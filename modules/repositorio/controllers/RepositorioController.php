<?php

namespace app\modules\repositorio\controllers;

use Yii;
use app\models\Utilities;
use yii\helpers\ArrayHelper;
use app\models\Empresa;
use app\models\ExportFile;
use \app\models\Persona;

/*academico::registerTranslations();
*/
class RepositorioController extends \app\components\CController {
    public function actionIndex() {
        /*$mod_lista = new Lista();
        $data = Yii::$app->request->get();
        if ($data['PBgetFilter']) {
            $arrSearch["lista"] = $data['lista'];
            $resp_lista = $mod_lista->consultarLista($arrSearch);
        } else {
            $resp_lista = $mod_lista->consultarLista();
        }*/
        return $this->render('index', [
               // 'model' => $resp_lista
               ]);
    }  
    public function actionCargar() {    
        return $this->render('cargar', [
              
               ]);
    }  
}
