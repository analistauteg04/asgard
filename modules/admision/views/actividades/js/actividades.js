$(document).ready(function () {


    //*********** FUNCIONES QUE SE DEBEN REMOVER CUANDO ESTEN HABILITADOS LOS MENUS **********
    $('#btn_crearactividad').click(function () {
        var opid = $('#txth_opid').val();
        var pgid = $('#txth_pgid').val();
        window.location.href = $('#txth_base').val() + "/admision/actividades/new?opid=" + opid + "&pgid=" + pgid;
    });
});

function newItem(){
    var opid = $('#txth_opid').val();
    var pgid = $('#txth_pgid').val();
    window.location.href = $('#txth_base').val() + "/admision/actividades/new?opid=" + opid + "&pgid=" + pgid;
}