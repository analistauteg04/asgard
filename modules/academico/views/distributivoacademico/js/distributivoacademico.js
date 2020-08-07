$(document).ready(function() {
    $('#cmb_unidad_dis').change(function() {
        var link = $('#txth_base').val() + "/academico/distributivoacademico/index";
        var arrParams = new Object();
        arrParams.uaca_id = $(this).val();
        arrParams.getmodalidad = true;
        requestHttpAjax(link, arrParams, function(response) {
            if (response.status == "OK") {
                data = response.message;
                setComboDataselect(data.modalidad, "cmb_modalidad", "Todos");
                var arrParams = new Object();
                if (data.modalidad.length > 0) {
                    let mod_id = data.modalidad[0].id;
                    arrParams.uaca_id = $('#cmb_unidad_dis').val();
                    arrParams.mod_id = mod_id;
                    arrParams.getjornada = true;
                    requestHttpAjax(link, arrParams, function(response) {
                        if (response.status == "OK") {
                            data = response.message;
                            setComboDataselect(data.jornada, "cmb_jornada", "Todos");
                            var arrParams = new Object();
                            if (data.jornada.length > 0) {
                                arrParams.uaca_id = $('#cmb_unidad_dis').val();
                                arrParams.mod_id = mod_id;
                                arrParams.jornada_id = data.jornada[0].id;
                                arrParams.gethorario = true;
                                requestHttpAjax(link, arrParams, function(response) {
                                    if (response.status == "OK") {
                                        data = response.message;
                                        setComboDataselect(data.horario, "cmb_horario", "Todos");
                                    }
                                }, true);
                            }
                        }
                    }, false);
                }
            }
        }, false);
    });
    $('#cmb_modalidad').change(function() {
        var link = $('#txth_base').val() + "/academico/distributivoacademico/index";
        var arrParams = new Object();
        arrParams.uaca_id = $('#cmb_unidad_dis').val();
        arrParams.mod_id = $(this).val();
        arrParams.getjornada = true;
        requestHttpAjax(link, arrParams, function(response) {
            if (response.status == "OK") {
                data = response.message;
                setComboDataselect(data.jornada, "cmb_jornada", "Todos");
                var arrParams = new Object();
                if (data.jornada.length > 0) {
                    arrParams.uaca_id = $('#cmb_unidad_dis').val();
                    arrParams.mod_id = $('#cmb_modalidad').val();
                    arrParams.jornada_id = data.jornada[0].id;
                    arrParams.gethorario = true;
                    requestHttpAjax(link, arrParams, function(response) {
                        if (response.status == "OK") {
                            data = response.message;
                            setComboDataselect(data.horario, "cmb_horario", "Todos");
                        }
                    }, true);
                }
            }
        }, false);
    });
    $('#cmb_jornada').change(function() {
        var link = $('#txth_base').val() + "/academico/distributivoacademico/index";
        var arrParams = new Object();
        arrParams.uaca_id = $('#cmb_unidad_dis').val();
        arrParams.mod_id = $('#cmb_modalidad').val();
        arrParams.jornada_id = $(this).val();
        arrParams.gethorario = true;
        requestHttpAjax(link, arrParams, function(response) {
            if (response.status == "OK") {
                data = response.message;
                setComboDataselect(data.horario, "cmb_horario", "Todos");
            }
        }, true);
    });

    $('#btn_buscarData_dist').click(function() {
        searchModules();
    });
});

function setComboDataselect(arr_data, element_id, texto) {
    var option_arr = "";
    option_arr += "<option value= '0'>" + texto + "</option>";
    for (var i = 0; i < arr_data.length; i++) {
        var id = arr_data[i].id;
        var value = arr_data[i].name;

        option_arr += "<option value='" + id + "'>" + value + "</option>";
    }
    $("#" + element_id).html(option_arr);
}

function searchModules() {
    var arrParams = new Object();
    arrParams.PBgetFilter = true;
    arrParams.search = $("#txt_buscarData").val();
    arrParams.unidad = $("#cmb_unidad_dis").val();
    arrParams.periodo = $("#cmb_periodo").val();
    arrParams.modalidad = $("#cmb_modalidad").val();
    arrParams.materia = $("#cmb_materia").val();
    arrParams.jornada = $("#cmb_jornada").val();
    $("#Tbg_Distributivo_Aca").PbGridView("applyFilterData", arrParams);
}

function edit() {
    var link = $('#txth_base').val() + "/academico/distributivoacademico/edit" + "?id=" + $("#frm_dis_id").val();
    window.location = link;
}

function update() {
    var link = $('#txth_base').val() + "/academico/distributivoacademico/update";
    var arrParams = new Object();
    arrParams.id = $("#frm_acc_id").val();
    arrParams.nombre = $('#frm_accion').val();
    arrParams.desc = $('#frm_acc_desc').val();
    arrParams.tipo = $('#frm_acc_type').val();
    arrParams.icon = $('#frm_acc_image').val();
    arrParams.url = $('#frm_acc_url').val();
    arrParams.lang = $('#frm_acc_lang').val();
    arrParams.estado = $('#frm_acc_status').val();
    if (!validateForm()) {
        requestHttpAjax(link, arrParams, function(response) {
            showAlert(response.status, response.label, response.message);
        }, true);
    }
}

function save() {
    var link = $('#txth_base').val() + "/academico/distributivoacademico/save";
    var arrParams = new Object();
    arrParams.profesor = $('#cmb_profesor').val();
    arrParams.unidad = $('#cmb_unidad_dis').val();
    arrParams.modalidad = $('#cmb_modalidad').val();
    arrParams.periodo = $('#cmb_periodo').val();
    arrParams.jornada = $('#cmb_jornada').val();
    arrParams.materia = $('#cmb_materia').val();
    arrParams.horario = $("#cmb_horario option:selected").text();
    if (!validateForm()) {
        requestHttpAjax(link, arrParams, function(response) {
            showAlert(response.status, response.label, response.message);
            if (response.status == "OK") {
                setTimeout(function() {
                    var link = $('#txth_base').val() + "/academico/distributivoacademico/index";
                    window.location = link;
                }, 1000);
            }
        }, true);
    }
}

function deleteItem(id) {
    var link = $('#txth_base').val() + "/academico/distributivoacademico/delete";
    var arrParams = new Object();
    arrParams.id = id;
    requestHttpAjax(link, arrParams, function(response) {
        if (response.status == "OK") {
            var arrParams2 = new Object();
            arrParams2.PBgetFilter = true;
            arrParams2.search = $("#boxgrid").val();
            $("#grid_acciones_list").PbGridView("applyFilterData", arrParams2);
            //window.location = window.location.href;
        }
        setTimeout(function() {
            showAlert(response.status, response.label, response.message);
        }, 1000);
    }, true);
}

function exportExcel() {

}

function exportPdf() {

}