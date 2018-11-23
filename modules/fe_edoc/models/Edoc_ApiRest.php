<?php

namespace app\modules\fe_edoc\models;

use Yii;
use app\models\Utilities;

class Edoc_ApiRest extends \app\modules\fe_edoc\components\CActiveRecord {
    public $tipoEdoc = "";
    public $cabEdoc = array();
    public $detEdoc = array();
    public $dadcEdoc = array();//dato adiciona
    public $fpagEdoc = array();//forma de pago

    function __construct($arr_params = array()) {
        Utilities::putMessageLogFile($arr_params);
        foreach ($arr_params as $key => $value) {
            if ($key == "tipoedoc")
                $this->tipoEdoc = $value;
            if ($key == "cabedoc")
                $this->cabEdoc = json_decode($value,TRUE);
            if ($key == "detedoc")
                $this->detEdoc = json_decode($value,TRUE);
            if ($key == "dadcedoc")
                $this->dadcEdoc = json_decode($value,TRUE);
            if ($key == "fpagedoc")
                $this->fpagEdoc = json_decode($value,TRUE);
        }
    }

    public function sendEdoc()
    {
        switch ($this->tipoEdoc) {
            case "01"://FACTURAS
                //return array("status" => "OK", "tipoEdoc" => $this->tipoEdoc, "croo_id" => $arr_data);
                return $this->insertarFacturas();
                break;
            case "04"://NOTA DE CREDITO

                break;
            case "05"://NOTA DE DEBITO

                break;
            case "06"://GUIA DE REMISION

                break;
            case "07"://RETENCIONES

                break;

        }

    }
    
    private function insertCabFact($con) {
        $cabFact= $this->cabEdoc;
        Utilities::putMessageLogFile($cabFact);
        $sql = "INSERT INTO " . $con->dbname . ".NubeFactura
               (Ambiente,TipoEmision,Secuencial)VALUES(:Ambiente,:TipoEmision,:Secuencial);";
        
        /*$sql = "INSERT INTO " . $con->db_edoc . ".NubeFactura
               (Ambiente,TipoEmision, RazonSocial, NombreComercial, Ruc,ClaveAcceso,CodigoDocumento, Establecimiento,
                PuntoEmision, Secuencial, DireccionMatriz, FechaEmision, DireccionEstablecimiento, ContribuyenteEspecial,
                ObligadoContabilidad, TipoIdentificacionComprador, GuiaRemision, RazonSocialComprador, IdentificacionComprador,
                TotalSinImpuesto, TotalDescuento, Propina, ImporteTotal, Moneda, SecuencialERP, CodigoTransaccionERP,UsuarioCreador,Estado,FechaCarga) VALUES 
               (:Ambiente,:TipoEmision, :RazonSocial, :NombreComercial, :Ruc,:ClaveAcceso,:CodigoDocumento, :Establecimiento,
                :PuntoEmision, :Secuencial, :DireccionMatriz, :FechaEmision, :DireccionEstablecimiento, :ContribuyenteEspecial,
                :ObligadoContabilidad, :TipoIdentificacionComprador, :GuiaRemision, :RazonSocialComprador, :IdentificacionComprador,
                :TotalSinImpuesto, :TotalDescuento, :Propina, :ImporteTotal, :Moneda, :SecuencialERP, :CodigoTransaccionERP,:UsuarioCreador,1,CURRENT_TIMESTAMP())";*/
        $comando = $con->createCommand($sql);
        

        //$comando->bindParam(":id", $id_docElectronico, PDO::PARAM_INT);
        $comando->bindParam(":Ambiente", $cabFact['TIPOAMBIENTE'], \PDO::PARAM_STR);
        $comando->bindParam(":TipoEmision", $cabFact['TIPOEMISION'], \PDO::PARAM_STR);
        $comando->bindParam(":Secuencial", $cabFact['SECUENCIAL'], \PDO::PARAM_STR);
        
        /*$comando->bindParam(":RazonSocial", $cabFact['SYS_FACTURANC_ID'], PDO::PARAM_STR);
        $comando->bindParam(":NombreComercial", $cabFact['SYS_FACTURANC_ID'], PDO::PARAM_STR);
        $comando->bindParam(":Ruc", $cabFact['RUC_SUJETO'], PDO::PARAM_STR);
        $comando->bindParam(":ClaveAcceso", $cabFact['CLAVEACCESO'], PDO::PARAM_STR);
        $comando->bindParam(":CodigoDocumento", $cabFact['CIA_CODIGO'], PDO::PARAM_STR);
        $comando->bindParam(":Establecimiento", $cabFact['COD_ESTAB'], PDO::PARAM_STR);
        $comando->bindParam(":PuntoEmision", $cabFact['PTOEMI'], PDO::PARAM_STR);
        $comando->bindParam(":Secuencial", $cabFact['SECUENCIAL'], PDO::PARAM_STR);
        $comando->bindParam(":DireccionMatriz", $cabFact['SYS_FACTURANC_ID'], PDO::PARAM_STR);
        $comando->bindParam(":FechaEmision", $cabFact['FECHAEMISION'], PDO::PARAM_STR);
        $comando->bindParam(":DireccionEstablecimiento", $cabFact['SYS_FACTURANC_ID'], PDO::PARAM_STR);
        $comando->bindParam(":ContribuyenteEspecial", $cabFact['CONTRIB_ESPECIAL'], PDO::PARAM_STR);
        $comando->bindParam(":ObligadoContabilidad", $cabFact['OBLIGADOCONTAB'], PDO::PARAM_STR);
        $comando->bindParam(":TipoIdentificacionComprador", $cabFact['TIPOID_SUJETO'], PDO::PARAM_STR);
        $comando->bindParam(":GuiaRemision", $cabFact['NUMGUIA'], PDO::PARAM_STR);
        $comando->bindParam(":RazonSocialComprador", $cabFact['SYS_FACTURANC_ID'], PDO::PARAM_STR);
        $comando->bindParam(":IdentificacionComprador", $cabFact['SYS_FACTURANC_ID'], PDO::PARAM_STR);
        $comando->bindParam(":TotalSinImpuesto", $cabFact['SYS_FACTURANC_ID'], PDO::PARAM_STR);
        $comando->bindParam(":TotalDescuento", $cabFact['TOTALDESC'], PDO::PARAM_STR);
        $comando->bindParam(":Propina", $cabFact['PROPINA'], PDO::PARAM_STR);
        $comando->bindParam(":ImporteTotal", $cabFact['TOTALBRUTO'], PDO::PARAM_STR);
        $comando->bindParam(":Moneda", $cabFact['MONEDA'], PDO::PARAM_STR);
        $comando->bindParam(":SecuencialERP", $cabFact['SECUENCIAL'], PDO::PARAM_STR);
        $comando->bindParam(":CodigoTransaccionERP", $CodigoTransaccionERP, PDO::PARAM_STR);
        $comando->bindParam(":UsuarioCreador", $cabFact['SYS_FACTURANC_ID'], PDO::PARAM_STR);*/

        $comando->execute();
        return $con->getLastInsertID();
        
    }
  
