<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
use app\models\Utilities;
use app\modules\academico\Module as academico;

//print_r($model);
academico::registerTranslations();
?>

<?=

PbGridView::widget([
    'id' => 'Tbg_Mallas',
    'showExport' => true,
    'fnExportEXCEL' => "exportExcel",
    'fnExportPDF' => "exportPdf",
    'dataProvider' => $model,
    'pajax' => true,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn', 'options' => ['width' => '10']],
        [
            'attribute' => 'Código',
            'header' => Yii::t("formulario", "Código"),
            'value' => 'maca_codigo',
        ],
        [
            'attribute' => 'Nombre',
            'header' => academico::t("diploma", "Malla"),
            'value' => 'maca_nombre',
        ],
        [
            'attribute' => 'Fecha inicial vigencia',
            'header' => academico::t("Academico", "Fecha inicial vigencia"),
            'value' => 'fechainicial',
        ],
        [
            'attribute' => 'Fecha final vigencia',
            'header' => academico::t("matriculacion", "Fecha final vigencia"),
            'value' => 'fechafin',
        ],        
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => Yii::t("formulario", "Actions"),
            'template' => '{view}',
            'buttons' => [               
                'view' => function ($url, $model) {                    
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::to(['/academico/mallasacademicas/indexdetalle', 'maca_id' => base64_encode($model['maca_id']) ]), ["data-toggle" => "tooltip", "title" => "Ver Detalle de Malla", "data-pjax" => 0]);
                   
                },
               
            ],
        ],
    ],
])
?>
