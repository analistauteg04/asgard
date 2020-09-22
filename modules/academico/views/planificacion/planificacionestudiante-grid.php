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
    <?=
    PbGridView::widget([
        'id' => 'PbPlanificaestudiante',
        'showExport' => true,
        //'fnExportEXCEL' => "exportExcel",
        //'fnExportPDF' => "exportPdf",
        'dataProvider' => $model,
        'columns' => [
            [
                'attribute' => 'DNI',
                'header' => Yii::t("formulario", "DNI 1"),
                'value' => 'nombres',
            ],  
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t("formulario", "Student"),
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        if (strlen($model['materia']) > 30) {
                            $texto = '...';
                        }
                        return Html::a('<span>' . substr($model['materia'], 0, 30) . $texto . '</span>', "javascript:", ["data-toggle" => "tooltip", "title" => $model['materia']]);
                    },
                ],
            ],
            [
                'attribute' => 'Carrera',
                'header' => Yii::t("formulario", "Date"),
                'value' => 'fecha',
            ],                       
            [
                'attribute' => 'periodo',
                'header' => Yii::t("formulario", "Period"),
                'value' => 'ip',
            ],
            [
                'attribute' => 'ips',
                'header' => academico::t("Academico", "End IP"),
                'value' => 'ip_salida',
            ],
        ],
    ])
    ?>
</div>   
