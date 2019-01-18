$(document).ready(function () {

    // LUEGO BORRA CUANDO ESTE EL BOTON DE BD
    /*$('#sendEditprograma').click(function () {
     lista = $('#txth_list').val();
     window.location.href = $('#txth_base').val() + "/marketing/email/editprogramacion?lisid=" + lista;
     });*/
    /*$('#sendModificaprograma').click(function () {
     var link = $('#txth_base').val() + "/marketing/email/updateprogramacion";
     var arrParams = new Object();
     arrParams.check_dia_1 = "";
     arrParams.check_dia_2 = "";
     arrParams.check_dia_3 = "";
     arrParams.check_dia_4 = "";
     arrParams.check_dia_5 = "";
     arrParams.check_dia_6 = "";
     arrParams.check_dia_7 = "";
     arrParams.lista = $('#txth_list').val();
     
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
     if (arrParams.check_dia_1 === "" && arrParams.check_dia_2 === "" && arrParams.check_dia_3 === "" && arrParams.check_dia_4 === "" && arrParams.check_dia_5 === "" && arrParams.check_dia_6 === "" && arrParams.check_dia_7 === "")
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
     window.location.href = $('#txth_base').val() + "/marketing/email/index";
     }, 5000);
     }
     
     
     }, true);
     }
     }
     });*/

    $('#cmb_lista').change(function () {
        var link = $('#txth_base').val() + "/marketing/email/programacion";
        var arrParams = new Object();
        arrParams.lis_id = $(this).val();
        arrParams.getplantilla = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboDataselect(data.template, "cmb_template", "Seleccionar");
            }
        }, true);
    });


    $('#btn_buscarDataLista').click(function () {
        mostrar_grid_lista();
    });

    $('#cmb_empresa').change(function () {
        var link = $('#txth_base').val() + "/marketing/email/new";
        var arrParams = new Object();
        arrParams.emp_id = $(this).val();
        arrParams.getcarrera = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboDataselect(data.carrera, "cmb_carrera_programa", "Seleccionar");
            }
        }, true);
        arrParams.emp_id = $(this).val();
        arrParams.getempresa = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                alert('empresa:' + arrParams.emp_id);
                alert('sin pais');
                alert('pais:' + data.empresa.emp_telefono);

                $('#cmb_pais').val(data.empresa.pai_id);
                $('#cmb_provincia').val(data.empresa.pro_id);
                $('#cmb_ciudad').val(data.empresa.can_id);
                $('#txt_direccion1').val(data.empresa.emp_direccion);
                $('#txt_direccion2').val(data.empresa.emp_direccion1);
                $('#txt_telefono').val(data.empresa.emp_telefono);
                $('#txt_codigo_postal').val(data.empresa.emp_codigo_postal);
            }
        }, true);
    });

    $('#cmb_pais').change(function () {
        var link = $('#txth_base').val() + "/marketing/email/new";
        var arrParams = new Object();
        arrParams.pai_id = $(this).val();
        arrParams.getprovincias = true;
        arrParams.getarea = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.provincias, "cmb_provincia");
                var arrParams = new Object();
                if (data.provincias.length > 0) {
                    arrParams.prov_id = data.provincias[0].id;
                    arrParams.getcantones = true;
                    requestHttpAjax(link, arrParams, function (response) {
                        if (response.status == "OK") {
                            data = response.message;
                            setComboData(data.cantones, "cmb_ciudad");
                        }
                    }, true);
                }

            }
        }, true);
    });

    $('#cmb_provincia').change(function () {
        var link = $('#txth_base').val() + "/marketing/email/new";
        var arrParams = new Object();
        arrParams.prov_id = $(this).val();
        arrParams.getcantones = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.cantones, "cmb_ciudad");
            }
        }, true);
    });
});

