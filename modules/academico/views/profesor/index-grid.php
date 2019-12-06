<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
use app\models\Utilities;
use app\modules\academico\Module as academico;
academico::registerTranslations();
?>

<?=
    PbGridView::widget([
        'id' => 'grid_profesor_list',
        'showExport' => false,
        //'fnExportEXCEL' => "exportExcel",
        //'fnExportPDF' => "exportPdf",
        'dataProvider' => $model,
        'pajax' => true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn', 'options' => ['width' => '10']],
            [
                'attribute' => 'PrimerNombre',
                'header' => Academico::t("profesor", "Name"),
                'value' => 'PrimerNombre',
            ],
            [
                'attribute' => 'PrimerApellido',
                'header' => Academico::t("profesor", "Surname"),
                'value' => 'PrimerApellido',
            ],
            [
                'attribute' => 'Celular',
                'header' => Academico::t("profesor", "Mobile"),
                'value' => 'Celular',
            ],
            [
                'attribute' => 'Correo',
                'header' => Academico::t("profesor", "Mail"),
                'value' => 'Correo',
            ], [
                'attribute' => 'Cedula',
                'header' => Academico::t("profesor", "Identification Card"),
                'value' => 'Cedula',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                //'header' => 'Action',
                'contentOptions' => ['style' => 'text-align: center;'],
                'headerOptions' => ['width' => '90'],
                'template' => '{view} {delete} {download} {pdf}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="'.Utilities::getIcon('view').'"></span>', Url::to(['profesor/view', 'id' => $model['per_id']]), ["data-toggle" => "tooltip", "title" => Yii::t("accion","View")]);
                    },
                    'delete' => function ($url, $model) {
                         return Html::a('<span class="'.Utilities::getIcon('remove').'"></span>', null, ['href' => 'javascript:confirmDelete(\'deleteItem\',[\'' . $model['per_id'] . '\']);', "data-toggle" => "tooltip", "title" => Yii::t("accion","Delete")]);
                    },
                    'download' => function ($url, $model) {
                        if($model['Cv'] != "")
                            return Html::a('<span class="'.Utilities::getIcon('download').'"></span>', 'javascript:', ["data-toggle" => "tooltip", "title" => Yii::t("accion","Download"), 'data-href' => Url::to(['profesor/download', 'route' => $model['Cv']]), 'onclick' => 'downloadPdf(this)']);
                   },
                   'pdf'=> function ($url, $model) {
                        if($model['Cv'] != "")
                            return Html::a('<span class="'.Utilities::getIcon('info').'"></span>', 'javascript:', ["data-toggle" => "tooltip", "title" => Yii::t("accion","View Document"), 'data-href' => Url::to(['profesor/download', 'route' => $model['Cv']]), 'onclick' => 'viewPdf(this)']);
                    },
                ],
            ],
        ],
    ])
?>
