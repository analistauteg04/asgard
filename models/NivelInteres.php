<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nivel_interes".
 *
 * @property integer $nint_id
 * @property string $nint_nombre
 * @property string $nint_descripcion
 * @property string $nint_estado
 * @property string $nint_fecha_creacion
 * @property string $nint_fecha_modificacion
 * @property string $nint_estado_logico
 *
 * @property DocNintTciudadano[] $docNintTciudadanos
 * @property NivelintMetodo[] $nivelintMetodos
 * @property SolicitudInscripcion[] $solicitudInscripcions
 */
class NivelInteres extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
       //return 'nivel_interes';
        return \Yii::$app->db_captacion->dbname.'.nivel_interes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nint_nombre', 'nint_descripcion', 'nint_estado', 'nint_estado_logico'], 'required'],
            [['nint_fecha_creacion', 'nint_fecha_modificacion'], 'safe'],
            [['nint_nombre'], 'string', 'max' => 300],
            [['nint_descripcion'], 'string', 'max' => 500],
            [['nint_estado', 'nint_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nint_id' => 'Nint ID',
            'nint_nombre' => 'Nint Nombre',
            'nint_descripcion' => 'Nint Descripcion',
            'nint_estado' => 'Nint Estado',
            'nint_fecha_creacion' => 'Nint Fecha Creacion',
            'nint_fecha_modificacion' => 'Nint Fecha Modificacion',
            'nint_estado_logico' => 'Nint Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocNintTciudadanos()
    {
        return $this->hasMany(DocNintTciudadano::className(), ['nint_id' => 'nint_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNivelintMetodos()
    {
        return $this->hasMany(NivelintMetodo::className(), ['nint_id' => 'nint_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudInscripcions()
    {
        return $this->hasMany(SolicitudInscripcion::className(), ['nint_id' => 'nint_id']);
    }
}
