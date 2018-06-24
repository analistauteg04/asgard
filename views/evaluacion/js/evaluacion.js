/*
 * It is released under the terms of the following BSD License.
 * Authors:
 * Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>
 */

$(document).ready(function () {

    $('#btnPromedio').click(function () {
        var link = $('#txth_base').val() + "/evaluacion/evaluar";
        var arrParams = new Object();
        arrParams.periodo = $('#cmb_periodo').val();
        arrParams.asignatura = $('#cmb_asignatura').val();
        arrParams.hevaluacion = $('#txt_heteroevaluación').val();
        arrParams.aevaluacion = $('#txt_autoevaluación').val();
        arrParams.cevaluacion = $('#txt_coevaluación').val();
        arrParams.directivo = $('#txt_directivo').val();
        arrParams.nivelestudio = $('#cmb_ninteres').val();
        arrParams.facultad = $('#cmb_facultad').val();
        arrParams.areaconoce = $('#cmb_areacono').val();
        arrParams.promedio = ((parseFloat(arrParams.hevaluacion) + parseFloat(arrParams.aevaluacion) + parseFloat(arrParams.cevaluacion) + parseFloat(arrParams.directivo)) / 4);
        arrParams.profesor = $('#TbG_Profesor input[name=rb_profesor]:checked').val();
        arrParams.paralelo = $('#txt_paralelo').val();
        arrParams.carrera = $('#TbG_CARRERAS input[name=rb_carrera]:checked').val();
        if (arrParams.promedio > 0) {
            $('#txt_promedio').val(arrParams.promedio.toFixed(2));
        }
        if (!validateForm()) {
            requestHttpAjax(link, arrParams, function (response) {
                showAlert(response.status, response.label, response.message);
                setTimeout(function () {
                    window.location.href = $('#txth_base').val() + "/evaluacion/evaluar";
                }, 3000);
            }, true);
        }
    });
    $('#sendEvaluacion').click(function () {
        var link = $('#txth_base').val() + "/evaluacion/guardarevaluacion";
        var arrParams = new Object();
        arrParams.periodo = $('#cmb_periodo').val();
        arrParams.asignatura = $('#cmb_asignatura').val();
        arrParams.hevaluacion = $('#txt_heteroevaluación').val();
        arrParams.aevaluacion = $('#txt_autoevaluación').val();
        arrParams.cevaluacion = $('#txt_coevaluación').val();
        arrParams.directivo = $('#txt_directivo').val();
        arrParams.promedio = $('#txt_promedio').val();
        arrParams.nivelestudio = $('#cmb_ninteres').val();
        arrParams.facultad = $('#cmb_facultad').val();
        arrParams.areaconoce = $('#cmb_areacono').val();
        arrParams.bloque = $('#cmb_bloque').val();
        arrParams.subarea = $('#cmb_subarea').val();
        arrParams.horario = dataHorario;
        arrParams.profesor = $('#TbG_Profesor input[name=rb_profesor]:checked').val();
        arrParams.paralelo = $('#txt_paralelo').val();
        arrParams.carrera = $('#TbG_CARRERAS input[name=rb_carrera]:checked').val();
        arrParams.grupo = $('#cmb_grupo').val();
        arrParams.mes = $('#cmb_mes').val();
        arrParams.modulo = $('#cmb_modulo').val();
        if (arrParams.profesor === undefined)
        {
            alert('Profesor: Campo no puede ser vacio');            
        }
        if (arrParams.carrera === undefined)
        {
            alert('Carrera: Campo no puede ser vacio');            
        }
        if (!validateForm()) {
            requestHttpAjax(link, arrParams, function (response) {
                showAlert(response.status, response.label, response.message);
                setTimeout(function () {
                    sessionStorage.clear();
                    window.location.href = $('#txth_base').val() + "/evaluacion/evaluar";
                }, 3000);
            }, true);
        }
    });      
    $('#btn_buscarDataEvaluacion').click(function () {
        actualizarGrid();
    });
    $('#btn_buscarProfesor').click(function () {
        //TbG_listarprofesor
        actualizarProfesorGrid();
    });

    $('#btn_BuscarCarrera').click(function () {
        actualizarCarreraGrid('ca');
    });

    $('#btn_BuscarPrograma').click(function () {
        actualizarCarreraGrid('po');
    });

    /***************filtra facultad segun nivel estudio interes vista evaluacion**********************/
    $('#cmb_ninteres').change(function () {
        var link = $('#txth_base').val() + "/evaluacion/evaluar";
        var arrParams = new Object();
        arrParams.ninter_id = $(this).val();
        arrParams.getfacultad = true;
        if (arrParams.ninter_id == 1)
        {
            $('#periodo').css('display', 'block');
            $('#asigna').css('display', 'block');
            $('#modulo').css('display', 'none');
            $('#grupo').css('display', 'none');
            $('#buscacarrera').css('display', 'block');
            $('#buscaprograma').css('display', 'none');
            $('#gridcarrera').css('display', 'none');
            $('#gridprograma').css('display', 'none');
        } else
        {
            $('#periodo').css('display', 'none');
            $('#modulo').css('display', 'block');
            $('#asigna').css('display', 'none');
            $('#grupo').css('display', 'block');
            $('#buscacarrera').css('display', 'none');
            $('#buscaprograma').css('display', 'block');
            $('#gridcarrera').css('display', 'none');
            $('#gridprograma').css('display', 'none');
        }
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.facultad, "cmb_facultad", "Seleccionar");
                if (arrParams.ninter_id == 0) {
                    $('#cmb_facultad').append('<option value="0" selected="selected">Seleccionar</option>');
                }
            }
        }, true);
    });

    $('#cmb_facultad').change(function () {
        var link = $('#txth_base').val() + "/evaluacion/evaluar";
        var arrParams = new Object();
        arrParams.fac_id = $(this).val();
        arrParams.getcarrera = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.carrera, "cmb_carrera", "Seleccionar");
            }
        }, true);
    });

    $('#cmb_anio').change(function () {
        var link = $('#txth_base').val() + "/evaluacion/evaluar";
        var arrParams = new Object();
        arrParams.anio_id = $(this).val();
        //alert(arrParams.anio_id);
        arrParams.getperiodo = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.periodo, "cmb_periodo");
            }
        }, true);
    });

    /***************filtra facultad segun nivel estudio interes vista listar evaluaciones**********************/
    $('#cmb_nintereslist').change(function () {
        var link = $('#txth_base').val() + "/evaluacion/listaevaluacion";
        var arrParams = new Object();
        arrParams.ninter_id = $(this).val();
        arrParams.getfacultad = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboDataselect(data.facultad, "cmb_facultadlist", "Todas");
            }
        }, true);
    });

    $('#cmb_facultadlist').change(function () {
        var link = $('#txth_base').val() + "/evaluacion/evaluar";
        var arrParams = new Object();
        arrParams.fac_id = $(this).val();
        arrParams.getcarrera = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboDataselect(data.carrera, "cmb_carreralist", "Todas");
            }
        }, true);
    });

    $('#cmb_carreralist').change(function () {
        var link = $('#txth_base').val() + "/evaluacion/evaluar";
        var arrParams = new Object();
        arrParams.car_id = $(this).val();
        arrParams.getmateria = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboDataselect(data.materia, "cmb_asignaturalist", "Todas");
            }
        }, true);
    });

    /***************filtra Area conocimiento  **********************/
    $('#cmb_areacono').change(function () {
        var link = $('#txth_base').val() + "/evaluacion/evaluar";
        var arrParams = new Object();
        arrParams.area = $(this).val();
        arrParams.getarea = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.subarea, "cmb_subarea");
                var arrParams = new Object();
                if (data.subarea.length > 0) {
                    arrParams.subarea = data.subarea[0].id;
                    arrParams.getsubarea = true;
                    requestHttpAjax(link, arrParams, function (response) {
                        if (response.status == "OK") {
                            data = response.message;                           
                            setComboDataselect(data.materia, "cmb_asignatura", "Seleccionar");
                        }
                    }, true);
                }
            }
        }, true);
    });
    $('#cmb_subarea').change(function () {
        var link = $('#txth_base').val() + "/evaluacion/evaluar";
        var arrParams = new Object();
        arrParams.subarea = $(this).val();
        arrParams.getsubarea = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;               
                setComboDataselect(data.materia, "cmb_asignatura", "Seleccionar");
            }
        }, true);
    });

    /***********************************************************************************************/
    /****************************Agregar Horarios**************************************************/
    var dataHorario = [];
    dataHorario = obtDataHorario();
    paintHorario(dataHorario);

    if (dataHorario.length != 0) {
        paintHorario(dataHorario);
    }
    $('#btn_AgregarHorario').click(function () {        
        var arrParams = new Object();
        arrParams.semana = $('#cmb_semana').val();
        arrParams.horaini = $('#txt_hora_inicio').val();
        arrParams.horafin = $('#txt_hora_fin').val();        
        var responseinicio = validarExpresion(/^\d?\d:\d{2}$/, arrParams.horaini);
        var responsefinal = validarExpresion(/^\d?\d:\d{2}$/, arrParams.horafin);
        if (!responseinicio || !responsefinal) {
            alert('Invalido hora inicio u hora fin');           
        } else
        {
            HorarioList = obtDataHorario();
            guardarLHora();
            dataHorario = obtDataHorario();
            paintHorario(dataHorario);
            //limpiar controles
            document.getElementById("cmb_semana").value = 'Lunes';
            $('#txt_hora_inicio').val("");
            $('#txt_hora_fin').val("");
        }
    });

    function guardarLHora() {
        var cmb_semana = $('#cmb_semana').val();
        var txt_hora_inicio = $('#txt_hora_inicio').val();
        var txt_hora_fin = $('#txt_hora_fin').val();
        var data = obtDataHorario();
        var longitud = (data.length) + 1;
        var newHora = {
            semana: cmb_semana,
            hora_inicio: txt_hora_inicio,
            hora_fin: txt_hora_fin,
            hora_clave: longitud,

        }
        HorarioList.push(newHora);
        sessionStorage.setItem('datosHorario', JSON.stringify(HorarioList));
    }
});

