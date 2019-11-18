<?php

namespace app\modules\academico\models;

use Yii;

/**
 * This is the model class for table "profesor_investigacion".
 *
 * @property int $pinv_id
 * @property int $pro_id
 * @property string $pinv_proyecto
 * @property string $pinv_ambito
 * @property string $pinv_responsabilidad
 * @property string $pinv_entidad
 * @property string $pinv_anio
 * @property string $pinv_duracion
 * @property int $pinv_usuario_ingreso
 * @property int $pinv_usuario_modifica
 * @property string $pinv_estado
 * @property string $pinv_fecha_creacion
 * @property string $pinv_fecha_modificacion
 * @property string $pinv_estado_logico
 *
 * @property Profesor $pro
 */
class ProfesorInvestigacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profesor_investigacion';
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
            [['pro_id', 'pinv_proyecto', 'pinv_ambito', 'pinv_responsabilidad', 'pinv_entidad', 'pinv_anio', 'pinv_duracion', 'pinv_usuario_ingreso', 'pinv_estado', 'pinv_estado_logico'], 'required'],
            [['pro_id', 'pinv_usuario_ingreso', 'pinv_usuario_modifica'], 'integer'],
            [['pinv_fecha_creacion', 'pinv_fecha_modificacion'], 'safe'],
            [['pinv_proyecto', 'pinv_responsabilidad', 'pinv_entidad'], 'string', 'max' => 200],
            [['pinv_ambito'], 'string', 'max' => 100],
            [['pinv_anio'], 'string', 'max' => 4],
            [['pinv_duracion'], 'string', 'max' => 20],
            [['pinv_estado', 'pinv_estado_logico'], 'string', 'max' => 1],
            [['pro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profesor::className(), 'targetAttribute' => ['pro_id' => 'pro_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pinv_id' => 'Pinv ID',
            'pro_id' => 'Pro ID',
            'pinv_proyecto' => 'Pinv Proyecto',
            'pinv_ambito' => 'Pinv Ambito',
            'pinv_responsabilidad' => 'Pinv Responsabilidad',
            'pinv_entidad' => 'Pinv Entidad',
            'pinv_anio' => 'Pinv Anio',
            'pinv_duracion' => 'Pinv Duracion',
            'pinv_usuario_ingreso' => 'Pinv Usuario Ingreso',
            'pinv_usuario_modifica' => 'Pinv Usuario Modifica',
            'pinv_estado' => 'Pinv Estado',
            'pinv_fecha_creacion' => 'Pinv Fecha Creacion',
            'pinv_fecha_modificacion' => 'Pinv Fecha Modificacion',
            'pinv_estado_logico' => 'Pinv Estado Logico',
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
