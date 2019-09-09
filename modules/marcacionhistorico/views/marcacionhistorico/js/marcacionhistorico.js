$(document).ready(function () {
    $('#btn_buscarMarcacion').click(function () {
        actualizarGridMarcacion();
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

function actualizarGridMarcacion() {
    var profesor = $('#txt_buscarDataProfesor').val();
    var materia = $('#txt_buscarDataMateria').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    //var periodo = $('#cmb_periodo option:selected').val();

    //Buscar almenos una clase con el nombre para ejecutar
    if (!$(".blockUI").length) {
        showLoadingPopup();
        $('#PbMarcacionhistorico').PbGridView('applyFilterData', {'profesor': profesor, 'materia': materia, 'f_ini': f_ini, 'f_fin': f_fin/*, 'periodo': periodo*/});
        setTimeout(hideLoadingPopup, 2000);
    }
}
function exportExcel() {
    var profesor = $('#txt_buscarDataProfesor').val();
    var materia = $('#txt_buscarDataMateria').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    //var periodo = $('#cmb_periodo option:selected').val();
    window.location.href = $('#txth_base').val() + "/marcacionhistorico/marcacionhistorico/expexcel?profesor=" + profesor + "&materia=" + materia + "&f_ini=" + f_ini + "&f_fin=" + f_fin /*+ "&periodo=" + periodo*/;
}
function exportPdf() {
    var profesor = $('#txt_buscarDataProfesor').val();
    var materia = $('#txt_buscarDataMateria').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    //var periodo = $('#cmb_periodo option:selected').val();
    window.location.href = $('#txth_base').val() + "/marcacionhistorico/marcacionhistorico/exppdf?pdf=1&profesor=" + profesor + "&materia=" + materia + "&f_ini=" + f_ini + "&f_fin=" + f_fin /*+ "&periodo=" + periodo*/;
}