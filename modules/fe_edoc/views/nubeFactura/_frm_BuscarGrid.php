<?php
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
?>
<div class="col-lg-4 form-group">
    <input type="text" class="form-control" value="" id="txt_buscarData" placeholder="<?= Yii::t("solicitud_ins", "Search by Dni or Names") ?>">
    <?php
    /*$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
        'name' => 'txt_PER_CEDULA',
        'id' => 'txt_PER_CEDULA',
        'source' => "js: function(request, response){ 
                  autocompletarBuscarPersona(request, response,'txt_PER_CEDULA','COD-NOM');
                }",
        'options' => array(
            'minLength' => '2',
            'showAnim' => 'fold',
            'select' => "js:function(event, ui) {
                    //actualizaBuscarPersona(ui.item.PER_ID);     
                }"
        ),
        'htmlOptions' => array(
            'class' => 'form-control',
            "data-type" => "number",
            'size'=>35, 
            //'onKeyup' => "verificarTextCedula(isEnter(event),'txt_PER_CEDULA')",
            'placeholder' => Yii::t('COMPANIA', 'Social reason o Ruc'),
            //'onkeydown' => "nextControl(isEnter(event),'txt_nombre_medico_aten')",
            //'onkeydown' => "buscarCodigo(isEnter(event),'txt_cod_paciente','COD-ID')",
            //'onkeydown' => "verificarTextCedula(isEnter(event),'txt_PER_CEDULA')",
            //'value' => 'search',
        ),
    ));*/
    ?>
</div>
<div class="col-lg-2 form-group">
    <?php
    echo Html::dropDownList(
            'cmb_tipoApr', '0'
            , array('0' => Yii::t('COMPANIA', 'All')) + $tipoApr
            , array('class' => 'form-control')
    );
    ?> 
</div>
<div class="col-lg-2 form-group">
    <?=
    DatePicker::widget([
        'name' => 'dtp_fec_ini',
        'value' => '',
        'type' => DatePicker::TYPE_INPUT,
        'options' => ["class" => "form-control", "id" => "dtp_fec_ini", "placeholder" => Yii::t("formulario", "Start date")],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => Yii::$app->params["dateByDatePicker"],
        ]
    ]);
    ?>
</div>
<div class="col-lg-2 form-group">
    <?=
    DatePicker::widget([
        'name' => 'dtp_fec_fin',
        'value' => '',
        'type' => DatePicker::TYPE_INPUT,
        'options' => ["class" => "form-control", "id" => "dtp_fec_fin", "placeholder" => Yii::t("formulario", "End date")],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => Yii::$app->params["dateByDatePicker"],
        ]
    ]);
    ?>
</div>
<div class="col-lg-2 form-group">
    <?php echo Html::button(Yii::t('CONTROL_ACCIONES', 'Search'), array('id' => 'btn_buscar', 'name' => 'btn_buscar', 'class' => 'btn btn-success', 'onclick' => 'buscarDataIndex("","")')); ?>
</div>
<div class="col-lg-12 form-group">
    <?php
    if (Yii::$app->session->get('RolNombre', FALSE) == 'ADMIN') { //CONTROLA POR ROL ADMIN
        echo Html::button(Yii::t('CONTROL_ACCIONES', 'To correct'), array('id' => 'btn_corregir', 'name' => 'btn_corregir', 'class' => 'btn btn-danger', 'onclick' => 'fun_EnviarCorreccion()'));
        echo Html::button(Yii::t('CONTROL_ACCIONES', 'Cancel'), array('id' => 'btn_cancel', 'name' => 'btn_cancel', 'class' => 'btn btn-danger', 'onclick' => 'fun_EnviarAnular()'));
    }
    ?>
    <?php echo Html::a(Yii::t('CONTROL_ACCIONES', 'Edit mail'), array('NubeFactura/updatemail'), array('id' => 'btn_Update', 'name' => 'btn_Update', 'title' => Yii::t('CONTROL_ACCIONES', 'Edit mail'), 'class' => 'btn btn-primary', 'onclick' => 'fun_UpdateMail()')); ?>
    <?php echo Html::button(Yii::t('CONTROL_ACCIONES', 'Forward mail'), array('id' => 'btn_reenviar', 'name' => 'btn_reenviar', 'class' => 'btn btn-primary', 'onclick' => 'fun_EnviarCorreo()')); ?> 
</div>