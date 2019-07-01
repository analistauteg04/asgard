<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
use app\modules\financiero\Module as financiero;
use app\modules\admision\Module as admision;
use app\modules\academico\Module as academico;
use app\modules\admision\Module;

admision::registerTranslations();

?>
<div>
    <?=
    PbGridView::widget([
        'id' => 'TbG_VERFICAR_PAGOS_EXTERNOS',
        'showExport' => true,
        'fnExportEXCEL' => "exportExcelvpex",
        'fnExportPDF' => "exportPdfvpex",
        'dataProvider' => $model,     
        'columns' =>
        [   
            [
                'attribute' => 'referencia',
                'header' => Yii::t("formulario", "Reference"),
                'value' => 'referencia',
            ],
            [
                'attribute' => 'estudiante',
                'header' => Yii::t("formulario", "Student"),
                'value' => 'estudiante',
            ],
            [
                'attribute' => 'fecha_pago',
                'header' => Yii::t("formulario", "Date"),
                'value' => 'fecha_pago',
            ],           
            [
                'attribute' => 'total_pago',
                'header' => Yii::t("formulario", "Valor Total"),
                'value' => 'total_pago',
            ],
            [
                'attribute' => 'Estado',
                'header' => financiero::t("Pagos", "Payment status"),
                'value' => 'estado',
            ],   
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t("formulario", "Actions"),         
                'template' => '{view} {details} {request}',           
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::to(['pagos/viewpagoexterno', 'ido' => $model['id'], 'popup' => 'true']), ["data-toggle" => "tooltip", "title" => "Aprobar Pago", "data-pjax" => 0, "class" => "pbpopup"]);
                    },                   
                    'details' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-th-list"></span>', Url::to(['pagos/detallepagoexterno', 'doc_id' => $model['id'], 'popup' => 'true']), ["data-toggle" => "tooltip", "title" => "Detalle Pago", "data-pjax" => 0, "class" => "pbpopup"]);
                    },                   
                    'request' => function ($url, $model) {  
                        return Html::a('<span class="glyphicon glyphicon-bookmark"></span>', "#", ["onclick" => "grabarInteresado(" . $model['id'] . ");", "data-toggle" => "tooltip", "title" => "Generar Solicitud", "data-pjax" => 0]);
                    },                   
                ],
            ],
        ],
    ])
    ?>
</div>