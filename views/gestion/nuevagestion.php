<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\date\DatePicker;
$fecha_actual = date("Y-m-d"); 
array_unshift($arr_operdida, "Seleccionar");
?>
<?= Html::hiddenInput('txth_idg', $_GET["id"], ['id' => 'txth_idg']); ?>
<?= Html::hiddenInput('txth_idc', $datageneral["pges_id"], ['id' => 'txth_idc']); ?>
<div class="col-md-12">    
    <h3><span id="lbl_titulo"><?= Yii::t("formulario", "New Management") ?></span><br/>    
</div>
<div class="col-md-12">    
    <br/>    
</div>
<div class="col-md-12  col-xs-12 col-sm-12 col-lg-12">
    <p class="text-danger"> <?= Yii::t("formulario", "Fields with * are required") ?> </p>
</div>
<form class="form-horizontal" enctype="multipart/form-data" >
    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12 ">
        <div class="col-md-7 col-sm-7 col-xs-7 col-lg-7">
            <div class="form-group">
                <h4><span id="lbl_general"><?= Yii::t("formulario", "Data General Contact") ?></span></h4>                                  
            </div>
        </div>            
    </div> 
    <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_nombrebene1" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label" id="lbl_nombrebene1"><?= Yii::t("formulario", "First Name") ?> <span class="text-danger">*</span> </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <input type="text" class="form-control PBvalidation keyupmce" value="<?= $datageneral["pges_pri_nombre"] ?>" id="txt_nombrebene1" data-type="alfa" placeholder="<?= Yii::t("formulario", "First Name") ?>">
                </div>
            </div>
        </div>  
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_nombrebene2" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label" id="lbl_nombrebene1"><?= Yii::t("formulario", "Middle Name") ?></label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <input type="text" class="form-control keyupmce" value="<?= $datageneral["pges_seg_nombre"] ?>" id="txt_nombrebene2" data-type="alfa" placeholder="<?= Yii::t("formulario", "Middle Name") ?>">
                </div>
            </div>
        </div>  
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_apellidobene1" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label" id="lbl_apellidobene1"><?= Yii::t("formulario", "Last Name") ?> <span class="text-danger">*</span> </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <input type="text" class="form-control PBvalidation keyupmce" value="<?= $datageneral["pges_pri_apellido"] ?>" id="txt_apellidobene1" data-type="alfa" placeholder="<?= Yii::t("formulario", "Last Name") ?>">
                </div>
            </div>
        </div>  
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_apellidobene2" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label" id="lbl_apellidobene2"><?= Yii::t("formulario", "Last Second Name") ?> </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <input type="text" class="form-control keyupmce" value="<?= $datageneral["pges_seg_apellido"] ?>" id="txt_apellidobene2" data-type="alfa" placeholder="<?= Yii::t("formulario", "Last Second Name") ?>">
                </div>
            </div>
        </div>   
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">   
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="txt_celular" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "CellPhone") ?> </label>        
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <div class="input-group">
                        <span id="lbl_codeCountry" class="input-group-addon"><?= $area ?></span>
                        <input type="text" class="form-control PBvalidation" value="<?= $datageneral["pges_celular"] ?>" id="txt_celular" data-type="celular_sin" data-keydown="true" placeholder="<?= Yii::t("formulario", "CellPhone") ?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="txt_celular2" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "CellPhone") . ' 2' ?> </label>        
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <div class="input-group">
                        <span id="lbl_codeCountry" class="input-group-addon"><?= $area ?></span>
                        <input type="text" class="form-control PBvalidation" value="<?= $datageneral["pges_domicilio_celular2"] ?>" id="txt_celular2" data-type="celular_sin" data-keydown="true" placeholder="<?= Yii::t("formulario", "CellPhone") . ' 2' ?>">
                    </div>
                </div>
            </div>           
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="txt_telefono_con" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label"><?= Yii::t("formulario", "Phone") ?></label>      
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <div class="input-group">
                        <span id="lbl_codeCountrycon" class="input-group-addon"><?= $area ?></span>
                        <input type="text" class="form-control PBvalidation" data-required="false" value="<?= $datageneral["pges_domicilio_telefono"] ?>" id="txt_telefono_con" data-type="telefono_sin" data-keydown="true" placeholder="<?= Yii::t("formulario", "Phone") ?>">
                    </div>
                </div>
            </div>
        </div> 
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="txt_correo" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  col-md-4 col-xs-4 col-lg-4 control-label"><?= Yii::t("formulario", "Email") ?> </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <input type="text" class="form-control PBvalidation keyupmce" value="<?= $datageneral["pges_correo"]?>" id="txt_correo" data-type="email" data-keydown="true" placeholder="<?= Yii::t("formulario", "Email") ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12 ">
        <div class="col-md-7 col-sm-7 col-xs-7 col-lg-7">
            <div class="form-group">
                <h4><span id="lbl_general"><?= Yii::t("formulario", "Data Management") ?></span></h4>                                  
            </div>
        </div>            
    </div> 
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">  
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_fecha_recepcion" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "Reception Date") ?> <span class="text-danger">*</span> </label>
                <div class="col-sm-4 col-md-4 col-xs-4 col-lg-4 ">
                    <?=
                    DatePicker::widget([
                        'name' => 'txt_fecha_recepcion',
                        'value' => $fecha_actual,
                        'type' => DatePicker::TYPE_INPUT,
                        'options' => ["class" => "form-control PBvalidation keyupmce", "id" => "txt_fecha_recepcion", "data-type" => "fecha_rec", "data-keydown" => "true", "placeholder" => Yii::t("formulario", "Reception Date")],
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => Yii::$app->params["dateByDatePicker"],
                        ]]
                    );
                    ?>
                </div>
                <label hidden for="txt_hora_recepcion" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "Reception Hour") ?> </label>                
                <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3">                    
                    <input type="text" class="form-control PBvalidation" value="" id="txt_hora_recepcion" data-type="tiempo" data-keydown="true" placeholder="<?= Yii::t('formulario', 'HH:MM') ?>">
                </div>  
            </div>
        </div> 
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_fecha_atencion" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "Attention Date") ?> <span class="text-danger">*</span> </label>
                <div class="col-sm-4 col-md-4 col-xs-4 col-lg-4 ">
                    <?=
                    DatePicker::widget([
                        'name' => 'txt_fecha_atencion',
                        'value' => '',
                        'type' => DatePicker::TYPE_INPUT,
                        'options' => ["class" => "form-control PBvalidation keyupmce", "id" => "txt_fecha_atencion", "data-type" => "fecha_aten", "data-keydown" => "true", "placeholder" => Yii::t("formulario", "Attention Date")],
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => Yii::$app->params["dateByDatePicker"],
                        ]]
                    );
                    ?>
                </div>
                <label hidden for="txt_hora_atencion" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "Attention Hour") ?> </label>            
                <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3">                    
                    <input type="text" class="form-control PBvalidation" value="" id="txt_hora_atencion" data-type="tiempo" data-keydown="true" placeholder="<?= Yii::t('formulario', 'HH:MM') ?>">
                </div> 
            </div>                    
        </div>         
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="cmb_estado" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "Status") ?> <span class="text-danger">*</span> </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <?= Html::dropDownList("cmb_estado", 0, $arr_estgestion, ["class" => "form-control", "id" => "cmb_estado"]) ?>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_observacion" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label" id="lbl_descripcion"><?= Yii::t("formulario", "observation") ?> </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <textarea  class="form-control keyupmce" id="txt_observacion"></textarea>
                </div>
            </div>
        </div> 
    </div>   
    <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'> 
        <div id="oportunidad" style="display: none;" class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="cmb_oportunidad" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "Lost Opportunity") ?></label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <?= Html::dropDownList("cmb_oportunidad", 0, $arr_operdida, ["class" => "form-control can_combo", "id" => "cmb_oportunidad"]) ?>
                </div>
            </div>
        </div>             
    </div>
    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12 ">
        <div class="col-md-7 col-sm-7 col-xs-7 col-lg-7">
            <div class="form-group">
                <h4><span id="lbl_general"><?= Yii::t("formulario", "Attention Next") ?></span></h4>                                  
            </div>
        </div>            
    </div> 
    <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_fecha_next" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "Date") ?></label>
                <div class="col-sm-4 col-md-4 col-xs-4 col-lg-4 ">
                    <?=
                    DatePicker::widget([
                        'name' => 'txt_fecha_next',
                        'value' => '',
                        'disabled' => $habilita,
                        'type' => DatePicker::TYPE_INPUT,
                        'options' => ["class" => "form-control PBvalidation keyupmce", "id" => "txt_fecha_next", "data-type" => "fecha_pro", "data-keydown" => "true", "placeholder" => Yii::t("formulario", "Date")],
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => Yii::$app->params["dateByDatePicker"],
                        ]]
                    );
                    ?>
                </div>
                <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3">                    
                    <label hidden for="txt_hora_proxima" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "Next Hour") ?> </label>                                    
                    <input type="text" class="form-control PBvalidation keyupmce" value="" id="txt_hora_proxima" data-type="tiempo" data-keydown="true" placeholder="<?= Yii::t('formulario', 'HH:MM') ?>"></div> 
            </div>                    
        </div> 
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="cmb_tipocontacto" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "Type") . ' ' . Yii::t("formulario", "Contact") ?>  </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <?= Html::dropDownList("cmb_tipocontacto", 0, ["0" => "Seleccionar", "1" => "Visita", "2" => "Llamada", "3" => "Correo"], ["class" => "form-control", "id" => "cmb_tipocontacto"]) ?>
                </div>
            </div>
        </div> 
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">   
        <div class="col-md-10"></div>
        <div class="col-md-2">
            <a id="btn_grabarneo" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("accion", "Save") ?></a>                                   
        </div>
    </div>     
</form>

