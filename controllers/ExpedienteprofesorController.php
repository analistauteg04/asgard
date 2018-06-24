<?php

namespace app\controllers;

use Yii;
use app\models\Etnia;
use app\models\Pais;
use app\models\Provincia;
use app\models\Canton;
use app\models\Utilities;
use app\models\TipoSangre;
use app\models\TipoDiscapacidad;
use app\models\TipoInstitucionAca;
use app\models\NivelInstruccion;
use app\models\Persona;
use app\models\ExpedienteProfesor;
use app\models\TipoParentesco;
use app\models\PersonaCorreoInstitucional;
use app\models\ContactoGeneral;
use app\models\EstadoCivil;
use app\models\Carrera;
use yii\base\Exception;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\base\Security;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;
use DateTime;

/**
 * 
 *
 * @author Diana Lopez, Grace Viteri
 */
class ExpedienteprofesorController extends \app\components\CController {

    public function actionCreate() {
        $mod_exprofesor = new ExpedienteProfesor();
        $mod_carrera = new Carrera();
        $mod_persona = new Persona();
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
            if (isset($data["getarea"])) {
                //obtener el codigo de area del pais en informacion personal//             
                $area = $mod_pais->consultarCodigoArea($data["codarea"]);
                $message = array("area" => $area);
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }
            if (isset($data["getinstituto"])) {
                $instituto = $mod_exprofesor->consultarInstituto($data["pai_id"]);
                $message = array("instituto" => $instituto);
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }
            if (isset($data["getareac"])) {
                $subarea = $mod_carrera->consultarSubAreaConocimiento($data["area"]);               
                $message = array("subarea" => $subarea);               
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            } 
            if (isset($data["getpais"])) {
                $nacionalidad = $mod_persona->consultarNacionalidad($data["pai_id"]);               
                $message = array("nacion" => $nacionalidad);                  
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            } 
        }
        
        $tab = $_GET["tab"];  //tab activo
        if (empty($tab)) {
            $tab=1;
        }
        //Se obtiene el per_id.
        $per_id = Yii::$app->session->get("PB_perid");
        /* Arreglos para llenar los combo box */
        $arr_conocimiento = $mod_carrera->consultarAreaConocimiento();
        $arr_subarea = $mod_carrera->consultarSubAreaConocimiento(1);
        $arr_nivinstruccion = $mod_exprofesor->consultarParametros('pv_ninstruccion', null);
        $arr_tipodiploma = $mod_exprofesor->consultarParametros('pv_tdiploma', null);
        $arr_modalidad = $mod_exprofesor->consultarParametros('pv_modalidad', null);
        $arr_tipcapacitacion = $mod_exprofesor->consultarParametros('pv_tcapacitacion', null);
        $arr_tiempodedica = $mod_exprofesor->consultarParametros('pv_tdedicado', null);
        $arr_tiprelacion = $mod_exprofesor->consultarParametros('pv_trelacion', null);
        $arr_publica = $mod_exprofesor->consultarParametros('pv_publicacion', null);
        $arr_coodireccion = $mod_exprofesor->consultarParametros('pv_coodireccion', null);
        $arr_tipopublica = $mod_exprofesor->consutarTipopublicacion();
        $arr_lenguaje = $mod_exprofesor->consultarIdiomas();
        $arr_etnia = Etnia::find()->select("etn_id AS id, etn_nombre AS value")->where(["etn_estado_logico" => "1", "etn_estado" => "1"])->asArray()->all();
        $tipos_sangre = TipoSangre::find()->select("tsan_id AS id, tsan_nombre AS value")->where(["tsan_estado_logico" => "1", "tsan_estado" => "1"])->asArray()->all();
        $arr_rolproyecto = $mod_exprofesor->consultarParametros('pv_rolproyecto', null);
        $arr_tipo_participacion = $mod_exprofesor->consultarParametros('pv_tipo_participacion', null);

        //Búsqueda de los datos de persona o profesor logueada        
        $respExpProfesor = $mod_persona->consultaPersonaId($per_id);
        $modpercorinstitucional = new PersonaCorreoInstitucional();
        $respPerCorInstitucional = $modpercorinstitucional->consultarCorreoInstitucional($per_id);
        $modContGeneral = new ContactoGeneral();
        $respContGeneral = $modContGeneral->consultarContactoGeneral($per_id);

        $data = Yii::$app->request->get();
        $pais_id = 57; //Ecuador
        $nacionalidad = 'Ecuatoriano';
        $arr_instituto = $mod_exprofesor->consultarInstituto($pais_id);
        $arr_pais_nac = Pais::find()->select("pai_id AS id, pai_nombre AS value, pai_codigo_fono AS code")->where(["pai_estado_logico" => "1", "pai_estado" => "1"])->asArray()->all();
        $arr_prov_nac = Provincia::provinciaXPais($respExpProfesor['pai_id_nacimiento']);
        $arr_ciu_nac = Canton::cantonXProvincia($respExpProfesor["pro_id_nacimiento"]);

        $arr_pais_dom = Pais::find()->select("pai_id AS id, pai_nombre AS value, pai_codigo_fono AS code")->where(["pai_estado_logico" => "1", "pai_estado" => "1"])->asArray()->all();
        $arr_prov_dom = Provincia::provinciaXPais($respExpProfesor['pai_id_domicilio']);
        $arr_ciu_dom = Canton::cantonXProvincia($respExpProfesor["pro_id_domicilio"]);

        $arr_pais_med = Pais::find()->select("pai_id AS id, pai_nombre AS value")->where(["pai_estado_logico" => "1", "pai_estado" => "1"])->asArray()->all();
        $arr_prov_med = Provincia::provinciaXPais($pais_id);
        $arr_ciu_med = Canton::cantonXProvincia($arr_prov_med[0]["id"]);

        $arr_pais_ter = Pais::find()->select("pai_id AS id, pai_nombre AS value")->where(["pai_estado_logico" => "1", "pai_estado" => "1"])->asArray()->all();
        $arr_prov_ter = Provincia::provinciaXPais($pais_id);
        $arr_ciu_ter = Canton::cantonXProvincia($arr_prov_ter[0]["id"]);

        $arr_pais_cuat = Pais::find()->select("pai_id AS id, pai_nombre AS value")->where(["pai_estado_logico" => "1", "pai_estado" => "1"])->asArray()->all();
        $arr_prov_cuat = Provincia::provinciaXPais($pais_id);
        $arr_ciu_cuat = Canton::cantonXProvincia($arr_prov_cuat[0]["id"]);

        $arr_tip_discap = TipoDiscapacidad::find()->select("tdis_id AS id, tdis_nombre AS value")->where(["tdis_estado_logico" => "1", "tdis_estado" => "1"])->asArray()->all();
        $arr_tip_discap_fam = TipoDiscapacidad::find()->select("tdis_id AS id, tdis_nombre AS value")->where(["tdis_estado_logico" => "1", "tdis_estado" => "1"])->asArray()->all();

        $arr_tip_instaca_med = TipoInstitucionAca::find()->select("tiac_id AS id, tiac_nombre AS value")->where(["tiac_estado_logico" => "1", "tiac_estado" => "1"])->asArray()->all();
        $arr_tip_instaca_ter = TipoInstitucionAca::find()->select("tiac_id AS id, tiac_nombre AS value")->where(["tiac_estado_logico" => "1", "tiac_estado" => "1"])->asArray()->all();
        $arr_tip_instaca_cuat = TipoInstitucionAca::find()->select("tiac_id AS id, tiac_nombre AS value")->where(["tiac_estado_logico" => "1", "tiac_estado" => "1"])->asArray()->all();
        $arr_ninstruc_mad = NivelInstruccion::find()->select("nins_id AS id, nins_nombre AS value")->where(["nins_estado_logico" => "1", "nins_estado" => "1"])->asArray()->all();
        $arr_ninstruc_pad = NivelInstruccion::find()->select("nins_id AS id, nins_nombre AS value")->where(["nins_estado_logico" => "1", "nins_estado" => "1"])->asArray()->all();

        $arr_tipparent_todos = TipoParentesco::find()->select("tpar_id AS id, tpar_nombre AS value")->where(["tpar_estado_logico" => "1", "tpar_estado" => "1"])->asArray()->all();
        $arr_tipparent = $mod_exprofesor->consultarParentesco('1');
        $arr_estcivil = EstadoCivil::find()->select("eciv_id as id, eciv_nombre as value")->where(["eciv_estado_logico" => "1", "eciv_estado" => "1"])->asArray()->all();

        $area = $mod_pais->consultarCodigoArea($respExpProfesor['pai_id_domicilio']);        
        //edad
        $fecha_actual = new DateTime(date("Y-m-d"));
        $fechanac = new Datetime($respExpProfesor["per_fecha_nacimiento"]);
        $edad = $fecha_actual->diff($fechanac);
        $edadf = $edad->format("%Y-%m") . "     (años-meses)";

        if (empty($respExpProfesor['per_foto'])) {
            $respExpProfesor['per_foto'] = '/uploads/expedienteprofesor/Silueta-opc-4.png';
        }
        $respotraetnia = $mod_persona->consultarOtraetnia($per_id);
        
        //Consulta de datos ingresados.
        //Datos de familia
        $resp_familiares = $mod_exprofesor->consultarDatosFamiliares($per_id, 1, 1);
        $resp_familiaresInst = $mod_exprofesor->consultarDatosFamiliares($per_id, 2, 1);

        //Datos Académicos.
        $resp_estsuperior = $mod_exprofesor->consultarDatosAcademicos($per_id,1,1);
        $resp_estactual = $mod_exprofesor->consultarDatosAcademicos($per_id,2,1);
        $resp_reconocimiento = $mod_exprofesor->consultarDatosAcademicos($per_id,3,1);
        $resp_idiomas = $mod_exprofesor->consultarDatosIdiomas($per_id,1);
        $resp_capacitacion = $mod_exprofesor->consultarDatosCapacitacion($per_id,1);        
        //Datos información laboral.
        $resp_laboral = $mod_exprofesor->consultarDatoslaborales($per_id,1);
        $resp_docencia = $mod_exprofesor->consultarDatosdocencia($per_id,1);        
        //Datos de investigación.
        $resp_investigacion = $mod_exprofesor->consultarDatosinvestigacion($per_id,1);   
        //Datos de Publicación.
        $resp_publicacion = $mod_exprofesor->consultarDatospublicacion($per_id, 1);
        $resp_codireccion = $mod_exprofesor->consultarDatoscodireccion($per_id, 1);
        $resp_ponencia = $mod_exprofesor->consultarDatosponencias($per_id, 1);
        /* Obtener datos de discapacidad */
        $resp_discapacidad = $mod_exprofesor->consultarDiscapacidad($per_id);
        
