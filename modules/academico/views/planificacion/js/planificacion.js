$(document).ready(function () {
    $('#btn_buscarMarcacion').click(function () {
        actualizarGridMarcacion();
    });

    $('#btn_cargarDocumento').click(function () {
        cargarDocumento();
    });

    $('#btn_buscarRegConf').click(function () {
        actualizarGridRegistroConf();
    });
    $('#btn_buscarPlanestudiante').click(function () {
        actualizarGridPlanest();
    });
    /************ planificacion x estudiante **********************************/
    $('#cmb_unidades').change(function () {
        var link = $('#txth_base').val() + "/academico/planificacion/planificacionestudiante";
        var arrParams = new Object();
        arrParams.nint_id = $(this).val();
        arrParams.getmodalidad = true;
        arrParams.empresa_id = 1;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboDataselect(data.modalidad, "cmb_modalidades", "Todos");
                var arrParams = new Object();
                if (data.modalidad.length > 0) {
                    arrParams.unidada = $('#cmb_unidades').val();
                    arrParams.moda_id = data.modalidad[0].id;
                    arrParams.empresa_id = 1;
                    arrParams.getcarrera = true;
                    requestHttpAjax(link, arrParams, function (response) {
                        if (response.status == "OK") {
                            data = response.message;
                            setComboDataselect(data.carrera, "cmb_carreras", "Todos");
                        }
                    }, true);
                }
            }
        }, true);
    });
    $('#cmb_modalidades').change(function () {
        var link = $('#txth_base').val() + "/academico/planificacion/planificacionestudiante";
        var arrParams = new Object();
        arrParams.unidada = $('#cmb_unidades').val();
        arrParams.moda_id = $(this).val();
        arrParams.empresa_id = 1;
        arrParams.getcarrera = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboDataselect(data.carrera, "cmb_carreras", "Todos");
            }
        }, true);
    });
    /*************************************************************************/

    $('#cmb_unidad').change(function () {
        var link = $('#txth_base').val() + "/academico/marcacion/listarhorario";
        var arrParams = new Object();
        arrParams.uaca_id = $(this).val();
        arrParams.getmodalidad = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboDataselect(data.modalidad, "cmb_modalidad", "Todos");
            }
        }, true);
    });

    $('#cmb_modalidad').change(function () {
        if ($(this).val() == 4 || $(this).val() == 1) {
            $('#divFechasDistancia').css('display', 'block');
        } else {
            $('#divFechasDistancia').css('display', 'none');
        }
    });

    $('#btn_buscarHorario').click(function () {
        actualizarGridHorario();
    });

    $('#btn_buscarNoMarcacion').click(function () {
        cargarNoMarcadas();
    });

    $('#cmb_per_academico').change(function () {
        var arrParams2 = new Object();
        arrParams2.PBgetFilter = true;
        arrParams2.pla_periodo_academico = $("#cmb_per_academico").val();
        arrParams2.mod_id = $("#cmb_modalidad").val();
        /* console.log(arrParams2); */
        $("#grid_planificaciones_list").PbGridView("applyFilterData", arrParams2);
    });

    $('#cmb_modalidad').change(function () {
        var arrParams2 = new Object();
        arrParams2.PBgetFilter = true;
        arrParams2.pla_periodo_academico = $("#cmb_per_academico").val();
        arrParams2.mod_id = $("#cmb_modalidad").val();
        /* console.log(arrParams2); */
        $("#grid_planificaciones_list").PbGridView("applyFilterData", arrParams2);
    });
});

function searchModules(idbox, idgrid) {
    var arrParams = new Object();
    arrParams.PBgetFilter = true;
    arrParams.search = $("#" + idbox).val();
    $("#" + idgrid).PbGridView("applyFilterData", arrParams);
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
    var arrParams = new Object();
    arrParams.PBgetFilter = true;
    arrParams.search = $("#boxgrid").val();
    //console.log (arrParams)
    console.log(arrParams.search)
    window.location.href = $('#txth_base').val() + "/documental/gestion/expexcel?search=" + arrParams.search;
}

