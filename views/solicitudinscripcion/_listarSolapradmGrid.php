<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;

?>
<?= Html::hiddenInput('txth_ids', '', ['id' => 'txth_ids']); ?>

<div>
    <?=
    PbGridView::widget([
        //'dataProvider' => new yii\data\ArrayDataProvider(array()),
        'id' => 'TbG_PERSONAS',
        //'showExport' => true,
        //'fnExportEXCEL' => "exportExcel",
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
                'template' => '{view}', 
                'buttons' => [
                    'view' => function ($url, $model) {                        
                        return Html::a('<span class="glyphicon glyphicon-edit"></span>', Url::to(['solicitudinscripcion/anular', 'ids' => base64_encode($model['sins_id']), 'nombres' => base64_encode($model['per_nombres']), 'apellidos' => base64_encode($model['per_apellidos']), 'nint_nombre' => base64_encode($model['nint_nombre']), 'car_nombre' => base64_encode($model['car_nombre']), 'popup'=>"true"]), ["class" => "pbpopup", "data-toggle" => "tooltip", "title" => "Anular Solicitud", "data-pjax" => 0]);                        
                        }
                ],
            ],
        ],
    ])
    ?>
</div>


