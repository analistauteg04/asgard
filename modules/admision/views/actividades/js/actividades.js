$(document).ready(function () {


    //*********** FUNCIONES QUE SE DEBEN REMOVER CUANDO ESTEN HABILITADOS LOS MENUS **********
    $('#btn_crearactividad').click(function () {
        var opid = $('#txth_opid').val();
        var pgid = $('#txth_pgid').val();
        window.location.href = $('#txth_base').val() + "/admision/actividades/newactividad?opid=" + opid + "&pgid=" + pgid;
    });
    $('#btn_grabaractividad').click(function () {
        var link = $('#txth_base').val() + "/admision/actividades/save";
        var arrParams = new Object();
        //Datos Gestión 
        arrParams.oportunidad = $('#txth_opo_id').val();
        arrParams.estado_oportunidad = $('#cmb_state_opportunity').val();
        arrParams.fecatencion = $('#txt_fecha_atencion').val();
        arrParams.horatencion = $('#txt_hora_atencion').val();
        arrParams.observacion = $('#txt_observacion').val();        
        if(arrParams.estado_oportunidad==5){
            arrParams.oportunidad_perdida=$('#cmb_lost_opportunity').val();            
        }
        //Datos Próxima Atención
        arrParams.fecproxima = $('#txt_fecha_proxima').val();
        arrParams.horproxima = $('#txt_hora_proxima').val();
        if (!validateForm()) {
            requestHttpAjax(link, arrParams, function (response) {
                showAlert(response.status, response.label, response.message);
                setTimeout(function () {
                    var opor_id = $('#txth_opo_id').val();
                    var pges_id = $('#txth_pgid').val();
                    window.location.href = $('#txth_base').val() + "/admision/actividades/listaractividades?opor_id=" + opor_id + "&pges_id=" + pges_id;
                }, 3000);
            }, true);
        }
    });
    $('#btn_actualizaractividad').click(function () {
        var link = $('#txth_base').val() + "/admision/actividades/update";
        var arrParams = new Object();
        //Datos Gestión 
        arrParams.bact_id = $('#txth_acid').val();
        arrParams.fecatencion = $('#txt_fecha_atencion').val();
        arrParams.horatencion = $('#txt_hora_atencion').val();
        arrParams.observacion = $('#txt_observacion').val();        
        //Datos Próxima Atención
        arrParams.fecproxima = $('#txt_fecha_proxima').val();
        arrParams.horproxima = $('#txt_hora_proxima').val();
        if (!validateForm()) {
            requestHttpAjax(link, arrParams, function (response) {
                showAlert(response.status, response.label, response.message);
                setTimeout(function () {
                    var opor_id = $('#txth_opo_id').val();
                    var pges_id = $('#txth_pgid').val();
                    window.location.href = $('#txth_base').val() + "/admision/actividades/listaractividades?opor_id=" + opor_id + "&pges_id=" + pges_id;
                }, 3000);
            }, true);
        }
    });
    $('#btn_editaractividad').click(function () {
        var opid = $('#txth_opo_id').val();
        var pgid = $('#txth_pgid').val();
        var acid = $('#txth_acid').val();
        window.location.href = $('#txth_base').val() + "/admision/actividades/edit?opid=" + opid + "&pgid=" + pgid + "&acid=" + acid;
    });
});

function newItem(){
    var opid = $('#txth_opid').val();
    var pgid = $('#txth_pgid').val();
    window.location.href = $('#txth_base').val() + "/admision/actividades/newactividad?opid=" + opid + "&pgid=" + pgid;
}

function save(){
    var link = $('#txth_base').val() + "/admision/actividades/save";
    var arrParams = new Object();
    //Datos Gestión 
    arrParams.oportunidad = $('#txth_opo_id').val();
    arrParams.estado_oportunidad = $('#cmb_state_opportunity').val();
    arrParams.fecatencion = $('#txt_fecha_atencion').val();
    arrParams.horatencion = $('#txt_hora_atencion').val();
    arrParams.observacion = $('#txt_observacion').val();        
    if(arrParams.estado_oportunidad==5){
        arrParams.oportunidad_perdida=$('#cmb_lost_opportunity').val();            
    }
    //Datos Próxima Atención
    arrParams.fecproxima = $('#txt_fecha_proxima').val();
    arrParams.horproxima = $('#txt_hora_proxima').val();
    if (!validateForm()) {
        requestHttpAjax(link, arrParams, function (response) {
            showAlert(response.status, response.label, response.message);
            setTimeout(function () {
                var opor_id = $('#txth_opo_id').val();
                var pges_id = $('#txth_pgid').val();
                window.location.href = $('#txth_base').val() + "/admision/actividades/listaractividades?opor_id=" + opor_id + "&pges_id=" + pges_id;
            }, 3000);
        }, true);
    }
}

function update(){
    var link = $('#txth_base').val() + "/admision/actividades/update";
    var arrParams = new Object();
    //Datos Gestión 
    arrParams.bact_id = $('#txth_acid').val();
    arrParams.fecatencion = $('#txt_fecha_atencion').val();
    arrParams.horatencion = $('#txt_hora_atencion').val();
    arrParams.observacion = $('#txt_observacion').val();        
    //Datos Próxima Atención
    arrParams.fecproxima = $('#txt_fecha_proxima').val();
    arrParams.horproxima = $('#txt_hora_proxima').val();
    if (!validateForm()) {
        requestHttpAjax(link, arrParams, function (response) {
            showAlert(response.status, response.label, response.message);
            setTimeout(function () {
                var opor_id = $('#txth_opo_id').val();
                var pges_id = $('#txth_pgid').val();
                window.location.href = $('#txth_base').val() + "/admision/actividades/listaractividades?opor_id=" + opor_id + "&pges_id=" + pges_id;
            }, 3000);
        }, true);
    }
}

function edit(){
    var opid = $('#txth_opo_id').val();
    var pgid = $('#txth_pgid').val();
    var acid = $('#txth_acid').val();
    window.location.href = $('#txth_base').val() + "/admision/actividades/edit?opid=" + opid + "&pgid=" + pgid + "&acid=" + acid;
}