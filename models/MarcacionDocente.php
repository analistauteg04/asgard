<?php

namespace app\models;

use app\models\Persona;
use Yii;
use yii\data\ArrayDataProvider;
/**
 * This is the model class for table "marcacion_docente".
 *
 * @property integer $mdoc_id
 * @property integer $per_id
 * @property integer $dasi_id
 * @property string $mdoc_hora_ini
 * @property string $mdoc_hora_fin
 * @property string $mdoc_estado
 * @property string $mdoc_fecha_creacion
 * @property string $mdoc_fecha_modificacion
 * @property string $mdoc_estado_logico
 */
class MarcacionDocente extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'marcacion_docente';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_academico');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['per_id', 'dasi_id', 'mdoc_hora_ini', 'mdoc_hora_fin', 'mdoc_estado', 'mdoc_estado_logico'], 'required'],
            [['per_id', 'dasi_id'], 'integer'],
            [['mdoc_fecha_creacion', 'mdoc_fecha_modificacion'], 'safe'],
            [['mdoc_hora_ini', 'mdoc_hora_fin', 'mdoc_estado', 'mdoc_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mdoc_id' => 'Mdoc ID',
            'per_id' => 'Per ID',
            'dasi_id' => 'Dasi ID',
            'mdoc_hora_ini' => 'Mdoc Hora Ini',
            'mdoc_hora_fin' => 'Mdoc Hora Fin',
            'mdoc_estado' => 'Mdoc Estado',
            'mdoc_fecha_creacion' => 'Mdoc Fecha Creacion',
            'mdoc_fecha_modificacion' => 'Mdoc Fecha Modificacion',
            'mdoc_estado_logico' => 'Mdoc Estado Logico',
        ];
    }
    
    /**
     * Function insertarEvaluacion (Registro de la evluación de los profesores)
     * @author  Jefferson Conde <analistadesarrollo03@uteg.edu.ec>
     * @param   
     * @return  
     */
    public function insertarMarcacionDocente($per_id, $dasi_id, $mdoc_hora_ini, $mdoc_hora_fin) {
        $con = \Yii::$app->db_academico;
        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        $param_sql = "mdoc_estado";
        $bcur_sql = "1";

        $param_sql .= ", mdoc_estado_logico";
        $bcur_sql .= ", 1";

        if (isset($per_id)) {
            $param_sql .= ", per_id";
            $bcur_sql .= ", :per_id";
        }

        if (isset($dasi_id)) {
            $param_sql .= ", dasi_id";
            $bcur_sql .= ", :dasi_id";
        }

        if (isset($mdoc_hora_ini)) { 
            $param_sql .= ", mdoc_hora_ini";
            $bcur_sql .= ", :mdoc_hora_ini";
        }

        if (isset($mdoc_hora_fin)) {
            $param_sql .= ", mdoc_hora_fin";
            $bcur_sql .= ", :mdoc_hora_fin";
        }

      try {
            $sql = "INSERT INTO " . $con->dbname . ".marcacion_docente ($param_sql) VALUES($bcur_sql)";
            $comando = $con->createCommand($sql);

            if (isset($per_id)) {
                $comando->bindParam(':per_id', $per_id, \PDO::PARAM_INT);
            }

            if (isset($dasi_id)) {
                $comando->bindParam(':dasi_id', $dasi_id, \PDO::PARAM_INT);
            }

            if (isset($mdoc_hora_ini)) {
                $comando->bindParam(':mdoc_hora_ini', $mdoc_hora_ini, \PDO::PARAM_STR);
            }

            if (isset($mdoc_hora_fin)) {
                $comando->bindParam(':mdoc_hora_fin', $mdoc_hora_fin, \PDO::PARAM_STR);
            }
            
// \app\models\Utilities::putMessageLogFile('arreglo...excel:' . print_r($comando, true));
           $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.marcacion_docente');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }
    
    /**
     * Function consulta los profesores. 
     * @author Jefferson Conde <analistadesarrollo03@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarMateriaPlanif($per_id, $data) {
        $con = \Yii::$app->db_academico;
        $estado = 1;
        $sql = "SELECT asg.apac_id as id, 
                      asg.apac_nombre as name                     
                FROM 
                    " . $con->dbname . ".horario_docente_asig hda
                Join asignatura_planificacion_acad asg 
                  on upper(hda.hdas_materia) = upper(asg.apac_nombre)                    
                WHERE hda.per_id =:per_id  and 
                apac_estado  =:estado 
                AND apac_estado_logico=:estado                 
                ORDER BY name";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
        $resultData = $comando->queryAll();
        $dataProvider = new ArrayDataProvider([
            'key' => 'id',
            'allModels' => $resultData,
            'pagination' => [
                'pageSize' => Yii::$app->params["pageSize"],
            ],
            'sort' => [
                'attributes' => [],
            ],
        ]);       
        if ($data == 1) {
            return $resultData;
        } else {
            return $dataProvider;
        }
    }

    
}
