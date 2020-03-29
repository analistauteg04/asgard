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
    
    public function recuperarIdsEstudiente($per_id){
        $con = \Yii::$app->db_academico; 
        $sql = "SELECT A.est_id FROM " . $con->dbname . ".estudiante A
                    WHERE A.est_estado=1 AND A.est_estado_logico=1 AND A.per_id=:per_id;";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
        $rawData=$comando->queryScalar();
        if ($rawData === false)
            return 0; //en caso de que existe problema o no retorne nada tiene 1 por defecto 
        return $rawData;
    }

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
    
    public function consultarCabSolicitud($Ids) {
        $con = \Yii::$app->db_academico;        
        $sql = "SELECT A.* FROM " . $con->dbname . ".cabecera_solicitud A
                    WHERE  A.csol_estado=1 AND A.csol_estado_logico=1 AND A.csol_id= :csol_id;";          
        $comando = $con->createCommand($sql);
        $comando->bindParam(":csol_id", $Ids, \PDO::PARAM_INT);
        return $comando->queryAll();
    }
    
    public function consultarDetSolicitud($Ids) {
        $con = \Yii::$app->db_academico;        
        $sql = "SELECT A.*,C.tra_nombre,B.esp_rubro FROM db_academico.detalle_solicitud A
			INNER JOIN " . $con->dbname . ".especies B ON A.esp_id=B.esp_id
			INNER JOIN " . $con->dbname . ".tramite C ON A.tra_id=C.tra_id
		WHERE A.dsol_estado=1 AND A.dsol_estado_logico=1 AND A.csol_id=:csol_id; ";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":csol_id", $Ids, \PDO::PARAM_INT);
        return $comando->queryAll();
    }
    
   
    public function CargarArchivo($fname, $csol_id) {
        $arroout = array();
        $con = \Yii::$app->db_academico;
        $trans = $con->beginTransaction();
        try {
            //$ids = isset($data['ids']) ? base64_decode($data['ids']) :NULL;
            $path = Yii::$app->basePath . Yii::$app->params['documentFolder'] . "especies/" . $fname;
            $path =  $fname;
            $sql = "UPDATE " . $con->dbname . ".cabecera_solicitud "
                    . "SET csol_ruta_archivo_pago=:csol_ruta_archivo_pago,csol_fecha_modificacion=CURRENT_TIMESTAMP() WHERE csol_id=:csol_id";
            
            $command = $con->createCommand($sql);
            $command->bindParam(":csol_id", $csol_id, \PDO::PARAM_INT);
            $command->bindParam(":csol_ruta_archivo_pago", $path, \PDO::PARAM_STR);
            $command->execute();
            
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
    
    /*INSERT INTO db_academico.especies_generadas
                    (dsol_id,empid,est_id,resp_id,tra_id,esp_id,uaca_id,mod_id,fpag_id,egen_numero_solicitud,
                     egen_observacion,egen_fecha_solicitud,egen_fecha_aprobacion,egen_fecha_caducidad,egen_estado_aprobacion,
                     egen_ruta_archivo_pago,egen_certificado,egen_usuario_ingreso,egen_estado,egen_fecha_creacion,egen_estado_logico)
                VALUES
                    ('8','1','1',1,'3','60','1','1','4','000000002',
                     '','2020-03-27 18:57:40',CURRENT_TIMESTAMP(),'31-12-1969','3',
                     NULL,NULL,'1',1,CURRENT_TIMESTAMP(),1);*/
    
    public function autorizarSolicitud($csol_id, $estado) {
        $emp_id = @Yii::$app->session->get("PB_idempresa");
        $usu_id = @Yii::$app->session->get("PB_iduser");
        $arroout = array();
        $con = \Yii::$app->db_academico;
        $trans = $con->beginTransaction();
        try {
           // \app\models\Utilities::putMessageLogFile($dts_Cab);
            
            $fecha_actual = date("d-m-Y");
            $cabSol=$this->consultarCabSolicitud($csol_id);
            $detSol=$this->consultarDetSolicitud($csol_id);            
            for ($i = 0; $i < sizeof($detSol); $i++) { 
                //$detSol[$i]['est_id']=1;
                $esp_id=$detSol[$i]['esp_id'];
                $detSol[$i]['egen_fecha_solicitud']=$cabSol[0]['csol_fecha_creacion'];
                $detSol[$i]['egen_ruta_archivo_pago']=$cabSol[0]['csol_ruta_archivo_pago'];
                $detSol[$i]['uaca_id']=$cabSol[0]['uaca_id'];
                $detSol[$i]['mod_id']=$cabSol[0]['mod_id'];
                $detSol[$i]['fpag_id']=$cabSol[0]['fpag_id'];
                $detSol[$i]['egen_estado_aprobacion']=$estado;
                $detSol[$i]['empid']=$emp_id;
                $detSol[$i]['resp_id']=1;//Responsable de firma
                $detSol[$i]['egen_usuario_ingreso']=$usu_id;              
                $detSol[$i]['egen_numero_solicitud']=$this->nuevaSecuencia($con, $esp_id);
                
                
                $dataEsp=$this->consultarDataEspecie($esp_id);
                $dias=$dataEsp[0]['esp_dia_vigencia'];
                $detSol[$i]['egen_fecha_caducidad']=date("Y-m-d",strtotime($fecha_actual."+". $dias ." days")); 
                $detSol[$i]['egen_certificado']=$dataEsp[0]['esp_emision_certificado'];
                $this->generarEspecies($con,$detSol[$i]);
            }
            
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
    
    public function consultarDataEspecie($Ids) {
        $con = \Yii::$app->db_academico;
        $sql = "SELECT esp_id,esp_valor,esp_emision_certificado,esp_dia_vigencia
                    FROM " . $con->dbname . ".especies
                WHERE esp_estado=1 AND esp_estado_logico=1 AND esp_id=:esp_id;";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":esp_id", $Ids, \PDO::PARAM_INT);
        return $comando->queryAll();
    }

    
     private function generarEspecies($con, $data) {
        $data['fpagegen_observacion_id']="";
        
        $sql = "INSERT INTO " . $con->dbname . ".especies_generadas
                    (dsol_id,empid,est_id,resp_id,tra_id,esp_id,uaca_id,mod_id,fpag_id,egen_numero_solicitud,
                     egen_observacion,egen_fecha_solicitud,egen_fecha_aprobacion,egen_fecha_caducidad,egen_estado_aprobacion,
                     egen_ruta_archivo_pago,egen_certificado,egen_usuario_ingreso,egen_estado,egen_fecha_creacion,egen_estado_logico)
                VALUES
                    (:dsol_id,:empid,:est_id,:resp_id,:tra_id,:esp_id,:uaca_id,:mod_id,:fpag_id,:egen_numero_solicitud,
                     :egen_observacion,:egen_fecha_solicitud,CURRENT_TIMESTAMP(),:egen_fecha_caducidad,:egen_estado_aprobacion,
                     :egen_ruta_archivo_pago,:egen_certificado,:egen_usuario_ingreso,1,CURRENT_TIMESTAMP(),1); ";
         

        $command = $con->createCommand($sql);
        $command->bindParam(":dsol_id", $data['dsol_id'], \PDO::PARAM_INT);
        $command->bindParam(":empid", $data['empid'], \PDO::PARAM_INT);
        $command->bindParam(":est_id", $data['est_id'], \PDO::PARAM_INT);
        $command->bindParam(":resp_id", $data['resp_id'], \PDO::PARAM_INT);
        $command->bindParam(":esp_id", $data['esp_id'], \PDO::PARAM_INT);
        $command->bindParam(":tra_id", $data['tra_id'], \PDO::PARAM_INT);
        $command->bindParam(":uaca_id", $data['uaca_id'], \PDO::PARAM_INT);
        $command->bindParam(":mod_id", $data['mod_id'], \PDO::PARAM_INT);
        $command->bindParam(":fpag_id", $data['fpag_id'], \PDO::PARAM_INT);        
        $command->bindParam(":egen_numero_solicitud", $data['egen_numero_solicitud'], \PDO::PARAM_STR);
        $command->bindParam(":egen_observacion", $data['egen_observacion'], \PDO::PARAM_STR);
        $command->bindParam(":egen_fecha_solicitud", $data['egen_fecha_solicitud'], \PDO::PARAM_STR);
        //$command->bindParam(":egen_fecha_aprobacion", $data['egen_fecha_aprobacion'], \PDO::PARAM_STR);
        $command->bindParam(":egen_fecha_caducidad", $data['egen_fecha_caducidad'], \PDO::PARAM_STR);
        $command->bindParam(":egen_estado_aprobacion", $data['egen_estado_aprobacion'], \PDO::PARAM_STR);
        $command->bindParam(":egen_ruta_archivo_pago", $data['egen_ruta_archivo_pago'], \PDO::PARAM_STR);
        $command->bindParam(":egen_certificado", $data['egen_certificado'], \PDO::PARAM_STR);     
        $command->bindParam(":egen_usuario_ingreso", $data['egen_usuario_ingreso'], \PDO::PARAM_STR);
        $command->execute();
    }
    
    public function nuevaSecuencia($con,$esp_id = NULL){
        $numero=0;
        try{
            $sql="SELECT IFNULL(CAST(esp_numero AS UNSIGNED),0) secuencia FROM " . $con->dbname . ".especies 
                    WHERE esp_estado=1 AND esp_estado_logico=1 AND esp_id=:esp_id ";          
            $sql.=" FOR UPDATE ";                        
            $comando = $con->createCommand($sql);
            $comando->bindParam(":esp_id", $emp_id, \PDO::PARAM_INT);    
            $rawData=$comando->queryScalar();   
            if ($rawData !== false){
                //$numero=str_pad((int)$rawData[0]["secuencia"]+1, 9, "0", STR_PAD_LEFT);
                $numero=str_pad((int)$rawData + 1, 9, "0", STR_PAD_LEFT);
                $sql=" UPDATE " . yii::$app->db_facturacion->dbname . ".especies SET esp_numero=:secuencia "
                        . " WHERE esp_estado=1 AND esp_estado_logico=1 AND esp_id=:esp_id ";          
                $comando = $con->createCommand($sql);
                $comando->bindParam(":secuencia", $numero, \PDO::PARAM_STR);
                $comando->bindParam(":esp_id", $esp_id, \PDO::PARAM_INT);                
                $rawData=$comando->execute();         
            }
        }catch(Exception $e){
            Utilities::putMessageLogFile($e);
        }
        return $numero;
    }

}
