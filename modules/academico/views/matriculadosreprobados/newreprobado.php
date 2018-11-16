<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\components\CFileInputAjax;
use yii\web\JsExpression;
use yii\jui\AutoComplete;
use yii\widgets\DetailView;
use yii\data\ArrayDataProvider;
use kartik\date\DatePicker;
use app\widgets\PbSearchBox\PbSearchBox;
use app\modules\academico\Module as academico;

$leyenda = '<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
          <div class="form-group">
          <div class="col-sm-10 col-md-10 col-xs-10 col-lg-10">
          <div style = "width: 600px;" class="alert alert-info"><span style="font-weight: bold"> Nota: </span> Marcar solamente las materias reprobadas. Las otras se entiende que estan aprobadas</div>
          </div>
          </div>
          </div>';
?>
<form class="form-horizontal" enctype="multipart/form-data" id="formsolicitud">
    <div class="col-md-12">
        <h3><span id="lbl_index"><?= academico::t("Academico", "Enrolled Income Method") ?></span></h3>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <!-- Espacio de relleno -->
        </br>
    </div>
    <div class="table table-bordered">
        <div class="panel-body">
            <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12 ">               
                <div class="form-group">
                    <h4><span id="lbl_resulevalua"><?= academico::t("Academico", "Admitted Data") ?></span></h4>                                  
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?=
                        PbSearchBox::widget([
                            'boxId' => 'boxgrid',
                            'type' => 'searchBox',
                            'placeHolder' => academico::t("Academico", "Search DNI"),
                            'controller' => '',
                            'callbackListSource' => 'searchAdmitido',
                            'callbackListSourceParams' => ["'boxgrid'", "'TbG_Admitido'"],
                        ]);
                        ?>
                    </div>
                </div>
                <br />              
                <?=
                $this->render('newreprobado-grid', ['model' => $admitido]);
                ?> 
            </div> 
        </div>
    </div>
    <div class="table table-bordered">
        <div class="panel-body">  
            <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>        
                <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                    <div class="form-group">
                        <label for="cmb_ninteres" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label"><?= Yii::t("formulario", "Academic unit") ?></label>
                        <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                            <?= Html::dropDownList("cmb_ninteres", 0, $arr_ninteres, ["class" => "form-control PBvalidation", "id" => "cmb_ninteres"]) ?>
                        </div>
                    </div>
                </div>   
                <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                    <div class="form-group">
                        <label for="cmb_modalidad" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label"><?= Yii::t("formulario", "Mode") ?></label>
                        <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                            <?= Html::dropDownList("cmb_modalidad", 0, $arr_modalidad, ["class" => "form-control PBvalidation", "id" => "cmb_modalidad"]) ?> 
                        </div>
                    </div>
                </div> 
            </div>  
            <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>  
                <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                    <div class="form-group">            
                        <label for="cmb_carrera1" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label"><?= Yii::t("academico", "Career") . ' /Programa' ?></label>
                        <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                            <?= Html::dropDownList("cmb_carrera1", 0, $arr_carrerra1, ["class" => "form-control", "id" => "cmb_carrera1"]) ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                    <div class="form-group">                
                        <label for="cmb_periodo" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label"><?= Yii::t("formulario", "Period"); ?> <span class="text-danger"></span></label>
                        <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                            <?= Html::dropDownList("cmb_periodo", 0, $arr_periodo, ["class" => "form-control", "id" => "cmb_periodo"]) ?>                        
                        </div>
                    </div>
                </div>
            </div>
            <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12' id="buscamateria" style="display: block;">
                <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'> 
                    <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                        <div class='col-md-4 col-xs-4 col-lg-4 col-sm-4'>         
                            <p> <a id="btn_BuscarMateria" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Search") . ' ' . Yii::t("formulario", "Matter") ?></a></p>
                        </div>
                    </div>        
                </div>
                <div id="gridmateria" style="display: none;">
                    <?php echo $leyenda; ?>
                    <?=
                    $this->render('materia-grid.php', [
                        'model' => $arr_materia,
                    ]);
                    ?> 
                </div>
            </div>            
        </div>
    </div>
</form>