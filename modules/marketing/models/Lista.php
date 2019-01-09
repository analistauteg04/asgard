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
    public function consultarLista() {
        $con = \Yii::$app->db_mailing;
        $con1 = \Yii::$app->db_academico;
        $estado = 1;
        $sql = "SELECT l.lis_id, l.lis_nombre, 
                        case when l.eaca_id > 0 then 
                                     ea.eaca_nombre else me.mest_nombre end as programa,
                        sum(case when (ls.lsus_estado = '1' and ls.lsus_estado_logico = '1') then
                                     1 else 0 end) as num_suscriptores
                FROM " . $con->dbname . ".lista l left join " . $con->dbname . ".lista_suscriptor ls on ls.lis_id = l.lis_id
                  left join " . $con1->dbname . ".estudio_academico ea on ea.eaca_id = l.eaca_id
                  left join " . $con1->dbname . ".modulo_estudio me on me.mest_id = l.mest_id
                WHERE lis_estado = :estado
                        and lis_estado_logico = :estado
                GROUP BY l.lis_id, l.lis_nombre, ea.eaca_nombre;";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);

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
        return $dataProvider;
        /* if ($onlyData) {
          return $resultData;
          } else {
          return $dataProvider;
          } */
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
     * Function insertarProgramacion crea una programacion.
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @param
     * @return
     */
    /*public function insertarProgramacion($lis_id, $pla_id, $fecinicio, $fecfin, $horenvio, $fecha_registro, $usuario) {
        $con = \Yii::$app->db_crm;
        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        $param_sql = "opo_estado";
        $bdet_sql = "1";

        $param_sql .= ", opo_estado_logico";
        $bdet_sql .= ", 1";

        if (isset($opo_codigo)) {
            $param_sql .= ", opo_codigo";
            $bdet_sql .= ", :opo_codigo";
        }
        if (isset($emp_id)) {
            $param_sql .= ", emp_id";
            $bdet_sql .= ", :emp_id";
        }
        if (isset($pges_id)) {
            $param_sql .= ", pges_id";
            $bdet_sql .= ", :pges_id";
        }
        if (isset($mest_id)) {
            $param_sql .= ", mest_id";
            $bdet_sql .= ", :mest_id";
        }
        if (isset($eaca_id)) {
            $param_sql .= ", eaca_id";
            $bdet_sql .= ", :eaca_id";
        }
        if (isset($uaca_id)) {
            $param_sql .= ", uaca_id";
            $bdet_sql .= ", :uaca_id";
        }
        if (isset($mod_id)) {
            $param_sql .= ", mod_id";
            $bdet_sql .= ", :mod_id";
        }
        if (isset($tove_id)) {
            $param_sql .= ", tove_id";
            $bdet_sql .= ", :tove_id";
        }
        if (isset($tsca_id)) {
            $param_sql .= ", tsca_id";
            $bdet_sql .= ", :tsca_id";
        }
        if (isset($ccan_id)) {
            $param_sql .= ", ccan_id";
            $bdet_sql .= ", :ccan_id";
        }
        if (isset($eopo_id)) {
            $param_sql .= ", eopo_id";
            $bdet_sql .= ", :eopo_id";
        }
        if (isset($opo_hora_ini_contacto)) {
            $param_sql .= ", opo_hora_ini_contacto";
            $bdet_sql .= ", :opo_hora_ini_contacto";
        }
        if (isset($opo_hora_fin_contacto)) {
            $param_sql .= ", opo_hora_fin_contacto";
            $bdet_sql .= ", :opo_hora_fin_contacto";
        }
        
        if (isset($opo_fecha_registro)) {
            $param_sql .= ", opo_fecha_registro";
            $bdet_sql .= ", :opo_fecha_registro";
        }
        if (isset($padm_id)) {
            $param_sql .= ", padm_id";
            $bdet_sql .= ", :padm_id";
        }
        if (isset($opo_usuario)) {
            $param_sql .= ", opo_usuario";
            $bdet_sql .= ", :opo_usuario";
        }

        try {
            $sql = "INSERT INTO " . $con->dbname . ".oportunidad ($param_sql) VALUES($bdet_sql)";
            $comando = $con->createCommand($sql);

            if (isset($opo_codigo)) {
                $comando->bindParam(':opo_codigo', $opo_codigo, \PDO::PARAM_STR);
            }
            if (isset($emp_id)) {
                $comando->bindParam(':emp_id', $emp_id, \PDO::PARAM_INT);
            }
            if (isset($pges_id)) {
                $comando->bindParam(':pges_id', $pges_id, \PDO::PARAM_INT);
            }
            if (!empty((isset($mest_id)))) {
                $comando->bindParam(':mest_id', $mest_id, \PDO::PARAM_INT);
            }
            if (!empty((isset($eaca_id)))) {
                $comando->bindParam(':eaca_id', $eaca_id, \PDO::PARAM_INT);
            }
            if (!empty((isset($uaca_id)))) {
                $comando->bindParam(':uaca_id', $uaca_id, \PDO::PARAM_INT);
            }
            if (!empty((isset($mod_id)))) {
                $comando->bindParam(':mod_id', $mod_id, \PDO::PARAM_INT);
            }
            if (!empty((isset($tove_id)))) {
                $comando->bindParam(':tove_id', $tove_id, \PDO::PARAM_INT);
            }
            if (!empty((isset($tsca_id)))) {
                $comando->bindParam(':tsca_id', $tsca_id, \PDO::PARAM_INT);
            }
            if (!empty((isset($ccan_id)))) {
                $comando->bindParam(':ccan_id', $ccan_id, \PDO::PARAM_INT);
            }
            if (!empty((isset($eopo_id)))) {
                $comando->bindParam(':eopo_id', $eopo_id, \PDO::PARAM_INT);
            }
             if (!empty((isset($opo_hora_ini_contacto)))) {
                $comando->bindParam(':opo_hora_ini_contacto', $opo_hora_ini_contacto, \PDO::PARAM_STR);
            }
            if (!empty((isset($opo_hora_fin_contacto)))) {
                $comando->bindParam(':opo_hora_fin_contacto', $opo_hora_fin_contacto, \PDO::PARAM_STR);
            }           
            if (!empty((isset($opo_fecha_registro)))) {
                $comando->bindParam(':opo_fecha_registro', $opo_fecha_registro, \PDO::PARAM_STR);
            }
            if (!empty((isset($padm_id)))) {
                $comando->bindParam(':padm_id', $padm_id, \PDO::PARAM_INT);
            }
            if (!empty((isset($opo_usuario)))) {
                $comando->bindParam(':opo_usuario', $opo_usuario, \PDO::PARAM_INT);
            }

            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.oportunidad');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }*/
}
