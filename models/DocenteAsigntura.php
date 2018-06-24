<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "docente_asigntura".
 *
 * @property integer $dasi_id
 * @property integer $per_id
 * @property integer $casi_id
 * @property integer $uaca_id
 * @property string $dasi_hora_ini
 * @property string $dasi_hora_fin
 * @property string $dasi_cant_horas
 * @property string $dasi_estado
 * @property string $dasi_fecha_creacion
 * @property string $dasi_fecha_modificacion
 * @property string $dasi_estado_logico
 */
class DocenteAsigntura extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'docente_asigntura';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_academico');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['per_id', 'casi_id', 'uaca_id', 'dasi_hora_ini', 'dasi_hora_fin', 'dasi_cant_horas', 'dasi_estado', 'dasi_estado_logico'], 'required'],
            [['per_id', 'casi_id', 'uaca_id'], 'integer'],
            [['dasi_fecha_creacion', 'dasi_fecha_modificacion'], 'safe'],
            [['dasi_hora_ini', 'dasi_hora_fin', 'dasi_cant_horas', 'dasi_estado', 'dasi_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dasi_id' => 'Dasi ID',
            'per_id' => 'Per ID',
            'casi_id' => 'Casi ID',
            'uaca_id' => 'Uaca ID',
            'dasi_hora_ini' => 'Dasi Hora Ini',
            'dasi_hora_fin' => 'Dasi Hora Fin',
            'dasi_cant_horas' => 'Dasi Cant Horas',
            'dasi_estado' => 'Dasi Estado',
            'dasi_fecha_creacion' => 'Dasi Fecha Creacion',
            'dasi_fecha_modificacion' => 'Dasi Fecha Modificacion',
            'dasi_estado_logico' => 'Dasi Estado Logico',
        ];
    }
}
