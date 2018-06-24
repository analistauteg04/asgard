<?php
use yii\helpers\Html;
use kartik\date\DatePicker;
?>
<?= Html::hiddenInput('txth_item', $ite_id, ['id' => 'txth_item']); ?>
<div class="col-md-12">
    <h3><span id="lbl_Personeria"><?= Yii::t("formulario", "Descuento por Item") ?></span></h3>
</div>
<form class="form-horizontal" enctype="multipart/form-data" id="formdescuentoitem">
    <div class="row">
        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
            <div class="form-group">
                <label for="txt_item" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label"><?= Yii::t("formulario", "Item") ?></label>
                <div class="col-sm-8 col-md-8 col-xs-8 col-lg-8">
                    <?= $item ?>
                </div>
            </div>
        </div>
        
        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
            <div class="form-group">
                <label for="txt_por_descuento" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label"><?= Yii::t("formulario", "Descuento") ?></label>
                <div class="col-sm-4 col-md-4 col-xs-4 col-lg-4">
                    <input type="text" class="form-control PBvalidation keyupmce" id="txt_por_descuento" value="" data-type="number" data-keydown="true" placeholder="<?= Yii::t("formulario", "Descuento") ?>">        
                </div>
            </div>
        </div>
        
        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
            <div class="form-group">
                <label for="txt_descripcion" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label"><?= Yii::t("formulario", "Descripción") ?></label>
                <div class="col-sm-4 col-md-4 col-xs-4 col-lg-4">
                    <input type="text" class="form-control PBvalidation keyupmce" id="txt_descripcion" value="" data-type="alfa" data-keydown="true" placeholder="<?= Yii::t("formulario", "Descripción") ?>">        
                </div>
            </div>
        </div>
        
        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 ">
            <div class="form-group">
                <label for="lbl_inicio" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label"><?= Yii::t("formulario", "Start date") ?></label>
                <div class="col-sm-4 col-md-4 col-xs-4 col-lg-4">
                    <?=
                    DatePicker::widget([
                        'name' => 'txt_fecha_ini',
                        'value' => '',
                        'type' => DatePicker::TYPE_INPUT,
                        'options' => ["class" => "form-control PBvalidation keyupmce", "id" => "txt_fecha_ini", "placeholder" => Yii::t("formulario", "Start date")],
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => Yii::$app->params["dateByDatePicker"],
                        ]]
                    );
                    ?>
                </div>
            </div>
        </div>
        
        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 ">
            <div class="form-group">
                <label for="lbl_fin" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label"><?= Yii::t("formulario", "End date") ?></label>
                <div class="col-sm-4 col-md-4 col-xs-4 col-lg-4">
                    <?=
                    DatePicker::widget([
                        'name' => 'txt_fecha_fin',
                        'value' => '',
                        'type' => DatePicker::TYPE_INPUT,
                        'options' => ["class" => "form-control PBvalidation keyupmce", "id" => "txt_fecha_fin", "placeholder" => Yii::t("formulario", "End date")],
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => Yii::$app->params["dateByDatePicker"],
                        ]]
                    );
                    ?>
                </div>
            </div>
        </div>
        
        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12"> 
            <div class="form-group">
                <div class="col-sm-5">                                                  
                </div>  
                <div class="col-sm-2">                      
                    <a id="btn_grabarDctoItem" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Send") ?></a>                                   
                </div> 
                <div class="col-sm-5">      
                    <br/>
                </div>  
            </div>    
        </div>  
    </div>
</form>

