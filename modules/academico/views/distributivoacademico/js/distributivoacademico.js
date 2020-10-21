$(document).ready(function() {
    recargarGridItem();
    $('#cmb_unidad_dis').change(function() {
        var link = $('#txth_base').val() + "/academico/distributivoacademico/new";
        var arrParams = new Object();
        arrParams.uaca_id = $(this).val();
        arrParams.getmodalidad = true;
        requestHttpAjax(link, arrParams, function(response) {
            if (response.status == "OK") {
                data = response.message;
                setComboDataselect(data.modalidad, "cmb_modalidad", "Todos");
                var arrParams = new Object();                                               
                if (data.modalidad.length > 0) {
                    let mod_id = data.modalidad[0].id;                    
                    arrParams.uaca_id = $('#cmb_unidad_dis').val();
                    arrParams.mod_id = mod_id;
                    arrParams.getjornada = true;
                    requestHttpAjax(link, arrParams, function(response) {
                        if (response.status == "OK") {
                            data = response.message;
                            setComboDataselect(data.jornada, "cmb_jornada", "Todos");
                            var arrParams = new Object();
                            if (data.jornada.length > 0) {
                                arrParams.uaca_id = $('#cmb_unidad_dis').val();
                                arrParams.mod_id = mod_id;
                                arrParams.jornada_id = data.jornada[0].id;
                                arrParams.gethorario = true;
                                requestHttpAjax(link, arrParams, function(response) {
                                    if (response.status == "OK") {
                                        data = response.message;
                                        setComboDataselect(data.horario, "cmb_horario", "Todos");
                                    }
                                }, true);
                            }
                        }
                    }, false);
                }//                                   
            }
        }, false);
    });
    
    $('#cmb_modalidad').change(function() {
        var link = $('#txth_base').val() + "/academico/distributivoacademico/new";
        var arrParams = new Object();       
        arrParams.mod_id = $(this).val(); 
        arrParams.getperiodo = true;
        requestHttpAjax(link, arrParams, function(response) {
            if (response.status == "OK") {
                    data = response.message;
                    setComboDataselect(data.periodo, "cmb_periodo", "Todos");
            }
        }, true);
        var arrParams = new Object();
        arrParams.uaca_id = $('#cmb_unidad_dis').val();
        arrParams.mod_id = $(this).val();        
        arrParams.getjornada = true;
        requestHttpAjax(link, arrParams, function(response) {
              if (response.status == "OK") {
                  data = response.message;
                  setComboDataselect(data.jornada, "cmb_jornada", "Todos");
                  var arrParams = new Object();
                  if (data.jornada.length > 0) {
                      arrParams.uaca_id = $('#cmb_unidad_dis').val();
                      arrParams.mod_id = $('#cmb_modalidad').val();
                      arrParams.jornada_id = data.jornada[0].id;
                      arrParams.gethorario = true;
                      requestHttpAjax(link, arrParams, function(response) {
                          if (response.status == "OK") {
                              data = response.message;
                              setComboDataselect(data.horario, "cmb_horario", "Todos");
                          }
                      }, true);
                  }
              }
        }, false);        
    });
       
    $('#cmb_jornada').change(function() {
        var link = $('#txth_base').val() + "/academico/distributivoacademico/new";
        var arrParams = new Object();
        arrParams.periodo_id = $('#cmb_periodo').val();
        arrParams.jornada_id = $(this).val();
        arrParams.getasignatura = true;
        requestHttpAjax(link, arrParams, function(response) {
            if (response.status == "OK") {
                data = response.message;
                setComboDataselect(data.asignatura, "cmb_materia", "Todos"); 
            }
        }, true);
        var arrParams = new Object();
        arrParams.uaca_id = $('#cmb_unidad_dis').val();
        arrParams.mod_id = $('#cmb_modalidad').val();
        arrParams.jornada_id = $(this).val();
        arrParams.gethorario = true;
        requestHttpAjax(link, arrParams, function(response) {
            if (response.status == "OK") {
                data = response.message;
                setComboDataselect(data.horario, "cmb_horario", "Todos");
            }
        }, true);           
    });

    $('#btn_buscarData_dist').click(function() {
        searchModules();
    });
    
    $('#cmb_tipo_asignacion').change(function () {
        document.getElementById("cmb_profesor").disabled=true;
        tipo = $('#cmb_tipo_asignacion').val();        
        if (tipo == 1) {
            $('#bloque1').css('display', 'block');            
            $('#bloque2').css('display', 'block');
            $('#bloque3').css('display', 'block');
            $('#bloque4').css('display', 'block');
        } else {
            $('#bloque1').css('display', 'none');            
            $('#bloque2').css('display', 'none');
            $('#bloque3').css('display', 'none');
            $('#bloque4').css('display', 'none');
        }
    });
        
});

