$(document).ready(function () {
    $('#btn_buscarGestion').click(function () {
        actualizarGridGestion();
    });
    $('#cmb_carrera2').change(function () {
        var ref = $(this).attr("data-ref");
        if ($(this).val() != 0) {
            var link = $('#txth_base').val() + "/admision/oportunidades/newoportunidadxcontacto";
            if (ref == "edit")
                link = $('#txth_base').val() + "/admision/oportunidades/edit";
            var arrParams = new Object();
            arrParams.car_id = $(this).val();
            arrParams.getsubcarrera = true;
            requestHttpAjax(link, arrParams, function (response) {
                if (response.status == "OK") {
                    data = response.message;
                    setComboData(data.subcarrera, "cmb_subcarrera");
                }
            }, true);
        } else {
            $('#cmb_subcarrera').html("<option value='0'>Ninguno</option>");
        }
    });
    $('#cmb_nivelestudio').change(function () {
        var link = $('#txth_base').val() + "/admision/oportunidades/new";
        var arrParams = new Object();
        arrParams.nint_id = $(this).val();
        arrParams.getmodalidad = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.modalidad, "cmb_modalidad");
                var arrParams = new Object();
                if (data.modalidad.length > 0) {
                    arrParams.unidada = $('#cmb_nivelestudio').val();
                    arrParams.moda_id = data.modalidad[0].id;
                    arrParams.getoportunidad = true;
                    requestHttpAjax(link, arrParams, function (response) {
                        if (response.status == "OK") {
                            data = response.message;
                            setComboData(data.oportunidad, "cmb_tipo_oportunidad");
                        }
                    }, true);
                    var arrParams = new Object();
                    if (data.modalidad.length > 0) {
                        arrParams.unidada = $('#cmb_nivelestudio').val();
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
            }
        }, true);
    });
    $('#cmb_nivelestudio_act').change(function () {
        var link = $('#txth_base').val() + "/admision/oportunidades/edit";
        var arrParams = new Object();
        arrParams.ninter_id = $(this).val();
        arrParams.getmodalidad = true;

        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                var arrParams = new Object();
                data = response.message;
                setComboData(data.modalidad, "cmb_modalidad_act");
                arrParams.unidada = $('#cmb_nivelestudio_act').val();
                arrParams.getoportunidad = true;
                requestHttpAjax(link, arrParams, function (response) {
                    if (response.status == "OK") {
                        data = response.message;
                        setComboData(data.oportunidad, "cmb_tipo_oportunidad");
                    }
                }, true);
                var arrParams = new Object();
                if (data.modalidad.length > 0) {
                    arrParams.unidada = $('#cmb_nivelestudio_act').val();
                    arrParams.moda_id = data.modalidad[0].id;
                    arrParams.getcarrera = true;
                    requestHttpAjax(link, arrParams, function (response) {
                        if (response.status == "OK") {
                            data = response.message;
                            setComboData(data.carrera, "cmb_carrera_estudio");
                        }
                    }, true);
                }
            }
        }, true);
    });
    $('#cmb_modalidad').change(function () {
        var link = $('#txth_base').val() + "/admision/oportunidades/new";
        var arrParams = new Object();
        arrParams.unidada = $('#cmb_nivelestudio').val();
        arrParams.moda_id = $(this).val();
        arrParams.getcarrera = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.carrera, "cmb_carrera1");
            }
        }, true);
    });
    $('#cmb_modalidad_act').change(function () {
        var link = $('#txth_base').val() + "/admision/oportunidades/edit";
        var arrParams = new Object();
        arrParams.unidada = $('#cmb_nivelestudio_act').val();
        arrParams.moda_id = $(this).val();
        arrParams.getcarrera = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.carrera, "cmb_carrera_estudio");
            }
        }, true);
    });
    $('#cmb_state_opportunity').change(function () {
        if ($('#cmb_state_opportunity').val() == 5 || $('#cmb_state_opportunity').val() == 4) {
            $("#txt_fecha_proxima").prop("disabled", true);
            $("#txt_hora_proxima").prop("disabled", true);
            $('#txt_fecha_proxima').removeClass("PBvalidation");
            $('#txt_hora_proxima').removeClass("PBvalidation");
        } else {
            $("#txt_fecha_proxima").prop("disabled", false);
            $("#txt_hora_proxima").prop("disabled", false);
            $('#txt_fecha_proxima').addClass("PBvalidation");
            $('#txt_hora_proxima').addClass("PBvalidation");
        }
        if ($('#cmb_state_opportunity').val() == 5) {
            $('#divoportunidad_perdida').css('display', 'block');
        } else {
            $('#divoportunidad_perdida').css('display', 'none');
        }
    });

});

