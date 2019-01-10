<?php
/**
 * Este Archivo contiene las vista de Compañias
 * @author Ing. Byron Villacreses <byronvillacreses@gmail.com>
 * @copyright Copyright &copy; SolucionesVillacreses 2014-09-24
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
?>
<?=
PbGridView::widget([
    //'dataProvider' => new yii\data\ArrayDataProvider(array()),
    'id' => 'TbG_DOCUMENTO',
    'showExport' => true,
    'fnExportEXCEL' => "exportExcel",
    'fnExportPDF' => "exportPdf",
    'dataProvider' => $model,
    'columns' =>
        [
        [
            //'id' => 'chkId',
            'class' => 'app\widgets\PbGridView\PbCheckboxColumn',
            //'cssClassExpression' => '($data["Estado"]=="2")?"disabled":""',
            //'disabled' => '($data["Estado"]=="2")?true:false',
        ],
        [
            'attribute' => 'IdDoc',
            'header' => Yii::t('COMPANIA', 'IdDoc'),
            'value' => 'IdDoc',
            //'header' => false,
            //'filter' => false,
            //'headerHtmlOptions' => array('style' => 'width:0px; display:none; border:none; textdecoration:none'),
            'options' => array('style' => 'display:none; border:none;'),
        ],
        [
            'header' => Yii::t('COMPANIA', 'Download'),
            'class' => 'yii\grid\ActionColumn',
            'options' => array('style' => 'text-align:center', 'width' => '85px'),
            'template' => '{pdf}{xml}',
            'buttons' => array(
                'pdf' => function ($url, $model) {
                    return Html::a('<span class="text-danger fa fa-file-pdf-o"></span>', Url::to(['NubeFactura/GenerarPdf', 'ids' => base64_encode($model['IdDoc'])]), ["data-toggle" => "tooltip", "title" => Yii::t('COMPANIA', 'Download PDF document'), "data-pjax" => 0]);
                },
                'xml' => function ($url, $model) {
                    return Html::a('<span class="text-success fa fa-file-code-o"></span>', Url::to(['NubeFactura/XmlAutorizado', 'ids' => base64_encode($model['IdDoc'])]), ["data-toggle" => "tooltip", "title" => Yii::t('COMPANIA', 'Download XML document'), "data-pjax" => 0]);
                },
            ),
        ],
        [
            'attribute' => 'Estado',
            'header' => Yii::t('COMPANIA', 'Status'),
            'value' => 'VSacceso::estadoAprobacion($data["Estado"])',
        ],
        [
            'attribute' => 'NumDocumento',
            'header' => Yii::t('COMPANIA', 'Document Number'),
            'options' => array('style' => 'text-align:center'),
            'value' => '$data["NumDocumento"]',
        ],
        [
            'attribute' => 'FechaEmision',
            'header' => Yii::t('COMPANIA', 'Issuance date'),
            'value' => 'date(Yii::$app->params["dateByDefault"],strtotime($data["FechaEmision"]))',
        ],
        [
            'attribute' => 'UsuarioCreador',
            'header' => Yii::t('COMPANIA', 'Serving'),
            'value' => '$data["UsuarioCreador"]',
            'options' => array('style' => 'text-align:center'),
        ],
        [
            'attribute' => 'FechaAutorizacion',
            'header' => Yii::t('COMPANIA', 'Authorization date'),
            'value' => '($data["FechaAutorizacion"]<>"")?date(Yii::$app->params["dateByDefault"],strtotime($data["FechaAutorizacion"])):"";',
        ],
        [
            'attribute' => 'IdentificacionComprador',
            'header' => Yii::t('COMPANIA', 'Dni/Ruc'),
            'value' => '$data["IdentificacionComprador"]',
        ],
        [
            'attribute' => 'RazonSocialComprador',
            'header' => Yii::t('COMPANIA', 'Company name'),
            //'htmlOptions' => array('style' => 'text-align:left', 'width' => '300px'),
            'value' => '$data["RazonSocialComprador"]',
        ],
        [
            'attribute' => 'ValorModificacion',
            'header' => Yii::t('COMPANIA', 'Total amount'),
            //'value' => '$data["ImporteTotal"]',
            'value' => 'Yii::$app->format->formatNumber($data["ValorModificacion"])',
            'options' => array('style' => 'text-align:right', 'width' => '8px'),
        ],
    ],
]);
?>