/* Funciones para bloque familiares en la institución*/
function obtDataHorario() {
    var storedListHorario = sessionStorage.getItem('datosHorario');
    if (storedListHorario == null) {
        HorarioList = [];
    } else {
        HorarioList = JSON.parse(storedListHorario);
    }
    return HorarioList;
}
function paintHorario(dataHorario) {
    html = " <div class='grid-view'>" +
            "<table class='table table-striped table-bordered dataTable'>" +
            "<tbody>" +
            "  <tr> <th>Día</th> <th>Hora Inicio</th> <th>Hora Fin</th><th> </th></tr>";
    for (i = 0; i < dataHorario.length; i++) {
        html += "<tr><td>" + dataHorario[i]['semana'] + "</td> <td>" + dataHorario[i]['hora_inicio'] + "</td> <td>" + dataHorario[i]['hora_fin'] + "</td><td><button type='button' class='btn btn-link' onclick='eliminarhorario(" + dataHorario[i]['hora_clave'] + ")'> <span class='glyphicon glyphicon-remove'></span> </button></td></tr>";
    }
    html += "  <tr  height='40'> <th></th> <th></th> <th></th><th> </th></tr>";
    html += "</tbody>";
    html += "    </table>" + "</div>";
    $("#resultadoListHorario").html(html);

}

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