// Recarga la Grid de Productos si Existe
function recargarGridItem() {
    var tGrid = 'TbG_Data';
    if (sessionStorage.grid_asignacion_list) {
        var arr_Grid = JSON.parse(sessionStorage.dts_asignacion_list);
        if (arr_Grid.length > 0) {
            $('#' + tGrid + ' > tbody').html("");
            for (var i = 0; i < arr_Grid.length; i++) {
                $('#' + tGrid + ' > tbody:last-child').append(retornaFila(i, arr_Grid, tGrid, true));
            }
        }
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

function searchModules() {
    var arrParams = new Object();
    arrParams.PBgetFilter = true;
    arrParams.search = $("#txt_buscarData").val();
    arrParams.unidad = $("#cmb_unidad_dis").val();
    arrParams.periodo = $("#cmb_periodo").val();
    arrParams.modalidad = $("#cmb_modalidad").val();
    arrParams.materia = $("#cmb_materia").val();
    arrParams.jornada = $("#cmb_jornada").val();
    $("#Tbg_Distributivo_Aca").PbGridView("applyFilterData", arrParams);
}

function showListStudents(id) {
    var link = $('#txth_base').val() + "/academico/distributivoestudiante/index/" + id;
    window.location = link;
}

function edit() {
    var link = $('#txth_base').val() + "/academico/distributivoacademico/edit" + "?id=" + $("#txth_ids").val();
    window.location = link;
}

function update() {
    var link = $('#txth_base').val() + "/academico/distributivoacademico/update";
    var arrParams = new Object();
    arrParams.id = $('#txth_ids').val();
    arrParams.profesor = $('#cmb_profesor').val();
    arrParams.unidad = $('#cmb_unidad_dis').val();
    arrParams.modalidad = $('#cmb_modalidad').val();
    arrParams.periodo = $('#cmb_periodo').val();
    arrParams.jornada = $('#cmb_jornada').val();
    arrParams.materia = $('#cmb_materia').val();
    arrParams.horario = $("#cmb_horario option:selected").text();
    if (!validateForm()) {
        requestHttpAjax(link, arrParams, function(response) {
            showAlert(response.status, response.label, response.message);
            if (response.status == "OK") {
                setTimeout(function() {
                    var link = $('#txth_base').val() + "/academico/distributivoacademico/index";
                    window.location = link;
                }, 1000);
            }
        }, true);
    }
}

function save() {
    var link = $('#txth_base').val() + "/academico/distributivoacademico/save";
    var arrParams = new Object();
    arrParams.profesor = $('#cmb_profesor').val();    
    arrParams.periodo = $('#txth_idperiodo').val();        
    /** Session Storage **/        
    if (sessionStorage.dts_asignacion_list) {
        var arr_Grid = JSON.parse(sessionStorage.dts_asignacion_list);
        if (arr_Grid.length > 0) {            
            arrParams.grid_docencia = sessionStorage.dts_asignacion_list;   
            if (!validateForm()) {
                requestHttpAjax(link, arrParams, function(response) {
                    showAlert(response.status, response.label, response.message);
                    if (response.status == "OK") {
                        loadSessionCampos('dts_asignacion_list', '', '', '');
                        setTimeout(function() {
                            var link = $('#txth_base').val() + "/academico/distributivocabecera/index";
                            window.location = link;
                        }, 1000);
                    }
                }, true);
            }
        } else {
            showAlert('NO_OK', 'error', {"wtmessage": "No Existe datos agregados", "title": 'Información'});
        }
    } else {
        showAlert('NO_OK', 'error', {"wtmessage": "No Existe datos agregados", "title": 'Información'});
    }    
}

function exportExcel() {
    var search = $('#txt_buscarData').val();
    var unidad = $('#cmb_unidad_dis').val();
    var modalidad = $('#cmb_modalidad').val();
    var periodo = $('#cmb_periodo').val();
    var asignatura = $('#cmb_materia').val();
    var jornada = $('#cmb_jornada').val();
    window.location.href = $('#txth_base').val() + "/academico/distributivoacademico/exportexcel?" +
        "search=" + search +
        "&unidad=" + unidad +
        "&modalidad=" + modalidad +
        "&periodo=" + periodo +
        "&asignatura=" + asignatura +
        "&jornada=" + jornada;
}

function exportPdf() {
    var search = $('#txt_buscarData').val();
    var unidad = $('#cmb_unidad_dis').val();
    var modalidad = $('#cmb_modalidad').val();
    var periodo = $('#cmb_periodo').val();
    var asignatura = $('#cmb_materia').val();
    var jornada = $('#cmb_jornada').val();
    window.location.href = $('#txth_base').val() + "/academico/distributivoacademico/exportpdf?pdf=1" +
        "&search=" + search +
        "&unidad=" + unidad +
        "&modalidad=" + modalidad +
        "&periodo=" + periodo +
        "&asignatura=" + asignatura +
        "&jornada=" + jornada;
}

/**  Asignación  **/
function addAsignacion(opAccion) {
    var tGrid = 'TbG_Data';
    var tasi_id = $("#cmb_tipo_asignacion").val();    
    if (tasi_id==1) {       
        var uni_id = $("#cmb_unidad_dis").val();            
        var mod_id = $("#cmb_modalidad").val();        
        var paca_id = $("#cmb_periodo").val();
        var jor_id = $("#cmb_jornada").val();
        var asi_id = $("#cmb_materia").val();        
        var hor_id = $("#cmb_horario").val();        
        var par_id = $("#cmb_paralelo").val();
        
        if (uni_id == 0 || mod_id == 0 || paca_id == 0 || jor_id == 0 || asi_id == 0 || hor_id == 0 || par_id == 0) {
            fillDataAlert();
            return;
        }
    }  
    
    if (opAccion != "edit") {
        //*********   Agregar materias *********
        var arr_Grid = new Array();
        if (sessionStorage.dts_asignacion_list) {
            /*Agrego a la Sesion*/
            arr_Grid = JSON.parse(sessionStorage.dts_asignacion_list);
            var size = arr_Grid.length;
            if (size > 0) {                
                arr_Grid[size] = objDistributivo(size);
                sessionStorage.dts_asignacion_list = JSON.stringify(arr_Grid);
                addVariosItem(tGrid, arr_Grid, -1);
                limpiarDetalle();               
            } else {
                /*Agrego a la Sesion*/
                //Primer Items                   
                arr_Grid[0] = objDistributivo(0);
                sessionStorage.dts_asignacion_list = JSON.stringify(arr_Grid);
                addPrimerItem(tGrid, arr_Grid, 0);
                limpiarDetalle();
            }
        } else {
            //No existe la Session
            //Primer Items
            arr_Grid[0] = objDistributivo(0);
            sessionStorage.dts_asignacion_list = JSON.stringify(arr_Grid);
            addPrimerItem(tGrid, arr_Grid, 0);
            limpiarDetalle();
        }
    } else {
        //data edicion
    }    
}

function objDistributivo(indice) {
    var rowGrid = new Object();
    rowGrid.indice = indice;   
    
    rowGrid.daca_id = 0;
    rowGrid.tasi_id = $("#cmb_tipo_asignacion").val();
    rowGrid.tasi_name = $("#cmb_tipo_asignacion :selected").text();
    if ($("#cmb_tipo_asignacion").val() == 1) {
        rowGrid.uni_id = $("#cmb_unidad_dis").val();    
        rowGrid.uni_name = $("#cmb_unidad_dis :selected").text();  
        rowGrid.mod_id = $("#cmb_modalidad").val();
        rowGrid.mod_name = $("#cmb_modalidad :selected").text();
        rowGrid.paca_id = $("#cmb_periodo").val();
        rowGrid.jor_id = $("#cmb_jornada").val();
        rowGrid.jor_name = $("#cmb_jornada :selected").text();
        rowGrid.asi_id = $("#cmb_materia").val();
        rowGrid.asi_name = $("#cmb_materia :selected").text();
        rowGrid.hor_id = $("#cmb_horario").val();
        rowGrid.hor_name = $("#cmb_horario :selected").text(); 
        rowGrid.par_id = $("#cmb_paralelo").val();
    } else {
        rowGrid.uni_id = $("#cmb_unidad_dis").val();    
        rowGrid.uni_name = 'N/A';
        rowGrid.mod_id = $("#cmb_modalidad").val();
        rowGrid.mod_name = 'N/A';
        rowGrid.paca_id = $("#cmb_periodo").val();
        rowGrid.jor_id = $("#cmb_jornada").val();
        rowGrid.jor_name = 'N/A';
        rowGrid.asi_id = $("#cmb_materia").val();
        rowGrid.asi_name = 'N/A';
        rowGrid.hor_id = $("#cmb_horario").val();
        rowGrid.hor_name = 'N/A';
        rowGrid.par_id = $("#cmb_paralelo").val();
    }
        
    //rowGrid.pro_otros = ($("#chk_otros").prop("checked")) ? 1 : 0;
    rowGrid.accion = "new";
    return rowGrid;
}

function addPrimerItem(TbGtable, lista, i) {
    /*Remuevo la Primera fila*/
    $('#' + TbGtable + ' >table >tbody').html("");
    /*Agrego a la Tabla de Detalle*/
    $('#' + TbGtable + ' tr:last').after(retornaFila(i, lista, TbGtable, true));
}

function addVariosItem(TbGtable, lista, i) {    
    i = ($('#' + TbGtable + ' tr').length) - 1;    
    $('#' + TbGtable + ' tr:last').after(retornaFila(i, lista, TbGtable, true));
}

function limpiarDetalle() {    
    //$('#cmb_unidad_dis option[value="0"]').attr("selected", true);    
    document.getElementById("cmb_unidad_dis").value = 0;
    document.getElementById("cmb_modalidad").value = 0;
    document.getElementById("cmb_periodo").value = 0;
    document.getElementById("cmb_jornada").value = 0;
    document.getElementById("cmb_materia").value = 0;
    document.getElementById("cmb_horario").value = 0;
    document.getElementById("cmb_paralelo").value = 0;            
}

function fillDataAlert() {
    var type = "alert";
    var label = "error";
    var status = "NO_OK";
    var messagew = {};
    messagew = {
        "wtmessage": "Llene todos los campos obligatorios",//objLang.Must_be_Fill_all_information_in_fields_with_label___,
        "title": objLang.Error,
        "acciones": [{
            "id": "btnalert",
            "class": "btn-primary clclass praclose",
            "value": objLang.Accept
        }],
    };
    showResponse(type, status, label, messagew);
}

function retornaFila(c, Grid, TbGtable, op) {
    //var RutaImagenAccion='ruta IMG'//$('#txth_rutaImg').val();
    var strFila = "";
    strFila += '<td style="display:none; border:none;">' + Grid[c]['indice'] + '</td>';    
    strFila += '<td style="display:none; border:none;">' + Grid[c]['daca_id'] + '</td>';    
    strFila += '<td>' + Grid[c]['tasi_name'] + '</td>';
    strFila += '<td>' + Grid[c]['asi_name'] + '</td>';
    strFila += '<td>' + Grid[c]['uni_name'] + '</td>';

    strFila += '<td style="display:none; border:none;">' + '</td>';
    strFila += '<td>' + Grid[c]['mod_name'] + '</td>';
    strFila += '<td style="display:none; border:none;">' + '</td>';    
    strFila += '<td>' + Grid[c]['jor_name'] + '</td>';
    strFila += '<td>' + Grid[c]['hor_name'] + '</td>';
    
    strFila += '<td>';//¿Está seguro de eliminar este elemento?   
    strFila += '<a onclick="eliminarItems(\'' + Grid[c]['indice'] + '\',\'' + TbGtable + '\')" ><span class="glyphicon glyphicon-trash"></span></a>';
    //<span class='glyphicon glyphicon-remove'></span>
    strFila += '</td>';

    if (op) {
        strFila = '<tr>' + strFila + '</tr>';
    }
    return strFila;
}

function eliminarItems(val, TbGtable) {
    var ids = "";
    //var count=0;
    if (sessionStorage.dts_asignacion_list) {
        var Grid = JSON.parse(sessionStorage.dts_asignacion_list);
        if (Grid.length > 0) {
            $('#' + TbGtable + ' tr').each(function () {
                ids = $(this).find("td").eq(0).html();               
                if (ids == val) {
                    var array = findAndRemove(Grid, 'indice', val);
                    sessionStorage.dts_asignacion_list = JSON.stringify(array);
                    //if (count==0){sessionStorage.removeItem('detalleGrid')} 
                    $(this).remove();
                }
            });
        }
    }
}

function findAndRemove(array, property, value) {
    for (var i = 0; i < array.length; i++) {
        if (array[i][property] == value) {
            array.splice(i, 1);
        }
    }
    return array;
}

