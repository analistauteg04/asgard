<?php

namespace app\modules\marcacionhistorico\controllers;

use Yii;
use app\models\ExportFile;
use yii\helpers\ArrayHelper;
use app\models\Utilities;
use app\modules\academico\models\PeriodoAcademicoMetIngreso;
use app\modules\academico\models\RegistroMarcacion;
use DateTime;
use app\modules\admision\Module as admision;
use app\modules\academico\Module as academico;
use app\modules\academico\models\Modalidad;
use app\modules\academico\models\UnidadAcademica;
use app\modules\marcacionhistorico\models\RegistroMarcacionHistorial;

admision::registerTranslations();

class MarcacionhistoricoController extends \app\components\CController {

    public function actionIndex() {
        $mod_marcacion = new RegistroMarcacionHistorial();
        $mod_periodo = new PeriodoAcademicoMetIngreso();
        $periodo = $mod_periodo->consultarPeriodoAcademico();
        $data = Yii::$app->request->get();
        if ($data['PBgetFilter']) {
            $arrSearch["profesor"] = $data['profesor'];
            $arrSearch["materia"] = $data['materia'];
            $arrSearch["f_ini"] = $data['f_ini'];
            $arrSearch["f_fin"] = $data['f_fin'];
            $arrSearch["periodo"] = $data['periodo'];
            $arr_historico = $mod_marcacion->consultarMarcacionHistorica($arrSearch);
            return $this->render('index-grid', [
                        'model' => $arr_historico,
            ]);
        } else {
            $arr_historico = $mod_marcacion->consultarMarcacionHistorica($arrSearch);
        }
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
        }
        return $this->render('index', [
                   'model' => $arr_historico,
                    'arr_periodo' => ArrayHelper::map(array_merge([["id" => "0", "name" => "Todas"]], $periodo), "id", "name"),
        ]);
    } 
    
    public function actionCargarmarcaciones() {
        $per_id = @Yii::$app->session->get("PB_perid");
        Utilities::putMessageLogFile("llego 1");
        //$mod_gestion = new Oportunidad();
        if (Yii::$app->request->isAjax) {
            Utilities::putMessageLogFile("llego 2");
            /*$data = Yii::$app->request->post();
            if ($data["upload_file"]) {
                if (empty($_FILES)) {
                    return json_encode(['error' => Yii::t("notificaciones", "Error to process File {file}. Try again.", ['{file}' => basename($files['name'])])]);
                }
                //Recibe Parámetros
                $files = $_FILES[key($_FILES)];
                $arrIm = explode(".", basename($files['name']));
                $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                if ($typeFile == 'xlsx' || $typeFile == 'csv' || $typeFile == 'xls') {
                    $dirFileEnd = Yii::$app->params["documentFolder"] . "leads/" . $data["name_file"] . "." . $typeFile;
                    Utilities::putMessageLogFile($dirFileEnd);
                    $status = Utilities::moveUploadFile($files['tmp_name'], $dirFileEnd);
                    if ($status) {
                        return true;
                    } else {
                        return json_encode(['error' => Yii::t("notificaciones", "Error to process File {file}. Try again.", ['{file}' => basename($files['name'])])]);
                    }
                }
            }*/
            /*if ($data["procesar_file"]) {
                $carga_archivo = $mod_gestion->CargarArchivo($data["archivo"], $data["emp_id"], $data["tipo_proceso"]);
                if ($carga_archivo['status']) {
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Archivo procesado correctamente." . $carga_archivo['data']),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Success"), false, $message);
                } else {
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error al procesar el archivo. " . $carga_archivo['message']),
                        "title" => Yii::t('jslang', 'Error'),
                    );
                    return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), true, $message);
                }
                return;
            }*/
        } else {
            return $this->render('cargarmarcaciones', []);
        }
        //return $this->render('cargarmarcaciones', []);
    }


}
