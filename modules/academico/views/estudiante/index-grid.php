<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
use app\models\Utilities;
use app\modules\academico\Module as academico;

academico::registerTranslations();
?>

<?=
    PbGridView::widget([
        'id' => 'Tbg_Estudiantes',
        'showExport' => false,
        //'fnExportEXCEL' => "exportExcel",
        //'fnExportPDF' => "exportPdf",
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
            /*[
                'attribute' => 'Carrera',
                'header' => academico::t("matriculacion", "Career"),
                'value' => 'Carrera',
            ],
            [
                'attribute' => 'Modalidad',
                'header' => academico::t("matriculacion", "Modality"),
                'value' => 'Modalidad',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => academico::t("diploma", "Program/Course"),
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        if (strlen($model['Programa']) > 30) {
                            $texto = '...';
                        }
                        return Html::a('<span>' . substr($model['Programa'], 0, 20) . $texto . '</span>', "javascript:", ["data-toggle" => "tooltip", "title" => $model['Programa']]);
                    },
                ],
            ],*/
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
        ],
    ])
?>
