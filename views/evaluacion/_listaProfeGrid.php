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
<div>
    <?=
    PbGridView::widget([
        'id' => 'TbG_listarprofesor',
        //'showExport' => true,
        //'fnExportEXCEL' => "exportExcel",
        //'fnExportPDF' => "exportPdf",
        'dataProvider' => $model,      
        'columns' =>
        [
            [
                'attribute' => 'codigo',
                'header' => Yii::t("formulario", "code"),
                'value' => 'id',
            ],
            [
                'attribute' => 'profesor',
                'header' => Yii::t("formulario", "Teacher"),
                'value' => 'name',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t("formulario", "Actions"),
                'template' => '{seleccion}', //
                'buttons' => [
                    'seleccion' => function ($url, $model) {
                    
                            return Html::a('<span class="glyphicon glyphicon-ok"></span>', Url::to(['evaluacion/asignamateria', 'idp' =>  base64_encode($model['id']), 'nombre' =>  base64_encode($model['name'])]), ["data-toggle" => "tooltip", "title" => "Seleccionar Profesor", "data-pjax" => 0]);
                      
                    },                    
                ],
            ],
        ],
    ])
    ?>
</div>