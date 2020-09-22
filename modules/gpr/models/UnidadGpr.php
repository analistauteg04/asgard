<?php

namespace app\modules\gpr\models;

use Yii;

/**
 * This is the model class for table "unidad_gpr".
 *
 * @property int $ugpr_id
 * @property string $ugpr_nombre
 * @property string $ugpr_descripcion
 * @property int $ugpr_usuario_ingreso
 * @property int|null $ugpr_usuario_modifica
 * @property string $ugpr_estado
 * @property string $ugpr_fecha_creacion
 * @property string|null $ugpr_fecha_modificacion
 * @property string $ugpr_estado_logico
 *
 * @property SubunidadGpr[] $subunidadGprs
 */
class UnidadGpr extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'unidad_gpr';
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
            [['ugpr_nombre', 'ugpr_descripcion', 'ugpr_usuario_ingreso', 'ugpr_estado', 'ugpr_estado_logico'], 'required'],
            [['ugpr_usuario_ingreso', 'ugpr_usuario_modifica'], 'integer'],
            [['ugpr_fecha_creacion', 'ugpr_fecha_modificacion'], 'safe'],
            [['ugpr_nombre'], 'string', 'max' => 300],
            [['ugpr_descripcion'], 'string', 'max' => 500],
            [['ugpr_estado', 'ugpr_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ugpr_id' => 'Ugpr ID',
            'ugpr_nombre' => 'Ugpr Nombre',
            'ugpr_descripcion' => 'Ugpr Descripcion',
            'ugpr_usuario_ingreso' => 'Ugpr Usuario Ingreso',
            'ugpr_usuario_modifica' => 'Ugpr Usuario Modifica',
            'ugpr_estado' => 'Ugpr Estado',
            'ugpr_fecha_creacion' => 'Ugpr Fecha Creacion',
            'ugpr_fecha_modificacion' => 'Ugpr Fecha Modificacion',
            'ugpr_estado_logico' => 'Ugpr Estado Logico',
        ];
    }

    /**
     * Gets query for [[SubunidadGprs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubunidadGprs()
    {
        return $this->hasMany(SubunidadGpr::className(), ['ugpr_id' => 'ugpr_id']);
    }
}
