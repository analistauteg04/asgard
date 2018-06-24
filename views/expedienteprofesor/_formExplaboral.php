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

//print_r($paises_nac);
?>
<div class='row'>
    <!-- Columna principal donde estan los nombres y la fotos Autor : Omar Romero Lopez-->
    <div class='col-md-12'>
        <div class="col-xs-12 col-sm-12 col-md-12 ">
            <div class='row' id='dynamic_field'>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <!-- Espacio de relleno --></br>
                    <div class="form-group">
                        <label for="lbl_ExpLaboral" class="col-sm-5 control-label"><?= Yii::t("formulario", "Are You Currently Working") ?></label>
                        <div class="col-sm-7">
                            <label>                
                                <input type="radio" name="rdo_laboralActual" id="rdo_laboralActual" value="1" checked> Si<br>                   
                            </label>
                            <label>            
                                <input type="radio" name="rdo_laboralActual_no" id="rdo_laboralActual_no" value="2" > No<br>
                            </label>
                        </div> 
                    </div>
                </div>  
                <div id="explabora" style="display: block;" >
                    <div class='col-md-12'>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cmb_pais_expl" class="col-sm-5 control-label"><?= Yii::t("formulario", "Country") ?> <span class="text-danger"></span> </label>
                                <div class="col-sm-7">
                                    <select id="cmb_pais_expl" name="cmb_pais_expl" class="form-control pai_combo">
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
                                <label for="txt_nombrecompania" class="col-sm-5 control-label"><?= Yii::t("formulario", "Company/Institution") ?> <span class="text-danger"></span> </label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control PBvalidation keyupmce" id="txt_nombrecompania" data-type="alfanumerico" data-keydown="true" placeholder="<?= Yii::t("formulario", "Company Name/Institution") ?>">
                                </div>
                            </div>
                        </div>                        
                    </div>   
                    <div class='col-md-12'>                        
                        <!--<div class="col-md-6">
                            <div class="form-group">
                                <label for="cmb_prov_expl" class="col-sm-5 control-label"><?= Yii::t("formulario", "State") ?> <span class="text-danger"></span> </label>
                                <div class="col-sm-7">
                        <?= Html::dropDownList("cmb_prov_expl", $pro_id_expl, $provincias_nac, ["class" => "form-control", "id" => "cmb_prov_expl"]) ?>
                                </div>
                            </div>
                        </div>-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txt_tipo_compania" class="col-sm-5 control-label keyupmce"><?= Yii::t("formulario", "Company Type/Institution") ?><span class="text-danger"></span> </label>
                                <div class="col-sm-7">
                                    <?= Html::dropDownList("cmb_tipo_compania", 0, $tip_instaca_med, ["class" => "form-control", "id" => "cmb_tipo_compania"]) ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txt_cargo" class="col-sm-5 control-label"><?= Yii::t("formulario", "Charges") ?><span class="text-danger"></span> </label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control PBvalidation keyupmce" id="txt_cargo" data-type="alfanumerico" data-keydown="true" placeholder="<?= Yii::t("formulario", "Charges Play") ?>">
                                </div>
                            </div>                        
                        </div>
                    </div>
                    <div class='col-md-12'>
                        <!--<div class="col-md-6">
                            <div class="form-group">
                                <label for="cmb_ciu_expl" class="col-sm-5 control-label"><?= Yii::t("formulario", "City") ?> <span class="text-danger"></span> </label>
                                <div class="col-sm-7">
                        <?= Html::dropDownList("cmb_ciu_expl", $can_id_expl, $cantones_nac, ["class" => "form-control", "id" => "cmb_ciu_expl"]) ?>
                                </div>
                            </div>
                        </div>-->                       
                    </div>
                    <div class='col-md-12'>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txt_fecha_inicioexpl" class="col-sm-5 control-label"><?= Yii::t("formulario", "Start date") ?><span class="text-danger"></span></label>
                                <div class="col-sm-7">
                                    <?=
                                    DatePicker::widget([
                                        'name' => 'txt_fecha_inicioexpl',
                                        'value' => $per_fecha_nacimiento,
                                        'type' => DatePicker::TYPE_INPUT,
                                        'options' => ["class" => "form-control PBvalidation keyupmce", "id" => "txt_fecha_inicioexpl", "data-type" => "fecha", "data-keydown" => "true", "placeholder" => Yii::t("formulario", "Fecha Inicio")],
                                        'pluginOptions' => [
                                            'autoclose' => true,
                                            'format' => Yii::$app->params["dateByDatePicker"],
                                        ]]
                                    );
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txt_fecha_finexpl" class="col-sm-5 control-label"><?= Yii::t("formulario", "End date") ?><span class="text-danger"></span></label>
                                <div class="col-sm-5">
                                    <?=
                                    DatePicker::widget([
                                        'name' => 'txt_fecha_finexpl',
                                        'value' => $per_fecha_nacimiento,
                                        'type' => DatePicker::TYPE_INPUT,
                                        'options' => ["class" => "form-control PBvalidation keyupmce", "id" => "txt_fecha_finexpl", "data-type" => "fecha", "data-keydown" => "true", "placeholder" => Yii::t("formulario", "Fecha Fin")],
                                        'pluginOptions' => [
                                            'autoclose' => true,
                                            'format' => Yii::$app->params["dateByDatePicker"],
                                        ]]
                                    );
                                    ?>
                                </div>                                
                                <input type="checkbox" name="check_actuallaboral"  id="check_actuallaboral" value="1"> 
                                <label for="txt_actuallaboral" class=" control-label"><?= Yii::t("formulario", "Current") ?></label>

                            </div>                           
                        </div>                                                
                    </div>  
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <b><?= Yii::t("formulario", "Contact Information") ?></b>
                        </h4>
                    </div>
                    <div class='col-md-12'>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txt_inst_med" class="col-sm-5 control-label"><?= Yii::t("formulario", "Phone") ?></label>
                                <div class="col-sm-7">
                                    <div class="input-group">
                                        <span id="lbl_codeCountryexpl" class="input-group-addon"><?= $code ?></span>
                                        <input type="text" class="form-control PBvalidation keyupmce" id="txt_inst_med" data-type="telefono_sin" data-keydown="true" placeholder="<?= Yii::t("formulario", "Phone Company/Institution") ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txt_inst_cont" class="col-sm-5 control-label"><?= Yii::t("formulario", "Contact") ?></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control PBvalidation keyupmce" id="txt_inst_cont" data-type="alfa" data-keydown="true" placeholder="<?= Yii::t("formulario", "Company/Institution Contact") ?>">
                                </div>
                            </div>
                        </div>
                    </div>  
                    <div class='col-md-12'>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txt_tlf_inst_cont" class="col-sm-5 control-label"><?= Yii::t("formulario", "Phone") . ' ' . Yii::t("formulario", "Contact") ?></label>
                                <div class="col-sm-7">
                                    <div class="input-group">
                                        <span id="lbl_codeCountryexpl1" class="input-group-addon"><?= $code ?></span>
                                        <input type="text" class="form-control PBvalidation keyupmce" id="txt_tlf_inst_cont" data-type="telefono_sin" data-keydown="true" placeholder="<?= Yii::t("formulario", "Phone Contact Company/Institution") ?>">
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>  
                    <div class='col-md-12'>
                        <div class='col-md-1'>        
                        </div>
                        <div class='col-md-2'>         
                            <p> <a id="btn_AgregarDataExpLab" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Add") ?></a></p>
                        </div>
                        <div class='col-md-9'>         

                        </div>
                    </div>                    
                </div>
            </div>
        </div>   
    </div>
</div>

