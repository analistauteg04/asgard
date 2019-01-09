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
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  Listas creadas en mailchimp.
     */
    public function consultarLista($arrFiltro = array(), $onlyData = false) {
        $con = \Yii::$app->db_mailing;
        $con1 = \Yii::$app->db_academico;
        $estado = 1;
        
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            if ($arrFiltro['list_id'] != "" && $arrFiltro['list_id'] > 0) {
                $str_search = "l.list_id = :lista_id AND ";
            }
        }
            
        $sql = "SELECT l.lis_id, l.lis_nombre, 
                        case when l.eaca_id > 0 then 
                                     ea.eaca_nombre else me.mest_nombre end as programa,
                        sum(case when (ls.lsus_estado = '1' and ls.lsus_estado_logico = '1') then
                                     1 else 0 end) as num_suscriptores
                FROM " . $con->dbname . ".lista l left join " . $con->dbname . ".lista_suscriptor ls on ls.lis_id = l.lis_id
                  left join " . $con1->dbname . ".estudio_academico ea on ea.eaca_id = l.eaca_id
                  left join " . $con1->dbname . ".modulo_estudio me on me.mest_id = l.mest_id
                WHERE $str_search
                      lis_estado = :estado
                      and lis_estado_logico = :estado
                GROUP BY l.lis_id, l.lis_nombre, ea.eaca_nombre;";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            if ($arrFiltro['list_id'] != "" && $arrFiltro['list_id'] > 0) {
                $lista_id = $arrFiltro["lista_id"];
                $comando->bindParam(":lista_id", $lista_id, \PDO::PARAM_INT); 
            }
        }
        
        $resultData = $comando->queryAll();
        $dataProvider = new ArrayDataProvider([
            'key' => 'id',
            'allModels' => $resultData,
            'pagination' => [
                'pageSize' => Yii::$app->params["pageSize"],
            ],
            'sort' => [
                'attributes' => [
                    'lis_id',
                    'lis_nombre',
                    'num_suscriptores',
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
            $hora_envio = date(Yii::$app->params["dateByDefault"]). " " .$pro_hora_envio.":00";
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

}
