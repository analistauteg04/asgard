$(document).ready(function () {
    $('#cmb_unidad').change(function () {
        var link = $('#txth_base').val() + "/academico/distributivo/index";        
        var arrParams = new Object();        
        arrParams.uaca_id = $(this).val();            
        arrParams.getmodalidad = true;
        requestHttpAjax(link, arrParams, function (response) {
            if (response.status == "OK") {                
                data = response.message;
                setComboDataselect(data.modalidad, "cmb_modalidad", "Todos");              
            }
        }, true);
    });
});

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