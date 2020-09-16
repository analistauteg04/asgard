<?php

namespace app\modules\gpr\models;

use Yii;

/**
 * This is the model class for table "indicador".
 *
 * @property int $ind_id
 * @property string $ind_nombre
 * @property string $ind_descripcion
 * @property int $ind_usuario_ingreso
 * @property int|null $ind_usuario_modifica
 * @property string $ind_estado
 * @property string $ind_fecha_creacion
 * @property string|null $ind_fecha_modificacion
 * @property string $ind_estado_logico
 *
 * @property ActividadIndicador[] $actividadIndicadors
 */
class Indicador extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'indicador';
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
            [['ind_nombre', 'ind_descripcion', 'ind_usuario_ingreso', 'ind_estado', 'ind_estado_logico'], 'required'],
            [['ind_usuario_ingreso', 'ind_usuario_modifica'], 'integer'],
            [['ind_fecha_creacion', 'ind_fecha_modificacion'], 'safe'],
            [['ind_nombre'], 'string', 'max' => 300],
            [['ind_descripcion'], 'string', 'max' => 500],
            [['ind_estado', 'ind_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ind_id' => 'Ind ID',
            'ind_nombre' => 'Ind Nombre',
            'ind_descripcion' => 'Ind Descripcion',
            'ind_usuario_ingreso' => 'Ind Usuario Ingreso',
            'ind_usuario_modifica' => 'Ind Usuario Modifica',
            'ind_estado' => 'Ind Estado',
            'ind_fecha_creacion' => 'Ind Fecha Creacion',
            'ind_fecha_modificacion' => 'Ind Fecha Modificacion',
            'ind_estado_logico' => 'Ind Estado Logico',
        ];
    }

    /**
     * Gets query for [[ActividadIndicadors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getActividadIndicadors()
    {
        return $this->hasMany(ActividadIndicador::className(), ['ind_id' => 'ind_id']);
    }
}
