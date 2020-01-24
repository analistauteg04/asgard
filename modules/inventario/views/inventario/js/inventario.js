/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    recargarGridItem();

    $('#btn_AgregarItem').click(function () {
        agregarItems('new');       
    });

    showAlert("warning", "warning", messagePB);
});