<?php

namespace app\modules\academico\controllers;

use Yii;
use app\models\ExportFile;
use app\components\CController;
use app\modules\academico\models\Planificacion;
use app\modules\academico\models\Modalidad;
use app\models\Persona;
use yii\helpers\ArrayHelper;
use yii\data\ArrayDataProvider;
use yii\base\Exception;
use app\models\Utilities;
use yii\helpers\VarDumper;
use app\modules\academico\Module as academico;
use app\modules\academico\models\PlanificacionEstudiante;

academico::registerTranslations();

class PlanificacionController extends \app\components\CController {


    public function actionIndex()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->get();
               /* if (isset($data["search"])) { */
                $pla_periodo_academico = $data["pla_periodo_academico"];
                $mod_id = $data["mod_id"];
                $dataPlanificaciones = Planificacion::getAllPlanificacionesGrid($search, $pla_periodo_academico, $mod_id);
                $dataProvider = new ArrayDataProvider([
                    'key' => 'pla_id',
                    'allModels' => $dataPlanificaciones,
                    'pagination' => [
                        'pageSize' => Yii::$app->params["pageSize"],
                    ],
                    'sort' => [
                        'attributes' => ["PeriodoAcademico"],
                    ],
                ]);
                return $this->renderPartial('index-grid', [
                    "model" => $dataProvider,
                ]);
          /*   } */
        }
        /*
        $arr_pla = Planificacion::find()
            ->select(['ROW_NUMBER() OVER (ORDER BY pla_periodo_academico) pla_id', 'pla_periodo_academico'])
            ->where('pla_estado_logico = 1 and pla_estado = 1')
            ->groupBy(['pla_periodo_academico'])
            ->all();
        */
        $arr_pla = Planificacion::getPeriodosAcademico();
        /* print_r($arr_pla); */
        if (count($arr_pla) > 0) {
            $arr_modalidad = Modalidad::findAll(["mod_estado" => 1, "mod_estado_logico" => 1]);
            $pla_periodo_academico = $arr_pla[0]->pla_periodo_academico;
            $mod_id = $arr_modalidad[0]->mod_id;
            $dataPlanificaciones = Planificacion::getAllPlanificacionesGrid(null, $pla_periodo_academico, $mod_id);
            $dataProvider = new ArrayDataProvider([
                'key' => 'pla_id',
                'allModels' => $dataPlanificaciones,
                'pagination' => [
                    'pageSize' => Yii::$app->params["pageSize"],
                ],
                'sort' => [
                    'attributes' => ["Modalidad"],
                ],
            ]);
            return $this->render('index', [
                'arr_pla' => (empty(ArrayHelper::map($arr_pla, "pla_periodo_academico", "pla_periodo_academico"))) ? array(Yii::t("planificacion", "-- Select periodo --")) : (ArrayHelper::map($arr_pla, "pla_periodo_academico", "pla_periodo_academico")),
                'arr_modalidad' => (empty(ArrayHelper::map($arr_modalidad, "mod_id", "mod_nombre"))) ? array(Yii::t("planificacion", "-- Select periodo --")) : (ArrayHelper::map($arr_modalidad, "mod_id", "mod_nombre")),
                'model' => $dataProvider,
                'pla_periodo_academico' => $pla_periodo_academico,
                'mod_id' => $mod_id,
            ]);
        } 
    }

    public function actionUpload() {
        $usu_id = Yii::$app->session->get("PB_iduser");
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if ($data["upload_file"]) {
                if (empty($_FILES)) {
                    return json_encode(['error' => Yii::t("notificaciones", "Error to process File ". basename($files['name']) .". Try again.")]);
                }
                //Recibe Parámetros
                $files = $_FILES[key($_FILES)];
                $arrIm = explode(".", basename($files['name']));
                $namefile= substr_replace($data["name_file"], $data["mod_id"], 14, 0);
                $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                if ($typeFile == 'xlsx' || $typeFile == 'csv' || $typeFile == 'xls') {
                    $dirFileEnd = Yii::$app->params["documentFolder"] . "planificacion/" . $namefile . "." . $typeFile;
                    $status = Utilities::moveUploadFile($files['tmp_name'], $dirFileEnd);
                    if ($status) {
                        return true;                        
                    } else {
                        return json_encode(['error' => Yii::t("notificaciones", "Error to process File ". basename($files['name']) .". Try again.")]);
                    }
                } else {                    
                    return json_encode(['error' => Yii::t("notificaciones", "Error to process File ". basename($files['name']) .". Try again.")]);
                }
            }

            if ($data["procesar_file"]) {
                ini_set('memory_limit', '256M');
                $per_id = Yii::$app->session->get("PB_perid");
                $model_planificacionEstudiante = new PlanificacionEstudiante();
                try {
                    $namefile= substr_replace($data["archivo"], $data["modalidad"], 14, 0);
                    $path = "planificacion/" . $namefile;
                    $modelo_planificacion = new Planificacion();
                    $modelo_planificacion->mod_id = $data["modalidad"];
                    $modelo_planificacion->per_id = $per_id;
                    $modelo_planificacion->pla_fecha_inicio = $data["fechaInicio"];
                    $modelo_planificacion->pla_fecha_fin = $data["fechaFin"];
                    $modelo_planificacion->pla_periodo_academico = $data["periodoAcademico"];
                    $modelo_planificacion->pla_path = $path;
                    $modelo_planificacion->pla_estado = "1";
                    $modelo_planificacion->pla_estado_logico = "1";
                    if($modelo_planificacion->save()){
                       /*  return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), true, "guardado"); */
                        $pla_id = $modelo_planificacion->getPrimaryKey();
                        $carga_archivo = $model_planificacionEstudiante->processFile($namefile,$pla_id);
                       /*  return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), true, $carga_archivo); */
                        if ($carga_archivo['status']) {
                            $message = array(
                                "wtmessage" => Yii::t("notificaciones", "Archivo procesado correctamente. " . $carga_archivo['message']),
                                "title" => Yii::t('jslang', 'Success'),                            
                            );
                            return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Success"), false, $message);
                        } else {
                            /* $modelo_planificacion_saved = Planificacion::findOne($pla_id);
                            $modelo_planificacion_saved->delete(); */
                            $message = array(
                                "wtmessage" => Yii::t("notificaciones", "Error al procesar el archivo. " . $carga_archivo['message']),
                                "title" => Yii::t('jslang', 'Error'),                               
                            );
                            
                            return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), true, $message);                            
                        }
                    }
                } catch (Exception $ex) {
                    /* $modelo_planificacion_saved = Planificacion::findOne($pla_id);
                    $modelo_planificacion_saved->delete(); */
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error al procesar el archivo."),
                        "title" => Yii::t('jslang', 'Error'),                        
                    );
                    return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), true, $message);
                }                                
            };
        } else {
            $arr_modalidad = Modalidad::findAll(["mod_estado" => 1, "mod_estado_logico" => 1]);
            return $this->render('cargar_planificacion',[
                'arr_modalidad' => (empty(ArrayHelper::map($arr_modalidad, "mod_id", "mod_nombre"))) ? array(Yii::t("planificacion", "-- Select planificacion --")) : (ArrayHelper::map($arr_modalidad, "mod_id", "mod_nombre"))
            ]);
        }        
    }

    public function actionDescargarplanificacion()
    {
        $report = new ExportFile();

        $data = Yii::$app->request->get();

        $pla_id = $data['pla_id'];
        $planificacion = Planificacion::findOne(["pla_id" => $pla_id]);
        $file = Yii::$app->basePath . Yii::$app->params['documentFolder'] . $planificacion->pla_path;
        if (file_exists($file)) {
            Yii::$app->response->sendFile($file);
        } else {
            /**en caso de que no */
        }
        return;
    }

    public function actionSave() {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            try {
                $fecha_inicio = $data["pla_fecha_inicio"];
                $fecha_fin = $data["pla_fecha_fin"];
                $periodo_academico = $data["pla_periodo_academico"];
                $estado = $data["estado"];
                $mod_id = $data["mod_id"];
                
                $planificacion_model = new Planificacion();
                $planificacion_model->pla_fecha_inicio = $fecha_inicio; 
                $planificacion_model->pla_fecha_fin = $fecha_fin;               
                $planificacion_model->pla_periodo_academico = $periodo_academico;
                $planificacion_model->mod_id = $mod_id;
                $planificacion_model->pla_estado = $estado;
                $planificacion_model->pla_estado_logico = "1";
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Your information was successfully saved."),
                    "title" => Yii::t('jslang', 'Success'),
                );
                if ($planificacion_model->save()) {
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                } else {
                    throw new Exception('Error SubModulo no creado.');
                }
            } catch (Exception $ex) {
                $message = array(
                    "wtmessage" => Yii::t('notificaciones', 'Your information has not been saved. Please try again.'),
                    "title" => Yii::t('jslang', 'Error'),
                );
                return Utilities::ajaxResponse('NOOK', 'alert', Yii::t('jslang', 'Error'), 'true', $message);
            }
        }
    }

}




