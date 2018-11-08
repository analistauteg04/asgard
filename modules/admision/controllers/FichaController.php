<?php

namespace app\modules\admision\controllers;

use Yii;
use app\models\Etnia;
use app\models\Pais;
use app\models\Provincia;
use app\models\Canton;
use app\models\Utilities;
use app\models\TipoSangre;

use app\models\Persona;
use app\models\Interesado;
use app\models\TipoParentesco;
use app\models\PersonaContacto;
use yii\helpers\ArrayHelper;
use app\models\EstadoCivil;

/**
 * 
 *
 * @author Diana Lopez
 */
class FichaController extends \app\components\CController {  
    public function actionUpdate() {
        $mod_pais = new Pais();
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
        }
        $per_id = Yii::$app->session->get("PB_perid");
        $arr_etnia = Etnia::find()->select("etn_id AS id, etn_nombre AS value")->where(["etn_estado_logico" => "1", "etn_estado" => "1"])->asArray()->all();
        $tipos_sangre = TipoSangre::find()->select("tsan_id AS id, tsan_nombre AS value")->where(["tsan_estado_logico" => "1", "tsan_estado" => "1"])->asArray()->all();
        
        //Búsqueda de los datos de persona logueada
        $modperinteresado = new Persona();
        $respPerinteresado = $modperinteresado->consultaPersonaId($per_id);
        $pais_id = 1; //Ecuador 
                
        $arr_pais_nac = Pais::find()->select("pai_id AS id, pai_nombre AS value")->where(["pai_estado_logico" => "1", "pai_estado" => "1"])->asArray()->all();
        $arr_prov_nac = Provincia::provinciaXPais($respPerinteresado['pai_id_nacimiento']);
        $arr_ciu_nac = Canton::cantonXProvincia($respPerinteresado['pro_id_nacimiento']);

        $arr_pais_dom = Pais::find()->select("pai_id AS id, pai_nombre AS value")->where(["pai_estado_logico" => "1", "pai_estado" => "1"])->asArray()->all();
        $arr_prov_dom = Provincia::provinciaXPais($respPerinteresado['pai_id_domicilio']);
        $arr_ciu_dom = Canton::cantonXProvincia($respPerinteresado['pro_id_domicilio']);
        
        // Consulta datos de contacto
        $modpersonacontacto = new PersonaContacto();
        $respcontacto = $modpersonacontacto->consultaPersonaContacto($per_id);       
        // Consultar otra etnia
        $respotraetnia = $modperinteresado->consultarOtraetnia($per_id);
        $area = $mod_pais->consultarCodigoArea($respPerinteresado['pai_id_nacimiento']);
        $area_dom = $mod_pais->consultarCodigoArea($respPerinteresado['pai_id_domicilio']);
        $arr_civil = EstadoCivil::find()->select("eciv_id as id, eciv_nombre as value")->where(["eciv_estado_logico" => "1", "eciv_estado" => "1"])->asArray()->all();

