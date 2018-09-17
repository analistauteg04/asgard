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

//print_r($model);
?>
<?= Html::hiddenInput('txth_ids', '', ['id' => 'txth_ids']); ?>
<div>
    <?=
    PbGridView::widget([
        // 'dataProvider' => new yii\data\ArrayDataProvider(array()),
        'id' => 'TbG_PERSONAS',
        //'showExport' => true,
        //'fnExportEXCEL' => "exportExcel",
        //'fnExportPDF' => "exportPdf",
        'dataProvider' => $model,
        'columns' =>
        [
            //['class' => 'yii\grid\SerialColumn', 'options' => ['width' => '10']],
            [
                'attribute' => 'Solicitud #',
                'header' => Yii::t("formulario", "Request #"),
                'value' => 'num_solicitud',
            ],
            [
                'attribute' => 'Fecha Solicitud ',
                'header' => Yii::t("solicitud_ins", "Application date"),
                'value' => 'fecha_solicitud',
            ],
            [
                'attribute' => 'DNI',
                'header' => Yii::t("formulario", "DNI 1"),
                //'options' => ['width' => '180'],
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
            [
                'attribute' => 'Ejecutivo Asignado',
                'header' => 'Ejecutivo Asignado',
                'value' => 'ejecutivo_asignado',
            ],
            [
                'attribute' => 'Estado',
                'header' => Yii::t("formulario", "Status"),
                'value' => 'estado',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t("formulario", "Actions"),
                'template' => '{view}', //
                'buttons' => [
                    'view' => function ($url, $model) {
                        if ($model['estado'] == 'Pendiente' && $model['roladmin'] != 1 && $model['numDocumento']>0) {
                            return Html::a('<span class="glyphicon glyphicon-download-alt"></span>', Url::to(['solicitudinscripcion/resultsolpreapro', 'ids' => base64_encode($model['sins_id']), 'perid' => base64_encode($model['persona']), 'apellidos' => base64_encode($model['per_apellidos']), 'nombres' => base64_encode($model['per_nombres']), 'nint_nombre' => base64_encode($model['nint_nombre']), 'car_nombre' => base64_encode($model['car_nombre'])]), ["data-toggle" => "tooltip", "title" => "Pre-Aprobar Solicitud.", "data-pjax" => 0]);
                        } else {
                            return '<span class="glyphicon glyphicon-download-alt"></span>';
                          }  
                    },
                ],
            ],
        ],
    ])
    ?>
</div>


