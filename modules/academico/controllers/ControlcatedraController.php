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

}
