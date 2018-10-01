<?php

use yii\helpers\Html;
use yii\helpers\Url;
use \app\models\Persona;
use app\widgets\PbGridView\PbGridView;
use yii\data\ArrayDataProvider;
use app\modules\admision\Module;
//echo 'bbb '.base64_decode($_GET['codigo']);
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?= Html::hiddenInput('txth_ids', $codigo, ['id' => 'txth_ids']); ?>

<?=

PbGridView::widget([
    'id' => 'Pbgestion',
    //'showExport' => true,
    'fnExportEXCEL' => "exportExcel",
    'fnExportPDF' => "exportPdf",
    'dataProvider' => $model,
    'columns' => [
        [
            'attribute' => 'fecha',
            'header' => Yii::t("formulario", "Activity Date"),
            'value' => 'fecha_atencion',
        ],
        [
            'attribute' => 'descripcion',
            'header' => Yii::t("formulario", "Description Activity"),
            'contentOptions' => ['style' => 'max-width:200px;'],
            'value' => 'observacion',
        ],
        [
            'attribute' => 'fechaproxima',
            'header' => Yii::t("formulario", "Attention Next"),
            'value' => 'proxima_atencion',
        ],
        [
            'attribute' => 'Estado',
            'header' => Module::t("crm", "Opportunity state"),
            'value' => 'estado_oportunidad',
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => Yii::t("formulario", "Actions"),
            'template' => '{view} {interested}', //
            'buttons' => [
                'view' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::to(['actividades/view', 'opid' => base64_encode($model["opo_id"]), 'pgid' => base64_encode($model["pges_id"]), 'acid' => base64_encode($model["bact_id"])]), ["data-toggle" => "tooltip", "title" => "Ver Actividad", "data-pjax" => 0]);
                },
                'interested' => function ($url, $model) {
                    $mod_per = new Persona();
                    $pre_id = $mod_per->ConsultaRegistroExiste(null, $model['pges_cedula'], null);
                    $existe = isset($pre_id['existen']) ? 1 : 0;
                    if ($model['estado_oportunidad_id'] == 3) {
                        if ($existe == 0) {
                            return Html::a('<span class="glyphicon glyphicon-user"></span>', "#", ["onclick" => "grabarInteresado(" . $model['pges_id'] . ");", "data-toggle" => "tooltip", "title" => "Generar Aspirante", "data-pjax" => 0]);
                        } else {
                            return "<span class = 'glyphicon glyphicon-user' data-toggle = 'tooltip' title ='Usuario Existente'  data-pjax = 0></span>";
                        }
                    } else {
                        return "<span class = 'glyphicon glyphicon-user' data-toggle = 'tooltip' title ='En espera de estado en Generar Aspirante'  data-pjax = 0></span>";
                    }
                },
            ],
        ],
    ],
])
?>

