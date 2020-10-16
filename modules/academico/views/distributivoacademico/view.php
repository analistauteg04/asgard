<?php

use Yii;
use yii\helpers\Html;
use app\modules\academico\Module as academico;

?>
<div>
    <form class="form-horizontal">
        <?=
        $this->render('view-cab', [ 
            'arr_cabecera' => $arr_cabecera,                        
          ]);
        ?>
    </form>
</div>
<div>
    <?=
    $this->render('view-grid', [
        'arr_detalle' => $arr_detalle, 
        ]);
    ?>
</div>