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

?>
<?= Html::hiddenInput('txth_ids', '', ['id' => 'txth_ids']); ?>
 <div>        
    <?=
    PbGridView::widget([
        //'dataProvider' => new yii\data\ArrayDataProvider(array()),
        'id' => 'Pbgperiodo',
        //'showExport' => true,
        'fnExportEXCEL' => "exportExcel",
        'fnExportPDF' => "exportPdf",
        'dataProvider' => $mod_periodo,
        'columns' => [            
            [
                'attribute' => 'Año',
                'header' => Yii::t("academico", "Year"),
                'value' => 'anio',
            ],
            [
                'attribute' => 'Mes',
                'header' => Yii::t("academico", "Month"),
                'value' => 'mes',
            ],
            [
                'attribute' => 'Código',
                'header' => Yii::t("academico", "Code"),
                'value' => 'codigo',
            ],
            [
                'attribute' => 'Método Ingreso',
                'header' => Yii::t("solicitud_ins", "Income Method"),
                'value' => 'metodo',
            ],
            [
                'attribute' => 'Fecha Inicial',
                'header' => Yii::t("academico", "Date from"),
                'value' => 'fecha_inicial',
            ],
            [
                'attribute' => 'Fecha Final',
                'header' => Yii::t("academico", "Date until"),
                'value' => 'fecha_final',
            ],
            [
                'attribute' => 'Num. Paralelos',
                'header' => Yii::t("academico", "Parallel"),
                'value' => 'cursos',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t("formulario", "Actions"),
                'template' => '{view} {update}', //
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-check"></span>', Url::to(['adminmetodoingreso/creaparalelo', 'pmin_id' => $model['pmin_id'], 'codigo' => $model['codigo']]), ["data-toggle" => "tooltip", "title" => "Registrar Paralelos", "data-pjax" => 0]);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-list"></span>', Url::to(['adminmetodoingreso/update', 'pmin_id' => base64_encode($model['pmin_id'])]), ["data-toggle" => "tooltip", "title" => "Modificar Período", "data-pjax" => 0]);
                    },
                ],
            ],
        ],
    ])
    ?>
    </div>   
