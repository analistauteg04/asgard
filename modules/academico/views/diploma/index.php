<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
use app\widgets\PbSearchBox\PbSearchBox;
use app\models\Utilities;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use app\modules\academico\Module as academico;

academico::registerTranslations();

?>
<form class="form-horizontal">
    <div class="row">
        <div class="col-md-6">
            <?= 
                PbSearchBox::widget([
                    'boxId' => 'boxgrid',
                    'type' => 'searchBox',
                    'boxLabel' => Yii::t("accion","Search"),
                    'placeHolder' => Yii::t("accion","Search"). ": " . Yii::t("formulario", "First Names") .", ". Yii::t("formulario", "Last Names") .", ". academico::t("diploma", "DNI"),
                    'controller' => '',
                    'callbackListSource' => 'searchModules',
                    'callbackListSourceParams' => ["'boxgrid'","'grid_diploma_list'"],
                ]);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <label for="cmb_carrera" class="col-sm-3 control-label"><?= academico::t("matriculacion", "Career") ?></label>
            <div class="col-sm-9">
                <?= Html::dropDownList("cmb_carrera", "0", $arr_carreras, ["class" => "form-control", "id" => "cmb_carrera"]) ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <label for="cmb_programa" class="col-sm-3 control-label"><?= academico::t("diploma", "Program/Course") ?></label>
            <div class="col-sm-9">
                <?= Html::dropDownList("cmb_programa", "0", $arr_programas, ["class" => "form-control", "id" => "cmb_programa"]) ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <label for="cmb_modalidad" class="col-sm-3 control-label"><?= academico::t("matriculacion", "Modality") ?></label>
            <div class="col-sm-9">
                <?= Html::dropDownList("cmb_modalidad", "0", $arr_modalidades, ["class" => "form-control", "id" => "cmb_modalidad"]) ?>
            </div>
        </div>
    </div>
</form>
<br />
<?=
    $this->render('index-grid', ['model' => $model,]);
?>