<?php

namespace app\modules\academico\models;

use Yii;

/**
 * This is the model class for table "control_catedra".
 *
 * @property int $cca_id
 * @property int $hape_id
 * @property string $cca_fecha_registro
 * @property string $cca_titulo_unidad
 * @property string $cca_tema
 * @property string $cca_trabajo_autopractico
 * @property string $cca_logro_aprendizaje
 * @property string $cca_observacion
 * @property string $cca_direccion_ip
 * @property int $usu_id
 * @property string $cca_estado
 * @property string $cca_fecha_creacion
 * @property string $cca_fecha_modificacion
 * @property string $cca_estado_logico
 *
 * @property HorarioAsignaturaPeriodo $hape
 */
class ControlCatedra extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'control_catedra';
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
            [['hape_id', 'cca_titulo_unidad', 'cca_tema', 'cca_trabajo_autopractico', 'cca_logro_aprendizaje', 'usu_id', 'cca_estado', 'cca_estado_logico'], 'required'],
            [['hape_id', 'usu_id'], 'integer'],
            [['cca_fecha_registro', 'cca_fecha_creacion', 'cca_fecha_modificacion'], 'safe'],
            [['cca_titulo_unidad'], 'string', 'max' => 500],
            [['cca_tema', 'cca_trabajo_autopractico', 'cca_logro_aprendizaje', 'cca_observacion'], 'string', 'max' => 2000],
            [['cca_direccion_ip'], 'string', 'max' => 20],
            [['cca_estado', 'cca_estado_logico'], 'string', 'max' => 1],
            [['hape_id'], 'exist', 'skipOnError' => true, 'targetClass' => HorarioAsignaturaPeriodo::className(), 'targetAttribute' => ['hape_id' => 'hape_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cca_id' => 'Cca ID',
            'hape_id' => 'Hape ID',
            'cca_fecha_registro' => 'Cca Fecha Registro',
            'cca_titulo_unidad' => 'Cca Titulo Unidad',
            'cca_tema' => 'Cca Tema',
            'cca_trabajo_autopractico' => 'Cca Trabajo Autopractico',
            'cca_logro_aprendizaje' => 'Cca Logro Aprendizaje',
            'cca_observacion' => 'Cca Observacion',
            'cca_direccion_ip' => 'Cca Direccion Ip',
            'usu_id' => 'Usu ID',
            'cca_estado' => 'Cca Estado',
            'cca_fecha_creacion' => 'Cca Fecha Creacion',
            'cca_fecha_modificacion' => 'Cca Fecha Modificacion',
            'cca_estado_logico' => 'Cca Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHape()
    {
        return $this->hasOne(HorarioAsignaturaPeriodo::className(), ['hape_id' => 'hape_id']);
    }
}
