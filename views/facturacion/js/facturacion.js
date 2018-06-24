/*
 * Authors:
 * Grace Viteri <analistadesarrollo01@uteg.edu.ec>
 */

$(document).ready(function () {
    
    /* Grabar descuentos */
    $('#btn_grabaDescuento').click(function () {
        var arrParams = new Object();
        var link = $('#txth_base').val() + "/facturacion/guardardescuento";
        arrParams.descripcion = $('#txt_descripcion').val();
        arrParams.porcentaje = $('#txt_porcentaje').val();
        
        if (!validateForm()) {
            requestHttpAjax(link, arrParams, function (response) {
                showAlert(response.status, response.label, response.message);
                setTimeout(function () {                    
                    window.location.href = $('#txth_base').val() + "/facturacion/descuento";                   
                }, 1000);
            }, true);
        }
    });

    /* Grabar descuento por item */
    $('#btn_grabarDctoItem').click(function () {
        var arrParams = new Object();
        var link = $('#txth_base').val() + "/facturacion/guardardescuento_item";
        arrParams.ite_id = $('#txth_item').val();        
        arrParams.des_id = $('#cmb_descuento').val();
        arrParams.fecha_inicio = $('#txt_fecha_ini').val();
        arrParams.fecha_fin = $('#txt_fecha_fin').val();
        arrParams.porcentaje = $('#txt_por_descuento').val();
        arrParams.descripcion = $('#txt_descripcion').val();
   
        //if (!validateForm()) {        
            requestHttpAjax(link, arrParams, function (response) {               
                showAlert(response.status, response.label, response.message);
                setTimeout(function () {                    
                    parent.window.location.href = $('#txth_base').val() + "/facturacion/listaritem";                   
                }, 1000);
            }, true);
       // }
    });

     /***************filtra Item segun categoría**********************/
    $('#cmb_subcategoria').change(function () {      
        var link = $('#txth_base').val() + "/facturacion/listaritem";
        var arrParams = new Object();
        arrParams.subcategoria = $(this).val();
        arrParams.getitem = true;                  
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {                
                data = response.message;                
                setComboData(data.item, "cmb_item", "Seleccionar");
            }
        }, true);
    });  
});
    