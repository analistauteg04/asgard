<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
use app\models\Utilities;
use app\modules\academico\Module as academico;
use app\modules\admision\Module as admision;

admision::registerTranslations();
academico::registerTranslations();
?>
<div>
    <?=
    PbGridView::widget([
        'id' => 'Tbg_Distributivo_Aca',
        'showExport' => true,
        'fnExportEXCEL' => "exportExcel",
        'fnExportPDF' => "exportPdf",
        'dataProvider' => $model,
        //'pajax' => false,
        'columns' =>
        [
            [
                'attribute' => 'Periodo',
                'header' => Yii::t("formulario", "Period"),
                'value' => 'Periodo',
            ],
            [
                'attribute' => 'Cedula',
                'header' => Yii::t("formulario", "DNI 1"),
                'value' => 'Cedula',
            ],       
            [
                'attribute' => 'Nombres',
                'header' => academico::t("Academico", "Teacher"),
                'value' => 'Nombres',
            ],  
            [
                'attribute' => 'Estado',
                'header' => Yii::t("formulario", "Status"),
                'value' => 'estadoRevision',
            ],    
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '',
                'template' => '{view}{delete}{Approbe}{Download}',
                'contentOptions' => ['class' => 'text-center'],
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="'.Utilities::getIcon('view').'"></span>', Url::to(['distributivoacademico/view', 'id' => $model['Id']]), ["data-toggle" => "tooltip", "title" => Yii::t("accion","View")]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="'.Utilities::getIcon('remove').'"></span>', null, ['href' => 'javascript:confirmDelete(\'deleteItem\',[\'' . $model['Id'] . '\']);', "data-toggle" => "tooltip", "title" => Yii::t("accion","Delete")]);
                    },
                    'Approbe' => function ($url, $model){
                        if ($model['estado'] == 1 or $model['estado'] == 3 ) {
                            return Html::a('<span class="'.Utilities::getIcon('edit').'"></span>', Url::to(['distributivocabecera/review', 'id' => $model['Id']]), ["data-toggle" => "tooltip", "title" => Yii::t("formulario","Revisar Distributivo")]);
                        } else {
                          return "<span class = 'glyphicon glyphicon-ok' data-toggle = 'tooltip' title ='Revisar Distributivo'  data-pjax = 0></span>";  
                        }
                    },
                    'Download' => function ($url, $model){
                        return Html::a('<span class="'.Utilities::getIcon('download').'"></span>', Url::to(['distributivocabecera/descargar', 'id' => $model['Id']]), ["data-toggle" => "tooltip", "title" => Yii::t("accion","Download")]);
                    }
                ],               
            ],                                
        ],
    ])
    ?>
</div>