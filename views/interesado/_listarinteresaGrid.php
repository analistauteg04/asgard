<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
?>
<?=

PbGridView::widget([
    //'dataProvider' => new yii\data\ArrayDataProvider(array()),
    'id' => 'TbG_PERSONAS',
    //'showExport' => true,
    'fnExportEXCEL' => "exportExcel",
    'fnExportPDF' => "exportPdf",
    'dataProvider' => $model,
    //'pajax' => false,
    'columns' =>
    [
        //['class' => 'yii\grid\SerialColumn', 'options' => ['width' => '10']],
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
            'attribute' => 'registro',
            'header' => Yii::t("solicitud_ins", "Registry date"),
            'value' => 'fecha_registro',
        ],
        [
            'attribute' => 'DNI',
            'header' => Yii::t("formulario", "DNI 1"),
            //'options' => ['width' => '180'],
            'value' => 'per_dni',
        ],
        [
            'attribute' => 'Nombres',
            'header' => Yii::t("formulario", "First Names"),
            'value' => 'per_nombres',
        ],
        [
            'attribute' => 'Apellidos',
            'header' => Yii::t("formulario", "Last Names"),
            'value' => 'per_apellidos',
        ],
        [
            'attribute' => 'Estado',
            'header' => Yii::t("formulario", "Status"),
            'value' => 'estado',
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => Yii::t("formulario", "Actions"),
            //'headerOptions' => ['width' => '30'],
            'template' => '{view} {update} {ficha} {solicitud}', //
            'buttons' => [
                'view' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-check"></span>', Url::to(['ficha/verfichainteresado', 'ids' => base64_encode($model['per_id'])]), ["data-toggle" => "tooltip", "title" => "Ver Ficha", "data-pjax" => 0]);
                },
                'update' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-download-alt"></span>', Url::to(['solicitudinscripcion/listarsolinteresado', 'ids' => base64_encode($model['per_id'])]), ["data-toggle" => "tooltip", "title" => "Ver Solicitud", "data-pjax" => 0]);
                },
                'ficha' => function ($url, $model) {
                    if (($model['grupo_rol'] == 15 || $model['grupo_rol'] == 1 || $model['grupo_rol'] == 7 || $model['grupo_rol'] == 18 || $model['grupo_rol'] == 14) && $model['estado'] == 'Pendiente Ficha Datos') {
                        return Html::a('<span class="glyphicon glyphicon-list-alt"></span>', Url::to(['ficha/create', 'ids' => base64_encode($model['per_id'])]), ["data-toggle" => "tooltip", "title" => "Crear Ficha", "data-pjax" => 0]);
                    } else {
                        return '<span class = "glyphicon glyphicon-list-alt">  </span>';
                    }
                },
                'solicitud' => function ($url, $model) {
                    if (($model['grupo_rol'] == 15 || $model['grupo_rol'] == 1 || $model['grupo_rol'] == 7 || $model['grupo_rol'] == 18 || $model['grupo_rol'] == 14) && $model['estado'] != 'Pendiente Ficha Datos') {
                        return Html::a('<span class="glyphicon glyphicon-file"></span>', Url::to(['solicitudinscripcion/create', 'ids' => base64_encode($model['per_id']), 'nac' => base64_encode($model['nacionalidad'])]), ["data-toggle" => "tooltip", "title" => "Crear Solicitud", "data-pjax" => 0]);
                    } else {
                        return '<span class = "glyphicon glyphicon-file">  </span>';
                    }
                },
            ],
        ],
    ],
])
?>

