<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "interesado_empresa".
 *
 * @property int $iemp_id
 * @property int $int_id
 * @property int $emp_id
 * @property string $iemp_estado
 * @property int $iemp_usuario_ingreso
 * @property int $iemp_usuario_modifica
 * @property string $iemp_fecha_creacion
 * @property string $iemp_fecha_modificacion
 * @property string $iemp_estado_logico
 *
 * @property Interesado $int
 */
class InteresadoEmpresa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'interesado_empresa';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_captacion');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['int_id', 'emp_id', 'iemp_usuario_ingreso', 'iemp_estado_logico'], 'required'],
            [['int_id', 'emp_id', 'iemp_usuario_ingreso', 'iemp_usuario_modifica'], 'integer'],
            [['iemp_fecha_creacion', 'iemp_fecha_modificacion'], 'safe'],
            [['iemp_estado', 'iemp_estado_logico'], 'string', 'max' => 1],
            [['int_id'], 'exist', 'skipOnError' => true, 'targetClass' => Interesado::className(), 'targetAttribute' => ['int_id' => 'int_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'iemp_id' => 'Iemp ID',
            'int_id' => 'Int ID',
            'emp_id' => 'Emp ID',
            'iemp_estado' => 'Iemp Estado',
            'iemp_usuario_ingreso' => 'Iemp Usuario Ingreso',
            'iemp_usuario_modifica' => 'Iemp Usuario Modifica',
            'iemp_fecha_creacion' => 'Iemp Fecha Creacion',
            'iemp_fecha_modificacion' => 'Iemp Fecha Modificacion',
            'iemp_estado_logico' => 'Iemp Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInt()
    {
        return $this->hasOne(Interesado::className(), ['int_id' => 'int_id']);
    }
}
