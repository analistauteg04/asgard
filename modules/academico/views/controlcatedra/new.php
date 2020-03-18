<?php

use yii\helpers\Html;
use kartik\date\DatePicker;
use app\modules\academico\Module as academico;

print_r($arr_datahorario);
?>

<form class="form-horizontal" enctype="multipart/form-data" > 
    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12 ">
        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12 ">   
            <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                <div class="form-group">
                    <h4><span id="lbl_general"><?= academico::t("Academico", "Cathedra control") ?></span></h4> 
                </div>
            </div>            
        </div> 
        <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>
            <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                <div class="form-group">
                    <label for="txt_asignatura" class="col-sm-2 control-label" id="lbl_cupo"><?= Yii::t("formulario", "Subject") ?></label>
                    <div class="col-md-10 col-sm-10 col-xs-10 col-lg-10">
                        <input type="text" class="form-control PBvalidation" value="<?= $arr_datahorario[0]['materia'] ?>" id="txt_asignatura" data-keydown="true" disabled = "true" placeholder="<?= Yii::t("formulario", "Subject") ?>">
                    </div>
                </div>
            </div>           
        </div> 
        <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>
            <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                <div class="form-group">
                    <label for="txt_docente" class="col-sm-4 control-label" id="lbl_unidad"><?= academico::t("Academico", "Teacher") ?></label>
                    <div class="col-md-8 col-sm-8 col-xs-8 col-lg-8">
                        <input type="text" class="form-control PBvalidation" value="<?= $arr_datahorario[0]['docente'] ?>" id="txt_docente" data-keydown="true" disabled = "true" placeholder="<?= academico::t("Academico", "Teacher") ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                <div class="form-group">
                    <label for="txt_unidad" class="col-sm-4 control-label" id="lbl_unidad"><?= academico::t("Academico", "Academic unit") ?></label>
                    <div class="col-md-8 col-sm-8 col-xs-8 col-lg-8">
                        <?= Html::dropDownList("cmb_unidad", $arr_datahorario[0]['unidad'], $arr_unidad, ["class" => "form-control", "id" => "cmb_unidad", "disabled" => "true"]) ?>
                    </div>
                </div>
            </div>  

        </div> 
        <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'> 
            <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                <div class="form-group">
                    <label for="txt_modalidad" class="col-sm-4 control-label" id="lbl_modalidad"><?= academico::t("Academico", "Modality") ?></label>
                    <div class="col-md-8 col-sm-8 col-xs-8 col-lg-8">
                        <?= Html::dropDownList("cmb_modalidad", $arr_datahorario[0]['modalidad'], $arr_modalidad, ["class" => "form-control", "id" => "cmb_modalidad", "disabled" => "true"]) ?>
                    </div>
                </div>
            </div>  
            <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                <div class="form-group">
                    <label for="txt_carrera" class="col-sm-4 control-label" id="lbl_programa"><?= academico::t("Academico", "Career/Program") ?><span class="text-danger">*</span></label>
                    <div class="col-md-8 col-sm-8 col-xs-8 col-lg-8">
                        <?= Html::dropDownList("cmb_carrera", 0, $arr_carrera, ["class" => "form-control", "id" => "cmb_carrera"]) ?>
                    </div>
                </div>
            </div>  

        </div> 
    </div>   
</div> 
</form>
