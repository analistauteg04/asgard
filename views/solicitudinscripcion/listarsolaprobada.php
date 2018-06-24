<?php

use yii\helpers\Html;

?>
<?= Html::hiddenInput('txth_ids', '', ['id' => 'txth_ids']); ?>
<div class="col-md-12">
    <h3><span id="lbl_Personeria"><?= Yii::t("solicitud_ins", "Applications approved") ?></span></h3>
</div>
<div>
    <form class="form-horizontal">
        <?=
        $this->render('_formBuscarSolApro', [
        //'arrCarreras' => $arrCarreras
        ]);
        ?>
    </form>
</div>
<div>
    <?=
        $this->render('_listarSolAproGrid', [
        'model' => $model,        
        'url' => $url]);
    ?>
</div>




