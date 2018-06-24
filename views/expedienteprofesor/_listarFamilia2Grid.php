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

<div id="resultadoListFamIns">
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
                'attribute' => 'fecha',
                'header' => Yii::t("solicitud_ins", "Nombres"),
                //'options' => ['width' => '180'],
                'value' => 'sins_fecha_solicitud',
            ],
            [
                'attribute' => 'dni',
                'header' => Yii::t("formulario", "Apellidos"),
                'value' => 'identificacion',
            ],
            [
                'attribute' => 'dni',
                'header' => Yii::t("formulario", "Parentesco"),
                'value' => 'identificacion',
            ],
            [
                'attribute' => 'dni',
                'header' => Yii::t("formulario", "Cargo Actual"),
                'value' => 'identificacion',
            ],
        
        ],
    ])
    ?>
</div>
