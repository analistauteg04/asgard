$(document).ready(function () {
   var link = $('#txth_base').val() + "/asignacionejecutivo/reasignar";
   var arrParams = new Object();
   arrParams.nivel = $('#cmb_nivel').val();
   arrParams.modalidad = $('#cmb_modalidad').val();
   arrParams.getagente = true;        
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;                  
                setComboData(data.agentes, "cmb_ejecutivo");
            }
        },true);
        
   $('#btn_asignarEjecutivo').click(function () {
        var arrParams = new Object();
        var link = $('#txth_base').val() + "/asignacionejecutivo/crearasignacion";
        arrParams.ejecutivo_id = $('#cmb_ejecutivo').val();        
        arrParams.int_id = $('#txth_ids').val();        
        arrParams.pint_id = $('#txth_pids').val();   
        arrParams.asp_id = $('#txth_asp').val();  
       
        if (!validateForm()) {
            requestHttpAjax(link, arrParams, function (response) {                                
                showAlert(response.status, response.label, response.message);                
                setTimeout(function () {
                    parent.window.location.href = $('#txth_base').val() + "/asignacionejecutivo/listarasignacion";
                }, 2000);
            }, true);
        }
    });
        
    $('#btn_ReasignarEjecutivo').click(function () {
        var arrParams = new Object();
        var link = $('#txth_base').val() + "/asignacionejecutivo/crearreasignacion";
        arrParams.ejecutivo_id = $('#cmb_ejecutivo').val();        
        arrParams.int_id = $('#txth_ids').val();        
        arrParams.pint_id = $('#txth_pids').val();   
        arrParams.asp_id = $('#txth_asp').val();  
       
        if (!validateForm()) {
            requestHttpAjax(link, arrParams, function (response) {                                
                showAlert(response.status, response.label, response.message);                
                setTimeout(function () {
                    parent.window.location.href = $('#txth_base').val() + "/asignacionejecutivo/listarasignacion";
                }, 2000);
            }, true);
        }
    });
    
    $('#cmb_modalidad').change(function () {
        var link = $('#txth_base').val() + "/asignacionejecutivo/reasignar";
        var arrParams = new Object();
        arrParams.nivel = $('#cmb_nivel').val();
        arrParams.modalidad = $(this).val();
        arrParams.getagente = true;        
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;                  
                setComboData(data.agentes, "cmb_ejecutivo");
            }
        },true);
    });
    
    $('#btn_buscarData').click(function(){
        actualizarGrid();
    });            
});

function actualizarGrid(){
    var search = $('#txt_buscarData').val();
    var ejecutivo = $('#cmb_ejecutivo option:selected').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    //Buscar almenos una clase con el nombre para ejecutar
    if(!$(".blockUI").length){
        showLoadingPopup();
        $('#TbG_PERSONAS').PbGridView('applyFilterData',{'f_ini':f_ini,'f_fin':f_fin,'ejecutivo':ejecutivo,'search':search});
        setTimeout(hideLoadingPopup,2000);
    }
}

