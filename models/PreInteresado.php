<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pre_interesado".
 *
 * @property integer $pint_id
 * @property integer $per_id
 * @property string $pint_estado_preinteresado
 * @property string $pint_estado
 * @property string $pint_fecha_creacion
 * @property string $pint_fecha_modificacion
 * @property string $pint_estado_logico
 *
 * @property Interesado[] $interesados
 * @property InteresadoEjecutivo[] $interesadoEjecutivos
 */
class PreInteresado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pre_interesado';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_captacion');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['per_id', 'pint_estado', 'pint_estado_logico'], 'required'],
            [['per_id'], 'integer'],
            [['pint_fecha_creacion', 'pint_fecha_modificacion'], 'safe'],
            [['pint_estado_preinteresado', 'pint_estado', 'pint_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pint_id' => 'Pint ID',
            'per_id' => 'Per ID',
            'pint_estado_preinteresado' => 'Pint Estado Preinteresado',
            'pint_estado' => 'Pint Estado',
            'pint_fecha_creacion' => 'Pint Fecha Creacion',
            'pint_fecha_modificacion' => 'Pint Fecha Modificacion',
            'pint_estado_logico' => 'Pint Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInteresados()
    {
        return $this->hasMany(Interesado::className(), ['pint_id' => 'pint_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInteresadoEjecutivos()
    {
        return $this->hasMany(InteresadoEjecutivo::className(), ['pint_id' => 'pint_id']);
    }
}
