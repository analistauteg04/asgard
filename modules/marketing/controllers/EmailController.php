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
use \app\models\Persona;
use \app\modules\admision\models\PersonaGestion;

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

        return $this->render('index', [
                    'model' => $resp_lista]);
    }

    public function actionAsignar() {
        $mod_lista = new Lista();
        $lis_id = base64_decode($_GET['lis_id']);
        $per_id = @Yii::$app->session->get("PB_perid");
        $mod_sb = new Suscriptor();
        $mod_persona = new Persona();
        $mod_perge = new PersonaGestion();
        $lista_model = $mod_lista->consultarListaXID($lis_id);
        $susbs_lista = $mod_sb->consultarSuscriptoresxLista($lis_id);
        $su_id = 0;
        $error = 0;
        $mensaje = "";
        if (Yii::$app->request->isAjax) {
            $con = \Yii::$app->db_asgard;
            $transaction = $con->beginTransaction();
            $data = Yii::$app->request->post();
            if ($data["accion"] = 'sc') {
                $ps_id = $data["psus_id"];
                $per_tipo = $data["per_tipo"];
                $data_source = array();
                $per_id = null;
                $pge_id = null;
                if ($per_tipo == 1) {
                    $data_source = $mod_persona->consultaPaersonaId($ps_id);
                    $per_id = $ps_id;
                }if ($per_tipo == 2) {
                    $data_source = $mod_perge->consultarPersonaGestion($ps_id);
                    $pge_id = $ps_id;
                }
                $keys = ['per_id', 'pges_id', 'sus_estado', 'sus_estado_logico'];
                $parametros = [$id_persona, $pge_id, 1, 1];
                $su_id = $mod_sb->insertarSuscritor($con, $parametros, $keys, 'suscriptor');
                if ($su_id > 0) {
                    $mensaje = "The information have been saved and the information has been sent to your email";
                } else {
                    $mensaje = "Error: El suscritor no fue guardado.";
                    $error++;
                }
            }
            if ($error == 0) {
                $message = array(
                    "wtmessage" => Yii::t("formulario", $mensaje),
                    "title" => Yii::t('jslang', 'Success'),
                );
            } else {
                $message = array(
                    "wtmessage" => Yii::t("formulario", $mensaje),
                    "title" => Yii::t('jslang', 'Success'),
                );
            }
            return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
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
        $lista = base64_decode($_GET["lisid"]);
        $plantilla = $mod_lista->consultarListaTemplate($lista);
        $ingreso = $mod_lista->consultarIngresoProgramacion($lista, $plantilla['id']);
        $lista_model = $mod_lista->consultarListaXID($lista);
        if (empty($ingreso)) {
            $muestra = 1;
            return $this->render('programacion', [
                        "muestra" => $muestra,
                        "arr_ingreso" => $ingreso,
                        'arr_lista' => $lista_model
            ]);
        } else {
            return $this->render('viewprograma', [
                        "muestra" => $muestra,
                        "arr_ingreso" => $ingreso,
                        'arr_lista' => $lista_model
            ]);
        }
    }

    public function actionDelete() {
        $mod_lista = new Lista();
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();            
            $lis_id = $data['lis_id'];            
            $con = \Yii::$app->db_mailing;
            $transaction = $con->beginTransaction();
            try {
                //consultar la lista.  
                $resp_consulta =  $mod_lista->consultarListaXID($lis_id);
                if ($resp_consulta["num_suscr"] > 0) {
                    $resp_listsuscriptor = $mod_lista->inactivaListaSuscriptor($lis_id);
                    if ($resp_listsuscriptor) {
                        $resp_lista = $mod_lista->inactivaLista($lis_id);
                        if ($resp_lista) {
                            $exito = '1';
                        }
                    }
                } else {
                    $resp_lista = $mod_lista->inactivaLista($lis_id);
                    if ($resp_lista) {
                        $exito = '1';
                    }
                }                
                if ($exito) {
                    //Eliminar en mailchimp
                    $webs_mailchimp = new WsMailChimp();
                    $conMailch = $webs_mailchimp->deleteList($lis_id);
                    if ($conMailch) {
                        $transaction->commit();
                        $message = array(
                            "wtmessage" => Yii::t("notificaciones", "Se ha eliminado la lista exitosamente."),
                            "title" => Yii::t('jslang', 'Success'),
                        );
                        return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                    }
                    
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
                if (empty($ingreso)) {
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
            if (isset($data["getempresa"])) {
                $resp_empresa = $empresa_mod->consultarEmpresaXid($data["emp_id"]);
                $message = array($resp_empresa);
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }
            if (isset($data["getcorreo"])) {
                $resp_correo = $empresa_mod->consultarCorreoXempresa($data["emp_id"]);
                $message = array("correo"=> $resp_correo);
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }            
        }
        $arreglo_empresa = $empresa_mod->getAllEmpresa();        
        $arreglo_carrerra = $oportunidad_mod->consultarCarreras();
        $arreglo_correo = $empresa_mod->consultarCorreoXempresa(1);
        return $this->render('new', [
                    "arr_empresa" => ArrayHelper::map(array_merge([["id" => "0", "value" => Yii::t("formulario", "Select")]], $arreglo_empresa), "id", "value"),
                    "arr_carrera" => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Select")]], $arreglo_carrerra), "id", "name"),                 
                    "arr_correo" => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Select")]], $arreglo_correo), "id", "name"),                 
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
            $ciudad = ucwords(mb_strtolower($data["ciudad_texto"]));            
            $provincia = ucwords(mb_strtolower($data["provincia_texto"]));            
            $direccion1 = ucwords(mb_strtolower($data["direccion1"]));
            $direccion2 = ucwords(mb_strtolower($data["direccion2"]));
            $telefono = $data["telefono"];
            $codigo_postal = ucwords(mb_strtolower($data["codigo_postal"]));
            $eaca_id = null;
            $mest_id = null;
            if ($emp_id != 1) {
                $mest_id = $data["carrera_id"];
            } else {
                $eaca_id = $data["carrera_id"];
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
                    $resp_lista = $lista->insertarLista($conLista["id"], $eaca_id, $mest_id, $emp_id, $nombre_lista, $correo_contacto, $nombre_contacto, $pais, $provincia, $ciudad, $direccion1, $direccion2, $telefono, $codigo_postal);
                    if ($resp_lista) {
                        $exito = 1;
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
                        "wtmessage" => Yii::t("notificaciones", "Error al grabar."),
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

    public function actionUpdateprogramacion() {
        $mod_lista = new Lista();
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $lista = base64_decode($data["lista"]);
            $fecinicio = $data["fecha_inicio"];
            $fecfin = $data["fecha_fin"];
            $horenvio = $data["hora_envio"];
            $fecha_modifica = date(Yii::$app->params["dateTimeByDefault"]);
            $usuario = @Yii::$app->user->identity->usu_id;
            $con = \Yii::$app->db_mailing;
            $transaction = $con->beginTransaction();
            try {
                $plantilla = $mod_lista->consultarListaTemplate($lista);
                $programa = $mod_lista->consultarIngresoProgramacion($lista, $plantilla['id']);
                $respuesta = $mod_lista->modificarProgramacionxId($programa['pro_id'], $lista, $plantilla['id'], $fecinicio, $fecfin, $horenvio, $usuario, $fecha_modifica);
                if ($respuesta) {
                    $resp_dia = $mod_lista->modificarDiaProgramacion($programa['pro_id'], $fecha_modifica);
                    if ($resp_dia) {
                        for ($i = 1; $i < 8; $i++) {
                            $dia = $data["check_dia_" . $i];
                            if ($dia > 0) {
                                $resp_dia = $mod_lista->insertarDiaProgra($programa['pro_id'], $dia, $fecha_modifica);
                            }
                        }
                        $transaction->commit();
                        $message = array(
                            "wtmessage" => Yii::t("notificaciones", "La información ha sido modificada. "),
                            "title" => Yii::t('jslang', 'Success'),
                        );
                        return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                    } else {
                        $transaction->rollback();
                        $message = array(
                            "wtmessage" => Yii::t("notificaciones", "Error al eliminar." . $mensaje),
                            "title" => Yii::t('jslang', 'Bad Request'),
                        );
                        return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Bad Request"), false, $message);
                    }
                } else {
                    $transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error al modificar." . $mensaje),
                        "title" => Yii::t('jslang', 'Bad Request'),
                    );
                    return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Bad Request"), false, $message);
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error al modificar." . $mensaje),
                    "title" => Yii::t('jslang', 'Bad Request'),
                );
                return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Bad Request"), false, $message);
            }
            return;
        }
    }

    public function actionEditprogramacion() {
        $mod_lista = new Lista();
        $lista = base64_decode($_GET["lisid"]);
        $plantilla = $mod_lista->consultarListaTemplate($lista);
        $ingreso = $mod_lista->consultarIngresoProgramacion($lista, $plantilla['id']);
        $lista_model = $mod_lista->consultarListaXID($lista);
        return $this->render('editprograma', [
                    "muestra" => $muestra,
                    "arr_ingreso" => $ingreso,
                    'arr_lista' => $lista_model
        ]);
    }

}
