<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
use app\models\Utilities;
use app\modules\academico\Module as academico;
use yii\grid\CheckboxColumn;
academico::registerTranslations();
?>
<br /><br />
<form class="form-horizontal">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <label class="col-lg-6 col-md-6 col-sm-6 col-xs-6 control-label"><?= academico::t("matriculacion", "Block 1") ?></label>
            <table class="table table-bordered table-subjects">
                <thead>
                    <tr>
                        <th><?= academico::t("matriculacion", "Subject")  ?></th>
                        <th style="width: 5px"><?= academico::t("matriculacion", "Hour")  ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($materias as $key => $value){
                            if(strtoupper($value["Subject"]) == strtoupper($materiasxEstudiante->pes_mat_b1_h1_nombre))
                                echo "<tr><td>".strtoupper($value["Subject"])."</td><td>1H</td></tr>";
                            if(strtoupper($value["Subject"]) == strtoupper($materiasxEstudiante->pes_mat_b1_h2_nombre))
                                echo "<tr><td>".strtoupper($value["Subject"])."</td><td>2H</td></tr>";
                            if(strtoupper($value["Subject"]) == strtoupper($materiasxEstudiante->pes_mat_b1_h3_nombre))
                                echo "<tr><td>".strtoupper($value["Subject"])."</td><td>3H</td></tr>";
                            if(strtoupper($value["Subject"]) == strtoupper($materiasxEstudiante->pes_mat_b1_h4_nombre))
                                echo "<tr><td>".strtoupper($value["Subject"])."</td><td>4H</td></tr>";
                            if(strtoupper($value["Subject"]) == strtoupper($materiasxEstudiante->pes_mat_b1_h5_nombre))
                                echo "<tr><td>".strtoupper($value["Subject"])."</td><td>5H</td></tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <label class="col-lg-6 col-md-6 col-sm-6 col-xs-6 control-label"><?= academico::t("matriculacion", "Block 2") ?></label>
            <table class="table table-bordered table-subjects">
                <thead>
                    <tr>
                        <th><?= academico::t("matriculacion", "Subject")  ?></th>
                        <th style="width: 5px"><?= academico::t("matriculacion", "Hour")  ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($materias as $key => $value){
                            if(strtoupper($value["Subject"]) == strtoupper($materiasxEstudiante->pes_mat_b2_h1_nombre))
                                echo "<tr><td>".strtoupper($value["Subject"])."</td><td>1H</td></tr>";
                            if(strtoupper($value["Subject"]) == strtoupper($materiasxEstudiante->pes_mat_b2_h2_nombre))
                                echo "<tr><td>".strtoupper($value["Subject"])."</td><td>2H</td></tr>";
                            if(strtoupper($value["Subject"]) == strtoupper($materiasxEstudiante->pes_mat_b2_h3_nombre))
                                echo "<tr><td>".strtoupper($value["Subject"])."</td><td>3H</td></tr>";
                            if(strtoupper($value["Subject"]) == strtoupper($materiasxEstudiante->pes_mat_b2_h4_nombre))
                                echo "<tr><td>".strtoupper($value["Subject"])."</td><td>4H</td></tr>";
                            if(strtoupper($value["Subject"]) == strtoupper($materiasxEstudiante->pes_mat_b2_h5_nombre))
                                echo "<tr><td>".strtoupper($value["Subject"])."</td><td>5H</td></tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</form>