<?php

use yii\helpers\Html;
use app\modules\academico\Module as academico;
$tipodoc = 'Cédula';
?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h3><span id="lbl_index"><?= 'Método Ingreso' ?></span></h3>
</div>
<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12 ">
    <div class="col-md-7 col-sm-7 col-xs-7 col-lg-7">
        <div class="form-group">
            <h4><span id="lbl_general"><?= Yii::t("formulario", "Data Contact") ?></span></h4> 
        </div>
    </div>

    <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_nombre1" class="col-sm-3 col-md-3 col-xs-3 col-lg-3 control-label" id="lbl_nombre1"><?= Yii::t("formulario", "Names") ?></label>
                <span for="txt_nombre1" class="col-sm-8 col-md-8 col-xs-8 col-lg-8  control-label" id="lbl_nombre1"><?= 'Juan Hugo'?> </span> 
            </div>
        </div> 
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_apellido1" class="col-sm-3 col-md-3 col-xs-3 col-lg-3 control-label" id="lbl_apellido1"><?= Yii::t("formulario", "Last Names") ?> </label>
                <span for="txt_apellido1" class="col-sm-8 col-md-8 col-xs-8 col-lg-8  control-label" id="lbl_apellido1"><?= 'Perez Perazo' ?> </span> 
            </div>
        </div> 
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="txt_cedula" class="col-sm-3 col-md-3 col-xs-3 col-lg-3 control-label"><?= $tipodoc ?></label> 
                <span for="txt_cedula" class="col-sm-8 col-md-8 col-xs-8 col-lg-8  control-label"><?= '0987563241' ?> </span> 
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="txt_celular" class="col-sm-3 col-md-3 col-xs-3 col-lg-3 control-label"><?= Yii::t("formulario", "CellPhone") ?></label> 
                <span for="txt_celular" class="col-sm-8 col-md-8 col-xs-8 col-lg-8  control-label"><?= '0987563211' ?> </span> 
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="txt_correo" class="col-sm-3 col-md-3 col-xs-3 col-lg-3 control-label"><?= Yii::t("formulario", "Email") ?></label> 
                <span for="txt_correo" class="col-sm-8 col-md-8 col-xs-8 col-lg-8  control-label"><?= 'p3p3per35@yopmail.com' ?> </span> 
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="txt_pais" class="col-sm-3 col-md-3 col-xs-3 col-lg-3 control-label"><?= Yii::t("formulario", "Country") ?></label> 
                <span for="txt_pais" class="col-sm-8 col-md-8 col-xs-8 col-lg-8  control-label"><?= 'Ecuador' ?> </span> 
            </div>
        </div>
    </div>
