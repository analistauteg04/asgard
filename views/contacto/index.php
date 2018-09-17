<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;
use kartik\date\DatePicker;
use yii\helpers\Url;

$this->title = 'Formulario de Contacto';
?>
<form class="form-horizontal">
    <div class="col-md-12">
        <h3><span id="lbl_Personeria"><?= Yii::t("formulario", "Formulario de Contacto") ?></span></h3>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="txt_nombres" class="col-sm-2 control-label"><?= Yii::t("formulario", "Names") ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control PBvalidation keyupmce" id="txt_nombres" data-type="alfa" data-keydown="true" placeholder="<?= Yii::t("formulario", "Names") ?>">
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="txt_ciudad" class="col-sm-2 control-label"><?= Yii::t("formulario", "City") ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control PBvalidation keyupmce" id="txt_ciudad" data-type="alfa" data-keydown="true" placeholder="<?= Yii::t("formulario", "City") ?>">
            </div>
        </div>
    </div>   
    <div class="col-md-12">
        <div class="form-group">
            <label for="txt_correo" class="col-sm-2 control-label"><?= Yii::t("formulario", "Email") ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control PBvalidation" id="txt_ftem_correo" data-type="email" data-keydown="true" placeholder="<?= Yii::t("formulario", "Email") ?>">
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="txt_telefono" class="col-sm-2 control-label"><?= Yii::t("formulario", "Phone or CellPhone") ?></label>

            <div class="col-sm-10">
                <input type="text" class="form-control PBvalidation" id="txt_telefono" data-type="alfanumerico" data-keydown="true" placeholder="<?= Yii::t("formulario", "Phone or CellPhone") ?>">
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="txt_mensaje" class="col-sm-2 control-label"><?= Yii::t("formulario", "Message") ?></label>

            <div class="col-sm-10">
                <textarea class="form-control" rows="5" id="comment"></textarea>
            </div>
        </div>
    </div>

    <div class="row"> 
        <div class="col-md-10"></div>        
        <div class="col-md-2">
            <a id="paso1next" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("accion", "Save") ?> </a>
        </div>
    </div>
</form>