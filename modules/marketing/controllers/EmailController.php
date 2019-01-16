<?php

namespace app\modules\marketing\controllers;

use Yii;
use app\models\Utilities;
use yii\helpers\ArrayHelper;
use app\models\Empresa;
use app\modules\admision\models\Oportunidad;
use app\modules\academico\models\ModuloEstudio;
use app\modules\marketing\models\Lista;
use app\modules\academico\Module as academico;
use app\modules\financiero\Module as financiero;
use app\modules\marketing\models\Suscriptor;
use app\webservices\WsMailChimp;
use app\models\Pais;
use app\models\Provincia;
use app\models\Canton;

academico::registerTranslations();
financiero::registerTranslations();

class EmailController extends \app\components\CController {

    public function actionIndex() {
        $mod_lista = new Lista();
        $data = Yii::$app->request->get();        
        if ($data['PBgetFilter']) {
            $arrSearch["lista"] = $data['lista'];
            \app\models\Utilities::putMessageLogFile('si hay filtro');
            $resp_lista = $mod_lista->consultarLista($arrSearch);
        } else {            
            $resp_lista = $mod_lista->consultarLista();
        }        
        //$resp_combo_lista = $mod_lista->consultarListaProgramacion();
        return $this->render('index', [
                    //"arr_lista" => ArrayHelper::map(array_merge(["id" => "0", "name" => "Seleccionar"], $resp_combo_lista), "id", "name"),
                    'model' => $resp_lista]);
    }

    public function actionAsignar() {
        $mod_lista = new Lista();
        $lis_id = base64_decode($_GET['lis_id']);
        $per_id = @Yii::$app->session->get("PB_perid");        
        $mod_sb= new Suscriptor();
        $lista_model=$mod_lista->consultarListaXID($lis_id);
        $susbs_lista = $mod_sb->consultarSuscriptoresxLista($lis_id);
        if (Yii::$app->request->isAjax) {
            
        }
        return $this->render('asignar', [
            'arr_lista' => $lista_model,
            'arr_estado' => array("Seleccionar", "Subscrito", "No Subscrito"),
            'model' => $susbs_lista,
        ]);
    }

    public function actionProgramacion() {
        $mod_lista = new Lista();
        $muestra = 0;
        $per_id = @Yii::$app->session->get("PB_perid");     
        $lista = base64_decode($_GET["lisid"]);
        $plantilla = $mod_lista->consultarListaTemplate($lista);
        $ingreso = $mod_lista->consultarIngresoProgramacion($lista, $plantilla['id']);
        if ($ingreso['ingresado'] == 0) {
            $muestra = 1;
        }
        $arr_lista = $mod_lista->consultarListaProgramacion();
        return $this->render('programacion', [
                    "arr_lista" => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Select")]], $arr_lista), "id", "name"),
                    "muestra" => $muestra,
        ]);
    }

