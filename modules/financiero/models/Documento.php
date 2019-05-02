<?php

namespace app\modules\financiero\models;

use Yii;

/**
 * This is the model class for table "documento".
 *
 * @property int $doc_id
 * @property int $tdoc_id
 * @property string $doc_nombres_cliente
 * @property string $doc_direccion
 * @property string $doc_telefono
 * @property string $doc_correo
 * @property double $doc_valor
 * @property int $doc_usuario_transaccion
 * @property string $doc_estado
 * @property string $doc_fecha_creacion
 * @property string $doc_fecha_modificacion
 * @property string $doc_estado_logico
 *
 * @property DetalleDocumento[] $detalleDocumentos
 */
class Documento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'documento';
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
            [['tdoc_id', 'doc_nombres_cliente', 'doc_valor', 'doc_usuario_transaccion'], 'required'],
            [['tdoc_id', 'doc_usuario_transaccion'], 'integer'],
            [['doc_valor'], 'number'],
            [['doc_fecha_creacion', 'doc_fecha_modificacion'], 'safe'],
            [['doc_nombres_cliente'], 'string', 'max' => 250],
            [['doc_direccion'], 'string', 'max' => 500],
            [['doc_telefono', 'doc_correo'], 'string', 'max' => 50],
            [['doc_estado', 'doc_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'doc_id' => 'Doc ID',
            'tdoc_id' => 'Tdoc ID',
            'doc_nombres_cliente' => 'Doc Nombres Cliente',
            'doc_direccion' => 'Doc Direccion',
            'doc_telefono' => 'Doc Telefono',
            'doc_correo' => 'Doc Correo',
            'doc_valor' => 'Doc Valor',
            'doc_usuario_transaccion' => 'Doc Usuario Transaccion',
            'doc_estado' => 'Doc Estado',
            'doc_fecha_creacion' => 'Doc Fecha Creacion',
            'doc_fecha_modificacion' => 'Doc Fecha Modificacion',
            'doc_estado_logico' => 'Doc Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetalleDocumentos()
    {
        return $this->hasMany(DetalleDocumento::className(), ['doc_id' => 'doc_id']);
    }
    
    public function insertDocumento($con,$idsbp) {  
        $estado = 1;        
        $sql = "INSERT INTO " . $con->dbname . ".solicitud_boton_pago
            (sbpa_id, ite_id, dsbp_cantidad, dsbp_precio, dsbp_valor_total, dsbp_estado, dsbp_estado_logico) VALUES
            (:idsbp,:ite_id,:cantidad,:dsbp_precio,:dsbp_valor_total:sbpa_estado,sbpa_estado)";
        
        $command = $con->createCommand($sql);        
        $command->bindParam(":idsbp", $idsbp, \PDO::PARAM_INT);
        $command->bindParam(":ite_id", $item_ids, \PDO::PARAM_INT);
        $command->bindParam(":cantidad", $cantidad, \PDO::PARAM_INT);
        $command->bindParam(":dsbp_precio", $item_precio, \PDO::PARAM_INT);
        $command->bindParam(":dsbp_valor_total", $total, \PDO::PARAM_INT);
        $command->bindParam(":dsbp_estado", $estado, \PDO::PARAM_STR);        
        $command->execute();
        return $con->getLastInsertID();        
    }
}
