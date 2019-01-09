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
        $resp_combo_lista = $mod_lista->consultarListaProgramacion();

        return $this->render('index', [
                    "arr_lista" => ArrayHelper::map($resp_combo_lista, "id", "name"),
                    'model' => $resp_lista]);
    }

    public function actionListasubscriptores() {

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

    public function actionGuardarprogramacion() {
        $mod_lista = new Lista();
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $lista = $data["lista"];
            $plantilla = $data["plantilla"];
            $fecinicio = $data["fecha_inicio"];
            $fecfin = $data["fecha_fin"];
            $horenvio = $data["hora_envio"];
            $fecha_registro = date(Yii::$app->params["dateTimeByDefault"]);
            $usuario = @Yii::$app->user->identity->usu_id;
            $con = \Yii::$app->db_crm;
            $transaction = $con->beginTransaction();
            try {
                $resp_programacion = $mod_lista->insertarProgramacion($lista, $plantilla, $fecinicio, $fecfin, $horenvio, $fecha_registro, $usuario);
                if ($resp_programacion) {
                    $exito = 1;
                }
                if ($exito) {
                    $transaction->commit();
                } else {
                    $transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error al grabar."),
                        "title" => Yii::t('jslang', 'Error'),
                    );
                    return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), false, $message);
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
