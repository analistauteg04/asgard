<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\date\DatePicker;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//print_r('esto.. '.$estado_cierre);
?>

<div class='row'>   
    <div class='col-md-12'>
        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 ">
            <h3><span id="lbl_Personeria"><?= Yii::t("formulario", "Actions Made") ?></span></h3>
            <br>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_nombres" class="col-sm-2 col-md-2 col-xs-2 col-lg-2  control-label" id="lbl_nombres"><?= Yii::t("formulario", "Names") ?></label> 
                <div class="col-sm-8 col-md-8 col-xs-8 col-lg-8 ">
                   <input type="text" class="form-control PBvalidation keyupmce" value="<?= $interesado ?>" disabled id="txt_nombres" data-type="alfa" placeholder="<?= Yii::t("formulario", "Names") ?>">

                </div>
            </div>
        </div> 
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_pais" class="col-sm-2 col-md-2 col-xs-2 col-lg-2  control-label" id="lbl_pais"><?= Yii::t("formulario", "Country") ?></label>
                <div class="col-sm-8 col-md-8 col-xs-8 col-lg-8 ">
                    <input type="text" class="form-control PBvalidation keyupmce" value="<?= $pais ?>" disabled id="txt_pais" data-type="alfa" placeholder="<?= Yii::t("formulario", "Country") ?>">                
                </div>
            </div>
        </div>  
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_correo" class="col-sm-2 col-md-2 col-xs-2 col-lg-2   control-label" id="lbl_correo"><?= Yii::t("formulario", "Email") ?></label>
                <div class="col-sm-8 col-md-8 col-xs-8 col-lg-8 ">
                    <input type="text" class="form-control PBvalidation keyupmce" value="<?= $correo ?>" disabled id="txt_correo" data-type="alfa" placeholder="<?= Yii::t("formulario", "Email") ?>">                
                </div>
            </div>
        </div>   
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_celular" class="col-sm-2 col-md-2 col-xs-2 col-lg-2  control-label" id="lbl_celular"><?= Yii::t("formulario", "CellPhone") ?></label>
                <div class="col-sm-8 col-md-8 col-xs-8 col-lg-8 ">      
                    <input type="text" class="form-control PBvalidation keyupmce" value="<?= $celular ?>" disabled id="txt_celular" data-type="alfa" placeholder="<?= Yii::t("formulario", "CellPhone") ?>">                                
                </div>
            </div><br>
        </div> 
        <?php if($estado_cierre == 0) {?>
        <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'> 
            <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                <div class='col-md-4 col-xs-4 col-lg-4 col-sm-4'>         
                    <p> <a id="btn_Neopera" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "New Management") ?></a></p>
                </div>
            </div>        
        </div> 
        <?php } ?>
    </div>
</div>

