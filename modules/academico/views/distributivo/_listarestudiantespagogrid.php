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
        //'showExport' => true,
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
                'header' => Yii::t("formulario", "Academic unit"),
                'value' => 'unidad',
            ],
            [
                'attribute' => 'modalidad',
                'header' => Yii::t("formulario", "Mode"),
                'value' => 'modalidad',
            ],
            [
                'attribute' => 'asignatura',
                'header' => Yii::t("formulario", "Subject"),
                'value' => 'asignatura',
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