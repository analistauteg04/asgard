<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
use app\modules\academico\Module as academico;
use app\modules\admision\Module as admision;
admision::registerTranslations();

?>
<?= Html::hiddenInput('txth_ids', '', ['id' => 'txth_ids']); ?>
<div>
    <?=
    PbGridView::widget([
        // 'dataProvider' => new yii\data\ArrayDataProvider(array()),
        'id' => 'TbG_PERSONAS',
        //'showExport' => false,
        //'fnExportEXCEL' => "exportExcel",
        //'fnExportPDF' => "exportPdf",
        'dataProvider' => $model,
        //'pajax' => false,
        'columns' =>
        [
            [
                'attribute' => 'solicitud',
                'header' => admision::t("Solicitudes", "Request #"),
                'value' => 'solicitud',
            ],
            [
                'attribute' => 'fecha',
                'header' => admision::t("Solicitudes", "Application date"),
                'value' => 'sins_fecha_solicitud',
            ],
            [
                'attribute' => 'DNI',
                'header' => Yii::t("formulario", "DNI 1"),           
                'value' => 'per_dni',
            ],
            [
                'attribute' => 'Nombres',
                'header' => Yii::t("formulario", "First Names"),
                'value' => 'per_nombres',
            ],
            [
                'attribute' => 'Apellidos',
                'header' => Yii::t("formulario", "Last Names"),
                'value' => 'per_apellidos',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => admision::t("Solicitudes", "Income Method"),
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span>' . $model['abr_metodo'] . '</span>', Url::to(['listaraspirantes']), ["data-toggle" => "tooltip", "title" => $model['ming_nombre']]);
                    },
                ],
            ],
            [
                'attribute' => 'carrera',
                'header' => academico::t("Academico", "Career/Program"),
                'value' => 'carrera',
            ],
            [
                'attribute' => 'beca',
                'header' => admision::t("Solicitudes", "Scholarship"),
                'value' => 'beca',
            ],      
           
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t("formulario", "Actions"),
                'template' => '{view} {matricula} {homologa}', //
                'buttons' => [                    
                    'view' => function ($url, $model) {                                                                           
                        return Html::a('<span class="glyphicon glyphicon-th-list"></span>', Url::to(['/admision/solicitudes/view', 'ids' => base64_encode($model['sins_id']), 'int' => base64_encode($model['int_id']), 'perid' => base64_encode($model['per_id'])]), ["data-toggle" => "tooltip", "title" => "Ver Solicitud", "data-pjax" => 0]);                        
                    },   
                    'matricula' => function ($url, $model) {                                                                           
                        return Html::a('<span class="glyphicon glyphicon-list-alt"></span>', Url::to(['/academico/matriculacion/newmetodoingreso', 'sids' => base64_encode($model['sins_id']), 'asp' => base64_encode($model['asp_id'])]), ["data-toggle" => "tooltip", "title" => "Matricular por Método Ingreso", "data-pjax" => 0]);                        
                    },   
                    'homologa' => function ($url, $model) {                                                                           
                        return Html::a('<span class="glyphicon glyphicon-check"></span>', Url::to(['/academico/matriculacion/newhomologacion', 'sids' => base64_encode($model['sins_id']), 'asp' => base64_encode($model['asp_id'])]), ["data-toggle" => "tooltip", "title" => "Matricular por Homologación", "data-pjax" => 0]);                        
                    },
                    
                ],
            ],
        ],
    ])
    ?>
</div>