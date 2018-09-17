<?php

use yii\helpers\Html;
?>
<?= Html::hiddenInput('txth_sins_id', $sins_id, ['id' => 'txth_sins_id']); ?>
<?= Html::hiddenInput('txth_per_id', $per_id, ['id' => 'txth_per_id']); ?>

<form class="form-horizontal" enctype="multipart/form-data" id="formsolicitud">
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <h3><span id="lbl_solicitud"><?= Yii::t("solicitud_ins", "Cancel Request") ?></span></h3>
    </div>            
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <div class="form-group">
            <label for="txt_solicitud" class="col-sm-4 control-label" id="lbl_nombres"><?= Yii::t("formulario", "Request #") ?></label> 
            <div class="col-sm-8 ">
                <input type="text" class="form-control" value="<?= $sins_id?>" id="txt_solicitud" disabled="true">                
            </div>
        </div>
    </div>       
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <div class="form-group">
            <label for="txt_cliente" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label" id="lbl_nombres"><?= Yii::t("formulario", "Interested") ?></label> 
            <div class="col-sm-8 ">
                <input type="text" class="form-control" value="<?= $cliente?>" id="txt_cliente" disabled="true">                                
            </div>
        </div>
    </div>           
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <div class="form-group">
            <label for="txt_carrera" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label" id="lbl_nombres"><?= Yii::t("academico", "Career") ?></label> 
            <div class="col-sm-8 ">
                <input type="text" class="form-control" value="<?= $carrera?>" id="txt_carrera" disabled="true">                 
            </div>
        </div>
    </div>                   
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <label for="txt_observacion" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label keyupmce"><?= Yii::t("formulario", "Observation") ?></label>
        <div class="col-sm-8 col-md-8 col-xs-8 col-lg-8  ">
            <input type="text" class="form-control" value="" id="txt_observacion" placeholder="<?= Yii::t("formulario", "Observation")?>">         
            <br>
        </div>
    </div>    
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12"> 
        <div class="form-group">
            <label for="" class="col-sm-5  control-label keyupmce"></label>
            <div class="col-md-2 col-sm-2 col-xs-4 col-lg-2">                    
                <a id="btnAnular" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Send") ?></a>               
            </div>   
            <label for="" class="col-sm-5  control-label keyupmce"></label>
        </div>    
    </div>         
</form>
