/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {
 $('#btn_buscarData_dist').click(function() {
        searchModules();
    });
 });

function searchModules() {
    var arrParams = new Object();
    arrParams.PBgetFilter = true;
    arrParams.search = $("#txt_buscarData").val();    
    arrParams.periodo = $("#cmb_periodo").val();    
    arrParams.estado = $("#cmb_estado").val();
    $("#Tbg_Distributivo_Aca").PbGridView("applyFilterData", arrParams);
}

function exportExcel() {
    var search = $('#txt_buscarData').val();    
    var periodo = $('#cmb_periodo').val();    
    window.location.href = $('#txth_base').val() + "/academico/distributivoacademico/exportexcel?" +
        "search=" + search +        
        "&periodo=" + periodo;   
}

function exportPdf() {
    var search = $('#txt_buscarData').val();    
    var periodo = $('#cmb_periodo').val();    
    window.location.href = $('#txth_base').val() + "/academico/distributivoacademico/exportpdf?pdf=1" +
        "&search=" + search +        
        "&periodo=" + periodo;
}