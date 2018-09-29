<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
use app\modules\academico\Module as academico;
use app\modules\admision\Module as admision;
admision::registerTranslations();
academico::registerTranslations();

?>
<?= Html::hiddenInput('txth_ids', '', ['id' => 'txth_ids']); ?>
<div>
    <?=
    PbGridView::widget([
        'id' => 'TbG_PERSONAS',
        'showExport' => true,
        'fnExportEXCEL' => "exportExcel",
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
                        return Html::a('<span>' . $model['abr_metodo'] . '</span>', Url::to(['#']), ["data-toggle" => "tooltip", "title" => $model['ming_nombre']]);
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
                'attribute' => 'matriculado',
                'header' => academico::t("Academico", "Registered"),
                'value' => 'matriculado',
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
                        if ($model["matriculado"]=='NO') {
                            return Html::a('<span class="glyphicon glyphicon-list-alt"></span>', Url::to(['/academico/matriculacion/newmetodoingreso', 'sids' => base64_encode($model['sins_id']), 'adm' => base64_encode($model['adm_id'])]), ["data-toggle" => "tooltip", "title" => "Matricular por Método Ingreso", "data-pjax" => 0]);                        
                        } else {
                            return '<span class="glyphicon glyphicon-th-list"></span>';
                        }
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