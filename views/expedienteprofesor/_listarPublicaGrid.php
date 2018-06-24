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

<div id="resultadoPublicacion">
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
                'attribute' => 'Tipo de Publicación',
                'header' => Yii::t("formulario", "Type publication"),
                'value' => 'solicitud',
            ],
            [
                'attribute' => 'Titulo',
                'header' => Yii::t("formulario", "Title"),
                'value' => 'sins_fecha_solicitud',
            ],
            [
                'attribute' => 'Publicación',
                'header' => Yii::t("formulario", "Publication"),
                'value' => 'sins_fecha_solicitud',
            ],
            [
                'attribute' => 'Nombre Revista Artículo Publicado',
                'header' => Yii::t("formulario", "Name") . ' ' . Yii::t("formulario", "Magazine/Editorial"),
                'value' => 'identificacion',
            ],
            [
                'attribute' => 'Fecha Publicación',
                'header' => Yii::t("formulario", "Fecha Publicación"),
                'value' => 'identificacion',
            ],
            [
                'attribute' => 'Número ISBN/ISSN',
                'header' => Yii::t("formulario", "Number ISBN/ISSN"),
                'value' => 'identificacion',
            ],
        ],
    ])
    ?>
</div>
