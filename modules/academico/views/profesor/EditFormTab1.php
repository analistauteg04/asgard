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
        <label for="txt_primer_nombre" class="col-sm-3 control-label"><?= Academico::t("profesor", "First Name") ?></label>
        <div class="col-sm-9">
            <input type="text" class="form-control PBvalidation" id="txt_primer_nombre" value="<?= $persona_model->per_pri_nombre ?>" data-type="alfa"  placeholder="<?= Academico::t("profesor", "First Name")  ?>">
        </div>
    </div>  
    <div class="form-group">
        <label for="txt_segundo_nombre" class="col-sm-3 control-label"><?= Academico::t("profesor", "Second Name") ?></label>
        <div class="col-sm-9">
            <input type="text" class="form-control PBvalidation" id="txt_segundo_nombre" value="<?= $persona_model->per_seg_nombre ?>" data-type="alfa"  placeholder="<?= Academico::t("profesor", "Second Name")  ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="txt_primer_apellido" class="col-sm-3 control-label"><?= Academico::t("profesor", "First Surname") ?></label>
        <div class="col-sm-9">
            <input type="text" class="form-control PBvalidation" id="txt_primer_apellido" value="<?= $persona_model->per_pri_apellido ?>" data-type="alfa"  placeholder="<?= Academico::t("profesor", "First Surname")  ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="txt_segundo_apellido" class="col-sm-3 control-label"><?= Academico::t("profesor", "Second Surname") ?></label>
        <div class="col-sm-9">
            <input type="text" class="form-control PBvalidation" id="txt_segundo_apellido" value="<?= $persona_model->per_seg_apellido ?>" data-type="alfa"  placeholder="<?= Academico::t("profesor", "Second Surname")  ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="txt_cedula" class="col-sm-3 control-label"><?= Academico::t("profesor", "Identification Card") ?></label>
        <div class="col-sm-9">
            <input type="text" class="form-control PBvalidation" id="txt_cedula" value="<?= $persona_model->per_cedula ?>" data-type="cedula"  placeholder="<?= Academico::t("profesor", "Identification Card")  ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="txt_ruc" class="col-sm-3 control-label"><?= Academico::t("profesor", "Ruc") ?></label>
        <div class="col-sm-9">
            <input type="text" class="form-control PBvalidation" id="txt_ruc" value="<?= $persona_model->per_ruc ?>" data-required="false" data-type="number"  placeholder="<?= Academico::t("profesor", "Ruc")  ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="txt_pasaporte" class="col-sm-3 control-label"><?= Academico::t("profesor", "Passport") ?></label>
        <div class="col-sm-9">
            <input type="text" class="form-control PBvalidation" id="txt_pasaporte" value="<?= $persona_model->per_pasaporte ?>" data-required="false" data-type="alfanumerico"  placeholder="<?= Academico::t("profesor", "Passport")  ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="txt_correo" class="col-sm-3 control-label"><?= Academico::t("profesor", "Mail") ?></label>
        <div class="col-sm-9">
            <input type="text" class="form-control PBvalidation" id="txt_correo" value="<?= $persona_model->per_correo ?>" data-type="email"  placeholder="<?= Academico::t("profesor", "Mail")  ?>">
        </div>
    </div> 
</form>