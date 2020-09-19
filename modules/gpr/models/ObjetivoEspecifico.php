<?php

namespace app\modules\gpr\models;

use Yii;

/**
 * This is the model class for table "objetivo_especifico".
 *
 * @property int $oesp_id
 * @property int $oest_id
 * @property string $oesp_nombre
 * @property string $oesp_descripcion
 * @property int $oesp_usuario_ingreso
 * @property int|null $oesp_usuario_modifica
 * @property string $oesp_estado
 * @property string $oesp_fecha_creacion
 * @property string|null $oesp_fecha_modificacion
 * @property string $oesp_estado_logico
 *
 * @property ObjetivoEstrategico $oest
 */
class ObjetivoEspecifico extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objetivo_especifico';
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
            [['oest_id', 'oesp_nombre', 'oesp_descripcion', 'oesp_usuario_ingreso', 'oesp_estado', 'oesp_estado_logico'], 'required'],
            [['oest_id', 'oesp_usuario_ingreso', 'oesp_usuario_modifica'], 'integer'],
            [['oesp_fecha_creacion', 'oesp_fecha_modificacion'], 'safe'],
            [['oesp_nombre'], 'string', 'max' => 300],
            [['oesp_descripcion'], 'string', 'max' => 500],
            [['oesp_estado', 'oesp_estado_logico'], 'string', 'max' => 1],
            [['oest_id'], 'exist', 'skipOnError' => true, 'targetClass' => ObjetivoEstrategico::className(), 'targetAttribute' => ['oest_id' => 'oest_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'oesp_id' => 'Oesp ID',
            'oest_id' => 'Oest ID',
            'oesp_nombre' => 'Oesp Nombre',
            'oesp_descripcion' => 'Oesp Descripcion',
            'oesp_usuario_ingreso' => 'Oesp Usuario Ingreso',
            'oesp_usuario_modifica' => 'Oesp Usuario Modifica',
            'oesp_estado' => 'Oesp Estado',
            'oesp_fecha_creacion' => 'Oesp Fecha Creacion',
            'oesp_fecha_modificacion' => 'Oesp Fecha Modificacion',
            'oesp_estado_logico' => 'Oesp Estado Logico',
        ];
    }

    /**
     * Gets query for [[Oest]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOest()
    {
        return $this->hasOne(ObjetivoEstrategico::className(), ['oest_id' => 'oest_id']);
    }
}
