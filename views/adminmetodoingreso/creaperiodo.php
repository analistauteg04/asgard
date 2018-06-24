<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\date\DatePicker;

?>

<div class="col-md-12">    
    <h3><span id="lbl_titulo"><?= Yii::t("academico", "Create CAN Period online") ?></span><br/>    
</div>

<form class="form-horizontal" enctype="multipart/form-data" >
    <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_anio" class="col-sm-4 control-label" id="lbl_periodo"><?= Yii::t("academico", "Year") ?></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" value="" id="txt_anio" data-type="graduacion" placeholder="<?= Yii::t("academico", "Year") ?>">
                </div>
            </div>
        </div>  
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_mes" class="col-sm-4 control-label" id="lbl_periodo"><?= Yii::t("academico", "Month") ?></label>
                <div class="col-sm-8">
                    <?= Html::dropDownList("cmb_mes", 1, $mes, ["class" => "form-control", "id" => "cmb_mes"]) ?>
                </div>
            </div>
        </div>  
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_nivel_interes" class="col-sm-4 control-label" id="lbl_periodo"><?= Yii::t("solicitud_ins", "Level Interest") ?></label>
                <div class="col-sm-8">
                    <?= Html::dropDownList("cmb_nivel_interes", 1, $arr_ninteres, ["class" => "form-control", "id" => "cmb_nivel_interes", 'disabled' => "true"]) ?>
                </div>
            </div>
        </div>  
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_metodo_ingreso" class="col-sm-4 control-label" id="lbl_periodo"><?= Yii::t("solicitud_ins", "Income Method") ?></label>
                <div class="col-sm-8">
                    <?= Html::dropDownList("cmb_metodo_ingreso", 1, $arr_metodos, ["class" => "form-control", "id" => "cmb_metodo_ingreso"]) ?>
                </div>
            </div>
        </div>  
    </div> 
    <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_fecha_desde" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("academico", "Date from") ?></label>
                <div class="col-sm-8 col-md-8 col-xs-8 col-lg-8 ">
                    <?=
                    DatePicker::widget([
                        'name' => 'txt_fecha_desde',
                        'value' => '',
                        'disabled' => $habilita,
                        'type' => DatePicker::TYPE_INPUT,
                        'options' => ["class" => "form-control PBvalidation keyupmce", "id" => "txt_fecha_desde", "data-type" => "fecha", "data-keydown" => "true", "placeholder" => Yii::t("academico", "Date from")],
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => Yii::$app->params["dateByDatePicker"],
                        ]]
                    );
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_fecha_hasta" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("academico", "Date until") ?></label>
                <div class="col-sm-8 col-md-8 col-xs-8 col-lg-8 ">
                    <?=
                    DatePicker::widget([
                        'name' => 'txt_fecha_hasta',
                        'value' => '',
                        'disabled' => $habilita,
                        'type' => DatePicker::TYPE_INPUT,
                        'options' => ["class" => "form-control PBvalidation keyupmce", "id" => "txt_fecha_hasta", "data-type" => "fecha", "data-keydown" => "true", "placeholder" => Yii::t("academico", "Date until")],
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => Yii::$app->params["dateByDatePicker"],
                        ]]
                    );
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_descripcion" class="col-sm-4 control-label" id="lbl_descripcion"><?= Yii::t("formulario", "Description") ?></label>
                <div class="col-sm-8">
                    <textarea  class="form-control PBvalidation keyupmce" id="txt_descripcion"></textarea>
                </div>
            </div>
        </div> 
    </div>    
    <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6"> 
            <div class="form-group">
                <div class="col-sm-4">                                                  
                </div>  
                <div class="col-sm-4">                      
                    <a id="btn_grabar_periodo" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Send") ?></a>                                   
                </div> 
                <div class="col-sm-4">      
                    <br/>
                </div>  
            </div>    
        </div>  
    </div>     
</form>