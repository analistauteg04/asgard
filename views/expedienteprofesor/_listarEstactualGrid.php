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

<div id="resultadoEstActual">
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
                'attribute' => 'Nivel de Instrucción',
                'header' => Yii::t("formulario", "Instructional Level"),
                //'options' => ['width' => '180'],
                'value' => 'sins_fecha_solicitud',
            ],
            [
                'attribute' => 'Universidad',
                'header' => Yii::t("formulario", "Institution"),
                'value' => 'identificacion',
            ],
            [
                'attribute' => 'Titulo a Obtener',
                'header' => Yii::t("formulario", "Title Obtained"),
                'value' => 'identificacion',
            ],
            [
                'attribute' => 'Fecha de Ingreso',
                'header' => Yii::t("formulario", "Date Entry"),
                'value' => 'identificacion',
            ],      
        
        ],
    ])
    ?>
</div>
