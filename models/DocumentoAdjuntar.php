<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "documento_adjuntar".
 *
 * @property integer $dadj_id
 * @property string $dadj_nombre
 * @property string $dadj_descripcion
 * @property string $dadj_estado
 * @property string $dadj_fecha_creacion
 * @property string $dadj_fecha_modificacion
 * @property string $dadj_estado_logico
 *
 * @property DocNintTciudadano[] $docNintTciudadanos
 * @property SolicitudinsDocumento[] $solicitudinsDocumentos
 */
class DocumentoAdjuntar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        //return 'documento_adjuntar';
        return \Yii::$app->db_captacion->dbname . '.documento_adjuntar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dadj_nombre', 'dadj_descripcion', 'dadj_estado', 'dadj_estado_logico'], 'required'],
            [['dadj_fecha_creacion', 'dadj_fecha_modificacion'], 'safe'],
            [['dadj_nombre'], 'string', 'max' => 300],
            [['dadj_descripcion'], 'string', 'max' => 500],
            [['dadj_estado', 'dadj_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dadj_id' => 'Dadj ID',
            'dadj_nombre' => 'Dadj Nombre',
            'dadj_descripcion' => 'Dadj Descripcion',
            'dadj_estado' => 'Dadj Estado',
            'dadj_fecha_creacion' => 'Dadj Fecha Creacion',
            'dadj_fecha_modificacion' => 'Dadj Fecha Modificacion',
            'dadj_estado_logico' => 'Dadj Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocNintTciudadanos()
    {
        return $this->hasMany(DocNintTciudadano::className(), ['dadj_id' => 'dadj_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudinsDocumentos()
    {
        return $this->hasMany(SolicitudinsDocumento::className(), ['dadj_id' => 'dadj_id']);
    }
}
