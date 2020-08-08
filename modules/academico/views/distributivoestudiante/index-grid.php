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
                'attribute' => 'Nombres',
                'header' => academico::t("matriculacion", "Student"),
                'value' => 'Nombres',
            ],
            [
                'attribute' => 'Cedula',
                'header' => Yii::t("formulario", "DNI 1"),
                'value' => 'Cedula',
            ],   
            [
                'attribute' => 'Correo',
                'header' => Yii::t("formulario", "Email"),
                'value' => 'Correo',
            ],   
            [
                'attribute' => 'Telefono',
                'header' => Yii::t("formulario", "Phone"),
                'value' => 'Telefono',
            ],
            [
                'attribute' => 'Matricula',
                'header' => academico::t("matriculacion", "Registration Number"),
                'value' => 'Matricula',
            ],
            [
                'attribute' => 'Carrera',
                'header' => academico::t("matriculacion", "Career"),
                'value' => 'Carrera',
            ],          
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '',
                'template' => '{view}{delete}{add}',
                'contentOptions' => ['class' => 'text-center'],
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="'.Utilities::getIcon('view').'"></span>', Url::to(['distributivoacademico/view', 'id' => $model['Id']]), ["data-toggle" => "tooltip", "title" => Yii::t("accion","View")]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="'.Utilities::getIcon('remove').'"></span>', null, ['href' => 'javascript:confirmDelete(\'deleteItem\',[\'' . $model['Id'] . '\']);', "data-toggle" => "tooltip", "title" => Yii::t("accion","Delete")]);
                    },
                    'add' => function ($url, $model){
                        return Html::a('<span class="fa fa-user-plus"></span>', Url::to(['distributivoestudiante/index', 'id' => $model['Id']]), ["data-toggle" => "tooltip", "title" => academico::t("distributivoacademico","Add Student")]);
                    }
                ],               
            ],                                
        ],
    ])
    ?>
</div>