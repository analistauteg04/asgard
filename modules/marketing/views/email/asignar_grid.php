<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
use app\modules\marketing\Module as marketing;
use app\modules\academico\Module as academico;
use app\modules\admision\Module as crm;

academico::registerTranslations();
crm::registerTranslations();
?>
    <?=

    PbGridView::widget([
        //'dataProvider' => new yii\data\ArrayDataProvider(array()),
        'id' => 'Tbg_SubsLista',
        'showExport' => true,
        'fnExportEXCEL' => "exportExcel",
        'fnExportPDF' => "exportPdf",
        'dataProvider' => $model,
        'columns' =>
        [
            [
                'attribute' => 'Contacto',
                'header' => crm::t("crm", "Contact"),
                'value' => 'contacto',
            ],
            [
                'attribute' => 'Carrera',
                'header' => academico::t("Academico", "Career/Program"),
                'value' => 'carrera',
            ],
            [
                'attribute' => 'Correo',
                'header' => marketing::t("marketing", "Email"),
                'value' => 'per_correo',
            ],
            [
                'attribute' => 'Subscriptor',
                'header' => marketing::t("marketing", "Estado"),
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
                'format' => 'html',
                'value' => function ($model) {
                    if (strtolower($model["estado"]) == "subscrito")
                        return '<small class="label label-success">' . $model["estado"] . '</small>';
                    else
                        return '<small class="label label-danger">' . $model["estado"] . '</small>';
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t("formulario", "Actions"),
                'template' => '{addsubs} {addsublistinte} {rmsubs}',
                'buttons' => [
                    'addsubs' => function ($url, $model) {
                        if (($model["estado"] == 'Subscrito')) {
                            return '<span class="glyphicon glyphicon-plus"></span>';
                        } else {
                            return Html::a('<span class="glyphicon glyphicon-plus"></span>', "#", ["onclick" => "preguntasuscribirContacto(" . $model['id_psus'] . "," . $model['per_tipo'] . "," . $model['lis_id'] .");", "data-toggle" => "tooltip", "title" => "Suscribirse a la lista", "data-pjax" => 0]);
                        }
                    },
                    'rmsubs' => function ($url, $model) {
                        if ($model["estado"] == 'Subscrito') {
                            return Html::a('<span class="glyphicon glyphicon-remove"></span>', "#", ["onclick" => "RemoverSuscritor(" . $model['id_sus'] . ");", "data-toggle" => "tooltip", "title" => "Eliminar Suscritor", "data-pjax" => 0]);
                        } else {
                            return "<span class = 'glyphicon glyphicon-remove' data-toggle = 'tooltip' title ='No se puede remover un contacto que no se haya suscrito'  data-pjax = 0></span>";
                        }
                    },
                ],
            ],
        ],
    ])
    ?>