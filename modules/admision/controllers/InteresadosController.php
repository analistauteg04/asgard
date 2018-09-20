<?php

namespace app\modules\admision\controllers;

use Yii;
use app\modules\admision\models\Interesado;
use app\modules\admision\models\InteresadoEjecutivo;
use app\modules\admision\models\PersonaGestion;
use app\models\EmpresaPersona;
use app\modules\admision\models\InteresadoEmpresa;
use app\models\Persona;
use app\models\Usuario;
use app\models\Utilities;
use yii\base\Security;
use app\models\UsuaGrolEper;
use app\models\Empresa;
use yii\helpers\ArrayHelper;

class InteresadosController extends \app\components\CController {

    public function actionIndex() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $interesado_model = new Interesado();
        $data = Yii::$app->request->get();

        if ($data['PBgetFilter']) {
            $arrSearch["search"] = $data['search'];
            $arrSearch["company"] = $data['company'];
            $model = $interesado_model->consultarInteresados($arrSearch);
        } else {
            $model = $interesado_model->consultarInteresados();
        }
        $empresa_model = new Empresa();
        $arr_empresas = $empresa_model->getAllEmpresa();
        $arrEmpresa = ArrayHelper::map($arr_empresas, "id", "value");
        return $this->render('index', [
                    'model' => $model,
                    'arr_empresa' => $arrEmpresa,
        ]);
    }

    public function actionGuardarinteresado() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $error = 0;
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $id_pgest = $data["id_pgest"];
            $pergest = new PersonaGestion();
            \app\models\Utilities::putMessageLogFile('persona gestion id: ' . $id_pgest);
            $pgest = $pergest->consultarPersonaGestion($id_pgest);
            $con = \Yii::$app->db_asgard;
            $transaction = $con->beginTransaction();
            try {
                $identificacion = '';
                \app\models\Utilities::putMessageLogFile('cedula: ' . $pgest['pges_cedula']);
                \app\models\Utilities::putMessageLogFile('pasaporte: ' . $pgest['pges_pasaporte']);
                if (isset($pgest['pges_cedula']) && strlen($pgest['pges_cedula']) > 0) {
                    $identificacion = $pgest['pges_cedula'];
                } else {
                    $identificacion = $pgest['pges_pasaporte'];
                }
                \app\models\Utilities::putMessageLogFile('identificacion: ' . $identificacion);
                if (isset($identificacion) && strlen($identificacion) > 0) {
                    $id_persona = 0;
                    $mod_persona = new Persona();
                    $keys_per = [
                        'per_pri_nombre', 'per_seg_nombre', 'per_pri_apellido', 'per_seg_apellido'
                        , 'per_cedula', 'etn_id', 'eciv_id', 'per_genero', 'pai_id_nacimiento', 'pro_id_nacimiento'
                        , 'can_id_nacimiento', 'per_fecha_nacimiento', 'per_celular', 'per_correo'
                        , 'tsan_id', 'per_domicilio_sector', 'per_domicilio_cpri', 'per_domicilio_csec'
                        , 'per_domicilio_num', 'per_domicilio_ref', 'per_domicilio_telefono'
                        , 'pai_id_domicilio', 'pro_id_domicilio', 'can_id_domicilio'
                        , 'per_nac_ecuatoriano', 'per_nacionalidad', 'per_foto', 'per_estado', 'per_estado_logico'
                    ];
                    $parametros_per = [
                        $pgest['pges_pri_nombre'], null, $pgest['pges_pri_apellido'], null,
                        $pgest['pges_cedula'], null, null, null, null, null,
                        null, null, $pgest['pges_celular'], $pgest['pges_correo'],
                        null, null, null, null,
                        null, null, null,
                        null, null, null,
                        null, null, null, 1, 1
                    ];
                    $id_persona = $mod_persona->consultarIdPersona($pgest['pges_cedula'], $pgest['pges_pasaporte']);
                    if ($id_persona == 0) {
                        $id_persona = $mod_persona->insertarPersona($con, $parametros_per, $keys_per, 'persona');
                    }
                    if ($id_persona > 0) {
                        \app\models\Utilities::putMessageLogFile('persona con id: ' . $id_persona);
                        $concap = \Yii::$app->db_captacion;
                        $mod_emp_persona = new EmpresaPersona();
                        $emp_id = 1;
                        $keys = ['emp_id', 'per_id', 'eper_estado', 'eper_estado_logico'];
                        $parametros = [$emp_id, $id_persona, 1, 1];
                        $emp_per_id = $mod_emp_persona->consultarIdEmpresaPersona($id_persona, $emp_id);
                        if ($emp_per_id == 0) {
                            $emp_per_id = $mod_emp_persona->insertarEmpresaPersona($con, $parametros, $keys, 'empresa_persona');
                        }
                        if ($emp_per_id > 0) {
                            \app\models\Utilities::putMessageLogFile('empresa persona con id: ' . $emp_per_id);
                            $usuario = new Usuario();
                            $usuario_id = $usuario->consultarIdUsuario($id_persona, $pgest['pges_correo']);
                            if ($usuario_id == 0) {
                                $security = new Security();
                                $hash = $security->generateRandomString();
                                $passencrypt = base64_encode($security->encryptByPassword($hash, 'Uteg2018'));
                                $keys = ['per_id', 'usu_user', 'usu_sha', 'usu_password', 'usu_estado', 'usu_estado_logico'];
                                $parametros = [$id_persona, $pgest['pges_correo'], $hash, $passencrypt, 1, 1];
                                $usuario_id = $usuario->crearUsuarioTemporal($con, $parametros, $keys, 'usuario');
                            }
                            if ($usuario_id > 0) {
                                \app\models\Utilities::putMessageLogFile('usuario con id: ' . $usuario_id);
                                $mod_us_gr_ep = new UsuaGrolEper();
                                $grol_id = 10;
                                $keys = ['eper_id', 'usu_id', 'grol_id', 'ugep_estado', 'ugep_estado_logico'];
                                $parametros = [$emp_per_id, $usuario_id, $grol_id, 1, 1];
                                $us_gr_ep_id = $mod_us_gr_ep->consultarIdUsuaGrolEper($emp_per_id, $usuario_id, $grol_id);
                                if ($us_gr_ep_id == 0)
                                    $us_gr_ep_id = $mod_us_gr_ep->insertarUsuaGrolEper($con, $parametros, $keys, 'usua_grol_eper');
                                if ($us_gr_ep_id > 0) {
                                    \app\models\Utilities::putMessageLogFile('usua grol con id: ' . $us_gr_ep_id);
                                    $mod_interesado = new Interesado(); // se guarda con estado_interesado 1                        
                                    $interesado_id = $mod_interesado->consultaInteresadoById($id_persona);
                                    $keys = ['per_id', 'int_estado_interesado', 'int_usuario_ingreso', 'int_estado', 'int_estado_logico'];
                                    $parametros = [$id_persona, 1, $usuario_id, 1, 1];
                                    if ($interesado_id == 0) {
                                        $interesado_id = $mod_interesado->insertarInteresado($concap, $parametros, $keys, 'interesado');
                                    }
                                    if ($interesado_id > 0) {
                                        \app\models\Utilities::putMessageLogFile('entro al interesado con id: ' . $interesado_id);
                                        $mod_inte_emp = new InteresadoEmpresa(); // se guarda con estado_interesado 1                        
                                        $iemp_id = $mod_inte_emp->consultaInteresadoEmpresaById($interesado_id, $emp_id);
                                        if ($iemp_id == 0) {
                                            \app\models\Utilities::putMessageLogFile('proceso a crear el interesado empresa ');
                                            \app\models\Utilities::putMessageLogFile('int_id: '.$interesado_id.', emp_id: '. $emp_id.', usu_id: '. $usuario_id);
                                            $iemp_id = $mod_inte_emp->crearInteresadoEmpresa($interesado_id, $emp_id, $usuario_id);
                                            \app\models\Utilities::putMessageLogFile('intereso empresa ingresado con id: ' . $iemp_id);
                                        }
                                        if ($iemp_id > 0) {
                                            \app\models\Utilities::putMessageLogFile('intereso empresa ingresado con id: ' . $iemp_id);
                                            \app\models\Utilities::putMessageLogFile(' proceso terminado, enviano correo ');
                                            $email_info = array(
                                                "nombre" => $pgest['pges_pri_nombre'],
                                                "apellido" => $pgest['pges_pri_apellido'],
                                                "correo" => $pgest['pges_correo']
                                            );
                                        } else {
                                            $error_message .= Yii::t("formulario", "The enterprise interested hasn't been saved");
                                            $error++;
                                        }
                                    } else {
                                        $error_message .= Yii::t("formulario", "The interested person hasn't been saved");
                                        $error++;
                                    }
                                } else {
                                    $error_message .= Yii::t("formulario", "The rol user hasn't been saved");
                                    $error++;
                                }
                            } else {
                                $error_message .= Yii::t("formulario", "The user hasn't been saved");
                                $error++;
                            }
                        } else {
                            $error_message .= Yii::t("formulario", "The enterprise person hasn't been saved");
                            $error++;
                        }
                    } else {
                        $error++;
                        $error_message .= Yii::t("formulario", "The person has not been saved");
                    }
                } else {
                    $error_message .= Yii::t("formulario", "Update DNI to generate interested");
                    $error++;
                }

                if ($error == 0) {
                    $message = array(
                        "wtmessage" => Yii::t("formulario", "The information have been saved"),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                } else {
                    //$transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("formulario", "Mensaje: " . $error_message),
                        "title" => Yii::t('jslang', 'Bad Request'),
                    );
                    return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Bad Request"), false, $message);
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => Yii::t("formulario", "Mensaje: " . $error_message),
                    "title" => Yii::t('jslang', 'Bad Request'),
                );
                return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Bad Request"), false, $message);
            }
            return;
        }
    }

    public function actionView() {
        
    }

    public function actionEdit() {
        
    }

    public function actionNew() {
        return $this->render('new');
    }

    public function actionSave() {
        
    }

    public function actionUpdate() {
        
    }

}
