/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    $('#cmb_provincia').change(function () {
        var link = $('#txth_base').val() + "/personaexterna/index";
        var arrParams = new Object();
        arrParams.prov_id = $(this).val();
        arrParams.getcantones = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.cantones, "cmb_ciudad");
            }
        }, true);
    });
    
    $('#registrar').click(function () {
        var link = $('#txth_base').val() + "/personaexterna/save";
        var arrParams = new Object();         
        arrParams.nombres = $('#txt_nombre').val();
        arrParams.apellidos = $('#txt_apellido').val();
        arrParams.correo = $('#txt_correo').val();
        arrParams.celular = $('#txt_celular').val();
        arrParams.telefono = $('#txt_telefono').val();
        arrParams.genero = $('#cmb_genero').val();
        arrParams.edad = $('#txt_edad').val();
        arrParams.niv_interes = $('#cmb_nivel_estudio').val();
        arrParams.pro_id = $('#cmb_provincia').val();
        arrParams.can_id = $('#cmb_ciudad').val();
        arrParams.eve_id = $('#cmb_evento').val();                        
        if (!validateForm()) {
            requestHttpAjax(link, arrParams, function (response) {
                showAlert(response.status, response.label, response.message);
                if (!response.error) {
                    setTimeout(function () {
                        window.location.href = $('#txth_base').val() + "/personaexterna/index";
                    }, 5000);
                }
            }, true);
        }

    });
    
    
    
});
