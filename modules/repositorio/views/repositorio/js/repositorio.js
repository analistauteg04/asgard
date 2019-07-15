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
                setComboDataselect(data.funciones, "cmb_categoria", "Todos");
                var arrParams = new Object();                   
                arrParams.fun_id = $('#cmb_categoria').val();
                arrParams.get_componentes = true;
                requestHttpAjax(link, arrParams, function (response) {
                    if (response.status == "OK") {
                        data = response.message;                        
                        setComboDataselect(data.componentes, "cmb_componente", "Todos");
                        var arrParams = new Object();                   
                        arrParams.comp_id = $('#cmb_componente').val();
                        arrParams.fun_id = $('#cmb_categoria').val();
                        arrParams.get_estandares = true;
                        requestHttpAjax(link, arrParams, function (response) {
                            if (response.status == "OK") {
                                data = response.message;                        
                                setComboDataselect(data.estandares, "cmb_estandar", "Todos");
                            }
                        }, true);                   
                    }
                }, true);                 
            }
        }, true);        
    });
    
    $('#cmb_modelo_evi').change(function () {
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
                        setComboData(data.componentes, "cmb_componente");
                        var arrParams = new Object();                   
                        arrParams.comp_id = $('#cmb_componente').val();
                        arrParams.fun_id = $('#cmb_categoria').val();
                        arrParams.get_estandares = true;
                        requestHttpAjax(link, arrParams, function (response) {
                            if (response.status == "OK") {
                                data = response.message;                        
                                setComboData(data.estandares, "cmb_estandar");
                            }
                        }, true);                   
                    }
                }, true);                 
            }
        }, true);        
    });    
    
    $('#cmb_categoria').change(function () {
        var link = $('#txth_base').val() + "/repositorio/repositorio/index";
        var arrParams = new Object();                       
        arrParams.fun_id = $('#cmb_categoria').val();
        arrParams.get_componentes = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;                
                setComboDataselect(data.componentes, "cmb_componente", "Todos");
                var arrParams = new Object();                   
                arrParams.comp_id = $('#cmb_componente').val();
                arrParams.fun_id = $('#cmb_categoria').val();
                arrParams.get_estandares = true;
                requestHttpAjax(link, arrParams, function (response) {
                    if (response.status == "OK") {
                        data = response.message;                        
                        setComboDataselect(data.estandares, "cmb_estandar", "Todos");
                    }
                }, true);      
            }
        }, true);                       
    });
    
    $('#cmb_funcion_evi').change(function () {
        var link = $('#txth_base').val() + "/repositorio/repositorio/index";
        var arrParams = new Object();                       
        arrParams.fun_id = $('#cmb_categoria').val();
        arrParams.get_componentes = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;                
                setComboData(data.componentes, "cmb_componente");
                var arrParams = new Object();                   
                arrParams.comp_id = $('#cmb_componente').val();
                arrParams.fun_id = $('#cmb_categoria').val();
                arrParams.get_estandares = true;
                requestHttpAjax(link, arrParams, function (response) {
                    if (response.status == "OK") {
                        data = response.message;                        
                        setComboData(data.estandares, "cmb_estandar");
                    }
                }, true);      
            }
        }, true);                       
    });
    
    $('#cmb_componente').change(function () {
        var link = $('#txth_base').val() + "/repositorio/repositorio/index";
        var arrParams = new Object();                       
        arrParams.comp_id = $('#cmb_componente').val();
        arrParams.fun_id = $('#cmb_categoria').val();
        arrParams.get_estandares = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;                
                setComboDataselect(data.estandares, "cmb_estandar", "Todos");
            }
        }, true);     
    });    
    
    $('#cmb_componente_evi').change(function () {
        var link = $('#txth_base').val() + "/repositorio/repositorio/index";
        var arrParams = new Object();                       
        arrParams.comp_id = $('#cmb_componente').val();
        arrParams.fun_id = $('#cmb_categoria').val();
        arrParams.get_estandares = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;                
                setComboData(data.estandares, "cmb_estandar");
            }
        }, true);                       
    });
    
    $('#btn_buscarData').click(function () {
        actualizarGrid();
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

function actualizarGrid() {
    var search = $('#txt_buscarData').val();
    var f_ini = $('#txt_fecha_ini').val();
    var f_fin = $('#txt_fecha_fin').val();
    var modelo = $('#cmb_modelo').val();
    var categoria = $('#cmb_categoria').val(); 
    var componente = $('#cmb_componente').val(); 
    var estandar = $('#cmb_estandar').val(); 
    //Buscar almenos una clase con el nombre para ejecutar
    if (!$(".blockUI").length) {
        showLoadingPopup();
        $('#Tbg_Listar').PbGridView('applyFilterData', {'f_ini': f_ini, 'f_fin': f_fin, 'search': search, 'mod_id': modelo, 'cat_id': categoria, 'comp_id': componente, 'est_id': estandar});
        setTimeout(hideLoadingPopup, 2000);
    }
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
