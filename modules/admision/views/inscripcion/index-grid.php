<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
use app\models\Utilities;
use app\modules\repositorio\Module as repositorio;
use app\modules\academico\Module as academico;
use app\modules\financiero\Module as financiero;
academico::registerTranslations();
financiero::registerTranslations();
?>


<?=
    PbGridView::widget([
        'id' => 'grid_inscr_list',
        'showExport' => true,
        'fnExportEXCEL' => "exportExcel",
        //'fnExportPDF' => "exportPdf",
        'dataProvider' => $model,
        'pajax' => true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn', 'options' => ['width' => '10']],
            [
                'attribute' => 'grupoIntroductorio',
                'header' => repositorio::t("repositorio", "Grupo Introductorio"),
                'value' => 'grupoIntroductorio',
            ],
            [
                'attribute' => 'convenio',
                'header' => repositorio::t("repositorio", "Tipo Convenio"),
                'value' => 'convenio',
            ],
            [
                'attribute' => 'dni',
                'header' => financiero::t("Pagos", "Documento"),
                'value' => 'dni',
            ],
            [
                'attribute' => 'nombres',
                'header' => Yii::t("formulario", "Names"),
                'value' => 'nombres',
            ],
            [
                'attribute' => 'pais',
                'header' => repositorio::t("repositorio", "Pais"),
                'value' => 'pais',
            ],
            [
                'attribute' => 'provincia',
                'header' => repositorio::t("repositorio", "Provincia"),
                'value' => 'provincia',
            ],
            [
                'attribute' => 'canton',
                'header' => repositorio::t("repositorio", "Cantón"),
                'value' => 'canton',
            ],
            [
                'attribute' => 'fecha_inscripcion',
                'header' => repositorio::t("repositorio", "Fecha inscripción"),
                'value' => 'fecha_inscripcion',
            ],
            [
                'attribute' => 'fecha_pago',
                'header' => repositorio::t("repositorio", "Fecha pago"),
                'value' => 'fecha_pago',
            ],
            [
                'attribute' => 'pago_inscripcion',
                'header' => financiero::t("Pagos", "Pago Inscripción"),
                'value' => 'pago_inscripcion',
            ],
            [
                'attribute' => 'valor_maestria',
                'header' => financiero::t("Pagos", "Pago Total"),
                'value' => 'valor_maestria',
            ],
            [
                'attribute' => 'forma_pago',
                'header' => repositorio::t("repositorio", "Método Pago"),
                'value' => 'forma_pago',
            ],
            [
                'attribute' => 'agente',
                'header' => financiero::t("Pagos", "Agente"),
                'value' => 'agente',
            ],
            [
                'attribute' => 'estado_pago',
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
                'format' => 'html',
                'header' => Yii::t("rol", "Status Role"),
                'value' => function($data){
                    if($data["estado_pago"] == "1")
                        return '<small class="label label-success">'.Yii::t("rol", "Role Enabled").'</small>';
                    else
                        return '<small class="label label-danger">'.Yii::t("rol", "Role Disabled").'</small>';
                },
            ],
        ],
    ])
?>
