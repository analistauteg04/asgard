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
            <?= Html::dropDownList("cmb_pais", $persona_model->pai_id_domicilio, $arr_pais, ["class" => "form-control", "id" => "cmb_pais", "disabled" => "disabled"]) ?>
        </div>
    </div>
    <div class="form-group">
        <label for="cmb_provincia" class="col-sm-3 control-label"><?= Academico::t("profesor", "Province") ?></label>
        <div class="col-sm-9">
            <?= Html::dropDownList("cmb_provincia", $persona_model->pro_id_domicilio, $arr_pro, ["class" => "form-control", "id" => "cmb_provincia" , "disabled" => "disabled"]) ?>
        </div>
    </div>
    <div class="form-group">
        <label for="cmb_canton" class="col-sm-3 control-label"><?= Academico::t("profesor", "Canton") ?></label>
        <div class="col-sm-9">
            <?= Html::dropDownList("cmb_canton", $persona_model->can_id_domicilio, $arr_can, ["class" => "form-control", "id" => "cmb_canton" , "disabled" => "disabled"]) ?>
        </div>
    </div>
    <div class="form-group">
        <label for="frm_per_domicilio_sector" class="col-sm-3 control-label"><?= Academico::t("profesor", "Sector") ?></label>
        <div class="col-sm-9">
            <input type="text" class="form-control PBvalidation" id="frm_per_domicilio_sector" value="<?= $persona_model->per_domicilio_sector ?>" data-type="all" disabled="disabled" placeholder="<?= Academico::t("profesor", "Sector")  ?>">
        </div>
    </div> 
    <div class="form-group">
        <label for="frm_per_domicilio_cpri" class="col-sm-3 control-label"><?= Academico::t("profesor", "Primary Street") ?></label>
        <div class="col-sm-9">
            <input type="text" class="form-control PBvalidation" id="frm_per_domicilio_cpri" value="<?= $persona_model->per_domicilio_cpri ?>" data-type="all" disabled="disabled" placeholder="<?= Academico::t("profesor", "Primary Street")  ?>">
        </div>
    </div> 
    <div class="form-group">
        <label for="frm_per_domicilio_csec" class="col-sm-3 control-label"><?= Academico::t("profesor", "Secondary Street") ?></label>
        <div class="col-sm-9">
            <input type="text" class="form-control PBvalidation" id="frm_per_domicilio_csec" value="<?= $persona_model->per_domicilio_csec ?>" data-type="all" disabled="disabled" placeholder="<?= Academico::t("profesor", "Secondary Street")  ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="frm_per_domicilio_num" class="col-sm-3 control-label"><?= Academico::t("profesor", "Numeration") ?></label>
        <div class="col-sm-9">
            <input type="text" class="form-control PBvalidation" id="frm_per_domicilio_num" value="<?= $persona_model->per_domicilio_num ?>" data-type="all" disabled="disabled" placeholder="<?= Academico::t("profesor", "Numeration")  ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="frm_per_domicilio_ref" class="col-sm-3 control-label"><?= Academico::t("profesor", "Reference") ?></label>
        <div class="col-sm-9">
            <input type="text" class="form-control PBvalidation" id="frm_per_domicilio_ref" value="<?= $persona_model->per_domicilio_ref ?>" data-type="all" disabled="disabled" placeholder="<?= Academico::t("profesor", "Reference")  ?>">
        </div>
    </div>
</form>