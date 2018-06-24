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
<?= Html::hiddenInput('txth_ids', '', ['id' => 'txth_ids']); ?>

<div>
    <?=
    PbGridView::widget([
        //'dataProvider' => new yii\data\ArrayDataProvider(array()),
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
                'attribute' => 'Estado',
                'header' => Yii::t("formulario", "Status"),
                'value' => 'estado',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t("formulario", "Actions"),
                'template' => '{view} {view1}', //
                'buttons' => [
                    'view' => function ($url, $model) {                        
                        if (($model['estado'] != 'Aprobado') and ($model['usu_preaprueba'] != $model['usu_autenticado'])) {
                            if (!empty($model['sins_fecha_reprobacion'])) {
                                return Html::a('<span class="glyphicon glyphicon-check"></span>', Url::to(['solicitudinscripcion/resultsolaprobar', 'ids' => base64_encode($model['sins_id']), 'int' => base64_encode($model['int_id']), 'perid' => base64_encode($model['persona']), 'apellidos' => base64_encode($model['per_apellidos']), 'nombres' => base64_encode($model['per_nombres']), 'nint_nombre' => base64_encode($model['nint_nombre']), 'car_nombre' => base64_encode($model['car_nombre']), 'fec_repro' => base64_encode($model['sins_fecha_reprobacion']), 'obs_repro' => base64_encode($model['sins_observacion'])]), ["data-toggle" => "tooltip", "title" => "Aprobación Solicitud", "data-pjax" => 0]);
                            } else {
                                return Html::a('<span class="glyphicon glyphicon-download-alt"></span>', Url::to(['solicitudinscripcion/resultsolaprobar', 'ids' => base64_encode($model['sins_id']), 'int' => base64_encode($model['int_id']), 'perid' => base64_encode($model['persona']), 'apellidos' => base64_encode($model['per_apellidos']), 'nombres' => base64_encode($model['per_nombres']), 'nint_nombre' => base64_encode($model['nint_nombre']), 'car_nombre' => base64_encode($model['car_nombre']), 'fec_repro' => base64_encode($model['sins_fecha_reprobacion']), 'obs_repro' => base64_encode($model['sins_observacion'])]), ["data-toggle" => "tooltip", "title" => "Aprobación Solicitud", "data-pjax" => 0]);
                            }
                        }
                    },
                    'view1' => function ($url, $model) {
                        if (!empty($model['sins_fecha_prenoprobacion'])) {
                            return Html::a('<span class="glyphicon glyphicon-check"></span>', Url::to(['solicitudinscripcion/resultsolpreapro', 'ids' => base64_encode($model['sins_id']), 'perid' => base64_encode($model['persona']), 'apellidos' => base64_encode($model['per_apellidos']), 'nombres' => base64_encode($model['per_nombres']), 'nint_nombre' => base64_encode($model['nint_nombre']), 'car_nombre' => base64_encode($model['car_nombre']), 'fec_prenopro' => base64_encode($model['sins_fecha_prenoprobacion']),]), ["data-toggle" => "tooltip", "title" => "Ver Pre-Aprobación", "data-pjax" => 0]);
                        }
                    },
                ],
            ],
        ],
    ])
    ?>
</div>


