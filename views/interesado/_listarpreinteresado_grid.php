<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
?>
<?=

PbGridView::widget([
    //'dataProvider' => new yii\data\ArrayDataProvider(array()),
    'id' => 'TbG_PERSONAS',
    //'showExport' => true,
    'fnExportEXCEL' => "exportExcel",
    'fnExportPDF' => "exportPdf",
    'dataProvider' => $model,
    //'pajax' => false,
    'columns' =>
    [
        //['class' => 'yii\grid\SerialColumn', 'options' => ['width' => '10']],                
        [
            'attribute' => 'registro',
            'header' => Yii::t("solicitud_ins", "Registry date"),
            'value' => 'fecha_registro',
        ],
        [
            'attribute' => 'DNI',
            'header' => Yii::t("formulario", "DNI 1"),
            //'options' => ['width' => '180'],
            'value' => 'dni',
        ],
        [
            'attribute' => 'Nombres',
            'header' => Yii::t("formulario", "First Names"),
            'value' => 'nombres',
        ],
        [
            'attribute' => 'Apellidos',
            'header' => Yii::t("formulario", "Last Names"),
            'value' => 'apellidos',
        ],
        [
            'attribute' => 'Celular',
            'header' => Yii::t("formulario", "CellPhone"),
            'value' => 'celular',
        ],  
        [
            'attribute' => 'Correo',
            'header' => Yii::t("formulario", "Email"),
            'value' => 'correo',
        ], 
    ],
])
?>

