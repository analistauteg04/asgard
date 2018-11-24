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
    
    private function retornaTarifaDelIva($tarifa) {
         //TABLA 18 FICHA TECNICA SEGUN SRI
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
    
    /*
     * INICIO DE PROCESO DE FACTURAS
     */
    
    private function insertarFacturas() {
        $con = Yii::$app->db_edoc;
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction();
        }
        try {
            $idCab= $this->insertarCabFactura($con);
            //Utilities::putMessageLogFile($idCab);
            $this->InsertarDetFactura($con,$idCab);
            $this->InsertarFacturaFormaPago($con,$idCab);
            $this->InsertarFacturaDatoAdicional($con,$idCab);
            if ($trans !== null){
                $trans->commit();
            }
            //return array("status"=>"OK");
            return array("status"=>"OK", "Ids_Doc"=>$idCab);
        } catch (\Exception $e) {
            $trans->rollBack();
            //throw $e;
            //return array("status" => "NO_OK");
            return array("status"=>"NO_OK","error"=>$e);
        }
        
    }
    
    private function insertarCabFactura($con) {
        $cabFact= $this->cabEdoc;
        //Utilities::putMessageLogFile($cabFact);
        //$sql = "INSERT INTO " . $con->dbname . ".NubeFactura
        //       (Ambiente,TipoEmision,Secuencial)VALUES(:Ambiente,:TipoEmision,:Secuencial);";
        $TipoEmision=1;//Valor por Defecto
        $RazonSocial="UTEG S.A.";
        $NombreComercial="UTEG S.A.";
        $Ruc="1310328404001";//Ruc de la EMpesa
        $DireccionMatriz="Direccion de la Matriz empresa";
        $DireccionEstablecimiento="Direccion de Establecimiento Empresa ";
        $ContribuyenteEspecial=($cabFact['CONTRIB_ESPECIAL']!=0)?'SI':'';
        $ObligadoContabilidad=$cabFact['OBLIGADOCONTAB'];//($cabFact['OBLIGADOCONTAB']!=0)?'SI':'';
        $CodigoTransaccionERP='XX';//
        $UsuarioCreador="1";//idde la Persona que genera la factura
        
        
        $sql = "INSERT INTO " . $con->db_edoc . ".NubeFactura
               (Ambiente,TipoEmision, RazonSocial, NombreComercial, Ruc,ClaveAcceso,CodigoDocumento, Establecimiento,
                PuntoEmision, Secuencial, DireccionMatriz, FechaEmision, DireccionEstablecimiento, ContribuyenteEspecial,
                ObligadoContabilidad, TipoIdentificacionComprador, GuiaRemision, RazonSocialComprador, IdentificacionComprador,
                TotalSinImpuesto, TotalDescuento, Propina, ImporteTotal, Moneda, SecuencialERP, CodigoTransaccionERP,UsuarioCreador,Estado,FechaCarga) VALUES 
               (:Ambiente,:TipoEmision, :RazonSocial, :NombreComercial, :Ruc,:ClaveAcceso,:CodigoDocumento, :Establecimiento,
                :PuntoEmision, :Secuencial, :DireccionMatriz, :FechaEmision, :DireccionEstablecimiento, :ContribuyenteEspecial,
                :ObligadoContabilidad, :TipoIdentificacionComprador, :GuiaRemision, :RazonSocialComprador, :IdentificacionComprador,
                :TotalSinImpuesto, :TotalDescuento, :Propina, :ImporteTotal, :Moneda, :SecuencialERP, :CodigoTransaccionERP,:UsuarioCreador,1,CURRENT_TIMESTAMP())";
        $comando = $con->createCommand($sql);

        //$comando->bindParam(":id", $id_docElectronico, PDO::PARAM_INT);
        $comando->bindParam(":Ambiente", $cabFact['TIPOAMBIENTE'], \PDO::PARAM_STR);
        $comando->bindParam(":TipoEmision", $TipoEmision, \PDO::PARAM_STR);
        $comando->bindParam(":Secuencial", $cabFact['SECUENCIAL'], \PDO::PARAM_STR);        
        $comando->bindParam(":RazonSocial", $RazonSocial, \PDO::PARAM_STR);
        $comando->bindParam(":NombreComercial", $NombreComercial, \PDO::PARAM_STR);
        $comando->bindParam(":Ruc", $Ruc, \PDO::PARAM_STR);
        $comando->bindParam(":ClaveAcceso", $cabFact['CLAVEACCESO'], \PDO::PARAM_STR);
        $comando->bindParam(":CodigoDocumento", $cabFact['TIPOCOMPROBANTE'], \PDO::PARAM_STR);
        $comando->bindParam(":Establecimiento", $cabFact['COD_ESTAB'], \PDO::PARAM_STR);
        $comando->bindParam(":PuntoEmision", $cabFact['PTOEMI'], \PDO::PARAM_STR);
        $comando->bindParam(":DireccionMatriz", $DireccionMatriz, \PDO::PARAM_STR);
        $comando->bindParam(":FechaEmision", $cabFact['FECHAEMISION'], \PDO::PARAM_STR);
        $comando->bindParam(":DireccionEstablecimiento", $DireccionEstablecimiento, \PDO::PARAM_STR);
        $comando->bindParam(":ContribuyenteEspecial", $ContribuyenteEspecial, \PDO::PARAM_STR);
        $comando->bindParam(":ObligadoContabilidad", $ObligadoContabilidad, \PDO::PARAM_STR);
        $comando->bindParam(":TipoIdentificacionComprador", $cabFact['TIPOID_SUJETO'], \PDO::PARAM_STR);
        $comando->bindParam(":GuiaRemision", $cabFact['NUMGUIA'], \PDO::PARAM_STR);
        $comando->bindParam(":RazonSocialComprador", $cabFact['RAZONSOCIAL_SUJETO'], \PDO::PARAM_STR);
        $comando->bindParam(":IdentificacionComprador", $cabFact['RUC_SUJETO'], \PDO::PARAM_STR);
        $comando->bindParam(":TotalSinImpuesto", $cabFact['TOTALBRUTO'], \PDO::PARAM_STR);
        $comando->bindParam(":TotalDescuento", $cabFact['TOTALDESC'], \PDO::PARAM_STR);
        $comando->bindParam(":Propina", $cabFact['PROPINA'], \PDO::PARAM_STR);
        $comando->bindParam(":ImporteTotal", $cabFact['TOTALDOC'], \PDO::PARAM_STR);
        $comando->bindParam(":Moneda", $cabFact['MONEDA'], \PDO::PARAM_STR);
        $comando->bindParam(":SecuencialERP", $cabFact['SECUENCIAL'], \PDO::PARAM_STR);
        $comando->bindParam(":CodigoTransaccionERP", $CodigoTransaccionERP, \PDO::PARAM_STR);
        $comando->bindParam(":UsuarioCreador", $UsuarioCreador, \PDO::PARAM_STR);

        $comando->execute();
        return $con->getLastInsertID();
        
    }
    
    /*Private Sub InsertarDetFactura(ByVal dtsData As DataSet, ByVal IdFact As Integer)
        Dim idDet As Integer = 0
        Dim valSinImp As Decimal = 0
        Dim val_iva12 As Decimal = 0
        Dim vet_iva12 As Decimal = 0
        Dim val_iva0 As Decimal = 0 'Valor de Iva
        Dim vet_iva0 As Decimal = 0 'Venta total con Iva
        Dim por_iva As Decimal = CDbl(dtsData.Tables("VC010101").Rows(0).Item("POR_IVA")) / 100

        For fil As Integer = 0 To dtsData.Tables("VD010101").Rows.Count - 1

            With dtsData.Tables("VD010101").Rows(fil)
                'valSinImp = floatval($detFact[$i]['T_VENTA']) - floatval($detFact[$i]['VAL_DES']);
                valSinImp = CDbl(.Item("T_VENTA")) - CDbl(.Item("VAL_DES"))
                If .Item("I_M_IVA") = "1" Then
                    'MOdificacion por que iva no cuadra con los totales
                    'val_iva12 = val_iva12 + (CDbl(.Item("CAN_DES")) * CDbl(.Item("P_VENTA")) * por_iva)
                    val_iva12 = val_iva12 + ((CDbl(.Item("CAN_DES")) * CDbl(.Item("P_VENTA")) - CDbl(.Item("VAL_DES"))) * por_iva)
                    vet_iva12 = vet_iva12 + valSinImp
                Else
                    val_iva0 = 0
                    vet_iva0 = vet_iva0 + valSinImp
                End If
            End With

            If cmSql IsNot Nothing Then cmSql.Dispose()
            cmSql = New MySqlCommand
            With cmSql
                .Connection = cn
                .CommandType = CommandType.Text

                .CommandText = "INSERT INTO NubeDetalleFactura " & _
                "(CodigoPrincipal,CodigoAuxiliar,Descripcion,Cantidad,PrecioUnitario,Descuento,PrecioTotalSinImpuesto,IdFactura) VALUES " & _
                "(?CodigoPrincipal,?CodigoAuxiliar,?Descripcion,?Cantidad,?PrecioUnitario,?Descuento,?PrecioTotalSinImpuesto,?IdFactura); SELECT LAST_INSERT_ID() "

                .Parameters.Add(New MySqlParameter("?CodigoPrincipal", MySqlDbType.VarChar)).Value = dtsData.Tables("VD010101").Rows(fil).Item("COD_ART")
                .Parameters.Add(New MySqlParameter("?CodigoAuxiliar", MySqlDbType.VarChar)).Value = "1"
                .Parameters.Add(New MySqlParameter("?Descripcion", MySqlDbType.VarChar)).Value = dtsData.Tables("VD010101").Rows(fil).Item("NOM_ART")
                .Parameters.Add(New MySqlParameter("?Cantidad", MySqlDbType.Double)).Value = dtsData.Tables("VD010101").Rows(fil).Item("CAN_DES")
                .Parameters.Add(New MySqlParameter("?PrecioUnitario", MySqlDbType.Double)).Value = dtsData.Tables("VD010101").Rows(fil).Item("P_VENTA")
                .Parameters.Add(New MySqlParameter("?Descuento", MySqlDbType.Double)).Value = dtsData.Tables("VD010101").Rows(fil).Item("VAL_DES")
                .Parameters.Add(New MySqlParameter("?PrecioTotalSinImpuesto", MySqlDbType.Double)).Value = valSinImp
                .Parameters.Add(New MySqlParameter("?IdFactura", MySqlDbType.Int32)).Value = IdFact
                .Transaction = trSql
                idDet = .ExecuteScalar
                .Dispose()
            End With
            'Inserta el IVA de cada Item 
            If dtsData.Tables("VD010101").Rows(fil).Item("I_M_IVA") = "1" Then
                'Segun Datos Sri 14%
                Call InsertarDetImpFactura(idDet, "2", (por_iva * 100), valSinImp, dtsData.Tables("VD010101").Rows(fil).Item("VAL_IVA"))
            Else
                'Caso Contrario no Genera Impuesto 0%
                Call InsertarDetImpFactura(idDet, "2", 0, valSinImp, dtsData.Tables("VD010101").Rows(fil).Item("VAL_IVA"))
            End If
        Next
        'Inserta el Total del Iva Acumulado en el detalle
        'Insertar Datos de Iva 0%
        If vet_iva0 > 0 Then
            Call InsertarFacturaImpuesto(IdFact, "2", 0, vet_iva0, val_iva0)
        End If
        'Inserta Datos de Iva 12
        If vet_iva12 > 0 Then
            Call InsertarFacturaImpuesto(IdFact, "2", (por_iva * 100), vet_iva12, val_iva12)
        End If
    End Sub*/
    
    private function InsertarDetFactura($con,$idCab) {
        $cabFact= $this->cabEdoc;
        $detFact= $this->detEdoc;
        //Dim por_iva As Decimal = CDbl(dtsData.Tables("VC010101").Rows(0).Item("POR_IVA")) / 100
        $por_iva=intval($cabFact['IVA_PORCENTAJE']);//12;//Recuperar el impuesto de alguna tabla    o recuperar de la Cabecera    
        $idDet=0;
        $valSinImp = 0;
        $val_iva12 = 0;
        $vet_iva12 = 0;
        $val_iva0 = 0;//Valor de Iva
        $vet_iva0 = 0;//Venta total con Iva

        for ($i = 0; $i < sizeof($detFact); $i++) {
            $valSinImp = $detFact[$i]['TOTALSINIMPUESTOS'];//floatval($detFact[$i]['T_VENTA']) - floatval($detFact[$i]['VAL_DES']);
            //%codigo iva segun tabla #17
            $codigoImp=$detFact[$i]['IMP_CODIGO'];
            if ($codigoImp == '2') {
                $val_iva12 = $val_iva12 + ((floatval($detFact[$i]['CANTIDAD'])*floatval($detFact[$i]['PRECIOUNITARIO'])-floatval($detFact[$i]['DESC']))* (floatval($por_iva)/100));
                $vet_iva12 = $vet_iva12 + $valSinImp;
            } else {
                $val_iva0 = 0;
                $vet_iva0 = $vet_iva0 + $valSinImp;
            }
            $CodigoAuxiliar=($detFact[$i]['CODIGOPRINCIPAL']!='')?$detFact[$i]['CODIGOPRINCIPAL']:1;
            $sql = "INSERT INTO " . $con->db_edoc . ".NubeDetalleFactura
                        (CodigoPrincipal,CodigoAuxiliar,Descripcion,Cantidad,PrecioUnitario,Descuento,PrecioTotalSinImpuesto,IdFactura) VALUES 
                        (:CodigoPrincipal,:CodigoAuxiliar,:Descripcion,:Cantidad,:PrecioUnitario,:Descuento,:PrecioTotalSinImpuesto,:IdFactura);";
            
            $comando = $con->createCommand($sql);
            $comando->bindParam(":CodigoPrincipal", $detFact[$i]['CODIGOPRINCIPAL'], \PDO::PARAM_STR);
            $comando->bindParam(":CodigoAuxiliar", $CodigoAuxiliar, \PDO::PARAM_STR);
            $comando->bindParam(":Descripcion", $detFact[$i]['DESCRIPCION'], \PDO::PARAM_STR);
            $comando->bindParam(":Cantidad", $detFact[$i]['CANTIDAD'], \PDO::PARAM_STR);
            $comando->bindParam(":PrecioUnitario", $detFact[$i]['PRECIOUNITARIO'], \PDO::PARAM_STR);
            $comando->bindParam(":Descuento", $detFact[$i]['DESC'], \PDO::PARAM_STR);
            $comando->bindParam(":PrecioTotalSinImpuesto", $valSinImp, \PDO::PARAM_STR);
            $comando->bindParam(":IdFactura", $idCab, \PDO::PARAM_INT);
            $comando->execute();
            $idDet = $con->getLastInsertID();
            
            //Inserta el IVA de cada Item             
            if ($codigoImp == '2') {//Verifico si el ITEM tiene Impuesto 12%
                //Segun Datos Sri
                $valIvaImp=(floatval($valSinImp)*floatval($por_iva))/100;//Calculo del Valor del Impuesto Generado por Detalle
                $this->InsertarDetImpFactura($con, $idDet, '2',$por_iva, $valSinImp, $valIvaImp); //12%
            } else {//Caso Contrario no Genera Impuesto 0%
                $this->InsertarDetImpFactura($con, $idDet, '2','0', $valSinImp, '0'); //0%
            }
        }
        //Inserta el Total del Iva Acumulado en el detalle
        //Insertar Datos de Iva 0%
        If ($vet_iva0 > 0) {
            $this->InsertarFacturaImpuesto($con, $idCab, '2','0', $vet_iva0, $val_iva0);
        }
        //Inserta Datos de Iva 12
        If ($vet_iva12 > 0) {
            $this->InsertarFacturaImpuesto($con, $idCab, '2', $por_iva, $vet_iva12, $val_iva12);
        }
    }

    private function InsertarDetImpFactura($con, $idDet, $codigo, $Tarifa, $t_venta, $val_iva) {
        $CodigoPor= $this->retornaTarifaDelIva($Tarifa);
        $sql = "INSERT INTO " . $con->db_edoc . ".NubeDetalleFacturaImpuesto
                    (Codigo,CodigoPorcentaje,BaseImponible,Tarifa,Valor,IdDetalleFactura)VALUES
                    (:Codigo,:CodigoPorcentaje,:BaseImponible,:Tarifa,:Valor,:IdDetalleFactura);";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":Codigo", $codigo, \PDO::PARAM_STR);
        $comando->bindParam(":CodigoPorcentaje", $CodigoPor, \PDO::PARAM_STR);
        $comando->bindParam(":BaseImponible", $t_venta, \PDO::PARAM_STR);
        $comando->bindParam(":Tarifa", $Tarifa, \PDO::PARAM_STR);
        $comando->bindParam(":Valor", $val_iva, \PDO::PARAM_STR);
        $comando->bindParam(":IdDetalleFactura", $idDet, \PDO::PARAM_INT);
        $comando->execute();        
    }
    
    private function InsertarFacturaImpuesto($con, $idCab, $codigo, $Tarifa, $t_venta, $val_iva) {
        $CodigoPor= $this->retornaTarifaDelIva($Tarifa);
        $sql = "INSERT INTO " . $con->db_edoc . ".NubeFacturaImpuesto
                    (Codigo,CodigoPorcentaje,BaseImponible,Tarifa,Valor,IdFactura)VALUES
                    (:Codigo,:CodigoPorcentaje,:BaseImponible,:Tarifa,:Valor,:IdFactura);";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":Codigo", $codigo, \PDO::PARAM_STR);
        $comando->bindParam(":CodigoPorcentaje", $CodigoPor, \PDO::PARAM_STR);
        $comando->bindParam(":BaseImponible", $t_venta, \PDO::PARAM_STR);
        $comando->bindParam(":Tarifa", $Tarifa, \PDO::PARAM_STR);
        $comando->bindParam(":Valor", $val_iva, \PDO::PARAM_STR);
        $comando->bindParam(":IdFactura", $idCab, \PDO::PARAM_INT);
        $comando->execute();        
    }

    /*Private Sub InsertarFacturaFormaPago(ByVal dtsData As DataSet, ByVal IdFact As Integer)
        'Implementado 8/08/2016
        'FOR_PAG_SRI,PAG_PLZ,PAG_TMP,VAL_NET
        'Nota la Tabla Forma de Pago debe ser aigual que la SEA Y WEBSEA los IDS deben conincidir.
        'Si no tiene codigo usa el codigo 1 (SIN UTILIZACION DEL SISTEMA FINANCIERO o Efectivo)
        Dim IdsForma As Int32 = 0
        Dim Total As Double = 0
        Dim Plazo As Int32 = 0
        Dim UnidadTiempo As String = ""
        With dtsData.Tables("VC010101").Rows(0)
            IdsForma = IIf(.Item("FOR_PAG_SRI") <> "", CInt(.Item("FOR_PAG_SRI")), 1) '($cabFact[$i]['FOR_PAG_SRI']!='')?$cabFact[$i]['FOR_PAG_SRI']:'1';
            Total = IIf(CDbl(.Item("VAL_NET")) > 0, CDbl(.Item("VAL_NET")), 0) '($cabFact[$i]['VAL_NET']!='')?$cabFact[$i]['VAL_NET']:0;
            Plazo = IIf(CInt(.Item("PAG_PLZ")) > 0, .Item("PAG_PLZ"), 30) '($cabFact[$i]['PAG_PLZ']>0)?$cabFact[$i]['PAG_PLZ']:'30';
            UnidadTiempo = IIf(.Item("PAG_TMP") <> "", .Item("PAG_TMP"), "DIAS") '($cabFact[$i]['PAG_TMP']!='')?$cabFact[$i]['PAG_TMP']:'DIAS';
        End With
        If cmSql IsNot Nothing Then cmSql.Dispose()
        cmSql = New MySqlCommand
        With cmSql
            .Connection = cn
            .CommandType = CommandType.Text

            .CommandText = "INSERT INTO NubeFacturaFormaPago " & _
                    "(IdForma,IdFactura,FormaPago,Total,Plazo,UnidadTiempo) VALUES " & _
                    "(?IdForma,?IdFactura,?FormaPago,?Total,?Plazo,?UnidadTiempo) "

            .Parameters.Add(New MySqlParameter("?IdForma", MySqlDbType.Int32)).Value = IdsForma
            .Parameters.Add(New MySqlParameter("?IdFactura", MySqlDbType.Int32)).Value = IdFact
            .Parameters.Add(New MySqlParameter("?FormaPago", MySqlDbType.VarChar)).Value = IdsForma.ToString("00")
            .Parameters.Add(New MySqlParameter("?Total", MySqlDbType.Double)).Value = Total
            .Parameters.Add(New MySqlParameter("?Plazo", MySqlDbType.Int32)).Value = Plazo
            .Parameters.Add(New MySqlParameter("?UnidadTiempo", MySqlDbType.VarChar)).Value = UnidadTiempo
            .Transaction = trSql
            'idDet = .ExecuteScalar
            .ExecuteNonQuery()
            .Dispose()
        End With

    End Sub*/       
    
    private function InsertarFacturaFormaPago($con, $idCab) {
        $fpagEdoc= $this->fpagEdoc;
        //Implementado 8/08/2016
        //FOR_PAG_SRI,PAG_PLZ,PAG_TMP,VAL_NET =>$cabFact[$i]['VAL_NET']
        //Nota la Tabla Forma de Pago debe ser aigual que la SEA Y WEBSEA los IDS deben conincidir.
        //Si no tiene codigo usa el codigo 1 (SIN UTILIZACION DEL SISTEMA FINANCIERO o Efectivo)
        $IdsForma = $fpagEdoc['COD_FORMAPAG']; //($fpagEdoc['COD_FORMAPAG']!='')?$fpagEdoc['FOR_PAG_SRI']:'1';
        $Total=$fpagEdoc['VALOR'];//($fpagEdoc['VALOR']!='')?$fpagEdoc['VAL_NET']:0;
        $Plazo=$fpagEdoc['PLAZO'];//($fpagEdoc['PLAZO']>0)?$fpagEdoc['PLAZO']:'30';
        $UnidadTiempo=$fpagEdoc['UNIDAD_TIEMPO'];//($fpagEdoc['UNIDAD_TIEMPO']!='')?$fpagEdoc['UNIDAD_TIEMPO']:'DIAS';
        
        $sql = "INSERT INTO " . $con->db_edoc . ".NubeFacturaFormaPago
                (IdForma,IdFactura,FormaPago,Total,Plazo,UnidadTiempo)VALUES
                (:IdForma,:IdFactura,:FormaPago,:Total,:Plazo,:UnidadTiempo);";
        
        $comando = $con->createCommand($sql);
        $comando->bindParam(":IdForma", $IdsForma, \PDO::PARAM_STR);
        $comando->bindParam(":IdFactura", $idCab, \PDO::PARAM_INT);
        $comando->bindParam(":FormaPago", $IdsForma, \PDO::PARAM_STR);
        $comando->bindParam(":Total", $Total, \PDO::PARAM_STR);
        $comando->bindParam(":Plazo", $Plazo, \PDO::PARAM_STR);
        $comando->bindParam(":UnidadTiempo", $UnidadTiempo, \PDO::PARAM_STR);
        $comando->execute();       
    }
    
    

    private function InsertarFacturaDatoAdicional($con, $idCab) {
        $dadcEdoc = $this->dadcEdoc;
        for ($i = 0; $i < sizeof($dadcEdoc); $i++) {
            $sql = "INSERT INTO " . $con->db_edoc . ".NubeDatoAdicionalFactura 
                 (Nombre,Descripcion,IdFactura) VALUES (:Nombre,:Descripcion,:IdFactura);";
            //('Direccion','$direccion','$idCab'),('Destino','$destino','$idCab'),('Contacto','$contacto','$idCab')";

            $comando = $con->createCommand($sql);
            $comando->bindParam(":Nombre", $dadcEdoc[$i]['NOMBRECAMPO'], \PDO::PARAM_STR);
            $comando->bindParam(":Descripcion", $dadcEdoc[$i]['VALORCAMPO'], \PDO::PARAM_STR);
            $comando->bindParam(":IdFactura", $idCab, \PDO::PARAM_INT);
            $comando->execute();
        }
    }

    /*
     * FIN DE PROCESO DE FACTURAS
     */
    

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