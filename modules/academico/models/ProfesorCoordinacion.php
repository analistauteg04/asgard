<?php

namespace app\modules\academico\models;

use Yii;

/**
 * This is the model class for table "profesor_coordinacion".
 *
 * @property int $pcoo_id
 * @property int $pro_id
 * @property string $pcoo_alumno
 * @property string $pcoo_programa
 * @property string $pcoo_academico
 * @property string $pcoo_institucion
 * @property string $pcoo_anio
 * @property int $pcoo_usuario_ingreso
 * @property int $pcoo_usuario_modifica
 * @property string $pcoo_estado
 * @property string $pcoo_fecha_creacion
 * @property string $pcoo_fecha_modificacion
 * @property string $pcoo_estado_logico
 *
 * @property Profesor $pro
 */
class ProfesorCoordinacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profesor_coordinacion';
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
            [['pro_id', 'pcoo_alumno', 'pcoo_programa', 'pcoo_academico', 'pcoo_institucion', 'pcoo_anio', 'pcoo_usuario_ingreso', 'pcoo_estado', 'pcoo_estado_logico'], 'required'],
            [['pro_id', 'pcoo_usuario_ingreso', 'pcoo_usuario_modifica'], 'integer'],
            [['pcoo_fecha_creacion', 'pcoo_fecha_modificacion'], 'safe'],
            [['pcoo_alumno', 'pcoo_programa', 'pcoo_academico'], 'string', 'max' => 100],
            [['pcoo_institucion'], 'string', 'max' => 200],
            [['pcoo_anio'], 'string', 'max' => 4],
            [['pcoo_estado', 'pcoo_estado_logico'], 'string', 'max' => 1],
            [['pro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profesor::className(), 'targetAttribute' => ['pro_id' => 'pro_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pcoo_id' => 'Pcoo ID',
            'pro_id' => 'Pro ID',
            'pcoo_alumno' => 'Pcoo Alumno',
            'pcoo_programa' => 'Pcoo Programa',
            'pcoo_academico' => 'Pcoo Academico',
            'pcoo_institucion' => 'Pcoo Institucion',
            'pcoo_anio' => 'Pcoo Anio',
            'pcoo_usuario_ingreso' => 'Pcoo Usuario Ingreso',
            'pcoo_usuario_modifica' => 'Pcoo Usuario Modifica',
            'pcoo_estado' => 'Pcoo Estado',
            'pcoo_fecha_creacion' => 'Pcoo Fecha Creacion',
            'pcoo_fecha_modificacion' => 'Pcoo Fecha Modificacion',
            'pcoo_estado_logico' => 'Pcoo Estado Logico',
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
