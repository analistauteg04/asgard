<?php

namespace app\modules\gpr\models;

use Yii;

/**
 * This is the model class for table "categoria".
 *
 * @property int $cat_id
 * @property string $cat_nombre
 * @property string $cat_descripcion
 * @property int $cat_usuario_ingreso
 * @property int|null $cat_usuario_modifica
 * @property string $cat_estado
 * @property string $cat_fecha_creacion
 * @property string|null $cat_fecha_modificacion
 * @property string $cat_estado_logico
 */
class Categoria extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categoria';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_gpr');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cat_nombre', 'cat_descripcion', 'cat_usuario_ingreso', 'cat_estado', 'cat_estado_logico'], 'required'],
            [['cat_usuario_ingreso', 'cat_usuario_modifica'], 'integer'],
            [['cat_fecha_creacion', 'cat_fecha_modificacion'], 'safe'],
            [['cat_nombre'], 'string', 'max' => 300],
            [['cat_descripcion'], 'string', 'max' => 500],
            [['cat_estado', 'cat_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cat_id' => 'Cat ID',
            'cat_nombre' => 'Cat Nombre',
            'cat_descripcion' => 'Cat Descripcion',
            'cat_usuario_ingreso' => 'Cat Usuario Ingreso',
            'cat_usuario_modifica' => 'Cat Usuario Modifica',
            'cat_estado' => 'Cat Estado',
            'cat_fecha_creacion' => 'Cat Fecha Creacion',
            'cat_fecha_modificacion' => 'Cat Fecha Modificacion',
            'cat_estado_logico' => 'Cat Estado Logico',
        ];
    }
}
