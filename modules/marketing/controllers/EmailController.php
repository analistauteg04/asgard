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
        
        if ($data['PBgetFilter']) {
            $arrSearch["lista_id"] = $data['lista_id'];                        
            $resp_lista = $mod_lista->consultarLista($arrSearch);
        } else {
            $resp_lista = $mod_lista->consultarLista();
        }
        
        $resp_combo_lista = $mod_lista->consultarListaProgramacion();                
        return $this->render('index', [
            "arr_lista" => ArrayHelper::map(array_merge(["id" => "0", "name" => "Seleccionar"],$resp_combo_lista), "id", "name"),                               
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
    
    public function actionDelete() {
        $mod_lista = new Lista();
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            //$lis_id = $data["list_id"];
            $lis_id = base64_decode($_GET['lis_id']);
            $con = \Yii::$app->db_mailing;
            $transaction = $con->beginTransaction();
            try {
                $resp_listsuscriptor = $mod_lista->inactivaListaSuscriptor($lis_id);
                if ($resp_listsuscriptor) {
                    $resp_lista = $mod_lista->inactivaLista($lis_id);
                    if ($resp_lista) {
                        $exito = '1';
                    } 
                }
                if ($exito) {
                    $transaction->commit();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Se ha eliminado la lista exitosamente."),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                } else {
                    $transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error al eliminar."),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                }
                
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error al eliminar."),
                    "title" => Yii::t('jslang', 'Success'),
                );
                return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
            }
        }
    }
    
}
