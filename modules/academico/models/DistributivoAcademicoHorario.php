<?php

namespace app\modules\academico\models;

use Yii;

/**
 * This is the model class for table "distributivo_academico_horario".
 *
 * @property int $daho_id
 * @property int $uaca_id
 * @property int $mod_id
 * @property string $daho_jornada
 * @property string $daho_horario
 * @property string|null $daho_hora_inicio
 * @property string|null $daho_hora_fin
 * @property string|null $daho_lunes
 * @property string|null $daho_martes
 * @property string|null $daho_miercoles
 * @property string|null $daho_jueves
 * @property string|null $daho_viernes
 * @property string|null $daho_sabado
 * @property string|null $daho_domingo
 * @property string $daho_estado
 * @property string $daho_fecha_creacion
 * @property string|null $daho_fecha_modificacion
 * @property string $daho_estado_logico
 *
 * @property DistributivoAcademico[] $distributivoAcademicos
 * @property UnidadAcademica $uaca
 * @property Modalidad $mod
 */
class DistributivoAcademicoHorario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'distributivo_academico_horario';
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
    public function rules()
    {
        return [
            [['uaca_id', 'mod_id', 'daho_jornada', 'daho_horario', 'daho_estado', 'daho_estado_logico'], 'required'],
            [['uaca_id', 'mod_id'], 'integer'],
            [['daho_fecha_creacion', 'daho_fecha_modificacion'], 'safe'],
            [['daho_jornada', 'daho_lunes', 'daho_martes', 'daho_miercoles', 'daho_jueves', 'daho_viernes', 'daho_sabado', 'daho_domingo', 'daho_estado', 'daho_estado_logico'], 'string', 'max' => 1],
            [['daho_horario', 'daho_hora_inicio', 'daho_hora_fin'], 'string', 'max' => 10],
            [['uaca_id'], 'exist', 'skipOnError' => true, 'targetClass' => UnidadAcademica::className(), 'targetAttribute' => ['uaca_id' => 'uaca_id']],
            [['mod_id'], 'exist', 'skipOnError' => true, 'targetClass' => Modalidad::className(), 'targetAttribute' => ['mod_id' => 'mod_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'daho_id' => 'Daho ID',
            'uaca_id' => 'Uaca ID',
            'mod_id' => 'Mod ID',
            'daho_jornada' => 'Daho Jornada',
            'daho_horario' => 'Daho Horario',
            'daho_hora_inicio' => 'Daho Hora Inicio',
            'daho_hora_fin' => 'Daho Hora Fin',
            'daho_lunes' => 'Daho Lunes',
            'daho_martes' => 'Daho Martes',
            'daho_miercoles' => 'Daho Miercoles',
            'daho_jueves' => 'Daho Jueves',
            'daho_viernes' => 'Daho Viernes',
            'daho_sabado' => 'Daho Sabado',
            'daho_domingo' => 'Daho Domingo',
            'daho_estado' => 'Daho Estado',
            'daho_fecha_creacion' => 'Daho Fecha Creacion',
            'daho_fecha_modificacion' => 'Daho Fecha Modificacion',
            'daho_estado_logico' => 'Daho Estado Logico',
        ];
    }

    /**
     * Gets query for [[DistributivoAcademicos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDistributivoAcademicos()
    {
        return $this->hasMany(DistributivoAcademico::className(), ['daho_id' => 'daho_id']);
    }

    /**
     * Gets query for [[Uaca]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUaca()
    {
        return $this->hasOne(UnidadAcademica::className(), ['uaca_id' => 'uaca_id']);
    }

    /**
     * Gets query for [[Mod]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMod()
    {
        return $this->hasOne(Modalidad::className(), ['mod_id' => 'mod_id']);
    }
    /**
     * Function consulta laws jornadas. 
     * @author Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarJornadahorario() {
        $con = \Yii::$app->db_academico;
        $estado = 1;   

        $sql = "SELECT distinct daho_jornada as id,
                  CASE daho_jornada  
                    WHEN 1 THEN 'Matutino'  
                    WHEN 2 THEN 'Nocturno'  
                    WHEN 3 THEN 'Semipresencial'
                    WHEN 4 THEN 'Distancia'
		  END AS name
                  FROM " . $con->dbname . ".distributivo_academico_horario
                  WHERE daho_estado = :estado AND
                  daho_estado_logico = :estado;";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $resultData = $comando->queryAll();
        return $resultData;
    }
}
