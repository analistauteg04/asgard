<?php

namespace app\modules\gpr\models;

use Yii;

/**
 * This is the model class for table "responsable_administrativo".
 *
 * @property int $radm_id
 * @property int $uadm_id
 * @property int $usu_id
 * @property int $emp_id
 * @property int $radm_usuario_ingreso
 * @property int|null $radm_usuario_modifica
 * @property string $radm_estado
 * @property string $radm_fecha_creacion
 * @property string|null $radm_fecha_modificacion
 * @property string $radm_estado_logico
 *
 * @property UnidadAdministrativa $uadm
 */
class ResponsableAdministrativo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'responsable_administrativo';
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
            [['uadm_id', 'usu_id', 'emp_id', 'radm_usuario_ingreso', 'radm_estado', 'radm_estado_logico'], 'required'],
            [['uadm_id', 'usu_id', 'emp_id', 'radm_usuario_ingreso', 'radm_usuario_modifica'], 'integer'],
            [['radm_fecha_creacion', 'radm_fecha_modificacion'], 'safe'],
            [['radm_estado', 'radm_estado_logico'], 'string', 'max' => 1],
            [['uadm_id'], 'exist', 'skipOnError' => true, 'targetClass' => UnidadAdministrativa::className(), 'targetAttribute' => ['uadm_id' => 'uadm_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'radm_id' => 'Radm ID',
            'uadm_id' => 'Uadm ID',
            'usu_id' => 'Usu ID',
            'emp_id' => 'Emp ID',
            'radm_usuario_ingreso' => 'Radm Usuario Ingreso',
            'radm_usuario_modifica' => 'Radm Usuario Modifica',
            'radm_estado' => 'Radm Estado',
            'radm_fecha_creacion' => 'Radm Fecha Creacion',
            'radm_fecha_modificacion' => 'Radm Fecha Modificacion',
            'radm_estado_logico' => 'Radm Estado Logico',
        ];
    }

    /**
     * Gets query for [[Uadm]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUadm()
    {
        return $this->hasOne(UnidadAdministrativa::className(), ['uadm_id' => 'uadm_id']);
    }

    public static function deleteAllResponsablesByConf($id){
        $con = \Yii::$app->db_gpr;
        $iduser = Yii::$app->session->get('PB_iduser', FALSE);
        $datemod = date('Y-m-d H:i:s');
        try{
            $sql = "UPDATE responsable_administrativo p 
                SET p.radm_estado_logico='0', p.radm_estado='0', p.radm_fecha_modificacion=:datemod, p.radm_usuario_modifica=:iduser
                WHERE p.uadm_id=:id AND p.radm_estado_logico='1' AND p.radm_estado='1';";

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
