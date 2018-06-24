<?php
namespace app\controllers;
use Yii;
use yii\helpers\ArrayHelper;
use app\models\Item;
use app\models\SubCategoria;
use app\models\Descuento;


/** 
 * @author Grace Viteri
 */
class FacturacionController extends \app\components\CController {
    public function actionListaritem() {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["getitem"])) {  
                $item = Item::find()->select("ite_id AS id, ite_nombre AS value")->where(["ite_estado_logico" => "1", "ite_estado" => "1", "scat_id" => $data['subcategoria']])->asArray()->all();                    
                $message = array("item" => $item);
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }
        }
        $arr_subcategoria = Subcategoria::find()->select("scat_id AS id, scat_nombre AS value")->where(["scat_estado_logico" => "1", "scat_estado" => "1"])->asArray()->all();
        $arr_item = Item::find()->select("ite_id AS id, ite_nombre AS value")->where(["ite_estado_logico" => "1", "ite_estado" => "1"])->asArray()->all();
        $modelItem = new Item();
        $respItem = $modelItem->listarItems();

        return $this->render('listarItem', [
                            'subcategoria' => ArrayHelper::map($arr_subcategoria, "id", "value"),
                            'item' => ArrayHelper::map($arr_item, "id", "value"),
                            'model' => $respItem,
        ]);        
    }             
    
    public function actionDescuento_item() {
      $item = base64_decode($_GET["ite_id"]);
      $itemDetalle = base64_decode($_GET["item"]);
            
      return $this->render('descuento_item', [                           
                           'ite_id' => $item,
                           'item' => $itemDetalle,
        ]);
    }
    
     public function actionGuardardescuento_item() {      
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $porcentaje = $data["porcentaje"];
            $item_id = $data["ite_id"];
            $fechaIni = $data["fecha_inicio"];
            $fechaFin = $data["fecha_fin"];
            $descripcion = ucwords(strtolower($data["descripcion"]));
            
            $usu_transaccion = @Yii::$app->session->get("PB_iduser");
             
            $modelFact = new Descuento();
            $con = \Yii::$app->db_facturacion;
            $transaction = $con->beginTransaction();
                
            try {
                //Consultar por item si existe el registro.  
                $respExiste = $modelFact->consultarDescuentoItem($item_id);
                if (!($respExiste)) {
                    //Insertar el descuento.
                    $respInsert = $modelFact->insertarDescuentoItem($item_id, $porcentaje, $descripcion, $fechaIni, $fechaFin);
                    if ($respInsert) {
                        //Grabar en tabla histórica.
                        $respInsertHist = $modelFact->insertarHistDescuentoItem($item_id, $porcentaje, $descripcion, $fechaIni, $fechaFin, $usu_transaccion);
                        if ($respInsertHist) {
                            $exito = 1;
                        }
                    }  
                } else {
                    //modificar el descuento.
                    $resp_modifica = $modelFact->modificarDescuentoItem($item_id, $des_id, $fechaIni, $fechaFin);
                    if ($resp_modifica) {
                        //Grabar en tabla histórica.
                       // $respInsertHist = $modelFact->insertarHistDescuentoItem($des_id, $item_id, $fechaIni, $fechaFin, $usu_transaccion);
                       // if ($respInsertHist) {
                            $exito = 1;
                       // }
                    }
                }
                if ($exito) {
                    $transaction->commit();                    
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "La infomación ha sido grabada."),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    echo \app\models\Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                    return;
                } else {                    
                    $transaction->rollback();                    
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error al grabar. " . $mensaje),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    echo \app\models\Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                    return;
                }
                    
            } catch (Exception $ex) {
                $transaction->rollback();                    
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error al grabar. " . $mensaje),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    echo \app\models\Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                    return;
            }
        }
    }
}

