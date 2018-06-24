<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
use app\models\Utilities;
?>


<?=

PbGridView::widget([
    //'dataProvider' => new yii\data\ArrayDataProvider(array()),
    'id' => 'TbG_PERSONAS',
    'showExport' => true,
    'fnExportEXCEL' => "exportExcel",
    //'fnExportPDF' => "exportPdf",
    'dataProvider' => $model,
    'columns' =>
    [
        [
            'attribute' => 'Solicitud #',
            'header' => Yii::t("formulario", "Request #"),
            'value' => 'num_solicitud',
        ],
        [
            'attribute' => 'Fecha Solicitud ',
            'header' => Yii::t("solicitud_ins", "Application date"),
            'value' => 'fecha_solicitud',
        ],
        [
            'attribute' => 'DNI',
            'header' => Yii::t("formulario", "DNI 1"),
            'value' => 'per_dni',
        ],
        [
            'attribute' => 'Nombres',
            'header' => Yii::t("formulario", "First Names"),
            'value' => 'per_nombre',
        ],
        [
            'attribute' => 'Unidad Academica',
            'header' => Yii::t("formulario", "Aca. Uni."),
            'value' => 'nint_nombre',
        ],
        [
            'attribute' => 'Modalidad',
            'header' => Yii::t("formulario", "Mode"),
            'value' => 'modalidad',
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => Yii::t("formulario", "Method of Entry"),
            'template' => '{view}',
            'buttons' => [
                'view' => function ($url, $model) {
                    return Html::a('<span>' . $model['abr_metodo'] . '</span>', Url::to(['listarsolinteresado']), ["data-toggle" => "tooltip", "title" => $model['ming_nombre']]);
                },
            ],
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => Yii::t("academico", "Career"),
            'template' => '{view}',
            'buttons' => [
                'view' => function ($url, $model) {
                    return Html::a('<span>' . $model['abre_carrera'] . '</span>', Url::to(['listarsolinteresado']), ["data-toggle" => "tooltip", "title" => $model['carrera']]);
                },
            ],
        ],
        [
            'attribute' => 'Estado',
            'header' => Yii::t("formulario", "Status"),
            'value' => 'estado',
        ],
        [
            'attribute' => 'Pago',
            'header' => 'Pago',
            'value' => 'estado_pago',
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => Yii::t("formulario", "Actions"),
            'template' => '{view}', //
            'buttons' => [
                'view' => function ($url, $model) {
                    if ($model['estado_pago'] != 'No Disponible') {
                        return Html::a('<span class="glyphicon glyphicon-download-alt"></span>', Url::to(['registrarpago/listarpagosolicitud', 'ids' => base64_encode($model['persona'])]), ["data-toggle" => "tooltip", "title" => "Listar Pagos", "data-pjax" => 0]);
                    } else {
                        return '<span class="glyphicon glyphicon-download-alt"></span>';
                    }
                },
            ],
        ],
    ],
])
?>