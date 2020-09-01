<style>
    .modCab{
        color: #000000;        
        line-height: 16px;
    }
    .panelUserInfo{
        /*margin: 10px 0px 18px;*/
        margin: 5px 0px 0px;
    }    
    .tcoll_cen {
        width: 50%;
        float: left;
        font-size: 10px;
        text-align: left;
    }
    .tcolr_cen {
        width: 50%;
        float: left;
        font-size: 10px;
        text-align: left;
    }
    .tcoll_cen2 {
        width: 40%;
        float: left;
        font-size: 10px;
        text-align: left;
    }
    .tcolr_cen2 {
        width: 60%;
        float: left;
        font-size: 10px;
        text-align: left;
    }
    .tcoll_ad {
        width: 30%;
        float: left;
        font-size: 10px;
        text-align: left;
    }
    .tcolr_ad {
        width: 70%;
        float: left;
        font-size: 10px;
        text-align: left;
    }
    .divDetalles{
        float: left;
        width: 100%;
        position: absolute;      
        left: 0;
        margin-top: 10px;
    }
    .divDetalleAd{
        float: left;
        width: 65%;
        position: absolute;      
        left: 0;
    }
    .divDetalleTot{  
        width: 35%;
        position: absolute;      
        right: 0;
    }
    .div_modInfoAd{
        float: left;
        width: 70%;
    }
    .div_modInfoVal{
        float: left;
        width: 100%;       
    }
    .div_modInfoDet{
        float: left;
        width: 60%;
    }
    .div_modInfoDet2{
        float: left;
        width: 75%;
    }
    .div_modInfoDet1{
        float: left;
        width: 40%;
    }    
    .bordeDivDet{ 
        border: 1px solid #000000;       
        -moz-border-radius: 7px;
        -webkit-border-radius: 7px;
        padding: 10px;
    }    
    .valorAlign{ 
        text-align: right !important;
    }

    .bold{
        font-weight: bold;
    }
    .blue{
        color:#002060 !important;
    }
</style>
<div>

    <div class="blue" style="text-align: center">
        <br><br>
        <p><strong><?php echo "HOJA DE VIDA"; ?></strong></p><br><br><br><br>
    </div>
    <div style="text-align: right">
        <br>
        <p></strong></p><br><br>
    </div>

    <!--<div style="text-align: right">
        <br>
        <p></p><br><br>
    </div>-->

    <div class="blue">
        <br><br>
        <p><u><b><?php echo "1.- DATOS PERSONALES" ?></b><br></u></p><br>
        <p><?php echo "APELLIDOS Y NOMBRES:"  ."      ". $persona_model['per_pri_apellido']. ' '. $persona_model['per_seg_apellido']. ' '. $persona_model['per_pri_nombre']. ' '. $persona_model['per_seg_apellido']; ?><br></p><br>
        <p><?php echo "CÉDULA / PASAPORTE:" ."      ". $persona_model['per_cedula']?><br></p><br>
        <p><?php echo "NACIONALIDAD:" ."      ". $persona_model['per_nacionalidad']?><br></p><br>
        <p><?php echo "FECHA DE NACIMIENTO:" ."      ". $persona_model['per_fecha_nacimiento']?><br></p><br>
        <p><?php echo "CIUDAD:" ."      ". $canton['ciudad']?><br></p><br>
        <p><?php echo "DIRECCIÓN:" ."      ". $persona_model['per_domicilio_cpri']. ' '. $persona_model['per_domicilio_csec']. ' '. $persona_model['per_domicilio_num'];?><br></p><br>
        <p><?php echo "TELÉFONO FIJO:" ."      ". $persona_model['per_domicilio_telefono']?><br></p><br>
        <p><?php echo "CELULAR:" ."      ". $persona_model['per_celular']?><br></p><br>
        <p><?php echo "CORREO ELECTRÓNICO:" ."      ". $persona_model['per_correo']?><br></p><br>
        <br><br>
        
    </div>
    <div class="blue">
        <p><u><b><?php echo "2.- INSTRUCCIÓN" ?></b><br></u></p><br><br>
        <p><?php echo "tabla..."?><br></p><br>
    </div>
    <div class="blue">
        <p><u><b><?php echo "3.- EXPERIENCIA DOCENTE" ?></b><br></u></p><br><br>
        <p><?php echo "tabla..."?><br></p><br>
    </div>
    <div class="blue">
        <p><u><b><?php echo "4.- EXPERIENCIA PROFESIONAL" ?></b><br></u></p><br><br>
        <p><?php echo "tabla..."?><br></p><br>
    </div>
    <div class="blue">
        <p><u><b><?php echo "5.- SUFICIENCIA DE IDIOMA" ?></b><br></u></p><br><br>
        <p><?php echo "tabla..."?><br></p><br>
    </div>
    <div class="blue">
        <p><u><b><?php echo "6.- PARTICIPACIÓN EN PROYECTOS DE INVESTIGACIÓN" ?></b><br></u></p><br><br>
        <p><?php echo "tabla..."?><br></p><br>
    </div>
    <div class="blue">
        <p><u><b><?php echo "7.- CAPACITACIÓN ESPECÍFICA" ?></b><br></u></p><br><br>
        <p><?php echo "tabla..."?><br></p><br>
    </div>
    <div class="blue">
        <p><u><b><?php echo "8.- CONFERENCIAS, PONENCIAS Y EXPOSITOR" ?></b><br></u></p><br><br>
        <p><?php echo "tabla..."?><br></p><br>
    </div>
    <div class="blue">
        <p><u><b><?php echo "9.- PUBLICACIONES" ?></b><br></u></p><br><br>
        <p><?php echo "tabla..."?><br></p><br>
    </div>
    <div class="blue">
        <p><u><b><?php echo "10.- DIRECCIÓN O CODIRECCIÓN DE TESIS DE MAESTRÍA Y PREGRADO" ?></b><br></u></p><br><br>
        <p><?php echo "tabla..."?><br></p><br>
    </div>
    <div class="blue">
        <p><u><b><?php echo "11.- REFERENCIAS LABORALES" ?></b><br></u></p><br><br>
        <p><?php echo "tabla..."?><br></p><br>
    </div>
    <div class="blue">
        <p><u><b><?php echo "12.- OTROS" ?></b><br></u></p><br><br>
        <p><?php echo "tabla..."?><br></p><br>
    </div>      
    <!--<table>
        <tbody>
            <tr>
                <td>Alumno:</td>
                <td><?php //echo $cabFact['Nombres'] ?></td>
                <td></td>
            </tr>
            <tr>
                <td>C.C. No.:</td>
                <td><?php //echo $cabFact['per_cedula'] ?></td>
                <td></td>
            </tr>
            <tr>
                <td>Teléfono:</td>
                <td><?php //echo $cabFact['per_celular'] ?></td>                
            </tr>
        </tbody>
    </table>-->

</div>
