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
        if (Yii::$app->request->isAjax) {            
            $data = Yii::$app->request->post();                                  
            $transaction = $con->beginTransaction();
            try {                
                $dataRegistro = array(
                    'pext_nombres'  => $data["nombres"],
                    'pext_apellidos'  => $data["apellidos"], 
                    'pext_correo'  => $data["correo"], 
                    'pext_celular'  => $data["celular"], 
                    'pext_telefono'  => $data["telefono"], 
                    'pext_genero'  => $data["genero"], 
                    'pext_edad'  => $data["edad"], 
                    'nins_id'  => $data["niv_interes"], 
                    'pro_id'  => $data["pro_id"], 
                    'can_id'  => $data["can_id"], 
                    'eve_id'  => $data["eve_id"], 
                    'pext_ip_registro'  => $ip, 
                );   
                \app\models\Utilities::putMessageLogFile('registro:' . $dataRegistro);     
                $respPersext = $mod_perext->insertPersonaExterna($con, $dataRegistro);
                if ($respPersext) {
                    $exito = '1';
                }
                if ($exito==1) {
                    $transaction->commit();
                    $mensaje = "Se ha guardado exitosamente su registro.";
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", $mensaje),
                        "title" => Yii::t('jslang', 'Success'),                        
                    );
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                } else {
                    $transaction->rollBack();
                    $message = array(
                    "wtmessage" => $ex->getMessage(), Yii::t("notificaciones", "Error al grabar."),
                    "title" => Yii::t('jslang', 'Error'),
                    );
                    return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), true, $message);
                }
            } catch (Exception $ex) {
                $transaction->rollBack();
                $message = array(
                    "wtmessage" => $ex->getMessage(), Yii::t("notificaciones", "Error al grabar."),
                    "title" => Yii::t('jslang', 'Error'),
                );
                return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), true, $message);
            }            
        }
    }
}

