$(document).ready(function () {
    $('#txthoraenvio').timepicker({
        minuteStep: 5,
        maxHours: 24,
        showMeridian: false,
    });
    var valor = $('.btnAccion').attr("onclick");
    if (valor == "guardarProgramacion()") {
        var id_muestra = $('#txth_muestra').val();
        if (id_muestra == 0) {
            var newcon = $("<i class='glyphicon glyphicon-pencil'> Editar</i>");
            $('.btnAccion').html(newcon);
            $(".btnAccion").attr("onclick", "editarProgramacion()");
        }
    }
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
    $('#btn_buscarDataListaSus').click(function () {
        mostrar_grid_lista_suscriptor();
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
        var arrParams = new Object();
        arrParams.getempresa = true;
        arrParams.emp_id = $(this).val();
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data2 = response.message;
                $('#txt_pais').val(data2[0].pai_nombre);
                $('#txt_provincia').val(data2[0].pro_nombre);
                $('#txt_ciudad').val(data2[0].can_nombre);
                $('#txt_direccion1').val(data2[0].emp_direccion);
                $('#txt_direccion2').val(data2[0].emp_direccion1);
                $('#txt_telefono').val(data2[0].emp_telefono);
                $('#txt_codigo_postal').val(data2[0].emp_codigo_postal);
            }
        }, true);
        var arrParams = new Object();
        arrParams.emp_id = $(this).val();
        arrParams.getcorreo = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboDataselect(data.correo, "cmb_correo_empresa", "Seleccionar");
            }
        }, true);
    });

    $('#btn_actualizar').click(function () {
        actualizarLista();
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

function mostrar_grid_lista_suscriptor() {
    var estado = $('#cmb_suscrito').val();
    if (!$(".blockUI").length) {
        showLoadingPopup();
        $('#Tbg_SubsLista').PbGridView('applyFilterData', {'estado': estado});
        setTimeout(hideLoadingPopup, 2000);
    }
}
function suscribirTodos() {
    var messagePB = new Object();
    messagePB.wtmessage = "Va a suscribir todos los contactos, esta opcion, solo guarda en la base como suscrito, vinculando a esta lista.<br/> Pero aun no esta como suscrito en mailchimp.";
    messagePB.title = "";  
    var objAccept = new Object();
    objAccept.id = "btnid2del";
    objAccept.class = "btn-primary clclass praclose";
    objAccept.value = "Aceptar";
    objAccept.callback = 'fnsuscribirLista';
    var params = new Array();
    objAccept.paramCallback = params;
    messagePB.acciones = new Array();
    messagePB.acciones[0] = objAccept;
    showAlert("OK", "info", messagePB);
}
function fnsuscribirLista() {
    var lista = $('#txth_ids').val();    
    var link = $('#txth_base').val() + "/marketing/email/suscribirtodos?lisid=" + lista;
    var arrParams = new Object();
    arrParams.lis_id = lista;
    if (!validateForm()) {
        requestHttpAjax(link, arrParams, function (response) {
            showAlert(response.status, response.label, response.message);
            if (!response.error) {
                setTimeout(function () {
                    window.location.href = $('#txth_base').val() + "/marketing/email/asignar?lis_id=" + arrParams.lis_id;
                }, 5000);
            }
        }, true);
    }
}
function programarEnvio() {
    var lista = $('#txth_ids').val();
    window.location.href = $('#txth_base').val() + "/marketing/email/programacion?lisid=" + lista;
}
function preguntasuscribirContacto(psus_id, per_tipo, list_id) {
    var messagePB = new Object();
    messagePB.wtmessage = "Haga clic en aceptar para suscribir el contacto, caso contrario haga clic en cancelar.";
    messagePB.title = "";
    var objAccept = new Object();
    objAccept.id = "btnid2del";
    objAccept.class = "btn-primary clclass praclose";
    objAccept.value = "Aceptar";
    objAccept.callback = 'suscribirContacto';
    var params = new Array(psus_id, per_tipo, list_id);
    objAccept.paramCallback = params;
    messagePB.acciones = new Array();
    messagePB.acciones[0] = objAccept;
    showAlert("OK", "info", messagePB);
}
function suscribirContacto(psus_id, per_tipo, list_id) {
    var link = $('#txth_base').val() + "/marketing/email/asignar";
    var arrParams = new Object();
    arrParams.psus_id = psus_id;
    arrParams.per_tipo = per_tipo;
    arrParams.list_id = list_id;
    arrParams.accion = 'sc';
    if (!validateForm()) {
        requestHttpAjax(link, arrParams, function (response) {
            preguntaSuscribirOtrasListas(response.message);
        }, true);
    }
}
function preguntaSuscribirOtrasListas(message) {
    //alert("ha entrado a las funciones");
    var messagePB = new Object();
    var mens_tot = message.wtmessage;
    mens_tot = mens_tot + "<br/> Las personas que se han suscrito a estas listas, tambien les ha interesado las siguientes listas:<br/>";
    var listas = message.listas;
    var i = 0;
    var str_listas = '';
    if (listas.length > 0) {
        for (i = 0; i < listas.length; i++) {
            str_listas = str_listas + '- ' + listas[i]['lis_nombre'] + '<br/>';
        }
        mens_tot = mens_tot + "<br/>" + str_listas + "<br/>" + "¿Desea suscribirlo a estas listas?";
    } else {
        mens_tot = mens_tot + "<br/>No hay listas referenciadas para dicho suscrito <br/>";
    }
    messagePB.wtmessage = mens_tot;
    messagePB.title = message.title;
    var objAccept = new Object();
    objAccept.id = "btnid2del";
    objAccept.class = "btn-primary clclass praclose";
    objAccept.value = "Aceptar";
    objAccept.callback = 'suscribirOtrasListas';
    var slistas = '';
    if (listas.length > 0) {
        var ids = '';
        for (i = 0; i < listas.length; i++) {
            if (i < (listas.length - 1)) {
                ids = ids + listas[i]['lis_id'] + ',';
            } else {
                ids = ids + listas[i]['lis_id'];
            }
        }
        slistas = ids;
    }
    var params = new Array(slistas, message.sus_id);
    objAccept.paramCallback = params;
    messagePB.acciones = new Array();
    messagePB.acciones[0] = objAccept;
    showAlert("OK", "success", messagePB);
}
function suscribirOtrasListas(lista_rel, sus_id) {
    var link = $('#txth_base').val() + "/marketing/email/asignar";
    var arrParams = new Object();
    arrParams.list_id = $('#txth_ids').val();
    ;
    arrParams.sus_id = sus_id;
    if (lista_rel.length > 0) {
        arrParams.list_ids = lista_rel;
    }
    arrParams.accion = 'lis_rel';
    if (!validateForm()) {
        requestHttpAjax(link, arrParams, function (response) {
            showAlert(response.status, response.label, response.message);
        }, true);
    }
}
function RemoverSuscritor(per_id, list_id) {
    var messagePB = new Object();
    var mensj = "Seguro Desea eliminar el suscritor de la lista?";
    messagePB.wtmessage = mensj;
    messagePB.title = "Eliminar";
    var objAccept = new Object();
    objAccept.id = "btnid2del";
    objAccept.class = "btn-primary clclass praclose";
    objAccept.value = "Aceptar";
    objAccept.callback = 'elminarSuscriptor';
    var params = new Array(per_id, list_id);
    objAccept.paramCallback = params;
    messagePB.acciones = new Array();
    messagePB.acciones[0] = objAccept;
    showAlert("warning", "warning", messagePB);
}

/***/
function elminarSuscriptor(per_id, list_id) {
    var link = $('#txth_base').val() + "/marketing/email/deletesuscriptor";
    var arrParams = new Object();
    arrParams.per_id = per_id;
    arrParams.list_id = list_id;
    arrParams.accion = 'sc';
    if (!validateForm()) {
        showLoadingPopup();
        requestHttpAjax(link, arrParams, function (response) {
        }, true);
        setTimeout(hideLoadingPopup, 2000);
    }
}
/**/
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
    arrParams.pla_id = $('#cmb_pla_id').val();

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
    var combo_carrera = document.getElementById("cmb_carrera_programa");
    arrParams.nombre_lista = combo_carrera.options[combo_carrera.selectedIndex].text;
    arrParams.txt_asunto = $('#txt_asunto').val();

    arrParams.txt_nombre_contacto = arrParams.nombre_empresa;
    arrParams.correo_id = $('#cmb_correo_empresa').val();
    var combo_correo = document.getElementById("cmb_correo_empresa");
    arrParams.txt_correo_contacto = combo_correo.options[combo_correo.selectedIndex].text;

    arrParams.pais_texto = $('#txt_pais').val();
    arrParams.provincia_texto = $('#txt_provincia').val();
    arrParams.ciudad_texto = $('#txt_ciudad').val();

    arrParams.direccion1 = $('#txt_direccion1').val();
    arrParams.direccion2 = $('#txt_direccion2').val();
    arrParams.telefono = $('#txt_telefono').val();
    arrParams.codigo_postal = $('#txt_codigo_postal').val();
    arrParams.codigo = null;
    arrParams.list_id = 0;
    arrParams.opcion = "N";

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

function actualizarLista() {
    var link = $('#txth_base').val() + "/marketing/email/guardarlista";
    var arrParams = new Object();
    arrParams.emp_id = $('#cmb_empresa').val();
    var combo_empresa = document.getElementById("cmb_empresa");
    arrParams.nombre_empresa = combo_empresa.options[combo_empresa.selectedIndex].text;

    arrParams.carrera_id = $('#cmb_carrera_programa').val();
    var combo_carrera = document.getElementById("cmb_carrera_programa");
    arrParams.nombre_lista = combo_carrera.options[combo_carrera.selectedIndex].text;
    arrParams.txt_asunto = $('#txt_asunto').val();

    arrParams.txt_nombre_contacto = arrParams.nombre_empresa;
    arrParams.correo_id = $('#cmb_correo_empresa').val();
    var combo_correo = document.getElementById("cmb_correo_empresa");
    arrParams.txt_correo_contacto = combo_correo.options[combo_correo.selectedIndex].text;

    arrParams.pais_texto = $('#txt_pais').val();
    arrParams.provincia_texto = $('#txt_provincia').val();
    arrParams.ciudad_texto = $('#txt_ciudad').val();
    arrParams.direccion1 = $('#txt_direccion1').val();
    arrParams.direccion2 = $('#txt_direccion2').val();
    arrParams.telefono = $('#txt_telefono').val();
    arrParams.codigo_postal = $('#txt_codigo_postal').val();
    arrParams.list_id = $('#txth_list_id').val();
    arrParams.opcion = "E";
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

function borrarLista(id, temp) {
    var link = $('#txth_base').val() + "/marketing/email/delete";
    var arrParams = new Object();
    arrParams.lis_id = id;
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

function eliminarLista(id) {
    var mensj = "¿Seguro desea eliminar la lista?";
    var messagePB = new Object();
    messagePB.wtmessage = mensj;
    messagePB.title = "Eliminar";
    var objAccept = new Object();
    objAccept.id = "btnid2del";
    objAccept.class = "btn-primary clclass praclose";
    objAccept.value = "Aceptar";
    objAccept.callback = 'borrarLista';
    var params = new Array(id, 0);
    objAccept.paramCallback = params;
    messagePB.acciones = new Array();
    messagePB.acciones[0] = objAccept;
    showAlert("warning", "warning", messagePB);
}
function editarProgramacion() {
    lista = $('#txth_list').val();
    window.location.href = $('#txth_base').val() + "/marketing/email/editprogramacion?lisid=" + lista;
}
function subirMailchimp() {
    var mensj = "<b>Nota:</b><br/><br/> Al momento de cargar a mailchimp, ya no se podra eliminar el suscritor de la lista,<br/>si desea ya no enviar correos a ese suscritor debe eliminar toda lista desde el modulo lista. <br/> ¿Seguro desea cargar todos los suscritos a Mailchimp?";
    var idlista = $('#txth_list').val();
    var messagePB = new Object();
    messagePB.wtmessage = mensj;
    messagePB.title = "Cargar a Mailchimp";
    var objAccept = new Object();
    objAccept.id = "btnid2del";
    objAccept.class = "btn-primary clclass praclose";
    objAccept.value = "Aceptar";
    objAccept.callback = 'cargarMailchimp';
    var params = new Array(idlista, 0);
    objAccept.paramCallback = params;
    messagePB.acciones = new Array();
    messagePB.acciones[0] = objAccept;
    showAlert("warning", "warning", messagePB);
}
function cargarMailchimp(idl, temp) {
    var arrParams = new Object();
    arrParams.lis_id = idl;
    var link = $('#txth_base').val() + "/marketing/email/cargarmailchimp";
    requestHttpAjax(link, arrParams, function (response) {
        showAlert(response.status, response.label, response.message);
        alert("ha cargado en mailchimp");
    }, true);
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
    arrParams.pla_id = $('#cmb_pla_id').val();

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
function exportExcel() {
    var estado = $('#cmb_suscrito').val();
    var lista = $('#txth_ids').val();
    window.location.href = $('#txth_base').val() + "/marketing/email/expexcel?estado=" + estado + "&lista=" + lista;
}

function exportPdf() {
    var estado = $('#cmb_suscrito').val();
    var lista = $('#txth_ids').val();
    window.location.href = $('#txth_base').val() + "/marketing/email/exppdf?pdf=1&estado=" + estado + "&lista=" + lista;
}

function exportExcelLista() {
    var lista = $('#txt_buscar_lista').val();    
    window.location.href = $('#txth_base').val() + "/marketing/email/expexcellista?lista=" + lista;
}