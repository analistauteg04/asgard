<?php

use yii\helpers\Html;
use yii\helpers\Url;
use \app\models\Persona;
use app\widgets\PbGridView\PbGridView;
use app\modules\admision\Module;
use app\modules\admision\Module as admision;
admision::registerTranslations();
?>
<?= Html::hiddenInput('txth_ids', '', ['id' => 'txth_ids']); ?>
<div>        
    <?=
    PbGridView::widget([
        'id' => 'Pbcontacto',
        'showExport' => true,
        'fnExportEXCEL' => "exportExcel",
        'fnExportPDF' => "exportPdf",
        'dataProvider' => $model,
        'columns' => [
            [
                'attribute' => 'Contacto',
                'header' => Module::t("crm", "Contact"),
                'value' => 'cliente',
            ],
            [
                'attribute' => 'Pais',
                'header' => Yii::t("formulario", "Country"),
                'value' => 'pais',
            ],
            [
                'attribute' => 'Fecha',
                'header' => Yii::t("formulario", "Date"),
                'value' => 'fecha_creacion',
            ],
            [
                'attribute' => 'empresa',
                'header' => Yii::t("formulario", "Company"),
                'value' => 'empresa',
            ],
            [
                'attribute' => 'unidad_academica',
                'header' => Yii::t("formulario", "Academic unit"),
                'value' => 'unidad_academica',
            ],
            [
                'attribute' => 'Canal',
                'header' => Module::t("crm", "Knowledge channel"),
                'value' => 'canal',
            ],
            [
                'attribute' => 'Usuario',
                'header' => Yii::t("formulario", "User login"),
                'value' => 'usuario_ing',
            ],
            [
                'attribute' => 'NumOportunidadesAbiertas',
                'header' => Yii::t("formulario", "Open Opportunities"),
                'value' => 'num_oportunidad_abiertas',
            ],
            [
                'attribute' => 'NumOportunidadesCerradas',
                'header' => Yii::t("formulario", "Close Opportunities"),
                'value' => 'num_oportunidad_cerradas',
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t("formulario", "Actions"),//{update} 
                'template' => '{view} {opportunities}', //    
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::to(['contactos/view', 'codigo' => base64_encode($model["pestion_id"]), 'tper' => base64_encode($model["tipo_persona"])]), ["data-toggle" => "tooltip", "title" => "Ver Contacto", "data-pjax" => 0]);
                    },
                    //'update' => function ($url, $model) {
                    //    return Html::a('<span class="glyphicon glyphicon-edit"></span>', Url::to(['admisiones/actualizarcontacto', 'codigo' => base64_encode($model["pestion_id"]), 'tper_id' => base64_encode($model["tipo_persona"])]), ["data-toggle" => "tooltip", "title" => "Modificar Contacto", "data-pjax" => 0]);
                    //},
                    'opportunities' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-th-large"></span>', Url::to(['contactos/listaroportunidad', 'pgid' => base64_encode($model['pestion_id'])]), ["data-toggle" => "tooltip", "title" => "Lista de Oportunidades", "data-pjax" => 0]);
                    },
                ],
            ],
        ],
    ])
    ?>
</div>   
