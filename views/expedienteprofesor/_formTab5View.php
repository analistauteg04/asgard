<?php

use yii\helpers\Html;
?>

<?= Html::hiddenInput('txth_ids', '', ['id' => 'txth_ids']); ?>
<div class="panel-group" id="accordion1" role="tablist" aria-multiselectable="true">   
    <div class="panel">            
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion1" href="#collapseV1"><b><?= Yii::t("formulario", "Research Projects") ?></b><br/><?= Yii::t("formulario", "Detail of the research projects he has carried out") ?></a>
            </h4>
        </div>        
        <div class="col-md-12">             
            <div>
                <?=
                $this->render('_listarInvestvGrid', [
                    'model' => $datos_investigacion,
                    ]);
                ?>
            </div>                            
        </div>                      
        <!--</div>-->
    </div> 
    <div class='col-md-12'>
        </br></br>
    </div>
    <div class="col-md-12"> 
        <div class="col-md-2">
            <a id="paso5backView" href="javascript:" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-menu-left"></span><?= Yii::t("formulario", "Back") ?></a>
        </div>
        <div class="col-md-8">&nbsp;</div>        
        <div class="col-md-2">
            <a id="paso5nextView" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Next") ?> <span class="glyphicon glyphicon-menu-right"></span></a>
        </div>
    </div> 
</div> 