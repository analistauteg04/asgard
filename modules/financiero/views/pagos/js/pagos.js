
$(document).ready(function () {
    /**
     * Function evento click en botón de Revisarpagocarga
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return 
     */
    // BORRAR LUEGO
    $('#btn_enviar').click(function () {
        var arrParams = new Object();
        var link = $('#txth_base').val() + "/financiero/pagos/savepago";

        arrParams.opag_id = $('#txth_ids').val();
        arrParams.estado_revision = $('#cmb_revision').val();
        arrParams.valor = $('#txth_val').val();
        arrParams.valorpagado = $('#txth_valp').val();
        arrParams.valortotal = $('#txth_valt').val();

        if ($('#cmb_revision').val() == "AP")
        {
            arrParams.observacion = "";
        } else
        {
            arrParams.observacion = $('#cmb_observacion').val();
        }
        arrParams.idd = $('#txth_idd').val();
        arrParams.int_id = $('#txth_int').val();
        arrParams.sins_id = $('#txth_sins').val();
        arrParams.per_id = $('#txth_perid').val();

        arrParams.controladm = '0';

        if ($('#cmb_revision').val() == "AP") {
            $('#cmb_observacion').removeClass("PBvalidation");
            arrParams.banderacrea = '1';
            if ((arrParams.valorpagado > 0) && (arrParams.valortotal > 0) && ((arrParams.valorpagado + arrParams.valor) > arrParams.valortotal)) {
                alert('Con este pago sobrepasa al valor total aprobado y pendiente.');
                return;
            }
        } else {
            arrParams.banderacrea = '0';
        }

        if (!validateForm()) {
            requestHttpAjax(link, arrParams, function (response) {
                $('#cmb_revision').val(0);
                $('#cmb_observacion').val(0);
                $('#txth_ids').val("");
                showAlert(response.status, response.label, response.message);

                setTimeout(function () {
                    parent.window.location.href = $('#txth_base').val() + "/financiero/pagos/validarpagocarga?ido=" + arrParams.opag_id;
                }, 2000);

            }, true);
        }
    });

    function cerrarpopup() {
        $('.mfp-close').trigger('click');
    }
    // BORRAR LUEGO
    $('#cmd_enviarData').click(function () {
        var arrParams = new Object();
        var link = $('#txth_base').val() + "/financiero/pagos/savecarga";
        var idpago = $('#txth_ids').val();
        var pg = $('#txth_pg').val();
        arrParams.idpago = $('#txth_ids').val();
        arrParams.totpago = $('#txth_tot').val();
        arrParams.pago = $('#txt_pago').val();
        arrParams.documento = $('#txth_doc_titulo').val();
        arrParams.metodopago = $('#cmb_forma_pago').val();
        arrParams.numtransaccion = $('#txt_numtransaccion').val();
        arrParams.fechatransaccion = $('#txt_fecha_transaccion').val();
        arrParams.vista = $('#txth_vista').val();

        if (parseFloat(arrParams.pago) > parseFloat(arrParams.totpago))
        {
            alert("Está tratando de ingresar un pago mayor al valor de su servicio. $" + parseFloat(arrParams.totpago));
        } else if (parseFloat(arrParams.pago) < parseFloat(arrParams.totpago))
        {
            alert("Está tratando de ingresar un pago menor al valor de su servicio. $" + parseFloat(arrParams.totpago));
        } else {
            if (!validateForm()) {
                requestHttpAjax(link, arrParams, function (response) {
                    showAlert(response.status, response.label, response.message);
                    setTimeout(function () {
                        if (arrParams.vista == 'adm') {
                            parent.window.location.href = $('#txth_base').val() + "/financiero/pagos/index";
                        } else {
                            parent.window.location.href = $('#txth_base').val() + "/financiero/pagos/listarpagosolicitud";
                        }
                    }, 4000);
                }, true);
            }
        }
    });

    /**
     * Function evento click en botón de Registrarpagoadm
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return 
     */
    $('#cmd_registrarPagoadm').click(function () {
        var arrParams = new Object();
        var link = $('#txth_base').val() + "/financiero/pagos/crearpago";
        var valor_pendiente = $('#txth_saldo_pendiente').val();

        arrParams.opag_id = $('#txth_ids').val();
        arrParams.totpago = $('#txth_total').val();
        arrParams.valor = $('#txt_pago').val();
        arrParams.forma_pago = $('#cmb_forma_pago').val();
        arrParams.numero_transaccion = $('#txt_numero_transaccion').val();
        arrParams.fecha_transaccion = $('#txt_fecha_transaccion').val();
        arrParams.estado_revision = "AP";
        arrParams.documento = $('#txth_doc_titulo').val();
        arrParams.observacion = "";
        arrParams.int_id = $('#txth_int').val();
        arrParams.sins_id = $('#txth_sins').val();
        arrParams.per_id = $('#txth_perid').val();
        arrParams.banderacrea = '1';
        arrParams.controladm = '1';

        if (parseFloat(arrParams.valor) > parseFloat(arrParams.totpago))
        {
            alert("Esta tratando de ingresar un pago mayor al valor de su servicio. " + parseFloat(arrParams.totpago));
        } else if (parseFloat(arrParams.valor) > parseFloat(valor_pendiente))
        {
            alert("Esta tratando de ingresar un pago mayor a su valor pendiente. " + parseFloat(valor_pendiente));
        } else {
            if (!validateForm()) {
                requestHttpAjax(link, arrParams, function (response) {
                    showAlert(response.status, response.label, response.message);
                    setTimeout(function () {
                        parent.window.location.href = $('#txth_base').val() + "/financiero/pagos/listarpagosolicitudregistroadm";
                    }, 2000);

                }, true);
            }
        }
    });


    $('#btn_validapago').click(function () {
        alert('Con este pago sobrepasa al valor total aprobado y pendiente.');
    });

    $('#cmb_revision').change(function () {
        if ($('#cmb_revision').val() == 'RE')
        {
            $('#Divobservalbl').show();
            $('#Divobservacmb').show();
        } else
        {
            $('#Divobservalbl').hide();
            $('#Divobservacmb').hide();
        }
    });
    $('#btn_buscarData').click(function () {
        actualizarGrid();
    });
    $('#btn_buscarDataPago').click(function () {
        actualizarGridPagoadm();
    });
    $('#btn_buscarDataReg').click(function () {
        actualizarGridPagoReg();
    });
    $('#btn_buscarPagoscargados').click(function () {
        actualizarGridPagosCargados();
    });
});

