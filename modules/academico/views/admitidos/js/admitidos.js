
$(document).ready(function () {
    $('#btn_buscarData').click(function () {
        actualizarGrid();
    });
});

function exportExcel() {
    var search = $('#txt_buscarData').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    var carrera = $('#cmb_carrera option:selected').val();     
    window.location.href = $('#txth_base').val() + "/academico/admitidos/expexcel?search=" + search + "&carrera=" + carrera+ "&fecha_ini=" + f_ini+ "&fecha_fin=" + f_fin;        
}

function exportPdf() {
    var search = $('#txt_buscarData').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    var carrera = $('#cmb_carrera option:selected').val();     
    window.location.href = $('#txth_base').val() + "/academico/admitidos/exppdf?pdf=1&search=" + search + "&carrera=" + carrera+ "&fecha_ini=" + f_ini+ "&fecha_fin=" + f_fin;            
}

function actualizarGrid() {
    var search = $('#txt_buscarData').val();
    var carrera = $('#cmb_carrera option:selected').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    var codigocan = $('#txt_buscarCodigo').val();
    //Buscar almenos una clase con el nombre para ejecutar
    if (!$(".blockUI").length) {
        showLoadingPopup();
        $('#TbG_PERSONAS').PbGridView('applyFilterData', {'f_ini': f_ini, 'f_fin': f_fin, 'carrera': carrera, 'search': search, 'codigocan': codigocan});
        setTimeout(hideLoadingPopup, 2000);
    }
}