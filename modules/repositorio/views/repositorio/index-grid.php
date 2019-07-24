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
    //'dataProvider' => new yii\data\ArrayDataProvider(array()),
    'id' => 'Tbg_Listar',
    'showExport' => true,
    'fnExportEXCEL' => "exportExcel",
    'fnExportPDF' => "exportPdf",
    'dataProvider' => $model,
    'columns' =>
    [
        [
            'attribute' => 'Nombre Archivo',
            'header' => repositorio::t("repositorio", "File name"),
            'value' => 'dre_imagen',
        ],
        [
            'attribute' => 'Tipo',
            'header' => Yii::t("formulario", "Type"),
            'value' => 'tipo',
        ],
        [
            'attribute' => 'Descripción',
            'header' => Yii::t("formulario", "Description"),
            'value' => 'dre_descripcion',
        ],
        [
            'attribute' => 'Fecha Archivo',
            'header' => repositorio::t("repositorio", "Date file"),
            'value' => 'dre_fecha_archivo',
        ],
        [
            'attribute' => 'Fecha Creación',
            'header' => Yii::t("formulario", "Registration Date"),
            'value' => 'dre_fecha_creacion',
        ],                       
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => Yii::t("formulario", "Actions"),
            'template' => '{view} {borrar}',
            'buttons' => [
                'view' => function ($url, $model) {                    
                    //return Html::a('<span class="glyphicon glyphicon-download-alt"></span>', Url::to(['/site/getimage', 'route' => $model['dre_ruta'].$model['dre_imagen']]), ["download" => $model['dre_imagen'], "data-toggle" => "tooltip", "title" => "Descargar Evidencia", "data-pjax" => 0]);
                    return Html::a('<span class="glyphicon glyphicon-download-alt"></span>', $model['dre_ruta'].$model['dre_imagen'], ["download" => $model['dre_imagen'], "data-toggle" => "tooltip", "title" => "Descargar Evidencia", "data-pjax" => 0]);
                }, 
                'borrar' => function ($url, $model) {                                                           
                    //return Html::a('<span class="glyphicon glyphicon-remove"></span>', Url::to(['/repositorio/repositorio/eliminar', 'ids' => base64_encode($model['dre_id'])]), ["data-toggle" => "tooltip", "title" => "Eliminar Archivo", "data-pjax" => 0]);
                    return Html::a('<span class="glyphicon glyphicon-remove"></span>', "#", ['onclick' => "removerArchivo(" . $model['dre_id'] . ");", "data-toggle" => "tooltip", "title" => "Eliminar Archivo", "data-pjax" => 0]);
                    
                },                                                 
            ],
        ],
    ],
])
?>