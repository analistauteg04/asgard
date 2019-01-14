<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * https://dev.placetopay.com/web/redirection/
 * https://dev.placetopay.com/web/api-redireccion/
 */

namespace app\widgets\PbVPOS;

use Yii;
use yii\base\Widget;
use app\models\Http;
use app\widgets\PbVPOS\assets\VPOSAsset;

class PbVPOS extends Widget {
    private static $widget_name = "PbVPOS";
    protected $login = "f06b5be68e988a6248b528d3a85c43e8";
    protected $secret = "jeb3d66Sfhyml5LO";
    protected $transKey = "";
    protected $seed = "";
    protected $nounce = "";
    protected $payment_gateway = "test.placetopay.ec";
    protected $port = "443";

    public $referenceID = "";
    public $requestID = "";
    public $moneda = "USD";
    public $pais = "EC";
    public $nombre_cliente = "";
    public $apellido_cliente = "";
    public $email_cliente = "";
    public $descripcionItem = "";
    public $subtotal = "";
    public $total = "";
    public $iva = "";
    public $expirationMin = "10";
    public $session = "";
    public $isCheckout = false;
    public $returnUrl = "";
    public $locale = "es_EC";
    public $ipAddress = "127.0.0.1";
    public $type = "button"; // boton, form
    public $titleBox = ""; 

    public function init()
    {
        parent::init();
        $this->generateAuthetication();
        $this->registerClientScript();
        $this->registerTranslations();
    }

    public function run()
    {
        $data = [
            "titleBox" => $this->titleBox,
            "nombre_cliente" => $this->nombre_cliente,
            "apellido_cliente" => $this->apellido_cliente,
            "email_cliente" => $this->email_cliente,
            "total" => $this->total,
            "referenceID" => $this->referenceID,
        ];
        
        $response = $this->redirectRequest();
        echo json_encode($response);
        //if($response["status"]["status"] != "FAILED") {
        if($response["status"]["status"] != "OK"){
            echo $this->render('error');
        }else{
            $requestId  = $response["requestId"];
            $processUrl = $response["processUrl"];
            //$data["processUrl"] = "http://www.penblu.com";
            $data["processUrl"] = $processUrl;
            if($this->type == "button")
                echo $this->render('button', $data);
            else
                echo $this->render('form', $data);
            //return Html::encode($this->message);
        }
    }

    private function generateAuthetication(){
        $this->seed = date('c');
        $nonce = "";
        if (function_exists('random_bytes')) {
            $nonce = bin2hex(random_bytes(16));
        } elseif (function_exists('openssl_random_pseudo_bytes')) {
            $nonce = bin2hex(openssl_random_pseudo_bytes(16));
        } else {
            $nonce = mt_rand();
        }
        $this->nounce   = base64_encode($nonce);
        $this->transKey = base64_encode(sha1($nounce . $this->seed . $this->secret, true));
    }

    public function redirectRequest(){
        $WS_URI = "redirection/api/session";
        $params = [
            "auth" => [
                "login" => $this->login,
                "seed" => $this->seed,
                "nonce" => $this->nounce,
                "tranKey" => $this->transKey,
            ],
            "locale" => $this->locale,
            "buyer" => [
                "name" => $this->nombre_cliente,
                "surname" => $this->apellido_cliente,
                "email" => $this->email_cliente,
                /*"document" => "",
                "documentType" => "",
                "address" => [
                    "street" => "",
                    "city" => "",
                    "country" => "",
                ],*/
            ],
            "payment" => [
                "reference"   => $this->referenceID,
                "description" => $this->descripcionItem,
                "amount" => [
                    "currency" => $this->moneda,
                    "total" => $this->total,
                ],
                "allowPartial" => false,
            ],
            "expiration" => date('c', strtotime('+'.$this->expirationMin.' minutes', strtotime(date("Y-m-d H:i:s")))),
            "returnUrl"  => $this->returnUrl,
            "ipAddress"  => $this->ipAddress,
            "userAgent"  => $_SERVER['HTTP_USER_AGENT'], 
        ];
        //\app\models\Utilities::putMessageLogFile($params);
        $response = Http::connect($this->payment_gateway, $this->port, http::HTTPS)
            ->setHeaders(array('Content-Type: application/json', 'Accept: application/json'))
            //->setCredentials($user, $apiKey)
            ->doPost($WS_URI, json_encode($params));
        $arr_response = json_decode($response, true);
        return $arr_response;
    }

