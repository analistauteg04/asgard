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
        'id' => 'TbG_HISTORIAL_TRANSACCIONES',
        'showExport' => true,
        'fnExportEXCEL' => "exportExcelhis",
        'fnExportPDF' => "exportPdfhis",
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
                'template' => '{view} {details}',           
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::to(['pagos/validarpagoexterno', 'ido' => $model['id']]), ["data-toggle" => "tooltip", "title" => "Validar Pago", "data-pjax" => 0]);
                    },                   
                    'details' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-th-list"></span>', Url::to(['pagos/detallepagoexterno', 'ido' => $model['id']]), ["data-toggle" => "tooltip", "title" => "Detalle Pago", "data-pjax" => 0]);
                    },                   
                ],
            ],
        ],
    ])
    ?>
</div>