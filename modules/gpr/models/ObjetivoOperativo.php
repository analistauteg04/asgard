<?php

namespace app\modules\gpr\models;

use Yii;

/**
 * This is the model class for table "objetivo_operativo".
 *
 * @property int $oope_id
 * @property string $oope_nombre
 * @property string $oope_descripcion
 * @property int $oope_usuario_ingreso
 * @property int|null $oope_usuario_modifica
 * @property string $oope_estado
 * @property string $oope_fecha_creacion
 * @property string|null $oope_fecha_modificacion
 * @property string $oope_estado_logico
 */
class ObjetivoOperativo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objetivo_operativo';
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
            [['oope_nombre', 'oope_descripcion', 'oope_usuario_ingreso', 'oope_estado', 'oope_estado_logico'], 'required'],
            [['oope_usuario_ingreso', 'oope_usuario_modifica'], 'integer'],
            [['oope_fecha_creacion', 'oope_fecha_modificacion'], 'safe'],
            [['oope_nombre'], 'string', 'max' => 300],
            [['oope_descripcion'], 'string', 'max' => 500],
            [['oope_estado', 'oope_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'oope_id' => 'Oope ID',
            'oope_nombre' => 'Oope Nombre',
            'oope_descripcion' => 'Oope Descripcion',
            'oope_usuario_ingreso' => 'Oope Usuario Ingreso',
            'oope_usuario_modifica' => 'Oope Usuario Modifica',
            'oope_estado' => 'Oope Estado',
            'oope_fecha_creacion' => 'Oope Fecha Creacion',
            'oope_fecha_modificacion' => 'Oope Fecha Modificacion',
            'oope_estado_logico' => 'Oope Estado Logico',
        ];
    }
}
