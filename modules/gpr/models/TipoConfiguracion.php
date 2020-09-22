<?php

namespace app\modules\gpr\models;

use Yii;

/**
 * This is the model class for table "tipo_configuracion".
 *
 * @property int $tcon_id
 * @property string $tcon_nombre
 * @property string $tcon_descripcion
 * @property int $tcon_usuario_ingreso
 * @property int|null $tcon_usuario_modifica
 * @property string $tcon_estado
 * @property string $tcon_fecha_creacion
 * @property string|null $tcon_fecha_modificacion
 * @property string $tcon_estado_logico
 */
class TipoConfiguracion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_configuracion';
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
            [['tcon_nombre', 'tcon_descripcion', 'tcon_usuario_ingreso', 'tcon_estado', 'tcon_estado_logico'], 'required'],
            [['tcon_usuario_ingreso', 'tcon_usuario_modifica'], 'integer'],
            [['tcon_fecha_creacion', 'tcon_fecha_modificacion'], 'safe'],
            [['tcon_nombre'], 'string', 'max' => 300],
            [['tcon_descripcion'], 'string', 'max' => 500],
            [['tcon_estado', 'tcon_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tcon_id' => 'Tcon ID',
            'tcon_nombre' => 'Tcon Nombre',
            'tcon_descripcion' => 'Tcon Descripcion',
            'tcon_usuario_ingreso' => 'Tcon Usuario Ingreso',
            'tcon_usuario_modifica' => 'Tcon Usuario Modifica',
            'tcon_estado' => 'Tcon Estado',
            'tcon_fecha_creacion' => 'Tcon Fecha Creacion',
            'tcon_fecha_modificacion' => 'Tcon Fecha Modificacion',
            'tcon_estado_logico' => 'Tcon Estado Logico',
        ];
    }
}
