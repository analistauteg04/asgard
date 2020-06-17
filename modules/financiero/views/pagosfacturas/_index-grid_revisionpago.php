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
            'value' => 'identificacion',
        ],
        [
            'attribute' => 'Nombres',
            'header' => Yii::t("formulario", "Student"),
            'value' => 'estudiante',
        ],
        [
            'attribute' => 'Unidad Academica',
            'header' => academico::t("Academico", "Academic unit"),
            'value' => 'unidad',
        ],
        [
            'attribute' => 'Modalidad',
            'header' => academico::t("Academico", "Modality"),
            'value' => 'modalidad',
        ],     
        [
            'attribute' => 'Método pago',           
            'header' => Yii::t("formulario", "Paid form"),
            'value' => 'forma_pago',            
        ],
        [
            'attribute' => 'Valor pago',           
            'header' => financiero::t("Pagos", "Amount Paid"),
            'value' => 'valor_pago',            
        ],
        [
            'attribute' => 'Cuota',           
            'header' => financiero::t("Pagos", "Monthly fee"),
            'value' => 'dpfa_num_cuota',            
        ],                  
        [
            'attribute' => 'Factura',           
            'header' => financiero::t("Pagos", "Bill"),
            'value' => 'dpfa_factura',            
        ],   
        [
            'attribute' => 'Fecha Registro',
            'header' => Yii::t("formulario", "Registration Date"),
            'format' => ['date', 'php:d-m-Y'],
            'value' => 'pfes_fecha_registro',
        ],           
        [
            'attribute' => 'Estado',
            'header' => Yii::t("formulario", "Status"),           
            'value' => 'estado_pago',
        ],  
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => Yii::t("formulario", "Actions"),
            'template' => '{descarga}', 
            'buttons' => [                
                'descarga' => function ($url, $model) {  
                    if (($model['estado_pago']== 'Pendiente') or ($model['estado_pago']== 'Rechazado')) {
                        return Html::a('<span class="glyphicon glyphicon-thumbs-up"></span>', Url::to(['/financiero/pagosfacturas/rechazar', 'dpfa_id' => base64_encode($model['dpfa_id'])]), ["data-toggle" => "tooltip", "title" => "Rechazar Pago", "data-pjax" => "0"]);
                    } 
                
                },                
            ],
        ],
    ],
])
?>