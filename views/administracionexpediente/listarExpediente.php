<?php

use yii\helpers\Html;

?>
<div class="col-md-12">
    <h3><span id="lbl_Personeria"><?= Yii::t("formulario", "Registered Records") ?></span></h3></br>
</div>
<div>
    <form class="form-horizontal">
        <?=
        $this->render('_formBuscarExpedient', [  
            'estado' => $arr_estado,
        ]);
        ?>
    </form>
</div>
<div>
    <?=
        $this->render('_listarExpedientGrid', [
        'model' => $model,        
        'url' => $url]);
    ?>
</div>




