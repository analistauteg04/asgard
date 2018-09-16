<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
use yii\data\ArrayDataProvider;

//echo 'bbb '.base64_decode($_GET['codigo']);
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?= Html::hiddenInput('txth_ids', $codigo, ['id' => 'txth_ids']); ?>

<?=

//   print_r($model);
PbGridView::widget([
    'id' => 'Pbgestion',
    //'showExport' => true,
    'fnExportEXCEL' => "exportExcel",
    'fnExportPDF' => "exportPdf",
    'dataProvider' => $model,
    'columns' => [
        [
            'attribute' => 'fecha',
            'header' => Yii::t("formulario", "Activity Date"),
            'value' => 'fecha_atencion',
        ],
        [
            'attribute' => 'descripcion',
            'header' => Yii::t("formulario", "Description Activity"),
            'contentOptions' => ['style' => 'max-width:200px;'],
            'value' => 'observacion',
        ],
        [
            'attribute' => 'fechaproxima',
            'header' => Yii::t("formulario", "Attention Next"),
            'value' => 'proxima_atencion',
        ],
        [
            'attribute' => 'Estado',
            'header' => Yii::t("crm", "Opportunity state"),
            'value' => 'estado_oportunidad',
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => Yii::t("formulario", "Actions"),
            'template' => '{view}', //
            'buttons' => [
                'view' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::to(['actividades/view', 'opid' => base64_encode($model["opo_id"]), 'pgid' => base64_encode($model["pges_id"]), 'acid' => base64_encode($model["bact_id"])]), ["data-toggle" => "tooltip", "title" => "Ver Actividad", "data-pjax" => 0]);
                },
            ],
        ],
    ],
])
?>

