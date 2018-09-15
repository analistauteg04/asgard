<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\date\DatePicker;
use app\widgets\PbGridView\PbGridView;
use yii\data\ArrayDataProvider;

$pmin_id = $_GET["pmin_id"];
?>

<?= Html::hiddenInput('txth_pmin_id', $pmin_id, ['id' => 'txth_pmin_id']); ?>
<div class="col-md-12">    
    <h3><span id="lbl_titulo"><?= Yii::t("academico", "Update Period") ?></span><br/>    
</div>

<form class="form-horizontal" enctype="multipart/form-data" >
    <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_anio" class="col-sm-4 control-label" id="lbl_periodo"><?= Yii::t("academico", "Year") ?></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control PBvalidation keyupmce" value="<?= $mod_periodo["pmin_anio"] ?>" id="txt_anio" data-type="graduacion" placeholder="<?= Yii::t("academico", "Year") ?>">
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_mes" class="col-sm-4 control-label" id="lbl_periodo"><?= Yii::t("academico", "Month") ?></label>
                <div class="col-sm-8">
                    <?= Html::dropDownList("cmb_mes", $mod_periodo["pmin_mes"], $mes, ["class" => "form-control", "id" => "cmb_mes"]) ?>
                </div>
            </div>
        </div>  
    </div> 
    <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_nivel_interes" class="col-sm-4 control-label" id="lbl_periodo"><?= Yii::t("formulario", "Academic unit") ?></label>
                <div class="col-sm-8">
                    <?= Html::dropDownList("cmb_nivel_interes", $mod_periodo["uaca_id"], $arr_ninteres, ["class" => "form-control", "id" => "cmb_nivel_interes"]) ?>
                </div>
            </div>
        </div>  
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">            
                <label for="cmb_modalidad" class="col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label"><?= Yii::t("formulario", "Mode") ?></label>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <?= Html::dropDownList("cmb_modalidad", $mod_periodo["mod_id"], $arr_modalidad, ["class" => "form-control", "id" => "cmb_modalidad"]) ?>
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
                        'value' => $mod_periodo["fecha_desde"],
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
                        'value' => $mod_periodo["fecha_hasta"],
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
                    <textarea  class="form-control PBvalidation keyupmce" id="txt_descripcion"><?= $mod_periodo["pmin_descripcion"] ?></textarea>
                </div>
            </div>
        </div>  
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_metodo_ingreso" class="col-sm-4 control-label" id="lbl_periodo"><?= Yii::t("solicitud_ins", "Income Method") ?></label>
                <div class="col-sm-8">
                    <?= Html::dropDownList("cmb_metodo_ingreso", $mod_periodo["ming_id"], $arr_metodos, ["class" => "form-control", "id" => "cmb_metodo_ingreso"]) ?>
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
                    <a id="btn_modificar_periodo" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Update") ?></a>                                   
                </div> 
                <div class="col-sm-4">      
                    <br/>
                </div>  
            </div>    
        </div> 
    </div> 
</form>