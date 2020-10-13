<?php

namespace app\modules\gpr\models;

use Yii;

/**
 * This is the model class for table "nivel".
 *
 * @property int $niv_id
 * @property string $niv_nombre
 * @property string $niv_descripcion
 * @property int $niv_usuario_ingreso
 * @property int|null $niv_usuario_modifica
 * @property string $niv_estado
 * @property string $niv_fecha_creacion
 * @property string|null $niv_fecha_modificacion
 * @property string $niv_estado_logico
 */
class Nivel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nivel';
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
            [['niv_nombre', 'niv_descripcion', 'niv_usuario_ingreso', 'niv_estado', 'niv_estado_logico'], 'required'],
            [['niv_usuario_ingreso', 'niv_usuario_modifica'], 'integer'],
            [['niv_fecha_creacion', 'niv_fecha_modificacion'], 'safe'],
            [['niv_nombre'], 'string', 'max' => 300],
            [['niv_descripcion'], 'string', 'max' => 500],
            [['niv_estado', 'niv_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'niv_id' => 'Niv ID',
            'niv_nombre' => 'Niv Nombre',
            'niv_descripcion' => 'Niv Descripcion',
            'niv_usuario_ingreso' => 'Niv Usuario Ingreso',
            'niv_usuario_modifica' => 'Niv Usuario Modifica',
            'niv_estado' => 'Niv Estado',
            'niv_fecha_creacion' => 'Niv Fecha Creacion',
            'niv_fecha_modificacion' => 'Niv Fecha Modificacion',
            'niv_estado_logico' => 'Niv Estado Logico',
        ];
    }
}
