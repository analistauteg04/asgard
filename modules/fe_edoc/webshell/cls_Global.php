<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cls_Global
 *
 * @author root
 */
//include('cls_Base.php');//para HTTP
class cls_Global {
    //put your code here
    public static $emp_id='1';//Empresa
    public static $est_id='1';//Establecimiento
    public static $pemi_id='1';//Punto Emision
    public static $ambt_id='1';//Ambiente de Pruebas por Defecto =1 =>2 Produccion (cambiar en caso de Pruebas)
    //public static $IdsUsu='1';//Valor por defecto(Alimenta al Autorizar el Documento)
    var $consumidorfinal='9999999999';
    var $dateStartFact='2019-02-12';
    var $datebydefault='d-m-Y';
    public static $dateXML = "d/m/Y";
    public $decimalPDF=2;
    public $SepdecimalPDF='.';
    var $limitEnv=3;
    var $limitEnvMail=1;
    public static $limitEnvAUT=2;
    var $IVAdefault=12;//Valor de Iva por Defecto en Textos
    var $Author="UTEG";
    var $rutaPDF="/home/EDOC/DOCPDF/";
    var $rutaXML="/home/EDOC/AUTORIZADO/";
    var $rutaLink='http://edoc.uteg.com';//Ruta donde se consultan los documentos
    var $tipoFacLocal='F4';
    var $tipoGuiLocal='GR';
    var $tipoRetLocal='RT';
    var $tipoNcLocal='NC';
    var $tipoNdLocal='ND';
    //FACTURA ELECTRONICA
    
    public static $seaDocXml = '/home/EDOC/GENERADO/';
    public static $seaDocFact = '/home/EDOC/FIRMADO/FACTURAS/';
    public static $seaDocRete = '/home/EDOC/FIRMADO/RETENCIONES/';
    public static $seaDocNc = '/home/EDOC/FIRMADO/NC/';
    public static $seaDocNd = '/home/EDOC/FIRMADO/ND/';
    public static $seaDocGuia = '/home/EDOC/FIRMADO/GUIAS/';
    public static $seaDocAutFact = '/home/EDOC/AUTORIZADO/FACTURAS/';
    public static $seaDocAutRete = '/home/EDOC/AUTORIZADO/RETENCIONES/';
    public static $seaDocAutNc = '/home/EDOC/AUTORIZADO/NC/';
    public static $seaDocAutNd = '/home/EDOC/AUTORIZADO/ND/';
    public static $seaDocAutGuia = '/home/EDOC/AUTORIZADO/GUIAS/';


    //function __construct() {  }
    
    public function messageSystem($status,$error,$op,$message,$data) {
        $arroout["status"] = $status;
        $arroout["error"] = $error;
        $arroout["message"] = $message;
        $arroout["data"] = $data;
        return $arroout;
    }
    
    public function buscarCedRuc($cedRuc) {
        try {
            $obj_con = new cls_Base();
            $conCont = $obj_con->conexionIntermedio();
            $rawData = array();
            $cedRuc=trim($cedRuc);            
            $sql = "SELECT A.per_id Ids,A.per_nombre RazonSocial,IFNULL(B.usu_correo,'') CorreoPer
                        FROM " . $obj_con->BdIntermedio . ".persona A
                                INNER JOIN " . $obj_con->BdIntermedio . ".usuario B
                                        ON A.per_id=B.per_id AND B.usu_est_log=1
                WHERE A.per_ced_ruc='$cedRuc' AND A.per_est_log=1 ";
            //echo $sql;
            $sentencia = $conCont->query($sql);
            if ($sentencia->num_rows > 0) {
                //Retorna Solo 1 Registro Asociado
                $rawData=$this->messageSystem('OK',null,null,null, $sentencia->fetch_assoc());  
            }else{
                $rawData=$this->messageSystem('NO_OK',null,null,null,null);  
            }
            $conCont->close();
            return $rawData;
        } catch (Exception $e) {
            //echo $e;
            $conCont->close();
            return $this->messageSystem('NO_OK', $e->getMessage(), null, null, null);
        }
    }
    
