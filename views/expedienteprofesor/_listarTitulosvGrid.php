<?php
use app\widgets\PbGridView\PbGridView;
use yii\helpers\Html;
use yii\helpers\Url;
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
                'attribute' => 'Nivel de Instrucción',
                'header' => Yii::t("formulario", "Instructional Level"),                
                'value' => 'dicu_nivel_des',
            ],
            [
                'attribute' => 'Universidad',
                'header' => Yii::t("formulario", "Institution"),
                'value' => 'dicu_nombre_institucion',
            ],
            [
                'attribute' => 'Titulo Obtenido',
                'header' => Yii::t("formulario", "Title Obtained"),
                'value' => 'dicu_titulo',
            ],
            [
                'attribute' => 'Fecha de Registro',
                'header' => Yii::t("formulario", "Registration Date"),
                'value' => 'dicu_fecha_registro',
            ],
            [
                'attribute' => 'Numero de Registro',
                'header' => Yii::t("formulario", "Registration Number"),
                'value' => 'dicu_numero_registro',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t("formulario", "Actions"),
                'template' => '{descarga}', //
                'buttons' => [                    
                    'descarga' => function ($url, $model) {                                                 
                        return Html::a('<span class="glyphicon glyphicon-download-alt"></span>', Url::to(['/site/getimage', 'route' => $model['dicu_documento']]), ["data-toggle" => "tooltip", "title" => "Ver Archivo", "data-pjax" => 0, 'target'=>'_blank']);
                        
                    },                                                     
                ],
            ],
        ],
    ])
    ?>
</div>
