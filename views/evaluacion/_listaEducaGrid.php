<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
  Created on : 23/04/2018
  Author     : Diana Lopez
 */

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbSearchBox\PbSearchBox;
use app\widgets\PbGridView\PbGridView;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use yii\data\ArrayDataProvider;
use app\models\Utilities;

?>
<?=

PbGridView::widget([
    'id' => 'TbG_Profesor',
    //'showExport' => true,
    //'fnExportEXCEL' => "exportExcel",
    //'fnExportPDF' => "exportPdf",
    'dataProvider' => $model,
    'columns' =>
    [
        [
            'name' => 'rb_profesor',
            'class' => 'yii\grid\RadioButtonColumn',
            'radioOptions' => function ($model) {
                return [
                    'value' => $model['id'],
                    'checked' => $model['id'] == $model['id']
                ];
            }
        ],
        [
            'attribute' => 'nombre',
            'header' => Yii::t("formulario", "Name"),
            'value' => 'nombre',
        ],
        [
            'attribute' => 'apellido',
            'header' => Yii::t("formulario", "Last Name1"),
            'value' => 'apellido',
        ],
        [
            'attribute' => 'dni',
            'header' => Yii::t("formulario", "DNI 1"),
            'value' => 'dni',
        ],
    ],
])
?>
