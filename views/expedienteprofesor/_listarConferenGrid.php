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

<div id="resultadoConferencia">
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
                'attribute' => 'Nombre',
                'header' => Yii::t("formulario", "Name"),
                'value' => 'solicitud',
            ],
            [
                'attribute' => 'País',
                'header' => Yii::t("formulario", "Country"),
                'value' => 'sins_fecha_solicitud',
            ],
            [
                'attribute' => 'Institución',
                'header' => Yii::t("formulario", "Institution"),
                'value' => 'sins_fecha_solicitud',
            ],  
            [
                'attribute' => 'AreaConocimiento',
                'header' => Yii::t("formulario", "Knowledge Area"),
                'value' => 'des_area_conocimiento',
            ],  
            [
                'attribute' => 'Ponencia',
                'header' => Yii::t("formulario", "Presentation"),
                'value' => 'identificacion',
            ],
        ],
    ])
    ?>
</div>
