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
        'id' => 'PbMarcacion',
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
                'attribute' => 'materia',
                'header' => Yii::t("formulario", "Matter"),
                'value' => 'materia',
            ],
            [
                'attribute' => 'Fecha',
                'header' => Yii::t("formulario", "Date"),
                'value' => 'fecha',
            ],
            [
                'attribute' => 'Horaini',
                'header' => academico::t("Academico", "Hour start date"),
                'value' => 'hora_inicio',
            ],
            [
                'attribute' => 'Horainipon',
                'header' => academico::t("Academico", "Hour start date") . ' ' . academico::t("Academico", "Expected"),
                'value' => 'inicio_esperado',
            ],
            [
                'attribute' => 'Horafin',
                'header' => academico::t("Academico", "Hour end date"),
                'value' => 'hora_salida',
            ],
            [
                'attribute' => 'Horafinpon',
                'header' => academico::t("Academico", "Hour end date") . ' ' . academico::t("Academico", "Expected"),
                'value' => 'salida_esperada',
            ],
            [
                'attribute' => 'ip',
                'header' => academico::t("Academico", "IP Marcación"),
                'value' => 'ip',
            ],
        ],
    ])
    ?>
</div>   
