<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\widgets\PbGridView\PbGridView;
use yii\data\ArrayDataProvider;
?>
<?= Html::hiddenInput('txth_ftem_id', 0, ['id' => 'txth_ftem_id']); ?>
<?= Html::hiddenInput('txth_errorFile', Yii::t("formulario", "The file extension is not valid or exceeds the maximum size in MB recommending him try again"), ['id' => 'txth_errorFile']); ?>

<div class="box-header with-border row">
    <div class="col-md-12"> <span class='titulo_CabeceraInfo'><?= Yii::t("formulario", "See File") ?></span></div>
</div>
<div class="col-md-12">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs tabsdatos col-md-12">
            <li class="active"><a href="#paso1" data-href="#paso1" data-toggle="tab" aria-expanded="true"><img class="" src="<?= Url::home() ?>img/users/n1.png" alt="User Image">  <?= Yii::t("formulario", "Personal") ?></a></li>
            <li><a href="#paso2" data-toggle="tab" aria-expanded="false"><img class="" src="<?= Url::home() ?>img/users/n2.png" alt="User Image">  <?= Yii::t("formulario", "Family") ?></a></li>
            <li><a href="#paso3" data-toggle="tab" aria-expanded="false"><img class="" src="<?= Url::home() ?>img/users/n3.png" alt="User Image">  <?= Yii::t("formulario", "Academic") ?></a></li>
            <li><a href="#paso4" data-toggle="tab" aria-expanded="false"><img class="" src="<?= Url::home() ?>img/users/n4.png" alt="User Image">  <?= Yii::t("formulario", "Laboral") ?></a></li>
            <li><a href="#paso5" data-toggle="tab" aria-expanded="false"><img class="" src="<?= Url::home() ?>img/users/n5.png" alt="User Image">  <?= Yii::t("formulario", "Investigation") ?></a></li>
            <li><a href="#paso6" data-toggle="tab" aria-expanded="false"><img class="" src="<?= Url::home() ?>img/users/n6.png" alt="User Image">  <?= Yii::t("formulario", "Publication") ?></a></li>            
        </ul>
        <div class="tab-content col-md-12">
            <div class="tab-pane active" id="paso1">
                <form class="form-horizontal">
                    <?=
                    $this->render('_formTab1View', [
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
                        'tipparent' => $arr_tipparent,
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
                        //Discapacidad
                        'tipo_discap' => $arr_tip_discap,
                        'tipo_discap_fam' => $arr_tip_discap_fam,
                        'tipparent_dis' => $arr_tipparent_dis,
                        'tipparent_enf' => $arr_tipparent_enf,
                        'tip_instaca_med' => $arr_tip_instaca_med,                        
                        'datos_discapacidad' => $datos_discapacidad
                    ]);
                    ?>
                </form>
            </div><!-- /.tab-pane -->
            <div class="tab-pane" id="paso2">
                <form class="form-horizontal">
                    <?=
                    $this->render('_formTab2View', [
                        'tipparent' => $arr_tipparent,
                        'per_fecha_nacimiento' => $respExpProfesor['per_fecha_nacimiento'],
                        'tipo_discap' => $arr_tip_discap,
                        'datos_familiares' => $datos_familiares,
                        'datos_familiares_inst' => $datos_familiares_inst,
                        'per_id' =>$per_id
                    ]);
                    ?>               
                </form>
            </div><!-- /.tab-pane -->            
            <div class="tab-pane" id="paso3">
                <form class="form-horizontal">
                    <?=
                    $this->render('_formTab3View', [
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
                        'datos_estudiosuperior' => $datos_estudiosuperior,
                        'datos_estudioactual' => $datos_estudioactual,
                        'datos_reconocimiento' => $datos_reconocimiento,
                        'datos_idiomas' => $datos_idiomas,
                        'datos_capacitacion' => $datos_capacitacion,
                    ]);
                    ?>              
                </form>
            </div><!-- /.tab-pane -->
            <div class="tab-pane" id="paso4">
                <form class="form-horizontal">
                    <?=
                    $this->render('_formTab4View', [
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
                        'datos_laborales' => $datos_laborales,
                        'datos_docencia' => $datos_docencia,
                    ]);
                    ?>               
                </form>
            </div><!-- /.tab-pane -->
            <div class="tab-pane" id="paso5">
                <form class="form-horizontal">
                    <?=
                    $this->render('_formTab5View', [
                        'tipo_discap' => $arr_tip_discap,
                        'tipo_discap_fam' => $arr_tip_discap_fam,
                        'tipparent_dis' => $arr_tipparent_dis,
                        'tipparent_enf' => $arr_tipparent_enf,
                        'tip_instaca_med' => $arr_tip_instaca_med,
                        'per_fecha_nacimiento' => $respExpProfesor['per_fecha_nacimiento'],
                        'datos_investigacion' => $datos_investigacion,
                    ]);
                    ?> 
                </form>
            </div><!-- /.tab-pane -->
            <div class="tab-pane" id="paso6">
                <form class="form-horizontal">
                    <?=
                    $this->render('_formTab6View', [
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
                        'datos_publicacion' => $datos_publicacion,
                        'datos_codireccion' => $datos_codireccion,
                        'datos_ponencia' => $datos_ponencia,
                    ]);
                    ?> 
                </form>
            </div><!-- /.tab-pane -->          
        </div><!-- /.tab-content -->
    </div><!-- /.nav-tabs-custom -->
</div><!-- /.col -->

