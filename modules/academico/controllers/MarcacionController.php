<?php

namespace app\modules\academico\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\Utilities;
use app\modules\academico\models\MatriculadosReprobado;
use app\modules\academico\models\RegistroMarcacion;
use DateTime;

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
        $mod_marcacion = new RegistroMarcacion();
        $arr_historico = $mod_marcacion->consultarRegistroMarcacion();
        return $this->render('index', [
                    'model' => $arr_historico,
                    'arr_periodo' => ArrayHelper::map(array_merge([["id" => "0", "name" => "Todas"], ["id" => "1", "name" => "Periodo 1"]]/* , $periodo */), "id", "name"),
                    'arr_materia' => ArrayHelper::map(array_merge([["id" => "0", "name" => "Todas"], ["id" => "1", "name" => "Materia 1"]]/* , $materia */), "id", "name"),
        ]);
    }

    public function actionSave() {     
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
            if ($accion == 'E') {
                $texto = 'entrada';
            } else {
                $texto = 'salida';
            }
            $ip = \app\models\Utilities::getClientRealIP(); // ip de la maquina
            $con = \Yii::$app->db_academico;
            $transaction = $con->beginTransaction();
            try {
                $mod_marcacion = new RegistroMarcacion();
                // consultar si no ha guardado ya el registro de esta marcacion
                if (!empty($hape_id) && !empty($profesor) && !empty($horario) && !empty($dia) && !empty($fecha) && !empty($accion)) {
                    $cons_marcacion = $mod_marcacion->consultarMarcacionExiste($hape_id, $profesor, $fecha, $accion);
                    if ($cons_marcacion["marcacion"] > 0) {
                        $busqueda = 1;
                    }
                }
                if ($busqueda == 0) {
                    //Guardar Marcacion (iniciar (E) o finalizar (S)). 
                    if ($accion == 'E') {
                        $hora = explode("-", $horario);
                        $hora_inicio = date(Yii::$app->params["dateTimeByDefault"]);
                        $real_inicia = date(Yii::$app->params["dateByDefault"]) . ' ' . $hora[0];
                        $hora_fin = date(Yii::$app->params["dateByDefault"]) . ' ' . $hora[1];
                        $intervalo = date_diff(new DateTime($hora_inicio), new DateTime($real_inicia));
                        $horacalculada = $intervalo->format('%H:%i:%s');
                        list($horas, $minutos, $segundos) = explode(':', $horacalculada);
                        $hora_en_segundos = ($horas * 3600 ) + ($minutos * 60 ) + $segundos;
                        $minutosfinales = $hora_en_segundos / 60;
                        /*\app\models\Utilities::putMessageLogFile('hora actual: ' . $hora_fin);
                        \app\models\Utilities::putMessageLogFile('hota inicia: ' . $hora_inicio);
                         \ \app\models\Utilities::putMessageLogFile('diferencia: ' . $minutosfinales); */
                        if (new DateTime($hora_inicio) < new DateTime($real_inicia)) {
                            $minutosfinales = $minutosfinales * -1;
                        }                      
                        if ($minutosfinales >= -30 && new DateTime($hora_inicio) < new DateTime($hora_fin)) { //SOLO PUEDE MARCAR 30 MINUTOS ANTES DEL INICIO Y UN 1 MINUTO ANTES DEL FINAL
                            $resp_marca = $mod_marcacion->insertarMarcacion($accion, $profesor, $hape_id, $hora_inicio, null, $ip, $usuario);
                            if ($resp_marca) {
                                if ($minutosfinales >= 15) { // AL MARCAR 15 MINUTOS DESPUES ENVIA MENSAJE
                                    $retraso = 'La entrado fue '. round($minutosfinales, 0, PHP_ROUND_HALF_DOWN) . ' después';
                                }
                                $exito = 1;
                            }
                        } else {
                            $exito = 0;
                            $mensaje = ' No puede marcar';
                        }
                    } else {
                        $hora = explode("-", $horario);
                        $hora_fin = date(Yii::$app->params["dateTimeByDefault"]);
                        $real_fin = date(Yii::$app->params["dateByDefault"]) . ' ' . $hora[1];
                        $intervalo = date_diff(new DateTime($hora_fin), new DateTime($real_fin));
                        $horacalculada = $intervalo->format('%H:%i:%s');
                        list($horas, $minutos, $segundos) = explode(':', $horacalculada);
                        $hora_en_segundos = ($horas * 3600 ) + ($minutos * 60 ) + $segundos;
                        $minutosfinales = $hora_en_segundos / 60;
                        if (new DateTime($hora_fin) < new DateTime($real_fin)) {
                            $minutosfinales = $minutosfinales * -1;
                        }
                        /* \app\models\Utilities::putMessageLogFile('dasd: ' . $real_fin);
                          \app\models\Utilities::putMessageLogFile('sdd: ' . $hora_fin); */                    
                        if ($minutosfinales >= 0 && $minutosfinales <= 30) { // SOLO PUEDE MARCAR SALIDA DE A LA HORA DE LA SALIDA Y HASTA 30 MINUTOS DESPUES
                            $cons_marcainicio = $mod_marcacion->consultarMarcacionExiste($hape_id, $profesor, $fecha, 'E');
                            if ($cons_marcainicio["marcacion"] > 0) {
                                $resp_marca = $mod_marcacion->insertarMarcacion($accion, $profesor, $hape_id, null, $hora_fin, $ip, $usuario);
                            }
                            if ($resp_marca) {
                                $exito = 1;
                            } else {
                                $exito = 0;
                                $mensaje = ' No ha marcado aún el inicio, por lo que no puede finalizar';
                            }
                        } else {
                            $exito = 0;
                            $mensaje = ' No puede marcar';
                        }
                    }
                    if ($exito) {
                        $mensaje = 'Ha registrado la hora de ' . $texto. ' '.$retraso;
                        $transaction->commit();
                        $message = array(
                            "wtmessage" => Yii::t("notificaciones", "La infomación ha sido grabada. " . $mensaje),
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

                    $mensaje = 'Ya registro la ' . $texto . ' de esta materia';
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
