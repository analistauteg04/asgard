
$(document).ready(function () {
    $('#btn_buscarDatamat').click(function () {
        actualizarGrid();
    });
    /***********************************************/
    /* Filtro para busqueda                        */
    /***********************************************/
       
    $('#cmb_unidadmat').change(function () {
        var link = $('#txth_base').val() + "/fianciero/pagoscontrato/index";
        document.getElementById("cmb_carreramat").options.item(0).selected = 'selected';
        var arrParams = new Object();
        arrParams.nint_id = $(this).val();
        arrParams.getmodalidad = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboDataselect(data.modalidad, "cmb_modalidadmat", "Todos");
                var arrParams = new Object();
                if (data.modalidad.length > 0) {
                    arrParams.unidada = $('#cmb_unidadmat').val();
                    arrParams.moda_id = data.modalidad[0].id;
                    arrParams.getcarrera = true;
                    requestHttpAjax(link, arrParams, function (response) {
                        if (response.status == "OK") {
                            data = response.message;
                            setComboDataselect(data.carrera, "cmb_carreramat", "Todos");
                        }
                    }, true);
                }
            }
        }, true);
    });
    $('#cmb_modalidadmat').change(function () {
        var link = $('#txth_base').val() + "/financiero/pagoscontrato/index";    
        var arrParams = new Object();
        arrParams.unidada = $('#cmb_unidadmat').val();
        arrParams.moda_id = $(this).val();
        arrParams.getcarrera = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboDataselect(data.carrera, "cmb_carreramat", "Todos");
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
    var search = $('#txt_buscarDatamatri').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val(); 
    var unidad = $('#cmb_unidadmat option:selected').val();
    var modalidad = $('#cmb_modalidadmat option:selected').val();
    var carrera = $('#cmb_carreramat option:selected').val();
    var periodo = $('#txt_periodomat').val();
    //Buscar almenos una clase con el nombre para ejecutar
    if (!$(".blockUI").length) {
        showLoadingPopup();
        $('#TbG_PAGOS').PbGridView('applyFilterData', {'f_ini': f_ini, 'f_fin': f_fin, 'search': search, 'unidad': unidad, 'modalidad': modalidad, 'carrera': carrera, 'periodo': periodo});
        setTimeout(hideLoadingPopup, 2000);
    }
}

function exportExcel() {
    var search = $('#txt_buscarDatamatri').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    var unidad = $('#cmb_unidadmat option:selected').val();
    var modalidad = $('#cmb_modalidadmat option:selected').val();
    var carrera = $('#cmb_carreramat option:selected').val();
    var periodo = $('#txt_periodomat').val();
    window.location.href = $('#txth_base').val() + "/financiero/pagoscontrato/expexcel?search=" + search + "&fecha_ini=" + f_ini + "&fecha_fin=" + f_fin+ "&unidad=" + unidad + "&modalidad=" + modalidad + "&carrera=" + carrera + "&periodo=" + periodo;
}

function exportPdf() {
    var search = $('#txt_buscarDatamatri').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    var unidad = $('#cmb_unidadmat option:selected').val();
    var modalidad = $('#cmb_modalidadmat option:selected').val();
    var carrera = $('#cmb_carreramat option:selected').val();
    var periodo = $('#txt_periodomat').val();
    window.location.href = $('#txth_base').val() + "/financiero/pagoscontrato/exppdf?pdf=1&search=" + search + "&fecha_ini=" + f_ini + "&fecha_fin=" + f_fin + "&unidad=" + unidad + "&modalidad=" + modalidad + "&carrera=" + carrera + "&periodo=" + periodo;
}

//Guarda Documento de carta de la UNE.
/*function SaveOtrosDocumentos() {
    var link = $('#txth_base').val() + "/academico/admitidos/saveotrosdocumentos";
    var arrParams = new Object();    
    arrParams.persona_id = $('#txth_idp').val();    
    arrParams.arc_doc_carta = $('#txth_doc_certune').val();        
    arrParams.observa = $('#txt_observa').val();
    //alert('perId:'+arrParams.persona_id);
    if (!validateForm()) {
        requestHttpAjax(link, arrParams, function (response) {
            showAlert(response.status, response.label, response.message);
            setTimeout(function () {                
                window.location.href = $('#txth_base').val() + "/academico/admitidos/subirotrosdocumentos";                
            }, 5000);
        }, true);
    }
}*/