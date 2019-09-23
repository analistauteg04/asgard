<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
use app\models\Utilities;
?>

<?=
    PbGridView::widget([
        'id' => 'grid_personaext_list',
        'showExport' => false,
        'fnExportEXCEL' => "exportExcel",
        'fnExportPDF' => "exportPdf",
        'dataProvider' => $model,
        'pajax' => true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn', 'options' => ['width' => '10']],
            [
                'attribute' => 'Nombres',
                'header' => Yii::t("formulario", "Names"),
                'value' => 'Nombres',
            ],
            [
                'attribute' => 'Apellidos',
                'header' => Yii::t("formulario", 'Last Names'),
                'value' => 'Apellidos',
            ],
            [
                'attribute' => 'Dni',
                'header' => Yii::t("formulario", "Dni"),
                'value' => 'Dni',
            ],
            [
                'attribute' => 'Correo',
                'header' => Yii::t("perfil", 'Email'),
                'value' => 'Correo',
            ],
            [
                'attribute' => 'Celular',
                'header' => Yii::t("perfil", 'CellPhone'),
                'value' => 'Celular',
            ],
            [
                'attribute' => 'Telefono',
                'header' => Yii::t("perfil", 'Phone'),
                'value' => 'Telefono',
            ],
            [
                'attribute' => 'Genero',
                'header' => Yii::t("perfil", 'Sex'),
                'value' => 'Genero',
            ],
            [
                'attribute' => 'FechaNacimiento',
                'header' => Yii::t("perfil", 'Birth Date'),
                'value' => 'FechaNacimiento',
            ],
            [
                'attribute' => 'Provincia',
                'header' => Yii::t("general", 'State'),
                'value' => 'Provincia',
            ],
            [
                'attribute' => 'Canton',
                'header' => Yii::t("general", 'City'),
                'value' => 'Canton',
            ],
            /*[
                'attribute' => 'Evento',
                'header' => 'Evento',
                'value' => 'Evento',
            ],*/
            /*[
                'attribute' => 'NivelInteres',
                'header' => Yii::t("general", 'City'),
                'value' => 'Canton',
            ],*/
            [
                'attribute' => 'FechaRegistro',
                'header' => 'Fecha Registro',
                'value' => 'FechaRegistro',
            ],
            [
                'attribute' => 'Estado',
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
                'format' => 'html',
                'header' => Yii::t("general", "Status"),
                'value' => function($data){
                    if($data["Estado"] == "1")
                        return '<small class="label label-success">'.Yii::t("general", "Enabled").'</small>';
                    else
                        return '<small class="label label-danger">'.Yii::t("general", "Disabled").'</small>';
                },
            ],
        ],
    ])
?>