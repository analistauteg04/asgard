<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use Yii;
use yii\helpers\Url;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Svrnm\ExcelDataTables\ExcelDataTable;



/**
 * Description of Utilities
 *
 * @author eduardocueva
 */
class Utilities {

    public static function sendEmail($titleMessage = "", $from, $to = array(), $subject, $body, $files = array(), $template = "/mail/layouts/mailing", $fileRoute = "/mail/layouts/files", $basePath = NULL) {
        if (function_exists('proc_open')) {
            //self::putMessageLogFile("Mail function exist");
        } else {
            self::putMessageLogFile("Error Mail function not exist");
        }
        $routeBase = (isset($basePath))?($basePath):(Yii::$app->basePath);
        $socialNetwork = Yii::$app->params["socialNetworks"];

        $mail = Yii::$app->mailer->compose("@app" . $template, [
            'titleMessage' => $titleMessage,
            'body' => $body,
            'socialNetwork' => $socialNetwork,
            'bannerImg' => 'banner.jpg',
            'facebook' => 'facebook.png',
            'twitter' => 'twitter.png',
            'youtube' => 'youtube.png',
            'pathImg' => $routeBase . "/" . $fileRoute . "/",
        ]);
        $mail->setFrom($from);
        $mail->setTo($to);
        $mail->setSubject($subject);
        foreach ($files as $key2 => $value2) {
            $mail->attach($value2);
        }
        try {
            $mail->send();
        } catch (Exception $ex) {
            self::putMessageLogFile($ex);
        }
    }

    /**
     * Function getMailMessage
     * @author  Diana Lopez <dlopez@uteg.edu.ec>
     * @param      
     * @return  
     */
    public static function getMailMessage($file, $slack = array(), $lang = "es", $basePath = NULL) {
        $routeBase = (isset($basePath))?($basePath . "/mail/layouts/messages/"):(Yii::$app->basePath . "/mail/layouts/messages/");
        $content = "";
        if (is_dir($routeBase . $lang)) {
            $routeBase .= $lang . "/" . $file;
        } elseif (is_dir($routeBase . "en")) {
            $routeBase .= "en/" . $file;
        } else
            return $content;
        if (is_file($routeBase))
            $content = file_get_contents($routeBase);
        if (count($slack) > 0) {
            foreach ($slack as $key => $value) {
                $content = str_replace($key, $value, $content);
            }
        }
        return $content;
    }

    /**
     * Función escribir en log del sistema
     *
     * @access public
     * @author Eduardo Cueva
     * @param  string $message       Escribe variable en archivo de logs.
     */
    public static function putMessageLogFile($message) {
        if (is_array($message))
            $message = json_encode($message);
            $message = date("Y-m-d H:i:s") . " " . $message . "\n";
        if (!is_dir(dirname(Yii::$app->params["logfile"]))) {
            mkdir(dirname(Yii::$app->params["logfile"]), 0777, true);
            chmod(dirname(Yii::$app->params["logfile"]), 0777);
            touch(Yii::$app->params["logfile"]);
        }
        /*if(filesize(Yii::$app->params["logfile"]) >= Yii::$app->params["MaxFileLogSize"]){
            $newName = str_replace(".log", "-" . date("YmdHis") . ".log", Yii::$app->params["logfile"]);
            rename(Yii::$app->params["logfile"], $newName);
            touch(Yii::$app->params["logfile"]);
        }
        //se escribe en el fichero*/
        file_put_contents(Yii::$app->params["logfile"], $message, FILE_APPEND | LOCK_EX);
    }

    /**
     * Función que devuelve la ip del usuario en session
     *
     * @access public
     * @author Eduardo Cueva
     * @return string   $ip         Retorna la IP del cliente o usuario
     */
    public static function getClientRealIP() {
        $ip = $_SERVER['REMOTE_ADDR'];
        if (!empty($_SERVER['HTTP_CLIENT_IP']) && self::validateTypeField($_SERVER['HTTP_CLIENT_IP'], 'ip'))
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']) && self::validateTypeField($_SERVER['HTTP_X_FORWARDED_FOR'], 'ip'))
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        return $ip;
    }

