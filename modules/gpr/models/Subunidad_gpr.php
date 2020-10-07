<?php

namespace app\modules\gpr\models;

use Yii;

/**
 * This is the model class for table "subunidad_gpr".
 *
 * @property int $sgpr_id
 * @property int $ugpr_id
 * @property string $sgpr_nombre
 * @property string $sgpr_descripcion
 * @property int $sgpr_usuario_ingreso
 * @property int|null $sgpr_usuario_modifica
 * @property string $sgpr_estado
 * @property string $sgpr_fecha_creacion
 * @property string|null $sgpr_fecha_modificacion
 * @property string $sgpr_estado_logico
 *
 * @property UnidadGpr $ugpr
 */
class Subunidad_gpr extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subunidad_gpr';
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
            [['ugpr_id', 'sgpr_nombre', 'sgpr_descripcion', 'sgpr_usuario_ingreso', 'sgpr_estado', 'sgpr_estado_logico'], 'required'],
            [['ugpr_id', 'sgpr_usuario_ingreso', 'sgpr_usuario_modifica'], 'integer'],
            [['sgpr_fecha_creacion', 'sgpr_fecha_modificacion'], 'safe'],
            [['sgpr_nombre'], 'string', 'max' => 300],
            [['sgpr_descripcion'], 'string', 'max' => 500],
            [['sgpr_estado', 'sgpr_estado_logico'], 'string', 'max' => 1],
            [['ugpr_id'], 'exist', 'skipOnError' => true, 'targetClass' => UnidadGpr::className(), 'targetAttribute' => ['ugpr_id' => 'ugpr_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sgpr_id' => 'Sgpr ID',
            'ugpr_id' => 'Ugpr ID',
            'sgpr_nombre' => 'Sgpr Nombre',
            'sgpr_descripcion' => 'Sgpr Descripcion',
            'sgpr_usuario_ingreso' => 'Sgpr Usuario Ingreso',
            'sgpr_usuario_modifica' => 'Sgpr Usuario Modifica',
            'sgpr_estado' => 'Sgpr Estado',
            'sgpr_fecha_creacion' => 'Sgpr Fecha Creacion',
            'sgpr_fecha_modificacion' => 'Sgpr Fecha Modificacion',
            'sgpr_estado_logico' => 'Sgpr Estado Logico',
        ];
    }

    /**
     * Gets query for [[Ugpr]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUgpr()
    {
        return $this->hasOne(UnidadGpr::className(), ['ugpr_id' => 'ugpr_id']);
    }
}
