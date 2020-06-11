$(document).ready(function() {

});

function searchModules(idbox, idgrid) {
    var arrParams = new Object();
    arrParams.PBgetFilter = true;
    arrParams.search = $("#" + idbox).val();
    $("#" + idgrid).PbGridView("applyFilterData", arrParams);
}

function update() {
    var link = $('#txth_base').val() + "/grupo/update";
    var arrParams = new Object();
    arrParams.id = $("#frm_grupo_id").val();
    arrParams.nombre = $('#frm_grupo').val();
    arrParams.desc = $('#frm_grupo_desc').val();
    arrParams.seg = $("#cmb_grupo_seg").val();
    arrParams.estado = $('#frm_grupo_status').val();
    arrParams.roles = $('#cmb_roles').val();
    if (!validateForm()) {
        requestHttpAjax(link, arrParams, function(response) {
            showAlert(response.status, response.label, response.message);
        }, true);
    }
}