<?php
namespace app\controllers;

use Yii;
//use app\models\SolicitudInscripcion;
//use app\models\Interesado;
use yii\helpers\ArrayHelper;

class VinculacionController extends \app\components\CController { 
    
     public function actionCreate() { 
         
         return $this->render('create', [                             
            ]);
     }
     
      public function actionGuardarproject() {
        
        //$modpersona = new Persona;
        $modvinculacion = new Vinculacion();
        //$modcontactogeneral = new ContactoGeneral();
        //$modpercorinstitucional = new PersonaCorreoInstitucional();
       // $per_id = Yii::$app->session->get("PB_perid");
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $usuario = @Yii::$app->session->get("PB_iduser");
            
            $con = \Yii::$app->db_general;
            $transaction = $con->beginTransaction();

            if ($data["upload_file"]) {
                if (empty($_FILES)) {
                    echo json_encode(['error' => Yii::t("notificaciones", "Error to process File {file}. Try again.", ['{file}' => basename($files['name'])])]);
                    return;
                }
            }
        }
        
      }
            
    
    
}