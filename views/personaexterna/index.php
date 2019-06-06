<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div>
    <form class="form-horizontal">
        <?=
        $this->render('registro', [ 
            "arr_provincia" => $arr_provincia,
            "arr_ciudad" => $arr_ciudad,
            "arr_genero" => $arr_genero,
            "arr_nivel" => $arr_nivel,
            "arr_evento" => $arr_evento,
            "arr_interes" => $arr_interes,
            ]);
        ?>
    </form>
</div>
