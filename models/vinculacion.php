<?php
namespace app\models;

use Yii;
use yii\data\ArrayDataProvider;

class Vinculacion extends \yii\db\ActiveRecord {

    public function insertarReg_proyectovin($rpvi_nombre_proj, $rpvi_descripcion_proj, $rpvi_nombre_contacto,
                                                $rpvi_telf_contacto, $rpvi_ruta_img) {
        $con = \Yii::$app->db_general;

        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        $param_sql = "dafa_estado_logico";
        $bdet_sql = "1";

        $param_sql .= ", dafa_estado";
        $bdet_sql .= ", 1";

        if (isset($rpvi_nombre_proj)) {
            $param_sql .= ", rpvi_nombre_proj";
            $bdet_sql .= ", :rpvi_nombre_proj";
        }

        if (isset($rpvi_descripcion_proj)) {
            $param_sql .= ", rpvi_descripcion_proj";
            $bdet_sql .= ", :rpvi_descripcion_proj";
        }

        if (isset($rpvi_nombre_contacto)) {
            $param_sql .= ", rpvi_nombre_contacto";
            $bdet_sql .= ", :rpvi_nombre_contacto";
        }

        if (isset($rpvi_telf_contacto)) {
            $param_sql .= ", rpvi_telf_contacto";
            $bdet_sql .= ", :rpvi_telf_contacto";
        }

        if (isset($rpvi_ruta_img)) {
            $param_sql .= ", rpvi_ruta_img";
            $bdet_sql .= ", :rpvi_ruta_img";
        }

       
        try {
            $sql = "INSERT INTO " . $con->dbname . ".registro_proj_vinculacion ($param_sql) VALUES($bdet_sql)";
            $comando = $con->createCommand($sql);

            if (isset($rpvi_nombre_proj))
                $comando->bindParam(':rpvi_nombre_proj', $rpvi_nombre_proj, \PDO::PARAM_INT);

            if (isset($rpvi_descripcion_proj))
                $comando->bindParam(':rpvi_descripcion_proj', $rpvi_descripcion_proj, \PDO::PARAM_INT);

            if (!empty((isset($rpvi_nombre_contacto))))
                $comando->bindParam(':rpvi_nombre_contacto', $rpvi_nombre_contacto, \PDO::PARAM_INT);

            if (isset($rpvi_telf_contacto))
                $comando->bindParam(':rpvi_telf_contactov', $rpvi_telf_contacto, \PDO::PARAM_STR);

            if (isset($rpvi_ruta_img))
                $comando->bindParam(':rpvi_ruta_img', $rpvi_ruta_img, \PDO::PARAM_STR);
             
            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.registro_proj_vinculacion');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }

}