<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\PbGridView\PbGridView;
use yii\data\ArrayDataProvider;

// echo 'aaa '.base64_decode($_GET['codigo']);
?>

<div class="col-md-12"> 
    <div class="border">
        <form class="form-horizontal">
            <?=
            $this->render('_formArbol', [
                'interesado' => $interesado,
                'pais' => $pais,
                'correo' => $correo,
                'celular' => $celular,
                'codigo' => $_GET["codigo"],
                'estado_cierre' => $estado_cierre,
            ]);
            ?>
        </form>
    </div>
</div>

<div class="col-md-12"> 
    <div>
        <?=
        $this->render('_listarArbolGrid', [
            'model' => $model,
            'codigo' => $_GET["codigo"],
        ]);
        ?>
    </div>
</div>