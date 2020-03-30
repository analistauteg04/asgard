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
$modalidad = array_unshift($arr_modalidad, "Todos");
?>
<form class="form-horizontal">    
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="txt_estudiante" class="col-sm-3 control-label"><?= academico::t("matriculacion", 'Student') ?></label>
                <div class="col-sm-9 search-aprobacion">
                    <?=
                        PbSearchBox::widget([
                            'boxId' => 'boxgrid',
                            'type' => 'searchBox',
                            'placeHolder' => Yii::t("accion", "Search"),
                            'controller' => '',
                            'callbackListSource' => 'searchModules',
                            'callbackListSourceParams' => ["'boxgrid'", "'grid_paises_list'"],
                        ]);
                    ?>
                </div>            
            </div>
            <div class="form-group">
                <label for="cmb_per_academico" class="col-sm-3 control-label"><?= academico::t("matriculacion", 'Academic Period') ?></label>
                <div class="col-sm-9">
                    <?= Html::dropDownList("cmb_per_academico", $pla_periodo_academico, $arr_pla, ["class" => "form-control", "id" => "cmb_per_academico"]) ?>
                </div>
            </div>
            <div class="form-group">
                <label for="cmb_modalidad" class="col-sm-3 control-label"><?= academico::t("matriculacion", 'Modality') ?></label>
                <div class="col-sm-9">
                    <?= Html::dropDownList("cmb_modalidad", 0,  $arr_modalidad, ["class" => "form-control", "id" => "cmb_modalidad"]) ?>
                </div>
            </div>
        </div>
    </div>
</form>
<br />
<?=
    $this->render('aprobacion-pago-grid', ['pagos' => $pagos,]);
?>