function exportPdf() {
    var profesor = $('#txt_buscarDataProfesor').val();
    var materia = $('#txt_buscarDataMateria').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    var periodo = $('#cmb_periodo option:selected').val();
    window.location.href = $('#txth_base').val() + "/academico/marcacion/exppdf?pdf=1&profesor=" + profesor + "&materia=" + materia + "&f_ini=" + f_ini + "&f_fin=" + f_fin + "&periodo=" + periodo;
}

function cargarDocumento() {
    var arrParams = new Object();
    var link = $('#txth_base').val() + "/academico/planificacion/upload";
    arrParams.procesar_file = true;
    arrParams.archivo = $('#txth_pla_adj_documento2').val() + "." + $('#txth_pla_adj_documento').val().split('.').pop();
    arrParams.periodoAcademico = $('#frm_per_aca').val();
    arrParams.fechaInicio = $('#dtp_pla_fecha_ini').val();
    arrParams.fechaFin = $('#dtp_pla_fecha_fin').val();
    arrParams.modalidad = $('#cmb_moda').val();
    if (!validateForm()) {
        requestHttpAjax(link, arrParams, function (response) {
            showAlert(response.status, response.label, response.message);
            /* if (!response.error) {
             setTimeout(function () {
             window.location.href = $('#txth_base').val() + "/academico/planificacion/index";
             }, 3000);
             } */
        }, true);
    }
}

function descargarPlanificacion(pla_id) {
    /* console.log("Entra a descargar", pla_id); */
    window.location.href = $('#txth_base').val() + "/academico/planificacion/descargarplanificacion?pla_id=" + pla_id;
}

function searchModules(idbox, idgrid) {
    var arrParams2 = new Object();
    arrParams2.PBgetFilter = true;
    arrParams2.pla_periodo_academico = $("#cmb_per_academico").val();
    arrParams2.mod_id = $("#cmb_modalidad").val();
    /* console.log(arrParams2); */
    $("#grid_planificaciones_list").PbGridView("applyFilterData", arrParams2);
}

function actualizarGridHorario() {
    var profesor = $('#txt_buscarDataProfesor').val();
    var unidad = $('#cmb_unidad option:selected').val();
    var modalidad = $('#cmb_modalidad option:selected').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    var periodo = $('#cmb_periodo option:selected').val();

    //Buscar almenos una clase con el nombre para ejecutar
    if (!$(".blockUI").length) {
        showLoadingPopup();
        $('#PbHorario').PbGridView('applyFilterData', {'profesor': profesor, 'unidad': unidad, 'modalidad': modalidad, 'f_ini': f_ini, 'f_fin': f_fin, 'periodo': periodo});
        setTimeout(hideLoadingPopup, 2000);
    }
}

function exportExcelhorario() {
    var profesor = $('#txt_buscarDataProfesor').val();
    var unidad = $('#cmb_unidad option:selected').val();
    var modalidad = $('#cmb_modalidad option:selected').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    var periodo = $('#cmb_periodo option:selected').val();
    window.location.href = $('#txth_base').val() + "/academico/marcacion/expexcelhorario?profesor=" + profesor + "&unidad=" + unidad + '&modalidad=' + modalidad + "&f_ini=" + f_ini + "&f_fin=" + f_fin + "&periodo=" + periodo;
}

function exportPdfhorario() {
    var profesor = $('#txt_buscarDataProfesor').val();
    var unidad = $('#cmb_unidad option:selected').val();
    var modalidad = $('#cmb_modalidad option:selected').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    var periodo = $('#cmb_periodo option:selected').val();
    window.location.href = $('#txth_base').val() + "/academico/marcacion/exppdfhorario?pdf=1&profesor=" + profesor + "&unidad=" + unidad + '&modalidad=' + modalidad + "&f_ini=" + f_ini + "&f_fin=" + f_fin + "&periodo=" + periodo;
}

