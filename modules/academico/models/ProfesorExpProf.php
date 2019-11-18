<?php

namespace app\modules\academico\models;

use Yii;

/**
 * This is the model class for table "profesor_exp_prof".
 *
 * @property int $pepr_id
 * @property int $pro_id
 * @property string $pepr_fecha_inicio
 * @property string $pepr_fecha_fin
 * @property string $pepr_organizacion
 * @property string $pepr_denominacion
 * @property string $pepr_funciones
 * @property int $pepr_usuario_ingreso
 * @property int $pepr_usuario_modifica
 * @property string $pepr_estado
 * @property string $pepr_fecha_creacion
 * @property string $pepr_fecha_modificacion
 * @property string $pepr_estado_logico
 *
 * @property Profesor $pro
 */
class ProfesorExpProf extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profesor_exp_prof';
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
            [['pro_id', 'pepr_organizacion', 'pepr_denominacion', 'pepr_funciones', 'pepr_usuario_ingreso', 'pepr_estado', 'pepr_estado_logico'], 'required'],
            [['pro_id', 'pepr_usuario_ingreso', 'pepr_usuario_modifica'], 'integer'],
            [['pepr_fecha_inicio', 'pepr_fecha_fin', 'pepr_fecha_creacion', 'pepr_fecha_modificacion'], 'safe'],
            [['pepr_organizacion', 'pepr_funciones'], 'string', 'max' => 200],
            [['pepr_denominacion'], 'string', 'max' => 100],
            [['pepr_estado', 'pepr_estado_logico'], 'string', 'max' => 1],
            [['pro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profesor::className(), 'targetAttribute' => ['pro_id' => 'pro_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pepr_id' => 'Pepr ID',
            'pro_id' => 'Pro ID',
            'pepr_fecha_inicio' => 'Pepr Fecha Inicio',
            'pepr_fecha_fin' => 'Pepr Fecha Fin',
            'pepr_organizacion' => 'Pepr Organizacion',
            'pepr_denominacion' => 'Pepr Denominacion',
            'pepr_funciones' => 'Pepr Funciones',
            'pepr_usuario_ingreso' => 'Pepr Usuario Ingreso',
            'pepr_usuario_modifica' => 'Pepr Usuario Modifica',
            'pepr_estado' => 'Pepr Estado',
            'pepr_fecha_creacion' => 'Pepr Fecha Creacion',
            'pepr_fecha_modificacion' => 'Pepr Fecha Modificacion',
            'pepr_estado_logico' => 'Pepr Estado Logico',
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
