<?php

namespace app\modules\admision\models;

use Yii;

/**
 * This is the model class for table "bitacora_seguimiento".
 *
 * @property int $bseg_id
 * @property string $bseg_nombre
 * @property string $bseg_descripcion
 * @property string $bseg_estado
 * @property string $bseg_fecha_creacion
 * @property string $bseg_fecha_modificacion
 * @property string $bseg_estado_logico
 */
class BitacoraSeguimiento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bitacora_seguimiento';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_crm');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bseg_nombre', 'bseg_descripcion', 'bseg_estado', 'bseg_estado_logico'], 'required'],
            [['bseg_fecha_creacion', 'bseg_fecha_modificacion'], 'safe'],
            [['bseg_nombre'], 'string', 'max' => 300],
            [['bseg_descripcion'], 'string', 'max' => 500],
            [['bseg_estado', 'bseg_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'bseg_id' => 'Bseg ID',
            'bseg_nombre' => 'Bseg Nombre',
            'bseg_descripcion' => 'Bseg Descripcion',
            'bseg_estado' => 'Bseg Estado',
            'bseg_fecha_creacion' => 'Bseg Fecha Creacion',
            'bseg_fecha_modificacion' => 'Bseg Fecha Modificacion',
            'bseg_estado_logico' => 'Bseg Estado Logico',
        ];
    }
}
