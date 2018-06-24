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
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <!-- Espacio de relleno --></br>
                    <div class="form-group">
                        <label for="txt_investigacion" class="col-sm-5 control-label"><?= Yii::t("formulario", "He has investigations") ?></label>
                        <div class="col-sm-7">
                            <label>                
                                <input type="radio" name="check_investigacionOK" id="check_investigacionOK" value="1" checked> Si<br>                   
                            </label>
                            <label>            
                                <input type="radio" name="check_investigacionNOK" id="check_investigacionNOK" value="2" > No<br>
                            </label>
                        </div> 
                    </div>
                </div>
                
                <div id="investigacion" style="display: block;" >   
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <!-- Espacio de relleno --><br>
                        <div class="form-group">
                             <div class="col-md-6">
                                <label for="txt_financiada" class="col-sm-5 control-label"><?= Yii::t("formulario", "Financed") ?></label>
                                <div class="col-sm-7">
                                    <label>                
                                        <input type="radio" name="check_financiadaOK" id="check_financiadaOK" value="1" > Si<br>                   
                                    </label>
                                    <label>            
                                        <input type="radio" name="check_financiadaNOK" id="check_financiadaNOK" value="2" checked> No<br>
                                    </label>
                                </div> 
                            </div>
                            <div class="col-md-6">
                                <label for="txt_institucion_financia" class="col-sm-5 control-label"><?= Yii::t("formulario", "Institution Financing") ?></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control PBvalidation keyupmce controlExpDocencia" data-required="false" id="txt_institucion_financia" data-type="alfa" disabled="false" data-keydown="true" placeholder="<?= Yii::t("formulario", "Institution Financing") ?>">
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12"> 
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txt_nombre_proyecto" class="col-sm-5 control-label"><?= Yii::t("formulario", "Project Name") ?></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control PBvalidation keyupmce controlExpDocencia" data-required="false" id="txt_nombre_proyecto" data-type="alfa" data-keydown="true" placeholder="<?= Yii::t("formulario", "Project Name") ?>">
                                </div>
                            </div>
                        </div> 
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txt_rolproyecto" class="col-sm-5 control-label"><?= Yii::t("formulario", "Project Role") ?></label>
                                <div class="col-sm-7"> 
                                    <?= Html::dropDownList("cmb_rol_proyecto", 0, $arr_rolproyecto, ["class" => "form-control", "id" => "cmb_rol_proyecto"]) ?>                                    
                                </div>
                            </div>
                        </div>                                                
                    </div>               
                    <div class="col-md-12">                       
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txt_finicio_investigacion" class="col-sm-5 control-label"><?= Yii::t("formulario", "Start date") . ' ' . Yii::t("formulario", "Investigation") ?><span class="text-danger"></span></label>
                                <div class="col-sm-7">
                                    <?=
                                    DatePicker::widget([
                                        'name' => 'txt_finicio_investigacion',
                                        'value' => $per_fecha_nacimiento,
                                        'type' => DatePicker::TYPE_INPUT,
                                        'options' => ["class" => "form-control PBvalidation keyupmce controlExpDocencia", "id" => "txt_finicio_investigacion", "data-type" => "fecha", "data-keydown" => "true", "placeholder" => Yii::t("formulario", "Start date") . ' ' . Yii::t("formulario", "Investigation")],
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
                                <label for="txt_ffin_investigacion" class="col-sm-5 control-label"><?= Yii::t("formulario", "End date") . ' ' . Yii::t("formulario", "Investigation") ?> <span class="text-danger"></span></label>
                                <div class="col-sm-5">
                                    <?=
                                    DatePicker::widget([
                                        'name' => 'txt_ffin_investigacion',
                                        'value' => $per_fecha_nacimiento,
                                        'type' => DatePicker::TYPE_INPUT,
                                        'options' => ["class" => "form-control PBvalidation keyupmce controlExpDocencia", "id" => "txt_ffin_investigacion", "data-type" => "fecha", "data-keydown" => "true", "placeholder" => Yii::t("formulario", "End date") . ' ' . Yii::t("formulario", "Investigation")],
                                        'pluginOptions' => [
                                            'autoclose' => true,
                                            'format' => Yii::$app->params["dateByDatePicker"],
                                        ]]
                                    );
                                    ?>
                                </div>
                                <input type="checkbox" name="check_actualinvestigacion"  id="check_actualinvestigacion" value="1"> 
                                <label for="txt_actualinvestigacion" class=" control-label"><?= Yii::t("formulario", "Progress") ?></label>

                            </div>
                        </div> 
                    </div>                    
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txth_doc_investigacion" class="col-md-5 control-label keyupmce"><?= Yii::t("formulario", "Attach document") ?></label>
                                <div class="col-md-7">
                                    <?= Html::hiddenInput('txth_ddoc_investigacion', '', ['id' => 'txth_ddoc_investigacion']); ?>
                                    <?= Html::hiddenInput('txth_per', $per_id, ['id' => 'txth_per']); ?>
                                    <?php
                                    echo CFileInputAjax::widget([
                                        'id' => 'txt_doc_investigacion',
                                        'name' => 'txt_doc_investigacion',
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
                                                var doc_investigacion= $("#txth_ddoc_investigacion").val();
                                                return {"upload_file": true, "name_file": doc_investigacion};
                                            }',  
                                        ],                                        
                                        'pluginEvents' => [
                                            "filebatchselected" => "function (event) {
                                                    function d2(n) {
                                                        if(n<9) return '0'+n;
                                                        return n;
                                                        }
                                                        today = new Date();
                                                        var doc_investigacion = 'investigacion_' + $('#txth_per').val() + '-' + today.getFullYear() + '-' + d2(parseInt(today.getMonth()+1)) + '-' + d2(today.getDate()) + ' ' + d2(today.getHours()) + ':' + d2(today.getMinutes()) + ':' + d2(today.getSeconds());
                                                        $('#txth_ddoc_investigacion').val(doc_investigacion);                                            
                                                        $('#txt_doc_investigacion').fileinput('upload');
                                                        var fileSent = $('#txt_doc_investigacion').val();
                                                        var ext = fileSent.split('.');
                                                        $('#txth_ddoc_investigacion').val(doc_investigacion + '.' + ext[ext.length - 1]);
                                                }",
                                            "fileuploaderror" => "function (event, data, msg) {
                                                                            $(this).parent().parent().children().first().addClass('hide');
                                                                            $('#txth_ddoc_investigacion').val('');
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
                        <div class='col-md-1'>        
                        </div>
                        <div class='col-md-2'>         
                            <p> <a id="btn_AgregarInvestigacion" href="javascript:" class="btn btn-primary btn-block controlExpDocencia"> <?= Yii::t("formulario", "Add") ?></a></p>
                        </div>
                        <div class='col-md-9'>         

                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</div>

