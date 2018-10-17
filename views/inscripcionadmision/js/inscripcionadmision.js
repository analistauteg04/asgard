/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    // para mostrar codigo de area
    $('#cmb_pais_dom').change(function () {
        var link = $('#txth_base').val() + "/inscripciones/index";
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
        var link = $('#txth_base').val() + "/inscripciones/guardarinscripcionsolicitud";
        var arrParams = new Object();
        arrParams.pges_pri_nombre = $('#txt_primer_nombre').val();
        arrParams.pges_pri_apellido = $('#txt_primer_apellido').val();
        arrParams.tipo_dni = $('#cmb_tipo_dni option:selected').val();
        arrParams.pges_cedula = $('#txt_cedula').val();
        arrParams.pges_correo = $('#txt_correo').val();
        arrParams.pais = $('#cmb_pais_dom option:selected').val();
        arrParams.pges_celular = $('#txt_celular').val();
        arrParams.pges_pasaporte = $('#txt_pasaporte').val();
        arrParams.unidad_academica = $('#cmb_unidad_solicitud option:selected').val();
        arrParams.modalidad = $('#cmb_modalidad_solicitud option:selected').val();
        arrParams.ming_id = $('#cmb_metodo_solicitud option:selected').val();
        arrParams.conoce = $('#cmb_conuteg option:selected').val();
        arrParams.carrera = $('#cmb_carrera_solicitud option:selected').val();
        arrParams.arc_extranjero = $('#txth_extranjero').val();
        arrParams.arc_doc_beca = $('#txth_doc_beca').val();
        
        /*$('#paso2').attr('class','active');//disable
        $('#paso1').attr('class','');
        $('.nav-tabs a[href="#paso2"]').tab('show');*/
        
        $("a[data-href='#paso1']").attr('data-toggle', 'none');
        $("a[data-href='#paso1']").parent().attr('class', 'disabled');
        $("a[data-href='#paso1']").attr('data-href', $("a[href='#paso1']").attr('href'));
        $("a[data-href='#paso1']").removeAttr('href');
        $("a[data-href='#paso2']").attr('data-toggle', 'tab');
        $("a[data-href='#paso2']").attr('href', $("a[data-href='#paso2']").attr('data-href'));
        $("a[data-href='#paso2']").trigger("click");
            
        
        /*if (!validateForm()) {
            requestHttpAjax(link, arrParams, function (response) {
                showAlert(response.status, response.label, response.message);
                if (!response.error) {
                    
                    //setTimeout(function () {
                    //    window.location.href = $('#txth_base').val() + "/inscripcionadmision/index";
                    //}, 5000);
                }
            }, true);
        }*/

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
        var link = $('#txth_base').val() + "/inscripciones/indexadmisionn";
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
            }
        }, true);       
    });

    $('#cmb_modalidad_solicitud').change(function () {
        var link = $('#txth_base').val() + "/inscripciones/indexadmisionn";
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
    });
            
    $('#cmb_metodo_solicitud').change(function () {
        if ($('#cmb_metodo_solicitud').val() != 0) {      
            $('#divRequisitos').css('display', 'block');            
        } else {
            $('#divRequisitos').css('display', 'none');    
        }
        
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
        if ($('#cmb_metodo_solicitud').val() == 3) {           
            $('#divCertificado').css('display', 'block');                        
        } else {
            $('#divCertificado').css('display', 'none');
            
        }
    }
});


//INSERTAR DATOS
function guardarSolicitud(accion) {
    if ($("#chk_mensaje2").prop("checked")) {
        var ID = (accion == "Update") ? $('#txth_twin_id').val() : 0;
        var link = $('#txth_base').val() + "/inscripciones/saveinscripciontemp";
        var arrParams = new Object();
        arrParams.DATA_1 = dataSolicitudPart1(ID);
        arrParams.DATA_2 = dataSolicitudPart2();
        arrParams.DATA_3 = dataSolicitudPart3();
        arrParams.ACCION = accion;
        //Subir Imagenes

        var validation = validateForm();
        if (!validation) {
            //subirDocumentos(1, true);
            //subirDocumentos(2, true);
            requestHttpAjax(link, arrParams, function (response) {
                var message = response.message;
                if (response.status == "OK") {
                    //var data =response.data;
                    //$('#txth_ftem_id').val(data.ids); 
                    //AccionTipo=data.accion;
                    menssajeModal(response.status, response.type, message.info, response.label, "", "", "1");
                    limpiarDatos();
                    var renderurl = $('#txth_base').val() + "/inscripciones/index";
                    window.location = renderurl;
                }else{
                    menssajeModal(response.status, response.type, message.info, response.label, "", "", "1");
                }             
            }, true);
        }
    } else {
        //alert('Debe Aceptar los términos de la Declaración Jurada');
        showAlert('NO_OK', 'error', {"wtmessage": 'Debe Aceptar los términos de la Declaración Jurada', "title":'Información'});
    }
}