        return $this->render('create', [
                    "arr_etnia" => ArrayHelper::map($arr_etnia, "id", "value"),
                    "arr_civil" => ArrayHelper::map($arr_estcivil, "id", "value"),
                    "tipo_dni" => array("CED" => Yii::t("formulario", "DNI Document"), "PASS" => Yii::t("formulario", "Passport")),
                    "genero" => array("M" => Yii::t("formulario", "Male"), "F" => Yii::t("formulario", "Female")),
                    "tipos_sangre" => ArrayHelper::map($tipos_sangre, "id", "value"),
                    /*                     * */
                    "arr_pais_nac" => $arr_pais_nac,
                    "arr_prov_nac" => ArrayHelper::map($arr_prov_nac, "id", "value"),
                    "arr_ciu_nac" => ArrayHelper::map($arr_ciu_nac, "id", "value"),
                    /*                     * */
                    "arr_pais_dom" => $arr_pais_dom,
                    "arr_prov_dom" => ArrayHelper::map($arr_prov_dom, "id", "value"),
                    "arr_ciu_dom" => ArrayHelper::map($arr_ciu_dom, "id", "value"),
                    /*                     * */
                    "arr_pais_med" => ArrayHelper::map($arr_pais_med, "id", "value"),
                    "arr_prov_med" => ArrayHelper::map($arr_prov_med, "id", "value"),
                    "arr_ciu_med" => ArrayHelper::map($arr_ciu_med, "id", "value"),
                    /*                     * */
                    "arr_pais_ter" => ArrayHelper::map($arr_pais_ter, "id", "value"),
                    "arr_prov_ter" => ArrayHelper::map($arr_prov_ter, "id", "value"),
                    "arr_ciu_ter" => ArrayHelper::map($arr_ciu_ter, "id", "value"),
                    /*                     * */
                    "arr_pais_cuat" => ArrayHelper::map($arr_pais_cuat, "id", "value"),
                    "arr_prov_cuat" => ArrayHelper::map($arr_prov_cuat, "id", "value"),
                    "arr_ciu_cuat" => ArrayHelper::map($arr_ciu_cuat, "id", "value"),
                    /*                     * */
                    "arr_tip_discap" => ArrayHelper::map($arr_tip_discap, "id", "value"),
                    "arr_tip_discap_fam" => ArrayHelper::map($arr_tip_discap_fam, "id", "value"),
                    /*                     * */
                    "arr_tip_instaca_med" => ArrayHelper::map($arr_tip_instaca_med, "id", "value"),
                    "arr_tip_instaca_ter" => ArrayHelper::map($arr_tip_instaca_ter, "id", "value"),
                    "arr_tip_instaca_cuat" => ArrayHelper::map($arr_tip_instaca_cuat, "id", "value"),
                    /*                     * */
                    "arr_ninstruc_mad" => ArrayHelper::map($arr_ninstruc_mad, "id", "value"),
                    "arr_ninstruc_pad" => ArrayHelper::map($arr_ninstruc_pad, "id", "value"),
                    /*                     * */
                    "arr_tipparent" => ArrayHelper::map(array_merge([["id" => "0", "value" => Yii::t("formulario", "Ninguno")]], $arr_tipparent), "id", "value"),
                    "arr_tipparent_todos" => ArrayHelper::map(array_merge([["id" => "0", "value" => Yii::t("formulario", "Ninguno")]], $arr_tipparent_todos), "id", "value"),
                    "respExpProfesor" => $respExpProfesor,
                    "area" => $area,
                    "respPerCorInstitucional" => $respPerCorInstitucional,
                    "respContGeneral" => $respContGeneral,
                    "otraetnia" => $respotraetnia,
                    "model" => $model,
                    "arr_conocimiento" => ArrayHelper::map($arr_conocimiento, "id", "name"),
                    "arr_subarea" => ArrayHelper::map($arr_subarea, "id", "name"),
                    "arr_nivinstruccion" => ArrayHelper::map($arr_nivinstruccion, "id", "name"),
                    "arr_modalidad" => ArrayHelper::map($arr_modalidad, "id", "name"),
                    "arr_tipcapacitacion" => ArrayHelper::map($arr_tipcapacitacion, "id", "name"),
                    "arr_tiempodedica" => ArrayHelper::map($arr_tiempodedica, "id", "name"),
                    "arr_tiprelacion" => ArrayHelper::map($arr_tiprelacion, "id", "name"),
                    "arr_publica" => ArrayHelper::map($arr_publica, "id", "name"),
                    "arr_coodireccion" => ArrayHelper::map($arr_coodireccion, "id", "name"),
                    "arr_tipopublica" => ArrayHelper::map($arr_tipopublica, "id", "name"),
                    "arr_tipodiploma" => ArrayHelper::map($arr_tipodiploma, "id", "name"),
                    "arr_instituto" => ArrayHelper::map($arr_instituto, "id", "name"),
                    "arr_lenguaje" => ArrayHelper::map($arr_lenguaje, "id", "name"),
                    "per_id" => $per_id,
                    "edad" => $edadf,
                    "resp_familiares" => $resp_familiares,
                    "resp_familiaresInst" => $resp_familiaresInst,
                    "resp_estsuperior" => $resp_estsuperior,
                    "resp_estactual" => $resp_estactual,
                    "resp_reconocimiento" => $resp_reconocimiento,
                    "resp_idiomas" => $resp_idiomas,
                    "resp_capacitacion" => $resp_capacitacion,
                    "resp_laboral" => $resp_laboral,
                    "resp_docencia" => $resp_docencia,
                    "resp_investigacion" => $resp_investigacion,
                    "resp_publicacion" => $resp_publicacion,
                    "resp_codireccion" => $resp_codireccion,
                    "resp_ponencia" => $resp_ponencia,
                    "resp_discapacidad" => $resp_discapacidad,
                    "tab" => $tab,
                    "arr_rolproyecto" => ArrayHelper::map($arr_rolproyecto, "id", "name"),
                    "arr_tipo_participacion" => ArrayHelper::map($arr_tipo_participacion, "id", "name"),
                    "nacionalidad" => $nacionalidad,
        ]);
    }

    /* Guardado de todos los tabs.*/   
    public function actionGuardar(){
        $modpersona = new Persona;
        $modexpprofesor = new ExpedienteProfesor();
        $modcontactogeneral = new ContactoGeneral();
        $modpercorinstitucional = new PersonaCorreoInstitucional();
        $per_id = Yii::$app->session->get("PB_perid");
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();

            if ($data["upload_file"]) {
                if (empty($_FILES)) {
                    echo json_encode(['error' => Yii::t("notificaciones", "Error to process File {file}. Try again.", ['{file}' => basename($files['name'])])]);
                    return;
                }
                //Recibe Parámetros
                $files = $_FILES[key($_FILES)];
                $arrIm = explode(".", basename($files['name']));
                $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                $dirFileEnd = Yii::$app->params["documentFolder"] . "expedienteprofesor/" . $per_id . "/" . $data["name_file"] . "_per_" . $per_id . "." . $typeFile;
                $status = Utilities::moveUploadFile($files['tmp_name'], $dirFileEnd);

                //\app\models\Utilities::putMessageLogFile('Files tmp_name: ' . $$files['tmp_name']);
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
            $per_cor_institucional = $data["correo_institucional"];
            $per_telefono = $data["telefono_persona"];
            $per_celular = $data["celular_persona"];
            $tsan_id = $data["tsangre_persona"];
            $per_nac_ecuatoriano = $data["nacecuador"];

            //FORM 1 Informacion de Contacto
            $cgen_nombre = ucwords(strtolower($data["nombre_contacto"]));
            $cgen_apellido = ucwords(strtolower($data["apellido_contacto"]));
            $cgen_telefono = $data["telefono_contacto"];
            $cgen_celular = $data["celular_contacto"];
            $tpar_id = $data["parentesco_contacto"];
            $cgen_direccion = ucwords(strtolower($data["direccion_contacto"]));

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
            
            $dataLSFamiliar = $data['dataLSFamiliar'];
            $dataLSFamiliarIns = $data['dataLSFamiliarIns'];
            $dataLSEstSuperior = $data['dataLSEstSuperior'];
            $dataLSEstActuales = $data['dataLSEstActual'];
            $dataLSReconocimiento = $data['dataLSReconocimiento'];
            $dataLSIdiomas = $data['dataLSIdiomas'];
            $dataLSCapacitacion = $data['dataLSCapacitacion'];
            $dataLSExpLaboral = $data['dataLSExpLaboral'];
            $dataLSExpDocencia = $data['dataLSExpDocencia'];
            $dataLSInvestigacion = $data['dataLSInvestigacion'];
            $dataLSPublicacion = $data['dataLSPublicacion'];
            $dataLSCodireccion = $data['dataLSCodireccion'];
            $dataLSPonencia = $data['dataLSPonencia'];
            $valor = null;
            $tipo_discap = $data ["tipo_discap"];
            $por_discapacidad = $data ["por_discapacidad"];
            $carnet_conadi = $data ["carnet_conadi"];
            $doc_adj_disc = $data ["doc_adj_disc"];
            $discapacidad = $data ["discapacidad"];
            
            //Verificar que haya cambios en los datos.
            $resp_persona = $modexpprofesor->consultarInfopersona($per_id);
            if ($resp_persona) {
                $resp_contacto = $modcontactogeneral->consultarContactoGeneral($per_id);
                $resp_correoinst = $modpercorinstitucional->consultarCorreoInstitucional($per_id);
                $respOtraEtnia = $modpersona->consultarOtraetnia($per_id);
                $tipo = $resp_contacto["parentesco"];
                if (!($resp_contacto)) {
                    $tipo = 1;
                }                
                $foto_archivo = "";                                        
                if (isset($data["foto_persona"]) && $data["foto_persona"] != "") {
                    $arrIm = explode(".", basename($data["foto_persona"]));
                    $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                    $foto_archivo = Yii::$app->params["documentFolder"] . "expedienteprofesor/" . $per_id . "/doc_foto_per_" . $per_id . "." . $typeFile;
                }
                //Conexiones
                $con = \Yii::$app->db;
                $transaction = $con->beginTransaction();
                $con1 = \Yii::$app->db_claustro;
                $transaction1 = $con1->beginTransaction();
                $con2 = \Yii::$app->db_general;
                $transaction2 = $con2->beginTransaction();
                try {
                    // actualización de Persona.
                    $exito = 2;
                    //$mensaje1 = 'Nombre:'.$resp_persona["per_pri_nombre"].'/'$per_pri_nombre.'|'.$resp_persona["per_seg_nombre"].'/'$per_seg_nombre.'|'. $resp_persona["per_pri_apellido"].'/'. $per_pri_apellido.'|'.$resp_persona["per_seg_apellido"].'/'.$per_seg_apellido.'|'.$resp_persona["per_genero"].'/'.$per_genero.'|'.$resp_persona["etn_id"].'/'.$etn_id.'|'.$resp_persona["eciv_id"].'/'.$eciv_id.'|'.$resp_persona["per_fecha_nacimiento"].'/'.$per_fecha_nacimiento.'|'.$resp_persona["per_nacionalidad"].'/'.$per_nacionalidad.'|'.$resp_persona["pai_id_nacimiento"].'/'. $pai_id_nacimiento.'|'. $resp_persona["pro_id_nacimiento"]. '/'.$pro_id_nacimiento.'|'. $resp_persona["can_id_nacimiento"] .'/'. $can_id_nacimiento. '/'.$resp_persona["per_correo"] . '/'. $per_correo . '|'. $resp_persona["per_telefono"] . '/'. $per_telefono . '|'.  $resp_persona["per_celular"] .'/'. $per_celular) or ( $resp_persona["tsan_id"] != $tsan_id) or ( $resp_persona["pai_id_domicilio"] != $pai_id_domicilio) or ( $resp_persona["pro_id_domicilio"] != $pro_id_domicilio) or ( $resp_persona["can_id_domicilio"] != $can_id_domicilio) or ( $resp_persona["per_domicilio_telefono"] != $per_domicilio_telefono) or ( $resp_persona["per_domicilio_sector"] != $per_domicilio_sector) or ( $resp_persona["per_domicilio_cpri"] != $per_domicilio_cpri) or ( $resp_persona["per_domicilio_cpri"] != $per_domicilio_cpri) or ( $resp_persona["per_domicilio_csec"] != $per_domicilio_csec) or ( $resp_persona["per_domicilio_num"] != $per_domicilio_num) or ( $resp_persona["per_domicilio_ref"] != $per_domicilio_ref) or ( $resp_persona["per_foto"] != $per_foto) or ( $resp_contacto["nombre"] != $cgen_nombre) or ( $resp_contacto["apellido"] != $cgen_apellido) or ( $resp_contacto["telefono"] != $cgen_telefono) or ( $resp_contacto["celular"] != $cgen_celular) or ( $resp_contacto["direccion"] != $cgen_direccion) or ( $tipo != $tpar_id) or ( $per_cor_institucional != $resp_correoinst["pcin_correo"]) or ( $etniaotra != $respOtraEtnia["oetn_nombre"];
                    if (($resp_persona["per_pri_nombre"] != $per_pri_nombre) or ( $resp_persona["per_seg_nombre"] != $per_seg_nombre) or ( $resp_persona["per_pri_apellido"] != $per_pri_apellido) or ( $resp_persona["per_seg_apellido"] != $per_seg_apellido) or ( $resp_persona["per_genero"] != $per_genero) or ( $resp_persona["etn_id"] != $etn_id) or ( $resp_persona["eciv_id"] != $eciv_id) or ( $resp_persona["per_fecha_nacimiento"] != $per_fecha_nacimiento) or ( $resp_persona["per_nacionalidad"] != $per_nacionalidad) or ( $resp_persona["pai_id_nacimiento"] != $pai_id_nacimiento) or ( $resp_persona["pro_id_nacimiento"] != $pro_id_nacimiento) or ( $resp_persona["can_id_nacimiento"] != $can_id_nacimiento) or ( $resp_persona["per_correo"] != $per_correo) or ( $resp_persona["per_telefono"] != $per_telefono) or ( $resp_persona["per_celular"] != $per_celular) or ( $resp_persona["tsan_id"] != $tsan_id) or ( $resp_persona["pai_id_domicilio"] != $pai_id_domicilio) or ( $resp_persona["pro_id_domicilio"] != $pro_id_domicilio) or ( $resp_persona["can_id_domicilio"] != $can_id_domicilio) or ( $resp_persona["per_domicilio_telefono"] != $per_domicilio_telefono) or ( $resp_persona["per_domicilio_sector"] != $per_domicilio_sector) or ( $resp_persona["per_domicilio_cpri"] != $per_domicilio_cpri) or ( $resp_persona["per_domicilio_cpri"] != $per_domicilio_cpri) or ( $resp_persona["per_domicilio_csec"] != $per_domicilio_csec) or ( $resp_persona["per_domicilio_num"] != $per_domicilio_num) or ( $resp_persona["per_domicilio_ref"] != $per_domicilio_ref) or ( $resp_persona["per_foto"] != $per_foto) or ( $resp_contacto["nombre"] != $cgen_nombre) or ( $resp_contacto["apellido"] != $cgen_apellido) or ( $resp_contacto["telefono"] != $cgen_telefono) or ( $resp_contacto["celular"] != $cgen_celular) or ( $resp_contacto["direccion"] != $cgen_direccion) or ( $tipo != $tpar_id) or ( $per_cor_institucional != $resp_correoinst["pcin_correo"]) or ( $etniaotra != $respOtraEtnia["oetn_nombre"])) { 
                        $respPersona = $modpersona->modificaPersona($per_id, $per_pri_nombre, $per_seg_nombre, $per_pri_apellido, $per_seg_apellido, $etn_id, $eciv_id, $per_genero, $pai_id_nacimiento, $pro_id_nacimiento, $can_id_nacimiento, $per_fecha_nacimiento, $per_celular, $per_correo, $tsan_id, $per_domicilio_sector, $per_domicilio_cpri, $per_domicilio_csec, $per_domicilio_num, $per_domicilio_ref, $per_domicilio_telefono, $pai_id_domicilio, $pro_id_domicilio, $can_id_domicilio, $per_nac_ecuatoriano, $per_nacionalidad, $foto_archivo);                        
                        // si es diferente de vacío guardar otra etnia.                         
                        if (!empty($etniaotra) and $etn_id == 6) {
                            //Se verifica si existe, se modifican los datos.
                            $respconsOtraEtnia = $modpersona->consultarOtraetnia($per_id);
                            if ($respconsOtraEtnia) {
                                $respOtraEtnia = $modpersona->modificarOtraEtnia($per_id, $etniaotra, '1');
                            } else {
                                $respOtraEtnia = $modpersona->crearOtraEtnia($per_id, $etniaotra);
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
                        $resp_expediente = $modexpprofesor->consultarExpedienteProfesor($per_id);
                        if (!($resp_expediente)) {                                                             
                            //Crear registro en expediente profesor.
                            $respid_expediente = $modexpprofesor->insertarExpediente($per_id);                                    
                        } else {
                            $respid_expediente = $resp_expediente["epro_id"];                             
                        }                            
                        // validar que si esta vacio no llame a guardar              
                        if (empty($cgen_nombre) && empty($cgen_apellido) && empty($cgen_telefono) && empty($cgen_celular) && empty($cgen_direccion)) {
                            $sincontacto = 1;
                        }
                        if ($sincontacto != 1) {                            
                            $respContactoGeneral = $modcontactogeneral->consultarContactoGeneral($per_id);
                            if ($respContactoGeneral) {                                 
                                $respContactoGeneral = $respContactoGeneral['contacto_id'];
                                $respContacto = $modcontactogeneral->modificarContactoGeneral($respContactoGeneral, $per_id, $cgen_nombre, $cgen_apellido, $tpar_id, $cgen_direccion, $cgen_telefono, $cgen_celular);                                 
                                if ($respContacto) {
                                    $exito = 1;                                        
                                }
                            } else {   
                                //$mensaje= $per_id .'/'.$cgen_nombre.'/'. $cgen_apellido.'/'. $tpar_id.'/'. $cgen_direccion.'/'. $cgen_telefono.'/'. $cgen_celular;
                                $respContacto = $modcontactogeneral->insertarContactoGeneral($per_id, $cgen_nombre, $cgen_apellido, $tpar_id, $cgen_direccion, $cgen_telefono, $cgen_celular);
                                //Obtener datos del contacto                                                                   
                                $resp_contactogen = $modcontactogeneral->consultarContactoGeneral($per_id);
                                $contacto = $resp_contactogen["contacto_id"];
                                if ($respid_expediente) {                                    
                                    //Registrar en tabla expediente del profesor el código de contacto.                                    
                                    $resp_modexpediente = $modexpprofesor->modificaExpediente($per_id, $contacto, null, null, null);
                                    if ($resp_modexpediente) {
                                        $exito = 1;
                                    }
                                }
                            }
                        } else {
                            $exito = 2;
                        }
                        //Discapacidad
                        if ($discapacidad == '1') {
                            //Verificamos si hay un archivo Documento que certifique la discapacidad                                                                                  
                            $foto_archivo9 = "";
                            if (isset($doc_adj_disc) && ($doc_adj_disc != "")) {
                                $arrIm = explode(".", basename($doc_adj_disc));
                                $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                                $ruta = $arrIm[0];
                                $foto_archivo9 = Yii::$app->params["documentFolder"] . "expedienteprofesor/" . $per_id . "/" . $ruta ."_per_" . $per_id. ".". $typeFile;
                            }
                            $respConsDisc = $modexpprofesor->consultarDiscapacidad($per_id);
                            if ($respConsDisc) {  //Se modifica la discapacidad.
                                $resp_discapidad = $modexpprofesor->modificarDiscapacidad($respConsDisc["ipdi_id"], $tipo_discap, $per_id, $carnet_conadi, $tipo_discap, $por_discapacidad, $doc_adj_disc, $foto_archivo9);                                
                            } else {  //Se inserta discapacidad.-                                                          
                                $resp_discapidad = $modexpprofesor->insertarDiscapacidad($tipo_discap, $per_id, $carnet_conadi, $tipo_discap, $por_discapacidad, $doc_adj_disc, $foto_archivo9);                                
                            }
                            if ($resp_discapidad) {
                                $exito = 1;
                            }
                        }
                    }
                    
                    $resp_profesor = $modexpprofesor->consultarExpedienteProfesor($per_id);
                    if ($resp_profesor) {  //Verificar si existe el profesor en tabla de expediente del profesor.
                        if (!empty($dataLSFamiliar) or ! empty($dataLSFamiliarIns)) {                                                                                                        
                            for ($i = 0; $i < count($dataLSFamiliar); $i++) {                                    
                                //Guardado Datos Familiares que vivan con profesor.   
                                $dafa_nombres = ucwords(strtolower($dataLSFamiliar[$i]["dafa_nombres"]));
                                $dafa_apellidos = ucwords(strtolower($dataLSFamiliar[$i]["dafa_apellidos"]));
                                $dafa_fecha_nacimiento = $dataLSFamiliar[$i]["dafa_fecha_nacimiento"];
                                $tpar_id = $dataLSFamiliar[$i]["tpar_id"];
                                $dafa_carga_familiar = $dataLSFamiliar[$i]["dafa_carga_familiar"];
                                $tdis_id = $dataLSFamiliar[$i]["tdis_id"];
                                $idis_porcentaje = $dataLSFamiliar[$i]["idis_porcentaje"];
                                $idis_carnet_conadis = $dataLSFamiliar[$i]["idis_carnet_conadis"];
                                $idis_ruta = $dataLSFamiliar[$i]["idis_ruta"];
                                $dafa_ocupacion = ucwords(strtolower($dataLSFamiliar[$i]["dafa_ocupacion"]));
                                $idis_discapacidad = $dataLSFamiliar[$i]["idis_discapacidad"];
                                $dafa_imagenfam = null;
                                $dafa_id= $dataLSFamiliar[$i]["dafa_id"];
                                //Verificamos si hay un archivo Documento que certifique que es familiar                                       
                                if ($dafa_id ==0) {
                                    $foto_archfamilia = "";
                                    if (isset($dafa_imagenfam) && ($dafa_imagenfam != "")) {
                                        $arrIm = explode(".", basename($dafa_imagenfam));
                                        $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                                        $rutafam = $arrIm[0] . "." . $typeFile;
                                        $foto_archfamilia = Yii::$app->params["documentFolder"] . "expedienteprofesor/" . $per_id . "/" . $rutafam;
                                    }                                   
                                    $tafam_id = 1;  //familiares que viven con profesor.                                 
                                    //Se registra si el familiar tiene discapacidad.
                                    if ($idis_discapacidad == "1") {  //si tiene discapacidad.
                                        $foto_archivo1 = "";                                            
                                        if (isset($idis_ruta) && ($idis_ruta != "")) {
                                            $arrIm = explode(".", basename($idis_ruta));
                                            $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                                            $ruta = $arrIm[0];
                                            $foto_archivo1 = Yii::$app->params["documentFolder"] . "expedienteprofesor/" . $per_id . "/" . $ruta . "_per_" . $per_id. ".". $typeFile;
                                        }
                                        //$mensaje = $tdis_id.'/'.$idis_carnet_conadis.'/'.$idis_porcentaje.'/'.$foto_archivo1.'/2';                                           
                                        $resp_discapacidad = $modexpprofesor->insertarDiscapacidad($tdis_id, null, $idis_carnet_conadis, $tdis_id, $idis_porcentaje, $foto_archivo1, $foto_archivo1);
                                    } else {
                                        $resp_discapacidad = null;
                                    }                                    
                                    //Se inserta el detalle de antecedentes familiares                                      
                                    //$mensaje = $per_id."/".$tpar_id."/".$tafam_id."/".$dafa_nombres."/".$dafa_apellidos."/".$dafa_fecha_nacimiento."/".$dafa_ocupacion."/".$dafa_carga_familiar."/".$resp_discapacidad;
                                    $resp_detalleantec = $modexpprofesor->insertarDet_antecedentesfam($per_id, $tpar_id, $tafam_id, $dafa_nombres, $dafa_apellidos, $dafa_fecha_nacimiento, $dafa_ocupacion, null, $dafa_carga_familiar, $resp_discapacidad, null);
                                    if ($resp_detalleantec) {
                                        $exito = 1;
                                    }
                                }
                            }
                            //Datos de familiares en la institución.
                            for ($j = 0; $j < count($dataLSFamiliarIns); $j++) {
                                $dafa_nombres_ins = ucwords(strtolower($dataLSFamiliarIns[$j]["dafa_nombres"]));
                                $dafa_apellidos_ins = ucwords(strtolower($dataLSFamiliarIns[$j]["dafa_apellidos"]));
                                $tpar_idins = $dataLSFamiliarIns[$j]["tpar_id"];
                                $dafa_ruta = $dataLSFamiliarIns[$j]["dafa_documento"];                                    
                                $dafa_id= $dataLSFamiliarIns[$j]["dafa_id"];                                      
                                if ($dafa_id ==0) {                                        
                                    //Verificamos si hay un archivo Documento que certifique.                                                                                  
                                    $foto_archivo2 = "";                                
                                    $tafam_id = 2;  //familiares de la institución.                                 
                                    //Se inserta el detalle de antecedentes familiares     
                                    $mensaje=2;
                                    $resp_detalleantec = $modexpprofesor->insertarDet_antecedentesfam($per_id, $tpar_idins, $tafam_id, $dafa_nombres_ins, $dafa_apellidos_ins, null, null, null, null, null, $foto_archivo2);
                                    if ($resp_detalleantec) {
                                        $exito = 1;
                                    }
                                }                                   
                            }
                        }                                
                        //Guardado de Detalle Estudios Superiores del profesor.  
                        if ((!empty($dataLSEstSuperior)) or ( !empty($dataLSEstActuales)) or ( !empty($dataLSReconocimiento)) or ( !empty($dataLSIdiomas)) or ( !empty($dataLSCapacitacion))) {                                                     
                            for ($i = 0; $i < count($dataLSEstSuperior); $i++) {
                                $mensaje = '1';
                                $dicu_nivel_ins = $dataLSEstSuperior[$i]["dicu_nivel_ins"];
                                $dicu_titulo = ucwords(strtolower($dataLSEstSuperior[$i]["dicu_titulo"]));
                                $dicu_fecha_registro = $dataLSEstSuperior[$i]["dicu_fecha_registro"];
                                $dicu_numero_registro = $dataLSEstSuperior[$i]["dicu_numero_registro"];
                                $ins_id = $dataLSEstSuperior[$i]["dicu_institucion"];
                                $dicu_otra_institucion = ucwords(strtolower($dataLSEstSuperior[$i]["dicu_otra_ins"]));
                                $dicu_documento = $dataLSEstSuperior[$i]["dicu_documento"];
                                $dicu_nombre_institucion = null;
                                $dicu_id = $dataLSEstSuperior[$i]["dicu_id"];
                                $dicu_areacon = $dataLSEstSuperior[$i]["dicu_areacon"];
                                $dicu_subareacon = $dataLSEstSuperior[$i]["dicu_subareacon"];
                                        
                                if ($dicu_otra_institucion == "1") {
                                    $dicu_nombre_institucion = ucwords(strtolower($dataLSEstSuperior[$i]["dicu_nombre_institucion"]));
                                    $ins_id = null;
                                }                                       
                                //Verificamos si hay un archivo Documento que certifique.                                                                                  
                                $foto_archivo3 = "";
                                if (isset($dicu_documento) && ($dicu_documento != "")) {
                                    $arrIm = explode(".", basename($dicu_documento));
                                    $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                                    $ruta = $arrIm[0];
                                    $foto_archivo3 = Yii::$app->params["documentFolder"] . "expedienteprofesor/" . $per_id . "/" . $ruta ."_per_" . $per_id.".". $typeFile;
                                }                                    
                                if ($dicu_id==0) {
                                    //Se inserta el detalle de estudios superiores  
                                    $tcur_id = 1; //Estudios superiores.                                            
                                    $resp_detestsup = $modexpprofesor->insertarDet_infocurricular($per_id, $dicu_nivel_ins, $ins_id, $tcur_id, $dicu_nombre_institucion, $dicu_titulo, $dicu_fecha_registro, $dicu_numero_registro, $foto_archivo3, $dicu_areacon, $dicu_subareacon);
                                    if ($resp_detestsup) {
                                        $exito = 1;
                                    }
                                }
                            }
                            //Estudios Actuales.
                            for ($i = 0; $i < count($dataLSEstActuales); $i++) {
                                $dicu_nivel_ins = $dataLSEstActuales[$i]["dicu_nivel_ins"];
                                $dicu_titulo = ucwords(strtolower($dataLSEstActuales[$i]["dicu_titulo"]));
                                $dicu_fecha_ingreso = $dataLSEstActuales[$i]["dicu_fecha_registro"];
                                $ins_id = $dataLSEstActuales[$i]["dicu_institucion"];
                                $dicu_otra_institucion = ucwords(strtolower($dataLSEstActuales[$i]["dicu_otra_ins"]));
                                $dicu_documento = $dataLSEstActuales[$i]["dicu_documento"];
                                $dicu_nombre_institucion = null;
                                $dicu_id = $dataLSEstActuales[$i]["dicu_id"];
                                $dicu_areacon = $dataLSEstActuales[$i]["dicu_areacon"];
                                $dicu_subareacon = $dataLSEstActuales[$i]["dicu_subareacon"];

                                if ($dicu_otra_institucion == "1") {
                                    $dicu_nombre_institucion = ucwords(strtolower($dataLSEstActuales[$i]["dicu_nombre_institucion"]));
                                    $ins_id = null;
                                }
                                //Verificamos si hay un archivo Documento que certifique.                                                                                  
                                $foto_archivo4 = "";
                                if (isset($dicu_documento) && ($dicu_documento != "")) {
                                    $arrIm = explode(".", basename($dicu_documento));
                                    $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                                    $ruta = $arrIm[0];
                                    $foto_archivo4 = Yii::$app->params["documentFolder"] . "expedienteprofesor/" . $per_id . "/" . $ruta . "_per_" . $per_id.".". $typeFile;;
                                }
                                if ($dicu_id==0) {
                                    //Se inserta el detalle de estudios actuales  
                                    $tcur_id = 2; //Estudios actuales.                                                    
                                    $resp_detestact = $modexpprofesor->insertarDet_infocurricular($per_id, $dicu_nivel_ins, $ins_id, $tcur_id, $dicu_nombre_institucion, $dicu_titulo, $dicu_fecha_ingreso, null, $foto_archivo4, $dicu_areacon, $dicu_subareacon);
                                    if ($resp_detestact) {
                                        $exito = 1;                                            
                                    }
                                }
                            }
                            //Detalle de Reconocimientos.                                                       
                            for ($i = 0; $i < count($dataLSReconocimiento); $i++) {
                                $dicu_reconocimiento = ucwords(strtolower($dataLSReconocimiento[$i]["dicu_titulo"]));
                                $dicu_fecha_logro = $dataLSReconocimiento[$i]["dicu_fecha_registro"];
                                $ins_id = $dataLSReconocimiento[$i]["dicu_institucion"];
                                $dicu_otra_institucion = ucwords(strtolower($dataLSReconocimiento[$i]["dicu_otra_ins"]));
                                $dicu_nombre_institucion = null;
                                $dicu_id = $dataLSReconocimiento[$i]["dicu_id"];

                                if ($dicu_otra_institucion == "1") {
                                    $dicu_nombre_institucion = ucwords(strtolower($dataLSReconocimiento[$i]["dicu_nombre_institucion"]));
                                    $ins_id = null;
                                }
                                if ($dicu_id==0) {
                                    //Se inserta el detalle de reconocimientos académicos
                                    $tcur_id = 3; //Reconocimientos                                                                                                               
                                    $resp_detrecono = $modexpprofesor->insertarDet_infocurricular($per_id, $dicu_nivel_ins, $ins_id, $tcur_id, $dicu_nombre_institucion, $dicu_reconocimiento, $dicu_fecha_logro, null, null, null, null);
                                    if ($resp_detrecono) {
                                        $exito = 1;                                            
                                    }
                                }
                            }
                            //Detalle de Idiomas
                            for ($i = 0; $i < count($dataLSIdiomas); $i++) {
                                $rxi_idioma = $dataLSIdiomas[$i]["rxi_nombre_idioma"];
                                $rxi_nombre_idioma = ucwords(strtolower($dataLSIdiomas[$i]["rxi_des_idioma"]));
                                $rxi_institucion = $dataLSIdiomas[$i]["rxi_institucion"];
                                $rxi_criterio_hablado = $dataLSIdiomas[$i]["rxi_comprension_hablado"];
                                $rxi_criterio_escrito = $dataLSIdiomas[$i]["rxi_comprension_escrito"];
                                $rxi_criterio_lectura = $dataLSIdiomas[$i]["rxi_comprension_lectura"];
                                $rxi_criterio_auditivo = $dataLSIdiomas[$i]["rxi_comprension_auditiva"];
                                $rxi_documento = $dataLSIdiomas[$i]["rxi_documento"];
                                $rxi_otro_lenguaje = $dataLSIdiomas[$i]["rxi_otro_lenguaje"];
                                $rxi_otro_idioma = null;
                                $rxi_id =  $dataLSIdiomas[$i]["rxi_id"];
                                if ($rxi_otro_lenguaje == "1") {
                                    $rxi_idioma = null;
                                    $rxi_otro_idioma = $rxi_nombre_idioma;
                                }
                                //Verificamos si hay un archivo Documento que certifique.                                                                                  
                                $foto_archivo5 = "";
                                if (isset($rxi_documento) && ($rxi_documento != "")) {
                                    $arrIm = explode(".", basename($rxi_documento));
                                    $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                                    $ruta = $arrIm[0];
                                    $foto_archivo5 = Yii::$app->params["documentFolder"] . "expedienteprofesor/" . $per_id . "/" . $ruta . "_per_" . $per_id.".". $typeFile;
                                }
                                if ($rxi_id==0) {
                                    //Se inserta el detalle de idiomas                             
                                    if (!empty($rxi_criterio_hablado)) {
                                        $valor = $rxi_criterio_hablado;
                                        $criterio = 1;
                                        switch ($valor):
                                            case 1:
                                                $nivel = 1;
                                                break;
                                            case 2:
                                                $nivel = 2;
                                                break;
                                            case 3:
                                                $nivel = 3;
                                                break;
                                        endswitch;

                                        $resp_detidiomas = $modexpprofesor->insertarResultadoxidioma($per_id, $rxi_idioma, $criterio, $nivel, $rxi_institucion, $foto_archivo5, $rxi_otro_idioma);
                                        if (!($resp_detidiomas)) {
                                            $errorgraba = 1;
                                            $mensaje = "Error al grabar Comprensión Hablado en el idioma: " . $rxi_nombre_idioma;
                                        }
                                    }
                                    if (!empty($rxi_criterio_escrito)) {
                                        $valor = $rxi_criterio_escrito;
                                        $criterio = 2;
                                        switch ($valor):
                                            case 4:
                                                $nivel = 1;
                                                break;
                                            case 5:
                                                $nivel = 2;
                                                break;
                                            case 6:
                                                $nivel = 3;
                                                break;
                                        endswitch;
                                        $resp_detidiomas = $modexpprofesor->insertarResultadoxidioma($per_id, $rxi_idioma, $criterio, $nivel, $rxi_institucion, $foto_archivo5, $rxi_otro_idioma);
                                        if (!($resp_detidiomas)) {
                                            $errorgraba = 1;
                                            $mensaje = "Error al grabar Comprensión Escrita en el idioma: " . $rxi_nombre_idioma;
                                        }
                                    }
                                    if (!empty($rxi_criterio_lectura)) {
                                        $valor = $rxi_criterio_lectura;
                                        $criterio = 3;
                                        switch ($valor):
                                            case 7:
                                                $nivel = 1;
                                                break;
                                            case 8:
                                                $nivel = 2;
                                                break;
                                            case 9:
                                                $nivel = 3;
                                                break;
                                        endswitch;
                                        $resp_detidiomas = $modexpprofesor->insertarResultadoxidioma($per_id, $rxi_idioma, $criterio, $nivel, $rxi_institucion, $foto_archivo5, $rxi_otro_idioma);
                                        if (!($resp_detidiomas)) {
                                            $errorgraba = 1;
                                            $mensaje = "Error al grabar Comprensión Lectura en el idioma: " . $rxi_nombre_idioma;
                                        }
                                    }
                                    if (!empty($rxi_criterio_auditivo)) {
                                        $valor = $rxi_criterio_auditivo;
                                        $criterio = 4;
                                        switch ($valor):
                                            case 10:
                                                $nivel = 1;
                                                break;
                                            case 11:
                                                $nivel = 2;
                                                break;
                                            case 12:
                                                $nivel = 3;
                                                break;
                                        endswitch;
                                        $resp_detidiomas = $modexpprofesor->insertarResultadoxidioma($per_id, $rxi_idioma, $criterio, $nivel, $rxi_institucion, $foto_archivo5, $rxi_otro_idioma);
                                        if (!($resp_detidiomas)) {
                                            $errorgraba = 1;
                                            $mensaje = "Error al grabar Comprensión Auditiva en el idioma: " . $rxi_nombre_idioma;
                                        }
                                    }
                                    if ($errorgraba == 1) {
                                        $exito = 0;
                                    } else {
                                        $exito = 1;                                            
                                    }
                                }
                            }
                            //Detalle de ingreso de capacitaciones.
                            for ($i = 0; $i < count($dataLSCapacitacion); $i++) {
                                $cap_nombre_curso = ucwords(strtolower($dataLSCapacitacion[$i]["cap_nombre_curso"]));
                                $cap_tipo_curso = $dataLSCapacitacion[$i]["cap_tipo_curso"];
                                $cap_modalidad = $dataLSCapacitacion[$i]["cap_modalidad"];
                                $cap_nombre_institucion = ucwords(strtolower($dataLSCapacitacion[$i]["cap_nombre_institucion"]));
                                $cap_tipo_diploma = $dataLSCapacitacion[$i]["cap_tipo_diploma"];
                                $cap_duracion = $dataLSCapacitacion[$i]["cap_duracion"];
                                $cap_fecha_inicio = $dataLSCapacitacion[$i]["cap_fecha_inicio"];
                                $cap_fecha_fin = $dataLSCapacitacion[$i]["cap_fecha_fin"];
                                $cap_documento = $dataLSCapacitacion[$i]["cap_documento"];
                                $cap_actual = $dataLSCapacitacion[$i]["cap_actual"];
                                $cap_id = $dataLSCapacitacion[$i]["cap_id"];

                                //Verificamos si hay un archivo Documento que certifique la discapacidad                                                                                  
                                $foto_archivo6 = "";
                                if (isset($cap_documento) && ($cap_documento != "")) {
                                    $arrIm = explode(".", basename($cap_documento));
                                    $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                                    $ruta = $arrIm[0];
                                    $foto_archivo6 = Yii::$app->params["documentFolder"] . "expedienteprofesor/" . $per_id . "/" . $ruta ."_per_" . $per_id ."." . $typeFile;
                                }
                                if ($cap_actual == '1') {
                                    $cap_fecha_fin = null;
                                }
                                if ($cap_id==0) {
                                    $resp_detcapacitacion = $modexpprofesor->insertarDet_capacitacion($per_id, $cap_tipo_curso, $cap_tipo_diploma, $cap_modalidad, $cap_nombre_curso, $cap_nombre_institucion, $cap_duracion, $cap_fecha_inicio, $cap_fecha_fin, $foto_archivo6, $cap_actual);
                                    if ($resp_detcapacitacion) {
                                        $exito = 1;
                                    }
                                }
                            }                         
                        }

                        //Guardado de experiencia laboral y docencia
                        if ((!empty($dataLSExpLaboral)) or ( !empty($dataLSExpDocencia))) {                              
                            //Información de experiencia laboral.
                            for ($i = 0; $i < count($dataLSExpLaboral); $i++) {
                                $dela_tipo_empresa = $dataLSExpLaboral[$i]["dela_tipo_emp"];
                                $dela_pais = $dataLSExpLaboral[$i]["dela_pais"];
                                $dela_empresa = ucwords(strtolower($dataLSExpLaboral[$i]["dela_empresa"]));
                                $dela_cargo = ucwords(strtolower($dataLSExpLaboral[$i]["dela_cargo"]));
                                $dela_inicio_labores = $dataLSExpLaboral[$i]["dela_fecha_inicio"];
                                $dela_fin_labores = $dataLSExpLaboral[$i]["dela_fecha_fin"];
                                $dela_actualidad = $dataLSExpLaboral[$i]["dela_actualidad"];
                                $dela_telefono_empresa = $dataLSExpLaboral[$i]["dela_telef_empresa"];
                                $dela_contacto = ucwords(strtolower($dataLSExpLaboral[$i]["dela_nombre_contacto"]));
                                $dela_telef_contacto = $dataLSExpLaboral[$i]["dela_telef_contacto"];
                                $dela_id = $dataLSExpLaboral[$i]["dela_id"];

                                if ($dela_actualidad == '1') {
                                    $dela_fin_labores = null;
                                }
                                if ((!empty($dela_contacto)) or ( !empty($dela_telef_contacto)) or ( !empty($dela_telefono_empresa))) {
                                    $icon_tipo_contacto = 2;
                                    if (empty($dela_telef_contacto)) {
                                        $dela_telef_contacto = $dela_telefono_empresa;
                                    }
                                    if ($dela_id==0) {
                                        $resp_contacto = $modexpprofesor->insertarInf_contacto($per_id, $dela_contacto, null, $dela_telef_contacto, null, null, $icon_tipo_contacto);
                                        if ($resp_contacto) {
                                            $contacto = 1;
                                        }
                                    }
                                } else {
                                    $contacto = 1;
                                }
                                if ($contacto) {
                                    if ($dela_id==0) {
                                        $resp_detexplaboral = $modexpprofesor->insertarDet_experiencialab($per_id, $dela_tipo_empresa, $dela_pais, $dela_empresa, $dela_cargo, $dela_inicio_labores, $dela_fin_labores, $dela_actualidad, $resp_contacto);
                                        if ($resp_detexplaboral) {
                                            $exito = 1;
                                        }
                                    }
                                }
                            }
                            //Información de experiencia en docencia.
                            for ($i = 0; $i < count($dataLSExpDocencia); $i++) {
                                $dedo_exp_docencia = $dataLSExpDocencia[$i]["dedo_exp_docencia"];
                                if ($dedo_exp_docencia == '1') {
                                    $dedo_pais = $dataLSExpDocencia[$i]["dedo_pais"];
                                    $dedo_institucion = $dataLSExpDocencia[$i]["dedo_institucion"];
                                    $dedo_des_institucion = ucwords(strtolower($dataLSExpDocencia[$i]["dedo_des_institucion"]));
                                    $dedo_areaconoc = $dataLSExpDocencia[$i]["dedo_areaconoc"];
                                    $dedo_catedra = $dataLSExpDocencia[$i]["dedo_catedra"];
                                    $dedo_tiempodedica = $dataLSExpDocencia[$i]["dedo_tiempodedica"];
                                    $dedo_des_tiempodedica = $dataLSExpDocencia[$i]["dedo_des_tiempodedica"];
                                    $dedo_tipo_relacion = $dataLSExpDocencia[$i]["dedo_tipo_relacion"];
                                    $dedo_direccion = ucwords(strtolower($dataLSExpDocencia[$i]["dedo_direccion"]));
                                    $dedo_telefono = $dataLSExpDocencia[$i]["dedo_telefono"];
                                    $dedo_fecha_inicio = $dataLSExpDocencia[$i]["dedo_fecha_inicio"];
                                    $dedo_fecha_fin = $dataLSExpDocencia[$i]["dedo_fecha_fin"];
                                    $dedo_actual = $dataLSExpDocencia[$i]["dedo_actual"];
                                    $dedo_telef_contacto = $dataLSExpDocencia[$i]["dedo_telef_contacto"];
                                    $dedo_contacto = ucwords(strtolower($dataLSExpDocencia[$i]["dedo_contacto"]));
                                    $otra_institucion = $dataLSExpDocencia[$i]["otra_institucion"];
                                    $dedo_subareacon = $dataLSExpDocencia[$i]["dedo_subareacon"];
                                    $dedo_id = $dataLSExpDocencia[$i]["dedo_id"];

                                    if ($otra_institucion == "1") {
                                        $dedo_otra_institucion = $dedo_des_institucion;
                                    }
                                    //Se inserta el detalle de experiencia docencia 
                                    if ($dedo_actual == '1') {
                                        $dedo_fecha_fin = null;
                                    };

                                    if ((!empty($dedo_contacto)) or ( !empty($dedo_telef_contacto))) {
                                        $icon_tipo_contacto = 3;
                                        if ($dedo_id==0) {
                                            $resp_contacto = $modexpprofesor->insertarInf_contacto($per_id, $dedo_contacto, null, $dedo_telef_contacto, null, null, $icon_tipo_contacto);
                                            if ($resp_contacto) {
                                                $contacto = 1;
                                            }
                                        }
                                    } else {
                                        $contacto = 1;
                                    }
                                    if ($contacto) {
                                        $dedo_catedra = null;
                                        if ($dedo_id==0) {
                                            $resp_detexpdocencia = $modexpprofesor->insertarDet_expdocencia($per_id, $dedo_institucion, $dedo_otra_institucion, $dedo_areaconoc, $dedo_catedra, $dedo_tiempodedica, $dedo_tipo_relacion, $dedo_direccion, $dedo_telefono, $dedo_fecha_inicio, $dedo_fecha_fin, $dedo_actual, $resp_contacto, $dedo_subareacon);
                                            if ($resp_detexpdocencia) {
                                                $exito = 1;
                                            }
                                        }
                                    }
                                }
                            }
                        }                      
                        //Guardado de investigación
                        if ((!empty($dataLSInvestigacion))) {                                                        
                            for ($i = 0; $i < count($dataLSInvestigacion); $i++) {
                                $dinv_tiene_investigaciones = $dataLSInvestigacion[$i]["dinv_tiene_investigaciones"];
                                $dinv_nombre_proyecto = ucwords(strtolower($dataLSInvestigacion[$i]["dinv_nombre_proyecto"]));
                                $dinv_responsabilidad = ucwords(strtolower($dataLSInvestigacion[$i]["dinv_responsabilidad"]));
                                $dinv_fechainicio = $dataLSInvestigacion[$i]["dinv_fechainicio"];
                                $dinv_fechafin = $dataLSInvestigacion[$i]["dinv_fechafin"];
                                $dinv_actual = $dataLSInvestigacion[$i]["dinv_actual"];
                                $dinv_documento = $dataLSInvestigacion[$i]["dinv_documento"];
                                $dinv_id = $dataLSInvestigacion[$i]["dinv_id"];
                                $dinv_financiado = $dataLSInvestigacion[$i]["dinv_financia"];
                                $dinv_instfinancia = $dataLSInvestigacion[$i]["dinv_instfinancia"];
                                
                                //Verificamos si hay un archivo Documento que certifique.                                                                                  
                                $foto_archivo7 = "";
                                if (isset($dinv_documento) && ($dinv_documento != "")) {
                                    $arrIm = explode(".", basename($dinv_documento));
                                    $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                                    $ruta = $arrIm[0];
                                    $foto_archivo7 = Yii::$app->params["documentFolder"] . "expedienteprofesor/" . $per_id . "/" . $ruta . "_per_" . $per_id. ".". $typeFile;
                                }

                                if ($dinv_tiene_investigaciones == "1") {
                                    //Se inserta el detalle de investigación.-   
                                    if ($dinv_actual == '1') {
                                        $dinv_fechafin = null;
                                    };
                                    if ($dinv_id==0) {
                                        $resp_detinvestigacion = $modexpprofesor->insertarDet_investigacion($per_id, $dinv_nombre_proyecto, $dinv_responsabilidad, $dinv_fechainicio, $dinv_fechafin, $dinv_actual, $foto_archivo7, $dinv_financiado, $dinv_instfinancia);
                                        if ($resp_detinvestigacion) {
                                            $exito = 1;
                                        }
                                    }
                                }
                            }
                        }                                         
                        //Guardado de publicación, codirección.
                        if ((!empty($dataLSPublicacion)) or ( !empty($dataLSCodireccion)) or ( !empty($dataLSPonencia))) {                                        
                            for ($i = 0; $i < count($dataLSPublicacion); $i++) {
                                $tpub_id = $dataLSPublicacion[$i]["dpub_tipo_publicacion"];
                                $dpub_titulo = ucwords(strtolower($dataLSPublicacion[$i]["dpub_titulo"]));
                                $dpub_fecha_publicacion = $dataLSPublicacion[$i]["dpub_fecha_publicacion"];
                                $dpub_publicacion = $dataLSPublicacion[$i]["dpub_publicacion"];
                                $dpub_nombre_publicacion = ucwords(strtolower($dataLSPublicacion[$i]["dpub_nombre_publicacion"]));
                                $dpub_numero_isbn = $dataLSPublicacion[$i]["dpub_numero_issn_isbn"];
                                $dpub_url = ucwords(strtolower($dataLSPublicacion[$i]["dpub_url"]));
                                $dpub_documento = $dataLSPublicacion[$i]["dpub_documento"];
                                $dpub_actual = $dataLSPublicacion[$i]["dpub_proceso"];                                
                                $dpub_id = $dataLSPublicacion[$i]["dpub_id"];                                   

                                //Verificamos si hay un archivo Documento que certifique.                                                                                  
                                $foto_archivo8 = "";
                                if (isset($dpub_documento) && ($dpub_documento != "")) {
                                    $arrIm = explode(".", basename($dpub_documento));
                                    $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                                    $ruta = $arrIm[0];
                                    $foto_archivo8 = Yii::$app->params["documentFolder"] . "expedienteprofesor/" . $per_id . "/" . $ruta ."_per_" . $per_id. "." . $typeFile;
                                }
                                if ($dpub_actual == '1') {
                                    $dpub_fecha_publicacion = null;
                                }

                                if ($dpub_id==0) {
                                    //Se inserta el detalle de publicación.-                                                          
                                    $resp_detpublicacion = $modexpprofesor->insertarDet_publicacion($per_id, $tpub_id, $dpub_titulo, $dpub_fecha_publicacion, $dpub_publicacion, $dpub_nombre_publicacion, $dpub_numero_isbn, $dpub_actual, $dpub_url, $foto_archivo8);
                                    if ($resp_detpublicacion) {
                                        $exito = 1;
                                    }
                                }
                            }
                            //Codirección.
                            for ($i = 0; $i < count($dataLSCodireccion); $i++) {
                                $itut_tipo_codireccion = $dataLSCodireccion[$i]["itut_tipo_codireccion"];
                                $itut_pais = $dataLSCodireccion[$i]["itut_pais"];
                                $itut_institucion_codirec = $dataLSCodireccion[$i]["itut_institucion_codirec"];
                                $itut_otrainst_codireccion = $dataLSCodireccion[$i]["itut_otrainst_codireccion"];
                                $itut_des_otrainst = ucwords(strtolower($dataLSCodireccion[$i]["itut_des_institucion"]));
                                $itut_anio_aprobacion = substr($dataLSCodireccion[$i]["itut_anio_aprobacion"], 0, 4);                                
                                $itut_id = $dataLSCodireccion[$i]["itut_id"];
                                $acon_id = $dataLSCodireccion[$i]["acon_id"];
                                
                                //Se inserta el detalle de codirección.-    
                                if ($itut_otrainst_codireccion == "0") {
                                    $itut_des_otrainst = null;
                                } else {
                                    $itut_institucion_codirec = null;
                                }
                                if ($itut_id==0) {
                                    $resp_detcodireccion = $modexpprofesor->insertarInf_tutorias($per_id, $itut_pais, $itut_institucion_codirec, $itut_des_otrainst, $itut_tipo_codireccion, null, $itut_anio_aprobacion, $acon_id);
                                    if ($resp_detcodireccion) {
                                        $exito = 1;
                                    }
                                }
                            }
                            //Ponencias.
                            for ($i = 0; $i < count($dataLSPonencia); $i++) {
                                $icon_ponencia = ucwords(strtolower($dataLSPonencia[$i]["icon_ponencia"]));
                                $icon_pais = $dataLSPonencia[$i]["icon_pais"];
                                $icon_institucion = ucwords(strtolower($dataLSPonencia[$i]["icon_institucion"]));                                
                                $icon_nombre_evento = ucwords(strtolower($dataLSPonencia[$i]["icon_nombre_evento"]));                                
                                $icon_id = $dataLSPonencia[$i]["icon_id"];
                                $acon_id = $dataLSPonencia[$i]["acon_id"];
                                $icon_tipo_participacion = $dataLSPonencia[$i]["icon_tipo_participacion"];
                                $icon_archivo = $dataLSPonencia[$i]["icon_archivo"];                                                                
                                //Verificamos si hay un archivo Documento que certifique.                                                                                  
                                $foto_archivo9 = "";
                                if (isset($icon_archivo) && ($icon_archivo != "")) {
                                    $arrIm = explode(".", basename($icon_archivo));
                                    $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                                    $ruta = $arrIm[0];                                    
                                    $foto_archivo9 = Yii::$app->params["documentFolder"] . "expedienteprofesor/" . $per_id . "/" . $ruta ."_per_" . $per_id. "." . $typeFile;
                                    
                                }                                
                                if ($icon_id==0) {                                    
                                    $resp_detponencia = $modexpprofesor->insertarInf_conferencias($per_id, $icon_pais, $icon_institucion, $icon_nombre_evento, $icon_ponencia, $acon_id, $icon_tipo_participacion, $foto_archivo9);
                                    if ($resp_detponencia) {
                                        $exito = 1;                                           
                                    }
                                }
                            }
                        }                     
                        
                    } else {  //No se encuentra registrado como expediente del profesor.
                        $exito = 0;
                        $mensaje = "No se encuentra registrada la información personal.";
                    }
                
                    if ($exito != 2) {
                        if ($exito) {
                            $transaction->commit();
                            $transaction1->commit();
                            $transaction2->commit();
                            $message = array(
                                "wtmessage" => Yii::t("notificaciones", "La infomación ha sido grabada. Verifique en opción Ver Expediente."),
                                "title" => Yii::t('jslang', 'Success'),
                            );
                            echo \app\models\Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                            return;
                        } else {                    
                            $transaction->rollback();
                            $transaction1->rollback();
                            $transaction2->rollback();
                            $message = array(
                                "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $mensaje),
                                "title" => Yii::t('jslang', 'Success'),
                            );
                            echo \app\models\Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                            return;
                        }
                    }
                } catch (Exception $ex) {
                    $transaction->rollback();
                    $transaction1->rollback();
                    $transaction2->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error al grabar2. " . $mensaje),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    echo \app\models\Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                    return;
                }
            }            
        }
    }
    
    public function actionView() {
        $mod_exprofesor = new ExpedienteProfesor();
        $mod_pais = new Pais();
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->get();
        }
        //Se obtiene el per_id.
        $per_id = Yii::$app->session->get("PB_perid");
        /* Arreglos para llenar los combo box */
        $arr_conocimiento = $mod_exprofesor->consultarAreaConocimiento();
        $arr_nivinstruccion = $mod_exprofesor->consultarParametros('pv_ninstruccion', null);
        $arr_tipodiploma = $mod_exprofesor->consultarParametros('pv_tdiploma', null);
        $arr_modalidad = $mod_exprofesor->consultarParametros('pv_modalidad', null);
        $arr_tipcapacitacion = $mod_exprofesor->consultarParametros('pv_tcapacitacion', null);
        $arr_tiempodedica = $mod_exprofesor->consultarParametros('pv_tdedicado', null);
        $arr_tiprelacion = $mod_exprofesor->consultarParametros('pv_trelacion', null);
        $arr_publica = $mod_exprofesor->consultarParametros('pv_publicacion', null);
        $arr_coodireccion = $mod_exprofesor->consultarParametros('pv_coodireccion', null);
        $arr_tipopublica = $mod_exprofesor->consutarTipopublicacion();
        $arr_lenguaje = $mod_exprofesor->consultarIdiomas();
        $arr_etnia = Etnia::find()->select("etn_id AS id, etn_nombre AS value")->where(["etn_estado_logico" => "1", "etn_estado" => "1"])->asArray()->all();
        $tipos_sangre = TipoSangre::find()->select("tsan_id AS id, tsan_nombre AS value")->where(["tsan_estado_logico" => "1", "tsan_estado" => "1"])->asArray()->all();

        //Búsqueda de los datos de persona o profesor logueada
        $modpersona = new Persona(); //ExpedienteProfesor();        
        $respExpProfesor = $modpersona->consultaPersonaId($per_id);
        $modpercorinstitucional = new PersonaCorreoInstitucional();
        $respPerCorInstitucional = $modpercorinstitucional->consultarCorreoInstitucional($per_id);
        $modContGeneral = new ContactoGeneral();
        $respContGeneral = $modContGeneral->consultarContactoGeneral($per_id);

        $pais_id = 57; //Ecuador
        $arr_instituto = $mod_exprofesor->consultarInstituto($pais_id);
        $arr_pais_nac = Pais::find()->select("pai_id AS id, pai_nombre AS value, pai_codigo_fono AS code")->where(["pai_estado_logico" => "1", "pai_estado" => "1"])->asArray()->all();
        $arr_prov_nac = Provincia::provinciaXPais($respExpProfesor['pai_id_nacimiento']);
        $arr_ciu_nac = Canton::cantonXProvincia($respExpProfesor["pro_id_nacimiento"]);

        $arr_pais_dom = Pais::find()->select("pai_id AS id, pai_nombre AS value, pai_codigo_fono AS code")->where(["pai_estado_logico" => "1", "pai_estado" => "1"])->asArray()->all();
        $arr_prov_dom = Provincia::provinciaXPais($respExpProfesor['pai_id_domicilio']);
        $arr_ciu_dom = Canton::cantonXProvincia($respExpProfesor["pro_id_domicilio"]);

        $arr_pais_med = Pais::find()->select("pai_id AS id, pai_nombre AS value")->where(["pai_estado_logico" => "1", "pai_estado" => "1"])->asArray()->all();
        $arr_prov_med = Provincia::provinciaXPais($pais_id);
        $arr_ciu_med = Canton::cantonXProvincia($arr_prov_med[0]["id"]);

        $arr_pais_ter = Pais::find()->select("pai_id AS id, pai_nombre AS value")->where(["pai_estado_logico" => "1", "pai_estado" => "1"])->asArray()->all();
        $arr_prov_ter = Provincia::provinciaXPais($pais_id);
        $arr_ciu_ter = Canton::cantonXProvincia($arr_prov_ter[0]["id"]);

        $arr_pais_cuat = Pais::find()->select("pai_id AS id, pai_nombre AS value")->where(["pai_estado_logico" => "1", "pai_estado" => "1"])->asArray()->all();
        $arr_prov_cuat = Provincia::provinciaXPais($pais_id);
        $arr_ciu_cuat = Canton::cantonXProvincia($arr_prov_cuat[0]["id"]);

        $arr_tip_discap = TipoDiscapacidad::find()->select("tdis_id AS id, tdis_nombre AS value")->where(["tdis_estado_logico" => "1", "tdis_estado" => "1"])->asArray()->all();
        $arr_tip_discap_fam = TipoDiscapacidad::find()->select("tdis_id AS id, tdis_nombre AS value")->where(["tdis_estado_logico" => "1", "tdis_estado" => "1"])->asArray()->all();

        $arr_tip_instaca_med = TipoInstitucionAca::find()->select("tiac_id AS id, tiac_nombre AS value")->where(["tiac_estado_logico" => "1", "tiac_estado" => "1"])->asArray()->all();
        $arr_tip_instaca_ter = TipoInstitucionAca::find()->select("tiac_id AS id, tiac_nombre AS value")->where(["tiac_estado_logico" => "1", "tiac_estado" => "1"])->asArray()->all();
        $arr_tip_instaca_cuat = TipoInstitucionAca::find()->select("tiac_id AS id, tiac_nombre AS value")->where(["tiac_estado_logico" => "1", "tiac_estado" => "1"])->asArray()->all();
        $arr_ninstruc_mad = NivelInstruccion::find()->select("nins_id AS id, nins_nombre AS value")->where(["nins_estado_logico" => "1", "nins_estado" => "1"])->asArray()->all();
        $arr_ninstruc_pad = NivelInstruccion::find()->select("nins_id AS id, nins_nombre AS value")->where(["nins_estado_logico" => "1", "nins_estado" => "1"])->asArray()->all();

        $arr_tipparent_dis = TipoParentesco::find()->select("tpar_id AS id, tpar_nombre AS value")->where(["tpar_estado_logico" => "1", "tpar_estado" => "1"])->asArray()->all();
        $arr_tipparent_enf = TipoParentesco::find()->select("tpar_id AS id, tpar_nombre AS value")->where(["tpar_estado_logico" => "1", "tpar_estado" => "1"])->asArray()->all();
        $arr_estcivil = EstadoCivil::find()->select("eciv_id as id, eciv_nombre as value")->where(["eciv_estado_logico" => "1", "eciv_estado" => "1"])->asArray()->all();

        $area = $mod_pais->consultarCodigoArea($respExpProfesor['pai_id_domicilio']);
        if (empty($respExpProfesor['per_foto'])) {
            $respExpProfesor['per_foto'] = '/uploads/expedienteprofesor/Silueta-opc-4.png';
        }
        $respotraetnia = $modpersona->consultarOtraetnia($per_id);
        //edad
        $fecha_actual = new DateTime(date("Y-m-d"));
        $fechanac = new Datetime($respExpProfesor["per_fecha_nacimiento"]);
        $edad = $fecha_actual->diff($fechanac);
        $edadf = $edad->format("%Y-%m") . "     (años-meses)";

        /* Obtener datos de discapacidad */
        $resp_discapacidad = $mod_exprofesor->consultarDiscapacidad($per_id);

        /* Obtener datos familiares */
        $resp_familiares = $mod_exprofesor->consultarDatosFamiliares($per_id, 1, 2);
        $resp_familiaresInst = $mod_exprofesor->consultarDatosFamiliares($per_id, 2, 2);
        /* Obtener datos académicos */

        $resp_estsuperior = $mod_exprofesor->consultarDatosAcademicos($per_id,1,2);
        $resp_estactual = $mod_exprofesor->consultarDatosAcademicos($per_id,2,2);
        $resp_reconocimiento = $mod_exprofesor->consultarDatosAcademicos($per_id,3,2);
        $resp_idiomas = $mod_exprofesor->consultarDatosIdiomas($per_id,2);
        $resp_capacitacion = $mod_exprofesor->consultarDatosCapacitacion($per_id,2);
        
        /* Obtener información laboral */
        $resp_laboral = $mod_exprofesor->consultarDatoslaborales($per_id,2);
        $resp_docencia = $mod_exprofesor->consultarDatosdocencia($per_id,2);
        
        /* Obtener datos de investigación */
        $resp_investigacion = $mod_exprofesor->consultarDatosinvestigacion($per_id,2);
        
        /* Obtener datos de Publicación */
        $resp_publicacion = $mod_exprofesor->consultarDatospublicacion($per_id,2);
        $resp_codireccion = $mod_exprofesor->consultarDatoscodireccion($per_id,2);
        $resp_ponencia = $mod_exprofesor->consultarDatosponencias($per_id,2);
  
        return $this->render('view', [
                    "arr_etnia" => ArrayHelper::map($arr_etnia, "id", "value"),
                    "arr_civil" => ArrayHelper::map($arr_estcivil, "id", "value"),
                    "tipo_dni" => array("CED" => Yii::t("formulario", "DNI Document"), "PASS" => Yii::t("formulario", "Passport")),
                    "genero" => array("M" => Yii::t("formulario", "Male"), "F" => Yii::t("formulario", "Female")),
                    "tipos_sangre" => ArrayHelper::map($tipos_sangre, "id", "value"),
                    /*                     * */
                    "arr_pais_nac" => $arr_pais_nac,
                    "arr_prov_nac" => ArrayHelper::map($arr_prov_nac, "id", "value"),
                    "arr_ciu_nac" => ArrayHelper::map($arr_ciu_nac, "id", "value"),
                    /*                     * */
                    "arr_pais_dom" => $arr_pais_dom,
                    "arr_prov_dom" => ArrayHelper::map($arr_prov_dom, "id", "value"),
                    "arr_ciu_dom" => ArrayHelper::map($arr_ciu_dom, "id", "value"),
                    /*                     * */
                    "arr_pais_med" => ArrayHelper::map($arr_pais_med, "id", "value"),
                    "arr_prov_med" => ArrayHelper::map($arr_prov_med, "id", "value"),
                    "arr_ciu_med" => ArrayHelper::map($arr_ciu_med, "id", "value"),
                    /*                     * */
                    "arr_pais_ter" => ArrayHelper::map($arr_pais_ter, "id", "value"),
                    "arr_prov_ter" => ArrayHelper::map($arr_prov_ter, "id", "value"),
                    "arr_ciu_ter" => ArrayHelper::map($arr_ciu_ter, "id", "value"),
                    /*                     * */
                    "arr_pais_cuat" => ArrayHelper::map($arr_pais_cuat, "id", "value"),
                    "arr_prov_cuat" => ArrayHelper::map($arr_prov_cuat, "id", "value"),
                    "arr_ciu_cuat" => ArrayHelper::map($arr_ciu_cuat, "id", "value"),
                    /*                     * */
                    "arr_tip_discap" => ArrayHelper::map($arr_tip_discap, "id", "value"),
                    "arr_tip_discap_fam" => ArrayHelper::map($arr_tip_discap_fam, "id", "value"),
                    /*                     * */
                    "arr_tip_instaca_med" => ArrayHelper::map($arr_tip_instaca_med, "id", "value"),
                    "arr_tip_instaca_ter" => ArrayHelper::map($arr_tip_instaca_ter, "id", "value"),
                    "arr_tip_instaca_cuat" => ArrayHelper::map($arr_tip_instaca_cuat, "id", "value"),
                    /*                     * */
                    "arr_ninstruc_mad" => ArrayHelper::map($arr_ninstruc_mad, "id", "value"),
                    "arr_ninstruc_pad" => ArrayHelper::map($arr_ninstruc_pad, "id", "value"),
                    /*                     * */
                    "arr_tipparent" => ArrayHelper::map($arr_tipparent_dis, "id", "value"),
                    "arr_tipparent_enf" => ArrayHelper::map($arr_tipparent_enf, "id", "value"),
                    "respExpProfesor" => $respExpProfesor,
                    "area" => $area,
                    "respPerCorInstitucional" => $respPerCorInstitucional,
                    "respContGeneral" => $respContGeneral,
                    "otraetnia" => $respotraetnia,
                    "arr_conocimiento" => ArrayHelper::map($arr_conocimiento, "id", "name"),
                    "arr_nivinstruccion" => ArrayHelper::map($arr_nivinstruccion, "id", "name"),
                    "arr_modalidad" => ArrayHelper::map($arr_modalidad, "id", "name"),
                    "arr_tipcapacitacion" => ArrayHelper::map($arr_tipcapacitacion, "id", "name"),
                    "arr_tiempodedica" => ArrayHelper::map($arr_tiempodedica, "id", "name"),
                    "arr_tiprelacion" => ArrayHelper::map($arr_tiprelacion, "id", "name"),
                    "arr_publica" => ArrayHelper::map($arr_publica, "id", "name"),
                    "arr_coodireccion" => ArrayHelper::map($arr_coodireccion, "id", "name"),
                    "arr_tipopublica" => ArrayHelper::map($arr_tipopublica, "id", "name"),
                    "arr_tipodiploma" => ArrayHelper::map($arr_tipodiploma, "id", "name"),
                    "arr_instituto" => ArrayHelper::map($arr_instituto, "id", "name"),
                    "arr_lenguaje" => ArrayHelper::map($arr_lenguaje, "id", "name"),
                    "per_id" => $per_id,
                    "datos_discapacidad" => $resp_discapacidad,
                    "datos_familiares" => $resp_familiares,
                    "datos_familiares_inst" => $resp_familiaresInst,
                    "datos_estudiosuperior" => $resp_estsuperior,
                    "datos_estudioactual" => $resp_estactual,
                    "datos_reconocimiento" => $resp_reconocimiento,
                    "datos_idiomas" => $resp_idiomas,
                    "datos_capacitacion" => $resp_capacitacion,
                    "datos_laborales" => $resp_laboral,
                    "datos_docencia" => $resp_docencia,
                    "datos_investigacion" => $resp_investigacion,
                    "datos_publicacion" => $resp_publicacion,
                    "datos_codireccion" => $resp_codireccion,
                    "datos_ponencia" => $resp_ponencia,
                    "edad" => $edadf,
        ]);
    }

    public function actionViewadmin() {
        $mod_exprofesor = new ExpedienteProfesor();
        $mod_pais = new Pais();
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->get();
        }
        //Se obtiene el per_id, estado y observación.
        $per_id = base64_decode($_GET["per_id"]);
        $estado = base64_decode($_GET["estado"]);
        $observacion = base64_decode($_GET["observacion"]);
        /* Arreglos para llenar los combo box */
        $arr_conocimiento = $mod_exprofesor->consultarAreaConocimiento();
        $arr_nivinstruccion = $mod_exprofesor->consultarParametros('pv_ninstruccion', null);
        $arr_tipodiploma = $mod_exprofesor->consultarParametros('pv_tdiploma', null);
        $arr_modalidad = $mod_exprofesor->consultarParametros('pv_modalidad', null);
        $arr_tipcapacitacion = $mod_exprofesor->consultarParametros('pv_tcapacitacion', null);
        $arr_tiempodedica = $mod_exprofesor->consultarParametros('pv_tdedicado', null);
        $arr_tiprelacion = $mod_exprofesor->consultarParametros('pv_trelacion', null);
        $arr_publica = $mod_exprofesor->consultarParametros('pv_publicacion', null);
        $arr_coodireccion = $mod_exprofesor->consultarParametros('pv_coodireccion', null);
        $arr_tipopublica = $mod_exprofesor->consutarTipopublicacion();
        $arr_lenguaje = $mod_exprofesor->consultarIdiomas();
        $arr_etnia = Etnia::find()->select("etn_id AS id, etn_nombre AS value")->where(["etn_estado_logico" => "1", "etn_estado" => "1"])->asArray()->all();
        $tipos_sangre = TipoSangre::find()->select("tsan_id AS id, tsan_nombre AS value")->where(["tsan_estado_logico" => "1", "tsan_estado" => "1"])->asArray()->all();

        //Búsqueda de los datos de persona o profesor logueada
        $mod_persona = new Persona(); //ExpedienteProfesor();        
        $respExpProfesor = $mod_persona->consultaPersonaId($per_id);
        $modpercorinstitucional = new PersonaCorreoInstitucional();
        $respPerCorInstitucional = $modpercorinstitucional->consultarCorreoInstitucional($per_id);
        $modContGeneral = new ContactoGeneral();
        $respContGeneral = $modContGeneral->consultarContactoGeneral($per_id);

        $pais_id = 57; //Ecuador
        $arr_instituto = $mod_exprofesor->consultarInstituto($pais_id);
        $arr_pais_nac = Pais::find()->select("pai_id AS id, pai_nombre AS value, pai_codigo_fono AS code")->where(["pai_estado_logico" => "1", "pai_estado" => "1"])->asArray()->all();
        $arr_prov_nac = Provincia::provinciaXPais($respExpProfesor['pai_id_nacimiento']);
        $arr_ciu_nac = Canton::cantonXProvincia($respExpProfesor["pro_id_nacimiento"]);

        $arr_pais_dom = Pais::find()->select("pai_id AS id, pai_nombre AS value, pai_codigo_fono AS code")->where(["pai_estado_logico" => "1", "pai_estado" => "1"])->asArray()->all();
        $arr_prov_dom = Provincia::provinciaXPais($respExpProfesor['pai_id_domicilio']);
        $arr_ciu_dom = Canton::cantonXProvincia($respExpProfesor["pro_id_domicilio"]);

        $arr_pais_med = Pais::find()->select("pai_id AS id, pai_nombre AS value")->where(["pai_estado_logico" => "1", "pai_estado" => "1"])->asArray()->all();
        $arr_prov_med = Provincia::provinciaXPais($pais_id);
        $arr_ciu_med = Canton::cantonXProvincia($arr_prov_med[0]["id"]);

        $arr_pais_ter = Pais::find()->select("pai_id AS id, pai_nombre AS value")->where(["pai_estado_logico" => "1", "pai_estado" => "1"])->asArray()->all();
        $arr_prov_ter = Provincia::provinciaXPais($pais_id);
        $arr_ciu_ter = Canton::cantonXProvincia($arr_prov_ter[0]["id"]);

        $arr_pais_cuat = Pais::find()->select("pai_id AS id, pai_nombre AS value")->where(["pai_estado_logico" => "1", "pai_estado" => "1"])->asArray()->all();
        $arr_prov_cuat = Provincia::provinciaXPais($pais_id);
        $arr_ciu_cuat = Canton::cantonXProvincia($arr_prov_cuat[0]["id"]);

        $arr_tip_discap = TipoDiscapacidad::find()->select("tdis_id AS id, tdis_nombre AS value")->where(["tdis_estado_logico" => "1", "tdis_estado" => "1"])->asArray()->all();
        $arr_tip_discap_fam = TipoDiscapacidad::find()->select("tdis_id AS id, tdis_nombre AS value")->where(["tdis_estado_logico" => "1", "tdis_estado" => "1"])->asArray()->all();

        $arr_tip_instaca_med = TipoInstitucionAca::find()->select("tiac_id AS id, tiac_nombre AS value")->where(["tiac_estado_logico" => "1", "tiac_estado" => "1"])->asArray()->all();
        $arr_tip_instaca_ter = TipoInstitucionAca::find()->select("tiac_id AS id, tiac_nombre AS value")->where(["tiac_estado_logico" => "1", "tiac_estado" => "1"])->asArray()->all();
        $arr_tip_instaca_cuat = TipoInstitucionAca::find()->select("tiac_id AS id, tiac_nombre AS value")->where(["tiac_estado_logico" => "1", "tiac_estado" => "1"])->asArray()->all();
        $arr_ninstruc_mad = NivelInstruccion::find()->select("nins_id AS id, nins_nombre AS value")->where(["nins_estado_logico" => "1", "nins_estado" => "1"])->asArray()->all();
        $arr_ninstruc_pad = NivelInstruccion::find()->select("nins_id AS id, nins_nombre AS value")->where(["nins_estado_logico" => "1", "nins_estado" => "1"])->asArray()->all();

        $arr_tipparent_dis = TipoParentesco::find()->select("tpar_id AS id, tpar_nombre AS value")->where(["tpar_estado_logico" => "1", "tpar_estado" => "1"])->asArray()->all();
        $arr_tipparent_enf = TipoParentesco::find()->select("tpar_id AS id, tpar_nombre AS value")->where(["tpar_estado_logico" => "1", "tpar_estado" => "1"])->asArray()->all();
        $arr_estcivil = EstadoCivil::find()->select("eciv_id as id, eciv_nombre as value")->where(["eciv_estado_logico" => "1", "eciv_estado" => "1"])->asArray()->all();

        $area = $mod_pais->consultarCodigoArea($respExpProfesor['pai_id_domicilio']);
        if (empty($respExpProfesor['per_foto'])) {
            $respExpProfesor['per_foto'] = '/uploads/expedienteprofesor/Silueta-opc-4.png';
        }
        $respotraetnia = $mod_persona->consultarOtraetnia($per_id);
        //edad
        $fecha_actual = new DateTime(date("Y-m-d"));
        $fechanac = new Datetime($respExpProfesor["per_fecha_nacimiento"]);
        $edad = $fecha_actual->diff($fechanac);
        $edadf = $edad->format("%Y-%m") . "     (años-meses)";

        /* Obtener datos de discapacidad */
        $resp_discapacidad = $mod_exprofesor->consultarDiscapacidad($per_id);

        /* Obtener datos familiares */
        $resp_familiares = $mod_exprofesor->consultarDatosFamiliares($per_id, 1, 2);
        $resp_familiaresInst = $mod_exprofesor->consultarDatosFamiliares($per_id, 2, 2);
        /* Obtener datos académicos */
        $resp_estsuperior = $mod_exprofesor->consultarDatosAcademicos($per_id,1,2);
        $resp_estactual = $mod_exprofesor->consultarDatosAcademicos($per_id,2,2);
        $resp_reconocimiento = $mod_exprofesor->consultarDatosAcademicos($per_id,3,2);
        $resp_idiomas = $mod_exprofesor->consultarDatosIdiomas($per_id,2);
        $resp_capacitacion = $mod_exprofesor->consultarDatosCapacitacion($per_id,2);
        
        /* Obtener información laboral */
        $resp_laboral = $mod_exprofesor->consultarDatoslaborales($per_id,2);
        $resp_docencia = $mod_exprofesor->consultarDatosdocencia($per_id,2);
        
        /* Obtener datos de investigación */
        $resp_investigacion = $mod_exprofesor->consultarDatosinvestigacion($per_id,2);
        
        /* Obtener datos de Publicación */
        $resp_publicacion = $mod_exprofesor->consultarDatospublicacion($per_id,2);
        $resp_codireccion = $mod_exprofesor->consultarDatoscodireccion($per_id,2);
        $resp_ponencia = $mod_exprofesor->consultarDatosponencias($per_id,2);
        
        /* Información de estados de validación.*/
        $resp_validacion = $mod_exprofesor->consultarParametros("pv_estadoexpediente",'1');  
                            
        return $this->render('viewadmin', [
                    "arr_etnia" => ArrayHelper::map($arr_etnia, "id", "value"),
                    "arr_civil" => ArrayHelper::map($arr_estcivil, "id", "value"),
                    "tipo_dni" => array("CED" => Yii::t("formulario", "DNI Document"), "PASS" => Yii::t("formulario", "Passport")),
                    "genero" => array("M" => Yii::t("formulario", "Male"), "F" => Yii::t("formulario", "Female")),
                    "tipos_sangre" => ArrayHelper::map($tipos_sangre, "id", "value"),
                    /*                     * */
                    "arr_pais_nac" => $arr_pais_nac,
                    "arr_prov_nac" => ArrayHelper::map($arr_prov_nac, "id", "value"),
                    "arr_ciu_nac" => ArrayHelper::map($arr_ciu_nac, "id", "value"),
                    /*                     * */
                    "arr_pais_dom" => $arr_pais_dom,
                    "arr_prov_dom" => ArrayHelper::map($arr_prov_dom, "id", "value"),
                    "arr_ciu_dom" => ArrayHelper::map($arr_ciu_dom, "id", "value"),
                    /*                     * */
                    "arr_pais_med" => ArrayHelper::map($arr_pais_med, "id", "value"),
                    "arr_prov_med" => ArrayHelper::map($arr_prov_med, "id", "value"),
                    "arr_ciu_med" => ArrayHelper::map($arr_ciu_med, "id", "value"),
                    /*                     * */
                    "arr_pais_ter" => ArrayHelper::map($arr_pais_ter, "id", "value"),
                    "arr_prov_ter" => ArrayHelper::map($arr_prov_ter, "id", "value"),
                    "arr_ciu_ter" => ArrayHelper::map($arr_ciu_ter, "id", "value"),
                    /*                     * */
                    "arr_pais_cuat" => ArrayHelper::map($arr_pais_cuat, "id", "value"),
                    "arr_prov_cuat" => ArrayHelper::map($arr_prov_cuat, "id", "value"),
                    "arr_ciu_cuat" => ArrayHelper::map($arr_ciu_cuat, "id", "value"),
                    /*                     * */
                    "arr_tip_discap" => ArrayHelper::map($arr_tip_discap, "id", "value"),
                    "arr_tip_discap_fam" => ArrayHelper::map($arr_tip_discap_fam, "id", "value"),
                    /*                     * */
                    "arr_tip_instaca_med" => ArrayHelper::map($arr_tip_instaca_med, "id", "value"),
                    "arr_tip_instaca_ter" => ArrayHelper::map($arr_tip_instaca_ter, "id", "value"),
                    "arr_tip_instaca_cuat" => ArrayHelper::map($arr_tip_instaca_cuat, "id", "value"),
                    /*                     * */
                    "arr_ninstruc_mad" => ArrayHelper::map($arr_ninstruc_mad, "id", "value"),
                    "arr_ninstruc_pad" => ArrayHelper::map($arr_ninstruc_pad, "id", "value"),
                    /*                     * */
                    "arr_tipparent" => ArrayHelper::map($arr_tipparent_dis, "id", "value"),
                    "arr_tipparent_enf" => ArrayHelper::map($arr_tipparent_enf, "id", "value"),
                    "respExpProfesor" => $respExpProfesor,
                    "area" => $area,
                    "respPerCorInstitucional" => $respPerCorInstitucional,
                    "respContGeneral" => $respContGeneral,
                    "otraetnia" => $respotraetnia,
                    "arr_conocimiento" => ArrayHelper::map($arr_conocimiento, "id", "name"),
                    "arr_nivinstruccion" => ArrayHelper::map($arr_nivinstruccion, "id", "name"),
                    "arr_modalidad" => ArrayHelper::map($arr_modalidad, "id", "name"),
                    "arr_tipcapacitacion" => ArrayHelper::map($arr_tipcapacitacion, "id", "name"),
                    "arr_tiempodedica" => ArrayHelper::map($arr_tiempodedica, "id", "name"),
                    "arr_tiprelacion" => ArrayHelper::map($arr_tiprelacion, "id", "name"),
                    "arr_publica" => ArrayHelper::map($arr_publica, "id", "name"),
                    "arr_coodireccion" => ArrayHelper::map($arr_coodireccion, "id", "name"),
                    "arr_tipopublica" => ArrayHelper::map($arr_tipopublica, "id", "name"),
                    "arr_tipodiploma" => ArrayHelper::map($arr_tipodiploma, "id", "name"),
                    "arr_instituto" => ArrayHelper::map($arr_instituto, "id", "name"),
                    "arr_lenguaje" => ArrayHelper::map($arr_lenguaje, "id", "name"),
                    "per_id" => $per_id,
                    "datos_discapacidad" => $resp_discapacidad,
                    "datos_familiares" => $resp_familiares,
                    "datos_familiares_inst" => $resp_familiaresInst,
                    "datos_estudiosuperior" => $resp_estsuperior,
                    "datos_estudioactual" => $resp_estactual,
                    "datos_reconocimiento" => $resp_reconocimiento,
                    "datos_idiomas" => $resp_idiomas,
                    "datos_capacitacion" => $resp_capacitacion,
                    "datos_laborales" => $resp_laboral,
                    "datos_docencia" => $resp_docencia,
                    "datos_investigacion" => $resp_investigacion,
                    "datos_publicacion" => $resp_publicacion,
                    "datos_codireccion" => $resp_codireccion,
                    "datos_ponencia" => $resp_ponencia,
                    "resp_validacion" => ArrayHelper::map($resp_validacion, "id", "name"),
                    "edad" => $edadf,
                    "estado" => $estado,
                    "observacion" => $observacion,
        ]);
    }

    public function actionGuardarevision() {
        $modexpprofesor = new ExpedienteProfesor();

        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $per_id = $data["per_id"];
            $resultado = $data["resultado"];
            $observacion = ucwords(strtolower($data["observacion"]));
            $usuario = @Yii::$app->session->get("PB_iduser");

            $con = \Yii::$app->db_claustro;
            $transaction = $con->beginTransaction();
            try {
                $resp_profesor = $modexpprofesor->consultarExpedienteProfesor($per_id);
                if ($resp_profesor) {
                    $resp_revisa = $modexpprofesor->modificaExpediente($per_id, null, $usuario, $resultado, $observacion);
                    if ($resp_revisa) {
                        //Enviar correo con la novedad.
                        if (empty($observacion)) {
                            $leyenda = "Su expediente ha sido validado sin ninguna novedad.";
                        } else {
                            $leyenda = $observacion;
                        }
                        //Obtener datos de profesor.
                        $resp_persona = $modexpprofesor->consultarInfopersona($per_id);
                        //Se envía correo al profesor el resultado de la revisión.
                        $nombres = $resp_persona["per_pri_nombre"] . " " . $resp_persona["per_seg_nombre"] . " " . $resp_persona["per_pri_apellido"] . " " . $resp_persona["per_seg_apellido"];
                        $link = Url::base(true);
                        $tituloMensaje = Yii::t("formulario", "File Information Income");
                        $asunto = Yii::t("formulario", "File Information Income");
                        
                        $body = Utilities::getMailMessage("ResultFileProfessor", array("[[profesor]]" => $nombres, "[[leyenda]]" => $leyenda, "[[link_asgard]]" => $link), Yii::$app->language);                        
                        Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [Yii::$app->params["soporteEmail"] => "Soporte"], $asunto, $body);
                        Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [$resp_persona["correo"] => $nombres], $asunto, $body);
                        $exito = 1;
                    }
                } else {
                    $exito = 0;
                    $mensaje = "No se encuentra registrada la información personal." . 'Perid:' . $per_id;
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
                        "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $mensaje),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    echo \app\models\Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                    return;
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error Catch  al grabar." . $mensaje),
                    "title" => Yii::t('jslang', 'Success'),
                );

                echo \app\models\Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                return;
            }
        }
    }

    public function actionCierre() {
        $modexpprofesor = new ExpedienteProfesor();

        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $per_id = $data["perId"];

            $con = \Yii::$app->db_claustro;
            $transaction = $con->beginTransaction();
            try {
                $resp_profesor = $modexpprofesor->consultarExpedienteProfesor($per_id);
                if ($resp_profesor) {
                    $resp_estado = 21;
                    $resp_modexpediente = $modexpprofesor->modificaExpediente($per_id, null, null, $resp_estado, null);
                    if ($resp_modexpediente) {
                        //Obtener datos de profeso.
                        $resp_persona = $modexpprofesor->consultarInfopersona($per_id);
                        //Se envía correo a los usuarios de talento humano.
                        $nombres = $resp_persona["per_pri_nombre"] . " " . $resp_persona["per_seg_nombre"] . " " . $resp_persona["per_pri_apellido"] . " " . $resp_persona["per_seg_apellido"];
                        $link = Url::base(true);
                        $tituloMensaje = Yii::t("formulario", "File Information Income");
                        $asunto = Yii::t("formulario", "File Information Income");

                        $body1 = Utilities::getMailMessage("Applicantreviewhumantalent", array("[[link_asgard]]" => $link), Yii::$app->language);
                        $body = Utilities::getMailMessage("ReviewFileProfessor", array("[[profesor]]" => $nombres, "[[link_asgard]]" => $link), Yii::$app->language);

                        Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [Yii::$app->params["jefetalento"] => "Jefe"], $asunto, $body);
                        Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [Yii::$app->params["analistatalento"] => "Analista"], $asunto, $body);
                        Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [Yii::$app->params["analistanomina"] => "Analista"], $asunto, $body);
                        Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [Yii::$app->params["soporteEmail"] => "Soporte"], $asunto, $body);
                        Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [$resp_persona["correo"] => $nombres], $asunto, $body1);
                        $exito = 1;
                    }
                } else {
                    $exito = 0;
                    $mensaje = "No se encuentra registrada la información personal." . 'Id Profesor:' . $per_id;
                }
                if ($exito) {
                    $transaction->commit();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "La infomación ha sido grabada y se ha enviado a Talento Humano para su respectiva revisión."),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    echo \app\models\Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                    return;
                } else {
                    $transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $mensaje),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    echo \app\models\Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                    return;
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error Catch  al grabar." . $mensaje),
                    "title" => Yii::t('jslang', 'Success'),
                );

                echo \app\models\Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                return;
            }
        }
    }

    public function actionEliminaregistro() {           
        $modExpediente = new ExpedienteProfesor;
        if (Yii::$app->request->isAjax) {            
            $data = Yii::$app->request->post();
            $codigo_id = $data["codElim"];
            $tabla = $data["tablaId"];
            $perIdElim = $data["perElim"];
            $idiElim = $data["idiElim"];
                        
            $con = \Yii::$app->db_general;
            $transaction = $con->beginTransaction();
            try {
                //$mensaje= 'codId:'.$codigo_id." /tabla:".$tabla;
                if ((!empty($codigo_id)) || (!empty($tabla))) {
                    //Detalle de antecedentes familiares.                
                    switch ($tabla) {                        
                        case 1:
                            $respConsulta= $modExpediente->consultarDiscapacidadFamiliar($codigo_id);                           
                            if (!(empty($respConsulta["ipdi_id"]))) {
                                $resulDiscapacidad = $modExpediente->inactivarInfoDiscapacidad($respConsulta["ipdi_id"]);
                                if ($resulDiscapacidad) {
                                    $resultado = $modExpediente->inactivarDetantecedentesfam($codigo_id); 
                                    break;
                                }
                            } else {
                                $resultado = $modExpediente->inactivarDetantecedentesfam($codigo_id); 
                                break;
                            }
                        case 2:
                            $resultado = $modExpediente->inactivarDetestudios($codigo_id);  
                            break;
                        case 3:
                            $resultado = $modExpediente->inactivarDetcapacitaciones($codigo_id);  
                            break;
                        case 4:
                            $respConsulta= $modExpediente->consultarInfoContactoExpLab($codigo_id);                           
                            if (!(empty($respConsulta["icon_id"]))) {
                                $resulInfoCont = $modExpediente->inactivarInfoContacto($respConsulta["icon_id"]);
                                if ($resulInfoCont) {
                                    $resultado = $modExpediente->inactivarDetexplaboral($codigo_id);  
                                    break;
                                }
                            } else {
                                $resultado = $modExpediente->inactivarDetexplaboral($codigo_id);  
                                break;
                            }
                        case 5:
                            $respConsulta= $modExpediente->consultarInfoContactoExpDoc($codigo_id);                           
                            if (!(empty($respConsulta["icon_id"]))) {
                                $resulInfoCont = $modExpediente->inactivarInfoContacto($respConsulta["icon_id"]);
                                if ($resulInfoCont) {
                                    $resultado = $modExpediente->inactivarDetexpdocente($codigo_id);  
                                    break;
                                }
                            } else {
                                $resultado = $modExpediente->inactivarDetexpdocente($codigo_id);  
                                break;
                            }
                        case 6:
                            $resultado = $modExpediente->inactivarDetinvestigacion($codigo_id);  
                            break;
                        case 7:
                            $resultado = $modExpediente->inactivarDetpublicacion($codigo_id);  
                            break;
                        case 8:
                            $resultado = $modExpediente->inactivarDetcodireccion($codigo_id);  
                            break;
                        case 9:
                            $resultado = $modExpediente->inactivarDetconferencia($codigo_id);  
                            break;
                        case 10:
                            $resultado = $modExpediente->inactivarDetidioma($perIdElim, $idiElim);  
                            break;
                    }
                    if ($resultado) {
                        $exito = 1;
                    }
                } else {
                    $mensaje='Sin datos para eliminar.';
                    $exito=0;
                }                
                if ($exito) {
                    $transaction->commit();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Se ha eliminado la información guardada."),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    echo \app\models\Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                    return;
                } else {
                    $transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $mensaje),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    echo \app\models\Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                    return;
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error Catch  al grabar." . $mensaje),
                    "title" => Yii::t('jslang', 'Success'),
                );

                echo \app\models\Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                return;
            }
        }
    }
}