    /**
     * Function ajaxResponse
     * @author  Diana Lopez <dlopez@uteg.edu.ec>
     * @param      
     * @return  
     */
    public static function ajaxResponse($status, $type, $label, $error, $message, $addicionalData = array()) {
        $arroout = array();
        $arroout["status"] = $status;
        $arroout["type"] = $type;
        $arroout["label"] = $label;
        $arroout["error"] = $error;
        $arroout["message"] = $message;
        if (count($addicionalData) > 0) {
            $arroout["data"] = $addicionalData;
        }
        return json_encode($arroout);
    }
    
    public static function createTemporalFile($filename) {
        $nombre_tmp = tempnam(sys_get_temp_dir() . $filename . "_" . date("Ymdhis"), "PB");
        return $nombre_tmp;
    }

    public static function removeTemporalFile($filename) {
        unlink($filename);
    }
    
    /**
     * Función que mueve un archivo a otro directorio
     *
     * @access public
     * @author Eduardo Cueva
     * @param string $dirFileIni Directorio Inicial
     * @param string $dirFileEnd Directorio Final
     * @return bool       Estado del movimiento del archivo
     */
    public static function moveUploadFile($dirFileIni, $dirFileEnd) {
        $dirFileEnd = Yii::$app->basePath . str_replace("../", "", $dirFileEnd);
        if (is_file($dirFileIni)) {
            if (self::verificarDirectorio(dirname($dirFileEnd))) {
                if (move_uploaded_file($dirFileIni, $dirFileEnd)) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Función que cambia la dimenision de una imagen
     *
     * @access public
     * @author Eduardo Cueva
     * @param string $dirImg Ruta de la Imagen
     * @param string $newwidth Ancho de la imagen. Ejemplo: 600
     * @param string $newheight Altura de la imagen. Ejemplo: 500
     * @return bool       Estado del movimiento del archivo
     */
    public static function changeSizeImage($dirImg, $newwidth, $newheight, $x1 = 0, $y1 = 0, $w = 0, $h = 0) {
        $w = ($w!=0)?$w:$newwidth;
        $h = ($h!=0)?$h:$newheight;
        
        $arrIm = explode(".", $dirImg);
        $typeImage = $arrIm[count($arrIm) - 1];
        $dirImg = Yii::$app->basePath . str_replace("../", "", $dirImg);

        list( $width_old, $height_old ) = getimagesize($dirImg);

        $thumb = imagecreatetruecolor($newwidth, $newheight);

        if (strtolower($typeImage) == "png") {
            $source = imagecreatefrompng($dirImg);
            imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width_old, $height_old);
            imagepng($thumb, $dirImg, 100);

            $im = imagecreatefrompng($dirImg);
            $dest = imagecreatetruecolor($w, $h);

            imagecopyresampled($dest, $im, 0, 0, $x1, $y1, $w, $h, $w, $h);
            imagepng($dest, $dirImg, 100);
        } else {
            $source = imagecreatefromjpeg($dirImg);
            imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width_old, $height_old);
            imagejpeg($thumb, $dirImg, 100);

            $im = imagecreatefromjpeg($dirImg);
            $dest = imagecreatetruecolor($w, $h);

            imagecopyresampled($dest, $im, 0, 0, $x1, $y1, $w, $h, $w, $h);
            imagejpeg($dest, $dirImg, 100);
        }
    }

    /**
     * Función que cambia la extension de una imagen a jpg
     *
     * @access public
     * @author Eduardo Cueva
     * @param string $dirImg Ruta de la Imagen
     * @param string $ext Extension que se desea cambiar
     * @return bool       Estado del movimiento del archivo
     */
    public static function changeIMGtoJPG($dirImg) {
        $dirImg = Yii::$app->basePath . str_replace("../", "", $dirImg);
        if (is_file($dirImg)) {
            $arrIm = explode(".", basename($dirImg));
            $typeImage = $arrIm[count($arrIm) - 1];
            if (strtolower($typeImage) == "png") {
                $image = imagecreatefrompng($dirImg);
                $newFile = preg_replace("/\.(png|Png|PNG)$/", '.jpg', $dirImg);
                imagejpeg($image, $newFile, "100");
                imagedestroy($image);
                unlink($dirImg);
            } if(strtolower($typeImage) == "gif") {
                $image = imagecreatefromgif($dirImg);
                $newFile = preg_replace("/\.(gif|Gif|GIF)$/", '.jpg', $dirImg);
                imagejpeg($image, $newFile, "100");
                imagedestroy($image);
                unlink($dirImg);
            }
        }
    }
    
    /**
     * Función que cambia la extension de una imagen a jpg
     *
     * @access public
     * @author Eduardo Cueva
     * @param string    $icon Nombre del Icono
     * @return string         Devuelve string css del icono
     */
    public static function getIcon($icon){
        $cssIcon = "";
        switch ($icon){
            case 'edit': 
                $cssIcon = "glyphicon glyphicon-pencil";
                break;
            case 'view':
                $cssIcon = "glyphicon glyphicon-eye-open";
                break;
            case 'remove':
                $cssIcon = "glyphicon glyphicon-remove";
                break;
        }
        return $cssIcon;
    }
    
    /**
     * Función que verifica si un directorio existe caso contrario intenta crearlo
     *
     * @access public
     * @author Eduardo Cueva
     * @param  string   $folder     Directorio a verificar si existe o no
     * @return bool     $bool       Retorna la IP del cliente o usuario
     */
    public static function verificarDirectorio($folder) {
        if (!file_exists($folder)) {
            if (mkdir($folder, 0755, true)) {
                //chown($folder, Yii::$app->params['userWebServer']);
                return true;
            } else {
                self::putMessageLogFile("Error: System cannot create folder: $folder");
                return false;
            }
        } else
            return true;
    }

    /**
     * Función que crea desencripta un mensaje a traves de una clave utilizando AES con metodo de encriptacion
     *
     * @access public
     * @author Eduardo Cueva
     * @param  string   $filename        Archivo a obtener el content type.
     * @return string   $contentType     Content Type del Archivo.
     */
    public static function mimeContentType($filename) {

        $mime_types = array(
            'txt' => 'text/plain',
            'htm' => 'text/html',
            'html' => 'text/html',
            'php' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'xml' => 'application/xml',
            'swf' => 'application/x-shockwave-flash',
            'flv' => 'video/x-flv',
            // images
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml',
            // archives
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
            'exe' => 'application/x-msdownload',
            'msi' => 'application/x-msdownload',
            'cab' => 'application/vnd.ms-cab-compressed',
            // audio/video
            'mp3' => 'audio/mpeg',
            'qt' => 'video/quicktime',
            'mov' => 'video/quicktime',
            // adobe
            'pdf' => 'application/pdf',
            'psd' => 'image/vnd.adobe.photoshop',
            'ai' => 'application/postscript',
            'eps' => 'application/postscript',
            'ps' => 'application/postscript',
            // ms office
            'doc' => 'application/msword',
            'rtf' => 'application/rtf',
            'xls' => 'application/vnd.ms-excel',
            'ppt' => 'application/vnd.ms-powerpoint',
            // open office
            'odt' => 'application/vnd.oasis.opendocument.text',
            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
        );

        $ext = strtolower(array_pop(explode('.', $filename)));
        if (array_key_exists($ext, $mime_types)) {
            return $mime_types[$ext];
        } elseif (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME);
            $mimetype = finfo_file($finfo, $filename);
            finfo_close($finfo);
            return $mimetype;
        } else {
            return 'application/octet-stream';
        }
    }

