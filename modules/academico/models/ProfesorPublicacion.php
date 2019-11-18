<?php

namespace app\modules\academico\models;

use Yii;

/**
 * This is the model class for table "profesor_publicacion".
 *
 * @property int $ppub_id
 * @property int $pro_id
 * @property string $ppub_produccion
 * @property string $ppub_titulo
 * @property string $ppub_editorial
 * @property string $ppub_isbn
 * @property string $ppub_autoria
 * @property int $ppub_usuario_ingreso
 * @property int $ppub_usuario_modifica
 * @property string $ppub_estado
 * @property string $ppub_fecha_creacion
 * @property string $ppub_fecha_modificacion
 * @property string $ppub_estado_logico
 *
 * @property Profesor $pro
 */
class ProfesorPublicacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profesor_publicacion';
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
            [['pro_id', 'ppub_produccion', 'ppub_titulo', 'ppub_editorial', 'ppub_isbn', 'ppub_autoria', 'ppub_usuario_ingreso', 'ppub_estado', 'ppub_estado_logico'], 'required'],
            [['pro_id', 'ppub_usuario_ingreso', 'ppub_usuario_modifica'], 'integer'],
            [['ppub_fecha_creacion', 'ppub_fecha_modificacion'], 'safe'],
            [['ppub_produccion'], 'string', 'max' => 100],
            [['ppub_titulo', 'ppub_autoria'], 'string', 'max' => 200],
            [['ppub_editorial', 'ppub_isbn'], 'string', 'max' => 50],
            [['ppub_estado', 'ppub_estado_logico'], 'string', 'max' => 1],
            [['pro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profesor::className(), 'targetAttribute' => ['pro_id' => 'pro_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ppub_id' => 'Ppub ID',
            'pro_id' => 'Pro ID',
            'ppub_produccion' => 'Ppub Produccion',
            'ppub_titulo' => 'Ppub Titulo',
            'ppub_editorial' => 'Ppub Editorial',
            'ppub_isbn' => 'Ppub Isbn',
            'ppub_autoria' => 'Ppub Autoria',
            'ppub_usuario_ingreso' => 'Ppub Usuario Ingreso',
            'ppub_usuario_modifica' => 'Ppub Usuario Modifica',
            'ppub_estado' => 'Ppub Estado',
            'ppub_fecha_creacion' => 'Ppub Fecha Creacion',
            'ppub_fecha_modificacion' => 'Ppub Fecha Modificacion',
            'ppub_estado_logico' => 'Ppub Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPro()
    {
        return $this->hasOne(Profesor::className(), ['pro_id' => 'pro_id']);
    }
}
