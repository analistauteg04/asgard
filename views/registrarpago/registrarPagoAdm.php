<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;
use kartik\date\DatePicker;
use yii\helpers\Url;
use app\components\CFileInputAjax;
use app\widgets\PbGridView\PbGridView;
use yii\data\ArrayDataProvider;
use yii\widgets\DetailView;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
?>
<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 ">    
    <h3><span id="lbl_Personeria"><?= Yii::t("formulario", "Payment Registration") ?></span>
</div>
<?= Html::hiddenInput('txth_ids', $opag_id, ['id' => 'txth_ids']); ?>
<?= Html::hiddenInput('txth_total', $valor_total, ['id' => 'txth_total']); ?>
<?= Html::hiddenInput('txth_saldo_pendiente', $saldo_pendiente, ['id' => 'txth_saldo_pendiente']); ?>
<?= Html::hiddenInput('txth_int', $int_id, ['id' => 'txth_int']); ?>
<?= Html::hiddenInput('txth_sins', $sins_id, ['id' => 'txth_sins']); ?>
<?= Html::hiddenInput('txth_perid', $per_id, ['id' => 'txth_perid']); ?>
<form class="form-horizontal">
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <div class="form-group">
            <label for="cmb_forma_pago" class="col-sm-2  control-label"><?= Yii::t("formulario", "Paid form") ?></label>
            <div class="col-sm-10 ">
                <?php
                $habilita = '';
                if ($saldo_pendiente <= '0') {
                    ?>
                    <?= Html::dropDownList("cmb_forma_pago", 0, $arr_forma_pago, ["class" => "form-control", "id" => "cmb_forma_pago", "disabled" => "disabled"]) ?>
                    <?php
                } else {
                    ?>
                    <?= Html::dropDownList("cmb_forma_pago", 0, $arr_forma_pago, ["class" => "form-control", "id" => "cmb_forma_pago"]) ?>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>     
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <div class="form-group">            
            <label for="txt_pago" class="col-sm-2 control-label"><?= Yii::t("formulario", "Pay Total") ?></label>
            <div class="col-sm-10 ">
                <?php
                if ($saldo_pendiente <= '0') {
                    ?>
                    <input type="text" class="form-control PBvalidation keyupmce" id="txt_pago" data-type="dinero" readonly = "readonly" data-keydown="true" placeholder="<?= Yii::t("formulario", "Pay Total") ?>">
                    <?php
                } else {
                    ?>
                    <input type="text" class="form-control PBvalidation keyupmce" id="txt_pago" data-type="dinero" data-keydown="true" placeholder="<?= Yii::t("formulario", "Pay Total") ?>">
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <div class="form-group">            
            <label for="txt_numero_transaccion" class="col-sm-2 control-label"><?= Yii::t("formulario", "Transaction Number") ?></label>
            <div class="col-sm-10 ">
                <?php
                if ($saldo_pendiente <= '0') {
                    ?>
                    <input type="text" class="form-control PBvalidation keyupmce" id="txt_numero_transaccion" data-type="number" readonly = "readonly" data-keydown="true" placeholder="<?= Yii::t("formulario", "Transaction Number") ?>">
                    <?php
                } else {
                    ?>
                    <input type="text" class="form-control PBvalidation keyupmce" id="txt_numero_transaccion" data-type="number" data-keydown="true" placeholder="<?= Yii::t("formulario", "Transaction Number") ?>">
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <div class="form-group">            
            <label for="txt_fecha_transaccion" class="col-sm-2 control-label"><?= Yii::t("formulario", "Transaction Date") ?></label>
            <div class="col-sm-10 ">
                <?php
                if ($saldo_pendiente <= '0') {
                    ?>
                      <?=
                        DatePicker::widget([
                        'name' => 'txt_fecha_transaccion',
                        'value' => '',
                        "disabled" => "disabled",
                        'type' => DatePicker::TYPE_INPUT,
                        'options' => ["class" => "form-control PBvalidation keyupmce", "id" => "txt_fecha_transaccion", "data-type" => "fecha", "data-keydown" => "true", "placeholder" => Yii::t("formulario", "Transaction Date")],
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => Yii::$app->params["dateByDatePicker"],
                        ]]
                        );
                      ?>
                    
                    <?php
                } else {
                    ?>
                    <?=
                        DatePicker::widget([
                        'name' => 'txt_fecha_transaccion',
                        'value' => '',
                        'type' => DatePicker::TYPE_INPUT,
                        'options' => ["class" => "form-control PBvalidation keyupmce", "id" => "txt_fecha_transaccion", "data-type" => "fecha", "data-keydown" => "true", "placeholder" => Yii::t("formulario", "Transaction Date")],
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => Yii::$app->params["dateByDatePicker"],
                        ]]
                        );
                      ?>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    
    <?php if ($saldo_pendiente > '0') { ?>
        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
            <div class="col-sm-2 col-md-2 col-xs-4 col-lg-2">                
                <a id="cmd_registrarPagoadm" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Send") ?> <span class=""></span></a>
            </div>
        </div>  
        <?php
    } else {
        $leyenda = '<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <div class="form-group">                        
            <div class="col-sm-10 col-md-10 col-xs-10 col-lg-10">                
             <div style = "width: 350px;" class="alert alert-info"><span style="font-weight: bold"> Nota: </span>El aspirante ha cancelado toda su inscripción.</div>          
            </div>
        </div>
    </div>';
    }
    echo $leyenda;
    ?>
</div> 
<div>
    <?=
    PbGridView::widget([
        //'dataProvider' => new yii\data\ArrayDataProvider(array()),
        'id' => 'TbgPago',
        //'showExport' => true,
        'fnExportEXCEL' => "exportExcel",
        'fnExportPDF' => "exportPdf",
        'dataProvider' => $model,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn', 'options' => ['width' => '10']],
            [
                'attribute' => 'Forma',
                'header' => Yii::t("formulario", "Paid form"),
                'value' => 'fpag_nombre',
            ],
            [
                'attribute' => 'Total',
                'header' => Yii::t("formulario", "Pay Total"),
                'value' => 'dcar_valor',
            ],
            [
                'attribute' => 'Numtrans',
                'header' => Yii::t("formulario", "Transaction Number"),
                'value' => 'icpr_num_transaccion',
            ],
                    [
                'attribute' => 'Fechatrans',
                'header' => Yii::t("formulario", "Transaction Date"),
                'value' => 'icpr_fecha_transaccion',
            ],
            [
                'attribute' => 'Revisado',
                'header' => 'Revisado',
                'value' => 'dcar_revisado',
            ],
            [
                'attribute' => 'Resultado',
                'header' => Yii::t("formulario", "Result"),
                'value' => 'dcar_resultado',
            ],
        ],
    ])
    ?>
</div>      
</form>

