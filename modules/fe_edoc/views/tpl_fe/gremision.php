<style>
    .modCab{
        color: #000000;        
        line-height: 16px;
    }
    .panelUserInfo{
        /*margin: 10px 0px 18px;*/
        margin: 5px 0px 0px;
    }    
    .tcoll_cen {
        width: 50%;
        float: left;
        font-size: 10px;
        text-align: left;
    }
    .tcolr_cen {
        width: 50%;
        float: left;
        font-size: 10px;
        text-align: left;
    }
    .tcoll_cen2 {
        width: 40%;
        float: left;
        font-size: 10px;
        text-align: left;
    }
    .tcolr_cen2 {
        width: 60%;
        float: left;
        font-size: 10px;
        text-align: left;
    }
    .tcoll_ad {
        width: 30%;
        float: left;
        font-size: 10px;
        text-align: left;
    }
    .tcolr_ad {
        width: 70%;
        float: left;
        font-size: 10px;
        text-align: left;
    }
    .divDetalles{
        float: left;
        width: 100%;
        position: absolute;      
        left: 0;
        margin-top: 10px;
    }
    .divDetalleAd{
        float: left;
        width: 65%;
        position: absolute;      
        left: 0;
    }
    .divDetalleTot{  
        width: 35%;
        position: absolute;      
        right: 0;
    }
    .div_modInfoAd{
        float: left;
        width: 70%;
    }
    .div_modInfoVal{
        float: left;
        width: 100%;       
    }
    .div_modInfoDet{
        float: left;
        width: 60%;
    }
    .div_modInfoDet2{
        float: left;
        width: 75%;
    }
    .div_modInfoDet1{
        float: left;
        width: 40%;
    }    
    .bordeDivDet{ 
        border: 1px solid #000000;       
        -moz-border-radius: 7px;
        -webkit-border-radius: 7px;
        padding: 10px;
    }    
    .valorAlign{ 
        text-align: right !important;
    }
    .divDetaVacio{
        height: 100px;
    }
