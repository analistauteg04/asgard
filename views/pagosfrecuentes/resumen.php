<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\admision\Module as admision;
use app\modules\academico\Module as academico;
use app\modules\financiero\Module as financiero;

admision::registerTranslations();
academico::registerTranslations();
financiero::registerTranslations();
?>
<?= Html::hiddenInput('txth_sbpa_id', $sbpa_id, ['id' => 'txth_sbpa_id']); ?>

<form class="form-horizontal" enctype="multipart/form-data" id="formsolicitud">
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <h3><span id="lbl_solicitud"><?= Yii::t("formulario", "Transaction Summary") ?></span></h3>
    </div> 
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <h4><b><span id="lbl_Personeria"><?= Yii::t("formulario", "Data Beneficiary") ?></span></b></h4>    
    </div>     
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_nombres" class="col-sm-4 control-label" id="lbl_nombres"><?= Yii::t("formulario", "Names") ?></label> 
                <div class="col-sm-8 ">
                    <span for="txt_nombres" class="col-sm-3 col-md-3 col-xs-3 col-lg-3 control-label" id="lbl_nombres">XXXX </span>                 
                </div>
            </div>
        </div>   

        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_apellidos" class="col-sm-4 control-label" id="lbl_apellidos"><?= Yii::t("formulario", "Last Names") ?></label> 
                <div class="col-sm-8 ">
                    <span for="txt_apellidos" class="col-sm-3 col-md-3 col-xs-3 col-lg-3 control-label" id="lbl_apellidos">XXXX </span>                 
                </div>
            </div>
        </div> 
    </div> 
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_cedula" class="col-sm-4 control-label" id="lbl_cedula"><?= Yii::t("formulario", "DNI Document") ?></label> 
                <div class="col-sm-8 ">
                    <span for="txt_cedula" class="col-sm-3 col-md-3 col-xs-3 col-lg-3 control-label" id="lbl_cedula">99999 </span>                 
                </div>
            </div>
        </div>            
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <h4><b><span id="lbl_solicitud"><?= Yii::t("formulario", "Data Invoices") ?></span></b></h4>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_nombrefactura" class="col-sm-4 control-label" id="lbl_nombrefactura"><?= Yii::t("formulario", "Names") ?></label> 
                <div class="col-sm-8 ">
                    <span for="txt_nombrefactura" class="col-sm-3 col-md-3 col-xs-3 col-lg-3 control-label" id="lbl_nombrefactura">XXXX </span>                 
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_cedula_factura" class="col-sm-4 control-label" id="lbl_cedulafactura"><?= Yii::t("formulario", "DNI Document") ?></label> 
                <div class="col-sm-8 ">
                    <span for="txt_cedula_factura" class="col-sm-3 col-md-3 col-xs-3 col-lg-3 control-label" id="lbl_cedulafactura">9999 </span>                 
                </div>
            </div>
        </div> 
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <h4><b><span id="lbl_Personeria"><?= Yii::t("formulario", "Data Payment") ?></span></b></h4>    
    </div> 
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_valor" class="col-sm-4 control-label" id="lbl_valor"><?= Yii::t("formulario", "Names") ?></label> 
                <div class="col-sm-8 ">
                    <span for="txt_valor" class="col-sm-3 col-md-3 col-xs-3 col-lg-3 control-label" id="lbl_valor">99.99 </span>                 
                </div>
            </div>
        </div>   

        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_fecha" class="col-sm-4 control-label" id="lbl_fecha"><?= Yii::t("formulario", "Date") ?></label> 
                <div class="col-sm-8 ">
                    <span for="txt_fecha" class="col-sm-3 col-md-3 col-xs-3 col-lg-3 control-label" id="lbl_fecha">YYYY-MM-DD </span>                 
                </div>
            </div>
        </div> 
    </div> 
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_estado" class="col-sm-4 control-label" id="lbl_estado"><?= Yii::t("formulario", "Status") ?></label> 
                <div class="col-sm-8 ">
                    <span for="txt_estado" class="col-sm-3 col-md-3 col-xs-3 col-lg-3 control-label" id="lbl_estado">99999 </span>                 
                </div>
            </div>
        </div>            
    </div>
</form>
