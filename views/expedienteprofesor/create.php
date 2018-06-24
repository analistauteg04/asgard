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

use yii\helpers\Url;
use yii\helpers\Html;

?>
<?= Html::hiddenInput('txth_ftem_id', 0, ['id' => 'txth_ftem_id']); ?>
<?= Html::hiddenInput('txth_errorFile', Yii::t("formulario", "The file extension is not valid or exceeds the maximum size in MB recommending him try again"), ['id' => 'txth_errorFile']); ?>

<div class="box-header with-border row">
    <div class="col-md-12"> <span class='titulo_CabeceraInfo'><?= Yii::t("formulario", "Create File") ?></span></div>
</div>
<div class="col-md-12">
    <p class="text-danger"> <?= Yii::t("formulario", "Fields with * are required") ?> </p>
</div>
<div class="col-md-12">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs tabsdatos col-md-12">
            <li class="disabled"><a href="#paso1" data-href="#paso1" data-toggle="tab" aria-expanded="true"><img class="" src="<?= Url::home() ?>img/users/n1.png" alt="User Image">  <?= Yii::t("formulario", "Personal") ?></a></li>
            <li class="disabled"><a data-href="#paso2" data-toggle="none" aria-expanded="false"><img class="" src="<?= Url::home() ?>img/users/n2.png" alt="User Image">  <?= Yii::t("formulario", "Family") ?></a></li>
            <li class="disabled"><a data-href="#paso3" data-toggle="none" aria-expanded="false"><img class="" src="<?= Url::home() ?>img/users/n3.png" alt="User Image">  <?= Yii::t("formulario", "Academic") ?></a></li>
            <li class="disabled"><a data-href="#paso4" data-toggle="none" aria-expanded="false"><img class="" src="<?= Url::home() ?>img/users/n4.png" alt="User Image">  <?= Yii::t("formulario", "Laboral") ?></a></li>
            <li class="disabled"><a data-href="#paso5" data-toggle="none" aria-expanded="false"><img class="" src="<?= Url::home() ?>img/users/n5.png" alt="User Image">  <?= Yii::t("formulario", "Investigation") ?></a></li>
            <li class="disabled"><a data-href="#paso6" data-toggle="none" aria-expanded="false"><img class="" src="<?= Url::home() ?>img/users/n6.png" alt="User Image">  <?= Yii::t("formulario", "Publication") ?></a></li>            
        </ul>
        <div class="tab-content col-md-12">
            <?php if ($tab==1) { 
                if (empty($respExpProfesor['per_nacionalidad'])) {
                        $respExpProfesor['per_nacionalidad'] = $nacionalidad;
                    } ?>
            <div class="tab-pane active" id="paso1">
            <?php } else { ?>
            <div class="tab-pane" id="paso1">    
            <?php } ?>
                <form class="form-horizontal">
                    <?=
                    
                    $this->render('_formTab1', [
                        'paises_nac' => $arr_pais_nac,
                        'provincias_nac' => $arr_prov_nac,
                        'cantones_nac' => $arr_ciu_nac,
                        'tipos_dni' => $tipo_dni,
                        'genero' => $genero,
                        'etnica' => $arr_etnia,
                        'tipos_sangre' => $tipos_sangre,
                        'eciv_id' => $respExpProfesor['eciv_id'],
                        'estado_civil' => $arr_civil,
                        'per_pri_nombre' => $respExpProfesor['per_pri_nombre'],
                        'per_seg_nombre' => $respExpProfesor['per_seg_nombre'],
                        'per_pri_apellido' => $respExpProfesor['per_pri_apellido'],
                        'per_seg_apellido' => $respExpProfesor['per_seg_apellido'],
                        'per_cedula' => $respExpProfesor['per_cedula'],
                        'per_genero' => $respExpProfesor['per_genero'],
                        'per_fecha_nacimiento' => $respExpProfesor['per_fecha_nacimiento'],
                        'etn_id' => $respExpProfesor['etn_id'],
                        'pai_id_nacimiento' => $respExpProfesor['pai_id_nacimiento'],
                        'pro_id_nacimiento' => $respExpProfesor['pro_id_nacimiento'],
                        'can_id_nacimiento' => $respExpProfesor['can_id_nacimiento'],
                        'eciv_descripcion' => substr(strtoupper($respExpProfesor['eciv_descripcion']), 0, 3),
                        'per_correo' => $respExpProfesor['per_correo'],
                        'per_celular' => $respExpProfesor['per_celular'],
                        'tsan_id' => $respExpProfesor['tsan_id'],
                        'tipparent' => $arr_tipparent_todos,
                        'per_nacionalidad' => $respExpProfesor['per_nacionalidad'],
                        'area' => $area['name'],
                        'per_pasaporte' => $respExpProfesor['per_pasaporte'],
                        'paises_dom' => $arr_pais_dom,
                        'provincias_dom' => $arr_prov_dom,
                        'cantones_dom' => $arr_ciu_dom,
                        'pai_id_domicilio' => $respExpProfesor['pai_id_domicilio'],
                        'pro_id_domicilio' => $respExpProfesor['pro_id_domicilio'],
                        'can_id_domicilio' => $respExpProfesor['can_id_domicilio'],
                        'per_domicilio_telefono' => $respExpProfesor['per_domicilio_telefono'],
                        'sector' => $respExpProfesor['sector'],
                        'per_domicilio_cpri' => $respExpProfesor['per_domicilio_cpri'],
                        'secundaria' => $respExpProfesor['secundaria'],
                        'per_domicilio_num' => $respExpProfesor['per_domicilio_num'],
                        'per_domicilio_ref' => $respExpProfesor['per_domicilio_ref'],
                        'area_dom' => $area_dom['name'],
                        'paises_nac' => $arr_pais_nac,
                        'pai_id_nacimiento' => $respExpProfesor['pai_id_nacimiento'],
                        'per_corInstitucional' => $respPerCorInstitucional['pcin_correo'],
                        'cgen_nombre' => $respContGeneral['nombre'],
                        'cgen_apellido' => $respContGeneral['apellido'],
                        'cgen_celular' => $respContGeneral['celular'],
                        'tpar_id' => $respContGeneral['parentesco'],
                        'cgen_telefono' => $respContGeneral['telefono'],
                        'cgen_direccion' => $respContGeneral['direccion'],
                        'per_foto' => $respExpProfesor['per_foto'],
                        'otraetnia' => $otraetnia['oetn_nombre'],
                        'edad' => $edad,                        
                        //discapacidad del profesor.
                        'tipo_discap' => $arr_tip_discap,
                        'tipo_discap_fam' => $arr_tip_discap_fam,
                        'tipparent_dis' => $arr_tipparent_dis,
                        'tipparent_enf' => $arr_tipparent_enf,
                        'tip_instaca_med' => $arr_tip_instaca_med,                        
                        'per_id' =>$per_id,
                        'resp_discapacidad' => $resp_discapacidad,      
                    ]);
                    ?>
                </form>
            </div><!-- /.tab-pane -->
            <?php if ($tab==2) { ?>
            <div class="tab-pane active" id="paso2">
            <?php } else { ?>
            <div class="tab-pane" id="paso2">  
            <?php } ?>            
                <form class="form-horizontal">
                    <?=
                    $this->render('_formTab2', [
                        'tipparent' => $arr_tipparent,
                        'arr_tipparent_todos' => $arr_tipparent_todos,
                        'per_fecha_nacimiento' => $respExpProfesor['per_fecha_nacimiento'],
                        'tipo_discap' => $arr_tip_discap,
                        'model' => $model,
                        'per_id' =>$per_id,   
                   
                    ]);
                    ?>               
                </form>
            </div><!-- /.tab-pane --> 
            <?php if ($tab==3) { ?>
            <div class="tab-pane fade in active" id="paso3">
            <?php } else { ?>
            <div class="tab-pane" id="paso3"> 
            <?php } ?>              
                <form class="form-horizontal">
                    <?=
                    $this->render('_formTab3', [
                        'paises_nac' => $arr_pais_nac,
                        'provincias_nac' => $arr_prov_nac,
                        'cantones_nac' => $arr_ciu_nac,
                        'paises_ter' => $arr_pais_ter,
                        'provincias_ter' => $arr_prov_ter,
                        'cantones_ter' => $arr_ciu_ter,
                        'paises_cuat' => $arr_pais_cuat,
                        'provincias_cuat' => $arr_prov_cuat,
                        'cantones_cuat' => $arr_ciu_cuat,
                        'tipos_institucion' => $tipos_institucion,
                        'pai_id_super' => $respExpProfesor['pai_id_nacimiento'],
                        'pro_id_super' => $respExpProfesor['pro_id_nacimiento'],
                        'can_id_super' => $respExpProfesor['can_id_nacimiento'],
                        /*                         * */
                        'tip_instaca_med' => $arr_tip_instaca_med,
                        'tip_instaca_ter' => $arr_tip_instaca_ter,
                        'tip_instaca_cuat' => $arr_tip_instaca_cuat,
                        'paises_nac' => $arr_pais_nac,
                        'provincias_nac' => $arr_prov_nac,
                        'cantones_nac' => $arr_ciu_nac,
                        'provincias_dom' => $arr_prov_nac,
                        'cantones_dom' => $arr_ciu_nac,
                        'per_fecha_nacimiento' => $respExpProfesor['per_fecha_nacimiento'],
                        'arr_lenguaje' => $arr_lenguaje,
                        'arr_instituto' => $arr_instituto,
                        'arr_nivinstruccion' => $arr_nivinstruccion,
                        'arr_tipodiploma' => $arr_tipodiploma,
                        'arr_modalidad' => $arr_modalidad,
                        'arr_tipcapacitacion' => $arr_tipcapacitacion,      
                        'arr_conocimiento' => $arr_conocimiento,
                        'arr_subarea' => $arr_subarea,                        
                    ]);
                    ?>              
                </form>
            </div><!-- /.tab-pane -->
            <?php if ($tab==4) { ?>
            <div class="tab-pane active" id="paso4">
            <?php } else { ?>
            <div class="tab-pane" id="paso4"> 
            <?php } ?>               
                <form class="form-horizontal">
                    <?=
                    $this->render('_formTab4', [
                        'paises_nac' => $arr_pais_nac,
                        'provincias_nac' => $arr_prov_nac,
                        'cantones_nac' => $arr_ciu_nac,
                        'pai_id_expl' => $respExpProfesor['pai_id_nacimiento'],
                        'pro_id_expl' => $respExpProfesor['pro_id_nacimiento'],
                        'can_id_expl' => $respExpProfesor['can_id_nacimiento'],
                        'ninstruc_mad' => $arr_ninstruc_mad,
                        'ninstruc_pad' => $arr_ninstruc_pad,
                        'tipparent_dis' => $arr_tipparent_dis,
                        'per_fecha_nacimiento' => $respExpProfesor['per_fecha_nacimiento'],
                        'per_genero' => $respExpProfesor['per_genero'],
                        'genero' => $genero,
                        'tipparent_dis' => $arr_tipparent_dis,
                        'tipparent_enf' => $arr_tipparent_enf,
                        'tip_instaca_med' => $arr_tip_instaca_med,
                        'arr_conocimiento' => $arr_conocimiento,
                        'arr_instituto' => $arr_instituto,
                        'arr_tiempodedica' => $arr_tiempodedica,
                        'arr_tiprelacion' =>$arr_tiprelacion,    
                        'arr_subarea' => $arr_subarea,                         
                    ]);
                    ?>               
                </form>
            </div><!-- /.tab-pane -->
            <?php if ($tab==5) { ?>
            <div class="tab-pane active" id="paso5">
            <?php } else { ?>
            <div class="tab-pane" id="paso5">
            <?php } ?>               
                <form class="form-horizontal">
                    <?=
                    $this->render('_formTab5', [
                        'tipo_discap' => $arr_tip_discap,
                        'tipo_discap_fam' => $arr_tip_discap_fam,
                        'tipparent_dis' => $arr_tipparent_dis,
                        'tipparent_enf' => $arr_tipparent_enf,
                        'tip_instaca_med' => $arr_tip_instaca_med,
                        'per_fecha_nacimiento' => $respExpProfesor['per_fecha_nacimiento'],     
                        'arr_rolproyecto' => $arr_rolproyecto,
                    ]);
                    ?> 
                </form>
            </div><!-- /.tab-pane -->
            <?php if ($tab==6) { ?>
            <div class="tab-pane active" id="paso6">
            <?php } else { ?>
            <div class="tab-pane" id="paso6">
            <?php } ?>             
                <form class="form-horizontal">
                    <?=
                    $this->render('_formTab6', [
                        'tipo_discap' => $arr_tip_discap,
                        'tipo_discap_fam' => $arr_tip_discap_fam,
                        'tipparent_dis' => $arr_tipparent_dis,
                        'tipparent_enf' => $arr_tipparent_enf,
                        'tip_instaca_med' => $arr_tip_instaca_med,
                        'per_fecha_nacimiento' => $respExpProfesor['per_fecha_nacimiento'],
                        'paises_nac' => $arr_pais_nac,
                        'pai_id_publica' => $respExpProfesor['pai_id_nacimiento'],
                        'pro_id_publica' => $respExpProfesor['pro_id_nacimiento'],
                        'can_id_publica' => $respExpProfesor['can_id_nacimiento'],
                        'pai_id_evento' => $respExpProfesor['pai_id_nacimiento'],
                        'arr_instituto' => $arr_instituto,
                        'arr_publica' => $arr_publica,
                        'arr_tipopublica' => $arr_tipopublica,
                        'arr_coodireccion' => $arr_coodireccion,   
                        'arr_conocimiento' => $arr_conocimiento,
                        'arr_tipo_participacion' => $arr_tipo_participacion,
                    ]);
                    ?> 
                </form>
            </div><!-- /.tab-pane -->            
        </div><!-- /.tab-content -->
    </div><!-- /.nav-tabs-custom -->
