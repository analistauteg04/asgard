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

academico::registerTranslations();
financiero::registerTranslations();
Especies::registerTranslations();
?>
<?=

PbGridView::widget([
    'id' => 'TbG_Solicitudes',
    //'showExport' => true,
    //'fnExportEXCEL' => "exportExcel",
    //'fnExportPDF' => "exportPdf",
    'dataProvider' => $model,
    'columns' =>
    [
        /* [
          'class' => 'yii\grid\CheckboxColumn',
          // you may configure additional properties here
         * var keys = $('#TbG_PERSONAS').yiiGridView('getSelectedRows'); Usar JS
          ], */

        /* A.egen_id,A.dsol_id,A.egen_numero_solicitud,C.esp_rubro,concat(D.per_pri_nombre,' ',D.per_pri_apellido) Nombres,D.per_cedula,
          F.uaca_nombre,G.mod_nombre,concat(E.resp_titulo,' ',E.resp_nombre) Responsable,date(A.egen_fecha_aprobacion) fecha_aprobacion,
          A.egen_fecha_caducidad */
        [
            'attribute' => 'Ids',
            'header' => Especies::t("Especies", "Ids"),
            //'visible' => FALSE,
            //'htmlOptions' => array('style' => 'display:none; border:none;'),
            //'contentOptions' => ['class' => 'bg-red','style' => 'display:none; border:none;'],     // HTML attributes to customize value tag
            //'captionOptions' => ['tooltip' => 'Tooltip'], 
            'value' => 'egen_id',
        ],
        [
            'attribute' => 'Número',
            'header' => Especies::t("Especies", "Número"),
            'value' => 'egen_numero_solicitud',
        ],
        
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => Especies::t("Especies", "Tipo Especies"),
            'template' => '{view}',
            'buttons' => [
                'view' => function ($url, $model) {
                    return Html::a('<span>' . substr($model['esp_rubro'], 0, 20) . '... </span>', Url::to(['#']), ["data-toggle" => "tooltip", "title" => $model['esp_rubro']]);
                },
            ],
        ],
        [
            'attribute' => 'Nombres',
            'header' => Especies::t("Especies", "Alumno"),
            'value' => 'Nombres',
        ],
        [
            'attribute' => 'Cédula',
            'header' => Especies::t("Especies", "Cédula"),
            'value' => 'per_cedula',
        ],
        [
            'attribute' => 'Unidad Academica',
            'header' => Especies::t("Especies", "Unidad Academica"),
            'value' => 'uaca_nombre',
        ],
        [
            'attribute' => 'Modalidad',
            'header' => Especies::t("Especies", "Modalidad"),
            'value' => 'mod_nombre',
        ],
        [
            'attribute' => 'Responsable',
            'header' => Especies::t("Especies", "Responsable"),
            'value' => 'Responsable',
        ],
        /* [
          'attribute' => 'F.Pago',
          'header' => Especies::t("Especies", "F.Pago"),
          'value' => 'fpag_nombre',
          ], */
        [
            'attribute' => 'Fecha Aprobación',
            'header' => Especies::t("Especies", "Fecha Aprobación"),
            'format' => ['date', 'php:d-m-Y'],
            'value' => 'fecha_aprobacion',
        ],
        [
            'attribute' => 'Fecha Aprobación',
            'header' => Especies::t("Especies", "Fecha Validez"),
            'format' => ['date', 'php:d-m-Y'],
            'value' => 'egen_fecha_caducidad',
        ],
        
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => Yii::t("formulario", "Actions"),
            'template' => '{view}', //
            'buttons' => [
                'view' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::to(['/academico/especies/generarespeciespdf', 'ids' => base64_encode($model['egen_id'])]), ["data-toggle" => "tooltip", "title" => "Descargar Especies", "data-pjax" => "0"]);
                },
            ],
        ],
    ],
])
?>