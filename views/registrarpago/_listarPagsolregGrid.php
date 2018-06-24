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

<div>
    <?=
    PbGridView::widget([
        //'dataProvider' => new yii\data\ArrayDataProvider(array()),
        'id' => 'TbG_Solicitudes',
        //'showExport' => true,
        //'fnExportEXCEL' => "exportExcel",
        //'fnExportPDF' => "exportPdf",
        'dataProvider' => $model,
        //'pajax' => false,
        'columns' =>
        [
            //['class' => 'yii\grid\SerialColumn', 'options' => ['width' => '10']],
            [
                'attribute' => 'solicitud',
                'header' => Yii::t("formulario", "Request #"),
                //'options' => ['width' => '180'],
                'value' => 'solicitud',
            ],
            [
                'attribute' => 'fecha',
                'header' => Yii::t("solicitud_ins", "Application date"),                
                'value' => 'sins_fecha_solicitud',
            ],
            [
                'attribute' => 'dni',
                'header' => Yii::t("formulario", "DNI 1"),
                'value' => 'identificacion',
            ],
            /*[
                'attribute' => 'correo',
                'header' => Yii::t("formulario", "Email"),
                'value' => 'correo',
            ],*/
            [
                'attribute' => 'Nombres',
                'header' => Yii::t("formulario", "First Names"),
                'value' => 'nombres',
            ],
            [
                'attribute' => 'Apellidos',
                'header' => Yii::t("formulario", "Last Names"),
                'value' => 'apellidos',
            ],
            [
                'attribute' => 'NivelInteres',
                'header' => Yii::t("solicitud_ins", "Level Interest"),
                'value' => 'nivel',
            ],
            [
                'attribute' => 'MetodoIngreso',
                'header' => Yii::t("solicitud_ins", "Income Method"),
                'value' => 'metodo',
            ],            
            [
                'attribute' => 'estado',
                'header' => Yii::t("formulario", "Status"),
                'value' => 'estado_desc_pago',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t("formulario", "Actions"),
                //'headerOptions' => ['width' => '30'],
                'template' => '{view}', //
                'buttons' => [
                    'view' => function ($url, $model) {
                        if ($model['estado'] == 'P') {
                            if ($model['rol'] == 5 || $model['rol'] == 6 || $model['rol'] == 7 || $model['rol'] == 8 || $model['rol'] == 15) {
                                return '<span class = "glyphicon glyphicon-check">  </span>';
                            } else {
                                return Html::a('<span class="glyphicon glyphicon-check"></span>', Url::to(['registrarpago/registrarpagoadm', 'ido' => $model['orden'], 'per_id' => $model['per_id']]), ["data-toggle" => "tooltip", "title" => "Registrar Pagos", "data-pjax" => 0]);
                            }
                        } else {
                            return Html::a('<span class="glyphicon glyphicon-thumbs-up"></span>', Url::to(['registrarpago/registrarpagoadm', 'ido' => $model['orden'], 'per_id' => $model['per_id']]), ["data-toggle" => "tooltip", "title" => "Registrar Pagos", "data-pjax" => 0]);
                        }
                    },
                ],
            ],
        ],
    ])
    ?>
</div>