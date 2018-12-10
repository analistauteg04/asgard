<?php
/**
 * This is the model class for table "NubeFactura".
 *
 * The followings are the available columns in table 'NubeFactura':
 * @property string $IdFactura
 * @property string $AutorizacionSRI
 * @property string $FechaAutorizacion
 * @property integer $Ambiente
 * @property integer $TipoEmision
 * @property string $RazonSocial
 * @property string $NombreComercial
 * @property string $Ruc
 * @property string $ClaveAcceso
 * @property string $CodigoDocumento
 * @property string $Establecimiento
 * @property string $PuntoEmision
 * @property string $Secuencial
 * @property string $DireccionMatriz
 * @property string $FechaEmision
 * @property string $DireccionEstablecimiento
 * @property string $ContribuyenteEspecial
 * @property string $ObligadoContabilidad
 * @property string $TipoIdentificacionComprador
 * @property string $GuiaRemision
 * @property string $RazonSocialComprador
 * @property string $IdentificacionComprador
 * @property string $TotalSinImpuesto
 * @property string $TotalDescuento
 * @property string $Propina
 * @property string $ImporteTotal
 * @property string $Moneda
 * @property string $UsuarioCreador
 * @property string $EmailResponsable
 * @property string $EstadoDocumento
 * @property string $DescripcionError
 * @property string $CodigoError
 * @property string $DirectorioDocumento
 * @property string $NombreDocumento
 * @property integer $GeneradoXls
 * @property string $SecuencialERP
 * @property string $CodigoTransaccionERP
 * @property integer $Estado
 * @property string $FechaCarga
 * @property string $IdLote
 *
 * The followings are the available model relations:
 * @property NubeDatoAdicionalFactura[] $nubeDatoAdicionalFacturas
 * @property NubeDetalleFactura[] $nubeDetalleFacturas
 * @property NubeFacturaImpuesto[] $nubeFacturaImpuestos
 */
/*
    Nota Importante: Se procedio a quitar el utf8_encode(data) EN Razon Social y Descricion o detalle Adicional
 *  ya que son propenso a caracteres especiales de los cuales la base ya los envia con la codificacion Real UTF-8 y ya 
 *  no es necesario convertiros. por lo tanto se somete a pruebas para ver resultados
 * */
namespace app\modules\fe_edoc\models;
use Yii;
use app\models\Utilities;
use \yii\data\ActiveDataProvider;
use \yii\data\ArrayDataProvider;
use yii\base\Exception;
use app\modules\fe_edoc\Module as fe_edoc;
class NubeFactura extends \app\modules\fe_edoc\components\CActiveRecord {
    
