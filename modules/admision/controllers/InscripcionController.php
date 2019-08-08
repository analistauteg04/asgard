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
use app\modules\admision\models\InscritoMaestria;
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
            if (isset($data["getprovincias"])) {
                $provincias = Provincia::find()->select("pro_id AS id, pro_nombre AS name")->where(["pro_estado_logico" => "1", "pro_estado" => "1", "pai_id" => $data['pai_id']])->asArray()->all();
                $message = array("provincias" => $provincias);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
            if (isset($data["getcantones"])) {
                $cantones = Canton::find()->select("can_id AS id, can_nombre AS name")->where(["can_estado_logico" => "1", "can_estado" => "1", "pro_id" => $data['prov_id']])->asArray()->all();
                $message = array("cantones" => $cantones);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
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

    public function actionSave() {
        $mod_inscrito = new InscritoMaestria();
        $user_id = @Yii::$app->session->get("PB_iduser");
        $fecha_ingreso = date(Yii::$app->params["dateTimeByDefault"]);
        if (Yii::$app->request->isAjax) {
            $con = \Yii::$app->db_crm;
            $data = Yii::$app->request->post();
            $items = $data["dataItems"]; // variable que toma todo lo del grid
            $transaction = $con->beginTransaction();
            try {
                if (!empty($items)) {
                    for ($i = 0; $i < count($items); $i++) {
                        $item_ingreso = $mod_inscrito->insertarInscritoMaestria($items[$i]["cemp_id"], $items[$i]["gint_id"], $items[$i]["pai_id"], $items[$i]["pro_id"], $items[$i]["can_id"], $items[$i]["imae_tipo_documento"], $items[$i]["imae_documento"], $items[$i]["imae_primer_nombre"], $items[$i]["imae_segundo_nombre"], $items[$i]["imae_primer_apellido"], $items[$i]["imae_segundo_apellido"], $items[$i]["imae_revisar_urgente"], $items[$i]["imae_cumple_requisito"], $items[$i]["imae_agente"], $items[$i]["imae_fecha_inscripcion"], $items[$i]["imae_fecha_pago"], $items[$i]["imae_pago_inscripcion"], $items[$i]["imae_valor_maestria"], $items[$i]["fpag_id"], $items[$i]["imae_estado_pago"], $items[$i]["imae_convenios"], $user_id, $fecha_ingreso);
                        if ($item_ingreso > 0) {
                            $transaction->commit();
                            $mensaje = "Se ha guardado exitosamente sus registros.";
                            $message = array(
                                "wtmessage" => Yii::t("notificaciones", $mensaje),
                                "title" => Yii::t('jslang', 'Success'),
                            );
                            return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                        } else {
                            $transaction->rollBack();
                            $message = array(
                                "wtmessage" => $ex->getMessage(), Yii::t("notificaciones", "Error al grabar."),
                                "title" => Yii::t('jslang', 'Error'),
                                "estado" => 0,
                            );
                            return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), true, $message);
                        }
                    }
                } else {
                    $mensaje = "No ha ingresado ninugún item al grid.";
                }
            } catch (Exception $ex) {
                $transaction->rollBack();
                $message = array(
                    "wtmessage" => $ex->getMessage(), Yii::t("notificaciones", "Error al grabar."),
                    "title" => Yii::t('jslang', 'Error'),
                    "estado" => 0,
                );
                return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), true, $message);
            }
        }
    }

}
