<?php

namespace app\modules\academico\models;

use yii\data\ArrayDataProvider;
use Yii;

/**
 * This is the model class for table "estudiante".
 *
 * @property int $est_id
 * @property int $per_id
 * @property int $est_usuario_ingreso
 * @property int $est_usuario_modifica
 * @property string $est_estado
 * @property string $est_fecha_creacion
 * @property string $est_fecha_modificacion
 * @property string $est_estado_logico
 *
 * @property Matriculacion[] $matriculacions
 * @property MatriculacionProgramaInscrito[] $matriculacionProgramaInscritos
 */
class Estudiante extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'estudiante';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb() {
        return Yii::$app->get('db_academico');
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['per_id', 'est_usuario_ingreso', 'est_estado', 'est_estado_logico'], 'required'],
            [['per_id', 'est_usuario_ingreso', 'est_usuario_modifica'], 'integer'],
            [['est_fecha_creacion', 'est_fecha_modificacion'], 'safe'],
            [['est_estado', 'est_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'est_id' => 'Est ID',
            'per_id' => 'Per ID',
            'est_usuario_ingreso' => 'Est Usuario Ingreso',
            'est_usuario_modifica' => 'Est Usuario Modifica',
            'est_estado' => 'Est Estado',
            'est_fecha_creacion' => 'Est Fecha Creacion',
            'est_fecha_modificacion' => 'Est Fecha Modificacion',
            'est_estado_logico' => 'Est Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatriculacions() {
        return $this->hasMany(Matriculacion::className(), ['est_id' => 'est_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatriculacionProgramaInscritos() {
        return $this->hasMany(MatriculacionProgramaInscrito::className(), ['est_id' => 'est_id']);
    }

    /**
     * Function guardar estudiante
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>
     * @param   
     * @return  $resultData (Retornar el código de estudiante).
     */
    public function insertarEstudiante($per_id, $est_matricula, $est_usuario_ingreso, $est_usuario_modifica, $est_fecha_creacion, $est_fecha_modificacion ) {

        $con = \Yii::$app->db_academico;
        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }
        $param_sql = "est_estado_logico";
        $bsol_sql = "1";

        $param_sql .= ", est_estado";
        $bsol_sql .= ", 1";
        if (isset($per_id)) {
            $param_sql .= ", per_id";
            $bsol_sql .= ", :per_id";
        }
        
        if (isset($est_matricula)) {
            $param_sql .= ", est_matricula";
            $bsol_sql .= ", :est_matricula";
        }

        if (isset($est_usuario_ingreso)) {
            $param_sql .= ", est_usuario_ingreso";
            $bsol_sql .= ", :est_usuario_ingreso";
        }

        if (isset($est_usuario_modifica)) {
            $param_sql .= ", est_usuario_modifica";
            $bsol_sql .= ", :est_usuario_modifica";
        }
        
        if (isset($est_fecha_creacion)) {
            $param_sql .= ", est_fecha_creacion";
            $bsol_sql .= ", :est_fecha_creacion";
        }

        if (isset($est_fecha_modificacion)) {
            $param_sql .= ", est_fecha_modificacion";
            $bsol_sql .= ", :est_fecha_modificacion";
        }


        try {
            $sql = "INSERT INTO " . $con->dbname . ".estudiante ($param_sql) VALUES($bsol_sql)";
            $comando = $con->createCommand($sql);

            if (isset($per_id)) {
                $comando->bindParam(':per_id', $per_id, \PDO::PARAM_INT);
            }
            
            if (isset($est_matricula)) {
                $comando->bindParam(':est_matricula', $est_matricula, \PDO::PARAM_STR);
            }
            
            if (isset($est_usuario_ingreso)) {
                $comando->bindParam(':est_usuario_ingreso', $est_usuario_ingreso, \PDO::PARAM_INT);
            }
            
            if (isset($est_usuario_modifica)) {
                $comando->bindParam(':est_usuario_modifica', $est_usuario_modifica, \PDO::PARAM_INT);
            }
            
            if (isset($est_fecha_creacion)) {
                $comando->bindParam(':est_fecha_creacion', $est_fecha_creacion, \PDO::PARAM_STR);
            }
            
            if (isset($est_fecha_modificacion)) {
                $comando->bindParam(':est_fecha_modificacion', $est_fecha_modificacion, \PDO::PARAM_STR);
            }
            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.estudiante');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }
    
     /**
     * Function Consultar estudiante existe.
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @property       
     * @return  
     */
    public function getEstudiantexids($per_id) {
        $con = \Yii::$app->db_academico;
        $estado = 1;

        $sql = "SELECT 	
                        count(*) as total
                        
                FROM " . $con->dbname . ".estudiante                     
                WHERE   per_id = :per_id                        
                        AND est_estado = :estado
                        AND est_estado_logico = :estado ";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);   
        $resultData = $comando->queryOne();
        return $resultData;
    }

}
