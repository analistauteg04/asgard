<?php

use yii\helpers\Html;
use yii\helpers\Url;
use \app\models\Persona;
use app\widgets\PbGridView\PbGridView;
use app\modules\admision\Module;
use app\modules\admision\Module as admision;
use app\modules\academico\Module as academico;

admision::registerTranslations();
?>
<?= Html::hiddenInput('txth_ids', '', ['id' => 'txth_ids']); ?>
<div>        
    <?=
    PbGridView::widget([
        'id' => 'Pbcontacto',
        'showExport' => true,
        //'fnExportEXCEL' => "exportExcel",
        //'fnExportPDF' => "exportPdf",
        'dataProvider' => $model,
        'columns' => [
            [
                'attribute' => 'Fecha',
                'header' => Yii::t("formulario", "Date"),
                'value' => 'cliente',
            ],
            [
                'attribute' => 'Horaini',
                'header' => academico::t("Academico", "Hour start date"),
                'value' => 'pges_codigo',
            ],
            [
                'attribute' => 'Horainipon',
                'header' => academico::t("Academico", "Hour end date"). ' '. academico::t("Academico", "Expected"),
                'value' => 'pais',
            ],
            [
                'attribute' => 'Horafin',
                'header' => academico::t("Academico", "Hour start date"),
                'value' => 'fecha_creacion',
            ],
            [
                'attribute' => 'Horafinpon',
                'header' => academico::t("Academico", "Hour end date"). ' '. academico::t("Academico", "Expected"),
                'value' => 'unidad_academica',
            ],
            [
                'attribute' => 'Ip',
                'header' => academico::t("Academico", "IP Marcación"),
                'value' => 'empresa',
            ],
            /*[
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t("formulario", "Actions"), 
                'template' => '{view} {opportunities}', 
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::to(['contactos/view', 'codigo' => base64_encode($model["pestion_id"]), 'tper' => base64_encode($model["tipo_persona"])]), ["data-toggle" => "tooltip", "title" => "Ver Contacto", "data-pjax" => 0]);
                    },
                    'opportunities' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-th-large"></span>', Url::to(['contactos/listaroportunidad', 'pgid' => base64_encode($model['pestion_id'])]), ["data-toggle" => "tooltip", "title" => "Lista de Oportunidades", "data-pjax" => 0]);
                    },
                ],
            ],*/
        ],
    ])
    ?>
</div>   