    public function insertarUsuarioPersona($obj_con,$cabDoc,$DBTable,$i) {  
        //$obj_con = new cls_Base();
        $conUse = $obj_con->conexionIntermedio();
        try {
            $this->InsertarPersona($conUse,$cabDoc,$obj_con,$i);
            $IdPer = $conUse->insert_id;
            $keyUser=$this->InsertarUsuario($conUse, $cabDoc,$obj_con, $IdPer,$DBTable,$i);
            $conUse->commit();
            $conUse->close();
            return $this->messageSystem('OK', null, null, null, $keyUser);
        } catch (Exception $e) {
            $conUse->rollback();
            $conUse->close();
            //throw $e;
            return $this->messageSystem('NO_OK', $e->getMessage(), null, null, null);
        }   
    }
    private function InsertarPersona($con, $objEnt,$obj_con,$i) {
        $sql = "INSERT INTO " . $obj_con->BdIntermedio . ".persona
                (per_ced_ruc,per_nombre,per_genero,per_est_log,per_fec_cre)VALUES
                ('" . $objEnt[$i]['CedRuc'] . "','" . $objEnt[$i]['RazonSoc'] . "','M','1',CURRENT_TIMESTAMP()) ";
        $command = $con->prepare($sql);
        $command->execute();
    }
    
    private function InsertarUsuario($con, $objEnt,$obj_con, $IdPer,$DBTable,$i) {
        $emp_id=cls_Global::$emp_id;
        $usuNombre = $objEnt[$i]['CedRuc'];
        $RazonSoc = $objEnt[$i]['RazonSoc'];
        //$correo = ($objEnt[$i]['CorreoPer']<>'')?$objEnt[$i]['CorreoPer']:$this->buscarCorreoERP($obj_con,$usuNombre,$DBTable);//Consulta Tabla Clientes
        $correo = ($objEnt[$i]['CorreoPer']<>'')?$objEnt[$i]['CorreoPer']:'';//Consulta Tabla Clientes
        $pass =$this->generarCodigoKey(8);// $objEnt[$i]['CedRuc'];
        //Inserta Datos Tabla USUARIO
        $sql = "INSERT INTO " . $obj_con->BdIntermedio . ".usuario
                (per_id,usu_nombre,usu_alias,usu_correo,usu_password,usu_est_log,usu_fec_cre)VALUES
                ($IdPer,'$usuNombre','$RazonSoc','$correo',MD5('$pass'),'1',CURRENT_TIMESTAMP()) ";
        $command = $con->prepare($sql);
        $command->execute();
        
        //Inserta Datas en la tabla USUARIO_EMPRESA con Su Rol
        $UsuId = $con->insert_id;
        //$RolId = $this->retornaRolUser($DBTable);//Retorna el Rol segunta tabla Roles
        /*
         * OPCIONAL SI SE NECESITA CONFIGURAR USUAIRO EMPRESA PARA EL ACCESO
        $sql = "INSERT INTO " . $obj_con->BdIntermedio . ".usuario_empresa
                (emp_id,usu_id,rol_id,est_log)VALUES
                ($emp_id,$UsuId,$RolId,1) ";
        $command = $con->prepare($sql);
        $command->execute();*/
        
        //Retorna el Pass y el Correo Guardado
        $arroout["Clave"] = $pass;
        $arroout["CorreoPer"] = $correo;
        return $arroout;
    }
    //Retrona ROL SEGUN TABLA ROLES
    private function retornaRolUser($tabla) {
        $IdsRol = 6; //ROL DE USER NORMAL POR DEFECTO
        switch ($tabla) {
            Case "MG0031":
                $IdsRol = 4; //CLIENTE
                break;
            Case "MG0032":
                $IdsRol = 5; //PROVEEDOR
                break;
            default:
                $IdsRol = 6; //USUARIO NORMAL
        }
        return $IdsRol;
    }

    //Genera un Codigo para Pass
    private function generarCodigoKey($longitud) {
        $key = '';
        $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
        $max = strlen($pattern) - 1;
        for ($i = 0; $i < $longitud; $i++)
            $key .= $pattern{mt_rand(0, $max)};
        return $key;
    }
    //Consulta en la Tablas del ERP si existe un correo
    private function buscarCorreoERP($obj_con,$CedRuc, $DBTable) {
        //$obj_con = new cls_Base();
        //Nota debe extraer los Correos del SIstema ERP
        $conCont = $obj_con->conexionIntermedio();
        $rawData='';
        $sql = "SELECT IFNULL(CORRE_E,'') CorreoPer  FROM " . $obj_con->BdIntermedio . ".$DBTable "
                . "WHERE CED_RUC='$CedRuc' AND CORRE_E<>'' ";
        //echo $sql;
        $sentencia = $conCont->query($sql);
        if ($sentencia->num_rows > 0) {
            $fila = $sentencia->fetch_assoc();
            $rawData= str_replace(",", ";", $fila["CorreoPer"]);//Remplaza las "," por el ";" Para poder enviar.
        }
        $conCont->close();
        return $rawData;
    }
    
