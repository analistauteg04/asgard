$(document).ready(function () {

    $('#cmb_pais').change(function () {
        var link = $('#txth_base').val() + "/gestion/create";
        var arrParams = new Object();
        arrParams.pai_id = $(this).val();
        arrParams.getprovincias = true;
        arrParams.getarea = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.provincias, "cmb_prov");
                var arrParams = new Object();
                if (data.provincias.length > 0) {
                    arrParams.prov_id = data.provincias[0].id;
                    arrParams.getcantones = true;
                    requestHttpAjax(link, arrParams, function (response) {
                        if (response.status == "OK") {
                            data = response.message;
                            setComboData(data.cantones, "cmb_ciu");
                        }
                    }, true);
                }

            }
        }, true);
        // actualizar codigo pais
        $("#lbl_codeCountry").text($("#cmb_pais option:selected").attr("data-code"));
    });

    $('#cmb_nivelestudio').change(function () {
        var link = $('#txth_base').val() + "/gestion/create";
        var arrParams = new Object();
        arrParams.ninter_id = $(this).val();
        arrParams.getmodalidad = true;
        if (arrParams.ninter_id == 1)
        {
            $('#carrera').css('display', 'block');
            $('#programa').css('display', 'none');
        } else
        {
            $('#carrera').css('display', 'none');
            $('#programa').css('display', 'block');

        }
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.modalidad, "cmb_modalidad");
                var arrParams = new Object();
                if (data.modalidad.length > 0) {
                    arrParams.unidada = $('#cmb_nivelestudio').val();
                    arrParams.moda_id = data.modalidad[0].id;
                    arrParams.getcarrera = true;
                    requestHttpAjax(link, arrParams, function (response) {
                        if (response.status == "OK") {
                            data = response.message;
                            setComboData(data.carrera, "cmb_carrera1");
                            arrParams.getagente = true;
                            requestHttpAjax(link, arrParams, function (response) {
                                if (response.status == "OK") {
                                    data = response.message;
                                    setComboData(data.agente, "cmb_agente");
                                }
                            }, true);
                        }
                    }, true);
                }
            }
        }, true);
    });

    $('#cmb_modalidad').change(function () {
        var link = $('#txth_base').val() + "/gestion/create";
        var arrParams = new Object();
        arrParams.unidada = $('#cmb_nivelestudio').val();
        arrParams.moda_id = $(this).val();
        arrParams.getcarrera = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.carrera, "cmb_carrera1");
                arrParams.getagente = true;
                requestHttpAjax(link, arrParams, function (response) {
                    if (response.status == "OK") {
                        data = response.message;
                        setComboData(data.agente, "cmb_agente");
                    }
                }, true);
            }
        }, true);
    });

    $('#cmb_estado').change(function () {
        var arrParams = new Object();
        arrParams.estado_id = $(this).val();
        if (arrParams.estado_id > 5)
        {
            if (arrParams.estado_id == 10)
            {
                $('#oportunidad').css('display', 'block');
            }
            if (arrParams.estado_id != 7)
            {
                $("#txt_fecha_next").prop("disabled", true);
                $("#txt_hora_proxima").prop("disabled", true);
                $("#cmb_tipocontacto").prop("disabled", true);
                $('#txt_fecha_next').removeClass("PBvalidation");
                $('#txt_hora_proxima').removeClass("PBvalidation");
            } else
            {
                $('#oportunidad').css('display', 'none');
                $("#txt_fecha_next").prop("disabled", false);
                $("#txt_hora_proxima").prop("disabled", false);
                $("#cmb_tipocontacto").prop("disabled", false);
                $('#txt_fecha_next').addClass("PBvalidation");
                $('#txt_hora_proxima').addClass("PBvalidation");
            }
        } else
        {
            $('#oportunidad').css('display', 'none');
            $("#txt_fecha_next").prop("disabled", false);
            $("#txt_hora_proxima").prop("disabled", false);
            $("#cmb_tipocontacto").prop("disabled", false);
            $('#txt_fecha_next').addClass("PBvalidation");
            $('#txt_hora_proxima').addClass("PBvalidation");
        }
    });

    $('#cmb_prov').change(function () {
        var link = $('#txth_base').val() + "/gestion/create";
        var arrParams = new Object();
        arrParams.prov_id = $(this).val();
        arrParams.getcantones = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.cantones, "cmb_ciu");
            }
        }, true);
    });

    //Control del div de beneficiario
    $('#rdo_beneficio').change(function () {
        if ($('#rdo_beneficio').val() == 1) {
            $("#rdo_beneficio_no").prop("checked", "");
            $('#beneficio').css('display', 'none');
        } else {
            $('#beneficio').css('display', 'block');
        }
    });

    $('#rdo_beneficio_no').change(function () {
        if ($('#rdo_beneficio_no').val() == 2) {
            $("#rdo_beneficio").prop("checked", "");
            $('#beneficio').css('display', 'block');
        } else {
            $('#beneficio').css('display', 'none');
        }
    });

    $('#cmb_carrera2').change(function () {
        var link = $('#txth_base').val() + "/gestion/create";
        var arrParams = new Object();
        arrParams.car_id = $(this).val();
        arrParams.getsubcarrera = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.subcarrera, "cmb_subcarrera");
            }
        }, true);
    });

    $('#btn_grabar').click(function () {
        var link = $('#txth_base').val() + "/gestion/guardargestion";
        var arrParams = new Object();
        // funcion que permite veriifar si viene vacio, remover la validacion 
        camposnulos('#txt_celular');
        camposnulos('#txt_celular2');
        camposnulos('#txt_telefono_con');
        camposnulos('#txt_correo');
        arrParams.agenteauten = $('#txth_idag').val();
        arrParams.personauten = $('#txth_idpa').val();
        // Datos Generales
        arrParams.txt_nombre1 = $('#txt_nombre1').val();
        arrParams.txt_nombre2 = $('#txt_nombre2').val();
        arrParams.txt_apellido1 = $('#txt_apellido1').val();
        arrParams.txt_apellido2 = $('#txt_apellido2').val();
        arrParams.pais = $('#cmb_pais').val();
        arrParams.provincia = $('#cmb_prov').val();
        arrParams.ciudad = $('#cmb_ciu').val();
        arrParams.celular = $('#txt_celular').val();
        arrParams.celular2 = $('#txt_celular2').val();
        arrParams.telefono = $('#txt_telefono_con').val();
        arrParams.correo = $('#txt_correo').val();
        arrParams.medio = $('#cmb_medio').val();
        arrParams.nivel = $('#cmb_nivelestudio').val();
        arrParams.modalidad = $('#cmb_modalidad').val();
        arrParams.carrera1 = $('#cmb_carrera1').val();
        arrParams.carrera2 = $('#cmb_carrera2').val();
        arrParams.subcarrera = $('#cmb_subcarrera').val();
        arrParams.programa1 = $('#cmb_programa1').val();
        arrParams.programa2 = $('#cmb_programa2').val();
        arrParams.canal = $('#cmb_canal').val();
        // Datos Beneficiario      
        camposnulos('#txt_celularbene');
        camposnulos('#txt_celularbeni2');
        camposnulos('#txt_telefono_conbeni');
        camposnulos('#txt_correobeni');
        if ($('input:radio[name=rdo_beneficio]:checked').val())
        {
            arrParams.beneficiario = $('input:radio[name=rdo_beneficio]:checked').val();
            arrParams.txt_nombrebeni1 = $('#txt_nombre1').val();
            arrParams.txt_nombrebeni2 = $('#txt_nombre2').val();
            arrParams.txt_apellidobeni1 = $('#txt_apellido1').val();
            arrParams.txt_apellidobeni2 = $('#txt_apellido2').val();
            arrParams.celularbeni = $('#txt_celular').val();
            arrParams.celular2beni = $('#txt_celular2').val();
            arrParams.telefonobeni = $('#txt_telefono_con').val();
            arrParams.correobeni = $('#txt_correo').val();
        } else
        {
            arrParams.beneficiario = $('input:radio[name=rdo_beneficio_no]:checked').val();
            arrParams.txt_nombrebeni1 = $('#txt_nombrebene1').val();
            arrParams.txt_nombrebeni2 = $('#txt_nombrebene2').val();
            arrParams.txt_apellidobeni1 = $('#txt_apellidobene1').val();
            arrParams.txt_apellidobeni2 = $('#txt_apellidobene2').val();
            arrParams.celularbeni = $('#txt_celularbene').val();
            arrParams.celular2beni = $('#txt_celularbeni2').val();
            arrParams.telefonobeni = $('#txt_telefono_conbeni').val();
            arrParams.correobeni = $('#txt_correobeni').val();
        }
        if (arrParams.beneficiario == 1)
        {
            $('#txt_nombrebene1').removeClass("PBvalidation");
            $('#txt_apellidobene1').removeClass("PBvalidation");
        } else
        {
            $('#txt_nombrebene1').addClass("PBvalidation");
            $('#txt_apellidobene1').addClass("PBvalidation");
        }
        //Datos Gestión          
        if (arrParams.agenteauten == 1 || arrParams.agenteauten == 2 || arrParams.personauten == 1)
        {
            arrParams.agente = $('#cmb_agente').val();
        } else
        {
            arrParams.agente = $('#cmb_agenteau').val();
        }
        arrParams.fecrecepcion = $('#txt_fecha_recepcion').val();
        arrParams.horecepcion = $('#txt_hora_recepcion').val();
        arrParams.fecatencion = $('#txt_fecha_atencion').val();
        arrParams.horatencion = $('#txt_hora_atencion').val();
        arrParams.estado = $('#cmb_estado').val();
        arrParams.observacion = $('#txt_observacion').val();
        arrParams.oportunidad = $('#cmb_oportunidad').val();
        //Datos Próxima Atención
        arrParams.fecproxima = $('#txt_fecha_next').val();
        arrParams.horproxima = $('#txt_hora_proxima').val();
        arrParams.tipocontacto = $('#cmb_tipocontacto').val();

        if (!validateForm()) {
            requestHttpAjax(link, arrParams, function (response) {
                showAlert(response.status, response.label, response.message);
                setTimeout(function () {
                    sessionStorage.clear();
                    window.location.href = $('#txth_base').val() + "/gestion/create";
                }, 3000);
            }, true);
        }
    });

    $('#btn_Neopera').click(function () {
        var persona = $('#txth_ids').val();
        window.location.href = $('#txth_base').val() + "/gestion/nuevagestion?id=" + persona;
    });

    $('#btn_grabarneo').click(function () {
        var link = $('#txth_base').val() + "/gestion/guardarnueva";
        var arrParams = new Object();
        camposnulos('#txt_celular');
        camposnulos('#txt_celular2');
        camposnulos('#txt_telefono_con');
        camposnulos('#txt_correo');
        //Datos Generales
        arrParams.txt_nombrebeni1 = $('#txt_nombrebene1').val();
        arrParams.txt_nombrebeni2 = $('#txt_nombrebene2').val();
        arrParams.txt_apellidobeni1 = $('#txt_apellidobene1').val();
        arrParams.txt_apellidobeni2 = $('#txt_apellidobene2').val();
        arrParams.celular = $('#txt_celular').val();
        arrParams.celular2 = $('#txt_celular2').val();
        arrParams.telefono = $('#txt_telefono_con').val();
        arrParams.correo = $('#txt_correo').val();

        //Datos Gestión 
        arrParams.gestion = $('#txth_idg').val();
        arrParams.benificiario = $('#txth_idc').val();
        arrParams.fecrecepcion = $('#txt_fecha_recepcion').val();
        arrParams.horecepcion = $('#txt_hora_recepcion').val();
        arrParams.fecatencion = $('#txt_fecha_atencion').val();
        arrParams.horatencion = $('#txt_hora_atencion').val();
        arrParams.estado = $('#cmb_estado').val();
        arrParams.observacion = $('#txt_observacion').val();
        arrParams.oportunidad = $('#cmb_oportunidad').val();
        //Datos Próxima Atención
        arrParams.fecproxima = $('#txt_fecha_next').val();
        arrParams.horproxima = $('#txt_hora_proxima').val();
        arrParams.tipocontacto = $('#cmb_tipocontacto').val();
        //alert(arrParams.estado);
        if (!validateForm()) {
            requestHttpAjax(link, arrParams, function (response) {
                showAlert(response.status, response.label, response.message);
                setTimeout(function () {
                    sessionStorage.clear();
                    window.location.href = $('#txth_base').val() + "/gestion/listargestion";
                }, 3000);
            }, true);
        }
    });

    $('#btn_buscarGestion').click(function () {
        actualizarGridGestion();
    });
});

function actualizarGridGestion() {
    var agente = $('#txt_buscarDataAgente').val();
    var interesado = $('#txt_buscarDataPersona').val(); //
    var f_atencion = $('#txt_fecha_atencion').val();
    var estado = $('#cmb_estado option:selected').val();
    //Buscar almenos una clase con el nombre para ejecutar
    if (!$(".blockUI").length) {
        showLoadingPopup();
        $('#Pbgestion').PbGridView('applyFilterData', {'agente': agente, 'interesado': interesado, 'f_atencion': f_atencion, 'estado': estado});
        setTimeout(hideLoadingPopup, 2000);
    }
}


function exportExcel() {
    var agente = $('#txt_buscarDataAgente').val();
    var interesado = $('#txt_buscarDataPersona').val();
    var f_atencion = $('#txt_fecha_atencion').val();
    var estado = $('#cmb_estado option:selected').val();
    window.location.href = $('#txth_base').val() + "/gestion/expexcel?agente=" + agente + "&interesado=" + interesado + "&f_atencion=" + f_atencion + "&estado=" + estado;
}

function camposnulos(campo) {
    if ($(campo).val() == "")
    {
        $(campo).removeClass("PBvalidation");
    } else
    {
        $(campo).addClass("PBvalidation");
    }
}
