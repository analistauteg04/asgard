<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
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
                'attribute' => 'Nombre',
                'header' => Yii::t("formulario", "Name"),
                'value' => 'icon_nombre_evento',
            ],
            [
                'attribute' => 'País',
                'header' => Yii::t("formulario", "Country"),
                'value' => 'icon_des_pais',
            ],
            [
                'attribute' => 'Institución',
                'header' => Yii::t("formulario", "Institution"),
                'value' => 'icon_institucion',
            ],  
            [
                'attribute' => 'AreaConocimiento',
                'header' => Yii::t("formulario", "Knowledge Area"),
                'value' => 'icon_des_areacon',
            ],  
            [
                'attribute' => 'Ponencia',
                'header' => Yii::t("formulario", "Presentation"),
                'value' => 'icon_ponencia',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t("formulario", "Actions"),
                'template' => '{descarga}', //
                'buttons' => [                    
                    'descarga' => function ($url, $model) {                                                 
                        return Html::a('<span class="glyphicon glyphicon-download-alt"></span>', Url::to(['/site/getimage', 'route' => $model['icon_archivo']]), ["data-toggle" => "tooltip", "title" => "Ver Archivo", "data-pjax" => 0, 'target'=>'_blank']);
                        
                    },                                                     
                ],
            ],
        ],
    ])
    ?>
</div>
