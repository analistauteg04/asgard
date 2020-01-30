<?php

namespace app\modules\academico\models;
use yii\data\ArrayDataProvider;
use Yii;

/**
 * This is the model class for table "estudiante".
 *
 * @property int $est_id
 * @property int $per_id
 * @property int $est_usuario_ingreso
 * @property int $est_usuario_modifica
 * @property string $est_estado
 * @property string $est_fecha_creacion
 * @property string $est_fecha_modificacion
 * @property string $est_estado_logico
 *
 * @property Matriculacion[] $matriculacions
 * @property MatriculacionProgramaInscrito[] $matriculacionProgramaInscritos
 */
class Estudiante extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estudiante';
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
            [['per_id', 'est_usuario_ingreso', 'est_estado', 'est_estado_logico'], 'required'],
            [['per_id', 'est_usuario_ingreso', 'est_usuario_modifica'], 'integer'],
            [['est_fecha_creacion', 'est_fecha_modificacion'], 'safe'],
            [['est_estado', 'est_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'est_id' => 'Est ID',
            'per_id' => 'Per ID',
            'est_usuario_ingreso' => 'Est Usuario Ingreso',
            'est_usuario_modifica' => 'Est Usuario Modifica',
            'est_estado' => 'Est Estado',
            'est_fecha_creacion' => 'Est Fecha Creacion',
            'est_fecha_modificacion' => 'Est Fecha Modificacion',
            'est_estado_logico' => 'Est Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatriculacions()
    {
        return $this->hasMany(Matriculacion::className(), ['est_id' => 'est_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatriculacionProgramaInscritos()
    {
        return $this->hasMany(MatriculacionProgramaInscrito::className(), ['est_id' => 'est_id']);
    }
    
}
