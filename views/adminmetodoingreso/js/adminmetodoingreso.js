$(document).ready(function () {

    $('#btn_grabar_periodo').click(function () {
        var arrParams = new Object();
        var link = $('#txth_base').val() + "/adminmetodoingreso/grabarperiodoxmetodoing";
        arrParams.anio = $('#txt_anio').val();
        arrParams.mes = $('#cmb_mes').val();
        arrParams.nint = $('#cmb_nivel_interes').val();
        arrParams.ming = $('#cmb_metodo_ingreso').val();
        arrParams.descripcion = $('#txt_descripcion').val();
        arrParams.fecdesde = $('#txt_fecha_desde').val();
        arrParams.fechasta = $('#txt_fecha_hasta').val();

        var mes = "";
        if ($('#cmb_mes').val().length == 1) {
            var mes = "0" + $('#cmb_mes').val();
        } else {
            mes = $('#cmb_mes').val();
        }
        if ($('#cmb_metodo_ingreso').val() == 1) {
            arrParams.codigo = "CAN" + mes + ($('#txt_anio').val()).substr(2, 2);
        } else {
            arrParams.codigo = "EXA" + mes + ($('#txt_anio').val()).substr(2, 2);
        }

        if (!validateForm()) {
            requestHttpAjax(link, arrParams, function (response) {
                showAlert(response.status, response.label, response.message);
                setTimeout(function () {
                    parent.window.location.href = $('#txth_base').val() + "/adminmetodoingreso/creaperiodo";
                }, 2000);
            }, true);
        }
    });

    $('#btn_grabar_paralelo').click(function () {
        var arrParams = new Object();
        var link = $('#txth_base').val() + "/adminmetodoingreso/grabarparalelo";
        arrParams.descripcion = $('#txt_descripcion').val();
        arrParams.cupo = $('#txt_cupo').val();
        arrParams.pmin_id = $('#txth_id').val();
        arrParams.graba = 'S';

        if (!validateForm()) {
            requestHttpAjax(link, arrParams, function (response) {
                showAlert(response.status, response.label, response.message);
                setTimeout(function () {
                    parent.window.location.href = $('#txth_base').val() + "/adminmetodoingreso/creaparalelo" + "?pmin_id=" + arrParams.pmin_id;
                }, 2000);
            }, true);
        }
    });

    $('#cmb_periodo').change(function () {
        var link = $('#txth_base').val() + "/adminmetodoingreso/asigna";
        var arrParams = new Object();
        arrParams.periodo = $(this).val();
        arrParams.getparalelo = true;

        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.paralelo, "cmb_paralelo");
            }
        }, true);
    });

    $('#btn_grabar_asignacion').click(function () {
        var arrParams = new Object();
        var link = $('#txth_base').val() + "/adminmetodoingreso/grabarasignacion";
        arrParams.asp_id = $('#txth_aspid').val();
        arrParams.curso_id = $('#cmb_paralelo').val();
        arrParams.sins_id = $('#txth_sinsid').val();

        if (!validateForm()) {
            requestHttpAjax(link, arrParams, function (response) {
                showAlert(response.status, response.label, response.message);
                setTimeout(function () {
                    parent.window.location.href = $('#txth_base').val() + "/aspirante/listaraspirantes";
                }, 2000);
            }, true);
        }
    });

    $('#btn_modificar_periodo').click(function () {
        var arrParams = new Object();
        var link = $('#txth_base').val() + "/adminmetodoingreso/updateperiodoxmetodoing";
        arrParams.pmin_id = $('#txth_pmin_id').val();
        arrParams.anio = $('#txt_anio').val();
        arrParams.mes = $('#cmb_mes').val();
        arrParams.nint = $('#cmb_nivel_interes').val();
        arrParams.ming = $('#cmb_metodo_ingreso').val();
        arrParams.descripcion = $('#txt_descripcion').val();
        arrParams.fecdesde = $('#txt_fecha_desde').val();
        arrParams.fechasta = $('#txt_fecha_hasta').val();

        if (!validateForm()) {
            requestHttpAjax(link, arrParams, function (response) {
                showAlert(response.status, response.label, response.message);
                setTimeout(function () {
                    parent.window.location.href = $('#txth_base').val() + "/adminmetodoingreso/listaperiodocan";
                }, 2000);
            }, true);
        }
    });

    $('#btn_buscarDataPeriodo').click(function () {
        actualizarperiodcanGrid();
    });
});

function actualizarperiodcanGrid() {
    var search = $('#txt_buscarDatapc').val();
    var f_ini = $('#txt_fecha_inipc').val();
    var f_fin = $('#txt_fecha_finpc').val();
    var mes = $('#cmb_mes option:selected').val();
    //Buscar almenos una clase con el nombre para ejecutar
    if (!$(".blockUI").length) {
        showLoadingPopup();
        $('#Pbgperiodo').PbGridView('applyFilterData', {'f_ini': f_ini, 'f_fin': f_fin, 'mes': mes, 'search': search});
        setTimeout(hideLoadingPopup, 2000);
    }
}



