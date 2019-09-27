<?php

namespace app\modules\academico\controllers;

use Yii;
use app\modules\academico\models\Admitido;
use app\modules\academico\models\EstudioAcademico;
use yii\helpers\ArrayHelper;
use app\models\Utilities;
use app\modules\academico\models\Modalidad;
use app\modules\academico\models\UnidadAcademica;
use app\modules\academico\models\PromocionPrograma;
use app\modules\admision\models\Oportunidad;
use app\modules\academico\Module as academico;
use app\modules\financiero\Module as financiero;
use app\modules\admision\Module as admision;


academico::registerTranslations();
admision::registerTranslations();
financiero::registerTranslations();

class MatriculacionposgradosController extends \app\components\CController {

    public function actionIndex() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $mod_programa = new EstudioAcademico();
        $mod_modalidad = new Modalidad();
        $mod_unidad = new UnidadAcademica();
        $modcanal = new Oportunidad();
        $data = Yii::$app->request->get();
        if ($data['PBgetFilter']) {
            $arrSearch["search"] = $data['search'];           
            $arrSearch["unidad"] = $data['unidad'];
            $arrSearch["modalidad"] = $data['modalidad'];
            $arrSearch["programa"] = $data['programa'];         
            $mod_promocion = PromocionPrograma::getPromocion($arrSearch);
            return $this->renderPartial('index-grid', [
                        "model" => $mod_promocion,
            ]);
        } else {
            $mod_promocion = PromocionPrograma::getPromocion();
        }
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["op"]) && $data["op"] == '1') {
                
            }
            if (isset($data["getmodalidad"])) {
                $modalidad = $mod_modalidad->consultarModalidad($data["uni_id"], 1);
                $message = array("modalidad" => $modalidad);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
            if (isset($data["getprograma"])) {
                $programa = $modcanal->consultarCarreraModalidad($data["unidada"], $data["moda_id"]);
                $message = array("programa" => $programa);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
        }
        $arr_unidad = $mod_unidad->consultarUnidadAcademicasEmpresa(1);
        $arr_modalidad = $mod_modalidad->consultarModalidad($arr_unidad[1]["id"], 1);
        $arr_programa1 = $modcanal->consultarCarreraModalidad($arr_unidad[1]["id"], $arr_modalidad[0]["id"]);
        $arrProgramas = ArrayHelper::map(array_merge([["id" => "0", "value" => Yii::t("formulario", "Grid")]], $mod_programa->consultarCarrera()), "id", "value");
        return $this->render('index', [
                    'model' => $mod_promocion,
                    'arrProgramas' => $arrProgramas,
                    'arr_unidad' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_unidad), "id", "name"),
                    'arr_modalidad' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_modalidad), "id", "name"),
                    'arr_programa1' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_programa1), "id", "name"),
        ]);
    }

}
