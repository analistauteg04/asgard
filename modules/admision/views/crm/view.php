<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\widgets\PbGridView\PbGridView;
use yii\helpers\Url;
use app\modules\admision\Module;

\app\modules\admision\views\app\resources\AppAssetBundle::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\Persona */

//$this->title = $model->DB_ID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Productos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

// home page URL: /index.php?r=site/index
echo Url::home() . "<br />";

// the base URL, useful if the application is deployed in a sub-folder of the Web root
echo Url::base() . "<br />";

echo Yii::$app->basePath . "<br />";

echo Yii::$app->controller->route ."<br />";
echo "Controller: ". Yii::$app->controller->id ."<br />";
echo "Action: ". Yii::$app->controller->action->id ."<br />";
echo "Module: ". Yii::$app->controller->module->id ."<br />";

// the canonical URL of the currently requested URL
// see https://en.wikipedia.org/wiki/Canonical_link_element
echo Url::canonical() . "<br />";

// remember the currently requested URL and retrieve it back in later requests
Url::remember();
echo Url::previous() . "<br />";

echo Module::t("Producto", "Product") . "<br />";
echo Module::t("prueba", "word") . "<br />";
echo Yii::t("test", "test") . "<br />";
echo Yii::t("app", "test") . "<br />";
echo Yii::$app->view->theme->themeName . "<br />";
echo Yii::$app->language . "<br />";
$columnas = array();
$headcolumn = array();
?>
<?php 
$query = array();
if(isset($_REQUEST['PBgetFilter']) && $_REQUEST['PBgetFilter'] == true){
    $query = \app\models\Usuario::findByCondition(["usu_username" => $_REQUEST['usu_username']]);
}else{
    $query = \app\models\Usuario::find();
}
?>
<div class="producto-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->DB_ID], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->DB_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'DB_ID',
            'DB_NOMBRE',
            'DB_MODELO',
            'DB_ESTADO',
        ],
    ])
    ?>

    
    <?=
    PbGridView::widget([
        //'dataProvider' => new yii\data\ArrayDataProvider(array()),
        'id' => 'gridPB',
        //'autoUpdate' => true,
        //'timepajax' => 10000,
        //'summary' => "",
        'dataProvider' => new yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 1,
            ],
            'sort' => [
                'attributes' => [
                    'usu_username',
                    'usu_fecha_creacion',
                ],
            ],
                ]),
        //'filterModel' => $model, // para que aparezcan los filtros
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // format one
            [
                'attribute' => 'usu_username',
                'label' => 'Username',
                'contentOptions' => function ($model, $key, $index, $column) {
                    return ['class' => 'tbl_column_name'];
                },
            ],
            // format two
            [
                'attribute' => 'usu_sha',
                'contentOptions' => ['class' => 'table_class', 'style' => 'display:block;'],
                'content' => function($data) {
                    return "value";
                }
            ],
            [
                'attribute' => 'usu_estado_activo',
                'label' => 'Es activo',
                'filter' => array("1" => "Active", "2" => "Inactive"),
            ],
            'usu_fecha_creacion',
            [
                'label' => 'Custom Link',
                'format' => 'raw', //raw, html, text
                'value' => function($data) {
                    $url = "http://www.bsourcecode.com";
                    return Html::a('Go Link', $url, ['title' => 'Go']);
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {link}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-user"></span>', $url);
                    },
                    'link' => function ($url, $model, $key) {
                        return Html::a('Action', $url);
                    },
                ],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Action',
                'headerOptions' => ['width' => '80'],
                'template' => '{view} {update} {delete}{link}',
            ],
        ],
    ])
    ?>
    
</div>
