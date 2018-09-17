<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_contacto_general".
 *
 * @property integer $tcge_id
 * @property string $tcge_nombre
 * @property string $tcge_descripcion
 * @property string $tcge_estado
 * @property string $tcge_fecha_creacion
 * @property string $tcge_fecha_modificacion
 * @property string $tcge_estado_logico
 *
 * @property ContactoGeneral[] $contactoGenerals
 */
class TipoContactoGeneral extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_contacto_general';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_general');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tcge_estado', 'tcge_estado_logico'], 'required'],
            [['tcge_fecha_creacion', 'tcge_fecha_modificacion'], 'safe'],
            [['tcge_nombre', 'tcge_descripcion'], 'string', 'max' => 100],
            [['tcge_estado', 'tcge_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tcge_id' => 'Tcge ID',
            'tcge_nombre' => 'Tcge Nombre',
            'tcge_descripcion' => 'Tcge Descripcion',
            'tcge_estado' => 'Tcge Estado',
            'tcge_fecha_creacion' => 'Tcge Fecha Creacion',
            'tcge_fecha_modificacion' => 'Tcge Fecha Modificacion',
            'tcge_estado_logico' => 'Tcge Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContactoGenerals()
    {
        return $this->hasMany(ContactoGeneral::className(), ['tcge_id' => 'tcge_id']);
    }
}