    /**
     * Devuelve un Objeto XML a partir de un Arreglo
     *
     * @access public
     * @author http://darklaunch.com/2009/05/23/php-xml-encode-using-domdocument-convert-array-to-xml-json-encode
     * @param mixed $mixed  Arreglo de datos
     * @param mixed $domElement     Nodo del Documento padre o elemento
     * @param mixed $DOMDocument    Nodo del Documento principal
     * @return string   $ip         Retorna la IP del cliente o usuario
     */
    public static function xml_encode($mixed, $domElement = null, $DOMDocument = null)
    {
        if (is_null($DOMDocument)) {
            $DOMDocument = new \DOMDocument();
            $DOMDocument->formatOutput = true;
            self::xml_encode($mixed, $DOMDocument, $DOMDocument);
            return $DOMDocument->saveXML();
        } else {
            if (is_array($mixed)) {
                foreach ($mixed as $index => $mixedElement) {
                    if (is_int($index)) {
                        if ($index === 0) {
                            $node = $domElement;
                        } else {
                            $node = $DOMDocument->createElement($domElement->tagName);
                            $domElement->parentNode->appendChild($node);
                        }
                    } else {
                        $plural = $DOMDocument->createElement($index);
                        $domElement->appendChild($plural);
                        $node = $plural;
                        if (!(rtrim($index, 's') === $index)) {
                            $singular = $DOMDocument->createElement(rtrim($index, 's'));
                            $plural->appendChild($singular);
                            $node = $singular;
                        }
                    }

                    self::xml_encode($mixedElement, $node, $DOMDocument);
                }
            } else {
                $mixed = is_bool($mixed) ? ($mixed ? 'true' : 'false') : $mixed;
                $domElement->appendChild($DOMDocument->createTextNode($mixed));
            }
        }
    }
    
