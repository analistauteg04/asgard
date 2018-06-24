<?php

use yii\helpers\Html;
?>

<?= Html::hiddenInput('txth_ids', '', ['id' => 'txth_ids']); ?>

<div class="col-md-12">
    <h3><span id="lbl_Personeria"><?= Yii::t("formulario", "Executive Assignment") ?></span></h3>
</div>

<div>
    <form class="form-horizontal">
        <?=
        $this->render('_formBuscaAsignacion', [
        'arrEjecutivos' => $arrEjecutivos,
        'arrEstados' => $arrEstados]);
        ?>
    </form>
</div>
<div>
    <?=
        $this->render('_listaAsignacionGrid', [
        'model' => $model,
        'url' => $url]);
    ?>
</div>