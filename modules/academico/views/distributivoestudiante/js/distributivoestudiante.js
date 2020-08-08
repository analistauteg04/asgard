$(document).ready(function() {
    $('#btn_buscarData_dist').click(function() {
        searchModules();
    });
});

function searchModules() {
    var arrParams = new Object();
    arrParams.PBgetFilter = true;
    arrParams.search = $("#txt_buscarData").val();
    arrParams.id = $("#txth_ids").val();
    $("#Tbg_Distributivo_Aca").PbGridView("applyFilterData", arrParams);
}

function getListStudent(search, response) {
    var link = $('#txth_base').val() + "/academico/distributivoestudiante/edit" + "?id=" + $("#txth_ids").val();;
    var arrParams = new Object();
    arrParams.search = search;
    arrParams.unidad = $('#txth_uids').val();
    arrParams.PBgetAutoComplete = true;
    requestHttpAjax(link, arrParams, function(rsp) {
        response(rsp);
    }, false, false, "json", "POST", null, false);
}

function showDataStudent(id, value) {
    var link = $('#txth_base').val() + "/academico/distributivoestudiante/delete";
    var arrParams = new Object();
    arrParams.id = id;
    requestHttpAjax(link, arrParams, function(response) {
        if (response.status == "OK") {

        }
    }, true);
}

function edit() {
    var link = $('#txth_base').val() + "/academico/distributivoestudiante/edit" + "?id=" + $("#txth_ids").val();
    window.location = link;
}

function deleteItem(id) {
    var link = $('#txth_base').val() + "/academico/distributivoestudiante/delete";
    var arrParams = new Object();
    arrParams.id = id;
    requestHttpAjax(link, arrParams, function(response) {
        if (response.status == "OK") {
            setTimeout(function() {
                showAlert(response.status, response.label, response.message);
            }, 1000);
        }
    }, true);
}

function exportExcel() {
    var search = $('#txt_buscarData').val();
    var id = $('#txth_ids').val();
    window.location.href = $('#txth_base').val() + "/academico/distributivoestudiante/exportexcel?" +
        "id=" + id +
        "&search=" + search;
}

function exportPdf() {
    var search = $('#txt_buscarData').val();
    var id = $('#txth_ids').val();
    window.location.href = $('#txth_base').val() + "/academico/distributivoestudiante/exportpdf?pdf=1" +
        "&id=" + id +
        "&search=" + search;
}