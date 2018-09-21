<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;

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
                'header' => Yii::t("formulario", "Request #"),
                'value' => 'solicitud',
            ],
            [
                'attribute' => 'fecha',
                'header' => Yii::t("solicitud_ins", "Application date"),
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
                'header' => Yii::t("formulario", "Method of Entry"),
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span>' . $model['abr_metodo'] . '</span>', Url::to(['listaraspirantes']), ["data-toggle" => "tooltip", "title" => $model['ming_nombre']]);
                    },
                ],
            ],
            [
                'attribute' => 'carrera',
                'header' => Yii::t("academico", "Career"),
                'value' => 'carrera',
            ],
            [
                'attribute' => 'beca',
                'header' => Yii::t("formulario", "Scholarship"),
                'value' => 'beca',
            ],      
           
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t("formulario", "Actions"),
                'template' => '{autoriza} ', //
                'buttons' => [                    
                    'autoriza' => function ($url, $model) {                                                                           
                        return Html::a('<span class="glyphicon glyphicon-download-alt"></span>', Url::to(['/admision/solicitudes/view', 'ids' => base64_encode($model['sins_id']), 'int' => base64_encode($model['int_id']), 'perid' => base64_encode($model['per_id'])]), ["data-toggle" => "tooltip", "title" => "Ver Documentos", "data-pjax" => 0]);                        
                    },   
                    /*'asigna' => function ($url, $model) {
                        if ($model['rol'] == 15 || $model['rol'] == 1) {
                            return Html::a('<span class="glyphicon glyphicon-edit"></span>', Url::to(['administracioncurso/asigna', 'popup' => "true", 'asp' => base64_encode($model['asp_id']), 'apellidos' => base64_encode($model['per_apellidos']), 'nombres' => base64_encode($model['per_nombres']), 'ming' => base64_encode($model['ming_id']), 'sins_id' => base64_encode($model['id_solicitud'])]), ["data-toggle" => "tooltip", "class" => "pbpopup", "title" => "Asignar/Reasignar Curso", "data-pjax" => 0]);
                        } else {
                            return '<span class = "glyphicon glyphicon-edit">  </span>';
                        }
                    },*/
                ],
            ],
        ],
    ])
    ?>
</div>