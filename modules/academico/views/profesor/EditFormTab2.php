<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;
use kartik\date\DatePicker;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\components\CFileInputAjax;
use app\modules\Academico\Module as Academico;
Academico::registerTranslations();
?>
<form class="form-horizontal">
    <div class="form-group">
        <label for="cmb_pais" class="col-sm-3 control-label"><?= Academico::t("profesor", "Country") ?></label>
        <div class="col-sm-9">
            <?= Html::dropDownList("cmb_pais", $persona_model->pai_id_domicilio, $arr_pais, ["class" => "form-control", "id" => "cmb_pais"]) ?>
        </div>
    </div>
    <div class="form-group">
        <label for="cmb_provincia" class="col-sm-3 control-label"><?= Academico::t("profesor", "Province") ?></label>
        <div class="col-sm-9">
            <?= Html::dropDownList("cmb_provincia", $persona_model->pro_id_domicilio, $arr_pro, ["class" => "form-control", "id" => "cmb_provincia"]) ?>
        </div>
    </div>
    <div class="form-group">
        <label for="cmb_canton" class="col-sm-3 control-label"><?= Academico::t("profesor", "Canton") ?></label>
        <div class="col-sm-9">
            <?= Html::dropDownList("cmb_canton", $persona_model->can_id_domicilio, $arr_can, ["class" => "form-control", "id" => "cmb_canton"]) ?>
        </div>
    </div>
    <div class="form-group">
        <label for="txt_sector" class="col-sm-3 control-label"><?= Academico::t("profesor", "Sector") ?></label>
        <div class="col-sm-9">
            <input type="text" class="form-control PBvalidation" id="txt_sector" value="<?= $persona_model->per_domicilio_sector ?>" data-type="all"  placeholder="<?= Academico::t("profesor", "Sector")  ?>">
        </div>
    </div> 
    <div class="form-group">
        <label for="txt_calle_pri" class="col-sm-3 control-label"><?= Academico::t("profesor", "Primary Street") ?></label>
        <div class="col-sm-9">
            <input type="text" class="form-control PBvalidation" id="txt_calle_pri" value="<?= $persona_model->per_domicilio_cpri ?>" data-type="all"  placeholder="<?= Academico::t("profesor", "Primary Street")  ?>">
        </div>
    </div> 
    <div class="form-group">
        <label for="txt_calle_sec" class="col-sm-3 control-label"><?= Academico::t("profesor", "Secondary Street") ?></label>
        <div class="col-sm-9">
            <input type="text" class="form-control PBvalidation" id="txt_calle_sec" value="<?= $persona_model->per_domicilio_csec ?>" data-type="all"  placeholder="<?= Academico::t("profesor", "Secondary Street")  ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="txt_numeracion" class="col-sm-3 control-label"><?= Academico::t("profesor", "Numeration") ?></label>
        <div class="col-sm-9">
            <input type="text" class="form-control PBvalidation" id="txt_numeracion" value="<?= $persona_model->per_domicilio_num ?>" data-type="all"  placeholder="<?= Academico::t("profesor", "Numeration")  ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="txt_referencia" class="col-sm-3 control-label"><?= Academico::t("profesor", "Reference") ?></label>
        <div class="col-sm-9">
            <input type="text" class="form-control PBvalidation" id="txt_referencia" value="<?= $persona_model->per_domicilio_ref ?>" data-type="all"  placeholder="<?= Academico::t("profesor", "Reference")  ?>">
        </div>
    </div>
</form>