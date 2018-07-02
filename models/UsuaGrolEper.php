<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%usua_grol}}".
 *
 * @property integer $ugep_id
 * @property integer $usu_id
 * @property integer $grol_id
 * @property string $ugep_estado
 * @property string $ugep_fecha_creacion
 * @property string $ugep_fecha_modificacion
 * @property string $ugep_estado_logico
 *
 * @property Usuario $usu
 * @property GrupRol $grol
 */
class UsuaGrolEper extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%usua_grol_eper}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usu_id', 'eper_id',  'grol_id', 'ugep_estado', 'ugep_estado_logico'], 'required'],
            [['usu_id', 'grol_id', 'eper_id'], 'integer'],
            [['ugep_fecha_creacion', 'ugep_fecha_modificacion'], 'safe'],
            [['ugep_estado', 'ugep_estado_logico'], 'string', 'max' => 1],
            [['usu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['usu_id' => 'usu_id']],
            [['grol_id'], 'exist', 'skipOnError' => true, 'targetClass' => GrupRol::className(), 'targetAttribute' => ['grol_id' => 'grol_id']],
            [['eper_id'], 'exist', 'skipOnError' => true, 'targetClass' => GrupRol::className(), 'targetAttribute' => ['eper_id' => 'eper_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ugep_id' => 'ugep ID',
            'usu_id' => 'Usu ID',
            'grol_id' => 'Grol ID',
            'eper_id' => 'Eper ID',
            'ugep_estado' => 'ugep Estado',
            'ugep_fecha_creacion' => 'ugep Fecha Creacion',
            'ugep_fecha_modificacion' => 'ugep Fecha Modificacion',
            'ugep_estado_logico' => 'ugep Estado Logico',
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
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEper()
    {
        return $this->hasOne(GrupRol::className(), ['eper_id' => 'eper_id']);
    }
    
}
