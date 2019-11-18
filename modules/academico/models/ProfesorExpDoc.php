<?php

namespace app\modules\academico\models;

use Yii;

/**
 * This is the model class for table "profesor_exp_doc".
 *
 * @property int $pedo_id
 * @property int $pro_id
 * @property string $pedo_fecha_inicio
 * @property string $pedo_fecha_fin
 * @property string $pedo_institucion
 * @property string $pedo_denominacion
 * @property string $pedo_asignaturas
 * @property int $pedo_usuario_ingreso
 * @property int $pedo_usuario_modifica
 * @property string $pedo_estado
 * @property string $pedo_fecha_creacion
 * @property string $pedo_fecha_modificacion
 * @property string $pedo_estado_logico
 *
 * @property Profesor $pro
 */
class ProfesorExpDoc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profesor_exp_doc';
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
            [['pro_id', 'pedo_institucion', 'pedo_denominacion', 'pedo_asignaturas', 'pedo_usuario_ingreso', 'pedo_estado', 'pedo_estado_logico'], 'required'],
            [['pro_id', 'pedo_usuario_ingreso', 'pedo_usuario_modifica'], 'integer'],
            [['pedo_fecha_inicio', 'pedo_fecha_fin', 'pedo_fecha_creacion', 'pedo_fecha_modificacion'], 'safe'],
            [['pedo_institucion', 'pedo_asignaturas'], 'string', 'max' => 200],
            [['pedo_denominacion'], 'string', 'max' => 100],
            [['pedo_estado', 'pedo_estado_logico'], 'string', 'max' => 1],
            [['pro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profesor::className(), 'targetAttribute' => ['pro_id' => 'pro_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pedo_id' => 'Pedo ID',
            'pro_id' => 'Pro ID',
            'pedo_fecha_inicio' => 'Pedo Fecha Inicio',
            'pedo_fecha_fin' => 'Pedo Fecha Fin',
            'pedo_institucion' => 'Pedo Institucion',
            'pedo_denominacion' => 'Pedo Denominacion',
            'pedo_asignaturas' => 'Pedo Asignaturas',
            'pedo_usuario_ingreso' => 'Pedo Usuario Ingreso',
            'pedo_usuario_modifica' => 'Pedo Usuario Modifica',
            'pedo_estado' => 'Pedo Estado',
            'pedo_fecha_creacion' => 'Pedo Fecha Creacion',
            'pedo_fecha_modificacion' => 'Pedo Fecha Modificacion',
            'pedo_estado_logico' => 'Pedo Estado Logico',
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
