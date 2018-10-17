<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;
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
            $data_1 = isset($data['DATA_1']) ? $data['DATA_1'] : array();
            //$data_2 = isset($data['DATA_2']) ? $data['DATA_2'] : array();
            //$data_3 = isset($data['DATA_3']) ? $data['DATA_3'] : array(); 
            $twin_id=$this->insertarDataInscripcion($con,$data_1,$data_2,$data_3);
            $trans->commit();
            $con->close();
             //RETORNA DATOS 
            $arroout["ids"]= $twin_id;
            $arroout["status"]= true;            
            $arroout["accion"]= 'Update';
            return $arroout;
            //return true;
        } catch (\Exception $e) {
            $trans->rollBack();
            $con->close();
            //throw $e;
            $arroout["status"]= false;
            return $arroout;
            //return false;
        }
    }
    private function insertarDataInscripcion($con,$data_1,$data_2,$data_3) {
        //`twin_id`,
        $sql = "INSERT INTO " . $con->dbname . ".temporal_wizard_inscripcion
            (twin_nombre,twin_apellido,twin_dni,twin_numero,twin_correo,twin_pais,twin_celular,
             uaca_id,mod_id,car_id,twin_metodo_ingreso,conuteg_id,ruta_doc_titulo,ruta_doc_dni,
             ruta_doc_certvota,ruta_doc_foto,ruta_doc_certificado,twin_mensaje1,twin_mensaje2,
             twin_estado,twin_fecha_creacion,twin_estado_logico)VALUES
            (:twin_nombre,:twin_apellido,:twin_dni,:twin_numero,:twin_correo,:twin_pais,:twin_celular,
             :uaca_id,:mod_id,:car_id,:twin_metodo_ingreso,:conuteg_id,:ruta_doc_titulo,:ruta_doc_dni,
             :ruta_doc_certvota,:ruta_doc_foto,:ruta_doc_certificado,:twin_mensaje1,:twin_mensaje2,
             1,CURRENT_TIMESTAMP(),1)";

        $command = $con->createCommand($sql);
        $command->bindParam(":twin_nombre",$doc_numero, PDO::PARAM_STR);
        $command->bindParam(":twin_apellido",$doc_numero, PDO::PARAM_STR);
        $command->bindParam(":twin_dni",$doc_numero, PDO::PARAM_STR);
        $command->bindParam(":twin_numero",$doc_numero, PDO::PARAM_STR);
        $command->bindParam(":twin_correo",$doc_numero, PDO::PARAM_STR);
        $command->bindParam(":twin_pais",$doc_numero, PDO::PARAM_STR);
        $command->bindParam(":twin_celular",$doc_numero, PDO::PARAM_STR);
        $command->bindParam(":uaca_id",$doc_numero, PDO::PARAM_STR);
        $command->bindParam(":mod_id",$doc_numero, PDO::PARAM_STR);
        $command->bindParam(":car_id",$doc_numero, PDO::PARAM_STR);
        $command->bindParam(":twin_metodo_ingreso",$doc_numero, PDO::PARAM_STR);
        $command->bindParam(":conuteg_id",$doc_numero, PDO::PARAM_STR);
        $command->bindParam(":ruta_doc_titulo",$doc_numero, PDO::PARAM_STR);
        $command->bindParam(":ruta_doc_dni",$doc_numero, PDO::PARAM_STR);
        $command->bindParam(":ruta_doc_certvota",$doc_numero, PDO::PARAM_STR);
        $command->bindParam(":ruta_doc_foto",$doc_numero, PDO::PARAM_STR);
        $command->bindParam(":ruta_doc_certificado",$doc_numero, PDO::PARAM_STR);
        $command->bindParam(":twin_mensaje1",$doc_numero, PDO::PARAM_STR);
        $command->bindParam(":twin_mensaje2",$doc_numero, PDO::PARAM_STR);
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
    public static function addLabelTimeDocumentos($sins_id, $file, $timeSt){
        $arrIm = explode(".", basename($file));
        $typeFile = strtolower($arrIm[count($arrIm) - 1]);
        $baseFile = Yii::$app->basePath;
        $search  = ".$typeFile";
        $replace = "_$timeSt" . ".$typeFile";
        $newFile = str_replace($search, $replace, $file);
        if(rename($baseFile . $file, $baseFile . $newFile)){
            return $newFile;
        }
        return FALSE;
    }
}
