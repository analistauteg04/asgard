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
        'id' => 'TbG_listarevaluacion',
        'showExport' => true,
        'fnExportEXCEL' => "exportExcel",
        //'fnExportPDF' => "exportPdf",
        'dataProvider' => $model,        
        'columns' =>
        [
            [
                'attribute' => 'profesor',
                'header' => Yii::t("formulario", "Teacher"),
                'value' => 'nombre',
            ],
            [
                'attribute' => 'niveslestudio',
                'header' => Yii::t("formulario", "Academic unit"),
                'value' => 'nivel_estudio',
            ],
            [
                'attribute' => 'modalidad',
                'header' => Yii::t("formulario", "Mode"),
                'value' => 'modalidad',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t("formulario", "Subject"),
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span>' . $model['materia'] . '</span>', Url::to(['listaevaluacion']), ["data-toggle" => "tooltip", "title" => $model['asi_nombre']]);
                    },
                ],
            ],
            [
                'attribute' => 'promedio',
                'header' => Yii::t("formulario", "Weighted"),
                'value' => 'edes_promedio',
            ],
        ],
    ])
    ?>
</div>