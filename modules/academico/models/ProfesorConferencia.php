<?php

namespace app\modules\academico\models;

use Yii;

/**
 * This is the model class for table "profesor_conferencia".
 *
 * @property int $pcon_id
 * @property int $pro_id
 * @property string $pcon_evento
 * @property string $pcon_institucion
 * @property string $pcon_anio
 * @property string $pcon_ponencia
 * @property int $pcon_usuario_ingreso
 * @property int $pcon_usuario_modifica
 * @property string $pcon_estado
 * @property string $pcon_fecha_creacion
 * @property string $pcon_fecha_modificacion
 * @property string $pcon_estado_logico
 *
 * @property Profesor $pro
 */
class ProfesorConferencia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profesor_conferencia';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_academico');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pro_id', 'pcon_evento', 'pcon_institucion', 'pcon_anio', 'pcon_ponencia', 'pcon_usuario_ingreso', 'pcon_estado', 'pcon_estado_logico'], 'required'],
            [['pro_id', 'pcon_usuario_ingreso', 'pcon_usuario_modifica'], 'integer'],
            [['pcon_fecha_creacion', 'pcon_fecha_modificacion'], 'safe'],
            [['pcon_evento', 'pcon_institucion', 'pcon_ponencia'], 'string', 'max' => 200],
            [['pcon_anio'], 'string', 'max' => 4],
            [['pcon_estado', 'pcon_estado_logico'], 'string', 'max' => 1],
            [['pro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profesor::className(), 'targetAttribute' => ['pro_id' => 'pro_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pcon_id' => 'Pcon ID',
            'pro_id' => 'Pro ID',
            'pcon_evento' => 'Pcon Evento',
            'pcon_institucion' => 'Pcon Institucion',
            'pcon_anio' => 'Pcon Anio',
            'pcon_ponencia' => 'Pcon Ponencia',
            'pcon_usuario_ingreso' => 'Pcon Usuario Ingreso',
            'pcon_usuario_modifica' => 'Pcon Usuario Modifica',
            'pcon_estado' => 'Pcon Estado',
            'pcon_fecha_creacion' => 'Pcon Fecha Creacion',
            'pcon_fecha_modificacion' => 'Pcon Fecha Modificacion',
            'pcon_estado_logico' => 'Pcon Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPro()
    {
        return $this->hasOne(Profesor::className(), ['pro_id' => 'pro_id']);
    }
}
