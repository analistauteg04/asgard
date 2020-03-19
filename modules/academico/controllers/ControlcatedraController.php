<?php

namespace app\modules\academico\controllers;

use Yii;
use app\models\ExportFile;
use yii\helpers\ArrayHelper;
use app\models\Utilities;
use app\modules\academico\models\PeriodoAcademicoMetIngreso;
use app\modules\academico\models\EstudioAcademico;
use app\modules\academico\models\ControlCatedra;
use app\modules\admision\models\Oportunidad;
use DateTime;
use app\modules\admision\Module as admision;
use app\modules\academico\Module as academico;
use app\modules\academico\models\Modalidad;
use app\modules\academico\models\UnidadAcademica;

admision::registerTranslations();

class ControlcatedraController extends \app\components\CController {

    public function actionNew() {
        $hape_id = $_GET['hape_id'];
        $modcanal = new Oportunidad();
        $mod_modalidad = new Modalidad();
        $mod_unidad = new UnidadAcademica();
        $mod_control = new ControlCatedra();
        $data = Yii::$app->request->get();
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["getmodalidad"])) {
                $modalidad = $mod_modalidad->consultarModalidad($data["uni_id"], 1);
                $message = array("modalidad" => $modalidad);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
            if (isset($data["getcarrera"])) {
                $carrera = $modcanal->consultarCarreraModalidad($data["unidada"], $data["moda_id"]);
                $message = array("carrera" => $carrera);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
        }
        $arr_actividad = $mod_control->consultarActividadevaluacion();
        $arr_valor = $mod_control->consultarValordesarrollo();
        $arr_datahorario = $mod_control->consultarHorarioxhapeid($hape_id, true);
        $arr_unidad = $mod_unidad->consultarUnidadAcademicasEmpresa(1);
        $arr_modalidad = $mod_modalidad->consultarModalidad($arr_datahorario[0]["unidad"], 1);
        $arr_carrera = $modcanal->consultarCarreraModalidad($arr_datahorario[0]["unidad"], $arr_datahorario[0]["modalidad"]);
        return $this->render('new', [
                    'arr_actividad' => $arr_actividad,
                    "arr_valor" => $arr_valor,
                    "arr_datahorario" => $arr_datahorario,
                    "arr_unidad" => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Select")]], $arr_unidad), "id", "name"),
                    "arr_modalidad" => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Select")]], $arr_modalidad), "id", "name"),
                    "arr_carrera" => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Select")]], $arr_carrera), "id", "name"),
        ]);
    }
    
    public function actionIndex() {        
        $mod_modalidad = new Modalidad();
        $mod_unidad = new UnidadAcademica();
        $mod_control = new ControlCatedra();        
        $mod_periodo = new PeriodoAcademicoMetIngreso();
        $periodo = $mod_periodo->consultarPeriodoAcademico();
        $data = Yii::$app->request->get();
        if ($data['PBgetFilter']) {
            $arrSearch["profesor"] = $data['profesor'];
            $arrSearch["materia"] = $data['materia'];
            $arrSearch["f_ini"] = $data['f_ini'];
            $arrSearch["f_fin"] = $data['f_fin'];
            $arrSearch["periodo"] = $data['periodo'];
            $arrSearch["unidad"] = $data['unidad'];
            $arrSearch["modalidad"] = $data['modalidad'];
            $arrSearch["estado"] = $data['estado'];
            $arr_data = $mod_control->consultarControlCatedra($arrSearch);
            return $this->render('index-grid', [
                        'model' => $arr_data,
            ]);
        } else {
            $arrSearch["periodo"] = $periodo[0]["id"];
            \app\models\Utilities::putMessageLogFile('periodo:' . $arrSearch["periodo"]);
            $arr_data = $mod_control->consultarControlCatedra($arrSearch);
        }
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
        }  
        $unidad = $mod_unidad->consultarUnidadAcademicasEmpresa(1);
        $modalidad = $mod_modalidad->consultarModalidad(1, 1);
        return $this->render('index', [                    
                    'model' => $arr_data,
                    'arr_periodo' => ArrayHelper::map(array_merge([["id" => "0", "name" => "Todas"]], $periodo), "id", "name"),
                    'arr_unidad' => ArrayHelper::map(array_merge([["id" => "0", "name" => "Todas"]], $unidad), "id", "name"),
                    'arr_modalidad' => ArrayHelper::map(array_merge([["id" => "0", "name" => "Todas"]], $modalidad), "id", "name"),
                    'arr_estado' => array("0" => Yii::t("formulario", "Todas"), "1" => Yii::t("formulario", "Registrado"), "2" => Yii::t("formulario", "Sin Registrar")),
        ]);
    }

}
