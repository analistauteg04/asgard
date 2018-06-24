<?php
/*
 * The Asgard framework is free software. It is released under the terms of
 * the following BSD License.
 *
 * Copyright (C) 2015 by Asgard Software 
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *  - Redistributions of source code must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 *  - Redistributions in binary form must reproduce the above copyright
 *    notice, this list of conditions and the following disclaimer in
 *    the documentation and/or other materials provided with the
 *    distribution.
 *  - Neither the name of Asgard Software nor the names of its
 *    contributors may be used to endorse or promote products derived
 *    from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * Asgard is based on code by
 * Yii Software LLC (http://www.yiisoft.com) Copyright Â© 2008
 *
 * Authors:
 * 
 * Diana Lopez <dlopez@uteg.edu.ec>
 * 
 */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use yii\helpers\Url;
use app\components\CFileInputAjax;
?>

<div class='row'>
    <div class="col-xs-12 col-sm-12 col-md-12 ">
        <!--  <div class="col-md-12">
              <h3><span id="lbl_Personeria"><?= Yii::t("formulario", "Data Additional") ?></span></h3>
          </div> -->       
        <div class="col-xs-12 col-sm-12 col-md-12">
            <!-- Espacio de relleno --></br>
            <div class="form-group">
                <label for="txt_discapacidad" class="col-sm-5 control-label"><?= Yii::t("bienestar", "¿Do you have any type of disability?") ?></label>
                <div class="col-sm-7">
                    <label>                
                        <input type="radio" name="rdb_discapacidadOK" id="rdb_discapacidadOK" disabled="true"
                           <?php
                                if (!empty($datos_discapacidad["ipdi_discapacidad"])) {
                                    echo 'checked';
                                }
                            ?> > Si<br>                                                
                    </label>
                    <label>            
                        <input type="radio" name="rdb_discapacidadNOK" id="rdb_discapacidadNOK" disabled="true" 
                            <?php
                             if (empty($datos_discapacidad["ipdi_discapacidad"])) {
                                 echo 'checked';
                             }
                            ?> > No<br>   
                    </label>
                </div> 
            </div>
        </div>       
        <div id="adicional" style="display: block;" >
            <div class="col-md-12">
                <div class="form-group">
                    <div class="col-md-6">
                        <label for="cmb_tip_discap" class="col-sm-5 control-label keyupmce"><?= Yii::t("bienestar", "Type Disability") ?></label>
                        <div class="col-sm-7">
                            <?= Html::dropDownList("cmb_tip_discap", $datos_discapacidad["tipo_discapacidad"], $tipo_discap, ["class" => "form-control", "id" => "cmb_tip_discap", 'disabled'=>"true"]) ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="txt_por_discapacidad" class="col-sm-5 control-label keyupmce"><?= Yii::t("bienestar", "Percentage Disability") ?></label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control PBvalidation keyupmce" id="txt_por_discapacidad" data-type="number" value="<?= $datos_discapacidad["porcentaje"] ?>" data-keydown="true" disabled="true" placeholder="<?= Yii::t("bienestar", "Percentage Disability") ?>">
                        </div>
                    </div>
                </div>
            </div>                            
            
            <div class="col-md-12">
                <div class="form-group">
                    <div class="col-md-6">
                        <label for="txt_carnet_conadis" class="col-sm-5 control-label keyupmce"><?= Yii::t("formulario", "Número Carnet Conadis") ?></label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control PBvalidation keyupmce" id="txt_carnet_conadis" data-type="number" data-keydown="true" value="<?= $datos_discapacidad["carnet"] ?>" disabled="true" placeholder="<?= Yii::t("bienestar", "Número Carnet Conadis") ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <?php if (!empty($datos_discapacidad["ipdi_discapacidad"])) { ?>                              
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txth_doc_adj_disi" class="col-sm-5 control-label keyupmce"><?= Yii::t("formulario", "Document") ?></label>
                                    <div class="col-md-7">      
                                        <?= Html::a('<span class="glyphicon glyphicon-download-alt"></span>', Url::to(['/site/getimage', 'route' => $datos_discapacidad['ruta']]), ["data-toggle" => "tooltip", "title" => "Ver Archivo", "data-pjax" => 0,'target'=>'_blank'],'Ver Archivo');
                                        ?>
                                    </div>
                                </div>    
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
           
        </div>
        <!--   Fin -->
    </div>  
</div>
