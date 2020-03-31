<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
use app\models\Utilities;
use app\modules\academico\Module as academico;
use yii\grid\CheckboxColumn;
academico::registerTranslations();
?>

<?=
    PbGridView::widget([
        'id' => 'grid_registro_list',
        'showExport' => false,
        //'fnExportEXCEL' => "exportExcel",
        //'fnExportPDF' => "exportPdf",
        /* 'dataProvider' => $model, */
        'summary' => '',
        'dataProvider' => $planificacion,
        'pajax' => true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn', 'options' => ['width' => '10']],            
            [
                'attribute' => 'Subject',
                'header' => Academico::t("matriculacion", "Subject"),
                'value' => 'Subject',
            ],     
            [
                'attribute' => 'Subject',
                'header' => Academico::t("matriculacion", "Block"),
                'value' => function($data) use ($materiasxEstudiante){
                    if(strtoupper($data["Subject"]) == strtoupper($materiasxEstudiante->pes_mat_b1_h1_nombre)) return "B1";
                    if(strtoupper($data["Subject"]) == strtoupper($materiasxEstudiante->pes_mat_b1_h2_nombre)) return "B1";
                    if(strtoupper($data["Subject"]) == strtoupper($materiasxEstudiante->pes_mat_b1_h3_nombre)) return "B1";
                    if(strtoupper($data["Subject"]) == strtoupper($materiasxEstudiante->pes_mat_b1_h4_nombre)) return "B1";
                    if(strtoupper($data["Subject"]) == strtoupper($materiasxEstudiante->pes_mat_b1_h5_nombre)) return "B1";
                    if(strtoupper($data["Subject"]) == strtoupper($materiasxEstudiante->pes_mat_b2_h1_nombre)) return "B2";
                    if(strtoupper($data["Subject"]) == strtoupper($materiasxEstudiante->pes_mat_b2_h2_nombre)) return "B2";
                    if(strtoupper($data["Subject"]) == strtoupper($materiasxEstudiante->pes_mat_b2_h3_nombre)) return "B2";
                    if(strtoupper($data["Subject"]) == strtoupper($materiasxEstudiante->pes_mat_b2_h4_nombre)) return "B2";
                    if(strtoupper($data["Subject"]) == strtoupper($materiasxEstudiante->pes_mat_b2_h5_nombre)) return "B2";
                },
            ],                   
        ]
    ])
?>