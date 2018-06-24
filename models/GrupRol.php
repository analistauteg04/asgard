<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "grup_rol".
 *
 * @property integer $grol_id
 * @property integer $gru_id
 * @property integer $rol_id
 * @property string $grol_estado
 * @property string $grol_fecha_creacion
 * @property string $grol_fecha_modificacion
 * @property string $grol_estado_logico
 *
 * @property GrupObmoGrupRol[] $grupObmoGrupRols
 * @property Grupo $gru
 * @property Rol $rol
 * @property UsuaGrol[] $usuaGrols
 */
class GrupRol extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'grup_rol';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gru_id', 'rol_id', 'grol_estado', 'grol_estado_logico'], 'required'],
            [['gru_id', 'rol_id'], 'integer'],
            [['grol_fecha_creacion', 'grol_fecha_modificacion'], 'safe'],
            [['grol_estado', 'grol_estado_logico'], 'string', 'max' => 1],
            [['gru_id'], 'exist', 'skipOnError' => true, 'targetClass' => Grupo::className(), 'targetAttribute' => ['gru_id' => 'gru_id']],
            [['rol_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rol::className(), 'targetAttribute' => ['rol_id' => 'rol_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'grol_id' => 'Grol ID',
            'gru_id' => 'Gru ID',
            'rol_id' => 'Rol ID',
            'grol_estado' => 'Grol Estado',
            'grol_fecha_creacion' => 'Grol Fecha Creacion',
            'grol_fecha_modificacion' => 'Grol Fecha Modificacion',
            'grol_estado_logico' => 'Grol Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupObmoGrupRols()
    {
        return $this->hasMany(GrupObmoGrupRol::className(), ['grol_id' => 'grol_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGru()
    {
        return $this->hasOne(Grupo::className(), ['gru_id' => 'gru_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRol()
    {
        return $this->hasOne(Rol::className(), ['rol_id' => 'rol_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuaGrols()
    {
        return $this->hasMany(UsuaGrol::className(), ['grol_id' => 'grol_id']);
    }

}
