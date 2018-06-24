<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "periodo_academico".
 *
 * @property integer $paca_id
 * @property integer $nint_id
 * @property integer $aaca_id
 * @property string $paca_nombre
 * @property string $paca_descripcion
 * @property string $paca_fecha_desde
 * @property string $paca_fecha_hasta
 * @property integer $paca_usuario_ingreso
 * @property integer $paca_usuario_modifica
 * @property string $paca_estado
 * @property string $paca_fecha_creacion
 * @property string $paca_fecha_modificacion
 * @property string $paca_estado_logico
 *
 * @property EvaluacionDesempeno[] $evaluacionDesempenos
 * @property AnioAcademico $aaca
 */
class PeriodoAcademico extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'periodo_academico';
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
            [['nint_id', 'aaca_id', 'paca_nombre', 'paca_descripcion', 'paca_usuario_ingreso', 'paca_estado', 'paca_estado_logico'], 'required'],
            [['nint_id', 'aaca_id', 'paca_usuario_ingreso', 'paca_usuario_modifica'], 'integer'],
            [['paca_fecha_desde', 'paca_fecha_hasta', 'paca_fecha_creacion', 'paca_fecha_modificacion'], 'safe'],
            [['paca_nombre', 'paca_descripcion'], 'string', 'max' => 100],
            [['paca_estado', 'paca_estado_logico'], 'string', 'max' => 1],
            [['aaca_id'], 'exist', 'skipOnError' => true, 'targetClass' => AnioAcademico::className(), 'targetAttribute' => ['aaca_id' => 'aaca_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'paca_id' => 'Paca ID',
            'nint_id' => 'Nint ID',
            'aaca_id' => 'Aaca ID',
            'paca_nombre' => 'Paca Nombre',
            'paca_descripcion' => 'Paca Descripcion',
            'paca_fecha_desde' => 'Paca Fecha Desde',
            'paca_fecha_hasta' => 'Paca Fecha Hasta',
            'paca_usuario_ingreso' => 'Paca Usuario Ingreso',
            'paca_usuario_modifica' => 'Paca Usuario Modifica',
            'paca_estado' => 'Paca Estado',
            'paca_fecha_creacion' => 'Paca Fecha Creacion',
            'paca_fecha_modificacion' => 'Paca Fecha Modificacion',
            'paca_estado_logico' => 'Paca Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluacionDesempenos() {
        return $this->hasMany(EvaluacionDesempeno::className(), ['paca_id' => 'paca_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAaca() {
        return $this->hasOne(AnioAcademico::className(), ['aaca_id' => 'aaca_id']);
    }

    /**
     * Function consulta los tipos de horarios. 
     * @author Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultaTipoHorario() {
        $con = \Yii::$app->db_academico;
        $estado = 1;
        $sql = "SELECT 
                   tho.thor_id  as id,
                   tho.thor_nombre as name
                FROM 
                   " . $con->dbname . ".tipo_horario  tho                      
                WHERE 
                   tho.thor_estado = :estado AND
                   tho.thor_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $resultData = $comando->queryAll();
        return $resultData;
    }

    /**
     * Function consulta los horarios. 
     * @author Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultaHorario() {
        $con = \Yii::$app->db_academico;
        $estado = 1;
        $sql = "SELECT 
                   hor_id as id,
                   CONCAT(hor_inicio, ' -- ', hor_fin) as name 
                FROM 
                   " . $con->dbname . ".horario                    
                WHERE 
                   hor_estado = :estado AND
                   hor_estado_logico = :estado
                ORDER BY hor_inicio";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $resultData = $comando->queryAll();
        return $resultData;
    }

    /**
     * Function insertarHorario (Registro de los horarios)
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>
     * @param   
     * @return  
     */
    public function insertarHorario($tipohorario, $descripcion, $horainicio, $horafin, $lunes, $martes, $miercoles, $jueves, $viernes, $sabado, $domingo, $rama, $usu_id) {
        $con = \Yii::$app->db_academico;
        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        $param_sql = "hor_estado_logico";
        $bcur_sql = "1";

        $param_sql .= ", hor_estado";
        $bcur_sql .= ", 1";

        if (isset($tipohorario)) {
            $param_sql .= ", thor_id";
            $bcur_sql .= ", :thor_id";
        }

        if (isset($descripcion)) {
            $param_sql .= ", hor_descripcion";
            $bcur_sql .= ", :hor_descripcion";
        }

        if (isset($horainicio)) {
            $param_sql .= ", hor_inicio";
            $bcur_sql .= ", :hor_inicio";
        }

        if (isset($horafin)) {
            $param_sql .= ", hor_fin";
            $bcur_sql .= ", :hor_fin";
        }

        if (isset($lunes)) {
            $param_sql .= ", hor_lunes";
            $bcur_sql .= ", :hor_lunes";
        }

        if (isset($martes)) {
            $param_sql .= ", hor_martes";
            $bcur_sql .= ", :hor_martes";
        }
        if (isset($miercoles)) {
            $param_sql .= ", hor_miercoles";
            $bcur_sql .= ", :hor_miercoles";
        }

        if (isset($jueves)) {
            $param_sql .= ", hor_jueves";
            $bcur_sql .= ", :hor_jueves";
        }

        if (isset($viernes)) {
            $param_sql .= ", hor_viernes";
            $bcur_sql .= ", :hor_viernes";
        }

        if (isset($sabado)) {
            $param_sql .= ", hor_sabado";
            $bcur_sql .= ", :hor_sabado";
        }

        if (isset($domingo)) {
            $param_sql .= ", hor_domingo";
            $bcur_sql .= ", :hor_domingo";
        }

        if (isset($rama)) {
            $param_sql .= ", hor_rama";
            $bcur_sql .= ", :hor_rama";
        }

        if (isset($usu_id)) {
            $param_sql .= ", hor_usuario_ingreso";
            $bcur_sql .= ", :hor_usuario_ingreso";
        }

        try {
            $sql = "INSERT INTO " . $con->dbname . ".horario ($param_sql) VALUES($bcur_sql)";
            $comando = $con->createCommand($sql);

            if (isset($tipohorario)) {
                $comando->bindParam(':thor_id', $tipohorario, \PDO::PARAM_INT);
            }

            if (isset($descripcion)) {
                $comando->bindParam(':hor_descripcion', $descripcion, \PDO::PARAM_STR);
            }

            if (isset($horainicio)) {
                $comando->bindParam(':hor_inicio', $horainicio, \PDO::PARAM_STR);
            }

            if (isset($horafin)) {
                $comando->bindParam(':hor_fin', $horafin, \PDO::PARAM_STR);
            }

            if (isset($lunes)) {
                $comando->bindParam(':hor_lunes', $lunes, \PDO::PARAM_STR);
            }

            if (isset($martes)) {
                $comando->bindParam(':hor_martes', $martes, \PDO::PARAM_STR);
            }

            if (isset($miercoles)) {
                $comando->bindParam(':hor_miercoles', $miercoles, \PDO::PARAM_STR);
            }

            if (isset($jueves)) {
                $comando->bindParam(':hor_jueves', $jueves, \PDO::PARAM_STR);
            }

            if (isset($viernes)) {
                $comando->bindParam(':hor_viernes', $viernes, \PDO::PARAM_STR);
            }

            if (isset($sabado)) {
                $comando->bindParam(':hor_sabado', $sabado, \PDO::PARAM_STR);
            }

            if (isset($domingo)) {
                $comando->bindParam(':hor_domingo', $domingo, \PDO::PARAM_STR);
            }

            if (isset($rama)) {
                $comando->bindParam(':hor_rama', $rama, \PDO::PARAM_STR);
            }

            if (isset($usu_id)) {
                $comando->bindParam(':hor_usuario_ingreso', $usu_id, \PDO::PARAM_STR);
            }

            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.horario');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }
    
    /**
     * Function consulta los bloques. 
     * @author Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultaBloque() {
        $con = \Yii::$app->db_academico;
        $estado = 1;
        $sql = "SELECT 
                   blo_id as id,
                   CONCAT(blo_nombre, ' (', blo_descripcion, ')') as name 
                FROM 
                   " . $con->dbname . ".bloque                    
                WHERE 
                   blo_estado = :estado AND
                   blo_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $resultData = $comando->queryAll();
        return $resultData;
    }

}
