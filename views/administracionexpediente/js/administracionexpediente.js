$(document).ready(function () {       
    $('#btn_buscarData').click(function(){
        actualizarGridExpediente();
    }); 
    
});

function actualizarGridExpediente(){
    var search = $('#txt_buscarData').val();    
    var estado = $('#cmb_estado option:selected').val();    
    //Buscar almenos una clase con el nombre para ejecutar
    if(!$(".blockUI").length){
        showLoadingPopup();
        $('#TbG_PERSONAS').PbGridView('applyFilterData',{'estadoexp':estado,'search':search});
        setTimeout(hideLoadingPopup,2000);
    }
}
