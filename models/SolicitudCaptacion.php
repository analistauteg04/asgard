<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "solicitud_captacion".
 *
 * @property int $rcap_id
 * @property int $per_id
 * @property int $pint_id
 * @property int $uaca_id
 * @property int $ming_id
 * @property int $eaca_id
 * @property int $mpub_id
 * @property string $rcap_fecha_ingreso
 * @property string $rcap_estado
 * @property string $rcap_fecha_creacion
 * @property string $rcap_fecha_modificacion
 * @property string $rcap_estado_logico
 */
class SolicitudCaptacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'solicitud_captacion';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_captacion');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['per_id', 'pint_id', 'rcap_estado', 'rcap_estado_logico'], 'required'],
            [['per_id', 'pint_id', 'uaca_id', 'ming_id', 'eaca_id', 'mpub_id'], 'integer'],
            [['rcap_fecha_ingreso', 'rcap_fecha_creacion', 'rcap_fecha_modificacion'], 'safe'],
            [['rcap_estado', 'rcap_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rcap_id' => 'Rcap ID',
            'per_id' => 'Per ID',
            'pint_id' => 'Pint ID',
            'uaca_id' => 'Uaca ID',
            'ming_id' => 'Ming ID',
            'eaca_id' => 'Eaca ID',
            'mpub_id' => 'Mpub ID',
            'rcap_fecha_ingreso' => 'Rcap Fecha Ingreso',
            'rcap_estado' => 'Rcap Estado',
            'rcap_fecha_creacion' => 'Rcap Fecha Creacion',
            'rcap_fecha_modificacion' => 'Rcap Fecha Modificacion',
            'rcap_estado_logico' => 'Rcap Estado Logico',
        ];
    }
    
    public function consultarSolictudCaptacion($con,$id_persona,$pre_interesado_id) {
        $estado = 1;
        $sql = "
                    SELECT
                    ifnull(rcap_id,0) as rcap_id
                    FROM db_captacion.solicitud_captacion
                    WHERE 
                    per_id = $id_persona
                    and pint_id = $pre_interesado_id
                    and rcap_estado = $estado
                    and rcap_estado_logico=$estado
                ";
        $comando = $con->createCommand($sql);
        $resultData = $comando->queryOne();
        if(empty($resultData['rcap_id']))
            return 0;
        else {
            return $resultData['rcap_id'];    
        }
    }
    
    public function insertarSolicitudCaptacion($con, $parameters, $keys, $name_table) {
        $trans = $con->getTransaction();
        $param_sql .= "" . $keys[0];
        $bdet_sql .= "'" . $parameters[0] . "'";
        for ($i = 1; $i < count($parameters); $i++) {
            if (isset($parameters[$i])) {
                $param_sql .= ", " . $keys[$i];
                $bdet_sql .= ", '" . $parameters[$i] . "'";
            }
        }
        try {
            $sql = "INSERT INTO " . $con->dbname.'.'.$name_table . " ($param_sql) VALUES($bdet_sql);";
            $comando = $con->createCommand($sql);
            $result = $comando->execute();
            $idtable=$con->getLastInsertID($con->dbname . '.' . $name_table);
            if ($trans !== null)
                $trans->commit();
            return $idtable;
        } catch (Exception $ex) {
            if ($trans !== null){
                $trans->rollback();            
            }
            return 0;
        }
    }
}
