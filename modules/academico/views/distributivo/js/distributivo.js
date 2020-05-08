$(document).ready(function () {
    $('#btn_buscarData').click(function () {
        actualizarGrid();
    });
    $('#btn_buscarDataHoras').click(function () {
        actualizarGridHoras();
    });
    $('#btn_buscarData_distprof').click(function () {
        actualizarGridDistProf();
    });
    $('#btn_buscarData_distpago').click(function () {
        actualizarGridDistPago();
    });
    $('#cmb_unidad_dis').change(function () {
        var link = $('#txth_base').val() + "/academico/distributivo/listarestudiantes";
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
    $('#cmb_unidad_dises').change(function () {
        var link = $('#txth_base').val() + "/academico/distributivo/listarestudiantespago";
        var arrParams = new Object();
        arrParams.uaca_id = $(this).val();
        arrParams.getmodalidad = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboDataselect(data.modalidad, "cmb_modalidades", "Todos");
                var arrParams = new Object();
                if (data.modalidad.length > 0) {
                    arrParams.uaca_id = $('#cmb_unidad_dises').val();
                    arrParams.moda_id = data.modalidad[0].id;
                    arrParams.getasignatura = true;
                    requestHttpAjax(link, arrParams, function (response) {
                        if (response.status == "OK") {
                            data = response.message;
                            setComboDataselect(data.asignatura, "cmb_asignaturaes", "Todos");
                        }
                    }, true);
                }
            }
        }, true);
    });
    
    $('#cmb_modalidades').change(function () {
        var link = $('#txth_base').val() + "/academico/distributivo/listarestudiantespago";
        var arrParams = new Object();
        arrParams.uaca_id = $('#cmb_unidad_dises').val();
        arrParams.moda_id = $(this).val();
        arrParams.getasignatura = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboDataselect(data.asignatura, "cmb_asignaturaes", "Todos");
            }
        }, true);
    });
    $('#btnGuardarpago').click(function () {
        guardarPagosEstudiante();
    });
});

function actualizarGrid() {
    var search = $('#txt_buscarData').val();
    var unidad = $('#cmb_unidad option:selected').val();
    var semestre = $('#cmb_semestre option:selected').val();
    //Buscar almenos una clase con el nombre para ejecutar
    if (!$(".blockUI").length) {
        showLoadingPopup();
        $('#Tbg_Distributivo').PbGridView('applyFilterData', {'search': search, 'unidad': unidad, 'semestre': semestre});
        setTimeout(hideLoadingPopup, 2000);
    }
}
function exportExcel() {
    var search = $('#txt_buscarData').val();
    var unidad = $('#cmb_unidad option:selected').val();
    var semestre = $('#cmb_semestre option:selected').val();
    window.location.href = $('#txth_base').val() + "/academico/distributivo/expexcel?search=" + search + "&unidad=" + unidad + "&semestre=" + semestre;
}
function exportPdf() {
    var search = $('#txt_buscarDataPersona').val();
    var unidad = $('#cmb_unidad option:selected').val();
    var semestre = $('#cmb_semestre option:selected').val();
    window.location.href = $('#txth_base').val() + "/academico/distributivo/exppdf?pdf=1&search=" + search + "&unidad=" + unidad + "&semestre=" + semestre;
}

function actualizarGridHoras() {
    var search = $('#txt_buscarData').val();
    var tipo = $('#cmb_tipo option:selected').val();
    var semestre = $('#cmb_semestre option:selected').val();
    //Buscar almenos una clase con el nombre para ejecutar
    if (!$(".blockUI").length) {
        showLoadingPopup();
        $('#Tbg_CargaHoraria').PbGridView('applyFilterData', {'search': search, 'tipo': tipo, 'semestre': semestre});
        setTimeout(hideLoadingPopup, 2000);
    }
}

