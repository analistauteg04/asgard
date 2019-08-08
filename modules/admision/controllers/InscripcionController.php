<?php

namespace app\modules\admision\controllers;
use app\modules\admision\models\ConvenioEmpresa;
use app\modules\academico\Module as academico;
use app\modules\financiero\Module as financiero;
use Yii;
use yii\helpers\Url;
use yii\base\Exception;
use yii\helpers\ArrayHelper;

academico::registerTranslations();
financiero::registerTranslations();

class InscripcionController extends \app\components\CController {
    public function actionNew() {               
        $mod_conempresa = new ConvenioEmpresa();
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            /*if (isset($data["getuacademias"])) {
                $data_u_acad = $mod_unidad->consultarUnidadAcademicasEmpresa($data["empresa_id"]);
                $message = array("unidad_academica" => $data_u_acad);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }*/
            
            
        }
        /*$arr_unidadac = $mod_unidad->consultarUnidadAcademicasEmpresa($emp_id);
        $arr_modalidad = $mod_modalidad->consultarModalidad(1, 1);
        $arr_metodos = $mod_metodo->consultarMetodoIngNivelInt($arr_unidadac[0]["id"]);
        $arr_carrera = $modcanal->consultarCarreraModalidad(1, 1);
        //Descuentos y precios.
        $resp_item = $modItemMetNivel->consultarXitemPrecio(1, 1, 1, 2, 1);
        $arr_descuento = $modDescuento->consultarDesctoxitem($resp_item["ite_id"]);*/
        $arr_convempresa = $mod_conempresa->consultarConvenioEmpresa();
        return $this->render('new', [                   
                    //"arr_item" => ArrayHelper::map(array_merge(["id" => "0", "name" => "Seleccionar"], $resp_item), "id", "name"), //ArrayHelper::map($resp_item, "id", "name"),                   
                    "arr_convenio_empresa" => ArrayHelper::map($arr_convempresa, "id", "name"),
        ]);
    }
}

