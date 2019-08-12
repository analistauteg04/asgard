<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
use app\widgets\PbSearchBox\PbSearchBox;
use kartik\date\DatePicker;
use app\models\Utilities;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;

?>

<div class="row">
    <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
        <?= 
            PbSearchBox::widget([
                'boxId' => 'boxgrid',
                'type' => 'searchBox',
                'placeHolder' => Yii::t("accion","Search"),
                'controller' => '',
                'callbackListSource' => 'searchModules',
                'callbackListSourceParams' => ["'boxgrid'","'grid_inscr_list'"],
            ]);
        ?>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
        <div class="form-group">
            <label for="lbl_inicio" class="col-sm-2 col-md-2 col-xs-2 col-lg-2 control-label"><?= Yii::t("formulario", "Start date") ?></label>
            <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3">
                <?=
                DatePicker::widget([
                    'name' => 'txt_fecha_ini',
                    'value' => '',
                    'type' => DatePicker::TYPE_INPUT,
                    'options' => ["class" => "form-control", "id" => "txt_fecha_ini", "placeholder" => Yii::t("formulario", "Start date")],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => Yii::$app->params["dateByDatePicker"],
                    ]]
                );
                ?>
            </div>
            <label for="lbl_fin" class="col-sm-2 col-md-2 col-xs-2 col-lg-2 control-label"><?= Yii::t("formulario", "End date") ?></label>
            <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3">
                <?=
                DatePicker::widget([
                    'name' => 'txt_fecha_fin',
                    'value' => '',
                    'type' => DatePicker::TYPE_INPUT,
                    'options' => ["class" => "form-control", "id" => "txt_fecha_fin", "placeholder" => Yii::t("formulario", "End date")],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => Yii::$app->params["dateByDatePicker"],
                    ]]
                );
                ?>
            </div>            
        </div>
    </div> 
</div>
<br />
<?=
    $this->render('index-grid', ['model' => $model,]);
?>