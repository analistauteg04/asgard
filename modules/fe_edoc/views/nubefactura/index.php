<?php
/**
 * Este Archivo contiene las vista de Compañias
 * @author Ing. Byron Villacreses <byronvillacreses@gmail.com>
 * @copyright Copyright &copy; SolucionesVillacreses 2014-09-24
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

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
    "isCheckout" => false,
    "requestID" => "",
    "type" => "button",
]);
?>
<?php //echo $this->render('_include'); ?>
<div class="col-lg-12">
    <?= $this->render('_frm_BuscarGrid', array('model' => $model, 'tipoDoc' => $tipoDoc,'tipoApr'=> $tipoApr)); ?>
</div>
<div class="col-lg-12">
    <?= $this->render('_indexGrid', array('model' => $model)); ?>
</div>
