<?php

use yii\helpers\Html;
use app\modules\academico\Module as academico;
?>

<div>
    <h3><?= Academico::t("matriculacion", "Online Registration") ?></h3>
    <br></br>
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"></div>
        <!-- Data -->
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <span><strong><?= Academico::t("matriculacion", "Academic Period") ?>: </strong></span>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <span><?= $data_student['pla_periodo_academico'] ?></span>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <span><strong><?= Academico::t("matriculacion", "Student") ?>: </strong></span>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <span><?= $data_student['pes_nombres'] ?></span>
                </div>                
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <span><strong><?= Academico::t("matriculacion", "DNI") ?>: </strong></span>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <span><?= $data_student['pes_dni'] ?></span>
                </div>                
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <span><strong><?= Academico::t("matriculacion", "Academic Unit") ?>: </strong></span>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <span><?= Academico::t("matriculacion", "Modality") ?> <?= $data_student['mod_nombre'] ?></span>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <span><strong><?= Academico::t("matriculacion", "Career") ?>: </strong></span>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <span><?= $data_student['pes_carrera'] ?></span>
                </div>                
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <span><strong><?= Academico::t("matriculacion", "Phone") ?>: </strong></span>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <span><?= $data_student['per_celular'] ?></span>
                </div>                
            </div>
            <!-- <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <span><strong><?= Academico::t("matriculacion", "Register Cost") ?>: </strong></span>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <span><?= $cost_total ?></span>
                </div>
            </div>  -->
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"></div>
    </div>
</div>
<br></br>
<?=
    $this->render('index-grid', ['planificacion' => $planificacion,]);
?>
<input type="hidden" id="frm_pes_id" value="<?= $pes_id ?>">
<input type="hidden" id="frm_num_min" value="<?= $num_min ?>">
<input type="hidden" id="frm_num_max" value="<?= $num_max ?>">
<input type="hidden" id="frm_modalidad" value="<?= $data_student['mod_nombre'] ?>">
<input type="hidden" id="frm_carrera" value="<?= $data_student['pes_carrera'] ?>">