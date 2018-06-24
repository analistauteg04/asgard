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

//print_r($pai_id_super);
?>

<?= Html::hiddenInput('txth_ids', '', ['id' => 'txth_ids']); ?>
<div class="panel-group" id="accordion1" role="tablist" aria-multiselectable="true">
    <div class="panel">            
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion1" href="#collapseY"><b><?= Yii::t("formulario", "Higher Education") ?></b><br/><?= Yii::t("formulario", "Enter information about your titles obtained") ?></a>
            </h4>
        </div>
        <div id="collapseY" class="collapse" role="tabpanel">
            <div class="col-md-12"> 
                <div class="border">
                    <form class="form-horizontal">
                        <?=
                        $this->render('_formTitulos', [
                            'paises_med' => $paises_med,
                            'provincias_med' => $provincias_med,
                            'paises_nac' => $paises_nac,
                            'provincias_nac' => $provincias_nac,
                            'cantones_nac' => $cantones_nac,
                            'provincias_dom' => $provincias_dom,
                            'cantones_dom' => $cantones_dom,
                            'per_fecha_registro' => $per_fecha_nacimiento,
                            'pai_id_super' => $pai_id_super,
                            'pro_id_super' => $pro_id_super,
                            'can_id_super' => $can_id_super,
                            'arr_instituto' => $arr_instituto,
                            'arr_nivinstruccion' => $arr_nivinstruccion,
                            'arr_conocimiento' => $arr_conocimiento,
                            'arr_subarea' => $arr_subarea,                             
                        ]);
                        ?>
                    </form>
                </div>
                <div>
                    <?=
                    $this->render('_listarTitulosGrid', [
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
                <a data-toggle="collapse" data-parent="#accordion1" href="#collapseY1"><b><?= Yii::t("formulario", "Actual Studies") ?></b><br/><?= Yii::t("formulario", "Ingrese información si actualmente esta cursando estudios superiores.") ?></a>
            </h4>
        </div>
        <div id="collapseY1" class="collapse" role="tabpanel">
            <div class="col-md-12"> 
                <div class="border">
                    <form class="form-horizontal">
                        <?=
                        $this->render('_formEstactual', [
                            'paises_med' => $paises_med,
                            'provincias_med' => $provincias_med,
                            'paises_nac' => $paises_nac,
                            'provincias_nac' => $provincias_nac,
                            'cantones_nac' => $cantones_nac,
                            'provincias_dom' => $provincias_dom,
                            'cantones_dom' => $cantones_dom,
                            'per_fecha_nacimiento' => $per_fecha_nacimiento,
                            'pai_id_actual' => $pai_id_super,
                            'pro_id_super' => $pro_id_super,
                            'can_id_super' => $can_id_super,
                            'arr_instituto' => $arr_instituto,
                            'arr_nivinstruccion' => $arr_nivinstruccion,
                            'per_id' => $per_id,
                            'arr_conocimiento' => $arr_conocimiento,
                            'arr_subarea' => $arr_subarea,   
                        ]);
                        ?>
                    </form>
                </div>
                <div>
                    <?=
                    $this->render('_listarEstactualGrid', [
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
                <a data-toggle="collapse" data-parent="#accordion1" href="#collapseY2"><b><?= Yii::t("formulario", "Academic Awards") ?></b><br/><?= Yii::t("formulario", "Detail the acknowledgments or achievements obtained preferably from the last five years.") ?></a>
            </h4>
        </div>
        <div id="collapseY2" class="collapse" role="tabpanel">
            <div class="col-md-12"> 
                <div class="border">
                    <form class="form-horizontal">
                        <?=
                        $this->render('_formReconoce', [
                            'paises_med' => $paises_med,
                            'provincias_med' => $provincias_med,
                            'paises_nac' => $paises_nac,
                            'provincias_nac' => $provincias_nac,
                            'cantones_nac' => $cantones_nac,
                            'provincias_dom' => $provincias_dom,
                            'cantones_dom' => $cantones_dom,
                            'per_fecha_nacimiento' => $per_fecha_nacimiento,
                            'pai_id_reconocimiento' => $pai_id_super,
                            'arr_instituto' => $arr_instituto,
                        ]);
                        ?>
                    </form>
                </div>
                <div>
                    <?=
                    $this->render('_listarReconoceGrid', [
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
                <a data-toggle="collapse" data-parent="#accordion1" href="#collapseY3"><b><?= Yii::t("formulario", "Languages") ?></b><br/><?= Yii::t("formulario", "Detail certificates or language courses") ?></a>
            </h4>
        </div>
        <div id="collapseY3" class="collapse" role="tabpanel">
            <div class="col-md-12"> 
                <div class="border">
                    <form class="form-horizontal">
                        <?=
                        $this->render('_formIdiomas', [
                            'paises_med' => $paises_med,
                            'provincias_med' => $provincias_med,
                            'paises_nac' => $paises_nac,
                            'provincias_nac' => $provincias_nac,
                            'cantones_nac' => $cantones_nac,
                            'provincias_dom' => $provincias_dom,
                            'cantones_dom' => $cantones_dom,
                            'per_fecha_nacimiento' => $per_fecha_nacimiento,
                            'arr_lenguaje' => $arr_lenguaje,
                            'per_id' => $per_id,
                        ]);
                        ?>
                    </form>
                </div>
                <div>
                    <?=
                    $this->render('_listarIdiomasGrid', [
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
                <a data-toggle="collapse" data-parent="#accordion1" href="#collapseY4"><b><?= Yii::t("formulario", "Trainings") ?></b><br/><?= Yii::t("formulario", "Enter the trainings you have done the last five years") ?></a>
            </h4>
        </div>
        <div id="collapseY4" class="collapse" role="tabpanel">
            <div class="col-md-12"> 
                <div class="border">
                    <form class="form-horizontal">
                        <?=
                        $this->render('_formCapacitacion', [
                            'tipo_discap' => $tipo_discap,
                            'tipo_discap_fam' => $tipo_discap_fam,
                            'tipparent_dis' => $tipparent_dis,
                            'tipparent_enf' => $tipparent_enf,
                            'tip_instaca_med' => $tip_instaca_med,
                            'per_fecha_nacimiento' => $respPerinteresado['per_fecha_nacimiento'],
                            'arr_tipodiploma' => $arr_tipodiploma,
                            'arr_modalidad' => $arr_modalidad,
                            'arr_tipcapacitacion' => $arr_tipcapacitacion,
                            'per_id' => $per_id
                        ]);
                        ?>
                    </form>
                </div>
                <div>
                    <?=
                    $this->render('_listarCapacitaGrid', [
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
            <a id="paso3back" href="javascript:" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-menu-left"></span><?= Yii::t("formulario", "Back") ?> </a>
        </div>
        <div class="col-md-8"></div>        
        <div class="col-md-2">
            <a id="paso3next" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Next") ?> <span class="glyphicon glyphicon-menu-right"></span></a>
        </div>
    </div>                                    
</div>