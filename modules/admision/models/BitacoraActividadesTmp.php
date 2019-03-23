<?php

namespace app\modules\admision\models;
use yii\base\Exception;
use app\modules\admision\models\BitacoraActividadesTmp;
use app\modules\admision\models\PersonaGestion;
use app\modules\academico\models\EstudioAcademico;
use app\modules\academico\models\UnidadAcademica;
use app\modules\academico\models\Modalidad;
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
    
    public function uploadFile($emp_id, $usu_id, $padm_id, $file) {
        $filaError = 0;
        $chk_ext = explode(".", $file);
        $con = \Yii::$app->db_crm;
        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }
        if (strtolower(end($chk_ext)) == "xls" || strtolower(end($chk_ext)) == "xlsx") {            
            //Create new PHPExcel object
            $objPHPExcel = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
            $dataArr = array();
            $model = new BitacoraActividadesTmp(); //isset       
            try {                
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
                $this->deletetablaTemp($con, $usu_id);                
                $filaError = 1;                    
                foreach ($dataArr as $val) {                                        
                    $filaError++;        
                    $modelPerGestion = new PersonaGestion();
                    $modelUnidad = new UnidadAcademica();
                    $modelModalidad = new Modalidad();
                    $modelEstAcademico = new EstudioAcademico();                                           
                    $respIdPerGes = $modelPerGestion::existePersonaGestLeads($val[6], $val[5]);   
                    if (!($respIdPerGes)) {
                        $mensaje = "No se encuentra persona gestión creada.";                                                       
                    }
                    $respUnidad = $modelUnidad::consultarIdsUnid_Academica($val[1]);
                    if (!($respUnidad)) {
                        $mensaje = "No se encuentra unidad.";                        
                    }
                    $respModalidad = $modelModalidad::consultarIdsModalidad($val[2]);
                    if (!($respModalidad)) {
                        $mensaje = "No se encuentra modalidad.";                        
                    }
                    $respEstAcade = $modelEstAcademico::consultarIdsEstudioAca($val[3]);  
                    if (!($respEstAcade)) {
                        $mensaje = "No se encuentra carrera.";                        
                    }                                        
                    $respOport = $model->consultarOportunidad($emp_id, $respIdPerGes, $respEstAcade, $respUnidad, $respModalidad);                    
                    if (!($respOport)) {                           
                        $bandera= '0';
                        $mensaje = "No se encontró ninguna oportunidad asociada.";                                                     
                    }
                    $respEstadoOpo = $model->consultarEstadoXoportunidad($val[7]);
                    if (!($respEstadoOpo)) {                           
                        $bandera= '0';
                        $mensaje = "No se encontró estado de oportunidad.";                           
                    }
                    $respObservaOpo = $model->consultarObservacionXoportunidad($val[8]);
                    if (!($respObservaOpo)) {                          
                        $bandera= '0';
                        $mensaje = "No se encontró código de observación.";                           
                    }
                    if ($val[7] == 5) { //Estado oportunidad perdida
                        $respOpoPerdida = $model->consultarOporPerdida($val[12]);
                        if (!($respOpoPerdida)) {                                 
                            $bandera= '0';
                            $mensaje = "No se encontró código de opotunidad perdida.";                               
                        }
                    }
                    if ($bandera == '0') {
                        $arroout["status"] = FALSE;
                        $arroout["error"] = null;
                        $arroout["message"] = " Error en la Fila => N°$filaError Nombres => $val[4]";
                        $arroout["data"] = null;
                        throw new Exception('Error, Item no almacenado');
                    }
                    \app\models\Utilities::putMessageLogFile('oport:'.$respOport["opo_id"]);
                    $model->opo_id = $respOport["opo_id"];
                    $model->usu_id = $usu_id;
                    $model->padm_id = $padm_id;
                    $model->eopo_id = $val[7];
                    $model->oact_id = $val[8];
                    $model->bact_fecha_registro = $val[9];                    
                    if ($val[7] == 1) { //Estado en curso
                        $model->bact_fecha_proxima_atencion =$val[10];
                    }
                    if ($val[7] == 5) { //Estado oportunidad perdida
                        $model->oper_id =$val[12];                        
                    }
                    $model->bact_descripcion = $val[11];                                         
                    if (!$model->save()) {     
                        //\app\models\Utilities::putMessageLogFile('opor error:'.$respOport["opo_id"]);
                        $arroout["status"] = FALSE;
                        $arroout["error"] = null;
                        $arroout["message"] = " Error en la Fila => N°$filaError Nombres => $val[4]";
                        $arroout["data"] = null;
                        throw new Exception('Error, Item no almacenado');
                    }
                } 
                if ($trans !== null) 
                    \app\models\Utilities::putMessageLogFile('graba');
                    $trans->commit(); 
               
                $arroout["status"] = TRUE;
                $arroout["error"] = null;
                $arroout["message"] = null;
                $arroout["data"] = null;                   
                return $arroout;
            } catch (Exception $ex) {
                if ($trans !== null)                    
                    $trans->rollback(); 
                                    \app\models\Utilities::putMessageLogFile('rollbacjk');
                    $arroout["status"] = FALSE;
                    $arroout["error"] = null;
                    $arroout["message"] = " Error en la Fila => N°$filaError Nombres => $val[4]. $mensaje";
                    $arroout["data"] = null;
                return $arroout;
            }
        }
    }

    public function deletetablaTemp($con, $usu_id) {
        $sql = "DELETE FROM " . $con->dbname . ".bitacora_actividades_tmp where usu_id = :usu_id";
        $command = $con->createCommand($sql);        
        $command->bindParam(":usu_id", $usu_id, \PDO::PARAM_INT);
        $command->execute();
    }
    
    public function consultarOportunidad($emp_id, $pges_id, $eaca_id, $uaca_id, $mod_id) {
        $con = \Yii::$app->db_crm;
        $estado = 1;
        $sql = "SELECT opo_id FROM " . $con->dbname . ".oportunidad 
                WHERE emp_id = :emp_id
                    and pges_id = :pges_id
                    and eaca_id = :eaca_id
                    and uaca_id = :uaca_id
                    and mod_id = :mod_id
                    and opo_estado = :estado
                    and opo_estado_logico = :estado ";                    
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":emp_id", $emp_id, \PDO::PARAM_INT);
        $comando->bindParam(":pges_id", $pges_id, \PDO::PARAM_INT);
        $comando->bindParam(":eaca_id", $eaca_id, \PDO::PARAM_INT);
        $comando->bindParam(":uaca_id", $uaca_id, \PDO::PARAM_INT);
        $comando->bindParam(":mod_id", $mod_id, \PDO::PARAM_INT);
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
        $comando->bindParam(":eopo_id", $eopo_id, \PDO::PARAM_INT);
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
        $comando->bindParam(":oact_id", $oact_id, \PDO::PARAM_INT);
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
    
    public function consultarBitacoraTemp($usu_id) {
        $con = \Yii::$app->db_crm;        
        $sql = "SELECT * FROM " . $con->dbname . ".bitacora_actividades_tmp where usu_id = :usu_id";        
        $comando = $con->createCommand($sql);
        $comando->bindParam(":usu_id", $usu_id, \PDO::PARAM_INT);
        return $comando->queryAll();
    }
    
    
    public function consultarOporPerdida($opoper_id) {
        $con = \Yii::$app->db_crm;
        $estado = 1;
        $sql = "SELECT 'S' existe FROM " . $con->dbname . ".oportunidad_perdida 
                WHERE oper_id = :oper_id
                      AND oper_estado = :estado
                      AND oper_estado_logico = :estado";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":oper_id", $opoper_id, \PDO::PARAM_INT);
        $resultData = $comando->queryOne();
        return $resultData;
    }
    
     /**
     * Function insertarBitacoraNovedades grabar novedades de actividades de una oportunidad.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function insertarBitacoraNovedades($bano_unidad, /*$bano_modalidad, $bano_carrera, $bano_nombre, $bano_telefono, 
                                              $bano_correo, $bano_contacto, $eopo_id, $oact_id, $bano_fecha_registro, $bano_descripcion,
                                              $bano_fecha_proxima_atencion, $oper_id, */$usu_id, $bano_tipoarchivo, $bano_novedad) {            
        $con = \Yii::$app->db_crm;
        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }       
        if (isset($bano_unidad)) {
            $param_sql .= ", bano_unidad";
            $bdet_sql .= ", :bano_unidad";
        }
        /*if (isset($bano_modalidad)) {
            $param_sql .= ", bano_modalidad";
            $bdet_sql .= ", :bano_modalidad";
        }
        if (isset($bano_carrera)) {
            $param_sql .= ", bano_carrera";
            $bdet_sql .= ", :bano_carrera";
        }
        if (isset($bano_nombre)) {
            $param_sql .= ", bano_nombre";
            $bdet_sql .= ", :bano_nombre";
        }
        if (isset($bano_telefono)) {
            $param_sql .= ", bano_telefono";
            $bdet_sql .= ", :bano_telefono";
        }
        if (isset($bano_correo)) {
            $param_sql .= ", bano_correo";
            $bdet_sql .= ", :bano_correo";
        }
        if (isset($bano_contacto)) {
            $param_sql .= ", bano_contacto";
            $bdet_sql .= ", :bano_contacto";
        }
        if (isset($eopo_id)) {
            $param_sql .= ", eopo_id";
            $bdet_sql .= ", :eopo_id";
        }
        if (isset($oact_id)) {
            $param_sql .= ", oact_id";
            $bdet_sql .= ", :oact_id";
        }
        if (isset($bano_fecha_registro)) {
            $param_sql .= ", bano_fecha_registro";
            $bdet_sql .= ", :bano_fecha_registro";
        }
        if (isset($bano_descripcion)) {
            $param_sql .= ", bano_descripcion";
            $bdet_sql .= ", :bano_descripcion";
        }
        if (isset($bano_fecha_proxima_atencion)) {
            $param_sql .= ", bano_fecha_proxima_atencion";
            $bdet_sql .= ", :bano_fecha_proxima_atencion";
        }
        if (isset($oper_id)) {
            $param_sql .= ", oper_id";
            $bdet_sql .= ", :oper_id";
        }*/
        if (isset($usu_id)) {
            $param_sql .= ", usu_id";
            $bdet_sql .= ", :usu_id";
        }
        if (isset($bano_tipoarchivo)) {
            $param_sql .= ", bano_tipoarchivo";
            $bdet_sql .= ", :bano_tipoarchivo";
        }
        if (isset($bano_novedad)) {
            $param_sql .= ", bano_novedad";
            $bdet_sql .= ", :bano_novedad";
        }
        try {
            $sql = "INSERT INTO " . $con->dbname . ".bitacora_actividades_noprocesadas ($param_sql) VALUES($bdet_sql)";
            $comando = $con->createCommand($sql);

            if (isset($bano_unidad)) {
                $comando->bindParam(':bano_unidad', $bano_unidad, \PDO::PARAM_STR);
            }
           /* if (!empty((isset($bano_modalidad)))) {
                $comando->bindParam(':bano_modalidad', $bano_modalidad, \PDO::PARAM_STR);
            }
            if (!empty((isset($bano_carrera)))) {
                $comando->bindParam(':bano_carrera', $bano_carrera, \PDO::PARAM_STR);
            }
            if (!empty((isset($bano_nombre)))) {
                $comando->bindParam(':bano_nombre', $bano_nombre, \PDO::PARAM_STR);
            }
            if (!empty((isset($bano_telefono)))) {
                $comando->bindParam(':bano_telefono', $bano_telefono, \PDO::PARAM_STR);
            }
            if (!empty((isset($bano_correo)))) {
                $comando->bindParam(':bano_correo', $bano_correo, \PDO::PARAM_STR);
            }
            if (!empty((isset($bano_contacto)))) {
                $comando->bindParam(':bano_contacto', $bano_contacto, \PDO::PARAM_STR);
            }
            if (!empty((isset($eopo_id)))) {
                $comando->bindParam(':eopo_id', $eopo_id, \PDO::PARAM_INT);
            }
            if (!empty((isset($oact_id)))) {
                $comando->bindParam(':oact_id', $oact_id, \PDO::PARAM_INT);
            }
            if (!empty((isset($bano_fecha_registro)))) {
                $comando->bindParam(':bano_fecha_registro', $bano_fecha_registro, \PDO::PARAM_STR);
            }
            if (!empty((isset($bano_descripcion)))) {
                $comando->bindParam(':bano_descripcion', $bano_descripcion, \PDO::PARAM_STR);
            }
            if (!empty((isset($bano_fecha_proxima_atencion)))) {
                $comando->bindParam(':bano_fecha_proxima_atencion', $bano_fecha_proxima_atencion, \PDO::PARAM_STR);
            }
            if (!empty((isset($oper_id)))) {
                $comando->bindParam(':oper_id', $oper_id, \PDO::PARAM_INT);
            }*/
            if (!empty((isset($usu_id)))) {
                $comando->bindParam(':usu_id', $usu_id, \PDO::PARAM_INT);
            }
            if (!empty((isset($bano_tipoarchivo)))) {
                $comando->bindParam(':bano_tipoarchivo', $bano_tipoarchivo, \PDO::PARAM_STR);
            }
            if (!empty((isset($bano_novedad)))) {
                $comando->bindParam(':bano_novedad', $bano_novedad, \PDO::PARAM_STR);
            }
            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.bitacora_actividades_noprocesadas');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }
}

