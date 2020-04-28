<?php

use yii\helpers\Html;
use app\modules\academico\Module as academico;
?>
<?= Html::hiddenInput('txth_ids', '', ['id' => 'txth_ids']); ?>
<div>
    <form class="form-horizontal">
        <?=
        $this->render('listar-distributivo_search', [ 
            'arr_unidad' => $mod_unidad,
            'arr_modalidad' => $mod_modalidad,
            'arr_periodo' => $mod_periodo,
            ]);
        ?>
    </form>
</div>
<div>
    <?=
    $this->render('listar_distributivo-grid', [
        'model' => $model,
        ]);
    ?>
</div>