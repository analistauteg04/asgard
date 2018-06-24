<?php

use yii\jui\AutoComplete;
use yii\web\JsExpression;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use app\widgets\PbGridView\PbGridView;
use yii\data\ArrayDataProvider;
use app\models\Utilities;

?>
<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
    <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3"> </div>   
    <div class="col-sm-6 col-md-6 col-xs-6 col-lg-6" >  
        <?=
        PbGridView::widget([           
            'id' => 'TbG_CARRERAS',
            //'showExport' => true,
            //'fnExportEXCEL' => "exportExcel",
            //'fnExportPDF' => "exportPdf",
            'dataProvider' => $model,           
            'columns' =>
            [
                /*[
                    'class' => '\yii\grid\CheckboxColumn',
                ],*/
                /*[
                    'class' => 'app\widgets\PbGridView\PbCheckboxColumn',
                ],*/
                [
                    'name' => 'rb_carrera',
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
                    'header' => Yii::t("formulario", "Name") . ' ' . Yii::t("academico", "Career"),
                    'value' => 'name',
                ],
            ],
        ])
        ?>
    </div>
    <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3"> </div>
</div>