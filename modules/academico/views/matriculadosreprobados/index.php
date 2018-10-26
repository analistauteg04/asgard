<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\components\CFileInputAjax;
use yii\web\JsExpression;
use yii\jui\AutoComplete;
use yii\widgets\DetailView;
use yii\data\ArrayDataProvider;
use kartik\date\DatePicker;
use app\widgets\PbSearchBox\PbSearchBox;
use app\modules\academico\Module as academico;
?>
<form class="form-horizontal" enctype="multipart/form-data" id="formsolicitud">
<div class="col-md-12">
    <h3><span id="lbl_index"><?= academico::t("Academico", "Failed Registrations") ?></span></h3>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
        <!-- Espacio de relleno -->
        </br>
    </div>
    <div class="table table-bordered">
        <div class="panel-body">
            <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12 ">               
                <div class="form-group">
                    <h4><span id="lbl_resulevalua"><?= academico::t("Academico", "Admitted Data") ?></span></h4>                                  
                </div>
               <div class="row">
                    <div class="col-md-6">
                        <?=
                        PbSearchBox::widget([
                            'boxId' => 'boxgrid',
                            'type' => 'searchBox',
                            'placeHolder' => Yii::t("accion", "Search"),
                            'controller' => '',
                            'callbackListSource' => 'searchAdmitido',
                            'callbackListSourceParams' => ["'boxgrid'", "'TbG_Admitido'"],
                        ]);
                        ?>
                    </div>
                </div>
                <br />              
                 <?=
                $this->render('index-grid', ['model' => $admitido]);
                ?> 
            </div> 
        </div>
    </div>
</form>