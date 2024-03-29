
$(document).ready(function () {

    $('input[name=opt_tipo_DNI]:radio').change(function () {
        if ($(this).val() == 1) {//ced
            $('#txt_dni_fac').attr("data-lengthMin", "10");
            $('#txt_dni_fac').attr("data-lengthMax", "10");
            $('#txt_dni_fac').attr("placeholder", $('#txth_ced_lb').val());
            $('label[for=txt_dni_fac]').text($('#txth_ced_lb').val() + "");
        } else if ($(this).val() == 2) { // ruc
            $('#txt_dni_fac').attr("data-lengthMin", "13");
            $('#txt_dni_fac').attr("data-lengthMax", "13");
            $('#txt_dni_fac').attr("placeholder", $('#txth_ruc_lb').val());
            $('label[for=txt_dni_fac]').text($('#txth_ruc_lb').val() + "");
        } else { // pasaporte
            $('#txt_dni_fac').attr("data-lengthMin", "13");
            $('#txt_dni_fac').attr("data-lengthMax", "13");
            $('#txt_dni_fac').attr("placeholder", $('#txth_ruc_lb').val());
            $('label[for=txt_dni_fac]').text($('#txth_pas_lb').val() + "");
        }
    });
    $('#cmb_empresa').change(function () {// cambio 2
        var link = $('#txth_base').val() + "/admision/solicitudes/new";
        var arrParams = new Object();
        arrParams.empresa_id = $('#cmb_empresa').val();
        arrParams.getuacademias = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.unidad_academica, "cmb_ninteres");
                var arrParams = new Object();
                if (data.unidad_academica.length > 0) {
                    //Here I am going to change the combo income method
                    var arrParams = new Object();
                    arrParams.nint_id = $('#cmb_ninteres').val();
                    arrParams.getmetodo = true;
                    requestHttpAjax(link, arrParams, function (response) {
                        if (response.status == "OK") {
                            data = response.message;
                            setComboData(data.metodos, "cmb_metodos");
                        }
                    }, true);
                    var arrParams = new Object();
                    arrParams.nint_id = $('#cmb_ninteres').val();
                    arrParams.getmodalidad = true;
                    arrParams.empresa_id = $('#cmb_empresa').val();
                    requestHttpAjax(link, arrParams, function (response) {
                        if (response.status == "OK") {
                            data = response.message;
                            setComboData(data.modalidad, "cmb_modalidad");
                            if (data.modalidad.length > 0) {
                                var arrParams = new Object();
                                arrParams.unidada = $('#cmb_ninteres').val();
                                arrParams.moda_id = $('#cmb_modalidad').val();
                                arrParams.empresa_id = $('#cmb_empresa').val();
                                arrParams.getcarrera = true;
                                requestHttpAjax(link, arrParams, function (response) {
                                    if (response.status == "OK") {
                                        data = response.message;
                                        setComboData(data.carrera, "cmb_carrera");
                                    }                                    
                                    var arrParams = new Object();
                                    arrParams.unidada = $('#cmb_ninteres').val();
                                    arrParams.metodo = $('#cmb_metodos').val();        
                                    arrParams.moda_id = $('#cmb_modalidad').val();
                                    arrParams.carrera_id = $('#cmb_carrera').val();
                                    arrParams.empresa_id = $('#cmb_empresa').val();
                                    arrParams.getitem = true;
                                    requestHttpAjax(link, arrParams, function (response) {
                                        if (response.status == "OK") {
                                            data = response.message;
                                            setComboData(data.items, "cmb_item");
                                        }
                                        //Precio.
                                        var arrParams = new Object();
                                        arrParams.ite_id = $('#cmb_item').val();
                                        arrParams.getprecio = true;        
                                        requestHttpAjax(link, arrParams, function (response) {
                                            if (response.status == "OK") {
                                                data = response.message;                                 
                                                $('#txt_precio_item').val(data.precio);
                                            }
                                        }, true);
                                    }, true); 
                                     //Descuentos.
                                    var arrParams = new Object();
                                    arrParams.unidada = $('#cmb_ninteres').val();
                                    arrParams.moda_id = $('#cmb_modalidad').val();
                                    arrParams.metodo = $('#cmb_metodos').val();
                                    arrParams.empresa_id = $('#cmb_empresa').val();
                                    arrParams.carrera_id = $('#cmb_carrera').val();
                                    arrParams.getdescuento = true;
                                    requestHttpAjax(link, arrParams, function (response) {
                                        if (response.status == "OK") {
                                            data = response.message;
                                            setComboData(data.descuento, "cmb_descuento");
                                        }
                                        //Precio con descuento.
                                        var arrParams = new Object();       
                                        arrParams.descuento_id = $('#cmb_descuento').val();                 
                                        arrParams.ite_id = $('#cmb_item').val();
                                        arrParams.getpreciodescuento = true;     
                                        requestHttpAjax(link, arrParams, function (response) {
                                            if (response.status == "OK") {
                                                data = response.message;
                                                $('#txt_precio_item2').val(data.preciodescuento);
                                            }
                                        }, true);      
                                    }, true);
                                }, true);                                                                
                            }
                        }
                    }, true);
                }
            }
        }, true);                
        //No mostrar el campo método ingreso cuando sea Unidad:Educación Continua.
        if (arrParams.empresa_id > 1) {
            $('#divMetodo').css('display', 'none');
            $('#divDocumento').css('display', 'none');
            $('#lbl_carrera').text('Programa');
        } else {
            $('#divMetodo').css('display', 'block');
            $('#divDocumento').css('display', 'block');
            $('#lbl_carrera').text('Carrera');
        }
    });
    
    $('#cmb_ninteres').change(function () {
        var link = $('#txth_base').val() + "/admision/solicitudes/new";
        var arrParams = new Object();
        arrParams.nint_id = $(this).val();
        arrParams.empresa_id = $('#cmb_empresa').val();
        arrParams.carrera_id = $('#cmb_carrera').val();
        arrParams.getmodalidad = true;        
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.modalidad, "cmb_modalidad");
                var arrParams = new Object();
                if (data.modalidad.length > 0) {
                    arrParams.unidada = $('#cmb_ninteres').val();
                    arrParams.moda_id = $('#cmb_modalidad').val();
                    arrParams.empresa_id = $('#cmb_empresa').val();
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
                 //Item.-
                var arrParams = new Object();
                arrParams.unidada = $('#cmb_ninteres').val();                                        
                arrParams.metodo = $('#cmb_metodos').val();        
                arrParams.moda_id = $('#cmb_modalidad').val();
                arrParams.carrera_id = $('#cmb_carrera').val();     
                arrParams.empresa_id = $('#cmb_empresa').val();
                arrParams.getitem = true;
                requestHttpAjax(link, arrParams, function (response) {
                    if (response.status == "OK") {
                        data = response.message;                        
                        setComboData(data.items, "cmb_item");
                    } 
                    //Precio.
                    var arrParams = new Object();
                    arrParams.ite_id = $('#cmb_item').val();
                    arrParams.getprecio = true;        
                    requestHttpAjax(link, arrParams, function (response) {
                        if (response.status == "OK") {
                            data = response.message;                                 
                            $('#txt_precio_item').val(data.precio);
                        }
                    }, true);                
                }, true);
                //Descuentos.
                var arrParams = new Object();
                arrParams.unidada = $('#cmb_ninteres').val();                
                arrParams.moda_id = $('#cmb_modalidad').val();
                arrParams.metodo = $('#cmb_metodos').val();
                arrParams.empresa_id = $('#cmb_empresa').val();
                arrParams.carrera_id = $('#cmb_carrera').val();
                arrParams.getdescuento = true;
                requestHttpAjax(link, arrParams, function (response) {
                    if (response.status == "OK") {
                        data = response.message;
                        setComboData(data.descuento, "cmb_descuento");
                    }
                    //Precio con descuento.
                    var arrParams = new Object();       
                    arrParams.descuento_id = $('#cmb_descuento').val();                 
                    arrParams.ite_id = $('#cmb_item').val();
                    arrParams.getpreciodescuento = true;     
                    requestHttpAjax(link, arrParams, function (response) {
                        if (response.status == "OK") {
                            data = response.message;
                            $('#txt_precio_item2').val(data.preciodescuento);
                        }
                    }, true);                   
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
        
    });

    $('#cmb_modalidad').change(function () {
        var link = $('#txth_base').val() + "/admision/solicitudes/new";
        var arrParams = new Object();
        arrParams.unidada = $('#cmb_ninteres').val();
        arrParams.moda_id = $(this).val();
        arrParams.empresa_id = $('#cmb_empresa').val();
        arrParams.getcarrera = true;
        arrParams.nint_id = $('#cmb_ninteres').val();
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.carrera, "cmb_carrera");
                var arrParams = new Object();
                arrParams.nint_id = $('#cmb_ninteres').val();             
                arrParams.getmetodo = true;
                requestHttpAjax(link, arrParams, function (response) {
                    if (response.status == "OK") {
                        data = response.message;
                        setComboData(data.metodos, "cmb_metodos");
                    }
                    //Item.-
                    var arrParams = new Object();               
                    arrParams.unidada = $('#cmb_ninteres').val();
                    arrParams.metodo = $('#cmb_metodos').val();        
                    arrParams.moda_id = $('#cmb_modalidad').val();
                    arrParams.carrera_id = $('#cmb_carrera').val();
                    arrParams.empresa_id = $('#cmb_empresa').val();
                    arrParams.getitem = true;
                    requestHttpAjax(link, arrParams, function (response) {
                        if (response.status == "OK") {
                            data = response.message;                            
                            setComboData(data.items, "cmb_item");               
                        } 
                        //Precio.        
                        var arrParams = new Object();
                        arrParams.ite_id = $('#cmb_item').val();
                        arrParams.getprecio = true;        
                        requestHttpAjax(link, arrParams, function (response) {
                            if (response.status == "OK") {
                                data = response.message;                                 
                                $('#txt_precio_item').val(data.precio);
                            }
                        }, true);            
                    }, true);   
                    //Descuentos.
                    var arrParams = new Object();        
                    arrParams.unidada = $('#cmb_ninteres').val();
                    arrParams.moda_id = $('#cmb_modalidad').val();
                    arrParams.metodo = $('#cmb_metodos').val();
                    arrParams.empresa_id = $('#cmb_empresa').val();
                    arrParams.carrera_id = $('#cmb_carrera').val();
                    arrParams.getdescuento = true;
                    requestHttpAjax(link, arrParams, function (response) {
                        if (response.status == "OK") {
                            data = response.message;
                            setComboData(data.descuento, "cmb_descuento");
                        }
                        //Precio con descuento.
                        var arrParams = new Object();       
                        arrParams.descuento_id = $('#cmb_descuento').val();                 
                        arrParams.ite_id = $('#cmb_item').val();
                        arrParams.getpreciodescuento = true;     
                        requestHttpAjax(link, arrParams, function (response) {
                            if (response.status == "OK") {
                                data = response.message;
                                $('#txt_precio_item2').val(data.preciodescuento);
                            }
                        }, true);      
                    }, true);    
                }, true);                  
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
    
    /***********************************************/
    /* Filtro para busqueda en listado solicitudes */
    /***********************************************/
    $('#cmb_unidadbus').change(function () {
        var link = $('#txth_base').val() + "/admision/solicitudes/index";
        document.getElementById("cmb_carrerabus").options.item(0).selected = 'selected';
        var arrParams = new Object();
        arrParams.nint_id = $(this).val();
        arrParams.getmodalidad = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;               
                setComboDataselect(data.modalidad, "cmb_modalidadbus", "Todos");
                var arrParams = new Object();
                if (data.modalidad.length > 0) {
                    arrParams.unidada = $('#cmb_unidadbus').val();
                    arrParams.moda_id = data.modalidad[0].id;
                    arrParams.getcarrera = true;
                    requestHttpAjax(link, arrParams, function (response) {
                        if (response.status == "OK") {
                            data = response.message;
                            setComboDataselect(data.carrera, "cmb_carrerabus", "Todos");                         
                        }
                    }, true);
                }
            }
        }, true);
    });
    $('#cmb_modalidadbus').change(function () {
        var link = $('#txth_base').val() + "/admision/solicitudes/index";
        //document.getElementById("cmb_unidadbus").options.item(0).selected = 'selected';
        var arrParams = new Object();
        arrParams.unidada = $('#cmb_unidadbus').val();
        arrParams.moda_id = $(this).val();
        arrParams.getcarrera = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;                
                setComboDataselect(data.carrera, "cmb_carrerabus", "Todos");
            }
        }, true);
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
            arrParams.condicioncerti = condicioncerti;
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
            if (len2 > 0) {
            arrParams.certi = 1;
            if (arrParams.observacion == "") {
                arrParams.observacion = obscerti;
            } else {
                arrParams.observacion = arrParams.observacion + "<br/>" + obscerti;
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
    
    $('#chk_certificado').change(function () {
        if ($('#chk_certificado').prop('checked')) {
            $('#Divcondcerti').css('visibility', 'visible');
        } else {
            $('#Divcondcerti').css('visibility', 'hidden');
        }
    });

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
        var link = $('#txth_base').val() + "/admision/solicitudes/new";
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
        //item.-
        var arrParams = new Object();
        arrParams.unidada = $('#cmb_ninteres').val();
        arrParams.metodo = $('#cmb_metodos').val();        
        arrParams.moda_id = $('#cmb_modalidad').val();      
        arrParams.empresa_id = $('#cmb_empresa').val();
        arrParams.getitem = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;                
                setComboData(data.items, "cmb_item");               
            } 
            //Precio.
            var arrParams = new Object();
            arrParams.ite_id = $('#cmb_item').val();
            arrParams.getprecio = true;        
            requestHttpAjax(link, arrParams, function (response) {
                if (response.status == "OK") {
                    data = response.message;                                 
                    $('#txt_precio_item').val(data.precio);
                }
            }, true);
        }, true);
        //Descuentos.
        arrParams.unidada = $('#cmb_ninteres').val();
        arrParams.moda_id = $('#cmb_modalidad').val();
        arrParams.metodo = $('#cmb_metodos').val();
        arrParams.empresa_id = $('#cmb_empresa').val();
        arrParams.carrera_id = $('#cmb_carrera').val();
        arrParams.getdescuento = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.descuento, "cmb_descuento");
            }            
            //Precio con descuento.
            var arrParams = new Object();       
            arrParams.descuento_id = $('#cmb_descuento').val();                 
            arrParams.ite_id = $('#cmb_item').val();
            arrParams.getpreciodescuento = true;     
            requestHttpAjax(link, arrParams, function (response) {
                if (response.status == "OK") {
                    data = response.message;
                    $('#txt_precio_item2').val(data.preciodescuento);
                }
            }, true);      
        }, true);        
    });
    
    $('#cmb_carrera').change(function () {
        var link = $('#txth_base').val() + "/admision/solicitudes/new";                
        //Carrera.-
        var arrParams = new Object();
        arrParams.unidada = $('#cmb_ninteres').val();
        arrParams.metodo = $('#cmb_metodos').val();        
        arrParams.moda_id = $('#cmb_modalidad').val();
        arrParams.carrera_id = $('#cmb_carrera').val();
        arrParams.empresa_id = $('#cmb_empresa').val();
        arrParams.getitem = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;                
                setComboData(data.items, "cmb_item");               
            } 
            //Precio.
            var arrParams = new Object();
            arrParams.ite_id = $('#cmb_item').val();
            arrParams.getprecio = true;        
            requestHttpAjax(link, arrParams, function (response) {
                if (response.status == "OK") {
                    data = response.message;                                 
                    $('#txt_precio_item').val(data.precio);
                }
            }, true);
        }, true);                  
        //Descuentos.
        var arrParams = new Object();
        arrParams.unidada = $('#cmb_ninteres').val();
        arrParams.moda_id = $('#cmb_modalidad').val();
        arrParams.metodo = $('#cmb_metodos').val();
        arrParams.empresa_id = $('#cmb_empresa').val();
        arrParams.carrera_id = $('#cmb_carrera').val();
        arrParams.getdescuento = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.descuento, "cmb_descuento");
            }
            //Precio con descuento.
            var arrParams = new Object();       
            arrParams.descuento_id = $('#cmb_descuento').val();                 
            arrParams.ite_id = $('#cmb_item').val();
            arrParams.getpreciodescuento = true;     
            requestHttpAjax(link, arrParams, function (response) {
                if (response.status == "OK") {
                    data = response.message;
                    $('#txt_precio_item2').val(data.preciodescuento);
                }
            }, true);      
        }, true);
    });

    $('#cmb_item').change(function () {
        var link = $('#txth_base').val() + "/admision/solicitudes/new";                        
        //Precio.
        var arrParams = new Object();       
        arrParams.ite_id = $('#cmb_item').val();
        arrParams.getprecio = true;        
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;                                 
                $('#txt_precio_item').val(data.precio);
            }
        }, true);
        //Precio con descuento.
        var arrParams = new Object();       
        arrParams.descuento_id = $('#cmb_descuento').val();                 
        arrParams.ite_id = $('#cmb_item').val();
        arrParams.getpreciodescuento = true;     
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                $('#txt_precio_item2').val(data.preciodescuento);
            }
        }, true);        
    });
    
    $('#cmb_descuento').change(function () {
        var link = $('#txth_base').val() + "/admision/solicitudes/new";                        
       //Precio con descuento.
        var arrParams = new Object();       
        arrParams.descuento_id = $('#cmb_descuento').val();                 
        arrParams.ite_id = $('#cmb_item').val();
        arrParams.getpreciodescuento = true;     
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                $('#txt_precio_item2').val(data.preciodescuento);
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

function exportExcel() {
    var search = $('#txt_buscarData').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    var estado = $('#cmb_estado option:selected').val();
    var unidad = $('#cmb_unidadbus option:selected').val();
    var modalidad = $('#cmb_modalidadbus option:selected').val();
    var carrera = $('#cmb_carrerabus option:selected').val();
    window.location.href = $('#txth_base').val() + "/admision/solicitudes/expexcelsolicitudes?search=" + search + "&f_ini=" + f_ini + "&f_fin=" + f_fin + "&estadoSol=" + estado + "&unidad=" + unidad + "&modalidad=" + modalidad + "&carrera=" + carrera;
}

function exportPdf() {
    var search = $('#txt_buscarData').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    var estado = $('#cmb_estado option:selected').val();
    var unidad = $('#cmb_unidadbus option:selected').val();
    var modalidad = $('#cmb_modalidadbus option:selected').val();
    var carrera = $('#cmb_carrerabus option:selected').val();
    window.location.href = $('#txth_base').val() + "/admision/solicitudes/exppdfsolicitudes?pdf=1&search=" + search + "&f_ini=" + f_ini + "&f_fin=" + f_fin + "&estadoSol=" + estado + "&unidad=" + unidad + "&modalidad=" + modalidad + "&carrera=" + carrera;
}

function actualizarGrid() {
    var search = $('#txt_buscarData').val();    
    var estadoSol = $('#cmb_estado option:selected').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    var unidad = $('#cmb_unidadbus option:selected').val();
    var modalidad = $('#cmb_modalidadbus option:selected').val();
    var carrera = $('#cmb_carrerabus option:selected').val();

    //Buscar almenos una clase con el nombre para ejecutar
    if (!$(".blockUI").length) {
        showLoadingPopup();
        $('#Tbg_Solicitudes').PbGridView('applyFilterData', {'f_ini': f_ini, 'f_fin': f_fin, 'search': search, 'estadoSol': estadoSol, 'unidad': unidad, 'modalidad': modalidad, 'carrera': carrera});
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
    arrParams.emp_id = $('#cmb_empresa').val();
    arrParams.nombres_fac = $('#txt_nombres_fac').val();
    arrParams.apellidos_fac = $('#txt_apellidos_fac').val();
    arrParams.dir_fac = $('#txt_dir_fac').val();
    arrParams.tel_fac = $('#txt_tel_fac').val();
    arrParams.tipo_DNI = $('input[name=opt_tipo_DNI]:radio').val();
    arrParams.dni_fac = $('#txt_dni_fac').val();
    arrParams.observacion = $('#txt_observacion').val();
    arrParams.ite_id = $('#cmb_item').val();    
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
    arrParams.arc_doc_certmat = $('#txth_doc_certificado').val();
    arrParams.arc_doc_curri = $('#txth_doc_hojavida').val();    
    arrParams.opcion = $('#txth_opcion').val();
    arrParams.uaca_id = $('#txth_uaca').val();
    arrParams.oserva = $('#txt_observa').val();
    if ($('input[name=opt_declara_si]:checked').val() == 1) {
        arrParams.beca = 1;
    } else {
        arrParams.beca = 0;
    }
    if (!validateForm()) {
        requestHttpAjax(link, arrParams, function (response) {
            showAlert(response.status, response.label, response.message);
            setTimeout(function () {
                if (arrParams.opcion == 1) {
                    window.location.href = $('#txth_base').val() + "/admision/solicitudes/listarsolicitudxinteresado?id=" + arrParams.interesado_id;
                } else {
                    window.location.href = $('#txth_base').val() + "/admision/solicitudes/index";
                }
            }, 5000);
        }, true);
    }
}
function UpdateDocumentos() {
    var link = $('#txth_base').val() + "/admision/solicitudes/updatedocumentos";
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
    arrParams.opcion = $('#txth_opcion').val();
    arrParams.uaca_id = $('#txth_uaca').val();
    arrParams.oserva = $('#txt_observa').val();
    if ($('input[name=opt_declara_si]:checked').val() == 1) {
        arrParams.beca = 1;
    } else {
        arrParams.beca = 0;
    }
    if (!validateForm()) {
        requestHttpAjax(link, arrParams, function (response) {
            showAlert(response.status, response.label, response.message);
            if (response.status == 'OK') {
                setTimeout(function () {
                    if (arrParams.opcion == 1) {
                        window.location.href = $('#txth_base').val() + "/admision/solicitudes/listarsolicitudxinteresado?id=" + arrParams.interesado_id;
                    } else {
                        window.location.href = $('#txth_base').val() + "/admision/solicitudes/index";
                    }
                }, 5000);
            }
        }, true);
    }
}
var condiciontitulo = new Array();
var condiciondni = new Array();
var condicioncerti = new Array();
var len = condiciontitulo.length;
var len1 = condiciondni.length;
var len2 = condicioncerti.length;
var obstitulo = "";
var obsdni = "";
var obscerti = "";

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
    //AQUI PARA CERTIFICADO VOTACION
    if ($('#chk_certificado').prop('checked')) {
        obscerti = $('#chk_certificado').attr('placeholder');
        if ($('#chk_concerti0').prop('checked')) {
            if (len2 == 0) {
                condicioncerti[0] = $('#txth_cond_certi0').val();
            } else {
                condicioncerti[len2] = $('#txth_cond_certi0').val();
            }
            len2 = len2 + 1;
        }
        if ($('#chk_concerti1').prop('checked')) {
            if (len2 == 0) {
                condicioncerti[0] = $('#txth_cond_certi1').val();
            } else {
                condicioncerti[len2] = $('#txth_cond_certi1').val();
            }
            len2 = len2 + 1;
        }
        if ($('#chk_concerti2').prop('checked')) {
            if (len2 == 0) {
                condicioncerti[0] = $('#txth_cond_certi2').val();
            } else {
                condicioncerti[len2] = $('#txth_cond_certi2').val();
            }
            len2 = len2 + 1;
        }
    }
}

//Guarda la Revisión final de solicitudes de inscripción.
function Approve() {
    var arrParams = new Object();
    var link = $('#txth_base').val() + "/admision/solicitudes/saverevision";

    arrParams.sins_id = $('#txth_sins_id').val();
    arrParams.int_id = $('#txth_int_id').val();
    arrParams.resultado = $('#cmb_revision').val();
    arrParams.observacion = $('#txt_observacion').val();
    arrParams.per_id = $('#txth_per_id').val();
    arrParams.estado_sol = $('#txth_rsin_id').val();
    arrParams.empresa = $('#txth_emp_id').val();
    arrParams.observarevisa = $('#txt_observarevi').val();
    
    if ($('#cmb_revision').val() == "4") {
        arreglo_check();
        arrParams.condicionestitulo = condiciontitulo;
        arrParams.condicionesdni = condiciondni;
        arrParams.condicioncerti = condicioncerti;
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
        if (len2 > 0) {
            arrParams.certi = 1;
            if (arrParams.observacion == "") {
                arrParams.observacion = obscerti;
            } else {
                arrParams.observacion = arrParams.observacion + "<br/>" + obscerti;
            }
        }
        
    }
    arrParams.banderapreaprueba = '0';
    if (!validateForm()) {
        requestHttpAjax(link, arrParams, function (response) {
            showAlert(response.status, response.label, response.message);
            if (response.status == "OK") {
                setTimeout(function () {
                    parent.window.location.href = $('#txth_base').val() + "/admision/solicitudes/index";
                }, 2000);
            }
        }, true);
    }
}
