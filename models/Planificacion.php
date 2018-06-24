<?php

namespace app\models;

use app\models\Persona;
use Yii;
use yii\data\ArrayDataProvider;

/**
 * This is the model class for table "expediente_profesor".
 *
 * @property integer $epro_id
 * @property integer $per_id
 * @property string $epro_estado
 * @property string $epro_fecha_creacion
 * @property string $epro_fecha_modificacion
 * @property string $epro_estado_logico
 */
class Programacion extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'docente_asigntura';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb() {
        return Yii::$app->get('db_academico');
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['per_id', 'epro_estado', 'dasi_estado'], 'required'],
            [['per_id'], 'integer'],
            [['dasi_fecha_creacion', 'dasi_fecha_modificacion'], 'safe'],
            [['dasi_estado', 'dasi_estado_logico'], 'string', 'max' => 1],
        ];
    }

    public function attributeLabels() {
        return [
            'dasi_id' => 'Dasi ID',
            'dasi_id' => 'Per ID',
            'dasi_estado' => 'Dasi Estado',
            'dasi_fecha_creacion' => 'Dasi Fecha Creacion',
            'dasi_fecha_modificacion' => 'Dasi Fecha Modificacion',
            'dasi_estado_logico' => 'Dasi Estado Logico',
        ];
    }
    
    public function insertarDoc_materia($per_id,$casi_id,$nint_id ) {
        $con = \Yii::$app->db_academico;

        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }
        

        $param_sql = "dasi_estado_logico    ";
        $bdet_sql = "1";

        $param_sql .= ", dasi_estado";
        $bdet_sql .= ", 1";

        if (isset($per_id)) {
            $param_sql .= ", per_id";
            $bdet_sql .= ", :per_id";
        }
        
        if (isset($casi_id)) {
            $param_sql .= ", casi_id";
            $bdet_sql .= ", :casi_id";
        }
        
        if (isset($nint_id)) {
            $param_sql .= ", nint_id";
            $bdet_sql .= ", :nint_id";
        }
        try {
            $sql = "INSERT INTO " .$con->dbname. ".docente_asigntura ($param_sql) VALUES($bdet_sql)";
            $comando = $con->createCommand($sql);

            if (isset($per_id))
                $comando->bindParam(':per_id', $per_id, \PDO::PARAM_INT);
            if (isset($casi_id))
                $comando->bindParam(':casi_id', $casi_id, \PDO::PARAM_INT);
            if (isset($nint_id))
                $comando->bindParam(':nint_id', $nint_id, \PDO::PARAM_INT);            
            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.docente_asigntura');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
        
        
    }
    
}