    private $tipoDoc='01';
    private function buscarFacturas($opcion) {
        $conCont = Yii::$app->db_edoc;
        $rawData = array();
        $fechaIni = Yii::$app->params['dateStartFact'];
        $limitEnv = fe_edoc::params('limitEnv');//Yii::$app->params['limitEnv'];
        //$sql = "SELECT TIP_NOF,CONCAT(REPEAT('0',9-LENGTH(RIGHT(NUM_NOF,9))),RIGHT(NUM_NOF,9)) NUM_NOF,
        switch ($opcion['OP']) {
            case '1':
                $Documento=$opcion['NUM_DOC'];
                $TipoDoc=$opcion['NUM_DOC'];
                $sql = "SELECT TIP_NOF, NUM_NOF,
                        CED_RUC,NOM_CLI,FEC_VTA,DIR_CLI,VAL_BRU,POR_DES,VAL_DES,VAL_FLE,BAS_IVA,
                        BAS_IV0,POR_IVA,VAL_IVA,VAL_NET,POR_R_F,VAL_R_F,POR_R_I,VAL_R_I,GUI_REM,0 PROPINA,
                        USUARIO,LUG_DES,NOM_CTO
                    FROM " . $conCont->dbname . ".VC010101 
                WHERE NUM_NOF LIKE '%$Documento' AND TIP_NOF='$TipoDoc' ";
                break;
            case 'RETENCION':
                $sql = "SELECT TIP_NOF, NUM_NOF,
                        CED_RUC,NOM_CLI,FEC_VTA,DIR_CLI,VAL_BRU,POR_DES,VAL_DES,VAL_FLE,BAS_IVA,
                        BAS_IV0,POR_IVA,VAL_IVA,VAL_NET,POR_R_F,VAL_R_F,POR_R_I,VAL_R_I,GUI_REM,0 PROPINA,
                        USUARIO,LUG_DES,NOM_CTO
                    FROM " . $conCont->dbname . ".VC010101 
                WHERE IND_UPD='L' AND FEC_VTA>'$fechaIni' AND ENV_DOC='0' LIMIT $limitEnv";
                break;
            default:
            //$IdGuiaRemision=$ids;
        }
        //echo $sql;
        $rawData = $conCont->createCommand($sql)->queryAll();
        return $rawData;
    }
    private function buscarDetFacturas($tipDoc, $numDoc) {
        $conCont = Yii::$app->db_edoc;
        $rawData = array();
        $sql = "SELECT TIP_NOF,NUM_NOF,FEC_VTA,COD_ART,NOM_ART,CAN_DES,P_VENTA,
                        T_VENTA,VAL_DES,I_M_IVA,VAL_IVA
                    FROM " . $conCont->dbname . ".VD010101
                WHERE TIP_NOF='$tipDoc' AND NUM_NOF='$numDoc' AND IND_EST='L'";
        //echo $sql;
        $rawData = $conCont->createCommand($sql)->queryAll();
        return $rawData;
    }
    public function mostrarDocumentos($control) {
        $page= new VSValidador;
        $rawData = array();
        $limitrowsql=$page->paginado($control);
        $tipoUser=Yii::$app->session->get('RolId', FALSE);
        $usuarioErp=$page->concatenarUserERP(Yii::$app->session->get('PB_iduser', FALSE));
        //echo $usuarioErp;
        //$fecInifact=Yii::$app->params['dateStartFact'];//Fecha Inicial de Facturacion Electronica
        $fecInifact= date(Yii::$app->params['dateByDefault']);
        $con = Yii::$app->db_edoc;
        $sql = "SELECT A.IdFactura IdDoc,A.Estado,A.CodigoTransaccionERP,A.SecuencialERP,A.UsuarioCreador,
                        A.FechaAutorizacion,A.AutorizacionSRI,
                        CONCAT(A.Establecimiento,'-',A.PuntoEmision,'-',A.Secuencial) NumDocumento,
                        A.FechaEmision,A.IdentificacionComprador,A.RazonSocialComprador,
                        A.TotalSinImpuesto,A.TotalDescuento,A.Propina,A.ImporteTotal,
                        'FACTURA' NombreDocumento,A.AutorizacionSri,A.ClaveAcceso,A.FechaAutorizacion
                        FROM " . $con->dbname . ".NubeFactura A
                WHERE A.CodigoDocumento='$this->tipoDoc'  AND A.Estado NOT IN (5) ";
        
        //Usuarios Vendedor con * es privilegiado y puede ver lo que factura el resta
        $sql .= ($usuarioErp!='1') ? "AND A.UsuarioCreador IN ('$usuarioErp')" : "";//Para Usuario Vendedores.
        
        if (!empty($control)) {//Verifica la Opcion op para los filtros
            $sql .= ($control[0]['TIPO_APR'] != "0") ? " AND A.Estado = '" . $control[0]['TIPO_APR'] . "' " : " AND A.Estado NOT IN (5) ";
            $sql .= ($control[0]['CEDULA'] > 0) ? "AND A.IdentificacionComprador = '" . $control[0]['CEDULA'] . "' " : "";
            //$sql .= ($control[0]['COD_PACIENTE'] != "0") ? "AND CDOR_ID_PACIENTE='".$control[0]['COD_PACIENTE']."' " : "";
            //$sql .= ($control[0]['PACIENTE'] != "") ? "AND CONCAT(B.PER_APELLIDO,' ',B.PER_NOMBRE) LIKE '%" . $control[0]['PACIENTE'] . "%' " : "";
            if($control[0]['F_INI']!='' AND $control[0]['F_FIN']!=''){//Si vienen valores en blanco en las fechas muestra todos
                $sql .= "AND DATE(A.FechaEmision) BETWEEN '" . date("Y-m-d", strtotime($control[0]['F_INI'])) . "' AND '" . date("Y-m-d", strtotime($control[0]['F_FIN'])) . "'  ";
            }
        }
        //$sql .= "ORDER BY A.IdFactura DESC  $limitrowsql";
        //echo $sql;
        
        $rawData = $con->createCommand($sql)->queryAll();
        return new ArrayDataProvider(array(
            'key' => 'IdDoc',
            'allModels' => $rawData,
            'sort' => array(
                'attributes' => array(
                    'IdDoc', 'Estado', 'CodigoTransaccionERP', 'SecuencialERP', 'UsuarioCreador',
                    'FechaAutorizacion', 'AutorizacionSRI', 'NumDocumento', 'FechaEmision', 'IdentificacionComprador',
                    'RazonSocialComprador', 'ImporteTotal', 'NombreDocumento',
                ),
            ),
            //'totalItemCount' => count($rawData),
            'pagination' => array(
                'pageSize' => Yii::$app->params['pageSize'],
                //'itemCount'=>count($rawData),
            ),
        ));
    }
    public function recuperarTipoDocumentos() {
        $con = Yii::$app->db_edoc;
        $sql = "SELECT idDirectorio,TipoDocumento,Descripcion,Ruta 
                FROM " . $con->dbname . ".VSDirectorio WHERE Estado=1;";
        $rawData = $con->createCommand($sql)->queryAll();
        return $rawData;
    }
    public function mostrarCabFactura($id) {
        $rawData = array();
        $con = Yii::$app->db_edoc;
        $sql = "SELECT A.IdFactura IdDoc,A.Estado,A.CodigoTransaccionERP,A.SecuencialERP,A.UsuarioCreador,
                        A.FechaAutorizacion,A.AutorizacionSRI,A.DireccionMatriz,A.DireccionEstablecimiento,
                        CONCAT(A.Establecimiento,'-',A.PuntoEmision,'-',A.Secuencial) NumDocumento,
                        A.ContribuyenteEspecial,A.ObligadoContabilidad,A.TipoIdentificacionComprador,
                        A.CodigoDocumento,A.Establecimiento,A.PuntoEmision,A.Secuencial,
                        A.FechaEmision,A.IdentificacionComprador,A.RazonSocialComprador,
                        A.TotalSinImpuesto,A.TotalDescuento,A.Propina,A.ImporteTotal,
                        'FACTURA' NombreDocumento,A.AutorizacionSri,A.ClaveAcceso,A.FechaAutorizacion,
                        A.Ambiente,A.TipoEmision,A.GuiaRemision,A.Moneda,A.Ruc,A.CodigoError,A.USU_ID
                        FROM " . $con->dbname . ".NubeFactura A
                WHERE A.CodigoDocumento='$this->tipoDoc' AND A.IdFactura =$id ";
        //echo $sql;        
        $rawData = $con->createCommand($sql)->queryOne(); //Recupera Solo 1
        //VSValidador::putMessageLogFile($rawData);
        return $rawData;
    }
    public function mostrarDetFacturaImp($id) {
        $rawData = array();
        $con = Yii::$app->db_edoc;
        $sql = "SELECT * FROM " . $con->dbname . ".NubeDetalleFactura WHERE IdFactura=$id";
        //echo $sql;
        $rawData = $con->createCommand($sql)->queryAll(); //Recupera Solo 1
        for ($i = 0; $i < sizeof($rawData); $i++) {
            $rawData[$i]['impuestos'] = $this->mostrarDetalleImp($rawData[$i]['IdDetalleFactura']); //Retorna el Detalle del Impuesto
        }
        return $rawData;
    }
    private function mostrarDetalleImp($id) {
        $rawData = array();
        $con = Yii::$app->db_edoc;
        $sql = "SELECT * FROM " . $con->dbname . ".NubeDetalleFacturaImpuesto WHERE IdDetalleFactura=$id";
        $rawData = $con->createCommand($sql)->queryAll(); //Recupera Solo 1
        return $rawData;
    }
    public function mostrarFacturaImp($id) {
        $rawData = array();
        $con = Yii::$app->db_edoc;
        $sql = "SELECT * FROM " . $con->dbname . ".NubeFacturaImpuesto WHERE IdFactura=$id";
        $rawData = $con->createCommand($sql)->queryAll(); //Recupera Solo 1
        return $rawData;
    }
    
