
<?php
use yii\helpers\Html;
?>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="txt_buscarData" class="col-sm-2 control-label"><?= Yii::t("formulario", "Search") ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" value="" id="txt_buscarData" placeholder="<?= Yii::t("solicitud_ins", "Search by Dni or Names") ?>">
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="txt_buscarEstado" class="col-sm-2 control-label"><?= Yii::t("formulario", "Status") ?></label>
            <div class="col-sm-4">
                <?= Html::dropDownList("cmb_estado", 0, $estado, ["class" => "form-control", "id" => "cmb_estado"]) ?>
            </div></br>   
        </div>  
    </div>  
    <div class="col-md-12">
        <div class="col-sm-8"></div>
        <div class="col-sm-2">                
            <a id="btn_buscarData" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Search") ?></a>
        </div>
    </div>
</div>