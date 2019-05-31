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
?>

<form class="form-horizontal">

    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
        <h3><b><span id="lbl_titulo"><?= Yii::t("formulario", "Check the detail of your request") ?></span></b></h3><br> 
    </div>
    <div class="col-md-6 col-xs-6 col-sm-6col-lg-6">
        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
            <span id="lbl_detalle1"><?= Yii::t("formulario", "Estás a un paso de formalizar tu inscripción, comienza hoy mismo a vivir la experiencia de una auténtica enseñanza empresarial.") ?></span>
            <span id="lbl_detalle2"><?= Yii::t("formulario", "A continuación te presentamos un resumen de lo que has elegido:") ?></span>
            <br/><br/>
        </div>
        <!-- Aqui he colocado la informacion -->
        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
            <div class="col-md-4 col-xs-4 col-sm-4 col-lg-4">
                <span id="lbl_uaca_lb"><b><?= Yii::t("formulario", "Unidad Academica: ") ?></b></span>
            </div>
            <div class="col-md-8 col-xs-8 col-sm-8 col-lg-8">
                <span id="lbl_uaca_tx"><?= "" ?></span>
            </div>
        </div>         
        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
            <div class="col-md-4 col-xs-4 col-sm-4 col-lg-4">
                <span id="lbl_moda_lb"><b><?= Yii::t("formulario", "Modalidad: ") ?></b></span>
            </div>
            <div class="col-md-8 col-xs-8 col-sm-8 col-lg-8">
                <span id="lbl_moda_tx"><?= "" ?></span>
            </div>
        </div>
        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
            <div class="col-md-4 col-xs-4 col-sm-4 col-lg-4">
                <span id="lbl_carrera_lb"><b><?= Yii::t("formulario", "Carrera/Programa: ") ?></b></span>
            </div>
            <div class="col-md-8 col-xs-8 col-sm-8 col-lg-8">
                <span id="lbl_carrera_tx"><?= "" ?></span>
            </div>
        </div>         
        <!--        <div id="id_met_ing" class="col-md-12 col-xs-12 col-sm-12 col-lg-12">-->
        <!--            <div class="col-md-4 col-xs-4 col-sm-4 col-lg-4">
                        <span id="lbl_ming_lb"><b><?php //Yii::t("formulario", "Metodo ingreso: ")  ?></b></span>
                    </div>
                    <div class="col-md-8 col-xs-8 col-sm-8 col-lg-8">-->
        <!--                <span id="lbl_ming_tx"><?php // "Curso Nivelacion"  ?></span>-->
        <!--            </div>-->
        <!--        </div>         -->
        <!--        <div id="id_mat_cur" class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                    <div class="col-md-4 col-xs-4 col-sm-4 col-lg-4">
                        <b><span id="lbl_mcur_lb"></span></b>
                    </div>
                    <div class="col-md-8 col-xs-8 col-sm-8 col-lg-8">
                        <span id="lbl_mcur_tx"></span>
                    </div>
                </div>         -->
        <!--        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                    <div class="col-md-4 col-xs-4 col-sm-4 col-lg-4">
                        <b><span id="lbl_fcur_lb"></span></b>
                    </div>
                    <div class="col-md-8 col-xs-8 col-sm-8 col-lg-8">
                        <span id="lbl_fcur_tx"></span>
                    </div>
                </div>-->
    </div>
    <div class="col-md-6 col-xs-6 col-sm-6col-lg-6">
        <!-- fin de ingreso de informacion -->
        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
            <span id="lbl_leyenda_pago_tx" ></span>
            <br/><br/>
        </div>
        <!-- item 1 -->
        <div id="id_item_1"  class="col-md-12 col-xs-12 col-sm-12 col-lg-12" style="display:none">
            <div class="col-md-4 col-xs-4 col-sm-4 col-lg-4">
                <b><span id="lbl_item_1"></span></b>
            </div>
            <div class="col-md-8 col-xs-8 col-sm-8 col-lg-8">
                $ <span id="val_item_1"></span>
            </div>
        </div>         
        <!-- item 2 -->
        <div id="id_item_2" class="col-md-12 col-xs-12 col-sm-12 col-lg-12" style="display:none">
            <div class="col-md-4 col-xs-4 col-sm-4 col-lg-4">
                <b><span id="lbl_item_2"></span></b>
            </div>
            <div class="col-md-8 col-xs-8 col-sm-8 col-lg-8">
                $ <span id="val_item_2"></span>
            </div>
        </div>      
        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
            <div class="col-md-4 col-xs-4 col-sm-4 col-lg-4">
                <span><b><?= Yii::t("formulario", "Valor total a pagar: ") ?></b></span>
            </div>
            <div class="col-md-8 col-xs-8 col-sm-8 col-lg-8">
                 <span id="lbl_valor_pagar_tx"></span><br/><br/>
                <small><b><?= Yii::t("formulario", "**Valores están en ($) USD ") ?></b></small>
            </div>         
        </div>
        <div id="id_item_3" class="col-md-12 col-xs-12 col-sm-12 col-lg-12" style="display:none">
            <div class="col-md-4 col-xs-4 col-sm-4 col-lg-4">
                <b><span id="lbl_item_3"></span></b>
            </div>
            <div class="col-md-8 col-xs-8 col-sm-8 col-lg-8">
                $ <span id="val_item_3"></span>
            </div>
        </div>  
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">             
            <div class="col-md-4 col-xs-4 col-sm-4 col-lg-4">
                <span><b><?= Yii::t("formulario", "Forma Pago: ") ?></b></span>
            </div>
            <div class="col-sm-8 col-md-8 col-xs-8 col-lg-8">
                <label> 
                    <input type="radio" name="rdo_forma_pago_dinner" id="rdo_forma_pago_dinner" value="1" checked> Dinners<br> 
                </label>
                <label> 
                    <input type="radio" name="rdo_forma_pago_otros" id="rdo_forma_pago_otros" value="2" > Stripe Payment<br>
                </label>
            </div>                             
        </div> 
    </div>
    
    
    <!--    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
            <h4><b><span id="lbl_detalle2"><?= Yii::t("formulario", "Pago:") ?></span></b></h4>
            <h4><span id="lbl_detalle2"><?= Yii::t("formulario", "Pago en línea PayPal: ") ?></span><a href="http://www.uteg.edu.ec/pagos-online/">http://www.uteg.edu.ec/pagos-online/</a></h4>        
        </div>-->
    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">         
        </br>
        </br>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">   
        <div class="col-md-2">
            <a id="paso3back" href="javascript:" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-menu-left"></span><?= Yii::t("formulario", "Back") ?> </a>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"> &nbsp;</div>
        <div class="col-md-2">
            <a id="sendInscripcionsolicitud" href="javascript:" class="btn btn-primary btn-block"> <?php echo "Pagar"; ?> </a>
        </div>
        <a id="btn_pago_i" href="javascript:" class="btn btn-primary btn-block pbpopup"></a>
    </div>
</form>