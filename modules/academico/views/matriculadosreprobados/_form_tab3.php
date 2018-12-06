<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;
use kartik\date\DatePicker;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\components\CFileInputAjax;
use app\modules\financiero\Module as financiero;
?>

<form class="form-horizontal">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h3><span id="lbl_Personeria"><?= Yii::t("formulario", "Request Data") ?></span></h3>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <p class="text-danger"> <?= Yii::t("formulario", "Fields with * are required") ?> </p>        
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">            
            <label for="txt_fecha_solicitud" class="col-sm-5 col-md-5 col-xs-5 col-lg-5  control-label"><?= Yii::t("formulario", "Fecha Solicitud") ?></label>
                <div class="col-sm-4 col-md-4 col-xs-4 col-lg-4 ">
                    <?=
                    DatePicker::widget([
                        'name' => 'txt_fecha_solicitud',
                        'value' => '',
                        //'disabled' => $habilita,
                        'type' => DatePicker::TYPE_INPUT,
                        'options' => ["class" => "form-control PBvalidation keyupmce", "id" => "txt_fecha_solicitud", "data-type" => "fecha_pro", "data-keydown" => "true", "placeholder" => Yii::t("formulario", "Date")],
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => Yii::$app->params["dateByDatePicker"],
                        ]
                    ]);
                    ?>
                </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">            
            <label for="cmb_unidad_solicitud" class="col-lg-3 col-md-3 col-sm-3 col-xs-3 control-label"><?= Yii::t("formulario", "Academic unit") ?> <span class="text-danger">*</span></label>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                <?= Html::dropDownList("cmb_unidad_solicitud", 0, $arr_ninteres, ["class" => "form-control", "id" => "cmb_unidad_solicitud"]) ?>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">            
            <label for="cmb_modalidad_solicitud" class="col-lg-3 col-md-3 col-sm-3 col-xs-3 control-label"><?= Yii::t("formulario", "Mode") ?> <span class="text-danger">*</span></label>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                <?= Html::dropDownList("cmb_modalidad_solicitud", 0, $arr_modalidad, ["class" => "form-control", "id" => "cmb_modalidad_solicitud"]) ?>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">            
            <label for="cmb_carrera_solicitud" class="col-lg-3 col-md-3 col-sm-3 col-xs-3 control-label"><?= Yii::t("academico", "Career") . ' /Programa' ?> <span class="text-danger">*</span></label>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                <?= Html::dropDownList("cmb_carrera_solicitud", 0, $arr_carrerra1, ["class" => "form-control", "id" => "cmb_carrera_solicitud"]) ?>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">            
            <label for="cmb_metodo_solicitud" class="col-sm-3 col-md-3 col-xs-3 col-lg-3 control-label keyupmce"><?= Yii::t("formulario", "Income Method") ?><span class="text-danger">*</span></label>
            <div class="col-sm-9 col-md-9 col-xs-9 col-lg-9">
                <?= Html::dropDownList("cmb_metodo_solicitud", 0, array_merge([Yii::t("formulario", "Select")], $arr_metodos), ["class" => "form-control", "id" => "cmb_metodo_solicitud"]) ?>
            </div>
        </div>
    </div>   
    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12" id="divAplicaDescuento" style="display: block">               
        <div class="form-group">
            <label for="txt_declararDescuento" class="col-sm-5 control-label"><?= financiero::t("Pagos", "Apply Discount") ?></label>
            <div class="col-sm-7">  
                <label><input type="radio" name="opt_declara_Dctosi"  id="opt_declara_Dctosi" value="1"><b>Si</b></label>
                <label><input type="radio" name="opt_declara_Dctono"  id="opt_declara_Dctono" value="2" checked><b>No</b></label>                                              
            </div>            
        </div>               
    </div> 
    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12" id="divDescuento" style="display: none">    
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="cmb_descuento" class="col-sm-5 col-md-5 col-xs-5 col-lg-5 control-label keyupmce"><?= financiero::t("Pagos", "Discount") ?></label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <?= Html::dropDownList("cmb_descuento", 0, array_merge([Yii::t("formulario", "Select")], $arr_descuento), ["class" => "form-control", "id" => "cmb_descuento"]) ?>
                </div>
            </div>    
        </div>  
    </div>    
    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">         
        </br>
        </br>
    </div>
    <div class="row"> 
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10"></div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <a id="sendInformacionAdmitidoFinal" href="javascript:" class="btn btn-primary btn-block"> <?php Yii::t("formulario", "Registrar"); ?> </a>
        </div>
    </div>
</form>