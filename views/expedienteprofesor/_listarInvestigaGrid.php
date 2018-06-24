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

<div id="resultadoInvestigacion">
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
                'attribute' => 'Nombre Proyecto',
                'header' => Yii::t("formulario", "Project Name"),
                'value' => 'solicitud',
            ],
            [
                'attribute' => 'RolProyecto',
                'header' => Yii::t("formulario", "Project Rol"),
                'value' => 'rolproyecto',
            ],
            [
                'attribute' => 'Fecha Inicio',
                'header' => Yii::t("formulario", "Start date") . ' ' . Yii::t("formulario", "Investigation"),
                'value' => 'identificacion',
            ],
            [
                'attribute' => 'Fecha Fin',
                'header' => Yii::t("formulario", "End date") . ' ' . Yii::t("formulario", "Investigation"),
                'value' => 'identificacion',
            ],
            [
                'attribute' => 'Financiado',
                'header' => Yii::t("formulario", "Funded"),
                'value' => 'financiado',
            ],
        ],
    ])
    ?>
</div>
