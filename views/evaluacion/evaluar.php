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

array_unshift($materia, "Seleccionar");
?>

<form class="form-horizontal" enctype="multipart/form-data" id="formsolicitud">
    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
        <h3><span id="lbl_solicitud"><?= Yii::t("formulario", "Evaluation Teacher") ?></span></h3>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <!-- Espacio de relleno -->
        </br>
    </div>
    <div class="table table-bordered">
        <div class="panel-body">
            <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12 ">               
                <div class="form-group">
                    <h4><span id="lbl_resulevalua"><?= Yii::t("formulario", "Data Teacher") ?></span></h4>                                  
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?=
                        PbSearchBox::widget([
                            'boxId' => 'boxgrid',
                            'type' => 'searchBox',
                            'placeHolder' => Yii::t("accion", "Search"),
                            'controller' => '',
                            'callbackListSource' => 'searchProfesor',
                            'callbackListSourceParams' => ["'boxgrid'", "'TbG_Profesor'"],
                        ]);
                        ?>
                    </div>
                </div>
                <br />              
                <?=
                $this->render('_listaEducaGrid', ['model' => $profesor,]);
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
                        <label for="cmb_facultad" class="col-sm-5 col-md-5 col-xs-5 col-lg-5 control-label"><?= Yii::t("formulario", "Mode") ?></label>
                        <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                            <?= Html::dropDownList("cmb_facultad", 0, $arr_facultad, ["class" => "form-control PBvalidation", "id" => "cmb_facultad"]) ?>                            
                        </div>
                    </div>
                </div> 
            </div> 
            <div id="periodo" style="display: block;" class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>        
                <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                    <div class="form-group">                
                        <label for="cmb_anio" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label"><?= Yii::t("formulario", "Period"); ?> <span class="text-danger"></span></label>
                        <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3">                    
                            <?= Html::dropDownList("cmb_anio", 0, $anio, ["class" => "form-control", "id" => "cmb_anio"]) ?>                           
                        </div>
                        <div class="col-sm-4 col-md-4 col-xs-4 col-lg-4">
                            <?= Html::dropDownList("cmb_periodo", 0, $periodo, ["class" => "form-control", "id" => "cmb_periodo"]) ?>                            
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                    <div class="form-group">
                        <label for="cmb_bloque" class="col-sm-5 col-md-5 col-xs-5 col-lg-5 control-label"><?= Yii::t("formulario", "Block") ?></label>
                        <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                            <?= Html::dropDownList("cmb_bloque", 0, $bloque, ["class" => "form-control", "id" => "cmb_bloque"]) ?>                
                        </div>
                    </div>   
                </div>
            </div>          
            <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>         
                <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                    <div class="form-group">
                        <label for="cmb_areacono" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label"><?= Yii::t("formulario", "Knowledge Area") ?></label>
                        <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                            <?= Html::dropDownList("cmb_areacono", 0, $areaconoce, ["class" => "form-control", "id" => "cmb_areacono"]) ?>
                        </div>
                    </div>
                </div> 
                <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                    <div class="form-group">
                        <label for="cmb_subarea" class="col-sm-5 col-md-5 col-xs-5 col-lg-5 control-label"><?= Yii::t("formulario", "Knowledge Sub Area") ?></label>
                        <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                            <?= Html::dropDownList("cmb_subarea", 0, $arr_subarea, ["class" => "form-control PBvalidation", "id" => "cmb_subarea"]) ?>                  
                        </div>
                    </div>
                </div>
            </div> 
            <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'> 
                <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6" id="asigna">
                    <div class="form-group">
                        <label for="cmb_asignatura" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label"><?= Yii::t("formulario", "Subject") ?></label>
                        <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                            <?= Html::dropDownList("cmb_asignatura", 0, $materia, ["class" => "form-control PBvalidation", "id" => "cmb_asignatura"]) ?>                  
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6" style="display: none;" id="modulo">
                    <div class="form-group">
                        <label for="cmb_modulo" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label"><?= Yii::t("formulario", "Module") ?></label>
                        <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                            <?= Html::dropDownList("cmb_modulo", 0, $materia, ["class" => "form-control PBvalidation", "id" => "cmb_modulo"]) ?>                  
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                    <div class="form-group">
                        <label for="txt_paralelo" class="col-sm-5 col-md-5 col-xs-5 col-lg-5 control-label"><?= Yii::t("formulario", "Number Parallel") ?></label>
                        <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                            <input type="text" class="form-control PBvalidation keyupmce" value="" id="txt_paralelo" data-type="numeracion_mi" data-keydown="true" placeholder="<?= Yii::t("formulario", "Number Parallel") ?>"> 
                        </div>
                    </div>
                </div>
            </div>
            <div id="grupo" style="display: none;" class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>        
                <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                    <div class="form-group">
                        <label for="cmb_grupo" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label"><?= Yii::t("formulario", "Group") ?></label>
                        <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                            <?= Html::dropDownList("cmb_grupo", 0, $arrgrupo_pos, ["class" => "form-control", "id" => "cmb_grupo"]) ?>                
                        </div>
                    </div>   
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                    <div class="form-group">
                        <label for="cmb_mes" class="col-sm-5 col-md-5 col-xs-5 col-lg-5 control-label"><?= Yii::t("formulario", "Month") ?></label>
                        <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                            <?= Html::dropDownList("cmb_mes", 0, ["1" => "Enero", "2" => "Febrero", "3" => "Marzo", "4" => "Abril", "5" => "Mayo", "6" => "Junio", "7" => "Julio", "8" => "Agosto", "9" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre"], ["class" => "form-control", "id" => "cmb_mes"]) ?>                
                        </div>
                    </div>   
                </div>
            </div> 
            <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12' id="buscacarrera" style="display: block;">
                <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'> 
                    <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                        <div class='col-md-4 col-xs-4 col-lg-4 col-sm-4'>         
                            <p> <a id="btn_BuscarCarrera" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Search") . ' ' . Yii::t("academico", "Career") ?></a></p>
                        </div>
                    </div>        
                </div>
                <div id="gridcarrera" style="display: none;">
                    <?=
                    $this->render('_listaCarreGrid.php', [
                        'model' => $arr_carrera,
                    ]);
                    ?>   
                </div>
            </div>
            <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12' id="buscaprograma" style="display: none;">
                <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'> 
                    <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                        <div class='col-md-4 col-xs-4 col-lg-4 col-sm-4'>         
                            <p> <a id="btn_BuscarPrograma" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Search") . ' ' . Yii::t("formulario", "Program") ?></a></p>
                        </div>
                    </div>        
                </div>
                <div id="gridprograma" style="display: none;">
                   <?=
                    $this->render('_listaCarreGrid.php', [
                        'model' => $arr_carrera,
                    ]);
                    ?> 
                </div>
            </div>
        </div>
    </div>
    <div class="table table-bordered">
        <div class="panel-body">
            <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12 ">
                <div class="col-md-7 col-sm-7 col-xs-7 col-lg-7">
                    <div class="form-group">
                        <h4><span id="lbl_resulevalua"><?= Yii::t("formulario", "Data Time Class") ?></span></h4>                                  
                    </div>
                </div>            
            </div> 
            <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12 '> 
                <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                    <div class="form-group">
                        <label for="cmb_semana" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label"><?= Yii::t("formulario", "Weekday") ?></label>
                        <div class="col-sm-6 col-md-6 col-xs-6 col-lg-6">
                            <?= Html::dropDownList("cmb_semana", 0, ["Lunes" => "Lunes", "Martes" => "Martes", "Miércoles" => "Miércoles", "Jueves" => "Jueves", "Viernes" => "Viernes", "Sábado" => "Sábado", "Domingo" => "Domingo"], ["class" => "form-control", "id" => "cmb_semana"]) ?>
                        </div>
                    </div>
                </div> 
                <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                    <div class="form-group">                
                        <label for="txt_hora_inicio" class="col-sm-5 col-md-5 col-xs-5 col-lg-5 control-label"><?= Yii::t("formulario", "Hour Start/End"); ?> </label>
                        <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3">                    
                            <input type="text" class="form-control" value="" id="txt_hora_inicio" data-type="tiempo" data-keydown="true" placeholder="<?= Yii::t('formulario', 'HH:MM')?>">
                        </div>
                        <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3">
                            <input type="text" class="form-control" value="" id="txt_hora_fin" data-type="tiempo" data-keydown="true" placeholder="<?= Yii::t('formulario', 'HH:MM')?>">

                        </div>
                    </div>
                </div>
            </div>  
            <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'> 
                <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                    <div class='col-md-3 col-xs-3 col-lg-3 col-sm-3'>         
                        <p> <a id="btn_AgregarHorario" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Add") ?></a></p>
                    </div>
                </div>        
            </div> 
            <div class="col-xs-12 col-sm-12 col-md-12">
                <!-- Espacio de relleno -->
                </br>
            </div> 
            <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>
                <div id="resultadoListHorario">

                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <!-- Espacio de relleno -->
                </br>
            </div>
        </div>
    </div>
    <div class="table table-bordered">
        <div class="panel-body">
            <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12 ">
                <div class="col-md-7 col-sm-7 col-xs-7 col-lg-7">
                    <div class="form-group">
                        <h4><span id="lbl_resulevalua"><?= Yii::t("formulario", "Results evaluation") ?></span></h4>                                  
                    </div>
                </div>            
            </div> 
            <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>
                <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                    <div class="form-group">
                        <label for="txt_heteroevaluación" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label"><?= Yii::t("formulario", "Heteroevaluation(40%)") ?></label>
                        <div class="col-sm-6 col-md-6 col-xs-6 col-lg-6">
                            <input type="text" class="form-control PBvalidation" id="txt_heteroevaluación" data-type="dinero" data-keydown="true" placeholder=""></div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                    <div class="form-group">                
                        <label for="txt_autoevaluación" class="col-sm-5 col-md-5 col-xs-5 col-lg-5 control-label"><?= Yii::t("formulario", "Self-evaluation (20%)"); ?> <span class="text-danger"></span></label>
                        <div class="col-sm-6 col-md-6 col-xs-6 col-lg-6">                    
                            <input type="text" class="form-control PBvalidation" id="txt_autoevaluación" data-type="dinero" data-keydown="true" placeholder="">
                        </div>
                    </div>
                </div>
            </div>  
            <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>
                <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                    <div class="form-group">
                        <label for="txt_coevaluación" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label"><?= Yii::t("formulario", "Co-evaluation (20%)") ?></label>
                        <div class="col-sm-6 col-md-6 col-xs-6 col-lg-6">
                            <input type="text" class="form-control PBvalidation" id="txt_coevaluación" data-type="dinero" data-keydown="true" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                    <div class="form-group">                
                        <label for="txt_directivo" class="col-sm-5 col-md-5 col-xs-5 col-lg-5 control-label"><?= Yii::t("formulario", "Management (20%)"); ?> <span class="text-danger"></span></label>
                        <div class="col-sm-6 col-md-6 col-xs-6 col-lg-6">                    
                            <input type="text" class="form-control PBvalidation" id="txt_directivo" data-type="dinero" data-keydown="true" placeholder="">
                        </div>
                    </div>
                </div>
            </div>  
            <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>
                <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                    <div class="form-group">
                        <label for="txt_promedio" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label"><?= Yii::t("formulario", "Weighted") ?></label>
                        <div class="col-sm-4 col-md-4 col-xs-4 col-lg-4">
                            <input type="text" class="form-control PBvalidation" disabled="true"  id="txt_promedio" data-type="dinero" data-keydown="true" placeholder="">
                        </div>
                    </div>
                </div>       
            </div>
            <div class="row"> 
                <div class="col-md-7"></div>
                <div class="col-md-2 col-xs-4 col-lg-2 col-sm-2">
                    <a id="btnPromedio" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Average") ?> </a>
                </div>
                <div class="col-md-2 col-xs-4 col-lg-2 col-sm-2">
                    <a id="sendEvaluacion" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("accion", "Save") ?> </a>
                </div>
            </div>
        </div>
    </div>      
    <?= Html::hiddenInput('txth_evaluar', $txth_evaluar, ['id' => 'txth_evaluar']); ?>
</form>