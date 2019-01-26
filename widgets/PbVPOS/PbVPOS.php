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
use yii\helpers\Url;
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

    public $dbConection = "db_facturacion";

    public function init()
    {
        parent::init();
        $this->generateAuthetication();
        $this->registerClientScript();
        $this->registerTranslations();
    }

    public function run()
    {
        $this->returnUrl = Url::current([], true) . "?referenceID=" . $this->referenceID;
        $response = null;
        $data = [
            "titleBox" => $this->titleBox,
            "nombre_cliente" => $this->nombre_cliente,
            "apellido_cliente" => $this->apellido_cliente,
            "email_cliente" => $this->email_cliente,
            "total" => $this->total,
            "referenceID" => $this->referenceID,
        ];
        //echo json_encode($data);
        if($this->isCheckout === false){
            $response = $this->redirectRequest();
        }else{
            $response = $this->getInfoPayment($this->requestID);
        }
        
        //echo $this->returnUrl;
        //echo json_encode($response);
        //if($response["status"]["status"] != "FAILED") {
        if($response["status"]["status"] != "OK"){
            echo $this->render('error');
        }else{
            if ($this->isCheckout === false) {
                $requestId = $response["requestId"];
                $processUrl = $response["processUrl"];
                $data["processUrl"] = $processUrl;
            }else{

            }
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
        $this->transKey = base64_encode(sha1($nonce . $this->seed . $this->secret, true));
    }

    public function redirectRequest(){
        $WS_URI = "redirection/api/session";
        $params = [
            "auth" => [
                "login" => $this->login,
                "seed"  => $this->seed,
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
        $this->saveRequestDB($params);
        $response = Http::connect($this->payment_gateway, $this->port, http::HTTPS)
            ->setHeaders(array('Content-Type: application/json', 'Accept: application/json'))
            //->setCredentials($user, $apiKey)
            ->doPost($WS_URI, json_encode($params));
        $arr_response = json_decode($response, true);
        $this->saveResponseDB($this->referenceID, $arr_response);
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
        $this->saveInfoResponseDB($arr_response);
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

    private function saveRequestDB($params){
        $con = \Yii::$app->$this->dbConection;
        $reference    = $params["payment"]["reference"];
        $descripcion  = $params["payment"]["description"];
        $currency     = $params["payment"]["amount"]["currency"];
        $total        = $params["payment"]["amount"]["total"];
        $tax          = $params["payment"]["amount"]["tax"];
        $session      = $params["payment"]["reference"];
        $expiration   = $params["expiration"];
        $returnUrl    = $params["returnUrl"];
        $date         = strtotime(date("Y-m-d H:i:s"));
        $document     = "";
        $documentType = "";
        $name         = $params["buyer"]["name"];
        $surname      = $params["buyer"]["surname"];
        $email        = $params["buyer"]["email"];
        $mobile       = "";
        $json_request = json_encode($params);

        $sql = "INSERT INTO " . $con->dbname . ".vpos_request 
            (reference,
            descripcion,
            currency,
            total,
            tax,
            session,
            date,
            returnUrl,
            expiration,
            document,
            documentType,
            name,
            surname,
            email,
            mobile,
            json_request,
            estado_logico)
            VALUES
            (:reference,
            :descripcion,
            :currency,
            :total,
            :tax,
            :session,
            :date,
            :returnUrl,
            :expiration,
            :document,
            :documentType,
            :name,
            :surname,
            :email,
            :mobile,
            :json_request,
            :estado_logico)";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":reference", $reference, \PDO::PARAM_INT);
        $comando->bindParam(":descripcion", $descripcion, \PDO::PARAM_STR);
        $comando->bindParam(":currency", $currency, \PDO::PARAM_STR);
        $comando->bindParam(":total", $total, \PDO::PARAM_STR);
        $comando->bindParam(":tax", $tax, \PDO::PARAM_STR);
        $comando->bindParam(":session", $session, \PDO::PARAM_STR);
        $comando->bindParam(":date", $date, \PDO::PARAM_STR);
        $comando->bindParam(":expiration", $expiration, \PDO::PARAM_STR);
        $comando->bindParam(":document", $document, \PDO::PARAM_STR);
        $comando->bindParam(":documentType", $documentType, \PDO::PARAM_STR);
        $comando->bindParam(":name", $name, \PDO::PARAM_STR);
        $comando->bindParam(":surname", $surname, \PDO::PARAM_STR);
        $comando->bindParam(":email", $email, \PDO::PARAM_STR);
        $comando->bindParam(":mobile", $mobile, \PDO::PARAM_STR);
        $comando->bindParam(":json_request", $json_request, \PDO::PARAM_STR);
        $comando->bindParam(":estado_logico", "1", \PDO::PARAM_STR);
        $comando->execute();
    }

    private function saveResponseDB($referenceId, $params){
        $con = \Yii::$app->$this->dbConection;
        $reference = $referenceId;
        $requestId = $params["requestId"];
        $status    = $params["status"]["status"];
        $reason    = $params["status"]["reason"];
        $message   = $params["status"]["message"];
        $date      = $params["status"]["date"];
        $processUrl    = $params["processUrl"];
        $json_response = json_encode($params);

        $sql = "INSERT INTO " . $con->dbname . ".vpos_response 
            (reference,
            requestId,
            status,
            reason,
            message,
            date,
            processUrl,
            json_response,
            estado_logico)
            VALUES
            (:reference,
            :requestId,
            :status,
            :reason,
            :message,
            :date,
            :processUrl,
            :json_response,
            :estado_logico)";

        $comando->bindParam(":reference", $reference, \PDO::PARAM_INT);
        $comando->bindParam(":requestId", $requestId, \PDO::PARAM_STR);
        $comando->bindParam(":status", $status, \PDO::PARAM_STR);
        $comando->bindParam(":reason", $reason, \PDO::PARAM_STR);
        $comando->bindParam(":message", $message, \PDO::PARAM_STR);
        $comando->bindParam(":date", $date, \PDO::PARAM_STR);
        $comando->bindParam(":processUrl", $processUrl, \PDO::PARAM_STR);
        $comando->bindParam(":json_response", $json_response, \PDO::PARAM_STR);
        $comando->bindParam(":estado_logico", "1", \PDO::PARAM_STR);
        $comando->execute();
    }

    private function saveInfoResponseDB($params){
        $con = \Yii::$app->$this->dbConection;
        $reference = $params["reference"];
        $requestId = $params["requestId"];
        $status = $params["status"]["status"];
        $reason = $params["status"]["reason"];
        $message = $params["status"]["message"];
        $date = $params["status"]["date"];
        
        $payment_status = $params["payment"]["status"]["status"];
        $payment_reason = $params["payment"]["status"]["reason"];
        $payment_message = $params["payment"]["status"]["message"];
        $payment_date = $params["payment"]["status"]["date"];
        $internalReference = $params["payment"]["internalReference"];
        $paymenMethod = $params["payment"]["paymentMethod"];
        $paymentMethodName = $params["payment"]["paymentMethodName"];
        $issuerName = $params["payment"]["issuerName"];
        $autorization = $params["payment"]["authorization"];
        $receipt = $params["payment"]["receipt"];
        $json_info = json_encode($params);

        $sql = "INSERT INTO " . $con->dbname . ".vpos_info_response 
            (reference,
            requestId,
            status,
            reason,
            message,
            date,
            payment_status,
            payment_reason,
            payment_message,
            payment_date,
            internalReference,
            paymenMethod,
            paymentMethodName,
            issuerName,
            autorization,
            receipt,
            json_info,
            estado_logico)
            VALUES
            (:reference,
            :requestId,
            :status,
            :reason,
            :message,
            :date,
            :payment_status,
            :payment_reason,
            :payment_message,
            :payment_date,
            :internalReference,
            :paymenMethod,
            :paymentMethodName,
            :issuerName,
            :autorization,
            :receipt,
            :json_info,
            :estado_logico)";

        $comando->bindParam(":reference", $reference, \PDO::PARAM_INT);
        $comando->bindParam(":requestId", $requestId, \PDO::PARAM_STR);
        $comando->bindParam(":status", $status, \PDO::PARAM_STR);
        $comando->bindParam(":reason", $reason, \PDO::PARAM_STR);
        $comando->bindParam(":message", $message, \PDO::PARAM_STR);
        $comando->bindParam(":date", $date, \PDO::PARAM_STR);
        $comando->bindParam(":payment_status", $payment_status, \PDO::PARAM_STR);
        $comando->bindParam(":payment_reason", $payment_reason, \PDO::PARAM_STR);
        $comando->bindParam(":payment_message", $payment_message, \PDO::PARAM_STR);
        $comando->bindParam(":payment_date", $payment_date, \PDO::PARAM_STR);
        $comando->bindParam(":internalReference", $internalReference, \PDO::PARAM_STR);
        $comando->bindParam(":paymenMethod", $paymenMethod, \PDO::PARAM_STR);
        $comando->bindParam(":paymentMethodName", $paymentMethodName, \PDO::PARAM_STR);
        $comando->bindParam(":issuerName", $issuerName, \PDO::PARAM_STR);
        $comando->bindParam(":autorization", $autorization, \PDO::PARAM_STR);
        $comando->bindParam(":receipt", $receipt, \PDO::PARAM_STR);
        $comando->bindParam(":json_info", $json_info, \PDO::PARAM_STR);
        $comando->bindParam(":estado_logico", "1", \PDO::PARAM_STR);
        $comando->execute();
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