<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "solicitud_inscripcion".
 *
 * @property int $sins_id
 * @property int $int_id
 * @property int $uaca_id
 * @property int $mod_id
 * @property int $ming_id
 * @property int $eaca_id
 * @property int $mest_id
 * @property int $emp_id
 * @property string $num_solicitud
 * @property int $rsin_id
 * @property string $sins_fecha_solicitud
 * @property string $sins_fecha_preaprobacion
 * @property string $sins_fecha_aprobacion
 * @property string $sins_fecha_reprobacion
 * @property string $sins_fecha_prenoprobacion
 * @property string $sins_preobservacion
 * @property string $sins_observacion
 * @property string $sins_beca
 * @property int $sins_usuario_preaprueba
 * @property int $sins_usuario_aprueba
 * @property int $sins_usuario_ingreso
 * @property int $sins_usuario_modifica
 * @property string $sins_estado
 * @property string $sins_fecha_creacion
 * @property string $sins_fecha_modificacion
 * @property string $sins_estado_logico
 *
 * @property SolicitudDatosFactura[] $solicitudDatosFacturas
 * @property Interesado $int
 * @property MetodoIngreso $ming
 * @property ResSolInscripcion $rsin
 * @property SolicitudRechazada[] $solicitudRechazadas
 * @property SolicitudinsDocumento[] $solicitudinsDocumentos
 */
class SolicitudInscripcion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'solicitud_inscripcion';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_captacion');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['int_id', 'rsin_id', 'sins_estado', 'sins_estado_logico'], 'required'],
            [['int_id', 'uaca_id', 'mod_id', 'ming_id', 'eaca_id', 'mest_id', 'emp_id', 'rsin_id', 'sins_usuario_preaprueba', 'sins_usuario_aprueba', 'sins_usuario_ingreso', 'sins_usuario_modifica'], 'integer'],
            [['sins_fecha_solicitud', 'sins_fecha_preaprobacion', 'sins_fecha_aprobacion', 'sins_fecha_reprobacion', 'sins_fecha_prenoprobacion', 'sins_fecha_creacion', 'sins_fecha_modificacion'], 'safe'],
            [['num_solicitud'], 'string', 'max' => 10],
            [['sins_preobservacion', 'sins_observacion'], 'string', 'max' => 1000],
            [['sins_beca', 'sins_estado', 'sins_estado_logico'], 'string', 'max' => 1],
            [['int_id'], 'exist', 'skipOnError' => true, 'targetClass' => Interesado::className(), 'targetAttribute' => ['int_id' => 'int_id']],
            [['ming_id'], 'exist', 'skipOnError' => true, 'targetClass' => MetodoIngreso::className(), 'targetAttribute' => ['ming_id' => 'ming_id']],
            [['rsin_id'], 'exist', 'skipOnError' => true, 'targetClass' => ResSolInscripcion::className(), 'targetAttribute' => ['rsin_id' => 'rsin_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sins_id' => 'Sins ID',
            'int_id' => 'Int ID',
            'uaca_id' => 'Uaca ID',
            'mod_id' => 'Mod ID',
            'ming_id' => 'Ming ID',
            'eaca_id' => 'Eaca ID',
            'mest_id' => 'Mest ID',
            'emp_id' => 'Emp ID',
            'num_solicitud' => 'Num Solicitud',
            'rsin_id' => 'Rsin ID',
            'sins_fecha_solicitud' => 'Sins Fecha Solicitud',
            'sins_fecha_preaprobacion' => 'Sins Fecha Preaprobacion',
            'sins_fecha_aprobacion' => 'Sins Fecha Aprobacion',
            'sins_fecha_reprobacion' => 'Sins Fecha Reprobacion',
            'sins_fecha_prenoprobacion' => 'Sins Fecha Prenoprobacion',
            'sins_preobservacion' => 'Sins Preobservacion',
            'sins_observacion' => 'Sins Observacion',
            'sins_beca' => 'Sins Beca',
            'sins_usuario_preaprueba' => 'Sins Usuario Preaprueba',
            'sins_usuario_aprueba' => 'Sins Usuario Aprueba',
            'sins_usuario_ingreso' => 'Sins Usuario Ingreso',
            'sins_usuario_modifica' => 'Sins Usuario Modifica',
            'sins_estado' => 'Sins Estado',
            'sins_fecha_creacion' => 'Sins Fecha Creacion',
            'sins_fecha_modificacion' => 'Sins Fecha Modificacion',
            'sins_estado_logico' => 'Sins Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudDatosFacturas()
    {
        return $this->hasMany(SolicitudDatosFactura::className(), ['sins_id' => 'sins_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInt()
    {
        return $this->hasOne(Interesado::className(), ['int_id' => 'int_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMing()
    {
        return $this->hasOne(MetodoIngreso::className(), ['ming_id' => 'ming_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRsin()
    {
        return $this->hasOne(ResSolInscripcion::className(), ['rsin_id' => 'rsin_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudRechazadas()
    {
        return $this->hasMany(SolicitudRechazada::className(), ['sins_id' => 'sins_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudinsDocumentos()
    {
        return $this->hasMany(SolicitudinsDocumento::className(), ['sins_id' => 'sins_id']);
    }
}
