<?php

namespace app\modules\admision\controllers;
use app\modules\admision\models\ConvenioEmpresa;
use app\modules\academico\Module as academico;
use app\modules\financiero\Module as financiero;
use app\models\Pais;
use app\models\Provincia;
use app\models\Canton;
use app\modules\financiero\models\FormaPago;
use app\modules\admision\models\GrupoIntroductorio;
use Yii;
use yii\helpers\Url;
use yii\base\Exception;
use yii\helpers\ArrayHelper;

academico::registerTranslations();
financiero::registerTranslations();

class InscripcionController extends \app\components\CController {
    public function actionNew() {               
        $mod_conempresa = new ConvenioEmpresa();
        $mod_fpago = new FormaPago();
        $mod_grupo = new GrupoIntroductorio();
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            /*if (isset($data["getuacademias"])) {
                $data_u_acad = $mod_unidad->consultarUnidadAcademicasEmpresa($data["empresa_id"]);
                $message = array("unidad_academica" => $data_u_acad);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }*/                        
        }
        $arr_pais_dom = Pais::find()->select("pai_id AS id, pai_nombre AS value")->where(["pai_estado_logico" => "1", "pai_estado" => "1"])->asArray()->all();
        $pais_id = 1; //Ecuador
        $arr_prov_dom = Provincia::provinciaXPais($pais_id);
        $arr_ciu_dom = Canton::cantonXProvincia($arr_prov_dom[0]["id"]);                
        $arr_convempresa = $mod_conempresa->consultarConvenioEmpresa();
        $arr_forma_pago = $mod_fpago->consultarFormaPago();
        $arr_grupo = $mod_grupo->consultarGrupoIntroductorio();
        return $this->render('new', [                   
                    //"arr_item" => ArrayHelper::map(array_merge(["id" => "0", "name" => "Seleccionar"], $resp_item), "id", "name"), //ArrayHelper::map($resp_item, "id", "name"),                   
                    "arr_convenio_empresa" => ArrayHelper::map($arr_convempresa, "id", "name"),
                    "arr_pais_dom" => ArrayHelper::map($arr_pais_dom, "id", "value"),
                    "arr_prov_dom" => ArrayHelper::map($arr_prov_dom, "id", "value"),
                    "arr_ciu_dom" => ArrayHelper::map($arr_ciu_dom, "id", "value"),
                    "arr_tipos_dni" => array("1" => Yii::t("formulario", "DNI Document"), "2" => Yii::t("formulario", "RUC"), "3" => Yii::t("formulario", "Passport")),
                    "arr_cumple_requisito" => array("1" => Yii::t("formulario", "Si"), "2" => Yii::t("formulario", "No")),
                    "arr_estado_pago" => array("1" => Yii::t("formulario", "Pagado"), "2" => Yii::t("formulario", "No Pagado"), "3" => Yii::t("formulario", "Pagado Totalidad Maestria")),
                    "arr_agente" => array("1" => Yii::t("formulario", "Aabad"), "2" => Yii::t("formulario", "Caguilar"), "3" => Yii::t("formulario", "Cmacias"), "4" => Yii::t("formulario", "Ebayona"), "5" => Yii::t("formulario", "Jmora"), "6" => Yii::t("formulario", "Sholguin")),
                    "arr_forma_pago" => ArrayHelper::map($arr_forma_pago, "id", "value"),
                    "arr_grupo" => ArrayHelper::map($arr_grupo, "id", "value"),
        ]);
    }
}

