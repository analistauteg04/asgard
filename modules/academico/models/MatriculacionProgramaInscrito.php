<?php

namespace app\modules\academico\models;

use Yii;

/**
 * This is the model class for table "matriculacion_programa_inscrito".
 *
 * @property int $mpin_id
 * @property int $ppro_id
 * @property int $adm_id
 * @property int $est_id
 * @property string $mpin_fecha_matriculacion
 * @property string $mpin_ficha
 * @property string $mpin_fecha_registro_ficha
 * @property int $mpin_usuario_ingresa
 * @property string $mpin_estado
 * @property string $mpin_fecha_creacion
 * @property int $mpin_usuario_modifica
 * @property string $mpin_fecha_modificacion
 * @property string $mpin_estado_logico
 *
 * @property PromocionPrograma $ppro
 * @property Estudiante $est
 */
class MatriculacionProgramaInscrito extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'matriculacion_programa_inscrito';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_academico');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ppro_id', 'adm_id', 'mpin_estado', 'mpin_estado_logico'], 'required'],
            [['ppro_id', 'adm_id', 'est_id', 'mpin_usuario_ingresa', 'mpin_usuario_modifica'], 'integer'],
            [['mpin_fecha_matriculacion', 'mpin_fecha_registro_ficha', 'mpin_fecha_creacion', 'mpin_fecha_modificacion'], 'safe'],
            [['mpin_ficha', 'mpin_estado', 'mpin_estado_logico'], 'string', 'max' => 1],
            [['ppro_id'], 'exist', 'skipOnError' => true, 'targetClass' => PromocionPrograma::className(), 'targetAttribute' => ['ppro_id' => 'ppro_id']],
            [['est_id'], 'exist', 'skipOnError' => true, 'targetClass' => Estudiante::className(), 'targetAttribute' => ['est_id' => 'est_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'mpin_id' => 'Mpin ID',
            'ppro_id' => 'Ppro ID',
            'adm_id' => 'Adm ID',
            'est_id' => 'Est ID',
            'mpin_fecha_matriculacion' => 'Mpin Fecha Matriculacion',
            'mpin_ficha' => 'Mpin Ficha',
            'mpin_fecha_registro_ficha' => 'Mpin Fecha Registro Ficha',
            'mpin_usuario_ingresa' => 'Mpin Usuario Ingresa',
            'mpin_estado' => 'Mpin Estado',
            'mpin_fecha_creacion' => 'Mpin Fecha Creacion',
            'mpin_usuario_modifica' => 'Mpin Usuario Modifica',
            'mpin_fecha_modificacion' => 'Mpin Fecha Modificacion',
            'mpin_estado_logico' => 'Mpin Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPpro()
    {
        return $this->hasOne(PromocionPrograma::className(), ['ppro_id' => 'ppro_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEst()
    {
        return $this->hasOne(Estudiante::className(), ['est_id' => 'est_id']);
    }
}
