<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>
<?= Html::hiddenInput('txth_twin_id', 0, ['id' => 'txth_twin_id']); ?>
<?= Html::hiddenInput('txth_ftem_id', 0, ['id' => 'txth_ftem_id']); ?>
<div class="col-md-12  col-xs-12 col-sm-12 col-lg-12">
    <form class="form-horizontal">
        <?=
        $this->render('_form_data', [
            "tipos_dni" => $tipos_dni,
            "tipos_dni2" => $tipos_dni2,
            "txth_extranjero" => $txth_extranjero,
            "arr_pais_dom" => $arr_pais_dom,
            "arr_prov_dom" => $arr_prov_dom,
            "arr_ciu_dom" => $arr_ciu_dom,
            "arr_ninteres" => $arr_ninteres,
            "arr_item"=>$arr_item,
            "arr_medio" => $arr_medio,
            "txt_precio" => $txt_precio,
            "arr_modalidad" => $arr_modalidad,
            "arr_conuteg" => $arr_conuteg,
            "arr_carrerra1" => $arr_carrerra1,
            "arr_metodos" => $arr_metodos,
        ]);
        ?>
    </form>
</div>
<div class="col-md-12  col-xs-12 col-sm-12 col-lg-12">
    <form class="form-horizontal">
        <?=
        $this->render('_form_pago', [
            "tipos_dni" => $tipos_dni,
            "tipos_dni2" => $tipos_dni2,
            "txth_extranjero" => $txth_extranjero,
            "arr_pais_dom" => $arr_pais_dom,
            "arr_prov_dom" => $arr_prov_dom,
            "arr_ciu_dom" => $arr_ciu_dom,
            "arr_ninteres" => $arr_ninteres,
            "arr_medio" => $arr_medio,
            "arr_modalidad" => $arr_modalidad,
            "arr_conuteg" => $arr_conuteg,
            "arr_carrerra1" => $arr_carrerra1,
            "arr_metodos" => $arr_metodos,
        ]);
        ?>
    </form>
    <div class="col-md-12  col-xs-12 col-sm-12 col-lg-12">
        <div class="col-md-10  col-xs-10 col-sm-10 col-lg-10"></div>
        <div class="col-md-2  col-xs-2 col-sm-2 col-lg-2">
            <a id="btnpagofrecuentes" href="javascript:" class="btn btn-primary btn-block"><?php echo "Guardar"; ?> </a>
        </div>
    </div>
</div>