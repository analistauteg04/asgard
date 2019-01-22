<?php


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use yii\helpers\Html;
use app\modules\marketing\Module as marketing;
?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="lbl_estado" class="col-sm-2 col-lg-2 col-md-2 col-xs-2 control-label"><?= Yii::t("formulario", "Estado") ?></label>
            <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3">
                <?= Html::dropDownList("cmb_estado", 0, $arr_estado, ["class" => "form-control pro_combo", "id" => "cmb_estado"]) ?>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
        <div class="col-sm-8"></div>
        <div class="col-sm-2 col-md-2 col-xs-2 col-lg-2">
            <a id="btn_buscarDataListaSuscrip" href="javascript:" onclick="mostrar_grid_lista_suscriptor()" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Search") ?></a>
        </div>
        
    </div>
    </div>
</div>