    public function getInfoPayment($requestID){
        $WS_URI = "redirection/api/session/".$requestID;
        $params = [
            "auth" => [
                "login" => $this->login,
                "seed" => $this->seed,
                "nonce" => $this->nounce,
                "tranKey" => $this->transKey,
            ],
            "ipAddress" => $this->ipAddress,
            "userAgent" => $_SERVER['HTTP_USER_AGENT'],
        ];
        //\app\models\Utilities::putMessageLogFile($params);
        $response = Http::connect($this->payment_gateway, $this->port, http::HTTPS)
            ->setHeaders(array('Content-Type: application/json', 'Accept: application/json'))
            //->setCredentials($user, $apiKey)
            ->doPost($WS_URI, json_encode ($params));
        $arr_response = json_decode($response, true);
        return $arr_response;
    }

    public function getNotificationPayment($data){
        $status  = $data["status"]["status"];
        $message = $data["status"]["message"];
        $reason  = $data["status"]["reason"];
        $dateNot = $data["status"]["date"];
        $requestId   = $data["requestId"];
        $referenceId = $data["reference"];
        $signature   = $data["signature"];
        $verifySig   = sha1($requestId . $status . $dateNot . $this->secret, true);
        if($signature == $verifySig){
            if ($status == "APPROVED") {

            } else {

            }
        }
    }

    /**
     * Registers required scripts
     */
    public function registerClientScript()
    {
        $view = $this->getView();
        $assetVPOS = VPOSAsset::register($view);
        //$view->registerJs($script, View::POS_END, $id);
        /*
        $view->registerJsFile(
            '@widgets/PbVPOS/js/lightbox.min.js',
            ['depends' => [\yii\web\JqueryAsset::className()]]
        );
        $view->registerJsFile(
            '@widgets/PbVPOS/js/script.js',
            ['depends' => [\yii\web\JqueryAsset::className()]]
        );
        $view->registerCssFile(
            "@widgets/PbVPOS/css/style.css", [
            'depends' => [\yii\bootstrap\BootstrapAsset::className()],
            'media' => 'print',
        ], 'vpos-style');
        */
    }

    public function registerTranslations()
    {
        $fileMap = $this->getMessageFileMap();
        $i18n = Yii::$app->i18n;
        $i18n->translations['widgets/' . self::$widget_name . '/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            //'sourceLanguage' => 'en-US',
            'basePath' => '@app/widgets/' . self::$widget_name . '/messages',
            'fileMap' => $fileMap,
        ];
    }

    private function getMessageFileMap()
    {
        // read directory message
        $arrLangFiles = array();
        $dir_messages = __DIR__ . DIRECTORY_SEPARATOR . "messages";
        $fileMap = array();
        $listDirs = scandir($dir_messages);
        foreach ($listDirs as $dir) {
            if ($dir != "." && $dir != "..") {
                $langDir = scandir($dir_messages . DIRECTORY_SEPARATOR . $dir);
                foreach ($langDir as $langFile) {
                    if (preg_match("/\.php$/", trim($langFile))) {
                        if (!in_array($langFile, $arrLangFiles)) {
                            $arrLangFiles[] = $langFile;
                            $file = str_replace(".php", "", $langFile);
                            $key = "widgets/" . self::$widget_name . "/" . $file;
                            $fileMap[$key] = $langFile;
                        }
                    }
                }
            }
        }
        return $fileMap;
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('widgets/' . self::$widget_name . '/' . $category, $message, $params, $language);
    }
}