function exportExcelHoras() {
    var search = $('#txt_buscarData').val();
    var tipo = $('#cmb_tipo option:selected').val();
    var semestre = $('#cmb_semestre option:selected').val();
    window.location.href = $('#txth_base').val() + "/academico/distributivo/expexcelhoras?search=" + search + "&tipo=" + tipo + "&semestre=" + semestre;
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

function actualizarGridDistProf() {
    var search = $('#txt_buscarData').val();
    var unidad = $('#cmb_unidad_dis option:selected').val();
    var modalidad = $('#cmb_modalidad option:selected').val();
    var periodo = $('#cmb_periodo option:selected').val();
    var estado = $('#cmb_estado option:selected').val();
    //Buscar almenos una clase con el nombre para ejecutar
    if (!$(".blockUI").length) {
        showLoadingPopup();
        $('#Tbg_Distributivo_listado').PbGridView('applyFilterData', {'search': search, 'unidad': unidad, 'modalidad': modalidad, 'periodo': periodo, 'estado': estado});
        setTimeout(hideLoadingPopup, 2000);
    }
}

function exportExcelDistprof() {
    var search = $('#txt_buscarData').val();
    var unidad = $('#cmb_unidad_dis option:selected').val();
    var modalidad = $('#cmb_modalidad option:selected').val();
    var periodo = $('#cmb_periodo option:selected').val();
    window.location.href = $('#txth_base').val() + "/academico/distributivo/expexceldist?search=" + search + "&unidad=" + unidad + "&modalidad=" + modalidad + "&periodo=" + periodo;
}

function exportPdfDisprof() {
    var search = $('#txt_buscarData').val();
    var unidad = $('#cmb_unidad_dis option:selected').val();
    var modalidad = $('#cmb_modalidad option:selected').val();
    var periodo = $('#cmb_periodo option:selected').val();
    window.location.href = $('#txth_base').val() + "/academico/distributivo/exppdfdis?pdf=1&search=" + search + "&unidad=" + unidad + "&modalidad=" + modalidad + "&periodo=" + periodo;
}

function actualizarGridDistPago() {
    var search = $('#txt_buscarDatapago').val();
    var profesor = $('#txt_buscarprofesor').val();
    var unidad = $('#cmb_unidad_dises option:selected').val();
    var modalidad = $('#cmb_modalidades option:selected').val();
    var periodo = $('#cmb_periodoes option:selected').val();
    var asignatura = $('#cmb_asignaturaes option:selected').val();
    var estado = $('#cmb_estadoes option:selected').val();
    //Buscar almenos una clase con el nombre para ejecutar
    if (!$(".blockUI").length) {
        showLoadingPopup();
        $('#Tbg_Distributivo_listadopago').PbGridView('applyFilterData', {'search': search, 'profesor': profesor, 'unidad': unidad, 'modalidad': modalidad, 'periodo': periodo, 'asignatura': asignatura, 'estado': estado});
        setTimeout(hideLoadingPopup, 2000);
    }
}
function guardarPagosEstudiante() {
     //var keys = String($('#Tbg_Distributivo_listadopago').PbGridView('getSelectedRows'));     
        var link = $('#txth_base').val() + "/academico/distributivo/savestudiantespago";
        var arrParams = new Object();
        arrParams.periodo = $('#cmb_periodoes').val();
        var selected = '';
        var unselected = '';
        //arrParams.carrera = $('#TbG_CARRERAS input[name=rb_carrera]:checked').val();
        $('#Tbg_Distributivo_listadopago input[type=checkbox]').each(function () {
            if (this.checked) {
                selected += $(this).val() + ',';
            }else{
                unselected += $(this).val() + ',';
            }
                
        });
            arrParams.pagado = selected.slice(0,-1);
            arrParams.nopagado = unselected.slice(0,-1);
        if (!validateForm()) {
            requestHttpAjax(link, arrParams, function (response) {
                showAlert(response.status, response.label, response.message);
                setTimeout(function () {
                    window.location.href = $('#txth_base').val() + "/academico/distributivo/listarestudiantespago";
                }, 3000);
            }, true);
        }
}

function exportExcelDistpago() {
    var search = $('#txt_buscarDatapago').val();
    var unidad = $('#cmb_unidad_dises option:selected').val();
    var modalidad = $('#cmb_modalidades option:selected').val();
    var periodo = $('#cmb_periodoes option:selected').val();
    var asignatura = $('#cmb_asignaturaes option:selected').val();
    var estado = $('#cmb_estadoes option:selected').val();
    window.location.href = $('#txth_base').val() + "/academico/distributivo/expexcelestpago?search=" + search + "&unidad=" + unidad + "&modalidad=" + modalidad + "&periodo=" + periodo + "&asignatura=" + asignatura + "&estado=" + estado;
}

function exportPdfDispago() {
    var search = $('#txt_buscarDatapago').val();
    var unidad = $('#cmb_unidad_dises option:selected').val();
    var modalidad = $('#cmb_modalidades option:selected').val();
    var periodo = $('#cmb_periodoes option:selected').val();
    var asignatura = $('#cmb_asignaturaes option:selected').val();
    var estado = $('#cmb_estadoes option:selected').val();
    window.location.href = $('#txth_base').val() + "/academico/distributivo/exppdfestpago?pdf=1&search=" + search + "&unidad=" + unidad + "&modalidad=" + modalidad + "&periodo=" + periodo + "&asignatura=" + asignatura + "&estado=" + estado;
}