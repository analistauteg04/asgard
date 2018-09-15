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
    <h3><span id="lbl_Personeria"><?= Yii::t("formulario", "Control Payments") ?></span></h3>    
</div>
<div>
    <form class="form-horizontal">
        <?=
        $this->render('_form_BuscarPagoSolicitud', [
            
        ]);
        ?>
    </form>
</div>
<div>
    <?=
        $this->render('_listarpagosolicitud_grid', [
        'model' => $model,
        'url' => $url]);
    ?>
</div>


