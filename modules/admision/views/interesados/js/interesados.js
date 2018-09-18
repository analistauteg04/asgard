
$(document).ready(function () {
    $('#btn_buscarInteresado').click(function () {
        actualizarGridInteresado();
    });
});
function actualizarGridInteresado(){
    var interesado = $('#txt_buscarData').val();
    var empresa = $('#cmb_empresa option:selected').val();
    if (!$(".blockUI").length) {
        showLoadingPopup();
        $('#TbG_Interesado').PbGridView('applyFilterData', {'search': interesado, 'company': empresa});
        setTimeout(hideLoadingPopup, 2000);
    }
}
