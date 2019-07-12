/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {

    $('#btn_AgregarItem').click(function () {
        guardarItem();
        var dataItems = obtDataList();
        representarItems(dataItems);
    });
    
    $('#cmb_modelo').change(function () {
        var link = $('#txth_base').val() + "/repositorio/repositorio/index";
        var arrParams = new Object();
        arrParams.mod_id = $('#cmb_modelo').val();
        arrParams.get_funciones = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.funciones, "cmb_categoria");
                var arrParams = new Object();                   
                arrParams.fun_id = $('#cmb_categoria').val();
                arrParams.get_componentes = true;
                requestHttpAjax(link, arrParams, function (response) {
                    if (response.status == "OK") {
                        data = response.message;
                        alert('Ingresa');
                        setComboData(data.componentes, "cmb_componente");
                    }
                }, true);
                    /*var arrParams = new Object();
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
                                    // if ($('#cmb_ninteres').val()!=1) {
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
                                        //habilita y deshabilita control de precio.
                                        var arrParams = new Object();
                                        arrParams.ite_id = $('#cmb_item').val();
                                        arrParams.gethabilita = true;
                                        requestHttpAjax(link, arrParams, function (response) {
                                            if (response.status == "OK") {
                                                data = response.message;
                                                if (data.habilita == 1) {
                                                    $("#txt_precio_item").prop('disabled', false);
                                                } else {
                                                    $("#txt_precio_item").prop('disabled', true);
                                                }
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
                                    //  }
                                }, true);
                            }
                        }
                    }, true);
                }*/
            }
        }, true);        
    });
});

function guardarItem() {
    var funcion_id = $('#cmb_funcion').val();
    var componente_id = $('#cmb_componente').val();
    var estandar_id = $('#cmb_estandar option:selected').html();
    var tipo_id = $('#cmb_tipo').val();
    var nombre_imagen = $('#txth_docarchivo').val();
    var fecha_archivo = $('#txt_fecha_documento').val();
    var descripcion = $('#txt_descripcion').val();  
    
    
    var datalist = obtDataList();
    var dataitem = {
        funcion: funcion_id,  
        componente: componente_id,
        estandar: estandar_id,
        tipo: tipo_id,
        imagen: nombre_imagen,
        fecha: fecha_archivo,
        descripcion: descripcion
    }
    //if (!existeitem(item_id)) {
        //alert('Agrega al storage');
        datalist.push(dataitem);
        sessionStorage.setItem('datosItem', JSON.stringify(datalist));
    /*} else {
        var mensaje = {wtmessage: "El item ya se encuentra ingresado.", title: "Exito"};
        showAlert("OK", "success", mensaje);
    }*/
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

function representarItems(dataItems) {
    $("#dataListItem").html("");
    html = " <div class='grid-view'>" +
            "<table class='table table-striped table-bordered dataTable'>" +
            "<tbody>" +
            "  <tr><th>Función</th> <th>Componente</th><th>Estándar</th><th>Imagen</th><th>Tipo</th> <th>Documento</th> <th>Fecha</th></tr>";
    total = 0;
    for (i = 0; i < dataItems.length; i++) {
        html += "<tr><td>" + dataItems[i]['funcion'] + "</td> <td>" + dataItems[i]['componente'] + "</td> <td>" + dataItems[i]['estandar'] + "</td> <td>" + dataItems[i]['imagen'] + "</td> <td>" + dataItems[i]['tipo'] + "</td> <td>" + dataItems[i]['documento'] + "</td> <td>" + dataItems[i]['fecha'] +"</td><td><button type='button' class='btn btn-link' onclick='eliminaritem(" + dataItems[i]['item_id'] + ")'> <span class='glyphicon glyphicon-remove'></span> </button></td></tr>";
        //total = total + parseInt(dataItems[i]['precio'], 10);
    }
    html += "<tr height='40'><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>";
    html += "</tbody>";
    html += "    </table>" + "</div>";
    $("#dataListItem").html(html);
}
