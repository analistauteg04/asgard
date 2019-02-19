<?php

use app\widgets\PbVPOS\PbVPOS;
echo PbVPOS::widget([
    "id" => "VPOS",
    "referenceID" => $referenceID,
    "descripcionItem" => "Compra de curso",
    "titleBox" => "Compras en Linea",
    "nombre_cliente" => "Eduardo",
    "apellido_cliente" => "Cueva",
    "email_cliente" => "edu19432@gmail.com",
    "total" => "10.50",
    "isCheckout" => (is_null($requestID)?false:true),
    "requestID" => (is_null($requestID)?"":$requestID),
    "type" => "button",
]);