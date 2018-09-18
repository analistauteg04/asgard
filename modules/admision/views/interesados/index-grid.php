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
            'attribute' => 'DNI',
            'header' => Yii::t("formulario", "DNI"),
            'value' => 'DNI',
        ],
        [
            'attribute' => 'Interesado',
            'header' => Yii::t("formulario", "Interested"),
            'value' => 'interesado',
        ],
        [
            'attribute' => 'Empresa',
            'header' => Yii::t("formulario", "Company"),
            'value' => 'empresa',
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => Yii::t("formulario", "Actions"),
            'template' => '{solicitudes} ', //
            'buttons' => [
                'solicitudes' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-th-large"></span>', Url::to(['admision/solicitud/solicitudxinteresado', 'ids' => base64_encode($model['id'])]), ["data-toggle" => "tooltip", "title" => "Mostrar Solicitudes", "data-pjax" => 0]);
                },
            ],
        ],
    ],
])
?>