    public static function generarReporteXLS($nombarch, $nameReport, $arrHeader, $arrData, $colPosition = array(), $typeExp = "Xls", $emp_id = null){
        if (is_null($emp_id)) {
            $emp_id = Yii::$app->session->get('PB_idempresa');
        }
        if(count($colPosition) == 0){
            $colPosition = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U");
        }
        if(count($arrData) == 0){
            echo Yii::t("reporte","No Reports");
            return;
        }
        if(count($arrHeader) == 0){
            echo Yii::t("reporte","No Reports");
            return;
        }
        $negrita = array(
            'font' => array(
                'bold' => true,
            ),
        );
        $border = array(
            'allborders' =>
                array(
                    'borders' => array(
                        'allborders' => array(
                            'style' => Border::BORDER_THIN,
                            'color' => array('argb' => 'FF000000'),
                        ),
                    ),
                ),
            'top' =>
                array(
                    'borders' => array(
                        'top' => array(
                            'style' => Border::BORDER_MEDIUM,
                            'color' => array('argb' => 'FF000000'),
                        ),
                    ),
                ),
            'bottom' =>
                array(
                    'borders' => array(
                        'bottom' => array(
                            'style' => Border::BORDER_MEDIUM,
                            'color' => array('argb' => 'FF000000'),
                        ),
                    ),
                ),
            'right' =>
                array(
                    'borders' => array(
                        'right' => array(
                            'style' => Border::BORDER_MEDIUM,
                            'color' => array('argb' => 'FF000000'),
                        ),
                    ),
                ),
            'left' =>
                array(
                    'borders' => array(
                        'left' => array(
                            'style' => Border::BORDER_MEDIUM,
                            'color' => array('argb' => 'FF000000'),
                        ),
                    ),
                ),
        );
        try{
            $objPHPExcel = new Spreadsheet();
            $objPHPExcel->getProperties()->setCreator(Yii::$app->session->get("PB_nombres"))
                    ->setLastModifiedBy(Yii::$app->session->get("PB_nombres"))
                    ->setTitle("Office 2007 XLSX")
                    ->setSubject("Office 2007 XLSX $nombarch")
                    ->setDescription("$nombarch for Office 2007 XLSX, generated using PHP classes.")
                    ->setKeywords("office 2007 openxml php")
                    ->setCategory("$nombarch result file");
            $objPHPExcel->getActiveSheet()->mergeCells('C6:D6');
            $objPHPExcel->getActiveSheet()->mergeCells('C7:D7');
            $objPHPExcel->getActiveSheet()->mergeCells('C4:N4');
            $objPHPExcel->getActiveSheet()->getStyle("C4")->getFont()->setSize(36);
            $objPHPExcel->getActiveSheet()->getStyle("C4")->getFont()->setBold(True);
            $objPHPExcel->getActiveSheet()->getStyle("C6")->getFont()->setSize(16);
            $objPHPExcel->getActiveSheet()->getStyle("C6")->getFont()->setBold(True);
            $objPHPExcel->getActiveSheet()->getStyle("E6")->getFont()->setSize(16);
            $objPHPExcel->getActiveSheet()->getStyle("C7")->getFont()->setSize(16);
            $objPHPExcel->getActiveSheet()->getStyle("C7")->getFont()->setBold(True);
            $objPHPExcel->getActiveSheet()->getStyle("E7")->getFont()->setSize(16);

            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('C4', $nameReport)
                    ->setCellValue('C6', Yii::t("reporte","Produced by"))
                    ->setCellValue('E6', Yii::$app->session->get("PB_nombres"))
                    ->setCellValue('C7', Yii::t("reporte","Date"))
                    ->setCellValue('E7', date("Y-m-d H:i:s"));

            // seteo de bordes cabecera de reporte
            $objPHPExcel->getActiveSheet()->getStyle("B2:S2")->applyFromArray($border["top"]);
            $objPHPExcel->getActiveSheet()->getStyle("B10:S10")->applyFromArray($border["bottom"]);
            $objPHPExcel->getActiveSheet()->getStyle("B2:B10")->applyFromArray($border["left"]);
            $objPHPExcel->getActiveSheet()->getStyle("S2:S10")->applyFromArray($border["right"]);
            $objPHPExcel->getActiveSheet()->getStyle("B$i:D$i")->applyFromArray($border);
            
            $objDrawing = new drawing();
            $objDrawing->setName('Logo');
            $objDrawing->setDescription('Logo');
            $objDrawing->setPath(Yii::$app->basePath . "/themes/" . Yii::$app->view->theme->themeName . "/assets/img/logos/logo_" . $emp_id . ".png");
            //$objDrawing->setHeight(80);
            $objDrawing->setWidth(300);
            $objDrawing->setCoordinates('O4');
            //$objDrawing->setOffsetX(1);
            //$objDrawing->setOffsetY(5);
            $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

            $i='12';
            //$i = '1';

            for($i=0; $i<count($arrHeader); $i++){
                $j = 12;
                $objPHPExcel->getActiveSheet()->getStyle($colPosition[$i] . $j)->getFont()->setBold(True);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colPosition[$i] . $j, $arrHeader[$i]);
            }
            $i = 12;
            //$i = 1;
            foreach($arrData as $key => $value){
                $k = 0;
                $j = $i + 1;
                foreach($value as $key2 => $value2){
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colPosition[$k] . $j, $value2);
                    $k++;
                }
                $i++;
            }
            $objWriter = IOFactory::createWriter($objPHPExcel, $typeExp);
            $objWriter->save('php://output');
        }catch(Exception $e){
            echo Yii::t("reporte","Error to export Excel");
        }

    }

    public static function writeReporteXLS($uriFile, $arrHeader, $arrData, $sheetName = "DATA"){
        if(count($arrData) == 0){
            echo Yii::t("reporte","No Reports");
            return;
        }
        if(count($arrHeader) == 0){
            echo Yii::t("reporte","No Reports");
            return;
        }
        try{
            
            $dataTable = new ExcelDataTable();
            $data = array();
            for($i=0; $i<count($arrData); $i++){
                $j=0;
                foreach($arrData[$i] as $key => $value){
                    $data[$i][$arrHeader[$j]] = $value;
                    $j++;
                }
            }
            $dataTable->setSheetName($sheetName);
            $dataTable->showHeaders()->addRows($data);
            return $dataTable->fillXLSX($uriFile);//attachToFile($uriFile, $out, false);
            
        }catch(Exception $e){
            echo Yii::t("reporte","Error to export Excel");
        }
    }
    
    
    public static function zipFiles($nombreZip, $arr_files = array()){
        $zip = new \ZipArchive();
        $filename = self::createTemporalFile($nombreZip);

        if ($zip->open($filename, \ZipArchive::CREATE)!==TRUE) {
            self::putMessageLogFile("cannot open <$filename>");
        }
        for($i=0; $i<count($arr_files); $i++){
            $zip->addFile($arr_files[$i]["ruta"],$arr_files[$i]["name"]);
        }
        $zip->close();
        return $filename;
    }
    
    public static function getLoginUrl(){
        $link = '/site/login';
        if(Yii::$app->session->get('PB_idempresa') != null && Yii::$app->session->get('PB_idempresa') != 1){
            $link = '/site/loginemp';
        }
        return $link;
    }
    
    public static function genero() {
        return [
            //'0' => Yii::t("formulario", "-Select-"),
            'M' => Yii::t("perfil", "Male"),
            'F' => Yii::t("perfil", "Female"),
            'G' => Yii::t("perfil", "GLBT"),
        ];
    }

    public static function validateTypeField($field, $type){
        $status = false;
        switch($type) {
            case 'ip': //solo ip
                if (preg_match("/^(([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]).){3}([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/", $field))
                    $status = true;
                break;
            case 'number'://solo numeros
                if(preg_match("/^(?:\+|-)?\d+$/", $field))
                    $status = true;
                break;
            case 'alfa'://solo letras
                if (preg_match("/^([a-zA-ZáéíóúÁÉÍÓÚÑñ '])+$/", $field))
                    $status = true;
                break;
            case 'alfanumerico':
                if (preg_match("/^([a-zA-Z áéíóúÁÉÍÓÚÑñ0-9])+$/", $field))
                    $status = true;
                break;
            case 'direccion':
                if (preg_match("/^([a-zA-Z áéíóúÁÉÍÓÚÑñ0-9 ./-])+$/", $field))
                    $status = true;
                break;
            case 'email'://email        
                if (preg_match("/^[\w\-\.]{3,}@([\w\-]{2,}\.)*([\w\-]{2,}\.)[\w\-]{2,4}$/", $field))
                    $status = true;
                break;
            case 'telefono':
                if (preg_match("/^(((\d{6,9}[ ]?\/[ ]?)(\d{6,9}[ ]?\/[ ]?)*\d{6,9})|(\d{6,9}))$/", $field))
                    $status = true;
                break;
            case 'celular':
                if (preg_match("/^(((\d{9,13}[ ]?\/[ ]?)(\d{9,10}[ ]?\/[ ]?)*\d{9,13})|(\d{9,13}))$/", $field))
                    $status = true;
                break;
            case 'dinero':
                if (preg_match("/^((\d{1,9})(\.\d{1,2})?)$/", $field))
                    $status = true;
                break;
            case 'fecha':
                if (preg_match("/^(19|20)\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])/", $field))
                    $status = true;
                break;
            case 'tiempo':
                if (preg_match("/^(0[1-9]|1\d|2[0-3]):([0-5]\d)$/", $field))
                    $status = true;
                break;
            case 'url' :
                if (preg_match("/^(http|https)\:\/\/[a-z0-9\.-]+\.[a-z]{2,4}/", $field))
                    $status = true;
                break;
            default :// all
                if (preg_match("/^(.|\n)+$/", $field))
                    $status = true;
                break;
        }
        return $status;
    }

    public static function validateToken($tokenID, $numberSecret) {
        return true; // remover esto porque se debe validar
        if ($tokenID === Yii::$app->params['tokenid'] && $numberSecret === Yii::$app->params['numbersecret']) {
            return true;
        }
        return false;
    }
    
    public static function Meses() {
        return [
            //'0' => Yii::t("formulario", "-Select-"),
            '1' => Yii::t("perfil", "Enero"),
            '2' => Yii::t("perfil", "Febrero"),
            '3' => Yii::t("perfil", "Marzo"),
            '4' => Yii::t("perfil", "Abril"),
            '5' => Yii::t("perfil", "Mayo"),
            '6' => Yii::t("perfil", "Junio"),
            '7' => Yii::t("perfil", "Julio"),
            '8' => Yii::t("perfil", "Agosto"),
            '9' => Yii::t("perfil", "Septiembre"),
            '10' => Yii::t("perfil", "Octubre"),
            '11' => Yii::t("perfil", "Noviembre"),
            '12' => Yii::t("perfil", "Diciembre"),
        ];
    }
    
}
