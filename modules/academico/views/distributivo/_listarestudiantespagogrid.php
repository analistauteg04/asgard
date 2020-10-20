<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
use app\modules\academico\Module as academico;
use app\modules\admision\Module as admision;

admision::registerTranslations();
academico::registerTranslations();
?>
<?= Html::hiddenInput('txth_ids', '', ['id' => 'txth_ids']); ?>
<div>
    <?=
    PbGridView::widget([
        'id' => 'Tbg_Distributivo_listadopago',
        'showExport' => true,
        'fnExportEXCEL' => "exportExcelDistpago",
        'fnExportPDF' => "exportPdfDispago",
        'dataProvider' => $model,
        //'pajax' => false,
        'columns' =>
        [
            [
                'attribute' => 'Periodo',
                'header' => Yii::t("formulario", "Period"),
                'value' => 'periodo',
            ],
            [
                'attribute' => 'unidad_academico',
                'header' => academico::t("Academico", "Aca. Uni."),
                'value' => 'unidad',
            ],
            [
                'attribute' => 'modalidad',
                'header' => Yii::t("formulario", "Mode"),
                'value' => 'modalidad',
            ],
            /* [
              'attribute' => 'asignatura',
              'header' => Yii::t("formulario", "Subject"),
              'value' => 'asignatura',
              ], */
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t("formulario", "Subject"),
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        if (strlen($model['asignatura']) > 30) {
                            $texto = '...';
                        }
                        return Html::a('<span>' . substr($model['asignatura'], 0, 20) . $texto . '</span>', "javascript:", ["data-toggle" => "tooltip", "title" => $model['asignatura']]);
                    },
                ],
            ],
            [
                'attribute' => 'DNI',
                'header' => Yii::t("formulario", "DNI"),
                'value' => 'identificacion',
            ],
            [
                'attribute' => 'Estudiante',
                'header' => Yii::t("formulario", "Complete Names"),
                'value' => 'estudiante',
            ],           
            [
                'attribute' => 'Estado',
                'header' => Yii::t("formulario", 'Status'),
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
                'format' => 'html',
                'value' => function ($model) {
                    if ($model["pago"] == 'No Autorizado')
                        return '<small class="label label-danger">No Autorizado</small>';                   
                    else
                        return '<small class="label label-success">Autorizado</small>';
                },
            ],
            [
                'attribute' => 'Fecha',
                'header' => Yii::t("formulario", "Date"),
                'value' => 'fecha_pago',
            ],
            /* [   
              'class' => 'app\widgets\PbGridView\PbCheckboxColumn',
              ], */
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Academico::t("matriculacion", "Select"),
                'contentOptions' => ['style' => 'text-align: center;'],
                'headerOptions' => ['width' => '60'],
                'template' => '{select}',
                'buttons' => [
                    'select' => function ($url, $model) {
                        return Html::checkbox("", false, ["value" => $model['est_id']]);
                    },
                ],
            ],
        ],
    ])
    ?>
</div>