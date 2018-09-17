<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
?>
<?= Html::hiddenInput('txth_ids', '', ['id' => 'txth_ids']); ?>
<div>        
    <?=
    PbGridView::widget([
        'id' => 'Pbcontactot',
        'dataProvider' => $model,
        'columns' => [
            [
                'attribute' => 'Nombres Apellidos',
                'header' => Yii::t("crm", "Contact"),
                'value' => 'nombreapellido',
            ],
            [
                'attribute' => 'Telefono',
                'header' => Yii::t("formulario", "Phone"),
                'value' => 'celular',
            ],
            [
                'attribute' => 'Email',
                'header' => Yii::t("formulario", "Email"),
                'value' => 'correo',
            ],
//            [
//                'attribute' => 'Estado',
//                'header' => Yii::t("crm", "Contact Status"),
//                'value' => 'estado_persona',
//            ],
//            [
//                'attribute' => 'Observacion',
//                'header' => Yii::t("formulario", "Observation"),
//                'value' => 'observacion',
//            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t("formulario", "Actions"),
                'template' => '{update} {save}', //
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-check"></span>', "#", ["class" => "pbpopups", "onclick" => "showIframePopupRef(this)", "data-toggle" => "tooltip", "title" => "Detalle Contacto", "data-href" => Url::to(['gestion/detallecontacto', 'popup' => "true", 'ptemp_id' => base64_encode($model['id'])])]);
                    },
                    'save' => function ($url, $model) {                        
                        if($model['actualizado']=='1')
                            return Html::a('<span class="glyphicon glyphicon-save"></span>', "#", ["onclick" => "grabarContactoGestion(".$model['id'].");", "data-toggle" => "tooltip", "title" => "Guardar Contacto Gestion"]);
                    },
                ],
            ],
        ],
    ])
    ?>
</div>   
