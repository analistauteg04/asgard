<?php

use yii\helpers\Html;
use app\modules\academico\Module as academico;
?>
<div>
    <form class="form-horizontal">
        <?=
        $this->render('index-search', [ 
            'unidad' => $unidad,
            'modalidad' => $modalidad,
            'periodo' => $periodo,
            'materia' => $materia,
            'jornada' => $jornada,
            'horario' => $horario,
            ]);
        ?>
    </form>
</div>
<div>
    <?=
    $this->render('index-grid', [
        'model' => $model,
        ]);
    ?>
</div>