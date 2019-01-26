<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('PHPMailerAutoload.php');
class mailSystem {
    private $domEmpresa='uteg.edu.ec';
    private $mailSMTP='mail.uteg.edu.ec';
    //private $noResponder='no-responder@uteg.edu.ec';
    private $noResponder='developer@uteg.edu.ec';
    private $adminMail='developer@uteg.edu.ec';//Cambiar 
    private $noResponderPass='developer1806';//Clave de correo NO responder
    public $Subject='Ha Recibido un(a)  Nuevo(a)!!! ';
    public $file_to_attachXML='';
    public $file_to_attachPDF='';
    public $fileXML='';
    public $filePDF='';
    
    //Valida si es un Email Correcto Devuelve True
    private function valid_email($val) {
        if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }

    //put your code here
    public function enviarMail($body,$CabPed,$obj_var,$usuData,$fil) {
        $mail = new PHPMailer();
        
        $mail->IsSMTP();
        $mail->SMTPSecure = "ssl";
        $mail->Port = 465;
        // la dirección del servidor, p. ej.: smtp.servidor.com
        $mail->Host = $this->mailSMTP;
        $mail->setFrom($this->noResponder, 'Servicio de envío automático '.$this->domEmpresa);

        // asunto y cuerpo alternativo del mensaje
        $mail->Subject = $this->Subject;
        $mail->AltBody = "Data alternativao";

        // si el cuerpo del mensaje es HTML
        $mail->MsgHTML($body);
        
        //##############################################
        //Separa en Array los Correos Ingresados para enviar
        $DataCorreos = (trim($CabPed[$fil]["CorreoPer"])!='')?explode(";",$CabPed[$fil]["CorreoPer"]):0;
        for ($icor = 0; $icor < count($DataCorreos); $icor++) {
            if ($this->valid_email(trim($DataCorreos[$icor]))) {//Verifica Email Correcto
                $mail->AddAddress(trim($DataCorreos[$icor]), trim($CabPed[$fil]["RazonSoc"]));
            }else{
                //Correos Alternativos de admin  $adminMail
                $mail->addBCC("byron_villacresesf@hotmail.com", "Byron Villa");
                //$mail->addBCC($usuData["CorreoUser"], $usuData["NombreUser"]);//Enviar Correos del Vendedor
            }
        }
        //if($DataCorreos==0){
            //Correos Alternativos de admin  $adminMail
            $mail->addBCC("bvillacreses@utimpor.com", "Byron Villa");
            //$mail->addBCC($usuData["CorreoUser"], $usuData["NombreUser"]);//Enviar Correos del Vendedor
        //}
        
     
        
        /******** COPIA OCULTA PARA VENTAS  ***************/
        //$mail->addBCC('byronvillacreses@gmail.com', 'Byron Villa'); //Para con copia
        
        //$mail->AddAttachment("archivo.zip");//adjuntos un archivo al mensaje
        $mail->AddAttachment($this->file_to_attachXML.$this->fileXML,$this->fileXML);
        $mail->AddAttachment($this->file_to_attachPDF.$this->filePDF,$this->filePDF);
        // si el SMTP necesita autenticación
        $mail->SMTPAuth = true;

        // credenciales usuario
        $mail->Username = $this->noResponder;
        $mail->Password = $this->noResponderPass;
        $mail->CharSet = 'UTF-8';
        //$mail->SMTPDebug = 1;//Muestra el Error

        if (!$mail->Send()) {
            //echo "Error enviando: " . $mail->ErrorInfo;
            return $obj_var->messageSystem('NO_OK', "Error enviando: " . $mail->ErrorInfo, null, null, null);
        } else {
            //echo "¡¡Enviado!!";
            return $obj_var->messageSystem('OK', "¡¡Enviado!!", null, null, null);
        }
    }
    
    public function enviarMailError($DocData) {
        $mail = new PHPMailer();
        $body = 'Error en Documento '.$DocData["tipo"].'-'.$DocData["NumDoc"].'<BR>';
        $body .= 'Error '.$DocData["Error"];
        
        $mail->IsSMTP();
        $mail->SMTPSecure = "ssl";
        $mail->Port = 465;
        $mail->Host = $this->mailSMTP;//"mail.utimpor.com";
        $mail->setFrom($this->noResponder, 'Error Servicio de envío automático '.$this->domEmpresa);

        // asunto y cuerpo alternativo del mensaje
        $mail->Subject = $this->Subject;
        $mail->AltBody = "Data alternativao";

        // si el cuerpo del mensaje es HTML
        $mail->MsgHTML($body);
        $mail->AddAddress("bvillacreses@utimpor.com", "Ing.Byron Villa");

        $mail->SMTPAuth = true;

        // credenciales usuario
        $mail->Username = $this->noResponder;
        $mail->Password = $this->noResponderPass;
        $mail->CharSet = 'UTF-8';
        //$mail->SMTPDebug = 1;//Muestra el Error
        
        $mail->Send();

        /*if (!$mail->Send()) {
            //echo "Error enviando: " . $mail->ErrorInfo;
            return $obj_var->messageSystem('NO_OK', "Error enviando: " . $mail->ErrorInfo, null, null, null);
        } else {
            //echo "¡¡Enviado!!";
            return $obj_var->messageSystem('OK', "¡¡Enviado!!", null, null, null);
        }*/
    }

}
