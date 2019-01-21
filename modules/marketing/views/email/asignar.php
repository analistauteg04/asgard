<?php

use yii\helpers\Html;
use app\modules\marketing\Module as marketing;
?>
<?= Html::hiddenInput('txth_ids', base64_encode($arr_lista['lis_id']), ['id' => 'txth_ids']); ?>
<div class="col-md-12">
    <h3><span id="lbl_Personeria"><?= marketing::t("marketing", "Asignación de Subscriptores") ?></span></h3>
</div>
<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12 ">
    <div class="col-md-7 col-sm-7 col-xs-7 col-lg-7">
        <div class="form-group">
            <h4><span id="lbl_general"><?= Yii::t("formulario", "Datos de la Lista") ?></span></h4> 
        </div>
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 col-lg-12'>
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_nombre" class="col-sm-3 col-md-3 col-xs-3 col-lg-3 control-label" id="lbl_nombre"><?= Yii::t("formulario", "Name") ?></label>
                <span for="txt_nombre" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label" id="lbl_nombre"><?= $arr_lista['lis_nombre'] ?> </span> 
            </div>
        </div> 
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <div class="form-group">
                <label for="txt_no_subs" class="col-sm-3 col-md-3 col-xs-3 col-lg-3 control-label" id="txt_no_subs"><?= Yii::t("formulario", "No. Subscr..") ?></label>
                <span for="txt_no_subs" class="col-sm-4 col-md-4 col-xs-4 col-lg-4 control-label" id="txt_no_subs"><?= $arr_lista['num_suscr'] ?> </span> 
            </div>
        </div> 
    </div>
</div>   
<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12 ">
    <br/>
</div>    
<div>    
    <?=
    $this->render('asignar-search', [
        'arr_estado' => $arr_estado,
    ]);
    ?>    
</div>
<div>    
    <?=
    $this->render('asignar_grid', [
        'model' => $model,
    ]);
    ?>    
</div>
