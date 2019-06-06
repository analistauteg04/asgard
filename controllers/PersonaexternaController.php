<?php

namespace app\controllers;

use Yii;
use app\models\Utilities;
use yii\helpers\ArrayHelper;
use yii\base\Exception;
use app\models\Pais;
use app\models\Provincia;
use app\models\Canton;
use app\modules\academico\models\NivelInstruccion;
use app\modules\marketing\models\Interes;
use app\models\PersonaExterna;
use yii\helpers\Url;


class PersonaexternaController extends \yii\web\Controller {
    public function init() {
        if (!is_dir(Yii::getAlias('@bower')))
            Yii::setAlias('@bower', '@vendor/bower-asset');
        return parent::init();
    }

    public function actionUpdate() {
        $this->layout = '@themes/' . \Yii::$app->getView()->theme->themeName . '/layouts/basic.php';
        return $this->render('update', array());
    }

    public function actionIndex() {
        $this->layout = '@themes/' . \Yii::$app->getView()->theme->themeName . '/layouts/basic.php';                
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["getcantones"])) {
                $cantones = Canton::find()->select("can_id AS id, can_nombre AS name")->where(["can_estado_logico" => "1", "can_estado" => "1", "pro_id" => $data['prov_id']])->asArray()->all();
                $message = array("cantones" => $cantones);
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }           
        }        
        $pais_id = 1; //Ecuador
        $arr_prov = Provincia::provinciaXPais($pais_id);
        $arr_ciu = Canton::cantonXProvincia(1);
        $mod_nivel= new NivelInstruccion();
        $arr_nivel = $mod_nivel->consultarNivelInstruccion();
        $mod_interes = new Interes();
        $arr_interes = $mod_interes->consultarInteres();
        $mod_perext = new PersonaExterna();
        $arr_evento = $mod_perext->consultarEvento();        
        $_SESSION['JSLANG']['Your information has not been saved. Please try again.'] = Yii::t('notificaciones', 'Your information has not been saved. Please try again.');
        return $this->render('index', [                    
                    "arr_provincia" => ArrayHelper::map($arr_prov, "id", "value"),
                    "arr_ciudad" => ArrayHelper::map($arr_ciu, "id", "value"),
                    "arr_genero" => array("1" => Yii::t("formulario", "Female"), "2" => Yii::t("formulario", "Male")),
                    "arr_nivel" => ArrayHelper::map($arr_nivel, "id", "value"),
                    "arr_evento" => ArrayHelper::map($arr_evento, "id", "value"), //$arr_evento
                    "arr_interes" => $arr_interes,
        ]);
    }    
    
    public function actionSave() {
        $mod_perext = new PersonaExterna();
        $con = \Yii::$app->db_mailing;
        $ip = \app\models\Utilities::getClientRealIP(); // ip de la maquina
        
        $respPersext = $mod_perext->insertPersonaExterna($con, $data);
    }
}

