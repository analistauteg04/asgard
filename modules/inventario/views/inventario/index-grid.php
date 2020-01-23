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
            'attribute' => 'Empresa',
            'header' => repositorio::t("repositorio", "Empresa"),
            'value' => 'dre_imagen',
        ],
        [
            'attribute' => 'Area',
            'header' => Yii::t("formulario", "Area"),
            'value' => 'tipo',
        ],
        [
            'attribute' => 'Categoría',
            'header' => Yii::t("formulario", "Categoría"),
            'value' => 'dre_descripcion',
        ],
        [
            'attribute' => 'Código',
            'header' => repositorio::t("repositorio", "Código"),
            'value' => 'dre_fecha_archivo',
        ],
        [
            'attribute' => 'Marca',
            'header' => Yii::t("formulario", "Marca"),
            'value' => 'dre_fecha_creacion',
        ],  
        [
            'attribute' => 'Modelo',
            'header' => Yii::t("formulario", "Modelo"),
            'value' => 'dre_fecha_creacion',
        ],  
        [
            'attribute' => 'Serie',
            'header' => Yii::t("formulario", "Serie"),
            'value' => 'dre_fecha_creacion',
        ],  
        [
            'attribute' => 'Cantidad',
            'header' => Yii::t("formulario", "Cantidad"),
            'value' => 'dre_fecha_creacion',
        ],  
       /* [
            'class' => 'yii\grid\ActionColumn',
            'header' => Yii::t("formulario", "Actions"),
            'template' => '{view} {borrar} {visor}',
            'buttons' => [
                'view' => function ($url, $model) {                                        
                    return Html::a('<span class="glyphicon glyphicon-download-alt"></span>', Url::to(['repositorio/downloadfile', 'ids' => base64_encode($model['dre_id'])]), ["data-toggle" => "tooltip", "title" => "Descargar Evidencia", "data-pjax" => 0]);                   
                },                                                            
            ],
        ],*/
    ],
])
?>