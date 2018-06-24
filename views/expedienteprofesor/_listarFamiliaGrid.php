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

<div id="resultadoListFam">
    <?=
    PbGridView::widget([
        'dataProvider' => new yii\data\ArrayDataProvider(array()),
        'id' => 'TbG_PERSONAS_CONTA_FAMILIAR',
        //'showExport' => true,
        //'fnExportEXCEL' => "exportExcel",
        //'fnExportPDF' => "exportPdf",
        //'dataProvider' => $model,
        //'pajax' => false,
        'columns' =>
        [
            //['class' => 'yii\grid\SerialColumn', 'options' => ['width' => '10']],
        
            [
                'attribute' => 'nombres',
                'header' => Yii::t("formulario", "Names"),
                //'options' => ['width' => '180'],
                'value' => 'nombres',
            ],
            [
                'attribute' => 'apellidos',
                'header' => Yii::t("formulario", "Last Names"),
                //'options' => ['width' => '180'],
                'value' => 'apellidos',
            ],
            [
                'attribute' => 'fecha_nacimiento',
                'header' => Yii::t("formulario", "Birth Date"),
                //'options' => ['width' => '180'],
                'value' => 'fecha_nac',
            ],
            [
                'attribute' => 'parentesco',
                'header' => Yii::t("formulario", "Kinship"),
                //'options' => ['width' => '180'],
                'value' => 'parentesco',
            ],
            [
                'attribute' => 'ocupacion',
                'header' => Yii::t("formulario", "Occupation"),
                //'options' => ['width' => '180'],
                'value' => 'ocupacion',
            ],
        ],
    ])
    ?>
</div>
