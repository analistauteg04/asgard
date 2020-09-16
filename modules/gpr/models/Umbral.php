<?php

namespace app\modules\gpr\models;

use Yii;

/**
 * This is the model class for table "umbral".
 *
 * @property int $umb_id
 * @property string $umb_nombre
 * @property string $umb_descripcion
 * @property int $umb_usuario_ingreso
 * @property int|null $umb_usuario_modifica
 * @property string $umb_estado
 * @property string $umb_fecha_creacion
 * @property string|null $umb_fecha_modificacion
 * @property string $umb_estado_logico
 */
class Umbral extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'umbral';
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
            [['umb_nombre', 'umb_descripcion', 'umb_usuario_ingreso', 'umb_estado', 'umb_estado_logico'], 'required'],
            [['umb_usuario_ingreso', 'umb_usuario_modifica'], 'integer'],
            [['umb_fecha_creacion', 'umb_fecha_modificacion'], 'safe'],
            [['umb_nombre'], 'string', 'max' => 300],
            [['umb_descripcion'], 'string', 'max' => 500],
            [['umb_estado', 'umb_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'umb_id' => 'Umb ID',
            'umb_nombre' => 'Umb Nombre',
            'umb_descripcion' => 'Umb Descripcion',
            'umb_usuario_ingreso' => 'Umb Usuario Ingreso',
            'umb_usuario_modifica' => 'Umb Usuario Modifica',
            'umb_estado' => 'Umb Estado',
            'umb_fecha_creacion' => 'Umb Fecha Creacion',
            'umb_fecha_modificacion' => 'Umb Fecha Modificacion',
            'umb_estado_logico' => 'Umb Estado Logico',
        ];
    }
}
