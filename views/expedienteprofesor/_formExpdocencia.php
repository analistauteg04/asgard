<?php
/*
 * The Asgard framework is free software. It is released under the terms of
 * the following BSD License.
 *
 * Copyright (C) 2015 by Asgard Software 
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *  - Redistributions of source code must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 *  - Redistributions in binary form must reproduce the above copyright
 *    notice, this list of conditions and the following disclaimer in
 *    the documentation and/or other materials provided with the
 *    distribution.
 *  - Neither the name of Asgard Software nor the names of its
 *    contributors may be used to endorse or promote products derived
 *    from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * Asgard is based on code by
 * Yii Software LLC (http://www.yiisoft.com) Copyright Â© 2008
 *
 * Authors:
 * 
 * Diana Lopez <dlopez@uteg.edu.ec>
 * 
 */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;
use kartik\date\DatePicker;
use yii\helpers\Url;
use app\components\CFileInputAjax;

array_push($arr_instituto, "Otra");
end($arr_instituto);
$otradocencia = key($arr_instituto);
array_unshift($arr_instituto, "Seleccionar");
//print_r($arr_instituto);
?>
<?= Html::hiddenInput('txth_otradocencia', $otradocencia, ['id' => 'txth_otradocencia']); ?>
<div class='row'>
    <!-- Columna principal donde estan los nombres y la fotos Autor : Omar Romero Lopez-->
    <div class='col-md-12'>
        <div class="col-xs-12 col-sm-12 col-md-12 ">
            <div class='row' id='dynamic_field'>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <!-- Espacio de relleno --></br>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="txt_expDocencia" class="col-sm-5 control-label"><?= Yii::t("formulario", "He has experience in teaching") ?></label>
                        <div class="col-sm-7">
                            <label>                
                                <input type="radio" name="check_expDocenciaOK" id="check_expDocenciaOK" value="1" checked> Si<br>                   
                            </label>
                            <label>            
                                <input type="radio" name="check_expDocenciaNOK" id="check_expDocenciaNOK" value="2" > No<br>
                            </label>
                        </div> 
                    </div>                    
                </div> 
                <div id="expdocencia" style="display: block;" >
                    <div class="col-md-12"> 
                        <div class="col-md-6">   
                            <div class="form-group">
                                <label for="txt_area_conocimiento" class="col-sm-5 control-label"><?= Yii::t("formulario", "Knowledge Area") ?></label>
                                <div class="col-sm-7">
                                    <?= Html::dropDownList("cmb_area_conocimientoed", 0, $arr_conocimiento, ["class" => "form-control", "id" => "cmb_area_conocimientoed"]) ?>
                                </div>
                            </div>
                        </div>  
                        <div class="col-md-6">                    
                            <div class="form-group">
                                <label for="txt_subareaconocimiento" class="col-sm-5 control-label"><?= Yii::t("formulario", "Knowledge Sub Area") ?></label>
                                <div class="col-sm-7">
                                    <?= Html::dropDownList("cmb_subarea_conocimientoed", 0, $arr_subarea, ["class" => "form-control", "id" => "cmb_subarea_conocimientoed"]) ?>
                                </div>
                            </div>  
                        </div>                                                                       
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cmb_pais_expdoce" class="col-sm-5 control-label"><?= Yii::t("formulario", "Country") ?> <span class="text-danger"></span> </label>
                                <div class="col-sm-7">
                                    <select id="cmb_pais_expdoce" name="cmb_pais_expdoce" class="form-control pai_combo">
                                        <?php
                                        $code = "";
                                        foreach ($paises_nac as $key => $value) {

                                            $selected = ($pai_id_expl == $value['id']) ? "selected='seleted'" : "";
                                            if ($selected != "")
                                                $code = "+" . preg_replace('/\s+/', '', $value['code']);
                                            echo "<option value='" . $value['id'] . "' data-code='" . "+" . preg_replace('/\s+/', '', $value['code']) . "' $selected >" . $value['value'] . "</option>";
                                        }
                                        ?> 
                                    </select>
                                </div>
                            </div> 
                        </div>  
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txt_universidad_institucion" class="col-sm-5 control-label"><?= Yii::t("formulario", "Institution") ?></label>
                                <div class="col-sm-7">
                                    <?= Html::dropDownList("cmb_universidad_institucion", 0, $arr_instituto, ["class" => "form-control", "id" => "cmb_universidad_institucion"]) ?>
                                    <!--<input type="checkbox" name="check_otrainstitucion"  id="check_otrainstitucion" value="1"> 
                                    <label for="lbl_otrainstitucion" class=" control-label"><?= Yii::t("formulario", "Other") ?></label>-->
                                </div>
                            </div>
                        </div>                                                                                             
                    </div> 
                    <div class="col-md-12">
                        <div class="col-md-6">                    
                            <div class="form-group">
                                <label for="txt_otrainstitucion" class="col-sm-5 control-label"><?= Yii::t("formulario", "Other") . ' ' . Yii::t("formulario", "Institution") ?></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control PBvalidation keyupmce controlExpDocencia" data-required="false" id="txt_otrainstitucion" disabled ="true" data-type="alfa" data-keydown="true" placeholder="<?= Yii::t("formulario", "Other") . ' ' . Yii::t("formulario", "Institution") ?>">
                                </div>
                            </div>  
                        </div>   
                        <div class="col-md-6">                                                
                            <div class="form-group">
                                <label for="cmb_tiempo_dedicacion" class="col-sm-5 control-label"><?= Yii::t("formulario", "Dedication time") ?> <span class="text-danger"></span> </label>
                                <div class="col-sm-7">
                                    <?= Html::dropDownList("cmb_tiempo_dedicacion", 0, $arr_tiempodedica, ["class" => "form-control can_combo controlExpDocencia", "id" => "cmb_tiempo_dedicacion"]) ?>
                                </div>
                            </div>                                        
                        </div>                           
                    </div>
                    <!--<div class='col-md-12'> 

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cmb_prov_expdoce" class="col-sm-5 control-label"><?= Yii::t("formulario", "State") ?> <span class="text-danger"></span> </label>
                                <div class="col-sm-7">
                    <?= Html::dropDownList("cmb_prov_expdoce", $pro_id_expl, $provincias_nac, ["class" => "form-control", "id" => "cmb_prov_expdoce"]) ?>
                                </div>
                            </div>
                        </div>                        
                    </div>-->
                    <div class='col-md-12'>
                        <!--<div class="col-md-6">
                            <div class="form-group">
                                <label for="cmb_ciu_expdoce" class="col-sm-5 control-label"><?= Yii::t("formulario", "City") ?> <span class="text-danger"></span> </label>
                                <div class="col-sm-7">
                        <?= Html::dropDownList("cmb_ciu_expdoce", $can_id_expl, $cantones_nac, ["class" => "form-control", "id" => "cmb_ciu_expdoce"]) ?>
                                </div>
                            </div>
                        </div>-->   
                        <div class="col-md-6">                     
                            <div class="form-group">
                                <label for="cmb_tipo_relacion" class="col-sm-5 control-label"><?= Yii::t("formulario", "Type Work Relationship") ?> <span class="text-danger"></span> </label>
                                <div class="col-sm-7">
                                    <?= Html::dropDownList("cmb_tipo_relacion", 0, $arr_tiprelacion, ["class" => "form-control can_combo controlExpDocencia", "id" => "cmb_tipo_relacion"]) ?>
                                </div>
                            </div> 
                        </div>                        
                        <div class="col-md-6">                    
                            <div class="form-group">
                                <label for="txt_direccion_expdocencia" class="col-sm-5 control-label"><?= Yii::t("formulario", "Address") . ' ' . Yii::t("formulario", "Institution") ?></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control PBvalidation keyupmce controlExpDocencia" data-required="false" id="txt_direccion_expdocencia" data-type="alfa" data-keydown="true" placeholder="<?= Yii::t("formulario", "Dirección de Universidad/Institución") ?>">
                                </div>
                            </div>  
                        </div>                           
                    </div>    
                    <div class="col-md-12"> 
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txt_tlfono_expdocencia" class="col-sm-5 control-label"><?= Yii::t("formulario", "Phone") . ' ' . Yii::t("formulario", "Institution") ?></label>
                                <div class="col-sm-7">
                                    <div class="input-group">
                                        <span id="lbl_codeCountryexpdoce" class="input-group-addon"><?= $code ?></span>
                                        <input type="text" class="form-control PBvalidation keyupmce" id="txt_tlfono_expdocencia" data-type="telefono_sin" data-keydown="true" placeholder="<?= Yii::t("formulario", "Phone") . ' ' . Yii::t("formulario", "Institution") ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txt_finicio_expdocencia" class="col-sm-5 control-label"><?= Yii::t("formulario", "Start date") . ' ' . Yii::t("formulario", "labors") ?><span class="text-danger"></span></label>
                                <div class="col-sm-7">
                                    <?=
                                    DatePicker::widget([
                                        'name' => 'txt_finicio_expdocencia',
                                        'value' => $per_fecha_nacimiento,
                                        'type' => DatePicker::TYPE_INPUT,
                                        'options' => ["class" => "form-control PBvalidation keyupmce controlExpDocencia", "id" => "txt_finicio_expdocencia", "data-type" => "fecha", "data-keydown" => "true", "placeholder" => Yii::t("formulario", "Start date") . ' ' . Yii::t("formulario", "labors")],
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
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txt_ffin_expdocencia" class="col-sm-5 control-label"><?= Yii::t("formulario", "End date") . ' ' . Yii::t("formulario", "labors") ?> <span class="text-danger"></span></label>
                                <div class="col-sm-5">
                                    <?=
                                    DatePicker::widget([
                                        'name' => 'txt_ffin_expdocencia',
                                        'value' => $per_fecha_nacimiento,
                                        'type' => DatePicker::TYPE_INPUT,
                                        'options' => ["class" => "form-control PBvalidation keyupmce controlExpDocencia", "id" => "txt_ffin_expdocencia", "data-type" => "fecha", "data-keydown" => "true", "placeholder" => Yii::t("formulario", "End date") . ' ' . Yii::t("formulario", "labors")],
                                        'pluginOptions' => [
                                            'autoclose' => true,
                                            'format' => Yii::$app->params["dateByDatePicker"],
                                        ]]
                                    );
                                    ?>
                                </div>
                                <input type="checkbox" name="check_actualdocencia"  id="check_actualdocencia" value="1"> 
                                <label for="txt_actualdocencia" class=" control-label"><?= Yii::t("formulario", "Current") ?></label>

                            </div>
                        </div>                         
                    </div>                    
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <b><?= Yii::t("formulario", "Contact Information") ?></b>
                        </h4>
                    </div>
                    <div class="col-md-12"> 
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txt_tlfcontacto_expdocencia" class="col-sm-5 control-label"><?= Yii::t("formulario", "Phone") ?></label>
                                <div class="col-sm-7">
                                    <div class="input-group">
                                        <span id="lbl_codeCountryexpdocecont" class="input-group-addon"><?= $code ?></span>
                                        <input type="text" class="form-control PBvalidation keyupmce" id="txt_tlfcontacto_expdocencia" data-type="telefono_sin" data-keydown="true" placeholder="<?= Yii::t("formulario", "Phone") . ' ' . Yii::t("formulario", "Contact") ?>">
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txt_contacto_expdocencia" class="col-sm-5 control-label"><?= Yii::t("formulario", "Name") . ' ' . Yii::t("formulario", "Contact") ?></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control PBvalidation keyupmce controlExpDocencia" data-required="false" id="txt_contacto_expdocencia" data-type="alfa" data-keydown="true" placeholder="<?= Yii::t("formulario", "Name") . ' ' . Yii::t("formulario", "Contact") ?>">
                                </div>
                            </div>      
                        </div>
                    </div>
                    <div class='col-md-12'>
                        <div class='col-md-1'>        
                        </div>
                        <div class='col-md-2'>         
                            <p> <a id="btn_AgregarDataExpDoc" href="javascript:" class="btn btn-primary btn-block controlExpDocencia"> <?= Yii::t("formulario", "Add") ?></a></p>
                        </div>
                        <div class='col-md-9'>         

                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</div>

