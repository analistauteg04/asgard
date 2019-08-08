<?php

namespace app\modules\admision\models;

use Yii;

/**
 * This is the model class for table "inscrito_maestria".
 *
 * @property int $imae_id
 * @property int $cemp_id
 * @property int $gint_id
 * @property int $pai_id_
 * @property int $pro_id
 * @property int $can_id
 * @property string $imae_tipo_documento
 * @property string $imae_documento
 * @property string $imae_primer_nombre
 * @property string $imae_segundo_nombre
 * @property string $imae_primer_apellido
 * @property string $imae_segundo_apellido
 * @property string $imae_revisar_urgente
 * @property string $imae_cumple_requisito
 * @property string $imae_agente
 * @property string $imae_fecha_inscripcion
 * @property string $imae_fecha_pago
 * @property double $imae_pago_inscripcion
 * @property double $imae_valor_maestria
 * @property int $fpag_id
 * @property string $imae_estado_pago
 * @property string $imae_convenios
 * @property int $imae_usuario
 * @property int $imae_usuario_modif
 * @property string $imae_estado
 * @property string $imae_fecha_creacion
 * @property string $imae_fecha_modificacion
 * @property string $imae_estado_logico
 *
 * @property GrupoIntroductorio $gint
 */
class InscritoMaestria extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inscrito_maestria';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_crm');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cemp_id', 'gint_id', 'pai_id_', 'pro_id', 'can_id', 'fpag_id', 'imae_usuario', 'imae_usuario_modif'], 'integer'],
            [['gint_id', 'imae_primer_nombre', 'imae_primer_apellido', 'imae_usuario', 'imae_estado', 'imae_estado_logico'], 'required'],
            [['imae_pago_inscripcion', 'imae_valor_maestria'], 'number'],
            [['imae_fecha_creacion', 'imae_fecha_modificacion'], 'safe'],
            [['imae_tipo_documento', 'imae_cumple_requisito', 'imae_estado_pago'], 'string', 'max' => 2],
            [['imae_documento'], 'string', 'max' => 50],
            [['imae_primer_nombre', 'imae_segundo_nombre', 'imae_primer_apellido', 'imae_segundo_apellido', 'imae_revisar_urgente', 'imae_agente', 'imae_convenios'], 'string', 'max' => 100],
            [['imae_fecha_inscripcion', 'imae_fecha_pago'], 'string', 'max' => 20],
            [['imae_estado', 'imae_estado_logico'], 'string', 'max' => 1],
            [['gint_id'], 'exist', 'skipOnError' => true, 'targetClass' => GrupoIntroductorio::className(), 'targetAttribute' => ['gint_id' => 'gint_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'imae_id' => 'Imae ID',
            'cemp_id' => 'Cemp ID',
            'gint_id' => 'Gint ID',
            'pai_id_' => 'Pai ID',
            'pro_id' => 'Pro ID',
            'can_id' => 'Can ID',
            'imae_tipo_documento' => 'Imae Tipo Documento',
            'imae_documento' => 'Imae Documento',
            'imae_primer_nombre' => 'Imae Primer Nombre',
            'imae_segundo_nombre' => 'Imae Segundo Nombre',
            'imae_primer_apellido' => 'Imae Primer Apellido',
            'imae_segundo_apellido' => 'Imae Segundo Apellido',
            'imae_revisar_urgente' => 'Imae Revisar Urgente',
            'imae_cumple_requisito' => 'Imae Cumple Requisito',
            'imae_agente' => 'Imae Agente',
            'imae_fecha_inscripcion' => 'Imae Fecha Inscripcion',
            'imae_fecha_pago' => 'Imae Fecha Pago',
            'imae_pago_inscripcion' => 'Imae Pago Inscripcion',
            'imae_valor_maestria' => 'Imae Valor Maestria',
            'fpag_id' => 'Fpag ID',
            'imae_estado_pago' => 'Imae Estado Pago',
            'imae_convenios' => 'Imae Convenios',
            'imae_usuario' => 'Imae Usuario',
            'imae_usuario_modif' => 'Imae Usuario Modif',
            'imae_estado' => 'Imae Estado',
            'imae_fecha_creacion' => 'Imae Fecha Creacion',
            'imae_fecha_modificacion' => 'Imae Fecha Modificacion',
            'imae_estado_logico' => 'Imae Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGint()
    {
        return $this->hasOne(GrupoIntroductorio::className(), ['gint_id' => 'gint_id']);
    }
}
