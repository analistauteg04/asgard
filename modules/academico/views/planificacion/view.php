<?php

use yii\helpers\Html;
use app\widgets\PbGridView\PbGridView;
use app\modules\academico\Module as academico;

//print_r($model_detalle);
academico::registerTranslations();
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h4><span id="lbl_planear"><?= academico::t("Academico", "See Student Planning") ?></span></h4>
</div><br><br><br>
<form class="form-horizontal">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">  
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
                <label for="lbl_unidadest" class="col-sm-2 col-lg-2 col-md-2 col-xs-2 control-label"><?= Yii::t("crm", "Academic Unit"); ?></label>
                <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3">
                    <?= Html::dropDownList("cmb_unidadest", 1, $arr_unidad, ["class" => "form-control", "id" => "cmb_unidadest", "Disabled" => "disabled"]) ?>
                </div>   
                <label for="lbl_modalidadest" class="col-sm-2 col-lg-2 col-md-2 col-xs-2 control-label"><?= Yii::t("formulario", "Mode"); ?></label>
                <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3">
                    <?= Html::dropDownList("cmb_modalidadest", $arr_cabecera["mod_id"], $arr_modalidad, ["class" => "form-control", "id" => "cmb_modalidadest", "Disabled" => "disabled"]) ?>
                </div>  
            </div>        
        </div>  
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
                <label for="lbl_carreraest" class="col-sm-2 col-lg-2 col-md-2 col-xs-2 control-label"><?= Yii::t("crm", "Carrera"); ?></label>
                <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3">
                    <!-- <? Html::dropDownList("cmb_carreraest",$arr_idcarrera["eaca_id"], $arr_carrera, ["class" => "form-control", "id" => "cmb_carreraest", "Disabled" => "disabled"]) ?>-->
                    <input type="text" class="form-control" value="<?= $arr_idcarrera["pes_carrera"] ?>" disabled ="true" id="txt_carrera" placeholder="<?= Yii::t("crm", "Carrera") ?>">
                </div>  
                <label for="lbl_periodoest" class="col-sm-2 col-lg-2 col-md-2 col-xs-2 control-label"><?= Yii::t("formulario", "Period"); ?></label>
                <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3">
                    <?= Html::dropDownList("cmb_periodoest", $arr_cabecera["pla_periodo_academico"], $arr_periodo, ["class" => "form-control", "id" => "cmb_periodoest", "Disabled" => "disabled"]) ?>
                </div>                  
            </div>        
        </div>  
    </div>
</form>
<div>      
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h4><span id="lbl_evaluar"><?= academico::t("Academico", "Student Planning Detail") ?></span></h4>
    </div><br><br>
    <?=
    PbGridView::widget([
        'id' => 'PbPlanificaestudianteview',
        'dataProvider' => $model_detalle,
        'pajax' => true,
        'summary' => false,
        'columns' => [
            [
                'attribute' => 'asignatura',
                'header' => academico::t("Academico", "Subject"),
                'value' => 'asignatura',
            ],
            [
                'attribute' => 'jornada',
                'header' => academico::t("Academico", "Working day"),
                'value' => 'pes_jornada',
            ],
            [
                'attribute' => 'bloque',
                'header' => Yii::t("formulario", "Block"),
                'value' => 'Bloque 1',
            ],
            [
                'attribute' => 'modalidad',
                'header' => Yii::t("formulario", "Mode"),
                'value' => 'modalidad',
            ],
            [
                'attribute' => 'hora',
                'header' => academico::t("Academico", "Hour"),
                'value' => 'Hora 1',
            ],
        ],
    ])
    ?>
</div>
