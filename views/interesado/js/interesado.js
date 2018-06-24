
$(document).ready(function () {       
    $('#btn_buscarData').click(function(){
        actualizarGrid();
    }); 
    
    $('#btn_buscarDataPreins').click(function(){
        actualizarpreinsGrid();
    }); 
    
    
});

function actualizarGrid(){
    var search = $('#txt_buscarData').val();
    //var estado = $('#cmb_estado option:selected').val();
    var estadosol = $('#cmb_estado option:selected').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    //Buscar almenos una clase con el nombre para ejecutar
    if(!$(".blockUI").length){
        showLoadingPopup();
        $('#TbG_PERSONAS').PbGridView('applyFilterData',{'f_ini':f_ini,'f_fin':f_fin,'estadosol':estadosol,'search':search});
        setTimeout(hideLoadingPopup,2000);
    }
}

function actualizarpreinsGrid(){
    var search = $('#txt_buscarData').val();
    //var estado = $('#cmb_estado option:selected').val();    
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    //Buscar almenos una clase con el nombre para ejecutar
    if(!$(".blockUI").length){
        showLoadingPopup();
        $('#TbG_PERSONAS').PbGridView('applyFilterData',{'f_ini':f_ini,'f_fin':f_fin,'search':search});
        setTimeout(hideLoadingPopup,2000);
    }
}