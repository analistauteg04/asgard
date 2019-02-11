<?php

namespace app\modules\academico\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\Utilities;
use app\modules\academico\models\MatriculadosReprobado; // ESTO CAMBIAR QUE NO VA SER DE AQUI LA DATA

class MarcacionController extends \app\components\CController {

    public function actionMarcacion() {
        $mod_admitido = new MatriculadosReprobado();
        $arr_materia = $mod_admitido->consultarMateriasPorUnidadModalidadCarrera(1, 1, 1, '', '');
        return $this->render('marcacion', [
                    'model' => $arr_materia
        ]);
    }

    public function actionIndex() {
        $mod_admitido = new MatriculadosReprobado();
        $arr_materia = $mod_admitido->consultarMateriasPorUnidadModalidadCarrera(1, 1, 1, '', '');
        return $this->render('index', [
                    'model' => $arr_materia,
                    'arr_periodo' => ArrayHelper::map(array_merge([["id" => "0", "name" => "Todas"], ["id" => "1", "name" => "Periodo 1"]]/* , $periodo */), "id", "name"),
                    'arr_materia' => ArrayHelper::map(array_merge([["id" => "0", "name" => "Todas"], ["id" => "1", "name" => "Materia 1"]]/* , $materia */), "id", "name"),
        ]);
    }

    public function actionSave() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $profesor = @Yii::$app->session->get("PB_iduser");
        $busqueda = 0;
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $materia = $data["materia"];
            $horario = $data["horario"];
            $accion = $data["accion"];
            $dia = $data["dia"];
            $fecha = date(Yii::$app->params["dateByDefault"]);
            $ip = \app\models\Utilities::getClientRealIP(); // ip de la maquina
            $con = \Yii::$app->db_academico; //CAMBIAR A BASE QUE ES SI NO ES ACADEMICO OJO
            $transaction = $con->beginTransaction();
            try {
                $mod_marcacion = new MatriculadosReprobado();
                // consultar si no ha guardado ya el registro de esta marcacion
                if (!empty($materia) && !empty($profesor) && !empty($horario) && !empty($dia) && !empty($fecha)) {
                    $cons_marcacion = $mod_marcacion->consultarMarcacionExiste($materia, $profesor, $horario, $fecha);
                    if ($cons_marcacion["marcacion"] > 0) {
                        $busqueda = 1;
                    }
                }
                if ($busqueda == 0) {
                    //Guardar Marcacion (iniciar o finalizar). 
                    if ($accion == 'I') {
                        $hora_inicio = date(Yii::$app->params["TimeByDefault"]); //$data["hora_inicio"];
                        $resp_marca = $mod_marcacion->insertarMarcacion($profesor, $materia, $horario, $dia, $hora_inicio, null, $fecha, $ip);
                        if ($resp_marca) {
                            $exito = 1;
                        }
                    } else {
                        $hora_fin = date(Yii::$app->params["TimeByDefault"]);
                        $resp_marca = $mod_marcacion->insertarMarcacion($profesor, $materia, $horario, $dia, null, $hora_fin, $fecha, $ip);
                        if ($resp_marca) {
                            $exito = 1;
                        }
                    }
                    if ($exito) {
                        $transaction->commit();
                        $message = array(
                            "wtmessage" => Yii::t("notificaciones", "La infomación ha sido grabada. "),
                            "title" => Yii::t('jslang', 'Success'),
                        );
                        return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                    } else {
                        $transaction->rollback();
                        $message = array(
                            "wtmessage" => Yii::t("notificaciones", "Error al grabar. " . $mensaje),
                            "title" => Yii::t('jslang', 'Error'),
                        );
                        return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), true, $message);
                    }
                } else {
                    $mensaje = 'Ya registro el inicio de esta materia';
                    $transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "No se puede guardar la marcacion " . $mensaje),
                        "title" => Yii::t('jslang', 'Error'),
                    );
                    return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), true, $message);
                }
            } catch (Exception $ex) {
                $mensaje = 'Intente nuevamente';
                $transaction->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $mensaje),
                    "title" => Yii::t('jslang', 'Error'),
                );
                return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), true, $message);
            }
            return;
        }
    }

}
