<?php

use yii\helpers\Html;
use yii\helpers\Url;
use \app\models\Persona;
use app\widgets\PbGridView\PbGridView;
use app\modules\admision\Module as admision;
use app\modules\academico\Module as academico;
//print_r($model);
admision::registerTranslations();
?>
<?= Html::hiddenInput('txth_ids', '', ['id' => 'txth_ids']); ?>
<div>        
    <?=
    PbGridView::widget([
        'id' => 'PbPlanificaestudiante',
        'showExport' => true,
        'fnExportEXCEL' => "exportExcelplanifica",
        'fnExportPDF' => "exportPdfplanifica",
        'dataProvider' => $model,
        'columns' => [
            [
                'attribute' => 'DNI',
                'header' => Yii::t("formulario", "DNI 1"),
                'value' => 'per_cedula',
            ],              
            [
                'attribute' => 'Estudiante',
                'header' => Yii::t("formulario", "Student"),
                'value' => 'pes_nombres',
            ],  
                            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t("crm", "Carrera"),
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        if (strlen($model['pes_carrera']) > 30) {
                            $texto = '...';
                        }
                        return Html::a('<span>' . substr($model['pes_carrera'], 0, 30) . $texto . '</span>', "javascript:", ["data-toggle" => "tooltip", "title" => $model['pes_carrera']]);
                    },
                ],
            ],
            [
                'attribute' => 'periodo',
                'header' => Yii::t("formulario", "Period"),
                'value' => 'pla_periodo_academico',
            ],            
        ],
    ])
    ?>
</div>   
