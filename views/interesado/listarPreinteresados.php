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
        $this->render('_formBuscarPreintere');
        ?>
    </form>
</div>
<div>
    <?=
        $this->render('_listarPreintereGrid', [
            'model' => $model,
            'url' => $url]);
    ?>
</div>

