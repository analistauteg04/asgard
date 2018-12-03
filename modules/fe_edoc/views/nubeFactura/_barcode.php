<?php
/* SOLUCION VALIDA */

use Yii;
use \barcode\barcode\GeneratedCodebar;
$ruta = Yii::app()->basePath;

// Loading Font
$font = new BCGFontFile($ruta . '/vendor/barcode/yii2-barcode/font/Arial.ttf', 8);

// The arguments are R, G, B for color.
$color_black = new BCGColor(0, 0, 0);
$color_white = new BCGColor(255, 255, 255);

// Barcode Part
$code = new BCGcode128();
$code->setScale(2);
$code->setThickness(30);//tamaño en vertical pixel
$code->setForegroundColor($color_black);
$code->setBackgroundColor($color_white);
$code->setFont($font);
$code->setStart(NULL);
$code->setTilde(true);
$code->parse($cabFact['ClaveAcceso']);
$code->clearLabels();//Elmina el TItulo de la LIbreria


// Drawing Part
//$drawing = new BCGDrawing(Yii::app()->theme->baseUrl.'/images/plantilla/filename.png', $color_white);
$drawing = new BCGDrawing('', $color_white);
$drawing->setBarcode($code);
$drawing->draw();
$drawing->setFilename(Yii::app()->params['seaBarra'].$cabFact['IdentificacionComprador'].'.png');

header('Content-Type: image/png');
//header('Content-Type: text/html; charset=utf-8');
$drawing->finish(BCGDrawing::IMG_FORMAT_PNG);
?>
