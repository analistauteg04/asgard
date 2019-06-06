<?php
/* 
 * Authors:
 * Grace Viteri <analistadesarrollo01@uteg.edu.ec> 
 * Kleber Loayza <analistadesarrollo03@uteg.edu.ec> /
 */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h3><span id="lbl_Personeria"><?= Yii::t("formulario", "Register") ?></span></h3>
</div>
<form class="form-horizontal" enctype="multipart/form-data" >
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="cmb_evento" class="col-sm-5 control-label"><?= Yii::t("formulario", "Event Name") ?></label>
                <div class="col-sm-7">
                    <?= Html::dropDownList("cmb_evento", 1, $arr_evento, ["class" => "form-control", "id" => "cmb_evento", ""]) ?>
                </div>
            </div>
        </div>        
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="txt_nombre" class="col-sm-5 control-label"><?= Yii::t("formulario", "Names") ?><span class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <input type="text" class="form-control PBvalidation keyupmce" value="" id="txt_nombre"  data-type="alfa" data-keydown="true" placeholder="<?= Yii::t("formulario", "Names") ?>">
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="txt_apellido" class="col-sm-5 control-label"><?= Yii::t("formulario", "Last Names") ?><span class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <input type="text" class="form-control PBvalidation keyupmce" value="" id="txt_apellido" data-type="alfa" data-keydown="true" placeholder="<?= Yii::t("formulario", "Last Names") ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">    
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="txt_correo" class="col-sm-5 control-label"><?= Yii::t("formulario", "Email") ?><span class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <input type="text" class="form-control PBvalidation" value="" id="txt_correo" data-type="email" data-keydown="true" placeholder="<?= Yii::t("formulario", "Email") ?>">
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="txt_celular" class="col-sm-5 control-label"><?= Yii::t("formulario", "CellPhone") ?><span class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <div class="input-group">
                        <input type="text" class="form-control PBvalidation" value="" id="txt_celular" data-type="celular_sin" data-keydown="true" placeholder="<?= Yii::t("formulario", "CellPhone") ?>">
                    </div>
                </div>
            </div>
        </div>        
    </div>    
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
            <div class="form-group">
                    <label for="txt_telefono" class="col-sm-5 control-label"><?= Yii::t("formulario", "Phone") ?></label>
                    <div class="col-sm-7">
                        <div class="input-group">
                            <input type="text" class="form-control PBvalidation" value="" id="txt_telefono" data-type="telefono_sin" data-keydown="true" placeholder="<?= Yii::t("formulario", "Phone") ?>">
                        </div>
                    </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="cmb_genero" class="col-sm-5 control-label"><?= Yii::t("formulario", "Gender") ?><span class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <?= Html::dropDownList("cmb_genero", 0, $arr_genero, ["class" => "form-control", "id" => "cmb_genero"]) ?>
                </div>
            </div>
        </div>             
    </div>        
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="txt_edad" class="col-sm-5 control-label"><?= Yii::t("formulario", "Age") ?><span class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <input type="text" class="form-control keyupmce" value="" id="txt_edad" data-type="number" data-keydown="true" placeholder="<?= Yii::t("formulario", "Age") ?>">
                </div>
            </div>
        </div>   
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="cmb_nivel_estudio" class="col-sm-5 control-label"><?= Yii::t("formulario", "Instructional Level") ?><span class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <?= Html::dropDownList("cmb_nivel_estudio", 0, $arr_nivel, ["class" => "form-control", "id" => "cmb_nivel_estudio"]) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">   
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="cmb_provincia" class="col-sm-5 control-label"><?= Yii::t("formulario", "State") ?><span class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <?= Html::dropDownList("cmb_provincia", 0, $arr_provincia, ["class" => "form-control pro_combo", "id" => "cmb_provincia"]) ?>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="cmb_ciudad" class="col-sm-5 control-label"><?= Yii::t("formulario", "City") ?><span class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <?= Html::dropDownList("cmb_ciudad", 0, $arr_ciudad, ["class" => "form-control can_combo", "id" => "cmb_ciudad"]) ?>
                </div>
            </div>
        </div>        
    </div>    
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">          
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9"></div>

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            <a id="registrar" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Register") ?> </a>
        </div>        
    </div> 
</form>

