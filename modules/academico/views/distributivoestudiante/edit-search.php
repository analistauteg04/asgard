<?php

use yii\helpers\Html;
use app\widgets\PbSearchBox\PbSearchBox;
use kartik\date\DatePicker;
use app\modules\academico\Module as academico;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <div class="form-group">
            <label for="txt_buscarData" class="col-sm-2 col-md-2 col-xs-2 col-lg-2 control-label"><?= Yii::t("formulario", "Search") ?></label>
            <div class="col-sm-8 col-md-8 col-xs-8 col-lg-8 ">
                <?= 
                    PbSearchBox::widget([
                        "boxId" => "txt_buscarData",
                        "type" => "searchBoxList",
                        "placeHolder" => Yii::t("solicitud_ins", "Search by Dni or Names"),
                        "callbackListSource" => "getListStudent",
                        "callbackListSourceParams" => [],
                        "callbackListSelected" => "showDataStudent",
                        "htmlOptions" => ['style' => 'width: 100%']
                    ]);
                ?>
                <?php /*<input type="text" class="form-control" value="" id="txt_buscarData" placeholder="<?= Yii::t("solicitud_ins", "Search by Dni or Names") ?>"> */?>
            </div>
        </div>
    </div>    
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">            
            <label for="txt_nombre" class="col-sm-2 col-sm-2 col-lg-2 col-md-2 col-xs-2 control-label"><?= Yii::t("formulario", "First Names") ?></label>
            <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">
                <?= Html::input("text", "txt_nombre", '' , ["class" => "form-control", "id" => "txt_nombre", "disabled" => "disabled"]) ?>
            </div>
            <label for="txt_apellidos" class="col-sm-2 col-sm-2 col-lg-2 col-md-2 col-xs-2 control-label"><?= Yii::t("formulario", "Last Names") ?></label>
            <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">
                <?= Html::input("text", "txt_apellidos", '', ["class" => "form-control", "id" => "txt_apellidos", "disabled" => "disabled"]) ?>
            </div>      
        </div>
    </div>    
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">            
            <label for="txt_carrera" class="col-sm-2 col-sm-2 col-lg-2 col-md-2 col-xs-2 control-label"><?= academico::t("matriculacion", "Career") ?></label>
            <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">
                <?= Html::input("text", "txt_carrera", '', ["class" => "form-control", "id" => "txt_carrera", "disabled" => "disabled"]) ?>
            </div>       
            <label for="txt_matricula" class="col-sm-2 col-sm-2 col-lg-2 col-md-2 col-xs-2 control-label"><?= academico::t("matriculacion", "Registration Number") ?></label>
            <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">
                <?= Html::input("text", "txt_matricula", '', ["class" => "form-control", "id" => "txt_matricula", "disabled" => "disabled"]) ?>
            </div> 
        </div>                                            
    </div>    
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">                        
            <label for="txt_periodo" class="col-sm-2 col-sm-2 col-lg-2 col-md-2 col-xs-2 control-label"><?= Yii::t("formulario", "Period") ?></label>
            <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">
                <?= Html::input("text", "txt_periodo", '', ["class" => "form-control", "id" => "txt_periodo", "disabled" => "disabled"]) ?>
            </div>   
            <label for="txt_materia" class="col-sm-2 col-sm-2 col-lg-2 col-md-2 col-xs-2 control-label"><?= Yii::t("formulario", "Subject") ?></label>
            <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">
                <?= Html::input("text", "txt_materia", '', ["class" => "form-control", "id" => "txt_materia", "disabled" => "disabled"]) ?>
            </div> 
        </div>
    </div> 
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <div class="col-sm-8"></div>
        <div class="col-sm-2 col-md-2 col-xs-4 col-lg-2">                
            <a id="btn_buscarData_dist" href="javascript:" class="btn btn-primary btn-block"> <?= academico::t("distributivoacademico","Add Student") ?></a>
        </div>
    </div>
</div>

