<?php
use yii\helpers\Html;
?>

<?= Html::hiddenInput('txth_ids', '', ['id' => 'txth_ids']); ?>
<div class="col-md-12">
    <h3><span id="lbl_Personeria"><?= Yii::t("interesado", "Pre Interested") ?></span></h3>
</div>

<div>
    <form class="form-horizontal">
        <?=
        $this->render('_form_Buscarpreinteresado');
        ?>
    </form>
</div>
<div>
    <?=
        $this->render('_listarpreinteresado_grid', [
            'model' => $model,
            'url' => $url]);
    ?>
</div>

