$(document).ready(function () {
    $('#sendInformacionAdmitidoPend').click(function () {
        habilitarSecciones();
        //if ($('#txth_twin_id').val() == 0) 
        //{
        guardarInscripcion('Create', '1');
        //} else {
        //    guardarInscripcion('Update', '1');
        //}
    });
    $('#paso2back').click(function () {
        $("a[data-href='#paso2']").attr('data-toggle', 'none');
        $("a[data-href='#paso2']").parent().attr('class', 'disabled');
        $("a[data-href='#paso2']").attr('data-href', $("a[href='#paso2']").attr('href'));
        $("a[data-href='#paso2']").removeAttr('href');
        $("a[data-href='#paso1']").attr('data-toggle', 'tab');
        $("a[data-href='#paso1']").attr('href', $("a[data-href='#paso1']").attr('data-href'));
        $("a[data-href='#paso1']").trigger("click");
    });
    $('#sendInformacionAdmitidoPendDos').click(function () {
        var error = 0;
        var pais = $('#cmb_pais_dom').val();
        if ($("#chk_mensaje1").prop("checked") && $("#chk_mensaje2").prop("checked")) {
            error = 0;
        } else {
            var mensaje = {wtmessage: "Debe Aceptar los términos de la Información.", title: "Exito"};
            error++;
            showAlert("NO_OK", "success", mensaje);
        }
        if ($('#txth_doc_titulo').val() == "")
        {
            error++;
            var mensaje =
                    {wtmessage: "Debe adjuntar título.", title: "Información"};
            showAlert("NO_OK", "error", mensaje);
        } else {
            if ($('#txth_doc_dni').val() == "")
            {
                error++;
                var mensaje =
                        {wtmessage: "Debe adjuntar documento de identidad.", title: "Información"};
                showAlert("NO_OK", "error", mensaje);
            } else {
                if ($('#cmb_tipo_dni').val() == "CED")
                {
                    if (pais == 1)
                    {
                        if ($('#txth_doc_certvota').val() == "")
                        {
                            error++;
                            var mensaje =
                                    {wtmessage: "Debe adjuntar certificado de votación.", title: "Información"};
                            showAlert("NO_OK", "error", mensaje);
                        }
                    } else

                    {
                        if ($('#txth_doc_foto').val() == "")
                        {
                            error++;
                            var mensaje =
                                    {wtmessage: "Debe adjuntar foto.", title: "Información"};
                            showAlert("NO_OK", "error", mensaje);
                        }
                    }
                } else {
                    if ($('#txth_doc_hojavida').val() == "") {
                        error++;
                        var mensaje = {wtmessage: "Debe adjuntar hoja de vida.", title: "Información"};
                        showAlert("NO_OK", "error", mensaje);
                    }
                }
            }
        }
        if ($('#cmb_unidad_solicitud').val() == 2) {
            if ($('#txth_doc_certificado').val() == "") {
                error++;
                var mensaje = {wtmessage: "Debe adjuntar certificado de materias.", title: "Información"};
                showAlert("NO_OK", "error", mensaje);
            }
        }
        if (error == 0) {
            guardarInscripcion('Update', '2');
        }
    });
    $('#paso1next').click(function () {
        $("a[data-href='#paso1']").attr('data-toggle', 'none');
        $("a[data-href='#paso1']").parent().attr('class', 'disabled');
        $("a[data-href='#paso1']").attr('data-href', $("a[href='#paso1']").attr('href'));
        $("a[data-href='#paso1']").removeAttr('href');
        $("a[data-href='#paso2']").attr('data-toggle', 'tab');
        $("a[data-href='#paso2']").attr('href', $("a[data-href='#paso2']").attr('data-href'));
        $("a[data-href='#paso2']").trigger("click");
    });
    $('#cmb_ninteres').change(function () {
        var link = $('#txth_base').val() + "/academico/matriculadosreprobados/index";
        var arrParams = new Object();
        arrParams.nint_id = $(this).val();
        arrParams.getmodalidad = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboDataselect(data.modalidad, "cmb_modalidad", "Seleccionar");
                var arrParams = new Object();
                if (data.modalidad.length > 0) {
                    arrParams.unidada = $('#cmb_ninteres').val();
                    arrParams.moda_id = data.modalidad[0].id;
                    arrParams.getcarrera = true;
                    requestHttpAjax(link, arrParams, function (response) {
                        if (response.status == "OK") {
                            data = response.message;
                            setComboDataselect(data.carrera, "cmb_carrera1", "Seleccionar");
                        }
                    }, true);
                }
            }
        }, true);
    });
    $('#cmb_modalidad').change(function () {
        var link = $('#txth_base').val() + "/academico/matriculadosreprobados/index";
        var arrParams = new Object();
        arrParams.unidada = $('#cmb_ninteres').val();
        arrParams.moda_id = $(this).val();
        arrParams.getcarrera = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboDataselect(data.carrera, "cmb_carrera1", "Seleccionar");
            }
        }, true);
    });
    $('#btn_BuscarMateria').click(function () {
        actualizarMateriaGrid();
    });
    //ESTO LUEGO BORRAR CUANDO ESTE EL BOTON DESDE EL MENU
    $('#sendReprobado').click(function () {
        var link = $('#txth_base').val() + "/academico/matriculadosreprobados/save";
        var arrParams = new Object();
        var selected = '';
        arrParams.uniacademica = $('#cmb_ninteres').val();
        arrParams.modalidad = $('#cmb_modalidad').val();
        arrParams.carreprog = $('#cmb_carrera1').val();
        arrParams.periodo = $('#cmb_periodo').val();
        arrParams.admitido = $('#TbG_Admitido input[name=rb_admitido]:checked').val();
        arrParams.paralelo = $('#txt_paralelo').val();
        //arrParams.carrera = $('#TbG_MATERIAS input[name=rb_materia]:checked').val();
        arrParams.grupo = $('#cmb_grupo').val();
        arrParams.mes = $('#cmb_mes').val();
        arrParams.modulo = $('#cmb_modulo').val();
        /*$('#TbG_MATERIAS input[type=checkbox]').each(function () {
         if (this.checked) {
         selected += $(this).val() + ',';
         }
         });
         if (selected != '')
         {
         arrParams.materia = selected;
         } else
         {
         var mensaje = {wtmessage: "Materias no debe estar vacío.", title: "Error"};
         showAlert("NO_OK", "Error", mensaje);
         }*/
        if (arrParams.admitido === undefined)
        {
            var mensaje = {wtmessage: "Admitido no debe estar vacío.", title: "Error"};
            showAlert("NO_OK", "Error", mensaje);
        } else {
            if ($('#cmb_ninteres option:selected').val() > '0') {
                if ($('#cmb_modalidad option:selected').val() > '0') {
                    if ($('#cmb_carrera1 option:selected').val() > '0') {
                        if ($('#cmb_periodo option:selected').val() > '0') {
                            $('#gridmateria').css('display', 'none');
                            alert ('Aqui guardar, luego pasar a funcion del boton'); 
                            /*if (!validateForm()) {
                                requestHttpAjax(link, arrParams, function (response) {
                                showAlert(response.status, response.label, response.message);
                                setTimeout(function () {
                                sessionStorage.clear();
                                window.location.href = $('#txth_base').val() + "/academico/matriculadosreprobados/save";
                                }, 3000);
                                }, true);
                                }*/
                        } else {
                            var mensaje = {wtmessage: "Período: El campo no debe estar vacío.", title: "Error"};
                            showAlert("NO_OK", "Error", mensaje);
                        }
                    } else {
                        var mensaje = {wtmessage: "Carrera /Programa: El campo no debe estar vacío.", title: "Error"};
                        showAlert("NO_OK", "Error", mensaje);
                    }
                } else {
                    var mensaje = {wtmessage: "Modalidad: El campo no debe estar vacío.", title: "Error"};
                    showAlert("NO_OK", "Error", mensaje);
                }
            } else {
                var mensaje = {wtmessage: "Unidad Académica: El campo no debe estar vacío.", title: "Error"};
                showAlert("NO_OK", "Error", mensaje);
            }            
        }
    });
});
function guardarInscripcion(accion, paso) {
    paso1next();
}
function habilitarSecciones() {
    var pais = $('#cmb_pais_dom').val();
    if (pais == 1) {
        $('#divCertvota').css('display', 'block');
    } else {
        $('#divCertvota').css('display', 'none');
    }
}
function paso1next() {
    $("a[data-href='#paso1']").attr('data-toggle', 'none');
    $("a[data-href='#paso1']").parent().attr('class', 'disabled');
    $("a[data-href='#paso1']").attr('data-href', $("a[href='#paso1']").attr('href'));
    $("a[data-href='#paso1']").removeAttr('href');
    $("a[data-href='#paso2']").attr('data-toggle', 'tab');
    $("a[data-href='#paso2']").attr('href', $("a[data-href='#paso2']").attr('data-href'));
    $("a[data-href='#paso2']").trigger("click");
}
function searchAdmitido(idbox, idgrid) {
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

function actualizarMateriaGrid() {

    if ($('#cmb_ninteres option:selected').val() > '0') {
        if ($('#cmb_modalidad option:selected').val() > '0') {
            if ($('#cmb_carrera1 option:selected').val() > '0') {
                if ($('#cmb_periodo option:selected').val() > '0') {
                    $('#gridmateria').css('display', 'none');
                    alert('Aqui se presentan las materias de esa carrera');
                    /*var unidadacade = $('#cmb_ninteres option:selected').val();
                     var modalidad = $('#cmb_modalidad option:selected').val();
                     var carrerapro = $('#cmb_carrera1 option:selected').val();
                     //Buscar almenos una clase con el nombre para ejecutar
                     if (!$(".blockUI").length) {
                     showLoadingPopup();
                     $('#TbG_MATERIAS').PbGridView('applyFilterData', {'unidadacade': unidadacade, 'modalidad': modalidad, 'carrerapro': carrerapro});
                     setTimeout(hideLoadingPopup, 2000);
                     }*/
                } else {
                    var mensaje = {wtmessage: "Período: El campo no debe estar vacío.", title: "Error"};
                    showAlert("NO_OK", "Error", mensaje);
                }
            } else {
                var mensaje = {wtmessage: "Carrera /Programa: El campo no debe estar vacío.", title: "Error"};
                showAlert("NO_OK", "Error", mensaje);
            }
        } else {
            var mensaje = {wtmessage: "Modalidad: El campo no debe estar vacío.", title: "Error"};
            showAlert("NO_OK", "Error", mensaje);
        }
    } else {
        var mensaje = {wtmessage: "Unidad Académica: El campo no debe estar vacío.", title: "Error"};
        showAlert("NO_OK", "Error", mensaje);
    }
}