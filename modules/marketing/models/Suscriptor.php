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
 * @property string $sus_estado
 * @property string $sus_fecha_creacion
 * @property string $sus_fecha_modificacion
 * @property string $sus_estado_logico
 *
 * @property BitacoraEnvio[] $bitacoraEnvios
 * @property ListaSuscriptor[] $listaSuscriptors
 */
class Suscriptor extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'suscriptor';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb() {
        return Yii::$app->get('db_mailing');
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['per_id', 'pges_id'], 'integer'],
            [['sus_estado', 'sus_estado_logico'], 'required'],
            [['sus_fecha_creacion', 'sus_fecha_modificacion'], 'safe'],
            [['sus_estado', 'sus_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'sus_id' => 'Sus ID',
            'per_id' => 'Per ID',
            'pges_id' => 'Pges ID',
            'sus_estado' => 'Sus Estado',
            'sus_fecha_creacion' => 'Sus Fecha Creacion',
            'sus_fecha_modificacion' => 'Sus Fecha Modificacion',
            'sus_estado_logico' => 'Sus Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBitacoraEnvios() {
        return $this->hasMany(BitacoraEnvio::className(), ['sus_id' => 'sus_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getListaSuscriptors() {
        return $this->hasMany(ListaSuscriptor::className(), ['sus_id' => 'sus_id']);
    }

    public function insertarSuscritor($con, $parameters, $keys, $name_table) {
        $trans = $con->getTransaction();
        $param_sql .= "" . $keys[0];
        $bdet_sql .= "'" . $parameters[0] . "'";
        for ($i = 1; $i < count($parameters); $i++) {
            if (isset($parameters[$i])) {
                $param_sql .= ", " . $keys[$i];
                $bdet_sql .= ", '" . $parameters[$i] . "'";
            }
        }
        try {
            $sql = "INSERT INTO " . $con->dbname . '.' . $name_table . " ($param_sql) VALUES($bdet_sql);";
            $comando = $con->createCommand($sql);
            $result = $comando->execute();
            $idtable = $con->getLastInsertID($con->dbname . '.' . $name_table);
            if ($trans !== null)
                $trans->commit();
            return $idtable;
        } catch (Exception $ex) {
            if ($trans !== null) {
                $trans->rollback();
            }
            return 0;
        }
    }

    /**
     * Function consultarSuscriptoresxLista
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>
     * @author  Kleber Loayza <analistadesarrollo03@uteg.edu.ec>
     * @property integer $userid
     * @return  
     */
    public function consultarSuscriptoresxLista($list_id, $subscrito = 0, $onlyData = false) {
        $con = \Yii::$app->db_mailing;
        $estado = 1;
        $query_subscrito = ($subscrito == 1) ? "AND ifnull(sus.sus_id,0)>0" : (($subscrito == 2) ? "AND ifnull(sus.sus_id,0)<1" : "");
        $nosuscrito = " left join db_mailing.suscriptor as sus on sus.per_id = per.per_id or sus.pges_id=pges.pges_id  ";
        $suscrito = " join db_mailing.suscriptor as sus on sus.per_id = per.per_id or sus.pges_id=pges.pges_id";
        $join_subscrito = ($subscrito == 1) ? $suscrito : (($subscrito == 2) ? $nosuscrito : $nosuscrito);
        $sql = "
               SELECT 
                    lst.lis_id,
                    per.per_id,
                    if(ifnull(per.per_id,0)>0,1,2) per_tipo,
                    if(ifnull(per.per_id,0)>0,per.per_id,pges.pges_id) id_psus,
                    concat(per.per_pri_nombre,' ',per.per_pri_apellido) as contacto, 
                    if(isnull(mest.mest_nombre),eaca.eaca_nombre,mest.mest_nombre) carrera,
                    per.per_correo,
                    if(ifnull(sus.sus_id,0)>0 and sus.sus_estado =:estado,'Subscrito','No Subscrito') as estado,
                    acon.acon_id,
                    acon.acon_nombre
                FROM 
                    db_mailing.lista lst
                    left join db_academico.estudio_academico as eaca on eaca.eaca_id= lst.eaca_id                    
                    left join db_academico.modulo_estudio as mest on mest.mest_id = lst.mest_id
                    left join db_captacion.solicitud_inscripcion as sins on sins.eaca_id = eaca.eaca_id or sins.mest_id = mest.mest_id
                    left join db_crm.oportunidad as opo on opo.eaca_id=eaca.eaca_id or opo.mest_id=mest.mest_id and opo.eaca_id != sins.eaca_id and opo.mest_id!=sins.mest_id                    
                    left join db_captacion.interesado as inte on inte.int_id = sins.int_id                    
                    left join db_crm.persona_gestion as pges on pges.pges_id=opo.pges_id
                    left join db_asgard.persona as per on per.per_id = inte.per_id
                    $join_subscrito
                    left join db_academico.estudio_academico_area_conocimiento as eaac on eaac.eaca_id=eaca.eaca_id
                    left join db_academico.area_conocimiento as acon on acon.acon_id=eaac.acon_id
                WHERE 
                    lst.lis_id= :list_id and
                    lst.lis_estado = :estado AND
                    lst.lis_estado_logico = :estado
                    $query_subscrito
               ";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":list_id", $list_id, \PDO::PARAM_INT);
        $resultData = $comando->queryAll();
        $dataProvider = new ArrayDataProvider([
            'key' => 'id',
            'allModels' => $resultData,
            'pagination' => [
                'pageSize' => Yii::$app->params["pageSize"],
            ],
            'sort' => [
                'attributes' => [
                    'contacto',
                    'carrera',
                    'per_correo',
                    'estado',
                ],
            ],
        ]);
        if ($onlyData) {
            return $resultData;
        } else {
            return $dataProvider;
        }
    }

    /**
     * Function insertarListaSuscritor
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>
     * @property integer $userid
     * @return  
     */
    public function insertarListaSuscritor($con, $parameters, $keys, $name_table) {
        $trans = $con->getTransaction();
        $param_sql .= "" . $keys[0];
        $bdet_sql .= "'" . $parameters[0] . "'";
        for ($i = 1; $i < count($parameters); $i++) {
            if (isset($parameters[$i])) {
                $param_sql .= ", " . $keys[$i];
                $bdet_sql .= ", '" . $parameters[$i] . "'";
            }
        }
        try {
            $sql = "INSERT INTO " . $con->dbname . '.' . $name_table . " ($param_sql) VALUES($bdet_sql);";
            $comando = $con->createCommand($sql);
            $result = $comando->execute();
            $idtable = $con->getLastInsertID($con->dbname . '.' . $name_table);
            if ($trans !== null)
                $trans->commit();
            return $idtable;
        } catch (Exception $ex) {
            if ($trans !== null) {
                $trans->rollback();
            }
            return 0;
        }
    }

    /**
     * Function eliminarSuscriptor
     * @author  Gioavanni Vergara <analistadesarrollo02@uteg.edu.ec>
     * @property 
     * @return  
     */
    public function updateSuscripto($per_id, $lista_id, $estado_cambio) {
        $con = \Yii::$app->db_mailing;
        $estado = 1;
        $fecha_modificacion = date(Yii::$app->params["dateTimeByDefault"]);
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }
        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".suscriptor sus 
                      INNER JOIN " . $con->dbname . ".lista_suscriptor lsus 
                      ON sus.sus_id = lsus.sus_id  
                      SET sus.sus_estado = :estado_cambio, 
                          lsus.lsus_estado = :estado_cambio,
                          sus.sus_fecha_modificacion = :fecha_modificacion, 
                          lsus.lsus_fecha_modificacion = :fecha_modificacion
                      WHERE sus.per_id = :per_id AND
                            lsus.lis_id = :lista_id ");

            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
            $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
            $comando->bindParam(":lista_id", $lista_id, \PDO::PARAM_INT);
            $comando->bindParam(":estado_cambio", $estado_cambio, \PDO::PARAM_STR);
            $comando->bindParam(":fecha_modificacion", $fecha_modificacion, \PDO::PARAM_STR);
            $response = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $response;
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }

    /**
     * Function consultarSuscriptoxPerylis
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>
     * @param   
     * @return  
     */
    public function consultarSuscriptoxPerylis($per_id, $list_id) {
        $con = \Yii::$app->db_mailing;
        //$estado = 0;

        $sql = "select count(*) as inscantes	
                FROM " . $con->dbname . ".suscriptor sus 
                INNER JOIN " . $con->dbname . ".lista_suscriptor lsus     
                ON sus.sus_id = lsus.sus_id
                WHERE sus.per_id = :per_id AND
                lsus.lis_id = :list_id  ";

        $comando = $con->createCommand($sql);
        //$comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
        $comando->bindParam(":list_id", $list_id, \PDO::PARAM_INT);
        $resultData = $comando->queryOne();
        return $resultData;
    }

}
