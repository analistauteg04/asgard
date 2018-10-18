<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use \yii\data\ActiveDataProvider;
use \yii\data\ArrayDataProvider;
use Yii;

/**
 * Description of InscripcionAdmision
 *
 * @author root
 */
class InscripcionAdmision extends \yii\db\ActiveRecord {

    //put your code here
    public function insertarInscripcion($data) {
        $arroout = array();
        $con = \Yii::$app->db_captacion;
        $trans = $con->beginTransaction();
         if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }
        try {
            //\app\models\Utilities::putMessageLogFile('Entro al modelo para ingresar la informacion');
            $twin_id = $this->insertarDataInscripcion($con,$data);
            
            if ($trans !== null)
                $trans->commit();
       
            //$con->close();
            //RETORNA DATOS 
            $arroout["status"] = TRUE;
            $arroout["error"] = null;
            $arroout["message"] = null;
            $arroout["ids"] = $twin_id;
            $arroout["data"] = null;//$rawData;
            return $arroout;
            
            //return true;
        } catch (\Exception $e) {
            fclose($handle);
            if ($trans !== null)
                $trans->rollback();

            $arroout["status"] = FALSE;
            $arroout["error"] = $ex->getCode();
            $arroout["message"] = $ex->getMessage();
            $arroout["data"] = $rawData;
            return $arroout;
        }
    }

    private function insertarDataInscripcion($con,$data) {

        /*$keys = [
                        'twin_nombre', 'twin_apellido', 'twin_dni','twin_numero', 
                        'twin_correo', 'twin_pais', 'twin_celular','uaca_id', 
                        'mod_id', 'car_id', 'twin_metodo_ingreso','conuteg_id', 
                        'ruta_doc_titulo', 'ruta_doc_dni', 'ruta_doc_certvota','ruta_doc_foto', 
                        'ruta_doc_certificado', 'twin_mensaje1', 'twin_mensaje2','twin_estado', 
                        'twin_fecha_creacion', 'twin_estado_logico' 
                    ];
            $parametros =   [
                                $data[0]['pges_pri_nombre'], $data[0]['pges_pri_apellido'], $data[0]['tipo_dni'],$data[0]['pges_cedula'],
                                $data[0]['pges_correo'], $data[0]['pais'], $data[0]['pges_celular'],$data[0]['unidad_academica'],
                                $data[0]['modalidad'], $data[0]['carrera'], $data[0]['ming_id'],$data[0]['conoce'],
                                null,null,null,null,
                                null, null, null,1,
                                date("YmdHis"), 1
                            ];
        
        $param_sql .= "" . $keys[0];
        $bdet_sql .= "'" . $parameters[0] . "'";
        for ($i = 1; $i < count($parameters); $i++) {
            if (isset($parameters[$i])) {
                $param_sql .= ", " . $keys[$i];
                $bdet_sql .= ", '" . $parameters[$i] . "'";
            }
        }
        try {
            $sql = "INSERT INTO " . $con->dbname . '.' . $name_table . " ($param_sql) VALUES($bdet_sql);";
            \app\models\Utilities::putMessageLogFile('sql: '.$sql);
            $comando = $con->createCommand($sql);
            $result = $comando->execute();
            $idtable = $con->getLastInsertID($con->dbname . '.' . $name_table);
            if ($trans !== null)
                $trans->commit();
            return $idtable;
        } catch (Exception $ex) {
            if ($trans !== null) {
                $trans->rollback();
            }
            return 0;
        }*/
        
        $sql = "INSERT INTO " . $con->dbname . ".temporal_wizard_inscripcion
            (twin_nombre,twin_apellido,twin_dni,twin_numero,twin_correo,twin_pais,twin_celular,uaca_id, 
             mod_id,car_id,twin_metodo_ingreso,conuteg_id,ruta_doc_titulo, ruta_doc_dni, ruta_doc_certvota,
             ruta_doc_foto,ruta_doc_certificado, twin_mensaje1,twin_mensaje2,twin_estado,twin_fecha_creacion,twin_estado_logico)VALUES
            (:twin_nombre,:twin_apellido,:twin_dni,:twin_numero,:twin_correo,:twin_pais,:twin_celular,:uaca_id, 
             :mod_id,:car_id,:twin_metodo_ingreso,:conuteg_id,:ruta_doc_titulo,:ruta_doc_dni,:ruta_doc_certvota,
             :ruta_doc_foto,:ruta_doc_certificado,:twin_mensaje1,:twin_mensaje2,1,CURRENT_TIMESTAMP(),1)";
                
        $command = $con->createCommand($sql);
        $command->bindParam(":twin_nombre", $data[0]['pges_pri_nombre'], \PDO::PARAM_STR);
        $command->bindParam(":twin_apellido", $data[0]['pges_pri_apellido'], \PDO::PARAM_STR);
        $command->bindParam(":twin_dni", $data[0]['tipo_dni'], \PDO::PARAM_STR);
        $command->bindParam(":twin_numero", $data[0]['pges_cedula'], \PDO::PARAM_STR);
        $command->bindParam(":twin_correo", $data[0]['pges_correo'], \PDO::PARAM_STR);
        $command->bindParam(":twin_pais", $data[0]['pais'], \PDO::PARAM_STR);
        $command->bindParam(":twin_celular", $data[0]['pges_celular'], \PDO::PARAM_STR);
        $command->bindParam(":uaca_id", $data[0]['unidad_academica'], \PDO::PARAM_STR);
        $command->bindParam(":mod_id", $data[0]['modalidad'], \PDO::PARAM_STR);
        $command->bindParam(":car_id", $data[0]['carrera'], \PDO::PARAM_STR);
        $command->bindParam(":twin_metodo_ingreso", $data[0]['ming_id'], \PDO::PARAM_STR);
        $command->bindParam(":conuteg_id", $data[0]['conoce'], \PDO::PARAM_STR);
        //$command->bindParam(":ruta_doc_titulo", $data[0]['ruta_doc_titulo'], \PDO::PARAM_STR);
        //$command->bindParam(":ruta_doc_dni", $data[0]['ruta_doc_dni'], \PDO::PARAM_STR);
        //$command->bindParam(":ruta_doc_certvota", $data[0]['ruta_doc_certvota'], \PDO::PARAM_STR);
        //$command->bindParam(":ruta_doc_foto", $data[0]['ruta_doc_foto'], \PDO::PARAM_STR);
        //$command->bindParam(":ruta_doc_certificado", $data[0]['ruta_doc_certificado'], \PDO::PARAM_STR);
        //$command->bindParam(":twin_mensaje1", $data[0]['twin_mensaje1'], \PDO::PARAM_STR);
        //$command->bindParam(":twin_mensaje2", $data[0]['twin_mensaje2'], \PDO::PARAM_STR);
        $command->execute();
        return $con->getLastInsertID();

    }

    /**
     * Function addLabelTimeDocumentos renombra el documento agregando una varible de tiempo 
     * @author  Developer Uteg <developer@uteg.edu.ec>
     * @param   int     $sins_id        Id de la solicitud
     * @param   string  $file           Uri del Archivo a modificar
     * @param   int     $timeSt         Parametro a agregar al nombre del archivo
     * @return  $newFile | FALSE (Retorna el nombre del nuevo archivo o false si fue error).
     */
    public static function addLabelTimeDocumentos($sins_id, $file, $timeSt) {
        $arrIm = explode(".", basename($file));
        $typeFile = strtolower($arrIm[count($arrIm) - 1]);
        $baseFile = Yii::$app->basePath;
        $search = ".$typeFile";
        $replace = "_$timeSt" . ".$typeFile";
        $newFile = str_replace($search, $replace, $file);
        if (rename($baseFile . $file, $baseFile . $newFile)) {
            return $newFile;
        }
        return FALSE;
    }

}
