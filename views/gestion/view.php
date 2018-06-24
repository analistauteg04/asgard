<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\date\DatePicker;

//print_r('SubCarrera:'.$tsca_id);
// echo 'ggg '.base64_decode($_GET['codigo']);
?>
<?= Html::hiddenInput('txth_idg', '', ['id' => 'txth_idg']); ?>
<?= Html::hiddenInput('txth_idc', '', ['id' => 'txth_idc']); ?>
<div class="col-md-12">    
    <h3><span id="lbl_titulo"><?= Yii::t("formulario", "View Management") ?></span><br/>    
</div>
<div class="col-md-12">    
    <br/>    
</div>
<form class="form-horizontal" enctype="multipart/form-data" >
    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12 ">
        <div class="col-md-7 col-sm-7 col-xs-7 col-lg-7">
            <div class="form-group">
                <h4><span id="lbl_general"><?= Yii::t("formulario", "Data General") ?></span></h4>                                  
            </div>
        </div>            
    </div> 
    <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_nombre1" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label" id="lbl_nombre1"><?= Yii::t("formulario", "First Name") ?> </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">

                    <input type="text" class="form-control PBvalidation keyupmce" value="<?= $arra_pnomb_con ?>" disabled id="txt_nombre1" data-type="alfa" placeholder="<?= Yii::t("formulario", "First Name") ?>">
                </div>
            </div>
        </div>  
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_nombre2" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label" id="lbl_nombre2"><?= Yii::t("formulario", "Middle Name") ?></label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <input type="text" class="form-control" value="<?= $arra_snomb_con ?>" disabled id="txt_nombre2" data-type="alfa" placeholder="<?= Yii::t("formulario", "Middle Name") ?>">
                </div>
            </div>
        </div>  
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_apellido1" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label" id="lbl_apellido1"><?= Yii::t("formulario", "Last Name") ?> </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <input type="text" class="form-control PBvalidation keyupmce" value="<?= $arra_papellido_con ?>" disabled id="txt_apellido1" data-type="alfa" placeholder="<?= Yii::t("formulario", "Last Name") ?>">
                </div>
            </div>
        </div>  
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_apellido12" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label" id="lbl_apellido2"><?= Yii::t("formulario", "Last Second Name") ?> </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <input type="text" class="form-control PBvalidation keyupmce" value="<?= $arra_sapellido_con ?>" disabled id="txt_apellido12" data-type="alfa" placeholder="<?= Yii::t("formulario", "Last Second Name") ?>">
                </div>
            </div>
        </div>  
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="cmb_pais" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "Country") ?> </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <?= Html::dropDownList("cmb_pais", $pais, $arr_pais, ["class" => "form-control", "id" => "cmb_pais", "disabled" => true]) ?>             
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="cmb_prov" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "State") ?> </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <?= Html::dropDownList("cmb_prov", $provincia, $arr_prov, ["class" => "form-control", "id" => "cmb_prov", "disabled" => true]) ?>
                </div>
            </div>
        </div>               
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">    
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="cmb_ciu" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "City") ?> </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <?= Html::dropDownList("cmb_ciu", $ciudad, $arr_ciu, ["class" => "form-control can_combo", "id" => "cmb_ciu", "disabled" => true]) ?>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="txt_celular" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "CellPhone") ?> </label>        
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <div class="input-group">
                        <span id="lbl_codeCountry" class="input-group-addon"><?= $area ?></span>
                        <input type="text" class="form-control PBvalidation" value="<?= $celular ?>" disabled id="txt_celular" data-type="celular_sin" data-keydown="true" placeholder="<?= Yii::t("formulario", "CellPhone") ?>">
                    </div>
                </div>
            </div>
        </div>                 
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="txt_celular2" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "CellPhone") . ' 2' ?> </label>        
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <div class="input-group">
                        <span id="lbl_codeCountry" class="input-group-addon"><?= $area ?></span>
                        <input type="text" class="form-control " value="<?= $telf ?>"  disabled id="txt_celular2" data-type="celular_sin" data-keydown="true" placeholder="<?= Yii::t("formulario", "CellPhone") . ' 2' ?>">
                    </div>
                </div>
            </div>           
        </div>          
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="txt_telefono_con" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label"><?= Yii::t("formulario", "Phone") ?></label>      
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <div class="input-group">
                        <span id="lbl_codeCountrycon" class="input-group-addon"><?= $area ?></span>
                        <input type="text" class="form-control" data-required="false" value="<?= $convenc ?>" disabled id="txt_telefono_con" data-type="telefono_sin" data-keydown="true" placeholder="<?= Yii::t("formulario", "Phone") ?>">
                    </div>
                </div>
            </div>
        </div>  
    </div>    

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="txt_correo" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  col-md-4 col-xs-4 col-lg-4 control-label"><?= Yii::t("formulario", "Email") ?> </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <input type="text" class="form-control PBvalidation" value="<?= $correo ?>" disabled id="txt_correo" data-type="email" data-keydown="true" placeholder="<?= Yii::t("formulario", "Email") ?>">
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="cmb_medio" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "Half Contact") ?> </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <?= Html::dropDownList("cmb_medio", $mcon_id, $arr_conocimiento, ["class" => "form-control pro_combo", "id" => "cmb_medio", "disabled" => true]) ?>
                </div>
            </div>
        </div>                
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="cmb_nivelestudio" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "Academic unit") ?> </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <?= Html::dropDownList("cmb_nivelestudio", $nint_id, $arr_ninteres, ["class" => "form-control pro_combo", "id" => "cmb_nivelestudio", "disabled" => true]) ?>
                </div>
            </div>
        </div>  
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="cmb_modalidad" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label"><?= Yii::t("formulario", "Mode") ?>  </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <?= Html::dropDownList("cmb_modalidad", $mod_id, $arr_modalidad, ["class" => "form-control PBvalidation", "id" => "cmb_modalidad", "disabled" => true]) ?>                            
                </div>
            </div>
        </div>
    </div>
    <div id="carrera" style="display: block;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="cmb_carrera1" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("academico", "Career") . ' 1' ?>  </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <?= Html::dropDownList("cmb_carrera1", $car_id, /* $arr_carrerra1 */ ["1" => "Carrera 1", "2" => "Carrera 2"], ["class" => "form-control", "id" => "cmb_carrera1", "disabled" => true]) ?>
                </div>
            </div>
        </div> 
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="cmb_carrera2" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("academico", "Career") . ' 2' ?>  </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <?= Html::dropDownList("cmb_carrera2", $tcar_id, $arr_carrerra2, ["class" => "form-control", "id" => "cmb_carrera2", "disabled" => true]) ?>
                </div>
            </div>
        </div>
    </div>    
    <div id="programa" style="display: none;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="cmb_programa1" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "Program") . ' 1' ?>  </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <?= Html::dropDownList("cmb_programa1", 0, ["1" => "Programa 1", "2" => "Programa 2"], ["class" => "form-control", "id" => "cmb_programa1", "disabled" => true]) ?>
                </div>
            </div>
        </div> 
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="cmb_programa2" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "Program") . ' 2' ?>  </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <?= Html::dropDownList("cmb_programa2", 0, ["1" => "Programa 1", "2" => "Programa 2"], ["class" => "form-control", "id" => "cmb_programa2", "disabled" => true]) ?>
                </div>
            </div>
        </div>
    </div>  
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="cmb_subcarrera" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "Sub Carrier") ?>  </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <?= Html::dropDownList("cmb_subcarrera", $tsca_id, $arr_subcarrera, ["class" => "form-control", "id" => "cmb_subcarrera", "disabled" => true]) ?>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="cmb_canal" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "Channel") ?>  </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <?= Html::dropDownList("cmb_canal", $ccan_id, $arr_canal, ["class" => "form-control can_combo", "id" => "cmb_canal", "disabled" => true]) ?>
                </div>
            </div>
        </div>    
    </div>
    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12 ">
        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12 ">
            <div class="col-md-7 col-sm-7 col-xs-7 col-lg-7">
                <div class="form-group">
                    <h4><span id="lbl_general"><?= Yii::t("formulario", "Data General Contact") ?></span></h4>                                  
                </div>
            </div>            
        </div>
        <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>
            <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                <div class="form-group">
                    <label for="txt_nombrebene1" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label" id="lbl_nombrebene1"><?= Yii::t("formulario", "First Name") ?> </label>
                    <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                        <input type="text" class="form-control" value="<?= $arra_pnomb_ben ?>" disabled id="txt_nombrebene1" data-type="alfa" placeholder="<?= Yii::t("formulario", "First Name") ?>">
                    </div>
                </div>
            </div>  
            <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                <div class="form-group">
                    <label for="txt_nombrebene2" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label" id="lbl_nombrebene1"><?= Yii::t("formulario", "Middle Name") ?></label>
                    <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                        <input type="text" class="form-control" value="<?= $arra_snomb_ben ?>" disabled  id="txt_nombrebene2" data-type="alfa" placeholder="<?= Yii::t("formulario", "Middle Name") ?>">
                    </div>
                </div>
            </div>  
        </div>  
        <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>
            <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                <div class="form-group">
                    <label for="txt_apellidobene1" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label" id="lbl_apellidobene1"><?= Yii::t("formulario", "Last Name") ?> </label>
                    <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                        <input type="text" class="form-control" value="<?= $arra_papellido_ben ?>" disabled id="txt_apellidobene1" data-type="alfa" placeholder="<?= Yii::t("formulario", "Last Name") ?>">
                    </div>
                </div>
            </div>  
            <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                <div class="form-group">
                    <label for="txt_apellidobene2" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label" id="txt_apellidobene2"><?= Yii::t("formulario", "Last Second Name") ?> </label>
                    <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                        <input type="text" class="form-control" value="<?= $arra_sapellido_ben ?>" disabled id="txt_apellidobene2" data-type="alfa" placeholder="<?= Yii::t("formulario", "Last Second Name") ?>">
                    </div>
                </div>
            </div>  
        </div>
        <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <div class="form-group">
                    <label for="txt_celularbene" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "CellPhone") ?> </label>        
                    <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                        <div class="input-group">
                            <span id="lbl_codeCountrybeni" class="input-group-addon"><?= $area ?></span>
                            <input type="text" class="form-control" value="<?= $celularben ?>" disabled id="txt_celularbene" data-type="celular_sin" data-keydown="true" placeholder="<?= Yii::t("formulario", "CellPhone") ?>">
                        </div>
                    </div>
                </div>
            </div> 
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <div class="form-group">
                    <label for="txt_correobeni" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  col-md-4 col-xs-4 col-lg-4 control-label"><?= Yii::t("formulario", "Email") ?> </label>
                    <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                        <input type="text" class="form-control" value="<?= $correo ?>" disabled id="txt_correobeni" data-type="email" data-keydown="true" placeholder="<?= Yii::t("formulario", "Email") ?>">
                    </div>
                </div>
            </div>
        </div>          
    </div>
    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12 ">
        <div class="col-md-7 col-sm-7 col-xs-7 col-lg-7">
            <div class="form-group">
                <h4><span id="lbl_general"><?= Yii::t("formulario", "Data Management") ?></span></h4>                                  
            </div>
        </div>            
    </div> 
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">    
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="cmb_agente" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "Executive") ?>  </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <input type="text" class="form-control PBvalidation" value="<?= $agente ?>" disabled id="txt_agente" data-type="alfa" data-keydown="true" placeholder="<?= Yii::t('formulario', 'Executive') ?>">        
                </div>
            </div>
        </div> 
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_fecha_recepcion" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "Reception Date") ?>  </label>                
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7 ">                    
                    <input type="text" class="form-control PBvalidation" value="<?= $fec_recepcion ?>" disabled id="txt_fecha_recepcion" data-type="alfa" data-keydown="true" placeholder="<?= Yii::t('formulario', 'Reception Date') ?>">                        
                </div>  

            </div>
        </div> 
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>        
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_fecha_atencion" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "Attention Date") ?>  </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7 ">                    
                    <input type="text" class="form-control PBvalidation" value="<?= $fec_atencion ?>" disabled id="txt_fecha_atencion" data-type="alfa" data-keydown="true" placeholder="<?= Yii::t('formulario', 'Attention Date') ?>">                        
                </div>                 
            </div>                    
        </div> 
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label for="cmb_estado" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "Status") ?> </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <?= Html::dropDownList("cmb_estado", $eges_id, $arr_estgestion, ["class" => "form-control", "id" => "cmb_estado", "disabled" => true]) ?>
                </div>
            </div>
        </div> 
    </div>   
    <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>        
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_observacion" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label" id="lbl_descripcion"><?= Yii::t("formulario", "observation") ?> </label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <textarea  class="form-control PBvalidation keyupmce" disabled="true" id="txt_observacion"><?= $observacion ?></textarea>
                </div>
            </div>
        </div>
        <?php if ($oper_id > 0) { ?>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <div class="form-group">
                    <label for="cmb_oportunidad" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "Lost Opportunity") ?></label>
                    <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                        <?= Html::dropDownList("cmb_oportunidad", $oper_id, $arr_operdida, ["class" => "form-control can_combo", "id" => "cmb_oportunidad", "disabled" => true]) ?>
                    </div>
                </div>
            </div>
        <?php  } ?>
            </div>
            <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12 ">
                <div class="col-md-7 col-sm-7 col-xs-7 col-lg-7">
                    <div class="form-group">
                        <h4><span id="lbl_general"><?= Yii::t("formulario", "Attention Next") ?></span></h4>                                  
                    </div>
                </div>            
            </div> 
            <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>
                <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                    <div class="form-group">
                        <label for="txt_fecha_next" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "Date") ?></label>
                        <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7 ">                    
                            <input type="text" class="form-control PBvalidation" value="<?= $fec_proxima ?>" disabled id="txt_fecha_next" data-type="alfa" data-keydown="true" placeholder="<?= Yii::t('formulario', 'Date') ?>">                        
                        </div>               
                    </div>                    
                </div> 
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="form-group">
                        <label for="cmb_tipocontacto" class="col-sm-4 col-md-4 col-xs-4 col-lg-4  control-label"><?= Yii::t("formulario", "Type") . ' ' . Yii::t("formulario", "Contact") ?>  </label>
                        <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                            <?= Html::dropDownList("cmb_tipocontacto", $tccr_id, ["0" => "Seleccionar", "1" => "Visita", "2" => "Llamada", "3" => "Correo"], ["class" => "form-control", "id" => "cmb_tipocontacto", "disabled" => true]) ?>
                </div>
            </div>
        </div> 
    </div>    
</form>

