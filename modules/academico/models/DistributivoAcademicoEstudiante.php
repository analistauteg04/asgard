<?php

namespace app\modules\academico\models;

use yii\data\ArrayDataProvider;
use Yii;

/**
 * This is the model class for table "distributivo_academico_estudiante".
 *
 * @property int $daes_id
 * @property int $daca_id
 * @property int $est_id
 * @property string $daes_fecha_registro
 * @property string $daes_estado
 * @property string $daes_fecha_creacion
 * @property string $daes_fecha_modificacion
 * @property string $daes_estado_logico
 *
 * @property DistributivoAcademico $daca
 * @property Estudiante $est
 */
class DistributivoAcademicoEstudiante extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'distributivo_academico_estudiante';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb() {
        return Yii::$app->get('db_academico');
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['daca_id', 'est_id', 'daes_estado', 'daes_estado_logico'], 'required'],
            [['daca_id', 'est_id'], 'integer'],
            [['daes_fecha_creacion', 'daes_fecha_modificacion', 'daes_fecha_registro'], 'safe'],
            [['daes_estado', 'daes_estado_logico'], 'string', 'max' => 1],
            [['daca_id'], 'exist', 'skipOnError' => true, 'targetClass' => DistributivoAcademico::className(), 'targetAttribute' => ['daca_id' => 'daca_id']],
            [['est_id'], 'exist', 'skipOnError' => true, 'targetClass' => Estudiante::className(), 'targetAttribute' => ['est_id' => 'est_id']],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEst() {
        return $this->hasOne(Estudiante::className(), ['est_id' => 'est_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDaca() {
        return $this->hasOne(DistributivoAcademico::className(), ['daca_id' => 'daca_id']);
    }

}
