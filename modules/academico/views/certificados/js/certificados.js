/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    $('#btn_buscarCertificado').click(function () {
        actualizarGridCertificadosGeneradas();
    });

    $('#cmb_unidad_cer').change(function () {
        var link = $('#txth_base').val() + "/academico/certificados/index";
        var arrParams = new Object();
        arrParams.unidad = $('#cmb_unidad_cer').val();
        //arrParams.moda_id = $(this).val();
        arrParams.getmodalidad = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboDataselect(data.modalidad, "cmb_modalidad_cer", "Todos");
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

function actualizarGridCertificadosGeneradas() {
    var search = $('#txt_buscarDataCertificado').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    var unidad = $('#cmb_unidad_cer').val();
    var modalidad = $('#cmb_modalidad_cer').val();
    var estdocerti = $('#cmb_estadocertificado_cer').val();
    //Buscar almenos una clase con el nombre para ejecutar
    if (!$(".blockUI").length) {
        showLoadingPopup();
        $('#TbG_Certificados').PbGridView('applyFilterData', {'f_ini': f_ini, 'f_fin': f_fin, 'unidad': unidad, 'modalidad': modalidad, 'search': search, 'estdocerti': estdocerti});
        setTimeout(hideLoadingPopup, 2000);
    }
}

function exportExcel() {
    var search = $('#txt_buscarDataCertificado').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    var unidad = $('#cmb_unidad_cer').val();
    var modalidad = $('#cmb_modalidad_cer').val();
    var estdocerti = $('#cmb_estadocertificado_cer').val();

    window.location.href = $('#txth_base').val() + "/academico/certificados/expexcelcertificado?search=" + search + "&f_ini=" + f_ini + "&f_fin=" + f_fin + '&unidad=' + unidad + "&modalidad=" + modalidad + "&estdocerti=" + estdocerti;
}

function exportPdf() {
    var search = $('#txt_buscarDataCertificado').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    var unidad = $('#cmb_unidad_cer').val();
    var modalidad = $('#cmb_modalidad_cer').val();
    var estdocerti = $('#cmb_estadocertificado_cer').val();

    window.location.href = $('#txth_base').val() + "/academico/certificados/exppdfcertificado?pdf=1&search=" + search + "&f_ini=" + f_ini + "&f_fin=" + f_fin + '&unidad=' + unidad + "&modalidad=" + modalidad + "&estdocerti=" + estdocerti;
}