function mostrar_grid_lista() {
    var lista = $('#txt_buscar_lista').val();

    //Buscar al menos una clase con el nombre para ejecutar.
    if (!$(".blockUI").length) {
        showLoadingPopup();
        $('#Tbg_Lista').PbGridView('applyFilterData', {'lista': lista});
        setTimeout(hideLoadingPopup, 2000);
    }
}
function suscribirContacto(psus_id, per_tipo) {
    preguntaSuscribirOtrasListas();
//    var link = $('#txth_base').val() + "/marketing/email/asignar";
//    var arrParams = new Object();
//    arrParams.psus_id = psus_id;
//    arrParams.per_tipo = per_tipo;
//    arrParams.accion = 'sc';
//    if (!validateForm()) {
//        requestHttpAjax(link, arrParams, function (response) {
//            if (!response.error) {
//                setTimeout(function () {
//                    preguntaSuscribirOtrasListas();
//                }, 5000);
//            }
//        }, true);
//    }
}
function preguntaSuscribirOtrasListas() {
    var mensj = "Maria Sanchez ha sido suscrita a la lista de Economia.<br/>";
    var mensj = mensj + "Las personas que se suscribieron a esta lista tambien les intereso las listas:<br/>";
    var mensj = mensj + "- Finanzas<br/>";
    var mensj = mensj + "- Marketing<br/>";
    var mensj = mensj + "- Adminsitracion empresas<br/>";
    var mensj = mensj + "Desea suscribirlo a estas listas tambien?";
    var messagePB = new Object();
    messagePB.wtmessage = mensj;
    messagePB.title = "Suscribirse";
    var objAccept = new Object();
    objAccept.id = "btnid2del";
    objAccept.class = "btn-primary clclass praclose";
    objAccept.value = "Aceptar";
    objAccept.callback = 'suscribirOtrasListas';
    messagePB.acciones = new Array();
    messagePB.acciones[0] = objAccept;
    showAlert("OK", "success", messagePB);
}
function suscribirOtrasListas() {

}
function elminarsuscritor() {

}
function RemoverSuscritor() {
    var mensj = "Seguro Desea eliminar el suscritor de la lista?";
    var messagePB = new Object();
    messagePB.wtmessage = mensj;
    messagePB.title = "Eliminar";
    var objAccept = new Object();
    objAccept.id = "btnid2del";
    objAccept.class = "btn-primary clclass praclose";
    objAccept.value = "Aceptar";
    objAccept.callback = 'elminarsuscritor';
    messagePB.acciones = new Array();
    messagePB.acciones[0] = objAccept;
    showAlert("warning", "warning", messagePB);
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

function guardarProgramacion() {
    var link = $('#txth_base').val() + "/marketing/email/guardarprogramacion";
    var arrParams = new Object();
    arrParams.check_dia_1 = "";
    arrParams.check_dia_2 = "";
    arrParams.check_dia_3 = "";
    arrParams.check_dia_4 = "";
    arrParams.check_dia_5 = "";
    arrParams.check_dia_6 = "";
    arrParams.check_dia_7 = "";
    arrParams.lista = $('#txth_list').val();

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
    if (arrParams.check_dia_1 === "" && arrParams.check_dia_2 === "" && arrParams.check_dia_3 === "" && arrParams.check_dia_4 === "" && arrParams.check_dia_5 === "" && arrParams.check_dia_6 === "" && arrParams.check_dia_7 === "")
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
                        window.location.href = $('#txth_base').val() + "/marketing/email/index";
                    }, 5000);
                }


            }, true);
        }
    }
}

