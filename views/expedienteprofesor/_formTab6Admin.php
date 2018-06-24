<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
use yii\data\ArrayDataProvider;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
?>

<?= Html::hiddenInput('txth_ids', '', ['id' => 'txth_ids']); ?>
<div class="panel-group" id="accordion11" role="tablist" aria-multiselectable="true">
    <div class="panel">            
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion11" href="#collapseX1"><b><?= Yii::t("formulario", "Publications") ?></b><br/><?= Yii::t("formulario", "Detail of the publications that you have made") ?></a></h4>
        </div>
        <div id="collapseX1" class="collapse" role="tabpanel">
            <div class="col-md-12">                 
                <div>
                    <?=
                    $this->render('_listarPublicavGrid', [
                        'model' => $datos_publicacion,
                        ]);
                    ?>
                </div>   
            </div>
        </div>
    </div>   
    <div class="panel">            
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion11" href="#collapseX2"><b><?= Yii::t("formulario", "Address or coodirection") ?></b><br/><?= Yii::t("formulario", "Detail of the address or coodirection you have made") ?></a></h4>
        </div>
        <div id="collapseX2" class="collapse" role="tabpanel">
            <div class="col-md-12">                 
                <div>
                    <?=
                    $this->render('_listarDircodirvGrid', [
                        'model' => $datos_codireccion,
                        ]);
                    ?>
                </div>
            </div>
        </div>
    </div> 
    <div class="panel">            
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion11" href="#collapseX3"><b><?= Yii::t("formulario", "Conferences, Presentations and Exhibitor") ?></b><br/><?= Yii::t("formulario", "Detail of the conferences, presentations and exhibitor you have made") ?></a></h4>
        </div>
        <div id="collapseX3" class="collapse" role="tabpanel">
            <div class="col-md-12">                
                <div>
                    <?=
                    $this->render('_listarConfervGrid', [
                        'model' => $datos_ponencia,
                        ]);
                    ?>
                </div> 
            </div>
        </div>
    </div>    
</div>    
<div class='col-md-12'>
    </br></br>
</div>
<div class="col-md-12"> 
    <div class="col-md-2">
        <a id="paso6backView" href="javascript:" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-menu-left"></span><?= Yii::t("formulario", "Back") ?></a>
    </div>
    <div class="col-md-8">&nbsp;</div>        
    <div class="col-md-2">
        <a id="paso6nextView" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Next") ?> <span class="glyphicon glyphicon-menu-right"></span></a>
    </div> 
</div> 
