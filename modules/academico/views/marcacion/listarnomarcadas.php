<?php

use yii\helpers\Html;
?>
<?= Html::hiddenInput('txth_ids', '', ['id' => 'txth_ids']); ?>

<div>
    <form class="form-horizontal">
        <?=
        $this->render('_formnomarcadas', [
            'arr_periodo' => $arr_periodo,            
        ]);
        ?>
    </form>
</div>
<div>
    <?=
    $this->render('_listarnomarcadas-grid', [
        'model' => $model,
    ]);
    ?>
</div>