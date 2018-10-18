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
        try {
            \app\models\Utilities::putMessageLogFile('Entro al modelo para ingresar la informacion');
            $keys = [
                        'twin_nombre', 'twin_apellido', 'twin_dni','twin_numero', 
                        'twin_correo', 'twin_pais', 'twin_celular','uaca_id', 
                        'mod_id', 'car_id', 'twin_metodo_ingreso','conuteg_id', 
                        'ruta_doc_titulo', 'ruta_doc_dni', 'ruta_doc_certvota','ruta_doc_foto', 
                        'ruta_doc_certificado', 'twin_mensaje1', 'twin_mensaje2','twin_estado', 
                        'twin_fecha_creacion', 'twin_estado_logico' 
                    ];
            $parametros =   [
                                ucwords(strtolower($data[0]['pges_pri_nombre'])), ucwords(strtolower($data[0]['pges_pri_apellido'])), ucwords(strtolower($data[0]['tipo_dni'])),ucwords(strtolower($data[0]['pges_cedula'])),
                                ucwords(strtolower($data[0]['pges_correo'])), ucwords(strtolower($data[0]['pais'])), ucwords(strtolower($data[0]['pges_celular'])),ucwords(strtolower($data[0]['unidad_academica'])),
                                $data[0]['modalidad'], $data[0]['carrera'], $data[0]['ming_id'],$data[0]['conoce'],
                                null,null,null,null,
                                null, null, null,1,
                                date("YmdHis"), 1
                            ];
            $twin_id = $this->insertarDataInscripcion($con, $keys,$parametros,"temporal_wizard_inscripcion");
            $trans->commit();
            $con->close();
            //RETORNA DATOS 
            $arroout["ids"] = $twin_id;
            $arroout["status"] = true;
            $arroout["accion"] = 'Update';
            return $arroout;
            //return true;
        } catch (\Exception $e) {
            $trans->rollBack();
            $con->close();
            //throw $e;
            $arroout["status"] = false;
            return $arroout;
            //return false;
        }
    }

    private function insertarDataInscripcion($con, $keys,$parameters,$name_table) {
        $trans = $con->getTransaction();
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
        }
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
