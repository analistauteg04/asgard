<?php

use app\widgets\PbGridView\PbGridView;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div>        
    <?=
    PbGridView::widget([
        //'dataProvider' => new yii\data\ArrayDataProvider(array()),
        'id' => 'Pbgperiodo',
        //'showExport' => true,
        'fnExportEXCEL' => "exportExcel",
        'fnExportPDF' => "exportPdf",
        'dataProvider' => $model,
        'columns' => [                
            [
                'attribute' => 'Subcategoria',
                'header' => Yii::t("facturacion", "Subcategoría"),
                'value' => 'subcategoria',
            ],
            [
                'attribute' => 'Item',
                'header' => Yii::t("facturacion", "Item"),
                'value' => 'item',
            ],
            [
                'attribute' => 'Descuento',
                'header' => Yii::t("formulario", "Descuento"),
                'value' => 'descuento',
            ],                    
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t("formulario", "Actions"),
                'template' => '{insert}', //
                'buttons' => [                       
                    'insert' => function ($url, $model) {                            
                            return Html::a('<span class="glyphicon glyphicon-edit"></span>', Url::to(['facturacion/descuento_item', 'ite_id' => base64_encode($model['ite_id']), 'item' => base64_encode($model['item']), 'popup' => "true"]), ["data-toggle" => "tooltip", "class" => "pbpopup", "title" => "Registrar Descuento", "data-pjax" => 0]);                     
                    },       
                ],
            ],
        ],
    ])
    ?>
</div>   
