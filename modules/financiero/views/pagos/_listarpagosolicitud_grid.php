<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
use app\modules\financiero\Module as financiero;
use app\modules\admision\Module as admision;

admision::registerTranslations();

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
                'header' => admision::t("Solicitudes", "Application date"),                
                'value' => 'sins_fecha_solicitud',
            ],           
            [
                'attribute' => 'Item',
                'header' => financiero::t("Pagos", "Item"),
                'value' => 'ite_nombre',
            ],
            [
                'attribute' => 'Total',
                'header' => admision::t("Solicitudes", "Total"),
                'value' => 'ipre_precio',
            ],
            [
                'attribute' => 'Saldo Pendiente',
                'header' => financiero::t("Pagos", "Outstanding balance"),
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
                            return Html::a('<span class="glyphicon glyphicon-check"></span>', Url::to(['pagos/cargardocpagos', 'sins_id'=> base64_encode($model['sins_id']),'ids' => base64_encode($model['opag_id']), 'tot' => base64_encode($model['pag_total']), 'estado' => base64_encode($model['estado']), 'pe' => base64_encode($model['pendiente']), 'peid' => base64_encode($model['per_id'])]), ["data-toggle" => "tooltip", "title" => "Subir Documento", "data-pjax" => 0]);
                        }
                    }
                ],
            ],
        ],
    ])
    ?>
</div>