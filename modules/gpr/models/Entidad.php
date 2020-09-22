<?php

namespace app\modules\gpr\models;

use Yii;

/**
 * This is the model class for table "entidad".
 *
 * @property int $ent_id
 * @property string $ent_nombre
 * @property string $ent_descripcion
 * @property int $ent_usuario_ingreso
 * @property int|null $ent_usuario_modifica
 * @property string $ent_estado
 * @property string $ent_fecha_creacion
 * @property string|null $ent_fecha_modificacion
 * @property string $ent_estado_logico
 */
class Entidad extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'entidad';
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
            [['ent_nombre', 'ent_descripcion', 'ent_usuario_ingreso', 'ent_estado', 'ent_estado_logico'], 'required'],
            [['ent_usuario_ingreso', 'ent_usuario_modifica'], 'integer'],
            [['ent_fecha_creacion', 'ent_fecha_modificacion'], 'safe'],
            [['ent_nombre'], 'string', 'max' => 300],
            [['ent_descripcion'], 'string', 'max' => 500],
            [['ent_estado', 'ent_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ent_id' => 'Ent ID',
            'ent_nombre' => 'Ent Nombre',
            'ent_descripcion' => 'Ent Descripcion',
            'ent_usuario_ingreso' => 'Ent Usuario Ingreso',
            'ent_usuario_modifica' => 'Ent Usuario Modifica',
            'ent_estado' => 'Ent Estado',
            'ent_fecha_creacion' => 'Ent Fecha Creacion',
            'ent_fecha_modificacion' => 'Ent Fecha Modificacion',
            'ent_estado_logico' => 'Ent Estado Logico',
        ];
    }
}