    public function mostrarFormaPago($id) {
        $rawData = array();
        $con = Yii::$app->db_edoc;
        //$sql = "SELECT * FROM " . $con->dbname . ".NubeFacturaFormaPago WHERE IdFactura=$id";
        $sql = "SELECT B.FormaPago,A.Total,A.Plazo,A.UnidadTiempo,A.FormaPago Codigo  
                FROM " . $con->dbname . ".NubeFacturaFormaPago A
                        INNER JOIN " . $con->dbname . ".VSFormaPago B
                                ON A.IdForma=B.IdForma
                    WHERE A.IdFactura=$id ";
        $rawData = $con->createCommand($sql)->queryAll(); //Recupera Solo 1
        return $rawData;
    }
    public function mostrarFacturaDataAdicional($id) {
        $rawData = array();
        $con = Yii::$app->db_edoc;
        $sql = "SELECT * FROM " . $con->dbname . ".NubeDatoAdicionalFactura WHERE IdFactura=$id";
        $rawData = $con->createCommand($sql)->queryAll(); //Recupera Solo 1
        return $rawData;
    }
    /**
     * Función 
     *
     * @author Byron Villacreses
     * @access public
     * @return Retorna Los Datos de las Facturas GENERADAS
     */
    public function retornarPersona($valor, $op) {
        $con = Yii::$app->db_edoc;
        $rawData = array();
        //Patron de Busqueda
        /* http://www.mclibre.org/consultar/php/lecciones/php_expresiones_regulares.html */
        $patron = "/^[[:digit:]]+$/"; //Los patrones deben empezar y acabar con el carácter / (barra).
        if (preg_match($patron, $valor)) {
            $op = "CED"; //La cadena son sólo números.
        } else {
            $op = "NOM"; //La cadena son Alfanumericos.
            //Las separa en un array 
            $aux = explode(" ", $valor);
            $condicion = " ";
            for ($i = 0; $i < count($aux); $i++) {
                //Crea la Sentencia de Busqueda
                //$condicion .=" AND (PER_NOMBRE LIKE '%$aux[$i]%' OR PER_APELLIDO LIKE '%$aux[$i]%' ) ";
                $condicion .=" AND RazonSocialComprador LIKE '%$aux[$i]%' ";
            }
        }
        $sql = "SELECT A.IdentificacionComprador,A.RazonSocialComprador
                    FROM " . $con->dbname . ".NubeFactura A
                  WHERE A.Estado<>0	GROUP BY IdentificacionComprador ";
        switch ($op) {
            case 'CED':
                $sql .=" AND IdentificacionComprador LIKE '%$valor%' ";
                break;
            case 'NOM':
                $sql .=$condicion;
                break;
            default:
        }
        $sql .= " LIMIT " . Yii::$app->params['limitRow'];
        //$sql .= " LIMIT 10";
        //echo $sql;
        $rawData = $con->createCommand($sql)->queryAll();
        return $rawData;
    }
    public function enviarDocumentos($id) {
        try {
            $autDoc=new VSAutoDocumento();
            $errAuto= new VSexception();
            $ids = explode(",", $id);
            for ($i = 0; $i < count($ids); $i++) {
                if ($ids[$i] !== "") {
                    $result = $this->generarFileXML($ids[$i]);
                    //VSValidador::putMessageLogFile($result);
                    $DirDocAutorizado=Yii::$app->params['seaDocAutFact']; 
                    $DirDocFirmado=Yii::$app->params['seaDocFact'];
                    if ($result['status'] == 'OK') {//Retorna True o False 
                        //echo $result['nomDoc'];
                        return $autDoc->AutorizaDocumento($result,$ids,$i,$DirDocAutorizado,$DirDocFirmado,'NubeFactura','FACTURA','IdFactura');
                    }elseif ($result['status'] == 'OK_REG') {
                        //LA CLAVE DE ACCESO REGISTRADA ingresa directamente a Obtener su autorizacion
                        //Autorizacion de Comprobantes 
                        return $autDoc->autorizaComprobante($result, $ids, $i, $DirDocAutorizado, $DirDocFirmado, 'NubeFactura','FACTURA','IdFactura');
                   
                    }else{
                        return $result;//$errAuto->messageSystem('NO_OK', $result["error"],1,null, null);
                    }
                }
            }
            return $errAuto->messageSystem('OK', null,40,null, null);
        } catch (Exception $e) { // se arroja una excepción si una consulta falla
            return $errAuto->messageSystem('NO_OK', $e->getMessage(), 41, null, null);
        }
    }
    
    
    private function generarFileXML($ids) {
        $autDoc=new VSAutoDocumento();
        $msgAuto= new VSexception();
        $valida= new VSValidador();
        $xmlGen=new VSXmlGenerador();
        $codDoc = $this->tipoDoc; //Documento Factura
        $cabFact = $this->mostrarCabFactura($ids);
        if (count($cabFact)>0) {
            switch ($cabFact["Estado"]) {
                case 2://RECIBIDO SRI (AUTORIZADOS)
                    return $msgAuto->messageFileXML('NO_OK', $cabFact["NumDocumento"], null, 42, null, null);
                    break;
                case 4://DEVUELTA (NO AUTORIZADOS EN PROCESO)
                    //Cuando son devueltas no se deben generar de nuevo la clave de acceso
                    //hay que esperar hasta que responda
                    switch ($cabFact["CodigoError"]) {
                        case 43://CLAVE DE ACCESO REGISTRADA
                            //No genera Nada Envia los datos generados anteriormente
                            //Retorna Automaticamente sin Generar Documento
                            //LA CLAVE DE ACCESO REGISTRADA ingresa directamente a Obtener su autorizacion
                            return $msgAuto->messageFileXML('OK_REG', $cabFact["NombreDocumento"], $cabFact["ClaveAcceso"], 43, null, null);
                            break;
                        case 70://CLAVE DE ACCESO EN PROCESO
                            return $msgAuto->messageFileXML('OK', $cabFact["NombreDocumento"], $cabFact["ClaveAcceso"], 43, null, null);
                            break;
                        default:
                            //Documento Devuelto hay que volver a generar la clave de Acceso
                            //Esto es Opcional
                            /*$objCla = new VSClaveAcceso();
                            $serie = $cabFact['Establecimiento'] . $cabFact['PuntoEmision'];
                            $fec_doc = date("Y-m-d", strtotime($cabFact['FechaEmision']));
                            $ClaveAcceso = $objCla->claveAcceso($codDoc, $fec_doc, $cabFact['Ruc'], $cabFact['Ambiente'], $serie, $cabFact['Secuencial'], $cabFact['TipoEmision']);
                            //$this->actualizaClaveAccesoFactura($ids,$ClaveAcceso);
                            $autDoc->actualizaClaveAccesoDocumento($ids, $ClaveAcceso, 'NubeFactura', 'IdFactura');
                            $cabFact = $this->mostrarCabFactura($ids); //Vuelve a Consultar con la Clave de Acceso Nueva.*/
                    }
                    break;
                case 8://DOCUMENTO ANULADO
                    return $msgAuto->messageSystem('NO_OK', null,11,null, null);//Peticion Invalida
                    break;
                default:
            }
        }else{
            //Si la Cabecera no devuelve registros Retorna un resultado  de False
            return $msgAuto->messageFileXML('NO_OK', null, null, 1, null, null);
        }
        
        $detFact = $this->mostrarDetFacturaImp($ids);
        $impFact = $this->mostrarFacturaImp($ids);
        $adiFact = $this->mostrarFacturaDataAdicional($ids);
        $pagFact = $this->mostrarFormaPago($ids);//Agregar forma de pago
        
        $xmldata = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';
            //$xmldata .='<factura id="comprobante" version="1.0.0">';//Version Normal Para 2 Decimales
            $xmldata .='<factura id="comprobante" version="1.1.0">';//Version para 4 Decimales en Precio Unitario
            
                $xmldata .= $xmlGen->infoTributaria($cabFact);
                $xmldata .='<infoFactura>';
                    $xmldata .='<fechaEmision>' . date(Yii::$app->params["dateXML"], strtotime($cabFact["FechaEmision"])) . '</fechaEmision>';
                    $xmldata .='<dirEstablecimiento>' . utf8_encode(trim($cabFact["DireccionEstablecimiento"])) . '</dirEstablecimiento>';
                    if(strlen(trim($cabFact['ContribuyenteEspecial']))>0){
                        $xmldata .='<contribuyenteEspecial>' . utf8_encode(trim($cabFact["ContribuyenteEspecial"])) . '</contribuyenteEspecial>';
                    }
                    $xmldata .='<obligadoContabilidad>' . utf8_encode(trim($cabFact["ObligadoContabilidad"])) . '</obligadoContabilidad>';
                    $xmldata .='<tipoIdentificacionComprador>' . utf8_encode(trim($cabFact["TipoIdentificacionComprador"])) . '</tipoIdentificacionComprador>';
                    //$xmldata .='<razonSocialComprador>' . utf8_encode($valida->limpioCaracteresXML(trim($cabFact["RazonSocialComprador"]))) . '</razonSocialComprador>';
                    $xmldata .='<razonSocialComprador>' . $valida->limpioCaracteresXML(trim($cabFact["RazonSocialComprador"])) . '</razonSocialComprador>'; 
                    //SValidador::putMessageLogFile($valida->limpioCaracteresXML(trim($cabFact["RazonSocialComprador"])));
                    //VSValidador::putMessageLogFile(trim($cabFact["RazonSocialComprador"]));
                    $xmldata .='<identificacionComprador>' . utf8_encode(trim($cabFact["IdentificacionComprador"])) . '</identificacionComprador>';
                    $xmldata .='<totalSinImpuestos>' . Yii::$app->format->formatNumber($cabFact["TotalSinImpuesto"]) . '</totalSinImpuestos>';
                    $xmldata .='<totalDescuento>' . Yii::$app->format->formatNumber($cabFact["TotalDescuento"]) . '</totalDescuento>';
                        $xmldata .='<totalConImpuestos>';
                        $IRBPNR = 0; //NOta validar si existe casos para estos
                        $ICE = 0;
                        for ($i = 0; $i < sizeof($impFact); $i++) {
                            if ($impFact[$i]['Codigo'] == '2') {//Valores de IVA
                                switch ($impFact[$i]['CodigoPorcentaje']) {
                                    case 0:
                                        $BASEIVA0=$impFact[$i]['BaseImponible'];
                                        $xmldata .='<totalImpuesto>';
                                                $xmldata .='<codigo>' . $impFact[$i]["Codigo"] . '</codigo>';
                                                $xmldata .='<codigoPorcentaje>' . $impFact[$i]["CodigoPorcentaje"] . '</codigoPorcentaje>';
                                                $xmldata .='<baseImponible>' . Yii::$app->format->formatNumber($impFact[$i]["BaseImponible"]) . '</baseImponible>';
                                                //$xmldata .='<tarifa>' . Yii::$app->format->formatNumber($impFact[$i]["Tarifa"]) . '</tarifa>';
                                                $xmldata .='<valor>' . Yii::$app->format->formatNumber($impFact[$i]["Valor"]) . '</valor>';
                                        $xmldata .='</totalImpuesto>';
                                        break;
                                    case 2://IVA 12%
                                        $BASEIVA12 = $impFact[$i]['BaseImponible'];
                                        $VALORIVA12 = $impFact[$i]['Valor'];
                                        $xmldata .='<totalImpuesto>';
                                                $xmldata .='<codigo>' . $impFact[$i]["Codigo"] . '</codigo>';
                                                $xmldata .='<codigoPorcentaje>' . $impFact[$i]["CodigoPorcentaje"] . '</codigoPorcentaje>';
                                                $xmldata .='<baseImponible>' . Yii::$app->format->formatNumber($impFact[$i]["BaseImponible"]) . '</baseImponible>';
                                                //$xmldata .='<tarifa>' . Yii::$app->format->formatNumber($impFact[$i]["Tarifa"]) . '</tarifa>';
                                                $xmldata .='<valor>' . Yii::$app->format->formatNumber($impFact[$i]["Valor"]) . '</valor>';
                                        $xmldata .='</totalImpuesto>';
                                        break;
                                    case 3://IVA 14%
                                        $BASEIVA12 = $impFact[$i]['BaseImponible'];
                                        $VALORIVA12 = $impFact[$i]['Valor'];
                                        $xmldata .='<totalImpuesto>';
                                                $xmldata .='<codigo>' . $impFact[$i]["Codigo"] . '</codigo>';
                                                $xmldata .='<codigoPorcentaje>' . $impFact[$i]["CodigoPorcentaje"] . '</codigoPorcentaje>';
                                                $xmldata .='<baseImponible>' . Yii::$app->format->formatNumber($impFact[$i]["BaseImponible"]) . '</baseImponible>';
                                                //$xmldata .='<tarifa>' . Yii::$app->format->formatNumber($impFact[$i]["Tarifa"]) . '</tarifa>';
                                                $xmldata .='<valor>' . Yii::$app->format->formatNumber($impFact[$i]["Valor"]) . '</valor>';
                                        $xmldata .='</totalImpuesto>';
                                        break;
                                    case 6://No objeto Iva
                                        //$NOOBJIVA=$impFact[$i]['BaseImponible'];
                                        break;
                                    case 7://Excento de Iva
                                        //$EXENTOIVA=$impFact[$i]['BaseImponible'];
                                        break;
                                    default:
                                }
                            }
                            //NOta Verificar cuando el COdigo sea igual a 3 o 5 Para los demas impuestos
                        }
                        $xmldata .='</totalConImpuestos>';
                $xmldata .='<propina>' . Yii::$app->format->formatNumber($cabFact["Propina"]) . '</propina>';
                $xmldata .='<importeTotal>' . Yii::$app->format->formatNumber($cabFact["ImporteTotal"]) . '</importeTotal>';
                $xmldata .='<moneda>' . utf8_encode(trim($cabFact["Moneda"])) . '</moneda>';
                
                //DATOS DE FORMA DE PAGO APLICADO 8 SEP 2016                
                $xmldata .='<pagos>';
                for ($xi = 0; $xi < sizeof($pagFact); $xi++) {
                    $xmldata .='<pago>';
                        $xmldata .='<formaPago>' . $valida->ajusteNumDoc(trim($pagFact[$xi]['Codigo']),2) . '</formaPago>';//Completa los 01 de al formato XSD <xsd:pattern value="[0][1-9]"/>
                        $xmldata .='<total>' . Yii::$app->format->formatNumber($pagFact[$xi]['Total']) . '</total>';
                        $xmldata .='<plazo>' . Yii::$app->format->formatNumber($pagFact[$xi]['Plazo']) . '</plazo>';
                        $xmldata .='<unidadTiempo>' . utf8_encode(trim($pagFact[$xi]['UnidadTiempo'])) . '</unidadTiempo>';
                    $xmldata .='</pago>';                    
                }
                $xmldata .='</pagos>';
                //Fin Forma de Pago
                
            $xmldata .='</infoFactura>';
        $xmldata .='<detalles>';
        for ($i = 0; $i < sizeof($detFact); $i++) {//DETALLE DE FACTURAS
            $xmldata .='<detalle>';
            $xmldata .='<codigoPrincipal>' . utf8_encode(trim($detFact[$i]['CodigoPrincipal'])) . '</codigoPrincipal>';
            $xmldata .='<codigoAuxiliar>' . utf8_encode(trim($detFact[$i]['CodigoAuxiliar'])) . '</codigoAuxiliar>';
            $xmldata .='<descripcion>' . $valida->limpioCaracteresXML(trim($detFact[$i]['Descripcion'])) . '</descripcion>';
            //VSValidador::putMessageLogFile($valida->limpioCaracteresXML(trim($detFact[$i]['Descripcion'])));
            $xmldata .='<cantidad>' . Yii::$app->format->formatNumber($detFact[$i]['Cantidad']) . '</cantidad>';
            //$xmldata .='<precioUnitario>' . Yii::$app->format->formatNumber($detFact[$i]['PrecioUnitario']) . '</precioUnitario>'; //Problemas de Redondeo Usar Roud(valor,deci)
            $xmldata .='<precioUnitario>' . (string)$detFact[$i]['PrecioUnitario'] . '</precioUnitario>';
            $xmldata .='<descuento>' . Yii::$app->format->formatNumber($detFact[$i]['Descuento']) . '</descuento>';
            $xmldata .='<precioTotalSinImpuesto>' . Yii::$app->format->formatNumber($detFact[$i]['PrecioTotalSinImpuesto']) . '</precioTotalSinImpuesto>';
            $xmldata .='<impuestos>';
            $impuesto = $detFact[$i]['impuestos'];
            for ($j = 0; $j < sizeof($impuesto); $j++) {//DETALLE IMPUESTO DE FACTURA
                $xmldata .='<impuesto>';
                        $xmldata .='<codigo>' . $impuesto[$j]['Codigo'] . '</codigo>';
                        $xmldata .='<codigoPorcentaje>' . $impuesto[$j]['CodigoPorcentaje'] . '</codigoPorcentaje>';
                        $xmldata .='<tarifa>' . Yii::$app->format->formatNumber($impuesto[$j]['Tarifa']) . '</tarifa>';
                        $xmldata .='<baseImponible>' . Yii::$app->format->formatNumber($impuesto[$j]['BaseImponible']) . '</baseImponible>';
                        $xmldata .='<valor>' . Yii::$app->format->formatNumber($impuesto[$j]['Valor']) . '</valor>';
                    $xmldata .='</impuesto>';
            }
            $xmldata .='</impuestos>';
        $xmldata .='</detalle>';
        }
        $xmldata .='</detalles>';
//    <retenciones>
//        <retencion>
//	    <codigo>4</codigo>
//	    <codigoPorcentaje>327</codigoPorcentaje>
//	    <tarifa>0.00</tarifa>	    
//	    <valor>0.00</valor>
//        </retencion>
//        <retencion>
//	    <codigo>4</codigo>
//	    <codigoPorcentaje>328</codigoPorcentaje>
//	    <tarifa>0.00</tarifa>	    
//	    <valor>0.00</valor>
//        </retencion>
//		 <retencion>
//	    <codigo>4</codigo>
//	    <codigoPorcentaje>3</codigoPorcentaje>
//	    <tarifa>1</tarifa>	    
//	    <valor>0.00</valor>
//        </retencion>
//    </retenciones>
        $xmldata .='<infoAdicional>';
        for ($i = 0; $i < sizeof($adiFact); $i++) {
            if(strlen(trim($adiFact[$i]['Descripcion']))>0){
                //$xmldata .='<campoAdicional nombre="' . utf8_encode(trim($adiFact[$i]['Nombre'])) . '">' . utf8_encode($valida->limpioCaracteresXML(trim($adiFact[$i]['Descripcion']))) . '</campoAdicional>';
                $xmldata .='<campoAdicional nombre="' . $valida->limpioCaracteresXML(trim($adiFact[$i]['Nombre'])) . '">' . $valida->limpioCaracteresXML(trim($adiFact[$i]['Descripcion'])) . '</campoAdicional>';
            }
        }
        $xmldata .='</infoAdicional>';
        //$xmldata .=$firma;
        $xmldata .='</factura>';
        //echo htmlentities($xmldata);
        $nomDocfile = $cabFact['NombreDocumento'] . '-' . $cabFact['NumDocumento'] . '.xml';
        file_put_contents(Yii::$app->params['seaDocXml'] . $nomDocfile, $xmldata); //Escribo el Archivo Xml
        return $msgAuto->messageFileXML('OK', $nomDocfile, $cabFact["ClaveAcceso"], 2, null, null);
    }
    
