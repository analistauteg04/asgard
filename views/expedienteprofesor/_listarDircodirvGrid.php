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
                'attribute' => 'Tipo de Dirección',
                'header' => Yii::t("formulario", "Type"),
                'value' => 'itut_des_tipocodireccion',
            ],   
            [
                'attribute' => 'Pais',
                'header' => Yii::t("formulario", "Country"),
                'value' => 'itut_des_pais',
            ],   
            [
                'attribute' => 'Institución',
                'header' => Yii::t("formulario", "Institution"),
                'value' => 'itut_des_institucion',
            ],   
            [
                'attribute' => 'AreaConocimiento',
                'header' => Yii::t("formulario", "Knowledge Area"),
                'value' => 'des_area_conocimiento',
            ],  
            [
                'attribute' => 'Año',
                'header' => Yii::t("formulario", "Year Approval"),
                'value' => 'itut_anio_aprobacion',
            ],
        ],
    ])
    ?>
</div>
