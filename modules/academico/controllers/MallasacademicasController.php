<?php

namespace app\modules\academico\controllers;

use Yii;
use app\models\ExportFile;
use app\modules\academico\models\EstudioAcademico;
use yii\helpers\ArrayHelper;
use app\models\Utilities;
use app\modules\academico\models\Modalidad;
use app\modules\academico\models\UnidadAcademica;
use app\modules\academico\models\MallaAcademica;
use app\models\Persona;
use app\models\Usuario;
use yii\base\Security;
use yii\base\Exception;
use app\modules\academico\Module as academico;
use app\modules\financiero\Module as financiero;
use app\modules\admision\Module as admision;

academico::registerTranslations();
admision::registerTranslations();
financiero::registerTranslations();

class MallasacademicasController extends \app\components\CController {
    
    public function actionIndex() {            
        $mod_malla = new MallaAcademica();
        
        $data = Yii::$app->request->get();
        if ($data['PBgetFilter']) {
            $arrSearch["search"] = $data['search'];
            
            $arr_mallas = $mod_malla->consultarMallas($arrSearch);
            return $this->renderPartial('index-grid', [
                        "model" => $arr_mallas,
            ]);
        } else {
            $arr_mallas = $mod_malla->consultarMallas();
        }        
        return $this->render('index', [
                    'model' => $arr_mallas,                   
        ]);
    } 
    
    public function actionIndexdetalle() {    
        $malla_id = base64_decode($_GET['maca_id']);        
        $mod_malla = new MallaAcademica();
        
        $data = Yii::$app->request->get();
        if ($data['PBgetFilter']) {
            $arrSearch["search"] = $data['search'];
            
            $arr_mallas = $mod_malla->consultarDetallemallaXid($malla_id,$arrSearch);
            return $this->renderPartial('indexdetalle-grid', [
                        "model" => $arr_mallas,
            ]);
        } else {
            $arr_mallas = $mod_malla->consultarDetallemallaXid($malla_id);
        }        
        return $this->render('indexdetalle', [
                    'model' => $arr_mallas,                   
        ]);
    } 
    

}
