<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;
use kartik\date\DatePicker;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\components\CFileInputAjax;
use app\widgets\PbGridView\PbGridView;
use app\modules\Academico\Module as Academico;
Academico::registerTranslations();
?>
<form class="form-horizontal">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="">
<?=
    PbGridView::widget([
        'id' => 'grid_investigacion_list',
        'showExport' => false,
        //'fnExportEXCEL' => "exportExcel",
        //'fnExportPDF' => "exportPdf",
        'dataProvider' => $model,
        'pajax' => true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn', 'options' => ['width' => '10']],
            [
                'attribute' => 'Denominancion',
                'header' => Academico::t("profesor", "Project Denomination") ,
                'value' => 'Denominancion',
            ],
            [
                'attribute' => 'Ambito',
                'header' => Academico::t("profesor", "Ambit"),
                'value' => 'Ambito',
            ],
            [
                'attribute' => 'Resposabilidad',
                'header' => Academico::t("profesor", "Resposability"),
                'value' => 'Resposabilidad',
            ],
            [
                'attribute' => 'Entidad',
                'header' => Academico::t("profesor", "Realization Entity"),
                'value' => 'Entidad',
            ], 
            [
                'attribute' => 'Anio',
                'header' => Academico::t("profesor", "Year"),
                'value' => 'Anio',
            ],
            [
                'attribute' => 'Duracion',
                'header' => Academico::t("profesor", "Time Duration"),
                'value' => 'Duracion',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                //'header' => 'Action',
                'contentOptions' => ['style' => 'text-align: center;'],
                'headerOptions' => ['width' => '60'],
                'template' => '',
                'buttons' => [
                    'delete' => function ($url, $model) {
                         return Html::a('<span class="'.Utilities::getIcon('remove').'"></span>', null, ['href' => 'javascript:confirmDelete(\'deleteItem\',[\'' . $model['per_id'] . '\']);', "data-toggle" => "tooltip", "title" => Yii::t("accion","Delete")]);
                    },
                ],
            ],
        ],
    ])
?>
        </div>
    </div>
</form>