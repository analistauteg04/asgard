<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\webservices;

use yii;
use app\models\Http;
use yii\helpers\Url;

/**
 * Description of ConsumirWsdl
 *
 * @author root
 */
class WsMailChimp
{

    //Variables Locales
    private $apiKey     = "";
    public  $apiVersion = "3.0";
    private $dc     = "";
    private $uri    = "api.mailchimp.com";
    private $apiUrl = "";

    public function __construct()
    {
        $this->apiKey  = "7cd00cff6bdeae6bbd5752d3c88479f8-us8";
        $arr_data = explode("-",$this->apiKey);
        $this->dc = $arr_data[1];
        $this->apiUrl  = "https://" . $this->dc . "." . $this->uri . "/" . $this->apiVersion . "/";
    }



    

}
