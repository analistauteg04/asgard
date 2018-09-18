<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
?>
<?=
    PbGridView::widget([
        //'dataProvider' => new yii\data\ArrayDataProvider(array()),
        'id' => 'TbG_Solicitudes',
        'showExport' => true,
        'fnExportEXCEL' => "exportExcel",
        //'fnExportPDF' => "exportPdf",
        'dataProvider' => $model,
        'columns' =>
        [
            [
                'attribute' => 'Solicitud #',
                'header' => Yii::t("formulario", "Request #"),
                'value' => 'num_solicitud',
            ],
            [
                'attribute' => 'Fecha Solicitud ',
                'header' => Yii::t("solicitud_ins", "Application date"),
                'value' => 'fecha_solicitud',
            ],
            [
                'attribute' => 'DNI',
                'header' => Yii::t("formulario", "DNI 1"),
                'value' => 'per_dni',
            ],
            [
                'attribute' => 'Nombres',
                'header' => Yii::t("formulario", "First Names"),
                //'value' => 'per_nombres',
                'value' => 'per_pri_nombre',
            ],
            [
                'attribute' => 'Apellidos',
                'header' => Yii::t("formulario", "Last Names"),
                'value' => 'per_apellidos',
                
            ],
            [
                'attribute' => 'Nivel Interes',
                'header' => Yii::t("formulario", "Academic unit"),
                'value' => 'uaca_nombre',
            ],
            [
                'attribute' => 'Metodo Ingreso',
                'header' => Yii::t("solicitud_ins", "Income Method"),
                'value' => 'ming_nombre',
            ],
            [
                'attribute' => 'Carrera',
                'header' => Yii::t("academico", "Career") . "/". Yii::t("formulario", "Program"),
                'value' => 'carrera',
            ],
            [
                'attribute' => 'Estado',
                'header' => Yii::t("formulario", "Status"),
                'value' => 'estado',
            ],
            [
                'attribute' => 'Pago',
                'header' => 'Pago',
                'value' => 'pago',
            ],
           
        ],
    ])
    ?>