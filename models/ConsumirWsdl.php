<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use yii;
use yii\helpers\Url;
use SoapClient;

/**
 * Description of ConsumirWsdl
 *
 * @author root
 */
class ConsumirWsdl {

    //Variables Locales
    private $usuario="";
    private $clave="";
    private $wdsl = "https://campusvirtual.uteg.edu.ec/soap/?wsdl=true";

    function __construct() {
        $this->usuario = 'webservice';
        $this->clave = 'WxrrvTt8';
    }
 
    private function webServiceCliente($wdsl, $param, $metodo) {
        //'password' => self::$clave
        $options = array(
            'login' => $this->usuario,
            'password' => $this->clave
        );
        try {
            //$cliente = new SoapClient($wdsl);
            $cliente = new SoapClient($wdsl, $options);
            $response = $cliente->__soapCall($metodo, $param);
            $arroout["status"] = "OK";
            $arroout["error"] = 0;
            $arroout["message"] = 'Respuesta Ok WebService: ' . $metodo;
            $arroout["data"] = $response;
            return $arroout;
        } catch (\SoapFault $e) {
            $arroout["status"] = "NO";
            $arroout["error"] = $e->getCode();
            $arroout["message"] = $e->getMessage();
            $arroout["data"] = null;
            return $arroout;
        }
        
    }

    public function consultar_grupos() {
        //$wdsl=self::$wdsl;  
        $wdsl= $this->wdsl;
        
        //<s:element name="id_usuario" type="s:string"/><s:element name="clave" 
        //type="s:string"/><s:element name="id_grupo" type="s:integer" minOccurs="0" maxOccurs="1"/>
        $param = array(
            'id_usuario' => '0923531792',
            'clave' => '0500573209',
            'id_grupo' => 0
        );       
        $param=array();
        $metodo = 'obtener_idiomas';
        return ConsumirWsdl::webServiceCliente($wdsl, $param, $metodo);
    }

}
