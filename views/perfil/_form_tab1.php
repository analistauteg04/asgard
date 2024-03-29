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
    <div class="col-md-12">
        <h3><span id="lbl_Personeria"><?= Yii::t("formulario", "Data Personal") ?></span></h3>
    </div>
</div>
<div class='row'>
    <!-- Columna princiapl donde estan los nombres y la fotos Autor : Omar Romero Lopez-->
    <div class='col-md-12'>    
        <div class="col-xs-12 col-sm-10 col-md-12 ">
            <div class='row'>
                <div class="col-xs-12 col-sm-12 col-md-12">                    
                    <div class="col-xs-6 col-sm-6 col-md-6">
                           <div class="col-md-12">
                                 <div class="row">
                                    <div class="form-group">

                                            <div class="col-sm-7">
                                                </br>
                                            </div>        
                                    </div>
                                 </div>
                            </div>
                            <div class="col-md-12">
                                 <div class="row">
                                    <div class="form-group">
                                            <label for="txt_primer_nombre" class="col-sm-5 control-label"> <?= Yii::t("formulario", "First Name") ?> <span class="text-danger">*</span></label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control PBvalidation keyupmce" value="<?= $per_pri_nombre ?>" id="txt_primer_nombre" data-type="alfa" data-keydown="true" placeholder="<?= Yii::t("formulario", "First Name") ?>"> 
                                            </div>        
                                    </div>
                                 </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group">
                                            <label for="txt_segundo_nombre" class="col-sm-5 control-label"><?= Yii::t("formulario", "Middle Name") ?></label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control keyupmce" value="<?= $per_seg_nombre ?>" id="txt_segundo_nombre" data-type="alfa" data-keydown="true" placeholder="<?= Yii::t("formulario", "Middle Name") ?>">
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group">
                                        <label for="txt_primer_nombre" class="col-sm-5 control-label"> <?= Yii::t("formulario", "Last Name2") ?> <span class="text-danger">*</span></label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control PBvalidation keyupmce" value="<?= $per_pri_apellido ?>" id="txt_primer_apellido" data-type="alfa" data-keydown="true" placeholder="<?= Yii::t("formulario", "Last Name") ?>">
                                        </div>        
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group">
                                        <label for="txt_segundo_nombre" class="col-sm-5 control-label"><?= Yii::t("formulario", "Last Second Name1") ?><span class="text-danger">*</span></label>
                                        <div class="col-sm-7">
                                        <input type="text" class="form-control keyupmce" value="<?= $per_seg_apellido ?>" id="txt_segundo_apellido" data-type="alfa" data-keydown="true" placeholder="<?= Yii::t("formulario", "Last Second Name") ?>">
                                        </div>
                                    </div>
                                </div>
                            </div> 

                    </div>
                    
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="row">
                            <div class="col-sm-1">                                
                            </div>
                            <div class="col-sm-10">
                                <div class="col-sm-12 text-center">
                                    <input id="files" class="col-sm-12" style="visibility:hidden;" type="file">                            
                                </div>  
                                <div class="col-sm-12 text-center">
                                <img src="<?= Url::base(). '/site/getimage/?route='.$per_foto ?>" width="135px" height="135px" id='img_destino' class="img-circle" alt="User Image" />
                                     
                                    <!-- https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTs8lPPHhK9VPELO2BbHfSCmWSU9JQv6elO_xDTZWSVQN4kRuIE -->
                                </div>
                                <div class="col-sm-12 text-center">
                                </br>
                                </div> 
                            
                                <div class="col-sm-12 text-center">                                    
                                    <div class="col-md-12 ">
                                        <div class="form-group">                                        
                                            <div class="col-sm-12">
                                                <?= Html::hiddenInput('txth_doc_foto', $per_foto, ['id' => 'txth_doc_foto']); ?>
                                                <?php
                                                echo CFileInputAjax::widget([
                                                    'id' => 'txt_doc_foto',
                                                    'name' => 'txt_doc_foto',                    
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
                                                        'browseLabel' => "Subir Foto",
                                                        'uploadUrl' => Url::to(['/perfil/guardartab1']),
                                                        'maxFileSize' => Yii::$app->params["MaxFileSize"], // en Kbytes
                                                        'uploadExtraData' => 'javascript:function (previewId,index) {
                                            return {"upload_file": true, "name_file": "doc_foto"};
                                        }',
                                                    ],
                                                    'pluginEvents' => [
                                                        "filebatchselected" => "function (event) {
                                        $('#txth_doc_foto').val($('#txt_doc_foto').val());
                                        $('#txt_doc_foto').fileinput('upload');
                                    }",
                                                        "fileuploaderror" => "function (event, data, msg) {
                                        $(this).parent().parent().children().first().addClass('hide');
                                        $('#txth_doc_foto').val('');
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
                                        <label for="txt_msj_alerta_avatar" class="col-sm-12 control-label text-center lbltxtTamañoImgAvatar"><span class="text-danger">*</span><?= Yii::t("formulario", "La imagen no debe ser superior a 100px de ancho y 100px de altura") ?></label>
                                </div>                                 
                            </div>
                            <div class="col-sm-1">                        
                            </div>                          
                        </div>
                    </div>                                  
                </div>                   
            </div>
        </div>
    </div>
