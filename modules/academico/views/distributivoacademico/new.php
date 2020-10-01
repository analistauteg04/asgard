<?php

use Yii;
use yii\helpers\Html;
use app\modules\academico\Module as academico;
use app\modules\admision\Module as admision;
use app\widgets\PbGridView\PbGridView;

admision::registerTranslations();
academico::registerTranslations();
?>
<?= Html::hiddenInput('txth_idperiodo', $arr_periodoActual['id'], ['id' => 'txth_idperiodo']); ?>
<h3>Período Académico: <span id="lbl_etiqueta"><?= $arr_periodoActual['nombre'] ?></span></h3>
</br>
<form class="form-horizontal">
    <div class="row">          
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">    
                <label for="cmb_profesor" class="col-sm-2 col-sm-2 col-lg-2 col-md-2 col-xs-2 control-label"><?= academico::t("Academico", "Teacher") ?></label>
                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">
                    <?= Html::dropDownList("cmb_profesor", 0,  $arr_profesor , ["class" => "form-control", "id" => "cmb_profesor"]) ?>
                </div>                            
            </div>
        </div>        
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
            <div class="form-group">            
                <label for="cmb_tipo_asignacion" class="col-sm-2 col-sm-2 col-lg-2 col-md-2 col-xs-2 control-label"><?= academico::t("Academico", "Tipo Asignación") ?></label>
                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">
                    <?= Html::dropDownList("cmb_tipo_asignacion", 0,  $arr_tipo_asignacion , ["class" => "form-control", "id" => "cmb_tipo_asignacion"]) ?>
                </div>   
                <div id="bloque1" style="display: none">
                <label for="cmb_unidad_dis" class="col-sm-2 col-sm-2 col-lg-2 col-md-2 col-xs-2 control-label"><?= Yii::t("formulario", "Academic unit") ?></label>
                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">
                    <?= Html::dropDownList("cmb_unidad_dis", 0, $arr_unidad, ["class" => "form-control", "id" => "cmb_unidad_dis"]) ?>
                </div> 
                </div>
            </div>
        </div>    
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="bloque2" style="display: none">
            <div class="form-group">    
                <label for="cmb_modalidad" class="col-sm-2 col-sm-2 col-lg-2 col-md-2 col-xs-2 control-label"><?= Yii::t("formulario", "Mode") ?></label>
                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">
                    <?= Html::dropDownList("cmb_modalidad", 0, $arr_modalidad, ["class" => "form-control", "id" => "cmb_modalidad"]) ?>
                </div>         
                <label for="cmb_periodo" class="col-sm-2 col-sm-2 col-lg-2 col-md-2 col-xs-2 control-label"><?= Yii::t("formulario", "Period") ?></label>
                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">
                    <?= Html::dropDownList("cmb_periodo", 0,  $arr_periodo , ["class" => "form-control", "id" => "cmb_periodo"]) ?>
                </div>       
            </div>                                            
        </div>    
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="bloque3" style="display: none">
            <div class="form-group">                        
                <label for="cmb_jornada" class="col-sm-2 col-sm-2 col-lg-2 col-md-2 col-xs-2 control-label"><?= academico::t("Academico", "Working day") ?></label>
                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">
                    <?= Html::dropDownList("cmb_jornada", 0, $arr_jornada, ["class" => "form-control", "id" => "cmb_jornada"]) ?>
                </div>   
                <label for="cmb_materia" class="col-sm-2 col-sm-2 col-lg-2 col-md-2 col-xs-2 control-label"><?= Yii::t("formulario", "Subject") ?></label>
                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">
                    <?= Html::dropDownList("cmb_materia", 0,  $arr_materias, ["class" => "form-control", "id" => "cmb_materia"]) ?>
                </div> 
            </div>
        </div> 
        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12" id="bloque4" style="display: none">
            <div class="form-group">                        
                <label for="cmb_horario" class="col-sm-2 col-sm-2 col-lg-2 col-md-2 col-xs-2 control-label"><?= Yii::t("formulario", "Schedule") ?></label>
                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">
                    <?= Html::dropDownList("cmb_horario", 0, $arr_horario, ["class" => "form-control", "id" => "cmb_horario"]) ?>
                </div>   
                <label for="cmb_paralelo" class="col-sm-2 col-sm-2 col-lg-2 col-md-2 col-xs-2 control-label"><?= Yii::t("formulario", "Paralelo") ?></label>
                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">
                    <?= Html::dropDownList("cmb_paralelo", 0, $arr_paralelo, ["class" => "form-control", "id" => "cmb_paralelo"]) ?>
                </div>   
            </div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
            <div class="form-group">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                    <button type="button" class="btn btn-primary" onclick="javascript:addAsignacion()"><?= Academico::t('profesor', 'Add') ?></button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="">
<?=
    PbGridView::widget([
        'id' => 'grid_asignacion_list',        
        'dataProvider' => $model,        
        'pajax' => true,
        'summary' => false,
        'columns' => [          
            [
                'attribute' => 'Tipo Asignación',
                'header' => academico::t("Academico", "Assignment Type"),
                'value' => 'des_tipo',
            ],
            [
                'attribute' => 'Asignatura',
                'header' => academico::t("Academico", "Subject"),
                'value' => 'asi_nombre',
            ],
            [
                'attribute' => 'Unidad Académica',
                'header' => academico::t("Academico", "Academic unit"),
                'value' => 'uaca_nombre',
            ],
            [
                'attribute' => 'Modalidad',
                'header' => academico::t("Academico", "Modality"),
                'value' => 'mod_nombre',
            ],
            [
                'attribute' => 'Horario',
                'header' => academico::t("Academico", "Schedule"),
                'value' => 'daho_horario',
            ],            
            [
                'class' => 'yii\grid\ActionColumn',
                //'header' => 'Action',
                'contentOptions' => ['style' => 'text-align: center;'],
                'headerOptions' => ['width' => '60'],
                'template' => '{delete}',
                'buttons' => [
                    'delete' => function ($url, $model) {
                         return Html::a('<span class="'.Utilities::getIcon('remove').'"></span>', null, ['href' => 'javascript:confirmDelete(\'deleteItem\',[\'' . $model['per_id'] . '\']);', "data-toggle" => "tooltip", "title" => Yii::t("accion","Delete")]);
                    },
                ],
            ],
        ],
    ])
?>
        </div>
    </div>
</form>