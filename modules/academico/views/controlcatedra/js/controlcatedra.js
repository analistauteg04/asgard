$(document).ready(function () {
    $('#btn_control').click(function () {
        grabarControl();
    });
    $('#cmb_unidad').change(function () {
        var link = $('#txth_base').val() + "/academico/controlcatedra/new";
        document.getElementById("cmb_carrera").options.item(0).selected = 'selected';
        var arrParams = new Object();
        arrParams.uni_id = $(this).val();
        arrParams.getmodalidad = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboDataselect(data.modalidad, "cmb_modalidad", "Seleccionar");
                var arrParams = new Object();
                if (data.modalidad.length > 0) {
                    arrParams.unidada = $('#cmb_unidad').val();
                    arrParams.moda_id = data.modalidad[0].id;
                    arrParams.getcarrera = true;
                    requestHttpAjax(link, arrParams, function (response) {
                        if (response.status == "OK") {
                            data = response.message;
                            setComboDataselect(data.programa, "cmb_carrera", "Seleccionar");
                        }
                    }, true);
                }
            }
        }, true);
    });
    $('#cmb_modalidad').change(function () {
        var link = $('#txth_base').val() + "/academico/controlcatedra/new";
        var arrParams = new Object();
        arrParams.unidada = $('#cmb_unidad').val();
        arrParams.moda_id = $(this).val();
        arrParams.getcarrera = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboDataselect(data.programa, "cmb_carrera", "Seleccionar");
            }
        }, true);
    }
    );
    
    $('#btn_buscarRegistro').click(function () {
        actualizarGridCatedra();
    });
    
});

function setComboDataselect(arr_data, element_id, texto) {
    var option_arr = "";
    option_arr += "<option value= '0'>" + texto + "</option>";
    for (var i = 0; i < arr_data.length; i++) {
        var id = arr_data[i].id;
        var value = arr_data[i].name;

        option_arr += "<option value='" + id + "'>" + value + "</option>";
    }
    $("#" + element_id).html(option_arr);
}

function actualizarGridCatedra() {
    var profesor = $('#txt_buscarDataProfesor').val();
    var unidad = $('#cmb_unidad option:selected').val();
    var modalidad = $('#cmb_modalidad option:selected').val();
    var materia = $('#txt_buscarDataMateria').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    var periodo = $('#cmb_periodo option:selected').val();    
    var estado = $('#cmb_estado option:selected').val();

    //Buscar almenos una clase con el nombre para ejecutar
    if (!$(".blockUI").length) {
        showLoadingPopup();
        $('#PbCatedra').PbGridView('applyFilterData', {'profesor': profesor, 'unidad': unidad, 'modalidad': modalidad, 'materia': materia, 'f_ini': f_ini, 'f_fin': f_fin, 'periodo': periodo, 'estado': estado});
        setTimeout(hideLoadingPopup, 2000);
    }
}
function grabarControl() {
    var link = $('#txth_base').val() + "/academico/controlcatedra/save";
    var arrParams = new Object();
    arrParams.hape_id = $('#txth_hape_id').val();
    arrParams.carrera = $('#cmb_carrera').val();
    arrParams.fecha_registro = $('#txt_fecha').val();
    arrParams.titulo = $('#txt_titulo').val();
    arrParams.tema = $('#txt_tema').val();
    arrParams.trabajo = $('#txt_trabajo').val();
    arrParams.logro = $('#txt_logro').val();
    arrParams.observacion = $('#txt_observacion').val();
    //arrParams.programa = $("#cmb_programa option:selected").text();
    /* if (arrParams.mes == 0 || arrParams.modalidad == 0 || arrParams.programa == 0)
     {
     showAlert('NO_OK', 'error', {"wtmessage": "Debe seleccionar opciones de las listas.", "title": 'Error'});
     } else
     {*/
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
    // }
}