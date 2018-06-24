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

<div id="resultadoExpDocencia">
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
                'attribute' => 'Universidad',
                'header' => Yii::t("formulario", "Institution"),
                //'options' => ['width' => '180'],
                'value' => 'solicitud',
            ],
            [
                'attribute' => 'Catedra',
                'header' => Yii::t("formulario", "Chair taught"),
                'value' => 'sins_fecha_solicitud',
            ],          
            [
                'attribute' => 'Tiempo',
                'header' => Yii::t("formulario", "Dedication time"),
                'value' => 'identificacion',
            ],            
            [
                'attribute' => 'Fecha Inicio',
                'header' => Yii::t("formulario", "Start date"),
                'value' => 'identificacion',
            ],
            [
                'attribute' => 'Fecha Fin',
                'header' => Yii::t("formulario", "End date"),
                'value' => 'identificacion',
            ],           
            [
                'attribute' => 'Telefono',
                'header' => Yii::t("formulario", "Phone") . ' ' . Yii::t("formulario", "Institution"),
                'value' => 'identificacion',
            ],
        ],
    ])
    ?>
</div>