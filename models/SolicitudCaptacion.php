<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "solicitud_captacion".
 *
 * @property integer $rcap_id
 * @property integer $per_id
 * @property integer $pint_id
 * @property integer $nint_id
 * @property integer $ming_id
 * @property integer $car_id
 * @property integer $mpub_id
 * @property string $rcap_estado
 * @property string $rcap_fecha_creacion
 * @property string $rcap_fecha_modificacion
 * @property string $rcap_estado_logico
 */
class SolicitudCaptacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return \Yii::$app->db_captacion->dbname . '.solicitud_captacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['per_id', 'pint_id', 'rcap_estado', 'rcap_estado_logico'], 'required'],
            [['per_id', 'pint_id', 'nint_id', 'ming_id', 'car_id', 'mpub_id'], 'integer'],
            [['rcap_fecha_creacion', 'rcap_fecha_modificacion'], 'safe'],
            [['rcap_estado', 'rcap_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rcap_id' => 'Rcap ID',
            'per_id' => 'Per ID',
            'pint_id' => 'Pint ID',
            'nint_id' => 'Nint ID',
            'ming_id' => 'Ming ID',
            'car_id' => 'Car ID',
            'mpub_id' => 'Mpub ID',
            'rcap_estado' => 'Rcap Estado',
            'rcap_fecha_creacion' => 'Rcap Fecha Creacion',
            'rcap_fecha_modificacion' => 'Rcap Fecha Modificacion',
            'rcap_estado_logico' => 'Rcap Estado Logico',
        ];
    }
}
