<?php
namespace app\modules\academico\models;

use yii\base\Exception;
use Yii;
use yii\data\ArrayDataProvider;
use app\models\Utilities;

/**
 * This is the model class for table "certificados_generadas".
 *
 * @property int $cgen_id
 * @property int $egen_id
 * @property string $cgen_codigo
 * @property string $cgen_observacion
 * @property string $cgen_fecha_codigo_generado
 * @property string $cgen_fecha_certificado_subido
 * @property string $cgen_fecha_caducidad
 * @property string $cgen_ruta_archivo_pdf
 * @property int $cgen_usuario_ingreso
 * @property int $cgen_usuario_modifica
 * @property string $cgen_estado
 * @property string $cgen_fecha_creacion
 * @property string $cgen_fecha_modificacion
 * @property string $cgen_estado_logico
 *
 * @property EspeciesGeneradas $egen
 */
class CertificadosGeneradas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'certificados_generadas';
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
            [['egen_id', 'cgen_codigo', 'cgen_estado_logico'], 'required'],
            [['egen_id', 'cgen_usuario_ingreso', 'cgen_usuario_modifica'], 'integer'],
            [['cgen_observacion'], 'string'],
            [['cgen_fecha_codigo_generado', 'cgen_fecha_certificado_subido', 'cgen_fecha_caducidad', 'cgen_fecha_creacion', 'cgen_fecha_modificacion'], 'safe'],
            [['cgen_codigo'], 'string', 'max' => 100],
            [['cgen_ruta_archivo_pdf'], 'string', 'max' => 500],
            [['cgen_estado', 'cgen_estado_logico'], 'string', 'max' => 1],
            [['cgen_codigo'], 'unique'],
            [['egen_id'], 'exist', 'skipOnError' => true, 'targetClass' => EspeciesGeneradas::className(), 'targetAttribute' => ['egen_id' => 'egen_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cgen_id' => 'Cgen ID',
            'egen_id' => 'Egen ID',
            'cgen_codigo' => 'Cgen Codigo',
            'cgen_observacion' => 'Cgen Observacion',
            'cgen_fecha_codigo_generado' => 'Cgen Fecha Codigo Generado',
            'cgen_fecha_certificado_subido' => 'Cgen Fecha Certificado Subido',
            'cgen_fecha_caducidad' => 'Cgen Fecha Caducidad',
            'cgen_ruta_archivo_pdf' => 'Cgen Ruta Archivo Pdf',
            'cgen_usuario_ingreso' => 'Cgen Usuario Ingreso',
            'cgen_usuario_modifica' => 'Cgen Usuario Modifica',
            'cgen_estado' => 'Cgen Estado',
            'cgen_fecha_creacion' => 'Cgen Fecha Creacion',
            'cgen_fecha_modificacion' => 'Cgen Fecha Modificacion',
            'cgen_estado_logico' => 'Cgen Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEgen()
    {
        return $this->hasOne(EspeciesGeneradas::className(), ['egen_id' => 'egen_id']);
    }
}
