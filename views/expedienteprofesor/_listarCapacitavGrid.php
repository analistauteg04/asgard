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
                'attribute' => 'Curso',
                'header' => Yii::t("formulario", "Course/Training"),
                'value' => 'cap_nombre_curso',
            ],
            [
                'attribute' => 'Tipo de Capacitación',
                'header' => Yii::t("solicitud_ins", Yii::t("formulario", "Type") .' '. Yii::t("formulario", "Training")),
                'value' => 'dcap_tipo_capacitacion',
            ],
            [
                'attribute' => 'Modalidad',
                'header' => Yii::t("formulario", "Mode"),
                'value' => 'cap_des_modalidad',
            ],
            [
                'attribute' => 'Institución que Organiza',
                'header' => Yii::t("formulario", "Organizing institution"),
                'value' => 'cap_nombre_institucion',
            ],
            [
                'attribute' => 'Tipo Diploma',
                'header' => Yii::t("formulario", "Diploma type"),
                'value' => 'cap_des_tipodiploma',
            ],
            [
                'attribute' => 'Duración Horas ',
                'header' => Yii::t("formulario", "Duration hours"),
                'value' => 'cap_duracion',
            ],
            [
                'attribute' => 'Fecha de Inicio',
                'header' => Yii::t("formulario", "Start date"),
                'value' => 'cap_fecha_inicio',
            ],
            [
                'attribute' => 'Fecha de Fin',
                'header' => Yii::t("formulario", "End date"),
                'value' => 'cap_fecha_fin',
            ], 
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t("formulario", "Actions"),
                'template' => '{descarga}', //
                'buttons' => [                    
                    'descarga' => function ($url, $model) {                                                 
                        return Html::a('<span class="glyphicon glyphicon-download-alt"></span>', Url::to(['/site/getimage', 'route' => $model['dcap_documento_capacitacion']]), ["data-toggle" => "tooltip", "title" => "Ver Archivo", "data-pjax" => 0, 'target'=>'_blank']);
                        
                    },                                                     
                ],
            ],
        ],
    ])
    ?>
</div>
