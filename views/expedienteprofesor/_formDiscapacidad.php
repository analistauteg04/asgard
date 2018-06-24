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
use kartik\date\DatePicker;
use yii\helpers\Url;
use app\components\CFileInputAjax;
?>

<div class='row'>
    <div class="col-xs-12 col-sm-12 col-md-12 ">              
        <div class="col-xs-12 col-sm-12 col-md-12">
            <!-- Espacio de relleno --></br>
            <div class="form-group">
                <div class="col-sm-12">
                    <label for="txt_discapacidad" class="col-sm-5 control-label"><?= Yii::t("bienestar", "¿Do you have any type of disability?") ?></label>
                    <label>
                        <input type="radio" name="rdb_discapacidadOK-dis" id="rdb_discapacidadOK" value="1"  <?php
                        if (!empty($resp_discapacidad)) {
                            echo 'checked';
                        }
                        ?>> Si<br>
                    </label>
                    <label>
                        <input type="radio" name="signup-rdb_discapacidadNOK" id="rdb_discapacidadNOK" value="2"  <?php
                        if (empty($resp_discapacidad)) {
                            echo 'checked';
                        }
                        ?>> No<br>
                    </label>    
                </div>
                <!--<label for="txt_discapacidad" class="col-sm-5 control-label"><?= Yii::t("bienestar", "¿Do you have any type of disability?") ?></label>
                <div class="col-sm-7">
                    <label>                
                        <input type="radio" name="rdb_discapacidadOK" id="rdb_discapacidadOK" value="1" > Si<br>                   
                    </label>
                    <label>            
                        <input type="radio" name="rdb_discapacidadNOK" id="rdb_discapacidadNOK" value="2" checked> No<br>
                    </label>
                </div> -->
            </div>
        </div>       
        <?php if (!empty($resp_discapacidad)) { ?>
        <div id="adicional" style="display: block;" >
        <?php } else { ?>
        <div id="adicional" style="display: none;" >
        <?php } ?>
            <div class="col-md-12">
                <div class="form-group">
                    <div class="col-md-6">
                        <label for="cmb_tip_discap" class="col-sm-5 control-label keyupmce"><?= Yii::t("bienestar", "Type Disability") ?></label>
                        <div class="col-sm-7">
                            <?= Html::dropDownList("cmb_tip_discap", $resp_discapacidad["tipo_discapacidad"], $tipo_discap, ["class" => "form-control", "id" => "cmb_tip_discap"]) ?>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="txt_por_discapacidad" class="col-sm-5 control-label keyupmce"><?= Yii::t("bienestar", "Percentage Disability") ?></label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control PBvalidation keyupmce" id="txt_por_discapacidad" value="<?= $resp_discapacidad["porcentaje"] ?>" data-type="number" data-keydown="true" placeholder="<?= Yii::t("bienestar", "Percentage Disability") ?>">
                        </div>
                    </div>
                </div>
            </div>
                                        
            <div class="col-md-12">
                <div class="form-group">
                    <div class="col-md-6">
                        <label for="txt_carnet_conadis" class="col-sm-5 control-label keyupmce"><?= Yii::t("formulario", "Número Carnet Conadis") ?></label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control PBvalidation keyupmce" id="txt_carnet_conadis" value="<?= $resp_discapacidad["carnet"] ?>" data-type="number" data-keydown="true" placeholder="<?= Yii::t("bienestar", "Número Carnet Conadis") ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="txth_doc_adj_disi" class="col-sm-5 control-label keyupmce"><?= Yii::t("formulario", "Attach document") ?></label>
                        <div class="col-sm-7">
                            <?= Html::hiddenInput('txth_doc_adj_disc', '', ['id' => 'txth_doc_adj_disc']); ?>
                            <?= Html::hiddenInput('txth_per', $per_id, ['id' => 'txth_per']); ?>
                            <?php
                            echo CFileInputAjax::widget([
                                'id' => 'txt_doc_adj_disc',
                                'name' => 'txt_doc_adj_disc',
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
                                                    var doc_discapacidad= $("#txth_doc_adj_disc").val();
                                                    return {"upload_file": true, "name_file": doc_discapacidad};
                                                }',  
                                            ],                                        
                                            'pluginEvents' => [
                                                "filebatchselected" => "function (event) {
                                                        function d2(n) {
                                                            if(n<9) return '0'+n;
                                                            return n;
                                                            }
                                                            today = new Date();
                                                            var doc_discapacidad = 'discapacidad_' + $('#txth_per').val() + '-' + today.getFullYear() + '-' + d2(parseInt(today.getMonth()+1)) + '-' + d2(today.getDate()) + ' ' + d2(today.getHours()) + ':' + d2(today.getMinutes()) + ':' + d2(today.getSeconds());
                                                            $('#txth_doc_adj_disc').val(doc_discapacidad);                                            
                                                            $('#txt_doc_adj_disc').fileinput('upload');
                                                            var fileSent = $('#txt_doc_adj_disc').val();
                                                            var ext = fileSent.split('.');
                                                            $('#txth_doc_adj_disc').val(doc_discapacidad + '.' + ext[ext.length - 1]);
                                                    }",
                                    "fileuploaderror" => "function (event, data, msg) {
                                                        $(this).parent().parent().children().first().addClass('hide');
                                                        $('#txth_doc_adj_disc').val('');
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
        <!--   Fin de Discapacidad-->
    </div>  
</div>
