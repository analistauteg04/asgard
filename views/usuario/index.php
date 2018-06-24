<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbSearchBox\PbSearchBox;
?>

<div class="row">
    <div class="col-md-6">
        <?=
        PbSearchBox::widget([
            'boxId' => 'boxgrid',
            'type' => 'searchBox',
            'placeHolder' => Yii::t("accion", "Search"),
            'controller' => '',
            'callbackListSource' => 'searchUsers',
            'callbackListSourceParams' => ["'boxgrid'", "'grid_user_list'"],
        ]);
        ?>
    </div>
</div>
<br />
<?=
$this->render('index-grid', ['model' => $model,]);
?>
