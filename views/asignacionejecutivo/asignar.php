<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="col-md-12">    
    <h3><span id="lbl_titulo"><?= Yii::t("formulario", "Executive Assignment") ?></span>
</div>
<?= Html::hiddenInput('txth_ids', $int_id, ['id' => 'txth_ids']); ?>
<?= Html::hiddenInput('txth_pids', $pint_id, ['id' => 'txth_pids']); ?>
<?= Html::hiddenInput('txth_asp', $asp_id, ['id' => 'txth_asp']); ?>

<form class="form-horizontal" enctype="multipart/form-data" >
    <div class="col-md-12">
        <div class="form-group">
            <label for="txt_interesado" class="col-sm-4 control-label" id="lbl_interesado"><?= Yii::t("formulario", "Complete Names") ?></label>
            <div class="col-sm-8">
                <input type="text" value="<?= $nombrescompletos ?>" class="form-control" id="txt_interesado" disabled="true" placeholder="<?= Yii::t("formulario", "Complete Names")?>">
            </div>
        </div>
    </div> 
    <div class="col-md-12">
        <div class="form-group">
            <label for="cmb_nivel" class="col-sm-4 control-label keyupmce"><?= Yii::t("formulario", "Academic unit") ?></label>
            <div class="col-sm-8">                
                  <?= Html::dropDownList("cmb_nivel", 0, $arr_nivel, ["class" => "form-control PBvalidation", "id" => "cmb_nivel"]) ?>               
            </div>
        </div>
    </div>    
    <div class="col-md-12">
        <div class="form-group">
            <label for="cmb_modalidad" class="col-sm-4 control-label keyupmce"><?= Yii::t("formulario", "Mode") ?></label>
            <div class="col-sm-8">                
                  <?= Html::dropDownList("cmb_modalidad", 0, $arr_modalidad, ["class" => "form-control PBvalidation", "id" => "cmb_modalidad"]) ?>               
            </div>
        </div>
    </div>    
    <div class="col-md-12">
        <div class="form-group">
            <label for="cmb_ejecutivo" class="col-sm-4 control-label keyupmce"><?= Yii::t("formulario", "New Executive") ?></label>
            <div class="col-sm-8">                
                    <?= Html::dropDownList("cmb_ejecutivo", 0, $arr_ejecutivos, ["class" => "form-control PBvalidation", "id" => "cmb_ejecutivo"]) ?>               
            </div>
        </div>
    </div>    
    <div class="col-md-12"> 
        <div class="form-group">
            <div class="col-sm-4">                                                  
            </div>  
            <div class="col-sm-4">                                  
                <a id="btn_asignarEjecutivo"  class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Send") ?></a>                                   
            </div> 
            <div class="col-sm-4">                                                  
            </div>  
        </div>    
    </div>  
</form>

