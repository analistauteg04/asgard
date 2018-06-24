<?php

namespace app\models;
use yii\data\ArrayDataProvider;

use Yii;

/**
 * This is the model class for table "unidad_academica".
 *
 * @property integer $uaca_id
 * @property string $uaca_nombre
 * @property string $uaca_descripcion
 * @property string $uaca_estado
 * @property string $uaca_fecha_creacion
 * @property string $uaca_fecha_modificacion
 * @property string $uaca_estado_logico
 */
class UnidadAcademica extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'unidad_academica';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_academico');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uaca_nombre', 'uaca_descripcion', 'uaca_estado', 'uaca_estado_logico'], 'required'],
            [['uaca_fecha_creacion', 'uaca_fecha_modificacion'], 'safe'],
            [['uaca_nombre'], 'string', 'max' => 300],
            [['uaca_descripcion'], 'string', 'max' => 500],
            [['uaca_estado', 'uaca_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uaca_id' => 'Uaca ID',
            'uaca_nombre' => 'Uaca Nombre',
            'uaca_descripcion' => 'Uaca Descripcion',
            'uaca_estado' => 'Uaca Estado',
            'uaca_fecha_creacion' => 'Uaca Fecha Creacion',
            'uaca_fecha_modificacion' => 'Uaca Fecha Modificacion',
            'uaca_estado_logico' => 'Uaca Estado Logico',
        ];
    }
}
