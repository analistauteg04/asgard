$(document).ready(function () {
    $('#btn_buscarMarcacion').click(function () {
        actualizarGridMarcacion();
    });
    
    $('#btn_cargarHorario').click(function () {
        cargarHorario();
    });
});

function Marcacion(hape_id, horario, accion, dia, prof_id) {
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

function actualizarGridMarcacion() {
    var profesor = $('#txt_buscarDataProfesor').val();
    var materia = $('#txt_buscarDataMateria').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    var periodo = $('#cmb_periodo option:selected').val();

    //Buscar almenos una clase con el nombre para ejecutar
    if (!$(".blockUI").length) {
        showLoadingPopup();
        $('#PbMarcacion').PbGridView('applyFilterData', {'profesor': profesor, 'materia': materia, 'f_ini': f_ini, 'f_fin': f_fin, 'periodo': periodo});
        setTimeout(hideLoadingPopup, 2000);
    }
}
function exportExcel() {
    var profesor = $('#txt_buscarDataProfesor').val();
    var materia = $('#txt_buscarDataMateria').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    var periodo = $('#cmb_periodo option:selected').val();
    window.location.href = $('#txth_base').val() + "/academico/marcacion/expexcel?profesor=" + profesor + "&materia=" + materia + "&f_ini=" + f_ini + "&f_fin=" + f_fin + "&periodo=" + periodo;
}
function exportPdf() {
    var profesor = $('#txt_buscarDataProfesor').val();
    var materia = $('#txt_buscarDataMateria').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    var periodo = $('#cmb_periodo option:selected').val();
    window.location.href = $('#txth_base').val() + "/academico/marcacion/exppdf?pdf=1&profesor=" + profesor + "&materia=" + materia + "&f_ini=" + f_ini + "&f_fin=" + f_fin + "&periodo=" + periodo;
}


function cargarHorario() {
    var arrParams = new Object();
    var link = $('#txth_base').val() + "/academico/marcacion/cargarhorario";
    arrParams.procesar_file = true;    
    arrParams.periodo_id = $('#cmb_periodo option:selected').val();
    arrParams.archivo = $('#txth_doc_adj_horario2').val() + "." + $('#txth_doc_adj_horario').val().split('.').pop();    
    if (!validateForm()) {
        requestHttpAjax(link, arrParams, function (response) {
            showAlert(response.status, response.label, response.message);
            setTimeout(function () {
                window.location.href = $('#txth_base').val() + "/academico/marcacion/index";
            }, 3000);
        }, true);
    }
}