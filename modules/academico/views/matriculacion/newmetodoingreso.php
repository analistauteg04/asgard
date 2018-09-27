<?php

use yii\helpers\Html;
use app\modules\academico\Module as academico;
$tipodoc = 'Cédula';
?>
<?= Html::hiddenInput('txth_sins_id', base64_encode($personalData["sins_id"]), ['id' => 'txth_sins_id']); ?>
<?= Html::hiddenInput('txth_adm_id', $_GET['adm'], ['id' => 'txth_adm_id']); ?>
<form class="form-horizontal">
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
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="txt_solicitud" class="col-sm-3 col-md-3 col-xs-3 col-lg-3 control-label"><?= Yii::t("formulario", "Solicitud") ?></label> 
                <span for="txt_solicitud" class="col-sm-8 col-md-8 col-xs-8 col-lg-8  control-label"><?= $personalData["num_solicitud"] ?> </span> 
            </div>
        </div>
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_nombre1" class="col-sm-3 col-md-3 col-xs-3 col-lg-3 control-label" id="lbl_nombre1"><?= Yii::t("formulario", "Names") ?></label>
                <span for="txt_nombre1" class="col-sm-8 col-md-8 col-xs-8 col-lg-8  control-label" id="lbl_nombre1"><?= $personalData["per_nombres"] ?> </span> 
            </div>
        </div> 
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_apellido1" class="col-sm-3 col-md-3 col-xs-3 col-lg-3 control-label" id="lbl_apellido1"><?= Yii::t("formulario", "Last Names") ?> </label>
                <span for="txt_apellido1" class="col-sm-8 col-md-8 col-xs-8 col-lg-8  control-label" id="lbl_apellido1"><?= $personalData["per_apellidos"] ?> </span> 
            </div>
        </div> 
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="txt_cedula" class="col-sm-3 col-md-3 col-xs-3 col-lg-3 control-label"><?= $tipodoc ?></label> 
                <span for="txt_cedula" class="col-sm-8 col-md-8 col-xs-8 col-lg-8  control-label"><?= $personalData["per_dni"] ?> </span> 
            </div>
        </div>        
    </div>    
    <div class="col-md-7 col-sm-7 col-xs-7 col-lg-7">
        <div class="form-group">
            <br/><h4><span id="lbl_general1"><?= Yii::t("formulario", "Datos Método Ingreso") ?></span></h4> 
        </div>
    </div>
    
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <div class="form-group">
            <label for="txt_periodo" class="col-sm-4 control-label" id="lbl_periodo"><?= Yii::t("academico", "Lecturing Period") ?></label>
            <div class="col-sm-8">
                <?= Html::dropDownList("cmb_periodo", null, $arr_periodo, ["class" => "form-control", "id" => "cmb_periodo"]) ?>
            </div>
        </div>
    </div>   
    
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <div class="form-group">
            <label for="txt_paralelo" class="col-sm-4 control-label" id="lbl_periodo"><?= Yii::t("academico", "Parallel") ?></label>
            <div class="col-sm-8">
                <?= Html::dropDownList("cmb_paralelo", null, $arr_paralelo, ["class" => "form-control", "id" => "cmb_paralelo"]) ?>
            </div>
        </div>
    </div>
   
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12"> 
        <div class="form-group">
            <div class="col-sm-8">                                                  
            </div>  
            <div class="col-sm-4">                      
                <a id="btn_grabar_asignacion" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Send") ?></a>                                   
            </div> 
            
        </div>    
    </div>  
    
</div>
</form>