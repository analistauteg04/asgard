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
$otraacademico = key($arr_instituto);
array_unshift($arr_instituto, "Seleccionar");
?>
<?= Html::hiddenInput('txth_otraacademico', $otraacademico, ['id' => 'txth_otraacademico']); ?>
<div class='row'>
    <!-- Columna principal donde estan los nombres y la fotos Autor : Omar Romero Lopez-->
    <div class='col-md-12'>
        <div class="col-xs-12 col-sm-12 col-md-12 ">
            <div class='row' id='dynamic_field'>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <!-- Espacio de relleno --></br>
                </div>
                <div class="col-md-12">  
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_fecha_logro" class="col-sm-5 control-label"><?= Yii::t("formulario", "Date Achievement") ?> <span class="text-danger"></span></label>
                            <div class="col-sm-7">
                                <?=
                                DatePicker::widget([
                                    'name' => 'txt_fecha_logro',
                                    'value' => '',
                                    'type' => DatePicker::TYPE_INPUT,
                                    'options' => ["class" => "form-control PBvalidation keyupmce", "id" => "txt_fecha_logro", "data-type" => "fecha", "data-keydown" => "true", "placeholder" => Yii::t("formulario", "Date Achievement")],
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
                            <label for="cmb_pais_reconocimiento" class="col-sm-5 control-label"><?= Yii::t("formulario", "Country") ?> <span class="text-danger"></span> </label>
                            <div class="col-sm-7">
                                <select id="cmb_pais_reconocimiento" name="cmb_pais_reconocimiento" class="form-control pai_combo">
                                    <?php
                                    $code = "";
                                    foreach ($paises_nac as $key => $value) {

                                        $selected = ($pai_id_reconocimiento == $value['id']) ? "selected='seleted'" : "";
                                        if ($selected != "")
                                            $code = "+" . preg_replace('/\s+/', '', $value['code']);
                                        echo "<option value='" . $value['id'] . "' data-code='" . "+" . preg_replace('/\s+/', '', $value['code']) . "' $selected >" . $value['value'] . "</option>";
                                    }
                                    ?> 
                                </select>
                            </div>
                        </div>
                    </div>                 
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_universidad_reconocimiento" class="col-sm-5 control-label"><?= Yii::t("formulario", "Institution") ?></label>
                            <div class="col-sm-7">
                                <?= Html::dropDownList("cmb_universidad_reconocimiento", 0, $arr_instituto, ["class" => "form-control", "id" => "cmb_universidad_reconocimiento"]) ?>
                                <!--<input type="checkbox" name="check_otrainstitucionreconocimiento"  id="check_otrainstitucionreconocimiento" value="1"> 
                                <label for="lbl_otrainstitucionreconocimiento" class=" control-label"><?= Yii::t("formulario", "Other") ?></label>-->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">                    
                        <div class="form-group">
                            <label for="txt_otrainstitucionareconocimiento" class="col-sm-5 control-label"><?= Yii::t("formulario", "Other") . ' ' . Yii::t("formulario", "Institution") ?></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control PBvalidation keyupmce controlExpDocencia" data-required="false" id="txt_otrainstitucionareconocimiento" disabled ="true" data-type="alfa" data-keydown="true" placeholder="<?= Yii::t("formulario", "Other") . ' ' . Yii::t("formulario", "Institution") ?>">
                            </div>
                        </div>  
                    </div>                    
                </div>
                <div class="col-md-12">    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_reconocimiento" class="col-sm-5 control-label"><?= Yii::t("formulario", "Recognition Awarded") ?></label>
                            <div class="col-sm-7">
                                <textarea  class="form-control PBvalidation keyupmce" data-required="false" id="txt_reconocimiento"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">    
                    <div class='col-md-1'>         
                    </div>
                    <div class="col-md-2">              
                        <p> <a id="btn_AgregarReconocimiento" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Add") ?></a></p>
                    </div>   
                    <div class="col-md-8">
                    </div>  
                </div>
                                                    
            </div>
        </div>        
    </div>
</div>

