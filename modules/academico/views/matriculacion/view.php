<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
use app\widgets\PbSearchBox\PbSearchBox;
use app\models\Utilities;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use app\modules\academico\Module as academico;
use app\components\CFileInputAjax;
academico::registerTranslations();

?>

<form class="form-horizontal">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label class="col-lg-6 col-md-6 col-sm-6 col-xs-6 control-label"><?= academico::t("matriculacion", "Student") ?></label>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 control-label" style="text-align: left;">
                    <?= $data_student['pes_nombres'] ?>
                </div>
            </div>
        </div> 
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label class="col-lg-6 col-md-6 col-sm-6 col-xs-6 control-label"><?= academico::t("matriculacion", "DNI") ?></label>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 control-label" style="text-align: left;">
                    <?= $data_student['pes_dni'] ?>
                </div>
            </div>
        </div> 
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label class="col-lg-6 col-md-6 col-sm-6 col-xs-6 control-label"><?= academico::t("matriculacion", "Career") ?></label>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 control-label" style="text-align: left;">
                    <?= $data_student['pes_carrera'] ?>
                </div>
            </div>
        </div> 
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label class="col-lg-6 col-md-6 col-sm-6 col-xs-6 control-label"><?= academico::t("matriculacion", "Phone") ?></label>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 control-label" style="text-align: left;">
                    <?= $data_student['per_celular'] ?>
                </div>
            </div>
        </div> 
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label class="col-lg-6 col-md-6 col-sm-6 col-xs-6 control-label"><?= academico::t("matriculacion", "Academic Period") ?></label>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 control-label" style="text-align: left;">
                    <?= $data_student['pla_periodo_academico'] ?>
                </div>
            </div>
        </div> 
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label class="col-lg-6 col-md-6 col-sm-6 col-xs-6 control-label"><?= academico::t("matriculacion", "Academic Unit") ?></label>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 control-label" style="text-align: left;">
                    <?= Academico::t("matriculacion", "Modality") ?> <?= $data_student['mod_nombre'] ?>
                </div>
            </div>
        </div> 
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txth_up_hoja" class="col-lg-6 col-md-6 col-sm-6 col-xs-6 control-label"><?= academico::t("matriculacion", "Upload registration") ?></label>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 control-label" style="text-align: left;">
                    <?= Html::hiddenInput('txth_up_hoja', '', ['id' => 'txth_up_hoja']); ?>
                    <?= Html::hiddenInput('txth_up_hoja2', '', ['id' => 'txth_up_hoja2']); ?>
                    <?php
                    echo CFileInputAjax::widget([
                        'id' => 'txt_up_hoja',
                        'name' => 'txt_up_hoja',
                        'disabled' => 'true',
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
                            'uploadUrl' => Url::to(['matriculacion/updatepagoregistro']),
                            // 'maxFileSize' => Yii::$app->params["MaxFileSize"],
                            'uploadExtraData' => 'javascript:function (previewId,index) {
                            return {"upload_file": true, "name_file": "hojaMatricula-' . @Yii::$app->session->get("PB_perid") . '-' . time() . '"};
                        }',
                        ],
                        'pluginEvents' => [
                            "filebatchselected" => "function (event) {
                            $('#txth_up_hoja2').val('hojaMatricula-" . @Yii::$app->session->get("PB_perid") . '-' . time() . "');
                            $('#txth_up_hoja').val($('#txt_up_hoja').val());
                            $('#txt_up_hoja').fileinput('upload');
                        }",
                            "fileuploaderror" => "function (event, data, msg) {
                            $(this).parent().parent().children().first().addClass('hide');
                            $('#txth_up_hoja').val('');        
                        }",
                            "filebatchuploadcomplete" => "function (event, files, extra) { 
                            $(this).parent().parent().children().first().addClass('hide');
                        }",
                            "filebatchuploadsuccess" => "function (event, data, previewId, index) {
                            var form = data.form, files = data.files, extra = data.extra,
                            response = data.response, reader = data.reader;
                            $(this).parent().parent().children().first().addClass('hide');
                            var acciones = [{id: 'reloadpage', class: 'btn btn-primary', value: objLang.Accept, callback: 'reloadPage'}];       
                        }",
                            "fileuploaded" => "function (event, data, previewId, index) {
                            $(this).parent().parent().children().first().addClass('hide');
                            var acciones = [{id: 'reloadpage', class: 'btn btn-primary', value: objLang.Accept, callback: 'reloadPage'}];                           
                        }",
                        ],
                    ]); //style="display: none;"
                    ?>
                </div>
            </div>
        </div> 
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <?php if(isset($matriculacion_model['rpm_hoja_matriculacion']) && $matriculacion_model['rpm_hoja_matriculacion'] !=""): ?>
            <div class="form-group">
                <label class="col-lg-6 col-md-6 col-sm-6 col-xs-6 control-label"><?= academico::t("matriculacion", "Download registration") ?></label>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 control-label" style="text-align: left;">
                    <?= Html::a(academico::t("matriculacion", "Download"), Url::to(['matriculacion/updatepagoregistro', 'filename' => $matriculacion_model['rpm_hoja_matriculacion']]));   ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</form>
<input type="hidden" id="frm_ron_id" value="<?= $ron_id ?>">
<input type="hidden" id="frm_rpm_id" value="<?= $rpm_id ?>">

<?=
    $this->render('registry-grid', ['materias' => $materias, "materiasxEstudiante" => $materiasxEstudiante]);
?>