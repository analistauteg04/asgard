<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use app\widgets\PbVPOS\PbVPOS;
?>
<form class="form-horizontal" enctype="multipart/form-data" >
    <div class="col-md-9 col-sm-8 col-xs-8 col-lg-9">
        <div class="form-group">
            <h3 class="box-title"><span id="lbl_Personeria"><?= $titleBox ?></span></h3>                 
        </div>
    </div>
    <div class="col-md-3 col-sm-4 col-xs-4 col-lg-3">
        <img class='logo_pv' src='<?= $publicAssetUrl . "/img/logo_pv".$pbId.".svg" ?>' />
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <div class="form-group">
            <label for="frmFirstName" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label"><?= PbVPOS::t("vpos", "First Name") ?></label>
            <div class="col-sm-8 col-md-8 col-xs-8 col-lg-8 ">
                <input type="text" class="form-control" id="frmFirstName" value="<?= $nombre_cliente ?>" placeholder="<?= PbVPOS::t("vpos", "First Name") ?>">           
            </div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <div class="form-group">
            <label for="frmLastName" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label"><?= PbVPOS::t("vpos", "Last Name") ?></label>
            <div class="col-sm-8 col-md-8 col-xs-8 col-lg-8 ">
                <input type="text" class="form-control" id="frmLastName" value="<?= $apellido_cliente ?>" placeholder="<?= PbVPOS::t("vpos", "Last Name") ?>">          
            </div>
        </div>
    </div> 
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <div class="form-group">
            <label for="frmEmail" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label"><?= PbVPOS::t("vpos", "Email") ?></label>
            <div class="col-sm-8 col-md-8 col-xs-8 col-lg-8 ">
                <input type="text" class="form-control" id="frmEmail" value="<?= $email_cliente ?>" placeholder="<?= PbVPOS::t("vpos", "Email") ?>">           
            </div>
        </div>
    </div> 
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <div class="form-group">
            <label for="frmAmount" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label"><?= PbVPOS::t("vpos", "Amount") ?></label>
            <div class="col-sm-8 col-md-8 col-xs-8 col-lg-8 ">
                <input type="text" class="form-control" id="frmAmount" value="<?= $total ?>" placeholder="<?= PbVPOS::t("vpos", "Amount") ?>" disabled="disabled">           
            </div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <div class="form-group">
            <div class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label">&nbsp;</div>
            <div class="col-sm-8 col-md-8 col-xs-8 col-lg-8 ">
                <img class='logo_cards' src='<?= $publicAssetUrl . "/img/logo_DN.png" ?>' />
                <img class='logo_cards' src='<?= $publicAssetUrl . "/img/logo_DV.png" ?>' /> 
                <img class='logo_cards' src='<?= $publicAssetUrl . "/img/logo_VS.png" ?>' /> 
                <img class='logo_cards' src='<?= $publicAssetUrl . "/img/logo_MC.png" ?>' />
            </div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <div class="form-group">
            <div class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label">&nbsp;</div>
            <div class="col-sm-8 col-md-8 col-xs-8 col-lg-8 ">
                <div class="checkbox">
                    <label>
                      <input type="checkbox" onclick="checkTerms(this)" /> 
                      <?= PbVPOS::t("vpos", "I am agree with terms and conditions.") ?>
                      <a href="<?= $termsConditions ?>" target="_blank"><?= PbVPOS::t("vpos", "Check terms and conditions here.") ?></a>
                    </label>
                  </div>
            </div>
            <div class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label">&nbsp;</div>
            <div class="col-sm-8 col-md-8 col-xs-8 col-lg-8 ">
                <div>
                    <label>
                      <a href="<?= $questionsLink ?>" target="_blank"><?= PbVPOS::t("vpos", "Check frequently asked questions here.") ?></a>
                    </label>
                </div>
            </div>
        </div>     
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12"> 
        <div class="form-group">
            <div class="col-sm-4 col-md-4 col-xs-4 col-lg-4">                                  
            </div> 
            <div class="col-sm-4 col-md-4 col-xs-4 col-lg-4 btnPago">                  
                <button type="button" class="btnBuy btn btn-block btn-primary disabled" onclick="playOnPay('<?= $processUrl ?>')"><?= PbVPOS::t("vpos", "Buy") ?></button>
            </div>      
            <div class="col-sm-4">                                  
            </div> 
        </div>    
    </div>
</form>
<div id="lightbox-response"></div>