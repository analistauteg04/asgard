<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
use app\modules\admision\Module as admision;
use app\modules\academico\Module as academico;
academico::registerTranslations();
?>
<?=
    PbGridView::widget([
        //'dataProvider' => new yii\data\ArrayDataProvider(array()),
        'id' => 'Tbg_Solicitudes',
        'showExport' => true,
        'fnExportEXCEL' => "exportExcel",
        //'fnExportPDF' => "exportPdf",
        'dataProvider' => $model,
        'columns' =>
        [
            [
                'attribute' => 'Solicitud #',
                'header' => admision::t("Solicitudes", "Request #"),
                'value' => 'num_solicitud',
            ],
            [
                'attribute' => 'Fecha Solicitud ',
                'header' => admision::t("Solicitudes", "Application date"),
                'value' => 'fecha_solicitud',
            ],
            [
                'attribute' => 'DNI',
                'header' => Yii::t("formulario", "DNI 1"),
                'value' => 'per_dni',
            ],
            [
                'attribute' => 'Nombres',
                'header' => Yii::t("formulario", "First Names"),
                //'value' => 'per_nombres',
                'value' => 'per_pri_nombre',
            ],
            [
                'attribute' => 'Apellidos',
                'header' => Yii::t("formulario", "Last Names"),
                'value' => 'per_apellidos',
                
            ],
            [
                'attribute' => 'Unidad Académica',
                'header' => academico::t("Academico", "Academic unit"),
                'value' => 'uaca_nombre',
            ],
            [
                'attribute' => 'Metodo Ingreso',
                'header' => admision::t("Solicitudes", "Income Method"),
                'value' => 'ming_nombre',
            ],
            [
                'attribute' => 'Carrera',
                'header' => academico::t("Academico", "Career/Program"),
                'value' => 'carrera',
            ],
            [
                'attribute' => 'Estado',
                'header' => Yii::t("formulario", "Status"),
                'value' => 'estado',
            ],
            [
                'attribute' => 'Pago',
                'header' => Yii::t("formulario", "Pago"),
                'value' => 'pago',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t("formulario", "Actions"),                
                'template' => '{view} {documentos} {factura}', 
                'buttons' => [                
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-check"></span>', Url::to(['/admision/solicitudes/view', 'ids' => base64_encode($model['sins_id']), 'int' => base64_encode($model['int_id']), 'perid' => base64_encode($model['persona'])]), ["data-toggle" => "tooltip", "title" => "Ver Solicitud", "data-pjax" => 0]);                        
                    },                           
                    'documentos' => function ($url, $model) {
                        if ($model['numDocumentos'] == 0)  {  
                            return Html::a('<span class="glyphicon glyphicon-folder-open"></span>', Url::to(['/admision/solicitudes/subirdocumentos', 'id_sol' => base64_encode($model['sins_id']), 'int' => base64_encode($model['int_id']), 'perid' => base64_encode($model['persona']), 'opcion' => base64_encode(2)]), ["data-toggle" => "tooltip", "title" => "Subir Documentos", "data-pjax" => 0]); 
                        } else {
                            if($model['rsin_id'] == 4)
                                return Html::a('<span class="glyphicon glyphicon-folder-open"></span>', Url::to(['/admision/solicitudes/actualizardocumentos', 'id_sol' => base64_encode($model['sins_id']), 'int' => base64_encode($model['int_id']), 'perid' => base64_encode($model['persona']), 'opcion' => base64_encode(2)]), ["data-toggle" => "tooltip", "title" => "Actualizar Documentos", "data-pjax" => 0]); 
                            else
                                return '<span class="glyphicon glyphicon-folder-open"></span>';
                        }
                    },  
                    'factura' => function ($url, $model) {
                        if ($model['pago'] != "No generado") {
                            return Html::a('<span class="glyphicon glyphicon-usd"></span>', Url::to(['/admision/solicitudes/descargafactura', 'id_sol' => base64_encode($model['sins_id']), 'int' => base64_encode($model['int_id']), 'perid' => base64_encode($model['persona']), 'opcion' => base64_encode(2)]), ["data-toggle" => "tooltip", "title" => "Descargar Factura", "data-pjax" => 0]);
                        }
                    },  
                ],
            ],
           
        ],
    ])
    ?>