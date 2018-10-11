<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
?>
<?=

PbGridView::widget([
    'id' => 'TbG_Interesado',
    'showExport' => true,
    'fnExportEXCEL' => "exportExcel",
    'dataProvider' => $model,
    'fnExportPDF' => "exportPdfAspirante",
    'columns' =>
    [
        [
            'attribute' => 'DNI',
            'header' => Yii::t("formulario", "DNI"),
            'value' => 'DNI',
        ],
        [
            'attribute' => 'Fecha',
            'header' => Yii::t("formulario", "Date"),
            'value' => 'fecha_interes',
        ],
        [
            'attribute' => 'Nombres',
            'header' => Yii::t("formulario", "Name"),
            'value' => 'nombres',
        ],
        [
            'attribute' => 'Apellidos',
            'header' => Yii::t("formulario", "Last Names"),
            'value' => 'apellidos',
        ],
        [
            'attribute' => 'Empresa',
            'header' => Yii::t("formulario", "Company"),
            'value' => 'empresa',
        ],
        [
            'attribute' => 'unidad_academica',
            'header' => Yii::t("formulario", "Academic unit"),
            'value' => 'unidad',
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => Yii::t("formulario", "Actions"),
            'template' => '{solicitudes} ', //
            'buttons' => [
                'solicitudes' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-th-large"></span>', Url::to(['/admision/solicitudes/listarsolicitudxinteresado', 'id' => base64_encode($model['id']), 'perid' => base64_encode($model['per_id'])]), ["data-toggle" => "tooltip", "title" => "Mostrar Solicitudes", "data-pjax" => 0]);
                },
            ],
        ],
    ],
])
?>

