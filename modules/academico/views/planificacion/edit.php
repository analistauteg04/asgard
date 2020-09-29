<?php

use yii\helpers\Html;
use app\models\Utilities;
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
                    <?= Html::dropDownList("cmb_unidadest", 1, $arr_unidad, ["class" => "form-control", "id" => "cmb_unidadest", "Disabled"=> "true"]) ?>
                </div>   
                <label for="lbl_modalidadest" class="col-sm-2 col-lg-2 col-md-2 col-xs-2 control-label"><?= Yii::t("formulario", "Mode"); ?></label>
                <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3">
                    <?= Html::dropDownList("cmb_modalidadest", $arr_cabecera["mod_id"], $arr_modalidad, ["class" => "form-control", "id" => "cmb_modalidadest", "Disabled"=> "true"]) ?>
                </div>  
            </div>        
        </div>  
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
                <label for="lbl_carreraest" class="col-sm-2 col-lg-2 col-md-2 col-xs-2 control-label"><?= Yii::t("crm", "Carrera"); ?></label>
                <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3">
                    <?= Html::dropDownList("cmb_carreraest", 1, $arr_carrera, ["class" => "form-control", "id" => "cmb_carreraest", "Disabled"=> "true"]) ?>
                </div>  
                <label for="lbl_periodoest" class="col-sm-2 col-lg-2 col-md-2 col-xs-2 control-label"><?= Yii::t("formulario", "Period"); ?></label>
                <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3">
                    <?= Html::dropDownList("cmb_periodoest", $arr_cabecera["pla_periodo_academico"], $arr_periodo, ["class" => "form-control", "id" => "cmb_periodoest", "Disabled"=> "true"]) ?>
                </div>                  
            </div>        
        </div>          
    </div>
    <div>      
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h4><span id="lbl_evaluar"><?= Yii::t("formulario", "Detalle Planificación Estudiante") ?></span></h4>
        </div><br><br><br>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label for="lbl_asignaest" class="col-sm-2 col-lg-2 col-md-2 col-xs-2 control-label"><?= academico::t("Academico", "Subject"); ?></label>
                    <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3">
                        <?= Html::dropDownList("cmb_asignaest", 1, $arr_unidad, ["class" => "form-control", "id" => "cmb_asignaest"]) ?>
                    </div>   
                    <label for="lbl_jornadaest" class="col-sm-2 col-lg-2 col-md-2 col-xs-2 control-label"><?= academico::t("Academico", "Working day") ?></label>
                    <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3">
                        <?= Html::dropDownList("cmb_jornadaest", 0, $arr_jornada, ["class" => "form-control", "id" => "cmb_jornadaest"]) ?>
                    </div>  
                </div>        
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label for="lbl_bloqueest" class="col-sm-2 col-lg-2 col-md-2 col-xs-2 control-label"><?= Yii::t("formulario", "Block"); ?></label>
                    <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3">
                        <?= Html::dropDownList("cmb_bloqueest", 0, $arr_bloque, ["class" => "form-control", "id" => "cmb_bloqueest"]) ?>
                    </div>   
                    <label for="lbl_modalidadesth" class="col-sm-2 col-lg-2 col-md-2 col-xs-2 control-label"><?= Yii::t("formulario", "Mode"); ?></label>
                    <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3">
                        <?= Html::dropDownList("cmb_modalidadesth", 0, $arr_modalidadh, ["class" => "form-control", "id" => "cmb_modalidadesth"]) ?>
                    </div>  
                </div>        
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label for="lbl_horaest" class="col-sm-2 col-lg-2 col-md-2 col-xs-2 control-label"><?= academico::t("Academico", "Hour"); ?></label>
                    <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3">
                        <?= Html::dropDownList("cmb_horaest", 0, $arr_hora, ["class" => "form-control", "id" => "cmb_horaest"]) ?>
                    </div> 
                </div>        
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                <button type="button" class="btn btn-primary" onclick="javascript:addInstruccion()"><?= Academico::t('profesor', 'Add') ?></button>
            </div>
        </div>
        <?=
        PbGridView::widget([
            'id' => 'PbPlanificaestudiantedit',
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
                [
                'class' => 'yii\grid\ActionColumn',                
                'contentOptions' => ['style' => 'text-align: center;'],
                'headerOptions' => ['width' => '60'],
                'template' => '{delete}',
                'buttons' => [
                    'delete' => function ($url, $model_detalle) {                        
                        return Html::a('<span class="'.Utilities::getIcon('remove').'"></span>', null, ['href' => 'javascript:', 'onclick' => "deletematestudiante(" . $_GET['pla_id'] . ", " . $_GET['per_id'] . ", " . substr($model_detalle['Bloque 1'],-1) . ", " . substr($model_detalle['Hora 1'],-1) . ");", "data-toggle" => "tooltip", "title" => Yii::t("accion","Delete")]);                         
                    },
                ],
            ],
            ],
        ])
        ?>
    </div>
</form>