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
            $respPersona['per_foto'] = '/uploads/ficha/silueta_default.jpg';
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
                $dirFileEnd = Yii::$app->params["documentFolder"] . "ficha/" . $per_id . "/" . $data["name_file"] . "_per_" . $per_id . ".jpeg";
                $status = false;
                if(strtolower($typeFile) == 'jpg' || strtolower($typeFile) == 'jpeg'){
                    $status = Utilities::moveUploadFile($files['tmp_name'], $dirFileEnd);
                }else{
                    $status = Utilities::changeIMGtoJPG($files['tmp_name'], $dirFileEnd);
                }
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
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                } else {
                    $transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error al grabar."),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error al grabar."),
                    "title" => Yii::t('jslang', 'Success'),
                );
                return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
            }
        }
    }

    public function actionCredencial(){
        $iduser = Yii::$app->session->get('PB_iduser', FALSE);
        $idper  = Yii::$app->session->get('PB_perid', FALSE);
        
        if (Yii::$app->session->get('PB_isuser')) {
            $foto_archivo = Yii::$app->basePath . Yii::$app->params["documentFolder"] . "ficha/" . $idper . "/doc_foto_per_" . $idper . ".jpeg";
            $bg_credencial = Yii::$app->basePath . Yii::$app->params["documentFolder"] . "ficha/credencial-admin-front.jpeg";
            $bg_credencial = Yii::$app->basePath . Yii::$app->params["documentFolder"] . "ficha/credencial-estudiante-front.jpeg";
            $foto_archivo = Yii::$app->basePath . Yii::$app->params["documentFolder"] . "ficha/test.jpeg";
            if(is_file($foto_archivo)){
                // mostrar los archivos
                Header("Content-type: image/jpeg");
                
                $im1 = imagecreatefromjpeg($bg_credencial); //image 325 x 523 
                $im2 = imagecreatefromjpeg($foto_archivo); //image 160 x 160 

                //redondeando esquinas
                $corner_radius = 20; // El radio de la esquina redondeada se establece en 20px por defecto
                $angle = 0; // The default angle is set to 0º
                $topleft = true; // La esquina superior izquierda se muestra por defecto
                $bottomleft = true; // La esquina inferior izquierda se muestra por defecto
                $bottomright = true; // La esquina inferior derecha se muestra por defecto
                $topright = true; // La esquina superior derecha se muestra por defecto
                $images_dir = 'rounded_corners';
                $bgColor = "#e6edf5"; //rgb(230,237,245)
                $marginPhoto = 31; // Para credenciales Estudiantes
                //$marginPhoto = 24; // Para credenciales Administrativas
                $bgColorAdmin = "#e8eff7"; //rgb(232,239,247)
                //$image_rounded = Yii::$app->basePath . Yii::$app->params["documentFolder"] . "ficha/$images_dir/rounded_corner_".$corner_radius."px.b.png";
                $image_rounded = Yii::$app->basePath . Yii::$app->params["documentFolder"] . "ficha/$images_dir/rounded_corner_".$corner_radius."px.w.png";
                $corner_source = imagecreatefrompng($image_rounded);
                $corner_width = imagesx($corner_source);  
                $corner_height = imagesy($corner_source);  
                $corner_resized = ImageCreateTrueColor($corner_radius, $corner_radius);
                ImageCopyResampled($corner_resized, $corner_source, 0, 0, 0, 0, $corner_radius, $corner_radius, $corner_width, $corner_height);
                $corner_width = imagesx($corner_resized);  
                $corner_height = imagesy($corner_resized);  
                $image = imagecreatetruecolor($corner_width, $corner_height);  
                $image = imagecreatefromjpeg($foto_archivo);
                $size = getimagesize($foto_archivo);
                $white = ImageColorAllocate($image,255,255,255);
                $black = ImageColorAllocate($image,0,0,0);

                // Esquina superior izquierda
                if ($topleft == true) {
                    $dest_x = 0;  
                    $dest_y = 0;  
                    imagecolortransparent($corner_resized, $black); 
                    imagecopymerge($image, $corner_resized, $dest_x, $dest_y, 0, 0, $corner_width, $corner_height, 100);
                } 

                // Esquina inferior izquierda
                if ($bottomleft == true) {
                    $dest_x = 0;  
                    $dest_y = $size[1] - $corner_height; 
                    $rotated = imagerotate($corner_resized, 90, 0);
                    imagecolortransparent($rotated, $black); 
                    imagecopymerge($image, $rotated, $dest_x, $dest_y, 0, 0, $corner_width, $corner_height, 100);  
                }

                // Esquina inferior derecha
                if ($bottomright == true) {
                    $dest_x = $size[0] - $corner_width;  
                    $dest_y = $size[1] - $corner_height;  
                    $rotated = imagerotate($corner_resized, 180, 0);
                    imagecolortransparent($rotated, $black); 
                    imagecopymerge($image, $rotated, $dest_x, $dest_y, 0, 0, $corner_width, $corner_height, 100);  
                }

                // Esquina superior derecha
                if ($topright == true) {
                    $dest_x = $size[0] - $corner_width;  
                    $dest_y = 0;  
                    $rotated = imagerotate($corner_resized, 270, 0);
                    imagecolortransparent($rotated, $black); 
                    imagecopymerge($image, $rotated, $dest_x, $dest_y, 0, 0, $corner_width, $corner_height, 100);  
                }

                // Rotar la imagen
                $image_rn = imagerotate($image, $angle, $white);

                // Texto
                $ttf_light = Yii::$app->basePath . Yii::$app->params["documentFolder"] . "fonts/Gotham-Book.otf";
                $ttf_bold = Yii::$app->basePath . Yii::$app->params["documentFolder"] . "fonts/Gotham-Medium.ttf";
                $colorB = imagecolorallocate($im1, 0, 84, 139);//#00548b
                $colorW = imagecolorallocate($im1, 255, 255, 255);//#FFFFFF
                $font_size = 11;
                $angulo = 0;
                $posX = 12;
                $posY = 370;

                //Imagen, tamaño, ángulo, x, y, color, fuente, texto
                imagefttext($im1, $font_size, $angulo, $posX, $posY, $colorB, $ttf_light, "Antonio Leyton Cadena");
                imagefttext($im1, $font_size, $angulo, $posX, 390, $colorB, $ttf_light, "Mercadotecnia");
                imagefttext($im1, $font_size, $angulo, $posX, 410, $colorB, $ttf_light, "Presencial");

                // Periodo
                $periodo = date("Y") . " - " . ( 1 + date("Y"));
                //Imagen, tamaño, ángulo, x, y, color, fuente, texto
                imagefttext($im1, 19, 0, 15, 495, $colorW, $ttf_bold, $periodo);

                // Crear la imagen final
                //imagejpeg($image);
                imagecopy($im1, $image_rn, (imagesx($im1)/2)-(imagesx($image_rn)/2), (imagesy($im1)/2)-(imagesy($image_rn)/2)-$marginPhoto, 0, 0, imagesx($image_rn), imagesy($image_rn));
                
                //imagecopy($im1, $im2, (imagesx($im1)/2)-(imagesx($im2)/2), (imagesy($im1)/2)-(imagesy($im2)/2)-32, 0, 0, imagesx($im2), imagesy($im2));
                //imagejpeg($im,"test4.jpg",90);
                imagepng($im1);
                imagedestroy($im1);
                imagedestroy($im2);
                imagedestroy($image_rn);
                exit();
            }else{
                // no existe hay q crear la imagen base
                Header("Content-type: image/jpeg");
                $cadena = "2020 - 2021";
                $im      = imagecreatefromjpeg($foto_archivo);
                $naranja = imagecolorallocate($im, 220, 210, 60);
                $px      = (imagesx($im) - 7.5 * strlen($cadena)) / 2;
                imagestring($im, 3, $px, 9, $cadena, $naranja);
                imagejpeg($im);
                imagedestroy($im);
                exit();
            }
            /*if (preg_match("/^\/uploads\//", $route)) {
                $url_image = Yii::$app->basePath . $route;
                $arrIm = explode(".", $url_image);
                $typeImage = $arrIm[count($arrIm) - 1];
                if (file_exists($url_image)) {
                    if (strtolower($typeImage) == "png") {
                        Header("Content-type: image/png");
                        $im = imagecreatefromPng($url_image);
                        ImagePng($im); // Mostramos la imagen
                        ImageDestroy($im); // Liberamos la memoria que ocupaba la imagen
                    } elseif (strtolower($typeImage) == "jpg" || strtolower($typeImage) == "jpeg") {
                        Header("Content-type: image/jpeg");
                        $im = imagecreatefromJpeg($url_image);
                        ImageJpeg($im); // Mostramos la imagen
                        ImageDestroy($im); // Liberamos la memoria que ocupaba la imagen
                    } elseif (strtolower($typeImage) == "pdf") {
                        Header("Content-type: application/pdf");
                        return file_get_contents($url_image);
                    }
                    exit();
                }
            }*/
        }
        /* Crear una imagen en blanco */
        

/*
        $im = imagecreatetruecolor(90, 90);
        $fondo = imagecolorallocate($im, 255, 255, 255);
        $ct = imagecolorallocate($im, 0, 0, 0);
        imagefilledrectangle($im, 0, 0, 150, 30, $fondo);
// Imprimir un mensaje de error
        imagestring($im, 1, 5, 5, Yii::t('jslang', 'Bad Request') . ": " . $route, $ct);
        ImagePng($im); // Mostramos la imagen
        ImageDestroy($im); // Liberamos la memoria que ocupaba la imagen
        exit();
*/
        
    }

}
