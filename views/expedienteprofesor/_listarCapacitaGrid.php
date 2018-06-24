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

<div id="resultadoCapacitacion">
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
            [
                'attribute' => 'Curso',
                'header' => Yii::t("formulario", "Course/Training"),
                'value' => 'solicitud',
            ],
            [
                'attribute' => 'Tipo de Capacitación',
                'header' => Yii::t("solicitud_ins", Yii::t("formulario", "Type") .' '. Yii::t("formulario", "Training")),
                'value' => 'sins_fecha_solicitud',
            ],
            [
                'attribute' => 'Modalidad',
                'header' => Yii::t("formulario", "Mode"),
                'value' => 'identificacion',
            ],
            [
                'attribute' => 'Institución que Organiza',
                'header' => Yii::t("formulario", "Institution organizes"),
                'value' => 'sins_fecha_solicitud',
            ],
            [
                'attribute' => 'Tipo Diploma',
                'header' => Yii::t("formulario", "Diploma type"),
                'value' => 'identificacion',
            ],
            [
                'attribute' => 'Duración Horas ',
                'header' => Yii::t("formulario", "Duration hours"),
                'value' => 'identificacion',
            ],
            [
                'attribute' => 'Fecha de Inicio',
                'header' => Yii::t("formulario", "Start date"),
                'value' => 'identificacion',
            ],
            [
                'attribute' => 'Fecha de Fin',
                'header' => Yii::t("formulario", "End date"),
                'value' => 'identificacion',
            ],          
        ],
    ])
    ?>
</div>
