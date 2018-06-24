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
?>
<div class='row'>
    <!-- Columna principal donde estan los nombres y la fotos Autor : Omar Romero Lopez-->
    <div class='col-md-12'>
        <div class="col-xs-12 col-sm-12 col-md-12 ">
            <div class='row' id='dynamic_field'>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <!-- Espacio de relleno --></br>
                </div>
                <div class='col-md-12'>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_nombre_curso" class="col-sm-5 control-label"><?= Yii::t("formulario", "Course/Training") ?> <span class="text-danger">*</span> </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control PBvalidation keyupmce" id="txt_nombre_curso" data-type="alfanumerico" data-keydown="true" placeholder="<?= Yii::t("formulario", "Course/Training") ?>">
                            </div>
                        </div>
                    </div>                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_tip_curso" class="col-sm-5 control-label keyupmce"><?= Yii::t("formulario", "Type") . ' ' . Yii::t("formulario", "Training") ?> <span class="text-danger">*</span> </label>
                            <div class="col-sm-7">
                                <?= Html::dropDownList("cmb_tipo_curso", 0, $arr_tipcapacitacion, ["class" => "form-control can_combo", "id" => "cmb_tipo_curso"]) ?>
                            </div>
                        </div>
                    </div>   
                </div>
                <div class='col-md-12'>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_modalidad" class="col-sm-5 control-label keyupmce"><?= Yii::t("formulario", "Mode") ?> <span class="text-danger">*</span> </label>
                            <div class="col-sm-7">
                                <?= Html::dropDownList("cmb_modalidad", 0, $arr_modalidad, ["class" => "form-control can_combo", "id" => "cmb_modalidad"]) ?>
                            </div>
                        </div>
                    </div>    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_inst_organiza" class="col-sm-5 control-label"><?= Yii::t("formulario", "Organizing institution") ?><span class="text-danger">*</span> </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control PBvalidation keyupmce" id="txt_inst_organiza" data-type="alfanumerico" data-keydown="true" placeholder="<?= Yii::t("formulario", "Organizing institution") ?>">
                            </div>
                        </div>
                    </div> 
                </div>
                <div class='col-md-12'>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_tip_diploma" class="col-sm-5 control-label keyupmce"><?= Yii::t("formulario", "Diploma type") ?> <span class="text-danger">*</span> </label>
                            <div class="col-sm-7">
                                <?= Html::dropDownList("cmb_tip_diploma", 0, $arr_tipodiploma, ["class" => "form-control can_combo", "id" => "cmb_tip_diploma"]) ?>
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_duracion_hora" class="col-sm-5 control-label"><?= Yii::t("formulario", "Duration hours") ?><span class="text-danger">*</span> </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control PBvalidation keyupmce" id="txt_duracion_hora" data-type="alfanumerico" data-keydown="true" placeholder="<?= Yii::t("formulario", "Duration hours") ?>">
                            </div>
                        </div>
                    </div>   
                </div> 
                <div class='col-md-12'>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_fecha_iniciocap" class="col-sm-5 control-label">Fecha Inicio <span class="text-danger">*</span></label>
                            <div class="col-sm-7">
                                <?=
                                DatePicker::widget([
                                    'name' => 'fecha_iniciocap',
                                    'value' => $per_fecha_nacimiento,
                                    'type' => DatePicker::TYPE_INPUT,
                                    'options' => ["class" => "form-control PBvalidation keyupmce", "id" => "fecha_iniciocap", "data-type" => "fecha", "data-keydown" => "true", "placeholder" => Yii::t("formulario", "Start date")],
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
                            <label for="txt_fecha_fincap" class="col-sm-5 control-label">Fecha Fin <span class="text-danger"></span></label>
                            <div class="col-sm-5">
                                <?=
                                DatePicker::widget([
                                    'name' => 'txt_fecha_fincap',
                                    'value' => $per_fecha_nacimiento,
                                    'type' => DatePicker::TYPE_INPUT,
                                    'options' => ["class" => "form-control PBvalidation keyupmce", "id" => "txt_fecha_fincap", "data-type" => "fecha", "data-keydown" => "true", "placeholder" => Yii::t("formulario", "End date")],
                                    'pluginOptions' => [
                                        'autoclose' => true,
                                        'format' => Yii::$app->params["dateByDatePicker"],
                                    ]]
                                );
                                ?>
                            </div>
                            <input type="checkbox" name="check_actualcapacitacion"  id="check_actualcapacitacion" value="1"> 
                            <label for="txt_actualcapacitacion" class=" control-label"><?= Yii::t("formulario", "Current") ?></label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txth_doc_adj_disi" class="col-md-5 control-label keyupmce"><?= Yii::t("formulario", "Attach Certificates") ?><span class="text-danger">*</span></label>
                            <div class="col-md-7">
                                <?= Html::hiddenInput('txth_doc_capacitacion', '', ['id' => 'txth_doc_capacitacion']); ?>
                                <?= Html::hiddenInput('txth_per', $per_id, ['id' => 'txth_per']); ?>
                                <?php
                                echo CFileInputAjax::widget([
                                    'id' => 'txt_doc_capacitacion',
                                    'name' => 'txt_doc_capacitacion',
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
                                        //'allowedFileExtensions' => ['jpg', 'png'],
                                        'maxFileSize' => Yii::$app->params["MaxFileSize"], // en Kbytes
                                        'uploadExtraData' => 'javascript:function (previewId,index) {
                                                var doc_capacitacion= $("#txth_doc_capacitacion").val();
                                                return {"upload_file": true, "name_file": doc_capacitacion};
                                            }',  
                                    ],
                                    //'options' => ['accept' => 'image/*'],
                                    'pluginEvents' => [
                                        "filebatchselected" => "function (event) {
                                                 function d2(n) {
                                                        if(n<9) return '0'+n;
                                                        return n;
                                                        }
                                                        today = new Date();
                                                        var doc_capacitacion = 'capacitacion_' + $('#txth_per').val() + '-' + today.getFullYear() + '-' + d2(parseInt(today.getMonth()+1)) + '-' + d2(today.getDate()) + ' ' + d2(today.getHours()) + ':' + d2(today.getMinutes()) + ':' + d2(today.getSeconds());
                                                        $('#txth_doc_capacitacion').val(doc_capacitacion);                                            
                                                        $('#txt_doc_capacitacion').fileinput('upload');
                                                        var fileSent = $('#txt_doc_capacitacion').val();
                                                        var ext = fileSent.split('.');
                                                        $('#txth_doc_capacitacion').val(doc_capacitacion + '.' + ext[ext.length - 1]);
                                                }",
                                        "fileuploaderror" => "function (event, data, msg) {
                                                    $(this).parent().parent().children().first().addClass('hide');
                                                    $('#txth_doc_doc_acapacitacion').val('');
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
                <div class='col-md-12'>

                    <div class="col-sm-6">                          
                        <div class="col-md-2">              
                        </div> 
                        <div class="col-md-4">              
                            <p> <a id="btn_AgregarCapacitacion" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Add") ?></a></p>
                        </div>   

                    </div>
                </div>
            </div>
        </div>        
    </div>
</div>
