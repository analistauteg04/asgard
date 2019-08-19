<?php

namespace app\modules\marcacionhistorico\models;

use Yii;

/**
 * This is the model class for table "registro_marcacion_historial".
 *
 * @property int $rmhi_id
 * @property int $haph_id
 * @property string $rmhi_fecha_hora_entrada
 * @property string $rmhi_fecha_hora_salida
 * @property string $rmhi_estado
 * @property string $rmhi_fecha_creacion
 * @property string $rmhi_fecha_modificacion
 * @property string $rmhi_estado_logico
 *
 * @property HorarioAsignaturaPeriodoHistorial $haph
 */
class RegistroMarcacionHistorial extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'registro_marcacion_historial';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_marcacion_historico');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['haph_id', 'rmhi_estado', 'rmhi_estado_logico'], 'required'],
            [['haph_id'], 'integer'],
            [['rmhi_fecha_hora_entrada', 'rmhi_fecha_hora_salida', 'rmhi_fecha_creacion', 'rmhi_fecha_modificacion'], 'safe'],
            [['rmhi_estado', 'rmhi_estado_logico'], 'string', 'max' => 1],
            [['haph_id'], 'exist', 'skipOnError' => true, 'targetClass' => HorarioAsignaturaPeriodoHistorial::className(), 'targetAttribute' => ['haph_id' => 'haph_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rmhi_id' => 'Rmhi ID',
            'haph_id' => 'Haph ID',
            'rmhi_fecha_hora_entrada' => 'Rmhi Fecha Hora Entrada',
            'rmhi_fecha_hora_salida' => 'Rmhi Fecha Hora Salida',
            'rmhi_estado' => 'Rmhi Estado',
            'rmhi_fecha_creacion' => 'Rmhi Fecha Creacion',
            'rmhi_fecha_modificacion' => 'Rmhi Fecha Modificacion',
            'rmhi_estado_logico' => 'Rmhi Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHaph()
    {
        return $this->hasOne(HorarioAsignaturaPeriodoHistorial::className(), ['haph_id' => 'haph_id']);
    }
}
