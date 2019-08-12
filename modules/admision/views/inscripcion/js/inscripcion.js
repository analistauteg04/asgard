$(document).ready(function() {

});

function searchModules(idbox, idgrid) {
    var arrParams = new Object();
    arrParams.PBgetFilter = true;
    arrParams.search = $("#" + idbox).val();
    arrParams.txt_fecha_ini = $("#txt_fecha_ini").val();
    arrParams.txt_fecha_fin = $("#txt_fecha_fin").val();
    $("#" + idgrid).PbGridView("applyFilterData", arrParams);
}