    public function actionDelete() {
        $mod_lista = new Lista();
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            //$lis_id = $data["list_id"];
            $lis_id = base64_decode($_GET['lis_id']);
            $con = \Yii::$app->db_mailing;
            $transaction = $con->beginTransaction();
            try {
                $resp_listsuscriptor = $mod_lista->inactivaListaSuscriptor($lis_id);
                if ($resp_listsuscriptor) {
                    $resp_lista = $mod_lista->inactivaLista($lis_id);
                    if ($resp_lista) {
                        $exito = '1';
                    }
                }
                if ($exito) {
                    $transaction->commit();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Se ha eliminado la lista exitosamente."),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                } else {
                    $transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error al eliminar."),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error al eliminar."),
                    "title" => Yii::t('jslang', 'Success'),
                );
                return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
            }
        }
    }

    public function actionGuardarprogramacion() {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $lista = base64_decode($data["lista"]);          
            $fecinicio = $data["fecha_inicio"];
            $fecfin = $data["fecha_fin"];
            $horenvio = $data["hora_envio"];
            $fecha_registro = date(Yii::$app->params["dateTimeByDefault"]);
            $usuario = @Yii::$app->user->identity->usu_id;
            $con = \Yii::$app->db_mailing;
            $transaction = $con->beginTransaction();
            try {
                $mod_lista = new Lista();
                $plantilla = $mod_lista->consultarListaTemplate($lista);
                $ingreso = $mod_lista->consultarIngresoProgramacion($lista, $plantilla['id']);
                if ($ingreso['ingresado'] == 0) {
                    $resp_programacion = $mod_lista->insertarProgramacion($lista, $plantilla['id'], $fecinicio, $fecfin, $horenvio, $usuario, $fecha_registro);
                    if ($resp_programacion) {
                        for ($i = 1; $i < 8; $i++) {
                            $dia = $data["check_dia_" . $i];
                            if ($dia > 0) {
                                $resp_dia = $mod_lista->insertarDiaProgra($resp_programacion, $dia, $fecha_registro);
                            }
                        }
                        $exito = 1;
                    }
                    if ($exito) {
                        $transaction->commit();
                        $message = array(
                            "wtmessage" => Yii::t("notificaciones", "La infomación ha sido grabada. "),
                            "title" => Yii::t('jslang', 'Success'),
                        );
                        echo Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                    } else {
                        $transaction->rollback();
                        $message = array(
                            "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $mensaje),
                            "title" => Yii::t('jslang', 'Error'),
                        );
                        echo Utilities::ajaxResponse('NO_OK', 'Error', Yii::t("jslang", "Error"), false, $message);
                    }
                } else {
                    $transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Ya se encuentra una programación ingresada para esta lista."),
                        "title" => Yii::t('jslang', 'Error'),
                    );
                    echo Utilities::ajaxResponse('NO_OK', 'Error', Yii::t("jslang", "Error"), false, $message);
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => $ex->getMessage(), Yii::t("notificaciones", "Error al grabar."),
                    "title" => Yii::t('jslang', 'Error'),
                );
                return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), true, $message);
            }
        }
    }

    public function actionNew() {
        $empresa_mod = new Empresa();
        $oportunidad_mod = new Oportunidad();
        $estudio_mod = new ModuloEstudio();        
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["getcarrera"])) {
                if ($data["emp_id"] == 1) {
                    $arreglo_carrerra = $oportunidad_mod->consultarCarreras();
                } else {
                    $arreglo_carrerra = $estudio_mod->consultarEstudioEmpresa($data["emp_id"]); // tomar id de impresa        
                }
                $message = array("carrera" => $arreglo_carrerra);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
            if (isset($data["getprovincias"])) {
                $provincias = Provincia::find()->select("pro_id AS id, pro_nombre AS name")->where(["pro_estado_logico" => "1", "pro_estado" => "1", "pai_id" => $data['pai_id']])->asArray()->all();
                $message = array("provincias" => $provincias);
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }
            if (isset($data["getcantones"])) {
                $cantones = Canton::find()->select("can_id AS id, can_nombre AS name")->where(["can_estado_logico" => "1", "can_estado" => "1", "pro_id" => $data['prov_id']])->asArray()->all();
                $message = array("cantones" => $cantones);
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }
        }        
        $arreglo_empresa = $empresa_mod->getAllEmpresa();
        $arreglo_carrerra = $oportunidad_mod->consultarCarreras();         
        $arreglo_pais = Pais::find()->select("pai_id AS id, pai_nombre AS value")->where(["pai_estado_logico" => "1", "pai_estado" => "1"])->asArray()->all();
        $arreglo_provincia = Provincia::provinciaXPais(1);        
        $arreglo_ciudad = Canton::cantonXProvincia(1);
        return $this->render('new', [
                    "arr_empresa" => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Select")]], $arreglo_empresa), "id", "value"),
                    "arr_carrera" => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Select")]], $arreglo_carrerra), "id", "name"),
                    "arr_pais" => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Select")]], $arreglo_pais), "id", "value"),
                    "arr_provincia" => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Select")]], $arreglo_provincia), "id", "value"),
                    "arr_ciudad" => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Select")]], $arreglo_ciudad), "id", "value"),
        ]);       
    }

    public function actionGuardarlista() {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $emp_id = $data["emp_id"];            
            $nombre_lista = ucwords(mb_strtolower($data["nombre_lista"]));
            $nombre_empresa = ucwords(mb_strtolower($data["nombre_empresa"]));
            $nombre_contacto = ucwords(mb_strtolower($data["txt_nombre_contacto"]));
            $correo_contacto = ucwords(mb_strtolower($data["txt_correo_contacto"]));
            $asunto = ucwords(mb_strtolower($data["txt_asunto"]));
            $pais = ucwords(mb_strtolower($data["pais_texto"]));
            $pais_id = $data["pais_id"];
            $ciudad = ucwords(mb_strtolower($data["ciudad_texto"]));
            $ciudad_id = $data["ciudad_id"];
            $provincia = ucwords(mb_strtolower($data["provincia_texto"]));
            $provincia_id = $data["provincia_id"];
            $direccion1 = ucwords(mb_strtolower($data["direccion1"]));
            $direccion2= ucwords(mb_strtolower($data["direccion2"]));
            $telefono= $data["telefono"];
            $codigo_postal= ucwords(mb_strtolower($data["codigo_postal"]));
            $eaca_id= null;
            $mest_id = null;
            if ($emp_id != 1) {
                $mest_id = $data["carrera_id"];                
            } else {
                $eaca_id= $data["carrera_id"];
            }
            
            $con = \Yii::$app->db_mailing;
            $transaction = $con->beginTransaction();
            try {                                
                $contacto = array(
                "company" => $nombre_empresa,
                "address1" => $direccion1,
                "address2" => $direccion2,
                "city" => $ciudad,
                "state" => $provincia,
                "zip" => $codigo_postal,
                "country" => $pais,
                "phone" => $telefono,
                );
                //Grabar en mailchimp    
                $webs_mailchimp = new WsMailChimp();
                $conLista = $webs_mailchimp->newList($nombre_lista, $nombre_contacto, $correo_contacto, $asunto, $contacto, "es");                                                
                if ($conLista) {
                    //Grabar en asgard
                    $lista = new Lista();
                    $resp_lista = $lista->insertarLista($conLista["id"], $eaca_id, $mest_id, $emp_id, $nombre_lista, $correo_contacto, $nombre_contacto, $pais_id, $provincia_id, $ciudad_id, $direccion1, $direccion2, $telefono, $codigo_postal);
                    if ($resp_lista) {
                        $exito=1;
                    }   
                }
                if ($exito) {
                    $transaction->commit();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "La infomación ha sido grabada. "),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    echo Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                } else {
                    $transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $mensaje),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    echo Utilities::ajaxResponse('NO_OK', 'Error', Yii::t("jslang", "Error"), false, $message);
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => $ex->getMessage(), Yii::t("notificaciones", "Error al grabar."),
                    "title" => Yii::t('jslang', 'Error'),
                );
                return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), true, $message);
            }
        }
    }

}