function guardarLista() {
    var link = $('#txth_base').val() + "/marketing/email/guardarlista";
    var arrParams = new Object();
    arrParams.emp_id = $('#cmb_empresa').val();
    var combo_empresa = document.getElementById("cmb_empresa");
    arrParams.nombre_empresa = combo_empresa.options[combo_empresa.selectedIndex].text;

    arrParams.carrera_id = $('#cmb_carrera_programa').val();
    arrParams.nombre_lista = $('#txt_nombre_lista').val();
    arrParams.txt_nombre_contacto = $('#txt_nombre_contacto').val();
    arrParams.txt_correo_contacto = $('#txt_correo_contacto').val();
    arrParams.txt_asunto = $('#txt_asunto').val();
    arrParams.pais_id = $('#cmb_pais').val();
    var combo_pais = document.getElementById("cmb_pais");
    arrParams.pais_texto = combo_pais.options[combo_pais.selectedIndex].text;

    arrParams.provincia_id = $('#cmb_provincia').val();
    var combo_provincia = document.getElementById("cmb_provincia");
    arrParams.provincia_texto = combo_provincia.options[combo_provincia.selectedIndex].text;

    arrParams.ciudad_id = $('#cmb_ciudad').val();
    var combo_ciudad = document.getElementById("cmb_ciudad");
    arrParams.ciudad_texto = combo_ciudad.options[combo_ciudad.selectedIndex].text;

    arrParams.direccion1 = $('#txt_direccion1').val();
    arrParams.direccion2 = $('#txt_direccion2').val();
    arrParams.telefono = $('#txt_telefono').val();
    arrParams.codigo_postal = $('#txt_codigo_postal').val();

    if (!validateForm()) {
        requestHttpAjax(link, arrParams, function (response) {
            showAlert(response.status, response.label, response.message);
            if (!response.error) {
                setTimeout(function () {
                    window.location.href = $('#txth_base').val() + "/marketing/email/new";
                }, 5000);
            }
        }, true);
    }
}
function borrarLista(id, codigo) {
    var link = $('#txth_base').val() + "/marketing/email/delete";
    var arrParams = new Object();
    arrParams.lis_id = id;
    arrParams.codigo = codigo;
    alert('saludos');
    if (!validateForm()) {
        requestHttpAjax(link, arrParams, function (response) {
            showAlert(response.status, response.label, response.message);
            if (!response.error) {
                setTimeout(function () {
                    window.location.href = $('#txth_base').val() + "/marketing/email/index";
                }, 5000);
            }
        }, true);
    }
}

function eliminarLista(id, codigo) {
    var mensj = "¿Seguro desea eliminar la lista?";
    var messagePB = new Object();
    messagePB.wtmessage = mensj;
    messagePB.title = "Eliminar";
    var objAccept = new Object();
    objAccept.id = "btnid2del";
    objAccept.class = "btn-primary clclass praclose";
    objAccept.value = "Aceptar";
    objAccept.callback = 'borrarLista';
    alert('ingresa');
    var params = new Array(id, codigo);
    objAccept.paramCallback = params;
    messagePB.acciones = new Array();
    messagePB.acciones[0] = objAccept;

    showAlert("warning", "warning", messagePB);
}
function editarProgramacion() {
    lista = $('#txth_list').val();
    window.location.href = $('#txth_base').val() + "/marketing/email/editprogramacion?lisid=" + lista;
}
function modificarProgramacion() {
    var link = $('#txth_base').val() + "/marketing/email/updateprogramacion";
    var arrParams = new Object();
    arrParams.check_dia_1 = "";
    arrParams.check_dia_2 = "";
    arrParams.check_dia_3 = "";
    arrParams.check_dia_4 = "";
    arrParams.check_dia_5 = "";
    arrParams.check_dia_6 = "";
    arrParams.check_dia_7 = "";
    arrParams.lista = $('#txth_list').val();

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
    if (arrParams.check_dia_1 === "" && arrParams.check_dia_2 === "" && arrParams.check_dia_3 === "" && arrParams.check_dia_4 === "" && arrParams.check_dia_5 === "" && arrParams.check_dia_6 === "" && arrParams.check_dia_7 === "")
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
                        window.location.href = $('#txth_base').val() + "/marketing/email/index";
                    }, 5000);
                }


            }, true);
        }
    }
}

