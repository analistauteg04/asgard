$(document).ready(function () {

//Guardar programacion luego borrar cuando se hace el boton desde el frm configuracion
    $('#sendProgramacion').click(function () {
        var link = $('#txth_base').val() + "/marketing/email/guardarprogramacion";        
        var arrParams = new Object();
        arrParams.lista = $('#cmb_lista').val();
        arrParams.plantilla = $('#cmb_template').val();
        /*arrParams.check_dia_1 = $('#cmb_tipo_dni').val();
        arrParams.check_dia_2 = $('#txt_cedula').val();
        arrParams.check_dia_3 = $('#txt_correo').val();
        arrParams.check_dia_4 = $('#cmb_pais_dom').val();
        arrParams.check_dia_5 = $('#txt_celular').val();
        arrParams.check_dia_6 = $('#txt_pasaporte').val();
        arrParams.check_dia_7 = $('#cmb_ninteres').val();*/
        arrParams.fecha_inicio = $('#txt_fecha_inicio').val();
        arrParams.fecha_fin = $('#txt_fecha_fin').val();
        arrParams.hora_envio = $('#txthoraenvio').val();        
        if (!validateForm()) {
            requestHttpAjax(link, arrParams, function (response) {
                showAlert(response.status, response.label, response.message);
                if (!response.error) {
                    setTimeout(function () {
                        window.location.href = $('#txth_base').val() + "/marketing/email/programacion";
                    }, 5000);
                }


            }, true);
        }

    });
});

