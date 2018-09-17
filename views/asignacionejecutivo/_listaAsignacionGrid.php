<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
?>

<?=

PbGridView::widget([   
    'id' => 'TbG_PERSONAS',
    'fnExportEXCEL' => "exportExcel",
    'fnExportPDF' => "exportPdf",
    'dataProvider' => $model,  
    'columns' =>
    [        
        [
            'attribute' => 'solicitud',
            'header' => Yii::t("formulario", "Request #"),
            'value' => 'solicitud',
        ],
        [
            'attribute' => 'fecha',
            'header' => Yii::t("solicitud_ins", "Application date"),
            'value' => 'sins_fecha_solicitud',
        ],
        [
            'attribute' => 'registro',
            'header' => Yii::t("solicitud_ins", "Registry date"),
            'value' => 'fecha_registro',
        ],
        [
            'attribute' => 'DNI',
            'header' => Yii::t("formulario", "DNI 1"),
            'value' => 'per_dni',
        ],
        [
            'attribute' => 'Nombres',
            'header' => Yii::t("formulario", "First Names"),
            'value' => 'per_nombresc',
        ], 
        [
            'attribute' => 'Unidad',
            'header' => Yii::t("formulario", "Aca. Uni."),
            'value' => 'unidad',
        ],
        [
            'attribute' => 'Modalidad',
            'header' => Yii::t("formulario", "Mode"),
            'value' => 'modalidad',
        ],
        [
            'attribute' => 'Estado',
            'header' => Yii::t("formulario", "Status"),
            'value' => 'estado',
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => Yii::t("formulario", "Executive"),
            'template' => '{view}',
            'buttons' => [
                'view' => function ($url, $model) {
                    if ($model['ejecutivo'] == 'Pendiente por Asignar') {
                        return '<span style="color:#0080FF;">' . $model['ejecutivo'] . '</span>';
                    } else {
                        return '<span>' . $model['ejecutivo'] . '</span>';
                    }
                },
            ],
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => Yii::t("formulario", "Actions"),
            'template' => '{update} {reasignar}',
            'buttons' => [
                'update' => function ($url, $model) {
                    if ($model['ejecutivo'] == 'Pendiente por Asignar') {
                        $nombres = $model['per_apellidos'] . " " . $model['per_nombres'];
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Url::to(['asignacionejecutivo/asignar', 'popup' => "true", 'pint' => base64_encode($model['pint_id']), 'int' => base64_encode($model['int_id']), 'asp' => base64_encode($model['asp_id']), 'nom_interesado' => base64_encode($nombres)]), ["class" => "pbpopup", "data-toggle" => "tooltip", "title" => "Asignar Ejecutivo"]);
                    } else {
                        return '<span class = "glyphicon glyphicon-pencil">  </span>';
                    }
                },
                'reasignar' => function ($url, $model) {
                    if ($model['ejecutivo'] != 'Pendiente por Asignar') {
                        $nombres = $model['per_apellidos'] . " " . $model['per_nombres'];
                        $agente = $model['ejecutivo'];
                        return Html::a('<span class="glyphicon glyphicon-edit"></span>', Url::to(['asignacionejecutivo/reasignar', 'popup' => "true", 'pint' => base64_encode($model['pint_id']), 'int' => base64_encode($model['int_id']), 'asp' => base64_encode($model['asp_id']), 'nom_interesado' => base64_encode($nombres), 'agente' => base64_encode($agente)]), ["class" => "pbpopup", "data-toggle" => "tooltip", "title" => "Re-Asignar Ejecutivo"]);
                    } else {
                        return '<span class = "glyphicon glyphicon-edit">  </span>';
                    }
                },
            ],
        ],      
    ],
])
?>

