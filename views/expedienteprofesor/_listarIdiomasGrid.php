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

<div id="resultadoIdioma">
    <?=
    PbGridView::widget([
        'dataProvider' => new yii\data\ArrayDataProvider(array()),
        'id' => 'TbG_Solicitudes',
        //'showExport' => true,
        //'fnExportEXCEL' => "exportExcel",
        //'fnExportPDF' => "exportPdf",
        //'dataProvider' => $model,
        //'pajax' => false,
        'columns' =>
        [
            //['class' => 'yii\grid\SerialColumn', 'options' => ['width' => '10']],
          
            [
                'attribute' => 'Nombre del Idioma',
                'header' => Yii::t("formulario", "Name Language"),
                //'options' => ['width' => '180'],
                'value' => 'sins_fecha_solicitud',
            ],
            [
                'attribute' => 'Institución que Certifica',
                'header' => Yii::t("formulario", "Institution certifies"),
                'value' => 'identificacion',
            ],
            [
                'attribute' => 'Comprensión Hablada',
                'header' => Yii::t("formulario", "Speaking Comprehension"),
                'value' => 'identificacion',
            ],
            [
                'attribute' => 'Comprensión Escrita',
                'header' => Yii::t("formulario", "Written Comprehension"),
                'value' => 'identificacion',
            ],
            [
                'attribute' => 'Comprensión Lectura',
                'header' => Yii::t("formulario", "Reading comprehension"),
                'value' => 'identificacion',
            ],
            [
                'attribute' => 'Comprensión Auditiva',
                'header' => Yii::t("formulario", "Auditive comprehension"),
                'value' => 'identificacion',
            ],                   
        ],
    ])
    ?>
</div>
