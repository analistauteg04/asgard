/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    // para mostrar codigo de area
    $('#cmb_pais_dom').change(function () {
        var link = $('#txth_base').val() + "/inscripciones/index";
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
        alert('llego aqui');
        var link = $('#txth_base').val() + "/inscripciones/guardarinscripcion";
        var arrParams = new Object();
        arrParams.pges_pri_nombre = $('#txt_primer_nombre').val();
        arrParams.pges_pri_apellido = $('#txt_primer_apellido').val();
        arrParams.tipo_dni = $('#cmb_tipo_dni').val();
        arrParams.pges_cedula = $('#txt_cedula').val();
        arrParams.pges_correo = $('#txt_correo').val();
        arrParams.pais = $('#cmb_pais_dom').val();
        arrParams.pges_celular = $('#txt_celular').val();
        arrParams.pges_pasaporte = $('#txt_pasaporte').val();
        arrParams.unidad = $('#cmb_ninteres').val();
        arrParams.modalidad = $('#cmb_modalidad').val();
        arrParams.conoce = $('#cmb_conuteg').val();
        arrParams.carrera = $('#cmb_carrera1').val();
        if (!validateForm()) {
            requestHttpAjax(link, arrParams, function (response) {
                showAlert(response.status, response.label, response.message);
                if (!response.error) {
                    setTimeout(function () {
                        window.location.href = $('#txth_base').val() + "/inscripciones/index";
                    }, 5000);
                }


            }, true);
        }

    });
    $('#sendInscripcionsolicitud').click(function () {
        alert('llego aqui');
        var link = $('#txth_base').val() + "/inscripciones/guardarinscripcionsolicitud";
        var arrParams = new Object();
        arrParams.pges_pri_nombre = $('#txt_primer_nombre').val();
        arrParams.pges_pri_apellido = $('#txt_primer_apellido').val();
        arrParams.tipo_dni = $('#cmb_tipo_dni').val();
        arrParams.pges_cedula = $('#txt_cedula').val();
        arrParams.pges_correo = $('#txt_correo').val();
        arrParams.pais = $('#cmb_pais_dom').val();
        arrParams.pges_celular = $('#txt_celular').val();
        arrParams.pges_pasaporte = $('#txt_pasaporte').val();
        arrParams.unidad = $('#cmb_ninteres').val();
        arrParams.modalidad = $('#cmb_modalidad').val();
        arrParams.conoce = $('#cmb_conuteg').val();
        arrParams.carrera = $('#cmb_carrera1').val();
        if (!validateForm()) {
            requestHttpAjax(link, arrParams, function (response) {
                showAlert(response.status, response.label, response.message);
                if (!response.error) {
                    setTimeout(function () {
                        window.location.href = $('#txth_base').val() + "/inscripciones/indexadmisionn";
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

    $('#cmb_ninteres').change(function () {
        var link = $('#txth_base').val() + "/inscripciones/index";
        var arrParams = new Object();
        arrParams.nint_id = $(this).val();
        arrParams.getmodalidad = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.modalidad, "cmb_modalidad");
                var arrParams = new Object();
                if (data.modalidad.length > 0) {
                    arrParams.unidada = $('#cmb_ninteres').val();
                    arrParams.moda_id = data.modalidad[0].id;
                    arrParams.getcarrera = true;
                    requestHttpAjax(link, arrParams, function (response) {
                        if (response.status == "OK") {
                            data = response.message;
                            setComboData(data.carrera, "cmb_carrera1");
                        }
                    }, true);
                }
            }
        }, true);
    });

    $('#cmb_modalidad').change(function () {
        var link = $('#txth_base').val() + "/inscripciones/index";
        var arrParams = new Object();
        arrParams.unidada = $('#cmb_ninteres').val();
        arrParams.moda_id = $(this).val();
        arrParams.getcarrera = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.carrera, "cmb_carrera1");
            }
        }, true);
    });

});

