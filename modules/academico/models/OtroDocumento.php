<?php

namespace app\modules\academico\models;

use Yii;

/**
 * This is the model class for table "otro_documento".
 *
 * @property int $odoc_id
 * @property int $per_id
 * @property int $dadj_id
 * @property string $odoc_archivo
 * @property string $odoc_observacion
 * @property int $odoc_usuario_ingreso
 * @property int $odoc_usuario_modifica
 * @property string $odoc_estado
 * @property string $odoc_fecha_creacion
 * @property string $odoc_fecha_modificacion
 * @property string $odoc_estado_logico
 */
class OtroDocumento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'otro_documento';
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
            [['per_id', 'dadj_id', 'odoc_archivo', 'odoc_estado', 'odoc_estado_logico'], 'required'],
            [['per_id', 'dadj_id', 'odoc_usuario_ingreso', 'odoc_usuario_modifica'], 'integer'],
            [['odoc_fecha_creacion', 'odoc_fecha_modificacion'], 'safe'],
            [['odoc_archivo', 'odoc_observacion'], 'string', 'max' => 500],
            [['odoc_estado', 'odoc_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'odoc_id' => 'Odoc ID',
            'per_id' => 'Per ID',
            'dadj_id' => 'Dadj ID',
            'odoc_archivo' => 'Odoc Archivo',
            'odoc_observacion' => 'Odoc Observacion',
            'odoc_usuario_ingreso' => 'Odoc Usuario Ingreso',
            'odoc_usuario_modifica' => 'Odoc Usuario Modifica',
            'odoc_estado' => 'Odoc Estado',
            'odoc_fecha_creacion' => 'Odoc Fecha Creacion',
            'odoc_fecha_modificacion' => 'Odoc Fecha Modificacion',
            'odoc_estado_logico' => 'Odoc Estado Logico',
        ];
    }
    
    public function insertar($con,$data)
    {                 
        $estado = '1';
        $sql = "INSERT INTO " . $con->dbname . ".otro_documento
            (per_id,dadj_id,odoc_archivo,odoc_observacion,odoc_usuario_ingreso,odoc_estado,odoc_estado_logico) VALUES
            (:per_id,:dadj_id,:odoc_archivo,:odoc_observacion,:odoc_usuario_ingreso,:odoc_estado,:odoc_estado_logico)";
        $command = $con->createCommand($sql);        
        $command->bindParam(":per_id",  $data['per_id'], \PDO::PARAM_INT);
        $command->bindParam(":dadj_id",  $data['dadj_id'], \PDO::PARAM_INT);
        $command->bindParam(":odoc_archivo",  $data['odoc_archivo'], \PDO::PARAM_STR);
        $command->bindParam(":odoc_observacion", $data['odoc_observacion'], \PDO::PARAM_STR);
        $command->bindParam(":odoc_usuario_ingreso", $data['odoc_usuario_ingreso'], \PDO::PARAM_INT);       
        $command->bindParam(":pext_estado", $estado, \PDO::PARAM_STR);      
        $command->execute();
        return $con->getLastInsertID();
    }
    
}
