<?php

use yii\helpers\Html;
use app\modules\repositorio\Module as repositorio;
?>
<?= Html::hiddenInput('txth_ids', '', ['id' => 'txth_ids']); ?>
<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
    <h3><span id="lbl_titulo"><?= repositorio::t("repositorio", "List Repository of Evidence") ?></span></h3>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
    <form class="form-horizontal">
        <?=
        $this->render('index-search', [
            'arr_empresa' => $arr_empresa,
            'arr_tipo_bien' => $arr_tipo_bien,            
             ]);             
        ?>
    </form>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
    <?=
    $this->render('index-grid', [
        'model' => $model,
        ]);
    ?>
</div>