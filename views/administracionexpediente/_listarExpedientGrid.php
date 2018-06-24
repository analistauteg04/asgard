<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
?>

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
                'attribute' => 'DNI',
                'header' => Yii::t("formulario", "DNI"),
                'value' => 'dni',
            ],
            [
                'attribute' => 'Nombres',
                'header' => Yii::t("formulario", "First Names"),
                'value' => 'nombres',
            ],
            [
                'attribute' => 'Apellidos',
                'header' => Yii::t("formulario", "Last Names"),
                'value' => 'apellidos',
            ],  
            [
                'attribute' => 'Estado',
                'header' => Yii::t("formulario", "Status"),
                'value' => 'des_estado',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t("formulario", "Actions"),
                'template' => '{revisa}', 
                'buttons' => [
                    'revisa' => function ($url, $model) {                             
                        return Html::a('<span class="glyphicon glyphicon-check"></span>', Url::to(['expedienteprofesor/viewadmin', 'per_id' => base64_encode($model['id']), 'estado' => base64_encode($model['estado']), 'observacion' => base64_encode($model['observacion'])]), ["data-toggle" => "tooltip", "title" => "Revisar Expediente", "data-pjax" => 0]);                        
                    },                                                
                ],
            ],
        ],
    ])
    ?>
</div>


