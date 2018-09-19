<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\components\CFileInputAjax;

$leyenda = '<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
          <div class="form-group">
          <div class="col-sm-10 col-md-10 col-xs-10 col-lg-10">
          <div style = "width: 450px;" class="alert alert-info"><span style="font-weight: bold"> Nota: </span> Al subir archivo debe ser 800 KB máximo y tipo jpg, png o pdf.</div>
          </div>
          </div>
          </div>';

session_start();
$_SESSION['persona_solicita'] = base64_encode($_GET['ids']);
?>
<?= Html::hiddenInput('txth_ids', base64_encode($per_id), ['id' => 'txth_ids']); ?>
<?= Html::hiddenInput('txth_nac', base64_encode($_GET['nac']), ['id' => 'txth_nac']); ?>
<?= Html::hiddenInput('txth_extranjero', $txth_extranjero, ['id' => 'txth_extranjero']); ?>
<?= Html::hiddenInput('txth_intId', base64_encode($int_id), ['id' => 'txth_intId']); ?>
<form class="form-horizontal" enctype="multipart/form-data" id="formsolicitud">
    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
        <h3><span id="lbl_solicitud"><?= Yii::t("solicitud_ins", "Application for Registration") ?></span></h3>
    </div>
    <div class="col-md-12">    
        <br/>    
    </div>
    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="cmb_ninteres" class="col-sm-5 col-md-5 col-xs-5 col-lg-5 control-label"><?= Yii::t("formulario", "Academic unit") ?></label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <?= Html::dropDownList("cmb_ninteres", 0, array_merge([Yii::t("formulario", "Select")],$arr_unidad), ["class" => "form-control", "id" => "cmb_ninteres"]) ?>
                </div>
            </div>  
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" id="divModalidad">
            <div class="form-group">
                <label for="cmb_modalidad" class="col-sm-5 col-md-5 col-xs-5 col-lg-5 control-label"><?= Yii::t("formulario", "Mode") ?></label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <?= Html::dropDownList("cmb_modalidad", 0, array_merge([Yii::t("formulario", "Select")],$arr_modalidad), ["class" => "form-control", "id" => "cmb_modalidad"]) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="cmb_carrera" id="lbl_carrera" class="col-sm-5 col-md-5 col-xs-5 col-lg-5 control-label keyupmce"><?= Yii::t("academico", "Career") ?></label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <?= Html::dropDownList("cmb_carrera", 0, array_merge([Yii::t("formulario", "Select")],$arr_carrera), ["class" => "form-control", "id" => "cmb_carrera"]) ?>
                </div>
            </div> 
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" id="divMetodo" style="display: block">
            <div class="form-group">
                <label for="cmb_metodos" class="col-sm-5 col-md-5 col-xs-5 col-lg-5 control-label keyupmce"><?= Yii::t("solicitud_ins", "Income Method") ?></label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <?= Html::dropDownList("cmb_metodos", 0, array_merge([Yii::t("formulario", "Select")],$arr_metodos), ["class" => "form-control", "id" => "cmb_metodos"]) ?>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12" id="divBeca" style="display: none">        
        <div class="form-group">
            <label for="txt_declararbeca" class="col-sm-5 control-label"><?= Yii::t("formulario", "Apply Cala Foundation scholarship") ?></label>
            <div class="col-sm-7">  
                <label><input type="radio" name="opt_declara_si"  id="opt_declara_si" value="1"><b>Si</b></label>
                <label><input type="radio" name="opt_declara_no"  id="opt_declara_no" value="2" checked><b>No</b></label>                                              
            </div>            
        </div>        
    </div> 
    
    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12" id="divAplicaDescuento" style="display: block">               
        <div class="form-group">
            <label for="txt_declararDescuento" class="col-sm-5 control-label"><?= Yii::t("formulario", "Apply Discount") ?></label>
            <div class="col-sm-7">  
                <label><input type="radio" name="opt_declara_Dctosi"  id="opt_declara_Dctosi" value="1"><b>Si</b></label>
                <label><input type="radio" name="opt_declara_Dctono"  id="opt_declara_Dctono" value="2" checked><b>No</b></label>                                              
            </div>            
        </div>               
    </div> 
    
    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12" id="divDescuento" style="display: none">       
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="cmb_descuento" class="col-sm-5 col-md-5 col-xs-5 col-lg-5 control-label keyupmce"><?= Yii::t("formulario", "Discount") ?></label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <?= Html::dropDownList("cmb_descuento", 0, array_merge([Yii::t("formulario", "Select")],$arr_descuento), ["class" => "form-control", "id" => "cmb_descuento"]) ?>
                </div>
            </div>    
        </div>  
    </div> 
    <!--
    <div id="divDocumento" style="display: block"> 
        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
            <h4><span id="lbl_Personeria"><?= Yii::t("solicitud_ins", "Attach document") ?></span></h4>    
        </div>
        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
            <?php echo $leyenda; ?>
        </div>

        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">        
            <div class="form-group">
                <label for="txt_subirdocumentos" class="col-sm-5 control-label"><?= Yii::t("formulario", "Desea subir documentos?") ?></label>
                <div class="col-sm-7">  
                    <label><input type="radio" name="opt_subir_si"  id="opt_subir_si" value="1"><b>Si</b></label>
                    <label><input type="radio" name="opt_subir_no"  id="opt_subir_no" value="2" checked><b>No</b></label>                                              
                </div>            
            </div>        
        </div> 
    </div>
    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12" id="DivDocumentos" style="display: none;">        
        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12 doc_titulo cinteres">
            <div class="form-group">
                <label for="txth_doc_titulo" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label keyupmce"><?= Yii::t("formulario", "Titulo") ?></label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <?= Html::hiddenInput('txth_doc_titulo', '', ['id' => 'txth_doc_titulo']); ?>
                    <?php
                    echo CFileInputAjax::widget([
                        'id' => 'txt_doc_titulo',
                        'name' => 'txt_doc_titulo',
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
                            'uploadUrl' => Url::to(['/solicitudinscripcion/guardarsolinsxinteresado']),
                            'maxFileSize' => Yii::$app->params["MaxFileSize"], // en Kbytes
                            'uploadExtraData' => 'javascript:function (previewId,index) {
                return {"upload_file": true, "name_file": "doc_titulo"};
            }',
                        ],
                        'pluginEvents' => [
                            "filebatchselected" => "function (event) {
            $('#txth_doc_titulo').val($('#txt_doc_titulo').val());
            $('#txt_doc_titulo').fileinput('upload');
        }",
                            "fileuploaderror" => "function (event, data, msg) {
            $(this).parent().parent().children().first().addClass('hide');
            $('#txth_doc_titulo').val('');
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
        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12 doc_dni cinteres">
            <div class="form-group">
                <label for="txth_doc_dni" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label keyupmce"><?= Yii::t("formulario", "Identification document") ?></label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <?= Html::hiddenInput('txth_doc_dni', '', ['id' => 'txth_doc_dni']); ?>
                    <?php
                    echo CFileInputAjax::widget([
                        'id' => 'txt_doc_dni',
                        'name' => 'txt_doc_dni',
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
                            'uploadUrl' => Url::to(['/solicitudinscripcion/guardarsolinsxinteresado']),
                            'maxFileSize' => Yii::$app->params["MaxFileSize"], // en Kbytes
                            'uploadExtraData' => 'javascript:function (previewId,index) {
                return {"upload_file": true, "name_file": "doc_dni"};
            }',
                        ],
                        'pluginEvents' => [
                            "filebatchselected" => "function (event) {
            $('#txth_doc_dni').val($('#txt_doc_dni').val());
            $('#txt_doc_dni').fileinput('upload');
        }",
                            "fileuploaderror" => "function (event, data, msg) {
            $(this).parent().parent().children().first().addClass('hide');
            $('#txth_doc_dni').val('');
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

        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12 doc_certvota cinteres" <?= ($txth_extranjero == "0" || base64_decode($_GET['nac']) == "0") ? 'style="display:none;"' : "" ?> >
            <div class="form-group">
                <label for="txth_doc_certvota" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label keyupmce"><?= Yii::t("formulario", "Certificado Votación") ?></label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <?= Html::hiddenInput('txth_doc_certvota', '', ['id' => 'txth_doc_certvota']); ?>
                    <?php
                    echo CFileInputAjax::widget([
                        'id' => 'txt_doc_certvota',
                        'name' => 'txt_doc_certvota',
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
                            'uploadUrl' => Url::to(['/solicitudinscripcion/guardarsolinsxinteresado']),
                            'maxFileSize' => Yii::$app->params["MaxFileSize"], // en Kbytes
                            'uploadExtraData' => 'javascript:function (previewId,index) {
                return {"upload_file": true, "name_file": "doc_certvota"};
            }',
                        ],
                        'pluginEvents' => [
                            "filebatchselected" => "function (event) {
            $('#txth_doc_certvota').val($('#txt_doc_certvota').val());
            $('#txt_doc_certvota').fileinput('upload');
        }",
                            "fileuploaderror" => "function (event, data, msg) {
            $(this).parent().parent().children().first().addClass('hide');
            $('#txth_doc_certvota').val('');
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
        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12 doc_foto cinteres">
            <div class="form-group">
                <label for="txth_doc_foto" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label keyupmce"><?= Yii::t("formulario", "Foto") ?></label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <?= Html::hiddenInput('txth_doc_foto', '', ['id' => 'txth_doc_foto']); ?>
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
                            'browseLabel' => "Subir Archivo",
                            'uploadUrl' => Url::to(['/solicitudinscripcion/guardarsolinsxinteresado']),
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
            $('#txth_doc_adj_disi').val('');
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

        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12" id="divDeclarabeca" style="display: none;">
            <div class="form-group">
                <label for="txth_doc_beca" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label keyupmce"><?= Yii::t("formulario", "Scholarship document") ?></label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <?= Html::hiddenInput('txth_doc_beca', '', ['id' => 'txth_doc_beca']); ?>
                    <?php
                    echo CFileInputAjax::widget([
                        'id' => 'txt_doc_beca',
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
                            'browseLabel' => "Subir Archivo",
                            'uploadUrl' => Url::to(['/solicitudinscripcion/guardarsolinsxinteresado']),
                            'maxFileSize' => Yii::$app->params["MaxFileSize"], // en Kbytes
                            'uploadExtraData' => 'javascript:function (previewId,index) {
                return {"upload_file": true, "name_file": "doc_beca"};
            }',
                        ],
                        'pluginEvents' => [
                            "filebatchselected" => "function (event) {
            $('#txth_doc_beca').val($('#txt_doc_beca').val());
            $('#txt_doc_beca').fileinput('upload');
        }",
                            "fileuploaderror" => "function (event, data, msg) {
            $(this).parent().parent().children().first().addClass('hide');
            $('#txth_doc_beca').val('');
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
    
    <div class="row"> 
        <div class="col-md-9"></div>
        <div class="col-md-2 col-xs-4 col-lg-2 col-sm-2">
            <a id="sendInscripcion" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("accion", "Save") ?> </a>
        </div>
    </div>
    <?= Html::hiddenInput('txth_extranjero', $txth_extranjero, ['id' => 'txth_extranjero']); ?>
</form>
