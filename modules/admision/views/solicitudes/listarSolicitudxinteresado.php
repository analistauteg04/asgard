<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
use yii\data\ArrayDataProvider;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
$tipodoc='';
if (!empty($personalData['per_cedula'])) {
    $tipodoc = "Cédula";
    $docdni = $personalData['per_cedula'];
} else {
    if (!empty($personalData['per_pasaporte'])) {
        $tipodoc = "Pasaporte";
        $docdni = $personalData['per_pasaporte'];
    } else {
        $tipodoc = "Cédula";
        $docdni = $personalData['per_cedula'];
    }
}
?>
<?= Html::hiddenInput('txth_per_id', base64_encode($personalData['per_id']), ['id' => 'txth_per_id']); ?>
<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
    <h3><span id="lbl_Personeria"><?= Yii::t("formulario", "Request by Interested") ?></span></h3>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
    <div class="col-md-7 col-sm-7 col-xs-7 col-lg-7">
        <div class="form-group">
            <h4><span id="lbl_general"><?= Yii::t("formulario", "Data General Interested") ?></span></h4> 
        </div>
    </div>    
    <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_nombre1" class="col-sm-3 col-md-3 col-xs-3 col-lg-3 control-label" id="lbl_nombre1"><?= Yii::t("formulario", "Names") ?>:</label>
                <span for="txt_nombre1" class="col-sm-8 col-md-8 col-xs-8 col-lg-8  control-label" id="lbl_nombre1"><?= $personalData['per_pri_nombre'] . " " . $personalData['per_seg_nombre'] ?> </span> 
            </div>
        </div> 
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_apellido1" class="col-sm-3 col-md-3 col-xs-3 col-lg-3 control-label" id="lbl_apellido1"><?= Yii::t("formulario", "Last Names") ?>: </label>
                <span for="txt_apellido1" class="col-sm-8 col-md-8 col-xs-8 col-lg-8  control-label" id="lbl_apellido1"><?= $personalData['per_pri_apellido'] . " " . $personalData['per_seg_apellido'] ?> </span> 
            </div>
        </div> 
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_nombre1" class="col-sm-3 col-md-3 col-xs-3 col-lg-3 control-label" id="lbl_nombre1"><?= $tipodoc ?>:</label>
                <span for="txt_nombre1" class="col-sm-8 col-md-8 col-xs-8 col-lg-8  control-label" id="lbl_nombre1"><?= $personalData['per_cedula'] ?> </span> 
            </div>
        </div> 
    </div>  
    <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>
        <div class="col-md-10 col-sm-10 col-xs-10 col-lg-10">
           
        </div> 
        <div class="col-md-2 col-sm-2 col-xs-2 col-lg-2">
            <div class="form-group">
               <a id="btnNewSolicitud" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("accion", "Nuevo") ?> </a>
            </div>
        </div> 
    </div>   
</div>
<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
    <?=
    $this->render('_listarSolxinteresadoGrid', [
        'model' => $model,
        'url' => $url]);
    ?>
</div>

