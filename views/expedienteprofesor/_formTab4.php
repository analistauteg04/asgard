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

//print_r($pai_id_expl);
?>

<?= Html::hiddenInput('txth_ids', '', ['id' => 'txth_ids']); ?>
<div class="panel-group" id="accordion2" role="tablist" aria-multiselectable="true">

    <div class="panel">            
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion2" href="#collapseZ"><b><?= Yii::t("formulario", "Work Experience") ?></b><br/><?= Yii::t("formulario", "Enter all work experiences") ?></a>
            </h4>
        </div>
        <div id="collapseZ" class="collapse" role="tabpanel">
            <div class="col-md-12"> 
                <div class="border">
                    <form class="form-horizontal">
                        <?=
                        $this->render('_formExplaboral', [
                            'paises_nac' => $paises_nac,
                            'provincias_nac' => $provincias_nac,
                            'cantones_nac' => $cantones_nac,
                            'pai_id_expl' => $pai_id_expl,
                            'pro_id_expl' => $pro_id_expl,
                            'can_id_expl' => $can_id_expl,
                            'ninstruc_mad' => $arr_ninstruc_mad,
                            'ninstruc_pad' => $arr_ninstruc_pad,
                            'tipparent_dis' => $tipparent_dis,
                            'per_fecha_nacimiento' => $respPerinteresado['per_fecha_nacimiento'],
                            'tipparent_enf' => $tipparent_enf,
                            'tip_instaca_med' => $tip_instaca_med,
                        ]);
                        ?>
                    </form>
                </div>
                <div>
                    <?=
                    $this->render('_listarExplaboraGrid', [
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
                <a data-toggle="collapse" data-parent="#accordion2" href="#collapseZ1"><b><?= Yii::t("formulario", "Experience in Teaching") ?></b><br/><?= Yii::t("formulario", "Enter if you have any experience in teaching") ?></a>
            </h4>
        </div>
        <div id="collapseZ1" class="collapse" role="tabpanel">
            <div class="col-md-12"> 
                <div class="border">
                    <form class="form-horizontal">
                        <?=
                        $this->render('_formExpdocencia', [
                            'ninstruc_mad' => $arr_ninstruc_mad,
                            'ninstruc_pad' => $arr_ninstruc_pad,
                            'tipparent_dis' => $tipparent_dis,
                            'per_fecha_nacimiento' => $respPerinteresado['per_fecha_nacimiento'],
                            'tipparent_enf' => $tipparent_enf,
                            'tip_instaca_med' => $tip_instaca_med,
                            'paises_nac' => $paises_nac,
                            'provincias_nac' => $provincias_nac,
                            'cantones_nac' => $cantones_nac,
                            'pai_id_expl' => $pai_id_expl,
                            'pro_id_expl' => $pro_id_expl,
                            'can_id_expl' => $can_id_expl,
                            'arr_conocimiento' => $arr_conocimiento,
                            'arr_instituto' => $arr_instituto,
                            'arr_tiempodedica' => $arr_tiempodedica,
                            'arr_tiprelacion' => $arr_tiprelacion,
                            'arr_subarea' => $arr_subarea,  
                        ]);
                        ?>
                    </form>
                </div>
                <div>
                    <?=
                    $this->render('_listarExpdocentGrid', [
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
            <a id="paso4back" href="javascript:" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-menu-left"></span><?= Yii::t("formulario", "Back") ?> </a>
        </div>
        <div class="col-md-8"></div>
     
        <div class="col-md-2">
            <a id="paso4next" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Next") ?> <span class="glyphicon glyphicon-menu-right"></span></a>
        </div>
    </div>                                    
</div>