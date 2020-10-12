<?php

namespace app\modules\gpr\models;

use Yii;

/**
 * This is the model class for table "hito".
 *
 * @property int $hito_id
 * @property string $hito_nombre
 * @property string $hito_descripcion
 * @property int $hito_usuario_ingreso
 * @property int|null $hito_usuario_modifica
 * @property string $hito_estado
 * @property string $hito_fecha_creacion
 * @property string|null $hito_fecha_modificacion
 * @property string $hito_estado_logico
 */
class Hito extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hito';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_gpr');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hito_nombre', 'hito_descripcion', 'hito_usuario_ingreso', 'hito_estado', 'hito_estado_logico'], 'required'],
            [['hito_usuario_ingreso', 'hito_usuario_modifica'], 'integer'],
            [['hito_fecha_creacion', 'hito_fecha_modificacion'], 'safe'],
            [['hito_nombre'], 'string', 'max' => 300],
            [['hito_descripcion'], 'string', 'max' => 500],
            [['hito_estado', 'hito_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'hito_id' => 'Hito ID',
            'hito_nombre' => 'Hito Nombre',
            'hito_descripcion' => 'Hito Descripcion',
            'hito_usuario_ingreso' => 'Hito Usuario Ingreso',
            'hito_usuario_modifica' => 'Hito Usuario Modifica',
            'hito_estado' => 'Hito Estado',
            'hito_fecha_creacion' => 'Hito Fecha Creacion',
            'hito_fecha_modificacion' => 'Hito Fecha Modificacion',
            'hito_estado_logico' => 'Hito Estado Logico',
        ];
    }
}
