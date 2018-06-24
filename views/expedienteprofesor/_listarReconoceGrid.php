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

<div id="resultadoReconocimiento">
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
                'attribute' => 'Reconocimiento Otorgado',
                'header' => Yii::t("formulario", "Recognition Awarded"),
                //'options' => ['width' => '180'],
                'value' => 'sins_fecha_solicitud',
            ],
            [
                'attribute' => 'Institución/Establecimiento',
                'header' => Yii::t("formulario", "Institution"),
                'value' => 'dicu_nombre_institucion',
            ],
            [
                'attribute' => 'Fecha Logro',
                'header' => Yii::t("formulario", "Date Achievement"),
                'value' => 'identificacion',
            ],
          
           
        
        ],
    ])
    ?>
</div>
