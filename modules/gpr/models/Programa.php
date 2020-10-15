<?php

namespace app\modules\gpr\models;

use Yii;

/**
 * This is the model class for table "programa".
 *
 * @property int $prog_id
 * @property string $prog_nombre
 * @property string $prog_descripcion
 * @property int $prog_usuario_ingreso
 * @property int|null $prog_usuario_modifica
 * @property string $prog_estado
 * @property string $prog_fecha_creacion
 * @property string|null $prog_fecha_modificacion
 * @property string $prog_estado_logico
 */
class Programa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'programa';
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
            [['prog_nombre', 'prog_descripcion', 'prog_usuario_ingreso', 'prog_estado', 'prog_estado_logico'], 'required'],
            [['prog_usuario_ingreso', 'prog_usuario_modifica'], 'integer'],
            [['prog_fecha_creacion', 'prog_fecha_modificacion'], 'safe'],
            [['prog_nombre'], 'string', 'max' => 300],
            [['prog_descripcion'], 'string', 'max' => 500],
            [['prog_estado', 'prog_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'prog_id' => 'Prog ID',
            'prog_nombre' => 'Prog Nombre',
            'prog_descripcion' => 'Prog Descripcion',
            'prog_usuario_ingreso' => 'Prog Usuario Ingreso',
            'prog_usuario_modifica' => 'Prog Usuario Modifica',
            'prog_estado' => 'Prog Estado',
            'prog_fecha_creacion' => 'Prog Fecha Creacion',
            'prog_fecha_modificacion' => 'Prog Fecha Modificacion',
            'prog_estado_logico' => 'Prog Estado Logico',
        ];
    }
}
