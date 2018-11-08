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
class SybaseRetenciones {
    //put your code here
    public function consultarSybCabFacturas() {
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

}
