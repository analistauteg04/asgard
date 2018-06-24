<?php

use app\widgets\PbGridView\PbGridView;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div>
    <?=
    PbGridView::widget([
        //'dataProvider' => new yii\data\ArrayDataProvider(array()),
        'id' => 'TbG_Solicitudes',
        //'showExport' => true,
        //'fnExportEXCEL' => "exportExcel",
        //'fnExportPDF' => "exportPdf",
        'dataProvider' => $model,
        //'pajax' => false,
        'columns' =>
        [                     
            [
                'attribute' => 'nombres',
                'header' => Yii::t("formulario", "Names"),
                //'options' => ['width' => '180'],
                'value' => 'dafa_nombres',
            ],
            [
                'attribute' => 'apellidos',
                'header' => Yii::t("formulario", "Last Names"),                
                'value' => 'dafa_apellidos',
            ],            
            [
                'attribute' => 'parentesco',
                'header' => Yii::t("formulario", "Kinship"),                
                'value' => 'des_parentesco',
            ],               
        ],
    ])
    ?>
</div>
