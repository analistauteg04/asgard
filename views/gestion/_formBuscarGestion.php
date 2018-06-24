<?php

use yii\jui\AutoComplete;
use yii\web\JsExpression;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;

array_unshift($arr_estgestion, "Todas");

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?><div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <div class="col-md-12">
            <div class="form-group">
                <label for="txt_buscarDataAgente" class="col-sm-2 col-md-2 col-xs-2 col-lg-2 control-label"><?= Yii::t("formulario", "Executive") ?></label>
                <div class="col-sm-9 col-md-9 col-xs-9 col-lg-9">
                    <input type="text" class="form-control" value="" id="txt_buscarDataAgente" placeholder="<?= Yii::t("formulario", "Search by Agent Names") ?>">
                </div>
            </div>
        </div> 
    </div>  
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <div class="col-md-12">
            <div class="form-group">
                <label for="txt_buscarDataPersona" class="col-sm-2 col-md-2 col-xs-2 col-lg-2 control-label"><?= Yii::t("formulario", "Interested") ?></label>
                <div class="col-sm-9 col-md-9 col-xs-9 col-lg-9">
                    <input type="text" class="form-control" value="" id="txt_buscarDataPersona" placeholder="<?= Yii::t("formulario", "Search by Interested Names") ?>">
                </div>
            </div>
        </div> 
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>           
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_fecha_atencion" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "Attention Date") ?></label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7 ">
                    <?=
                    DatePicker::widget([
                        'name' => 'txt_fecha_atencion',
                        'value' => '',
                        'type' => DatePicker::TYPE_INPUT,
                        'options' => ["class" => "form-control PBvalidation keyupmce", "id" => "txt_fecha_atencion", "data-type" => "fecha", "data-keydown" => "true", "placeholder" => Yii::t("formulario", "Attention Date")],
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => Yii::$app->params["dateByDatePicker"],
                        ]]
                    );
                    ?>
                </div>
            </div>                    
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="cmb_estado" class="col-sm-4 control-label"><?= Yii::t("formulario", "Status") ?>  </label>
                <div class="col-sm-6 col-md-6 col-xs-6 col-lg-6">
                    <?= Html::dropDownList("cmb_estado", 0, $arr_estgestion, ["class" => "form-control", "id" => "cmb_estado"]) ?>
                </div>
            </div>
        </div>  
    </div>     
    <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>
        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
            <div class="col-sm-8 col-md-8 col-xs-8 col-lg-8"></div>
            <div class="col-sm-2 col-md-2 col-xs-4 col-lg-2">                
                <a id="btn_buscarGestion" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Search") ?></a>
            </div>
        </div>
    </div></div></br>
