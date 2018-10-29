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
        'id' => 'TbG_REPMATRICULA',
        'showExport' => true,
        'fnExportEXCEL' => "exportExcel",
        'fnExportPDF' => "exportPdf",
        'dataProvider' => $model,
        'columns' =>
        [
            [
                'attribute' => 'fecha',
                'header' => Yii::t("formulario", "Date"),
                'value' => 'mre_fecha_creacion',
            ],
            [
                'attribute' => 'DNI',
                'header' => Yii::t("formulario", "DNI 1"),
                'value' => 'per_cedula',
            ],
            [
                'attribute' => 'Nombres',
                'header' => Yii::t("formulario", "First Names"),
                'value' => 'per_pri_nombre',
            ],
            [
                'attribute' => 'Apellidos',
                'header' => Yii::t("formulario", "Last Names"),
                'value' => 'per_pri_apellido',
            ],
            [
                'attribute' => 'unidad',
                'header' => Yii::t("formulario", "Aca. Uni."),
                'value' => 'uaca_nombre',
            ],
            [
                'attribute' => 'modalidad',
                'header' => Yii::t("formulario", "Mode"),
                'value' => 'mod_nombre',
            ],
            [
                'attribute' => 'mes',
                'header' => Yii::t("formulario", "Month"),
                'value' => 'mes_id_academico',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => academico::t("Academico", "Career/Program"),
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        if ($model['carrera'] != '') {
                            $texto = substr($model['carrera'], 0, 15) . '...';
                        } else {
                            $texto = '';
                        }
                        return Html::a('<span>' . $texto . '</span>', Url::to(['#']), ["data-toggle" => "tooltip", "title" => $model['carrera']]);
                    },
                ],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => admision::t("Solicitudes", "Income Method"),
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span>' . $model['abr_metodo'] . '</span>', Url::to(['#']), ["data-toggle" => "tooltip", "title" => $model['ming_nombre']]);
                    },
                ],
            ],
            [
                'attribute' => 'aprobadas',
                'header' => academico::t("Academico", "Approved"),
                'value' => 'aprobada',
            ],
            [
                'attribute' => 'reprobadas',
                'header' => academico::t("Academico", "Failed"),
                'value' => 'reprobada',
            ],
            /*[
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t("formulario", "Actions"),
                'template' => '{view}',
                'buttons' => [
                ],
            ],*/
        ],
    ])
    ?>
</div>