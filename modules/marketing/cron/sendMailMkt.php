<?php

$logFile = dirname(__FILE__) . "/../../../runtime/logs/pb.log";
$dataDB = include_once("../config/mod.php");
//include_once("../../../webservices/WsMailChimp.php");
$dbname = $dataDB["marketing"]["db_mailing"]["dbname"];
$dbuser = $dataDB["marketing"]["db_mailing"]["username"];
$dbpass = $dataDB["marketing"]["db_mailing"]["password"];
$dbserver = "127.0.0.1";//$dataDB["marketing"]["db_mailing"]["dbserver"];
$dbport = 8889;
$dsn = "mysql:host=$dbserver;dbname=$dbname;port=$dbport";
spl_autoload_register('my_autoloader');
use app\webservices\WsMailChimp as mailchimp;
$ws1 = new mailchimp();
//echo json_encode($ws1->getAllTemplates());
getCampaignOnTime($ws1);

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
    $filename1 = dirname(__FILE__) . '/../../../webservices/WsMailChimp.php';
    $filename2 = dirname(__FILE__) . '/../../../models/Http.php';
    include_once($filename1);
    include_once($filename2);
}
function getCampaignOnTime($webServer)
{
    GLOBAL $dsn, $dbuser, $dbpass, $dbname;
    try {
        $now = date("Ymd");
        $dia = date("N");
        $iniTime = date('H:i', strtotime("-3 minutes", strtotime(date("Y-m-d H:i:s"))));
        $endTime = date('H:i', strtotime("+3 minutes", strtotime(date("Y-m-d H:i:s"))));
        $pdo = new \PDO($dsn, $dbuser, $dbpass);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * , p.pla_id as temp_id " .
        "FROM programacion AS p " .
        "INNER JOIN dia_programacion AS dp ON p.pro_id = dp.pro_id " .
        "INNER JOIN lista AS l ON l.lis_id = p.lis_id " .
        "WHERE " .
        "p.pro_estado=1 AND " .
        "p.pro_estado_logico=1 AND " .
        "dp.dpro_estado=1 AND " .
        "dp.dpro_estado_logico=1 AND " .
        "p.pro_fecha_desde <= '".$now."' AND " .
        "p.pro_fecha_hasta >= '".$now."' AND " .
        "dp.dia_id = '".$dia."' AND " .
        "p.pro_hora_envio > '".$iniTime."' AND " .
        "p.pro_hora_envio < '".$endTime."' " . 
        ";";
        //echo $sql;
        $cmd = $pdo->prepare($sql);
        //$cmd->execute([":now" => $now, ":dia" => $dia, ":iniDate" => $iniTime, ":endDate" => $endTime]);
        $cmd->execute();
        $rows = $cmd->fetchAll(\PDO::FETCH_ASSOC);
        //echo json_encode($rows);
        if (count($rows) > 0) {
            for ($i = 0; $i < count($rows); $i++) {
                $addressInfo = array(
                    //"subject_line" => $rows[$i][""],
                    //"title" => $rows[$i][""],
                    "subject_line" => "Subject de Envio",
                    "title" => "Titulo de Envio",
                    "from_name" => $rows[$i]["lis_nombre_principal"],
                    "reply_to" => $rows[$i]["lis_correo_principal"],
                    "template_id" => (int) $rows[$i]["temp_id"],
                );
                $obj_new = $webServer->createCampaign($rows[$i]["lis_codigo"], $addressInfo);
                if(isset($obj_new["id"])){
                    $sendCampaign = $webServer->sendCampaign($obj_new["id"]);
                    if(is_array($sendCampaign)){
                        echo "error crear campania: " . json_encode($sendCampaign);
                        putMessageLogFile("Error al enviar campaña ". $sendCampaign);
                    }
                }else{
                    echo "error crear campania: ". json_encode($obj_new);
                    putMessageLogFile("Error al crear campaña " . $obj_new);
                }
            }
        }
    } catch (PDOException $e) {
        echo 'Falló la conexión: ' . $e->getMessage();
        putMessageLogFile('Error: ' . $e->getMessage());
        exit;
    }
    
}

?>