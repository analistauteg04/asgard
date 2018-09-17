<?php

use yii\helpers\Html;
?>
<?= Html::hiddenInput('txth_ids', '', ['id' => 'txth_ids']); ?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h3><span id="lbl_evaluar"><?= Yii::t("crm", "Contacts") ?></span></h3>
</div>
<div>
    <form class="form-horizontal">
        <?=
        $this->render('_formBuscarMetodosIngreso', [            
            'arr_contacto' => $arr_contacto,
        ]);
        ?>
    </form>
</div>
<div>
    <?=
    $this->render('_listarMetodosIngresoGrid', [
        'model' => $model,
    ]);
    ?>
</div>
