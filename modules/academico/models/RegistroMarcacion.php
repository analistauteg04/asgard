<?php

namespace app\modules\academico\models;

use Yii;
use yii\data\ArrayDataProvider;

/**
 * This is the model class for table "registro_marcacion".
 *
 * @property int $rmar_id
 * @property string $rmar_tipo
 * @property int $pro_id
 * @property int $hape_id
 * @property string $rmar_fecha_hora_entrada
 * @property string $rmar_fecha_hora_salida
 * @property string $rmar_direccion_ip
 * @property int $usu_id
 * @property string $rmar_estado
 * @property string $rmar_fecha_creacion
 * @property string $rmar_fecha_modificacion
 * @property string $rmar_estado_logico
 *
 * @property Profesor $pro
 * @property HorarioAsignaturaPeriodo $hape
 */
class RegistroMarcacion extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'registro_marcacion';
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
            [['rmar_tipo', 'pro_id', 'hape_id', 'rmar_direccion_ip', 'usu_id', 'rmar_estado', 'rmar_estado_logico'], 'required'],
            [['pro_id', 'hape_id', 'usu_id'], 'integer'],
            [['rmar_fecha_hora_entrada', 'rmar_fecha_hora_salida', 'rmar_fecha_creacion', 'rmar_fecha_modificacion'], 'safe'],
            [['rmar_tipo', 'rmar_estado', 'rmar_estado_logico'], 'string', 'max' => 1],
            [['rmar_direccion_ip'], 'string', 'max' => 20],
            [['pro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profesor::className(), 'targetAttribute' => ['pro_id' => 'pro_id']],
            [['hape_id'], 'exist', 'skipOnError' => true, 'targetClass' => HorarioAsignaturaPeriodo::className(), 'targetAttribute' => ['hape_id' => 'hape_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'rmar_id' => 'Rmar ID',
            'rmar_tipo' => 'Rmar Tipo',
            'pro_id' => 'Pro ID',
            'hape_id' => 'Hape ID',
            'rmar_fecha_hora_entrada' => 'Rmar Fecha Hora Entrada',
            'rmar_fecha_hora_salida' => 'Rmar Fecha Hora Salida',
            'rmar_direccion_ip' => 'Rmar Direccion Ip',
            'usu_id' => 'Usu ID',
            'rmar_estado' => 'Rmar Estado',
            'rmar_fecha_creacion' => 'Rmar Fecha Creacion',
            'rmar_fecha_modificacion' => 'Rmar Fecha Modificacion',
            'rmar_estado_logico' => 'Rmar Estado Logico',
        ];
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
    public function getHape() {
        return $this->hasOne(HorarioAsignaturaPeriodo::className(), ['hape_id' => 'hape_id']);
    }

    /**
     * Function consultarMateriasMarcabyPro
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>    
     * @property integer $userid
     * @return  
     */
    public function consultarMateriasMarcabyPro($per_id, $dia) {
        $con = \Yii::$app->db_academico;

        $estado = 1;
        $sql = "
               SELECT 
                    hap.hape_id as id,
                    concat(hap.hape_hora_entrada, '-',hap.hape_hora_salida) as horario,
                    hap.dia_id as dia,
                    hap.uaca_id as unidad,
                    hap.mod_id as modalidad,
                    asig.asi_nombre as materia,
                    hap.pro_id as profesor
                    FROM
                    " . $con->dbname . ".horario_asignatura_periodo hap
                    INNER JOIN " . $con->dbname . ".profesor prof ON prof.pro_id = hap.pro_id
                    INNER JOIN " . $con->dbname . ".asignatura asig ON asig.asi_id = hap.asi_id
                    INNER JOIN " . $con->dbname . ".periodo_academico paca ON paca.paca_id = hap.paca_id    
                    WHERE
                    hap.dia_id = :dia AND
                    prof.per_id = :per_id AND
                    hap.hape_estado = :estado AND
                    hap.hape_estado_logico = :estado AND
                    prof.pro_estado = :estado AND
                    prof.pro_estado_logico = :estado AND
                    asig.asi_estado = :estado AND
                    asig.asi_estado_logico = :estado  AND
                    paca.paca_activo = 'A'
               ";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
        $comando->bindParam(":dia", $dia, \PDO::PARAM_INT);
        $resultData = $comando->queryAll();
        $dataProvider = new ArrayDataProvider([
            'key' => 'id',
            'allModels' => $resultData,
            'pagination' => [
                'pageSize' => Yii::$app->params["pageSize"],
            ],
            'sort' => [
                'attributes' => [
                    'contacto',
                    'carrera',
                    'per_correo',
                    'estado',
                ],
            ],
        ]);
        if ($onlyData) {
            return $resultData;
        } else {
            return $dataProvider;
        }
    }

    /**
     * Function consultarMarcacionExiste
     * @author  Giovanni Vergara <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  Consulta una marcacion.
     */
    public function consultarMarcacionExiste($hape_id, $profesor, $fecha, $rmar_tipo) {
        $con = \Yii::$app->db_academico;
        $estado = 1;
        $fecha_registro = "%" . $fecha . "%";
        $sql = "
                    SELECT
                        count(*) as marcacion
                    FROM 
                        " . $con->dbname . ".registro_marcacion rem                    
                    WHERE
                        rem.hape_id= :hape_id AND
                        rem.pro_id= :profesor AND
                        rem.rmar_fecha_creacion like :fecha AND  
                        rem.rmar_tipo = :rmar_tipo AND
                        rem.rmar_estado = :estado AND
                        rem.rmar_estado_logico = :estado";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":hape_id", $hape_id, \PDO::PARAM_INT);
        $comando->bindParam(":profesor", $profesor, \PDO::PARAM_INT);  
        $comando->bindParam(":fecha", $fecha_registro, \PDO::PARAM_STR);
        $comando->bindParam(":rmar_tipo", $rmar_tipo, \PDO::PARAM_STR);
        $resultData = $comando->queryOne();
        return $resultData;
    }
    
    /**
     * Function insertarMarcacion crea marcacion.
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @param
     * @return
     */
    public function insertarMarcacion($rmar_tipo, $pro_id, $hape_id, $rmar_fecha_hora_entrada, $rmar_fecha_hora_salida, $rmar_direccion_ip, $usu_id) {
        $con = \Yii::$app->db_academico;
        $rmar_fecha_creacion = date(Yii::$app->params["dateTimeByDefault"]); 
        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        $param_sql = "rmar_estado";
        $bdet_sql = "1";

        $param_sql .= ", rmar_estado_logico";
        $bdet_sql .= ", 1";

        if (isset($rmar_tipo)) {
            $param_sql .= ", rmar_tipo";
            $bdet_sql .= ", :rmar_tipo";
        }
        if (isset($pro_id)) {
            $param_sql .= ", pro_id";
            $bdet_sql .= ", :pro_id";
        }
        if (isset($hape_id)) {
            $param_sql .= ", hape_id";
            $bdet_sql .= ", :hape_id";
        }       
        if (isset($rmar_fecha_hora_entrada)) {
            $param_sql .= ", rmar_fecha_hora_entrada";
            $bdet_sql .= ", :rmar_fecha_hora_entrada";
        }
        if (isset($rmar_fecha_hora_salida)) {
            $param_sql .= ", rmar_fecha_hora_salida";
            $bdet_sql .= ", :rmar_fecha_hora_salida";
        }
        if (isset($rmar_direccion_ip)) {
            $param_sql .= ", rmar_direccion_ip";
            $bdet_sql .= ", :rmar_direccion_ip";
        }        
        if (isset($usu_id)) {
            $param_sql .= ", usu_id";
            $bdet_sql .= ", :usu_id";
        } 
        if (isset($rmar_fecha_creacion)) {
            $param_sql .= ", rmar_fecha_creacion";
            $bdet_sql .= ", :rmar_fecha_creacion";
        }

        try {
            $sql = "INSERT INTO " . $con->dbname . ".registro_marcacion ($param_sql) VALUES($bdet_sql)";
            $comando = $con->createCommand($sql);

            if (isset($rmar_tipo)) {
                $comando->bindParam(':rmar_tipo', $rmar_tipo, \PDO::PARAM_STR);
            }
            if (isset($pro_id)) {
                $comando->bindParam(':pro_id', $pro_id, \PDO::PARAM_INT);
            }
            if (isset($hape_id)) {
                $comando->bindParam(':hape_id', $hape_id, \PDO::PARAM_INT);
            }
            if (isset($rmar_fecha_hora_entrada)) {
                $comando->bindParam(':rmar_fecha_hora_entrada', $rmar_fecha_hora_entrada, \PDO::PARAM_STR);
            }
            if (isset($rmar_fecha_hora_salida)) {
                $comando->bindParam(':rmar_fecha_hora_salida', $rmar_fecha_hora_salida, \PDO::PARAM_STR);
            }
            if (isset($rmar_direccion_ip)) {
                $comando->bindParam(':rmar_direccion_ip', $rmar_direccion_ip, \PDO::PARAM_STR);
            }
            if (!empty((isset($usu_id)))) {
                $comando->bindParam(':usu_id', $usu_id, \PDO::PARAM_INT);
            }      
            if (!empty((isset($rmar_fecha_creacion)))) {
                $comando->bindParam(':rmar_fecha_creacion', $rmar_fecha_creacion, \PDO::PARAM_STR);
            }

            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.registro_marcacion');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }

}
