<?php

namespace app\modules\gpr\models;

use Yii;

/**
 * This is the model class for table "proyecto".
 *
 * @property int $pro_id
 * @property string $pro_nombre
 * @property string $pro_descripcion
 * @property int $pro_usuario_ingreso
 * @property int|null $pro_usuario_modifica
 * @property string $pro_estado
 * @property string $pro_fecha_creacion
 * @property string|null $pro_fecha_modificacion
 * @property string $pro_estado_logico
 */
class Proyecto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proyecto';
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
            [['pro_nombre', 'pro_descripcion', 'pro_usuario_ingreso', 'pro_estado', 'pro_estado_logico'], 'required'],
            [['pro_usuario_ingreso', 'pro_usuario_modifica'], 'integer'],
            [['pro_fecha_creacion', 'pro_fecha_modificacion'], 'safe'],
            [['pro_nombre'], 'string', 'max' => 300],
            [['pro_descripcion'], 'string', 'max' => 500],
            [['pro_estado', 'pro_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pro_id' => 'Pro ID',
            'pro_nombre' => 'Pro Nombre',
            'pro_descripcion' => 'Pro Descripcion',
            'pro_usuario_ingreso' => 'Pro Usuario Ingreso',
            'pro_usuario_modifica' => 'Pro Usuario Modifica',
            'pro_estado' => 'Pro Estado',
            'pro_fecha_creacion' => 'Pro Fecha Creacion',
            'pro_fecha_modificacion' => 'Pro Fecha Modificacion',
            'pro_estado_logico' => 'Pro Estado Logico',
        ];
    }
}
