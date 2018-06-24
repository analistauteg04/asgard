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
use kartik\file\FileInput;
use kartik\date\DatePicker;
use yii\helpers\Url;
use app\components\CFileInputAjax;
?>

<div class='row'>
    <!-- Columna principal donde estan los nombres y la fotos Autor : Omar Romero Lopez-->
    <div class='col-md-12'>
        <div class="col-xs-12 col-sm-12 col-md-12 ">
            <div class='row' id='dynamic_field'>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <!-- Espacio de relleno --></br>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_nombres_fam_ins" class="col-sm-5 control-label"><?= Yii::t("formulario", "First Names") ?></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control PBvalidation keyupmce" data-required="false" id="txt_nombres_fam_ins" data-type="alfa" data-keydown="true" placeholder="<?= Yii::t("formulario", "First Names") ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_apellidos_fam_ins" class="col-sm-5 control-label"><?= Yii::t("formulario", "Last Names") ?></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control PBvalidation keyupmce" data-required="false" id="txt_apellidos_fam_ins" data-type="alfa" data-keydown="true" placeholder="<?= Yii::t("formulario", "Last Names") ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class='col-md-12'>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cmb_parentesco_fam_ins" class="col-sm-5 control-label"><?= Yii::t("formulario", "Kinship") ?></label>
                            <div class="col-sm-7">
                                <?= Html::dropDownList("cmb_parentesco_fam_ins", 1, $tipparent, ["class" => "form-control", "id" => "cmb_parentesco_fam_ins"]) ?>
                            </div>
                        </div>
                    </div>
                      
                </div>
                <div class='col-md-12'> 
                    <div class='col-md-1'>         
                    </div>
                    <div class='col-md-2'>         
                        <p> <a id="btn_AgregarFamInsti" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Add") ?></a></p>
                    </div>
                    <div class='col-md-9'>         
                    </div>
                </div>                                             
            </div>
        </div>        	  
        <div class="col-xs-12 col-sm-2 col-md-3">
            <!-- Espacio de relleno -->
        </div>       
    </div> 
</div>

