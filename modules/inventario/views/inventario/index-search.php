<?php

use yii\jui\AutoComplete;
use yii\web\JsExpression;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;

?>
<div class="row">        
    <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
        <div class="form-group">
            <label for="txt_buscarData" class="col-sm-2 col-md-2 col-xs-2 col-lg-2 control-label"><?= Yii::t("formulario", "Search") ?></label>
            <div class="col-sm-8 col-md-8 col-xs-8 col-lg-8">
                <input type="text" class="form-control" value="" id="txt_buscarData" placeholder="<?= Yii::t("formulario", "Buscar por Nombre de Archivo") ?>">
            </div>                        
        </div>
    </div>    
    <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
        <div class="form-group">
            <label for="cmb_empresa" class="col-sm-2 col-sm-2 col-lg-2 col-md-2 col-xs-2 control-label"><?= Yii::t("formulario", "Modelo") ?></label>
            <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">
                <?= Html::dropDownList("cmb_empresa", 0, $arr_empresa, ["class" => "form-control PBvalidation", "id" => "cmb_empresa"]) ?>                                    
            </div>  
            <label for="cmb_tipo_bien" class="col-sm-2 col-sm-2 col-lg-2 col-md-2 col-xs-2 control-label"><?= Yii::t("formulario", "Categoría") ?></label>
            <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">
                <?= Html::dropDownList("cmb_tipo_bien", 0, $arr_tipo_bien, ["class" => "form-control PBvalidation", "id" => "cmb_tipo_bien"]) ?>                                    
            </div>                
        </div>
    </div>    
    <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
        <div class="col-sm-8 col-md-8 col-xs-8 col-lg-8 "></div>
        <div class="col-sm-2 col-md-2 col-xs-4 col-lg-2">                
            <a id="btn_buscarData" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Search") ?></a>
        </div>
    </div>
</div>

