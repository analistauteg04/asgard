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

<div id="resultadoExpLaboral">
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
                'attribute' => 'Empresa',
                'header' => Yii::t("formulario", "Company/Institution"),
                //'options' => ['width' => '180'],
                'value' => 'sins_fecha_solicitud',
            ],
            [
                'attribute' => 'Tipo Empresa',
                'header' => Yii::t("formulario", "Company Type/Institution"),
                'value' => 'identificacion',
            ],
            [
                'attribute' => 'Cargo',
                'header' => Yii::t("formulario", "Charges"),
                'value' => 'identificacion',
            ],
            [
                'attribute' => 'Fecha Inicio',
                'header' => Yii::t("formulario", "Start date"),
                'value' => 'identificacion',
            ],
            [
                'attribute' => 'Fecha FIn',
                'header' => Yii::t("formulario", "End date"),
                'value' => 'identificacion',
            ],
            [
                'attribute' => 'Telefono Empresa/Institución',
                'header' => Yii::t("formulario", "Phone Contact Company/Institution"),
                'value' => 'identificacion',
            ],
            [
                'attribute' => 'Días Trabajados',
                'header' => Yii::t("formulario", "Worked Days"),
                'value' => 'identificacion',
            ],
        ],
    ])
    ?>
</div>
