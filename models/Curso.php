<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "curso".
 *
 * @property integer $cur_id
 * @property integer $pmin_id
 * @property string $cur_descripcion
 * @property integer $cur_num_cupo
 * @property integer $cur_num_inscritos
 * @property integer $cur_usuario_ingreso
 * @property integer $cur_usuario_modifica
 * @property string $cur_estado
 * @property string $cur_fecha_creacion
 * @property string $cur_fecha_modificacion
 * @property string $cur_estado_logico
 *
 * @property AsignacionCurso[] $asignacionCursos
 * @property PeriodoMetodoIngreso $pmin
 */
class Curso extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'curso';
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
            [['pmin_id', 'cur_descripcion', 'cur_usuario_ingreso', 'cur_estado', 'cur_estado_logico'], 'required'],
            [['pmin_id', 'cur_num_cupo', 'cur_num_inscritos', 'cur_usuario_ingreso', 'cur_usuario_modifica'], 'integer'],
            [['cur_fecha_creacion', 'cur_fecha_modificacion'], 'safe'],
            [['cur_descripcion'], 'string', 'max' => 500],
            [['cur_estado', 'cur_estado_logico'], 'string', 'max' => 1],
            [['pmin_id'], 'exist', 'skipOnError' => true, 'targetClass' => PeriodoMetodoIngreso::className(), 'targetAttribute' => ['pmin_id' => 'pmin_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cur_id' => 'Cur ID',
            'pmin_id' => 'Pmin ID',
            'cur_descripcion' => 'Cur Descripcion',
            'cur_num_cupo' => 'Cur Num Cupo',
            'cur_num_inscritos' => 'Cur Num Inscritos',
            'cur_usuario_ingreso' => 'Cur Usuario Ingreso',
            'cur_usuario_modifica' => 'Cur Usuario Modifica',
            'cur_estado' => 'Cur Estado',
            'cur_fecha_creacion' => 'Cur Fecha Creacion',
            'cur_fecha_modificacion' => 'Cur Fecha Modificacion',
            'cur_estado_logico' => 'Cur Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsignacionCursos()
    {
        return $this->hasMany(AsignacionCurso::className(), ['cur_id' => 'cur_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmin()
    {
        return $this->hasOne(PeriodoMetodoIngreso::className(), ['pmin_id' => 'pmin_id']);
    }
}
