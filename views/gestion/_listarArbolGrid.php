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

<?= //   print_r($model);
PbGridView::widget([
    'id' => 'Pbgestion',
    //'showExport' => true,
    'fnExportEXCEL' => "exportExcel",
    'fnExportPDF' => "exportPdf",
    'dataProvider' => $model,
    'columns' => [
        [
            'attribute' => 'Agente',
            'header' => Yii::t("formulario", "Executive"),
            'value' => 'agente',
        ],
        [
            'attribute' => 'Persona',
            'header' => Yii::t("formulario", "Names"),
            'value' => 'interesado',
        ],
        [
            'attribute' => 'fecha',
            'header' => Yii::t("formulario", "Attention Date"),
            'value' => 'fecha_atencion',
        ],
        [
            'attribute' => 'fechaproxima',
            'header' => Yii::t("formulario", "Attention Next"),
            'value' => 'proxima_atencion',
        ],
        [
            'attribute' => 'Estado',
            'header' => Yii::t("formulario", "Status"),
            'value' => 'estado',
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => Yii::t("formulario", "Actions"),
            'template' => '{view}', //
            'buttons' => [
                'view' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::to(['gestion/view', 'codigo' => base64_encode($model["hsco_id"]), 'agente' => base64_encode($model["agente"])]), ["data-toggle" => "tooltip", "title" => "Ver Gestión", "data-pjax" => 0]);
                },
            ],
        ],
    ],
])
?>