</div><!-- /.col -->
<?php 
    $this->registerJs("loadSessionFamiliares('". json_encode($resp_familiares) ."')", \yii\web\View::POS_END);
    $this->registerJs("loadSessionFamiliaresInst('". json_encode($resp_familiaresInst) ."')", \yii\web\View::POS_END);
    $this->registerJs("loadSessionEstSuperior('". json_encode($resp_estsuperior) ."')", \yii\web\View::POS_END);
    $this->registerJs("loadSessionEstActual('". json_encode($resp_estactual) ."')", \yii\web\View::POS_END);
    $this->registerJs("loadSessionReconocimiento('". json_encode($resp_reconocimiento) ."')", \yii\web\View::POS_END);
    $this->registerJs("loadSessionIdiomas('". json_encode($resp_idiomas) ."')", \yii\web\View::POS_END);
    $this->registerJs("loadSessionCapacitacion('". json_encode($resp_capacitacion) ."')", \yii\web\View::POS_END);
    $this->registerJs("loadSessionExpLaboral('". json_encode($resp_laboral) ."')", \yii\web\View::POS_END);    
    $this->registerJs("loadSessionExpDocencia('". json_encode($resp_docencia) ."')", \yii\web\View::POS_END);        
    $this->registerJs("loadSessionInvestigacion('". json_encode($resp_investigacion) ."')", \yii\web\View::POS_END); 
    $this->registerJs("loadSessionPublicacion('". json_encode($resp_publicacion) ."')", \yii\web\View::POS_END); 
    $this->registerJs("loadSessionCodireccion('". json_encode($resp_codireccion) ."')", \yii\web\View::POS_END); 
    $this->registerJs("loadSessionPonencia('". json_encode($resp_ponencia) ."')", \yii\web\View::POS_END);     
?>
 