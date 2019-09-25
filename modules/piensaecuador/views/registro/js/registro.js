$(document).ready(function() {

});

function searchModules(idbox, idgrid) {
    var arrParams = new Object();
    arrParams.PBgetFilter = true;
    arrParams.search = $("#" + idbox).val();
    $("#" + idgrid).PbGridView("applyFilterData", arrParams);
}

function exportExcel() {
    var agente = $('#txt_buscarDataAgente').val();
    var interesado = $('#txt_buscarDataPersona').val();
    var f_atencion = $('#txt_fecha_atencion').val();
    var estado = $('#cmb_estado option:selected').val();
    window.location.href = $('#txth_base').val() + "/admision/admisiones/expexcel?agente=" + agente + "&interesado=" + interesado + "&f_atencion=" + f_atencion + "&estado=" + estado;
}

function exportPdf() {
    var agente = $('#txt_buscarDataAgente').val();
    var interesado = $('#txt_buscarDataPersona').val();
    var f_atencion = $('#txt_fecha_atencion').val();
    var estado = $('#cmb_estado option:selected').val();
    window.location.href = $('#txth_base').val() + "/admision/admisiones/exppdf?pdf=1&search=" + agente + "&interesado=" + interesado + "&f_atencion=" + f_atencion + "&estado=" + estado;
}