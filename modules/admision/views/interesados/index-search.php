<?php

use yii\helpers\Html;
use kartik\date\DatePicker;
?>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">  
        <div class="form-group">
            <label for="txt_buscarData" class="col-sm-2 col-md-2 col-xs-2 col-lg-2 control-label"><?= Yii::t("formulario", "Search") ?></label>
            <div class="col-sm-8 col-md-8 col-xs-8 col-lg-8">
                <input type="text" class="form-control" value="" id="txt_buscarData" placeholder="<?= Yii::t("solicitud_ins", "Search by Dni or Names") ?>">
            </div>
        </div>
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>                   
        <div class="form-group">
            <label for="cmb_empresa" class="col-sm-2 col-lg-2 col-md-2 col-xs-2 control-label"><?= Yii::t("formulario", "Company") ?>  </label>
            <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3"> 
                <?= Html::dropDownList("cmb_empresa", 0, array_merge([Yii::t("formulario", "Select")],$arr_empresa), ["class" => "form-control", "id" => "cmb_empresa"]) ?> 
            </div>
        </div>              
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">  
        <div class="col-sm-8"></div>
        <div class="col-sm-2">                
            <a id="btn_buscarInteresado" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Search") ?></a>
        </div>
    </div>
</div></br>

