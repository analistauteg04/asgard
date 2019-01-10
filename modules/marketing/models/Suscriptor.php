<?php

namespace app\modules\marketing\models;

use yii\data\ArrayDataProvider;
use Yii;

/**
 * This is the model class for table "suscriptor".
 *
 * @property int $sus_id
 * @property int $per_id
 * @property int $pges_id
 * @property string $sus_nombres
 * @property string $sus_apellidos
 * @property string $sus_correo
 * @property string $sus_estado
 * @property string $sus_fecha_creacion
 * @property string $sus_fecha_modificacion
 * @property string $sus_estado_logico
 *
 * @property BitacoraEnvio[] $bitacoraEnvios
 * @property ListaSuscriptor[] $listaSuscriptors
 */
class Suscriptor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'suscriptor';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_mailing');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['per_id', 'pges_id'], 'integer'],
            [['sus_nombres', 'sus_apellidos', 'sus_correo', 'sus_estado', 'sus_estado_logico'], 'required'],
            [['sus_fecha_creacion', 'sus_fecha_modificacion'], 'safe'],
            [['sus_nombres', 'sus_apellidos'], 'string', 'max' => 100],
            [['sus_correo'], 'string', 'max' => 50],
            [['sus_estado', 'sus_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sus_id' => 'Sus ID',
            'per_id' => 'Per ID',
            'pges_id' => 'Pges ID',
            'sus_nombres' => 'Sus Nombres',
            'sus_apellidos' => 'Sus Apellidos',
            'sus_correo' => 'Sus Correo',
            'sus_estado' => 'Sus Estado',
            'sus_fecha_creacion' => 'Sus Fecha Creacion',
            'sus_fecha_modificacion' => 'Sus Fecha Modificacion',
            'sus_estado_logico' => 'Sus Estado Logico',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBitacoraEnvios()
    {
        return $this->hasMany(BitacoraEnvio::className(), ['sus_id' => 'sus_id']);
    }
    
    
    public function consultarSuscriptoresxLista($list_id) {
        $con = \Yii::$app->db_mailing;
        $estado = 1;
        $sql = "
               SELECT 
                    per.per_pri_nombre, per.per_pri_apellido, 
                    if(isnull(mest.mest_nombre),eaca.eaca_nombre,mest.mest_nombre) ,per.per_correo,
                    ifnull(sus.sus_id,0) as es_susbcriptor

                FROM 
                        db_mailing.lista lst
                        left join db_academico.estudio_academico as eaca on eaca.eaca_id= lst.eaca_id
                        left join db_academico.modulo_estudio as mest on mest.mest_id = lst.mest_id
                        left join db_captacion.solicitud_inscripcion as sins on sins.eaca_id = eaca.eaca_id or sins.mest_id = mest.mest_id
                        left join db_captacion.interesado as inte on inte.int_id = sins.int_id
                    left join db_asgard.persona as per on per.per_id = inte.per_id
                    left join db_mailing.suscriptor as sus on sus.per_id = per.per_id
                WHERE 
                        lst.lis_id=1 and
                        lst.lis_estado = 1 AND
                        lst.lis_estado_logico = 1
               ";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $resultData = $comando->queryAll();
        return $resultData;
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getListaSuscriptors()
    {
        return $this->hasMany(ListaSuscriptor::className(), ['sus_id' => 'sus_id']);
    }
}
