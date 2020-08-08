<?php

namespace app\modules\academico\models;

use yii\data\ArrayDataProvider;
use Yii;

/**
 * This is the model class for table "distributivo_academico_estudiante".
 *
 * @property int $daes_id
 * @property int $daca_id
 * @property int $est_id
 * @property string $daes_fecha_registro
 * @property string $daes_estado
 * @property string $daes_fecha_creacion
 * @property string $daes_fecha_modificacion
 * @property string $daes_estado_logico
 *
 * @property DistributivoAcademico $daca
 * @property Estudiante $est
 */
class DistributivoAcademicoEstudiante extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'distributivo_academico_estudiante';
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
            [['daca_id', 'est_id', 'daes_estado', 'daes_estado_logico'], 'required'],
            [['daca_id', 'est_id'], 'integer'],
            [['daes_fecha_creacion', 'daes_fecha_modificacion', 'daes_fecha_registro'], 'safe'],
            [['daes_estado', 'daes_estado_logico'], 'string', 'max' => 1],
            [['daca_id'], 'exist', 'skipOnError' => true, 'targetClass' => DistributivoAcademico::className(), 'targetAttribute' => ['daca_id' => 'daca_id']],
            [['est_id'], 'exist', 'skipOnError' => true, 'targetClass' => Estudiante::className(), 'targetAttribute' => ['est_id' => 'est_id']],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEst() {
        return $this->hasOne(Estudiante::className(), ['est_id' => 'est_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDaca() {
        return $this->hasOne(DistributivoAcademico::className(), ['daca_id' => 'daca_id']);
    }

    public function getListadoDistributivoEstudiante($daca_id, $search = null, $onlyData = false){
        $con_academico = \Yii::$app->db_academico;
        $con_db = \Yii::$app->db;
        $search_cond = "%" . $search . "%";
        $estado = "1";
        $str_search = "";

        if (isset($search) && $search != "") {
            $str_search = "(pe.per_pri_nombre like :search OR ";
            $str_search .= "pe.per_pri_apellido like :search OR ";
            $str_search .= "pe.per_cedula like :search) AND ";
        }

        $sql = "SELECT 
                    de.daes_id AS Id,
                    CONCAT(pe.per_pri_nombre, ' ', pe.per_pri_apellido) AS Nombres,
                    pe.per_cedula AS Cedula,
                    pe.per_correo AS Correo,
                    ifnull(pe.per_celular, '') AS Telefono,
                    e.est_matricula AS Matricula,
                    ea.eaca_nombre AS Carrera
                FROM 
                    " . $con_academico->dbname . ".distributivo_academico AS da 
                    INNER JOIN " . $con_academico->dbname . ".distributivo_academico_estudiante AS de ON da.daca_id = de.daca_id
                    INNER JOIN " . $con_academico->dbname . ".estudiante AS e ON e.est_id = de.est_id
                    INNER JOIN " . $con_academico->dbname . ".estudiante_carrera_programa AS ec ON ec.est_id = e.est_id
                    INNER JOIN " . $con_academico->dbname . ".modalidad_estudio_unidad AS mu ON mu.meun_id = ec.meun_id
                    INNER JOIN " . $con_academico->dbname . ".estudio_academico AS ea ON ea.eaca_id = mu.eaca_id
                    INNER JOIN " . $con_db->dbname . ".persona AS pe ON e.per_id = pe.per_id
                WHERE 
                    $str_search 
                    da.daca_id =:daca_id AND 
                    da.daca_estado = :estado AND
                    da.daca_estado_logico = :estado AND 
                    de.daes_estado = :estado AND
                    de.daes_estado_logico = :estado AND 
                    e.est_estado = :estado AND
                    e.est_estado_logico = :estado AND
                    ec.ecpr_estado = :estado AND
                    ec.ecpr_estado_logico = :estado AND
                    mu.meun_estado = :estado AND
                    mu.meun_estado_logico = :estado AND
                    ea.eaca_estado = :estado AND
                    ea.eaca_estado_logico = :estado AND
                    pe.per_estado = :estado AND
                    pe.per_estado_logico = :estado ";

        $comando = $con_academico->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":daca_id", $daca_id, \PDO::PARAM_INT);
        if (isset($search) && $search != "") {
            $comando->bindParam(":search", $search_cond, \PDO::PARAM_STR);
        }

        $res = $comando->queryAll();
        if ($onlyData)
            return $res;
        $dataProvider = new ArrayDataProvider([
            'key' => 'Id',
            'allModels' => $res,
            'pagination' => [
                'pageSize' => Yii::$app->params["pageSize"],
            ],
            'sort' => [
                'attributes' => ['Nombres', "Cedula", "Cedula", "Correo", "Carrera"],
            ],
        ]);

        return $dataProvider;
    }

}
