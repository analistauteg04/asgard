<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* Web Server */
$WS_HOST = "localhost";
$WS_PORT = "8888";
$WS_USER = "test";
$WS_PASS = "test";
$WS_URI_FAC = "asgard/api/request/fe_edoc/Client/getTest/json";
$WS_URI_NC = "asgard/api/request/fe_edoc/Client/getTest/json";
$WS_URI_RET = "asgard/api/request/fe_edoc/Client/getTest/json";

$service = "uteg-fe";
$logFile = "../logs/$service.log";
$limit = 1;

function putMessageLogFile($message) {
    GLOBAL $logFile;
    if (is_array($message))
        $message = json_encode($message);
    $message = date("Y-m-d H:i:s") . " " . $message . "\n";
    file_put_contents($logFile, $message, FILE_APPEND | LOCK_EX);
}
