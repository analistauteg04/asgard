/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    // para mostrar codigo de area
    $('#cmb_pais_dom').change(function () {
        var link = $('#txth_base').val() + "/inscripcionadmision/index";
        var arrParams = new Object();
        arrParams.codarea = $(this).val();
        arrParams.getarea = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                $('#txt_codigoarea').val(data.area['name']);
            }
        }, true);
    });

    $('#sendInformacionAspirante').click(function () {
        if ($('#txth_twin_id').val() == 0) {
            guardarInscripcion('Create');
        } else {
            guardarInscripcion('Update');
        }

    });
    $('#sendInformacionAspirante2').click(function () {
        if ($("#chk_mensaje1").prop("checked") && $("#chk_mensaje2").prop("checked")) {
            if ($('#txth_twin_id').val() != 0) {
                guardarInscripcion('Update');
            }
        } else {
            alert('Debe Aceptar los términos de la Información');
        }
    });
    $('#sendInscripcionsolicitud').click(function () {
        var link = $('#txth_base').val() + "/inscripcionadmision/saveinscripciontemp";
        var arrParams = new Object();
        arrParams.codigo = $('#txth_twin_id').val();
        arrParams.ACCION = 'Fin';
        requestHttpAjax(link, arrParams, function (response) {
            var message = response.message;
            //console.log(response);
            if (response.status == "OK") {
                setTimeout(function () {
                    var uaca_id=parseInt(response.data.data.uaca_id);
                    var mod_id=parseInt(response.data.data.mod_id);
                    var ming=parseInt(response.data.data.twin_metodo_ingreso);
                    switch (uaca_id) {
                        case 1:
                            switch (mod_id) {
                                case 1:
                                    switch (ming) {
                                        case 1:
                                            window.location.href = "https://www.uteg.edu.ec/pago-online-nivelacion/";
                                            break;
                                        case 2:
                                            window.location.href = "https://www.uteg.edu.ec/pago-examen-online/";
                                            break;
                                    }
                                    break;
                                case 2:
                                    switch (ming) {
                                        case 1:
                                            window.location.href = "https://www.uteg.edu.ec/pago-grado-presencial/ ";
                                            break;
                                        case 2:
                                            window.location.href = "https://www.uteg.edu.ec/pago-examen-presencial/  ";
                                            break;
                                    }
                                    break;
                                case 3:
                                    switch (ming) {
                                        case 1:
                                            //alert('grado semipresencial curso');
                                            //Todavia no hay enlace para grado semipresencial curso
                                            break;
                                        case 2:
                                            //alert('grado semipresencial examen');
                                            //Todavia no hay enlace para grado semipresencial Examen
                                            break;
                                    }
                                    break;
                                case 4:
                                    switch (ming) {
                                        case 1:
                                            window.location.href = "https://www.uteg.edu.ec/pago-grado-distancia/";
                                            break;
                                        case 2:
                                            window.location.href = "https://www.uteg.edu.ec/pago-examen-distancia/";
                                            break;
                                    }
                                    break;
                            }
                            break;
                        case 2:
                            window.location.href = "https://www.uteg.edu.ec/pago-posgrado/";
                            break;
                    }
                }, 5000);
            }
        });
    });

    $('#cmb_tipo_dni').change(function () {
        if ($('#cmb_tipo_dni').val() == 'PASS') {
            $('#txt_cedula').removeClass("PBvalidation");
            $('#txt_pasaporte').addClass("PBvalidation");
            $('#Divpasaporte').show();
            $('#Divcedula').hide();
        } else if ($('#cmb_tipo_dni').val() == 'CED')
        {
            $('#txt_pasaporte').removeClass("PBvalidation");
            $('#txt_cedula').addClass("PBvalidation");
            $('#Divpasaporte').hide();
            $('#Divcedula').show();
        }
    });

    $('#cmb_unidad_solicitud').change(function () {
        var link = $('#txth_base').val() + "/inscripcionadmision/index";
        var arrParams = new Object();
        arrParams.nint_id = $(this).val();
        arrParams.getmodalidad = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.modalidad, "cmb_modalidad_solicitud");
                var arrParams = new Object();
                if (data.modalidad.length > 0) {
                    arrParams.unidada = $('#cmb_unidad_solicitud').val();
                    arrParams.moda_id = data.modalidad[0].id;
                    arrParams.getcarrera = true;
                    requestHttpAjax(link, arrParams, function (response) {
                        if (response.status == "OK") {
                            data = response.message;
                            setComboData(data.carrera, "cmb_carrera_solicitud");
                        }
                    }, true);
                }
            }
        }, true);

        //métodos.
        var arrParams = new Object();
        arrParams.nint_id = $(this).val();
        arrParams.metodo = $('#cmb_metodo_solicitud').val();
        arrParams.getmetodo = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.metodos, "cmb_metodo_solicitud");
                AparecerDocumento();
                Requisitos();
            }
        }, true);

    });

    $('#cmb_modalidad_solicitud').change(function () {
        var link = $('#txth_base').val() + "/inscripcionadmision/index";
        var arrParams = new Object();
        arrParams.unidada = $('#cmb_unidad_solicitud').val();
        arrParams.moda_id = $(this).val();
        arrParams.getcarrera = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.carrera, "cmb_carrera_solicitud");
            }
        }, true);
        Requisitos();
    });

    $('#cmb_metodo_solicitud').change(function () {
        Requisitos();
        AparecerDocumento();
    });

    // tabs del index
    $('#paso1next').click(function () {

        $("a[data-href='#paso1']").attr('data-toggle', 'none');
        $("a[data-href='#paso1']").parent().attr('class', 'disabled');
        $("a[data-href='#paso1']").attr('data-href', $("a[href='#paso1']").attr('href'));
        $("a[data-href='#paso1']").removeAttr('href');
        $("a[data-href='#paso2']").attr('data-toggle', 'tab');
        $("a[data-href='#paso2']").attr('href', $("a[data-href='#paso2']").attr('data-href'));
        $("a[data-href='#paso2']").trigger("click");
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
    $('#paso2next').click(function () {
        $("a[data-href='#paso2']").attr('data-toggle', 'none');
        $("a[data-href='#paso2']").parent().attr('class', 'disabled');
        $("a[data-href='#paso2']").attr('data-href', $("a[href='#paso2']").attr('href'));
        $("a[data-href='#paso2']").removeAttr('href');
        $("a[data-href='#paso3']").attr('data-toggle', 'tab');
        $("a[data-href='#paso3']").attr('href', $("a[data-href='#paso3']").attr('data-href'));
        $("a[data-href='#paso3']").trigger("click");
    });
    $('#paso3back').click(function () {
        $("a[data-href='#paso3']").attr('data-toggle', 'none');
        $("a[data-href='#paso3']").parent().attr('class', 'disabled');
        $("a[data-href='#paso3']").attr('data-href', $("a[href='#paso3']").attr('href'));
        $("a[data-href='#paso3']").removeAttr('href');
        $("a[data-href='#paso2']").attr('data-toggle', 'tab');
        $("a[data-href='#paso2']").attr('href', $("a[data-href='#paso2']").attr('data-href'));
        $("a[data-href='#paso2']").trigger("click");
    });


    function AparecerDocumento() {
        if ($('#cmb_metodo_solicitud').val() == 4) {
            $('#divCertificado').css('display', 'block');
        } else {
            $('#divCertificado').css('display', 'none');

        }
    }

    function Requisitos() {
        if ($('#cmb_metodo_solicitud').val() != 0) {
            //Grado
            if ($('#cmb_unidad_solicitud').val() == 1) {
                //Método: CAN
                if ($('#cmb_metodo_solicitud').val() == 1) {
                    //Online
                    if ($('#cmb_modalidad_solicitud').val() == 1) {
                        $('#divRequisitosCANO').css('display', 'block');
                        $('#divRequisitosCANP').css('display', 'none');
                        $('#divRequisitosCANSP').css('display', 'none');
                        $('#divRequisitosCANAD').css('display', 'none');
                        $('#divRequisitosEXA').css('display', 'none');
                        $('#divRequisitosPRP').css('display', 'none');
                    } else {  //Presencial
                        if ($('#cmb_modalidad_solicitud').val() == 2) {
                            $('#divRequisitosCANP').css('display', 'block');
                            $('#divRequisitosCANO').css('display', 'none');
                            $('#divRequisitosCANSP').css('display', 'none');
                            $('#divRequisitosCANAD').css('display', 'none');
                            $('#divRequisitosEXA').css('display', 'none');
                            $('#divRequisitosPRP').css('display', 'none');
                        } else {   //Semipresencial
                            if ($('#cmb_modalidad_solicitud').val() == 3) {
                                $('#divRequisitosCANSP').css('display', 'block');
                                $('#divRequisitosCANO').css('display', 'none');
                                $('#divRequisitosCANP').css('display', 'none');
                                $('#divRequisitosCANAD').css('display', 'none');
                                $('#divRequisitosEXA').css('display', 'none');
                                $('#divRequisitosPRP').css('display', 'none');
                            } else {  // distancia
                                $('#divRequisitosCANAD').css('display', 'block');
                                $('#divRequisitosCANO').css('display', 'none');
                                $('#divRequisitosCANP').css('display', 'none');
                                $('#divRequisitosCANSP').css('display', 'none');
                                $('#divRequisitosEXA').css('display', 'none');
                                $('#divRequisitosPRP').css('display', 'none');
                            }
                        }
                    }
                } else {  //examen
                    //Online                    
                    $('#divRequisitosEXA').css('display', 'block');
                    $('#divRequisitosCANO').css('display', 'none');
                    $('#divRequisitosCANP').css('display', 'none');
                    $('#divRequisitosCANSP').css('display', 'none');
                    $('#divRequisitosCANAD').css('display', 'none');
                    $('#divRequisitosPRP').css('display', 'none');
                }
            } else {  //Posgrado  Semipresencial
                if ($('#cmb_modalidad_solicitud').val() == 3) {
                    //Homologación            
                    if ($('#cmb_metodo_solicitud').val() == 4) {
                        //Taller introductorio
                        $('#divRequisitosPRP').css('display', 'block');
                        $('#divRequisitosCANO').css('display', 'none');
                        $('#divRequisitosCANP').css('display', 'none');
                        $('#divRequisitosCANSP').css('display', 'none');
                        $('#divRequisitosCANAD').css('display', 'none');
                        $('#divRequisitosEXA').css('display', 'none');
                    }
                }
            }
        } else {
            $('#divRequisitosCANO').css('display', 'none');
            $('#divRequisitosCANP').css('display', 'none');
            $('#divRequisitosCANSP').css('display', 'none');
            $('#divRequisitosCANAD').css('display', 'none');
            $('#divRequisitosEXA').css('display', 'none');
            $('#divRequisitosPRP').css('display', 'none');
        }
    }
});

