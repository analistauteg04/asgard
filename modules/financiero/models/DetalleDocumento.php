<?php

namespace app\modules\financiero\models;

use Yii;

/**
 * This is the model class for table "detalle_documento".
 *
 * @property int $ddoc_id
 * @property int $doc_id
 * @property int $ite_id
 * @property int $ddoc_cantidad
 * @property double $ddoc_precio
 * @property double $ddoc_valor_iva
 * @property double $ddoc_valor_total
 * @property int $ddoc_usuario_transaccion
 * @property string $ddoc_estado
 * @property string $ddoc_fecha_creacion
 * @property string $ddoc_fecha_modificacion
 * @property string $ddoc_estado_logico
 *
 * @property Documento $doc
 * @property Item $ite
 */
class DetalleDocumento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detalle_documento';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_facturacion');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['doc_id', 'ite_id', 'ddoc_cantidad', 'ddoc_precio', 'ddoc_valor_iva', 'ddoc_valor_total', 'ddoc_usuario_transaccion'], 'required'],
            [['doc_id', 'ite_id', 'ddoc_cantidad', 'ddoc_usuario_transaccion'], 'integer'],
            [['ddoc_precio', 'ddoc_valor_iva', 'ddoc_valor_total'], 'number'],
            [['ddoc_fecha_creacion', 'ddoc_fecha_modificacion'], 'safe'],
            [['ddoc_estado', 'ddoc_estado_logico'], 'string', 'max' => 1],
            [['doc_id'], 'exist', 'skipOnError' => true, 'targetClass' => Documento::className(), 'targetAttribute' => ['doc_id' => 'doc_id']],
            [['ite_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['ite_id' => 'ite_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ddoc_id' => 'Ddoc ID',
            'doc_id' => 'Doc ID',
            'ite_id' => 'Ite ID',
            'ddoc_cantidad' => 'Ddoc Cantidad',
            'ddoc_precio' => 'Ddoc Precio',
            'ddoc_valor_iva' => 'Ddoc Valor Iva',
            'ddoc_valor_total' => 'Ddoc Valor Total',
            'ddoc_usuario_transaccion' => 'Ddoc Usuario Transaccion',
            'ddoc_estado' => 'Ddoc Estado',
            'ddoc_fecha_creacion' => 'Ddoc Fecha Creacion',
            'ddoc_fecha_modificacion' => 'Ddoc Fecha Modificacion',
            'ddoc_estado_logico' => 'Ddoc Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoc()
    {
        return $this->hasOne(Documento::className(), ['doc_id' => 'doc_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIte()
    {
        return $this->hasOne(Item::className(), ['ite_id' => 'ite_id']);
    }
}
