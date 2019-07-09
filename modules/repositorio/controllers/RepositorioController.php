<?php

namespace app\modules\repositorio\controllers;

use Yii;
use app\models\Utilities;
use yii\helpers\ArrayHelper;
use app\models\Empresa;
use app\models\ExportFile;
use \app\models\Persona;
use \app\modules\repositorio\models\DocumentoRepositorio;

class RepositorioController extends \app\components\CController {
    public function actionIndex() {
        $mod_repositorio = new DocumentoRepositorio();
        $data = Yii::$app->request->get();
        if ($data['PBgetFilter']) {
            $arrSearch["lista"] = $data['lista'];
            //$resp_lista = $mod_repositorio->consultarLista($arrSearch);
        } else {
            //$resp_lista = $mod_repositorio->consultarLista();
        }
        return $this->render('index', [
                'arr_categoria' => array("1" => Yii::t("formulario", "Docencia"), "2" => Yii::t("formulario", "Condiciones Institucionales")),
                'arr_componente' => array("1" => Yii::t("formulario", "Profesorado"), "2" => Yii::t("formulario", "Estudiantado")),
                'arr_estandar' => array("1" => Yii::t("formulario", "Estándar 1"), "2" => Yii::t("formulario", "Estándar 2")),
                //'model' => null,
               ]);
    }    
}
