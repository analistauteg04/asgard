 /*
 * It is released under the terms of the following BSD License.
 * Authors:
 * Diana Lopez <dlopez@uteg.edu.ec>, Grace Viteri <analistadesarrollo01@uteg.edu.ec>
 */
var familiarList = [];
var familiarInsList = [];
var EstudiosSupList = [];
var EstudiosActualesList = [];
var ReconocimientosList = [];
var IdiomasList = [];
var CapacitacionList = [];
var ExpLaboralList = [];
var ExpDocenciaList = [];
var InvestigacionList = [];
var PublicacionList = [];
var dataConPublicacion = [];
var CodireccionList = [];
var PonenciaList = [];

$(document).ready(function () {              
    $('#cmb_parentesco_cont_fam').append('<option value="0" selected="selected">Ninguno</option>');
    $('#cmb_parentesco_fam_ins').append('<option value="0" selected="selected">Ninguno</option>');
    
    var dataContFam = [];
    dataContFam = obtDataLSConFam();    
    if (dataContFam.length != 0) {
        paintListFamiliares(dataContFam);
    }

    /******************************** Familiares que vivan con usted ******************************/
    $('#btn_Agregar').click(function () {
        //Verificar que se registren los campos necesarios.
        var mensaje = "";
        if ($('#txt_nombres_contacto_fami').val() == "") {
            mensaje= "¡Ingrese los nombres!.";          
        }
        if ($('#txt_apellidos_contacto_fami').val() == "") {
            mensaje= "¡Ingrese los apellidos!.";         
        }
        if ($('#txt_fecha_nacimiento_fami').val() == "") {
            mensaje= "¡Ingrese fecha de nacimiento!.";            
        }
        if ($('#txtarea_ocupacion').val() == "") {
            mensaje= "¡Ingrese ocupación!.";            
        }        
        if ($('#check_fami_dis_ok').prop('checked')) {
            if ($('#txt_por_discapacidad_fam').val()=="") {
                mensaje= "¡Ingrese porcentaje de discapacidad!.";  
            }
            if ($('#txt_carnet_con').val()=="") {
                mensaje= "¡Ingrese carnet de conadis!.";  
            }
            if ($('#txth_doc_adj_disif').val()=="") {
                mensaje= "¡Adjunte imagen de conadis!.";  
            }
        }        
        if (mensaje != "") {
            alert(mensaje);
        } else {        
            familiarList = obtDataLSConFam();
            guardarLSConFam();
            dataContFam = obtDataLSConFam();
            paintListFamiliares(dataContFam);
            //Limpiar controles.
            $('#txt_nombres_contacto_fami').val("");
            $('#txt_apellidos_contacto_fami').val("");
            $('#txt_fecha_nacimiento_fami').val("");
            $('#txtarea_ocupacion').val("");
            $('#txt_por_discapacidad_fam').val("");
            $('#txt_carnet_con').val("");
            $('#txth_doc_adj_disif').val("");            
            document.getElementById("cmb_parentesco_cont_fam").value = '1';
            document.getElementById("cmb_tip_discap_fam").value = '1';
        }
    });
    function guardarLSConFam() {
        var txt_nom_con_fam = $('#txt_nombres_contacto_fami').val();
        var txt_ape_con_fam = $('#txt_apellidos_contacto_fami').val();
        var txt_fec_con_fam = $('#txt_fecha_nacimiento_fami').val();
        var cmb_par_con_fam = $('#cmb_parentesco_cont_fam').val();
        var combo_con_fam = document.getElementById("cmb_parentesco_cont_fam");
        var txt_com_fam = combo_con_fam.options[combo_con_fam.selectedIndex].text;
        var rdo_carga_fam = $('input:radio[name=carga]:checked').val();
        var txtarea_ocupacion = $('#txtarea_ocupacion').val();
        var txth_doc_adj_fami = $('#txth_doc_adj_fami').val();

        var rdo_dis_fam = "0";
        var txt_tip_discap_fam = "";
        if ($('#check_fami_dis_ok').prop('checked')) {
            rdo_dis_fam = "1";
            var cmb_tip_discap_fam = $('#cmb_tip_discap_fam').val();
            var combo_tip_dis = document.getElementById("cmb_tip_discap_fam");
            txt_tip_discap_fam = combo_tip_dis.options[combo_tip_dis.selectedIndex].text;
            var txt_por_discapacidad_fam = $('#txt_por_discapacidad_fam').val();
            var txt_carnet_con = $('#txt_carnet_con').val();
            var txth_doc_adj_disi = $('#txth_doc_adj_disif').val();
        }     
        var data = obtDataLSConFam();
        var longitud = (data.length)+1;
        
        var newFamiliar = {
            dafa_nombres: txt_nom_con_fam,
            dafa_apellidos: txt_ape_con_fam,
            dafa_fecha_nacimiento: txt_fec_con_fam,
            tpar_id: cmb_par_con_fam,
            dafa_carga_familiar: rdo_carga_fam,
            tdis_id: cmb_tip_discap_fam,
            idis_porcentaje: txt_por_discapacidad_fam,
            idis_carnet_conadis: txt_carnet_con,
            idis_ruta: txth_doc_adj_disi,
            dafa_ocupacion: txtarea_ocupacion,
            idis_discapacidad: rdo_dis_fam,
            txt_tip_discap_fam: txt_tip_discap_fam,
            des_parentesco: txt_com_fam,            
            dafa_clave: longitud,
            dafa_id: 0,
        }

        familiarList.push(newFamiliar);
        sessionStorage.setItem('datosFamiliares', JSON.stringify(familiarList));
    }
    
    /***********************************************************************************************/
    /****************************Familiar que trabaje en la Institucion*****************************/    
    var dataContFamIns = [];
    dataContFamIns = obtDataLSFamIns();
    paintListFamiliaresIns(dataContFamIns);

    if (dataContFamIns.length != 0) {
        paintListFamiliaresIns(dataContFamIns);
    }
    $('#btn_AgregarFamInsti').click(function () {
        //Verificar que se registren los campos necesarios.
        var mensaje = "";
        if ($('#txt_nombres_fam_ins').val() == "") {
            mensaje= "¡Ingrese los nombres!.";          
        }
        if ($('#txt_apellidos_fam_ins').val() == "") {
            mensaje= "¡Ingrese los apellidos!.";          
        }
        if (mensaje != "") {
            alert(mensaje);
        } else {
            familiarInsList = obtDataLSFamIns();
            guardarLSFamIns();
            dataContFamIns = obtDataLSFamIns();
            paintListFamiliaresIns(dataContFamIns);
            //Limpiar controles       
            $('#txt_nombres_fam_ins').val("");
            $('#txt_apellidos_fam_ins').val("");
            $('#txth_doc_faminst').val("");
            document.getElementById("cmb_parentesco_fam_ins").value = '1';
        }
    });
    
    function guardarLSFamIns() {
        var txt_nombres_fam_ins = $('#txt_nombres_fam_ins').val();
        var txt_apellidos_fam_ins = $('#txt_apellidos_fam_ins').val();
        var cmb_parentesco_fam_ins = $('#cmb_parentesco_fam_ins').val();
        var combo_fam_ins = document.getElementById("cmb_parentesco_fam_ins");
        var txt_fam_ins = combo_fam_ins.options[combo_fam_ins.selectedIndex].text;
        var txt_documento = "";//$('#txth_doc_faminst').val();
        var data = obtDataLSFamIns();
        var longitud = (data.length)+1;
                
        var newFamiliar = {
            dafa_nombres: txt_nombres_fam_ins,
            dafa_apellidos: txt_apellidos_fam_ins,
            tpar_id: cmb_parentesco_fam_ins,
            des_parentesco: txt_fam_ins,
            dafa_documento: txt_documento,
            dafa_clave: longitud,
            dafa_id: 0,
        }
        familiarInsList.push(newFamiliar);
        sessionStorage.setItem('datosFamiliaresIns', JSON.stringify(familiarInsList));
    }  
   /**********************************************************************************************/

    /*****************************Estudios Superiores**********************************************/
    var dataContEstSuperior = [];
    dataContEstSuperior = obtDataLSEstSuperior();
    paintListEstSuperior(dataContEstSuperior);

    if (dataContEstSuperior.length != 0) {
        paintListEstSuperior(dataContEstSuperior);
    }

    $('#btn_AgregarEstSuperior').click(function () {
        //Verificar que se registren los campos necesarios.
        var mensaje = "";
        var combo_institucion = document.getElementById('cmb_universidad_institucionsuper');
        var nombre_institucion = combo_institucion.options[combo_institucion.selectedIndex].text;
        if ($('#cmb_universidad_institucionsuper').val() == 0) {
            mensaje= "¡Seleccione institución!.";          
        }
        if ((nombre_institucion == "Otra") && ($('#txt_otrainstitucionsuper').val()=="")) {
            mensaje= "¡Ingrese nombre de institución!.";    
        }
        if ($('#txt_titulo').val() == "") {
            mensaje= "¡Ingrese título académico!.";          
        }
        if ($('#txt_fecha_registro').val() == "") {
            mensaje= "¡Ingrese fecha de registro!.";          
        }
        if ($('#txt_numero_registro').val() == "") {
            mensaje= "¡Ingrese número de registro!.";          
        }
        if ($('#txth_doc_adjs_titulo').val() == "") {
            mensaje= "¡Adjunte imagen de título académico!.";          
        }
        if (mensaje != "") {
            alert(mensaje);
        } else {
            EstudiosSupList = obtDataLSEstSuperior();
            guardarLSEstSuperior();
            dataContEstSuperior = obtDataLSEstSuperior();
            paintListEstSuperior(dataContEstSuperior);
            //Limpiar controles     
            document.getElementById("cmb_pais_super").value = '57';
            document.getElementById('cmb_universidad_institucionsuper').value = '1';
            document.getElementById('cmb_nivel_instru').value = '1';
            document.getElementById('cmb_area_conocimiento').value = '1';
            document.getElementById('cmb_subarea_conocimiento').value = '1';
            $('#txt_otrainstitucionsuper').val("");
            $('#txt_titulo').val("");
            $('#txt_fecha_registro').val("");
            $('#txt_numero_registro').val("");
            $('#txth_doc_adjs_titulo').val("");
        }
    });
    function guardarLSEstSuperior() {
        var nivel_instruccion = $('#cmb_nivel_instru').val();
        var combo_nivelins = document.getElementById('cmb_nivel_instru');
        var txt_nivelins = combo_nivelins.options[combo_nivelins.selectedIndex].text;

        var institucion = $('#cmb_universidad_institucionsuper').val();
        var combo_institucion = document.getElementById('cmb_universidad_institucionsuper');
        var nombre_institucion = combo_institucion.options[combo_institucion.selectedIndex].text;
        var otra_institucion = $('#txt_otrainstitucionsuper').val();
        var otra_ins = "0";
        if (nombre_institucion == 'Otra') {
            nombre_institucion = otra_institucion;
            otra_ins = "1";
        }

        var pais_id = $('#cmb_pais_super').val();
        var combo_pais = document.getElementById("cmb_pais_super");
        var txt_pais = combo_pais.options[combo_pais.selectedIndex].text;

        var titulo = $('#txt_titulo').val();
        var fecha_registro = $('#txt_fecha_registro').val();
        var numero_registro = $('#txt_numero_registro').val();
        var documento = $('#txth_doc_adjs_titulo').val();
        
        var area_id = $('#cmb_area_conocimiento').val();
        var subarea_id = $('#cmb_subarea_conocimiento').val();
        
        var data = obtDataLSEstSuperior();
        var longitud = (data.length)+1;
        
        var newEstSuperior = {
            dicu_nivel_ins: nivel_instruccion,
            dicu_nivel_des: txt_nivelins,
            dicu_institucion: institucion,
            dicu_nombre_institucion: nombre_institucion,
            dicu_otra_institucion: otra_institucion,
            dicu_pais_id: pais_id,
            dicu_des_pais: txt_pais,
            dicu_titulo: titulo,
            dicu_fecha_registro: fecha_registro,
            dicu_numero_registro: numero_registro,
            dicu_otra_ins: otra_ins,
            dicu_documento: documento,
            dicu_areacon: area_id,
            dicu_subareacon: subarea_id,
            dicu_clave: longitud,
            dicu_id: 0,
        }
        EstudiosSupList.push(newEstSuperior);
        sessionStorage.setItem('datosEstSuperior', JSON.stringify(EstudiosSupList));
    }   
    /*****************************Fin Estudios Superiores******************************************/
    /*******************************Estudios Actuales**********************************************/    
    var dataContEstActuales = [];
    dataContEstActuales = obtDataLSEstActual();
    paintListEstActual(dataContEstActuales);

    if (dataContEstActuales.length != 0) {
        paintListEstActual(dataContEstActuales);
    }

    $('#btn_AgregarEstActual').click(function () {
        //Verificar que se registren los campos necesarios.
        var mensaje = "";
        var combo_institucion = document.getElementById('cmb_universidad_institucionactual');
        var nombre_institucion = combo_institucion.options[combo_institucion.selectedIndex].text;
        if ($('#cmb_universidad_institucionactual').val() == 0) {
            mensaje= "¡Seleccione institución!.";          
        }
        if ((nombre_institucion == "Otra") && ($('#txt_otrainstitucionactual').val()=="")) {
            mensaje= "¡Ingrese nombre de institución!.";    
        }
        if ($('#txt_titulo_act').val() == "") {
            mensaje= "¡Ingrese título académico!.";          
        }
        if ($('#txt_fecha_ingreso').val() == "") {
            mensaje= "¡Ingrese fecha de ingreso!.";          
        }        
        if ($('#txth_doc_adj_actual').val() == "") {
            mensaje= "¡Adjunte imagen de estudio actual!.";          
        }
        if (mensaje != "") {
            alert(mensaje);
        } else {
            EstudiosActualesList = obtDataLSEstActual();
            guardarLSEstActual();
            dataContEstActuales = obtDataLSEstActual();
            paintListEstActual(dataContEstActuales);
            //Limpiar controles    
            document.getElementById('cmb_nivel_instru_act').value = '1';
            document.getElementById('cmb_universidad_institucionactual').value = '1';
            document.getElementById("cmb_pais_actual").value = '57';
            document.getElementById('cmb_area_conocimientoea').value = '1';
            document.getElementById('cmb_subarea_conocimientoea').value = '1';
            $('#txt_titulo_act').val("");
            $('#txt_fecha_ingreso').val("");
            $('#txth_doc_adj_actual').val("");
            $('#txt_otrainstitucionactual').val("");
        }
    });
    function guardarLSEstActual() {
        var nivel_instruccion = $('#cmb_nivel_instru_act').val();
        var combo_nivelins = document.getElementById('cmb_nivel_instru_act');
        var txt_nivelins = combo_nivelins.options[combo_nivelins.selectedIndex].text;

        var titulo = $('#txt_titulo_act').val();
        var fecha_ingreso = $('#txt_fecha_ingreso').val();
        var documento = $('#txth_doc_adj_actual').val();

        var institucion_act = $('#cmb_universidad_institucionactual').val();
        var combo_institucion = document.getElementById('cmb_universidad_institucionactual');
        var nombre_institucion_act = combo_institucion.options[combo_institucion.selectedIndex].text;

        var otra_institucion_act = $('#txt_otrainstitucionactual').val();
        var otra_ins_act = "0";
        if (nombre_institucion_act == 'Otra') {
            nombre_institucion_act = otra_institucion_act;
            otra_ins_act = "1";
        }
        var pais_id = $('#cmb_pais_actual').val();
        var combo_pais = document.getElementById("cmb_pais_actual");
        var txt_pais = combo_pais.options[combo_pais.selectedIndex].text;
        
        var area_id = $('#cmb_area_conocimientoea').val();
        var subarea_id = $('#cmb_subarea_conocimientoea').val();
        
        var data = obtDataLSEstActual();
        var longitud = (data.length)+1;
        
        var newEstActual = {
            dicu_nivel_ins: nivel_instruccion,
            dicu_nivel_des: txt_nivelins,
            dicu_institucion: institucion_act,
            dicu_nombre_institucion: nombre_institucion_act,
            dicu_otra_institucion: otra_institucion_act,
            dicu_pais_id: pais_id,
            dicu_des_pais: txt_pais,
            dicu_titulo: titulo,
            dicu_fecha_registro: fecha_ingreso,
            dicu_otra_ins: otra_ins_act,
            dicu_documento: documento,
            dicu_areacon: area_id,
            dicu_subareacon: subarea_id,
            dicu_clave: longitud,
            dicu_id: 0,
        }
        EstudiosActualesList.push(newEstActual);
        sessionStorage.setItem('datosEstActual', JSON.stringify(EstudiosActualesList));
    }
    /********************************Fin Estudios Actuales******************************************/

    /*******************************Reconocimientos*************************************************/    
    var dataContReconocimientos = [];
    dataContReconocimientos = obtDataLSReconocimiento();
    paintListReconocimiento(dataContReconocimientos);

    if (dataContReconocimientos.length != 0) {
        paintListReconocimiento(dataContReconocimientos);
    }

    $('#btn_AgregarReconocimiento').click(function () {
        //Verificar que se registren los campos necesarios.
        var mensaje = "";
        var combo_institucion = document.getElementById('cmb_universidad_reconocimiento');
        var nombre_institucion = combo_institucion.options[combo_institucion.selectedIndex].text;
        if ($('#cmb_universidad_reconocimiento').val() == 0) {
            mensaje= "¡Seleccione institución!.";          
        }
        if ((nombre_institucion == "Otra") && ($('#txt_otrainstitucionareconocimiento').val()=="")) {
            mensaje= "¡Ingrese nombre de institución!.";    
        }
        if ($('#txt_fecha_logro').val() == "") {
            mensaje= "¡Ingrese fecha del reconocimiento!.";          
        } else {
            var fecha = new Date();
            var anio = fecha.getFullYear();
            var fecharec = new Date($('#txt_fecha_logro').val());
            var aniorec = fecharec.getFullYear();
            if ((anio-aniorec)>5) {
                mensaje="¡Ingrese reconocimiento de los últimos cinco años!.";
            }
        }
        
        if ($('#txt_reconocimiento').val() == "") {
            mensaje= "¡Ingrese Reconocimiento otorgado!.";          
        }
        
        if (mensaje != "") {
            alert(mensaje);
        } else {
            ReconocimientosList = obtDataLSReconocimiento();
            guardarLSReconocimiento();
            dataContReconocimientos = obtDataLSReconocimiento();
            paintListReconocimiento(dataContReconocimientos);
            //Limpiar controles    
            $('#txt_reconocimiento').val("");
            $('#txt_fecha_logro').val("");
            $('#txt_otrainstitucionareconocimiento').val("");
            document.getElementById("cmb_pais_reconocimiento").value = '57';
            document.getElementById('cmb_universidad_reconocimiento').value = '1';
        }
    });    
    function guardarLSReconocimiento() {
        var reconocimiento = $('#txt_reconocimiento').val();
        var fecha_logro = $('#txt_fecha_logro').val();
        var institucion = $('#cmb_universidad_reconocimiento').val();
        var combo_institucion = document.getElementById('cmb_universidad_reconocimiento');
        var nombre_institucion = combo_institucion.options[combo_institucion.selectedIndex].text;

        var otra_institucion = $('#txt_otrainstitucionareconocimiento').val();
        var otra_ins = "0";
        if (nombre_institucion == 'Otra') {
            nombre_institucion = otra_institucion;
            otra_ins = "1";
        }

        var pais_id = $('#cmb_pais_reconocimiento').val();
        var combo_pais = document.getElementById("cmb_pais_reconocimiento");
        var txt_pais = combo_pais.options[combo_pais.selectedIndex].text;
        var data = obtDataLSReconocimiento();
        var longitud = (data.length)+1;
        
        var newReconocimiento = {
            dicu_titulo: reconocimiento,
            dicu_nombre_institucion: nombre_institucion,
            dicu_fecha_registro: fecha_logro,
            dicu_pais: pais_id,
            dicu_des_pais: txt_pais,
            dicu_institucion: institucion,
            dicu_otra_ins: otra_ins,
            dicu_clave: longitud,
            dicu_id: 0,
        }

        ReconocimientosList.push(newReconocimiento);
        sessionStorage.setItem('Reconocimiento', JSON.stringify(ReconocimientosList));
    }
    
    /********************************Fin Reconocimientos******************************************/
    /*******************************Idiomas*******************************************************/    
    var dataContIdiomas = [];
    dataContIdiomas = obtDataLSIdiomas();
    paintListIdiomas(dataContIdiomas);

    if (dataContIdiomas.length != 0) {
        paintListIdiomas(dataContIdiomas);
    }

    $('#btn_AgregarIdioma').click(function () {
        //Verificar que se registren los campos necesarios.
        var mensaje = "";
        var combo_idioma = document.getElementById('cmb_nombre_lenguaje');
        var nombre_idioma = combo_idioma.options[combo_idioma.selectedIndex].text;        
        if ((nombre_idioma == "Otro") && ($('#txt_otro_lenguaje').val()=="")) {
            mensaje= "¡Ingrese nombre del idioma!.";    
        }        
        if ($('#txt_insti_certifica').val() == "") {
            mensaje= "¡Ingrese institución que certifica su conocimiento!.";          
        }       
       
        var comprension_h = $('input[name=check_nivel_hablado]:checked').val();
        var comprension_e = $('input[name=check_nivel_escrito]:checked').val();
        var comprension_l = $('input[name=check_nivel_lectura]:checked').val();
        var comprension_a = $('input[name=check_nivel_auditiva]:checked').val();
        
        if (typeof(comprension_h) == "undefined") {        
            mensaje= "¡Indique el nivel de comprensión hablado del idioma!.";    
        }
        if (typeof(comprension_e) == "undefined") {        
            mensaje= "¡Indique el nivel de comprensión escrita del idioma!.";  
        }
        if (typeof(comprension_l) == "undefined") {        
            mensaje= "¡Indique el nivel de comprensión de lectura del idioma!.";  
        }
        if (typeof(comprension_a) == "undefined") {        
             mensaje= "¡Indique el nivel de comprensión auditiva del idioma!.";  
        }
        if ($('#txth_doc_idioma').val() == "") {
            mensaje= "¡Debe adjuntar certificado!.";      
        }
        
        if (mensaje != "") {
            alert(mensaje);
        } else {
            IdiomasList = obtDataLSIdiomas();
            guardarLSIdiomas();
            dataContIdiomas = obtDataLSIdiomas();
            paintListIdiomas(dataContIdiomas);
            //Limpiar controles.
            document.getElementById('cmb_nombre_lenguaje').value = '1';
            $('#txt_insti_certifica').val("");
            $('#txt_otro_lenguaje').val("");
            $('#txth_doc_idioma').val("");
            
            $("#check_nivel_1").prop("checked", "");
            $("#check_nivel_2").prop("checked", "");
            $("#check_nivel_3").prop("checked", "");
            $("#check_nivel_4").prop("checked", "");
            $("#check_nivel_5").prop("checked", "");
            $("#check_nivel_6").prop("checked", "");
            $("#check_nivel_7").prop("checked", "");
            $("#check_nivel_8").prop("checked", "");
            $("#check_nivel_9").prop("checked", "");
            $("#check_nivel_10").prop("checked", "");
            $("#check_nivel_11").prop("checked", "");
            $("#check_nivel_12").prop("checked", "");
        }
    });
    function guardarLSIdiomas() {
        var nombre_idioma = $('#cmb_nombre_lenguaje').val();
        var combo_idioma = document.getElementById('cmb_nombre_lenguaje');
        var txt_idioma = combo_idioma.options[combo_idioma.selectedIndex].text;

        var nombre_institucion = $('#txt_insti_certifica').val();
        var comprension_h = $('input[name=check_nivel_hablado]:checked').val();
        var comprension_e = $('input[name=check_nivel_escrito]:checked').val();
        var comprension_l = $('input[name=check_nivel_lectura]:checked').val();
        var comprension_a = $('input[name=check_nivel_auditiva]:checked').val();
        var documento = $('#txth_doc_idioma').val();
        
        var otro_lenguaje = $('#txt_otro_lenguaje').val();
        var olenguaje = "0";
        if (txt_idioma == 'Otro') {
            txt_idioma = otro_lenguaje;
            olenguaje = "1";
        } 
        
        var nivel_hablado = '';
        switch (comprension_h) {
            case '1':
                nivel_hablado = 'Básico';
                break;
            case '2':
                nivel_hablado = 'Intermedio';
                break;
            case '3':
                nivel_hablado = 'Avanzado';
                break;
            default:
                nivel_hablado = 'Ninguno';
        }

        var nivel_escrito = '';
        switch (comprension_e) {
            case '4':
                nivel_escrito = 'Básico';
                break;
            case '5':
                nivel_escrito = 'Intermedio';
                break;
            case '6':
                nivel_escrito = 'Avanzado';
                break;
            default:
                nivel_escrito = 'Ninguno';
        }

        var nivel_lectura = '';
        switch (comprension_l) {
            case '7':
                nivel_lectura = 'Básico';
                break;
            case '8':
                nivel_lectura = 'Intermedio';
                break;
            case '9':
                nivel_lectura = 'Avanzado';
                break;
            default:
                nivel_lectura = 'Ninguno';
        }

        var nivel_auditiva = '';
        switch (comprension_a) {
            case '10':
                nivel_auditiva = 'Básico';
                break;
            case '11':
                nivel_auditiva = 'Intermedio';
                break;
            case '12':
                nivel_auditiva = 'Avanzado';
                break;
            default:
                nivel_auditiva = 'Ninguno';
        }
        var data = obtDataLSIdiomas();
        var longitud = (data.length)+1;
        
        var newIdioma = {
            rxi_nombre_idioma: nombre_idioma,
            rxi_institucion: nombre_institucion,
            rxi_comprension_hablado: comprension_h,
            rxi_comprension_escrito: comprension_e,
            rxi_comprension_lectura: comprension_l,
            rxi_comprension_auditiva: comprension_a,
            rxi_nivel_hablado: nivel_hablado,
            rxi_nivel_escrito: nivel_escrito,
            rxi_nivel_lectura: nivel_lectura,
            rxi_nivel_auditiva: nivel_auditiva,
            rxi_des_idioma: txt_idioma,
            rxi_documento: documento,
            rxi_otro_lenguaje: olenguaje,
            rxi_clave: longitud,
            rxi_id: 0,
        }
        IdiomasList.push(newIdioma);
        sessionStorage.setItem('Idiomas', JSON.stringify(IdiomasList));
    }
        
    /********************************Fin Idiomas**************************************************/
    /*******************************Capacitaciones************************************************/    
    var dataContCapacitacion = [];
    dataContCapacitacion = obtDataLSCapacitacion();
    paintListCapacitacion(dataContCapacitacion);

    if (dataContCapacitacion.length != 0) {
        paintListCapacitacion(dataContCapacitacion);
    }

    $('#btn_AgregarCapacitacion').click(function () {
        //Verificar que se registren los campos necesarios.
        var mensaje = "";               
        if ($('#txt_inst_organiza').val() == "") {
            mensaje= "¡Ingrese institución que organiza!.";          
        }                      
        if ($('#txt_nombre_curso').val() == "") {
            mensaje= "¡Ingrese nombre del curso!.";      
        }
        if ($('#txt_duracion_hora').val() == "") {
            mensaje= "¡Ingrese duración en horas!.";      
        }       
        if ($('#fecha_iniciocap').val() == "") {
            mensaje= "¡Ingrese fecha inicial de capacitación!.";      
        }
        var actual = $('input[name=check_actualcapacitacion]:checked').val();
        if ((typeof(actual) == "undefined") && ($('#txt_fecha_fincap').val() == "")) {
            mensaje= "¡Ingrese fecha final de capacitación!.";
        }   
        
        if (($('#fecha_iniciocap').val() != "") && ($('#txt_fecha_fincap').val() != "")) {
            var fechaini = new Date($('#fecha_iniciocap').val());
            var fechafin = new Date($('#txt_fecha_fincap').val());
            if (fechaini > fechafin) {
                mensaje= "¡Fecha inicial no puede ser mayor a Fecha final de capacitación!.";
            }
            var fecha = new Date();
            var anio = fecha.getFullYear();            
            var aniocap = fechafin.getFullYear();
            if ((anio-aniocap)>5) {
                mensaje="¡La fecha de finalización del curso debe ser de los últimos cinco años!.";
            }
        }  
        //Cuando sólo se ha seleccionado fecha inicial
        if (($('#fecha_iniciocap').val() != "") && ($('#txt_fecha_fincap').val() == "") && (typeof(actual) != "undefined")) {
            var fechaini = new Date($('#fecha_iniciocap').val());            
            var fecha = new Date();
            var anio = fecha.getFullYear();            
            var aniocap = fechaini.getFullYear();
            if ((anio-aniocap)>5) {
                mensaje="¡La fecha de inicio del curso debe ser de los últimos cinco años!.";
            }
        }  
        /*if ($('#txth_doc_capacitacion').val() == "") {
            mensaje= "¡Adjunte certificado de capacitación!.";      
        } */ 
        if (mensaje != "") {
            alert(mensaje);
        } else {
            CapacitacionList = obtDataLSCapacitacion();
            guardarLSCapacitacion();
            dataContCapacitacion = obtDataLSCapacitacion();
            paintListCapacitacion(dataContCapacitacion);
            //Limpiar controles.        
            document.getElementById('cmb_tipo_curso').value = '8';
            document.getElementById('cmb_modalidad').value = '15';
            document.getElementById('cmb_tip_diploma').value = '4';
            $('#txt_inst_organiza').val("");
            $('#txt_nombre_curso').val("");
            $('#txt_duracion_hora').val("");
            $('#fecha_iniciocap').val("");
            $('#txt_fecha_fincap').val("");
            $('#txth_doc_capacitacion').val("");
            $("#check_actualcapacitacion").prop("checked", "");    
        }
    });
    function guardarLSCapacitacion() {
        var nombre_curso = $('#txt_nombre_curso').val();

        var tipo_curso = $('#cmb_tipo_curso').val();
        var combo_tipo_curso = document.getElementById('cmb_tipo_curso');
        var des_tipo_curso = combo_tipo_curso.options[combo_tipo_curso.selectedIndex].text;

        var modalidad = $('#cmb_modalidad').val();
        var combo_modalidad = document.getElementById('cmb_modalidad');
        var des_modalidad = combo_modalidad.options[combo_modalidad.selectedIndex].text;

        var nombre_institucion = $('#txt_inst_organiza').val();

        var tipo_diploma = $('#cmb_tip_diploma').val();
        var combo_tipo_diploma = document.getElementById('cmb_tip_diploma');
        var des_tipo_diploma = combo_tipo_diploma.options[combo_tipo_diploma.selectedIndex].text;

        var duracion = $('#txt_duracion_hora').val();
        var fecha_inicio = $('#fecha_iniciocap').val();
        var fecha_fin = $('#txt_fecha_fincap').val();
        var documento = $('#txth_doc_capacitacion').val();
        var actualidad = "0";
        if ($('#check_actualcapacitacion').prop('checked')) {
            actualidad = "1";
        }
        var data = obtDataLSCapacitacion();
        var longitud = (data.length)+1;
        
        var newCapacitacion = {
            cap_nombre_curso: nombre_curso,
            cap_tipo_curso: tipo_curso,
            cap_des_tipocurso: des_tipo_curso,
            cap_modalidad: modalidad,
            cap_des_modalidad: des_modalidad,
            cap_nombre_institucion: nombre_institucion,
            cap_tipo_diploma: tipo_diploma,
            cap_des_tipodiploma: des_tipo_diploma,
            cap_duracion: duracion,
            cap_fecha_inicio: fecha_inicio,
            cap_fecha_fin: fecha_fin,
            cap_actual: actualidad,
            cap_documento: documento,
            cap_clave: longitud,
            cap_id: 0,
        }
        CapacitacionList.push(newCapacitacion);
        sessionStorage.setItem('Capacitacion', JSON.stringify(CapacitacionList));
    }
    /********************************Fin Capacitaciones********************************************/

    /******************************* Experiencia Laboral********************************************/    
    var dataConExpLaboral = [];
    dataConExpLaboral = obtDataLSExpLaboral();
    paintListExpLaboral(dataConExpLaboral);

    if (dataConExpLaboral.length != 0) {
        paintListExpLaboral(dataConExpLaboral);
    }

    $('#btn_AgregarDataExpLab').click(function () {
        //Verificar que se registren los campos necesarios.
        var mensaje = "";               
        if ($('#txt_nombrecompania').val() == "") {
            mensaje= "¡Ingrese nombre de la empresa!.";          
        }                      
        if ($('#txt_cargo').val() == "") {
            mensaje= "¡Ingrese cargo de desempeño!.";      
        }          
        if ($('#txt_fecha_inicioexpl').val() == "") {
            mensaje= "¡Ingrese fecha inicio de labores!.";      
        }       
        var actual = $('input[name=check_actuallaboral]:checked').val();
        if ((typeof(actual) == "undefined") && ($('#txt_fecha_finexpl').val() == "")) {
            mensaje= "¡Ingrese fecha final de labores!.";
        }    
        if ($('#txt_inst_med').val() == "") {
            mensaje= "¡Ingrese teléfono de empresa!.";      
        }  
        if ($('#txt_inst_cont').val() == "") {
            mensaje= "¡Ingrese nombre del contacto de la empresa!.";      
        } 
        if ($('#txt_tlf_inst_cont').val() == "") {
            mensaje= "¡Ingrese teléfono del contacto de la empresa!.";      
        }                                     
        
        if (mensaje != "") {
            alert(mensaje);
        } else {                    
            ExpLaboralList = obtDataLSExpLaboral();
            guardarLSExpLaboral();
            dataConExpLaboral = obtDataLSExpLaboral();
            paintListExpLaboral(dataConExpLaboral);
            //Limpiar controles.        
            document.getElementById('cmb_pais_expl').value = '57';
            document.getElementById('cmb_tipo_compania').value = '1';
            $('#txt_nombrecompania').val("");
            $('#txt_cargo').val("");
            $('#txt_fecha_inicioexpl').val("");
            $('#txt_fecha_finexpl').val("");
            $('#txt_inst_med').val("");
            $('#txt_inst_cont').val("");
            $('#txt_tlf_inst_cont').val("");
            $("#check_actuallaboral").prop("checked", "");
        }
    });
    function guardarLSExpLaboral() {
        var rexplab = $('input:radio[name=rdo_laboralActual]:checked').val();

        var pais_expl = $('#cmb_pais_expl').val();
        var combo_paislb = document.getElementById('cmb_pais_expl');
        var txt_paislb = combo_paislb.options[combo_paislb.selectedIndex].text;

        var tipo_compania = $('#cmb_tipo_compania').val();
        var combo_tipocompania = document.getElementById('cmb_tipo_compania');
        var txt_tipocompania = combo_tipocompania.options[combo_tipocompania.selectedIndex].text;

        var institucion = $('#txt_nombrecompania').val();
        var cargo = $('#txt_cargo').val();
        var fechainicio = $('#txt_fecha_inicioexpl').val();
        var fechafin_expl = $('#txt_fecha_finexpl').val();
        var inst_med = $('#txt_inst_med').val();
        var inst_cont = $('#txt_inst_cont').val();
        var telefcont = $('#txt_tlf_inst_cont').val();
        var actualidad = "0";
        if ($('#check_actuallaboral').prop('checked')) {
            actualidad = "1";
        }
        var data = obtDataLSExpLaboral();
        var longitud = (data.length)+1;
        
        var newExpLaboral = {
            dela_empresa: institucion,
            dela_experiencia: rexplab,
            dela_pais: pais_expl,
            dela_des_pais: txt_paislb,
            dela_tipo_emp: tipo_compania,
            dela_des_emp: txt_tipocompania,
            dela_cargo: cargo,
            dela_fecha_inicio: fechainicio,
            dela_fecha_fin: fechafin_expl,
            dela_telef_contacto: telefcont,
            dela_nombre_contacto: inst_cont,
            dela_telef_empresa: inst_med,
            dela_actualidad: actualidad,
            dela_clave: longitud,
            dela_id: 0,
        }
        ExpLaboralList.push(newExpLaboral);
        sessionStorage.setItem('datosExpLaboral', JSON.stringify(ExpLaboralList));
    }
    /**************************** Fin Experiencia Laboral *******************************************/

    /******************************* Experiencia Docencia********************************************/    
    var dataConExpDocencia = [];
    dataConExpDocencia = obtDataLSExpDocencia();
    paintListExpDocencia(dataConExpDocencia);

    if (dataConExpDocencia.length != 0) {
        paintListExpDocencia(dataConExpDocencia);
    }

    $('#btn_AgregarDataExpDoc').click(function () {
         //Verificar que se registren los campos necesarios.
        var mensaje = "";             
        var combo_institucion = document.getElementById('cmb_universidad_institucion');
        var des_institucion = combo_institucion.options[combo_institucion.selectedIndex].text;
        if ($('#cmb_universidad_institucion').val() == 0) {
            mensaje= "¡Seleccione una institución!.";          
        }   
        if ((des_institucion=="Otra") && ($('#txt_otrainstitucion').val()=="")) {
            mensaje= "¡Ingrese nombre de la institución!.";          
        }
        if ($('#txt_direccion_expdocencia').val() == "") {
            mensaje= "¡Ingrese dirección de la institución!.";          
        }                      
        if ($('#txt_tlfono_expdocencia').val() == "") {
            mensaje= "¡Ingrese teléfono de la institución!.";      
        }  
        if ($('#txt_tlfono_expdocencia').val() == "") {
            mensaje= "¡Ingrese teléfono de la institución!.";      
        }          
        if ($('#txt_finicio_expdocencia').val() == "") {
            mensaje= "¡Ingrese fecha inicio de labores!.";      
        }       
        var actual = $('input[name=check_actualdocencia]:checked').val();
        if ((typeof(actual) == "undefined") && ($('#txt_ffin_expdocencia').val() == "")) {
            mensaje= "¡Ingrese fecha final de labores!.";
        }    
        if ($('#txt_contacto_expdocencia').val() == "") {
            mensaje= "¡Ingrese nombre del contacto de la institución!.";      
        } 
        if ($('#txt_tlfcontacto_expdocencia').val() == "") {
            mensaje= "¡Ingrese teléfono del contacto de la institución!.";      
        } 
        if (mensaje != "") {
            alert(mensaje);
        } else { 
            ExpDocenciaList = obtDataLSExpDocencia();
            guardarLSExpDocencia();
            dataConExpDocencia = obtDataLSExpDocencia();
            paintListExpDocencia(dataConExpDocencia);
            //Limpiar controles.
            document.getElementById('cmb_pais_expdoce').value = '57';
            document.getElementById('cmb_universidad_institucion').value = '0';
            document.getElementById('cmb_area_conocimientoed').value = '1';
            document.getElementById('cmb_tiempo_dedicacion').value = '10';
            document.getElementById('cmb_tipo_relacion').value = '13';
            document.getElementById('cmb_subarea_conocimientoed').value = '1';            
            //$('#txt_catedra_impartida').val("");
            $('#txt_direccion_expdocencia').val("");
            $('#txt_tlfono_expdocencia').val("");
            $('#txt_finicio_expdocencia').val("");
            $('#txt_ffin_expdocencia').val("");
            $('#txt_tlfcontacto_expdocencia').val("");
            $('#txt_contacto_expdocencia').val("");
            $('#txt_otrainstitucion').val("");
            $('#check_actualdocencia').prop("cheked","");
        }
    });
    function guardarLSExpDocencia() {           
        var rexpdoc = $('input:radio[name=check_expDocenciaOK]:checked').val();

        var pais_expdoc = $('#cmb_pais_expdoce').val();
        var combo_paisdoc = document.getElementById('cmb_pais_expdoce');
        var des_paisdoc = combo_paisdoc.options[combo_paisdoc.selectedIndex].text;

        var institucion = $('#cmb_universidad_institucion').val();
        var combo_institucion = document.getElementById('cmb_universidad_institucion');
        var des_institucion = combo_institucion.options[combo_institucion.selectedIndex].text;
        var otra_inst = "0";
        if (des_institucion == 'Otra') {
            des_institucion = $('#txt_otrainstitucion').val();
            otra_inst = "1";
        }

        var areaconocim = $('#cmb_area_conocimiento').val();
        var combo_areaconoc = document.getElementById('cmb_area_conocimientoed');
        var des_areaconoc = combo_areaconoc.options[combo_areaconoc.selectedIndex].text;

        var tiempo_dedica = $('#cmb_tiempo_dedicacion').val();
        var combo_tiempodedica = document.getElementById('cmb_tiempo_dedicacion');
        var des_tiempodedica = combo_tiempodedica.options[combo_tiempodedica.selectedIndex].text;

        var tipo_relacion = $('#cmb_tipo_relacion').val();
        var combo_tipo_relacion = document.getElementById('cmb_tipo_relacion');
        var des_tiporelacion = combo_tipo_relacion.options[combo_tipo_relacion.selectedIndex].text;

        var catedra = "";//$('#txt_catedra_impartida').val();
        var direccion = $('#txt_direccion_expdocencia').val();
        var telefono = $('#txt_tlfono_expdocencia').val();
        var fecha_inicio = $('#txt_finicio_expdocencia').val();
        var fecha_fin = $('#txt_ffin_expdocencia').val();
        var actual = "0";
        if ($('#check_actualdocencia').prop('checked')) {
            actual = "1";
        }
        var telef_contacto = $('#txt_tlfcontacto_expdocencia').val();
        var contacto = $('#txt_contacto_expdocencia').val();
        
        var subarea_id = $('#cmb_subarea_conocimientoed').val();
        
        var data = obtDataLSExpDocencia();
        var longitud = (data.length)+1;
        
        var newExpDocencia = {
            dedo_exp_docencia: rexpdoc,
            dedo_pais: pais_expdoc,
            dedo_institucion: institucion,
            dedo_des_institucion: des_institucion,
            dedo_areaconoc: areaconocim,
            dedo_des_areaconoc: des_areaconoc,
            dedo_catedra: catedra,
            dedo_tiempodedica: tiempo_dedica,
            dedo_des_tiempodedica: des_tiempodedica,
            dedo_tipo_relacion: tipo_relacion,
            dedo_direccion: direccion,
            dedo_telefono: telefono,
            dedo_fecha_inicio: fecha_inicio,
            dedo_fecha_fin: fecha_fin,
            dedo_actual: actual,
            dedo_telef_contacto: telef_contacto,
            dedo_contacto: contacto,
            otra_institucion: otra_inst,
            dedo_subareacon: subarea_id,
            dedo_clave: longitud,
            dedo_id:0,
        }
        ExpDocenciaList.push(newExpDocencia);
        sessionStorage.setItem('datosExpDocencia', JSON.stringify(ExpDocenciaList));
    }
    /******************************* Investigación ********************************************/    
    var dataConInvestigacion = [];
    dataConInvestigacion = obtDataLSInvestigacion();
    paintListInvestigacion(dataConInvestigacion);

    if (dataConInvestigacion.length != 0) {
        paintListInvestigacion(dataConInvestigacion);
    }

    $('#btn_AgregarInvestigacion').click(function () {
         //Verificar que se registren los campos necesarios.
        var mensaje = "";                     
        if ($('#txt_nombre_proyecto').val() == "") {
            mensaje= "¡Ingrese nombre del proyecto!.";          
        }                      
        if ($('#txt_responsabilidad').val() == "") {
            mensaje= "¡Ingrese responsable!.";      
        }  
        if ($('#txt_finicio_investigacion').val() == "") {
            mensaje= "¡Ingrese Fecha de Inicio!.";      
        }                      
        var actual = $('input[name=check_actualinvestigacion]:checked').val();
        if ((typeof(actual) == "undefined") && ($('#txt_ffin_investigacion').val() == "")) {
            mensaje= "¡Ingrese fecha fin de investigación!.";
        }    
        if ($('#txth_ddoc_investigacion').val() == "") {
            mensaje= "¡Adjunte documento de investigación!.";      
        } 
        if (mensaje != "") {
            alert(mensaje);
        } else { 
            InvestigacionList = obtDataLSInvestigacion();
            guardarLSInvestigacion();
            dataConInvestigacion = obtDataLSInvestigacion();
            paintListInvestigacion(dataConInvestigacion);
            //Limpiar controles.  
            document.getElementById('cmb_rol_proyecto').value = '24';                    
            $('#txt_nombre_proyecto').val("");
            $('#txt_institucion_financia').val("");
            $('#txt_finicio_investigacion').val("");
            $('#txt_ffin_investigacion').val("");
            $('#txth_ddoc_investigacion').val("");
            $("#check_actualinvestigacion").prop("checked", "");    
            $('#check_financiadaNOK').prop('checked');
        }
    });    

    function guardarLSInvestigacion() {
        var rinvestigacion = $('input:radio[name=check_investigacionOK]:checked').val();
        var proyecto = $('#txt_nombre_proyecto').val();
        
        var rolProyecto = $('#cmb_rol_proyecto').val();
        var combo_rolproyecto = document.getElementById('cmb_rol_proyecto');
        var des_rolproyecto = combo_rolproyecto.options[combo_rolproyecto.selectedIndex].text;
        
        var instfnancia = $('#txt_institucion_financia').val();
        var fecha_inicio = $('#txt_finicio_investigacion').val();
        var fecha_fin = $('#txt_ffin_investigacion').val();
        var documento = $('#txth_ddoc_investigacion').val();
        var ractual = "0";
        if ($('#check_actualinvestigacion').prop('checked')) {
            ractual = "1";
        }
        var rfinancia = "0";
        var des_financiada = "NO";
        if ($('#check_financiadaOK').prop('checked')) {
            rfinancia = "1";
            des_financiada = "SI";
        }
        var data = obtDataLSInvestigacion();
        var longitud = (data.length)+1;
        
        var newInvestigacion = {
            dinv_tiene_investigaciones: rinvestigacion,
            dinv_nombre_proyecto: proyecto,
            dinv_responsabilidad: rolProyecto,
            div_des_rolproyecto: des_rolproyecto,
            dinv_instfinancia: instfnancia,
            dinv_financia: rfinancia,
            dinv_des_financiada: des_financiada,
            dinv_fechainicio: fecha_inicio,
            dinv_fechafin: fecha_fin,
            dinv_actual: ractual,
            dinv_documento: documento,
            dinv_clave: longitud,
            dinv_id: 0,
        }
        InvestigacionList.push(newInvestigacion);
        sessionStorage.setItem('datosInvestigacion', JSON.stringify(InvestigacionList));
    }
        
    /********************************** Fin Investigación ***********************************************/

    /******************************* Publicación ********************************************/        
    dataConPublicacion = obtDataLSPublicacion();
    paintListPublicacion(dataConPublicacion);

    if (dataConPublicacion.length != 0) {
        paintListPublicacion(dataConPublicacion);
    }

    $('#btn_AgregarPublicacion').click(function () {
        //Verificar que se registren los campos necesarios.
        var mensaje = "";                     
        if ($('#txt_titulo_publicacion').val() == "") {
            mensaje= "¡Ingrese título de la publicación!.";          
        }                      
        var actual = $('input[name=check_procesopublica]:checked').val();
        if ((typeof(actual) == "undefined") && ($('#txt_fecha_publicacion').val() == "")) {
            mensaje= "¡Ingrese fecha de la publicación!.";
        }      
        if ($('#txt_nombrepublicacion').val() == "") {
            mensaje= "¡Ingrese nombre de publicación!.";      
        }  
        if (($('#cmb_publicadoen').val() == '6') && ( $('#txt_numero_issn').val()=="")){
            mensaje= "¡Ingrese número de ISSN!.";      
        }
        if (($('#cmb_publicadoen').val() == '7') && ( $('#txt_numero_isbn').val()=="")){
            mensaje= "¡Ingrese número de ISBN!.";      
        }
        if ($('#txt_url').val() == "") {
            mensaje= "¡Ingrese url!.";      
        }  
        if ($('#txth_doc_articulo').val() == "") {
            mensaje= "¡Adjunte documento de publicación!.";      
        }     

        if (mensaje != "") {
            alert(mensaje);
        } else {                   
            PublicacionList = obtDataLSPublicacion();
            guardarLSPublicacion();
            dataConPublicacion = obtDataLSPublicacion();
            paintListPublicacion(dataConPublicacion);
            //Limpiar controles.
            $('#txt_titulo_publicacion').val("");
            $('#txt_fecha_publicacion').val("");
            $('#check_procesopublica').prop('checked', '')
            $('#txt_nombrepublicacion').val("");
            $('#txt_url').val("");
            $('#txth_doc_articulo').val("");
            $('#txt_numero_issn').val("");
            $('#txt_numero_isbn').val("");
            //$('#check_acepta').prop('checked', '');
            document.getElementById('cmb_tipo_publicacion').value = '1';
            document.getElementById('cmb_publicadoen').value = '6';
        }
    });

    function guardarLSPublicacion() {
        var titulo = $('#txt_titulo_publicacion').val();
        var fecha_publicacion = $('#txt_fecha_publicacion').val();
        var proceso = "0";
        if ($('#check_procesopublica').prop('checked')) {
            proceso = "1";
        }
        var nombre_publicacion = $('#txt_nombrepublicacion').val();
        var url = $('#txt_url').val();
        var documento = $('#txth_doc_articulo').val();      
        var tipo_publicacion = $('#cmb_tipo_publicacion').val();
        var combo_tipo_publicacion = document.getElementById('cmb_tipo_publicacion');
        var des_tipopublicacion = combo_tipo_publicacion.options[combo_tipo_publicacion.selectedIndex].text;

        var publicacion = $('#cmb_publicadoen').val();
        var combo_publicacion = document.getElementById('cmb_publicadoen');
        var des_publicacion = combo_publicacion.options[combo_publicacion.selectedIndex].text;
        var numero = 0;
        if (publicacion == "6") {  //Revista
            numero = $('#txt_numero_issn').val();
        } else {  //Editorial
            numero = $('#txt_numero_isbn').val();
        }
        var data = obtDataLSPublicacion();
        var longitud = (data.length)+1;
        
        var newPublicacion = {
            dpub_tipo_publicacion: tipo_publicacion,
            dpub_des_tipopublicacion: des_tipopublicacion,
            dpub_publicacion: publicacion,
            dpub_des_publicacion: des_publicacion,
            dpub_titulo: titulo,
            dpub_fecha_publicacion: fecha_publicacion,
            dpub_nombre_publicacion: nombre_publicacion,
            dpub_numero_issn_isbn: numero,
            dpub_proceso: proceso,
            dpub_url: url,
            dpub_documento: documento,            
            dpub_clave: longitud,
            dpub_id: 0,
        }
        PublicacionList.push(newPublicacion);
        sessionStorage.setItem('datosPublicacion', JSON.stringify(PublicacionList));
    }    
    /********************************** Fin Publicación ***********************************************/


    /******************************* Codirección ********************************************/    
    var dataConCodireccion = [];
    dataConCodireccion = obtDataLSCodireccion();
    paintListCodireccion(dataConCodireccion);

    if (dataConCodireccion.length != 0) {
        paintListCodireccion(dataConCodireccion);
    }

    $('#btn_AgregarCodireccion').click(function () {
        //Verificar que se registren los campos necesarios.
        var mensaje = "";                     
        var combo_institucion = document.getElementById('cmb_universidad_institucionpublica');
        var des_institucion = combo_institucion.options[combo_institucion.selectedIndex].text;
        if ($('#cmb_universidad_institucionpublica').val() == 0) {
            mensaje= "¡Seleccione una institución!.";          
        }   
        if ((des_institucion=="Otra") && ($('#txt_otrainstitucionpublica').val()=="")) {
            mensaje= "¡Ingrese nombre de la institución!.";          
        }        
        if ($('#txt_publicaprobacion').val() == "") {
            mensaje= "¡Ingrese año de aprobación!.";      
        }                   
        if (mensaje != "") {
            alert(mensaje);
        } else {  
            CodireccionList = obtDataLSCodireccion();
            guardarLSCodireccion();
            dataConCodireccion = obtDataLSCodireccion();
            paintListCodireccion(dataConCodireccion);
            //Limpiar controles.
            document.getElementById('cmb_tipo_coodireccion').value = '19';
            document.getElementById('cmb_pais_publica').value = '57';
            document.getElementById('cmb_universidad_institucionpublica').value = '1';
            document.getElementById('cmb_area_conocimiento_dir').value = '1';
            $('#txt_otrainstitucionpublica').val("");
            $('#txt_publicaprobacion').val("");            
        }
    });   

    function guardarLSCodireccion() {
        var tipo_codireccion = $('#cmb_tipo_coodireccion').val();
        var combo_tipocodir = document.getElementById('cmb_tipo_coodireccion');
        var des_tipocodireccion = combo_tipocodir.options[combo_tipocodir.selectedIndex].text;

        var pais = $('#cmb_pais_publica').val();
        var combo_pais = document.getElementById('cmb_pais_publica');
        var des_pais = combo_pais.options[combo_pais.selectedIndex].text;

        var institucion = $('#cmb_universidad_institucionpublica').val();
        var combo_institucion = document.getElementById('cmb_universidad_institucionpublica');
        var des_institucion_codirec = combo_institucion.options[combo_institucion.selectedIndex].text;
        var otra_inst_codirec = "0";
        if (des_institucion_codirec == "Otra") {
            des_institucion_codirec = $('#txt_otrainstitucionpublica').val();
            otra_inst_codirec = "1";
        }
        var area_conoc = $('#cmb_area_conocimiento_dir').val();
        var combo_areacon = document.getElementById('cmb_area_conocimiento_dir');
        var des_areacon = combo_areacon.options[combo_areacon.selectedIndex].text;
        
        var anio_aprobacion = $('#txt_publicaprobacion').val();        
        var data = obtDataLSCodireccion();
        var longitud = (data.length)+1;
        
        var newCodireccion = {            
            itut_pais: pais,
            itut_des_pais: des_pais,
            itut_institucion_codirec: institucion,
            itut_otrainst_codireccion: otra_inst_codirec,
            itut_des_institucion: des_institucion_codirec,
            itut_anio_aprobacion: anio_aprobacion,
            itut_tipo_codireccion: tipo_codireccion,
            itut_des_tipocodireccion: des_tipocodireccion,
            acon_id: area_conoc,
            des_areacon: des_areacon,
            itut_clave: longitud,
            itut_id: 0,
        }
        CodireccionList.push(newCodireccion);
        sessionStorage.setItem('datosCodireccion', JSON.stringify(CodireccionList));
    }    
    /********************************** Fin Codirección ***********************************************/

    /************************************* Ponencia **************************************************/    
    var dataConPonencia = [];
    dataConPonencia = obtDataLSPonencia();
    paintListPonencia(dataConPonencia);

    if (dataConPonencia.length != 0) {
        paintListPonencia(dataConPonencia);
    }

    $('#btn_AgregarConferencia').click(function () {
        //Verificar que se registren los campos necesarios.
        var mensaje = "";                             
        
        if ($('#txt_institucionevento').val()=="") {
            mensaje= "¡Ingrese nombre de la institución!.";          
        }        
        if ($('#txt_nombrevento').val() == "") {
            mensaje= "¡Ingrese nombre del evento!.";      
        }              
        if ($('#txt_ponencia').val() == "") {
            mensaje= "¡Ingrese nombre de ponencia!.";      
        } 
        if ($('#txth_doc_ponencia').val() == "") {
            mensaje= "¡Ingrese evidencia de la conferencia.";      
        }
        if (mensaje != "") {
            alert(mensaje);
        } else {          
            PonenciaList = obtDataLSPonencia();
            guardarLSPonencia();
            dataConPonencia = obtDataLSPonencia();
            paintListPonencia(dataConPonencia);
            //Limpiar controles.
            $('#txt_nombrevento').val("");
            $('#txth_doc_ponencia').val("");
            document.getElementById('cmb_pais_evento').value = '57';            
            document.getElementById('cmb_area_conocimiento_conf').value = '1';
            document.getElementById('cmb_tipo_participacion').value = '27';
            $('#txt_institucionevento').val("");            
        }
    });

    function guardarLSPonencia() {
        var nombre_evento = $('#txt_nombrevento').val();
        var ponencia = $('#txt_ponencia').val();

        var pais_evento = $('#cmb_pais_evento').val();
        var combo_pais_evento = document.getElementById('cmb_pais_evento');
        var des_pais_evento = combo_pais_evento.options[combo_pais_evento.selectedIndex].text;

        var des_univ_evento = $('#txt_institucionevento').val();
                
        var areaConoc = $('#cmb_area_conocimiento_conf').val();
        var combo_areaCon = document.getElementById('cmb_area_conocimiento_conf');
        var des_areaCon = combo_areaCon.options[combo_areaCon.selectedIndex].text;
        
        var tipo_participacion = $('#cmb_tipo_participacion').val();
        var archivo = $('#txth_doc_ponencia').val();
        
        var data = obtDataLSPonencia();
        var longitud = (data.length)+1;
        
        var newPonencia = {            
            icon_pais: pais_evento,
            icon_des_pais: des_pais_evento,
            icon_institucion: des_univ_evento,                        
            icon_nombre_evento: nombre_evento,
            icon_ponencia: ponencia,
            acon_id: areaConoc,
            icon_des_areacon: des_areaCon,
            icon_tipo_participacion: tipo_participacion,
            icon_archivo: archivo,
            icon_clave: longitud,
            icon_id: 0,
        }
        PonenciaList.push(newPonencia);
        sessionStorage.setItem('datosPonencia', JSON.stringify(PonenciaList));
    }        
    /************************************* Fin Ponencia ***********************************************/

    /* Nacimiento */
    $('#cmb_pais_nac').change(function () {
        var link = $('#txth_base').val() + "/expedienteprofesor/create";
        var arrParams = new Object();
        arrParams.pai_id = $(this).val();
        arrParams.getpais = true;        
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;                  
                $('#txt_nacionalidad').val(data.nacion.nacionalidad);
            }
        },true);
                
        arrParams.getprovincias = true;
        arrParams.getarea = true;                  
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;                       
                setComboData(data.provincias, "cmb_prov_nac");
                var arrParams = new Object();
                if (data.provincias.length > 0) {                    
                    arrParams.prov_id = data.provincias[0].id;
                    arrParams.getcantones = true;
                    requestHttpAjax(link, arrParams, function (response) {
                        if (response.status == "OK") {
                            data = response.message;
                            setComboData(data.cantones, "cmb_ciu_nac");
                        }
                    }, true);
                }
            }
        }, true);     
        
        // actualizar codigo pais
        $("#lbl_codeCountry").text($("#cmb_pais_nac option:selected").attr("data-code"));
        $("#lbl_codeCountrycon").text($("#cmb_pais_nac option:selected").attr("data-code"));
        $("#lbl_codeCountrycell").text($("#cmb_pais_nac option:selected").attr("data-code"));       
    });

    $('#cmb_prov_nac').change(function () {
        var link = $('#txth_base').val() + "/expedienteprofesor/create";
        var arrParams = new Object();
        arrParams.prov_id = $(this).val();
        arrParams.getcantones = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.cantones, "cmb_ciu_nac");
            }
        }, true);
    });

    /* Domicilio */
    $('#cmb_pais_dom').change(function () {
        var link = $('#txth_base').val() + "/expedienteprofesor/create";
        var arrParams = new Object();
        arrParams.pai_id = $(this).val();
        arrParams.getprovincias = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.provincias, "cmb_prov_dom");
                var arrParams = new Object();
                if (data.provincias.length > 0) {
                    arrParams.prov_id = data.provincias[0].id;
                    arrParams.getcantones = true;
                    requestHttpAjax(link, arrParams, function (response) {
                        if (response.status == "OK") {
                            data = response.message;
                            setComboData(data.cantones, "cmb_ciu_dom");
                        }
                    }, true);
                }
            }
        }, true);
        // actualizar codigo pais   
        $("#lbl_codeCountrydom").text($("#cmb_pais_dom option:selected").attr("data-code"));
    });

    $('#cmb_prov_dom').change(function () {
        var link = $('#txth_base').val() + "/expedienteprofesor/create";
        var arrParams = new Object();
        arrParams.prov_id = $(this).val();
        arrParams.getcantones = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.cantones, "cmb_ciu_dom");
            }
        }, true);
    });

    /*pais experiencia laboral*/
    $('#cmb_pais_expl').change(function () {
        var link = $('#txth_base').val() + "/expedienteprofesor/create";
        var arrParams = new Object();
        arrParams.pai_id = $(this).val();
        arrParams.getprovincias = true;
        arrParams.getarea = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.provincias, "cmb_prov_expl");
                var arrParams = new Object();
                if (data.provincias.length > 0) {
                    arrParams.prov_id = data.provincias[0].id;
                    arrParams.getcantones = true;
                    requestHttpAjax(link, arrParams, function (response) {
                        if (response.status == "OK") {
                            data = response.message;
                            setComboData(data.cantones, "cmb_ciu_expl");
                        }
                    }, true);
                }

            }
        }, true);
        // actualizar codigo pais
        $("#lbl_codeCountryexpl").text($("#cmb_pais_expl option:selected").attr("data-code"));
        $("#lbl_codeCountryexpl1").text($("#cmb_pais_expl option:selected").attr("data-code"));
    });

    $('#cmb_prov_expl').change(function () {
        var link = $('#txth_base').val() + "/expedienteprofesor/create";
        var arrParams = new Object();
        arrParams.prov_id = $(this).val();
        arrParams.getcantones = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.cantones, "cmb_ciu_expl");
            }
        }, true);
    });
    
    /***************filtra universidades segun pais **********************/
    $('#cmb_pais_expdoce').change(function () {
        var link = $('#txth_base').val() + "/expedienteprofesor/create";
        var arrParams = new Object();
        arrParams.pai_id = $(this).val();
        arrParams.getinstituto = true;
        $("#txt_otrainstitucion").attr('disabled', 'disabled');
        $("#txt_otrainstitucion").val('');
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.instituto, "cmb_universidad_institucion");
                $('#cmb_universidad_institucion').append('<option value="0" selected="selected">Seleccionar</option>');
                $('#cmb_universidad_institucion').append('<option value="-1">Otra</option>');
            }
        }, true);
        // actualizar codigo pais
        $("#lbl_codeCountryexpdoce").text($("#cmb_pais_expdoce option:selected").attr("data-code"));
        $("#lbl_codeCountryexpdocecont").text($("#cmb_pais_expdoce option:selected").attr("data-code"));
    });

    //Control de otra univeridad o instituto
    $('#cmb_universidad_institucion').change(function () {
        var combo_institucion = document.getElementById('cmb_universidad_institucion');
        var des_institucion = combo_institucion.options[combo_institucion.selectedIndex].text;
        if (des_institucion == 'Otra') {
            $("#txt_otrainstitucion").removeAttr("disabled");
            $("#txt_otrainstitucion").val('');
        } else
        {
            $("#txt_otrainstitucion").attr('disabled', 'disabled');            
            $("#txt_otrainstitucion").val('');
        }
    });

    /***************filtra universidades segun pais en estudios superiores**********************/
    $('#cmb_pais_super').change(function () {
        var link = $('#txth_base').val() + "/expedienteprofesor/create";
        var arrParams = new Object();
        arrParams.pai_id = $(this).val();
        arrParams.getinstituto = true;
        $("#txt_otrainstitucionsuper").attr('disabled', 'disabled');
        $("#txt_otrainstitucionsuper").val('');
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.instituto, "cmb_universidad_institucionsuper");
                $('#cmb_universidad_institucionsuper').append('<option value="0" selected="selected">Seleccionar</option>');
                $('#cmb_universidad_institucionsuper').append('<option value="-1">Otra</option>');
                //$('select option[value="0"]').attr("selected", true);
            }
        }, true);
    });

    //Control de otra univeridad o instituto superior
    /***************filtra universidades segun pais en estudios superiores**********************/
    $('#cmb_universidad_institucionsuper').change(function () {
        var combo_institucion = document.getElementById('cmb_universidad_institucionsuper');
        var des_institucion = combo_institucion.options[combo_institucion.selectedIndex].text;
        if (des_institucion == 'Otra') {
            $("#txt_otrainstitucionsuper").removeAttr("disabled");
            $("#txt_otrainstitucionsuper").val('');
        } else
        {
            $("#txt_otrainstitucionsuper").attr('disabled', 'disabled');            
            $("#txt_otrainstitucionsuper").val('');
        }      
    });

    /***************filtra universidades segun pais en estudios actuales**********************/
    $('#cmb_pais_actual').change(function () {
        var link = $('#txth_base').val() + "/expedienteprofesor/create";
        var arrParams = new Object();
        arrParams.pai_id = $(this).val();
        arrParams.getinstituto = true;
        $("#txt_otrainstitucionactual").attr('disabled', 'disabled');
        $("#txt_otrainstitucionactual").val('');
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.instituto, "cmb_universidad_institucionactual");
                $('#cmb_universidad_institucionactual').append('<option value="0" selected="selected">Seleccionar</option>');
                $('#cmb_universidad_institucionactual').append('<option value="-1">Otra</option>');
            }
        }, true);
    });

    //Control de otra univeridad o instituto actual
    $('#cmb_universidad_institucionactual').change(function () {
        var combo_institucion = document.getElementById('cmb_universidad_institucionactual');
        var des_institucion = combo_institucion.options[combo_institucion.selectedIndex].text;
        if (des_institucion == 'Otra') {
            $("#txt_otrainstitucionactual").removeAttr("disabled");
            $("#txt_otrainstitucionactual").val('');
        } else
        {
            $("#txt_otrainstitucionactual").attr('disabled', 'disabled');            
            $("#txt_otrainstitucionactual").val('');
        }       
    });

    /***************filtra universidades segun pais en reaconocimientos**********************/
    $('#cmb_pais_reconocimiento').change(function () {
        var link = $('#txth_base').val() + "/expedienteprofesor/create";
        var arrParams = new Object();
        arrParams.pai_id = $(this).val();
        arrParams.getinstituto = true;
        $("#txt_otrainstitucionareconocimiento").attr('disabled', 'disabled');
        $("#txt_otrainstitucionareconocimiento").val('');
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.instituto, "cmb_universidad_reconocimiento");
                $('#cmb_universidad_reconocimiento').append('<option value="0" selected="selected">Seleccionar</option>');
                $('#cmb_universidad_reconocimiento').append('<option value="-1">Otra</option>');
            }
        }, true);
    });

    //Control de otra univeridad en reconocimientos
    $('#cmb_universidad_reconocimiento').change(function () {
        var combo_institucion = document.getElementById('cmb_universidad_reconocimiento');
        var des_institucion = combo_institucion.options[combo_institucion.selectedIndex].text;
        if (des_institucion == 'Otra') {
            $("#txt_otrainstitucionareconocimiento").removeAttr("disabled");
            $("#txt_otrainstitucionareconocimiento").val('');
        } else
        {
            $("#txt_otrainstitucionareconocimiento").attr('disabled', 'disabled');            
            $("#txt_otrainstitucionareconocimiento").val('');
        }
    });

    $('#cmb_prov_expdoce').change(function () {
        var link = $('#txth_base').val() + "/expedienteprofesor/create";
        var arrParams = new Object();
        arrParams.prov_id = $(this).val();
        arrParams.getcantones = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.cantones, "cmb_ciu_expdoce");
            }
        }, true);
    });
    /********************/

    $('#cmb_raza_etnica').change(function () {
        var valor = $('#cmb_raza_etnica').val();
        if (valor == 6) {
            $("#txt_otra_etnia").removeAttr("disabled");
        } else {
            $("#txt_otra_etnia").attr('disabled', 'disabled');
            $("#txt_otra_etnia").val("");
        }
    });
    
    /***************filtra Área conocimiento Estudios Superiores **********************/
    $('#cmb_area_conocimiento').change(function () {      
        var link = $('#txth_base').val() + "/expedienteprofesor/create";
        var arrParams = new Object();
        arrParams.area = $(this).val();
        arrParams.getareac = true;
                  
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {                
                data = response.message;                
                setComboData(data.subarea, "cmb_subarea_conocimiento", "Seleccionar");
            }
        }, true);
    });  
    
     /***************filtra Área conocimiento Estudios Actuales **********************/
    $('#cmb_area_conocimientoea').change(function () {      
        var link = $('#txth_base').val() + "/expedienteprofesor/create";
        var arrParams = new Object();
        arrParams.area = $(this).val();
        arrParams.getareac = true;
                  
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {                
                data = response.message;                
                setComboData(data.subarea, "cmb_subarea_conocimientoea", "Seleccionar");
            }
        }, true);
    });  
    
     /***************filtra Área conocimiento Experiencia Docencia **********************/
    $('#cmb_area_conocimientoed').change(function () {      
        var link = $('#txth_base').val() + "/expedienteprofesor/create";
        var arrParams = new Object();
        arrParams.area = $(this).val();
        arrParams.getareac = true;
                  
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {                
                data = response.message;                
                setComboData(data.subarea, "cmb_subarea_conocimientoed", "Seleccionar");
            }
        }, true);
    });  
    
      //Control de Validación del expediente: Validado e invalidado.
    /***************filtra universidades segun pais en estudios superiores**********************/
    $('#cmb_tip_validacion').change(function () {
        var combo_validacion = $('#cmb_tip_validacion').val();        
        if (combo_validacion == 23) {
             $('#divObservacion').show();
        } else
        {
             $('#divObservacion').hide();
        }      
    });

    /* DESPLAZAR TAB */
    // Tabs View
    $('#paso1nextView').click(function () {
        $("a[href='#paso2']").trigger("click");    
    });
    $('#paso2backView').click(function () {
        $("a[href='#paso1']").trigger("click");      
    });
    $('#paso2nextView').click(function () {
        $("a[href='#paso3']").trigger("click");
    });
    $('#paso3backView').click(function () {
        $("a[href='#paso2']").trigger("click");   
    });
    $('#paso3nextView').click(function () {
        $("a[href='#paso4']").trigger("click");    
    });
    $('#paso4backView').click(function () {
        $("a[href='#paso3']").trigger("click");      
    });
    $('#paso4nextView').click(function () {
        $("a[href='#paso5']").trigger("click");    
    });
    $('#paso5backView').click(function () {
        $("a[href='#paso4']").trigger("click");       
    });
    $('#paso5nextView').click(function () {
        $("a[href='#paso6']").trigger("click");        
    });
    $('#paso6backView').click(function () {
        $("a[href='#paso5']").trigger("click");      
    });
    $('#paso6nextView').click(function () {
        $("a[href='#paso7']").trigger("click");      
    });
    $('#paso7backView').click(function () {
        $("a[href='#paso6']").trigger("click");   
    });   
    
    // tabs create
    var tab = 0;
    $('#paso1next').click(function () {        
        $("a[data-href='#paso1']").attr('data-toggle', 'none');
        $("a[data-href='#paso1']").parent().attr('class', 'disabled');
        $("a[data-href='#paso1']").attr('data-href', $("a[href='#paso1']").attr('href'));
        $("a[data-href='#paso1']").removeAttr('href');
        $("a[data-href='#paso2']").attr('data-toggle', 'tab');
        $("a[data-href='#paso2']").attr('href', $("a[data-href='#paso2']").attr('data-href'));
        $("a[data-href='#paso2']").trigger("click");
        tab=2;
        Guardar();        
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
        tab=3;
        Guardar();
        
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
        $("a[data-href='#paso3']").attr('data-toggle', 'none');
        $("a[data-href='#paso3']").parent().attr('class', 'disabled');
        $("a[data-href='#paso3']").attr('data-href', $("a[href='#paso3']").attr('href'));
        $("a[data-href='#paso3']").removeAttr('href');
        $("a[data-href='#paso4']").attr('data-toggle', 'tab');
        $("a[data-href='#paso4']").attr('href', $("a[data-href='#paso4']").attr('data-href'));
        $("a[data-href='#paso4']").trigger("click");
        tab=4;
        Guardar();
    });
    $('#paso4back').click(function () {
        $("a[data-href='#paso4']").attr('data-toggle', 'none');
        $("a[data-href='#paso4']").parent().attr('class', 'disabled');
        $("a[data-href='#paso4']").attr('data-href', $("a[href='#paso4']").attr('href'));
        $("a[data-href='#paso4']").removeAttr('href');
        $("a[data-href='#paso3']").attr('data-toggle', 'tab');
        $("a[data-href='#paso3']").attr('href', $("a[data-href='#paso3']").attr('data-href'));
        $("a[data-href='#paso3']").trigger("click");
    });
    $('#paso4next').click(function () {        
        $("a[data-href='#paso4']").attr('data-toggle', 'none');
        $("a[data-href='#paso4']").parent().attr('class', 'disabled');
        $("a[data-href='#paso4']").attr('data-href', $("a[href='#paso4']").attr('href'));
        $("a[data-href='#paso4']").removeAttr('href');
        $("a[data-href='#paso5']").attr('data-toggle', 'tab');
        $("a[data-href='#paso5']").attr('href', $("a[data-href='#paso5']").attr('data-href'));
        $("a[data-href='#paso5']").trigger("click");
        tab=5;
        Guardar();
    });
    $('#paso5back').click(function () {
        $("a[data-href='#paso5']").attr('data-toggle', 'none');
        $("a[data-href='#paso5']").parent().attr('class', 'disabled');
        $("a[data-href='#paso5']").attr('data-href', $("a[href='#paso5']").attr('href'));
        $("a[data-href='#paso5']").removeAttr('href');
        $("a[data-href='#paso4']").attr('data-toggle', 'tab');
        $("a[data-href='#paso4']").attr('href', $("a[data-href='#paso4']").attr('data-href'));
        $("a[data-href='#paso4']").trigger("click");
    });

    $('#paso5next').click(function () {        
        $("a[data-href='#paso5']").attr('data-toggle', 'none');
        $("a[data-href='#paso5']").parent().attr('class', 'disabled');
        $("a[data-href='#paso5']").attr('data-href', $("a[href='#paso5']").attr('href'));
        $("a[data-href='#paso5']").removeAttr('href');
        $("a[data-href='#paso6']").attr('data-toggle', 'tab');
        $("a[data-href='#paso6']").attr('href', $("a[data-href='#paso6']").attr('data-href'));
        $("a[data-href='#paso6']").trigger("click");
        tab=6;
        Guardar();
    });

    $('#paso6back').click(function () {
        $("a[data-href='#paso6']").attr('data-toggle', 'none');
        $("a[data-href='#paso6']").parent().attr('class', 'disabled');
        $("a[data-href='#paso6']").attr('data-href', $("a[href='#paso6']").attr('href'));
        $("a[data-href='#paso6']").removeAttr('href');
        $("a[data-href='#paso5']").attr('data-toggle', 'tab');
        $("a[data-href='#paso5']").attr('href', $("a[data-href='#paso5']").attr('data-href'));
        $("a[data-href='#paso5']").trigger("click");
    });    

    $('#btn_save_validacion').click(function () {
        var arrParams = new Object();
        var link = $('#txth_base').val() + "/expedienteprofesor/guardarevision";
      
        arrParams.per_id = $('#txth_perid').val();
        arrParams.resultado = $('#cmb_tip_validacion').val(); 
        arrParams.observacion = $('#txt_observacion').val();
        
        // if (!validateForm()) {
        requestHttpAjax(link, arrParams, function (response) {
            showAlert(response.status, response.label, response.message);
            setTimeout(function () {
                window.location.href = $('#txth_base').val() + "/administracionexpediente/listarexpediente";
            }, 2000);
        }, true);
        // }
    });
    
    /*GUARDAR INFORMACION. */   
    function Guardar() {
        var arrParams = new Object();
        var link = $('#txth_base').val() + "/expedienteprofesor/guardar";
        //FORM 1 datos personal
        arrParams.foto_persona = $('#txth_doc_foto').val();
        arrParams.pnombre_persona = $('#txt_primer_nombre').val();
        arrParams.snombre_persona = $('#txt_segundo_nombre').val();
        arrParams.papellido_persona = $('#txt_primer_apellido').val();
        arrParams.sapellido_persona = $('#txt_segundo_apellido').val();
        arrParams.genero_persona = $('#cmb_genero').val();
        arrParams.etnia_persona = $('#cmb_raza_etnica').val();
        arrParams.etnia_otra = $('#txt_otra_etnia').val();
        arrParams.ecivil_persona = $('#txt_estado_civil').val();
        arrParams.fnacimiento_persona = $('#txt_fecha_nacimiento').val();
        arrParams.pnacionalidad = $('#txt_nacionalidad').val();
        arrParams.pais_persona = $('#cmb_pais_nac').val();
        arrParams.provincia_persona = $('#cmb_prov_nac').val();
        arrParams.canton_persona = $('#cmb_ciu_nac').val();
        arrParams.correo_persona = $('#txt_ftem_correo').val();
        arrParams.correo_institucional = $('#txt_ftem_correo1').val();
        arrParams.telefono_persona = $('#txt_telefono').val();
        arrParams.celular_persona = $('#txt_celular').val();
        arrParams.tsangre_persona = $('#cmb_tipo_sangre').val();
        if ($('input[name=signup-ecu]:checked').val() == 1) {
            arrParams.nacecuador = 1;
        } else {
            arrParams.nacecuador = 0;
        }
        //FORM 1 Informacion de Contacto
        arrParams.nombre_contacto = $('#txt_nombres_contacto').val();
        arrParams.apellido_contacto = $('#txt_apellidos_contacto').val();
        arrParams.telefono_contacto = $('#txt_telefono_con').val();
        arrParams.celular_contacto = $('#txt_celular_con').val();
        arrParams.direccion_contacto = $('#txt_address_con').val();
        arrParams.parentesco_contacto = $('#cmb_parentesco_con').val();

        //FORM 2 Datos Domicilio
        arrParams.paisd_domicilio = $('#cmb_pais_dom').val();
        arrParams.provinciad_domicilio = $('#cmb_prov_dom').val();
        arrParams.cantond_domicilio = $('#cmb_ciu_dom').val();
        arrParams.telefono_domicilio = $('#txt_telefono_dom').val();
        arrParams.sector_domicilio = $('#txt_sector_dom').val();
        arrParams.callep_domicilio = $('#txt_cprincipal_dom').val();
        arrParams.calls_domicilio = $('#txt_csecundaria_dom').val();
        arrParams.numero_domicilio = $('#txt_numeracion_dom').val();
        arrParams.referencia_domicilio = $('#txt_referencia_dom').val();
        
        //Eliminar el pb_validation de los otros controles.      
        $('#txt_nombres_contacto_fami').removeClass("PBvalidation");
        $('#txt_apellidos_contacto_fami').removeClass("PBvalidation");
        $('#txt_fecha_nacimiento_fami').removeClass("PBvalidation");
        $('#txtarea_ocupacion').removeClass("PBvalidation");        
        $('#txt_por_discapacidad_fam').removeClass("PBvalidation");
        $('#txt_carnet_con').removeClass("PBvalidation");
        $('#txt_nombres_fam_ins').removeClass("PBvalidation");
        $('#txt_apellidos_fam_ins').removeClass("PBvalidation");
        $('#txt_otrainstitucionsuper').removeClass("PBvalidation");
        $('#txt_titulo').removeClass("PBvalidation");
        $('#txt_fecha_registro').removeClass("PBvalidation");
        $('#txt_numero_registro').removeClass("PBvalidation");
        $('#txt_titulo_act').removeClass("PBvalidation");
        $('#txt_fecha_ingreso').removeClass("PBvalidation");
        $('#txt_otrainstitucionactual').removeClass("PBvalidation");
        $('#txt_reconocimiento').removeClass("PBvalidation");
        $('#txt_fecha_logro').removeClass("PBvalidation");
        $('#txt_otrainstitucionareconocimiento').removeClass("PBvalidation");
        $('#txt_insti_certifica').removeClass("PBvalidation");
        $('#txt_otro_lenguaje').removeClass("PBvalidation");
        $('#txth_doc_idioma').removeClass("PBvalidation");
        $('#txt_inst_organiza').removeClass("PBvalidation");
        $('#txt_nombre_curso').removeClass("PBvalidation");
        $('#txt_duracion_hora').removeClass("PBvalidation");
        $('#fecha_iniciocap').removeClass("PBvalidation");
        $('#txt_fecha_fincap').removeClass("PBvalidation");
        $('#txt_nombrecompania').removeClass("PBvalidation");
        $('#txt_cargo').removeClass("PBvalidation");
        $('#txt_fecha_inicioexpl').removeClass("PBvalidation");
        $('#txt_fecha_finexpl').removeClass("PBvalidation");
        $('#txt_inst_med').removeClass("PBvalidation");
        $('#txt_inst_cont').removeClass("PBvalidation");
        $('#txt_tlf_inst_cont').removeClass("PBvalidation");
        $('#txt_direccion_expdocencia').removeClass("PBvalidation");
        $('#txt_tlfono_expdocencia').removeClass("PBvalidation");
        $('#txt_finicio_expdocencia').removeClass("PBvalidation");
        $('#txt_ffin_expdocencia').removeClass("PBvalidation");
        $('#txt_tlfcontacto_expdocencia').removeClass("PBvalidation");
        $('#txt_contacto_expdocencia').removeClass("PBvalidation");
        $('#txt_otrainstitucion').removeClass("PBvalidation");
        $('#txt_nombre_proyecto').removeClass("PBvalidation");
        $('#txt_responsabilidad').removeClass("PBvalidation");
        $('#txt_finicio_investigacion').removeClass("PBvalidation");
        $('#txt_ffin_investigacion').removeClass("PBvalidation");
        $('#txt_titulo_publicacion').removeClass("PBvalidation");
        $('#txt_fecha_publicacion').removeClass("PBvalidation");
        $('#txt_nombrepublicacion').removeClass("PBvalidation");
        $('#txt_url').removeClass("PBvalidation");
        $('#txt_numero_issn').removeClass("PBvalidation");
        $('#txt_numero_isbn').removeClass("PBvalidation");
        $('#txt_otrainstitucionpublica').removeClass("PBvalidation");
        $('#txt_publicaprobacion').removeClass("PBvalidation");
        $('#txt_nombrevento').removeClass("PBvalidation");
        $('#txt_ponencia').removeClass("PBvalidation");
        $('#txt_otrainstitucionevento').removeClass("PBvalidation");
        $('#txt_por_discapacidad').removeClass("PBvalidation");
        $('#txt_carnet_conadis').removeClass("PBvalidation");

        //FORM 2 datos Familiares              
        arrParams.dataLSFamiliar = familiarList;
        arrParams.dataLSFamiliarIns = familiarInsList;    
        //sessionStorage.removeItem('datosFamiliares');
        //sessionStorage.clear();
        
        //Estudios
        arrParams.dataLSEstSuperior = EstudiosSupList;
        arrParams.dataLSEstActual = EstudiosActualesList;
        arrParams.dataLSReconocimiento = ReconocimientosList;
        arrParams.dataLSIdiomas = IdiomasList;
        arrParams.dataLSCapacitacion = CapacitacionList;      

        //Experiencia Laboral
        arrParams.dataLSExpLaboral = ExpLaboralList;
        arrParams.dataLSExpDocencia = ExpDocenciaList;       
        
        //Investigación
        arrParams.dataLSInvestigacion = InvestigacionList;     
        
        //Publicaciones
        arrParams.dataLSPublicacion = PublicacionList;
        arrParams.dataLSCodireccion = CodireccionList;
        arrParams.dataLSPonencia = PonenciaList;  
        
        //FORM 1 datos discapacidad
        if ($('#rdb_discapacidadOK').prop('checked')) {
            arrParams.discapacidad =  '1';
            var mensaje = "";
            if  ($('#txt_por_discapacidad').val() == "") {
                mensaje = "¡Ingrese porcentaje de discapacidad!.";
            }
            if  ($('#txt_carnet_conadis').val() == "") {
                mensaje = "¡Ingrese número de carnet del conadis!.";
            }
            if  ($('#txth_doc_adj_disc').val() == "") {
                mensaje = "¡Adjunte imagen de carnet del conadis!.";
            }
            if (mensaje != "") {
                alert (mensaje);
            } else {                
                arrParams.tipo_discap = $('#cmb_tip_discap').val();
                arrParams.por_discapacidad = $('#txt_por_discapacidad').val();
                arrParams.carnet_conadi = $('#txt_carnet_conadis').val();
                arrParams.doc_adj_disc = $('#txth_doc_adj_disc').val();      
            }
        }
        if (!validateForm()) {
            requestHttpAjax(link, arrParams, function (response) {
                showAlert(response.status, response.label, response.message);
                setTimeout(function () {
                    
                    window.location.href = $('#txth_base').val() + "/expedienteprofesor/create?tab="+tab;                
                }, 1000);       
            }, true);
        }         
    }
    
    $('#btn_save').click(function () {
        tab= 6;
        Guardar();
    });   
     
    /*Cerrar ingreso para revisión de talento humano.*/
    $('#btn_cerrar').click(function () {   
        var arrParams = new Object();
        var link = $('#txth_base').val() + "/expedienteprofesor/cierre";        
        arrParams.perId = $('#txth_pid').val();
        
        /*if (!validateForm()) {*/
        requestHttpAjax(link, arrParams, function (response) {
            showAlert(response.status, response.label, response.message);
            setTimeout(function () {
                window.location.href = $('#txth_base').val() + "/expedienteprofesor/create";
            }, 2000);
        }, true);
        /*}*/
    })

    //Control del div de Laborando Actualmente
    $('#rdo_laboralActual').change(function () {
        if ($('#rdo_laboralActual').val() == 1) {
            $("#rdo_laboralActual_no").prop("checked", "");
        } 
    });

    $('#rdo_laboralActual_no').change(function () {
        if ($('#rdo_laboralActual_no').val() == 2) {
            $("#rdo_laboralActual").prop("checked", "");
        } 
    });
    //Control del div de discapacidad
    $('#rdo_laboralActual').change(function () {
        if ($('#rdo_laboralActual').val() == 1) {
            $('#explabora').css('display', 'block');
            $("#rdo_laboralActual_no").prop("checked", "");
        } else {
            $('#explabora').css('display', 'none');
        }
    });

    $('#rdo_laboralActual_no').change(function () {
        if ($('#rdo_laboralActual_no').val() == 2) {
            $('#explabora').css('display', 'none');
            $("#rdo_laboralActual").prop("checked", "");
        } else {
            $('#explabora').css('display', 'block');
        }
    });

    //Control del div de Tiene experiencia docencia
    $('#check_expDocenciaOK').change(function () {
        if ($('#check_expDocenciaOK').val() == 1) {
            $('#expdocencia').css('display', 'block');
            $("#check_expDocenciaNOK").prop("checked", "");
        } else {
            $('#expdocencia').css('display', 'none');
        }
    });

    $('#check_expDocenciaNOK').change(function () {
        if ($('#check_expDocenciaNOK').val() == 2) {
            $('#expdocencia').css('display', 'none');
            $("#check_expDocenciaOK").prop("checked", "");
        } else {
            $('#expdocencia').css('display', 'block');
        }
    });
    //Control del div de Tiene investigaciones
    $('#check_investigacionOK').change(function () {
        if ($('#check_investigacionOK').val() == 1) {
            $('#investigacion').css('display', 'block');
            $("#check_investigacionNOK").prop("checked", "");
        } else {
            $('#investigacion').css('display', 'none');
        }
    });

    $('#check_investigacionNOK').change(function () {
        if ($('#check_investigacionNOK').val() == 2) {
            $('#investigacion').css('display', 'none');
            $("#check_investigacionOK").prop("checked", "");
        } else {
            $('#investigacion').css('display', 'block');
        }
    });

    //Control de la caja de texto de institución que financia.
    $('#check_financiadaOK').change(function () {
        if ($('#check_financiadaOK').val() == 1) {            
            $("#check_financiadaNOK").prop("checked", "");
            $("#txt_institucion_financia").prop("disabled", false);
            $("#txt_institucion_financia").val('');
        } else {            
            $("#txt_institucion_financia").prop("disabled", $(this).is(':checked'));
            $("#txt_institucion_financia").val('');
        }
    });

    $('#check_financiadaNOK').change(function () {
        if ($('#check_financiadaNOK').val() == 2) {           
            $("#check_financiadaOK").prop("checked", "");
            $("#txt_institucion_financia").prop("disabled", $(this).is(':checked'));
            $("#txt_institucion_financia").val('');
        } else {            
            $("#txt_institucion_financia").prop("disabled", false);
            $("#txt_institucion_financia").val('');
        }
    });
    
    //Control de fecha fin en investigacion habilitar y deshabilitar
    $('#check_actualinvestigacion').change(function () {
        $("#txt_ffin_investigacion").prop("disabled", $(this).is(':checked'));
        $("#txt_ffin_investigacion").val('');
    });

    //Control del div de discapacidad en Tab2 Informacion Familiar
    //Control del div enfermedad
    $('#signup-enf').change(function () {
        if ($('#signup-enf').val() == 1) {
            $('#enfermedad').css('display', 'block');
            $("#signup-enf_no").prop("checked", "");
        } else {
            $('#enfermedad').css('display', 'none');
        }
    });

    $('#signup-enf_no').change(function () {
        if ($('#signup-enf_no').val() == 2) {
            $('#enfermedad').css('display', 'none');
            $("#signup-enf").prop("checked", "");
        } else {
            $('#enfermedad').css('display', 'block');
        }
    });

    //Control del div con discapacidad familiar
    $('#signup-discf').change(function () {
        if ($('#signup-discf').val() == 1) {
            $('#discapacidad_fam').css('display', 'block');
            $("#signup-discf_no").prop("checked", "");
        } else {
            $('#discapacidad_fam').css('display', 'none');
        }
    });

    $('#signup-discf_no').change(function () {
        if ($('#signup-discf_no').val() == 2) {
            $('#discapacidad_fam').css('display', 'none');
            $("#signup-discf").prop("checked", "");
        } else {
            $('#discapacidad_fam').css('display', 'block');
        }
    });

    //Control de enfermedad familiar    
    $('#signup-enfcf').change(function () {
        if ($('#signup-enfcf').val() == 1) {
            $('#enfermedad_fam').css('display', 'block');
            $("#signup-enfcf_no").prop("checked", "");
        } else {
            $('#enfermedad_fam').css('display', 'none');
        }
    });

    $('#signup-enfcf_no').change(function () {
        if ($('#signup-enfcf_no').val() == 2) {
            $('#enfermedad_fam').css('display', 'none');
            $("#signup-enfcf").prop("checked", "");
        } else {
            $('#enfermedad_fam').css('display', 'block');
        }
    });
    //Control del div de discapacidad
    $('#check_fami_dis_ok').change(function () {
        if ($('#check_fami_dis_ok').val() == 1) {
            $("#rdo_laboralActual_no").prop("checked", "");
        } else {

        }
    });

    $('#rdo_laboralActual_no').change(function () {
        if ($('#rdo_laboralActual_no').val() == 2) {
            $("#check_fami_dis_ok").prop("checked", "");
        } else {

        }
    });

    //Control del div de discapacidad
    $('#check_fami_dis_ok').change(function () {
        if ($('#check_fami_dis_ok').val() == 1) {
            $('#discapacidad').css('display', 'block');
            $("#check_fami_dis_nok").prop("checked", "");
        } else {
            $('#discapacidad').css('display', 'none');
        }
    });

    $('#check_fami_dis_nok').change(function () {
        if ($('#check_fami_dis_nok').val() == 2) {
            $('#discapacidad').css('display', 'none');
            $("#check_fami_dis_ok").prop("checked", "");
        } else {
            $('#discapacidad').css('display', 'block');
        }
    });

    /* Contro del Div "Vive con usted" que aparesca segun elija el parentesco hijo o hija */
    $("#rdo_ViveUsted").hide();
    $('#cmb_parentesco_con2').change(function () {
        if ($('#cmb_parentesco_con2').val() == 3 || $('#cmb_parentesco_con2').val() == 4) {
            /* $('#parentesco').css('display', 'block');
             $("#check_fami_dis_ok").prop("checked", "");*/
            $("#rdo_ViveUsted").show();
            //$("#nTargeta").hide();
        } else {
            $("#rdo_ViveUsted").hide();
        }
    });
    /* Contro del Div "Fecha de Registro" que aparesca segun elija titulo de cuarto o quinto nivel */
    $("#text-obli-fechRegis").hide();
    $('#cmb_nivel_instru').change(function () {

        if ($('#cmb_nivel_instru').val() == 1 || $('#cmb_nivel_instru').val() == 2) {
            /* $('#parentesco').css('display', 'block');
             $("#check_fami_dis_ok").prop("checked", "");*/
            $("#text-obli-fechRegis").show();
            //$("#nTargeta").hide();
        } else {
            $("#text-obli-fechRegis").hide();
        }
    });
    /*******************************/

    //Control del idioma nativo inhabilitar campos al elegir nativo 
    $('#check_idiomaNativo').change(function () {
        $("#txt_insti_certifica").prop("disabled", $(this).is(':checked'));
        $(".check_idiomasComprension").prop("disabled", $(this).is(':checked'));
        // $("#txt_doc_adj_disi").prop("disabled", $(this).is(':checked'));
        $("input[type=file]").prop("disabled", $(this).is(':checked'));
        $('#nlenguaje').css('display', 'block');
    });

    $('#rdb_nativo').change(function () {
        if ($('#rdb_nativo').val() == 1) {
            $('#nlenguaje').css('display', 'block');
            $("#rdb_nativo_no").prop("checked", "");
            $("#txt_insti_certifica").removeAttr("disabled");
            $("input[type=file]").removeAttr("disabled");
        } else {
            $('#nlenguaje').css('display', 'none');
        }
    });

    $('#rdb_nativo_no').change(function () {
        if ($('#rdb_nativo_no').val() == 2) {
            $('#nlenguaje').css('display', 'none');
            $("#rdb_nativo").prop("checked", "");
            $("#txt_insti_certifica").prop("disabled", $(this).is(':checked'));
            $("input[type=file]").prop("disabled", $(this).is(':checked'));
        } else {
            $('#nlenguaje').css('display', 'block');
        }
    });

    /***************************************/
    //Control de si tienes experiencia en docencia.
    $('#check_expDocenciaOK').change(function () {
        if ($('#check_expDocenciaOK').val() == 1) {
            $("#check_expDocenciaNOK").prop("checked", "");
        }
    });

    $('#check_expDocenciaNOK').change(function () {
        if ($('#check_expDocenciaNOK').val() == 2) {
            $("#check_expDocenciaOK").prop("checked", "");
        }
    });
    //Control de si Tiene usted algún tipo de discapacidad.
    $('#rdb_discapacidadOK').change(function () {
        if ($('#rdb_discapacidadOK').val() == 1) {
            $('#adicional').css('display', 'block');
            $("#rdb_discapacidadNOK").prop("checked", "");
            $("#div_btndiscapacidad").css('display','block');
        } else {
            $('#adicional').css('display', 'none');
            $("#div_btndiscapacidad").css('display','none');
        }
    });

    $('#rdb_discapacidadNOK').change(function () {
        if ($('#rdb_discapacidadNOK').val() == 2) {
            $('#adicional').css('display', 'none');
            $("#rdb_discapacidadOK").prop("checked", "");
            $("#div_btndiscapacidad").css('display','none');
        } else {
            $('#adicional').css('display', 'block');
            $("#div_btndiscapacidad").css('display','block');
        }
    });

    //Control de fecha fin en laboral habilitar y deshabilitar
    $('#check_actuallaboral').change(function () {
        $("#txt_fecha_finexpl").prop("disabled", $(this).is(':checked'));
        $("#txt_fecha_finexpl").val('');
    });

    //Control de fecha fin en docencia habilitar y deshabilitar
    $('#check_actualdocencia').change(function () {
        $("#txt_ffin_expdocencia").prop("disabled", $(this).is(':checked'));
        $("#txt_ffin_expdocencia").val('');
    });

    //Control de fecha fin en capacitacion habilitar y deshabilitar
    $('#check_actualcapacitacion').change(function () {
        $("#txt_fecha_fincap").prop("disabled", $(this).is(':checked'));
        $("#txt_fecha_fincap").val('');
    });

    //Control de fecha publicacion habilitar o no 
    $('#check_procesopublica').change(function () {
        $("#txt_fecha_publicacion").prop("disabled", $(this).is(':checked'));
        $("#txt_fecha_publicacion").val('');
    });

    // Control que cambia a ISSN o ISBN segun combo publicacion
    $('#cmb_publicadoen').change(function () {
        if ($('#cmb_publicadoen').val() == '6') {
            $('#txt_numero_issn').removeClass("PBvalidation");
            $('#txt_numero_isbn').addClass("PBvalidation");
            $('#Divissn').show();
            $('#Divisbn').hide();
        } else if ($('#cmb_publicadoen').val() == '7')
        {
            $('#txt_numero_isbn').removeClass("PBvalidation");
            $('#txt_numero_issn').addClass("PBvalidation");
            $('#Divissn').hide();
            $('#Divisbn').show();
        }
    });

    /***************filtra universidades segun pais en publicaciones **********************/
    $('#cmb_pais_publica').change(function () {
        var link = $('#txth_base').val() + "/expedienteprofesor/create";
        var arrParams = new Object();
        arrParams.pai_id = $(this).val();
        arrParams.getinstituto = true;
        $("#txt_otrainstitucionpublica").attr('disabled', 'disabled');
        $("#txt_otrainstitucionpublica").val('');
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.instituto, "cmb_universidad_institucionpublica");
                $('#cmb_universidad_institucionpublica').append('<option value="0" selected="selected">Seleccionar</option>');
                $('#cmb_universidad_institucionpublica').append('<option value="-1">Otra</option>');
            }
        }, true);
    });

    //Control de otra univeridad o instituto publicacion
    $('#cmb_universidad_institucionpublica').change(function () {
        var combo_institucion = document.getElementById('cmb_universidad_institucionpublica');
        var des_institucion = combo_institucion.options[combo_institucion.selectedIndex].text;
        if (des_institucion == 'Otra') {
            $("#txt_otrainstitucionpublica").removeAttr("disabled");
            $("#txt_otrainstitucionpublica").val('');
        } else
        {
            $("#txt_otrainstitucionpublica").attr('disabled', 'disabled');            
            $("#txt_otrainstitucionpublica").val('');
        }
    });

    /***************filtra universidades segun pais en eventos **********************/
    $('#cmb_pais_evento').change(function () {
        var link = $('#txth_base').val() + "/expedienteprofesor/create";
        var arrParams = new Object();
        arrParams.pai_id = $(this).val();
        arrParams.getinstituto = true;
        $("#txt_otrainstitucionevento").attr('disabled', 'disabled');
        $("#txt_otrainstitucionevento").val('');
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {
                data = response.message;
                setComboData(data.instituto, "cmb_universidad_institucionevento");
                $('#cmb_universidad_institucionevento').append('<option value="0" selected="selected">Seleccionar</option>');
                $('#cmb_universidad_institucionevento').append('<option value="-1">Otra</option>');
            }
        }, true);
    });

    //Control de otra univeridad o instituto en eventos
    $('#cmb_universidad_institucionevento').change(function () {
        var combo_institucion = document.getElementById('cmb_universidad_institucionevento');
        var des_institucion = combo_institucion.options[combo_institucion.selectedIndex].text;
        if (des_institucion == 'Otra') {
            $("#txt_otrainstitucionevento").removeAttr("disabled");
            $("#txt_otrainstitucionevento").val('');
        } else
        {
            $("#txt_otrainstitucionevento").attr('disabled', 'disabled');            
            $("#txt_otrainstitucionevento").val('');
        }    
    });

    /* Cargado de Imagen en Expediente Profesor Autor : Omar Romero */
    function mostrarImagen(input) {
         if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function (e) {
                   $('#img_destino').attr('src', e.target.result);
              }
              reader.readAsDataURL(input.files[0]);
         }
    }
     
    $("#txt_doc_foto").change(function () {
         mostrarImagen(this);
    });    
    
    //Control para otro idioma.      
    $('#cmb_nombre_lenguaje').change(function () {
        var combo_lenguaje = document.getElementById('cmb_nombre_lenguaje');
        var des_lenguaje = combo_lenguaje.options[combo_lenguaje.selectedIndex].text;
        if (des_lenguaje == 'Otro') {
            $("#txt_otro_lenguaje").removeAttr("disabled");
            $("#txt_otro_lenguaje").val('');
        } else
        {
            $("#txt_otro_lenguaje").attr('disabled', 'disabled');            
            $("#txt_otro_lenguaje").val('');
        }
    });    
    
    //Control del div Declaración de familiares.
    $('#opt_declara_si').change(function () {
        if ($('#opt_declara_si').val() == 1) {
            $('#divDeclarafamiliares').css('display', 'block');
            $("#opt_declara_no").prop("checked", "");
        } else {
            $('#divDeclarafamiliares').css('display', 'none');
        }
    });

    $('#opt_declara_no').change(function () {
        if ($('#opt_declara_no').val() == 2) {
            $('#divDeclarafamiliares').css('display', 'none');
            $("#opt_declara_si").prop("checked", "");
        } else {
            $('#divDeclarafamiliares').css('display', 'block');
        }
    });
    
    //Control del div Declaración de información verdadera.
    $('#check_acepta').change(function () {        
        if ($('#check_acepta').prop('checked')) {
            $('#DivRevision').css('display', 'block');    
        } else {
            $('#DivRevision').css('display', 'none');
        }      
    });           
 });
        
    /* Funciones para bloque familiares del profesor*/
    function obtDataLSConFam() {
        var storedListConFam = sessionStorage.getItem('datosFamiliares');
        if (storedListConFam == null) {
            familiarList = [];
        } else {
            familiarList = JSON.parse(storedListConFam);
        }
        return familiarList;
    }
    
    /*Función llamada desde el formulario create para llenar los grids.*/
    function loadSessionFamiliares(arrdata){
        sessionStorage.setItem("datosFamiliares",arrdata);        
        var dataContFam = JSON.parse(arrdata);
        paintListFamiliares(dataContFam);                   
    }
    
    function paintListFamiliares(dataContFam) {
        html = "  <div class='table-responsive tabla_estile'>" +
                "<table class='table'>" +
                "  <tr> <th>Nombres</th> <th>Apellidos</th> <th>Fecha Nacimiento</th> <th>Parentesco</th><th>Ocupación</th><th>Discapacidad</th></tr>";
        for (i = 0; i < dataContFam.length; i++) {
            html += "<tr><td>" + dataContFam[i]['dafa_nombres'] + "</td> <td>" + dataContFam[i]['dafa_apellidos'] + "</td> <td>" + dataContFam[i]['dafa_fecha_nacimiento'] + "</td> <td>" + dataContFam[i]['des_parentesco'] + "</td><td>" + dataContFam[i]['dafa_ocupacion'] + "</td><td>" + dataContFam[i]['txt_tip_discap_fam'] + "</td><td> <button type='button' class='btn btn-link' onclick='eliminarElementoFamilia(" + dataContFam[i]['dafa_clave'] + ")'> <span class='glyphicon glyphicon-remove'></span> </button> </td></tr>";
        }

        html += "    </table>" +
                "</div>";
        $("#resultadoListFam").html(html);
    }
    
    /* Grace Viteri <analistadesarrollo01@uteg.edu.ec>*/
   /* function BorrarItemFam(indice) {    
        alert(indice);
        var tmp = JSON.parse(sessionStorage.getItem('datosFamiliares'));
        var filteredPeople = tmp.filter(item => item.dafa_clave!==indice);              
         
        sessionStorage.setItem('datosFamiliares', JSON.stringify(filteredPeople));     
         //Mostrar en tabla el session storage
        var dataContFam = obtDataLSConFam();
        paintListFamiliares(dataContFam);
    }*/
    
    /* Funciones para bloque familiares en la institución*/
    function obtDataLSFamIns() {
        var storedListFamIns = sessionStorage.getItem('datosFamiliaresIns');
        if (storedListFamIns == null) {
            familiarInsList = [];
        } else {
            familiarInsList = JSON.parse(storedListFamIns);
        }
        return familiarInsList;
    }
    
    /*Función llamada desde el formulario create para llenar los grids.*/
    function loadSessionFamiliaresInst(arrdata){
        sessionStorage.setItem("datosFamiliaresIns",arrdata);
        var dataContFamInst = JSON.parse(arrdata);
        paintListFamiliaresIns(dataContFamInst);
       
    }
    
    function paintListFamiliaresIns(dataContFamIns) {
        html = " <div class='table-responsive tabla_estile'>" +
                "<table class='table'>" +
                "  <tr> <th>Nombres</th> <th>Apellidos</th> <th>Parentesco</th></tr>";
        for (i = 0; i < dataContFamIns.length; i++) {             
             html += "<tr><td>" + dataContFamIns[i]['dafa_nombres'] + "</td> <td>" + dataContFamIns[i]['dafa_apellidos'] + "</td> <td>" + dataContFamIns[i]['des_parentesco'] + "</td><td> <button type='button' class='btn btn-link' onclick='eliminarElementoFamiliaInst(" + dataContFamIns[i]['dafa_clave'] + ")'> <span class='glyphicon glyphicon-remove'></span> </button> </td></tr>";             
        }
        html += "    </table>" + "</div>";
        $("#resultadoListFamIns").html(html);
    }       
    
    /* Funciones para el bloque de estudios superiores */
     function obtDataLSEstSuperior() {
        var storedListEstSup = sessionStorage.getItem('datosEstSuperior');
        if (storedListEstSup == null) {
            EstudiosSupList = [];
        } else {
            EstudiosSupList = JSON.parse(storedListEstSup);
        }
        return EstudiosSupList;
    }
    
    /*Función llamada desde el formulario create para llenar los grids.*/
    function loadSessionEstSuperior(arrdata){
        sessionStorage.setItem("datosEstSuperior",arrdata);
        var dataContEstSuperior = JSON.parse(arrdata);
        paintListEstSuperior(dataContEstSuperior);       
    }
    
    function paintListEstSuperior(dataContEstSuperior) {
        html = " <div class='table-responsive tabla_estile'>" +
                "<table class='table'>" +
                "  <tr> <th>Nivel Instrucción</th> <th>Institución</th> <th>Título Obtenido</th> <th>Fecha Registro</th> <th>Número Registro</th> <th>Lugar</th></tr>";
        for (i = 0; i < dataContEstSuperior.length; i++) {
            html += "<tr><td>" + dataContEstSuperior[i]['dicu_nivel_des'] + "</td> <td>" + dataContEstSuperior[i]['dicu_nombre_institucion'] + "</td> <td>" + dataContEstSuperior[i]['dicu_titulo'] + "</td> <td>" + dataContEstSuperior[i]['dicu_fecha_registro'] + "</td> <td>" + dataContEstSuperior[i]['dicu_numero_registro'] + "</td> <td>" + dataContEstSuperior[i]['dicu_des_pais'] + "</td><td> <button type='button' class='btn btn-link' onclick='eliminarElementoEstsuperiores(" + dataContEstSuperior[i]['dicu_clave'] + ")'> <span class='glyphicon glyphicon-remove'></span> </button> </td></tr>";
        }

        html += "    </table>" + "</div>";
        $("#resultadoEstSuperior").html(html);
    }      
    
    /* Funciones para el bloque de estudios actuales */
    function obtDataLSEstActual() {
        var storedListEstAct = sessionStorage.getItem('datosEstActual');
        if (storedListEstAct == null) {
            EstudiosActualesList = [];
        } else {
            EstudiosActualesList = JSON.parse(storedListEstAct);
        }
        return EstudiosActualesList;
    }
    
    /*Función llamada desde el formulario create para llenar los grids.*/
    function loadSessionEstActual(arrdata){
        sessionStorage.setItem("datosEstActual",arrdata);
        var dataContEstActuales = JSON.parse(arrdata);
        paintListEstActual(dataContEstActuales);       
    }
    
    function paintListEstActual(dataContEstActuales) {
        html = " <div class='table-responsive tabla_estile'>" +
                "<table class='table'>" +
                "  <tr> <th>Nivel Instrucción</th> <th>Institución</th> <th>Título Obtenido</th> <th>Fecha Ingreso</th> </tr>";
        for (i = 0; i < dataContEstActuales.length; i++) {
            html += "<tr><td>" + dataContEstActuales[i]['dicu_nivel_des'] + "</td> <td>" + dataContEstActuales[i]['dicu_nombre_institucion'] + "</td> <td>" + dataContEstActuales[i]['dicu_titulo'] + "</td> <td>" + dataContEstActuales[i]['dicu_fecha_registro'] + "</td><td> <button type='button' class='btn btn-link' onclick='eliminarElementoEstactuales(" + dataContEstActuales[i]['dicu_clave'] + ")'> <span class='glyphicon glyphicon-remove'></span> </button> </td></tr>";
        }

        html += "    </table>" + "</div>";
        $("#resultadoEstActual").html(html);
    }       
    
    /* Funciones para el bloque de Reconocimientos.*/
    function obtDataLSReconocimiento() {
        var storedListReconocimiento = sessionStorage.getItem('Reconocimiento');
        if (storedListReconocimiento == null) {
            ReconocimientosList = [];
        } else {
            ReconocimientosList = JSON.parse(storedListReconocimiento);
        }
        return ReconocimientosList;
    }
    
     /*Función llamada desde el formulario create para llenar los grids.*/
    function loadSessionReconocimiento(arrdata){
        sessionStorage.setItem("Reconocimiento",arrdata);
        var dataContReconocimientos = JSON.parse(arrdata);
        paintListReconocimiento(dataContReconocimientos);       
    }
    
    function paintListReconocimiento(dataContReconocimientos) {
        html = " <div class='table-responsive tabla_estile'>" +
                "<table class='table'>" +
                "  <tr> <th>Reconocimiento</th> <th>Institución</th> <th>Fecha Logro</th> </tr>";
        for (i = 0; i < dataContReconocimientos.length; i++) {
            html += "<tr><td>" + dataContReconocimientos[i]['dicu_titulo'] + "</td> <td>" + dataContReconocimientos[i]['dicu_nombre_institucion'] + "</td> <td>" + dataContReconocimientos[i]['dicu_fecha_registro'] + "</td><td> <button type='button' class='btn btn-link' onclick='eliminarElementoReconocimiento(" + dataContReconocimientos[i]['dicu_clave'] + ")'> <span class='glyphicon glyphicon-remove'></span> </button> </td></tr>";
        }

        html += "    </table>" + "</div>";
        $("#resultadoReconocimiento").html(html);
    }
    
    /* Funciones para el bloque de Idiomas.*/
    function obtDataLSIdiomas() {
        var storedListIdiomas = sessionStorage.getItem('Idiomas');
        if (storedListIdiomas == null) {
            IdiomasList = [];
        } else {
            IdiomasList = JSON.parse(storedListIdiomas);
        }
        return IdiomasList;
    }
    
    /*Función llamada desde el formulario create para llenar los grids.*/
    function loadSessionIdiomas(arrdata){
        sessionStorage.setItem("Idiomas",arrdata);
        var dataContIdiomas = JSON.parse(arrdata);
        paintListIdiomas(dataContIdiomas);       
    }
    
    function paintListIdiomas(dataContIdiomas) {
        html = " <div class='table-responsive tabla_estile'>" +
                "<table class='table'>" +
                "  <tr> <th>Nombre Lenguaje</th> <th>Institución Certifica</th> <th>Comprensión Hablado</th> <th>Comprensión Escrito</th> <th>Comprensión Lectura</th> <th>Comprensión Auditiva</th></tr>";
        for (i = 0; i < dataContIdiomas.length; i++) {
            html += "<tr><td>" + dataContIdiomas[i]['rxi_des_idioma'] + "</td> <td>" + dataContIdiomas[i]['rxi_institucion'] + "</td> <td>" + dataContIdiomas[i]['rxi_nivel_hablado'] + "</td> <td>" + dataContIdiomas[i]['rxi_nivel_escrito'] + "</td> <td>" + dataContIdiomas[i]['rxi_nivel_lectura'] + "</td> <td>" + dataContIdiomas[i]['rxi_nivel_auditiva'] + "</td><td> <button type='button' class='btn btn-link' onclick='eliminarElementoIdioma(" + dataContIdiomas[i]['rxi_clave'] + ")'> <span class='glyphicon glyphicon-remove'></span> </button> </td></tr>";
        }

        html += "    </table>" + "</div>";
        $("#resultadoIdioma").html(html);
    }
    
    /* Funciones para el bloque de Capacitaciones */
    function obtDataLSCapacitacion() {
        var storedListCapacitacion = sessionStorage.getItem('Capacitacion');
        if (storedListCapacitacion == null) {
            CapacitacionList = [];
        } else {
            CapacitacionList = JSON.parse(storedListCapacitacion);
        }
        return CapacitacionList;
    }
    
    /*Función llamada desde el formulario create para llenar los grids.*/
    function loadSessionCapacitacion(arrdata){
        sessionStorage.setItem("Capacitacion",arrdata);
        var dataContCapacitacion = JSON.parse(arrdata);
        paintListCapacitacion(dataContCapacitacion);       
    }
    
    function paintListCapacitacion(dataContCapacitacion) {
        html = " <div class='table-responsive tabla_estile'>" +
                "<table class='table'>" +
                "  <tr> <th>Curso/Capacitación</th> <th>Tipo Capacitación</th> <th>Modalidad</th> <th>Institución Organiza</th> <th>Tipo Diploma</th> <th>Duración Horas</th> <th>Fecha Inicio</th> <th>Fecha Fin</th></tr>";
        for (i = 0; i < dataContCapacitacion.length; i++) {
            html += "<tr><td>" + dataContCapacitacion[i]['cap_nombre_curso'] + "</td> <td>" + dataContCapacitacion[i]['cap_des_tipocurso'] + "</td> <td>" + dataContCapacitacion[i]['cap_des_modalidad'] + "</td> <td>" + dataContCapacitacion[i]['cap_nombre_institucion'] + "</td> <td>" + dataContCapacitacion[i]['cap_des_tipodiploma'] + "</td> <td>" + dataContCapacitacion[i]['cap_duracion'] + "</td> <td>" + dataContCapacitacion[i]['cap_fecha_inicio'] + "</td> <td>" + dataContCapacitacion[i]['cap_fecha_fin'] + "</td><td> <button type='button' class='btn btn-link' onclick='eliminarElementoCapacitacion(" + dataContCapacitacion[i]['cap_clave'] + ")'> <span class='glyphicon glyphicon-remove'></span> </button> </td></tr>";
        }

        html += "    </table>" + "</div>";
        $("#resultadoCapacitacion").html(html);
    }

    /* Funciones para el bloque de Experiencia Laboral */
    function obtDataLSExpLaboral() {
        var storedListExpLaboral = sessionStorage.getItem('datosExpLaboral');
        if (storedListExpLaboral == null) {
            ExpLaboralList = [];
        } else {
            ExpLaboralList = JSON.parse(storedListExpLaboral);
        }
        return ExpLaboralList;
    }
    
    /*Función llamada desde el formulario create para llenar los grids.*/
    function loadSessionExpLaboral(arrdata){
        sessionStorage.setItem("datosExpLaboral",arrdata);
        var dataConExpLaboral = JSON.parse(arrdata);
        paintListExpLaboral(dataConExpLaboral);       
    }
    
    function paintListExpLaboral(dataConExpLaboral) {
        html = " <div class='table-responsive tabla_estile'>" +
                "<table class='table'>" +
                "  <tr> <th>Empresa/Institución</th> <th>Tipo Empresa/Institución</th> <th>Cargo</th> <th>Fecha Inicio</th> <th>Fecha Fin</th> <th>Teléfono Empresa</th> </tr>";
        for (i = 0; i < dataConExpLaboral.length; i++) {
            html += "<tr><td>" + dataConExpLaboral[i]['dela_empresa'] + "</td> <td>" + dataConExpLaboral[i]['dela_des_emp'] + "</td> <td>" + dataConExpLaboral[i]['dela_cargo'] + "</td> <td>" + dataConExpLaboral[i]['dela_fecha_inicio'] + "</td> <td>" + dataConExpLaboral[i]['dela_fecha_fin'] + "</td> <td>" + dataConExpLaboral[i]['dela_telef_empresa'] + "</td><td> <button type='button' class='btn btn-link' onclick='eliminarElementoExplaboral(" + dataConExpLaboral[i]['dela_clave'] + ")'> <span class='glyphicon glyphicon-remove'></span> </button> </td></tr>";
        }

        html += "    </table>" + "</div>";
        $("#resultadoExpLaboral").html(html);
    }

    /* Funciones para el bloque de Experiencia Docente */
    function obtDataLSExpDocencia() {
        var storedListExpDocencia = sessionStorage.getItem('datosExpDocencia');
        if (storedListExpDocencia == null) {
            ExpDocenciaList = [];
        } else {
            ExpDocenciaList = JSON.parse(storedListExpDocencia);
        }
        return ExpDocenciaList;
    }
    
    /*Función llamada desde el formulario create para llenar los grids.*/
    function loadSessionExpDocencia(arrdata){
        sessionStorage.setItem("datosExpDocencia",arrdata);
        var dataConExpDocencia = JSON.parse(arrdata);
        paintListExpDocencia(dataConExpDocencia);       
    }
    
    function paintListExpDocencia(dataConExpDocencia) {
        html = " <div class='table-responsive tabla_estile'>" +
                "<table class='table'>" +
                "  <tr> <th>Empresa/Institución</th> <th>Área Conocimiento</th> <th>Tiempo Dedicación</th> <th>Fecha Inicio</th> <th>Fecha Fin</th> <th>Teléfono Empresa</th> </tr>";
        for (i = 0; i < dataConExpDocencia.length; i++) {
            html += "<tr><td>" + dataConExpDocencia[i]['dedo_des_institucion'] + "</td> <td>" + dataConExpDocencia[i]['dedo_des_areaconoc'] + "</td> <td>" + dataConExpDocencia[i]['dedo_des_tiempodedica'] + "</td> <td>" + dataConExpDocencia[i]['dedo_fecha_inicio'] + "</td> <td>" + dataConExpDocencia[i]['dedo_fecha_fin'] + "</td> <td>" + dataConExpDocencia[i]['dedo_telefono'] + "</td><td> <button type='button' class='btn btn-link' onclick='eliminarElementoExpdocente(" + dataConExpDocencia[i]['dedo_clave'] + ")'> <span class='glyphicon glyphicon-remove'></span> </button> </td></tr>";
        }

        html += "    </table>" + "</div>";
        $("#resultadoExpDocencia").html(html);
    }
    
    /* Funciones para el bloque de Investigación */
    function obtDataLSInvestigacion() {
        var storedListInvestigacion = sessionStorage.getItem('datosInvestigacion');
        if (storedListInvestigacion == null) {
            InvestigacionList = [];
        } else {
            InvestigacionList = JSON.parse(storedListInvestigacion);
        }
        return InvestigacionList;
    }
    
    /*Función llamada desde el formulario create para llenar los grids.*/
    function loadSessionInvestigacion(arrdata){
        sessionStorage.setItem("datosInvestigacion",arrdata);
        var dataConInvestigacion = JSON.parse(arrdata);
        paintListInvestigacion(dataConInvestigacion);       
    }
    
    function paintListInvestigacion(dataConInvestigacion) {
        html = " <div class='table-responsive tabla_estile'>" +
                "<table class='table'>" +
                "  <tr> <th>Nombre Proyecto</th> <th>Rol Proyecto</th> <th>Fecha Inicio</th> <th>Fecha Fin</th> <th>Financiada</th> </tr>";
        for (i = 0; i < dataConInvestigacion.length; i++) {
            html += "<tr><td>" + dataConInvestigacion[i]['dinv_nombre_proyecto'] + "</td> <td>" + dataConInvestigacion[i]['div_des_rolproyecto'] + "</td> <td>" + dataConInvestigacion[i]['dinv_fechainicio'] + "</td> <td>" + dataConInvestigacion[i]['dinv_fechafin'] + "</td> <td>" + dataConInvestigacion[i]['dinv_des_financiada'] + "</td><td> <button type='button' class='btn btn-link' onclick='eliminarElementoInvestigacion(" + dataConInvestigacion[i]['dinv_clave'] + ")'> <span class='glyphicon glyphicon-remove'></span> </button> </td></tr>";
        }

        html += "    </table>" + "</div>";
        $("#resultadoInvestigacion").html(html);
    }
    
    /* Funciones para el bloque de Publicación */
    function obtDataLSPublicacion() {
        var storedListPublicacion = sessionStorage.getItem('datosPublicacion');
        if (storedListPublicacion == null) {
            PublicacionList = [];
        } else {
            PublicacionList = JSON.parse(storedListPublicacion);
        }
        return PublicacionList;
    }
    
    /*Función llamada desde el formulario create para llenar los grids.*/
    function loadSessionPublicacion(arrdata){
        sessionStorage.setItem("datosPublicacion",arrdata);
        var dataConPublicacion = JSON.parse(arrdata);
        paintListPublicacion(dataConPublicacion);       
    }
    
    function paintListPublicacion(dataConPublicacion) {
        html = " <div class='table-responsive tabla_estile'>" +
                "<table class='table'>" +
                "  <tr> <th>Tipo Publicación</th> <th>Título</th> <th>Publicación</th> <th>Nombre</th> <th>Fecha Publicación</th> <th>Número ISBN/ISSN</th> </tr>";
        for (i = 0; i < dataConPublicacion.length; i++) {
            html += "<tr><td>" + dataConPublicacion[i]['dpub_des_tipopublicacion'] + "</td> <td>" + dataConPublicacion[i]['dpub_titulo'] + "</td> <td>" + dataConPublicacion[i]['dpub_des_publicacion'] + "</td> <td>" + dataConPublicacion[i]['dpub_nombre_publicacion'] + "</td> <td>" + dataConPublicacion[i]['dpub_fecha_publicacion'] + "</td> <td>" + dataConPublicacion[i]['dpub_numero_issn_isbn'] + "</td><td> <button type='button' class='btn btn-link' onclick='eliminarElementoPublicacion(" + dataConPublicacion[i]['dpub_clave'] + ")'> <span class='glyphicon glyphicon-remove'></span> </button> </td></tr>";
        }

        html += "    </table>" + "</div>";
        $("#resultadoPublicacion").html(html);
    }
     
    /* Funciones en el bloque de codirección. */
    function obtDataLSCodireccion() {
        var storedListCodireccion = sessionStorage.getItem('datosCodireccion');
        if (storedListCodireccion == null) {
            CodireccionList = [];
        } else {
            CodireccionList = JSON.parse(storedListCodireccion);
        }
        return CodireccionList;
    }
    
    /*Función llamada desde el formulario create para llenar los grids.*/
    function loadSessionCodireccion(arrdata){
        sessionStorage.setItem("datosCodireccion",arrdata);
        var dataConCodireccion = JSON.parse(arrdata);
        paintListCodireccion(dataConCodireccion);       
    }
    
    function paintListCodireccion(dataConCodireccion) {
        html = " <div class='table-responsive tabla_estile'>" +
                "<table class='table'>" +
                "  <tr> <th>Tipo Codirección</th> <th>País</th> <th>Institución</th> <th>Área Conocimiento</th> <th>Año Aprobación</th> </tr>";
        for (i = 0; i < dataConCodireccion.length; i++) {
            html += "<tr><td>" + dataConCodireccion[i]['itut_des_tipocodireccion'] + "</td> <td>" + dataConCodireccion[i]['itut_des_pais'] + "</td> <td>" + dataConCodireccion[i]['itut_des_institucion'] + "</td> <td>" +  dataConCodireccion[i]['des_areacon'] + "</td> <td>" + dataConCodireccion[i]['itut_anio_aprobacion'] + "</td><td> <button type='button' class='btn btn-link' onclick='eliminarElementoCodireccion(" + dataConCodireccion[i]['itut_clave'] + ")'> <span class='glyphicon glyphicon-remove'></span> </button> </td></tr>";
        }

        html += "    </table>" + "</div>";
        $("#resultadoCodireccion").html(html);
    }
    
    /* Funciones en el bloque de ponencias. */
    function obtDataLSPonencia() {
        var storedListPonencia = sessionStorage.getItem('datosPonencia');
        if (storedListPonencia == null) {
            PonenciaList = [];
        } else {
            PonenciaList = JSON.parse(storedListPonencia);
        }
        return PonenciaList;
    }
    
    /*Función llamada desde el formulario create para llenar los grids.*/
    function loadSessionPonencia(arrdata){
        sessionStorage.setItem("datosPonencia",arrdata);
        var dataConPonencia = JSON.parse(arrdata);
        paintListPonencia(dataConPonencia);       
    }
    
    function paintListPonencia(dataConPonencia) {
        html = " <div class='table-responsive tabla_estile'>" +
                "<table class='table'>" +
                "  <tr> <th>Nombre</th> <th>País</th> <th>Institución</th> <th>Área Conocimiento</th> <th>Ponencia</th>  </tr>";
        for (i = 0; i < dataConPonencia.length; i++) {
            html += "<tr><td>" + dataConPonencia[i]['icon_nombre_evento'] + "</td> <td>" + dataConPonencia[i]['icon_des_pais'] + "</td> <td>" + dataConPonencia[i]['icon_institucion'] + "</td> <td>" + dataConPonencia[i]['icon_des_areacon'] + "</td> <td>" + dataConPonencia[i]['icon_ponencia'] + "</td><td> <button type='button' class='btn btn-link' onclick='eliminarElementoPonencia(" + dataConPonencia[i]['icon_clave'] + ")'> <span class='glyphicon glyphicon-remove'></span> </button> </td></tr>";
        }

        html += "    </table>" + "</div>";
        $("#resultadoConferencia").html(html);
    }
    
    function eliminarElementoFamilia(indice) {
        var arrParams = new Object();
        var link = $('#txth_base').val() + "/expedienteprofesor/eliminaregistro";                        
        var arr_familia = new Array();
        arr_familia = JSON.parse(sessionStorage.datosFamiliares);
        var size_arr = arr_familia.length;        
        var i = 0;        
        for (var i=0; i<= size_arr; i++) {            
            if (arr_familia[i]['dafa_clave'] == indice) {                
                //newarr_fam.push(arr_familia[i]);                                                               
                if (arr_familia[i]['dafa_id'] != 0) {                    
                    arrParams.codElim = (arr_familia[i]['dafa_id']);
                    arrParams.tablaId = 1;
                }          
                arr_familia.splice(i,1); 
                sessionStorage.removeItem("datosFamiliares");       
                sessionStorage.datosFamiliares = JSON.stringify(arr_familia);
                //Mostrar en tabla el session storage
                var dataContFam = obtDataLSConFam();
                paintListFamiliares(dataContFam);                 
                //document.write(JSON.stringify(arr_familia));    
                //Se envía datos a eliminar lógicamente.
                if (arrParams.codElim > 0) {                       
                   // if (!validateForm()) {
                        requestHttpAjax(link, arrParams, function (response) {                       
                            showAlert(response.status, response.label, response.message);                          
                        }, true);
                   // }
                }
            }            
        }  
    }
    
    function eliminarElementoFamiliaInst(indice) {    
        var arrParams = new Object();
        var link = $('#txth_base').val() + "/expedienteprofesor/eliminaregistro";                        
        var arr_familia = new Array();
        arr_familia = JSON.parse(sessionStorage.datosFamiliaresIns);
        var size_arr = arr_familia.length;        
        var i = 0;        
        for (var i=0; i<= size_arr; i++) {            
            if (arr_familia[i]['dafa_clave'] == indice) {                                                                                           
                if (arr_familia[i]['dafa_id'] != 0) {                    
                    arrParams.codElim = (arr_familia[i]['dafa_id']);
                    arrParams.tablaId = 1;
                }          
                arr_familia.splice(i,1); 
                sessionStorage.removeItem("datosFamiliaresIns");       
                sessionStorage.datosFamiliaresIns = JSON.stringify(arr_familia);
                //Mostrar en tabla el session storage
                var dataContFamIns = obtDataLSFamIns();
                paintListFamiliaresIns(dataContFamIns);                                   
                //Se envía datos a eliminar lógicamente.
                if (arrParams.codElim > 0) {                    
                   // if (!validateForm()) {
                        requestHttpAjax(link, arrParams, function (response) {                       
                            showAlert(response.status, response.label, response.message);                          
                        }, true);
                   // }
                }
            }            
        }   
    }  
    
    function eliminarElementoEstsuperiores(indice) {         
        var arrParams = new Object();
        var link = $('#txth_base').val() + "/expedienteprofesor/eliminaregistro";                        
        var arr_estudios = new Array();
        arr_estudios = JSON.parse(sessionStorage.datosEstSuperior);
        var size_arr = arr_estudios.length;        
        var i = 0;        
        for (var i=0; i<= size_arr; i++) {  
            if (arr_estudios[i]['dicu_clave'] == indice) {                                                                                          
                if (arr_estudios[i]['dicu_id'] != 0) {                    
                    arrParams.codElim = (arr_estudios[i]['dicu_id']);
                    arrParams.tablaId = 2;
                }          
                arr_estudios.splice(i,1); 
                sessionStorage.removeItem("datosEstSuperior");       
                sessionStorage.datosEstSuperior = JSON.stringify(arr_estudios);
                //Mostrar en tabla el session storage
                var dataContEstSuperior = obtDataLSEstSuperior();
                paintListEstSuperior(dataContEstSuperior);                         
                //Se envía datos a eliminar lógicamente.
               if (arrParams.codElim > 0) {                    
                   // if (!validateForm()) {
                        requestHttpAjax(link, arrParams, function (response) {                       
                            showAlert(response.status, response.label, response.message);                          
                        }, true);
                   // }
                }
            }            
        }   
    }
    
    function eliminarElementoEstactuales(indice) {         
        var arrParams = new Object();
        var link = $('#txth_base').val() + "/expedienteprofesor/eliminaregistro";                        
        var arr_estudios = new Array();
        arr_estudios = JSON.parse(sessionStorage.datosEstActual);
        var size_arr = arr_estudios.length;        
        var i = 0;        
        for (var i=0; i<= size_arr; i++) {  
            if (arr_estudios[i]['dicu_clave'] == indice) {                                                                                          
                if (arr_estudios[i]['dicu_id'] != 0) {                    
                    arrParams.codElim = (arr_estudios[i]['dicu_id']);
                    arrParams.tablaId = 2;
                }          
                arr_estudios.splice(i,1); 
                sessionStorage.removeItem("datosEstActual");       
                sessionStorage.datosEstActual = JSON.stringify(arr_estudios);
                //Mostrar en tabla el session storage
                var dataContEstActual = obtDataLSEstActual();
                paintListEstActual(dataContEstActual);                       
                //Se envía datos a eliminar lógicamente.
                if (arrParams.codElim > 0) {                    
                   // if (!validateForm()) {
                        requestHttpAjax(link, arrParams, function (response) {                       
                            showAlert(response.status, response.label, response.message);                          
                        }, true);
                   // }
                }
            }            
        }   
    }
    
    function eliminarElementoReconocimiento(indice) {         
        var arrParams = new Object();
        var link = $('#txth_base').val() + "/expedienteprofesor/eliminaregistro";                        
        var arr_reconoce = new Array();
        arr_reconoce = JSON.parse(sessionStorage.Reconocimiento);
        var size_arr = arr_reconoce.length;        
        var i = 0;        
        for (var i=0; i<= size_arr; i++) {  
            if (arr_reconoce[i]['dicu_clave'] == indice) {                                                                                          
                if (arr_reconoce[i]['dicu_id'] != 0) {                    
                    arrParams.codElim = (arr_reconoce[i]['dicu_id']);
                    arrParams.tablaId = 2;
                }          
                arr_reconoce.splice(i,1); 
                sessionStorage.removeItem("Reconocimiento");       
                sessionStorage.Reconocimiento = JSON.stringify(arr_reconoce);
                //Mostrar en tabla el session storage
                var dataContReconocimiento = obtDataLSReconocimiento();
                paintListReconocimiento(dataContReconocimiento);                    
                //Se envía datos a eliminar lógicamente.
                if (arrParams.codElim > 0) {                    
                   // if (!validateForm()) {
                        requestHttpAjax(link, arrParams, function (response) {                       
                            showAlert(response.status, response.label, response.message);                          
                        }, true);
                   // }
                }
            }            
        }   
    }
    
    function eliminarElementoCapacitacion(indice) {         
        var arrParams = new Object();
        var link = $('#txth_base').val() + "/expedienteprofesor/eliminaregistro";                        
        var arr_capacita = new Array();
        arr_capacita = JSON.parse(sessionStorage.Capacitacion);
        var size_arr = arr_capacita.length;        
        var i = 0;        
        for (var i=0; i<= size_arr; i++) {  
            if (arr_capacita[i]['cap_clave'] == indice) {                                                                                          
                if (arr_capacita[i]['cap_id'] != 0) {                    
                    arrParams.codElim = (arr_capacita[i]['cap_id']);
                    arrParams.tablaId = 3;
                }          
                arr_capacita.splice(i,1); 
                sessionStorage.removeItem("Capacitacion");       
                sessionStorage.Capacitacion = JSON.stringify(arr_capacita);
                //Mostrar en tabla el session storage
                var dataContCapacitacion = obtDataLSCapacitacion();
                paintListCapacitacion(dataContCapacitacion);                 
                //Se envía datos a eliminar lógicamente.
                if (arrParams.codElim > 0) {                    
                   // if (!validateForm()) {
                        requestHttpAjax(link, arrParams, function (response) {                       
                            showAlert(response.status, response.label, response.message);                          
                        }, true);
                   // }
                }
            }            
        }   
    }
    
    function eliminarElementoExplaboral(indice) {         
        var arrParams = new Object();             
        var link = $('#txth_base').val() + "/expedienteprofesor/eliminaregistro";                        
        var arreglo = new Array();
        arreglo = JSON.parse(sessionStorage.datosExpLaboral);
        var size_arr = arreglo.length;        
        var i = 0;        
        for (var i=0; i<= size_arr; i++) {  
            if (arreglo[i]['dela_clave'] == indice) {                                                                                          
                if (arreglo[i]['dela_id'] != 0) {                    
                    arrParams.codElim = (arreglo[i]['dela_id']);
                    arrParams.tablaId = 4;
                }          
                arreglo.splice(i,1); 
                sessionStorage.removeItem("datosExpLaboral");       
                sessionStorage.datosExpLaboral = JSON.stringify(arreglo);
                //Mostrar en tabla el session storage
                var dataContExpLaboral = obtDataLSExpLaboral();
                paintListExpLaboral(dataContExpLaboral);               
                //Se envía datos a eliminar lógicamente.
                if (arrParams.codElim > 0) {                    
                   // if (!validateForm()) {
                        requestHttpAjax(link, arrParams, function (response) {                       
                            showAlert(response.status, response.label, response.message);                          
                        }, true);
                   // }
                }
            }            
        }   
    }       

    function eliminarElementoExpdocente(indice) {         
        var arrParams = new Object();             
        var link = $('#txth_base').val() + "/expedienteprofesor/eliminaregistro";                        
        var arreglo = new Array();
        arreglo = JSON.parse(sessionStorage.datosExpDocencia);
        var size_arr = arreglo.length;        
        var i = 0;        
        for (var i=0; i<= size_arr; i++) {  
            if (arreglo[i]['dedo_clave'] == indice) {                                                                                          
                if (arreglo[i]['dedo_id'] != 0) {                    
                    arrParams.codElim = (arreglo[i]['dedo_id']);
                    arrParams.tablaId = 5;
                }          
                arreglo.splice(i,1); 
                sessionStorage.removeItem("datosExpDocencia");       
                sessionStorage.datosExpDocencia = JSON.stringify(arreglo);
                //Mostrar en tabla el session storage
                var dataContExpDocencia = obtDataLSExpDocencia();
                paintListExpDocencia(dataContExpDocencia);            
                //Se envía datos a eliminar lógicamente.
                if (arrParams.codElim > 0) {                    
                   // if (!validateForm()) {
                        requestHttpAjax(link, arrParams, function (response) {                       
                            showAlert(response.status, response.label, response.message);                          
                        }, true);
                   // }
                }
            }            
        }   
    }     

    function eliminarElementoInvestigacion(indice) {         
        var arrParams = new Object();             
        var link = $('#txth_base').val() + "/expedienteprofesor/eliminaregistro";                        
        var arreglo = new Array();
        arreglo = JSON.parse(sessionStorage.datosInvestigacion);
        var size_arr = arreglo.length;        
        var i = 0;        
        for (var i=0; i<= size_arr; i++) {  
            if (arreglo[i]['dinv_clave'] == indice) {                                                                                          
                if (arreglo[i]['dinv_id'] != 0) {                    
                    arrParams.codElim = (arreglo[i]['dinv_id']);
                    arrParams.tablaId = 6;
                }          
                arreglo.splice(i,1); 
                sessionStorage.removeItem("datosInvestigacion");       
                sessionStorage.datosInvestigacion = JSON.stringify(arreglo);
                //Mostrar en tabla el session storage
                var dataContInvestigacion = obtDataLSInvestigacion();
                paintListInvestigacion(dataContInvestigacion);          
                //Se envía datos a eliminar lógicamente.
                if (arrParams.codElim > 0) {                    
                   // if (!validateForm()) {
                        requestHttpAjax(link, arrParams, function (response) {                       
                            showAlert(response.status, response.label, response.message);                          
                        }, true);
                   // }
                }
            }            
        }   
    }
    
    
    function eliminarElementoPublicacion(indice) {         
        var arrParams = new Object();             
        var link = $('#txth_base').val() + "/expedienteprofesor/eliminaregistro";                        
        var arreglo = new Array();
        arreglo = JSON.parse(sessionStorage.datosPublicacion);
        var size_arr = arreglo.length;        
        var i = 0;        
        for (var i=0; i<= size_arr; i++) {  
            if (arreglo[i]['dpub_clave'] == indice) {                                                                                          
                if (arreglo[i]['dpub_id'] != 0) {                    
                    arrParams.codElim = (arreglo[i]['dpub_id']);
                    arrParams.tablaId = 7;
                }          
                arreglo.splice(i,1); 
                sessionStorage.removeItem("datosPublicacion");       
                sessionStorage.datosPublicacion = JSON.stringify(arreglo);
                //Mostrar en tabla el session storage
                var dataContPublicacion = obtDataLSPublicacion();
                paintListPublicacion(dataContPublicacion);        
                //Se envía datos a eliminar lógicamente.
                if (arrParams.codElim > 0) {                    
                   // if (!validateForm()) {
                        requestHttpAjax(link, arrParams, function (response) {                       
                            showAlert(response.status, response.label, response.message);                          
                        }, true);
                   // }
                }
            }            
        }   
    }
 
    function eliminarElementoCodireccion(indice) {         
        var arrParams = new Object();             
        var link = $('#txth_base').val() + "/expedienteprofesor/eliminaregistro";                        
        var arreglo = new Array();
        arreglo = JSON.parse(sessionStorage.datosCodireccion);
        var size_arr = arreglo.length;        
        var i = 0;        
        for (var i=0; i<= size_arr; i++) {  
            if (arreglo[i]['itut_clave'] == indice) {                                                                                          
                if (arreglo[i]['itut_id'] != 0) {                    
                    arrParams.codElim = (arreglo[i]['itut_id']);
                    arrParams.tablaId = 8;
                }          
                arreglo.splice(i,1); 
                sessionStorage.removeItem("datosCodireccion");       
                sessionStorage.datosCodireccion = JSON.stringify(arreglo);
                //Mostrar en tabla el session storage
                var dataContCodireccion = obtDataLSCodireccion();
                paintListCodireccion(dataContCodireccion);       
                //Se envía datos a eliminar lógicamente.
                if (arrParams.codElim > 0) {                    
                   // if (!validateForm()) {
                        requestHttpAjax(link, arrParams, function (response) {                       
                            showAlert(response.status, response.label, response.message);                          
                        }, true);
                   // }
                }
            }            
        }   
    }

    function eliminarElementoPonencia(indice) {         
        var arrParams = new Object();             
        var link = $('#txth_base').val() + "/expedienteprofesor/eliminaregistro";                        
        var arreglo = new Array();
        arreglo = JSON.parse(sessionStorage.datosPonencia);
        var size_arr = arreglo.length;        
        var i = 0;        
        for (var i=0; i<= size_arr; i++) {  
            if (arreglo[i]['icon_clave'] == indice) {                                                                                          
                if (arreglo[i]['icon_id'] != 0) {                    
                    arrParams.codElim = (arreglo[i]['icon_id']);
                    arrParams.tablaId = 9;
                }          
                arreglo.splice(i,1); 
                sessionStorage.removeItem("datosPonencia");       
                sessionStorage.datosPonencia = JSON.stringify(arreglo);
                //Mostrar en tabla el session storage
                var dataContPonencia = obtDataLSPonencia();
                paintListPonencia(dataContPonencia);    
                //Se envía datos a eliminar lógicamente.
                if (arrParams.codElim > 0) {                    
                   // if (!validateForm()) {
                        requestHttpAjax(link, arrParams, function (response) {                       
                            showAlert(response.status, response.label, response.message);                          
                        }, true);
                   // }
                }
            }            
        }   
    }
    
    function eliminarElementoIdioma(indice) {         
        var arrParams = new Object();             
        var link = $('#txth_base').val() + "/expedienteprofesor/eliminaregistro";                        
        var arreglo = new Array();
        arreglo = JSON.parse(sessionStorage.Idiomas);
        var size_arr = arreglo.length;        
        var i = 0;        
        for (var i=0; i<= size_arr; i++) {  
            if (arreglo[i]['rxi_clave'] == indice) {                                                                                          
                if (arreglo[i]['rxi_id'] != 0) {                    
                    arrParams.perElim = (arreglo[i]['per_id']);
                    arrParams.idiElim = (arreglo[i]['idi_id']);
                    arrParams.tablaId = 10;
                }          
                arreglo.splice(i,1); 
                sessionStorage.removeItem("Idiomas");       
                sessionStorage.Idiomas = JSON.stringify(arreglo);
                //Mostrar en tabla el session storage
                var dataContIdiomas = obtDataLSIdiomas();
                paintListIdiomas(dataContIdiomas); 
                //Se envía datos a eliminar lógicamente.
                if (arrParams.perElim > 0) {                    
                   // if (!validateForm()) {
                        requestHttpAjax(link, arrParams, function (response) {                       
                            showAlert(response.status, response.label, response.message);                          
                        }, true);
                   // }
                }
            }            
        }   
    } 
         