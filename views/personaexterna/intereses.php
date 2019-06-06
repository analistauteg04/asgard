<?php
/* 
 * Authors:
 * Grace Viteri <analistadesarrollo01@uteg.edu.ec> 
 * Kleber Loayza <analistadesarrollo03@uteg.edu.ec> /
 */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h3><span id="lbl_Personeria"><?= Yii::t("formulario", "Interests") ?></span></h3>
</div>
<form class="form-horizontal" enctype="multipart/form-data" >
    <?php 
        for($i=0;$i<count($arr_interes);$i++){
            if($i==0 || $i%4==0){
                ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php 
            }
            if($i==0 || 1){
                ?>
                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
                        <div class="form-group">
                            
                        </div>
                    </div>        
                <?php 
            }
            if($i==0 || $i%4==0){
                ?>
                </div>
                <?php 
            }
            
        }
    ?>
    
</form>