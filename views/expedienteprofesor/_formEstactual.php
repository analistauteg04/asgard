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
$otractual = key($arr_instituto);
array_unshift($arr_instituto, "Seleccionar");
?>
<?= Html::hiddenInput('txth_otraactual', $otractual, ['id' => 'txth_otraactual']); ?>
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
                            <label for="lbl_nivel_instru" class="col-sm-5 control-label"><?= Yii::t("formulario", "Instructional Level") ?> <span class="text-danger"></span> </label>
                            <div class="col-sm-7">
                                <?= Html::dropDownList("cmb_nivel_instru_act", 0, $arr_nivinstruccion, ["class" => "form-control can_combo", "id" => "cmb_nivel_instru_act"]) ?>
                            </div>
                        </div>
                    </div>  
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cmb_pais_actual" class="col-sm-5 control-label"><?= Yii::t("formulario", "Country") ?> <span class="text-danger"></span> </label>
                            <div class="col-sm-7">
                                <select id="cmb_pais_actual" name="cmb_pais_actual" class="form-control pai_combo">
                                    <?php
                                    $code = "";
                                    foreach ($paises_nac as $key => $value) {

                                        $selected = ($pai_id_actual == $value['id']) ? "selected='seleted'" : "";
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
                            <label for="txt_universidad_institucionactual" class="col-sm-5 control-label"><?= Yii::t("formulario", "Institution") ?></label>
                            <div class="col-sm-7">
                                <?= Html::dropDownList("cmb_universidad_institucionactual", 0, $arr_instituto, ["class" => "form-control", "id" => "cmb_universidad_institucionactual"]) ?>
                                <!--<input type="checkbox" name="check_otrainstitucionactual"  id="check_otrainstitucionactual" value="1"> 
                                <label for="lbl_otrainstitucionactual" class=" control-label"><?= Yii::t("formulario", "Other") ?></label>-->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">                    
                        <div class="form-group">
                            <label for="txt_otrainstitucionactual" class="col-sm-5 control-label"><?= Yii::t("formulario", "Other") . ' ' . Yii::t("formulario", "Institution") ?></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control PBvalidation keyupmce controlExpDocencia" data-required="false" id="txt_otrainstitucionactual" disabled ="true" data-type="alfa" data-keydown="true" placeholder="<?= Yii::t("formulario", "Other") . ' ' . Yii::t("formulario", "Institution") ?>">
                            </div>
                        </div>  
                    </div>                    
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_areaconocimiento" class="col-sm-5 control-label"><?= Yii::t("formulario", "Knowledge Area") ?></label>
                            <div class="col-sm-7">
                                <?= Html::dropDownList("cmb_area_conocimientoea", 0, $arr_conocimiento, ["class" => "form-control", "id" => "cmb_area_conocimientoea"]) ?>                                
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-6">                    
                        <div class="form-group">
                            <label for="txt_subareaconocimiento" class="col-sm-5 control-label"><?= Yii::t("formulario", "Knowledge Sub Area") ?></label>
                            <div class="col-sm-7">
                                <?= Html::dropDownList("cmb_subarea_conocimientoea", 0, $arr_subarea, ["class" => "form-control", "id" => "cmb_subarea_conocimientoea"]) ?>
                            </div>
                        </div>  
                    </div>                                      
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_titulo" class="col-sm-5 control-label"><?= Yii::t("formulario", "Title Obtained") ?></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control PBvalidation keyupmce" data-required="false" id="txt_titulo_act" data-type="alfa" data-keydown="true" placeholder="<?= Yii::t("formulario", "Title Obtained") ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_fecha_ingreso" class="col-sm-5 control-label"><?= Yii::t("formulario", "Date Entry") ?> <span class="text-danger"></span></label>
                            <div class="col-sm-7">
                                <?=
                                DatePicker::widget([
                                    'name' => 'txt_fecha_ingreso',
                                    'value' => '',
                                    'type' => DatePicker::TYPE_INPUT,
                                    'options' => ["class" => "form-control PBvalidation keyupmce", "id" => "txt_fecha_ingreso", "data-type" => "fecha", "data-keydown" => "true", "placeholder" => Yii::t("formulario", "Date Entry")],
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
                            <label for="txth_doc_adj_actual" class="col-md-5 control-label keyupmce"><?= Yii::t("formulario", "Attach document") ?></label>
                            <div class="col-md-7">
                                <?= Html::hiddenInput('txth_doc_adj_actual', '', ['id' => 'txth_doc_adj_actual']); ?>
                                <?= Html::hiddenInput('txth_per', $per_id, ['id' => 'txth_per']); ?>
                                <?php
                                echo CFileInputAjax::widget([
                                    'id' => 'txt_doc_adj_actual',
                                    'name' => 'txt_doc_adj_actual',
                                    'pluginLoading' => false,
                                    'showMessage' => false,
                                    'pluginOptions' => [
                                        'showPreview' => false,
                                        'showCaption' => true,
                                        'showRemove' => true,
                                        'showUpload' => false,
                                        'showCancel' => false,
                                        'browseClass' => 'btn btn-primary btn-block',
                                        'browseIcon' => '<i class="fa fa-folder-open"></i> ',
                                        'browseLabel' => "Subir Archivo",
                                        'uploadUrl' => Url::to(['/expedienteprofesor/guardar']),                                        
                                        'maxFileSize' => Yii::$app->params["MaxFileSize"], // en Kbytes
                                        'uploadExtraData' => 'javascript:function (previewId,index) {
                                                var doc_estactual= $("#txth_doc_adj_actual").val();
                                                return {"upload_file": true, "name_file": doc_estactual};
                                            }',                                     
                                    ],                                    
                                    'pluginEvents' => [
                                        "filebatchselected" => "function (event) {
                                                     function d2(n) {
                                                        if(n<9) return '0'+n;
                                                        return n;
                                                        }
                                                        today = new Date();
                                                        var doc_estactual = 'estudio_actual_' + $('#txth_per').val() + '-' + today.getFullYear() + '-' + d2(parseInt(today.getMonth()+1)) + '-' + d2(today.getDate()) + ' ' + d2(today.getHours()) + ':' + d2(today.getMinutes()) + ':' + d2(today.getSeconds());
                                                        $('#txth_doc_adj_actual').val(doc_estactual);                                            
                                                        $('#txt_doc_adj_actual').fileinput('upload');
                                                        var fileSent = $('#txt_doc_adj_actual').val();
                                                        var ext = fileSent.split('.');
                                                        $('#txth_doc_adj_actual').val(doc_estactual + '.' + ext[ext.length - 1]);
                                                }",
                                        "fileuploaderror" => "function (event, data, msg) {
                                                    $(this).parent().parent().children().first().addClass('hide');
                                                    $('#txth_doc_adj_actual').val('');
                                                    //showAlert('NO_OK', 'error', {'wtmessage': objLang.Error_to_process_File__Try_again_, 'title': objLang.Error});   
                                                }",
                                        "filebatchuploadcomplete" => "function (event, files, extra) { 
                                                    $(this).parent().parent().children().first().addClass('hide');
                                                }",
                                        "filebatchuploadsuccess" => "function (event, data, previewId, index) {
                                                    var form = data.form, files = data.files, extra = data.extra,
                                                    response = data.response, reader = data.reader;
                                                    $(this).parent().parent().children().first().addClass('hide');
                                                    var acciones = [{id: 'reloadpage', class: 'btn btn-primary', value: objLang.Accept, callback: 'reloadPage'}];
                                                    //showAlert('OK', 'Success', {'wtmessage': objLang.File_uploaded_successfully__Do_you_refresh_the_web_page_, 'title': objLang.Success, 'acciones': acciones});  
                                                }",
                                        "fileuploaded" => "function (event, data, previewId, index) {
                                                    $(this).parent().parent().children().first().addClass('hide');
                                                    var acciones = [{id: 'reloadpage', class: 'btn btn-primary', value: objLang.Accept, callback: 'reloadPage'}];
                                                    //showAlert('OK', 'Success', {'wtmessage': objLang.File_uploaded_successfully__Do_you_refresh_the_web_page_, 'title': objLang.Success, 'acciones': acciones});                              
                                                }",
                                    ],
                                ]);
                                ?>
                            </div>
                        </div>                                                     
                    </div>                     
                </div>
                <div class="col-sm-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_msj_alerta_avatar" class="col-sm-12 control-label text-center lbltxtTamañoImgAvatar"><span class="text-danger">*</span><?= Yii::t("formulario", "Adjunte certificado de los estudios que está realizando actualmente.") ?></label>                
                        </div> 
                    </div>
                </div>
                <div class='col-md-12'>
                    <div class='col-md-1'>         

                    </div>
                    <div class='col-md-2'>         
                        <p> <a id="btn_AgregarEstActual" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Agregar") ?></a></p>
                    </div>
                    <div class='col-md-9'>         

                    </div>
                </div>
            </div>
        </div>        
    </div>
</div>

