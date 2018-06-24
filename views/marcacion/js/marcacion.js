/*
 * It is released under the terms of the following BSD License.
 * Authors:
 * Jefferson Conde <analistadesarrollo03@uteg.edu.ec>
 */

$(document).ready(function () {
    
    $('#sendMarcacion').click(function () {
        var link = $('#txth_base').val() + "/marcacion/guardarmarcacion";
        var arrParams = new Object();
       
       // alert($('#txt_hora').val());
       arrParams.per_id = $('#txth_perid').val();
        arrParams.nombre = $('#txt_primer_nombre').val();
        arrParams.identificacion = $('#txt_identificacion').val();        
        arrParams.asignatura = $('#cmb_asignatura').val();        
       // arrParams.semana = $('#cmb_semana').val();        
        arrParams.fecha = $('#txt_fecha').val();        
        arrParams.hora = $('#txt_hora').val();
      
      //  alert(link);
        if (!validateForm()) {
            requestHttpAjax(link, arrParams, function (response) {
                showAlert(response.status, response.label, response.message);
                setTimeout(function () {
                    sessionStorage.clear();
                    window.location.href = $('#txth_base').val() + "/marcacion/ingreso";
                }, 3000);
            }, true);
      }
    });
    
});