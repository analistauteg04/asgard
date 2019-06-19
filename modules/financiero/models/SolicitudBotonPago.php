<?php

namespace app\modules\financiero\models;

use Yii;

/**
 * This is the model class for table "solicitud_boton_pago".
 *
 * @property int $sbpa_id
 * @property int $pben_id
 * @property string $sbpa_fecha_solicitud
 * @property string $sbpa_estado
 * @property string $sbpa_fecha_creacion
 * @property string $sbpa_fecha_modificacion
 * @property string $sbpa_estado_logico
 *
 * @property DetalleSolicitudBotonPago[] $detalleSolicitudBotonPagos
 * @property OrdenPago[] $ordenPagos
 * @property PersonaBeneficiaria $pben
 */
class SolicitudBotonPago extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'solicitud_boton_pago';
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
            [['pben_id'], 'integer'],
            [['sbpa_fecha_solicitud', 'sbpa_fecha_creacion', 'sbpa_fecha_modificacion'], 'safe'],
            [['sbpa_estado', 'sbpa_estado_logico'], 'required'],
            [['sbpa_estado', 'sbpa_estado_logico'], 'string', 'max' => 1],
            [['pben_id'], 'exist', 'skipOnError' => true, 'targetClass' => PersonaBeneficiaria::className(), 'targetAttribute' => ['pben_id' => 'pben_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sbpa_id' => 'Sbpa ID',
            'pben_id' => 'Pben ID',
            'sbpa_fecha_solicitud' => 'Sbpa Fecha Solicitud',
            'sbpa_estado' => 'Sbpa Estado',
            'sbpa_fecha_creacion' => 'Sbpa Fecha Creacion',
            'sbpa_fecha_modificacion' => 'Sbpa Fecha Modificacion',
            'sbpa_estado_logico' => 'Sbpa Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetalleSolicitudBotonPagos()
    {
        return $this->hasMany(DetalleSolicitudBotonPago::className(), ['sbpa_id' => 'sbpa_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdenPagos()
    {
        return $this->hasMany(OrdenPago::className(), ['sbpa_id' => 'sbpa_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPben()
    {
        return $this->hasOne(PersonaBeneficiaria::className(), ['pben_id' => 'pben_id']);
    }
    
    public function insertSolicitudBotonPago($con,$id_pben) {  
        $estado = 1;
        $fecha_solicitud = date(Yii::$app->params["dateTimeByDefault"]);
        $sql = "INSERT INTO " . $con->dbname . ".solicitud_boton_pago
            (pben_id, sbpa_fecha_solicitud, sbpa_estado, sbpa_estado_logico) VALUES
            (:id_pben,:fecha_solicitud,:sbpa_estado,:sbpa_estado)";
        
        $command = $con->createCommand($sql);        
        $command->bindParam(":id_pben", $id_pben, \PDO::PARAM_INT);
        $command->bindParam(":fecha_solicitud", $fecha_solicitud, \PDO::PARAM_STR);
        $command->bindParam(":sbpa_estado", $estado, \PDO::PARAM_STR);        
        $command->execute();
        return $con->getLastInsertID();        
    }
    public function consultarHistoralTransacciones(){
        
    }
}
