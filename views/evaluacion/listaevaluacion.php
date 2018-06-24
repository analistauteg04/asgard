<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
use yii\data\ArrayDataProvider;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
?>
<?= Html::hiddenInput('txth_ids', '', ['id' => 'txth_ids']); ?>
<div class="col-md-12">
    <h3><span id="lbl_evaluar"><?= Yii::t("formulario", "Evaluations") ?></span></h3>
</div>
<div>
    <form class="form-horizontal">
        <?=
        $this->render('_formBuscaEvalu', [
            'profesor' => $profesor,
            'periodo' => $periodo,
            'arr_ninteres' => $arr_ninteres,
            'arr_facultad' => $arr_facultad,
            'arr_carrera' => $arr_carrera,
            'materia' => $materia,
        ]);
        ?>
    </form>
</div>
<div>
    <?=
    $this->render('_listaEvaluGrid', [
        'model' => $model,
        'profesor' => $profesor
    ]);
    ?>
</div>