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

<div id="resultadoEstSuperior">
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
                'attribute' => 'Titulo Obtenido',
                'header' => Yii::t("formulario", "Title Obtained"),
                'value' => 'identificacion',
            ],
            [
                'attribute' => 'Fecha de Registro',
                'header' => Yii::t("formulario", "Registration Date"),
                'value' => 'identificacion',
            ],
            [
                'attribute' => 'Numero de Registro',
                'header' => Yii::t("formulario", "Registration Number"),
                'value' => 'identificacion',
            ],
            [
                'attribute' => 'País',
                'header' => Yii::t("formulario", "Place"),
                'value' => 'identificacion',
            ],                              
        ],
    ])
    ?>
</div>
