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
    'id' => 'Tbg_SubsLista',
    'showExport' => true,
    'fnExportEXCEL' => "exportExcel",
    'fnExportPDF' => "exportPdf",
    'dataProvider' => $model,
    'columns' =>
    [
        [
            'attribute' => 'Contacto',
            'header' => marketing::t("marketing", "Contact"),
            'value' => 'contacto',
        ],
        [
            'attribute' => 'Carrera',
            'header' => marketing::t("Academico", "Career/Program"),
            'value' => 'carrera',
        ],
        [
            'attribute' => 'Correo',
            'header' => marketing::t("marketing", "Email"),
            'value' => 'per_correo',
        ],             
        [
            'attribute' => 'Subscriptor',
            'header' => marketing::t("marketing", "Estado"),
            'value' => 'estado',
        ],             
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => "Listas de  interes",
            'template' => '{view}',
            'buttons' => [
                'view' => function ($url, $model) {
                    return Html::a('<span>...</span>', Url::to(['#']), ["data-toggle" => "tooltip", "title" => 'Economia - Finanzas - Literatura']);
                },
            ],
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => Yii::t("formulario", "Actions"),
            'template' => '{addsubs} {addsublistinte} {rmsubs}',
            'buttons' => [
                'addsubs' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-plus"></span>', Url::to(['/marketing/email/asignar',  'lis_id' => base64_encode($model['lis_id'])]), ["data-toggle" => "tooltip", "title" => "Subscribirse a lista", "data-pjax" => 0]);
                },     
                'addsublistinte' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-th-list"></span>', Url::to(['/marketing/email/delete',  'lis_id' => base64_encode($model['lis_id'])]), ["data-toggle" => "tooltip", "title" => "Agregar Subscriptor a Listas Interes", "data-pjax" => 0]);
                },     
                'rmsubs' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-remove"></span>', Url::to(['/marketing/email/delete',  'lis_id' => base64_encode($model['lis_id'])]), ["data-toggle" => "tooltip", "title" => "Eliminar Subscriptor", "data-pjax" => 0]);
                },        
            ],
        ],
    ],
])
?>