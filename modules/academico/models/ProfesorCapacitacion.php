<?php

namespace app\modules\academico\models;

use Yii;

/**
 * This is the model class for table "profesor_capacitacion".
 *
 * @property int $pcap_id
 * @property int $pro_id
 * @property string $pcap_evento
 * @property string $pcap_institucion
 * @property string $pcap_anio
 * @property string $pcap_tipo
 * @property string $pcap_duracion
 * @property int $pcap_usuario_ingreso
 * @property int $pcap_usuario_modifica
 * @property string $pcap_estado
 * @property string $pcap_fecha_creacion
 * @property string $pcap_fecha_modificacion
 * @property string $pcap_estado_logico
 *
 * @property Profesor $pro
 */
class ProfesorCapacitacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profesor_capacitacion';
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
            [['pro_id', 'pcap_evento', 'pcap_institucion', 'pcap_anio', 'pcap_tipo', 'pcap_duracion', 'pcap_usuario_ingreso', 'pcap_estado', 'pcap_estado_logico'], 'required'],
            [['pro_id', 'pcap_usuario_ingreso', 'pcap_usuario_modifica'], 'integer'],
            [['pcap_fecha_creacion', 'pcap_fecha_modificacion'], 'safe'],
            [['pcap_evento', 'pcap_institucion', 'pcap_tipo'], 'string', 'max' => 200],
            [['pcap_anio'], 'string', 'max' => 4],
            [['pcap_duracion'], 'string', 'max' => 20],
            [['pcap_estado', 'pcap_estado_logico'], 'string', 'max' => 1],
            [['pro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profesor::className(), 'targetAttribute' => ['pro_id' => 'pro_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pcap_id' => 'Pcap ID',
            'pro_id' => 'Pro ID',
            'pcap_evento' => 'Pcap Evento',
            'pcap_institucion' => 'Pcap Institucion',
            'pcap_anio' => 'Pcap Anio',
            'pcap_tipo' => 'Pcap Tipo',
            'pcap_duracion' => 'Pcap Duracion',
            'pcap_usuario_ingreso' => 'Pcap Usuario Ingreso',
            'pcap_usuario_modifica' => 'Pcap Usuario Modifica',
            'pcap_estado' => 'Pcap Estado',
            'pcap_fecha_creacion' => 'Pcap Fecha Creacion',
            'pcap_fecha_modificacion' => 'Pcap Fecha Modificacion',
            'pcap_estado_logico' => 'Pcap Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPro()
    {
        return $this->hasOne(Profesor::className(), ['pro_id' => 'pro_id']);
    }

    public function getItems(){
        $arr_data = [
            0 => ['id' => 1, 'nombre' => 'Curso'],
            1 => ['id' => 2, 'nombre' => 'Seminario'],
            2 => ['id' => 3, 'nombre' => 'Taller'],
            3 => ['id' => 4, 'nombre' => 'Congreso'],
            4 => ['id' => 5, 'nombre' => 'Encuentro'],
            5 => ['id' => 6, 'nombre' => 'Otro'],
        ];
        return $arr_data;
    }
}
