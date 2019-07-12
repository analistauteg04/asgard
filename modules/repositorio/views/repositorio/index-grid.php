<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
use app\modules\repositorio\Module as repositorio;
?>
<?=
PbGridView::widget([
    'dataProvider' => new yii\data\ArrayDataProvider(array()),
    'id' => 'Tbg_Listar',
    'showExport' => true,
    'fnExportEXCEL' => "exportExcel",
    'fnExportPDF' => "exportPdf",
    //'dataProvider' => $model,
    'columns' =>
    [
        [
            'attribute' => 'Nombre Archivo',
            'header' => repositorio::t("repositorio", "File name"),
            'value' => 'num_solicitud',
        ],
        [
            'attribute' => 'Tipo',
            'header' => Yii::t("formulario", "Type"),
            'value' => 'fecha_solicitud',
        ],
        [
            'attribute' => 'Descripción',
            'header' => Yii::t("formulario", "Description"),
            'value' => 'per_dni',
        ],
        [
            'attribute' => 'Fecha Archivo',
            'header' => repositorio::t("repositorio", "Date file"),
            'value' => 'per_pri_nombre',
        ],
        [
            'attribute' => 'Fecha Creación',
            'header' => Yii::t("formulario", "Registration Date"),
            'value' => 'per_pri_apellido',
        ],                       
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => Yii::t("formulario", "Actions"),
            'template' => '{view}',
            'buttons' => [
                'view' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-download-alt"></span>', Url::to(['/repositorio/repositorio/view', 'ids' => base64_encode($model['sins_id']), 'int' => base64_encode($model['int_id']), 'perid' => base64_encode($model['persona']), 'empid' => base64_encode($model['emp_id'])]), ["data-toggle" => "tooltip", "title" => "Descargar", "data-pjax" => 0]);
                },                
            ],
        ],
    ],
])
?>