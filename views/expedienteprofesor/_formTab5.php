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
<div class="panel-group" id="accordion1" role="tablist" aria-multiselectable="true">   
    <div class="panel">            
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion1" href="#collapseV1"><b><?= Yii::t("formulario", "Research Projects") ?></b><br/><?= Yii::t("formulario", "Enter the research projects you have done") ?></a>
            </h4>
        </div>
        <!--<div id="collapseV1" class="collapse" role="tabpanel">-->
        <div class="col-md-12"> 
            <div class="border">
                <form class="form-horizontal">
                    <?=
                    $this->render('_formInvestigacion', [
                        'tipo_discap' => $tipo_discap,
                        'tipo_discap_fam' => $tipo_discap_fam,
                        'tipparent_dis' => $tipparent_dis,
                        'tipparent_enf' => $tipparent_enf,
                        'tip_instaca_med' => $tip_instaca_med,
                        'per_fecha_nacimiento' => $respPerinteresado['per_fecha_nacimiento'],
                        'per_id' => $per_id,
                        'arr_rolproyecto' => $arr_rolproyecto,
                    ]);
                    ?>
                </form>
            </div>
            <div>
                <?=
                $this->render('_listarInvestigaGrid', [
                    'model' => $model,
                    'url' => $url]);
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
            <a id="paso5back" href="javascript:" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-menu-left"></span><?= Yii::t("formulario", "Back") ?></a>
        </div>
        <div class="col-md-8"></div>
      
        <div class="col-md-2">
            <a id="paso5next" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Next") ?> <span class="glyphicon glyphicon-menu-right"></span></a>
        </div>
    </div> 
</div> 