function actualizarGridGestion() {
    var agente = $('#txt_buscarDataAgente').val();
    var interesado = $('#txt_buscarDataPersona').val();
    // var f_atencion = $('#txt_fecha_atencion').val();
    var estado = $('#cmb_estadop option:selected').val();
    //Buscar almenos una clase con el nombre para ejecutar
    if (!$(".blockUI").length) {
        showLoadingPopup();
        // $('#Pbgestion').PbGridView('applyFilterData', {'agente': agente, 'interesado': interesado, 'f_atencion': f_atencion, 'estado': estado});
        $('#Pbgestion').PbGridView('applyFilterData', { 'agente': agente, 'interesado': interesado, 'estado': estado });
        setTimeout(hideLoadingPopup, 2000);
    }
}

function edit(){
    var codigo = $('#txth_opoid').val();
    var persona = $('#txth_pgid').val();
    window.location.href = $('#txth_base').val() + "/admision/oportunidades/edit?codigo=" + codigo + "&pgesid=" + persona;
}

function update(){
    var link = $('#txth_base').val() + "/admision/oportunidades/update";
    var arrParams = new Object();
    arrParams.pgid = $('#txth_pgid').val();
    arrParams.opo_id = $('#txth_opoid').val();
    arrParams.uaca_id = $('#cmb_nivelestudio_act').val();
    arrParams.modalidad = $('#cmb_modalidad_act').val();
    arrParams.empresa = $('#cmb_empresa').val();
    arrParams.tipoOport = $('#cmb_tipo_oportunidad').val();
    arrParams.estado = $('#cmb_state_opportunity').val();
    arrParams.carreraestudio = $('#cmb_carrera_estudio').val();
    arrParams.canal = $('#cmb_ccanal').val();
    arrParams.carrera2 = $('#cmb_carrera2').val();
    arrParams.subcarrera = $('#cmb_subcarrera').val();

    if (!validateForm()) {
        requestHttpAjax(link, arrParams, function (response) {
            showAlert(response.status, response.label, response.message);
            setTimeout(function () {
                window.location.href = $('#txth_base').val() + "/admision/oportunidades/index";
            }, 3000);
        }, true);
    }
}

function save(){
    var sub_carrera = ($('#cmb_subcarrera').val() != 0 && $('#cmb_subcarrera').val() != '') ? $('#cmb_subcarrera').val() : 0;
    var link = $('#txth_base').val() + "/admision/oportunidades/save";
    var arrParams = new Object();
    arrParams.id_pgest = $('#txth_pgid').val();
    arrParams.empresa = $('#cmb_empresa').val();
    arrParams.id_unidad_academica = $('#cmb_nivelestudio').val();
    arrParams.id_modalidad = $('#cmb_modalidad').val();
    arrParams.id_tipo_oportunidad = $('#cmb_tipo_oportunidad').val();
    arrParams.id_estado_oportunidad = $('#cmb_state_opportunity').val();
    arrParams.id_estudio_academico = $('#cmb_carrera1').val();
    arrParams.canal_conocimiento = $('#cmb_knowledge_channel').val();
    arrParams.carrera2 = $('#cmb_carrera2').val();
    arrParams.sub_carrera = sub_carrera;
    if (!validateForm()) {
        requestHttpAjax(link, arrParams, function (response) {
            showAlert(response.status, response.label, response.message);
            setTimeout(function () {
                if (response.status == "OK") {
                    //parent.window.location.href = $('#txth_base').val() + "/admision/admisiones/listaroportxcontacto?pgid=".arrParams.id_pgest;
                    parent.window.location.href = $('#txth_base').val() + "/admision/contactos/index";
                }
            }, 3000);
        }, true);
    }
}