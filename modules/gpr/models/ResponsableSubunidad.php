<?php

namespace app\modules\gpr\models;

use app\models\Utilities;
use Yii;

/**
 * This is the model class for table "responsable_subunidad".
 *
 * @property int $rsub_id
 * @property int $sgpr_id
 * @property int $usu_id
 * @property int $emp_id
 * @property int $rsub_usuario_ingreso
 * @property int|null $rsub_usuario_modifica
 * @property string $rsub_estado
 * @property string $rsub_fecha_creacion
 * @property string|null $rsub_fecha_modificacion
 * @property string $rsub_estado_logico
 *
 * @property SubunidadGpr $sgpr
 */
class ResponsableSubunidad extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'responsable_subunidad';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_gpr');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sgpr_id', 'usu_id', 'emp_id', 'rsub_usuario_ingreso', 'rsub_estado', 'rsub_estado_logico'], 'required'],
            [['sgpr_id', 'usu_id', 'emp_id', 'rsub_usuario_ingreso', 'rsub_usuario_modifica'], 'integer'],
            [['rsub_fecha_creacion', 'rsub_fecha_modificacion'], 'safe'],
            [['rsub_estado', 'rsub_estado_logico'], 'string', 'max' => 1],
            [['sgpr_id'], 'exist', 'skipOnError' => true, 'targetClass' => SubunidadGpr::className(), 'targetAttribute' => ['sgpr_id' => 'sgpr_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rsub_id' => 'Rsub ID',
            'sgpr_id' => 'Sgpr ID',
            'usu_id' => 'Usu ID',
            'emp_id' => 'Emp ID',
            'rsub_usuario_ingreso' => 'Rsub Usuario Ingreso',
            'rsub_usuario_modifica' => 'Rsub Usuario Modifica',
            'rsub_estado' => 'Rsub Estado',
            'rsub_fecha_creacion' => 'Rsub Fecha Creacion',
            'rsub_fecha_modificacion' => 'Rsub Fecha Modificacion',
            'rsub_estado_logico' => 'Rsub Estado Logico',
        ];
    }

    /**
     * Gets query for [[Sgpr]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSgpr()
    {
        return $this->hasOne(SubunidadGpr::className(), ['sgpr_id' => 'sgpr_id']);
    }

    public static function deleteAllResponsablesByConf($id){
        $con = \Yii::$app->db_gpr;
        $iduser = Yii::$app->session->get('PB_iduser', FALSE);
        $datemod = date('Y-m-d H:i:s');
        try{
            $sql = "UPDATE responsable_subunidad p 
                SET p.rsub_estado_logico='0', p.rsub_estado='0', p.rsub_fecha_modificacion=:datemod, p.rsub_usuario_modifica=:iduser
                WHERE p.sgpr_id=:id AND p.rsub_estado_logico='1' AND p.rsub_estado='1';";

            $comando = $con->createCommand($sql);
            $comando->bindParam(':id' , $id, \PDO::PARAM_INT);
            $comando->bindParam(':iduser' , $iduser, \PDO::PARAM_INT);
            $comando->bindParam(':datemod' , $datemod, \PDO::PARAM_STR);
            $res = $comando->execute();
            if(isset($res)){
                return true;
            }else
                throw new \Exception('Error');
        }catch(\Exception $e){
            return false;
        }
    }
}
