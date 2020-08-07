$(document).ready(function() {
    $('#cmb_unidad_dis').change(function() {
        var link = $('#txth_base').val() + "/academico/distributivoacedmico/index";
        var arrParams = new Object();
        arrParams.uaca_id = $(this).val();
        arrParams.getmodalidad = true;
        requestHttpAjax(link, arrParams, function(response) {
            if (response.status == "OK") {
                data = response.message;
                setComboDataselect(data.modalidad, "cmb_modalidad", "Todos");
            }
        }, true);
    });
    $('#btn_buscarData_dist').click(function() {
        searchModules();
    });
});

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
    var link = $('#txth_base').val() + "/academico/distributivoacedmico/edit" + "?id=" + $("#frm_dis_id").val();
    window.location = link;
}

function update() {
    var link = $('#txth_base').val() + "/academico/distributivoacedmico/update";
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
    var link = $('#txth_base').val() + "/academico/distributivoacedmico/save";
    var arrParams = new Object();
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

function deleteItem(id) {
    var link = $('#txth_base').val() + "/academico/distributivoacedmico/delete";
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