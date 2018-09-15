<?php

use yii\helpers\Html;

?>
<?= Html::hiddenInput('txth_ids', '', ['id' => 'txth_ids']); ?>
<div class="col-md-12">
    <h3><span id="lbl_Personeria"><?= Yii::t("solicitud_ins", "Manage Approved Requests") ?></span></h3>
</div>
<div>
    <form class="form-horizontal">
        <?=
        $this->render('_formBuscarSolapradm', [        
        ]);
        ?>
    </form>
</div>
<div>
    <?=
        $this->render('_listarSolapradmGrid', [
        'model' => $model,        
        'url' => $url]);
    ?>
</div>