<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
  Created on : 23/04/2018
  Author     : Diana Lopez
 */

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbSearchBox\PbSearchBox;
use app\widgets\PbGridView\PbGridView;

?>
<?=

PbGridView::widget([
    'id' => 'grid_user_list',
    'showExport' => false,
    //'fnExportEXCEL' => "exportExcel",
    //'fnExportPDF' => "exportPdf",
    'dataProvider' => $model,
    'pajax' => true,
    'columns' => [
            ['class' => 'yii\grid\SerialColumn', 'options' => ['width' => '10']],
            [
            'header' => Yii::t("usuario", "Username"),
            'options' => ['width' => '180'],
            'value' => 'Username',
        ],
            [
            'attribute' => 'Nombres',
            'header' => Yii::t("perfil", "First Name"),
            'value' => 'Nombres',
        ],
            [
            'attribute' => 'Apellidos',
            'header' => Yii::t("perfil", "Last Name"),
            'value' => 'Apellidos',
        ],
            [
            'attribute' => 'Grupo',
            'header' => Yii::t("login_usuario", "Group"),
            'value' => 'Grupo',
        ],
            [
            'attribute' => 'Rol',
            'header' => Yii::t("login_usuario", "Rol"),
            'value' => 'Rol',
        ],
            [
            'class' => 'yii\grid\ActionColumn',
            //'header' => 'Action',
            'contentOptions' => ['style' => 'text-align: center;'],
            'headerOptions' => ['width' => '60'],
            'template' => '{view} {delete}',
            'buttons' => [
                'view' => function ($url, $model) {
                    // return Html::a('<span class="' . Utilities::getIcon('view') . '"></span>', Url::to(['usuario/view', 'id' => $model['id']]), ["data-toggle" => "tooltip", "title" => Yii::t("accion", "View")]);
                    //return  Html::a('Action', Url::to(['mceformulariotemp/solicitudpdf','ids' => 1],['class' => 'btn btn-default',"target" => "_blank"]));
                },
                'delete' => function ($url, $model) {
                    //return Html::a('<span class="' . Utilities::getIcon('remove') . '"></span>', null, ['href' => 'javascript:eliminar(\'' . $model['id'] . '\');', "data-toggle" => "tooltip", "title" => Yii::t("accion", "Delete")]);
                },
            ],
        ],
    ],
])
?>