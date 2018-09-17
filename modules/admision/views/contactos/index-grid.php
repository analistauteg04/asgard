<?php

use yii\helpers\Html;
use yii\helpers\Url;
use \app\models\Persona;
use app\widgets\PbGridView\PbGridView;
?>
<?= Html::hiddenInput('txth_ids', '', ['id' => 'txth_ids']); ?>
<div>        
    <?=
    PbGridView::widget([
        'id' => 'Pbcontacto',
        'dataProvider' => $model,
        'columns' => [
            [
                'attribute' => 'Contacto',
                'header' => Yii::t("crm", "Contact"),
                'value' => 'cliente',
            ],
            [
                'attribute' => 'Tipo persona',
                'header' => Yii::t("crm", "Contact Type"),
                'value' => 'des_tipo_persona',
            ],
            [
                'attribute' => 'Estado',
                'header' => Yii::t("crm", "Contact Status"),
                'value' => 'estado_contacto',
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
