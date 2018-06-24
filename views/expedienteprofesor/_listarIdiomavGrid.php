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
                'attribute' => 'Nombre del Idioma',
                'header' => Yii::t("formulario", "Name Language"),                
                'value' => 'rxi_des_idioma',
            ],
            [
                'attribute' => 'Institución que Certifica',
                'header' => Yii::t("formulario", "Institution certifies"),
                'value' => 'rxi_institucion',
            ],
            [
                'attribute' => 'Comprensión Hablada',
                'header' => Yii::t("formulario", "Comprehension")." ".Yii::t("formulario", "Speaking"),
                'value' => 'rxi_nivel_hablado',
            ],
            [
                'attribute' => 'Comprensión Escrita',
                'header' => Yii::t("formulario", "Comprehension")." ".Yii::t("formulario", "Written"),
                'value' => 'rxi_nivel_escrito',
            ],
            [
                'attribute' => 'Comprensión Lectura',
                'header' => Yii::t("formulario", "Comprehension")." ".Yii::t("formulario", "Reading"),
                'value' => 'rxi_nivel_lectura',
            ],
            [
                'attribute' => 'Comprensión Auditiva',
                'header' => Yii::t("formulario", "Comprehension")." ".Yii::t("formulario", "Auditive"),
                'value' => 'rxi_nivel_auditiva',
            ], 
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t("formulario", "Actions"),
                'template' => '{descarga}', //
                'buttons' => [                    
                    'descarga' => function ($url, $model) {                                                 
                        return Html::a('<span class="glyphicon glyphicon-download-alt"></span>', Url::to(['/site/getimage', 'route' => $model['rxid_documento']]), ["data-toggle" => "tooltip", "title" => "Ver Archivo", "data-pjax" => 0, 'target'=>'_blank']);
                        
                    },                                                     
                ],
            ],
        ],
    ])
    ?>
</div>
