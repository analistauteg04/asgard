<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use app\widgets\PbVPOS\PbVPOS;
?>

<div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-warning"></i> <?= PbVPOS::t("vpos", "Error") ?>!</h4>
    <?= PbVPOS::t("vpos", "Problems with Payment Method") ?>
</div>