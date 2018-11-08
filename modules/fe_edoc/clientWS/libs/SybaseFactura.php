<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SybaseFactura
 *
 * @author Byron
 */
include_once "libs/http.php";
include('Global.php');
include('cls_BaseSybase.php');
include('cls_Base.php');
class SybaseFactura {
    private $tipoDoc='01';//Tipo Doc SRI
    //put your code here
    public function consultarSybCabFacturasXXX() {
        GLOBAL  $limit;
        $obj_con = new cls_BaseSybase();
        $pdo = $obj_con->conexionSybase();
        try {
            $sql = "SELECT TOP $limit * FROM DBA.TCIDE_FACTURANC_TEMP WHERE estado_proceso=0 ";
            $comando = $pdo->prepare($sql);
            $comando->execute();
            $rows = $comando->fetchAll(PDO::FETCH_ASSOC);
            if (count($rows) > 0) {
                foreach ($rows as $row) {
                    //putMessageLogFile($row['RISE'] . "<br>");
                    $this->consultarSybDetFacturas($pdo, $row['SYS_FACTURANC_ID']);
                    $this->consultarSybDatAdiFacturas($pdo, $row['SYS_FACTURANC_ID']);
                }
                return TRUE;
            } else {
                return FALSE;
            }
        } catch (PDOException $e) {
            putMessageLogFile("Error: " . $e);
            return FALSE;
        }
    }
    