//INSERTAR DATOS
function guardarInscripcion(accion) {
    var ID = (accion == "Update") ? $('#txth_twin_id').val() : 0;
    var link = $('#txth_base').val() + "/inscripcionadmision/saveinscripciontemp";
    var arrParams = new Object();
    arrParams.DATA_1 = dataInscripPart1(ID);
    arrParams.ACCION = accion;
    if (!validateForm()) {
        requestHttpAjax(link, arrParams, function (response) {
            var message = response.message;
            //console.log(response);
            if (response.status == "OK") {
                if (accion == "Create") {
                    $('#txth_twin_id').val(response.data.ids)
                    paso1next();
                } else {
                    var uaca_id = response.data.data.uaca_id;
                    //Inicio ingreso informacion del tab 3\
                    $('#lbl_uaca_tx').text(response.data.data.unidad);
                    $('#lbl_moda_tx').text(response.data.data.modalidad);
                    $('#lbl_carrera_tx').text(response.data.data.carrera);
                    $('#lbl_ming_tx').text(response.data.data.metodo);

                    if (uaca_id == 1) {
                        $('#id_item_1').css('display', 'block');
                        $('#id_item_2').css('display', 'block');
                    } else if (uaca_id == 2) {
                        $('#id_item_1').css('display', 'none');
                        $('#id_item_2').css('display', 'none');
                        $('#id_mat_cur').css('display', 'none');
                    }
                    $('#id_item_1').css('display', 'none');
                    $('#id_item_2').css('display', 'none');
                    var leyenda = '';
                    var ming = response.data.data.twin_metodo_ingreso;
                    var mod_id = response.data.data.mod_id;
                    var materias_online = "Matematicas I, Tecnicas de comunicacion Oral y Escrita, Contabilidad";
                    var materias_otros = "Matematicas I, Tecnicas de comunicacion Oral y Escrita, Contabilidad, Desarrollo del Pensamiento, Emprendimiento";

                    $('#lbl_fcur_lb').text("Fecha del curso:");
                    if (uaca_id == 2) {
                        leyenda = 'El valor de la maestría: $11,300.00 ';
                        leyenda += 'El valor a cancelar por concepto de inscripción es: ';
                        $('#lbl_item_1').text("Valor Inscripción: ");
                        $('#val_item_1').text(response.data.data.precio);
                        $('#lbl_valor_pagar_tx').text(response.data.data.precio);
                        $('#lbl_fcur_tx').text("17 de noviembre del 2018");
                    } else if (uaca_id == 1) {
                        leyenda = 'El valor a cancelar por concepto de ' + response.data.data.metodo + ' en la modalidad ' + response.data.data.modalidad + ' es:';
                        if (mod_id == 1) {//online
                            $('#lbl_mcur_tx').text(materias_online);
                            if (ming == 1) {// curso
                                $('#lbl_valor_pagar_tx').text(response.data.data.precio);
                                $('#lbl_fcur_lb').text("Fecha del curso:");
                                $('#lbl_fcur_tx').text("22 de octubre al 14 de diciembre");
                            } else if (ming == 2) { // examen
                                $('#lbl_fcur_lb').text("Fecha de las pruebas:");
                                $('#lbl_valor_pagar_tx').text(response.data.data.precio);
                                $('#lbl_fcur_tx').text("En quince (15) días a partir del registro (un coordinador te contactará para brindarte mayor información)");
                            }
                        } else if (mod_id == 2 || mod_id == 3 || mod_id == 4) {//presencial y semi presencial
                            $('#lbl_mcur_tx').text(materias_otros);
                            if (ming == 1) {// curso
                                if (mod_id == 2 || mod_id == 3) {
                                    $('#lbl_fcur_tx').text("22 de octubre al 30 de noviembre");
                                } else if (mod_id == 4) {
                                    $('#lbl_fcur_tx').text("20 de octubre al 8 de diciembre");
                                }
                                $('#lbl_item_1').text("Curso de nivelación: ");
                                $('#val_item_1').text(response.data.data.precio);
                                $('#lbl_item_2').text("Descuento especial: ");
                                $('#val_item_2').text(response.data.data.ddit_valor);
                                var totalvalor = parseInt(response.data.data.precio) - parseInt(response.data.data.ddit_valor);
                                $('#lbl_valor_pagar_tx').text(totalvalor);
                                $('#lbl_fcur_lb').text("Fecha del curso:");
                                $('#id_item_1').css('display', 'block');
                                $('#id_item_2').css('display', 'block');
                            } else if (ming == 2) { // examen
                                $('#lbl_fcur_tx').text("En quince (15) días a partir del registro (un coordinador te contactará para brindarte mayor información)");
                                $('#lbl_item_1').text("Exámen de Admisión: ");
                                $('#val_item_1').text(response.data.data.precio);
                                $('#lbl_item_2').text("Descuento especial: ");
                                $('#val_item_2').text(response.data.data.ddit_valor);
                                var totalvalor = parseInt(response.data.data.precio) - parseInt(response.data.data.ddit_valor);
                                $('#lbl_valor_pagar_tx').text(totalvalor);
                                $('#lbl_fcur_lb').text("Fecha de las pruebas:");
                                $('#id_item_1').css('display', 'block');
                                $('#id_item_2').css('display', 'block');
                            }
                        }
                    }

                    $('#lbl_leyenda_pago_tx').text(leyenda);
                    //fin ingreso informacion del tab 3
                    $('#txth_twin_id').val(response.data.ids);//SE AGREGA AL FINAL                            
                    paso2next();
                }
                //var data =response.data;
                //AccionTipo=data.accion;
                //limpiarDatos();
                //var renderurl = $('#txth_base').val() + "/inscripciones/index";
                //window.location = renderurl;
            }
            showAlert(response.status, response.label, response.message);
        }, true);
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

function paso2next() {
    $("a[data-href='#paso2']").attr('data-toggle', 'none');
    $("a[data-href='#paso2']").parent().attr('class', 'disabled');
    $("a[data-href='#paso2']").attr('data-href', $("a[href='#paso2']").attr('href'));
    $("a[data-href='#paso2']").removeAttr('href');
    $("a[data-href='#paso3']").attr('data-toggle', 'tab');
    $("a[data-href='#paso3']").attr('href', $("a[data-href='#paso3']").attr('data-href'));
    $("a[data-href='#paso3']").trigger("click");
}

function dataInscripPart1(ID) {
    var datArray = new Array();
    var objDat = new Object();
    objDat.twin_id = ID;//Genero Automatico
    objDat.pges_pri_nombre = $('#txt_primer_nombre').val();
    objDat.pges_pri_apellido = $('#txt_primer_apellido').val();
    objDat.tipo_dni = $('#cmb_tipo_dni option:selected').val();
    objDat.pges_cedula = $('#txt_cedula').val();
    objDat.pges_correo = $('#txt_correo').val();
    objDat.pais = $('#cmb_pais_dom option:selected').val();
    objDat.pges_celular = $('#txt_celular').val();
    objDat.unidad_academica = $('#cmb_unidad_solicitud option:selected').val();
    objDat.modalidad = $('#cmb_modalidad_solicitud option:selected').val();
    objDat.ming_id = $('#cmb_metodo_solicitud option:selected').val();
    objDat.conoce = $('#cmb_conuteg option:selected').val();
    objDat.carrera = $('#cmb_carrera_solicitud option:selected').val();
    //TABA 2
    objDat.ruta_doc_titulo = ($('#txth_doc_titulo').val() != '') ? $('#txth_doc_titulo').val() : '';
    objDat.ruta_doc_dni = ($('#txth_doc_dni').val() != '') ? $('#txth_doc_dni').val() : '';
    objDat.ruta_doc_certvota = ($('#txth_doc_certvota').val() != '') ? $('#txth_doc_certvota').val() : '';
    objDat.ruta_doc_foto = ($('#txth_doc_foto').val() != '') ? $('#txth_doc_foto').val() : '';
    objDat.ruta_doc_certificado = ($('#txth_doc_certificado').val() != '') ? $('#txth_doc_certificado').val() : '';
    objDat.twin_mensaje1 = ($("#chk_mensaje1").prop("checked")) ? '1' : '0';
    objDat.twin_mensaje2 = ($("#chk_mensaje2").prop("checked")) ? '1' : '0';
    datArray[0] = objDat;
    sessionStorage.dataInscrip_1 = JSON.stringify(datArray);
    return datArray;
}