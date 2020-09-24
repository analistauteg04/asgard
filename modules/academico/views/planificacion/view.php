<?php

use yii\helpers\Html;
/* use yii\helpers\Url;
  use kartik\date\DatePicker; */
use app\widgets\PbGridView\PbGridView;
use app\modules\academico\Module as academico;

//print_r($model_detalle);
academico::registerTranslations();
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h4><span id="lbl_evaluar"><?= Yii::t("formulario", "Ver Planificación Estudiante") ?></span></h4>
</div>
<form class="form-horizontal">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">  
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
                <label for="lbl_unidad" class="col-sm-2 col-lg-2 col-md-2 col-xs-2 control-label"><?= Yii::t("crm", "Academic Unit"); ?></label>
                <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3">
                    <?= Html::dropDownList("cmb_unidades", 1, $arr_unidad, ["class" => "form-control", "id" => "cmb_unidades", "Disabled" => "disabled"]) ?>
                </div>   
                <label for="lbl_modalidad" class="col-sm-2 col-lg-2 col-md-2 col-xs-2 control-label"><?= Yii::t("formulario", "Mode"); ?></label>
                <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3">
                    <?= Html::dropDownList("cmb_modalidades", $arr_cabecera["mod_id"], $arr_modalidad, ["class" => "form-control", "id" => "cmb_modalidades",  "Disabled" => "disabled"]) ?>
                </div>  
            </div>        
        </div>  
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
                <label for="lbl_carrera" class="col-sm-2 col-lg-2 col-md-2 col-xs-2 control-label"><?= Yii::t("crm", "Carrera"); ?></label>
                <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3">
                    <?= Html::dropDownList("cmb_carreras", 1, $arr_carrera, ["class" => "form-control", "id" => "cmb_carreras", "Disabled" => "disabled"]) ?>
                </div>  
                <label for="lbl_periodo" class="col-sm-2 col-lg-2 col-md-2 col-xs-2 control-label"><?= Yii::t("formulario", "Period"); ?></label>
                <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3">
                    <?= Html::dropDownList("cmb_periodo", $arr_cabecera["pla_periodo_academico"], $arr_periodo, ["class" => "form-control", "id" => "cmb_periodo",  "Disabled" => "disabled"]) ?>
                </div>                  
            </div>        
        </div>    
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">  
            <div class="col-sm-8"></div>
            <div class="col-sm-2">                
                <a id="btn_buscarPlanestudiante" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Search") ?></a>
            </div>
        </div>
    </div>
</form>
<div>        
    <?=
    PbGridView::widget([
        'id' => 'PbPlanificaestudiantedet',
        'dataProvider' => $model_detalle,
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
