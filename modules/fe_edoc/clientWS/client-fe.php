<?php

include_once('libs/SybaseFactura.php');//para HTTP

$obj = new SybaseFactura();
//$res=$obj->consultarSybCabFacturas();
$res = $obj->insertarFacturas();




/* Web Server */
$WS_HOST = "sistema.penblu.com";
$WS_PORT = "80";
$WS_USER = "test";
$WS_PASS = "test";
$WS_URI  = "asgard/api/request/fe_edoc/Client/getTest/json";
$timeSend = 5; // en segundos

$response = Http::connect($WS_HOST, $WS_PORT)->doPost($WS_URI, array('sleep' => 2));
$arr_response = json_decode($response, true);

putMessageLogFile($arr_response);

function sendEdoc (){
    GLOBAL $timeSend;
    /* Proceso de lectura de datos */

    sleep($timeSend);

}

function putMessageLogFile ($message) {
    GLOBAL $logfile;
    if (is_array($message))
        $message = json_encode($message);
    $message = date("Y-m-d H:i:s") . " " . $message . "\n";
    if (!is_dir(dirname($logfile))) {
        mkdir(dirname($logfile), 0777, true);
        chmod(dirname($logfile), 0777);
        touch($logfile);
    }
    file_put_contents($logfile, $message, FILE_APPEND | LOCK_EX);
}

?>