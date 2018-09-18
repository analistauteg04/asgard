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
<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
    <h3><span id="lbl_Personeria"><?= Yii::t("Solicitudes", "Request by Interested") ?></span></h3>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
    <form class="form-horizontal">
        <?=
        $this->render('_formBuscarSolxinteresado', [
        'arrCarreras' => $arrCarreras,
        'arrEstados' => $arrEstados]);
        ?>
    </form>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
    <?=
        $this->render('_listarSolxinteresadoGrid', [
        'model' => $model,
        'url' => $url]);
    ?>
</div>


