<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
use app\modules\academico\Module as academico;
use app\modules\admision\Module as admision;

admision::registerTranslations();
academico::registerTranslations();
?>
<?= Html::hiddenInput('txth_ids', '', ['id' => 'txth_ids']); ?>
<div>
    <?=
    PbGridView::widget([
        'id' => 'Tbg_CargaHoraria',
        'showExport' => true,
        'fnExportEXCEL' => "exportExcelCargaH",
        //'fnExportPDF' => "exportPdf",
        'dataProvider' => $model,
        //'pajax' => false,
        'columns' =>
        [
            [
                'attribute' => 'DNI',
                'header' => Yii::t("formulario", "DNI 1"),
                'value' => 'per_cedula',
            ],
            [
                'attribute' => 'docente',
                'header' => academico::t("Academico", "Teacher"),
                'value' => 'docente',
            ],    
            [
                'attribute' => 'Docencia',
                'header' => academico::t("Academico", "Teaching"),
                'value' => 'docencia',
            ], 
            [
                'attribute' => 'Tutoria',
                'header' => Yii::t("Academico", "Tutorial"),
                'value' => 'tutoria',
            ], 
            [
                'attribute' => 'Investigación',
                'header' => Yii::t("Academico", "Investigation"),
                'value' => 'investigacion',
            ], 
            [
                'attribute' => 'Vinculación',
                'header' => Yii::t("Academico", "Vinculación"),
                'value' => 'vinculacion',
            ], 
            [
                'attribute' => 'Administrativa',
                'header' => Yii::t("Academico", "Administrative"),
                'value' => 'administrativa',
            ], 
            [
                'attribute' => 'Otras Actividades',
                'header' => Yii::t("Academico", "Administrative"),
                'value' => 'otras',
            ],
            [
                'attribute' => 'Administrativa',
                'header' => Yii::t("Academico", "Other activities"),
                'value' => 'administrativa',
            ],            
            [
                'attribute' => 'semestre',
                'header' => Yii::t("formulario", "Semester"),
                'value' => 'semestre',
            ],             
            /*[
                'class' => 'yii\grid\ActionColumn',
                'header' => academico::t("Academico", "Career/Program"),
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span>' . substr($model['carrera'], 0,10)  . '..</span>', Url::to(['#']), ["data-toggle" => "tooltip", "title" => $model['carrera']]);
                    },
                ],               
            ],*/                                  
        ],
    ])
    ?>
</div>