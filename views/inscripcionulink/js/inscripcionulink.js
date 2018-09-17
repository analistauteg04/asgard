/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    // para mostrar codigo de area
    $('#cmb_pais_dom').change(function () {
        var link = $('#txth_base').val() + "/inscripcionulink/index";
        var arrParams = new Object();
        arrParams.codarea = $(this).val();
        arrParams.getarea = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                $('#txt_codigoarea').val(data.area['name']);
            }
        }, true);
    });

    $('#sendInscripcion').click(function () {
        var link = $('#txth_base').val() + "/inscripcionulink/guardarinscripcion";
        var arrParams = new Object();
        arrParams.pri_nombre = $('#txt_primer_nombre').val();
        arrParams.pri_apellido = $('#txt_primer_apellido').val();
        arrParams.tipo_dni = $('#cmb_tipo_dni').val();
        arrParams.cedula = $('#txt_cedula').val();
        arrParams.correo = $('#txt_correo').val();
        arrParams.pais = $('#cmb_pais_dom').val();
        arrParams.celular = $('#txt_celular').val();
        arrParams.pasaporte = $('#txt_pasaporte').val();
        arrParams.unidad = $('#cmb_ninteres').val();
        arrParams.modalidad = $('#cmb_modalidad').val();
        arrParams.conoce = $('#cmb_conuteg').val();
        arrParams.carrera = $('#cmb_modulo').val();
        if (!validateForm()) {
            requestHttpAjax(link, arrParams, function (response) {
                showAlert(response.status, response.label, response.message);
                if (!response.error) {
                    setTimeout(function () {
                        window.location.href = $('#txth_base').val() + "/inscripcionulink/index";
                    }, 5000);
                }


            }, true);
        }

    });

    $('#cmb_tipo_dni').change(function () {
        if ($('#cmb_tipo_dni').val() == 'PASS') {
            $('#txt_cedula').removeClass("PBvalidation");
            $('#txt_pasaporte').addClass("PBvalidation");
            $('#Divpasaporte').show();
            $('#Divcedula').hide();
        } else if ($('#cmb_tipo_dni').val() == 'CED')
        {
            $('#txt_pasaporte').removeClass("PBvalidation");
            $('#txt_cedula').addClass("PBvalidation");
            $('#Divpasaporte').hide();
            $('#Divcedula').show();
        }
    });
});