</style>
<div class="panelUserInfo">
    <div class="bordeDivDet">
        <div class="div_modInfoDet modCab">
            <div>
                <div class="tcoll_cen"><?php echo app\modules\fe_edoc\Module::t("fe", "DNI (Haulier)") ?>:</div>
                <div class="tcolr_cen"><?php echo $rucTransportista; ?></div>
            </div>
            <div>
                <div class="tcoll_cen"><?php echo app\modules\fe_edoc\Module::t("fe", "Business Name / Names and Lastnames") ?>:</div>
                <div class="tcolr_cen"><?php echo $razonSocTransportista; ?></div>
            </div>
            <div>
                <div class="tcoll_cen"><?php echo app\modules\fe_edoc\Module::t("fe", "Plaque") ?>:</div>
                <div class="tcolr_cen"><?php echo $placa; ?></div>
            </div>
            <div>
                <div class="tcoll_cen"><?php echo app\modules\fe_edoc\Module::t("fe", "Starting Point") ?>:</div>
                <div class="tcolr_cen"><?php echo $dirPartida; ?></div>
            </div>
        </div>
        <div class="clear"></div>
        <div class="div_modInfoDet modCab">
            <div>
                <div class="tcoll_cen"><?php echo app\modules\fe_edoc\Module::t("fe", "Start Date Transport") ?>:</div>
                <div class="tcolr_cen"><?php echo $fechaIniTransporte; ?></div>
            </div>
        </div>
        <div class="div_modInfoDet1 modCab">
            <div>
                <div class="tcoll_cen"><?php echo app\modules\fe_edoc\Module::t("fe", "Fin Date Transport") ?>:</div>
                <div class="tcolr_cen"><?php echo $fechaFinTransporte; ?></div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="bordeDivDet">
        <div class="div_modInfoDet modCab">
            <div>
                <div class="tcoll_cen"><?php echo app\modules\fe_edoc\Module::t("fe", "Proof of Purchase") ?>:</div>
                <div class="tcolr_cen"><?php echo app\modules\fe_edoc\Module::t("fe", "INVOICE") . "  " . $numDocSustento; ?></div>
            </div>
        </div>
        <div class="div_modInfoDet1 modCab">
            <div> 
                <div class="tcoll_cen"><?php echo app\modules\fe_edoc\Module::t("fe", "Date of Issue") ?>:</div>
                <div class="tcolr_cen"><?php echo $fechaEmisionDocSustento; ?></div>
            </div>
        </div>
        <div class="clear"></div>
        <div class="div_modInfoDet2 modCab">
            <div>
                <div class="tcoll_cen2"><?php echo app\modules\fe_edoc\Module::t("fe", "Authorization Number") ?>:</div>
                <div class="tcolr_cen2"><?php echo $numAutDocSustento; ?></div>
            </div>
            <br/>
            <div>
                <div class="tcoll_cen2"><?php echo app\modules\fe_edoc\Module::t("fe", "Reason Transfer") ?>:</div>
                <div class="tcolr_cen2"><?php echo $motivoTraslado; ?></div>
            </div>
            <div>
                <div class="tcoll_cen2"><?php echo app\modules\fe_edoc\Module::t("fe", "Destination (Point of Arrival)") ?>:</div>
                <div class="tcolr_cen2"><?php echo $dirDestinatario; ?></div>
            </div>
            <div>
                <div class="tcoll_cen2"><?php echo app\modules\fe_edoc\Module::t("fe", "DNI (Recipient)") ?>:</div>
                <div class="tcolr_cen2"><?php echo $identificacionDestinatario; ?></div>
            </div>
            <div>
                <div class="tcoll_cen2" ><?php echo app\modules\fe_edoc\Module::t("fe", "Business Name / Names and Lastnames") ?>:</div>
                <div class="tcolr_cen2"><?php echo $razonSocialDestinatario; ?></div>
            </div>
            <div>
                <div class="tcoll_cen2"><?php echo app\modules\fe_edoc\Module::t("fe", "Customs Document") ?>:</div>
                <div class="tcolr_cen2"><?php echo $docAduaneroUnico; ?></div>
            </div>
            <div>
                <div class="tcoll_cen2"><?php echo app\modules\fe_edoc\Module::t("fe", "Set Destination Code") ?>:</div>
                <div class="tcolr_cen2"><?php echo $codEstabDestino; ?></div>
            </div>
            <div>
                <div class="tcoll_cen2"><?php echo app\modules\fe_edoc\Module::t("fe", "Ruta") ?>:</div>
                <div class="tcolr_cen2"><?php echo $ruta; ?></div>
            </div>
        </div>
        <br/>
        <div class="clear"></div>
        <div class="div_modInfoVal">
            <table>    
                <tr>
                    <td class="thcol"><?php echo app\modules\fe_edoc\Module::t("fe", 'Amount'); ?></td>
                    <td class="thcol"><?php echo app\modules\fe_edoc\Module::t("fe", 'Description'); ?></td>
                    <td class="thcol"><?php echo app\modules\fe_edoc\Module::t("fe", 'Code Principal'); ?></td>
                    <td class="thcol"><?php echo app\modules\fe_edoc\Module::t("fe", 'Code Auxiliary'); ?></td>
                </tr>
                <?php
                foreach ($arr_detalles as $arr_detalle) {
                    $cantidad = isset($arr_detalle["cantidad"]) ? trim($arr_detalle["cantidad"]) : "";
                    $descripcion = isset($arr_detalle["descripcion"]) ? trim($arr_detalle["descripcion"]) : "";
                    $codPrincipal = isset($arr_detalle["codigoInterno"]) ? trim($arr_detalle["codigoInterno"]) : "";
                    $codAuxiliar = isset($arr_detalle["codigoAdicional"]) ? trim($arr_detalle["codigoAdicional"]) : "";
                    echo "<tr>";
                    echo "<td style='text-align: left;'>" . $cantidad . "</td>";
                    echo "<td style='text-align: left;'>" . $descripcion . "</td>";
                    echo "<td style='text-align: left;'>" . $codPrincipal . "</td>";
                    echo "<td style='text-align: left;'>" . $codAuxiliar . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>
    <div class="divDetalles">
        <div class="divDetalleAd ">
            <div class="bordeDivDet modCab div_modInfoAd <?php if (!isset($arr_infoAdicional)) { ?>divDetaVacio<?php 
                                                                                                            } ?>">
                <div>
                    <div class="tcoll bold" style="width: 90%; alignment-adjust: center"><?php echo app\modules\fe_edoc\Module::t("fe", "Additional Information") ?></div>
                </div>
                <?php
                if (isset($arr_infoAdicional)) {
                    $arr_detalles_adi = $arr_infoAdicional["campoAdicional"];
                    if (array_key_exists('0', $arr_detalles_adi)) {
                        $arr_detalles_adi = $arr_infoAdicional["campoAdicional"];
                    } else {
                        $arr_detalles_adi = $arr_infoAdicional;
                    }
                    foreach ($arr_detalles_adi as $arr_detallesadi) {
                        $detalle_nombre = trim($arr_detallesadi["@nombre"]);
                        $detalle_valor = trim($arr_detallesadi["$"]);
                        if ($detalle_nombre != "" && $detalle_valor != "") {
                            $nombre_adicional = GALGOMEDIA::cambiarFormatoCapitalizar($detalle_nombre, true);
                            ?>
                            <div>
                                <div class="tcoll_ad"><?php echo $nombre_adicional ?>:</div>
                                <div class="tcolr_ad"><?php echo $detalle_valor; ?></div>
                            </div> 
                            <?php

                        }
                    }
                }
                ?>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>