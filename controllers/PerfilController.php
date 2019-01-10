<?php

namespace app\controllers;

use Yii;
use app\models\Etnia;
use app\models\Pais;
use app\models\Provincia;
use app\models\Canton;
use app\models\Utilities;
use app\models\TipoSangre;
use app\models\Persona;
use app\models\EstadoCivil;
use app\models\TipoParentesco;
use app\models\PersonaContacto;
use app\models\PersonaCorreoInstitucional;
use app\models\ContactoGeneral;
use app\models\TipoContactoGeneral;
use yii\base\Exception;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\base\Security;
use yii\data\ArrayDataProvider;
use yii\helpers\VarDumper;

/**
 * 
 *
 * @author Diana Lopez
 */
class PerfilController extends \app\components\CController {

    public function actionUpdate() {
        $mod_areapais = new Pais();
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
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
            if (isset($data["getarea"])) {
                //obtener el codigo de area del pais en informacion personal
                //$mod_areapais = new Pais();
                $area = $mod_areapais->consultarCodigoArea($data["codarea"]);
                $message = array("area" => $area);
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }
        }
        $per_id = Yii::$app->session->get("PB_perid");
        $arr_etnia = Etnia::find()->select("etn_id AS id, etn_nombre AS value")->where(["etn_estado_logico" => "1", "etn_estado" => "1"])->asArray()->all();
        $tipos_sangre = TipoSangre::find()->select("tsan_id AS id, tsan_nombre AS value")->where(["tsan_estado_logico" => "1", "tsan_estado" => "1"])->asArray()->all();
        //Búsqueda de los datos de persona logueada
        $modpersona = new Persona();
        $respPersona = $modpersona->consultaPersonaId($per_id);

        if ($respPersona['per_id']) {
            $modpercorinstitucional = new PersonaCorreoInstitucional();
            $respPerCorInstitucional = $modpercorinstitucional->consultarCorreoInstitucional($per_id);
            $modContGeneral = new ContactoGeneral();
            $respContGeneral = $modContGeneral->consultaContactoGeneral($respPersona['per_id']);
            $data = Yii::$app->request->get();
        }

        $pais_id = 57; //Ecuador
        $arr_pais_nac = Pais::find()->select("pai_id AS id, pai_nombre AS value, pai_codigo_fono AS code")->where(["pai_estado_logico" => "1", "pai_estado" => "1"])->asArray()->all();
        $arr_prov_nac = Provincia::provinciaXPais($respPersona['pai_id_nacimiento']);
        $arr_ciu_nac = Canton::cantonXProvincia($respPersona['pro_id_nacimiento']);

        $arr_pais_dom = Pais::find()->select("pai_id AS id, pai_nombre AS value, pai_codigo_fono AS code")->where(["pai_estado_logico" => "1", "pai_estado" => "1"])->asArray()->all();
        $arr_prov_dom = Provincia::provinciaXPais($respPersona['pai_id_domicilio']);
        $arr_ciu_dom = Canton::cantonXProvincia($respPersona['pro_id_domicilio']);

        $arr_tipparent = TipoParentesco::find()->select("tpar_id AS id, tpar_nombre AS value")->where(["tpar_estado_logico" => "1", "tpar_estado" => "1"])->asArray()->all();
        $arr_civil = EstadoCivil::find()->select("eciv_id as id, eciv_nombre as value")->where(["eciv_estado_logico" => "1", "eciv_estado" => "1"])->asArray()->all();

        $area = $mod_areapais->consultarCodigoArea($respPersona['pai_id_domicilio']);
        $respotraetnia = $modpersona->consultarOtraetnia($per_id);

        if (empty($respPersona['per_foto'])) {
            $respPersona['per_foto'] = '/uploads/ficha/silueta_default.png';
        }

