<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
use app\models\Utilities;

?>
<?=
    PbGridView::widget([
        //'dataProvider' => new yii\data\ArrayDataProvider(array()),
        'id' => 'TbG_PERSONAS',
        'showExport' => true,
        'fnExportEXCEL' => "exportExcel",
        //'fnExportPDF' => "exportPdf",
        'dataProvider' => $model,
        'columns' =>
        [
            [
                'attribute' => 'Solicitud #',
                'header' => Yii::t("formulario", "Request #"),
                'value' => 'num_solicitud',
            ],
            [
                'attribute' => 'Fecha Solicitud ',
                'header' => Yii::t("solicitud_ins", "Application date"),
                'value' => 'fecha_solicitud',
            ],
            [
                'attribute' => 'DNI',
                'header' => Yii::t("formulario", "DNI 1"),
                'value' => 'per_dni',
            ],
            [
                'attribute' => 'Nombres',
                'header' => Yii::t("formulario", "First Names"),
                //'value' => 'per_nombres',
                'value' => 'per_pri_nombre',
            ],
            [
                'attribute' => 'Apellidos',
                'header' => Yii::t("formulario", "Last Names"),
                'value' => 'per_apellidos',
                
            ],
            [
                'attribute' => 'Nivel Interes',
                'header' => Yii::t("formulario", "Academic unit"),
                'value' => 'nint_nombre',
            ],
            [
                'attribute' => 'Metodo Ingreso',
                'header' => Yii::t("solicitud_ins", "Income Method"),
                'value' => 'ming_nombre',
            ],
            [
                'attribute' => 'Carrera',
                'header' => Yii::t("academico", "Career") . "/". Yii::t("formulario", "Program"),
                'value' => 'carrera',
            ],
            [
                'attribute' => 'Estado',
                'header' => Yii::t("formulario", "Status"),
                'value' => 'estado',
            ],
            [
                'attribute' => 'Pago',
                'header' => 'Pago',
                'value' => 'estado_pago',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t("formulario", "Actions"),
                'template' => '{view}{update}', //
                'buttons' => [
                    'view' => function ($url, $model) {
                        if ($model['estado_pago'] != 'No Disponible') {
                            return Html::a('<span class="glyphicon glyphicon-download-alt"></span>', Url::to(['registrarpago/listarpagosolicitud', 'ids' => base64_encode($model['persona'])]), ["data-toggle" => "tooltip", "title" => "Listar Pagos", "data-pjax" => 0]);
                        }
                        else {
                            return '<span class="glyphicon glyphicon-download-alt"></span>';
                        }
                    },
                    'update' => function ($url, $model) {
                        if ($model['nint_id'] != 3) {
                            if ($model['numDocumentos'] == 0)  {    
                                if ($model['rsin_id'] == 1) {
                                    return Html::a('<span class="glyphicon glyphicon-upload"></span>', Url::to(['solicitudinscripcion/subirdocumentos', 'ids' => base64_encode($model['persona']), 'sins_id' => base64_encode($model['sins_id']), 'solicitud' => base64_encode($model['num_solicitud']), 'int_id' => base64_encode($model['int_id']), 'beca' => base64_encode($model['beca']), 'apellidos' => base64_encode($model['per_apellidos']), 'nombres' => base64_encode($model['per_nombres']), 'nacionalidad' => base64_encode($model['per_nac_ecuatoriano'])]), ["data-toggle" => "tooltip", "title" => "Subir Documentos", "data-pjax" => 0]);
                                } else {
                                    return '<span class="glyphicon glyphicon-upload"></span>';
                                }
                            }   else {
                                return '<span class="glyphicon glyphicon-upload"></span>';
                            }
                        }
                    }
                ],
            ],
        ],
    ])
    ?>