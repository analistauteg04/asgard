<?php

namespace app\modules\gpr\models;

use Yii;

/**
 * This is the model class for table "actividad_indicador".
 *
 * @property int $aind_id
 * @property int $ind_id
 * @property string $aind_nombre
 * @property string $aind_descripcion
 * @property int $aind_usuario_ingreso
 * @property int|null $aind_usuario_modifica
 * @property string $aind_estado
 * @property string $aind_fecha_creacion
 * @property string|null $aind_fecha_modificacion
 * @property string $aind_estado_logico
 *
 * @property Indicador $ind
 */
class ActividadIndicador extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'actividad_indicador';
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
            [['ind_id', 'aind_nombre', 'aind_descripcion', 'aind_usuario_ingreso', 'aind_estado', 'aind_estado_logico'], 'required'],
            [['ind_id', 'aind_usuario_ingreso', 'aind_usuario_modifica'], 'integer'],
            [['aind_fecha_creacion', 'aind_fecha_modificacion'], 'safe'],
            [['aind_nombre'], 'string', 'max' => 300],
            [['aind_descripcion'], 'string', 'max' => 500],
            [['aind_estado', 'aind_estado_logico'], 'string', 'max' => 1],
            [['ind_id'], 'exist', 'skipOnError' => true, 'targetClass' => Indicador::className(), 'targetAttribute' => ['ind_id' => 'ind_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'aind_id' => 'Aind ID',
            'ind_id' => 'Ind ID',
            'aind_nombre' => 'Aind Nombre',
            'aind_descripcion' => 'Aind Descripcion',
            'aind_usuario_ingreso' => 'Aind Usuario Ingreso',
            'aind_usuario_modifica' => 'Aind Usuario Modifica',
            'aind_estado' => 'Aind Estado',
            'aind_fecha_creacion' => 'Aind Fecha Creacion',
            'aind_fecha_modificacion' => 'Aind Fecha Modificacion',
            'aind_estado_logico' => 'Aind Estado Logico',
        ];
    }

    /**
     * Gets query for [[Ind]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInd()
    {
        return $this->hasOne(Indicador::className(), ['ind_id' => 'ind_id']);
    }
}
