<?php

namespace app\modules\academico\models;

use Yii;

/**
 * This is the model class for table "profesor_instruccion".
 *
 * @property int $pins_id
 * @property int $pro_id
 * @property int $nins_id
 * @property string $pins_institucion
 * @property string $pins_especializacion
 * @property string $pins_titulo
 * @property string $pins_senescyt
 * @property int $pins_usuario_ingreso
 * @property int $pins_usuario_modifica
 * @property string $pins_estado
 * @property string $pins_fecha_creacion
 * @property string $pins_fecha_modificacion
 * @property string $pins_estado_logico
 *
 * @property Profesor $pro
 * @property NivelInstruccion $nins
 */
class ProfesorInstruccion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profesor_instruccion';
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
            [['pro_id', 'nins_id', 'pins_institucion', 'pins_especializacion', 'pins_titulo', 'pins_senescyt', 'pins_usuario_ingreso', 'pins_estado', 'pins_estado_logico'], 'required'],
            [['pro_id', 'nins_id', 'pins_usuario_ingreso', 'pins_usuario_modifica'], 'integer'],
            [['pins_fecha_creacion', 'pins_fecha_modificacion'], 'safe'],
            [['pins_institucion', 'pins_especializacion'], 'string', 'max' => 150],
            [['pins_titulo'], 'string', 'max' => 200],
            [['pins_senescyt'], 'string', 'max' => 50],
            [['pins_estado', 'pins_estado_logico'], 'string', 'max' => 1],
            [['pro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profesor::className(), 'targetAttribute' => ['pro_id' => 'pro_id']],
            [['nins_id'], 'exist', 'skipOnError' => true, 'targetClass' => NivelInstruccion::className(), 'targetAttribute' => ['nins_id' => 'nins_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pins_id' => 'Pins ID',
            'pro_id' => 'Pro ID',
            'nins_id' => 'Nins ID',
            'pins_institucion' => 'Pins Institucion',
            'pins_especializacion' => 'Pins Especializacion',
            'pins_titulo' => 'Pins Titulo',
            'pins_senescyt' => 'Pins Senescyt',
            'pins_usuario_ingreso' => 'Pins Usuario Ingreso',
            'pins_usuario_modifica' => 'Pins Usuario Modifica',
            'pins_estado' => 'Pins Estado',
            'pins_fecha_creacion' => 'Pins Fecha Creacion',
            'pins_fecha_modificacion' => 'Pins Fecha Modificacion',
            'pins_estado_logico' => 'Pins Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPro()
    {
        return $this->hasOne(Profesor::className(), ['pro_id' => 'pro_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNins()
    {
        return $this->hasOne(NivelInstruccion::className(), ['nins_id' => 'nins_id']);
    }
}
