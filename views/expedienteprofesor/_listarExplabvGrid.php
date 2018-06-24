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
                'attribute' => 'Empresa',
                'header' => Yii::t("formulario", "Company/Institution"),                
                'value' => 'dela_empresa',
            ],
            [
                'attribute' => 'Tipo Empresa',
                'header' => Yii::t("formulario", "Company Type/Institution"),
                'value' => 'dela_des_emp',
            ],
            [
                'attribute' => 'Cargo',
                'header' => Yii::t("formulario", "Charges"),
                'value' => 'dela_cargo',
            ],
            [
                'attribute' => 'Fecha Inicio',
                'header' => Yii::t("formulario", "Start date"),
                'value' => 'dela_fecha_inicio',
            ],
            [
                'attribute' => 'Fecha FIn',
                'header' => Yii::t("formulario", "End date"),
                'value' => 'dela_fecha_fin',
            ],
            [
                'attribute' => 'Telefono Empresa/Institución',
                'header' => Yii::t("formulario", "Phone Contact Company/Institution"),
                'value' => 'dela_telef_empresa',
            ],
            [
                'attribute' => 'Días Trabajados',
                'header' => Yii::t("formulario", "Worked Days"),
                'value' => 'dias',
            ],
        ],
    ])
    ?>
</div>
