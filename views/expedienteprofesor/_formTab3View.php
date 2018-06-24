<?php

use yii\helpers\Html;

?>

<?= Html::hiddenInput('txth_ids', '', ['id' => 'txth_ids']); ?>
<div class="panel-group" id="accordion1" role="tablist" aria-multiselectable="true">
    <div class="panel">            
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion1" href="#collapseY"><b><?= Yii::t("formulario", "Higher Education") ?></b><br/><?= Yii::t("formulario", "Information about your titles obtained") ?></a>
            </h4>
        </div>
        <div id="collapseY" class="collapse" role="tabpanel">
            <div class="col-md-12">                 
                <div>
                    <?=
                    $this->render('_listarTitulosvGrid', [
                        'model' => $datos_estudiosuperior,
                        ]);
                    ?>
                </div>
            </div>
        </div>
    </div>   
    <div class="panel">            
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion1" href="#collapseY1"><b><?= Yii::t("formulario", "Actual Studies") ?></b><br/><?= Yii::t("formulario", "Information if you are currently studying higher education.") ?></a>
            </h4>
        </div>
        <div id="collapseY1" class="collapse" role="tabpanel">
            <div class="col-md-12"> 
                
                <div>
                    <?=
                    $this->render('_listarEstactuvGrid', [
                        'model' => $datos_estudioactual,
                        'url' => $url]);
                    ?>
                </div>
            </div>
        </div>
    </div> 
    <div class="panel">            
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion1" href="#collapseY2"><b><?= Yii::t("formulario", "Academic Awards") ?></b><br/><?= Yii::t("formulario", "Recognitions or achievements obtained") ?></a>
            </h4>
        </div>
        <div id="collapseY2" class="collapse" role="tabpanel">
            <div class="col-md-12">               
                <div>
                    <?=
                    $this->render('_listarReconocevGrid', [
                        'model' => $datos_reconocimiento,
                        ]);
                    ?>
                </div>
            </div>
        </div>
    </div> 
    <div class="panel">            
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion1" href="#collapseY3"><b><?= Yii::t("formulario", "Languages") ?></b><br/><?= Yii::t("formulario", "Certificates or language courses") ?></a>
            </h4>
        </div>
        <div id="collapseY3" class="collapse" role="tabpanel">
            <div class="col-md-12">          
                <div>
                    <?=
                    $this->render('_listarIdiomavGrid', [
                        'model' => $datos_idiomas,
                        ]);
                    ?>
                </div>
            </div>
        </div>
    </div> 
    <div class="panel">            
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion1" href="#collapseY4"><b><?= Yii::t("formulario", "Trainings") ?></b><br/><?= Yii::t("formulario", "Training information") ?></a>
            </h4>
        </div>
        <div id="collapseY4" class="collapse" role="tabpanel">
            <div class="col-md-12">                
                <div>
                    <?=
                    $this->render('_listarCapacitavGrid', [
                        'model' => $datos_capacitacion]);
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
            <a id="paso3backView" href="javascript:" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-menu-left"></span><?= Yii::t("formulario", "Back") ?> </a>
        </div>
        <div class="col-md-8"></div>
        <div class="col-md-2">
            <a id="paso3nextView" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Next") ?> <span class="glyphicon glyphicon-menu-right"></span></a>
        </div>
    </div>                                    
</div>