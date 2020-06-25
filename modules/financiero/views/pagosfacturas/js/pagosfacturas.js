/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    $('#btn_guardarpago').click(function () {
        guardarPagofactura();
    });
    $('#btn_grabar_rechazo').click(function () {
        rechazarPago();
    });
});
function guardarPagofactura() {
    var arrParams = new Object();
    var link = $('#txth_base').val() + "/financiero/pagosfacturas/savepagopendiente";
    var selected = '';
    arrParams.estid = $('#txth_idest').val();
    arrParams.per_id = $('#txth_per').val();
    arrParams.referencia = $('#txt_referencia').val();
    arrParams.formapago = $('#cmb_formapago').val();
    arrParams.valor = $('#txt_valor').val();
    arrParams.fechapago = $('#txt_fechapago').val();
    arrParams.observacion = $('#txt_observa').val();
    arrParams.documento = $('#txth_doc_pago').val();
    $('#TbgPagopendiente input[type=checkbox]').each(function () {
        if (this.checked) {
            selected += $(this).val() + '*';
        }
    });
    arrParams.pagado = selected.slice(0, -1);    
    if (arrParams.pagado != '') {

        if (arrParams.formapago == '0') {
            var mensaje = {wtmessage: "Método Pago : El campo no debe estar vacío.", title: "Error"};
            showAlert("NO_OK", "error", mensaje);
        } else {
            if (!validateForm()) {
                requestHttpAjax(link, arrParams, function (response) {
                    showAlert(response.status, response.label, response.message);
                    setTimeout(function () {
                        parent.window.location.href = $('#txth_base').val() + "/financiero/pagosfacturas/viewsaldo";
                    }, 2000);
                }, true);
            }
        }
    } else {
        var mensaje = {wtmessage: "Datos Facturas Pendientes : Debe seleccionar las cuotas.", title: "Error"};
        showAlert("NO_OK", "error", mensaje);
    }
}

function rechazarPago() {
    var arrParams = new Object();
    var link = $('#txth_base').val() + "/financiero/pagosfacturas/saverechazo";
    arrParams.dpfa_id = $('#txth_dpfa_id').val();
    arrParams.resultado = $('#cmb_estado').val();
    arrParams.observacion = $('#cmb_observacion').val();
    if (!validateForm()) {
        requestHttpAjax(link, arrParams, function (response) {
            showAlert(response.status, response.label, response.message);
            setTimeout(function () {
                parent.window.location.href = $('#txth_base').val() + "/financiero/pagosfacturas/revisionpagos";
            }, 2000);
        }, true);
    }
}

