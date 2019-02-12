<?php

namespace app\modules\academico\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\Utilities;
use app\modules\academico\models\MatriculadosReprobado;
use app\modules\academico\models\RegistroMarcacion;

class MarcacionController extends \app\components\CController {

    public function actionMarcacion() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $dia = date("w", strtotime(date("Y-m-d")));
        $mod_marcacion = new RegistroMarcacion();
        $arr_materia = $mod_marcacion->consultarMateriasMarcabyPro($per_id, $dia);
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
        //$per_id = @Yii::$app->session->get("PB_perid");
        $usuario = @Yii::$app->session->get("PB_iduser");
        $busqueda = 0;
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $accion = $data["accion"];
            $profesor = $data["profesor"];
            $hape_id = $data["hape_id"];    
            $horario = $data["horario"];
            $dia = $data["dia"];
            $fecha = date(Yii::$app->params["dateByDefault"]); // solo envia Y-m-d
            $ip = \app\models\Utilities::getClientRealIP(); // ip de la maquina
            $con = \Yii::$app->db_academico; 
            $transaction = $con->beginTransaction();
            try {
                $mod_marcacion = new RegistroMarcacion();
                // consultar si no ha guardado ya el registro de esta marcacion
                if (!empty($hape_id) && !empty($profesor) && !empty($horario) && !empty($dia) && !empty($fecha)) {
                    $cons_marcacion = $mod_marcacion->consultarMarcacionExiste($hape_id, $profesor, $dia, $fecha);
                    if ($cons_marcacion["marcacion"] > 0) {
                        $busqueda = 1;
                    }
                }
                if ($busqueda == 0) {
                    //Guardar Marcacion (iniciar (E) o finalizar (S)). 
                    if ($accion == 'E') {
                        $hora_inicio = date(Yii::$app->params["dateTimeByDefault"]); 
                        $resp_marca = $mod_marcacion->insertarMarcacion($accion, $profesor, $hape_id, $hora_inicio, null, $ip, $usuario);
                        if ($resp_marca) {
                            $exito = 1;
                        }
                    } else {
                        $hora_fin = date(Yii::$app->params["dateTimeByDefault"]);
                        $resp_marca = $mod_marcacion->insertarMarcacion($accion, $profesor, $hape_id, $hora_inicio, null, $ip, $usuario);
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
