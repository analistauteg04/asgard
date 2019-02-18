<?php

use app\widgets\PbVPOS\PbVPOS;
echo PbVPOS::widget([
    "id" => "VPOS",
    "referenceID" => rand(10000, 50000),
    "descripcionItem" => "Compra de curso",
    "titleBox" => "Compras en Linea",
    "nombre_cliente" => "Eduardo",
    "apellido_cliente" => "Cueva",
    "email_cliente" => "edu19432@gmail.com",
    "total" => "10.50",
    "isCheckout" => (is_null($referenceID)?false:true),
    "requestID" => (is_null($referenceID)?"":$referenceID),
    "type" => "button",
]);

echo json_encode([$referenceID]);