</div>

<div class='row'>
    <!-- Columna principal donde estan los nombres y la fotos Autor : Omar Romero Lopez-->
    <hr>
    <div class='col-md-12'>
        <div class="col-xs-12 col-sm-10 col-md-12 ">
            <div class='row'>
                <div class="col-md-12">
                    <div class="col-md-6">                                 
                        <div class="form-group">
                            <label for="cmb_tipo_dni" class="col-sm-5 control-label keyupmce"><?= Yii::t("formulario", "Type DNI") ?> <span class="text-danger">*</span> </label>
                            <div class="col-sm-7">
                                <?= Html::dropDownList("cmb_tipo_dni", $tipodoc, $tipos_dni, ["class" => "form-control", "id" => "cmb_tipo_dni", 'disabled' => "true"]) ?>
                            </div>
                        </div>
                              
                    </div>
                    <div class="col-md-6">                                
                        <div class="form-group">
                            <label for="txt_cedula" class="col-sm-5 control-label"><?= Yii::t("formulario", "DNI") ?> <span class="text-danger">*</span> </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control keyupmce" value="<?= $per_cedula ?>" id="txt_cedula" disabled  data-type="cedula" data-keydown="true" placeholder="<?= Yii::t("formulario", "National identity document") ?>">
                            </div>
                        </div>                                
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cmb_raza_etnica" class="col-sm-5 control-label"><?= Yii::t("formulario", "Ethnic") ?> <span class="text-danger">*</span> </label>
                            <div class="col-sm-7">
                            <?= Html::dropDownList("cmb_raza_etnica", $etn_id, $etnica, ["class" => "form-control", "id" => "cmb_raza_etnica"]) ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_otra_etnia" class="col-sm-5 control-label"><?= Yii::t("formulario", "Ethnic Others") ?> </label>
                            <div class="col-sm-7">
                                <input type="text"  class="form-control keyupmce" value="<?= $otraetnia ?>" id="txt_otra_etnia" disabled ="true"  data-type="alfanumerico" data-keydown="true" placeholder="<?= Yii::t("formulario", "Ethnic Others") ?>">
                            </div>
                        </div>
                    </div>                    
                </div>  
                <div class="col-md-12"> 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cmb_genero" class="col-sm-5 control-label"><?= Yii::t("formulario", "Gender") ?> <span class="text-danger">*</span> </label>
                            <div class="col-sm-7">
                            <?= Html::dropDownList("cmb_genero", $per_genero, $genero, ["class" => "form-control", "id" => "cmb_genero"]) ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_fecha_nacimiento" class="col-sm-5 control-label"><?= Yii::t("formulario", "Birth Date") ?> <span class="text-danger">*</span></label>
                            <div class="col-sm-7">
                                <?=
                                DatePicker::widget([
                                    'name' => 'txt_fecha_nacimiento',
                                    'value' => $per_fecha_nacimiento,
                                    'type' => DatePicker::TYPE_INPUT,
                                    'options' => ["class" => "form-control PBvalidation keyupmce", "id" => "txt_fecha_nacimiento", "data-type" => "fecha", "data-keydown" => "true", "placeholder" => Yii::t("formulario", "Birth Date yyyy-mm-dd")],
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
                            <label for="txt_nacionalidad" class="col-sm-5 control-label"><?= Yii::t("formulario", "Nationality") ?> <span class="text-danger">*</span> </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control PBvalidation keyupmce" id="txt_nacionalidad" value="<?= $per_nacionalidad ?>" data-type="alfanumerico" data-keydown="true" placeholder="<?= Yii::t("formulario", "Nationality") ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cmb_pais_nac" class="col-sm-5 control-label"><?= Yii::t("formulario", "Country of birth") ?> <span class="text-danger">*</span> </label>
                            <div class="col-sm-7">                                    
                                <select id="cmb_pais_nac" name="cmb_pais_nac" class="form-control pai_combo">
                                    <?php
                                        $code = "";
                                        foreach ($paises_nac as $key => $value) {                                        
                                            $selected = ($pai_id_nacimiento == $value['id']) ? "selected='seleted'" : "";
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
                            <label for="cmb_prov_nac" class="col-sm-5 control-label"><?= Yii::t("formulario", "State of birth") ?> <span class="text-danger">*</span> </label>
                            <div class="col-sm-7">
                                <?= Html::dropDownList("cmb_prov_nac", $pro_id_nacimiento, $provincias_nac, ["class" => "form-control pro_combo", "id" => "cmb_prov_nac"]) ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cmb_ciu_nac" class="col-sm-5 control-label"><?= Yii::t("formulario", "City of birth") ?> <span class="text-danger">*</span> </label>
                            <div class="col-sm-7">
                                <?= Html::dropDownList("cmb_ciu_nac", $can_id_nacimiento, $cantones_nac, ["class" => "form-control can_combo", "id" => "cmb_ciu_nac"]) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_ftem_correo" class="col-sm-5 control-label"><?= Yii::t("formulario", "Email1") ?> <span class="text-danger">*</span> </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control PBvalidation keyupmce" value="<?= $per_correo ?>" id="txt_ftem_correo" data-type="email" data-keydown="true" placeholder="<?= Yii::t("formulario", "Email") ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_ftem_correo1" class="col-sm-5 control-label"><?= Yii::t("formulario", "Email2") ?> <span class="text-danger">*</span> </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control PBvalidation keyupmce" value="<?= $per_corInstitucional ?>" id="txt_ftem_correo1" data-type="email" data-keydown="true" placeholder="<?= Yii::t("formulario", "Email") ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_estado_civil" class="col-sm-5 control-label"><?= Yii::t("formulario", "Marital Status") ?> <span class="text-danger">*</span> </label>
                            <div class="col-sm-7">
                                    <?= Html::dropDownList("txt_estado_civil", $eciv_id, $estado_civil, ["class" => "form-control", "id" => "txt_estado_civil"]) ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cmb_tipo_sangre" class="col-sm-5 control-label"><?= Yii::t("formulario", "Blood Type") ?><span class="text-danger">*</span></label>
                                <div class="col-sm-7">
                                <?= Html::dropDownList("cmb_tipo_sangre", $tsan_id, $tipos_sangre, ["class" => "form-control", "id" => "cmb_tipo_sangre"]) ?>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_celular" class="col-sm-5 control-label"><?= Yii::t("formulario", "CellPhone") ?></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control PBvalidation keyupmce" value="<?= $per_celular ?>" data-required="false" id="txt_celular" data-type="celular_sin" data-keydown="true" placeholder="<?= Yii::t("formulario", "CellPhone") ?>">
                            </div>
                        </div>
                    </div>
                </div>
<!--***************************** Informacion de Domicilio ***********************************************-->  
                <div class="col-md-12">
                    <h3><span id="lbl_Personeria"><?= Yii::t("formulario", "Data Address") ?></span></h3>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cmb_pais_dom" class="col-sm-5 control-label"><?= Yii::t("formulario", "Country") ?> <span class="text-danger">*</span> </label>
                            <div class="col-sm-7">                                
                                <select id="cmb_pais_dom" name="cmb_pais_dom" class="form-control pai_combo">
                                    <?php
                                        $code = "";
                                        foreach ($paises_dom as $key => $value) {
                                            $selected = ($pai_id_domicilio == $value['id']) ? "selected='seleted'" : "";
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
                            <label for="cmb_prov_dom" class="col-sm-5 control-label"><?= Yii::t("formulario", "State") ?> <span class="text-danger">*</span> </label>
                            <div class="col-sm-7">
                                <?= Html::dropDownList("cmb_prov_dom", $pro_id_domicilio, $provincias_dom, ["class" => "form-control", "id" => "cmb_prov_dom"]) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cmb_ciu_dom" class="col-sm-5 control-label"><?= Yii::t("formulario", "City") ?> <span class="text-danger">*</span> </label>
                            <div class="col-sm-7">
                                <?= Html::dropDownList("cmb_ciu_dom", $can_id_domicilio, $cantones_dom, ["class" => "form-control", "id" => "cmb_ciu_dom"]) ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_telefono_dom" class="col-sm-5 control-label"><?= Yii::t("formulario", "Phone") ?> <span class="text-danger">*</span> </label>
                            <div class="col-sm-7">
                                <div class="input-group">
                                    <span id="lbl_codeCountrydom" class="input-group-addon"><?= $code ?></span>
                                    <input type="text" class="form-control PBvalidation keyupmce" value="<?= $per_domicilio_telefono ?>" id="txt_telefono_dom" data-type="telefono_sin" data-keydown="true" placeholder="<?= Yii::t("formulario", "Phone") ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_sector_dom" class="col-sm-5 control-label"><?= Yii::t("formulario", "Sector") ?> <span class="text-danger">*</span> </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control PBvalidation keyupmce" value="<?= $sector ?>" id="txt_sector_dom" data-type="alfanumerico" data-keydown="true" placeholder="<?= Yii::t("formulario", "Sector") ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_cprincipal_dom" class="col-sm-5 control-label"><?= Yii::t("formulario", "Main Street") ?> <span class="text-danger">*</span> </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control PBvalidation keyupmce" value="<?= $per_domicilio_cpri ?>" id="txt_cprincipal_dom" data-type="alfanumerico" data-keydown="true" placeholder="<?= Yii::t("formulario", "Main Street") ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_csecundaria_dom" class="col-sm-5 control-label"><?= Yii::t("formulario", "High Street") ?> <span class="text-danger">*</span> </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control PBvalidation keyupmce" value="<?= $secundaria ?>" id="txt_csecundaria_dom" data-type="alfanumerico" data-keydown="true" placeholder="<?= Yii::t("formulario", "High Street") ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_numeracion_dom" class="col-sm-5 control-label"><?= Yii::t("formulario", "Numeration") ?></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control PBvalidation keyupmce" data-required="false" value="<?= $per_domicilio_num ?>" id="txt_numeracion_dom" data-type="numeracion" data-keydown="true" placeholder="<?= Yii::t("formulario", "Numeration") ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_referencia_dom" class="col-sm-5 control-label"><?= Yii::t("formulario", "Reference") ?> <span class="text-danger">*</span> </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control PBvalidation keyupmce" value="<?= $per_domicilio_ref ?>" id="txt_referencia_dom" data-type="alfanumerico" data-keydown="true" placeholder="<?= Yii::t("formulario", "Reference") ?>">
                            </div>
                        </div>
                    </div>
                </div>        
               
<!--***************************** Fin de Informacion de contacto ***********************************************-->  
                <div class="row">
                    <div class="col-md-12">
                        <h3>Información Contacto: </br><span id="lbl_ContactoEmerge2"><?= Yii::t("formulario", "En caso de emergencia contactarse con:") ?></span></h3>
                    </div>
                </div>

                <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txt_nombres_contacto" class="col-sm-5 control-label"><?= Yii::t("formulario", "First Names") ?></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control PBvalidation keyupmce"  value="<?= $cgen_nombre ?>"  data-required="false" id="txt_nombres_contacto" data-type="alfa" data-keydown="true" placeholder="<?= Yii::t("formulario", "First Names") ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txt_apellidos_contacto" class="col-sm-5 control-label"><?= Yii::t("formulario", "Last Names") ?></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control PBvalidation keyupmce"  value="<?= $cgen_apellido ?>" data-required="false" id="txt_apellidos_contacto" data-type="alfa" data-keydown="true" placeholder="<?= Yii::t("formulario", "Last Names") ?>">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_telefono_con" class="col-sm-5 control-label"><?= Yii::t("formulario", "Phone") ?></label>      
                            <div class="col-sm-7">
                                <div class="input-group">
                                    <span id="lbl_codeCountrycon" class="input-group-addon"><?= $code ?></span>
                                    <input type="text" class="form-control PBvalidation keyupmce" data-required="false" value="<?= $cgen_telefono ?>" id="txt_telefono_con" data-type="telefono_sin" data-keydown="true" placeholder="<?= Yii::t("formulario", "Phone") ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_celular_con" class="col-sm-5 control-label"><?= Yii::t("formulario", "CellPhone") ?></label>        
                            <div class="col-sm-7">
                                <div class="input-group">
                                    <span id="lbl_codeCountrycell" class="input-group-addon"><?= $code ?></span>
                                    <input type="text" class="form-control PBvalidation keyupmce"  data-required="false"  value="<?= $cgen_celular ?>" id="txt_celular_con" data-type="celular_sin" data-keydown="true" placeholder="<?= Yii::t("formulario", "CellPhone") ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">     
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_address_con" class="col-sm-5 control-label"><?= Yii::t("formulario", "Address") ?></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control PBvalidation keyupmce" value="<?= $cgen_direccion ?>" data-required="false" id="txt_address_con" data-type="alfanumerico" data-keydown="true" placeholder="<?= Yii::t("formulario", "Address") ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cmb_parentesco_con" class="col-sm-5 control-label"><?= Yii::t("formulario", "Kinship") ?></label>
                            <div class="col-sm-7">
                                <?= Html::dropDownList("cmb_parentesco_con", $tpar_id , [0 => 'Esposo', 1 => 'Esposa',  2 => 'Hijo',3 => 'Hija', 4 => 'Padre',  5 => 'Madre',6 => 'Abuelo',  7 => 'Abuela', 8 => 'Hermano',9 => 'Hermano',10 => 'Otro'], ["class" => "form-control", "id" => "cmb_parentesco_con"]) ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12"> 
                    <div class="col-md-10"></div>
                    <div class="col-md-2">
                        <a id="paso1next" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Save") ?> </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">       
        </div>       
    </div>
</div>

