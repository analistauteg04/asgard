<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;

?>
<?= Html::hiddenInput('txth_ids', '', ['id' => 'txth_ids']); ?>
<div>        
    <?=
    PbGridView::widget([
        'id' => 'Pbgestion',
        'showExport' => true,
        'fnExportEXCEL' => "exportExcel",
        //'fnExportPDF' => "exportPdf",
        'dataProvider' => $model,
        'columns' => [           
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t("formulario", "Executive"),
                'template' => '{view}', //
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span>' . $model['cod_agente'] . '</span>', Url::to(['listargestion']), ["data-toggle" => "tooltip", "title" => $model['agente']]);
                    },
                ],
            ],
            [
                'attribute' => 'Interesado',
                'header' => Yii::t("formulario", "Interested"),
                'value' => 'interesado',
            ],
            [
                'attribute' => 'fecha',
                'header' => Yii::t("formulario", "Attention Date"),
                'value' => 'fecha_atencion',
            ],
            [
                'attribute' => 'fecha',
                'header' => Yii::t("formulario", "Attention Next"),
                'value' => 'fecha_proxima_atencion',
            ],            
            [
                'attribute' => 'Estado',
                'header' => Yii::t("formulario", "Status"),
                'value' => 'estado_des',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t("formulario", "Actions"),
                'template' => '{view}', //
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::to(['gestion/listararbol', 'codigo' => base64_encode($model['gcrm_id']), 'interesado' => base64_encode($model['interesado']), 'correo' => base64_encode($model['pges_correo']), 'celular' => base64_encode($model['pges_celular']), 'pais' => base64_encode($model['pais']) ]), ["data-toggle" => "tooltip", "title" => "Ver Gestiones", "data-pjax" => 0]);
                    },
                ],
            ],
        ],
    ])
    ?>
</div>   
