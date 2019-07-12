<?php

namespace app\modules\repositorio\controllers;

use Yii;
use app\models\Utilities;
use yii\helpers\ArrayHelper;
use app\models\Empresa;
use app\models\ExportFile;
use \app\models\Persona;
use \app\modules\repositorio\models\DocumentoRepositorio;
use \app\modules\repositorio\models\Funcion;
use \app\modules\repositorio\models\Componente;

class RepositorioController extends \app\components\CController {
    public function actionIndex() {
        $mod_repositorio = new DocumentoRepositorio();      
        $mod_categoria = new Funcion();
        $mod_componente = new Componente();
        $data = Yii::$app->request->get();
        if ($data['PBgetFilter']) {
            $arrSearch["lista"] = $data['lista'];
            //$resp_lista = $mod_repositorio->consultarLista($arrSearch);
        } else {
            //$resp_lista = $mod_repositorio->consultarLista();
        }
        $arr_categoria = $mod_categoria->consultarFuncion();
        $arr_componente = $mod_componente->consultarComponente(1);
        return $this->render('index', [
                'arr_categoria' => ArrayHelper::map($arr_categoria, "id", "value"), //array("1" => Yii::t("formulario", "Docencia"), "2" => Yii::t("formulario", "Condiciones Institucionales")),
                'arr_componente' => ArrayHelper::map($arr_componente, "id", "value"), 
                'arr_estandar' => array("1" => Yii::t("formulario", "Estándar 1"), "2" => Yii::t("formulario", "Estándar 2")),
                //'model' => null,
               ]);
    }  
    public function actionCargar() {
        $mod_componente = new Componente();
        
        $arr_componente = $mod_componente->consultarComponente(1);
        $arr_funcion = $mod_componente->consultarComponente(1);
        $arr_modelos = $mod_componente->consultarComponente(1);
        return $this->render('cargar', [              
                    'arr_componentes' => ArrayHelper::map($arr_componente, "id", "value"), 
                    'arr_funciones' => ArrayHelper::map($arr_funcion, "id", "value"), 
                    'arr_modelos' => ArrayHelper::map($arr_funcion, "id", "value"), 
               ]);
    }  
}
