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
use app\modules\academico\Module as Especies;

//print_r($model);
academico::registerTranslations();
financiero::registerTranslations();
Especies::registerTranslations();
?>
<?=

PbGridView::widget([
    'id' => 'TbG_Certiifcados',
    //'showExport' => true,
    'fnExportEXCEL' => "exportExcel",
    'fnExportPDF' => "exportPdf",
    'dataProvider' => $model,
    'columns' =>
    [
        [
            'attribute' => 'Nombres',
            'header' => Especies::t("Especies", "Número"),
            'value' => 'cgen_id',
        ],
        [
            'attribute' => 'Nombres',
            'header' => Especies::t("Especies", "Alumno"),
            'value' => 'Nombres',
        ],
        [
            'attribute' => 'Especie',
            //'class' => 'yii\grid\ActionColumn',
            'header' => Especies::t("Especies", "Número Especie"),
            //'template' => '{view}',
            'value' => 'egen_numero_solicitud',
            /*'buttons' => [
                'view' => function ($url, $model) {
                    return Html::a('<span>' . substr($model['egen_numero_solicitud'], 0, 10) . '... </span>', Url::to(['#']), ["data-toggle" => "tooltip", "title" => $model['egen_numero_solicitud']]);
                },
            ],*/
        ],
                        [
            'class' => 'yii\grid\ActionColumn',
            'header' => Especies::t("Especies", "Código Certificado"),
            'template' => '{view}',
            'buttons' => [
                'view' => function ($url, $model) {
                    return Html::a('<span>' . substr($model['cgen_codigo'], 0, 10) . '... </span>', Url::to(['#']), ["data-toggle" => "tooltip", "title" => $model['cgen_codigo']]);
                },
            ],
        ],
        [
            'attribute' => 'Unidad Academica',
            'header' => Especies::t("Especies", "Academic unit"),
            'value' => 'uaca_nombre',
        ],
        [
            'attribute' => 'Modalidad',
            'header' => Especies::t("Especies", "Modalidad"),
            'value' => 'mod_nombre',
        ],
        [
            'attribute' => 'Fecha Aprobación',
            'header' => Especies::t("Especies", "Fecha Genarado"),
            'format' => ['date', 'php:d-m-Y'],
            'value' => 'cgen_fecha_codigo_generado',
        ],
        /*[
            'class' => 'yii\grid\ActionColumn',
            'header' => Yii::t("formulario", "Actions"),
            'template' => '{descarga} {certificado}', //
            'buttons' => [                
                'descarga' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-download-alt"></span>', Url::to(['/academico/especies/descargarimagen', 'espgen_id' => base64_encode($model['egen_id'])]), ["data-toggle" => "tooltip", "title" => "Descargar Especie/Justificación", "data-pjax" => "0"]);
                },
                'certificado' => function ($url, $model) {
                    if ($model["egen_certificado"] == "SI" && $model["codigo_generado"] == " ") { // tambien preguntar si ya no se ha generado el codigo ne la tabla certificados_generados
                        return Html::a('<span class="glyphicon glyphicon-barcode"></span>', "#", ["onclick" => "generarCodigocer(" . $model['egen_id'] . ",'" . $model["egen_numero_solicitud"] . "','" . $model['per_cedula'] . "');", "data-toggle" => "tooltip", "title" => "Generar Codigo Certificado", "data-pjax" => 0]);
                    } else {
                        return "<span class = 'glyphicon glyphicon-barcode' data-toggle = 'tooltip' title ='Especie no genera codigo o ya fue generado'  data-pjax = 0></span>";
                    }
                },
            ],
        ],*/
    ],
])
?>