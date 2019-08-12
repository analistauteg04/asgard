<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;
use kartik\date\DatePicker;
use yii\helpers\Url;
use app\components\CFileInputAjax;
use app\widgets\PbGridView\PbGridView;
use yii\data\ArrayDataProvider;
use yii\widgets\DetailView;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use app\models\Utilities;
use app\modules\repositorio\Module as repositorio;
use app\modules\academico\Module as academico;
use app\modules\financiero\Module as financiero;
academico::registerTranslations();
financiero::registerTranslations();

?>
<div class="col-md-12">    
    <h3><span id="lbl_Personeria"><?= repositorio::t("repositorio", "Registro de inscritos a Maestrías") ?></span>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <p class="text-danger"> <?= Yii::t("formulario", "Fields with * are required") ?> </p>        
</div>
<form class="form-horizontal">
    <div class="col-md-12">    
        <h4><span id="lbl_datos_inscrito"><?= repositorio::t("repositorio", "Datos del Inscrito") ?></span> </h4>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">            
                <label for="cmb_tipo_documento" class="col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label"><?= repositorio::t("repositorio", "Tipo Documento") ?> <span class="text-danger">*</span></label>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?= Html::dropDownList("cmb_tipo_documento", 0, ['0' => Yii::t('formulario', 'Select')] + $arr_tipos_dni, ["class" => "form-control", "id" => "cmb_tipo_documento"]) ?>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_documento" class="col-sm-5 col-md-5 col-xs-5 col-lg-5 control-label" id="lbl_documento"><?= financiero::t("Pagos", "Documento") ?><span class="text-danger">*</span></label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <input type="text" class="form-control keyupmce" value="" id="txt_documento" data-type="alfa" placeholder="<?= Yii::t("formulario", "DNI Document") ?>">
                </div>
            </div>
        </div>                 
    </div> 
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                         
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_nombres1" class="col-sm-5 col-md-5 col-xs-5 col-lg-5 control-label" id="lbl_nombre1"><?= financiero::t("Pagos", "Primer Nombre") ?><span class="text-danger">*</span></label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <input type="text" class="form-control keyupmce" value="" id="txt_nombres1" data-type="alfa" placeholder="<?= Yii::t("formulario", "Primer Nombre") ?>">
                </div>
            </div>
        </div> 
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_nombres2" class="col-sm-5 col-md-5 col-xs-5 col-lg-5 control-label" id="lbl_nombre2"><?= financiero::t("Pagos", "Segundo Nombre") ?></label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <input type="text" class="form-control keyupmce" value="" id="txt_nombres2" data-type="alfa" placeholder="<?= Yii::t("formulario", "Segundo Nombre") ?>">
                </div>
            </div>
        </div> 
    </div> 
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                         
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_apellidos1" class="col-sm-5 col-md-5 col-xs-5 col-lg-5 control-label" id="lbl_apellido1"><?= financiero::t("Pagos", "Primer Apellido") ?><span class="text-danger">*</span></label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <input type="text" class="form-control keyupmce" value="" id="txt_apellidos1" data-type="alfa" placeholder="<?= Yii::t("formulario", "Primer Apellido") ?>">
                </div>
            </div>
        </div> 
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_apellidos2" class="col-sm-5 col-md-5 col-xs-5 col-lg-5 control-label" id="lbl_apellido2"><?= financiero::t("Pagos", "Segundo Apellido") ?></label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <input type="text" class="form-control keyupmce" value="" id="txt_apellidos2" data-type="alfa" placeholder="<?= Yii::t("formulario", "Segundo Apellido") ?>">
                </div>
            </div>
        </div> 
    </div>     
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">        
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6" >
            <div class="form-group">            
                <label for="cmb_pais" class="col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label"><?= repositorio::t("repositorio", "Pais") ?><span class="text-danger">*</span></label>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?= Html::dropDownList("cmb_pais", 1, ['0' => Yii::t('formulario', 'Select')]+ $arr_pais_dom, ["class" => "form-control", "id" => "cmb_pais", "disabled" => "true"]) ?>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">            
                <label for="cmb_provincia" class="col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label"><?= repositorio::t("repositorio", "Provincia") ?> <span class="text-danger">*</span></label>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?= Html::dropDownList("cmb_provincia", 0, ['0' => Yii::t('formulario', 'Select')] + $arr_prov_dom, ["class" => "form-control", "id" => "cmb_provincia"]) ?>
                </div>
            </div>
        </div>
    </div>    
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">        
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">            
                <label for="cmb_canton" class="col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label"><?= repositorio::t("repositorio", "Cantón") ?> <span class="text-danger">*</span></label>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?= Html::dropDownList("cmb_canton", 0, ['0' => Yii::t('formulario', 'Select')]+ $arr_ciu_dom, ["class" => "form-control", "id" => "cmb_canton"]) ?>
                </div>
            </div>
        </div>         
    </div> 
    
    <div class="col-md-12">    
        <h4><span id="lbl_Datos_Inscripcion"><?= repositorio::t("repositorio", "Datos de la Inscripción") ?></span> </h4>
    </div>    
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">        
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6"> 
            <div class="form-group"> 
                <label for="cmb_tipo_convenio" class="col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label"><?= repositorio::t("repositorio", "Tipo Convenio") ?> <span class="text-danger">*</span></label>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?php //Html::dropDownList("cmb_modelo_evi", 1,array_merge($arr_modelos) , ["class" => "form-control", "id" => "cmb_modelo_evi"]) ?>
                    <?=
                    Html::dropDownList("cmb_tipo_convenio", 0, ['0' => Yii::t('formulario', 'No convenio')] + $arr_convenio_empresa, ["class" => "form-control", "id" => "cmb_tipo_convenio"])
                    ?>
                </div>
            </div>   
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">            
                <label for="cmb_grupo_introductorio" class="col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label"><?= repositorio::t("repositorio", "Grupo Introductorio") ?> <span class="text-danger">*</span></label>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?= Html::dropDownList("cmb_grupo_introductorio", 0, ['0' => Yii::t('formulario', 'Select')]+$arr_grupo, ["class" => "form-control", "id" => "cmb_grupo_introductorio"]) ?>
                </div>
            </div>
        </div>
    </div> 
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                 
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">            
                <label for="cmb_cumple_requisito" class="col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label"><?= repositorio::t("repositorio", "Cumple Requisito") ?> <span class="text-danger">*</span></label>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?= Html::dropDownList("cmb_cumple_requisito", 0, ['0' => Yii::t('formulario', 'Select')]+$arr_cumple_requisito, ["class" => "form-control", "id" => "cmb_cumple_requisito"]) ?>
                </div>
            </div>
        </div>  
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="cmb_agente" class="col-sm-5 col-md-5 col-xs-5 col-lg-5 control-label" id="lbl_nombre1"><?= financiero::t("Pagos", "Agente") ?><span class="text-danger">*</span></label>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?= Html::dropDownList("cmb_agente", 0, ['0' => Yii::t('formulario', 'Select')] + $arr_agente, ["class" => "form-control", "id" => "cmb_agente"]) ?>
                </div>
            </div>
        </div> 
    </div> 
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">    
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">            
                <label for="txt_fecha_inscripcion" class="col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label"><?= repositorio::t("repositorio", "Fecha inscripción") ?> <span class="text-danger">*</span></label>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?=
                    DatePicker::widget([
                        'name' => 'txt_fecha_inscripcion',
                        'value' => '',
                        'type' => DatePicker::TYPE_INPUT,
                        'options' => ["class" => "form-control", "id" => "txt_fecha_inscripcion", "placeholder" => repositorio::t("repositorio", "Fecha inscripción")],
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => Yii::$app->params["dateByDatePicker"],
                        ]]
                    );
                    ?>
                </div>
            </div>
        </div> 
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_revision" class="col-sm-5 col-md-5 col-xs-5 col-lg-5 control-label" id="lbl_nombre1"><?= financiero::t("Pagos", "Revisión") ?></label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <input type="text" class="form-control keyupmce" value="" id="txt_revision" data-type="alfa" placeholder="<?= Yii::t("formulario", "Revisión") ?>">
                </div>
            </div>
        </div> 
    </div>
    
    <div class="col-md-12">    
        <h4><span id="lbl_Datos_Pago"><?= repositorio::t("repositorio", "Datos del Pago") ?></span> </h4>
    </div>    
    
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                    
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_pago_inscripcion" class="col-sm-5 col-md-5 col-xs-5 col-lg-5 control-label" id="lbl_nombre1"><?= financiero::t("Pagos", "Pago Inscripción") ?><span class="text-danger">*</span></label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <input type="text" class="form-control keyupmce" value="" id="txt_pago_inscripcion" data-type="alfa" placeholder="<?= Yii::t("formulario", "Pago Inscripción") ?>">
                </div>
            </div>
        </div> 
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_pago_total" class="col-sm-5 col-md-5 col-xs-5 col-lg-5 control-label" id="lbl_nombre1"><?= financiero::t("Pagos", "Pago Total") ?><span class="text-danger">*</span></label>
                <div class="col-sm-7 col-md-7 col-xs-7 col-lg-7">
                    <input type="text" class="form-control keyupmce" value="" id="txt_pago_total" data-type="alfa" placeholder="<?= Yii::t("formulario", "Pago Total") ?>">
                </div>
            </div>
        </div> 
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">   
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">            
                <label for="txt_fecha_pago" class="col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label"><?= repositorio::t("repositorio", "Fecha pago") ?> <span class="text-danger">*</span></label>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?=
                    DatePicker::widget([
                        'name' => 'txt_fecha_pago',
                        'value' => '',
                        'type' => DatePicker::TYPE_INPUT,
                        'options' => ["class" => "form-control", "id" => "txt_fecha_pago", "placeholder" => repositorio::t("repositorio", "Fecha Pago")],
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => Yii::$app->params["dateByDatePicker"],
                        ]]
                    );
                    ?>
                </div>
            </div>
        </div>        
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">            
                <label for="cmb_metodo_pago" class="col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label"><?= repositorio::t("repositorio", "Método Pago") ?> <span class="text-danger">*</span></label>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?= Html::dropDownList("cmb_metodo_pago", 0, ['0' => Yii::t('formulario', 'Select')]+ $arr_forma_pago, ["class" => "form-control", "id" => "cmb_metodo_pago"]) ?>
                </div>
            </div>
        </div>  
    </div> 
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                         
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="cmb_estado_pago" class="col-sm-5 col-md-5 col-xs-5 col-lg-5 control-label" id="lbl_nombre1"><?= financiero::t("Pagos", "Estado Pago") ?><span class="text-danger">*</span></label>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <?= Html::dropDownList("cmb_estado_pago", 0, ['0' => Yii::t('formulario', 'Select')]+$arr_estado_pago, ["class" => "form-control", "id" => "cmb_estado_pago"]) ?>
                </div>
            </div>
        </div> 
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">            
                <label for="txt_convenio_listo" class="col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label"><?= repositorio::t("repositorio", "Convenio Listo") ?> </label>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <input type="text" class="form-control keyupmce" value="" id="txt_convenio_listo" data-type="alfa" placeholder="<?= Yii::t("formulario", "Convenio Listo") ?>">
                </div>
            </div>
        </div>   
    </div> 
           
    <br/>
    <br/>
    <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'> 
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6"></div>
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class='col-md-7 col-xs-7 col-lg-7 col-sm-7'></div>
            <div class='col-md-3 col-xs-3 col-lg-3 col-sm-3'>         
                <p> <a id="btn_AgregarItem" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Add") ?></a></p>
            </div>
        </div>        
    </div> 
    <br/>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h3><span id="lbl_cargado"><?= repositorio::t("repositorio", "Inscripciones registradas") ?></span></h3>
    </div>    
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <div class="box-body table-responsive no-padding">
                <table  id="TbG_Data" class="table table-hover">
                    <thead>
                        <tr>
                            <th><?= Yii::t("formulario", "Documento") ?></th>
                            <th><?= Yii::t("formulario", "Nombre") ?></th>
                            <th><?= Yii::t("formulario", "Apellido") ?></th>
                            <th><?= Yii::t("formulario", "Provincia") ?></th>
                            <th><?= Yii::t("formulario", "Cantón") ?></th>                            
                            <th style="display:none; border:none;"></th>
                            <th><?= Yii::t("formulario", "Tipo Convenio") ?></th> 
                            <th style="display:none; border:none;"></th>
                            <th><?= Yii::t("formulario", "Grupo Introductorio") ?></th> 
                            <th><?= Yii::t("formulario", "Agente") ?></th> 
                            <th><?= Yii::t("formulario", "Fecha Inscripcion") ?></th> 
                            <th><?= Yii::t("formulario", "Estado Pago") ?></th> 
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</form>

