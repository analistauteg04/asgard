<?php

namespace app\modules\financiero\models;

use Yii;

/**
 * This is the model class for table "persona_beneficiaria".
 *
 * @property int $pben_id
 * @property string $pben_nombre
 * @property string $pben_apellido
 * @property string $pben_cedula
 * @property string $pben_ruc
 * @property string $pben_pasaporte
 * @property string $pben_celular
 * @property string $pben_correo
 * @property string $pben_estado
 * @property string $pben_fecha_creacion
 * @property string $pben_fecha_modificacion
 * @property string $pben_estado_logico
 *
 * @property SolicitudBotonPago[] $solicitudBotonPagos
 */
class PersonaBeneficiaria extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'persona_beneficiaria';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_facturacion');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pben_cedula', 'pben_estado', 'pben_estado_logico'], 'required'],
            [['pben_fecha_creacion', 'pben_fecha_modificacion'], 'safe'],
            [['pben_nombre', 'pben_apellido', 'pben_correo'], 'string', 'max' => 250],
            [['pben_cedula', 'pben_ruc'], 'string', 'max' => 15],
            [['pben_pasaporte', 'pben_celular'], 'string', 'max' => 50],
            [['pben_estado', 'pben_estado_logico'], 'string', 'max' => 1],
        ];
    }
    public function insertPersonaBeneficia(){
        
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pben_id' => 'Pben ID',
            'pben_nombre' => 'Pben Nombre',
            'pben_apellido' => 'Pben Apellido',
            'pben_cedula' => 'Pben Cedula',
            'pben_ruc' => 'Pben Ruc',
            'pben_pasaporte' => 'Pben Pasaporte',
            'pben_celular' => 'Pben Celular',
            'pben_correo' => 'Pben Correo',
            'pben_estado' => 'Pben Estado',
            'pben_fecha_creacion' => 'Pben Fecha Creacion',
            'pben_fecha_modificacion' => 'Pben Fecha Modificacion',
            'pben_estado_logico' => 'Pben Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudBotonPagos()
    {
        return $this->hasMany(SolicitudBotonPago::className(), ['pben_id' => 'pben_id']);
    }
}
