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
    'id' => 'Tbg_DetalleMallas',
    'showExport' => true,
    'fnExportEXCEL' => "exportExcel",
    'fnExportPDF' => "exportPdf",
    'dataProvider' => $model,
    'pajax' => true,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn', 'options' => ['width' => '10']],
        [
            'attribute' => 'Código',
            'header' => Yii::t("formulario", "Código Asignatura"),
            'value' => 'made_codigo_asignatura',
        ],
        [
            'attribute' => 'Nombre',
            'header' => academico::t("diploma", "Asignatura"),
            'value' => 'asi_nombre',
        ],
        [
            'attribute' => 'Semestre',
            'header' => academico::t("Academico", "Semestre"),
            'value' => 'made_semestre',
        ],
        [
            'attribute' => 'Créditos',
            'header' => academico::t("matriculacion", "Créditos"),
            'value' => 'made_credito',
        ],        
        [
            'attribute' => 'Unidad Estudio',
            'header' => academico::t("matriculacion", "Unidad Estudio"),
            'value' => 'uest_nombre',
        ],   
        [
            'attribute' => 'Formación',
            'header' => academico::t("matriculacion", "Formación"),
            'value' => 'fmac_nombre',
        ],   
        [
            'attribute' => 'Materia requisito',
            'header' => academico::t("matriculacion", "Materia Requisito"),
            'value' => 'materia_requisito',
        ],   
       /*[
            'class' => 'yii\grid\ActionColumn',
            'header' => Yii::t("formulario", "Actions"),
            'template' => '{view}',
            'buttons' => [               
                'view' => function ($url, $model) {                    
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::to(['/academico/estudiante/view', 'per_id' => base64_encode($model['per_id']), 'est_id' => base64_encode($model['est_id'])]), ["data-toggle" => "tooltip", "title" => "Ver Detalle de Malla", "data-pjax" => 0]);
                   
                },
               
            ],
        ],*/
    ],
])
?>
