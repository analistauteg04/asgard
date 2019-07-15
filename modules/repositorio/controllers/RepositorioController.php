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
use \app\modules\repositorio\models\Modelo;
use \app\modules\repositorio\models\Estandar;

class RepositorioController extends \app\components\CController {

    public function actionIndex() {
        $mod_repositorio = new DocumentoRepositorio();
        $mod_categoria = new Funcion();
        $mod_componente = new Componente();
        $mod_modelo = new Modelo();
        $mod_estandar = new Estandar();
        $data = Yii::$app->request->get();

        if ($data['PBgetFilter']) {
            $arrSearch["lista"] = $data['lista'];
            $resp_listado = $mod_repositorio->consultarDocumentos($arrSearch);
        } else {
            $resp_listado = $mod_repositorio->consultarDocumentos();
        }
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["get_funciones"])) {
                $resp_funciones = $mod_categoria->consultarFuncion($data["mod_id"]);
                $message = array("funciones" => $resp_funciones);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
            if (isset($data["get_componentes"])) {
                //\app\models\Utilities::putMessageLogFile('fun_id:' . $data["fun_id"]);
                $resp_componente = $mod_componente->consultarComponente($data["fun_id"]);
                $message = array("componentes" => $resp_componente);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
            if (isset($data["get_estandares"])) {
                $resp_estandares = $mod_estandar->consultarEstandar($data["fun_id"], $data["comp_id"]);
                $message = array("estandares" => $resp_estandares);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
        }
        $arr_modelo = $mod_modelo->consultarModelo();
        $arr_categoria = $mod_categoria->consultarFuncion(2);
        $arr_componente = $mod_componente->consultarComponente(1);
        $arr_estandar = $mod_estandar->consultarEstandar(1, 1);

        return $this->render('index', [
                    'arr_modelo' => ArrayHelper::map($arr_modelo, "id", "value"),
                    'arr_categoria' => ArrayHelper::map($arr_categoria, "id", "name"), //array("1" => Yii::t("formulario", "Docencia"), "2" => Yii::t("formulario", "Condiciones Institucionales")),
                    'arr_componente' => ArrayHelper::map($arr_componente, "id", "name"),
                    'arr_estandar' => ArrayHelper::map($arr_estandar, "id", "name"),
                    'model' => $resp_listado,
        ]);
    }

    public function actionCargar() {
        $mod_componente = new Componente();
        $mod_modelo = new Modelo();
        $mod_estandar = new Estandar();
        $mod_funcion = new Funcion();
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["get_funciones"])) {
                $resp_funciones = $mod_categoria->consultarFuncion($data["mod_id"]);
                $message = array("funciones" => $resp_funciones);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
            if (isset($data["get_funciones"])) {
                $resp_funciones = $mod_funcion->consultarFuncion($data["mod_id"]);
                $message = array("funciones" => $resp_funciones);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
            if (isset($data["get_componentes"])) {
                //\app\models\Utilities::putMessageLogFile('fun_id:' . $data["fun_id"]);
                $resp_componente = $mod_componente->consultarComponente($data["fun_id"]);
                $message = array("componentes" => $resp_componente);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
            if (isset($data["get_estandares"])) {
                $resp_estandares = $mod_estandar->consultarEstandar($data["fun_id"], $data["comp_id"]);
                $message = array("estandares" => $resp_estandares);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
        }
        $arr_componente = $mod_componente->consultarComponente(1);
        $arr_funcion = $mod_funcion->consultarFuncion(2);
        $arr_modelo = $mod_modelo->consultarModelo();
        $arr_estandar = $mod_estandar->consultarEstandar(1, 1);
        return $this->render('cargar', [
                    'arr_componentes' => ArrayHelper::map($arr_componente, "id", "name"),
                    'arr_funciones' => ArrayHelper::map($arr_funcion, "id", "name"),
                    'arr_modelos' => ArrayHelper::map($arr_modelo, "id", "value"),
                    'arr_estandares' => ArrayHelper::map($arr_estandar, "id", "name"),
                    'arr_tipos' => array("1" => Yii::t("formulario", "Private"), "2" => Yii::t("formulario", "Public")),
        ]);
    }

}
