/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {    
    $('#btn_buscarData').click(function () {
        llenarGrid();       
    });
    
    $('#cmb_tipo_bien').change(function () {
        var link = $('#txth_base').val() + "/inventario/inventario/index";
        var arrParams = new Object();
         alert('Saludos');
        arrParams.tipobien_id = $(this).val();
        arrParams.get_categoria = true;
        alert('Antes');
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.categorias, "cmb_categoria");
                //setComboDataselect(data.estandares, "cmb_estandar_evi","Seleccionar");
            }
        }, true);
    });   
    
    $('#cmb_departamento').change(function () {
        var link = $('#txth_base').val() + "/inventario/inventario/index";
        var arrParams = new Object();        
        arrParams.dpto_id = $(this).val();
        arrParams.get_area = true;
        alert('areas');
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.areas, "cmb_area");
                //setComboDataselect(data.estandares, "cmb_estandar_evi","Seleccionar");
            }
        }, true);
    });   
    
});

function llenarGrid() {
    var codigo = $('#txt_buscarData').val();
    var tipo_bien = $('#cmb_tipo_bien').val();
    var categoria = $('#cmb_categoria').val();
    var departamento = $('#cmb_departamento').val();
    var area = $('#cmb_area').val();
    
    //Buscar almenos una clase con el nombre para ejecutar
    if (!$(".blockUI").length) {
        showLoadingPopup();
        $('#Tbg_Listar').PbGridView('applyFilterData', {'codigo': codigo, 'tipo_bien': tipo_bien, 'categoria': categoria, 'departamento': departamento, 'area': area});
        setTimeout(hideLoadingPopup, 2000);
    }
}

function exportExcel() {
    var codigo = $('#txt_buscarData').val();
    var tipo_bien = $('#cmb_tipo_bien').val();
    var categoria = $('#cmb_categoria').val();
    var departamento = $('#cmb_departamento').val();
    var area = $('#cmb_area').val();
    window.location.href = $('#txth_base').val() + "/inventario/inventario/expexcel?search=" + codigo + "&tipo_bien=" + tipo_bien + "&categoria=" + categoria + "&departamento=" + departamento + "&area=" + area;
}

function exportPdf() {
    var codigo = $('#txt_buscarData').val();
    var tipo_bien = $('#cmb_tipo_bien').val();
    var categoria = $('#cmb_categoria').val();
    var departamento = $('#cmb_departamento').val();
    var area = $('#cmb_area').val();
    window.location.href = $('#txth_base').val() + "/inventario/inventario/exppdf?pdf=1&search=" + codigo + "&tipo_bien=" + tipo_bien + "&categoria=" + categoria + "&departamento=" + departamento + "&area=" + area;
}