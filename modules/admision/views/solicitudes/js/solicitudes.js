
$(document).ready(function () {


    $('#cmb_ninteres').change(function () {
        var link = $('#txth_base').val() + "/solicitudinscripcion/create";
        var arrParams = new Object();
        arrParams.nint_id = $(this).val();
        arrParams.getmodalidad = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.modalidad, "cmb_modalidad");
                var arrParams = new Object();
                if (data.modalidad.length > 0) {
                    arrParams.unidada = $('#cmb_ninteres').val();
                    arrParams.moda_id = data.modalidad[0].id;
                    arrParams.getcarrera = true;
                    requestHttpAjax(link, arrParams, function (response) {
                        if (response.status == "OK") {
                            data = response.message;
                            setComboData(data.carrera, "cmb_carrera");
                        }
                    }, true);
                }
            }
        }, true);
        //métodos.
        var arrParams = new Object();
        arrParams.nint_id = $('#cmb_ninteres').val();
        arrParams.metodo = $('#cmb_metodos').val();
        arrParams.getmetodo = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.metodos, "cmb_metodos");
                //Descuentos.
                var arrParams = new Object();
                arrParams.nint_id = $('#cmb_ninteres').val();
                arrParams.unidada = $('#cmb_ninteres').val();
                arrParams.moda_id = $('#cmb_modalidad').val();
                arrParams.metodo = $('#cmb_metodos').val();
                arrParams.getdescuento = true;
                requestHttpAjax(link, arrParams, function (response) {
                    if (response.status == "OK") {
                        data = response.message;
                        setComboData(data.descuento, "cmb_descuento");
                    }
                }, true);
            }
        }, true);


        //Sólo mostrar el bloque de beca Fundación Cala cuando sea Unidad:Grado y Método:examen.                  
        if (arrParams.nint_id == 1) {
            if ($('#cmb_metodos') == 2) {
                $('#divBeca').css('display', 'block');
            } else {
                $('#divBeca').css('display', 'none');
            }
        } else {
            $('#divBeca').css('display', 'none');
        }
        //No mostrar el campo método ingreso cuando sea Unidad:Educación Continua.
        if (arrParams.nint_id > 2) {
            $('#divMetodo').css('display', 'none');
            $('#divDocumento').css('display', 'none');
            $('#lbl_carrera').text('Programa');
        } else {
            $('#divMetodo').css('display', 'block');
            $('#divDocumento').css('display', 'block');
            $('#lbl_carrera').text('Carrera');
        }
    });

    $('#cmb_modalidad').change(function () {
        var link = $('#txth_base').val() + "/solicitudinscripcion/create";
        var arrParams = new Object();
        arrParams.unidada = $('#cmb_ninteres').val();
        arrParams.moda_id = $(this).val();
        arrParams.getcarrera = true;
        arrParams.nint_id = $('#cmb_ninteres').val();
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.carrera, "cmb_carrera");
                arrParams.getmetodo = true;
                requestHttpAjax(link, arrParams, function (response) {
                    if (response.status == "OK") {
                        data = response.message;
                        setComboData(data.metodos, "cmb_metodos");
                    }
                }, true);
            }
        }, true);
        //Descuentos.
        var arrParams = new Object();
        arrParams.nint_id = $('#cmb_ninteres').val();
        arrParams.unidada = $('#cmb_ninteres').val();
        arrParams.moda_id = $('#cmb_modalidad').val();
        arrParams.metodo = $('#cmb_metodos').val();
        arrParams.getdescuento = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.descuento, "cmb_descuento");
            }
        }, true);
    });

    $('#cmb_unidad').change(function () {
        var link = $('#txth_base').val() + "/solicitudinscripcion/listarsolinteresado";
        var arrParams = new Object();
        arrParams.nint_id = $(this).val();
        arrParams.getmodalidad = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.modalidad, "cmb_modalidades");
                var arrParams = new Object();
                if (data.modalidad.length > 0) {
                    arrParams.unidada = $('#cmb_unidad').val();
                    arrParams.moda_id = data.modalidad[0].id;
                    arrParams.getcarrera = true;
                    requestHttpAjax(link, arrParams, function (response) {
                        if (response.status == "OK") {
                            data = response.message;
                            setComboData(data.carrera, "cmb_carreras");
                            arrParams.getmetodo = true;
                        }
                    }, true);
                }
            }
        }, true);
    });

    $('#cmb_modalidades').change(function () {
        var link = $('#txth_base').val() + "/solicitudinscripcion/listarsolinteresado";
        var arrParams = new Object();
        arrParams.unidada = $('#cmb_unidad').val();
        arrParams.moda_id = $(this).val();
        arrParams.getcarrera = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboDataselect(data.carrera, "cmb_carreras", "Todos");
            }
        }, true);
    });

    $('#cmb_ninteres').change(function () {
        switch ($(this).val()) {
            case '1': //grado
                $('.cinteres').hide(); //oculto todo
                if ($('#txth_extranjero').val() == "1") {
                    $('.doc_titulo').show();
                    $('.doc_dni').show();
                    $('.doc_foto').show();
                } else {
                    $('.doc_titulo').show();
                    $('.doc_dni').show();
                    $('.doc_certvota').show();
                    $('.doc_foto').show();
                }
                break;
            case '2': //grado online
                $('.cinteres').hide(); //oculto todo
                if ($('#txth_extranjero').val() == "1") {
                    $('.doc_titulo').show();
                    $('.doc_dni').show();
                    $('.doc_foto').show();
                } else {
                    $('.doc_titulo').show();
                    $('.doc_dni').show();
                    $('.doc_certvota').show();
                    $('.doc_foto').show();
                }
                break;
            case '3': //posgrado
                $('.cinteres').hide(); //oculto todo
                if ($('#txth_extranjero').val() == "1") {
                    $('.doc_titulo').show();
                    $('.doc_dni').show();
                    $('.doc_foto').show();
                } else {
                    $('.doc_titulo').show();
                    $('.doc_dni').show();
                    $('.doc_certvota').show();
                    $('.doc_foto').show();
                }
                break;
            default:
                $('.cinteres').hide();
                break;
        }
    });


    /**
     * Function evento click en botón de PreAprobación
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  Grabar la pre-aprobación.
     */
    /***** BORRAR DESPUES *****/
    $('#btn_Preaprobarsolicitud').click(function () {
        var arrParams = new Object();
        var link = $('#txth_base').val() + "/admision/solicitudes/saverevision";
        arrParams.sins_id = $('#txth_sins_id').val();
        arrParams.resultado = $('#cmb_revision').val();
        arrParams.per_id = $('#txth_per_id').val();

        if ($('#cmb_revision').val() == "4") {
            arreglo_check();
            arrParams.condicionestitulo = condiciontitulo;
            arrParams.condicionesdni = condiciondni;
            //Condiciones que indican que se ha seleccionado un(os) checkboxes.
            if (len > 0) {
                arrParams.titulo = 1;
                arrParams.observacion = obstitulo;
            }
            if (len1 > 0) {
                arrParams.dni = 1;
                if (arrParams.observacion == "") {
                    arrParams.observacion = obsdni;
                } else {
                    arrParams.observacion = arrParams.observacion + "<br/>" + obsdni;
                }
            }
        }
        arrParams.banderapreaprueba = '1';
        if (!validateForm()) {
            requestHttpAjax(link, arrParams, function (response) {
                showAlert(response.status, response.label, response.message);

                setTimeout(function () {
                    parent.window.location.href = $('#txth_base').val() + "/solicitudinscripcion/listarsolpendiente";
                }, 2000);

            }, true);
        }
    });

    /**
     * Function evento click en botón de Aprobación
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  Grabar la Aprobación.
     */
    /****BORRAR DESPUÉS*****/
    $('#btn_Aprobarsolicitud').click(function () {
        var arrParams = new Object();
        var link = $('#txth_base').val() + "/admision/solicitudes/saverevision";
        var condiciontitulo = new Array();
        var condiciondni = new Array();
        var len = condiciontitulo.length;
        var len1 = condiciondni.length;
        var obstitulo = "";
        var obsdni = "";
        arrParams.sins_id = $('#txth_sins_id').val();
        arrParams.int_id = $('#txth_int_id').val();
        arrParams.resultado = $('#cmb_revision').val();
        arrParams.observacion = $('#txt_observacion').val();
        arrParams.per_id = $('#txth_per_id').val();

        if ($('#cmb_revision').val() == "4") {
            arreglo_check();
            arrParams.condicionestitulo = condiciontitulo;
            arrParams.condicionesdni = condiciondni;
            //Condiciones que indican que se ha seleccionado un(os) checkboxes.
            if (len > 0) {
                arrParams.titulo = 1;
                arrParams.observacion = obstitulo;
            }
            if (len1 > 0) {
                arrParams.dni = 1;
                if (arrParams.observacion == "") {
                    arrParams.observacion = obsdni;
                } else {
                    arrParams.observacion = arrParams.observacion + "<br/>" + obsdni;
                }
            }
        }
        arrParams.banderapreaprueba = '0';
        if (!validateForm()) {
            requestHttpAjax(link, arrParams, function (response) {
                showAlert(response.status, response.label, response.message);

                setTimeout(function () {
                    parent.window.location.href = $('#txth_base').val() + "/admision/solicitudes/index";
                }, 2000);

            }, true);
        }
    });

    /**
     * Function evento change de la lista de valores de "Resultado" de las pantallas de 
     *          Pre-Aprobación y Aprobación de Solicitudes.
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  
     */
    $('#cmb_revision').change(function () {
        if ($('#cmb_revision').val() == 4) {
            $('#Divnoaprobado').css('display', 'block');
        } else {
            $('#Divnoaprobado').css('display', 'none');
        }
    });

    /**
     * Function evento change del control "chk_titulo": condiciones a revisar por tipo de documento "título".      
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  
     */
    $('#chk_titulo').change(function () {
        if ($('#chk_titulo').prop('checked')) {
            $('#Divcondtitulo').css('visibility', 'visible');
        } else {
            $('#Divcondtitulo').css('visibility', 'hidden');
        }
    });

    /**
     * Function evento change del control "chk_documento": condiciones a revisar por tipo de documento "documento de identidad".
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  
     */
    $('#chk_documento').change(function () {
        if ($('#chk_documento').prop('checked')) {
            $('#Divconddni').css('visibility', 'visible');
        } else {
            $('#Divconddni').css('visibility', 'hidden');
        }
    });

    /**
     * Function arreglo_check, forma arreglo con las condiciones elegidas tanto para los documentos: título y documento de identidad.
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  
     */
    function arreglo_check() {
        if ($('#chk_titulo').prop('checked')) {
            obstitulo = $('#chk_titulo').attr('placeholder');
            if ($('#chk_contitulo0').prop('checked')) {
                if (len == 0) {
                    condiciontitulo[0] = $('#txth_cond_titulo0').val();
                } else {
                    condiciontitulo[len] = $('#txth_cond_titulo0').val();
                }
                len = len + 1;
            }
            if ($('#chk_contitulo1').prop('checked')) {
                if (len == 0) {
                    condiciontitulo[0] = $('#txth_cond_titulo1').val();
                } else {
                    condiciontitulo[len] = $('#txth_cond_titulo1').val();
                }
                len = len + 1;
            }
            if ($('#chk_contitulo2').prop('checked')) {
                if (len == 0) {
                    condiciontitulo[0] = $('#txth_cond_titulo2').val();
                } else {
                    condiciontitulo[len] = $('#txth_cond_titulo2').val();
                }
                len = len + 1;
            }
            if ($('#chk_contitulo3').prop('checked')) {
                if (len == 0) {
                    condiciontitulo[0] = $('#txth_cond_titulo3').val();
                } else {
                    condiciontitulo[len] = $('#txth_cond_titulo3').val();
                }
                len = len + 1;
            }
        }

        if ($('#chk_documento').prop('checked')) {
            obsdni = $('#chk_documento').attr('placeholder');
            if ($('#chk_conddni0').prop('checked')) {
                if (len1 == 0) {
                    condiciondni[0] = $('#txth_cond_dni0').val();
                } else {
                    condiciondni[len1] = $('#txth_cond_dni0').val();
                }
                len1 = len1 + 1;
            }
            if ($('#chk_conddni1').prop('checked')) {
                if (len1 == 0) {
                    condiciondni[0] = $('#txth_cond_dni1').val();
                } else {
                    condiciondni[len1] = $('#txth_cond_dni1').val();
                }
                len1 = len1 + 1;
            }
            if ($('#chk_conddni2').prop('checked')) {
                if (len1 == 0) {
                    condiciondni[0] = $('#txth_cond_dni2').val();
                } else {
                    condiciondni[len1] = $('#txth_cond_dni2').val();
                }
                len1 = len1 + 1;
            }
        }
    }

    $('#btn_buscarData').click(function () {
        actualizarGrid();
    });
    $('#btn_buscarDataPend').click(function () {
        actualizarGridPend();
    });
    $('#btn_buscarDataPreapro').click(function () {
        actualizarGridPreapro();
    });
    $('#btn_buscarDataapro').click(function () {
        actualizarGridaprobada();
    });

    //Control del div Declaración de beca.
    $('#opt_declara_si').change(function () {
        if ($('#opt_declara_si').val() == 1) {
            $('#divDeclarabeca').css('display', 'block');
            $('#votacion').css('display', 'none');
            $("#opt_declara_no").prop("checked", "");
        } else {
            $('#divDeclarabeca').css('display', 'none');
            $('#votacion').css('display', 'block');
        }
    });

    $('#opt_declara_no').change(function () {
        if ($('#opt_declara_no').val() == 2) {
            $('#divDeclarabeca').css('display', 'none');
            $('#votacion').css('display', 'block');
            $("#opt_declara_si").prop("checked", "");
        } else {
            $('#divDeclarabeca').css('display', 'block');
            $('#votacion').css('display', 'none');
        }
    });

    //Control del div de Descuentos.
    $('#opt_declara_Dctosi').change(function () {
        if ($('#opt_declara_Dctosi').val() == 1) {
            $('#divDescuento').css('display', 'block');
            $("#opt_declara_Dctono").prop("checked", "");
        } else {
            $('#divDescuento').css('display', 'none');
        }

    });

    $('#opt_declara_Dctono').change(function () {
        if ($('#opt_declara_Dctono').val() == 2) {
            $('#divDescuento').css('display', 'none');
            $("#opt_declara_Dctosi").prop("checked", "");
        } else {
            $('#divDescuento').css('display', 'block');
        }
    });

    $('#btnAnular').click(function () {
        var link = $('#txth_base').val() + "/solicitudinscripcion/grabaranulacion";
        var arrParams = new Object();
        arrParams.observacion = $('#txt_observacion').val();
        arrParams.sins_id = $('#txth_sins_id').val();

        if (!validateForm()) {
            requestHttpAjax(link, arrParams, function (response) {
                showAlert(response.status, response.label, response.message);
                setTimeout(function () {
                    parent.window.location.href = $('#txth_base').val() + "/solicitudinscripcion/listarsolaprobadmin";
                }, 5000);
            }, true);
        }
    });

    /***BORRAR DESPUES ***/
    $('#sendDocumentos').click(function () {
        var link = $('#txth_base').val() + "/admision/solicitudes/savedocumentos";
        var arrParams = new Object();
        arrParams.sins_id = $('#txth_ids').val();
        arrParams.persona_id = $('#txth_idp').val();
        arrParams.interesado_id = $('#txth_int_id').val();
        arrParams.arc_extranjero = $('#txth_extranjero').val();
        arrParams.arc_doc_titulo = $('#txth_doc_titulo').val();
        arrParams.arc_doc_dni = $('#txth_doc_dni').val();
        arrParams.arc_doc_certvota = $('#txth_doc_certvota').val();
        arrParams.arc_doc_foto = $('#txth_doc_foto').val();
        arrParams.arc_doc_beca = $('#txth_doc_beca').val();

        if ($('input[name=opt_declara_si]:checked').val() == 1) {
            arrParams.beca = 1;
        } else {
            arrParams.beca = 0;
        }
        if (!validateForm()) {
            requestHttpAjax(link, arrParams, function (response) {
                showAlert(response.status, response.label, response.message);
                setTimeout(function () {
                    window.location.href = $('#txth_base').val() + "/admision/solicitudes/listarsolicitudxinteresado?id=" + arrParams.interesado_id;
                }, 5000);
            }, true);
        }
    });

    //Control del div Subida Documentos.
    $('#opt_subir_si').change(function () {
        if ($('#opt_subir_si').val() == 1) {
            $('#DivDocumentos').css('display', 'block');
            $("#opt_subir_no").prop("checked", "");
        } else {
            $('#DivDocumentos').css('display', 'none');
        }
    });

    $('#opt_subir_no').change(function () {
        if ($('#opt_subir_no').val() == 2) {
            $('#DivDocumentos').css('display', 'none');
            $("#opt_subir_si").prop("checked", "");
        } else {
            $('#DivDocumentos').css('display', 'block');
        }
    });

    $('#cmb_metodos').change(function () {
        var link = $('#txth_base').val() + "/solicitudinscripcion/create";
        var arrParams = new Object();
        if ($('#cmb_metodos').val() == 2) {
            if ($('#cmb_ninteres').val() == 1) {
                $('#divBeca').css('display', 'block');
            } else {
                $('#divBeca').css('display', 'none');
            }
        } else {
            $('#divBeca').css('display', 'none');
        }
        //Descuentos.
        arrParams.unidada = $('#cmb_ninteres').val();
        arrParams.moda_id = $('#cmb_modalidad').val();
        arrParams.metodo = $('#cmb_metodos').val();
        arrParams.getdescuento = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.descuento, "cmb_descuento");
            }
        }, true);
    });

    /**** BORRAR ****/
    $('#btnNewSolicitud').click(function () {
        var per_id = $('#txth_per_id').val();
        window.location.href = $('#txth_base').val() + "/admision/solicitudes/new?per_id=" + per_id;
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

function exportExcel() {
    var search = $('#txt_buscarData').val();
    var modalidad = $('#cmb_modalidades option:selected').val();
    var carrera = $('#cmb_carreras option:selected').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    window.location.href = $('#txth_base').val() + "/solicitudinscripcion/expexcel?search=" + search + "&modalidad=" + modalidad + "&carrera=" + carrera + "&f_ini=" + f_ini + "&f_fin=" + f_fin;
}

function actualizarGrid() {
    var search = $('#txt_buscarData').val();
    var modalidad = $('#cmb_modalidades option:selected').val();
    var carrera = $('#cmb_carrera option:selected').val();
    var estadoSol = $('#cmb_estado option:selected').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();

    //Buscar almenos una clase con el nombre para ejecutar
    if (!$(".blockUI").length) {
        showLoadingPopup();
        $('#Tbg_Solicitudes').PbGridView('applyFilterData', {'f_ini': f_ini, 'f_fin': f_fin, 'modalidad': modalidad, 'carrera': carrera, 'search': search, 'estadoSol': estadoSol});
        setTimeout(hideLoadingPopup, 2000);
    }
}

function actualizarGridPend() {
    var search = $('#txt_buscarDataPen').val();
    var ejecutivo = $('#cmb_ejecutivo option:selected').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    //Buscar almenos una clase con el nombre para ejecutar
    if (!$(".blockUI").length) {
        showLoadingPopup();
        $('#TbG_PERSONAS').PbGridView('applyFilterData', {'f_ini': f_ini, 'f_fin': f_fin, 'ejecutivo': ejecutivo, 'search': search});
        setTimeout(hideLoadingPopup, 2000);
    }

}
function actualizarGridPreapro() {
    var search = $('#txt_buscarDataPreapro').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    //Buscar almenos una clase con el nombre para ejecutar
    if (!$(".blockUI").length) {
        showLoadingPopup();
        $('#TbG_PERSONAS').PbGridView('applyFilterData', {'f_ini': f_ini, 'f_fin': f_fin, 'search': search});
        setTimeout(hideLoadingPopup, 2000);
    }
}

function actualizarGridaprobada() {
    var search = $('#txt_buscarDataapro').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    //Buscar almenos una clase con el nombre para ejecutar
    if (!$(".blockUI").length) {
        showLoadingPopup();
        $('#TbG_PERSONAS').PbGridView('applyFilterData', {'f_ini': f_ini, 'f_fin': f_fin, 'search': search});
        setTimeout(hideLoadingPopup, 2000);
    }
}

function NewSolicitud() {
    var per_id = $('#txth_per_id').val();
    window.location.href = $('#txth_base').val() + "/admision/solicitudes/new?per_id=" + per_id;
}
function save() {
    var link = $('#txth_base').val() + "/admision/solicitudes/save";
    var arrParams = new Object();
    arrParams.persona_id = $('#txth_ids').val();
    arrParams.int_id = $('#txth_intId').val();
    arrParams.ninteres = $('#cmb_ninteres').val();
    arrParams.modalidad = $('#cmb_modalidad').val();
    arrParams.metodoing = $('#cmb_metodos').val();
    arrParams.carrera = $('#cmb_carrera').val();
    arrParams.arc_doc_titulo = $('#txth_doc_titulo').val();
    arrParams.arc_doc_dni = $('#txth_doc_dni').val();
    arrParams.arc_doc_certvota = $('#txth_doc_certvota').val();
    arrParams.arc_doc_foto = $('#txth_doc_foto').val();
    arrParams.arc_extranjero = $('#txth_extranjero').val();
    arrParams.arc_nacional = $('#txth_nac').val();
    arrParams.arc_doc_beca = $('#txth_doc_beca').val();
    arrParams.emp_id = 1;
    if ($('input[name=opt_declara_Dctosi]:checked').val() == 1) {
        arrParams.descuento_id = $('#cmb_descuento').val();
        arrParams.marcadescuento = '1';
    }
    if ($('input[name=opt_declara_si]:checked').val() == 1) {
        arrParams.beca = 1;
    } else {
        arrParams.beca = 0;
    }

    if ($('input[name=opt_subir_si]:checked').val() == 1) {
        arrParams.subirDocumentos = 1;
    } else {
        arrParams.subirDocumentos = 0;
    }

    if (!validateForm()) {
        requestHttpAjax(link, arrParams, function (response) {
            showAlert(response.status, response.label, response.message);
            setTimeout(function () {
                if (arrParams.persona_id == '0')
                {
                    window.location.href = $('#txth_base').val() + "/admision/interesados/index";
                } else
                {
                    window.location.href = $('#txth_base').val() + "/admision/solicitudes/listarsolicitudxinteresado?id=" + arrParams.int_id;
                }
            }, 5000);
        }, true);
    }
}
//Guarda Documentos de solicitudes de inscripción.
function SaveDocumentos() {
    var link = $('#txth_base').val() + "/admision/solicitudes/savedocumentos";
    var arrParams = new Object();
    arrParams.sins_id = $('#txth_ids').val();
    arrParams.persona_id = $('#txth_idp').val();
    arrParams.interesado_id = $('#txth_int_id').val();
    arrParams.arc_extranjero = $('#txth_extranjero').val();
    arrParams.arc_doc_titulo = $('#txth_doc_titulo').val();
    arrParams.arc_doc_dni = $('#txth_doc_dni').val();
    arrParams.arc_doc_certvota = $('#txth_doc_certvota').val();
    arrParams.arc_doc_foto = $('#txth_doc_foto').val();
    arrParams.arc_doc_beca = $('#txth_doc_beca').val();

    if ($('input[name=opt_declara_si]:checked').val() == 1) {
        arrParams.beca = 1;
    } else {
        arrParams.beca = 0;
    }
    if (!validateForm()) {
        requestHttpAjax(link, arrParams, function (response) {
            showAlert(response.status, response.label, response.message);
            setTimeout(function () {
                window.location.href = $('#txth_base').val() + "/admision/solicitudes/listarsolicitudxinteresado?ids=" + base64_encode(arrParams.persona_id);
            }, 5000);
        }, true);
    }
}
//Guarda la Pre-revisión de solicitudes de inscripción.
function SavePrerevision() {
    var arrParams = new Object();
    var link = $('#txth_base').val() + "/admision/solicitudes/saverevision";
    var condiciontitulo = new Array();
    var condiciondni = new Array();
    var len = condiciontitulo.length;
    var len1 = condiciondni.length;
    var obstitulo = "";
    var obsdni = "";
    arrParams.sins_id = $('#txth_sins_id').val();
    arrParams.resultado = $('#cmb_revision').val();
    arrParams.per_id = $('#txth_per_id').val();

    if ($('#cmb_revision').val() == "4") {
        arreglo_check();
        arrParams.condicionestitulo = condiciontitulo;
        arrParams.condicionesdni = condiciondni;
        //Condiciones que indican que se ha seleccionado un(os) checkboxes.
        if (len > 0) {
            arrParams.titulo = 1;
            arrParams.observacion = obstitulo;
        }
        if (len1 > 0) {
            arrParams.dni = 1;
            if (arrParams.observacion == "") {
                arrParams.observacion = obsdni;
            } else {
                arrParams.observacion = arrParams.observacion + "<br/>" + obsdni;
            }
        }
    }
    arrParams.banderapreaprueba = '1';
    if (!validateForm()) {
        requestHttpAjax(link, arrParams, function (response) {
            showAlert(response.status, response.label, response.message);

            setTimeout(function () {
                parent.window.location.href = $('#txth_base').val() + "/admision/solicitudes/index";
            }, 2000);

        }, true);
    }
}

//Guarda la Revisión final de solicitudes de inscripción.
function SaveRevision() {
    var arrParams = new Object();
    var link = $('#txth_base').val() + "/admision/solicitudes/saverevision";
    var condiciontitulo = new Array();
    var condiciondni = new Array();
    var len = condiciontitulo.length;
    var len1 = condiciondni.length;
    var obstitulo = "";
    var obsdni = "";
    arrParams.sins_id = $('#txth_sins_id').val();
    arrParams.int_id = $('#txth_int_id').val();
    arrParams.resultado = $('#cmb_revision').val();
    arrParams.observacion = $('#txt_observacion').val();
    arrParams.per_id = $('#txth_per_id').val();

    if ($('#cmb_revision').val() == "4") {
        arreglo_check();
        arrParams.condicionestitulo = condiciontitulo;
        arrParams.condicionesdni = condiciondni;
        //Condiciones que indican que se ha seleccionado un(os) checkboxes.
        if (len > 0) {
            arrParams.titulo = 1;
            arrParams.observacion = obstitulo;
        }
        if (len1 > 0) {
            arrParams.dni = 1;
            if (arrParams.observacion == "") {
                arrParams.observacion = obsdni;
            } else {
                arrParams.observacion = arrParams.observacion + "<br/>" + obsdni;
            }
        }
    }
    arrParams.banderapreaprueba = '0';
    if (!validateForm()) {
        requestHttpAjax(link, arrParams, function (response) {
            showAlert(response.status, response.label, response.message);

            setTimeout(function () {
                parent.window.location.href = $('#txth_base').val() + "/admision/solicitudes/index";
            }, 2000);

        }, true);
    }
}
