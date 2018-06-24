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
                'attribute' => 'Nombre Prroyecto',
                'header' => Yii::t("formulario", "Project Name"),
                'value' => 'dinv_nombre_proyecto',
            ],
            [
                'attribute' => 'Responsabilidad',
                'header' => Yii::t("formulario", "Project Role"),
                'value' => 'div_des_rolproyecto',
            ],
            [
                'attribute' => 'Fecha Inicio',
                'header' => Yii::t("formulario", "Start date") . ' ' . Yii::t("formulario", "Investigation"),
                'value' => 'dinv_fechainicio',
            ],
            [
                'attribute' => 'Fecha Fin',
                'header' => Yii::t("formulario", "End date") . ' ' . Yii::t("formulario", "Investigation"),
                'value' => 'dinv_fechafin',
            ], 
            [
                'attribute' => 'Financiado',
                'header' => Yii::t("formulario", "Funded"),
                'value' => 'dinv_des_financiada',
            ], 
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t("formulario", "Actions"),
                'template' => '{descarga}', //
                'buttons' => [                    
                    'descarga' => function ($url, $model) {                                                 
                        return Html::a('<span class="glyphicon glyphicon-download-alt"></span>', Url::to(['/site/getimage', 'route' => $model['dinv_documento']]), ["data-toggle" => "tooltip", "title" => "Ver Archivo", "data-pjax" => 0, 'target'=>'_blank']);
                        
                    },                                                     
                ],
            ],
        ],
    ])
    ?>
</div>
