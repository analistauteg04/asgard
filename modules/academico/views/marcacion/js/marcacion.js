$(document).ready(function () {

});

function Marcacion(materia,horario,accion, dia) {
    var link = $('#txth_base').val() + "/academico/marcacion/save";
    var arrParams = new Object();
    arrParams.materia = materia;
    arrParams.horario = horario;
    arrParams.accion = accion;
    arrParams.dia = dia;
    

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