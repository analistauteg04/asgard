<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rango_sueldo".
 *
 * @property integer $rsue_id
 * @property string $rsue_nombre
 * @property string $rsue_descripcion
 * @property string $rsue_estado
 * @property string $rsue_fecha_creacion
 * @property string $rsue_fecha_actualizacion
 * @property string $rsue_estado_logico
 *
 * @property InfoFamiliaGraduado[] $infoFamiliaGraduados
 */
class RangoSueldo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {        
        return \Yii::$app->db_graduado->dbname . '.rango_sueldo';
    }    

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rsue_nombre', 'rsue_descripcion', 'rsue_estado', 'rsue_estado_logico'], 'required'],
            [['rsue_fecha_creacion', 'rsue_fecha_actualizacion'], 'safe'],
            [['rsue_nombre', 'rsue_descripcion'], 'string', 'max' => 200],
            [['rsue_estado', 'rsue_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rsue_id' => 'Rsue ID',
            'rsue_nombre' => 'Rsue Nombre',
            'rsue_descripcion' => 'Rsue Descripcion',
            'rsue_estado' => 'Rsue Estado',
            'rsue_fecha_creacion' => 'Rsue Fecha Creacion',
            'rsue_fecha_actualizacion' => 'Rsue Fecha Actualizacion',
            'rsue_estado_logico' => 'Rsue Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInfoFamiliaGraduados()
    {
        return $this->hasMany(InfoFamiliaGraduado::className(), ['rsue_id' => 'rsue_id']);
    }
}
