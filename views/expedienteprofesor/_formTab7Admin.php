<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
?>

<?= Html::hiddenInput('txth_perid', $per_id, ['id' => 'txth_perid']); ?>
<form class="form-horizontal" enctype="multipart/form-data" >
<div class='row'>
<div class="panel-group" id="accordion3" role="tablist" aria-multiselectable="true">
    <div class="panel">            
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion3" href="#collapseV1"><b><?= Yii::t("formulario", "Validation") ?></b><br/><?= Yii::t("formulario", "File validation") ?></a>
            </h4>
        </div>
        <!--<div id="collapseV1" class="collapse" role="tabpanel">-->
        <div class="col-md-12">
            <?php if ($estado == 23) { ?>
            <div class="col-md-12">                               
                <div class="form-group">
                    <label for="txt_observacion_ant" class="col-sm-5 control-label keyupmce"><?= Yii::t("formulario", "Last Observations") ?></label>
                    <div class="col-sm-7">
                        <textarea  rows="6" cols="100" class="form-control PBvalidation keyupmce" data-required="false" id="txt_observacion_ant" disabled="true"><?= $observacion ?></textarea>                        
                    </div>
                </div>                                                          
            </div>    
            <?php } ?>
            <div class="col-md-12">                               
                <div class="form-group">
                    <label for="cmb_tip_validacion" class="col-sm-5 control-label keyupmce"><?= Yii::t("formulario", "Result") ?></label>
                    <div class="col-sm-5">
                        <?= Html::dropDownList("cmb_tip_validacion", 0, $tipo_validacion, ["class" => "form-control", "id" => "cmb_tip_validacion"]) ?>
                    </div>
                </div>                                                          
            </div>                        
            <div id= "divObservacion" class="col-md-12" style="display: none;">                               
                <div class="form-group">
                    <label for="txt_observacion" class="col-sm-5 control-label keyupmce"><?= Yii::t("formulario", "Observations") ?></label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control PBvalidation keyupmce" id="txt_observacion" data-type="alfanumerico" data-keydown="true" placeholder="<?= Yii::t("formulario", "Observations") ?>">
                    </div>
                </div>                                                          
            </div>        
        </div>
    </div>       
</div> 
<div class='col-md-12'>
    </br></br>
</div>
<div class="col-md-12"> 
    <div class="col-md-2">
        <a id="paso7backView" href="javascript:" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-menu-left"></span><?= Yii::t("formulario", "Back") ?></a>
    </div>
    <div class="col-md-8">&nbsp;</div>
    <div class="col-md-2">
        <a id="btn_save_validacion" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Save") ?> <span class="glyphicon glyphicon-floppy-disk"></span>
        </a>
    </div>
</div> 
</div> 
</form>
    