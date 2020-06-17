/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {
    $('#btn_guardarpago').click(function() {
        guardarPagofactura();
    });
});

function guardarPagofactura() {
    var arrParams = new Object();
    var link = $('#txth_base').val() + "/financiero/pagosfacturas/savepagopendiente";
    arrParams.referencia = $('#txt_referencia').val();
    arrParams.formapago = $('#cmb_forma_pago').val();
    arrParams.valor = $('#txt_valor').val();
    arrParams.fechapago = $('#txt_fechapago').val();
    arrParams.observacion = $('txt_observa').val();
    arrParams.docuemento = $('txth_doc_pago').val();
    arrParams.estid = $('txth_idest').val();
    arrParams.per_id = $('#txth_per').val();

    if (!validateForm()) {
        requestHttpAjax(link, arrParams, function(response) {
            showAlert(response.status, response.label, response.message);
            setTimeout(function() {
                parent.window.location.href = $('#txth_base').val() + "/financiero/pagosfacturas/viewsaldo";
            }, 2000);

        }, true);
    }
}

