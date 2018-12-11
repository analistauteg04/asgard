<?php

namespace app\modules\marketing\models;

use yii\data\ArrayDataProvider;
use DateTime;
use Yii;

/**
 * This is the model class for table "solicitudins_documento".
 *
 * @property int $sdoc_id
 * @property int $sins_id
 * @property int $int_id
 * @property int $dadj_id
 * @property string $sdoc_archivo
 * @property string $sdoc_observacion
 * @property int $sdoc_usuario_ingreso
 * @property int $sdoc_usuario_modifica
 * @property string $sdoc_estado
 * @property string $sdoc_fecha_creacion
 * @property string $sdoc_fecha_modificacion
 * @property string $sdoc_estado_logico
 *
 * @property SolicitudInscripcion $sins
 * @property Interesado $int
 * @property DocumentoAdjuntar $dadj
 */
class Whatsapp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Whatsapp';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_marketing');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sins_id', 'int_id', 'dadj_id', 'sdoc_archivo', 'sdoc_estado', 'sdoc_estado_logico'], 'required'],
            [['sins_id', 'int_id', 'dadj_id', 'sdoc_usuario_ingreso', 'sdoc_usuario_modifica'], 'integer'],
            [['sdoc_fecha_creacion', 'sdoc_fecha_modificacion'], 'safe'],
            [['sdoc_archivo', 'sdoc_observacion'], 'string', 'max' => 500],
            [['sdoc_estado', 'sdoc_estado_logico'], 'string', 'max' => 1],
            [['sins_id'], 'exist', 'skipOnError' => true, 'targetClass' => SolicitudInscripcion::className(), 'targetAttribute' => ['sins_id' => 'sins_id']],
            [['int_id'], 'exist', 'skipOnError' => true, 'targetClass' => Interesado::className(), 'targetAttribute' => ['int_id' => 'int_id']],
            [['dadj_id'], 'exist', 'skipOnError' => true, 'targetClass' => DocumentoAdjuntar::className(), 'targetAttribute' => ['dadj_id' => 'dadj_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sdoc_id' => 'Sdoc ID',
            'sins_id' => 'Sins ID',
            'int_id' => 'Int ID',
            'dadj_id' => 'Dadj ID',
            'sdoc_archivo' => 'Sdoc Archivo',
            'sdoc_observacion' => 'Sdoc Observacion',
            'sdoc_usuario_ingreso' => 'Sdoc Usuario Ingreso',
            'sdoc_usuario_modifica' => 'Sdoc Usuario Modifica',
            'sdoc_estado' => 'Sdoc Estado',
            'sdoc_fecha_creacion' => 'Sdoc Fecha Creacion',
            'sdoc_fecha_modificacion' => 'Sdoc Fecha Modificacion',
            'sdoc_estado_logico' => 'Sdoc Estado Logico',
        ];
    }
}
