<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;
use kartik\date\DatePicker;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\components\CFileInputAjax;


// CAN: GRADO
$requisitosCANP = ' <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                    <div class="form-group">
                        <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3">
                        </div>
                        <div class="col-sm-9 col-md-9 col-xs-9 col-lg-9">
                            <div style = "width: 1200px;" class="alert alert-info"><span style="font-weight: bold"> Nota: </span> Fecha curso de nivelación del 22 de octubre al 7 de diciembre deberás cargar en el siguiente paso estos documentos: <br>
                                Cédula de identidad o pasaporte. <br>
                                Certificado de votación. <br>
                                Título de bachiller notarizado. <br>
                                Foto Actual. <br>
                            </div>
                        </div>
                    </div>
                </div>'; 

$requisitosCANSP = ' <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                    <div class="form-group">
                        <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3">
                        </div>
                        <div class="col-sm-9 col-md-9 col-xs-9 col-lg-9">
                            <div style = "width: 1200px;" class="alert alert-info"><span style="font-weight: bold"> Nota: </span> Fecha curso de nivelación del 22 de octubre al 7 de diciembre deberás cargar en el siguiente paso estos documentos: <br>
                                Cédula de identidad o pasaporte. <br>
                                Certificado de votación. <br>
                                Título de bachiller notarizado. <br>
                                Foto Actual. <br>
                            </div>
                        </div>
                    </div>
                </div>'; 

$requisitosCANAD = ' <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                    <div class="form-group">
                        <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3">
                        </div>
                        <div class="col-sm-9 col-md-9 col-xs-9 col-lg-9">
                            <div style = "width: 1200px;" class="alert alert-info"><span style="font-weight: bold"> Nota: </span> Fecha curso de nivelación del 22 de octubre al 7 de diciembre deberás cargar en el siguiente paso estos documentos: <br>
                                Cédula de identidad o pasaporte. <br>
                                Certificado de votación. <br>
                                Título de bachiller notarizado. <br>
                                Foto Actual. <br>
                            </div>
                        </div>
                    </div>
                </div>'; 

$requisitosCANO = ' <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                    <div class="form-group">
                        <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3">
                        </div>
                        <div class="col-sm-9 col-md-9 col-xs-9 col-lg-9">
                            <div style = "width: 1200px;" class="alert alert-info"><span style="font-weight: bold">Fecha curso de nivelación del 22 de octubre al 14 de diciembre deberás cargar en el siguiente paso estos documentos: <br> </span>
                                Cédula de identidad o pasaporte. <br>
                                Certificado de votación. <br>
                                Título de bachiller notarizado. <br>
                                Foto Actual. <br>
                            </div>
                        </div>
                    </div>
                </div>'; 

// EXAMEN: GRADO
$requisitosEXP = ' <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                    <div class="form-group">
                        <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3">
                        </div>
                        <div class="col-sm-9 col-md-9 col-xs-9 col-lg-9">
                            <div style = "width: 1200px;" class="alert alert-info"><span style="font-weight: bold"> Nota: </span> Fecha curso de nivelación del 22 de octubre al 7 de diciembre deberás cargar en el siguiente paso estos documentos: <br>
                                Cédula de identidad o pasaporte. <br>
                                Certificado de votación. <br>
                                Título de bachiller notarizado. <br>
                                Foto Actual. <br>
                            </div>
                        </div>
                    </div>
                </div>'; 

$requisitosEXSP = ' <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                    <div class="form-group">
                        <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3">
                        </div>
                        <div class="col-sm-9 col-md-9 col-xs-9 col-lg-9">
                            <div style = "width: 1200px;" class="alert alert-info"><span style="font-weight: bold"> Nota: </span> Fecha curso de nivelación del 22 de octubre al 7 de diciembre deberás cargar en el siguiente paso estos documentos: <br>
                                Cédula de identidad o pasaporte. <br>
                                Certificado de votación. <br>
                                Título de bachiller notarizado. <br>
                                Foto Actual. <br>
                            </div>
                        </div>
                    </div>
                </div>'; 

$requisitosEXAD = ' <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                    <div class="form-group">
                        <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3">
                        </div>
                        <div class="col-sm-9 col-md-9 col-xs-9 col-lg-9">
                            <div style = "width: 1200px;" class="alert alert-info"><span style="font-weight: bold"> Nota: </span> Fecha curso de nivelación del 22 de octubre al 7 de diciembre deberás cargar en el siguiente paso estos documentos: <br>
                                Cédula de identidad o pasaporte. <br>
                                Certificado de votación. <br>
                                Título de bachiller notarizado. <br>
                                Foto Actual. <br>
                            </div>
                        </div>
                    </div>
                </div>'; 

