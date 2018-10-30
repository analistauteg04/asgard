<?php

namespace app\modules\fe_edoc\models;

use Yii;
use app\models\Utilities;

class Client_ApiRest {
    public $test1 = "";
    public $test2 = "";

    function __construct($arr_params = array()) {
        foreach ($arr_params as $key => $value) {
            if ($key == "test1")
                $this->test1 = $value;
            if ($key == "test2")
                $this->test2 = $value;
        }
    }

    public function getTest(){
        return ["test" => "OK", "Params" => ["test1" => $this->test1, "test2" => $this->test2]];
    }

    public function sendMessagesToChat() {
        $usu_id      = $this->usu_id;
        $mensaje     = $this->cmes_mensaje;
        $croo_id     = $this->croo_id;
        $fecha_envio = $this->cmes_fecha_envio;
        $fecha_creacion = date("Y-m-d H:i:s");
        $chat_id = 0;
        $con = Yii::$app->db;
        $trans = $con->getTransaction();
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction();
        }
        if($croo_id == 0){// se debe crear el chat para ambos
            $croo_id = $this->croo_id = $this->createChatRoom();
        }
        if(!$this->verifyUserChat()){
            return array("status" => "NO_OK","chat_id"=> 0);
        }
        $sql = "INSERT INTO chat_message(
                        croo_id,
                        usu_id,
                        cmes_mensaje,
                        cmes_fecha_envio,
                        cmes_estado_recibido,
                        cmes_estado_activo,
                        cmes_fecha_creacion,
                        cmes_estado_logico) 
                    VALUES (
                        :croo_id,
                        :usu_id,
                        :mensaje,
                        :fecha_envio,
                        '0',
                        '1',
                        :fecha_creacion,
                        '1'
                    )";
        try {
            $comando = $con->createCommand($sql);
            $comando->bindParam(":usu_id", $usu_id, \PDO::PARAM_INT);
            $comando->bindParam(":croo_id", $croo_id, \PDO::PARAM_INT);
            $comando->bindParam(":mensaje", $mensaje, \PDO::PARAM_STR);
            $comando->bindParam(":fecha_envio", $fecha_envio, \PDO::PARAM_STR);
            $comando->bindParam(":fecha_creacion", $fecha_creacion, \PDO::PARAM_STR);
            $status = $comando->execute();
            if($status){
                $chat_id = $con->getLastInsertID("chat_message");
            }
            if ($trans !== null){
                $trans->commit();
            }
            return array("status"=>"OK", "chat_id"=>$chat_id, "croo_id"=>$croo_id);
        } catch (\Exception $e) {
            $trans->rollBack();
            //throw $e;
            return array("status" => "NO_OK", "chat_id"=> 0);
        }
    }

}