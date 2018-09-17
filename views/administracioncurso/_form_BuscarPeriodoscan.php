<?php
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <div class="form-group">
            <label for="txt_buscarDatapc" class="col-sm-2 col-md-2 col-xs-2 col-lg-2 control-label"><?= Yii::t("formulario", "Search") ?></label>
            <div class="col-sm-8 col-md-8 col-xs-8 col-lg-8 ">
                <input type="text" class="form-control" value="" id="txt_buscarDatapc" placeholder="<?= Yii::t("formulario", "Search by Code or year")?>">
            </div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <div class="form-group">
            <label for="lbl_inicio" class="col-sm-2 col-md-2 col-xs-2 col-lg-2 control-label"><?= Yii::t("academico", "Date from") ?></label>
            <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3 ">
                <?=
                DatePicker::widget([
                    'name' => 'txt_fecha_inipc',
                    'value' => '',
                    'type' => DatePicker::TYPE_INPUT,
                    'options' => ["class" => "form-control", "id" => "txt_fecha_inipc", "placeholder" => Yii::t("academico", "Date from")],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => Yii::$app->params["dateByDatePicker"],
                    ]]
                );
                ?>
            </div>
            <label for="lbl_fin" class="col-sm-2 col-md-2 col-xs-2 col-lg-2 control-label"><?= Yii::t("academico", "Date until") ?></label>
            <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3 ">
                <?=
                DatePicker::widget([
                    'name' => 'txt_fecha_finpc',
                    'value' => '',
                    'type' => DatePicker::TYPE_INPUT,
                    'options' => ["class" => "form-control", "id" => "txt_fecha_finpc", "placeholder" => Yii::t("academico", "Date until")],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => Yii::$app->params["dateByDatePicker"],
                    ]]
                );
                ?>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <div class="form-group">
            <label for="cmb_mes" class="col-sm-2 col-md-2 col-xs-2 col-lg-2 control-label"><?= Yii::t("academico", "Month") ?></label>
            <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3">
                <?= Html::dropDownList("cmb_mes", 0, [" " => "Todos", "1" => "Enero", "2" => "Febrero", "3" => "Marzo", "4" => "Abril", "5" => "Mayo", "6" => "Junio", "7" => "Julio", "8" => "Agosto", "9" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre"], ["class" => "form-control", "id" => "cmb_mes"]) ?></div>      
        </div>
    </div> 
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <div class="col-sm-8"></div>
        <div class="col-sm-2 col-md-2 col-xs-4 col-lg-2">                
            <a id="btn_buscarDataPeriodo" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Search") ?></a>
        </div>
    </div>
</div>

