<?php

use yii\helpers\Html;

?>
<?= Html::hiddenInput('txth_ids', '', ['id' => 'txth_ids']); ?>
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">               
    <div class="panel">            
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseX"><b>Datos Familiares</b><br/><?= Yii::t("formulario", "Información de los familiares que vivan con el profesor y son de primer grado de consanguinidad y afinidad.") ?></a>
            </h4>
        </div>
        <div id="collapseX" class="collapse" role="tabpanel">
            <div class="col-md-12">                 
                <div>
                    <?=
                    $this->render('_listarFamiliavGrid', [
                        'model' => $datos_familiares,
                        ]);
                    ?>
                </div>
            </div>
        </div>
    </div>        
    <div class="panel">            
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2"><b>Datos Familiares Institución</b><br/>Tienes algún familiar en la institución</a>
            </h4>
        </div>
        <div id="collapse2" class="collapse" role="tabpanel">
            <div class="col-md-12">                
                <div>
                    <?=
                    $this->render('_listarFamilia2vGrid', [
                        'model' => $datos_familiares_inst,
                        'url' => $url]);
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
            <a id="paso2backView" href="javascript:" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-menu-left"></span><?= Yii::t("formulario", "Back") ?> </a>
        </div>
        <div class="col-md-8"></div>
        <div class="col-md-2">
            <a id="paso2nextView" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Next") ?> <span class="glyphicon glyphicon-menu-right"></span></a>
        </div>
    </div>                                    
</div>