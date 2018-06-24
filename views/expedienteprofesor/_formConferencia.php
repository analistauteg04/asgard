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
$otraconferencia = key($arr_instituto);
array_unshift($arr_instituto, "Seleccionar");
?>
<?= Html::hiddenInput('txth_otraconferencia', $otraconferencia, ['id' => 'txth_otraconferencia']); ?>
<div class='row'>
    <!-- Columna principal donde estan los nombres y la fotos Autor : Omar Romero Lopez-->
    <div class='col-md-12'>
        <div class="col-xs-12 col-sm-12 col-md-12 ">
            <div class='row' id='dynamic_field'>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <!-- Espacio de relleno --><br>
                </div>             
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_nombrevento" class="col-sm-5 control-label keyupmce"><?= Yii::t("formulario", "Event Name") ?> <span class="text-danger"></span> </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control PBvalidation keyupmce" id="txt_nombrevento" data-type="alfanumerico" data-keydown="true" placeholder="<?= Yii::t("formulario", "Event Name") ?>">                             
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cmb_pais_evento" class="col-sm-5 control-label"><?= Yii::t("formulario", "Country") ?> <span class="text-danger"></span> </label>
                            <div class="col-sm-7">
                                <select id="cmb_pais_evento" name="cmb_pais_evento" class="form-control pai_combo">
                                    <?php
                                    $code = "";
                                    foreach ($paises_nac as $key => $value) {

                                        $selected = ($pai_id_evento == $value['id']) ? "selected='seleted'" : "";
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
                            <label for="txt_institucionevento" class="col-sm-5 control-label"><?= Yii::t("formulario", "Institution") ?></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control PBvalidation keyupmce controlExpDocencia" data-required="false" id="txt_institucionevento" data-type="alfa" data-keydown="true" placeholder="<?= Yii::t("formulario", "Institution") ?>">
                                <!--<?= Html::dropDownList("cmb_universidad_institucionevento", 0, $arr_instituto, ["class" => "form-control", "id" => "cmb_universidad_institucionevento"]) ?> -->
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_areaconocimiento" class="col-sm-5 control-label"><?= Yii::t("formulario", "Knowledge Area") ?></label>
                            <div class="col-sm-7">
                                <?= Html::dropDownList("cmb_area_conocimiento_conf", 0, $arr_conocimiento, ["class" => "form-control", "id" => "cmb_area_conocimiento_conf"]) ?>                                
                            </div>
                        </div>
                    </div>                     
                </div> 
                <div class="col-md-12">   
                     <div class="col-md-6">                    
                        <div class="form-group">
                            <label for="txt_tipo_participacion" class="col-sm-5 control-label"><?= Yii::t("formulario", "Type Participation") ?></label>
                            <div class="col-sm-7">
                                <?= Html::dropDownList("cmb_tipo_participacion", 0, $arr_tipo_participacion, ["class" => "form-control", "id" => "cmb_tipo_participacion"]) ?>                                
                            </div>
                        </div>  
                    </div> 
                    <div class="col-md-6">                    
                        <div class="form-group">
                            <label for="txt_ponencia" class="col-sm-5 control-label"><?= Yii::t("formulario", "Presentation") ?></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control PBvalidation keyupmce controlExpDocencia" data-required="false" id="txt_ponencia" data-type="alfa" data-keydown="true" placeholder="<?= Yii::t("formulario", "Presentation") ?>">
                            </div>
                        </div>  
                    </div>                      
                </div>   
                <div class='col-md-12'>                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txth_doc_ponencia" class="col-md-5 control-label keyupmce"><?= Yii::t("formulario", "Attach") ?></label>
                            <div class="col-md-7">
                                <?= Html::hiddenInput('txth_doc_ponencia', '', ['id' => 'txth_doc_ponencia']); ?>
                                <?= Html::hiddenInput('txth_per', $per_id, ['id' => 'txth_per']); ?>
                                <?php
                                echo CFileInputAjax::widget([
                                    'id' => 'txt_doc_ponencia',
                                    'name' => 'txt_doc_ponencia',
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
                                                var doc_ponencia= $("#txth_doc_ponencia").val();
                                                return {"upload_file": true, "name_file": doc_ponencia};
                                            }',  
                                        ],                                        
                                        'pluginEvents' => [
                                            "filebatchselected" => "function (event) {
                                                    function d2(n) {
                                                        if(n<9) return '0'+n;
                                                        return n;
                                                        }
                                                        today = new Date();
                                                        var doc_ponencia = 'ponencia_' + $('#txth_per').val() + '-' + today.getFullYear() + '-' + d2(parseInt(today.getMonth()+1)) + '-' + d2(today.getDate()) + ' ' + d2(today.getHours()) + ':' + d2(today.getMinutes()) + ':' + d2(today.getSeconds());
                                                        $('#txth_doc_ponencia').val(doc_ponencia);                                            
                                                        $('#txt_doc_ponencia').fileinput('upload');
                                                        var fileSent = $('#txt_doc_ponencia').val();
                                                        var ext = fileSent.split('.');
                                                        $('#txth_doc_ponencia').val(doc_ponencia + '.' + ext[ext.length - 1]);
                                                }",
                                        "fileuploaderror" => "function (event, data, msg) {
                                                                            $(this).parent().parent().children().first().addClass('hide');
                                                                            $('#txth_doc_ponencia').val('');
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
                            <label for="txt_msj_alerta_avatar" class="col-sm-12 control-label text-center lbltxtTamañoImgAvatar"><span class="text-danger">*</span><?= Yii::t("formulario", "Adjunte evidencia de la conferencia realizada.") ?></label>                
                        </div> 
                    </div>
                </div>
                <div class='col-md-12'>
                    <div class='col-md-1'>        
                    </div>
                    <div class='col-md-2'>         
                        <p> <a id="btn_AgregarConferencia" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Add") ?></a></p>
                    </div>
                    <div class='col-md-9'>         
                    </div>
                </div>  
                                
            </div>
        </div>        
    </div>
</div>
