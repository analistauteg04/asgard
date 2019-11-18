<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\components\CFileInputAjax;
use app\models\Persona;
use app\modules\Academico\models\Profesor;
use app\modules\Academico\Module as Academico;
Academico::registerTranslations();
?>

<form class="form-horizontal">
    <div class="form-group">
        <label for="frm_per_pri_nombre" class="col-sm-3 control-label"><?= Academico::t("profesor", "First Name") ?></label>
        <div class="col-sm-9">
            <input type="text" class="form-control PBvalidation" id="frm_per_pri_nombre" value="<?= $persona_model->per_pri_nombre ?>" data-type="all" disabled="disabled" placeholder="<?= Academico::t("profesor", "First Name")  ?>">
        </div>
    </div>  
    <div class="form-group">
        <label for="frm_per_seg_nombre" class="col-sm-3 control-label"><?= Academico::t("profesor", "Second Name") ?></label>
        <div class="col-sm-9">
            <input type="text" class="form-control PBvalidation" id="frm_per_seg_nombre" value="<?= $persona_model->per_seg_nombre ?>" data-type="alfa" disabled="disabled" placeholder="<?= Academico::t("profesor", "Second Name")  ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="frm_per_pri_apellido" class="col-sm-3 control-label"><?= Academico::t("profesor", "First Surname") ?></label>
        <div class="col-sm-9">
            <input type="text" class="form-control PBvalidation" id="frm_per_pri_apellido" value="<?= $persona_model->per_pri_apellido ?>" data-type="alfa" disabled="disabled" placeholder="<?= Academico::t("profesor", "First Surname")  ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="frm_per_seg_apellido" class="col-sm-3 control-label"><?= Academico::t("profesor", "Second Surname") ?></label>
        <div class="col-sm-9">
            <input type="text" class="form-control PBvalidation" id="frm_per_seg_apellido" value="<?= $persona_model->per_seg_apellido ?>" data-type="alfa" disabled="disabled" placeholder="<?= Academico::t("profesor", "Second Surname")  ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="frm_per_cedula" class="col-sm-3 control-label"><?= Academico::t("profesor", "Identification Card") ?></label>
        <div class="col-sm-9">
            <input type="text" class="form-control PBvalidation" id="frm_per_cedula" value="<?= $persona_model->per_cedula ?>" data-type="alfa" disabled="disabled" placeholder="<?= Academico::t("profesor", "Identification Card")  ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="frm_per_ruc" class="col-sm-3 control-label"><?= Academico::t("profesor", "Ruc") ?></label>
        <div class="col-sm-9">
            <input type="text" class="form-control PBvalidation" id="frm_per_ruc" value="<?= $persona_model->per_ruc ?>" data-type="alfa" disabled="disabled" placeholder="<?= Academico::t("profesor", "Ruc")  ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="frm_per_pasaporte" class="col-sm-3 control-label"><?= Academico::t("profesor", "Passport") ?></label>
        <div class="col-sm-9">
            <input type="text" class="form-control PBvalidation" id="frm_per_pasaporte" value="<?= $persona_model->per_pasaporte ?>" data-type="alfa" disabled="disabled" placeholder="<?= Academico::t("profesor", "Passport")  ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="frm_nacionalidad" class="col-lg-3 col-md-3 col-sm-3 col-xs-3 control-label"><?= Yii::t("perfil", "Nationality") ?></label>
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
            <input type="text" maxlength="50" class="form-control PBvalidation" id="frm_nacionalidad" value="<?= $persona_model->per_nacionalidad ?>" disabled="disabled" data-required="false" data-type="all" placeholder="<?= Yii::t("perfil", "Nationality") ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="frm_per_correo" class="col-sm-3 control-label"><?= Academico::t("profesor", "Mail") ?></label>
        <div class="col-sm-9">
            <input type="text" class="form-control PBvalidation" id="frm_per_correo" value="<?= $persona_model->per_correo ?>" data-type="alfa" disabled="disabled" placeholder="<?= Academico::t("profesor", "Mail")  ?>">
        </div>
    </div> 
    <div class="form-group">
        <label for="frm_cel" class="col-sm-3 control-label"><?= Yii::t("perfil", "CellPhone") ?></label>
        <div class="col-sm-9">
            <input type="text" class="form-control PBvalidation" id="frm_cel" value="<?= $persona_model->per_celular ?>" data-required="false" disabled="disabled" data-type="number"  placeholder="<?= Yii::t("perfil", "CellPhone")  ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="frm_phone" class="col-sm-3 control-label"><?= Yii::t("perfil", "Phone") ?></label>
        <div class="col-sm-9">
            <input type="text" class="form-control PBvalidation" id="frm_phone" value="<?= $persona_model->per_domicilio_telefono ?>" disabled="disabled" data-required="false" data-type="number"  placeholder="<?= Yii::t("perfil", "Phone")  ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="frm_fecha_nacimiento" class="col-sm-3 control-label"><?= Yii::t("perfil", "Birth Date") ?></label>
        <div class="col-sm-9">
            <input type="text" class="form-control PBvalidation" id="frm_fecha_nacimiento" value="<?= $persona_model->per_fecha_nacimiento ?>" disabled="disabled" data-required="false" data-type="number"  placeholder="<?= Yii::t("perfil", "Birth Date")  ?>">
        </div>
    </div>
</form>