        return $this->render('update', [
                    "arr_etnia" => ArrayHelper::map($arr_etnia, "id", "value"),
                    "arr_civil" => ArrayHelper::map($arr_civil, "id", "value"),
                    "tipo_dni" => array("CED" => Yii::t("formulario", "DNI Document"), "PASS" => Yii::t("formulario", "Passport")),
                    "genero" => array("M" => Yii::t("formulario", "Male"), "F" => Yii::t("formulario", "Female")),
                    "tipos_sangre" => ArrayHelper::map($tipos_sangre, "id", "value"),
                    /*                     * */
                    "arr_pais_nac" => $arr_pais_nac, //ArrayHelper::map($arr_pais_nac, "id", "value"),
                    "arr_prov_nac" => ArrayHelper::map($arr_prov_nac, "id", "value"),
                    "arr_ciu_nac" => ArrayHelper::map($arr_ciu_nac, "id", "value"),
                    /*                     * */
                    "arr_pais_dom" => $arr_pais_dom,
                    "arr_prov_dom" => ArrayHelper::map($arr_prov_dom, "id", "value"),
                    "arr_ciu_dom" => ArrayHelper::map($arr_ciu_dom, "id", "value"),
                    /*                     * */
                    "arr_tipparent" => ArrayHelper::map($arr_tipparent, "id", "value"),
                    "respPersona" => $respPersona, 
                    "area" => $area,
                    "respPerCorInstitucional" => $respPerCorInstitucional,
                    "respContGeneral" => $respContGeneral,
                    "respotraetnia" => $respotraetnia,
        ]);
    }

    /* Guardado del Primer Tab */
    public function actionGuardartab1() {
        //error_log("Entro a log");        
        $modpersona = new Persona(); //ExpedienteProfesor();
        $per_id = Yii::$app->session->get("PB_perid");
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();

            if ($data["upload_file"]) {
                if (empty($_FILES)) {
                    echo json_encode(['error' => Yii::t("notificaciones", "Error to process File {file}. Try again.", ['{file}' => basename($files['name'])])]);
                    return;
                }
                //Recibe Paramentros
                $files = $_FILES[key($_FILES)];
                $arrIm = explode(".", basename($files['name']));
                $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                $dirFileEnd = Yii::$app->params["documentFolder"] . "ficha/" . $per_id . "/" . $data["name_file"] . "_per_" . $per_id . "." . $typeFile;
                $status = Utilities::moveUploadFile($files['tmp_name'], $dirFileEnd);
                if ($status) {
                    return true;
                } else {
                    echo json_encode(['error' => Yii::t("notificaciones", "Error to process File {file}. Try again.", ['{file}' => basename($files['name'])])]);
                    return;
                }
            }

            //FORM 1 datos personal
            $per_foto = $data["foto_persona"];
            $per_pri_nombre = $data["pnombre_persona"];
            $per_seg_nombre = $data["snombre_persona"];
            $per_pri_apellido = ucwords(mb_strtolower($data["papellido_persona"]));
            $per_seg_apellido = ucwords(mb_strtolower($data["sapellido_persona"]));
            $per_genero = $data["genero_persona"];
            $etn_id = $data["etnia_persona"];
            $etniaotra = ucwords(mb_strtolower($data["etnia_otra"])); // esta guarda en tabla otra_etnia
            $eciv_id = $data["ecivil_persona"];
            $per_fecha_nacimiento = $data["fnacimiento_persona"];
            $per_nacionalidad = $data["pnacionalidad"];
            $pai_id_nacimiento = $data["pais_persona"];
            $pro_id_nacimiento = $data["provincia_persona"];
            $can_id_nacimiento = $data["canton_persona"];
            $per_correo = ucwords(strtolower($data["correo_persona"]));
            $per_cor_institucional = ucwords(strtolower($data["correo_institucional"]));
            $per_telefono = $data["telefono_persona"];
            $per_celular = $data["celular_persona"];
            $tsan_id = $data["tsangre_persona"];
            $per_nac_ecuatoriano = $data["nacecuador"];

            //FORM 1 Informacion de Contacto
            $cgen_nombre = ucwords(mb_strtolower($data["nombre_contacto"]));
            $cgen_apellido = ucwords(mb_strtolower($data["apellido_contacto"]));
            $cgen_telefono = $data["telefono_contacto"];
            $cgen_celular = $data["celular_contacto"];
            $tpar_id = $data["parentesco_contacto"];
            $cgen_direccion = ucwords(mb_strtolower($data["direccion_contacto"]));

            //FORM 2 Datos Domicilio
            $pai_id_domicilio = $data["paisd_domicilio"];
            $pro_id_domicilio = $data["provinciad_domicilio"];
            $can_id_domicilio = $data["cantond_domicilio"];
            $per_domicilio_telefono = $data["telefono_domicilio"];
            $per_domicilio_sector = ucwords(mb_strtolower($data["sector_domicilio"]));
            $per_domicilio_cpri = ucwords(mb_strtolower($data["callep_domicilio"]));
            $per_domicilio_csec = ucwords(mb_strtolower($data["calls_domicilio"]));
            $per_domicilio_num = ucwords(mb_strtolower($data["numero_domicilio"]));
            $per_domicilio_ref = ucwords(mb_strtolower($data["referencia_domicilio"]));

            $foto_archivo = "";

            if (isset($data["foto_persona"]) && $data["foto_persona"] != "") {
                $arrIm = explode(".", basename($data["foto_persona"]));
                $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                $foto_archivo = Yii::$app->params["documentFolder"] . "ficha/" . $per_id . "/doc_foto_per_" . $per_id . "." . $typeFile;
            }
            $con = \Yii::$app->db;
            $transaction = $con->beginTransaction();
            try {
                //Guardado con envio de Foto               
                $respPersona = $modpersona->modificaPersona($per_id, $per_pri_nombre, $per_seg_nombre, $per_pri_apellido, $per_seg_apellido, $etn_id, $eciv_id, $per_genero, $pai_id_nacimiento, $pro_id_nacimiento, $can_id_nacimiento, $per_fecha_nacimiento, $per_celular, $per_correo, $tsan_id, $per_domicilio_sector, $per_domicilio_cpri, $per_domicilio_csec, $per_domicilio_num, $per_domicilio_ref, $per_domicilio_telefono, $pai_id_domicilio, $pro_id_domicilio, $can_id_domicilio, $per_nac_ecuatoriano, $per_nacionalidad, $foto_archivo);
                if ($respPersona) {
                    // creacion de contacto                                    
                    $modcontactogeneral = new ContactoGeneral();
                    $modpercorinstitucional = new PersonaCorreoInstitucional();

                    // si es diferente de vacío guardar otra etnia.                    
                    if (!empty($etniaotra) and $etn_id == 6) {
                        //Se verifica si existe, se modifican los datos.
                        $respconsOtraEtnia = $modpersona->consultarOtraetnia($per_id);
                        if ($respconsOtraEtnia) {
                            $respOtraEtnia = $modpersona->modificarOtraEtnia($per_id, $etniaotra, '1');
                        } else {
                            //
                            $respOtraEtnia = $modpersona->crearOtraEtnia($per_id, $etniaotra);
                        }
                    } else {
                        //Se verifica que si existe como otra etnia se inactiva el registro.
                        $respconsOtraEtnia = $modpersona->consultarOtraetnia($per_id);
                        if ($respconsOtraEtnia) {
                            $respOtraEtnia = $modpersona->modificarOtraEtnia($per_id, $etniaotra, '0');
                        }
                    }
                    // actualizacion de Correo Profesor en caso de que se venga algun valor en esta variable                   
                    if (!empty($per_cor_institucional)) {
                        //Verificar si existe creado ya un correo institucional si no existe se lo crea
                        $verificarRegistroCorInstitucional = $modpercorinstitucional->consultarCorreoInstitucional($per_id);
                        if ($verificarRegistroCorInstitucional) {
                            //Existe Registro lo actualizamos
                            $respPerCorInstitucional = $modpercorinstitucional->modificaCorInstitucional($per_id, $per_cor_institucional);
                        } else {
                            //No Existe Registro lo creamos
                            $respPerCorInstitucional = $modpercorinstitucional->crearCorreoInstitucional($per_id, $per_cor_institucional);
                        }
                    }
                    // validar que si esta vacio no llame a guardar              
                    if (empty($cgen_nombre) && empty($cgen_apellido) && empty($cgen_telefono) && empty($cgen_celular) && $tpar_id != '' && empty($cgen_direccion)) {
                        $sincontacto = 1;
                    }

                    if ($sincontacto != 1) {
                        $verificarRegistroContactoGeneral = $modcontactogeneral->consultaContactoGeneral($per_id);
                        // $db_base = "db_asgard.persona";
                        if ($verificarRegistroContactoGeneral) {
                            $resp_contacto = $modcontactogeneral->modificaContactoGeneral($verificarRegistroContactoGeneral['contacto_id'], $per_id, $cgen_nombre, $cgen_apellido, $tpar_id, $cgen_direccion, $cgen_telefono, $cgen_celular);
                            if ($resp_contacto) {
                                $exito = 1;
                            }
                        } else {
                            $resp_contacto = $modcontactogeneral->crearContactoGeneral($per_id, $cgen_nombre, $cgen_apellido, $tpar_id, $cgen_direccion, $cgen_telefono, $cgen_celular);
                            if ($resp_contacto) {
                                $exito = 1;
                            }
                        }
                    } else {
                        $exito = 1;
                    }
                }

                if ($exito) {
                    $transaction->commit();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "La infomación ha sido grabada."),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    echo \app\models\Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                    return;
                } else {
                    $transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error al grabar."),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    echo \app\models\Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                    return;
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error al grabar."),
                    "title" => Yii::t('jslang', 'Success'),
                );
                echo \app\models\Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                return;
            }
        }
    }

}
