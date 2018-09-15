<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "distributivo_academico".
 *
 * @property int $daca_id
 * @property int $plan_id
 * @property int $pro_id
 * @property int $dhor_id
 * @property string $daca_fecha_registro
 * @property int $daca_usuario_ingreso
 * @property int $daca_usuario_modifica
 * @property string $daca_estado
 * @property string $daca_fecha_creacion
 * @property string $daca_fecha_modificacion
 * @property string $daca_estado_logico
 *
 * @property Planificacion $plan
 * @property Profesor $pro
 * @property DistributivoHorario $dhor
 * @property Matriculacion[] $matriculacions
 */
class DistributivoAcademico extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'distributivo_academico';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['plan_id', 'pro_id', 'dhor_id', 'daca_usuario_ingreso', 'daca_estado', 'daca_estado_logico'], 'required'],
            [['plan_id', 'pro_id', 'dhor_id', 'daca_usuario_ingreso', 'daca_usuario_modifica'], 'integer'],
            [['daca_fecha_registro', 'daca_fecha_creacion', 'daca_fecha_modificacion'], 'safe'],
            [['daca_estado', 'daca_estado_logico'], 'string', 'max' => 1],
            [['plan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Planificacion::className(), 'targetAttribute' => ['plan_id' => 'plan_id']],
            [['pro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profesor::className(), 'targetAttribute' => ['pro_id' => 'pro_id']],
            [['dhor_id'], 'exist', 'skipOnError' => true, 'targetClass' => DistributivoHorario::className(), 'targetAttribute' => ['dhor_id' => 'dhor_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'daca_id' => 'Daca ID',
            'plan_id' => 'Plan ID',
            'pro_id' => 'Pro ID',
            'dhor_id' => 'Dhor ID',
            'daca_fecha_registro' => 'Daca Fecha Registro',
            'daca_usuario_ingreso' => 'Daca Usuario Ingreso',
            'daca_usuario_modifica' => 'Daca Usuario Modifica',
            'daca_estado' => 'Daca Estado',
            'daca_fecha_creacion' => 'Daca Fecha Creacion',
            'daca_fecha_modificacion' => 'Daca Fecha Modificacion',
            'daca_estado_logico' => 'Daca Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlan()
    {
        return $this->hasOne(Planificacion::className(), ['plan_id' => 'plan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPro()
    {
        return $this->hasOne(Profesor::className(), ['pro_id' => 'pro_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDhor()
    {
        return $this->hasOne(DistributivoHorario::className(), ['dhor_id' => 'dhor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatriculacions()
    {
        return $this->hasMany(Matriculacion::className(), ['daca_id' => 'daca_id']);
    }
}
