$(document).ready(function() {
    $("#cmb_pais").change(function() {
        var link = $('#txth_base').val() + "/academico/profesor/new";
        var arrParams = new Object();
        arrParams.pai_id = $("#cmb_pais").val();
        console.log(arrParams);
        requestHttpAjax(link, arrParams, function(response) {
            if (response.status == "OK")
                console.log(response.message);
            setComboData(response.message['arr_pro'], "cmb_provincia");
            setComboData(response.message['arr_can'], "cmb_canton");
            //  setComboData(response.message,"cmb_canton");
        }, true);
    });

    $("#cmb_provincia").change(function() {
        var link = $('#txth_base').val() + "/academico/profesor/new";
        var arrParams = new Object();
        arrParams.pro_id = $("#cmb_provincia").val();
        console.log(arrParams);
        requestHttpAjax(link, arrParams, function(response) {
            if (response.status == "OK")
                setComboData(response.message, "cmb_canton");
        }, true);
    });
    $('#view_pass_btn').click(function() {
        if ($('#frm_clave').attr("type") == "text") {
            $('#frm_clave').attr("type", "password");
            $('#view_pass_btn > i').attr("class", "glyphicon glyphicon-eye-open");
        } else {
            $('#frm_clave').attr("type", "text");
            $('#view_pass_btn > i').attr("class", "glyphicon glyphicon-eye-close");
        }
    });
    $("#generate_btn").click(function() {
        console.log("entra");
        var newpass = generatePasswordSemi();
        $('#frm_clave').val(newpass);
    });

    function generatePasswordSemi() {
        var ramdonPass = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!¡@#$&/()=?¿-+*^{}[]";
        var newpass = "";
        for (var i = 0; i < 6; i++)
            newpass += ramdonPass.charAt(Math.floor(Math.random() * ramdonPass.length));
        return newpass;
    }

    $("#frm_asi_image").keyup(function() {
        if ($(this).val() != "")
            $("#iconAsi").attr("class", $(this).val());
        else {
            $("#iconAsi").attr("class", $(this).attr("data-alias"));
            $(this).val($(this).attr("data-alias"));
        }
    });

    $("#spanAsiStatus").click(function() {
        if ($("#frm_asi_status").val() == "1") {
            $("#iconAsiStatus").attr("class", "glyphicon glyphicon-unchecked");
            $("#frm_asi_status").val("0");
        } else {
            $("#iconAsiStatus").attr("class", "glyphicon glyphicon-check");
            $("#frm_asi_status").val("1");
        }
    });
});

function searchModules(idbox, idgrid) {
    var arrParams = new Object();
    arrParams.PBgetFilter = true;
    arrParams.search = $("#" + idbox).val();
    $("#" + idgrid).PbGridView("applyFilterData", arrParams);
}

function edit() {
    var link = $('#txth_base').val() + "/academico/profesor/edit" + "?id=" + $("#frm_asi_id").val();
    window.location = link;
}

function update() {
    var link = $('#txth_base').val() + "/academico/profesor/update";
    var arrParams = new Object();
    arrParams.per_id = $("#frm_per_id").val();
    arrParams.pri_nombre = $('#txt_primer_nombre').val();
    arrParams.seg_nombre = $('#txt_segundo_nombre').val();
    arrParams.pri_apellido = $('#txt_primer_apellido').val();
    arrParams.seg_apellido = $('#txt_segundo_apellido').val();
    arrParams.cedula = $('#txt_cedula').val();
    arrParams.ruc = $('#txt_ruc').val();
    arrParams.pasaporte = $('#txt_pasaporte').val();
    arrParams.correo = $('#txt_correo').val();

    arrParams.pai_id = $('#cmb_pais').val();
    arrParams.pro_id = $('#cmb_provincia').val();
    arrParams.can_id = $('#cmb_canton').val();
    arrParams.sector = $('#txt_sector').val();
    arrParams.calle_pri = $('#txt_calle_pri').val();
    arrParams.calle_sec = $('#txt_calle_sec').val();
    arrParams.numeracion = $('#txt_numeracion').val();
    arrParams.referencia = $('#txt_referencia').val();
    arrParams.nacionalidad = $('#txt_nacionalidad').val();
    arrParams.celular = $('#txt_cel').val();
    arrParams.phone = $('#txt_phone').val();
    arrParams.fecha_nacimiento = $('#txt_fecha_nacimiento').val();

    arrParams.usuario = $('#txt_usuario').val();
    arrParams.clave = $('#frm_clave').val();
    arrParams.gru_id = $('#cmb_grupo').val();
    arrParams.rol_id = $('#cmb_rol').val();
    arrParams.emp_id = $('#cmb_empresa').val();
    if (!validateForm()) {
        console.log(arrParams);
        requestHttpAjax(link, arrParams, function(response) {
            showAlert(response.status, response.label, response.message);
        }, true);
    }
}

function save() {
    var link = $('#txth_base').val() + "/academico/profesor/save";
    var arrParams = new Object();
    arrParams.pri_nombre = $('#txt_primer_nombre').val();
    arrParams.seg_nombre = $('#txt_segundo_nombre').val();
    arrParams.pri_apellido = $('#txt_primer_apellido').val();
    arrParams.seg_apellido = $('#txt_segundo_apellido').val();
    arrParams.cedula = $('#txt_cedula').val();
    arrParams.ruc = $('#txt_ruc').val();
    arrParams.pasaporte = $('#txt_pasaporte').val();
    arrParams.correo = $('#txt_correo').val();

    arrParams.pai_id = $('#cmb_pais').val();
    arrParams.pro_id = $('#cmb_provincia').val();
    arrParams.can_id = $('#cmb_canton').val();
    arrParams.sector = $('#txt_sector').val();
    arrParams.calle_pri = $('#txt_calle_pri').val();
    arrParams.calle_sec = $('#txt_calle_sec').val();
    arrParams.numeracion = $('#txt_numeracion').val();
    arrParams.referencia = $('#txt_referencia').val();
    arrParams.nacionalidad = $('#txt_nacionalidad').val();
    arrParams.celular = $('#txt_cel').val();
    arrParams.phone = $('#txt_phone').val();
    arrParams.fecha_nacimiento = $('#txt_fecha_nacimiento').val();

    arrParams.usuario = $('#txt_usuario').val();
    arrParams.clave = $('#frm_clave').val();
    arrParams.gru_id = $('#cmb_grupo').val();
    arrParams.rol_id = $('#cmb_rol').val();
    arrParams.emp_id = $('#cmb_empresa').val();

    console.log(arrParams);
    if (!validateForm()) {
        console.log(arrParams);
        requestHttpAjax(link, arrParams, function(response) {
            console.log(response.message);
            showAlert(response.status, response.label, response.message);
        }, true);
    }
}

function deleteItem(per_id) {
    var link = $('#txth_base').val() + "/academico/profesor/delete";
    var arrParams = new Object();
    arrParams.per_id = per_id;
    requestHttpAjax(link, arrParams, function(response) {
        if (response.status == "OK") {
            var arrParams2 = new Object();
            arrParams2.PBgetFilter = true;
            arrParams2.search = $("#boxgrid").val();
            $("#grid_profesor_list").PbGridView("applyFilterData", arrParams2);
            //window.location = window.location.href;
        }
        setTimeout(function() {
            showAlert(response.status, response.label, response.message);
        }, 1000);
    }, true);
}