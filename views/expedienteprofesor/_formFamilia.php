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
<!--<?= Html::hiddenInput('txth_familia', json_encode($resp_familiares), ['id' => 'txth_familia']); ?>-->
<!--<?= print_r(json_encode($resp_familiares)) ?>;-->

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
                            <label for="txt_declararfamilia" class="col-sm-5 control-label"><?= Yii::t("formulario", "Data to declare") ?></label>
                            <div class="col-sm-7">  
                                <label><input type="radio" name="opt_declara_si"  id="opt_declara_si" value="1" checked><b>Si</b></label>
                                <label><input type="radio" name="opt_declara_no"  id="opt_declara_no" value="2"><b>No</b></label>                                              
                            </div> 
                            <div class="col-md-4"> 
                            </div> 
                        </div>
                    </div>
                </div> 
                <div id="divDeclarafamiliares" style="display: block;">                    
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txt_nombres_contacto" class="col-sm-5 control-label"><?= Yii::t("formulario", "First Names") ?><span class="text-danger"></span></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control PBvalidation keyupmce" data-required="false" id="txt_nombres_contacto_fami" data-type="alfa" data-keydown="true" placeholder="<?= Yii::t("formulario", "First Names") ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txt_apellidos_contacto" class="col-sm-5 control-label"><?= Yii::t("formulario", "Last Names") ?><span class="text-danger"></span></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control PBvalidation keyupmce" data-required="false" id="txt_apellidos_contacto_fami" data-type="alfa" data-keydown="true" placeholder="<?= Yii::t("formulario", "Last Names") ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-12'>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txt_fecha_nacimiento_fami" class="col-sm-5 control-label"><?= Yii::t("formulario", "Birth Date") ?> <span class="text-danger"></span></label>
                                <div class="col-sm-7">
                                    <?=
                                    DatePicker::widget([
                                        'name' => 'txt_fecha_nacimiento_fami',
                                        'value' => $per_fecha_nacimiento,
                                        'type' => DatePicker::TYPE_INPUT,
                                        'options' => ["class" => "form-control PBvalidation keyupmce", "id" => "txt_fecha_nacimiento_fami", "data-type" => "fecha", "data-keydown" => "true", "placeholder" => Yii::t("formulario", "Birth Date yyyy-mm-dd")],
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
                                <label for="cmb_parentesco_cont_fam" class="col-sm-5 control-label"><?= Yii::t("formulario", "Kinship") ?><span class="text-danger"></span></label>
                                <div class="col-sm-7">
                                    <?= Html::dropDownList("cmb_parentesco_cont_fam", 1, $tipparent, ["class" => "form-control", "id" => "cmb_parentesco_cont_fam"]) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-12'>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txtarea_ocupacion" class="col-sm-5 control-label"><?= Yii::t("formulario", "Occupation") ?><span class="text-danger"></span></label>
                                <div class="col-sm-7">
                                    <textarea  class="form-control PBvalidation keyupmce" data-required="false" id="txtarea_ocupacion"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txt_carga_fami" class="col-sm-5 control-label"><?= Yii::t("formulario", "It is in charge of the Family") ?></label>
                                <div class="col-md-7">  
                                    <label>  <input type="radio" name="carga"  id="check_cont_fami_car_ok" value="1"><b>Si</b></label>
                                    <label>  <input type="radio" name="carga"  id="check_cont_fami_car_nok" value="0" checked><b>No</b></label>        
                                </div> 
                                <div class="col-md-4"> 
                                </div> 
                            </div>
                        </div>
                    </div>  
                    <!--<div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txth_doc_adj_fami" class="col-sm-3 control-label keyupmce"><?= Yii::t("formulario", "Attach document") ?></label>
                                <div class="col-sm-9">
                                    <?= Html::hiddenInput('txth_doc_adj_fami', '', ['id' => 'txth_doc_adj_fami']); ?>
                                    <?= Html::hiddenInput('txth_per', $per_id, ['id' => 'txth_per']); ?>
                                    <?php                                
                                    echo CFileInputAjax::widget([
                                        'id' => 'txt_doc_adj_fami',
                                        'name' => 'txt_doc_adj_fami',
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
                                            'uploadUrl' => Url::to(['/expedienteprofesor/guardartab2']),                                        
                                            'maxFileSize' => Yii::$app->params["MaxFileSize"], // en Kbytes
                                            'uploadExtraData' => 'javascript:function (previewId,index) {
                                                    var doc_familia= $("#txth_doc_adj_fami").val();
                                                    return {"upload_file": true, "name_file": doc_familia};
                                                }',                                    
                                        ],                                    
                                        'pluginEvents' => [
                                            "filebatchselected" => "function (event) {
                                                function d2(n) {
                                                if(n<9) return '0'+n;
                                                return n;
                                                }
                                                today = new Date();
                                                var doc_familia = 'familiar_' + $('#txth_per').val() + '-' + today.getFullYear() + '-' + d2(parseInt(today.getMonth()+1)) + '-' + d2(today.getDate()) + ' ' + d2(today.getHours()) + ':' + d2(today.getMinutes()) + ':' + d2(today.getSeconds());
                                                $('#txth_doc_adj_fami').val(doc_familia);                                            
                                                $('#txt_doc_adj_fami').fileinput('upload');
                                                var fileSent = $('#txt_doc_adj_fami').val();
                                                var ext = fileSent.split('.');
                                                $('#txth_doc_adj_fami').val(doc_familia + '.' + ext[ext.length - 1]);                        
                                            }",
                                            "fileuploaderror" => "function (event, data, msg) {
                                                $(this).parent().parent().children().first().addClass('hide');
                                                $('#txth_doc_adj_fami').val('');
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
                    </div> -->
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txt_discapacidad" class="col-sm-5 control-label"><?= Yii::t("formulario", "Your relative has some disability") ?></label>
                                <div class="col-sm-7">  
                                    <label><input type="radio" name="check_fami_dis_ok"  id="check_fami_dis_ok" value="1"><b>Si</b></label>
                                    <label><input type="radio" name="check_fami_dis_nok"  id="check_fami_dis_nok" value="2" checked><b>No</b></label>                                              
                                </div> 
                                <div class="col-md-4"> 
                                </div> 
                            </div>
                        </div>    
                    </div> 
                    <!-- campos que solo se habilitan si el familiar tiene discapacidad -->                        
                    <div id="discapacidad" style="display: none;" >
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cmb_tip_discap_fam" class="col-sm-5 control-label keyupmce"><?= Yii::t("bienestar", "Type Disability") ?></label>
                                <div class="col-sm-7">
                                    <?= Html::dropDownList("cmb_tip_discap_fam", 1, $tipo_discap, ["class" => "form-control", "id" => "cmb_tip_discap_fam"]) ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txt_por_discapacidad_fam" class="col-sm-5 control-label keyupmce"><?= Yii::t("bienestar", "Percentage Disability") ?></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control PBvalidation keyupmce" id="txt_por_discapacidad_fam" data-type="number" data-keydown="true" placeholder="<?= Yii::t("bienestar", "%") ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txt_carnet_con" class="col-sm-5 control-label"><?= Yii::t("formulario", "Carnet CONADIS") ?></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control PBvalidation keyupmce" id="txt_carnet_con" data-type="number" data-keydown="true" placeholder="<?= Yii::t("bienestar", "Carnet Number Conadis") ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txth_doc_adj_disi" class="col-sm-5 control-label keyupmce"><?= Yii::t("formulario", "Attach document") ?></label>
                                <div class="col-sm-7">
                                    <?= Html::hiddenInput('txth_doc_adj_disif', '', ['id' => 'txth_doc_adj_disif']); ?>
                                    <?= Html::hiddenInput('txth_per', $per_id, ['id' => 'txth_per']); ?>
                                    <?php                                
                                    echo CFileInputAjax::widget([
                                        'id' => 'txt_doc_adj_disif',
                                        'name' => 'txt_doc_adj_disif',
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
                                                    var doc_conadis= $("#txth_doc_adj_disif").val();
                                                    return {"upload_file": true, "name_file": doc_conadis};
                                                }',                                    
                                        ],                                    
                                        'pluginEvents' => [
                                            "filebatchselected" => "function (event) {
                                                function d2(n) {
                                                if(n<9) return '0'+n;
                                                return n;
                                                }
                                                today = new Date();
                                                var doc_conadis = 'conadis_' + $('#txth_per').val() + '-' + today.getFullYear() + '-' + d2(parseInt(today.getMonth()+1)) + '-' + d2(today.getDate()) + ' ' + d2(today.getHours()) + ':' + d2(today.getMinutes()) + ':' + d2(today.getSeconds());
                                                $('#txth_doc_adj_disif').val(doc_conadis);                                            
                                                $('#txt_doc_adj_disif').fileinput('upload');
                                                var fileSent = $('#txt_doc_adj_disif').val();
                                                var ext = fileSent.split('.');
                                                $('#txth_doc_adj_disif').val(doc_conadis + '.' + ext[ext.length - 1]);                        
                                            }",
                                            "fileuploaderror" => "function (event, data, msg) {
                                                $(this).parent().parent().children().first().addClass('hide');
                                                $('#txth_doc_adj_disif').val('');
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
                    </div>
                    <div class='col-md-12'>
                        <div id='rdo_ViveUsted' class="col-md-6" style="display:none;">              
                            <label for="txt_apellidos_contacto" class="col-sm-5 control-label"><?= Yii::t("formulario", "¿ Vive con usted ?") ?></label>
                            <div class="col-md-7">  
                                <div class="col-md-12"> 
                                    <div class="col-md-3"></div>  
                                    <div class="col-md-9"> 
                                        <input type="radio" name="ccc9"  id="ccc9" value="1" checked> Si
                                    </div>      
                                </div>   
                                <div class="col-md-12">    
                                    <div class="col-md-3"></div>  
                                    <div class="col-md-9"> 
                                        <input type="radio" name="ccc9"  id="ccc9" value="2"> No
                                    </div>  
                                </div>
                            </div>   
                        </div>                                                                 
                    </div>
                    <div class="col-md-12">    
                        <div class='col-md-1'>         
                        </div>
                        <div class="col-md-2">              
                            <p> <a id="btn_Agregar" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Add") ?></a></p>
                        </div>   
                        <div class="col-md-8">
                        </div>  
                    </div>
                </div>
            </div>
        </div>     	  
        <div class="col-xs-12 col-sm-2 col-md-3">            
        </div>      
    </div>    
</div>

