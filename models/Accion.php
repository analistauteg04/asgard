<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "accion".
 *
 * @property integer $acc_id
 * @property string $acc_nombre
 * @property string $acc_url_accion
 * @property string $acc_tipo
 * @property string $acc_descripcion
 * @property string $acc_lang_file
 * @property string $acc_dir_imagen
 * @property string $acc_estado
 * @property string $acc_fecha_creacion
 * @property string $acc_fecha_modificacion
 * @property string $acc_estado_logico
 *
 * @property ObmoAcci[] $obmoAccis
 */
class Accion extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'accion';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['acc_estado', 'acc_estado_logico'], 'required'],
            [['acc_fecha_creacion', 'acc_fecha_modificacion'], 'safe'],
            [['acc_nombre', 'acc_url_accion', 'acc_tipo', 'acc_lang_file', 'acc_dir_imagen'], 'string', 'max' => 250],
            [['acc_descripcion'], 'string', 'max' => 500],
            [['acc_estado', 'acc_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'acc_id' => 'Acc ID',
            'acc_nombre' => 'Acc Nombre',
            'acc_url_accion' => 'Acc Url Accion',
            'acc_tipo' => 'Acc Tipo',
            'acc_descripcion' => 'Acc Descripcion',
            'acc_lang_file' => 'Acc Lang File',
            'acc_dir_imagen' => 'Acc Dir Imagen',
            'acc_estado' => 'Acc Estado',
            'acc_fecha_creacion' => 'Acc Fecha Creacion',
            'acc_fecha_modificacion' => 'Acc Fecha Modificacion',
            'acc_estado_logico' => 'Acc Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObmoAccis() {
        return $this->hasMany(ObmoAcci::className(), ['acc_id' => 'acc_id']);
    }

}
