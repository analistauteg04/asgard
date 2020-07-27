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
    'id' => 'Tbg_Estudiantes',
    'showExport' => true,
    'fnExportEXCEL' => "exportExcel",
    'fnExportPDF' => "exportPdf",
    'dataProvider' => $model,
    'pajax' => true,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn', 'options' => ['width' => '10']],
        [
            'attribute' => 'Nombres',
            'header' => Yii::t("formulario", "First Names"),
            'value' => 'nombres',
        ],
        [
            'attribute' => 'Cedula',
            'header' => academico::t("diploma", "DNI"),
            'value' => 'dni',
        ],
        [
            'attribute' => 'Carrera',
            'header' => academico::t("Academico", "Academic unit"),
            'value' => 'undidad',
        ],
        [
            'attribute' => 'Modalidad',
            'header' => academico::t("matriculacion", "Modality"),
            'value' => 'modalidad',
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => academico::t("Academico", "Career/Program"),
            'template' => '{view}',
            'buttons' => [
                'view' => function ($url, $model) {
                    if (strlen($model['carrera']) > 30) {
                        $texto = '...';
                    }
                    return Html::a('<span>' . substr($model['carrera'], 0, 20) . $texto . '</span>', "javascript:", ["data-toggle" => "tooltip", "title" => $model['carrera']]);
                },
            ],
        ],
        [
            'attribute' => 'matricula',
            'header' => academico::t("Academico", 'Enrollment Number'),
            'value' => 'matricula',
        ],
        [
            'attribute' => 'categoria',
            'header' => Yii::t("formulario", "Category"),
            'value' => 'categoria',
        ],
        [
            'attribute' => 'fechacreacion',
            'header' => Yii::t("formulario", 'Date Create'),
            'value' => 'fecha_creacion',
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => Yii::t("formulario", "Actions"),
            'template' => '{create}',
            'buttons' => [
                'create' => function ($url, $model) {
                    if ($model['est_id'] < 1) {
                        return Html::a('<span class="glyphicon glyphicon glyphicon-file"></span>', Url::to(['/academico/estudiante/new', 'per_id' => base64_encode($model['per_id'])]), ["data-toggle" => "tooltip", "title" => "Crear Estudiante", "data-pjax" => 0]);
                    } else {
                        return '<span class="glyphicon glyphicon glyphicon-file"></span>';
                    }
                },
            ],
        ],
    ],  
])
?>
