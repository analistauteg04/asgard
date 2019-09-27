
$(document).ready(function () {
    $('#btn_buscarData').click(function () {
        actualizarGrid();
    });
    /***********************************************/
    /* Filtro para busqueda en listado solicitudes */
    /***********************************************/
    $('#cmb_unidadbus').change(function () {
        var link = $('#txth_base').val() + "/academico/matriculacionposgrados/index";
        document.getElementById("cmb_programabus").options.item(0).selected = 'selected';
        var arrParams = new Object();
        arrParams.uni_id = $(this).val();
        arrParams.getmodalidad = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboDataselect(data.modalidad, "cmb_modalidadbus", "Todos");
                var arrParams = new Object();
                if (data.modalidad.length > 0) {
                    arrParams.unidada = $('#cmb_unidadbus').val();
                    arrParams.moda_id = data.modalidad[0].id;
                    arrParams.getprograma = true;
                    requestHttpAjax(link, arrParams, function (response) {
                        if (response.status == "OK") {
                            data = response.message;
                            setComboDataselect(data.programa, "cmb_programabus", "Todos");
                        }
                    }, true);
                }
            }
        }, true);
    });
    $('#cmb_modalidadbus').change(function () {
        var link = $('#txth_base').val() + "/academico/matriculacionposgrados/index";
        var arrParams = new Object();
        arrParams.unidada = $('#cmb_unidadbus').val();
        arrParams.moda_id = $(this).val();
        arrParams.getprograma = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboDataselect(data.programa, "cmb_programabus", "Todos");
            }
        }, true);
    });
    
    $('#cmb_programa').change(function () {
        var link = $('#txth_base').val() + "/academico/matriculacionposgrados/new";
        var arrParams = new Object();
        arrParams.promocion_id = $(this).val();
        arrParams.getparalelos = true;                  
        requestHttpAjax(link, arrParams, function (response) {             
            if (response.status == "OK") {                                
                data = response.message;
                setComboData(data.paralelos, "cmb_paralelo");
                
            }
        }, true);
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

/*function exportExcel() {
    var search = $('#txt_buscarData').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    var unidad = $('#cmb_unidadbus option:selected').val();
    var modalidad = $('#cmb_modalidadbus option:selected').val();
    var carrera = $('#cmb_carrerabus option:selected').val();
    var periodo = $('#txt_periodo').val();
    window.location.href = $('#txth_base').val() + "/academico/admitidos/expexcel?search=" + search + "&fecha_ini=" + f_ini + "&fecha_fin=" + f_fin+ "&unidad=" + unidad + "&modalidad=" + modalidad + "&carrera=" + carrera + "&periodo=" + periodo;
}

function exportPdf() {
    var search = $('#txt_buscarData').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    var unidad = $('#cmb_unidadbus option:selected').val();
    var modalidad = $('#cmb_modalidadbus option:selected').val();
    var carrera = $('#cmb_carrerabus option:selected').val();
    var periodo = $('#txt_periodo').val();
    window.location.href = $('#txth_base').val() + "/academico/admitidos/exppdf?pdf=1&search=" + search + "&fecha_ini=" + f_ini + "&fecha_fin=" + f_fin + "&unidad=" + unidad + "&modalidad=" + modalidad + "&carrera=" + carrera + "&periodo=" + periodo;
}*/

function actualizarGrid() {
    var search = $('#txt_buscarData').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    var codigocan = $('#txt_buscarCodigo').val();
    var unidad = $('#cmb_unidadbus option:selected').val();
    var modalidad = $('#cmb_modalidadbus option:selected').val();
    var carrera = $('#cmb_carrerabus option:selected').val();
    var periodo = $('#txt_periodo').val();
    //Buscar almenos una clase con el nombre para ejecutar
    if (!$(".blockUI").length) {
        showLoadingPopup();
        $('#TbG_PERSONAS').PbGridView('applyFilterData', {'f_ini': f_ini, 'f_fin': f_fin, 'search': search, 'codigocan': codigocan, 'unidad': unidad, 'modalidad': modalidad, 'carrera': carrera, 'periodo': periodo});
        setTimeout(hideLoadingPopup, 2000);
    }
}
