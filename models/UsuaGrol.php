<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%usua_grol}}".
 *
 * @property integer $ugro_id
 * @property integer $usu_id
 * @property integer $grol_id
 * @property string $ugro_estado
 * @property string $ugro_fecha_creacion
 * @property string $ugro_fecha_modificacion
 * @property string $ugro_estado_logico
 *
 * @property Usuario $usu
 * @property GrupRol $grol
 */
class UsuaGrol extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%usua_grol}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usu_id', 'grol_id', 'ugro_estado', 'ugro_estado_logico'], 'required'],
            [['usu_id', 'grol_id'], 'integer'],
            [['ugro_fecha_creacion', 'ugro_fecha_modificacion'], 'safe'],
            [['ugro_estado', 'ugro_estado_logico'], 'string', 'max' => 1],
            [['usu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['usu_id' => 'usu_id']],
            [['grol_id'], 'exist', 'skipOnError' => true, 'targetClass' => GrupRol::className(), 'targetAttribute' => ['grol_id' => 'grol_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ugro_id' => 'Ugro ID',
            'usu_id' => 'Usu ID',
            'grol_id' => 'Grol ID',
            'ugro_estado' => 'Ugro Estado',
            'ugro_fecha_creacion' => 'Ugro Fecha Creacion',
            'ugro_fecha_modificacion' => 'Ugro Fecha Modificacion',
            'ugro_estado_logico' => 'Ugro Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsu()
    {
        return $this->hasOne(Usuario::className(), ['usu_id' => 'usu_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrol()
    {
        return $this->hasOne(GrupRol::className(), ['grol_id' => 'grol_id']);
    }
}
