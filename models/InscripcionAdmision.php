<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use \yii\data\ActiveDataProvider;
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
            $twin_id = $this->insertarDataInscripcion($con,$data["DATA_1"]);
            $trans->commit();
            //RETORNA DATOS 
            $arroout["status"] = TRUE;
            $arroout["error"] = null;
            $arroout["message"] = null;
            $arroout["ids"] = $twin_id;
            $arroout["data"] = null;//$rawData;
            return $arroout;
        } catch (\Exception $e) {
            $trans->rollback();

            $arroout["status"] = FALSE;
            $arroout["error"] = $e->getCode();
            $arroout["message"] = $e->getMessage();
            $arroout["data"] = null;//$rawData;
            return $arroout;
        }
    }
    
    public function actualizarInscripcion($data) {
        $arroout = array();
        $con = \Yii::$app->db_captacion;
        $trans = $con->beginTransaction();
        try {
            $this->updateDataInscripcion($con,$data["DATA_1"]);
            $trans->commit();
            //RETORNA DATOS 
            $arroout["status"] = TRUE;
            $arroout["error"] = null;
            $arroout["message"] = null;
            $arroout["ids"] = $twin_id;
            $arroout["data"] = null;//$rawData;
            return $arroout;
        } catch (\Exception $e) {
            $trans->rollback();
            $arroout["status"] = FALSE;
            $arroout["error"] = $e->getCode();
            $arroout["message"] = $e->getMessage();
            $arroout["data"] = null;//$rawData;
            return $arroout;
        }
        
    }

    private function insertarDataInscripcion($con,$data) {
        $ruta_doc_titulo='';
        $ruta_doc_dni='';
        $ruta_doc_certvota='';
        $ruta_doc_foto='';
        $ruta_doc_certificado='';
        $twin_mensaje1=0;
        $twin_mensaje2=0;
           
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
        $command->bindParam(":ruta_doc_titulo", $ruta_doc_titulo, \PDO::PARAM_STR);
        $command->bindParam(":ruta_doc_dni", $ruta_doc_dni, \PDO::PARAM_STR);
        $command->bindParam(":ruta_doc_certvota", $ruta_doc_certvota, \PDO::PARAM_STR);
        $command->bindParam(":ruta_doc_foto", $ruta_doc_foto, \PDO::PARAM_STR);
        $command->bindParam(":ruta_doc_certificado", $ruta_doc_certificado, \PDO::PARAM_STR);
        $command->bindParam(":twin_mensaje1", $twin_mensaje1, \PDO::PARAM_STR);
        $command->bindParam(":twin_mensaje2", $twin_mensaje2, \PDO::PARAM_STR);
        $command->execute();
        return $con->getLastInsertID();

    }
    
    
    private function updateDataInscripcion($con,$data) {
        $sql = "UPDATE " . $con->dbname . ".temporal_wizard_inscripcion 
                SET twin_nombre=:twin_nombre,twin_apellido=:twin_apellido,twin_dni=:twin_dni,twin_numero=:twin_numero,
                    twin_correo=:twin_correo,twin_pais=:twin_pais,twin_celular=:twin_celular,uaca_id=:uaca_id, 
                    mod_id=:mod_id,car_id=:car_id,twin_metodo_ingreso=:twin_metodo_ingreso,conuteg_id=:conuteg_id,ruta_doc_titulo=:ruta_doc_titulo, 
                    ruta_doc_dni=:ruta_doc_dni, ruta_doc_certvota=:ruta_doc_certvota,ruta_doc_foto=:ruta_doc_foto,ruta_doc_certificado=:ruta_doc_certificado, 
                    twin_mensaje1=:twin_mensaje1,twin_mensaje2=:twin_mensaje2,twin_fecha_modificacion=CURRENT_TIMESTAMP() 
                 WHERE twin_id =:twin_id ";
        $command = $con->createCommand($sql);
        $command->bindParam(":twin_id", $data[0]['twin_id'], \PDO::PARAM_STR);
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
        $command->bindParam(":ruta_doc_titulo", $data[0]['ruta_doc_titulo'], \PDO::PARAM_STR);
        $command->bindParam(":ruta_doc_dni", $data[0]['ruta_doc_dni'], \PDO::PARAM_STR);
        $command->bindParam(":ruta_doc_certvota",$data[0]['ruta_doc_certvota'], \PDO::PARAM_STR);
        $command->bindParam(":ruta_doc_foto", $data[0]['ruta_doc_foto'], \PDO::PARAM_STR);
        $command->bindParam(":ruta_doc_certificado", $data[0]['ruta_doc_certificado'], \PDO::PARAM_STR);
        $command->bindParam(":twin_mensaje1", $data[0]['twin_mensaje1'], \PDO::PARAM_STR);
        $command->bindParam(":twin_mensaje2", $data[0]['twin_mensaje2'], \PDO::PARAM_STR);
        $command->execute();
        //return $con->getLastInsertID();
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
    
    /**
     * Function consultarDatosInscripcion
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  $resultData (Obtiene los datos de inscripción y el precio de la solicitud.)
     */
    public function consultarDatosInscripcion($twin_identificacion, $twin_correo) {
        $con = \Yii::$app->db_captacion;
        $con2 = \Yii::$app->db_facturacion;
        $con1 = \Yii::$app->db_academico;
        $estado = 1;
        $estado_precio = 'A';
        
        $sql = "SELECT  ua.uaca_nombre unidad, 
                        m.mod_nombre modalidad,
                        ea.eaca_nombre carrera,
                        mi.ming_nombre metodo,
                        ip.ipre_precio as precio
                FROM " . $con->dbname . ".temporal_wizard_inscripcion twi inner join db_academico.unidad_academica ua on ua.uaca_id = twi.uaca_id
                     inner join " . $con1->dbname . ".modalidad m on m.mod_id = twi.mod_id
                     inner join " . $con1->dbname . ".estudio_academico ea on ea.eaca_id = twi.car_id
                     inner join " . $con->dbname . ".metodo_ingreso mi on mi.ming_id = twi.twin_metodo_ingreso
                     inner join " . $con2->dbname . ".item_metodo_unidad imi on (imi.ming_id =  twi.twin_metodo_ingreso and imi.uaca_id = twi.uaca_id and imi.mod_id = twi.mod_id)
                     inner join " . $con2->dbname . ".item_precio ip on ip.ite_id = imi.ite_id
                WHERE twi.twin_numero = :twin_identificacion AND
                     twi.twin_correo = :twin_correo AND
                     ip.ipre_estado_precio = :estado_precio AND
                     ua.uaca_estado = :estado AND
                     ua.uaca_estado_logico = :estado AND
                     m.mod_estado = :estado AND
                     m.mod_estado_logico = :estado AND
                     ea.eaca_estado = :estado AND
                     ea.eaca_estado_logico = :estado AND
                     mi.ming_estado = :estado AND
                     mi.ming_estado_logico = :estado AND
                     imi.imni_estado = :estado AND
                     imi.imni_estado_logico = :estado AND
                     ip.ipre_estado = :estado AND
                     ip.ipre_estado_logico = :estado
             limit 1";
                
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":twin_identificacion", $twin_identificacion, \PDO::PARAM_STR);
        $comando->bindParam(":twin_correo", $twin_correo, \PDO::PARAM_STR);        
        $comando->bindParam(":estado_precio", $estado_precio, \PDO::PARAM_STR);
        $resultData = $comando->queryOne();
        return $resultData;
    }

}
