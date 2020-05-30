$(document).ready(function() {
    $('#btn_buscar').click(function () {
        actualizarGrid();
    });
    
     $('#cmb_unidad').change(function() {
        var link = $('#txth_base').val() + "/formulario/registro/index";
        var arrParams = new Object();
        arrParams.uaca_id = $(this).val();
        arrParams.getcarrera = true;
        requestHttpAjax(link, arrParams, function(response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.carr_prog, "cmb_carrera_programa");
            }
        }, true);
    });
});

function actualizarGrid() {
    var search = $('#txt_buscarData').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    var unidad = $('#cmb_unidad').val();
    var carrera = $('#cmb_carrera_programa').val();    
    //Buscar almenos una clase con el nombre para ejecutar
    if (!$(".blockUI").length) {
        showLoadingPopup();
        $('#PBgrid_personaform').PbGridView('applyFilterData', {'unidad': unidad, 'carrera': carrera, 'search': search, 'f_ini': f_ini, 'f_fin': f_fin});
        setTimeout(hideLoadingPopup, 2000);
    }
}

function exportExcel() {
    var search = $('#txt_buscarData').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    var unidad = $('#cmb_unidad').val();
    var carrera = $('#cmb_carrera_programa').val();  
    window.location.href = $('#txth_base').val() + "/formulario/registro/expexcel?search=" + search + "&f_ini=" + f_ini + "&f_fin=" + f_fin + '&unidad=' + unidad + "&carrera=" + carrera;
}

function exportPdf() {
    var search = $('#txt_buscarData').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    var unidad = $('#cmb_unidad').val();
    var carrera = $('#cmb_carrera_programa').val();    

    window.location.href = $('#txth_base').val() + "/formulario/registro/exppdf?pdf=1&search=" + search + "&f_ini=" + f_ini + "&f_fin=" + f_fin + '&unidad=' + unidad + "&carrera=" + carrera;
}