/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
 * 
 * @returns {voids}
 * Created: Kleber Loayza(kloayza@uteg.edu.ec)
 * date: Oct/23/18
 */
function habilitarSecciones() {
    var pais = $('#cmb_pais_dom').val();
    if (pais == 1) {
        $('#divCertvota').css('display', 'block');
    } else {
        $('#divCertvota').css('display', 'none');
    }
}
var itemList = [];
$(document).ready(function () {    
    // para mostrar codigo de area
    llenarDatosBen(obtDataBen());
    representarItems(obtDataList());
    var unisol = $('#cmb_unidad_solicitud').val();
    if (unisol == 1) {
        $('#divmetodocan').css('display', 'none');
    } else if (unisol == 2) {
        $('#divmetodocan').css('display', 'block');
    }
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
        habilitarSecciones();
        if ($('#txth_twin_id').val() == 0) {
            guardarInscripcion('Create', '1');
        } else {
            guardarInscripcion('Update', '1');
        }
    });
    $('#sendInformacionAspirante2').click(function () {
        var error = 0;
        var pais = $('#cmb_pais_dom').val();
        if ($("#chk_mensaje1").prop("checked") && $("#chk_mensaje2").prop("checked")) {
            error = 0;
        } else {
            var mensaje = {wtmessage: "Debe Aceptar los términos de la Información.", title: "Exito"};
            error++;
            showAlert("NO_OK", "success", mensaje);
        }
        if ($('#txth_doc_titulo').val() == "") {
            error++;
            var mensaje = {wtmessage: "Debe adjuntar título.", title: "Información"};
            showAlert("NO_OK", "error", mensaje);
        } else {
            if ($('#txth_doc_dni').val() == "") {
                error++;
                var mensaje = {wtmessage: "Debe adjuntar documento de identidad.", title: "Información"};
                showAlert("NO_OK", "error", mensaje);
            } else {
                if ($('#cmb_tipo_dni').val() == "CED") {
                    if (pais == 1) {
                        if ($('#txth_doc_certvota').val() == "") {
                            error++;
                            var mensaje = {wtmessage: "Debe adjuntar certificado de votación.", title: "Información"};
                            showAlert("NO_OK", "error", mensaje);
                        }
                    } else {
                        if ($('#txth_doc_foto').val() == "") {
                            error++;
                            var mensaje = {wtmessage: "Debe adjuntar foto.", title: "Información"};
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
            //alert($('#cmb_tipo_dni').val());

        }
        //alert(error);
        if (error == 0) {
            guardarInscripcion('Update', '2');
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
                showLoadingPopup();
                setTimeout(function () {
                    var uaca_id = parseInt(response.data.data.uaca_id);
                    var mod_id = parseInt(response.data.data.mod_id);
                    var ming = parseInt(response.data.data.twin_metodo_ingreso);
                    var sins_id = parseInt(response.data.dataext);
                    alert('solicitud:' + sins_id);
                    if ($('input[name=rdo_forma_pago_dinner]:checked').val() == 1) {
                        PagoDinners(sins_id);
                    } else {
                        switch (uaca_id) {
                            case 1:
                                switch (mod_id) {
                                    case 1: //online
                                        window.location.href = "https://www.uteg.edu.ec/pagos-grado-online/";
                                        break;
                                        //                                case 1:
                                        //                                    switch (ming) {
                                        //                                        case 1:
                                        //                                            $('#tx_paypal').attr("href", "https://www.uteg.edu.ec/pago-online-nivelacion/")
                                        //                                            $('#tx_paypal').val("https://www.uteg.edu.ec/pago-online-nivelacion/");
                                        //                                            window.location.href = "https://www.uteg.edu.ec/pago-online-nivelacion/";
                                        //                                            break;
                                        //                                        case 2:
                                        //                                            $('#tx_paypal').attr("href", "https://www.uteg.edu.ec/pago-examen-online/")
                                        //                                            $('#tx_paypal').val("https://www.uteg.edu.ec/pago-examen-online/");
                                        //                                            window.location.href = "https://www.uteg.edu.ec/pago-examen-online/";
                                        //                                            break;
                                        //                                    }
                                        //                                    break;
                                    case 2:// presencial
                                        window.location.href = "https://www.uteg.edu.ec/pago-grado-presencial/";
                                        break;
                                        //                                    switch (ming) {
                                        //                                        case 1:
                                        //                                            $('#tx_paypal').attr("href", "https://www.uteg.edu.ec/pago-grado-presencial/")
                                        //                                            $('#tx_paypal').val("https://www.uteg.edu.ec/pago-grado-presencial/");
                                        //                                            window.location.href = "https://www.uteg.edu.ec/pago-grado-presencial/";
                                        //                                            break;
                                        //                                        case 2:
                                        //                                            $('#tx_paypal').attr("href", "https://www.uteg.edu.ec/pago-examen-presencial/")
                                        //                                            $('#tx_paypal').val("https://www.uteg.edu.ec/pago-examen-presencial/");
                                        //                                            window.location.href = "https://www.uteg.edu.ec/pago-examen-presencial/";
                                        //                                            break;
                                        //                                    }
                                        break;
                                    case 3:// semipresencial
                                        window.location.href = "https://www.uteg.edu.ec/pago-grado-semipresencial/";
                                        //                                    switch (ming) {
                                        //                                        case 1:
                                        //                                            //alert('grado semipresencial curso');
                                        //                                            //Todavia no hay enlace para grado semipresencial curso
                                        //                                            break;
                                        //                                        case 2:
                                        //                                            //alert('grado semipresencial examen');
                                        //                                            //Todavia no hay enlace para grado semipresencial Examen
                                        //                                            break;
                                        //                                    }
                                        break;
                                    case 4: //distancia
                                        window.location.href = "https://www.uteg.edu.ec/pago-grado-distancia/";
                                        //                                    switch (ming) {
                                        //                                        case 1:
                                        //                                            $('#tx_paypal').attr("href", "https://www.uteg.edu.ec/pago-grado-distancia/")
                                        //                                            $('#tx_paypal').val("https://www.uteg.edu.ec/pago-grado-distancia/");
                                        //                                            window.location.href = "https://www.uteg.edu.ec/pago-grado-distancia/";
                                        //                                            break;
                                        //                                        case 2:
                                        //                                            $('#tx_paypal').attr("href", "https://www.uteg.edu.ec/pago-examen-distancia/")
                                        //                                            $('#tx_paypal').val("https://www.uteg.edu.ec/pago-examen-distancia/");
                                        //                                            window.location.href = "https://www.uteg.edu.ec/pago-examen-distancia/";
                                        //                                            break;
                                        //                                    }
                                        break;
                                }
                                break;
                            case 2:
                                $('#tx_paypal').attr("href", "https://www.uteg.edu.ec/pago-posgrado/")
                                $('#tx_paypal').val("https://www.uteg.edu.ec/pago-posgrado/");
                                window.location.href = "https://www.uteg.edu.ec/pago-posgrado/";
                                break;
                        }
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
        var unisol = $('#cmb_unidad_solicitud').val();
        if (unisol == 1) {
            $('#divmetodocan').css('display', 'none');
            $('#divRequisitosCANP').css('display', 'none');
            $('#divRequisitosCANSP').css('display', 'none');
            $('#divRequisitosCANAD').css('display', 'none');
            $('#divRequisitosCANO').css('display', 'none');
            $('#divRequisitosEXA').css('display', 'none');
            $('#divRequisitosPRP').css('display', 'none');
        } else if (unisol == 2) {
            $('#divmetodocan').css('display', 'block');
        }
        var link = $('#txth_base').val() + "/pagosfrecuentes/index";
        var arrParams = new Object();
        arrParams.nint_id = $(this).val();
        arrParams.getmodalidad = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.modalidad, "cmb_modalidad_solicitud");
                var arrParams = new Object();
                if (data.modalidad.length > 0) {
                    if (unisol == 2) {
                        var arrParams = new Object();
                        arrParams.nint_id = $('#cmb_unidad_solicitud').val();
                        arrParams.metodo = $('#cmb_metodo_solicitud').val();
                        arrParams.getmetodo = true;
                        requestHttpAjax(link, arrParams, function (response) {
                            if (response.status == "OK") {
                                data = response.message;
                                setComboData(data.metodos, "cmb_metodo_solicitud");
                                //Item.-
                                var arrParams = new Object();
                                arrParams.unidada = $('#cmb_unidad_solicitud').val();
                                arrParams.metodo = $('#cmb_metodo_solicitud').val();
                                arrParams.moda_id = $('#cmb_modalidad_solicitud').val();
                                arrParams.empresa_id = 1; // se coloca 1, porque solo se trabaja con uteg
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
                            }
                        }, true);
                    } else {
                        //Item.-
                        var arrParams = new Object();
                        arrParams.unidada = $('#cmb_unidad_solicitud').val();
                        arrParams.metodo = $('#cmb_metodo_solicitud').val();
                        arrParams.moda_id = $('#cmb_modalidad_solicitud').val();
                        arrParams.empresa_id = 1; // se coloca 1, porque solo se trabaja con uteg
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
                    }
                }
            }
        }, true);
    });
    $('#cmb_modalidad_solicitud').change(function () {
        var link = $('#txth_base').val() + "/pagosfrecuentes/index";
        var arrParams = new Object();
        arrParams.unidada = $('#cmb_unidad_solicitud').val();
        arrParams.metodo = $('#cmb_metodo_solicitud').val();
        arrParams.moda_id = $('#cmb_modalidad_solicitud').val();
        arrParams.carrera_id = $('#cmb_carrera_solicitud').val();
        arrParams.empresa_id = 1; // se coloca 1, porque solo se trabaja con uteg
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
    });
    $('#cmb_item').change(function () {
        var link = $('#txth_base').val() + "/pagosfrecuentes/index";
        var arrParams = new Object();
        arrParams.ite_id = $('#cmb_item').val();
        arrParams.getprecio = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                $('#txt_precio_item').val(data.precio);
            }
        }, true);
    });
    $('#rdo_forma_pago_dinner').change(function () {
        if ($('#rdo_forma_pago_dinner').val() == 1) {
            $("#rdo_forma_pago_otros").prop("checked", "");
        } else {
            $("#rdo_forma_pago_dinner").prop("checked", true);
        }
    });
    $('#rdo_forma_pago_otros').change(function () {
        if ($('#rdo_forma_pago_otros').val() == 2) {
            $("#rdo_forma_pago_dinner").prop("checked", "");
        } else {
            $("#rdo_forma_pago_otros").prop("checked", true);
        }
    });
    $('#btn_AgregarItem').click(function () {
        guardarItem();
        var dataItems = obtDataList();
        representarItems(dataItems);
    });    
    
    // tabs create
    $('#paso1next').click(function () {
        guardarBenPagoTemp();
        $("a[data-href='#paso1']").attr('data-toggle', 'none');
        $("a[data-href='#paso1']").parent().attr('class', 'disabled');
        $("a[data-href='#paso1']").attr('data-href', $("a[href='#paso1']").attr('href'));
        $("a[data-href='#paso1']").removeAttr('href');
        $("a[data-href='#paso2']").attr('data-toggle', 'tab');
        $("a[data-href='#paso2']").attr('href', $("a[data-href='#paso2']").attr('data-href'));
        $("a[data-href='#paso2']").trigger("click");
    });
    $('#paso2back').click(function () {
        llenarDatosBen(obtDataBen());
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
    $('#paso3next').click(function () {        
        guardarFacturaTemp();
        guardarPagos();
        $("a[data-href='#paso2']").attr('data-toggle', 'none');
        $("a[data-href='#paso2']").parent().attr('class', 'disabled');
        $("a[data-href='#paso2']").attr('data-href', $("a[href='#paso2']").attr('href'));
        $("a[data-href='#paso2']").removeAttr('href');
        $("a[data-href='#paso3']").attr('data-toggle', 'tab');
        $("a[data-href='#paso3']").attr('href', $("a[data-href='#paso3']").attr('data-href'));
        $("a[data-href='#paso3']").trigger("click");
    });
    
});
function llenarDatosBen(benData){
    if(benData['nombre'].length > 0){
        $('#txt_primer_nombre').val(benData['nombre']);
    }
    if(benData['apellido'].length > 0){
        $('#txt_primer_apellido').val(benData['apellido']);
    }
    if(benData['nombre'].length > 0){
        $('#txt_pasaporte').val(benData['pasaporte']);
    }
    if(benData['correo'].length > 0){
        $('#txt_correo').val(benData['correo']);
    }
    if(benData['celular'].length > 0){
        $('#txt_celular').val(benData['celular']);
    }
    if(benData['cedula'].length > 0){
        $('#txt_cedula').val(benData['cedula']);
    }
    if(benData['pais_id'].length > 0){
        $('#cmb_pais_dom').val(benData['pais_id']);
    }
}
function guardarBenPagoTemp(){
    var arrParams = new Object();
    arrParams.nombre = $('#txt_primer_nombre').val();
    arrParams.apellido = $('#txt_primer_apellido').val();
    arrParams.pasaporte = $('#txt_pasaporte').val();
    arrParams.correo = $('#txt_correo').val();
    arrParams.celular = $('#txt_celular').val();
    arrParams.pais_id = $('#cmb_pais_dom').val();  
    arrParams.cedula = $('#txt_cedula').val();
    sessionStorage.setItem('datosBen', JSON.stringify(arrParams));        
}

function guardarFacturaTemp(){
    var arrParams = new Object();
    arrParams.nombre_fac = $('#txt_nombres_fac').val();
    arrParams.apellidos_fac = $('#txt_apellidos_fac').val();
    arrParams.dir_fac = $('#txt_dir_fac').val();
    arrParams.telfono_fac = $('#txt_tel_fac').val();
    arrParams.tipo_dni_fac = $("input[name='opt_tipo_DNI']:checked").val();
    arrParams.dni_fac = $('#txt_dni_fac').val();
    arrParams.correo = $('#txt_correo').val();
    sessionStorage.setItem('datosFactura', JSON.stringify(arrParams));    
}

function guardarPagos() {  
    var dataBenList=[];
    var dataFacturaList= [];
    var link = $('#txth_base').val() + "/pagosfrecuentes/savepayment";
    var arrParams = new Object();
    var storedListBen = sessionStorage.getItem('datosBen');
    if (storedListBen == null) {
        dataBenList = [];
    } else {        
        dataBenList = JSON.parse(storedListBen);        
    }   
    var storedListFactura = sessionStorage.getItem('datosFactura');
    if (storedListFactura == null) {
        dataFacturaList = [];
    } else {
        dataFacturaList = JSON.parse(storedListFactura);        
    }     
    arrParams.dataBenList = dataBenList;
    arrParams.dataFacturaList = dataFacturaList;  
    arrParams.dataItems = itemList;    
    requestHttpAjax(link, arrParams, function (response) {
        showAlert("OK", "success", response.message);
        if (!response.error) {
                setTimeout(function () {
                    window.location.href = $('#txth_base').val() + "/pagosfrecuentes/index";
                }, 5000);
            }

    });
}
function getItemsIds() {
    var newList = [];
    var lstcurrent = obtDataList();
    for (i = 0; i < lstcurrent.length; i++) {
        newList.push(lstcurrent[i]['item_id']);
    }
    return JSON.stringify(newList);
}
function guardarItem() {
    var unidad_id = $('#cmb_unidad_solicitud').val();
    var unidad_txt = $('#cmb_unidad_solicitud option:selected').html();
    var modalidad_id = $('#cmb_modalidad_solicitud').val();
    var txt_modalidad = $('#cmb_modalidad_solicitud option:selected').html();
    var item_id = $('#cmb_item').val();
    var txt_item = $('#cmb_item option:selected').html();
    var txt_precio = $('#txt_precio_item').val();
    var datalist = obtDataList();
    var dataitem = {
        item_id: item_id,
        unidad_id: unidad_id,
        unidad: unidad_txt,
        modalidad_id: modalidad_id,
        modalidad: txt_modalidad,
        item: txt_item,
        precio: txt_precio
    }
    if (!existeitem(item_id)) {
        //alert('Agrega al storage');
        datalist.push(dataitem);        
        sessionStorage.setItem('datosItem', JSON.stringify(datalist));
    } else {
        var mensaje = {wtmessage: "El item ya se encuentra ingresado.", title: "Exito"};
        showAlert("OK", "success", mensaje);
    }
}
function existeitem(item_id) {
    var lstcurrent = obtDataList();
    for (i = 0; i < lstcurrent.length; i++) {
        if (lstcurrent[i]['item_id'] == item_id) {
            return true;
        }
    }
    return false;
}
function obtDataList() {
    var storedListItems = sessionStorage.getItem('datosItem');
    if (storedListItems === null) {
        itemList = [];
    } else {
        itemList = JSON.parse(storedListItems);
    }
    return itemList;
}
function obtDataBen() {
    var storedListBen = sessionStorage.getItem('datosBen');
    if (storedListBen === null) {
        benList = [];
    } else {
        benList = JSON.parse(storedListBen);
    }
    return benList;
}
function representarItems(dataItems) {
    $("#dataListItem").html("");
    html = " <div class='grid-view'>" +
            "<table class='table table-striped table-bordered dataTable'>" +
            "<tbody>" +
            "  <tr><th>Unidad Academica</th> <th>Modalidad</th> <th>Item</th> <th>Precio</th></tr>";
    var total = 0;
    for (i = 0; i < dataItems.length; i++) {
        html += "<tr><td>" + dataItems[i]['unidad'] + "</td> <td>" + dataItems[i]['modalidad'] + "</td> <td>" + dataItems[i]['item'] + "</td> <td>$" + dataItems[i]['precio'] + "</td><td><button type='button' class='btn btn-link' onclick='eliminaritem(" + dataItems[i]['item_id'] + ")'> <span class='glyphicon glyphicon-remove'></span> </button></td></tr>";
        total = total + parseInt(dataItems[i]['precio'], 10);
    }
    html += "<tr height='40'><th>Total</th><th></th><th></th><th>$" + total + "</th><th></th></tr>";
    html += "</tbody>";
    html += "    </table>" + "</div>";
    $("#dataListItem").html(html);
}
function eliminaritem(indice) {
    var tmp = JSON.parse(sessionStorage.getItem('datosItem'));
    var newArr = [];
    for (it = 0; it < parseInt(tmp.length); it++) {
        if (parseInt(tmp[it].item_id) !== parseInt(indice)) {
            newArr.push(tmp[it]);
        }
    }
    sessionStorage.setItem('datosItem', JSON.stringify(newArr));
    representarItems(obtDataList());
}
function sleep(milliseconds) {
    var start = new Date().getTime();
    for (var i = 0; i < 1e7; i++) {
        if ((new Date().getTime() - start) > milliseconds) {
            break;
        }
    }
}
function PagoDinners(solicitud) {
    var link = $('#txth_base').val() + "/pagosfrecuentes/savepagodinner";
    var arrParams = new Object();
    arrParams.sins_id = solicitud;
    alert('solicitud-proc:PagoDinner:' + solicitud);
    requestHttpAjax(link, arrParams, function (response) {
        var message = response.message;
        if (response.status == "OK") {
            showLoadingPopup();
            setTimeout(function () {
            }, 1000);
        }
    });
}
