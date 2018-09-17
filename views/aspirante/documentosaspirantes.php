<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\components\CFileInputAjax;
?>
<?= Html::hiddenInput('txth_sins_id', $sins_id, ['id' => 'txth_sins_id']); ?>
<?= Html::hiddenInput('txth_per_id', $per_id, ['id' => 'txth_per_id']); ?>

<form class="form-horizontal" enctype="multipart/form-data" id="formsolicitud">
    <div class="col-md-12">
        <h3><span id="lbl_solicitud"><?= Yii::t("formulario", "Aspiring Documents") ?></span></h3>
    </div> 
    <div class='col-md-12'>
        <div class="col-md-6">
            <div class="form-group">
                <label for="txt_nombres" class="col-sm-4 control-label" id="lbl_nombres"><?= Yii::t("formulario", "Names") ?></label> 
                <div class="col-sm-8">
                    <?= $nombres ?>
                </div>
            </div>
        </div>   
        <div class="col-md-6">
            <div class="form-group">
                <label for="txt_apellidos" class="col-sm-4 control-label" id="lbl_nombres"><?= Yii::t("formulario", "Last Names") ?></label> 
                <div class="col-sm-8">
                    <?= $apellidos ?>
                </div>
            </div>
        </div> 
    </div>
    <div class="col-md-12">
        <h4><b><span id="lbl_Personeria"><?= Yii::t("formulario", "Personal Files") ?></span></b></h4>    
    </div>
    <div class='col-md-12'>
        <div class="col-md-6 doc_titulo cinteres">
            <div class="form-group">
                <label for="txth_doc_titulo" class="col-sm-4 control-label keyupmce"><?= Yii::t("formulario", "Title") ?></label>
                <div class="col-sm-7">  
                    <?php
                    echo "<a href='" . Url::to(['/site/getimage', 'route' => "$arch1"]) . "' download='" . $arch1 . "' ><span class='glyphicon glyphicon-download-alt'></span>Descargar Imagen</a>"
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-6 doc_dni cinteres">
            <div class="form-group">
                <label for="txth_doc_dni" class="col-sm-4 control-label keyupmce"><?= Yii::t("formulario", "DNI") ?></label>
                <div class="col-sm-7">                
                    <?php
                    echo "<a href='" . Url::to(['/site/getimage', 'route' => "$arch2"]) . "' download='" . $arch2 . "' ><span class='glyphicon glyphicon-download-alt'></span>Descargar Imagen</a>"
                    ?>
                </div>
            </div>
        </div> 
    </div>
    <div class='col-md-12'>
        <div class="col-md-6 doc_foto cinteres">
            <div class="form-group">
                <label for="txth_doc_foto" class="col-sm-4 control-label keyupmce"><?= Yii::t("formulario", "Photo") ?></label>
                <div class="col-sm-7">                
                    <?php
                    echo "<a href='" . Url::to(['/site/getimage', 'route' => "$arch4"]) . "' download='" . $arch4 . "' ><span class='glyphicon glyphicon-download-alt'></span>Descargar Imagen</a>"
                    ?>
                </div>
            </div>
        </div>        
        <?php if ($txth_extranjero == "1") { ?>
            <div class="col-md-6 doc_certvota cinteres">
                <div class="form-group">
                    <label for="txth_doc_certvota" class="col-sm-4 control-label keyupmce"><?= Yii::t("formulario", "Voting Certificate") ?></label>
                    <div class="col-sm-7">                
                        <?php
                        echo "<a href='" . Url::to(['/site/getimage', 'route' => "$arch3"]) . "' download='" . $arch3 . "' ><span class='glyphicon glyphicon-download-alt'></span>Descargar Imagen</a>"
                        ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="col-md-12">    
        <h4><b><span id="lbl_Personeria"><?= Yii::t("formulario", "Payment files") ?></span></b></h4>  
    </div>
    <div class='col-md-12'>
        <div class="col-md-6 doc_certvota cinteres">
            <div class="form-group">
                <label for="txth_doc_certvota" class="col-sm-4 control-label keyupmce"><?php echo 'Pago' ?></label>
                <div class="col-sm-7">                
                    <?php
                    echo "<a href='" . Url::to(['/site/getimage', 'route' => "/uploads/documento/" . base64_decode($_GET['ids']) . "/" . $imagen]) . "' download='" . $imagen . "' ><span class='glyphicon glyphicon-download-alt'></span>Descargar Imagen</a>"
                    ?>
                </div>
            </div>
        </div>
    </div>
</form>
