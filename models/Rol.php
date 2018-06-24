<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rol".
 *
 * @property integer $rol_id
 * @property string $rol_nombre
 * @property string $rol_descripcion
 * @property string $rol_estado
 * @property string $rol_fecha_creacion
 * @property string $rol_fecha_actualizacion
 * @property string $rol_estado_logico
 *
 * @property GrupRol[] $grupRols
 */
class Rol extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'rol';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['rol_estado', 'rol_estado_logico'], 'required'],
            [['rol_fecha_creacion', 'rol_fecha_actualizacion'], 'safe'],
            [['rol_nombre'], 'string', 'max' => 50],
            [['rol_descripcion'], 'string', 'max' => 45],
            [['rol_estado', 'rol_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'rol_id' => 'Rol ID',
            'rol_nombre' => 'Rol Nombre',
            'rol_descripcion' => 'Rol Descripcion',
            'rol_estado' => 'Rol Estado',
            'rol_fecha_creacion' => 'Rol Fecha Creacion',
            'rol_fecha_actualizacion' => 'Rol Fecha Actualizacion',
            'rol_estado_logico' => 'Rol Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupRols() {
        return $this->hasMany(GrupRol::className(), ['rol_id' => 'rol_id']);
    }

}
