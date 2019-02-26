<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use app\widgets\PbVPOS\PbVPOS;
?>
<div class="box-header with-border">
    <h3 class="box-title"><?= $titleBox ?></h3>
</div>
<form role="form">
    <div class="box-body">
        <div class="form-group">
            <label for="frmFirstName"><?= PbVPOS::t("vpos", "First Name") ?></label>
            <input type="text" class="form-control" id="frmFirstName" value="<?= $nombre_cliente ?>" placeholder="<?= PbVPOS::t("vpos", "First Name") ?>">
        </div>
        <div class="form-group">
            <label for="frmLastName"><?= PbVPOS::t("vpos", "Last Name") ?></label>
            <input type="text" class="form-control" id="frmLastName" value="<?= $apellido_cliente ?>" placeholder="<?= PbVPOS::t("vpos", "Last Name") ?>">
        </div>
        <div class="form-group">
            <label for="frmEmail"><?= PbVPOS::t("vpos", "Email") ?></label>
            <input type="text" class="form-control" id="frmEmail" value="<?= $email_cliente ?>" placeholder="<?= PbVPOS::t("vpos", "Email") ?>">
        </div>
        <div class="form-group">
            <label for="frmAmount"><?= PbVPOS::t("vpos", "Amount") ?></label>
            <input type="text" class="form-control" id="frmAmount" value="<?= $total ?>" placeholder="<?= PbVPOS::t("vpos", "Amount") ?>" disabled="disabled">
        </div>
    </div>
    <div class="box-footer btnPago">
        <button type="button" class="btn btn-block btn-success" onclick="playOnPay('<?= $processUrl ?>')"><?= PbVPOS::t("vpos", "Buy") ?></button>
    </div>
</form>
<div id="lightbox-response"></div>