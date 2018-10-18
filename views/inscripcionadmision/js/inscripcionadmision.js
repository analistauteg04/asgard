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
        guardarInscripcion('Create');        

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
        if ($('#cmb_metodo_solicitud').val() == 3) {           
            $('#divCertificado').css('display', 'block');                        
        } else {
            $('#divCertificado').css('display', 'none');
            
        }
    }
    
    function Requisitos() {
        if ($('#cmb_metodo_solicitud').val() != 0) {            
            //Grado
            if  ($('#cmb_unidad_solicitud').val() == 1) {
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
            }  else {  //Posgrado  Semipresencial
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
    //if ($("#chk_mensaje2").prop("checked")) {
    if (true) {
        var ID = (accion == "Update") ? $('#txth_twin_id').val() : 0;
        var link = $('#txth_base').val() + "/inscripcionadmision/saveinscripciontemp";
        var arrParams = new Object();
        arrParams.DATA_1 = dataInscripPart1(ID);
        arrParams.ACCION = accion;
        if (!validateForm()) {
            requestHttpAjax(link, arrParams, function (response) {
                var message = response.message;
                if (response.status == "OK") {
                    //var data =response.data;
                    //AccionTipo=data.accion;
                    limpiarDatos();
                    var renderurl = $('#txth_base').val() + "/inscripciones/index";
                    window.location = renderurl;
                }     
                showAlert(response.status, response.label, response.message.info);       
            }, true);
        }
    } else {
        //alert('Debe Aceptar los términos de la Declaración Jurada');
        showAlert('NO_OK', 'error', {"wtmessage": objLang.Your_information_has_not_been_saved__Please_try_again_, "title":objLang.Error});
    }
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
    //objDat.pges_pasaporte = $('#txt_pasaporte').val();
    objDat.unidad_academica = $('#cmb_unidad_solicitud option:selected').val();
    objDat.modalidad = $('#cmb_modalidad_solicitud option:selected').val();
    objDat.ming_id = $('#cmb_metodo_solicitud option:selected').val();
    objDat.conoce = $('#cmb_conuteg option:selected').val();
    objDat.carrera = $('#cmb_carrera_solicitud option:selected').val();
    //objDat.arc_extranjero = $('#txth_extranjero').val();
    //objDat.arc_doc_beca = $('#txth_doc_beca').val();
    datArray[0] = objDat;
    sessionStorage.dataInscrip_1 = JSON.stringify(datArray);
    //return JSON.stringify(datArray);
    return datArray;
}