    public function actualizaEnvioMailRAD($docDat,$tipDoc) {
        $obj_con = new cls_Base();
        //$conCont = $obj_con->conexionVsRAd();
        $conCont = $obj_con->conexionIntermedio();
        try {
            for ($i = 0; $i < sizeof($docDat); $i++) {
                $Estado=$docDat[$i]['EstadoEnv'];//Contine el IDs del Tabla Autorizacion
                $Ids=$docDat[$i]['Ids'];
                switch ($tipDoc) {
                    Case "FA"://FACTURAS
                        $sql = "UPDATE " . $obj_con->BdIntermedio . ".NubeFactura SET EstadoEnv='$Estado' WHERE IdFactura='$Ids';";
                        break;
                    Case "GR"://GUIAS DE REMISION
                        $sql = "UPDATE " . $obj_con->BdIntermedio . ".NubeGuiaRemision SET EstadoEnv='$Estado' WHERE IdGuiaRemision='$Ids';";
                        break;
                    Case "RT"://RETENCIONES
                        $sql = "UPDATE " . $obj_con->BdIntermedio . ".NubeRetencion SET EstadoEnv='$Estado' WHERE IdRetencion='$Ids';";
                        break;
                    Case "NC"://NOTAS DE CREDITO
                        $sql = "UPDATE " . $obj_con->BdIntermedio . ".NubeNotaCredito SET EstadoEnv='$Estado' WHERE IdNotaCredito='$Ids';";
                        break;
                    Case "ND"://NOTAS DE DEBITO
                        //$sql = "UPDATE " . $obj_con->BdIntermedio . ".NubeFactura SET EstadoEnv='$Estado' WHERE IdFactura='$Ids';";
                        break;
                }
                $command = $conCont->prepare($sql);
                $command->execute();
            }
            $conCont->commit();
            $conCont->close();
            return true;
        } catch (Exception $e) {
            $conCont->rollback();
            $conCont->close();
            throw $e;
            return false;
        }
    }
    
    public function limpioCaracteresXML($cadena) {
        //$search = array("<", ">", "&", "'","ñ","Ñ");
        //$replace = array("&lt;", "&gt", "&amp;", "&apos","n","N");
        //$final = str_replace($search, $replace, $cadena);
        //return $final;
        
        $String = trim($cadena);
        
        $String = str_replace(array('á','à','â','ã','ª','ä'),"a",$String);
        $String = str_replace(array('Á','À','Â','Ã','Ä'),"A",$String);
        $String = str_replace(array('Í','Ì','Î','Ï'),"I",$String);
        $String = str_replace(array('í','ì','î','ï'),"i",$String);
        $String = str_replace(array('é','è','ê','ë'),"e",$String);
        $String = str_replace(array('É','È','Ê','Ë'),"E",$String);
        $String = str_replace(array('ó','ò','ô','õ','ö','º'),"o",$String);
        $String = str_replace(array('Ó','Ò','Ô','Õ','Ö'),"O",$String);
        $String = str_replace(array('ú','ù','û','ü'),"u",$String);
        $String = str_replace(array('Ú','Ù','Û','Ü'),"U",$String);
        
        $String = str_replace(array('[','^','´','`','¨','~',']'),"",$String);
  
        //Implementado Byron 14-12-2016
        $String = str_replace("<","&lt;",$String);
        $String = str_replace(">","&gt",$String);
        $String = str_replace("&","&amp;",$String);
        //$String = str_replace("&","&#38;",$String);
        $String = str_replace("'","&apos",$String);
        
        $String = str_replace("ç","c",$String);
        $String = str_replace("Ç","C",$String);
        $String = str_replace("ñ","n",$String);
        $String = str_replace("Ñ","N",$String);
        $String = str_replace("Ý","Y",$String);
        $String = str_replace("ý","y",$String);
        
        

        $String = str_replace("&aacute;","a",$String);
        $String = str_replace("&Aacute;","A",$String);
        $String = str_replace("&eacute;","e",$String);
        $String = str_replace("&Eacute;","E",$String);
        $String = str_replace("&iacute;","i",$String);
        $String = str_replace("&Iacute;","I",$String);
        $String = str_replace("&oacute;","o",$String);
        $String = str_replace("&Oacute;","O",$String);
        $String = str_replace("&uacute;","u",$String);
        $String = str_replace("&Uacute;","U",$String);
        
        return $String;
        
    }
    
