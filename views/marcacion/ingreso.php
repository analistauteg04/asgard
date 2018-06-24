<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\components\CFileInputAjax;
use yii\web\JsExpression;

//setlocale(LC_ALL,"es_ES");

//print_r("ok ".$profesor );


 /*  $arrayMeses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
   'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
 
   $arrayDias = array( 'Domingo', 'Lunes', 'Martes',
       'Miercoles', 'Jueves', 'Viernes', 'Sabado');
     
    echo ($arrayDias[date('w')].", ".date('d')." de ".$arrayMeses[date('m')-1]." de ".date('Y'));
*/
//array_unshift($materia, "Seleccionar");
?>

<form class="form-horizontal" enctype="multipart/form-data" id="formsolicitud">
    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
        <h3><span id="lbl_solicitud"><?= Yii::t("formulario", "Ingreso Marcación") ?></span></h3>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <!-- Espacio de relleno -->
        </br>
    </div>

    <div class="table table-bordered">
        <div class="panel-body">  
            <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>  
                 <div class="form-group">
                    <h4><span id="lbl_resulevalua"><?= Yii::t("formulario", "Data Teacher") ?></span></h4>                                  
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                    <div class="form-group">
                        <label for="txt_primer_nombre" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label"><?= Yii::t("formulario", "Nombres") ?></label>
                        <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                            <input type="text" class="form-control PBvalidation keyupmce" value="<?= $profesor ?>" id="txt_primer_nombre" data-type="alfa" data-keydown="true" disabled ="true" placeholder="<?= Yii::t("formulario", "First Name") ?>">                                          
                        </div>
                    </div>
                </div>   
                <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                    <div class="form-group">
                        <label for="txt_tipo_identificacion" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label"><?= Yii::t("formulario", "DNI") ?></label>
                        <div class="col-sm-2 col-md-2 col-xs-2 col-lg-2">
                            <input type="text" class="form-control PBvalidation keyupmce" value="<?= $tipo_identificacion ?>" id="txt_tipo_identificacion" data-type="alfa" data-keydown="true" disabled ="true" placeholder="<?= Yii::t("formulario", "DNI") ?>">                                          
                        </div>
                        <div class="col-sm-4 col-md-4 col-xs-4 col-lg-4">
                            <input type="text" class="form-control PBvalidation keyupmce" value="<?= $identificacion ?>" id="txt_identificacion" data-type="number" data-keydown="true" disabled ="true" placeholder="<?= Yii::t("formulario", "DNI") ?>">                                          
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
                        <label for="txt_fecha" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label"><?= Yii::t("formulario", "Weekday") ?></label>
                        <div class="col-sm-6 col-md-6 col-xs-6 col-lg-6">                           
                            <input type="text" disabled="true"  class="form-control" value="<?= print_r(date('d/m/Y')) ?>" id="txt_fecha" data-type="tiempo" data-keydown="true" placeholder="<?= Yii::t('formulario', 'HH:MM')?>">
                        </div>
                    </div>
                </div> 
                <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                    <div class="form-group">                
                        <label for="txt_hora" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label"><?= Yii::t("formulario", "Hour Start/End"); ?> </label>
                        <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3">                    
                            <input type="text" disabled="true"  class="form-control" value="<?= print_r(date('H:i:s',time())); ?>" id="txt_hora" data-type="tiempo" data-keydown="true" placeholder="<?= Yii::t('formulario', 'HH:MM')?>">
                        </div>                        
                    </div>
                </div>
            </div>  
            <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'> 
                <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                    <div class='col-md-3 col-xs-3 col-lg-3 col-sm-3'>         
                        <p> <a id="sendMarcacion" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Iniciar") ?></a></p>
                    </div>
                </div>        
            </div> 
        </div>
    </div>    
    <?= Html::hiddenInput('txth_marcacion', $txth_marcacion, ['id' => 'txth_marcacion']); ?>    
</form>