$requisitosEXO = ' <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                    <div class="form-group">
                        <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3">
                        </div>
                        <div class="col-sm-9 col-md-9 col-xs-9 col-lg-9">
                            <div style = "width: 1200px;" class="alert alert-info"><span style="font-weight: bold"> Al inscribirte al examen de admisión, tendrás acceso al Campus Virtual UTEG para prepararte. A partir de la fecha de registro tendrás un mes para rendir el examen de manera online. <br>
                                Deberás cargar en el siguiente paso estos documentos: <br></span>                                 
                                Cédula de identidad o pasaporte. <br>
                                Certificado de votación. <br>
                                Título de bachiller notarizado. <br>
                                Foto Actual. <br>
                            </div>
                        </div>
                    </div>
                </div>'; 
//Posgrado
$requisitosPRP = '<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                    <div class="form-group">
                        <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3">
                        </div>
                        <div class="col-sm-9 col-md-9 col-xs-9 col-lg-9">
                            <div style = "width: 1200px;" class="alert alert-info"><span style="font-weight: bold"> Deberás cargar en el siguiente paso estos documentos: </span><br>
                                    Cédula de identidad o pasaporte <br>
                                    Certificado de votación <br>
                                    Título de tercer nivel notarizado <br>
                                    Certificado de calificaciones de estudios de tercer nivel  <br>
                                    Hoja de vida   <br>
                                    Foto actual    <br>
                            </div>
                        </div>
                    </div>
                  </div>'; 

$requisitosHOMO = ' <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                    <div class="form-group">
                        <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3">
                        </div>
                        <div class="col-sm-9 col-md-9 col-xs-9 col-lg-9">
                            <div style = "width: 1200px;" class="alert alert-info"><span style="font-weight: bold"> Nota: </span> Fecha curso de nivelación del 22 de octubre al 7 de diciembre deberás cargar en el siguiente paso estos documentos: <br>
                                Cédula de identidad o pasaporte. <br>
                                Certificado de votación. <br>
                                Título de bachiller notarizado. <br>
                                Foto Actual. <br>
                            </div>
                        </div>
                    </div>
                </div>'; 
