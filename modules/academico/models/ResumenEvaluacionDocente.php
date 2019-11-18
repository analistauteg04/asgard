<?php

namespace app\modules\academico\models;

use yii\data\ArrayDataProvider;
use Yii;

/**
 * This is the model class for table "resumen_evaluacion_docente".
 *
 * @property int $redo_id
 * @property int $pro_id
 * @property int $saca_id
 * @property int $teva_id
 * @property int $redo_cant_horas
 * @property int $redo_puntaje_evaluacion
 * @property string $redo_estado
 * @property string $redo_fecha_creacion
 * @property string $redo_fecha_modificacion
 * @property string $redo_estado_logico
 *
 * @property SemestreAcademico $saca
 * @property Profesor $pro
 * @property TipoEvaluacion $teva
 */
class ResumenEvaluacionDocente extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resumen_evaluacion_docente';
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
            [['pro_id', 'saca_id', 'teva_id', 'redo_estado', 'redo_estado_logico'], 'required'],
            [['pro_id', 'saca_id', 'teva_id', 'redo_cant_horas', 'redo_puntaje_evaluacion'], 'integer'],
            [['redo_fecha_creacion', 'redo_fecha_modificacion'], 'safe'],
            [['redo_estado', 'redo_estado_logico'], 'string', 'max' => 1],
            [['saca_id'], 'exist', 'skipOnError' => true, 'targetClass' => SemestreAcademico::className(), 'targetAttribute' => ['saca_id' => 'saca_id']],
            [['pro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profesor::className(), 'targetAttribute' => ['pro_id' => 'pro_id']],
            [['teva_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoEvaluacion::className(), 'targetAttribute' => ['teva_id' => 'teva_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'redo_id' => 'Redo ID',
            'pro_id' => 'Pro ID',
            'saca_id' => 'Saca ID',
            'teva_id' => 'Teva ID',
            'redo_cant_horas' => 'Redo Cant Horas',
            'redo_puntaje_evaluacion' => 'Redo Puntaje Evaluacion',
            'redo_estado' => 'Redo Estado',
            'redo_fecha_creacion' => 'Redo Fecha Creacion',
            'redo_fecha_modificacion' => 'Redo Fecha Modificacion',
            'redo_estado_logico' => 'Redo Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaca()
    {
        return $this->hasOne(SemestreAcademico::className(), ['saca_id' => 'saca_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPro()
    {
        return $this->hasOne(Profesor::className(), ['pro_id' => 'pro_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeva()
    {
        return $this->hasOne(TipoEvaluacion::className(), ['teva_id' => 'teva_id']);
    }
}
