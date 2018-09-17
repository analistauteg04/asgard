<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="formulario">
    <form name="frmVPOS" method="POST" action="https://vpayment.verifika.com/VPOS/MM/transactionStart20.do">
        <table border="0">
            <tr>
                <td align="center" valign="middle" colspan="5"><img src="img/logo_uteg.png" class="logo"/></td>
            </tr>
            <tr>
                <td align="left" valign="middle" class="etiquetas">Transacción: </td>
                <td >
                    <input name="idInscripcion" class="entradas" id="idInscripcion" value="<?php echo $idInscripcion; ?>" disabled>
                </td>
            </tr>
            <tr>
                <td align="left" valign="middle" class="etiquetas">Nombres: </td>
                <td >
                    <input name="Nombre" class="entradas" id="Nombre" value="<?php echo $nombre; ?>" disabled>
                </td>
            </tr>
            <tr>
                <td align="left" valign="middle" class="etiquetas">Apellido: </td>
                <td><input name="Apellido" class="entradas" id="Apellido" value="<?php echo $apellido; ?>" disabled></td>
            </tr>
            <tr>
                <td align="left" valign="middle" class="etiquetas">Curso: </td>
                <td>
                    <input name="NombreMateria" class="entradas" id="NombreMateria" value="<?php echo $nombreMateria; ?>" disabled>
                </td>
            </tr>
            <tr>
                <td align="left" valign="middle" class="etiquetas">Precio: </td>
                <td>
                    <input name="Precio" class="entradas" id="Precio" value="<?php echo $precio; ?>" disabled>
                </td>
            </tr>
            <INPUT TYPE="hidden" NAME="IDACQUIRER" value="<?php echo $array_send['acquirerId']; ?>">
            <INPUT TYPE="hidden" NAME="IDCOMMERCE" value="<?php echo $array_send['commerceId']; ?>">
            <INPUT TYPE="hidden" NAME="XMLREQ" value="<?php echo $array_get['XMLREQ']; ?>">
            <INPUT TYPE="hidden" NAME="DIGITALSIGN" value="<?php echo $array_get['DIGITALSIGN']; ?>">
            <INPUT TYPE="hidden" NAME="SESSIONKEY" value="<?php echo $array_get['SESSIONKEY']; ?>">
            <tr>
                <td colspan="5">
            <center>
                <input class="boton" type="submit" name="envio" id="envio" value="Pagar" />
            </center>
            </td>
            </tr>
        </table>
    </form>
</div>