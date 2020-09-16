<?php

namespace app\modules\gpr\models;

use Yii;

/**
 * This is the model class for table "categoria_bsc".
 *
 * @property int $cbsc_id
 * @property string $cbsc_nombre
 * @property string $cbsc_descripcion
 * @property int $cbsc_usuario_ingreso
 * @property int|null $cbsc_usuario_modifica
 * @property string $cbsc_estado
 * @property string $cbsc_fecha_creacion
 * @property string|null $cbsc_fecha_modificacion
 * @property string $cbsc_estado_logico
 *
 * @property ObjetivoEstrategico[] $objetivoEstrategicos
 */
class CategoriaBsc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categoria_bsc';
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
            [['cbsc_nombre', 'cbsc_descripcion', 'cbsc_usuario_ingreso', 'cbsc_estado', 'cbsc_estado_logico'], 'required'],
            [['cbsc_usuario_ingreso', 'cbsc_usuario_modifica'], 'integer'],
            [['cbsc_fecha_creacion', 'cbsc_fecha_modificacion'], 'safe'],
            [['cbsc_nombre'], 'string', 'max' => 300],
            [['cbsc_descripcion'], 'string', 'max' => 500],
            [['cbsc_estado', 'cbsc_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cbsc_id' => 'Cbsc ID',
            'cbsc_nombre' => 'Cbsc Nombre',
            'cbsc_descripcion' => 'Cbsc Descripcion',
            'cbsc_usuario_ingreso' => 'Cbsc Usuario Ingreso',
            'cbsc_usuario_modifica' => 'Cbsc Usuario Modifica',
            'cbsc_estado' => 'Cbsc Estado',
            'cbsc_fecha_creacion' => 'Cbsc Fecha Creacion',
            'cbsc_fecha_modificacion' => 'Cbsc Fecha Modificacion',
            'cbsc_estado_logico' => 'Cbsc Estado Logico',
        ];
    }

    /**
     * Gets query for [[ObjetivoEstrategicos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getObjetivoEstrategicos()
    {
        return $this->hasMany(ObjetivoEstrategico::className(), ['cbsc_id' => 'cbsc_id']);
    }
}
