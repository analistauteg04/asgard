<?php
use yii\helpers\Html;
?>

<form class="form-horizontal" enctype="multipart/form-data" >                
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <div class="form-group">
            <label for="txt_subcategoria" class="col-sm-4 control-label" id="lbl_periodo"><?= Yii::t("facturacion", "Subcategory") ?></label>
            <div class="col-sm-5">
                <?= Html::dropDownList("cmb_subcategoria", 0, $subcategoria, ["class" => "form-control", "id" => "cmb_subcategoria"]) ?>
            </div>
        </div>
    </div>  
    
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <div class="form-group">
            <label for="txt_item" class="col-sm-4 control-label" id="lbl_periodo"><?= Yii::t("facturacion", "Item") ?></label>
            <div class="col-sm-5">
                <?= Html::dropDownList("cmb_item", 0, $item, ["class" => "form-control", "id" => "cmb_item"]) ?>
            </div>
        </div>
    </div>  
                
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12"> 
        <div class="form-group">
            <div class="col-sm-5">                                                  
            </div>  
            <div class="col-sm-2">                      
                <a id="btn_buscarItem" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Search") ?></a>                                   
            </div> 
            <div class="col-sm-5">      
                <br/>
            </div>  
        </div>    
    </div>  
    
</form>

