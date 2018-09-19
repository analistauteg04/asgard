<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
use yii\data\ArrayDataProvider;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use app\models\Utilities;
?>
<div>
    <?=
    PbGridView::widget([
        'id' => 'TbG_SOLICITUD',
        //'showExport' => true,
        //'fnExportEXCEL' => "exportExcel",
        //'fnExportPDF' => "exportPdf",
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
                'attribute' => 'Metodo',
                'header' => Yii::t("solicitud_ins", "Income Method"),
                'value' => 'ite_nombre',
            ],
            [
                'attribute' => 'Total',
                'header' => "Total",
                'value' => 'ipre_precio',
            ],
            [
                'attribute' => 'Saldo Pendiente',
                'header' => Yii::t("formulario", "Outstanding balance"),
                'value' => 'pendiente',
            ],            
            [
                'attribute' => 'Estado',
                'header' => Yii::t("formulario", "Status"),
                'value' => 'estado',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t("formulario", "Actions"),
                'template' => '{view} ',
                'buttons' => [
                    'view' => function ($url, $model) {
                        if ($model['rol'] == 1) {
                            return Html::a('<span class="glyphicon glyphicon-check"></span>', Url::to(['pagos/cargardocpagos', 'ids' => base64_encode($model['opag_id']), 'tot' => base64_encode($model['ipre_precio']), 'estado' => base64_encode($model['estado']), 'pe' => base64_encode($model['pendiente'])]), ["data-toggle" => "tooltip", "title" => "Subir Documento", "data-pjax" => 0]);
                        }
                    }
                ],
            ],
        ],
    ])
    ?>
</div>