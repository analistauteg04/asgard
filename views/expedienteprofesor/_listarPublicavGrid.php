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
        'id' => 'TbG_Solicitudes',
        //'showExport' => true,
        //'fnExportEXCEL' => "exportExcel",
        //'fnExportPDF' => "exportPdf",
        'dataProvider' => $model,
        //'pajax' => false,
        'columns' =>
        [
            [
                'attribute' => 'Tipo de Publicación',
                'header' => Yii::t("formulario", "Type publication"),
                'value' => 'dpub_des_tipopublicacion',
            ],
            [
                'attribute' => 'Titulo',
                'header' => Yii::t("formulario", "Title"),
                'value' => 'dpub_titulo',
            ],
            [
                'attribute' => 'Publicación',
                'header' => Yii::t("formulario", "Publication"),
                'value' => 'dpub_des_publicacion',
            ],
            [
                'attribute' => 'Nombre Revista Artículo Publicado',
                'header' => Yii::t("formulario", "Name") . ' ' . Yii::t("formulario", "Magazine/Editorial"),
                'value' => 'dpub_nombre_publicacion',
            ],
            [
                'attribute' => 'Fecha Publicación',
                'header' => Yii::t("formulario", "Fecha Publicación"),
                'value' => 'dpub_fecha_publicacion',
            ],
            [
                'attribute' => 'Número ISBN/ISSN',
                'header' => Yii::t("formulario", "Number ISBN/ISSN"),
                'value' => 'dpub_numero_issn_isbn',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t("formulario", "Actions"),
                'template' => '{descarga}', //
                'buttons' => [                    
                    'descarga' => function ($url, $model) {                                                 
                        return Html::a('<span class="glyphicon glyphicon-download-alt"></span>', Url::to(['/site/getimage', 'route' => $model['dpub_link_publicacion']]), ["data-toggle" => "tooltip", "title" => "Ver Archivo", "data-pjax" => 0, 'target'=>'_blank']);
                        
                    },                                                     
                ],
            ],
        ],
    ])
    ?>
</div>
