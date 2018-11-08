<?php
include('SybaseFactura.php');//para HTTP
$obj = new SybaseFactura();
//$res=$obj->consultarSybCabFacturas();
$res=$obj->insertarFacturas();
?>