    public function mostrarRutaXMLAutorizado($id) {
        $rawData = array();
        $con = Yii::$app->db_edoc;
        $sql = "SELECT EstadoDocumento,DirectorioDocumento,NombreDocumento FROM " . $con->dbname . ".NubeFactura WHERE "
                . "IdFactura=$id AND EstadoDocumento='AUTORIZADO'";
        $rawData = $con->createCommand($sql)->queryOne(); //Recupera Solo 1
        return $rawData;
    }
    
    
    public function actualizaClaveAccesoFactura($ids,$clave) {
        $con = Yii::$app->db_edoc;
        $trans = $con->beginTransaction();
        try {
            $sql = "UPDATE " . $con->dbname . ".NubeFactura SET ClaveAcceso='$clave' WHERE IdFactura='$ids'";
            //echo $sql;
            $command = $con->createCommand($sql);
            $command->execute();
            $trans->commit();
            return true;
        } catch (Exception $e) {
            $trans->rollback();
            throw $e;
            return false;
        }
    }
    
    
    public function reporteDocumentos($f_ini,$f_fin,$t_apr) {
        $page= new VSValidador;
        $rawData = array();       
        //$tipoUser=Yii::$app->session->get('RolId', FALSE);
        //$usuarioErp=$page->concatenarUserERP(Yii::$app->session->get('UsuarioErp', FALSE));
     
        //$fecInifact= date(Yii::$app->params['dateByDefault']);
        $con = Yii::$app->db_edoc;
        $sql = "SELECT A.IdFactura IdDoc,A.Estado,A.CodigoTransaccionERP,A.SecuencialERP,A.UsuarioCreador,
                        A.FechaAutorizacion,A.AutorizacionSRI,
                        CONCAT(A.Establecimiento,'-',A.PuntoEmision,'-',A.Secuencial) NumDocumento,
                        A.FechaEmision,A.IdentificacionComprador,A.RazonSocialComprador,
                        A.TotalSinImpuesto,A.TotalDescuento,A.Propina,A.ImporteTotal,
                        'FACTURA' NombreDocumento,A.AutorizacionSri,A.ClaveAcceso,A.FechaAutorizacion
                        FROM " . $con->dbname . ".NubeFactura A
                WHERE  A.Estado NOT IN (5) ";
        
        //Usuarios Vendedor con * es privilegiado y puede ver lo que factura el resta
        //$sql .= ($usuarioErp!='*') ? "AND A.UsuarioCreador IN ('$usuarioErp')" : "";//Para Usuario Vendedores.
        
        if (!empty($control)) {//Verifica la Opcion op para los filtros
            $sql .= ($t_apr != "0") ? " AND A.Estado = '" . $t_apr . "' " : " ";
            if($f_ini!='' AND $f_fin!=''){//Si vienen valores en blanco en las fechas muestra todos
                $sql .= "AND DATE(A.FechaEmision) BETWEEN '" . date("Y-m-d", strtotime($f_ini)) . "' AND '" . date("Y-m-d", strtotime($f_fin)) . "'  ";
            }
        }
        $sql .= "ORDER BY A.IdFactura DESC";
        //echo $sql;
        
        //VSValidador::putMessageLogFile($sql);
        $rawData = $con->createCommand($sql)->queryAll();
        return $rawData;       
        
    }
}