function exportExcel() {
    var periodo = $('#cmb_periodo option:selected').val();
    var search = $('#txt_buscarDataProfesor').val();   
    var asignatura = $('#cmb_asignatura option:selected').val();
    var nivelestudio = $('#cmb_nintereslist option:selected').val();
    var facultadest = $('#cmb_facultadlist option:selected').val();
    window.location.href = $('#txth_base').val() + "/evaluacion/expexcel?search=" + search + "&nivelestudio=" + nivelestudio + "&facultadest=" + facultadest;
}

function actualizarGrid() {
    var search = $('#txt_buscarDataProfesor').val();
    var asignatura = $('#cmb_asignatura option:selected').val();
    var nivelestudio = $('#cmb_nintereslist option:selected').val();
    var facultadest = $('#cmb_facultadlist option:selected').val();
    var materiaest = $('#cmb_asignaturalist option:selected').val();
    //Buscar almenos una clase con el nombre para ejecutar
    if (!$(".blockUI").length) {
        showLoadingPopup();
        $('#TbG_listarevaluacion').PbGridView('applyFilterData', {'search': search, 'nivelestudio': nivelestudio, 'facultadest': facultadest});
        setTimeout(hideLoadingPopup, 2000);
    }
}

function actualizarCarreraGrid(filtro) {   
    if (filtro === 'ca')
    {
        $('#gridcarrera').css('display', 'block');
    } else
    {
        $('#gridprograma').css('display', 'block');
    }
    var facultadeva = $('#cmb_facultad option:selected').val();
    var subareaeva = $('#cmb_subarea option:selected').val();
    var asignaeva = $('#cmb_asignatura option:selected').val();    
    //Buscar almenos una clase con el nombre para ejecutar
    if (!$(".blockUI").length) {
        showLoadingPopup();
        $('#TbG_CARRERAS').PbGridView('applyFilterData', {'facultadeva': facultadeva, 'subareaeva': subareaeva, 'asignaeva': asignaeva});
        setTimeout(hideLoadingPopup, 2000);
    }   
}

function actualizarProfesorGrid() {
    var search = $('#txt_buscarProfesor').val();

    //Buscar almenos una clase con el nombre para ejecutar
    if (!$(".blockUI").length) {
        showLoadingPopup();
        $('#TbG_listarprofesor').PbGridView('applyFilterData', {'search': search});
        setTimeout(hideLoadingPopup, 2000);
    }
}

function eliminarhorario(indice) {    
    var tmp = JSON.parse(sessionStorage.getItem('datosHorario'));
    var filteredPeople = tmp.filter(item => item.hora_clave !== indice);
    sessionStorage.setItem('datosHorario', JSON.stringify(filteredPeople));
    //Mostrar en tabla el session storage
    var dataHorario = obtDataHorario();
    paintHorario(dataHorario);
}

function searchProfesor(idbox, idgrid) {
    var arrParams = new Object();
    arrParams.PBgetFilter = true;
    arrParams.search = $("#" + idbox).val();
    $("#" + idgrid).PbGridView("applyFilterData", arrParams);
}