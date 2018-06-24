<?php

use yii\helpers\Html;
?>

<?= Html::hiddenInput('txth_ids', '', ['id' => 'txth_ids']); ?>
<div class="panel-group" id="accordion2" role="tablist" aria-multiselectable="true">


    <div class="panel">            
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion2" href="#collapseZ"><b><?= Yii::t("formulario", "Work Experience") ?></b><br/><?= Yii::t("formulario", "Work experience information") ?></a>
            </h4>
        </div>
        <div id="collapseZ" class="collapse" role="tabpanel">
            <div class="col-md-12">                 
                <div>
                    <?=
                    $this->render('_listarExplabvGrid', [
                        'model' => $datos_laborales,
                        ]);
                    ?>
                </div> 

            </div>

        </div>
    </div>   
    <div class="panel">            
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion2" href="#collapseZ1"><b><?= Yii::t("formulario", "Experience in Teaching") ?></b><br/><?= Yii::t("formulario", "Teaching experience information") ?></a>
            </h4>
        </div>
        <div id="collapseZ1" class="collapse" role="tabpanel">
            <div class="col-md-12"> 
                <div>
                    <?=
                    $this->render('_listarExpdocvGrid', [
                        'model' => $datos_docencia,
                        ]);
                    ?>
                </div> 
            </div>

        </div>
    </div> 

    <div class='col-md-12'>
        </br>
    </div>



    <div class="col-md-12"> 
        <div class="col-md-2">
            <a id="paso4backView" href="javascript:" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-menu-left"></span><?= Yii::t("formulario", "Back") ?> </a>
        </div>
        <div class="col-md-8"></div>
        <div class="col-md-2">
            <a id="paso4nextView" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Next") ?> <span class="glyphicon glyphicon-menu-right"></span></a>
        </div>
    </div>                                    
</div>