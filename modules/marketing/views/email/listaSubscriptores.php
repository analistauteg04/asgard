<?php
use yii\helpers\Html;

use app\modules\marketing\Module as marketing;

?>
<?= Html::hiddenInput('txth_ids', '', ['id' => 'txth_ids']); ?>
<div class="col-md-12">
    <h3><span id="lbl_Personeria"><?= marketing::t("marketing", "Add subscribers to the list") ?></span></h3>
</div>
