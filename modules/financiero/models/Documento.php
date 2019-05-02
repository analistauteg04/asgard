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
    
    public function insertDocumento($con,$tdoc_id,$nombres,$direccion,$telefono,$correo,$valor,$usuario) {  
        $estado = 1;        
        $sql = "INSERT INTO " . $con->dbname . ".solicitud_boton_pago
            (tdoc_id, doc_nombres_cliente, doc_direccion, doc_telefono, doc_correo, doc_valor, doc_usuario_transaccion,doc_estado,doc_estado_logico) VALUES
            (:tdoc_id,:doc_nombres_cliente,:doc_direccion,:doc_telefono,:doc_correo,:doc_valor,:doc_usuario_transaccion,:doc_estado,:doc_estado)";
                        
        $command = $con->createCommand($sql);        
        $command->bindParam(":tdoc_id", $tdoc_id, \PDO::PARAM_INT);
        $command->bindParam(":doc_nombres_cliente", $nombres, \PDO::PARAM_STR);
        $command->bindParam(":doc_direccion", $direccion, \PDO::PARAM_STR);
        $command->bindParam(":doc_telefono", $telefono, \PDO::PARAM_STR);
        $command->bindParam(":doc_correo", $correo, \PDO::PARAM_STR);
        $command->bindParam(":doc_valor", $valor, \PDO::PARAM_INT);        
        $command->bindParam(":doc_usuario_transaccion", $usuario, \PDO::PARAM_STR);    
        $command->bindParam(":doc_estado", $estado, \PDO::PARAM_STR);    
        $command->execute();
        return $con->getLastInsertID();        
    }
}
