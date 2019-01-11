<?php

namespace app\modules\marketing\controllers;

use Yii;
use app\models\Utilities;//
use yii\helpers\ArrayHelper;
use app\modules\marketing\models\Lista;
use app\modules\academico\Module as academico;
use app\modules\financiero\Module as financiero;
use app\modules\marketing\models\Suscriptor;

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
        $op = isset($_POST['op']) ? $_POST['op'] : "";
        $resp_combo_lista = $mod_lista->consultarListaProgramacion();                
        return $this->render('index', [
                    "arr_lista" => ArrayHelper::map(array_merge(["id" => "0", "name" => "Seleccionar"], $resp_combo_lista), "id", "name"),
                    'model' => $resp_lista]);
    }

    public function actionAsignar() {
        $mod_lista = new Lista();
        $lis_id = base64_decode($_GET['lis_id']);
        $per_id = @Yii::$app->session->get("PB_perid");        
        $mod_pg= new Suscriptor();
        
        if (Yii::$app->request->isAjax) {
            
        }        
        return $this->render('asignar', [
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

    public function actionGuardarprogramacion() {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $lista = $data["lista"];
            $plantilla = $data["plantilla"];
            $fecinicio = $data["fecha_inicio"];
            $fecfin = $data["fecha_fin"];
            $horenvio = $data["hora_envio"];        
            $fecha_registro = date(Yii::$app->params["dateTimeByDefault"]);
            $usuario = @Yii::$app->user->identity->usu_id;
            $con = \Yii::$app->db_mailing;
            $transaction = $con->beginTransaction();
            try {
                $mod_lista = new Lista();
                $resp_programacion = $mod_lista->insertarProgramacion($lista, $plantilla, $fecinicio, $fecfin, $horenvio, $usuario, $fecha_registro);
                $pro_id = Yii::$app->db_mailing->getLastInsertID('db_mailing.programacion');
                if ($resp_programacion) {
                    for ($i = 1; $i < 8; $i++) {
                        $dia =  $data["check_dia_".$i];
                        if($dia > 0) {
                            $resp_dia = $mod_lista->insertarDiaProgra($resp_programacion, $dia, $fecha_registro);                            
                        }
                    }
                    $exito = 1;
                }
                if ($exito) {
                    $transaction->commit();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "La infomación ha sido grabada. "),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    echo Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                } else {
                    $transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $mensaje),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    echo Utilities::ajaxResponse('NO_OK', 'Error', Yii::t("jslang", "Error"), false, $message);
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => $ex->getMessage(), Yii::t("notificaciones", "Error al grabar."),
                    "title" => Yii::t('jslang', 'Error'),
                );
                return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), true, $message);
            }
        }
    }

}
