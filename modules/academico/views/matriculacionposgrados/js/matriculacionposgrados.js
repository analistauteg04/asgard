
$(document).ready(function () {
    $('#btn_buscarData').click(function () {
        actualizarGrid();
    });
    /*****************************************************/
    /* Filtro para busqueda en index Promoción Programa */
    /***************************************************/
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
  
    /*****************************************************/
    /* Filtro en crear Promoción Programa */
    /***************************************************/
    $('#cmb_unidad').change(function () {
        var link = $('#txth_base').val() + "/academico/matriculacionposgrados/newpromocion";
        document.getElementById("cmb_programa").options.item(0).selected = 'selected';
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
                    arrParams.getprograma = true;
                    requestHttpAjax(link, arrParams, function (response) {
                        if (response.status == "OK") {
                            data = response.message;
                            setComboDataselect(data.programa, "cmb_programa", "Seleccionar");
                        }
                    }, true);
                }
            }
        }, true);
    });
    $('#cmb_modalidad').change(function () {
        var link = $('#txth_base').val() + "/academico/matriculacionposgrados/newpromocion";
        var arrParams = new Object();
        arrParams.unidada = $('#cmb_unidad').val();
        arrParams.moda_id = $(this).val();
        arrParams.getprograma = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboDataselect(data.programa, "cmb_programa", "Seleccionar");
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
function actualizarGrid() {
    var search = $('#txt_buscarData').val();
    var unidad = $('#cmb_unidadbus option:selected').val();
    var modalidad = $('#cmb_modalidadbus option:selected').val();
    var programa = $('#cmb_programabus option:selected').val();
    //Buscar almenos una clase con el nombre para ejecutar
    if (!$(".blockUI").length) {
        showLoadingPopup();
        $('#TbG_PROGRAMA').PbGridView('applyFilterData', {'search': search, 'unidad': unidad, 'modalidad': modalidad, 'programa': programa});
        setTimeout(hideLoadingPopup, 2000);
    }
}

function exportExcel() {
    var search = $('#txt_buscarData').val();
    var unidad = $('#cmb_unidadbus option:selected').val();
    var modalidad = $('#cmb_modalidadbus option:selected').val();
    var programa = $('#cmb_programabus option:selected').val(); 
    window.location.href = $('#txth_base').val() + "/academico/matriculacionposgrados/expexcel?search=" + search + "&unidad=" + unidad + "&modalidad=" + modalidad + "&programa=" + programa;
}

function exportPdf() {
    var search = $('#txt_buscarData').val();  
    var unidad = $('#cmb_unidadbus option:selected').val();
    var modalidad = $('#cmb_modalidadbus option:selected').val();
    var programa = $('#cmb_programabus option:selected').val();
    window.location.href = $('#txth_base').val() + "/academico/matriculacionposgrados/exppdf?pdf=1&search=" + search + "&unidad=" + unidad + "&modalidad=" + modalidad + "&programa=" + programa;
}

function newPrograma() {    
    window.location.href = $('#txth_base').val() + "/academico/matriculacionposgrados/newpromocion";
}
