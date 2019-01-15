<?php

namespace app\modules\marketing\models;

use yii\data\ArrayDataProvider;
use Yii;

/**
 * This is the model class for table "lista".
 *
 * @property int $lis_id
 * @property int $eaca_id
 * @property int $mest_id
 * @property string $lis_nombre
 * @property string $lis_descripcion
 * @property string $lis_estado
 * @property string $lis_fecha_creacion
 * @property string $lis_fecha_modificacion
 * @property string $lis_estado_logico
 *
 * @property ListaSuscriptor[] $listaSuscriptors
 * @property Programacion[] $programacions
 */
class Lista extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'lista';
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
            [['eaca_id', 'mest_id'], 'integer'],
            [['lis_nombre', 'lis_descripcion', 'lis_estado', 'lis_estado_logico'], 'required'],
            [['lis_fecha_creacion', 'lis_fecha_modificacion'], 'safe'],
            [['lis_nombre'], 'string', 'max' => 50],
            [['lis_descripcion'], 'string', 'max' => 500],
            [['lis_estado', 'lis_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'lis_id' => 'Lis ID',
            'eaca_id' => 'Eaca ID',
            'mest_id' => 'Mest ID',
            'lis_nombre' => 'Lis Nombre',
            'lis_descripcion' => 'Lis Descripcion',
            'lis_estado' => 'Lis Estado',
            'lis_fecha_creacion' => 'Lis Fecha Creacion',
            'lis_fecha_modificacion' => 'Lis Fecha Modificacion',
            'lis_estado_logico' => 'Lis Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getListaSuscriptors() {
        return $this->hasMany(ListaSuscriptor::className(), ['lis_id' => 'lis_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgramacions() {
        return $this->hasMany(Programacion::className(), ['lis_id' => 'lis_id']);
    }

    /**
     * Function consultarLista
     * @author  Kleber Loayza <analistadesarrollo03@uteg.edu.ec>
     * @param   
     * @return  Consulta una lista dada un Id.
     */
    public function consultarLista($lista_id) {
        $con = \Yii::$app->db_mailing;
        $estado = 1;
        $sql = "
                    SELECT
                        lst.lis_nombre,
                        count(lsu.sus_id) as num_suscr
                    FROM 
                        db_mailing.lista lst
                        left join lista_suscriptor as lsu on lsu.lis_id=lst.lis_id
                    WHERE
                        lst.lis_id=1
                        group by lst.lis_id
                ";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $resultData = $comando->queryOne();
        return $resultData;
    }

    /**
     * Function consulta listas creadas de mailchimp.
     * @author Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarListaProgramacion() {
        $con = \Yii::$app->db_mailing;
        $estado = 1;
        $sql = "SELECT 
                   lst.lis_id as id,
                   lst.lis_nombre as name
                FROM 
                   " . $con->dbname . ".lista  lst
                WHERE 
                      lst.lis_estado = :estado AND
                      lst.lis_estado_logico = :estado
                ORDER BY name asc  ";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $resultData = $comando->queryAll();
        return $resultData;
    }

    /**
     * Function inactivaLista
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  Inactiva las listas creadas en mailchimp.
     */
    public function inactivaLista($lis_id) {
        $con = \Yii::$app->db_mailing;
        $estado = 1;
        $fecha_modificacion = date(Yii::$app->params["dateTimeByDefault"]);

        try {
            $comando = $con->createCommand
                    (
                    "UPDATE " . $con->dbname . ".lista		       
                      SET 
                          lis_estado = '0',
                          lis_estado_logico = '0',
                          lis_fecha_modificacion = :fecha_modificacion
                      WHERE lis_id = :list_id AND                        
                            lis_estado = :estado AND
                            lis_estado_logico = :estado"
            );
            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
            $comando->bindParam(":fecha_modificacion", $fecha_modificacion, \PDO::PARAM_STR);
            $comando->bindParam(":list_id", $lis_id, \PDO::PARAM_INT);
            $response = $comando->execute();
            return $response;
        } catch (Exception $ex) {
            return FALSE;
        }
    }

    /**
     * Function inactivaListaSuscriptor
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  Inactiva la relación de lista y suscriptor creadas en mailchimp.
     */
    public function inactivaListaSuscriptor($lis_id) {
        $con = \Yii::$app->db_mailing;
        $estado = 1;
        $fecha_modificacion = date(Yii::$app->params["dateTimeByDefault"]);

        try {
            $comando = $con->createCommand
                    (
                    "UPDATE " . $con->dbname . ".lista_suscriptor		       
                      SET 
                          lsus_estado = '0',
                          lsus_estado_logico = '0',
                          lsus_fecha_modificacion = :fecha_modificacion
                      WHERE lsus_id = :list_id AND                        
                            lsus_estado = :estado AND
                            lsus_estado_logico = :estado"
            );
            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
            $comando->bindParam(":fecha_modificacion", $fecha_modificacion, \PDO::PARAM_STR);
            $comando->bindParam(":list_id", $lis_id, \PDO::PARAM_INT);
            $response = $comando->execute();
            return $response;
        } catch (Exception $ex) {
            return FALSE;
        }
    }

    /**
     * Function insertarProgramacion crea una programacion.
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @param
     * @return
     */
    public function insertarProgramacion($lis_id, $pla_id, $pro_fecha_desde, $pro_fecha_hasta, $pro_hora_envio, $pro_usuario_ingreso, $pro_fecha_creacion) {
        $con = \Yii::$app->db_mailing;
        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        $param_sql = "pro_estado";
        $bdet_sql = "1";

        $param_sql .= ", pro_estado_logico";
        $bdet_sql .= ", 1";

        if (isset($lis_id)) {
            $param_sql .= ", lis_id";
            $bdet_sql .= ", :lis_id";
        }
        if (isset($pla_id)) {
            $param_sql .= ", pla_id";
            $bdet_sql .= ", :pla_id";
        }
        if (isset($pro_fecha_desde)) {
            $param_sql .= ", pro_fecha_desde";
            $bdet_sql .= ", :pro_fecha_desde";
        }
        if (isset($pro_fecha_hasta)) {
            $param_sql .= ", pro_fecha_hasta";
            $bdet_sql .= ", :pro_fecha_hasta";
        }
        if (isset($pro_hora_envio)) {
            $hora_envio = date(Yii::$app->params["dateByDefault"]) . " " . $pro_hora_envio . ":00";
            $param_sql .= ", pro_hora_envio";
            $bdet_sql .= ", :pro_hora_envio";
        }
        if (isset($pro_usuario_ingreso)) {
            $param_sql .= ", pro_usuario_ingreso";
            $bdet_sql .= ", :pro_usuario_ingreso";
        }
        if (isset($pro_fecha_creacion)) {
            $param_sql .= ", pro_fecha_creacion";
            $bdet_sql .= ", :pro_fecha_creacion";
        }

        try {
            $sql = "INSERT INTO " . $con->dbname . ".programacion ($param_sql) VALUES($bdet_sql)";
            $comando = $con->createCommand($sql);

            if (isset($lis_id)) {
                $comando->bindParam(':lis_id', $lis_id, \PDO::PARAM_INT);
            }
            if (isset($pla_id)) {
                $comando->bindParam(':pla_id', $pla_id, \PDO::PARAM_INT);
            }
            if (isset($pro_fecha_desde)) {
                $comando->bindParam(':pro_fecha_desde', $pro_fecha_desde, \PDO::PARAM_STR);
            }
            if (!empty((isset($pro_fecha_hasta)))) {
                $comando->bindParam(':pro_fecha_hasta', $pro_fecha_hasta, \PDO::PARAM_STR);
            }
            if (!empty((isset($pro_hora_envio)))) {
                $comando->bindParam(':pro_hora_envio', $hora_envio, \PDO::PARAM_STR);
            }
            if (!empty((isset($pro_usuario_ingreso)))) {
                $comando->bindParam(':pro_usuario_ingreso', $pro_usuario_ingreso, \PDO::PARAM_STR);
            }
            if (!empty((isset($pro_fecha_creacion)))) {
                $comando->bindParam(':pro_fecha_creacion', $pro_fecha_creacion, \PDO::PARAM_STR);
            }

            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.programacion');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }

    /**
     * Function insertarDiaProgra crea dia atados a una programacion.
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @param
     * @return
     */
    public function insertarDiaProgra($pro_id, $dia_id, $dpro_fecha_creacion) {
        $con = \Yii::$app->db_mailing;
        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        $param_sql = "dpro_estado";
        $bdet_sql = "1";

        $param_sql .= ", dpro_estado_logico";
        $bdet_sql .= ", 1";

        if (isset($pro_id)) {
            $param_sql .= ", pro_id";
            $bdet_sql .= ", :pro_id";
        }
        if (isset($dia_id)) {
            $param_sql .= ", dia_id";
            $bdet_sql .= ", :dia_id";
        }
        if (isset($dpro_fecha_creacion)) {
            $param_sql .= ", dpro_fecha_creacion";
            $bdet_sql .= ", :dpro_fecha_creacion";
        }

        try {
            $sql = "INSERT INTO " . $con->dbname . ".dia_programacion ($param_sql) VALUES($bdet_sql)";
            $comando = $con->createCommand($sql);

            if (isset($pro_id)) {
                $comando->bindParam(':pro_id', $pro_id, \PDO::PARAM_INT);
            }
            if (isset($dia_id)) {
                $comando->bindParam(':dia_id', $dia_id, \PDO::PARAM_INT);
            }
            if (!empty((isset($dpro_fecha_creacion)))) {
                $comando->bindParam(':dpro_fecha_creacion', $dpro_fecha_creacion, \PDO::PARAM_STR);
            }

            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.dia_programacion');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }

    /**
     * Function consulta plantillas segun lista. 
     * @author Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarListaTemplate($list_id) {
        $con = \Yii::$app->db_mailing;
        $estado = 1;
        $sql = "SELECT 
                   pla.pla_id as id, 
                   pla.pla_nombre as name
                   
                FROM 
                   " . $con->dbname . ".lista_plantilla lpa 
                   INNER JOIN " . $con->dbname . ".plantilla  pla on pla.pla_id = lpa.pla_id ";
        $sql .= "  
                WHERE  
                   lpa.lis_id = :list_id AND  
                   lpa.lpla_estado = :estado AND
                   lpa.lpla_estado_logico = :estado
                ORDER BY name asc";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":list_id", $list_id, \PDO::PARAM_INT);   
        $resultData = $comando->queryOne();
        return $resultData;
    }
    
    /**
     * Function consulta si no se ha ingresado anteriormente una programacion a una lista y plantilla. 
     * @author Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarIngresoProgramacion($list_id, $pla_id) {
        $con = \Yii::$app->db_mailing;
        $estado = 1;
        $sql = "SELECT 
                   count(pro_id) as ingresado
                   
                FROM 
                   " . $con->dbname . ".programacion ";
        $sql .= "  
                WHERE  
                   lis_id = :list_id AND  
                   pla_id = :pla_id AND
                   pro_estado = :estado AND
                   pro_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":list_id", $list_id, \PDO::PARAM_INT);  
        $comando->bindParam(":pla_id", $pla_id, \PDO::PARAM_INT); 
        $resultData = $comando->queryOne();
        return $resultData;
    }

}
