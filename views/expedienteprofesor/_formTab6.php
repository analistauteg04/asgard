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
<div class="panel-group" id="accordion11" role="tablist" aria-multiselectable="true">
    <div class="panel">            
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion11" href="#collapseX1"><b><?= Yii::t("formulario", "Publications") ?></b><br/><?= Yii::t("formulario", "Enter the publications you have made") ?></a></h4>
        </div>
        <div id="collapseX1" class="collapse" role="tabpanel">
            <div class="col-md-12"> 
                <div class="border">
                    <form class="form-horizontal">
                        <?=
                        $this->render('_formPublica', [
                            'tipo_discap' => $tipo_discap,
                            'tipo_discap_fam' => $tipo_discap_fam,
                            'tipparent_dis' => $tipparent_dis,
                            'tipparent_enf' => $tipparent_enf,
                            'tip_instaca_med' => $tip_instaca_med,
                            'per_fecha_nacimiento' => $respPerinteresado['per_fecha_nacimiento'],
                            'paises_nac' => $paises_nac,
                            'pai_id_publica' => $pai_id_publica,
                            'pro_id_publica' => $pro_id_publica,
                            'can_id_publica' => $can_id_publica,
                            'arr_instituto' => $arr_instituto,
                            'pai_id_evento' => $pai_id_publica,
                            'arr_publica' => $arr_publica,
                            'arr_tipopublica' => $arr_tipopublica,
                            'per_id' => $per_id,
                        ]);
                        ?>
                    </form>
                </div>
                <div>
                    <?=
                    $this->render('_listarPublicaGrid', [
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
                <a data-toggle="collapse" data-parent="#accordion11" href="#collapseX2"><b><?= Yii::t("formulario", "Address or coodirection") ?></b><br/><?= Yii::t("formulario", "Enter the address or coodirection you have made") ?></a></h4>
        </div>
        <div id="collapseX2" class="collapse" role="tabpanel">
            <div class="col-md-12"> 
                <div class="border">
                    <form class="form-horizontal">
                        <?=
                        $this->render('_formDircoodireccion', [
                            'tipo_discap' => $tipo_discap,
                            'tipo_discap_fam' => $tipo_discap_fam,
                            'tipparent_dis' => $tipparent_dis,
                            'tipparent_enf' => $tipparent_enf,
                            'tip_instaca_med' => $tip_instaca_med,
                            'per_fecha_nacimiento' => $respPerinteresado['per_fecha_nacimiento'],
                            'paises_nac' => $paises_nac,
                            'pai_id_publica' => $pai_id_publica,
                            'pro_id_publica' => $pro_id_publica,
                            'can_id_publica' => $can_id_publica,
                            'arr_instituto' => $arr_instituto,
                            'pai_id_evento' => $pai_id_publica,
                            'arr_publica' => $arr_publica,
                            'arr_tipopublica' => $arr_tipopublica,
                            'arr_coodireccion' => $arr_coodireccion,
                            'arr_conocimiento' => $arr_conocimiento,
                        ]);
                        ?>
                    </form>
                </div>
                <div>
                    <?=
                    $this->render('_listarDircoodirGrid', [
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
                <a data-toggle="collapse" data-parent="#accordion11" href="#collapseX3"><b><?= Yii::t("formulario", "Conferences, Presentations and Exhibitor") ?></b><br/><?= Yii::t("formulario", "Enter the conferences, presentations and exhibitor you have made") ?></a></h4>
        </div>
        <div id="collapseX3" class="collapse" role="tabpanel">
            <div class="col-md-12"> 
                <div class="border">
                    <form class="form-horizontal">
                        <?=
                        $this->render('_formConferencia', [
                            'tipo_discap' => $tipo_discap,
                            'tipo_discap_fam' => $tipo_discap_fam,
                            'tipparent_dis' => $tipparent_dis,
                            'tipparent_enf' => $tipparent_enf,
                            'tip_instaca_med' => $tip_instaca_med,
                            'per_fecha_nacimiento' => $respPerinteresado['per_fecha_nacimiento'],
                            'paises_nac' => $paises_nac,
                            'pai_id_publica' => $pai_id_publica,
                            'pro_id_publica' => $pro_id_publica,
                            'can_id_publica' => $can_id_publica,
                            'arr_instituto' => $arr_instituto,
                            'pai_id_evento' => $pai_id_publica,
                            'arr_publica' => $arr_publica,
                            'arr_tipopublica' => $arr_tipopublica,
                            'arr_conocimiento' => $arr_conocimiento,
                            'arr_tipo_participacion' => $arr_tipo_participacion,
                            'per_id' => $per_id,
                        ]);
                        ?>
                    </form>
                </div>
                <div>
                    <?=
                    $this->render('_listarConferenGrid', [
                        'model' => $model,
                        'url' => $url]);
                    ?>
                </div> 
            </div>
        </div>
    </div> 
    <div class='col-md-12'>
        </br></br>
    </div>
    <div class="col-md-12">
        <div class="form-group">
              <div class="col-sm-10 col-md-10 col-xs-10 col-lg-10 ">
              <div style = "width: 1110px;" class="alert alert-info">La información registrada en el presente formulario es para USO INTERNO, exclusivo de la Universidad Tecnológica Empresarial de Guayaquil,  garantizando la confidencialidad de los datos y soportes suministrados.</div>
              </div>
        </div>
        <!--<p>La información registrada en el presente formulario es para USO INTERNO, exclusivo de la Universidad Tecnológica Empresarial de Guayaquil,  garantizando la confidencialidad de los datos y soportes suministrados.</p>-->
    </div>
    <div class="col-md-12">
        <div class="col-md-6">    
            <div>
                <input type="checkbox" name="check_acepta"  id="check_acepta" value="1">
                <?= Yii::t("formulario", "I accept the responsibility that the information is true") ?>
            </div>                         
        </div>    
        <div class="col-md-2" id="DivRevision" style="display: none;">    
            <div>
                <a id="btn_cerrar" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "For revision") ?> <span class="glyphicon glyphicon-pencil"></span></a>
            </div>                         
        </div>     
    </div>
    <div class='col-md-12'>
        </br></br>
    </div>
    <div class="col-md-12"> 
        <div class="col-md-2">
            <a id="paso6back" href="javascript:" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-menu-left"></span><?= Yii::t("formulario", "Back") ?></a>
        </div>
        <div class="col-md-8"></div>
      
        <div class="col-md-2" >
            <a id="btn_save" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Save") ?> <span class="glyphicon glyphicon-floppy-disk"></span></a>
        </div>
    </div>                                    
</div>