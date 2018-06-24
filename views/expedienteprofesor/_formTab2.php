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
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">               
    <div class="panel">            
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseX"><b>Datos Familiares</b><br/><?= Yii::t("formulario", "Enter the relatives that live with you and that are first degree of consanguinity and affinity.") ?></a>
            </h4>
        </div>
        <div id="collapseX" class="collapse" role="tabpanel">
            <div class="col-md-12"> 
                <div class="border">
                    <form class="form-horizontal">
                        <?=
                        $this->render('_formFamilia', [
                            'tipparent' => $tipparent,
                            'per_fecha_nacimiento' => $respPerinteresado['per_fecha_nacimiento'],
                            'tipo_discap' => $tipo_discap,
                            'per_id' => $per_id,                                               
                            ]);
                        ?>
                    </form>
                </div>
                <div>
                    <?=
                    $this->render('_listarFamiliaGrid', [
                        'model' => $model,
                        'url' => $url]);
                    ?>
                </div>
            </div>
        </div>
    </div>        
    <div class="panel">            
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2"><b>Datos Familiares Institución</b><br/><?= Yii::t("formulario", "Family data that work in the institution.") ?></a>
            </h4>
        </div>
        <div id="collapse2" class="collapse" role="tabpanel">
            <div class="col-md-12"> 
                <div class="border">
                    <form class="form-horizontal">
                        <?=
                        $this->render('_formFamilia2', [
                            'ninstruc_mad' => $arr_ninstruc_mad,
                            'ninstruc_pad' => $arr_ninstruc_pad,
                            'tipparent' => $arr_tipparent_todos,
                            'per_fecha_nacimiento' => $respPerinteresado['per_fecha_nacimiento'],
                            'per_genero' => $respPerinteresado['per_genero'],
                            'genero' => $genero,
                            'per_id' => $per_id,                            
                            ]);
                        ?>
                    </form>
                </div>
                <div>
                    <?=
                    $this->render('_listarFamilia2Grid', [
                        'model' => $model,
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
            <a id="paso2back" href="javascript:" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-menu-left"></span><?= Yii::t("formulario", "Back") ?> </a>
        </div>
        <div class="col-md-8"></div>        
        <div class="col-md-2">
            <a id="paso2next" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Next") ?> <span class="glyphicon glyphicon-menu-right"></span></a>
        </div>
    </div>                                    
</div>
