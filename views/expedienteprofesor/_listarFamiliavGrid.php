<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
?>

<div>
    <?=
    PbGridView::widget([
        'dataProvider' => $model,
        'id' => 'TbG_PERSONAS_FAMILIAR',
        //'showExport' => true,
        //'fnExportEXCEL' => "exportExcel",
        //'fnExportPDF' => "exportPdf",        
        //'pajax' => false,
        'columns' =>
        [                    
            [
                'attribute' => 'nombres',
                'header' => Yii::t("formulario", "Names"),
                //'options' => ['width' => '180'],
                'value' => 'dafa_nombres',
            ],
            [
                'attribute' => 'apellidos',
                'header' => Yii::t("formulario", "Last Names"),                
                'value' => 'dafa_apellidos',
            ],
            [
                'attribute' => 'fecha_nacimiento',
                'header' => Yii::t("formulario", "Birth Date"),                
                'value' => 'dafa_fecha_nacimiento',
            ],
            [
                'attribute' => 'parentesco',
                'header' => Yii::t("formulario", "Kinship"),                
                'value' => 'des_parentesco',
            ],
            [
                'attribute' => 'ocupacion',
                'header' => Yii::t("formulario", "Occupation"),                
                'value' => 'dafa_ocupacion',
            ],
            [
                'attribute' => 'carga_actual',
                'header' => Yii::t("formulario", "Family Burden"),                
                'value' => 'carga_actual',
            ],
            [
                'attribute' => 'discapacidad',
                'header' => Yii::t("formulario", "Discapacidad"),                
                'value' => 'idis_discapacidad',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t("formulario", "Actions"),
                'template' => '{descarga}', //
                'buttons' => [                    
                    'descarga' => function ($url, $model) {     
                        if ($model["idis_discapacidad"]=="SI") {
                            return Html::a('<span class="glyphicon glyphicon-download-alt"></span>', Url::to(['/site/getimage', 'route' => $model['archivo_discapacidad']]), ["data-toggle" => "tooltip", "title" => "Ver Archivo Discapacidad", "data-pjax" => 0,'target'=>'_blank']);
                        }                        
                        //return Html::a('<span class="glyphicon glyphicon-download-alt"></span>', Url::to(['/site/getimage', 'route' => $model['dafa_archivo']]), ["data-toggle" => "tooltip", "title" => "Ver Archivo Familiar", "data-pjax" => 0,'target'=>'_blank']);                        
                    },                                                     
                ],
            ],
        ],
    ])
    ?>
</div>
