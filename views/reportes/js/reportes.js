

$(document).ready(function () {
//    $('#btn_buscarActividad').click(function () {
//        buscarActividades();
//    });    
    
    
});

function exportAgendamiento(){
    buscarActividades("1");//Reporte de Oportunidad x Actividad
}

function exportLostContact(){
    buscarActividades("2");//Reporte de Oportunidad x Proxima Oportunidad
}
function buscarActividades(op) {
    //var search = '';//$('#txt_buscarDataPago').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    //var f_estado = '';//$('#cmb_estado').val();
    //Buscar al menos una clase con el nombre para ejecutar
    window.location.href = $('#txth_base').val() + "/reportes/expexcelreport?op="+op+"&f_ini="+f_ini+"&f_fin="+f_fin;
}
