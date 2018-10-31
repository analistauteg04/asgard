$(document).ready(function () {
    $('#btn_grabar_asignacion').click(function () {
        var arrParams = new Object();
        var link = $('#txth_base').val() + "/academico/matriculacion/save"; 

        arrParams.sins_id = $('#txth_sins_id').val();
        arrParams.par_id = $('#cmb_paralelo').val();
        arrParams.per_id = $('#cmb_periodo').val();
        arrParams.adm_id = $('#txth_adm_id').val();        
        
        if (!validateForm()) {
            requestHttpAjax(link, arrParams, function (response) {
                showAlert(response.status, response.label, response.message);

                setTimeout(function () {
                    parent.window.location.href = $('#txth_base').val() + "/academico/admitidos/index";
                }, 2000);

            }, true);
        }
    });
    
    $('#cmb_periodo').change(function () {
        var link = $('#txth_base').val() + "/academico/matriculacion/newmetodoingreso";
        var arrParams = new Object();
        arrParams.pmin_id = $(this).val();
        arrParams.getparalelos = true;        
          alert('Saludos');
        requestHttpAjax(link, arrParams, function (response) {             
            if (response.status == "OK") {                
                alert('Saludos');
                data = response.message;
                setComboData(data.paralelos, "cmb_paralelo");
                
            }
        }, true);
    });
});



function savemethod(){
    var arrParams = new Object();
    var link = $('#txth_base').val() + "/academico/matriculacion/save"; 
    arrParams.sins_id = $('#txth_sins_id').val();
    arrParams.par_id = $('#cmb_paralelo').val();
    arrParams.per_id = $('#cmb_periodo').val();
    arrParams.adm_id = $('#txth_adm_id').val();        

    if (!validateForm()) {
        requestHttpAjax(link, arrParams, function (response) {
            showAlert(response.status, response.label, response.message);

            setTimeout(function () {
                parent.window.location.href = $('#txth_base').val() + "/academico/admitidos/index";
            }, 2000);

        }, true);
    }
    
}