?>
<form class="form-horizontal">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h3><span id="lbl_Personeria"><?= Yii::t("formulario", "Application for Admission Process") ?></span></h3>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <p class="text-danger"> <?= Yii::t("formulario", "Fields with * are required") ?> </p>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="txt_primer_nombre" class="col-lg-3 col-md-3 col-sm-3 col-xs-3 control-label"><?= Yii::t("formulario", "Name") ?> <span class="text-danger">*</span></label>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                <input type="text" class="form-control PBvalidation keyupmce" id="txt_primer_nombre" data-type="alfa" data-keydown="true" placeholder="<?= Yii::t("formulario", "First Name") ?>">
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="txt_primer_apellido" class="col-lg-3 col-md-3 col-sm-3 col-xs-3 control-label"><?= Yii::t("formulario", "Last Name1") ?> <span class="text-danger">*</span></label>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                <input type="text" class="form-control PBvalidation keyupmce" id="txt_primer_apellido" data-type="alfa" data-keydown="true" placeholder="<?= Yii::t("formulario", "Last Name") ?>">
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="cmb_tipo_dni" class="col-lg-3 col-md-3 col-sm-3 col-xs-3 control-label keyupmce"><?= Yii::t("formulario", "DNI 1") ?> <span class="text-danger">*</span></label>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                <?= Html::dropDownList("cmb_tipo_dni", 0, $tipos_dni, ["class" => "form-control", "id" => "cmb_tipo_dni"]) ?>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="Divcedula">
        <div class="form-group">
            <label for="txt_cedula" class="col-lg-3 col-md-3 col-sm-3 col-xs-3 control-label"><?= Yii::t("formulario", "Number") ?> <span class="text-danger">*</span></label>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                <input type="text" maxlength="10" class="form-control PBvalidation keyupmce" id="txt_cedula" data-type="number" data-keydown="true" placeholder="<?= Yii::t("formulario", "National identity document") ?>">
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display: none;" id="Divpasaporte">
        <div class="form-group">
            <label for="txt_pasaporte" class="col-lg-3 col-md-3 col-sm-3 col-xs-3 control-label"><?= Yii::t("formulario", "Number") ?> <span class="text-danger">*</span></label>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                <input type="text" maxlength="15" class="form-control keyupmce" id="txt_pasaporte" data-type="alfanumerico" data-keydown="true" placeholder="<?= Yii::t("formulario", "Passport") ?>">
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="txt_correo" class="col-lg-3 col-md-3 col-sm-3 col-xs-3 control-label"><?= Yii::t("formulario", "Email") ?> <span class="text-danger">*</span></label>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                <input type="text" class="form-control PBvalidation" id="txt_correo" data-type="email" data-keydown="true" placeholder="<?= Yii::t("formulario", "Email") ?>">
            </div>
        </div>
    </div>   
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">            
            <label for="cmb_pais_dom" class="col-lg-3 col-md-3 col-sm-3 col-xs-3 control-label"><?= Yii::t("formulario", "Country") ?> <span class="text-danger">*</span></label>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                <?= Html::dropDownList("cmb_pais_dom", 1, $arr_pais_dom, ["class" => "form-control", "id" => "cmb_pais_dom"]) ?>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="txt_celular" class="col-lg-3 col-md-3 col-sm-3 col-xs-3 control-label"><?= Yii::t("formulario", "CellPhone") ?> <span class="text-danger">*</span></label>		
            <!--<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"> 
                <input type="text" class="form-control" id="txt_codigoarea" data-type="number" value ="+593" disabled = "true " data-keydown="true">                
            </div>-->
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                <input type="text" class="form-control PBvalidation" id="txt_celular" data-type="number" data-keydown="true" placeholder="<?= Yii::t("formulario", "CellPhone") ?>">
            </div>
        </div>
    </div>        
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">            
            <label for="cmb_unidad_solicitud" class="col-lg-3 col-md-3 col-sm-3 col-xs-3 control-label"><?= Yii::t("formulario", "Academic unit") ?> <span class="text-danger">*</span></label>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                <?= Html::dropDownList("cmb_unidad_solicitud", 0, $arr_ninteres, ["class" => "form-control", "id" => "cmb_unidad_solicitud"]) ?>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">            
            <label for="cmb_modalidad_solicitud" class="col-lg-3 col-md-3 col-sm-3 col-xs-3 control-label"><?= Yii::t("formulario", "Mode") ?> <span class="text-danger">*</span></label>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                <?= Html::dropDownList("cmb_modalidad_solicitud", 0, $arr_modalidad, ["class" => "form-control", "id" => "cmb_modalidad_solicitud"]) ?>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">            
            <label for="cmb_carrera_solicitud" class="col-lg-3 col-md-3 col-sm-3 col-xs-3 control-label"><?= Yii::t("academico", "Career") . ' /Programa' ?> <span class="text-danger">*</span></label>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                <?= Html::dropDownList("cmb_carrera_solicitud", 0, $arr_carrerra1, ["class" => "form-control", "id" => "cmb_carrera_solicitud"]) ?>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">            
            <label for="cmb_metodo_solicitud" class="col-sm-3 col-md-3 col-xs-3 col-lg-3 control-label keyupmce"><?= Yii::t("formulario", "Income Method") ?><span class="text-danger">*</span></label>
            <div class="col-sm-9 col-md-9 col-xs-9 col-lg-9">
                <?= Html::dropDownList("cmb_metodo_solicitud", 0, array_merge([Yii::t("formulario", "Select")], $arr_metodos), ["class" => "form-control", "id" => "cmb_metodo_solicitud"]) ?>
            </div>
        </div>
    </div> 
    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12" id="divRequisitosCANP" style="display: none">   
        <?php echo $requisitosCANP ?>
    </div>
    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12" id="divRequisitosCANSP" style="display: none">   
        <?php echo $requisitosCANSP ?>
    </div>
    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12" id="divRequisitosCANAD" style="display: none">   
        <?php echo $requisitosCANAD ?>
    </div>
    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12" id="divRequisitosCANO" style="display: none">   
        <?php echo $requisitosCANO ?>
    </div>
    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12" id="divRequisitosEXP" style="display: none">   
        <?php echo $requisitosEXP ?>
    </div>
    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12" id="divRequisitosEXSP" style="display: none">   
        <?php echo $requisitosEXSP ?>
    </div>
    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12" id="divRequisitosEXAD" style="display: none">   
        <?php echo $requisitosEXAD ?>
    </div>
    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12" id="divRequisitosEXO" style="display: none">   
        <?php echo $requisitosEXO ?>
    </div>
    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12" id="divRequisitosEXO" style="display: none">   
        <?php echo $requisitosEXO ?>
    </div>
    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12" id="divRequisitosPRP" style="display: none">   
        <?php echo $requisitosPRP ?>
    </div>
    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12" id="divRequisitosHOMO" style="display: none">   
        <?php echo $requisitosHOMO ?>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">            
            <label for="cmb_conuteg" class="col-lg-3 col-md-3 col-sm-3 col-xs-3 control-label"><?= Yii::t("formulario", "Knowledge how about UTEG") ?> <span class="text-danger">*</span></label>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                <?= Html::dropDownList("cmb_conuteg", 0, $arr_conuteg, ["class" => "form-control", "id" => "cmb_conuteg"]) ?>
            </div>
        </div>
    </div>
        
    <div class="row"> 
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10"></div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <a id="sendInformacionAspirante" href="javascript:" class="btn btn-primary btn-block"> <?php echo "Siguiente"; ?> </a>
        </div>
    </div>
</form>