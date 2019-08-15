<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
use app\models\Utilities;
use app\modules\repositorio\Module as repositorio;
use app\modules\academico\Module as academico;
use app\modules\financiero\Module as financiero;
repositorio::registerTranslations();
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
                'attribute' => 'pri_apellido',
                'header' => Yii::t("formulario", "Names"),
                'value' => function($data){
                    return ucwords(strtolower($data['pri_nombre'] . " " . $data['seg_nombre'] . " " . $data['pri_apellido'] . " " . $data['seg_apellido']));
                },
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
                'value' => function($data){
                    return Yii::$app->params["currency"] . $data['pago_inscripcion'];
                },
            ],
            [
                'attribute' => 'valor_maestria',
                'header' => financiero::t("Pagos", "Pago Total"),
                'value' => function($data){
                    return Yii::$app->params["currency"] . $data['valor_maestria'];
                },
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
                'header' => Yii::t("formulario", "Payment Status"),
                'value' => function($data){
                    $arr_estado = array("1" => Yii::t("formulario", "Pagado"), "2" => Yii::t("formulario", "No Pagado"), "3" => Yii::t("formulario", "Pagado Totalidad Maestria"));
                    switch($data["estado_pago"]){
                        case 1:
                            return '<small class="label label-success">'.$arr_estado[1].'</small>';
                        case 2:
                            return '<small class="label label-danger">'.$arr_estado[2].'</small>';
                        case 3:
                            return '<small class="label label-success">'.$arr_estado[3].'</small>';
                        default:
                            return '<small class="label label-danger">'.$arr_estado[2].'</small>';
                    }
                },
            ],
        ],
    ])
?>
