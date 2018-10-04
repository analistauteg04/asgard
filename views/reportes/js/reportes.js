

$(document).ready(function () {
    $('#btn_buscarActividad').click(function () {
        buscarActividades();
    });    
    
    
});

function buscarActividades() {
    //var search = '';//$('#txt_buscarDataPago').val();
    var op="1";
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    //var f_estado = '';//$('#cmb_estado').val();
    //Buscar al menos una clase con el nombre para ejecutar
    window.location.href = $('#txth_base').val() + "/reportes/expexcelreport?op="+op+"&f_ini="+f_ini+"&f_fin="+f_fin;
}
