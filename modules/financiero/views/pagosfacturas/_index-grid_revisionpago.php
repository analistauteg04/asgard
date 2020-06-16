<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
use app\modules\academico\Module as academico;
use app\modules\financiero\Module as financiero;


//print_r($model);
academico::registerTranslations();
financiero::registerTranslations();

?>
<?=

PbGridView::widget([
    'id' => 'TbG_Revisionpago',
    'showExport' => true,
    'fnExportEXCEL' => "exportExcelrevpago",
    'fnExportPDF' => "exportPdfrevpago",
    'dataProvider' => $model,
    'columns' =>
    [
        [
            'attribute' => 'Identificación',
            'header' => Yii::t("formulario", "DNI"),
            'value' => 'cgen_id',
        ],
        [
            'attribute' => 'Nombres',
            'header' => Yii::t("formulario", "Student"),
            'value' => 'Nombres',
        ],
        [
            'attribute' => 'Unidad Academica',
            'header' => academico::t("Academico", "Academic unit"),
            'value' => 'uaca_nombre',
        ],
        [
            'attribute' => 'Modalidad',
            'header' => academico::t("Academico", "Modality"),
            'value' => 'mod_nombre',
        ],
        [
            'attribute' => 'Carrera/Programa',           
            'header' => academico::t("Academico", "Career/Program"),
            'value' => 'egen_numero_solicitud',            
        ],
        [
            'attribute' => 'Método pago',           
            'header' => Yii::t("formulario", "Paid form"),
            'value' => 'cgen_codigo',            
        ],
        [
            'attribute' => 'Cuota',           
            'header' => financiero::t("Pagos", "Monthly fee"),
            'value' => 'cgen_codigo',            
        ],                  
        [
            'attribute' => 'Factura',           
            'header' => financiero::t("Pagos", "Bill"),
            'value' => 'cgen_codigo',            
        ],   
        [
            'attribute' => 'Fecha Registro',
            'header' => Yii::t("formulario", "Registration Date"),
            'format' => ['date', 'php:d-m-Y'],
            'value' => 'cgen_fecha_certificado_subido',
        ],           
        [
            'attribute' => 'Estado',
            'header' => Yii::t("formulario", "Status"),           
            'value' => 'cgen_estado_certificado',
        ],  
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => Yii::t("formulario", "Actions"),
            'template' => '{descarga}', 
            'buttons' => [                
                'descarga' => function ($url, $model) {                                    
                return Html::a('<span class="glyphicon glyphicon-thumbs-up"></span>', Url::to(['/academico/certificados/autorizarcertificado', 'cgen_id' => base64_encode($model['cgen_id'])]), ["data-toggle" => "tooltip", "title" => "Autorizar Certificado", "data-pjax" => "0"]);
                },                
            ],
        ],
    ],
])
?>