function cargarNoMarcadas() {
    var profesor = $('#txt_buscarDataProfesor').val();
    var materia = $('#txt_buscarDataMateria').val();
    var unidad = $('#cmb_unidad option:selected').val();
    var modalidad = $('#cmb_modalidad option:selected').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    var periodo = $('#cmb_periodo option:selected').val();
    var tipo = $('#cmb_tipo option:selected').val();

    if (!$(".blockUI").length) {
        showLoadingPopup();
        $('#PbNomarcacion').PbGridView('applyFilterData', {'profesor': profesor, 'materia': materia, 'unidad': unidad, 'modalidad': modalidad, 'f_ini': f_ini, 'f_fin': f_fin, 'periodo': periodo, 'tipo': tipo});
        setTimeout(hideLoadingPopup, 2000);
    }
}

function exportExcelNoMarcadas() {
    var profesor = $('#txt_buscarDataProfesor').val();
    var materia = $('#txt_buscarDataMateria').val();
    var unidad = $('#cmb_unidad option:selected').val();
    var modalidad = $('#cmb_modalidad option:selected').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    var periodo = $('#cmb_periodo option:selected').val();
    var tipo = $('#cmb_tipo option:selected').val();

    window.location.href = $('#txth_base').val() + "/academico/marcacion/expexcelnomarcadas?profesor=" + profesor + "&materia=" + materia + "&unidad=" + unidad + '&modalidad=' + modalidad + "&f_ini=" + f_ini + "&f_fin=" + f_fin + "&periodo=" + periodo + "&tipo=" + tipo;
}

function exportPdfNoMarcadas() {
    var profesor = $('#txt_buscarDataProfesor').val();
    var materia = $('#txt_buscarDataMateria').val();
    var unidad = $('#cmb_unidad option:selected').val();
    var modalidad = $('#cmb_modalidad option:selected').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    var periodo = $('#cmb_periodo option:selected').val();
    var tipo = $('#cmb_tipo option:selected').val();

    window.location.href = $('#txth_base').val() + "/academico/marcacion/exppdfnomarcadas?pdf=1&profesor=" + profesor + "&materia=" + materia + "&unidad=" + unidad + '&modalidad=' + modalidad + "&f_ini=" + f_ini + "&f_fin=" + f_fin + "&periodo=" + periodo + "&tipo=" + tipo;
}

function actualizarGridRegistroConf() {
    var arrParams2 = new Object();
    arrParams2.PBgetFilter = true;
    arrParams2.periodo = ($("#cmb_per_acad").val() != 0) ? ($("#cmb_per_acad option:selected").text()) : "";
    arrParams2.mod_id = $("#cmb_mod").val();
    $("#grid_regconf_list").PbGridView("applyFilterData", arrParams2);
}

function editRegConf() {
    var link = $('#txth_base').val() + "/academico/planificacion/editreg" + "?id=" + $("#frm_rco_id").val();
    window.location = link;
}

function updateRegConf() {
    var link = $('#txth_base').val() + "/academico/planificacion/updatereg";
    var arrParams = new Object();
    arrParams.id = $('#frm_rco_id').val();
    arrParams.pla_id = $('#cmb_per_acad').val();
    arrParams.finicio = $('#frm_fecha_ini').val();
    arrParams.ffin = $('#frm_fecha_fin').val();
    arrParams.bloque = $('#cmb_bloque').val();
    if ($('#frm_fecha_ini').val() > $('#frm_fecha_fin').val()) {
        var msg = objLang.The_initial_date_of_registry_cannot_be_greater_than_end_date_;
        shortModal(msg, objLang.Error, "error");
        return;
    }
    if (!validateForm()) {
        requestHttpAjax(link, arrParams, function (response) {
            showAlert(response.status, response.label, response.message);
            if (response.status == "OK") {
                setTimeout(function () {
                    window.location.href = $('#txth_base').val() + "/academico/planificacion/registerprocess";
                }, 3000);
            }
        }, true);
    }
}

function saveRegConf() {
    var link = $('#txth_base').val() + "/academico/planificacion/savereg";
    var arrParams = new Object();
    arrParams.pla_id = $('#cmb_per_acad').val();
    arrParams.finicio = $('#frm_fecha_ini').val();
    arrParams.ffin = $('#frm_fecha_fin').val();
    arrParams.bloque = $('#cmb_bloque').val();
    if ($('#frm_fecha_ini').val() > $('#frm_fecha_fin').val()) {
        var msg = objLang.The_initial_date_of_registry_cannot_be_greater_than_end_date_;
        shortModal(msg, objLang.Error, "error");
        return;
    }
    if (!validateForm()) {
        requestHttpAjax(link, arrParams, function (response) {
            showAlert(response.status, response.label, response.message);
            if (response.status == "OK") {
                setTimeout(function () {
                    window.location.href = $('#txth_base').val() + "/academico/planificacion/registerprocess";
                }, 3000);
            }
        }, true);
    }
}

