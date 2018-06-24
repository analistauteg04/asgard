<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\date\DatePicker;

$fecha_actual = date("Y-m-d");
array_unshift($arr_operdida, "Seleccionar");
?>
<?= Html::hiddenInput('txth_idag', $agente_autentica, ['id' => 'txth_idag']); ?>
<?= Html::hiddenInput('txth_idpa', $persona_autentica, ['id' => 'txth_idpa']); ?>
<div class="col-md-12">    
    <h3><span id="lbl_titulo"><?= Yii::t("formulario", "Create Management") ?></span><br/>    
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
                <h4><span id="lbl_general"><?= Yii::t("formulario", "Data General Contractor") ?></span></h4>                                  
            </div>
        </div>            
    </div> 
    <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_nombre1" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label" id="lbl_nombre1"><?= Yii::t("formulario", "First Name") ?> <span class="text-danger">*</span> </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <input type="text" class="form-control PBvalidation keyupmce" value="" id="txt_nombre1" data-type="alfa" placeholder="<?= Yii::t("formulario", "First Name") ?>">
                </div>
            </div>
        </div>  
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_nombre2" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label" id="lbl_nombre2"><?= Yii::t("formulario", "Middle Name") ?></label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <input type="text" class="form-control keyupmce" value="" id="txt_nombre2" data-type="alfa" placeholder="<?= Yii::t("formulario", "Middle Name") ?>">
                </div>
            </div>
        </div>  
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_apellido1" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label" id="lbl_apellido1"><?= Yii::t("formulario", "Last Name") ?> <span class="text-danger">*</span> </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <input type="text" class="form-control PBvalidation keyupmce" value="" id="txt_apellido1" data-type="alfa" placeholder="<?= Yii::t("formulario", "Last Name") ?>">
                </div>
            </div>
        </div>  
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_apellido2" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label" id="lbl_apellido2"><?= Yii::t("formulario", "Last Second Name") ?> </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <input type="text" class="form-control keyupmce" value="" id="txt_apellido2" data-type="alfa" placeholder="<?= Yii::t("formulario", "Last Second Name") ?>">
                </div>
            </div>
        </div>  
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="cmb_pais" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "Country") ?> <span class="text-danger">*</span> </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <select id="cmb_pais" name="cmb_pais" class="form-control pai_combo">
                        <?php
                        $pai_id_nacimiento = 57;
                        $code = "";
                        foreach ($arr_pais as $key => $value) {

                            $selected = ($pai_id_nacimiento == $value['id']) ? "selected='seleted'" : "";
                            if ($selected != "")
                                $code = "+" . preg_replace('/\s+/', '', $value['code']);
                            echo "<option value='" . $value['id'] . "' data-code='" . "+" . preg_replace('/\s+/', '', $value['code']) . "' $selected >" . $value['value'] . "</option>";
                        }
                        ?> 
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="cmb_prov" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "State") ?> <span class="text-danger">*</span> </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <?= Html::dropDownList("cmb_prov", 0, $arr_prov, ["class" => "form-control pro_combo", "id" => "cmb_prov"]) ?>
                </div>
            </div>
        </div>               
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">    
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="cmb_ciu" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "City") ?> <span class="text-danger">*</span> </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <?= Html::dropDownList("cmb_ciu", 0, $arr_ciu, ["class" => "form-control can_combo", "id" => "cmb_ciu"]) ?>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="txt_celular" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "CellPhone") ?> </label>        
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <div class="input-group">
                        <span id="lbl_codeCountry" class="input-group-addon"><?= $area ?></span>
                        <input type="text" class="form-control PBvalidation" value="" id="txt_celular" data-type="celular_sin" data-keydown="true" placeholder="<?= Yii::t("formulario", "CellPhone") ?>">
                    </div>
                </div>
            </div>
        </div>                 
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="txt_celular2" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "CellPhone") . ' 2' ?> </label>        
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <div class="input-group">
                        <span id="lbl_codeCountry" class="input-group-addon"><?= $area ?></span>
                        <input type="text" class="form-control PBvalidation" value="" id="txt_celular2" data-type="celular_sin" data-keydown="true" placeholder="<?= Yii::t("formulario", "CellPhone") . ' 2' ?>">
                    </div>
                </div>
            </div>           
        </div>          
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="txt_telefono_con" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label"><?= Yii::t("formulario", "Phone") ?></label>      
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <div class="input-group">
                        <span id="lbl_codeCountrycon" class="input-group-addon"><?= $code ?></span>
                        <input type="text" class="form-control PBvalidation" data-required="false" value="" id="txt_telefono_con" data-type="telefono_sin" data-keydown="true" placeholder="<?= Yii::t("formulario", "Phone") ?>">
                    </div>
                </div>
            </div>
        </div>  
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="txt_correo" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  col-md-4 col-xs-4 col-lg-4 control-label"><?= Yii::t("formulario", "Email") ?> </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <input type="text" class="form-control PBvalidation keyupmce" value="" id="txt_correo" data-type="email" data-keydown="true" placeholder="<?= Yii::t("formulario", "Email") ?>">
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="cmb_medio" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "Half Contact") ?> <span class="text-danger">*</span> </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <?= Html::dropDownList("cmb_medio", 0, $arr_conocimiento, ["class" => "form-control pro_combo", "id" => "cmb_medio"]) ?>
                </div>
            </div>
        </div>                
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="cmb_nivelestudio" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "Academic unit") ?> <span class="text-danger">*</span> </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <?= Html::dropDownList("cmb_nivelestudio", 0, $arr_ninteres, ["class" => "form-control pro_combo", "id" => "cmb_nivelestudio"]) ?>
                </div>
            </div>
        </div>  
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="cmb_modalidad" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label"><?= Yii::t("formulario", "Mode") ?> <span class="text-danger">*</span> </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <?= Html::dropDownList("cmb_modalidad", 0, $arr_modalidad, ["class" => "form-control PBvalidation", "id" => "cmb_modalidad"]) ?>                            
                </div>
            </div>
        </div>
    </div>
    <div id="carrera" style="display: block;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="cmb_carrera1" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("academico", "Career") . ' 1' ?> <span class="text-danger">*</span> </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <?= Html::dropDownList("cmb_carrera1", 0, $arr_carrerra1 /* ["1" => "Carrera 1", "2" => "Carrera 2"] */, ["class" => "form-control", "id" => "cmb_carrera1"]) ?>
                </div>
            </div>
        </div> 
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="cmb_carrera2" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("academico", "Career") . ' 2' ?> <span class="text-danger">*</span> </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <?= Html::dropDownList("cmb_carrera2", 0, $arr_carrerra2, ["class" => "form-control", "id" => "cmb_carrera2"]) ?>
                </div>
            </div>
        </div>
    </div>    
    <div id="programa" style="display: none;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="cmb_carrera2" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "Program") . ' 1' ?> <span class="text-danger">*</span> </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <?= Html::dropDownList("cmb_carrera2", 0, $arr_programa1, ["class" => "form-control", "id" => "cmb_carrera2"]) ?>
                </div>
            </div>
        </div>         
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="cmb_carrera2" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("academico", "Career") . ' 2' ?> <span class="text-danger">*</span> </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <?= Html::dropDownList("cmb_carrera2", 0, $arr_carrerra2, ["class" => "form-control", "id" => "cmb_carrera2"]) ?>
                </div>
            </div>
        </div>
    </div>  
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="cmb_subcarrera" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "Sub Carrier") . ' 2' ?> <span class="text-danger">*</span> </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <?= Html::dropDownList("cmb_subcarrera", 0, $arr_subcarrerra, ["class" => "form-control can_combo", "id" => "cmb_subcarrera"]) ?>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="cmb_canal" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "Channel") ?> <span class="text-danger">*</span> </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <?= Html::dropDownList("cmb_canal", 0, $arr_canal, ["class" => "form-control can_combo", "id" => "cmb_canal"]) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">   
        <div class="form-group">
            <label for="lbl_Beneficiario" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label"><?= Yii::t("formulario", "Are you the Contact") ?></label>
            <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                <label>                
                    <input type="radio" name="rdo_beneficio" id="rdo_beneficio" value="1" checked> Si<br>                   
                </label>
                <label>            
                    <input type="radio" name="rdo_beneficio_no" id="rdo_beneficio_no" value="2" > No<br>
                </label>
            </div> 
        </div>
    </div>
    <div id="beneficio" style="display: none;">
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
                        <input type="text" class="form-control PBvalidation keyupmce" value="" id="txt_nombrebene1" data-type="alfa" placeholder="<?= Yii::t("formulario", "First Name") ?>">
                    </div>
                </div>
            </div>  
            <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                <div class="form-group">
                    <label for="txt_nombrebene2" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label" id="lbl_nombrebene1"><?= Yii::t("formulario", "Middle Name") ?></label>
                    <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                        <input type="text" class="form-control keyupmce" value="" id="txt_nombrebene2" data-type="alfa" placeholder="<?= Yii::t("formulario", "Middle Name") ?>">
                    </div>
                </div>
            </div>  
        </div>  
        <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>
            <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                <div class="form-group">
                    <label for="txt_apellidobene1" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label" id="lbl_apellidobene1"><?= Yii::t("formulario", "Last Name") ?> <span class="text-danger">*</span> </label>
                    <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                        <input type="text" class="form-control PBvalidation keyupmce" value="" id="txt_apellidobene1" data-type="alfa" placeholder="<?= Yii::t("formulario", "Last Name") ?>">
                    </div>
                </div>
            </div>  
            <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                <div class="form-group">
                    <label for="txt_apellidobene2" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label" id="lbl_apellidobene2"><?= Yii::t("formulario", "Last Second Name") ?> </label>
                    <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                        <input type="text" class="form-control keyupmce" value="" id="txt_apellidobene2" data-type="alfa" placeholder="<?= Yii::t("formulario", "Last Second Name") ?>">
                    </div>
                </div>
            </div>   
        </div>
        <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <div class="form-group">
                    <label for="txt_celularbene" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "CellPhone") ?> </label>        
                    <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                        <div class="input-group">
                            <span id="lbl_codeCountrybeni" class="input-group-addon"><?= $area ?></span>
                            <input type="text" class="form-control PBvalidation" value="" id="txt_celularbene" data-type="celular_sin" data-keydown="true" placeholder="<?= Yii::t("formulario", "CellPhone") ?>">
                        </div>
                    </div>
                </div>
            </div> 
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <div class="form-group">
                    <label for="txt_celularbeni2" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "CellPhone") . ' 2' ?> </label>        
                    <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                        <div class="input-group">
                            <span id="lbl_codeCountry" class="input-group-addon"><?= $area ?></span>
                            <input type="text" class="form-control PBvalidation" value="" id="txt_celularbeni2" data-type="celular_sin" data-keydown="true" placeholder="<?= Yii::t("formulario", "CellPhone") . ' 2' ?>">
                        </div>
                    </div>
                </div>           
            </div> 
        </div> 
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                      
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <div class="form-group">
                    <label for="txt_telefono_conbeni" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label"><?= Yii::t("formulario", "Phone") ?></label>      
                    <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                        <div class="input-group">
                            <span id="lbl_codeCountrycon" class="input-group-addon"><?= $code ?></span>
                            <input type="text" class="form-control PBvalidation" data-required="false" value="" id="txt_telefono_conbeni" data-type="telefono_sin" data-keydown="true" placeholder="<?= Yii::t("formulario", "Phone") ?>">
                        </div>
                    </div>
                </div>
            </div>  
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <div class="form-group">
                    <label for="txt_correobeni" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  col-md-4 col-xs-4 col-lg-4 control-label"><?= Yii::t("formulario", "Email") ?> </label>
                    <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                        <input type="text" class="form-control PBvalidation keyupmce" value="" id="txt_correobeni" data-type="email" data-keydown="true" placeholder="<?= Yii::t("formulario", "Email") ?>">
                    </div>
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
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="cmb_agente" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "Executive") ?> <span class="text-danger">*</span> </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <?php if ($agente_autentica == 1 || $persona_autentica == 1 || $agente_autentica == 2) { ?>
                        <?= Html::dropDownList("cmb_agente", 0, $arr_agente, ["class" => "form-control", "id" => "cmb_agente"]) ?>
                    <?php } else { ?>
                        <?= Html::dropDownList("cmb_agenteau", $agente_cargo, $arr_agente, ["class" => "form-control", "id" => "cmb_agenteau", "disabled" => true]) ?>
                    <?php } ?>
                </div>
            </div>
        </div> 
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
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>        
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_fecha_atencion" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "Attention Date") ?> <span class="text-danger">*</span> </label>
                <div class="col-sm-4 col-md-4 col-xs-4 col-lg-4 ">
                    <?=
                    DatePicker::widget([
                        'name' => 'txt_fecha_atencion',
                        'value' => $fecha_actual,
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
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="cmb_estado" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "Status") ?> <span class="text-danger">*</span> </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <?= Html::dropDownList("cmb_estado", 0, $arr_estgestion, ["class" => "form-control", "id" => "cmb_estado"]) ?>
                </div>
            </div>
        </div> 
    </div>   
    <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>        
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_observacion" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label" id="lbl_descripcion"><?= Yii::t("formulario", "observation") ?> </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <textarea  class="form-control keyupmce" id="txt_observacion"></textarea>
                </div>
            </div>
        </div>
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
            <a id="btn_grabar" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("accion", "Save") ?></a>                                   
        </div>
    </div>     
</form>

