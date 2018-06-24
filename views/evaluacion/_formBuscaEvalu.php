<?php

use yii\jui\AutoComplete;
use yii\web\JsExpression;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;

array_unshift($profesor, "Todas");
array_unshift($periodo, "Todas");
array_unshift($arr_ninteres, "Todas");
array_unshift($arr_facultad, "Todas");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?><div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <div class="col-md-12">
            <div class="form-group">
                <label for="txt_buscarDataProfesor" class="col-sm-2 col-md-2 col-xs-2 col-lg-2 control-label"><?= Yii::t("formulario", "Search") ?></label>
                <div class="col-sm-9 col-md-9 col-xs-9 col-lg-9">
                    <input type="text" class="form-control" value="" id="txt_buscarDataProfesor" placeholder="<?= Yii::t("formulario", "Search by Teacher Names") ?>">
                </div>
            </div>
        </div> 
    </div>  
    <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>           
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="cmb_nintereslist" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label"><?= Yii::t("formulario", "Academic unit") ?></label>
                <div class="col-sm-6 col-md-6 col-xs-6 col-lg-6">
                    <?= Html::dropDownList("cmb_nintereslist", 0, $arr_ninteres, ["class" => "form-control", "id" => "cmb_nintereslist"]) ?>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="cmb_facultadlist" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label"><?= Yii::t("formulario", "Mode") ?></label>
                <div class="col-sm-6 col-md-6 col-xs-6 col-lg-6">
                    <?= Html::dropDownList("cmb_facultadlist", 0, $arr_facultad, ["class" => "form-control", "id" => "cmb_facultadlist"]) ?>
                </div>
            </div>
        </div> 
    </div> 
    <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>
        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
            <div class="col-sm-8 col-md-8 col-xs-8 col-lg-8"></div>
            <div class="col-sm-2 col-md-2 col-xs-4 col-lg-2">                
                <a id="btn_buscarDataEvaluacion" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Search") ?></a>
            </div>
        </div>
    </div></div></br>
