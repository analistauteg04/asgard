<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>
<?= Html::hiddenInput('txth_ids', $opag_id, ['id' => 'txth_ids']); ?>
<?= Html::hiddenInput('txth_idd', $idd, ['id' => 'txth_idd']); ?>
<?= Html::hiddenInput('txth_int', $int_id, ['id' => 'txth_int']); ?>
<?= Html::hiddenInput('txth_sins', $sins_id, ['id' => 'txth_sins']); ?>
<?= Html::hiddenInput('txth_perid', $per_id, ['id' => 'txth_perid']); ?>
<form class="form-horizontal" enctype="multipart/form-data" >
    <div class="col-md-10">
        <div class="form-group">
            <h3><span id="lbl_Personeria"><?= Yii::t("formulario", "Invoice data") ?></span></h3>                 
        </div>
    </div>
    
    <div class="col-md-12">
        <div class="form-group">
            <label for="txt_tipo_dni" class="col-sm-4 control-label" id="lbl_tipo_dni"><?= Yii::t("formulario", "Type DNI") ?></label>
            <div class="col-sm-8">
                <?= Html::dropDownList("cmb_tipo_dni", 0, $tipo_dni, ["class" => "form-control PBvalidation", "id" => "cmb_tipo_dni"]) ?>
            </div>
        </div>
    </div>  

    <div class="col-md-12">
        <div class="form-group">
            <label for="txt_dni" class="col-sm-4 control-label" id="lbl_dni"><?= Yii::t("formulario", "DNI") ?></label>
            <div class="col-sm-8">
               <input type="text" class="form-control PBvalidation keyupmce" id="txt_dni" data-type="cedula" data-keydown="true" placeholder="<?= Yii::t("formulario", "DNI") ?>">
            </div>
        </div>
    </div>  

    <div class="col-md-12">
        <div class="form-group">
            <label for="txt_nombres" class="col-sm-4 control-label" id="lbl_nombres"><?= Yii::t("formulario", "First Names") ?></label>
            <div class="col-sm-8">
                <input type="text" class="form-control PBvalidation keyupmce" id="txt_nombres" data-type="alfa" data-keydown="true" placeholder="<?= Yii::t("formulario", "First Names") ?>">                
            </div>
        </div>
    </div>   

    <div class="col-md-12">
        <div class="form-group">
            <label for="txt_apellidos" class="col-sm-4 control-label" id="lbl_apellidos"><?= Yii::t("formulario", "Last Names") ?></label>
            <div class="col-sm-8">
               <input type="text" class="form-control PBvalidation keyupmce" id="txt_apellidos" data-type="alfa" data-keydown="true" placeholder="<?= Yii::t("formulario", "Last Names") ?>">                  
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="txt_direccion" class="col-sm-4 control-label" id="lbl_direccion"><?= Yii::t("formulario", "Address") ?></label>
            <div class="col-sm-8">
                <input type="text" class="form-control PBvalidation keyupmce" id="txt_direccion" data-type="alfanumerico" data-keydown="true" placeholder="<?= Yii::t("formulario", "Address") ?>">                  
            </div>
        </div>
    </div> 
    <div class="col-md-12">
        <div class="form-group">
            <label for="txt_correo" class="col-sm-4 control-label" id="lbl_correo"><?= Yii::t("formulario", "Email") ?></label>
            <div class="col-sm-8">
                <input type="text" class="form-control PBvalidation keyupmce" id="txt_correo" data-type="email" data-keydown="true" placeholder="<?= Yii::t("formulario", "Email") ?>">                                  
            </div>
        </div>
    </div> 
    <div class="col-md-12">
        <div class="form-group">
            <label for="txt_telefono" class="col-sm-4 control-label" id="lbl_telefono"><?= Yii::t("formulario", "Phone") ?></label>
            <div class="col-sm-8">
                <input type="text" class="form-control PBvalidation keyupmce" id="txt_telefono" data-type="telefono_sin" data-keydown="true" placeholder="<?= Yii::t("formulario", "Phone") ?>">                                                  
            </div>
        </div>
    </div> 
    
    <div class="col-md-12"> 
        <div class="form-group">
            <div class="col-sm-4">                                  
            </div> 
            <div class="col-sm-4">     
                <a id="btn_enviar"  class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Send") ?></a>                    
            </div>                  
            <div class="col-sm-4">                                  
            </div> 
        </div>    
    </div>  

</form>