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
                'attribute' => 'Reconocimiento Otorgado',
                'header' => Yii::t("formulario", "Recognition Awarded"),                
                'value' => 'dicu_titulo',
            ],
            [
                'attribute' => 'Institución/Establecimiento',
                'header' => Yii::t("formulario", "Institution"),
                'value' => 'dicu_nombre_institucion',
            ],
            [
                'attribute' => 'Fecha Logro',
                'header' => Yii::t("formulario", "Date Achievement"),
                'value' => 'dicu_fecha_registro',
            ],
          
        ],
    ])
    ?>
</div>
