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

$valorcheck = 1;
$icomprension = '';
?>



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
                            <label for="txt_nombre_lenguaje" class="col-sm-5 control-label"><?= Yii::t("formulario", "Know some language") ?></label>
                            <div class="col-sm-7">
                                <label>                
                                    <input type="radio" name="rdb_nativo" id="rdb_nativo" value="1" checked> Si<br>                   
                                </label>
                                <label>            
                                    <input type="radio" name="rdb_nativo_no" id="rdb_nativo_no" value="2"> No<br>
                                </label>
                            </div> 
                            <!--<div class="col-sm-7">
                                <input type="text" class="form-control PBvalidation keyupmce" data-required="false" id="txt_nombre_lenguaje" data-type="alfa" data-keydown="true" placeholder="<?= Yii::t("formulario", "Name Language") ?>">
                                <div class="col-sm-7">
                                    <input type="checkbox" name="check_idiomaNativo"  id="check_idiomaNativo" value="1" checked> 
                                    <label for="txt_idionanativo" class=" control-label"><?= Yii::t("formulario", "Native language") ?></label>
                                </div>
                            </div>-->
                        </div>
                    </div>                    
                </div>
                <div id="nlenguaje" style="display: block;" >  
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txt_nombre_lenguaje" class="col-sm-5 control-label"><?= Yii::t("formulario", "Name Language") ?></label>
                                <div class="col-sm-7">
                                    <?= Html::dropDownList("cmb_nombre_lenguaje", 0, $arr_lenguaje, ["class" => "form-control", "id" => "cmb_nombre_lenguaje"]) ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txt_otro_lenguaje" class="col-sm-5 control-label"><?= Yii::t("formulario", "Another language") ?></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control PBvalidation keyupmce" data-required="false" id="txt_otro_lenguaje" data-type="alfa" disabled="true" data-keydown="true" placeholder="<?= Yii::t("formulario", "Another language") ?>">
                                </div>
                            </div>
                        </div>
                     </div>      
                     <div class="col-md-12">   
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txt_insti_certifica" class="col-sm-5 control-label"><?= Yii::t("formulario", "Institution certifies") ?></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control PBvalidation keyupmce" data-required="false" id="txt_insti_certifica" data-type="alfa" data-keydown="true" placeholder="<?= Yii::t("formulario", "Institution certifies") ?>">
                                </div>
                            </div>
                        </div>
                    </div>                        
                    <div class="col-md-12"> 
                        <!-- AQUI EMPIEZA FOR-->  
                        <?php $compresion_idioma = array(Yii::t("formulario", "Speaking"), Yii::t("formulario", "Written"), Yii::t("formulario", "Reading"), Yii::t("formulario", "Auditive")); ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr align="center" style="font-weight: bold;"> 
                                    <td><?= Yii::t("formulario", "Comprehension") ?></td>
                                    <td><?= Yii::t("formulario", "Basic") ?></td>
                                    <td><?= Yii::t("formulario", "Intermediate") ?></td>
                                    <td><?= Yii::t("formulario", "Advanced") ?></td>
                                </tr>
                            </thead>
                            <?php for ($i = 0; $i < count($compresion_idioma); $i++) { ?>
                                <tr align="center">   
                                    <td><b><?php echo $compresion_idioma[$i]; ?></b></td>
                                    <?php
                                    for ($j = 1; $j < 4; $j++) {
                                        switch ($valorcheck) {
                                            case ($valorcheck < 4):
                                                $icomprension = 'hablado';
                                                break;

                                            case (($valorcheck >= 4) && ($valorcheck <= 6)):
                                                $icomprension = 'escrito';
                                                break;

                                            case (($valorcheck >= 7) && ($valorcheck <= 9)):
                                                $icomprension = 'lectura';
                                                break;

                                            case ($valorcheck > 9):
                                                $icomprension = 'auditiva';
                                                break;
                                        }
                                        ?>                                    
                                        <td><input type="radio" class="check_idiomasComprension" name="<?php echo 'check_nivel_' . $icomprension; ?>"  id="<?php echo 'check_nivel_' . $valorcheck; ?>" value="<?php echo $valorcheck; ?>"> </td> 
                                        <?php
                                        $valorcheck ++;
                                    }
                                    ?>  
                                </tr>                      
                            <?php } ?>
                        </table> 
                        <!-- AQUI TERMINA FOR-->
                    </div>  
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txth_doc_idioma" class="col-md-5 control-label keyupmce"><?= Yii::t("formulario", "Attach Certificates") ?></label>
                                <div class="col-md-7">
                                    <?= Html::hiddenInput('txth_doc_idioma', '', ['id' => 'txth_doc_idioma']); ?>
                                    <?= Html::hiddenInput('txth_per', $per_id, ['id' => 'txth_per']); ?>
                                    <?php
                                    echo CFileInputAjax::widget([
                                        'id' => 'txt_doc_idioma',
                                        'name' => 'txt_doc_idioma',
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
                                                var doc_idiomas= $("#txth_doc_idioma").val();
                                                return {"upload_file": true, "name_file": doc_idiomas};
                                            }',  
                                        ],                                        
                                        'pluginEvents' => [
                                            "filebatchselected" => "function (event) {
                                                    function d2(n) {
                                                        if(n<9) return '0'+n;
                                                        return n;
                                                        }
                                                        today = new Date();
                                                        var doc_idiomas = 'idiomas_' + $('#txth_per').val() + '-' + today.getFullYear() + '-' + d2(parseInt(today.getMonth()+1)) + '-' + d2(today.getDate()) + ' ' + d2(today.getHours()) + ':' + d2(today.getMinutes()) + ':' + d2(today.getSeconds());
                                                        $('#txth_doc_idioma').val(doc_idiomas);                                            
                                                        $('#txt_doc_idioma').fileinput('upload');
                                                        var fileSent = $('#txt_doc_idioma').val();
                                                        var ext = fileSent.split('.');
                                                        $('#txth_doc_idioma').val(doc_idiomas + '.' + ext[ext.length - 1]);
                                                }",
                                            "fileuploaderror" => "function (event, data, msg) {
                                                    $(this).parent().parent().children().first().addClass('hide');
                                                    $('#txth_doc_idioma').val('');
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
                        <div class="col-md-12">    
                            <div class='col-md-1'>         
                            </div>
                            <div class="col-md-2">              
                                <p> <a id="btn_AgregarIdioma" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Add") ?></a></p>
                            </div>   
                            <div class="col-md-8">
                            </div>  
                        </div>                        
                        
                    </div>
                    <div class="col-md-12"><br/></div>
                </div>
                
            </div>   
        </div>       
    </div>     
</div>

