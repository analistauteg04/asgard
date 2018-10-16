<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="txt_buscarDataPersona" class="col-sm-2 col-lg-2 col-md-2 col-xs-2 control-label"><?= Yii::t("formulario", "Search") ?></label>
            <div class="col-sm-8 col-xs-8 col-md-8 col-lg-8">
                <input type="text" class="form-control" value="" id="txt_buscarDataPersona" placeholder="<?= Yii::t("formulario", "Search by Names") ?>">
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="lbl_inicio" class="col-sm-2 col-md-2 col-xs-2 col-lg-2 control-label"><?= Yii::t("formulario", "Start date") ?></label>
            <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3">
                <?=
                DatePicker::widget([
                    'name' => 'txt_fecha_ini',
                    'value' => '',
                    'type' => DatePicker::TYPE_INPUT,
                    'options' => ["class" => "form-control", "id" => "txt_fecha_ini", "placeholder" => Yii::t("formulario", "Start date")],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => Yii::$app->params["dateByDatePicker"],
                    ]]
                );
                ?>
            </div>
            <label for="lbl_fin" class="col-sm-2 col-md-2 col-xs-2 col-lg-2 control-label"><?= Yii::t("formulario", "End date") ?></label>
            <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3">
                <?=
                DatePicker::widget([
                    'name' => 'txt_fecha_fin',
                    'value' => '',
                    'type' => DatePicker::TYPE_INPUT,
                    'options' => ["class" => "form-control", "id" => "txt_fecha_fin", "placeholder" => Yii::t("formulario", "End date")],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => Yii::$app->params["dateByDatePicker"],
                    ]]
                );
                ?>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="lbl_medio" class="col-sm-2 col-lg-2 col-md-2 col-xs-2 control-label"><?= Yii::t("formulario", "Channel") ?></label>
            <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3">
                <?= Html::dropDownList("cmb_medio", 0, $arr_canalconta, ["class" => "form-control pro_combo", "id" => "cmb_medio"]) ?>
            </div>
            <!--<label for="lbl_usurin" class="col-sm-2 col-md-2 col-xs-2 col-lg-2 control-label"><?= Yii::t("formulario", "User login") ?></label>
            <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3">
                <? Html::dropDownList("cmb_medio", 0, $arr_canalconta, ["class" => "form-control pro_combo", "id" => "cmb_medio"]) ?>
            </div>-->
        </div>
    </div>
    <!--<div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>                   
            <div class="form-group">
                <label for="cmb_estadocontacto" class="col-sm-2 col-lg-2 col-md-2 col-xs-2 control-label"><? Yii::t("formulario", "Status") ?>  </label>
                <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3"> 
                    <? Html::dropDownList("cmb_estadocontacto", 0, $arr_contacto, ["class" => "form-control", "id" => "cmb_estadocontacto"]) ?> 
                </div>
            </div>
              
    </div>-->
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">  
        <div class="col-sm-8"></div>
        <div class="col-sm-2">                
            <a id="btn_buscarContacto" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Search") ?></a>
        </div>
    </div>
</div></br>
