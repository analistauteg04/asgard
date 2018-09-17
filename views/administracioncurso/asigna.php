<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\date\DatePicker;
use app\widgets\PbGridView\PbGridView;
use yii\data\ArrayDataProvider;

?>
<?= Html::hiddenInput('txth_aspid', $asp_id, ['id' => 'txth_aspid']); ?>
<?= Html::hiddenInput('txth_sinsid', $sins_id, ['id' => 'txth_sinsid']); ?>

<div class="col-md-12">    
    <h3><span id="lbl_titulo"><?= Yii::t("academico", "Assignment to Income Method") ?></span></h3><br/>    
</div>

<form class="form-horizontal" enctype="multipart/form-data" >        
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <div class="form-group">
            <label for="txt_periodo" class="col-sm-4 control-label" id="lbl_periodo"><?= Yii::t("academico", "Lecturing Period") ?></label>
            <div class="col-sm-8">
                <?= Html::dropDownList("cmb_periodo", null, $arr_periodo, ["class" => "form-control", "id" => "cmb_periodo"]) ?>
            </div>
        </div>
    </div>   
    
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <div class="form-group">
            <label for="txt_paralelo" class="col-sm-4 control-label" id="lbl_periodo"><?= Yii::t("academico", "Parallel") ?></label>
            <div class="col-sm-8">
                <?= Html::dropDownList("cmb_paralelo", null, $arr_paralelo, ["class" => "form-control", "id" => "cmb_paralelo"]) ?>
            </div>
        </div>
    </div>
    
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12"> 
        <div class="form-group">
            <div class="col-sm-4">                                                  
            </div>  
            <div class="col-sm-4">                      
                <a id="btn_grabar_asignacion" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Send") ?></a>                                   
            </div> 
            <div class="col-sm-4">      
                <br/>
            </div>  
        </div>    
    </div>  
    
</form>