$(document).ready(function () {

//Guardar programacion luego borrar cuando se hace el boton desde el frm configuracion
    $('#sendProgramacion').click(function () {
        var link = $('#txth_base').val() + "/marketing/email/guardarprogramacion";        
        var arrParams = new Object();
        arrParams.lista = $('#cmb_lista').val();
        arrParams.plantilla = $('#cmb_template').val();
        /************************************************/
        /*arrParams.check_dia_1 = $('#check_dia_1').val();
        arrParams.check_dia_2 = $('#check_dia_2').val();
        arrParams.check_dia_3 = $('#check_dia_3').val();
        arrParams.check_dia_4 = $('#check_dia_4').val();
        arrParams.check_dia_5 = $('#check_dia_5').val();
        arrParams.check_dia_6 = $('#check_dia_6').val();
        arrParams.check_dia_7 = $('#check_dia_7').val();*/
        /************************************************/
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

