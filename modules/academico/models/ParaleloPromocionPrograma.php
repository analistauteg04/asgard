<?php

namespace app\modules\academico\models;

use Yii;

/**
 * This is the model class for table "paralelo_promocion_programa".
 *
 * @property int $pppr_id
 * @property int $ppro_id
 * @property int $pppr_cupo
 * @property int $pppr_cupo_actual
 * @property int $pppr_usuario_ingresa
 * @property string $pppr_estado
 * @property string $pppr_fecha_creacion
 * @property int $pppr_usuario_modifica
 * @property string $pppr_fecha_modificacion
 * @property string $pppr_estado_logico
 *
 * @property PromocionPrograma $ppro
 */
class ParaleloPromocionPrograma extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'paralelo_promocion_programa';
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
            [['ppro_id', 'pppr_cupo', 'pppr_estado', 'pppr_estado_logico'], 'required'],
            [['ppro_id', 'pppr_cupo', 'pppr_cupo_actual', 'pppr_usuario_ingresa', 'pppr_usuario_modifica'], 'integer'],
            [['pppr_fecha_creacion', 'pppr_fecha_modificacion'], 'safe'],
            [['pppr_estado', 'pppr_estado_logico'], 'string', 'max' => 1],
            [['ppro_id'], 'exist', 'skipOnError' => true, 'targetClass' => PromocionPrograma::className(), 'targetAttribute' => ['ppro_id' => 'ppro_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pppr_id' => 'Pppr ID',
            'ppro_id' => 'Ppro ID',
            'pppr_cupo' => 'Pppr Cupo',
            'pppr_cupo_actual' => 'Pppr Cupo Actual',
            'pppr_usuario_ingresa' => 'Pppr Usuario Ingresa',
            'pppr_estado' => 'Pppr Estado',
            'pppr_fecha_creacion' => 'Pppr Fecha Creacion',
            'pppr_usuario_modifica' => 'Pppr Usuario Modifica',
            'pppr_fecha_modificacion' => 'Pppr Fecha Modificacion',
            'pppr_estado_logico' => 'Pppr Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPpro()
    {
        return $this->hasOne(PromocionPrograma::className(), ['ppro_id' => 'ppro_id']);
    }
    
    /**
     * Function consulta los paralelos por programa. 
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarParalelosxPrograma($promo_id) {
        $con = \Yii::$app->db_academico;
        $estado = 1;
        $sql = "SELECT pppr_id id, pppr_descripcion name                 
                FROM 
                " . $con->dbname . ".paralelo_promocion_programa  ppp 
                WHERE ppro_id = :promo_id AND
                   pppr_estado = :estado AND
                   pppr_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":promo_id", $promo_id, \PDO::PARAM_INT);
        $resultData = $comando->queryAll();
        return $resultData;
    }
}
