<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
use app\modules\marketing\Module as marketing;
use app\modules\academico\Module as academico;
academico::registerTranslations();
?>
<?=

PbGridView::widget([
    //'dataProvider' => new yii\data\ArrayDataProvider(array()),
    'id' => 'Tbg_Solicitudes',
    'showExport' => true,
    'fnExportEXCEL' => "exportExcel",
    'fnExportPDF' => "exportPdf",
    'dataProvider' => $model,
    'columns' =>
    [
        [
            'attribute' => 'Lista',
            'header' => marketing::t("marketing", "List"),
            'value' => 'lis_nombre',
        ],
        [
            'attribute' => 'Programa',
            'header' => academico::t("Academico", "Career/Program/Course"),
            'value' => 'programa',
        ],
        [
            'attribute' => 'Subscriber number',
            'header' => marketing::t("marketing", "Subscriber number"),
            'value' => 'num_suscriptores',
        ],             
        /*[
            'class' => 'yii\grid\ActionColumn',
            'header' => academico::t("Academico", "Career/Program/Course"),
            'template' => '{view}',
            'buttons' => [
                'view' => function ($url, $model) {
                    return Html::a('<span>' . substr($model['carrera'], 0, 20) . '... </span>', Url::to(['#']), ["data-toggle" => "tooltip", "title" => $model['carrera']]);
                },
            ],
        ],*/      
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => Yii::t("formulario", "Actions"),
            'template' => '{programar} {editar} {eliminar}',
            'buttons' => [
                'programar' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-check"></span>', Url::to(['/marketing/email/programacion', /* 'empid' => base64_encode($model['emp_id'])*/]), ["data-toggle" => "tooltip", "title" => "Programación de envío", "data-pjax" => 0]);
                },     
                'editar' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Url::to(['/marketing/email/edit', /* 'empid' => base64_encode($model['emp_id'])*/]), ["data-toggle" => "tooltip", "title" => "Editar lista", "data-pjax" => 0]);
                },     
                'eliminar' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-remove"></span>', Url::to(['/marketing/email/drop', /* 'empid' => base64_encode($model['emp_id'])*/]), ["data-toggle" => "tooltip", "title" => "Eliminar lista", "data-pjax" => 0]);
                },     
            ],
        ],
    ],
])
?>