        return $this->render('update', [
                    "arr_etnia" => ArrayHelper::map($arr_etnia, "id", "value"),
                    "arr_civil" => ArrayHelper::map($arr_civil, "id", "value"),
                    "tipo_dni" => array("CED" => Yii::t("formulario", "DNI Document"), "PASS" => Yii::t("formulario", "Passport")),
                    "genero" => array("M" => Yii::t("formulario", "Male"), "F" => Yii::t("formulario", "Female")),
                    "tipos_sangre" => ArrayHelper::map($tipos_sangre, "id", "value"),
                    /*                     * */
                    "arr_pais_nac" => ArrayHelper::map($arr_pais_nac, "id", "value"),
                    "arr_prov_nac" => ArrayHelper::map($arr_prov_nac, "id", "value"),
                    "arr_ciu_nac" => ArrayHelper::map($arr_ciu_nac, "id", "value"),
                    /*                     * */
                    "arr_pais_dom" => ArrayHelper::map($arr_pais_dom, "id", "value"),
                    "arr_prov_dom" => ArrayHelper::map($arr_prov_dom, "id", "value"),
                    "arr_ciu_dom" => ArrayHelper::map($arr_ciu_dom, "id", "value"),                    
                    "respPerinteresado" => $respPerinteresado,
                    "respcontacto" => $respcontacto,                    
                    "respotraetnia" => $respotraetnia,
                    "area" => $area,
                    "area_dom" => $area_dom,
        ]);
    } 
    
    public function actionGuardarficha() {
        $modperinteresado = new Persona();
        $user_ingresa = Yii::$app->session->get("PB_perid");
        if (Yii::$app->request->isAjax) {
            $modInteresado = new Interesado();
            $data = Yii::$app->request->post();
            if ($_SESSION['persona_ingresa'] != '') {// tomar el de parametro)
                $per_id = $_SESSION['persona_ingresa'];
            } else {
                unset($_SESSION['persona_ingresa']);
                $per_id = Yii::$app->session->get("PB_perid");                
            }            
            if ($data["upload_file"]) {
                if (empty($_FILES)) {
                    echo json_encode(['error' => Yii::t("notificaciones", "Error to process File {file}. Try again.", ['{file}' => basename($files['name'])])]);
                    return;
                }
                //Recibe Parámetros
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
            $per_pri_nombre = $data["pnombre_persona"];
            $per_seg_nombre = $data["snombre_persona"];
            $per_pri_apellido = $data["papellido_persona"];
            $per_seg_apellido = $data["sapellido_persona"];
            $per_genero = $data["genero_persona"];
            $etn_id = $data["etnia_persona"];
            $etniaotra = ucwords(strtolower($data["etnia_otra"])); // esta guarda en tabla otra_etnia
            $eciv_id = $data["ecivil_persona"];
            $per_fecha_nacimiento = $data["fnacimiento_persona"];
            $per_nacionalidad = $data["pnacionalidad"];
            $pai_id_nacimiento = $data["pais_persona"];
            $pro_id_nacimiento = $data["provincia_persona"];
            $can_id_nacimiento = $data["canton_persona"];
            $per_correo = $data["correo_persona"];
            $per_celular = $data["celular_persona"];
            $tsan_id = $data["tsangre_persona"];
            $per_nac_ecuatoriano = $data["nacecuador"];

            //FORM 1 Informacion de Contacto
            $pcon_nombre = ucwords(strtolower($data["nombre_contacto"]));
            $pcon_apellido = ucwords(strtolower($data["apellido_contacto"]));
            $pcon_telefono = $data["telefono_contacto"];
            $pcon_celular = $data["celular_contacto"];
            $tpar_id = $data["parentesco_contacto"];
            $pcon_direccion = ucwords(strtolower($data["direccion_contacto"]));

            //FORM 2 Datos Domicilio
            $pai_id_domicilio = $data["paisd_domicilio"];
            $pro_id_domicilio = $data["provinciad_domicilio"];
            $can_id_domicilio = $data["cantond_domicilio"];
            $per_domicilio_telefono = $data["telefono_domicilio"];
            $per_domicilio_sector = $data["sector_domicilio"];
            $per_domicilio_cpri = $data["callep_domicilio"];
            $per_domicilio_csec = $data["calls_domicilio"];
            $per_domicilio_num = $data["numero_domicilio"];
            $per_domicilio_ref = $data["referencia_domicilio"];

            //FORM 3 Datos Academicos - Estudios Nivel Medio 
            $instituto_med = ucwords(strtolower($data["instituto_medio"]));
            $tipinti_med = $data["tipinti_medio"];
            $pai_id_med = $data["pais_medio"];
            $pro_id_med = $data["prov_medio"];
            $ciu_id_med = $data["ciu_medio"];
            $tit_med = ucwords(strtolower($data["tit_medio"]));
            $grado_med = $data["grado_medio"];

            //FORM 3 Datos Academicos - Estudios Tercer Nivel
            $instituto_ter = ucwords(strtolower($data["instituto_tercer"]));
            $tipinti_ter = $data["tipinti_tercer"];
            $pai_id_ter = $data["pais_tercer"];
            $pro_id_ter = $data["prov_tercer"];
            $ciu_id_ter = $data["ciu_tercer"];
            $tit_ter = ucwords(strtolower($data["tit_tercer"]));
            $grado_ter = $data["grado_tercer"];

            //FORM 3 Datos Academicos - Estudios Cuarto Nivel
            $instituto_cua = ucwords(strtolower($data["instituto_cuarto"]));
            $tipinti_cua = $data["tipinti_cuarto"];
            $pai_id_cua = $data["pais_cuarto"];
            $pro_id_cua = $data["prov_cuarto"];
            $ciu_id_cua = $data["ciu_cuarto"];
            $tit_cua = ucwords(strtolower($data["tit_cuarto"]));
            $grado_cua = $data["grado_cuarto"];

            //FORM 4 Datos Familiares
            $instr_madre = $data["inst_madre"];
            $instr_padre = $data["inst_padre"];
            $miembros_hogar = $data["miem_hogar"];
            $miembros_salario = $data["miem_salario"];

            //FORM 5 Datos Adicionales
            $discapacidad = $data["discapacidadi"]; //rd
            $tip_discapacidad = $data["tipoi"];
            $porc_discapacidad = $data["porcentajei"];            
            $enfermedad = $data["enfermedad"];
            $discapacidad_fam = $data["discapacidad_fam"];
            $enfermedad_fam = $data["enfermedad_fam"];

            $idis_archivo = "";
            if (isset($data["archivoi"]) && $data["archivoi"] != "") {
                $arrIm = explode(".", basename($data["archivoi"]));
                $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                $idis_archivo = Yii::$app->params["documentFolder"] . "ficha/" . $per_id . "/enf_discapacidad_per_" . $per_id . "." . $typeFile;
            }

            $enf_catastrofica = $data["enfermedc"]; //rd
            $ienf_tipoenfermedad = "";
            $ienf_archivo = "";
            if (isset($data["archivoc"]) && $data["archivoc"] != "") {
                $arrIm = explode(".", basename($data["archivoc"]));
                $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                $ienf_archivo = Yii::$app->params["documentFolder"] . "ficha/" . $per_id . "/enf_catastrofica_per_" . $per_id . "." . $typeFile;
            }

            $disc_severa = $data["discapacidadsev"]; //rd
            $tip_disc_severa = $data["tipof"];
            $porc_disc_severa = $data["porcentajef"];
            $paren_disc_severa = $data["parentescof"];
            $disc_archivo = "";
            if (isset($data["archivof"]) && $data["archivof"] != "") {
                $arrIm = explode(".", basename($data["archivof"]));
                $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                $disc_archivo = Yii::$app->params["documentFolder"] . "ficha/" . $per_id . "/fam_discapacidad_per_" . $per_id . "." . $typeFile;
            }

            $enf_catas_carga = $data["enfermedcf"]; //rd
            $enf_paren_carga = $data["enfermedcp"];
            $ifen_archivo = "";
            if (isset($data["archivocf"]) && $data["archivocf"] != "") {
                $arrIm = explode(".", basename($data["archivocf"]));
                $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                $ifen_archivo = Yii::$app->params["documentFolder"] . "ficha/" . $per_id . "/fam_catastrofica_per_" . $per_id . "." . $typeFile;
            }
            $tip_enf_fam = $tip_disc_severa; // se debe cambiar
            $con = \Yii::$app->db;
            $transaction = $con->beginTransaction();
            $con1 = \Yii::$app->db_captacion;
            $transaction1 = $con1->beginTransaction();
            try {
                // obtener id de preinteresado
                $arr_interesado = $modInteresado->consultarPreinterxId($per_id);
                if (count($arr_interesado) > 0 && isset($arr_interesado)) {
                    // actualizacion de Persona
                    $respPersona = $modperinteresado->modificaPersona($per_id, $per_pri_nombre, $per_seg_nombre, $per_pri_apellido, $per_seg_apellido, $etn_id, $eciv_id, $per_genero, $pai_id_nacimiento, $pro_id_nacimiento, $can_id_nacimiento, $per_fecha_nacimiento, $per_celular, $per_correo, $tsan_id, $per_domicilio_sector, $per_domicilio_cpri, $per_domicilio_csec, $per_domicilio_num, $per_domicilio_ref, $per_domicilio_telefono, $pai_id_domicilio, $pro_id_domicilio, $can_id_domicilio, $per_nac_ecuatoriano, $per_nacionalidad, '');
                    // creación de contacto
                    $modpersonacontacto = new PersonaContacto();

                    // si es diferente de vacío guardar otra etnia.                    
                    if (!empty($etniaotra) and $etn_id == 6) {
                        //Se verifica si existe, se modifican los datos.
                        $respconsOtraEtnia = $modperinteresado->consultarOtraetnia($per_id);
                        if ($respconsOtraEtnia) {
                            $respOtraEtnia = $modperinteresado->modificarOtraEtnia($per_id, $etniaotra, '1');
                        } else {
                            //Creación
                            $respOtraEtnia = $modperinteresado->crearOtraEtnia($per_id, $etniaotra);
                        }
                    } else {
                        //Se verifica que si existe como otra etnia se inactiva el registro.
                        $respconsOtraEtnia = $modperinteresado->consultarOtraetnia($per_id);
                        if ($respconsOtraEtnia) {
                            $respOtraEtnia = $modperinteresado->modificarOtraEtnia($per_id, $etniaotra, '0');
                        }
                    }
                    // validar que si esta vacío no llame a guardar
                    if (empty($pcon_nombre) && empty($pcon_apellido) && empty($pcon_telefono) && empty($pcon_celular) && $tpar_id == 1 && empty($pcon_direccion)) {
                        $sincontacto = 1;
                    }

                    //Si existe registro en persona contacto se modifican los datos.
                    $resexistecontacto = $modpersonacontacto->consultaPersonaContacto($per_id);
                    if ($resexistecontacto) {
                        if ($pcon_nombre != $pcon_apellido) {
                            $contacto = $pcon_nombre . " " . $pcon_apellido;
                        } else {
                            $contacto = $pcon_nombre;
                        }
                        $resp_modcontacto = $modpersonacontacto->modificarPersonacontacto($per_id, $tpar_id, $contacto, $pcon_telefono, $pcon_celular, $pcon_direccion);
                    } else {
                        if ($sincontacto != 1) {
                            //Creación de persona de contacto.
                            $modpersonacontacto->crearPersonaContacto($per_id, $tpar_id, $pcon_nombre . " " . $pcon_apellido, $pcon_telefono, $pcon_celular, $pcon_direccion);
                        }
                    }
                    //Busca id de interesado.
                    $resp_existeinteresado = $modInteresado->consultarInteresaxId($per_id);
                    if ($resp_existeinteresado) {
                        $int_id = $resp_existeinteresado["int_id"];
                    } else {
                        // creación de Interesado
                        $respInsertInteresado = $modInteresado->insertarInteresado($arr_interesado['id'], $user_ingresa);
                        $int_id = Yii::$app->db_captacion->getLastInsertID();
                        // modificar estado pre interesado
                        $respModPreInteresado = $modInteresado->modificarPreinterxId($arr_interesado['id']);
                    }
                    $msg = "info académicos";
                    //Verificar si tiene datos académicos.
                    $resp_existeacadmedio = $modInteresado->consultarDatoacadxId($per_id, 1);
                    if ($resp_existeacadmedio) {
                        //modificación de estudios medios.
                        $respInfoAcademicoMedio = $modInteresado->modificarDatoacaxInt($int_id, $pai_id_med, $pro_id_med, $ciu_id_med, $tipinti_med, 1, $instituto_med, $tit_med, $grado_med);
                    } else {
                        // info académica Medio
                        $respInfoAcademicoMedio = $modInteresado->insertarDatoacaInter($int_id, $pai_id_med, $pro_id_med, $ciu_id_med, $tipinti_med, 1, $instituto_med, $tit_med, $grado_med);
                    }
                    // info académica Tercer
                    //si no tiene informacion no guardar
                    if (empty($instituto_ter) && empty($tit_ter) && empty($grado_ter)) {
                        $sintercernivel = 1;
                    }
                    if ($sintercernivel != 1) {
                        $resp_existeacadternivel = $modInteresado->consultarDatoacadxId($per_id, 2);
                        if ($resp_existeacadternivel) {
                            //modificación de info de tercer nivel.
                            $respInfoAcademicoTercer = $modInteresado->modificarDatoacaxInt($int_id, $pai_id_ter, $pro_id_ter, $ciu_id_ter, $tipinti_ter, 2, $instituto_ter, $tit_ter, $grado_ter);
                        } else {
                            $respInfoAcademicoTercer = $modInteresado->insertarDatoacaInter($int_id, $pai_id_ter, $pro_id_ter, $ciu_id_ter, $tipinti_ter, 2, $instituto_ter, $tit_ter, $grado_ter);
                        }
                    }
                    // info academica Cuarto
                    //si no tiene información no guardar
                    if (empty($instituto_cua) && empty($tit_cua) && empty($grado_cua)) {
                        $sincuartonivel = 1;
                    }
                    if ($sincuartonivel != 1) {
                        $resp_existeacadcuarnivel = $modInteresado->consultarDatoacadxId($per_id, 3);
                        if ($resp_existeacadcuarnivel) {
                            $respInfoAcademicoCuarto = $modInteresado->modificarDatoacaxInt($int_id, $pai_id_cua, $pro_id_cua, $ciu_id_cua, $tipinti_cua, 3, $instituto_cua, $tit_cua, $grado_cua);
                        } else {
                            $respInfoAcademicoCuarto = $modInteresado->insertarDatoacaInter($int_id, $pai_id_cua, $pro_id_cua, $ciu_id_cua, $tipinti_cua, 3, $instituto_cua, $tit_cua, $grado_cua);
                        }
                    }
                    // info familiar
                    // validar que si esta vacío no llame a guardar.
                    $msg = "info familiar";
                    if (empty($miembros_salario) && empty($miembros_hogar) && (($instr_madre == 1) or empty($instr_madre)) && (($instr_padre == 1) or empty($instr_padre))) {
                        $sinmiembros = 1;
                    }
                  
                    $resp_existe_infofamilia = $modInteresado->consultarDatofamxId($per_id);
                    if ($sinmiembros != 1) {
                        if ($resp_existe_infofamilia) {
                            $info_familiar = $modInteresado->modificarFamilxInte($int_id, $instr_padre, $instr_madre, $miembros_hogar, $miembros_salario);
                        } else {
                            $info_familiar = $modInteresado->insertarDatofamInter($int_id, $instr_padre, $instr_madre, $miembros_hogar, $miembros_salario);
                        }
                    }
                    $msg = "info discapacidad";
                    // info discapacidad                     
                    $resp_existe_infodisc = $modInteresado->consultarDatodiscxId($per_id);
                    if (!empty($discapacidad)) {
                        if ($discapacidad == 1) {
                            if ($resp_existe_infodisc) {
                                $info_discapacidad = $modInteresado->modificarDiscapxInte($int_id, $tip_discapacidad, $discapacidad, $porc_discapacidad, $idis_archivo);
                            } else {
                                $info_discapacidad = $modInteresado->insertarDatodisInter($int_id, $tip_discapacidad, $discapacidad, $porc_discapacidad, $idis_archivo);
                            }
                        } else {
                            if ($resp_existe_infodisc) {  //Cuando ha existido registro en tabla info_discapacidad, se inactiva el registro.
                                $info_discapacidad = $modInteresado->inactivarDiscapxInte($int_id);
                            }
                        }
                    }
                    $msg = "info enfermedad catastrófica";
                    // info enfermedad catastrófica
                    $resp_existeinfoenfer = $modInteresado->consultarDatoenfxId($per_id);
                    if (!empty($enf_catastrofica)) {
                        if ($enfermedad == 1) {
                            if ($resp_existeinfoenfer) {
                                $info_enfer_catas = $modInteresado->modificarEnferxInte($int_id, $enf_catastrofica, $ienf_tipoenfermedad, $ienf_archivo);
                            } else {
                                $info_enfer_catas = $modInteresado->insertarDatoenfInter($int_id, $enf_catastrofica, $ienf_tipoenfermedad, $ienf_archivo);
                            }
                        } else {
                            if ($resp_existeinfoenfer) {
                                $info_enfer_catas = $modInteresado->inactivarEnfermxInte($int_id);
                            }
                        }
                    }
                    $msg = "info discapacidad familiar";
                    // info enfermedad familiar discapacidad
                    $resp_existeconsinfofamdis = $modInteresado->consultarFamdiscxId($per_id);
                    if (!empty($disc_severa)) {
                        if ($discapacidad_fam == 1) {
                            if ($resp_existeconsinfofamdis) {
                                $info_enfer_fam_disc = $modInteresado->modificarFamdisxInte($int_id, $paren_disc_severa, $tip_disc_severa, $disc_severa, $porc_disc_severa, $disc_archivo);
                            } else {
                                $info_enfer_fam_disc = $modInteresado->insertarFamdiscInter($int_id, $paren_disc_severa, $tip_disc_severa, $disc_severa, $porc_disc_severa, $disc_archivo);
                            }
                        } else {
                            if ($resp_existeconsinfofamdis) {
                                $info_enfer_fam_disc = $modInteresado->inactivarFamdisxInte($int_id);
                            }
                        }
                    }
                    $msg = "info enfermedad familiar";
                    // info familia enfermedad
                    $resp_existeenffam = $modInteresado->consultarEnfefamxId($per_id);
                    if (!empty($enf_catas_carga)) {
                        if ($enfermedad_fam == 1) {
                            if ($resp_existeenffam) {
                                $info_enfer_familiar = $modInteresado->modificarEnffamxInte($int_id, $enf_paren_carga, $tip_enf_fam, $enf_catas_carga, $ifen_archivo);
                            } else {
                                $info_enfer_familiar = $modInteresado->insertarEnfefamInter($int_id, $enf_paren_carga, $tip_enf_fam, $enf_catas_carga, $ifen_archivo);
                            }
                        } else {
                            if ($resp_existeenffam) {
                                $info_enfer_familiar = $modInteresado->inactivarFamenfxInte($int_id);
                            }
                        }
                    }
                    //Se asigna menú de interesado (cambio de rol)
                    $msg = "asignación de rol";
                    $resp_consrol = $modInteresado->consultaGruporolxId($per_id, 11);
                    if ($resp_consrol["grol_id"] == 11) {
                        //Ya tiene asignado el rol de interesado.
                        $exito = 1;
                        $mensaje = "La infomación ha sido actualizada.";
                    } else {                        
                        $resprol = $modInteresado->modificarGruporolxId($per_id, 11);
                        if ($resprol) {
                            $exito = 1;
                        }                      
                    }
                }
                if ($exito) {
                    $transaction->commit();
                    $transaction1->commit();
                    if (empty($mensaje)) {
                        $message = array(
                            "wtmessage" => Yii::t("notificaciones", "La infomación ha sido grabada. Proceda con el ingreso de su solicitud."),
                            "title" => Yii::t('jslang', 'Success'),
                        );
                    } else {
                        $message = array(
                            "wtmessage" => Yii::t("notificaciones", $mensaje),
                            "title" => Yii::t('jslang', 'Success'),
                        );
                    }
                    echo \app\models\Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                    return;
                } else {
                    $transaction->rollback();
                    $transaction1->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $msg),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    echo \app\models\Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                    return;
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $transaction1->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $msg),
                    "title" => Yii::t('jslang', 'Success'),
                );
                echo \app\models\Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                return;
            }
        }
    }           
}
