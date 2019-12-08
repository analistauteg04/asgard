<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;
use kartik\date\DatePicker;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\components\CFileInputAjax;
?>
<form class="form-horizontal"> 
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">   
        <div class="form-group">
            <label for="frm_usu_user" class="col-lg-3 col-md-3 col-xs-3 col-sm-3 control-label"><?= Yii::t("login", "Username") ?></label>
            <div class="col-lg-9 col-md-9 col-xs-9 col-sm-9">
                <input type="text" class="form-control PBvalidation" id="frm_usu_user" readonly="readonly" value="<?= $usuario_model->usu_user ?>" data-type="alfa" disabled="disabled" placeholder="<?= Yii::t("profesor", "User Name")  ?>">
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="frm_clave" class="col-lg-3 col-md-3 col-xs-3 col-sm-3 control-label"><?= Yii::t("login", "Password") ?></label>
            <div class="col-lg-9 col-md-9 col-xs-9 col-sm-9">
                <div class="input-group">
                    <?= Html::passwordInput("frm_clave", "********", ["class" => "form-control PBvalidation", "data-type" => "all", "id" => "frm_clave", "disabled" => "disabled","placeholder" => Yii::t("login", "Password") ]) ?>
                    <?= Html::tag('span', Html::button(Html::tag("i", "", ['class' => 'glyphicon glyphicon-eye-open']), ['id' => "view_pass_btn", 'class' => 'btn btn-primary btn-flat',]), ["class" => "input-group-btn", "data-toggle" => "tooltip", "data-placement" => "top", "title" => Yii::t("accion", "View")]) ?>
                </div>
            </div>
        </div>  
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="cmb_grupo" class="col-lg-3 col-md-3 col-xs-3 col-sm-3 control-label"><?= Yii::t("grupo", "Name of Group") ?></label>
            <div class="col-lg-9 col-md-9 col-xs-9 col-sm-9">
                <?= Html::dropDownList("cmb_grupo", $gru_id, $arr_grupos, ["class" => "form-control", "id" => "cmb_grupo", "disabled" => "disabled"]) ?>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="cmb_rol" class="col-lg-3 col-md-3 col-xs-3 col-sm-3 control-label"><?= Yii::t("rol", "Name of Role") ?></label>
            <div class="col-lg-9 col-md-9 col-xs-9 col-sm-9">
                <?= Html::dropDownList("cmb_rol", $rol_id, $arr_roles, ["class" => "form-control", "id" => "cmb_rol", "disabled" => "disabled"]) ?>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="cmb_empresa" class="col-lg-3 col-md-3 col-xs-3 col-sm-3 control-label"><?= Yii::t("formulario", "Company") ?></label>
            <div class="col-lg-9 col-md-9 col-xs-9 col-sm-9">
                <?= Html::dropDownList("cmb_empresa", $empresa_persona_model->emp_id, $arr_empresa, ["class" => "form-control", "id" => "cmb_empresa", "disabled" => "disabled"]) ?>
            </div>
        </div>
    </div>
</form>