    public function limpioCaracteresSQL($cadena) {
        $search = array("'");
        $replace = array("`");
        $final = str_replace($search, $replace, $cadena);
        return $final;
    }
    
    public static function retornaTarifaDelIva($tarifa) {
         //TABLA 18 FICHA TECNICA
        $codigo=0;
        switch (floatval($tarifa)) {
            Case 0:
                $codigo=0;
                break;
            Case 12:
                $codigo=2;
                break;
            Case 14:
                $codigo=3;
                break;
            Case 6:
                $codigo=6;//NO OBJETO DE IVA
                break;
            default:
                $codigo=7;//EXEPTO DE IVA
        }
        return $codigo;
     }
     
     public static function buscarDocAutorizacion($tipDoc) {
        try {
            $obj_con = new cls_Base();
            $obj_var = new cls_Global();
            $conCont = $obj_con->conexionIntermedio();
            $rawData = array();
            $fechaIni=$obj_var->dateStartFact;
            $limitEnv=$obj_var->limitEnv;
            switch ($tipDoc) {
                    Case "FA"://FACTURAS                        
                        $sql = "SELECT IdFactura Ids,ClaveAcceso,AutorizacionSri 
                                        FROM " . $obj_con->BdIntermedio . ".NubeFactura 
                                WHERE Estado=2 AND DATE(FechaCarga)>='$fechaIni' LIMIT $limitEnv ";                        
                        break;
                    Case "GR"://GUIAS DE REMISION
                        $sql = "UPDATE " . $obj_con->BdIntermedio . ".NubeGuiaRemision SET EstadoEnv='$Estado' WHERE IdGuiaRemision='$Ids';";
                        break;
                    Case "RT"://RETENCIONES
                        $sql = "UPDATE " . $obj_con->BdIntermedio . ".NubeRetencion SET EstadoEnv='$Estado' WHERE IdRetencion='$Ids';";
                        break;
                    Case "NC"://NOTAS DE CREDITO
                        $sql = "UPDATE " . $obj_con->BdIntermedio . ".NubeNotaCredito SET EstadoEnv='$Estado' WHERE IdNotaCredito='$Ids';";
                        break;
                    Case "ND"://NOTAS DE DEBITO
                        //$sql = "UPDATE " . $obj_con->BdIntermedio . ".NubeFactura SET EstadoEnv='$Estado' WHERE IdFactura='$Ids';";
                        break;
                }
            
            //echo $sql;
            $sentencia = $conCont->query($sql);
            if ($sentencia->num_rows > 0) {
                while ($fila = $sentencia->fetch_assoc()) {//Array Asociativo
                    $rawData[] = $fila;
                }
            }
            $conCont->close();
            return $rawData;
        } catch (Exception $e) {
            echo $e;
            $conCont->close();
            return false;
        }
    }
    
    public static function putMessageLogFile($message) {
        $rutaLog= __DIR__ . '/log/Errorlog.log';//$this->logfile;
        if (is_array($message))
            $message = json_encode($message);
        $message = date("Y-m-d H:i:s") . " " . $message . "\n";
        if (!is_dir(dirname($rutaLog))) {
            mkdir(dirname($rutaLog), 0777, true);
            chmod(dirname($rutaLog), 0777);
            touch($rutaLog);
        }
        //se escribe en el fichero
        file_put_contents($rutaLog, $message, FILE_APPEND | LOCK_EX);
    }
    
    public static function formatoDecXML($valor){
        $obj_var = new cls_Global();
        return number_format($valor, $obj_var->decimalPDF, $obj_var->SepdecimalPDF, '');
    }
    

}