function deleteItem(id) {
    var link = $('#txth_base').val() + "/academico/planificacion/deletereg";
    var arrParams = new Object();
    arrParams.id = id;
    requestHttpAjax(link, arrParams, function (response) {
        if (response.status == "OK") {
            actualizarGridRegistroConf();
        }
        setTimeout(function () {
            showAlert(response.status, response.label, response.message);
        }, 1000);
    }, true);
}

function actualizarGridPlanest() {
    var estudiante = $('#txt_buscarDataPlanifica').val();
    /*var unidad = $('#cmb_unidades option:selected').val();
     var modalidad = $('#cmb_modalidades option:selected').val();
     var carrera = $('#cmb_carreras option:selected').val();*/
    var periodo = $('#cmb_periodo option:selected').val();
    //Buscar almenos una clase con el nombre para ejecutar
    if (!$(".blockUI").length) {
        showLoadingPopup();
        $('#PbPlanificaestudiante').PbGridView('applyFilterData', {'estudiante': estudiante, /*'unidad': unidad, 'modalidad': modalidad, 'carrera': carrera,*/ 'periodo': periodo});
        setTimeout(hideLoadingPopup, 2000);
    }
}

function exportExcelplanifica() {
    var estudiante = $('#txt_buscarDataPlanifica').val();
    /*var unidad = $('#cmb_unidades option:selected').val();
     var modalidad = $('#cmb_modalidades option:selected').val();
     var carrera = $('#cmb_carreras option:selected').val();*/
    var periodo = $('#cmb_periodo option:selected').val();
    window.location.href = $('#txth_base').val() + "/academico/planificacion/expexcelplanifica?estudiante=" + estudiante + /*"&unidad="+ unidad + '&modalidad='+ modalidad + "&carrera=" +*/ "&periodo=" + periodo;
}

function exportPdfplanifica() {
    var estudiante = $('#txt_buscarDataPlanifica').val();
    /*var unidad = $('#cmb_unidades option:selected').val();
     var modalidad = $('#cmb_modalidades option:selected').val();
     var carrera = $('#cmb_carreras option:selected').val();*/
    var periodo = $('#cmb_periodo option:selected').val();
    window.location.href = $('#txth_base').val() + "/academico/planificacion/exppdfplanifica?pdf=1&estudiante=" + estudiante + /*"&unidad="+ unidad + '&modalidad='+ modalidad + "&carrera=" + carrera + */ "&periodo=" + periodo;
}
function accion(plaid, perid) {
    var link = $('#txth_base').val() + "/academico/planificacion/deleteplanest";
    var arrParams = new Object();
    arrParams.pla_id = plaid;
    arrParams.per_id = perid;
    if (!validateForm()) {
        requestHttpAjax(link, arrParams, function (response) {
            showAlert(response.status, response.label, response.message);
            if (!response.error) {
                setTimeout(function () {
                    window.location.href = $('#txth_base').val() + "/academico/planificacion/planificacionestudiante";
                }, 3000);
            }
        }, true);
    }
}

function deleteplanestudiante(plaid, perid) {
    var mensj = "¿Seguro desea eliminar la planificación?";
    var messagePB = new Object();
    messagePB.wtmessage = mensj;
    messagePB.title = "Eliminar";
    var objAccept = new Object();
    objAccept.id = "btnid2del";
    objAccept.class = "btn-primary";
    objAccept.value = "Aceptar";
    objAccept.callback = 'accion';
    var params = new Array(plaid, perid);
    objAccept.paramCallback = params;
    messagePB.acciones = new Array();
    messagePB.acciones[0] = objAccept;
    showAlert("warning", "warning", messagePB);
}