<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use app\components\CFileInputAjax;

$per_id = @Yii::$app->session->get("PB_perid");

$leyenda = '<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
          <div class="form-group">
          <div class="col-sm-10 col-md-10 col-xs-10 col-lg-10">
          <div style = "width: 500px;" class="alert alert-info"><span style="font-weight: bold"> Nota: </span> Al subir archivo debe ser 15 KB máximo y tipo xlsx o csv, seprador  ","</div>
          </div>
          </div>
          </div>';
?>
<div class="col-md-12">    
    <h3><span id="lbl_titulo"><?= Yii::t("formulario", "Carga Historial Marcaciones") ?></span><br/>    
</div>
<div class="col-md-12">    
    <br/>    
</div>
<form class="form-horizontal" enctype="multipart/form-data" >
    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
        <?php echo $leyenda; ?>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">         
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">            
                <label for="txth_doc_archivo" class="col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label"><?= Yii::t("formulario", "Attach document") ?> <span class="text-danger">*</span></label>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?= Html::hiddenInput('txth_per', $per_id, ['id' => 'txth_per']); ?>
                    <?= Html::hiddenInput('txth_doc_archivo', '', ['id' => 'txth_doc_archivo']); ?>
                    <?= Html::hiddenInput('txth_doc_archivo_ruta', '', ['id' => 'txth_doc_archivo_ruta']); ?>
                    <?php
                    echo CFileInputAjax::widget([
                        'id' => 'txt_doc_archivo',
                        'name' => 'txt_doc_archivo',
                        'disabled' => '',
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
                            'uploadUrl' => Url::to(['/marcacionhistorico/marcacionhistorico/cargarmarcaciones']), // CABIAR RUTA QUE ES
                            'maxFileSize' => Yii::$app->params["MaxFileSize"], // en Kbytes
                            'uploadExtraData' => 'javascript:function (previewId,index) {
                                    var name_doc= $("#txt_doc_archivo").val();
                                    var modelo=$("#cmb_modelo_evi option:selected").text();
                                    var funcion=$("#cmb_funcion_evi option:selected").text();
                                    var componente=$("#cmb_componente_evi option:selected").text();
                                    var estandar=$("#cmb_estandar_evi option:selected").text();
                                    var tipo=$("#cmb_tipo_evi option:selected").text();
                                    
                                    return {"upload_file": true, 
                                            "name_file": name_doc,
                                            "modelo": modelo,
                                            "funcion": funcion,
                                            "componente": componente,
                                            "estandar": estandar,
                                            "tipo": tipo};
                                    
                            }',
                        ],
                        'pluginEvents' => [
                            "filebatchselected" => "function (event) { 
                                    function d2(n) {
                                        if(n<9) return '0'+n;
                                        return n;
                                    }
                                    today = new Date();
                                    var name_pago = 'pago_' + $('#txth_per').val() + '-' + today.getFullYear() + '-' + d2(parseInt(today.getMonth()+1)) + '-' + d2(today.getDate()) + ' ' + d2(today.getHours()) + ':' + d2(today.getMinutes()) + ':' + d2(today.getSeconds());
                                    //$('#txth_docarchivo').val(name_pago);
                                    
                                    if($('#cmb_modelo_evi').val() != 0 && $('#cmb_funcion_evi').val() != 0 && $('#txth_docarchivo').val() != ''
                                        && $('#cmb_estandar_evi').val() != 0 && $('#cmb_tipo_evi').val() != 0 && $('#txt_fecha_documento_evi').val() != ''){
                                        $('#txt_doc_archivo').fileinput('upload');
                                    }else{
                                        showAlert('NO_OK', 'error', {'wtmessage': 'No Existe datos Selecionados ', 'title':'Información'});
                                        $('#txt_doc_archivo').fileinput('clear');
                                        $('#txt_doc_archivo').fileinput('refresh');
                                    }
        
                                    
                                    
                                    //var fileSent = $('#txt_doc_archivo').val();
                                    //var ext = fileSent.split('.');
                                    //$('#txth_doc_archivo').val(name_pago + '.' + ext[ext.length - 1]);
                        }",
                            "fileuploaderror" => "function (event, data, msg) {
                                    $(this).parent().parent().children().first().addClass('hide');
                                    $('#txth_doc_archivo').val('');
                                    $('#txth_doc_archivo_ruta').val('');
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
                                response = data.response
                                $('#txth_doc_archivo').val('');
                                $('#txth_doc_archivo_ruta').val('');
                                if(response.status){
                                    $('#txth_doc_archivo').val(response.nombre);
                                    $('#txth_doc_archivo_ruta').val(response.ruta);
                                }
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
    
</form>

