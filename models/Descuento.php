<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "descuento".
 *
 * @property int $des_id
 * @property string $des_descripcion
 * @property int $des_porcentaje
 * @property string $des_estado
 * @property string $des_fecha_creacion
 * @property string $des_fecha_modificacion
 * @property string $des_estado_logico
 *
 * @property HistorialDescuentoItem[] $historialDescuentoItems
 */
class Descuento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'descuento';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_facturacion');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['des_descripcion', 'des_porcentaje'], 'required'],
            [['des_porcentaje'], 'integer'],
            [['des_fecha_creacion', 'des_fecha_modificacion'], 'safe'],
            [['des_descripcion'], 'string', 'max' => 60],
            [['des_estado', 'des_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'des_id' => 'Des ID',
            'des_descripcion' => 'Des Descripcion',
            'des_porcentaje' => 'Des Porcentaje',
            'des_estado' => 'Des Estado',
            'des_fecha_creacion' => 'Des Fecha Creacion',
            'des_fecha_modificacion' => 'Des Fecha Modificacion',
            'des_estado_logico' => 'Des Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistorialDescuentoItems()
    {
        return $this->hasMany(HistorialDescuentoItem::className(), ['des_id' => 'des_id']);
    }
             
    /**
     * Function grabar la inserción de descuento en item.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function insertarDescuentoItem($ite_id, $dite_porcentaje, $dite_descripcion, $dite_fecha_inicio, $dite_fecha_fin) {
        $con = \Yii::$app->db_facturacion;
        
        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }
        $estado_descuento = "A";
        $param_sql = "dite_estado_logico";
        $bdes_sql = "1";

        $param_sql .= ", dite_estado";
        $bdes_sql .= ", 1";
                      
        if (isset($ite_id)) {
            $param_sql .= ", ite_id";
            $bdes_sql .= ", :ite_id";
        }
        if (isset($dite_porcentaje)) {
            $param_sql .= ", dite_porcentaje";
            $bdes_sql .= ", :dite_porcentaje";
        }
        if (isset($dite_descripcion)) {
            $param_sql .= ", dite_descripcion";
            $bdes_sql .= ", :dite_descripcion";
        }
        if (isset($dite_fecha_inicio)) {
            $param_sql .= ", dite_fecha_inicio";
            $bdes_sql .= ", :dite_fecha_inicio";
        }        
        if (isset($dite_fecha_fin)) {
            $param_sql .= ", dite_fecha_fin";
            $bdes_sql .= ", :dite_fecha_fin";
        }
        if (isset($estado_descuento)) {
            $param_sql .= ", dite_estado_descuento";
            $bdes_sql .= ", :dite_estado_descuento";
        }
        
        try {
            $sql = "INSERT INTO " . $con->dbname . ".descuento_item ($param_sql) VALUES($bdes_sql)";
            $comando = $con->createCommand($sql);

            if (isset($dite_porcentaje)) {
                $comando->bindParam(':dite_porcentaje', $dite_porcentaje, \PDO::PARAM_INT);
            }
            if (isset($dite_descripcion)) {
                $comando->bindParam(':dite_descripcion', $dite_descripcion, \PDO::PARAM_STR);
            }
            if (isset($ite_id)) {
                $comando->bindParam(':ite_id', $ite_id, \PDO::PARAM_INT);
            }
            if (isset($dite_fecha_inicio)) {
                $comando->bindParam(':dite_fecha_inicio', $dite_fecha_inicio, \PDO::PARAM_STR);
            }
            if (isset($dite_fecha_fin)) {
                $comando->bindParam(':dite_fecha_fin', $dite_fecha_fin, \PDO::PARAM_STR);
            }
            if (isset($estado_descuento)) {
                $comando->bindParam(':dite_estado_descuento', $estado_descuento, \PDO::PARAM_STR);
            }
            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.descuento_item');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }
    
    /**
     * Function grabar la inserción de historial de descuento en item.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function insertarHistDescuentoItem($ite_id, $hdit_porcentaje, $hdit_descripcion, $hdit_fecha_inicio, $hdit_fecha_fin, $hdit_usu_transaccion) {
        $con = \Yii::$app->db_facturacion;

        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        $param_sql = "hdit_estado_logico";
        $bdes_sql = "1";

        $param_sql .= ", hdit_estado";
        $bdes_sql .= ", 1";

        if (isset($hdit_porcentaje)) {
            $param_sql .= ", hdit_porcentaje";
            $bdes_sql .= ", :hdit_porcentaje";
        }
        if (isset($hdit_descripcion)) {
            $param_sql .= ", hdit_descripcion";
            $bdes_sql .= ", :hdit_descripcion";
        }
        if (isset($ite_id)) {
            $param_sql .= ", ite_id";
            $bdes_sql .= ", :ite_id";
        }
        if (isset($hdit_fecha_inicio)) {
            $param_sql .= ", hdit_fecha_inicio";
            $bdes_sql .= ", :hdit_fecha_inicio";
        }        
        if (isset($hdit_fecha_fin)) {
            $param_sql .= ", hdit_fecha_fin";
            $bdes_sql .= ", :hdit_fecha_fin";
        }
        if (isset($hdit_usu_transaccion)) {
            $param_sql .= ", hdit_usu_transaccion";
            $bdes_sql .= ", :hdit_usu_transaccion";
        }
        
        try {
            $sql = "INSERT INTO " . $con->dbname . ".historial_descuento_item ($param_sql) VALUES($bdes_sql)";
            $comando = $con->createCommand($sql);

            if (isset($hdit_porcentaje)) {
                $comando->bindParam(':hdit_porcentaje', $hdit_porcentaje, \PDO::PARAM_INT);
            }
            if (isset($hdit_descripcion)) {
                $comando->bindParam(':hdit_descripcion', $hdit_descripcion, \PDO::PARAM_INT);
            }
            if (isset($ite_id)) {
                $comando->bindParam(':ite_id', $ite_id, \PDO::PARAM_INT);
            }
            if (isset($hdit_fecha_inicio)) {
                $comando->bindParam(':hdit_fecha_inicio', $hdit_fecha_inicio, \PDO::PARAM_STR);
            }
            if (isset($hdit_fecha_fin)) {
                $comando->bindParam(':hdit_fecha_fin', $hdit_fecha_fin, \PDO::PARAM_STR);
            }
            if (isset($hdit_usu_transaccion)) {
                $comando->bindParam(':hdit_usu_transaccion', $hdit_usu_transaccion, \PDO::PARAM_INT);
            }
            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.historial_descuento_item');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }        
    
    /**
     * Function Obtiene el descuento del item.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarDescuentoItem($ite_id) {
        $con = \Yii::$app->db_facturacion;
        $estado = 1;
        $sql = "SELECT dite_id
                FROM 
                   " . $con->dbname . ".descuento_item  
                WHERE 
                   ite_id = :ite_id  AND
                   dite_estado = :estado AND
                   dite_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":ite_id", $ite_id, \PDO::PARAM_INT);

        $resultData = $comando->queryOne();
        return $resultData;
    }
    
    /**
     * Function modificarDescuentoItem que actualiza los datos de descuentos de item.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function modificarDescuentoItem($ite_id, $des_id, $fechaIni, $fechaFin) {

        $con = \Yii::$app->db_facturacion;
        $estado = 1;
        $fecha_modificacion = date("Y-m-d H:i:s");        

        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".descuento_item		       
                      SET   des_id = ifnull(:des_id,des_id),
                            dite_fecha_inicio = ifnull(:dite_fecha_inicio, dite_fecha_inicio),
                            dite_fecha_fin = ifnull(:dite_fecha_fin, dite_fecha_fin),
                            dite_fecha_modificacion = :dite_fecha_modificacion
                      WHERE 
                        ite_id = :ite_id AND                        
                        dite_estado = :estado AND
                        dite_estado_logico = :estado");

            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
            $comando->bindParam(":dite_fecha_modificacion", $fecha_modificacion, \PDO::PARAM_STR);
            $comando->bindParam(":ite_id", $ite_id, \PDO::PARAM_INT);           
            $comando->bindParam(":des_id", $des_id, \PDO::PARAM_INT);  
            $comando->bindParam(":dite_fecha_inicio", $fechaIni, \PDO::PARAM_STR);
            $comando->bindParam(":dite_fecha_fin", $fechaFin, \PDO::PARAM_STR);

            $response = $comando->execute();

            if ($trans !== null)
                $trans->commit();
            return $response;
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }
}
