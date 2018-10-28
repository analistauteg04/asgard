<?php

$service  = "uteg-fe";
$servidor = "localhost";
$database = "uteg";
$usuario  = "dba";
$clave    = "sql";
$dns      = "sybase:host=$servidor;dbname=$database";
$logFile  = "/var/log/$service.log";

echo "Salida: " . json_endode(test());

function test() {
    GLOBAL $dns, $usuario, $clave;
    $pdo = new PDO($dns, $usuario, $clave);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $id = "19782";
    try {
        $sql = "SELECT 
                    * 
                FROM 
                    DBA.TCIDE_FACTURANC_TEMP 
                WHERE 
                    SYS_FACTURANC_ID = :id";
        $comando = $pdo->prepare($sql);
        $comando->bindParam(":id", $id, PDO::PARAM_INT);
        $comando->execute();
        $row = $comando->fetch();
        if (count($row) > 0) {
            return $row["TCIDE_FACTURANC_TEMP"];
        } else {
            putMessageLogFile("Error: ");
            return FALSE;
        }
    } catch (PDOException $e) {
        return FALSE;
    }
}
/*
function actualizarEstadoDocXML($id_docElectronico, $file_aut) {
    GLOBAL $dns, $usuario, $clave;
    $pdo = new PDO($dns, $usuario, $clave);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->beginTransaction();
    $fecha_modificacion = date("Y-m-d H:i:s");
    try {
        $sql = "UPDATE 
                    DOCUMENTO_XML 
                SET 
                    DXML_FECHA_MODIFICACION = :fecha, 
                    DXML_XML_AUTORIZADO = :file_aut 
                WHERE 
                    DELE_ID = :id AND 
                    DXML_ESTADO_LOGICO=1";
        $comando = $pdo->prepare($sql);
        $comando->bindParam(":id", $id_docElectronico, PDO::PARAM_INT);
        $comando->bindParam(":fecha", $fecha_modificacion, PDO::PARAM_STR);
        $comando->bindParam(":file_aut", $file_aut, PDO::PARAM_STR);
        $resultado = $comando->execute();
        if ($resultado) {
            $pdo->commit();
            return TRUE;
        } else {
            $pdo->rollBack();
            putMessageLogFile("No se pudo actualizar el DOCUMENTO_XML el ESTADO $tipoDoc en la Base de datos. Datos recibidos -> docId: $id_docElectronico, Archivo Autorizado: $file_aut");
            return FALSE;
        }
    } catch (PDOException $e) {
        $pdo->rollBack();
        putMessageLogFile("Error: No se pudo registrar el ESTADO $tipoDoc en la Base de datos. Datos recibidos -> docId: $id_docElectronico, Archivo Autorizado: $file_aut");
    }
    return FALSE;
}
*/

function putMessageLogFile($message) {
    GLOBAL $logFile;
    if (is_array($message))
        $message = json_encode($message);
    $message = date("Y-m-d H:i:s") . " " . $message . "\n";
    file_put_contents($logFile, $message, FILE_APPEND | LOCK_EX);
}

?>