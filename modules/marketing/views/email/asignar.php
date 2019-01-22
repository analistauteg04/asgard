<?php

use yii\helpers\Html;
use app\modules\marketing\Module as marketing;
?>
<?= Html::hiddenInput('txth_ids', base64_encode($arr_lista['lis_id']), ['id' => 'txth_ids']); ?>
<div class="col-md-12">
    <h3><span id="lbl_Personeria"><?= marketing::t("marketing", "Asignación de Subscriptores") ?></span></h3>
</div>
<div class="clear">
    <br/><br/>
</div>    
<div>    
    <form class="form-horizontal">
        <?=
        $this->render('asignar-search', [
            'arr_estado' => $arr_estado,
            'arr_lista' =>$arr_lista,
        ]);
        ?>    
    </form>
</div>
<div>    
    <?=
    $this->render('asignar_grid', [
        'model' => $model,
    ]);
    ?>    
</div>
