<?php

namespace app\modules\academico\models;

use yii\data\ArrayDataProvider;
use Yii;

/**
 * This is the model class for table "distributivo_academico".
 *
 * @property int $daca_id
 * @property int $paca_id
 * @property int $ppro_id
 * @property int $daho_id
 * @property int $asi_id
 * @property int $pro_id
 * @property int $uaca_id
 * @property int $mod_id
 * @property string $daca_jornada
 * @property string $daca_horario
 * @property string $daca_fecha_registro
 * @property int $daca_usuario_ingreso
 * @property int $daca_usuario_modifica
 * @property string $daca_estado
 * @property string $daca_fecha_creacion
 * @property string $daca_fecha_modificacion
 * @property string $daca_estado_logico
 *
 * @property UnidadAcademica $uaca
 * @property Profesor $pro
 * @property Asignatura $asi
 * @property Modalidad $mod
 */
class DistributivoAcademico extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'distributivo_academico';
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
            [['pro_id', 'asi_id', 'uaca_id', 'daca_estado', 'daca_estado_logico'], 'required'],
            [['pro_id', 'asi_id', 'uaca_id', 'paca_id', 'ppro_id', 'daho_id'], 'integer'],
            [['daca_fecha_creacion', 'daca_fecha_modificacion', 'daca_fecha_registro'], 'safe'],
            [['daca_estado', 'daca_estado_logico'], 'string', 'max' => 1],
            [['uaca_id'], 'exist', 'skipOnError' => true, 'targetClass' => UnidadAcademica::className(), 'targetAttribute' => ['uaca_id' => 'uaca_id']],
            [['pro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profesor::className(), 'targetAttribute' => ['pro_id' => 'pro_id']],
            [['asi_id'], 'exist', 'skipOnError' => true, 'targetClass' => Asignatura::className(), 'targetAttribute' => ['asi_id' => 'asi_id']],
            [['mod_id'], 'exist', 'skipOnError' => true, 'targetClass' => Modalidad::className(), 'targetAttribute' => ['mod_id' => 'mod_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pro_id' => 'Asi ID',
            'asi_id' => 'Scon ID',
            'uaca_id' => 'Uaca ID',
            'paca_id' => 'paca_id',
            'ppro_id' => 'ppro_id',
            'daho_id' => 'daho_id',
            'mod_id' => 'mod_id',
            'daca_fecha_registro' => 'daca_fecha_registro',
            'daca_usuario_ingreso' => 'Usuario Ingreso',
            'daca_usuario_modifica' => 'Usuario Modifica',
            'daca_estado' => 'Estado',
            'daca_fecha_creacion' => 'Fecha Creacion',
            'daca_fecha_modificacion' => 'Fecha Modificacion',
            'daca_estado_logico' => 'Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUaca() {
        return $this->hasOne(UnidadAcademica::className(), ['uaca_id' => 'uaca_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPro() {
        return $this->hasOne(Profesor::className(), ['pro_id' => 'pro_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsi() {
        return $this->hasOne(Asignatura::className(), ['asi_id' => 'asi_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMod() {
        return $this->hasOne(Modalidad::className(), ['mod_id' => 'mod_id']);
    }

    public function getListadoDistributivo($search = NULL, $modalidad = NULL, $asignatura = NULL, $jornada = NULL, $unidadAcademico = NULL, $periodoAcademico = NULL, $onlyData = false){
        $con_academico = \Yii::$app->db_academico;
        $con_db = \Yii::$app->db;
        $search_cond = "%" . $search . "%";
        $estado = "1";
        $str_search = "";
        $str_unidad = "";
        $str_periodo = "";
        $str_modalidad = "";
        $str_jornada = "";
        // array("0" => "Todos", "1" => "(M) Matutino", "2" => "(N) Nocturno", "3" => "(S) Semipresencial", "4" => "(D) Distancia")

        if (isset($search) && $search != "") {
            $str_search = "(pe.per_pri_nombre like :search OR ";
            $str_search .= "pe.per_pri_apellido like :search OR ";
            $str_search .= "pe.per_cedula like :search) AND ";
        }
        if (isset($modalidad) && $modalidad > 0) {
            $str_modalidad = "m.mod_id = :modalidad AND ";
        }
        if (isset($asignatura) && $asignatura > 0) {
            $str_asignatura = "a.asi_id = :asignatura AND ";
        }
        if (isset($unidadAcademico) && $unidadAcademico > 0) {
            $str_unidad = "ua.uaca_id = :unidad AND ";
        }
        if (isset($periodoAcademico) && $periodoAcademico > 0) {
            $str_periodo = "pa.paca_id = :periodo AND ";
        }
        if (isset($jornada) && $jornada > 0) {
            $str_jornada = "dh.daho_jornada = :jornada AND ";
        }

        $sql = "SELECT 
                    da.daca_id AS Id, 
                    CONCAT(pe.per_pri_nombre, ' ', pe.per_pri_apellido) AS Nombres,
                    pe.per_cedula AS Cedula,
                    ua.uaca_nombre AS UnidadAcademica,
                    m.mod_nombre AS Modalidad,
                    ifnull(CONCAT(blq.baca_anio,' (',blq.baca_nombre,'-',sem.saca_nombre,')'),blq.baca_anio) AS Periodo,
                    a.asi_nombre AS Asignatura,
                    CASE
                        WHEN dh.daho_jornada = 1 THEN '(M) Matutino'
                        WHEN dh.daho_jornada = 2 THEN '(N) Nocturno'
                        WHEN dh.daho_jornada = 3 THEN '(S) Semipresencial'
                        WHEN dh.daho_jornada = 4 THEN '(D) Distancia'
                        ELSE ''
                    END AS Jornada
                FROM 
                    " . $con_academico->dbname . ".distributivo_academico AS da 
                    LEFT JOIN " . $con_academico->dbname . ".distributivo_academico_horario AS dh ON da.daho_id = dh.daho_id
                    INNER JOIN " . $con_academico->dbname . ".profesor AS p ON da.pro_id = p.pro_id
                    INNER JOIN " . $con_academico->dbname . ".modalidad AS m ON da.mod_id = m.mod_id
                    INNER JOIN " . $con_academico->dbname . ".unidad_academica AS ua ON da.uaca_id = ua.uaca_id
                    INNER JOIN " . $con_academico->dbname . ".asignatura AS a ON da.asi_id = a.asi_id
                    INNER JOIN " . $con_academico->dbname . ".periodo_academico AS pa ON da.paca_id = pa.paca_id
                    INNER JOIN " . $con_db->dbname . ".persona AS pe ON p.per_id = pe.per_id
                    LEFT JOIN " . $con_academico->dbname . ".semestre_academico sem  ON sem.saca_id = pa.saca_id 
                    LEFT JOIN " . $con_academico->dbname . ".bloque_academico blq ON blq.baca_id = pa.baca_id
                WHERE 
                    $str_search 
                    $str_modalidad 
                    $str_asignatura
                    $str_unidad
                    $str_periodo
                    $str_jornada
                    pa.paca_activo = 'A' AND
                    pa.paca_estado = :estado AND
                    da.daca_estado_logico = :estado AND 
                    da.daca_estado = :estado AND
                    p.pro_estado_logico = :estado AND 
                    p.pro_estado = :estado AND
                    m.mod_estado_logico = :estado AND 
                    m.mod_estado = :estado AND
                    ua.uaca_estado_logico = :estado AND 
                    ua.uaca_estado = :estado AND
                    pa.paca_estado_logico = :estado AND 
                    pa.paca_estado = :estado AND
                    pa.paca_estado_logico = :estado AND 
                    pa.paca_estado = :estado AND
                    pa.paca_estado_logico = :estado ";
        $comando = $con_academico->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        if (isset($search) && $search != "") {
            $comando->bindParam(":search", $search_cond, \PDO::PARAM_STR);
        }
        if (isset($modalidad) && $modalidad != "") {
            $comando->bindParam(":modalidad", $modalidad, \PDO::PARAM_INT);
        }
        if (isset($asignatura) && $asignatura != "") {
            $comando->bindParam(":asignatura", $asignatura, \PDO::PARAM_INT);
        }
        if (isset($unidadAcademico) && $unidadAcademico != "") {
            $comando->bindParam(":unidad", $unidadAcademico, \PDO::PARAM_INT);
        }
        if (isset($periodoAcademico) && $periodoAcademico != "") {
            $comando->bindParam(":periodo", $periodoAcademico, \PDO::PARAM_INT);
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
                'attributes' => ['Nombres', "Cedula", "UnidadAcademica", "Modalidad", "Periodo"],
            ],
        ]);

        return $dataProvider;
    }

    public function getHorariosByUnidadAcad($uaca_id = null, $mod_id = null, $jornada_id = null){
        $con_academico = \Yii::$app->db_academico;
        $str_condition = "";
        if (isset($uaca_id) && $uaca_id > 0) {
            $str_condition .= "uaca_id = :uaca_id AND ";
        }
        if (isset($mod_id) && $mod_id > 0) {
            $str_condition .= "mod_id = :mod_id AND ";
        }
        if (isset($jornada_id) && $jornada_id > 0) {
            $str_condition .= "daho_jornada = :jornada_id AND ";
        }
        $sql = "SELECT 
                    @row_number:=@row_number+1 as id,
                    daho_horario AS name
                FROM 
                    " . $con_academico->dbname . ".distributivo_academico_horario, (SELECT @row_number:=0) AS t 
                WHERE
                    $str_condition
                    daho_estado = 1 AND
                    daho_estado_logico = 1
                GROUP BY
                    daho_horario
                ORDER BY
                    daho_horario ASC";
        $comando = $con_academico->createCommand($sql);
        if (isset($uaca_id) && $uaca_id > 0)    $comando->bindParam(":uaca_id", $uaca_id, \PDO::PARAM_INT);
        if (isset($mod_id) && $mod_id > 0)    $comando->bindParam(":mod_id", $mod_id, \PDO::PARAM_INT);
        if (isset($jornada_id) && $jornada_id > 0)  $comando->bindParam(":jornada_id", $jornada_id, \PDO::PARAM_STR);
        $res = $comando->queryAll();
        return $res;
    }

    public function getJornadasByUnidadAcad($uaca_id = null, $mod_id = null){
        $con_academico = \Yii::$app->db_academico;
        $str_condicion = "";
        if (isset($uaca_id) && $uaca_id > 0) {
            $str_condicion .= "uaca_id = :uaca_id AND ";
        }
        if (isset($mod_id) && $mod_id > 0) {
            $str_condicion .= "mod_id = :mod_id AND ";
        }
        $sql = "SELECT 
                    daho_jornada as id,
                    CASE
                        WHEN daho_jornada = 1 THEN '(M) Matutino'
                        WHEN daho_jornada = 2 THEN '(N) Nocturno'
                        WHEN daho_jornada = 3 THEN '(S) Semipresencial'
                        WHEN daho_jornada = 4 THEN '(D) Distancia'
                        ELSE ''
                    END AS name
                FROM 
                    " . $con_academico->dbname . ".distributivo_academico_horario
                WHERE
                    $str_condicion
                    daho_estado = 1 AND
                    daho_estado_logico = 1
                GROUP BY
                    daho_jornada
                ORDER BY
                    daho_jornada DESC";
        $comando = $con_academico->createCommand($sql);
        if (isset($uaca_id) && $uaca_id > 0)    $comando->bindParam(":uaca_id", $uaca_id, \PDO::PARAM_INT);
        if (isset($mod_id) && $mod_id > 0)    $comando->bindParam(":mod_id", $mod_id, \PDO::PARAM_INT);
        $res = $comando->queryAll();
        return $res;
    }

    public function existsDistribucionAcademico($pro_id, $asi_id, $uaca_id, $mod_id, $paca_id, $jornada, $horario){
        $con_academico = \Yii::$app->db_academico;
        $sql = "SELECT 
                    da.daca_id as id,
                    dah.daho_id as daho_id
                FROM 
                    " . $con_academico->dbname . ".distributivo_academico AS da
                    INNER JOIN " . $con_academico->dbname . ".distributivo_academico_horario AS dah ON da.daho_id = dah.daho_id
                WHERE
                    da.paca_id =:paca_id AND
                    da.pro_id =:pro_id AND 
                    da.asi_id =:asi_id AND 
                    dah.uaca_id =:uaca_id AND 
                    dah.mod_id =:mod_id AND 
                    dah.daho_horario =:horario AND 
                    dah.daho_jornada =:jornada AND
                    da.daca_estado = 1 AND
                    da.daca_estado_logico = 1 AND
                    dah.daho_estado = 1 AND
                    dah.daho_estado_logico = 1";
        $comando = $con_academico->createCommand($sql);
        $comando->bindParam(":paca_id", $paca_id, \PDO::PARAM_INT);
        $comando->bindParam(":pro_id", $pro_id, \PDO::PARAM_INT);
        $comando->bindParam(":asi_id", $asi_id, \PDO::PARAM_INT);
        $comando->bindParam(":uaca_id", $uaca_id, \PDO::PARAM_INT);
        $comando->bindParam(":mod_id", $mod_id, \PDO::PARAM_INT);
        $comando->bindParam(":jornada", $jornada, \PDO::PARAM_STR);
        $comando->bindParam(":horario", $horario, \PDO::PARAM_STR);
        $res = $comando->queryOne();
        return $res;
    }

    public function getDistribucionAcademicoHorario($uaca_id, $mod_id, $jornada, $horario){
        $con_academico = \Yii::$app->db_academico;
        $sql = "SELECT 
                    dah.daho_id as daho_id
                FROM 
                    " . $con_academico->dbname . ".distributivo_academico_horario AS dah
                WHERE
                    dah.uaca_id =:uaca_id AND 
                    dah.mod_id =:mod_id AND 
                    dah.daho_horario =:horario AND 
                    dah.daho_jornada =:jornada AND
                    dah.daho_estado = 1 AND
                    dah.daho_estado_logico = 1
                ORDER BY 
                    dah.daho_id DESC";
        $comando = $con_academico->createCommand($sql);
        $comando->bindParam(":uaca_id", $uaca_id, \PDO::PARAM_INT);
        $comando->bindParam(":mod_id", $mod_id, \PDO::PARAM_INT);
        $comando->bindParam(":jornada", $jornada, \PDO::PARAM_STR);
        $comando->bindParam(":horario", $horario, \PDO::PARAM_STR);
        $res = $comando->queryOne();
        return $res;
    }

}
