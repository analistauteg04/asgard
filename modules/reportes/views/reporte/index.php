<?php

use yii\helpers\Html;
?>
<?= Html::hiddenInput('txth_ids', '', ['id' => 'txth_ids']); ?>


<div>
    <?=
    $this->render('index-grid', [
        'model' => $model,
    ]);
    ?>
</div>