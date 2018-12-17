<?php

/*
 * 
 * Ref API Mailchimp: https://developer.mailchimp.com/documentation/mailchimp/reference/overview/
 * 
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
    private $host    = "api.mailchimp.com";
    private $port   = "443";
    private $user   = "";
    private $apiUrl = "";

    public function __construct()
    {
        $this->apiKey  = "1aa07fb04cd96c63cdba23f9424cd826-us8";
        $this->user = "Uteg";
        $arr_data = explode("-",$this->apiKey);
        $this->dc = $arr_data[1];
        //$this->apiUrl  = "https://" . $this->dc . "." . $this->uri . "/" . $this->apiVersion . "/";
        $this->host = $this->dc . "." . $this->host; //. "/" . $this->apiVersion . "/";
        $this->apiUrl = $this->apiVersion . "/";
    }

    // Get information about all lists
    public function getList(){
        $WS_HOST = $this->host;
        $WS_PORT = $this->port;
        $WS_URI = $this->apiUrl . "lists";
        $params = array();

        $response = Http::connect($WS_HOST, $WS_PORT, http::HTTPS)
            //->setHeaders(array('Content-Type: application/json', 'Accept: application/json'))
            ->setCredentials($this->user, $this->apiKey)
            ->doGet($WS_URI, $params);
        $arr_response = json_decode($response, true);
        return $arr_response;
    }

    // Create a new list
    public function newList($nameList, $from_name, $from_email, $subject, $contact, $lang = "es"){
        $WS_HOST = $this->host;
        $WS_PORT = $this->port;
        $WS_URI = $this->apiUrl . "lists";
        $params = json_encode(array(
            "name" => $nameList,
            /*"contact" => array(
                "company" => "UTEG",
                "address1" => "test1",
                "address2" => "test2",
                "city" => "Guayaquil",
                "state" => "GY",
                "zip" => "12345",
                "country" => "Ecuador",
                "phone" => "112233445566",
            ),*/
            "contact" => $contact,
            "permission_reminder" => "You'\''re receiving this email because you signed up for updates about Freddie'\''s newest hats.",
            "campaign_defaults" => array(
                "from_name" => $from_name,
                "from_email" => $from_email,
                "subject" => $subject,
                "language" => $lang,
            ),
            "email_type_option" => true
        ));

        $response = Http::connect($WS_HOST, $WS_PORT, http::HTTPS)
            ->setHeaders(array('Content-Type: application/json', 'Accept: application/json'))
            ->setCredentials($this->user, $this->apiKey)
            ->doPost($WS_URI, $params);
        $arr_response = json_decode($response, true);
        return $response;
    }

    // Get information about members in a list
    function getMember($memberId){
        $WS_HOST = $this->host;
        $WS_PORT = $this->port;
        $WS_URI = $this->apiUrl . "lists/$memberId/members";
        $params = array();

        $response = Http::connect($WS_HOST, $WS_PORT, http::HTTPS)
            //->setHeaders(array('Content-Type: application/json', 'Accept: application/json'))
            ->setCredentials($this->user, $this->apiKey)
            ->doGet($WS_URI, $params);
        $arr_response = json_decode($response, true);
        return $arr_response;
    }

    // Add a new list member
    function newMember($memberId, $email_member, $tags = array())
    {
        $WS_HOST = $this->host;
        $WS_PORT = $this->port;
        $WS_URI = $this->apiUrl . "lists/$memberId/members";
        $params = json_encode(array(
            "email_address" => $email_member,
            "status" => "subscribed",
            "tags" => $tags,
        ));

        $response = Http::connect($WS_HOST, $WS_PORT, http::HTTPS)
            ->setHeaders(array('Content-Type: application/json', 'Accept: application/json'))
            ->setCredentials($this->user, $this->apiKey)
            ->doPost($WS_URI, $params);
        $arr_response = json_decode($response, true);
        return $arr_response;
    }
    

}
