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

}
