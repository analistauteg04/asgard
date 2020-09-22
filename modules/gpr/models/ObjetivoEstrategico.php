<?php

namespace app\modules\gpr\models;

use Yii;

/**
 * This is the model class for table "objetivo_estrategico".
 *
 * @property int $oest_id
 * @property int $enf_id
 * @property int $cbsc_id
 * @property string $oest_nombre
 * @property string $oest_descripcion
 * @property string|null $oest_fecha_inicio
 * @property string|null $oest_fecha_fin
 * @property string|null $oest_fecha_actualizacion
 * @property int $oest_usuario_ingreso
 * @property int|null $oest_usuario_modifica
 * @property string $oest_estado
 * @property string $oest_fecha_creacion
 * @property string|null $oest_fecha_modificacion
 * @property string $oest_estado_logico
 *
 * @property ObjetivoEspecifico[] $objetivoEspecificos
 * @property Enfoque $enf
 * @property CategoriaBsc $cbsc
 */
class ObjetivoEstrategico extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objetivo_estrategico';
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
            [['enf_id', 'cbsc_id', 'oest_nombre', 'oest_descripcion', 'oest_usuario_ingreso', 'oest_estado', 'oest_estado_logico'], 'required'],
            [['enf_id', 'cbsc_id', 'oest_usuario_ingreso', 'oest_usuario_modifica'], 'integer'],
            [['oest_fecha_inicio', 'oest_fecha_fin', 'oest_fecha_actualizacion', 'oest_fecha_creacion', 'oest_fecha_modificacion'], 'safe'],
            [['oest_nombre'], 'string', 'max' => 300],
            [['oest_descripcion'], 'string', 'max' => 500],
            [['oest_estado', 'oest_estado_logico'], 'string', 'max' => 1],
            [['enf_id'], 'exist', 'skipOnError' => true, 'targetClass' => Enfoque::className(), 'targetAttribute' => ['enf_id' => 'enf_id']],
            [['cbsc_id'], 'exist', 'skipOnError' => true, 'targetClass' => CategoriaBsc::className(), 'targetAttribute' => ['cbsc_id' => 'cbsc_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'oest_id' => 'Oest ID',
            'enf_id' => 'Enf ID',
            'cbsc_id' => 'Cbsc ID',
            'oest_nombre' => 'Oest Nombre',
            'oest_descripcion' => 'Oest Descripcion',
            'oest_fecha_inicio' => 'Oest Fecha Inicio',
            'oest_fecha_fin' => 'Oest Fecha Fin',
            'oest_fecha_actualizacion' => 'Oest Fecha Actualizacion',
            'oest_usuario_ingreso' => 'Oest Usuario Ingreso',
            'oest_usuario_modifica' => 'Oest Usuario Modifica',
            'oest_estado' => 'Oest Estado',
            'oest_fecha_creacion' => 'Oest Fecha Creacion',
            'oest_fecha_modificacion' => 'Oest Fecha Modificacion',
            'oest_estado_logico' => 'Oest Estado Logico',
        ];
    }

    /**
     * Gets query for [[ObjetivoEspecificos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getObjetivoEspecificos()
    {
        return $this->hasMany(ObjetivoEspecifico::className(), ['oest_id' => 'oest_id']);
    }

    /**
     * Gets query for [[Enf]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEnf()
    {
        return $this->hasOne(Enfoque::className(), ['enf_id' => 'enf_id']);
    }

    /**
     * Gets query for [[Cbsc]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCbsc()
    {
        return $this->hasOne(CategoriaBsc::className(), ['cbsc_id' => 'cbsc_id']);
    }
}
