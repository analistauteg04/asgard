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
        'id' => 'TbG_PERSONAS',
        //'showExport' => true,
        //'fnExportEXCEL' => "exportuneExcel",
        //'fnExportPDF' => "exportunePdf",
        'dataProvider' => $model,
        //'pajax' => false,
        'columns' =>
        [                   
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
            /*[
                'class' => 'yii\grid\ActionColumn',
                'header' => academico::t("Academico", "Career/Program"),
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span>' . substr($model['carrera'], 0,10)  . '..</span>', Url::to(['#']), ["data-toggle" => "tooltip", "title" => $model['carrera']]);
                    },
                ],               
            ],*/           
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t("formulario", "Actions"),
                'template' => '{homologa}', //
                'buttons' => [      
                    'homologa' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-check"></span>', Url::to(['/academico/matriculacion/newhomologacion', 'sids' => base64_encode($model['sins_id']), 'asp' => base64_encode($model['asp_id'])]), ["data-toggle" => "tooltip", "title" => "Matricular por Homologación", "data-pjax" => 0]);
                    },
                ],
            ],
        ],
    ])
    ?>
</div>