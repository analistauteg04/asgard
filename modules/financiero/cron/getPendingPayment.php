<?php

$logFile = dirname(__FILE__) . "/../../../runtime/logs/pb.log";
$dataDB = include_once(dirname(__FILE__) . "/../config/mod.php");
$dbname = $dataDB["financiero"]["db_facturacion"]["dbname"];
$dbuser = $dataDB["financiero"]["db_facturacion"]["username"];
$dbpass = $dataDB["financiero"]["db_facturacion"]["password"];
$dbserver = "127.0.0.1";//$dataDB["marketing"]["db_mailing"]["dbserver"];
$dbport = 3306;
$dsn = "mysql:host=$dbserver;dbname=$dbname;port=$dbport";
spl_autoload_register('my_autoloader');
use app\widgets\PbVPOS\PbVPOS;

echo PbVPOS::widget([
            "id" => "VPOS",
            "iscron" => true,            
            "type" => "form",
]);
function putMessageLogFile($message)
{
    global $logFile;
    if (is_array($message))
        $message = json_encode($message);
    $message = date("Y-m-d H:i:s") . " " . $message . "\r\n";
    if ((filesize($logFile) / pow(1024, 2)) > 100) { // si el log es mayor a 100 MB entonces se debe limpiar el archivo
        file_put_contents($logFile, $message, LOCK_EX);
    } else {
        file_put_contents($logFile, $message, FILE_APPEND | LOCK_EX);
    }
}
function my_autoloader($class)
{
    $filename1 = dirname(__FILE__) . '/../../../widgets/PbVPOS/PbVPOS.php';
    $filename2 = dirname(__FILE__) . '/../../../models/Http.php';
    include_once($filename1);
    include_once($filename2);
}