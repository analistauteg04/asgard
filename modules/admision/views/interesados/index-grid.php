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
            //'headerOptions' => ['width' => '30'],
            'template' => '{solicitudes} ', //
            'buttons' => [
                'solicitudes' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-th-large"></span>', Url::to(['solicitudinscripcion/listarsolicitudxinteresado', 'ids' => base64_encode($model['per_id'])]), ["data-toggle" => "tooltip", "title" => "Mostrar Solicitudes", "data-pjax" => 0]);
                },
            ],
        ],
    ],
])
?>

