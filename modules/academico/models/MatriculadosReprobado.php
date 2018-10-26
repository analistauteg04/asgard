<?php

namespace app\modules\academico\models;

use Yii;
use yii\data\ArrayDataProvider;

/**
 * This is the model class for table "matriculados_reprobado".
 *
 * @property int $mre_id
 * @property int $adm_id
 * @property int $mre_usuario_ingreso
 * @property int $mreusuario_modifica
 * @property string $mre_estado
 * @property string $mre_fecha_creacion
 * @property string $mre_fecha_modificacion
 * @property string $mre_estado_logico
 *
 * @property Admitido $adm
 */
class MatriculadosReprobado extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'matriculados_reprobado';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_captacion');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['adm_id', 'mre_usuario_ingreso', 'mre_estado', 'mre_estado_logico'], 'required'],
            [['adm_id', 'mre_usuario_ingreso', 'mreusuario_modifica'], 'integer'],
            [['mre_fecha_creacion', 'mre_fecha_modificacion'], 'safe'],
            [['mre_estado', 'mre_estado_logico'], 'string', 'max' => 1],
            [['adm_id'], 'exist', 'skipOnError' => true, 'targetClass' => Admitido::className(), 'targetAttribute' => ['adm_id' => 'adm_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'mre_id' => 'Mre ID',
            'adm_id' => 'Adm ID',
            'mre_usuario_ingreso' => 'Mre Usuario Ingreso',
            'mreusuario_modifica' => 'Mreusuario Modifica',
            'mre_estado' => 'Mre Estado',
            'mre_fecha_creacion' => 'Mre Fecha Creacion',
            'mre_fecha_modificacion' => 'Mre Fecha Modificacion',
            'mre_estado_logico' => 'Mre Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdm()
    {
        return $this->hasOne(Admitido::className(), ['adm_id' => 'adm_id']);
    }
}
