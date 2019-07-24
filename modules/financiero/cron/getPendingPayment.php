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

getPagosPendientes();

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
function getPagosPendientes() {
    GLOBAL $dsn, $dbuser, $dbpass, $dbname;
    
    $pdo = new \PDO($dsn, $dbuser, $dbpass);    
    $sql = "
                    select vres.reference,vres.requestId,vres.ordenPago,vres.tipo_orden
                    from db_financiero.vpos_response as vres
                    left join db_financiero.vpos_info_response as vire on vire.ordenPago = vres.ordenPago and vire.tipo_orden = vres.tipo_orden
                    where ifnull(vire.id,0) = 0 and
                    vire.estado_logico= :estado_logico and
                    vres.estado_logico = :estado_logico
                ";
    $cmd = $pdo->prepare($sql);
    $cmd->execute();
    $rows = $cmd->fetchAll(\PDO::FETCH_ASSOC);        
    if (count($rows) > 0) {
        for ($i = 0; $i < count($rows); $i++) {
            
        }
    }
}
function my_autoloader($class)
{
    $filename1 = dirname(__FILE__) . '/../../../widgets/PbVPOS/PbVPOS.php';
    $filename2 = dirname(__FILE__) . '/../../../models/Http.php';
    include_once($filename1);
    include_once($filename2);
}