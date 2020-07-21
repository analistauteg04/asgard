<?php

use yii\helpers\Html;
use app\modules\academico\Module as academico;

$leyenda = '
          <div class="form-group">          
          <div class="alert alert-info">
          <table class="tg">
            <tr>
              <td colspan="2" class="tg-0pky"><span style="font-weight: bold"> Nota: </span>Estimado Estudiante, si tiene alguna observación con la 
              planificación del periodo académico por favor contactar a la secretaría de su facultad, a los siguientes números:</br></br></td>
            </tr>
            <tr>
                <td class="tg-0pky"><span style="font-weight: bold">Datos de Contacto</span></br></br></td>
            </tr>
            <tr>
              <td class="tg-0pky"><span style="font-weight: bold">Facultad Grado Presencial</span></br>
                Correo: secretariapresencial@uteg.edu.ec</br>
                Celular: 0993817458</br></br></td>
              <td class="tg-0pky"><span style="font-weight: bold">Facultad Grado a Distancia y Semipresencial</span></br>
                Correo: secretariasemipresencial@uteg.edu.ec</br>
                Celular: 09895899757</br></br></td>
            </tr>
            <tr>
              <td class="tg-0pky"> <span style="font-weight: bold">Facultad Grado Online</span></br>
                Correo: secretariaonline@uteg.edu.ec</br>
                Celular: 0991534808</br></br></td>
              <td class="tg-0pky"><span style="font-weight: bold">Mesa de Servicio UTEG</span></br>
                Correo: mesaservicio01e@uteg.edu.ec y mesaservicio02@uteg.edu.ec</br></br></td>
            </tr>
          </table>
          </div>     
          </div>';
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
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <span><strong><?= Academico::t("matriculacion", "Registration Number") ?>: </strong></span>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <span><?= $data_student['est_matricula'] ?></span>
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

<div class="col-xs-8"><?php echo $leyenda; ?></div>
<div class="col-xs-4">
    <div class="table-responsive">
        <table style="text-align: right;" class="table">
            <tbody>
                <tr>
                    <th style="width:50%"><?= academico::t('matriculacion','Cost per Subject') ?></th>
                    <td id="costMat">$0.00</td>
                </tr>
                <tr style='display: none;'>
                    <th><?= academico::t('matriculacion','Registration payment') ?></th>
                    <td id="costMatr">$<?= isset($dataMat['MAT-GRAD'])?$dataMat['MAT-GRAD']:'0.00' ?></td>
                </tr>
                <tr>
                    <th><?= academico::t('matriculacion','Administrative Expenses') ?></th>
                    <td id="costAdmin">$<?= isset($dataMat['ADM-GAST'])?$dataMat['ADM-GAST']:'0.00' ?></td>
                </tr>
                <tr>
                    <th><?= academico::t('matriculacion','Students Association') ?></th>
                    <td id="costStud">$<?= isset($dataMat['ASOEST'])?$dataMat['ASOEST']:'0.00' ?></td>
                </tr>
                <tr>
                    <th style="font-size: 25px;"><?= academico::t('matriculacion', 'Register Cost') ?></th>
                    <td style="font-size: 25px; font-weight: bold;" id="costTotal">$0.00</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>



<input type="hidden" id="frm_pes_id" value="<?= $pes_id ?>">
<input type="hidden" id="frm_num_min" value="<?= $num_min ?>">
<input type="hidden" id="frm_num_max" value="<?= $num_max ?>">
<input type="hidden" id="frm_modalidad" value="<?= $data_student['mod_nombre'] ?>">
<input type="hidden" id="frm_carrera" value="<?= $data_student['pes_carrera'] ?>">
<input type="hidden" id="frm_categoria" value="<?= $data_student['est_categoria'] ?>">
<input type="hidden" id="frm_cat_price" value="<?= $CatPrecio ?>">
<input type="hidden" id="frm_asc_est" value="<?= isset($dataMat['ASOEST'])?$dataMat['ASOEST']:'0.00' ?>">
<input type="hidden" id="frm_mat_cos" value="<?= isset($dataMat['MAT-GRAD'])?$dataMat['MAT-GRAD']:'0.00' ?>">
<input type="hidden" id="frm_gas_adm" value="<?= isset($dataMat['ADM-GAST'])?$dataMat['ADM-GAST']:'0.00' ?>">