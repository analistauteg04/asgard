$(document).ready(function () {

});

function Marcacion(hape_id,horario,accion,dia,prof_id) {    
    var link = $('#txth_base').val() + "/academico/marcacion/save";
    var arrParams = new Object();
    arrParams.hape_id = hape_id;
    arrParams.horario = horario;
    arrParams.accion = accion;
    arrParams.dia = dia;
    arrParams.profesor = prof_id;    
    if (!validateForm()) {
        requestHttpAjax(link, arrParams, function (response) {
            showAlert(response.status, response.label, response.message);
            if (!response.error) {
                setTimeout(function () {
                    window.location.href = $('#txth_base').val() + "/academico/marcacion/marcacion";
                }, 5000);
            }
        }, true);
    }
}