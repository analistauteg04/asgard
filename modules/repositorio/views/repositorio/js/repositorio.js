/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {

    //$('#btn_AgregarItem').click(function () {
        //guardarItem();
        var dataItems = obtDataList();
        representarItems(dataItems);
    //});
});

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
            "  <tr><th>Función</th> <th>Componente</th> <th>Estándar</th> <th>Tipo</th> <th>Documento</th> <th>Fecha</th></tr>";
    total = 0;
    for (i = 0; i < dataItems.length; i++) {
        html += "<tr><td>" + dataItems[i]['funcion'] + "</td> <td>" + dataItems[i]['componente'] + "</td> <td>" + dataItems[i]['estandar'] + "</td> <td>" + dataItems[i]['tipo'] + "</td> <td>" + dataItems[i]['documento'] + "</td> <td>" + dataItems[i]['fecha'] +"</td><td><button type='button' class='btn btn-link' onclick='eliminaritem(" + dataItems[i]['item_id'] + ")'> <span class='glyphicon glyphicon-remove'></span> </button></td></tr>";
        //total = total + parseInt(dataItems[i]['precio'], 10);
    }
    html += "<tr height='40'><th></th><th></th><th></th><th></th><th></th><th></th></tr>";
    html += "</tbody>";
    html += "    </table>" + "</div>";
    $("#dataListItem").html(html);
}