    private function insertarFacturas() {
        $con = Yii::$app->db_edoc;
                

        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction();
        }
        try {
            $idCab= $this->insertCabFact($con);
            Utilities::putMessageLogFile($idCab);
            //$this->insertDetFact($idCab); 
            
           
            if ($trans !== null){
                $trans->commit();
            }
            //return array("status"=>"OK");
            return array("status"=>"OK", "chat_id"=>$idCab, "croo_id"=>'1');
        } catch (\Exception $e) {
            $trans->rollBack();
            //throw $e;
            //return array("status" => "NO_OK");
            return array("status"=>"NO_OK","error"=>$e);
        }
        
    }



    public function sendMessagesToChat() {
        $usu_id      = $this->usu_id;
        $mensaje     = $this->cmes_mensaje;
        $croo_id     = $this->croo_id;
        $fecha_envio = $this->cmes_fecha_envio;
        $fecha_creacion = date("Y-m-d H:i:s");
        $chat_id = 0;
        $con = Yii::$app->db;
        $trans = $con->getTransaction();
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction();
        }
        if($croo_id == 0){// se debe crear el chat para ambos
            $croo_id = $this->croo_id = $this->createChatRoom();
        }
        if(!$this->verifyUserChat()){
            return array("status" => "NO_OK","chat_id"=> 0);
        }
        $sql = "INSERT INTO chat_message(
                        croo_id,
                        usu_id,
                        cmes_mensaje,
                        cmes_fecha_envio,
                        cmes_estado_recibido,
                        cmes_estado_activo,
                        cmes_fecha_creacion,
                        cmes_estado_logico) 
                    VALUES (
                        :croo_id,
                        :usu_id,
                        :mensaje,
                        :fecha_envio,
                        '0',
                        '1',
                        :fecha_creacion,
                        '1'
                    )";
        try {
            $comando = $con->createCommand($sql);
            $comando->bindParam(":usu_id", $usu_id, \PDO::PARAM_INT);
            $comando->bindParam(":croo_id", $croo_id, \PDO::PARAM_INT);
            $comando->bindParam(":mensaje", $mensaje, \PDO::PARAM_STR);
            $comando->bindParam(":fecha_envio", $fecha_envio, \PDO::PARAM_STR);
            $comando->bindParam(":fecha_creacion", $fecha_creacion, \PDO::PARAM_STR);
            $status = $comando->execute();
            if($status){
                $chat_id = $con->getLastInsertID("chat_message");
            }
            if ($trans !== null){
                $trans->commit();
            }
            return array("status"=>"OK", "chat_id"=>$chat_id, "croo_id"=>$croo_id);
        } catch (\Exception $e) {
            $trans->rollBack();
            //throw $e;
            return array("status" => "NO_OK", "chat_id"=> 0);
        }
    }

}