function exportExcel() {
    var search = $('#txt_buscarData').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    window.location.href = $('#txth_base').val() + "/financiero/pagos/expexcel?search=" + search + "&f_ini=" + f_ini + "&f_fin=" + f_fin;
}

function actualizarGrid() {
    var search = $('#txt_buscarData').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    //Buscar almenos una clase con el nombre para ejecutar
    if (!$(".blockUI").length) {
        showLoadingPopup();
        $('#TbG_SOLICITUD').PbGridView('applyFilterData', {'f_ini': f_ini, 'f_fin': f_fin, 'search': search});
        setTimeout(hideLoadingPopup, 2000);
    }
}
function actualizarGridPagoadm() {
    var search = $('#txt_buscarDataPago').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    var f_estado = $('#cmb_estado').val();
    //Buscar almenos una clase con el nombre para ejecutar
    if (!$(".blockUI").length) {
        showLoadingPopup();
        $('#TbG_Solicitudes').PbGridView('applyFilterData', {'f_ini': f_ini, 'f_fin': f_fin, 'f_estado': f_estado, 'search': search});
        setTimeout(hideLoadingPopup, 2000);
    }
}
function actualizarGridPagoReg() {
    var search = $('#txt_buscarDataReg').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();

    //Buscar al menos una clase con el nombre para ejecutar
    if (!$(".blockUI").length) {
        showLoadingPopup();
        $('#TbG_Solicitudes').PbGridView('applyFilterData', {'f_ini': f_ini, 'f_fin': f_fin, 'search': search});
        setTimeout(hideLoadingPopup, 2000);
    }
}
function actualizarGridPagosCargados() {
    var search = $('#txt_buscarDataPago').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    var f_estado = $('#cmb_estado').val();
    //Buscar al menos una clase con el nombre para ejecutar
    if (!$(".blockUI").length) {
        showLoadingPopup();
        $('#TbG_Solicitudes').PbGridView('applyFilterData', {'f_ini': f_ini, 'f_fin': f_fin, 'f_estado': f_estado, 'search': search});
        setTimeout(hideLoadingPopup, 2000);
    }
    //Guarda carga de archivos
    function SaveCarga() {
        var arrParams = new Object();
        var link = $('#txth_base').val() + "/financiero/pagos/savecarga";
        var idpago = $('#txth_ids').val();
        var pg = $('#txth_pg').val();
        arrParams.idpago = $('#txth_ids').val();
        arrParams.totpago = $('#txth_tot').val();
        arrParams.pago = $('#txt_pago').val();
        arrParams.documento = $('#txth_doc_titulo').val();
        arrParams.metodopago = $('#cmb_forma_pago').val();
        arrParams.numtransaccion = $('#txt_numtransaccion').val();
        arrParams.fechatransaccion = $('#txt_fecha_transaccion').val();
        arrParams.vista = $('#txth_vista').val();

        if (parseFloat(arrParams.pago) > parseFloat(arrParams.totpago))
        {
            alert("Está tratando de ingresar un pago mayor al valor de su servicio. $" + parseFloat(arrParams.totpago));
        } else if (parseFloat(arrParams.pago) < parseFloat(arrParams.totpago))
        {
            alert("Está tratando de ingresar un pago menor al valor de su servicio. $" + parseFloat(arrParams.totpago));
        } else {
            if (!validateForm()) {
                requestHttpAjax(link, arrParams, function (response) {
                    showAlert(response.status, response.label, response.message);
                    setTimeout(function () {
                        if (arrParams.vista == 'adm') {
                            parent.window.location.href = $('#txth_base').val() + "/financiero/pagos/index";
                        } else {
                            parent.window.location.href = $('#txth_base').val() + "/financiero/pagos/listarpagosolicitud";
                        }
                    }, 4000);
                }, true);
            }
        }
    }
    // VALIDA PAGOS
    function Savepagos() {

        var arrParams = new Object();
        var link = $('#txth_base').val() + "/financiero/pagos/savepago";
        arrParams.opag_id = $('#txth_ids').val();
        arrParams.estado_revision = $('#cmb_revision').val();
        arrParams.valor = $('#txth_val').val();
        arrParams.valorpagado = $('#txth_valp').val();
        arrParams.valortotal = $('#txth_valt').val();
        if ($('#cmb_revision').val() == "AP")
        {
            arrParams.observacion = "";
        } else
        {
            arrParams.observacion = $('#cmb_observacion').val();
        }
        arrParams.idd = $('#txth_idd').val();
        arrParams.int_id = $('#txth_int').val();
        arrParams.sins_id = $('#txth_sins').val();
        arrParams.per_id = $('#txth_perid').val();

        arrParams.controladm = '0';

        if ($('#cmb_revision').val() == "AP") {
            $('#cmb_observacion').removeClass("PBvalidation");
            arrParams.banderacrea = '1';
            if ((arrParams.valorpagado > 0) && (arrParams.valortotal > 0) && ((arrParams.valorpagado + arrParams.valor) > arrParams.valortotal)) {
                alert('Con este pago sobrepasa al valor total aprobado y pendiente.');
                return;
            }
        } else {
            arrParams.banderacrea = '0';
        }
        if (!validateForm()) {
            requestHttpAjax(link, arrParams, function (response) {
                $('#cmb_revision').val(0);
                $('#cmb_observacion').val(0);
                $('#txth_ids').val("");
                showAlert(response.status, response.label, response.message);

                setTimeout(function () {
                    parent.window.location.href = $('#txth_base').val() + "/financiero/pagos/validarpagocarga?ido=" + arrParams.opag_id;
                }, 2000);

            }, true);
        }
    }
}