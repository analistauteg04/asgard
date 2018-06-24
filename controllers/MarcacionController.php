<?php

namespace app\controllers;

use Yii;
use app\models\Utilities;
use yii\helpers\ArrayHelper;
//use app\models\NivelInteres;
use app\models\Carrera;
//use app\models\EvaluacionDesempeno;
use app\models\ExpedienteProfesor;
use app\models\MarcacionDocente;
use yii\helpers\Url;
use yii\base\Security;

/**
 * 
 *
 * @author Jefferson Conde
 */
class MarcacionController extends \app\components\CController {

    public function actionIngreso() {
        $per_id = Yii::$app->session->get("PB_perid");
        
         $mod_exprofesor = new ExpedienteProfesor();
         $mod_carrera = new Carrera();
         $mod_marcacion = new MarcacionDocente();        
        
        $resp_persona = $mod_exprofesor->consultarInfopersona($per_id);  
        $arrmateria = $mod_marcacion->consultarMateriaPlanif($per_id, 1);   
        $nombres = $resp_persona["per_pri_nombre"] . " " . $resp_persona["per_seg_nombre"] . " " . $resp_persona["per_pri_apellido"] . " " . $resp_persona["per_seg_apellido"];
        
        if ($resp_persona["per_cedula"]){
            $dni_info = $resp_persona["per_cedula"];
            $tipo_identi = 'CED';            
        }elseif ($resp_persona["per_pasaporte"]){
            $dni_info = $resp_persona["per_pasaporte"];
            $tipo_identi = 'PAS'; 
        } else {
            $dni_info = $resp_persona["per_ruc"];
            $tipo_identi = 'RUC';                 
        }
        
       // $arrprofesor = $mod_exprofesor->consultaProfesorgrid(0);      
           
        return $this->render('ingreso', [
                    'per_id' => $per_id,
                    'profesor' => $nombres,
                    'tipo_identificacion' => $tipo_identi,
                    'identificacion' => $dni_info,
                    'materia' => ArrayHelper::map($arrmateria, "id", "name"),
        ]);
    }
    
     public function actionGuardarmarcacion() {
    //  $periodo = 0;
    //   $bloque = 0;
    //   $grupo = 0;
    //   $mes = 0;
        $per_id = @Yii::$app->session->get("PB_perid");
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            
            $profesor = $data["nombre"];                  
            $identificacion = $data["identificacion"];
            $asignatura = $data["asignatura"];
            //$semana = $data["semana"];
            $fecha= $data["fecha"];
            $hora = $data["hora"];
            

            $usuario = @Yii::$app->user->identity->usu_id;
            $con = \Yii::$app->db_academico;
            
            $transaction = $con->beginTransaction();
            try {
                $mensaje_jco = "Profesor".$profesor." Identif ".$identificacion;
                 
                $mod_marcacion = new MarcacionDocente(); 
                
              
                $resp_ingreso = $mod_marcacion->insertarMarcacionDocente($per_id,$asignatura, $fecha, $fecha);
                 // $exito=1;
               // $edes_id = Yii::$app->db_academico->getLastInsertID('db_academico.evaluacion_desempeno');
                if ($resp_ingreso) {
                    $exito = 1;
                   /* if (!empty($horario)) {
                        for ($i = 0; $i < count($horario); $i++) {
                            //Guardado Datos horario.
                            $hora_inicio = $horario[$i]["hora_inicio"];
                            $hora_fin = $horario[$i]["hora_fin"];
                            $dia = ucwords(strtolower($horario[$i]["semana"]));
                            $res_horario = $mod_evaluacion->insertarHorario($edes_id, $hora_inicio, $hora_fin, $dia, $usuario);
                            if ($res_horario) {
                                $exito = 1;
                            }
                        }
                    }*/
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
                        "wtmessage" => Yii::t("notificaciones", "Error al grabar1." . $mensaje_jco),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    echo Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $mensaje_jco),
                    "title" => Yii::t('jslang', 'Success'),
                );
                echo Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
            }
            return;
        }
    }

}
