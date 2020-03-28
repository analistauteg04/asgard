<?php

namespace app\modules\academico\models;

use yii\base\Exception;
use Yii;
use yii\data\ArrayDataProvider;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Especies
 *
 * @author byron Villacreses
 */
class Especies extends \yii\db\ActiveRecord {

    //put your code here

    public function consultaDatosEstudiante($id) {
        $rawData = array();
        $con = \Yii::$app->db_academico;
        $con1 = \Yii::$app->db_asgard;
        $sql = "SELECT B.per_id Ids,B.per_pri_nombre,B.per_seg_nombre,B.per_pri_apellido, 
                            B.per_seg_apellido,B.per_cedula
                    FROM " . $con->dbname . ".estudiante A 
                            INNER JOIN " . $con1->dbname . ".persona B ON A.per_id=B.per_id
                WHERE A.est_estado=1 AND A.est_estado_logico=1 AND A.est_id=:Ids;";
        //echo $sql;    

        $comando = $con->createCommand($sql);
        //$comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":Ids", $id, \PDO::PARAM_INT);
        //$comando->bindParam(":estadoinactivo", $estadoinactivo, \PDO::PARAM_STR);
        $rawData = $comando->queryOne();
        return $rawData;
    }

    public static function getSolicitudesAlumnos($est_id, $arrFiltro = array(), $onlyData = false) {
        $con = \Yii::$app->db_academico;
        $con1 = \Yii::$app->db_asgard;
        $con2 = \Yii::$app->db_facturacion;
        $estado = 1;
        $str_search = "";
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $str_search .= ($arrFiltro['f_pago']!= "")?" AND A.fpag_id= :fpag_id ":"";
            if ($arrFiltro['f_ini'] != "" && $arrFiltro['f_fin'] != "") {
                $str_search .= " AND A.csol_fecha_creacion BETWEEN :fec_ini AND :fec_fin ";
                //$str_search .= "A.sesp_fecha_solicitud >= :fec_ini AND ";
                //$str_search .= "A.sesp_fecha_solicitud <= :fec_fin AND ";
            }
        }
        
        $sql = "SELECT lpad(ifnull(A.csol_id,0),9,'0') csol_id,A.empid,B.uaca_nombre,C.mod_nombre,D.fpag_nombre,date(A.csol_fecha_creacion) csol_fecha_solicitud,
                    A.csol_estado_aprobacion,A.csol_total
                    FROM " . $con->dbname . ".cabecera_solicitud A
                            INNER JOIN " . $con->dbname . ".unidad_academica B ON B.uaca_id=A.uaca_id
                    INNER JOIN " . $con->dbname . ".modalidad C ON C.mod_id=A.mod_id
                    INNER JOIN " . $con2->dbname . ".forma_pago D ON D.fpag_id=A.fpag_id
                WHERE  A.csol_estado=1 AND A.csol_estado_logico=1 AND A.est_id=:est_id  $str_search;";

       


        $comando = $con->createCommand($sql);
        //$comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":est_id", $est_id, \PDO::PARAM_INT);
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $fecha_ini = $arrFiltro["f_ini"];
            $fecha_fin = $arrFiltro["f_fin"];
            $forma_pago =$arrFiltro['f_pago'];
            if($forma_pago!= ""){ $comando->bindParam(":fpag_id", $forma_pago, \PDO::PARAM_INT); }
            
