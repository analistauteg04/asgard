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
        'id' => 'TbG_PROGRMA',
        'showExport' => true,
        'fnExportEXCEL' => "exportExcel",
        'fnExportPDF' => "exportPdf",
        'dataProvider' => $model,
        //'pajax' => false,
        'columns' =>
        [
            [
                'attribute' => 'codigo',
                'header' => Yii::t("formulario", "Code"),
                'value' => 'solicitud',
            ],
            [
                'attribute' => 'anio',
                'header' => Yii::t("formulario", "Year"),
                'value' => 'per_dni',
            ],
            [
                'attribute' => 'mes',
                'header' => Yii::t("formulario", "Month"),
                'value' => 'per_nombres',
            ],
            [
                'attribute' => 'unidad_academica',
                'header' => admision::t("Solicitudes", "U. Académica."),
                'value' => 'uaca_nombre',
            ],
            [
                'attribute' => 'modalidad',
                'header' => admision::t("Solicitudes", "Modalidad"),
                'value' => 'mod_nombre',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t("formulario", "Program"),
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span>' . substr($model['carrera'], 0, 15) . '..</span>', Url::to(['#']), ["data-toggle" => "tooltip", "title" => $model['carrera']]);
                    },
                ],
            ],
            [
                'attribute' => 'paralelo',
                'header' => academico::t("Academico", "Parallel"),
                'value' => 'per_apellidos',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t("formulario", "Actions"),
                'template' => '{view} {paralelo}', //        
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-list-alt"></span>', Url::to(['/academico/matriculacionposgrados/index', 'ids' => base64_encode($model['sins_id'])]), ["data-toggle" => "tooltip", "title" => "Ver Programación", "data-pjax" => 0]);
                    },
                    'paralelo' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-list"></span>', Url::to(['/academico/matriculacionposgrados/index', 'ids' => base64_encode($model['sins_id'])]), ["data-toggle" => "tooltip", "title" => "Ver Paralelos", "data-pjax" => 0]);
                    },
                ],
            ],
        ],
    ])
    ?>
</div>