<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
use yii\data\ArrayDataProvider;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
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
                //'options' => ['width' => '180'],
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
            /*[
                'attribute' => 'codigo',
                'header' => Yii::t("academico", "Code"),
                'value' => 'can',
            ],*/
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t("formulario", "Course"),
                'template' => '{view}', //
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span>' . $model['curso'] . '</span>', Url::to(['listaraspirantes']), ["data-toggle" => "tooltip", "title" => $model['periodo']]);
                    },
                ],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t("formulario", "Actions"),
                'template' => '{update} {autoriza} {asigna} {modasigna}', //
                'buttons' => [
                    'update' => function ($url, $model) {
                        if ($model['rol'] == 15 || $model['rol'] == 1 || $model['rol'] == 17) {
                            return Html::a('<span class="glyphicon glyphicon-check"></span>', Url::to(['ficha/verfichaxinteresado', 'ids' => base64_encode($model['per_id'])]), ["data-toggle" => "tooltip", "title" => "Ver Ficha", "data-pjax" => 0]);
                        } else {
                            return '<span class = "glyphicon glyphicon-check">  </span>';
                        }
                    },
                    'autoriza' => function ($url, $model) {
                        if ($model['rol'] == 15 || $model['rol'] == 1 || $model['rol'] == 17) {
                            return Html::a('<span class="glyphicon glyphicon-download-alt"></span>', Url::to(['aspirante/documentosaspirantes', 'sol_id' => base64_encode($model['id_solicitud']), 'ids' => base64_encode($model['per_id']), 'int' => base64_encode($model['int_id']), 'perid' => base64_encode($model['persona']), 'apellidos' => base64_encode($model['per_apellidos']), 'nombres' => base64_encode($model['per_nombres']), 'nint_nombre' => base64_encode($model['nint_nombre']), 'car_nombre' => base64_encode($model['car_nombre'])]), ["data-toggle" => "tooltip", "title" => "Ver Archivos", "data-pjax" => 0]);
                        } else {
                            return '<span class = "glyphicon glyphicon-download-alt">  </span>';
                        }
                    },
                    'asigna' => function ($url, $model) {
                        if ($model['rol'] == 15 || $model['rol'] == 1) {
                            return Html::a('<span class="glyphicon glyphicon-edit"></span>', Url::to(['administracioncurso/asigna', 'popup' => "true", 'asp' => base64_encode($model['asp_id']), 'apellidos' => base64_encode($model['per_apellidos']), 'nombres' => base64_encode($model['per_nombres']), 'ming' => base64_encode($model['ming_id']), 'sins_id' => base64_encode($model['id_solicitud'])]), ["data-toggle" => "tooltip", "class" => "pbpopup", "title" => "Asignar/Reasignar Curso", "data-pjax" => 0]);
                        } else {
                            return '<span class = "glyphicon glyphicon-edit">  </span>';
                        }
                    },
                ],
            ],
        ],
    ])
    ?>
</div>