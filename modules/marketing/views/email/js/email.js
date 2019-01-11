$(document).ready(function () {

//Guardar programacion luego borrar cuando se hace el boton desde el frm configuracion
    $('#sendProgramacion').click(function () {
        var link = $('#txth_base').val() + "/marketing/email/guardarprogramacion";
        var arrParams = new Object();
        arrParams.check_dia_1 = "";
        arrParams.check_dia_2 = "";
        arrParams.check_dia_3 = "";
        arrParams.check_dia_4 = "";
        arrParams.check_dia_5 = "";
        arrParams.check_dia_6 = "";
        arrParams.check_dia_7 = "";
        arrParams.lista = $('#cmb_lista').val();
        arrParams.plantilla = $('#cmb_template').val();

        if ($('input:checkbox[name=check_dia_1]:checked').val() > 0)
        {
            arrParams.check_dia_1 = $('input:checkbox[name=check_dia_1]:checked').val();
        }
        if ($('input:checkbox[name=check_dia_2]:checked').val() > 0)
        {
            arrParams.check_dia_2 = $('input:checkbox[name=check_dia_2]:checked').val();
        }
        if ($('input:checkbox[name=check_dia_3]:checked').val() > 0)
        {
            arrParams.check_dia_3 = $('input:checkbox[name=check_dia_3]:checked').val();
        }
        if ($('input:checkbox[name=check_dia_4]:checked').val() > 0)
        {
            arrParams.check_dia_4 = $('input:checkbox[name=check_dia_4]:checked').val();
        }
        if ($('input:checkbox[name=check_dia_5]:checked').val() > 0)
        {
            arrParams.check_dia_5 = $('input:checkbox[name=check_dia_5]:checked').val();
        }
        if ($('input:checkbox[name=check_dia_6]:checked').val() > 0)
        {
            arrParams.check_dia_6 = $('input:checkbox[name=check_dia_6]:checked').val();
        }
        if ($('input:checkbox[name=check_dia_7]:checked').val() > 0)
        {
            arrParams.check_dia_7 = $('input:checkbox[name=check_dia_7]:checked').val();
        }
        if (arrParams.check_dia_1 == "" && arrParams.check_dia_2 == "" && arrParams.check_dia_3 == "" && arrParams.check_dia_4 == ""  && arrParams.check_dia_5 == ""  && arrParams.check_dia_6 == ""  && arrParams.check_dia_7 == "")
        {
            var mensaje =
                    {wtmessage: "Días Programar : El campo no debe estar vacío.", title: "Error"};
            showAlert("NO_OK", "error", mensaje);
        } else {
            arrParams.fecha_inicio = $('#txt_fecha_inicio').val();
            arrParams.fecha_fin = $('#txt_fecha_fin').val();
            arrParams.hora_envio = $('#txthoraenvio').val();
            if (!validateForm()) {
                requestHttpAjax(link, arrParams, function (response) {
                    showAlert(response.status, response.label, response.message);
                    if (!response.error) {
                        setTimeout(function () {
                            window.location.href = $('#txth_base').val() + "/marketing/email/programacion";
                        }, 5000);
                    }


                }, true);
            }
        }
    });

    $('#btn_buscarDataLista').click(function () {
        mostrar_grid_lista();
    });

});

function mostrar_grid_lista() {
    var lista_id = $('#cmb_lista option:selected').val();

    //Buscar almenos una clase con el nombre para ejecutar
    if (!$(".blockUI").length) {
        showLoadingPopup();
        $('#Tbg_Lista').PbGridView('applyFilterData', {'lista_id': lista_id});
        setTimeout(hideLoadingPopup, 2000);
    }
}
function autocompletarBuscarLista(requestq, responseq,control,op){
    var link = $('#txth_base').val() +"/marketing/email/index";
    var arrParams = new Object();
    arrParams.valor = $('#' + control).val();
    arrParams.op = op;
    requestHttpAjax(link, arrParams, function (response) {
        //showAlert(response.status, response.label, response.message);
        //if (response.status == 'OK') {
            var arrayList = new Array;
            var count = response.length;
            for (var i = 0; i < count; i++) {
                row = new Object();
                row.IdentificacionComprador = response[i]['IdentificacionComprador'];
                row.RazonSocialComprador = response[i]['RazonSocialComprador'];
 
                // Campos Importandes relacionados con el  CJuiAutoComplete
                row.id = response[i]['IdentificacionComprador'];
                row.label = response[i]['RazonSocialComprador'] + ' - ' + response[i]['IdentificacionComprador'];//+' - '+data[i]['SEGURO_SOCIAL'];//Lo sugerido
                //row.value=response[i]['IdentificacionComprador'];//lo que se almacena en en la caja de texto
                row.value = response[i]['RazonSocialComprador'];//lo que se almacena en en la caja de texto
                arrayList[i] = row;
            }
            sessionStorage.src_buscIndex = JSON.stringify(arrayList);//dss=>DataSessionStore
            responseq(arrayList);  
        //}
    }, true);
}
