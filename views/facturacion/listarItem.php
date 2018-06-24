<?php

?>

<div class="col-md-12">
    <h3><span id="lbl_Personeria"><?= Yii::t("facturacion", "Item Listing") ?></span></h3>
</div>
<div>
    <form class="form-horizontal">
        <?=
        $this->render('_formBuscarItem', [
            'subcategoria' => $subcategoria,
            'item' => $item,
        ]);
        ?>
    </form>
</div>
<div>
    <?=
        $this->render('_listarItemGrid', [
        'model' => $model,        
        'url' => $url]);
    ?>
</div>