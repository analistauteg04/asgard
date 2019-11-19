$(document).ready(function () {
    $('#btn_buscarData').click(function () {
        actualizarGrid();
    });        
});

function actualizarGrid() {
    var search = $('#txt_buscarData').val();    
    var unidad = $('#cmb_unidad option:selected').val();
    var semestre = $('#cmb_semestre option:selected').val();   
    //Buscar almenos una clase con el nombre para ejecutar
    if (!$(".blockUI").length) {
        showLoadingPopup();
        $('#Tbg_Distributivo').PbGridView('applyFilterData', {'search': search, 'unidad': unidad, 'semestre': semestre});
        setTimeout(hideLoadingPopup, 2000);
    }
}
function exportExcel() {
    var search = $('#txt_buscarData').val();       
    var unidad = $('#cmb_unidad option:selected').val();
    var semestre = $('#cmb_semestre option:selected').val();   
    window.location.href = $('#txth_base').val() + "/academico/distributivo/expexcel?search=" + search + "&unidad=" + unidad + "&semestre=" + semestre;
}
function exportPdf() {
    var search = $('#txt_buscarDataPersona').val();    
    var unidad = $('#cmb_unidad option:selected').val();
    var semestre = $('#cmb_semestre option:selected').val();   
    window.location.href = $('#txth_base').val() + "/academico/distributivo/exppdf?pdf=1&search=" + search  + "&unidad=" + unidad + "&semestre=" + semestre;
}