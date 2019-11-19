<?php

use yii\helpers\Html;
use yii\helpers\Url;
use \app\models\Persona;
use app\widgets\PbGridView\PbGridView;
use app\modules\admision\Module as admision;
use app\modules\academico\Module as academico;

admision::registerTranslations();
?>
<?= Html::hiddenInput('txth_ids', '', ['id' => 'txth_ids']); ?>
<div>        
   <!--<?
    PbGridView::widget([
        'id' => 'PbEvaluacionDocente',
        'showExport' => true,
        'fnExportEXCEL' => "exportExcel",
        'fnExportPDF' => "exportPdf",
        'dataProvider' => $model,
        'columns' => [
            [
                'attribute' => 'profesor',
                'header' => Yii::t("formulario", "Teacher"),
                'value' => 'nombres',
            ],     
            [
                'attribute' => 'tipoevaluacion',
                'header' => Yii::t("formulario", "Evaluation Type"),
                'value' => 'tipo_evaluacion',
            ],
            [
                'attribute' => 'horas',
                'header' => Yii::t("formulario", "Hours"),
                'value' => 'horas',
            ],
            [
                'attribute' => 'evaluacion',
                'header' => Yii::t("formulario", "Evaluation"),
                'value' => 'evaluacion',
            ],
            [
                'attribute' => 'totalhora',
                'header' => academico::t("Academico", "Total Hours"),
                'value' => 'total_horas',
            ],
            [
                'attribute' => 'totalevaluacion',
                'header' => academico::t("Academico", "Total Evaluation"),
                'value' => 'total_evaluacion',
            ],            
        ],
    ])
    ?>-->
</div>   
