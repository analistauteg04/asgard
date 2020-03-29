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
        [
            'attribute' => 'Solicitud',
            'header' => Especies::t("Especies", "Solicitud"),
            //'visible' => FALSE,
            //'htmlOptions' => array('style' => 'display:none; border:none;'),
            //'contentOptions' => ['class' => 'bg-red','style' => 'display:none; border:none;'],     // HTML attributes to customize value tag
            //'captionOptions' => ['tooltip' => 'Tooltip'], 
            'value' => 'csol_id',
        ],
        [
            'attribute' => 'Fecha Solicitud ',
            'header' => Especies::t("Especies", "Fecha Solicitud"),
            'format' => ['date', 'php:d-m-Y'],
            'value' => 'csol_fecha_solicitud',
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
            'attribute' => 'F.Pago',
            'header' => Especies::t("Especies", "F.Pago"),
            'value' => 'fpag_nombre',
        ],
        /* [
          'class' => 'yii\grid\ActionColumn',
          'header' => academico::t("Academico", "Especies"),
          'template' => '{view}',
          'buttons' => [
          'view' => function ($url, $model) {
          return Html::a('<span>' . substr($model['esp_rubro'], 0, 20) . '... </span>', Url::to(['#']), ["data-toggle" => "tooltip", "title" => $model['esp_rubro']]);
          },
          ],
          ], */
        [
            'attribute' => 'Total',
            'header' => Especies::t("Especies", "Total"),
            'value' => 'csol_total',
        ],
        [
            'attribute' => 'Estado Solicitud',
            'header' => Especies::t("Especies", "Estado Solicitud"),
            //'value' => 'csol_estado_aprobacion',
            'value' => function ($url, $model) {
                $estadoApro = "";
                if ($model['csol_estado_aprobacion'] == '1') {
                    return $model['csol_estado_aprobacion'];
                }
                return $estadoApro;
            }
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => Yii::t("formulario", "Actions"),
            'template' => '{view}', //
            'buttons' => [
                'view' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::to(['/academico/especies/autorizarpago', 'ids' => base64_encode($model['csol_id'])]), ["data-toggle" => "tooltip", "title" => "Ver Solicitud", "data-pjax" => "0"]);
                },
                
            ],
        ],
    ],
])
?>