    private function consultarSybDetFacturas($pdo,$Ids) {
        $sql = "SELECT * FROM DBA.TCIDE_FACTURANC_DET WHERE SYS_FACTURANC_ID=:id ORDER BY ID_SECUENCIA ";
        $comando = $pdo->prepare($sql);
        $comando->bindParam(":id", $Ids, PDO::PARAM_INT);
        $comando->execute();
        $rows = $comando->fetchAll(PDO::FETCH_ASSOC);
        if (count($rows) > 0) {
            foreach ($rows as $row) {
                putMessageLogFile($row['CODIGOPRINCIPAL'] . "<br>");
                //putMessageLogFile($row['COD_ESTAB'] . "<br>");
            }
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    private function consultarSybDatAdiFacturas($pdo,$Ids) {
        $sql = "SELECT * FROM DBA.TCIDE_FACTURANC_DATADD WHERE SYS_FACTURANC_ID=:id ORDER BY SECUENCIA ";
        $comando = $pdo->prepare($sql);
        $comando->bindParam(":id", $Ids, PDO::PARAM_INT);
        $comando->execute();
        $rows = $comando->fetchAll(PDO::FETCH_ASSOC);
        if (count($rows) > 0) {
            foreach ($rows as $row) {
                putMessageLogFile($row['VALORCAMPO'] . "<br>");
                //putMessageLogFile($row['COD_ESTAB'] . "<br>");
            }
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    /***********************************************************************************/
    /***********************************************************************************/
    /*INSERTAR DATOS EN APP WEB */
    
    public function consultarSybCabFacturas($pdo) {
        GLOBAL  $limit;
        $rawData = array();
        //$obj_con = new cls_BaseSybase();
        //$pdo = $obj_con->conexionSybase();
        try {
            $sql = "SELECT TOP $limit * FROM DBA.TCIDE_FACTURANC_TEMP WHERE estado_proceso=0 ";
            $comando = $pdo->prepare($sql);
            $comando->execute();
            $rows = $comando->fetchAll(PDO::FETCH_ASSOC);            
            if (count($rows) > 0) {
                foreach ($rows as $row) {
                    $rawData[] = $row;
                    //putMessageLogFile($row);
                }
            }
            return $rawData;
        } catch (PDOException $e) {
            putMessageLogFile("Error: " . $e);
            return $rawData;
        }
    }
    
    
     public function insertarFacturas() {
        $codDoc=$this->tipoDoc;//Documento Factura
        $objSyb = new cls_BaseSybase();
        $conSyb = $objSyb->conexionSybase();
        try {
            $cabFact = $this->consultarSybCabFacturas($conSyb);
            for ($i = 0; $i < sizeof($cabFact); $i++) {
                  //putMessageLogFile($cabFact[$i]['SYS_FACTURANC_ID']);
//                $ClaveAcceso=$this->InsertarCabFactura($con,$obj_con,$cabFact, $empresaEnt,$codDoc, $i);
//                $idCab = $con->insert_id;
                //$idCab=$this->InsertarCabFactura($con,$cabFact[$i],$codDoc);
                $detFact = array();
                $response = Http::connect($WS_HOST, $WS_PORT)->doPost($WS_URI_FAC, array('cabecera' => $cabFact, 'detalle' => $detFact));
                $arr_response = json_decode($response, true);
                if($arr_response["state"] == 200 && $arr_response["error"] == false){
                    putMessageLogFile("OK");
                    // actualizar registro en sysbase
                }else{
                    putMessageLogFile("ERROR");
                    // no actualizar registro en sysbase y enviar mail de error a sysadmin
                }
                 
//                $detFact=$this->buscarDetFacturas($cabFact[$i]['TIP_NOF'],$cabFact[$i]['NUM_NOF']);
//                $this->InsertarDetFactura($con,$obj_con,$cabFact[$i]['POR_IVA'],$detFact,$idCab);
//                $this->InsertarFacturaFormaPago($con, $obj_con, $i, $cabFact, $idCab);//Inserta Forma de Pago 8 SEP 2016
//                $this->InsertarFacturaDatoAdicional($con,$obj_con,$i,$cabFact,$idCab);
//                $cabFact[$i]['ID_DOC']=$idCab;//Actualiza el IDs Documento Autorizacon SRI
//                $cabFact[$i]['CLAVE']=$ClaveAcceso;
            }
            //$this->actualizaErpCabFactura($cabFact);
            //echo "ERP Actualizado";
            return true;
        } catch (PDOException $e) {
            putMessageLogFile("Error: " . $e);
            return false;
        }   
    }
    
    private function InsertarCabFactura($con,$cabFact,$codDoc) {
        GLOBAL $dbIntermedia;
        $CodigoTransaccionERP='FP';
        //putMessageLogFile($cabFact['SYS_FACTURANC_ID']);
        
        /*$valida = new VSValidador();
        $tip_iden = $valida->tipoIdent($objEnt[$i]['CED_RUC']);
        $Secuencial = $valida->ajusteNumDoc($objEnt[$i]['NUM_NOF'], 9);
        //$GuiaRemi=$valida->ajusteNumDoc($objEnt[$i]['GUI_REM'],9);
        $GuiaRemi = (strlen($objEnt[$i]['GUI_REM']) > 0) ? $objEmp['Establecimiento'] . '-' . $objEmp['PuntoEmision'] . '-' . $valida->ajusteNumDoc($objEnt[$i]['GUI_REM'], 9) : '';
        $ced_ruc = ($tip_iden == '07') ? '9999999999999' : $objEnt[$i]['CED_RUC'];
        /* Datos para Genera Clave */
        //$tip_doc,$fec_doc,$ruc,$ambiente,$serie,$numDoc,$tipoemision
        /*$objCla = new VSClaveAcceso();
        $serie = $objEmp['Establecimiento'] . $objEmp['PuntoEmision'];
        $fec_doc = date("Y-m-d", strtotime($objEnt[$i]['FEC_VTA']));
        
        $ClaveAcceso =$objEnt[$i]['ClaveAcceso']; //$objCla->claveAcceso($codDoc, $fec_doc, $objEmp['Ruc'], $objEmp['Ambiente'], $serie, $Secuencial, $objEmp['TipoEmision']);
        /** ********************** */
        /*$nomCliente=str_replace("'","`",$objEnt[$i]['NOM_CLI']);// Error del ' en el Text se lo Reemplaza `
        //$nomCliente=$objEnt[$i]['NOM_CLI'];// Error del ' en el Text
        $TotalSinImpuesto=floatval($objEnt[$i]['BAS_IVA'])+floatval($objEnt[$i]['BAS_IV0']);//Cambio por Ajuste de Valores Byron Diferencias*/
        
         /*{"SYS_FACTURANC_ID":"19770","CIA_CODIGO":"01","TIP_DOC_VEN":"EN8","NUM_DOC_VE":"1769","RUC_SUJETO":"0931574438",
          "FECHAEMISION":"2018-08-25","CONTRIB_ESPECIAL":"0","OBLIGADOCONTAB":"SI","RISE":"Contribuyente Regimen Simplificado Rise",
          "TIPOID_SUJETO":"05","RAZONSOCIAL_SUJETO":"TORRES VERA KAREN SARAY 4","NUMGUIA":null,"TOTALBRUTO":"387.80","TOTALDESC":"0.00",
          "IVA_PORCENTAJE":"0.00","IVA_CODIGO":"0","IVA_VALOR":"0.00","ICE_BASE":"0.00","ICE_PORCENTAJE":"0.00","ICE_VALOR":"0.00","ICE_CODIGO":"0",
          "PROPINA":"0.00","TOTALDOC":"387.80","MAILSUJETO":"skaren9425@hotmail.com","MONEDA":"DOLAR","TIPCOMP_MODIFICA":"01",
          "NUMCOMP_MODIFICA":"001-002-000019045","FECHAEMISION_SUSTENTO":"2018-08-25","VALORDOC_MODIFICA":"387.80","ANIO_FISCAL":"2018","PROCESADA":"0",
          "FECHAHORA_PROCESA":"2018-08-25 12:45:08.011000","APROBADA":"0","MENSAJE":" ","DIGITOVERIFICADOR":"0","TIPOCOMPROBANTE":"04","TIPOAMBIENTE":"2",
          "COD_ESTAB":"001","PTOEMI":"002","SECUENCIAL":"000001769","CODIGONUMERICO_NORMAL":null,"CODIGONUMERICO_CONTING":null,"TIPOEMISION":null,
          "FECHAHORA_AUTORIZA":"2018-08-25 12:45:06.000000","AUTORIZACION":"2508201804099216491300120010020000017690001975310",
          "MOTIVO_DEVOLUCION":"CAMBIO DE MATERIA - AUTORIZA SEC GNRAL","CLAVEACCESO":"2508201804099216491300120010020000017690001975310",
          "MSJ_IDENTIFICADOR":" ","MSJ_INFORMACIONADICIONAL":" ","MSJ_TIPO":" ","codigonumerico":"19784","direcc_comprador":"JULIAN CORONEL 505 Y BOYACA",
          "ubicacion":"0","contador_envios":"2","ESTADO":"A","fecha_ult_intento":"2018-08-25 12:50:55.375000","recibida":"S","estado_proceso":"0"}*/
        
        
        $sql = "INSERT INTO " . $dbIntermedia . ".NubeFactura
               (Ambiente,TipoEmision, RazonSocial, NombreComercial, Ruc,ClaveAcceso,CodigoDocumento, Establecimiento,
                PuntoEmision, Secuencial, DireccionMatriz, FechaEmision, DireccionEstablecimiento, ContribuyenteEspecial,
                ObligadoContabilidad, TipoIdentificacionComprador, GuiaRemision, RazonSocialComprador, IdentificacionComprador,
                TotalSinImpuesto, TotalDescuento, Propina, ImporteTotal, Moneda, SecuencialERP, CodigoTransaccionERP,UsuarioCreador,Estado,FechaCarga) VALUES 
               (:Ambiente,:TipoEmision, :RazonSocial, :NombreComercial, :Ruc,:ClaveAcceso,:CodigoDocumento, :Establecimiento,
                :PuntoEmision, :Secuencial, :DireccionMatriz, :FechaEmision, :DireccionEstablecimiento, :ContribuyenteEspecial,
                :ObligadoContabilidad, :TipoIdentificacionComprador, :GuiaRemision, :RazonSocialComprador, :IdentificacionComprador,
                :TotalSinImpuesto, :TotalDescuento, :Propina, :ImporteTotal, :Moneda, :SecuencialERP, :CodigoTransaccionERP,:UsuarioCreador,1,CURRENT_TIMESTAMP())";
        $comando = $con->prepare($sql);
        //$comando->bindParam(":id", $id_docElectronico, PDO::PARAM_INT);
        $comando->bindParam(":Ambiente", $cabFact['TIPOAMBIENTE'], PDO::PARAM_STR);
        $comando->bindParam(":TipoEmision", $cabFact['TIPOEMISION'], PDO::PARAM_STR);
        $comando->bindParam(":RazonSocial", $cabFact['SYS_FACTURANC_ID'], PDO::PARAM_STR);
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
        $comando->bindParam(":UsuarioCreador", $cabFact['SYS_FACTURANC_ID'], PDO::PARAM_STR);

        $comando->execute();
        return $con->lastInsertId();

    }
   
       

}
