<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pre_interesado".
 *
 * @property integer $pint_id
 * @property integer $per_id
 * @property string $pint_estado_preinteresado
 * @property string $pint_estado
 * @property string $pint_fecha_creacion
 * @property string $pint_fecha_modificacion
 * @property string $pint_estado_logico
 *
 * @property Interesado[] $interesados
 * @property InteresadoEjecutivo[] $interesadoEjecutivos
 */
class PreInteresado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pre_interesado';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_captacion');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['per_id', 'pint_estado', 'pint_estado_logico'], 'required'],
            [['per_id'], 'integer'],
            [['pint_fecha_creacion', 'pint_fecha_modificacion'], 'safe'],
            [['pint_estado_preinteresado', 'pint_estado', 'pint_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pint_id' => 'Pint ID',
            'per_id' => 'Per ID',
            'pint_estado_preinteresado' => 'Pint Estado Preinteresado',
            'pint_estado' => 'Pint Estado',
            'pint_fecha_creacion' => 'Pint Fecha Creacion',
            'pint_fecha_modificacion' => 'Pint Fecha Modificacion',
            'pint_estado_logico' => 'Pint Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInteresados()
    {
        return $this->hasMany(Interesado::className(), ['pint_id' => 'pint_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInteresadoEjecutivos()
    {
        return $this->hasMany(InteresadoEjecutivo::className(), ['pint_id' => 'pint_id']);
    }
    /**
     * Function ConsultaRegistropreins
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @property    $cedula, $pasaporte    
     * @return  
     */
    /**
     * Function modificaPersona
     * @author  Kleber Loayza <analistadesarrollo03@uteg.edu.ec>
     * @property integer $userid
     * @return  
     */
    public function insertarPreInteresado($con,$parameters,$keys,$name_table) {
        $trans = $con->getTransaction(); 
        $param_sql .= "" . $keys[0];
        $bdet_sql .= "'" . $parameters[0]."'";
        for ($i = 1; $i < count($parameters); $i++) {
            if (isset($parameters[$i])) {
                $param_sql .= ", " . $keys[$i];
                $bdet_sql .= ", '" . $parameters[$i]."'";
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
    public function consultaPreInteresadoById($per_id) {
        $con = \Yii::$app->db_captacion;
        $estado = 1;
        $sql = "
                    SELECT
                    ifnull(pint_id,0) as pint_id
                    FROM db_captacion.pre_interesado 
                    WHERE 
                            per_id = $per_id
                       and pint_estado = $estado
                       and pint_estado_logico=$estado
                ";
        $comando = $con->createCommand($sql);
        $resultData = $comando->queryOne();
        if(empty($resultData['pint_id']))
            return 0;
        else {
            return $resultData['pint_id'];    
        }
    }
}
