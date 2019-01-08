<?php

namespace app\modules\marketing\models;

use Yii;

/**
 * This is the model class for table "lista".
 *
 * @property int $lis_id
 * @property int $eaca_id
 * @property int $mest_id
 * @property string $lis_nombre
 * @property string $lis_descripcion
 * @property string $lis_estado
 * @property string $lis_fecha_creacion
 * @property string $lis_fecha_modificacion
 * @property string $lis_estado_logico
 *
 * @property ListaSuscriptor[] $listaSuscriptors
 * @property Programacion[] $programacions
 */
class Lista extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lista';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_mailing');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['eaca_id', 'mest_id'], 'integer'],
            [['lis_nombre', 'lis_descripcion', 'lis_estado', 'lis_estado_logico'], 'required'],
            [['lis_fecha_creacion', 'lis_fecha_modificacion'], 'safe'],
            [['lis_nombre'], 'string', 'max' => 50],
            [['lis_descripcion'], 'string', 'max' => 500],
            [['lis_estado', 'lis_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'lis_id' => 'Lis ID',
            'eaca_id' => 'Eaca ID',
            'mest_id' => 'Mest ID',
            'lis_nombre' => 'Lis Nombre',
            'lis_descripcion' => 'Lis Descripcion',
            'lis_estado' => 'Lis Estado',
            'lis_fecha_creacion' => 'Lis Fecha Creacion',
            'lis_fecha_modificacion' => 'Lis Fecha Modificacion',
            'lis_estado_logico' => 'Lis Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getListaSuscriptors()
    {
        return $this->hasMany(ListaSuscriptor::className(), ['lis_id' => 'lis_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgramacions()
    {
        return $this->hasMany(Programacion::className(), ['lis_id' => 'lis_id']);
    }
}