            if ($arrFiltro['f_ini'] != "" && $arrFiltro['f_fin'] != "") {
                $comando->bindParam(":fec_ini", $fecha_ini, \PDO::PARAM_STR);
                $comando->bindParam(":fec_fin", $fecha_fin, \PDO::PARAM_STR);
            }
        }
        $resultData = $comando->queryAll();
        $dataProvider = new ArrayDataProvider([
            'key' => 'id',
            'allModels' => $resultData,
            'pagination' => [
                'pageSize' => Yii::$app->params["pageSize"],
            ],
            'sort' => [
                'attributes' => [
                    'csol_id',
                    'csol_fecha_solicitud',
                ],
            ],
        ]);
        if ($onlyData) {
            return $resultData;
        } else {
            return $dataProvider;
        }
    }

    public static function getTramite() {
        $con = \Yii::$app->db_academico;
        $sql = "SELECT tra_id id,tra_nombre name 
                    FROM " . $con->dbname . ".tramite
                WHERE tra_estado=1 AND tra_estado_logico=1; ";
        $comando = $con->createCommand($sql);
        //$comando->bindParam(":esp_id", $Ids, \PDO::PARAM_INT);
        return $comando->queryAll();
    }
    
    
    public static function getFormaPago() {
        $con = \Yii::$app->db_facturacion;
        $sql = "SELECT fpag_id Ids,fpag_nombre Nombre 
                    FROM " . $con->dbname . ".forma_pago
                WHERE fpag_estado=1 AND fpag_estado_logico=1 AND fpag_id IN(4,5,6);";        
        $comando = $con->createCommand($sql);
        //$comando->bindParam(":esp_id", $Ids, \PDO::PARAM_INT);
        return $comando->queryAll();
    }

    public static function getTramiteEspecie($Ids) {
        $con = \Yii::$app->db_academico;
        $sql = "SELECT esp_id id,esp_rubro name
                    FROM " . $con->dbname . ".especies
                WHERE esp_estado=1 AND esp_estado_logico=1 AND tra_id=:tra_id;";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":tra_id", $Ids, \PDO::PARAM_INT);
        return $comando->queryAll();
    }

    public static function getDataEspecie($Ids) {
        $con = \Yii::$app->db_academico;
        $sql = "SELECT esp_id,esp_valor,esp_emision_certificado,esp_dia_vigencia
                    FROM " . $con->dbname . ".especies
                WHERE esp_estado=1 AND esp_estado_logico=1 AND esp_id=:esp_id;";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":esp_id", $Ids, \PDO::PARAM_INT);
        return $comando->queryAll();
    }

    public function insertarLista($dts_Cab, $dts_Det) {
        $arroout = array();
        $con = \Yii::$app->db_academico;
        $trans = $con->beginTransaction();
        try {
           // \app\models\Utilities::putMessageLogFile($dts_Cab);
            $this->InsertarCabLista($con, $dts_Cab);
            //$idCab=$con->getLastInsertID();//IDS de la Persona
            $idCab = $con->getLastInsertID($con->dbname . '.cabecera_solicitud');
            $this->InsertarDetLista($con, $dts_Det, $idCab);
            
            $trans->commit();
            $con->close();
            //RETORNA DATOS 
            //$arroout["ids"]= $ftem_id;
            $arroout["status"]= true;
            //$arroout["secuencial"]= $doc_numero;
            return $arroout;
         } catch (\Exception $e) {
            $trans->rollBack();
            $con->close();
            throw $e;
            $arroout["status"]= false;
            return $arroout;
        }
    }

    private function InsertarCabLista($con, $data) {
        \app\models\Utilities::putMessageLogFile($data['csol_total']);
        $sql = "INSERT INTO " . $con->dbname . ".cabecera_solicitud
                (empid,est_id,uaca_id,mod_id,fpag_id,csol_total,csol_usuario_ingreso,csol_estado,csol_fecha_creacion,csol_estado_logico)VALUES
                (:empid,:est_id,:uaca_id,:mod_id,:fpag_id,:csol_total,1,1,CURRENT_TIMESTAMP(),1);";
        $command = $con->createCommand($sql);
        $command->bindParam(":empid", $data['empid'], \PDO::PARAM_INT);
        $command->bindParam(":est_id", $data['est_id'], \PDO::PARAM_INT);
        $command->bindParam(":uaca_id", $data['uaca_id'], \PDO::PARAM_INT);
        $command->bindParam(":mod_id", $data['mod_id'], \PDO::PARAM_INT);
        $command->bindParam(":fpag_id", $data['fpag_id'], \PDO::PARAM_INT);
        $command->bindParam(":csol_total", $data['csol_total'], \PDO::PARAM_STR);
        $command->execute();
    }

    private function InsertarDetLista($con, $dts_Det, $idCab) {        
        for ($i = 0; $i < sizeof($dts_Det); $i++) {  
            $dts_Det[$i]['dsol_usuario_ingreso']=1;
            $dts_Det[$i]['est_id']=1;
            $sql = "INSERT INTO " . $con->dbname . ".detalle_solicitud
                        (csol_id,tra_id,esp_id,est_id,dsol_cantidad,dsol_valor,dsol_total,
                        dsol_usuario_ingreso,dsol_estado,dsol_fecha_creacion,dsol_estado_logico)
                    VALUES
                        (:csol_id,:tra_id,:esp_id,:est_id,:dsol_cantidad,:dsol_valor,:dsol_total,
                        :dsol_usuario_ingreso,1,CURRENT_TIMESTAMP(),1);";
            $command = $con->createCommand($sql);
            $command->bindParam(":csol_id", $idCab, \PDO::PARAM_INT);
            $command->bindParam(":tra_id", $dts_Det[$i]['tra_id'], \PDO::PARAM_INT);
            $command->bindParam(":esp_id", $dts_Det[$i]['esp_id'], \PDO::PARAM_INT);
            $command->bindParam(":est_id", $dts_Det[$i]['est_id'], \PDO::PARAM_INT);
            $command->bindParam(":dsol_cantidad", $dts_Det[$i]['dsol_cantidad'], \PDO::PARAM_INT);
            $command->bindParam(":dsol_valor", $dts_Det[$i]['dsol_valor'], \PDO::PARAM_STR);
            $command->bindParam(":dsol_total", $dts_Det[$i]['dsol_total'], \PDO::PARAM_STR);
            $command->bindParam(":dsol_usuario_ingreso", $dts_Det[$i]['dsol_usuario_ingreso'], \PDO::PARAM_INT);            
            $command->execute();
        }
    }

}
