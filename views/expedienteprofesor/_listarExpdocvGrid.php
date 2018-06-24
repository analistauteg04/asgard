<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
?>

<div>
    <?=
    PbGridView::widget([        
        'id' => 'TbG_Solicitudes',
        //'showExport' => true,
        //'fnExportEXCEL' => "exportExcel",
        //'fnExportPDF' => "exportPdf",
        'dataProvider' => $model,
        //'pajax' => false,
        'columns' =>
        [
            [
                'attribute' => 'Universidad',
                'header' => Yii::t("formulario", "Institution"),                
                'value' => 'dedo_des_institucion',
            ],
            [
                'attribute' => 'Area Conocimiento',
                'header' => Yii::t("formulario", "Knowledge Area"),
                'value' => 'dedo_des_areaconoc',
            ],          
            [
                'attribute' => 'Tiempo',
                'header' => Yii::t("formulario", "Dedication time"),
                'value' => 'dedo_des_tiempodedica',
            ],            
            [
                'attribute' => 'Fecha Inicio',
                'header' => Yii::t("formulario", "Start date"),
                'value' => 'dedo_fecha_inicio',
            ],
            [
                'attribute' => 'Fecha Fin',
                'header' => Yii::t("formulario", "End date"),
                'value' => 'dedo_fecha_fin',
            ],           
            [
                'attribute' => 'Telefono',
                'header' => Yii::t("formulario", "Phone") . ' ' . Yii::t("formulario", "Institution"),
                'value' => 'dedo_telefono',
            ],
        ],
    ])
    ?>
</div>