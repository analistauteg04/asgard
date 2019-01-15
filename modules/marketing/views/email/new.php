<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\marketing\Module;
use app\modules\admision\Module as admision;
admision::registerTranslations();

?>

<form class="form-horizontal" enctype="multipart/form-data" id="formnewlista">
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <h3><span id="lbl_solicitud"><?= Module::t("marketing", "New List") ?></span></h3>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="cmb_empresa" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label"><?= Yii::t("formulario", "Company") ?> <span class="text-danger">*</span> </label>
                <div class="col-sm-8 col-md-8 col-xs-8 col-lg-8">
                    <?= Html::dropDownList("cmb_empresa", 0, $arr_empresa, ["class" => "form-control can_combo", "id" => "cmb_empresa"]) ?>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="txt_carrera_programa" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label"><?= admision::t("crm", "Career/Program/Course") ?> <span class="text-danger">*</span> </label> 
                <div class="col-sm-8 col-md-8 col-xs-8 col-lg-8">
                    <?= Html::dropDownList("cmb_carrera_programa", 0, $arr_carrera, ["class" => "form-control can_combo", "id" => "cmb_carrera_programa"]) ?>
                </div>
            </div>
        </div> 
    </div>
    
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_nombre_lista" class="col-sm-4 control-label" id="lbl_nombre_lista"><?= Yii::t("formulario", "Name") ?><span class="text-danger">*</span></label> 
                <div class="col-sm-8 ">
                    <input type="text" class="form-control PBvalidation keyupmce" value="" id="txt_nombre_lista" data-type="alfa" placeholder="<?= Yii::t("formulario", "Name") ?>">                 
                </div>
            </div>
        </div>   
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_nombre_empresa" class="col-sm-4 control-label" id="lbl_nombre_empresa"><?= Yii::t("formulario", "Company Name") ?><span class="text-danger">*</span></label> 
                <div class="col-sm-8 ">
                    <input type="text" class="form-control PBvalidation keyupmce" value="" id="txt_nombre_empresa" data-type="alfa" placeholder="<?= Yii::t("formulario", "Company Name") ?>">                 
                </div>
            </div>
        </div> 
    </div> 
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_nombre_contacto" class="col-sm-4 control-label" id="lbl_nombre_contacto"><?= Module::t("marketing", "Name Contact") ?><span class="text-danger">*</span></label> 
                <div class="col-sm-8 ">
                    <input type="text" class="form-control PBvalidation keyupmce" value="" id="txt_nombre_contacto" data-type="alfa" placeholder="<?= Module::t("marketing", "Name Contact") ?>">                 
                </div>
            </div>
        </div> 
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_correo_contacto" class="col-sm-4 control-label" id="lbl_correo_contacto"><?= Module::t("marketing", "Contact Email") ?><span class="text-danger">*</span></label> 
                <div class="col-sm-8 ">
                    <input type="text" class="form-control PBvalidation keyupmce" value="" id="txt_correo_contacto" data-type="email" placeholder="<?= Module::t("marketing", "Contact Email") ?>">                 
                </div>
            </div>
        </div>           
    </div>        
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_asunto" class="col-sm-4 control-label" id="lbl_asunto"><?= Module::t("marketing", "Subject") ?><span class="text-danger">*</span></label> 
                <div class="col-sm-8 ">
                    <input type="text" class="form-control PBvalidation keyupmce" value="" id="txt_asunto" data-type="alfa" placeholder="<?= Module::t("marketing", "Subject") ?>">                 
                </div>
            </div>
        </div>         
    </div>  
    
    <div class="row"> 
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9"></div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            <a id="sendNewList" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Send") ?> </a>
        </div>
    </div>
</form>
