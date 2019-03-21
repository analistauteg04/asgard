<?php

namespace app\modules\admision\models;
use yii\base\Exception;
use app\modules\admision\models\BitacoraActividadesTmp;
use Yii;

/**
 * This is the model class for table "bitacora_actividades_tmp".
 *
 * @property int $bact_id
 * @property int $opo_id
 * @property int $usu_id
 * @property int $padm_id
 * @property int $eopo_id
 * @property int $oact_id
 * @property string $bact_fecha_registro
 * @property string $bact_descripcion
 * @property string $bact_fecha_proxima_atencion
 */
class BitacoraActividadesTmp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bitacora_actividades_tmp';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_crm');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['opo_id', 'usu_id', 'padm_id', 'eopo_id', 'oact_id'], 'integer'],
            [['bact_fecha_registro', 'bact_fecha_proxima_atencion'], 'safe'],
            [['bact_descripcion'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'bact_id' => 'Bact ID',
            'opo_id' => 'Opo ID',
            'usu_id' => 'Usu ID',
            'padm_id' => 'Padm ID',
            'eopo_id' => 'Eopo ID',
            'oact_id' => 'Oact ID',
            'bact_fecha_registro' => 'Bact Fecha Registro',
            'bact_descripcion' => 'Bact Descripcion',
            'bact_fecha_proxima_atencion' => 'Bact Fecha Proxima Atencion',
        ];
    }
    
    public function uploadFile($usu_id, $padm_id, $file) {
        $filaError = 0;
        $chk_ext = explode(".", $file);
        $con = \Yii::$app->db_crm;
        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }
        if (strtolower(end($chk_ext)) == "csv") {
            //si es correcto, entonces damos permisos de lectura para subir          
            try {
                $handle = fopen($file, "r");
                $cont = 0;
                $this->deletetablaTemp($con);                
                //PersonaGestionTmp::deletetablaTemp($con);
                while (($data = fgetcsv($handle, ",")) !== FALSE) {
                    $filaError++;
                    if ($cont != 0) {
                        $model = new BitacoraActividadesTmp(); //isset
                        $respOport = $model->consultarOportunidad($data[0]);
                        if (!($respOport)) {                            
                            $bandera= '0';
                        }
                        $respEstadoOpo = $model->consultarEstadoXoportunidad($data[1]);
                        if (!($respEstadoOpo)) {                            
                            $bandera= '0';
                        }
                        $respObservaOpo = $model->consultarObservacionXoportunidad($data[2]);
                        if (!($respObservaOpo)) {                            
                            $bandera= '0';
                        }
                        if ($bandera == '0') {
                            $arroout["status"] = FALSE;
                            $arroout["error"] = null;
                            $arroout["message"] = " Error en la Fila => N°$filaError Código Oportunidad => $data[5]";
                            $arroout["data"] = null;
                            throw new Exception('Error, Item no almacenado');
                        }                        
                        $model->opo_id = $data[0];
                        $model->usu_id = $usu_id; //"$data[1]";
                        $model->padm_id = $padm_id;
                        $model->eopo_id = $data[1]; //"$data[3]";
                        $model->oact_id = $data[2]; //"$data[4]";
                        $model->bact_fecha_registro = "$data[3]";                        
                        $model->bact_fecha_proxima_atencion = "$data[4]";
                        $model->bact_descripcion = "$data[5]";
                        if (!$model->save()) {
                            $arroout["status"] = FALSE;
                            $arroout["error"] = null;
                            $arroout["message"] = " Error en la Fila => N°$filaError Código Oportunidad => $data[5]";
                            $arroout["data"] = null;
                            throw new Exception('Error, Item no almacenado');
                        }
                    }
                    $cont++;
                }
                fclose($handle);
                if ($trans !== null)
                    $trans->commit();

                $arroout["status"] = TRUE;
                $arroout["error"] = null;
                $arroout["message"] = null;
                $arroout["data"] = null;
                //return true;
                return $arroout;
            } catch (Exception $ex) {
                fclose($handle);
                if ($trans !== null)
                    $trans->rollback();
                //return false;
                return $arroout;
            }
        }else if (strtolower(end($chk_ext)) == "xls" || strtolower(end($chk_ext)) == "xlsx") {
            //Create new PHPExcel object
            $objPHPExcel = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
            $dataArr = array();
            try {
                //$sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
                    $worksheetTitle = $worksheet->getTitle();
                    $highestRow = $worksheet->getHighestRow(); // e.g. 10 
                    $highestColumn = $worksheet->getHighestDataColumn(); // e.g 'F'
                    $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
                    //lectura del Archivo XLS filas y Columnas
                    for ($row = 1; $row <= $highestRow; ++$row) {
                        for ($col = 0; $col <= $highestColumnIndex; ++$col) {
                            $cell = $worksheet->getCellByColumnAndRow($col, $row);
                            $val = $cell->getValue();
                            $dataArr[$row][$col] = $val;
                        }
                    }
                    unset($dataArr[1]); // Se elimina la cabecera de titulos del file
                }
                $this->deletetablaTemp($con);
                //PersonaGestionTmp::deletetablaTemp($con);
                $filaError = 1;
                foreach ($dataArr as $val) {
                    $filaError++;                    
                    $model = new BitacoraActividadesTmp(); //isset                    
                    //\app\models\Utilities::putMessageLogFile('data columna 4.'. date("Y-m-d H:i:s", strtotime($val[4])));   
                    \app\models\Utilities::putMessageLogFile('data columna 4.'. date("Y-m-d H:i:s", strtotime($val[4])));   
                    //\app\models\Utilities::putMessageLogFile('data columna 5.'. strtotime($val[5]));                       
                    $respOport = $model->consultarOportunidad($val[1]);
                    if (!($respOport)) {                        
                        $bandera= '0';
                    }
                    $respEstadoOpo = $model->consultarEstadoXoportunidad($val[2]);
                    if (!($respEstadoOpo)) {                        
                        $bandera= '0';
                    }
                    $respObservaOpo = $model->consultarObservacionXoportunidad($val[3]);
                    if (!($respObservaOpo)) {                        
                        $bandera= '0';
                    }
                    if ($bandera == '0') {
                        $arroout["status"] = FALSE;
                        $arroout["error"] = null;
                        $arroout["message"] = " Error en la Fila => N°$filaError Código Oportunidad => $val[1]";
                        $arroout["data"] = null;
                        throw new Exception('Error, Item no almacenado');
                    }
                    $fecha_registro = date("Y-m-d H:i:s", strtotime($val[4]));
                    $fecha_proxima = date("Y-m-d H:i:s", strtotime($val[5]));
                    $model->opo_id = $val[1];
                    $model->usu_id = $usu_id; //"$data[1]";
                    $model->padm_id = $padm_id;
                    $model->eopo_id = $val[2]; //"$data[3]";
                    $model->oact_id = $val[3]; //"$data[4]";
                    $model->bact_fecha_registro = "2019-03-21 11:30:00";                      
                    if ($val[2] == 1) { //Estado en curso
                        $model->bact_fecha_proxima_atencion = "2019-03-22 11:30:00";//$val[5];
                    }
                    $model->bact_descripcion = $val[6];                    
                    if (!$model->save()) {
                        $arroout["status"] = FALSE;
                        $arroout["error"] = null;
                        $arroout["message"] = " Error en la Fila => N°$filaError Código Oportunidad => $val[5]";
                        $arroout["data"] = null;
                        throw new Exception('Error, Item no almacenado');
                    }
                }
                if ($trans !== null)
                    $trans->commit();
                
                $arroout["status"] = TRUE;
                $arroout["error"] = null;
                $arroout["message"] = null;
                $arroout["data"] = null;
                //return true;
                return $arroout;
            } catch (Exception $ex) {
                if ($trans !== null)
                    \app\models\Utilities::putMessageLogFile('se fue por el rollback');  
                    $trans->rollback();
                //return false;
                return $arroout;
            }
        }
    }

    public function deletetablaTemp($con) {
        $sql = "DELETE FROM " . $con->dbname . ".bitacora_actividades_tmp";
        $command = $con->createCommand($sql);
        $command->execute();
    }
    
    public function consultarOportunidad($opo_codigo) {
        $con = \Yii::$app->db_crm;
        $estado = 1;
        $sql = "SELECT opo_id FROM " . $con->dbname . ".oportunidad 
                WHERE opo_codigo = :opo_codigo
                      AND opo_estado = :estado
                      AND opo_estado_logico = :estado";
        \app\models\Utilities::putMessageLogFile('codigo oportunidad'.$opo_codigo);   
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":opo_codigo", $opo_codigo, \PDO::PARAM_STR);
        $resultData = $comando->queryOne();
        return $resultData;
    }
    
    public function consultarEstadoXoportunidad($eopo_id) {
        $con = \Yii::$app->db_crm;
        $estado = 1;
        $sql = "SELECT 'S' existe FROM " . $con->dbname . ".estado_oportunidad 
                WHERE eopo_id = :eopo_id
                      AND eopo_estado = :estado
                      AND eopo_estado_logico = :estado";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":eopo_id", $eopo_id, \PDO::PARAM_STR);
        $resultData = $comando->queryOne();
        return $resultData;
    }
    
    public function consultarObservacionXoportunidad($oact_id) {
        $con = \Yii::$app->db_crm;
        $estado = 1;
        $sql = "SELECT 'S' existe FROM " . $con->dbname . ".observacion_actividades 
                WHERE oact_id = :oact_id
                      AND oact_estado = :estado
                      AND oact_estado_logico = :estado";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":oact_id", $oact_id, \PDO::PARAM_STR);
        $resultData = $comando->queryOne();
        return $resultData;
    }
    
    public function consultarIdXPadm($per_id) {
        $con = \Yii::$app->db_crm;
        $estado = 1;
        $sql = "SELECT padm_id FROM " . $con->dbname . ".personal_admision 
                WHERE per_id = :per_id
                      AND padm_estado = :estado
                      AND padm_estado_logico = :estado";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
        $resultData = $comando->queryOne();
        return $resultData;                
    }
    
    public function consultarBitacoraTemp() {
        $con = \Yii::$app->db_crm;        
        $sql = "SELECT * FROM " . $con->dbname . ".bitacora_actividades_tmp";        
        $comando = $con->createCommand($sql);
        return $comando->queryAll();
    }
}

