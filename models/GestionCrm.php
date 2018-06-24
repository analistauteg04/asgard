<?php

namespace app\models;

use yii\data\ArrayDataProvider;
use Yii;

/**
 * This is the model class for table "gestion_crm".
 *
 * @property integer $gcrm_id
 * @property string $gcrm_codigo
 * @property integer $pcon_id
 * @property integer $pben_id
 * @property string $gcrm_estado_sierre
 * @property string $gcrm_fecha_estad_sierre
 * @property string $gcrm_estado
 * @property integer $gcrm_id_usuario
 * @property integer $gcrm_usuario_modif
 * @property string $gcrm_fecha_creacion
 * @property string $gcrm_fecha_modificacion
 * @property string $gcrm_estado_logico
 */
class GestionCrm extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'gestion_crm';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb() {
        return Yii::$app->get('db_crm');
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['pcon_id', 'pben_id', 'gcrm_estado_sierre', 'gcrm_estado', 'gcrm_estado_logico'], 'required'],
            [['pcon_id', 'pben_id', 'gcrm_id_usuario', 'gcrm_usuario_modif'], 'integer'],
            [['gcrm_fecha_estad_sierre', 'gcrm_fecha_creacion', 'gcrm_fecha_modificacion'], 'safe'],
            [['gcrm_codigo'], 'string', 'max' => 250],
            [['gcrm_estado_sierre', 'gcrm_estado', 'gcrm_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'gcrm_id' => 'Gcrm ID',
            'gcrm_codigo' => 'Gcrm Codigo',
            'pcon_id' => 'Pcon ID',
            'pben_id' => 'Pben ID',
            'gcrm_estado_sierre' => 'Gcrm Estado Sierre',
            'gcrm_fecha_estad_sierre' => 'Gcrm Fecha Estad Sierre',
            'gcrm_estado' => 'Gcrm Estado',
            'gcrm_id_usuario' => 'Gcrm Id Usuario',
            'gcrm_usuario_modif' => 'Gcrm Usuario Modif',
            'gcrm_fecha_creacion' => 'Gcrm Fecha Creacion',
            'gcrm_fecha_modificacion' => 'Gcrm Fecha Modificacion',
            'gcrm_estado_logico' => 'Gcrm Estado Logico',
        ];
    }

    /**
     * Function consulta los medios de conocimiento y canal. 
     * @author Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarConocimientoCanal($opcion) {
        $con = \Yii::$app->db_crm;
        $estado = 1;
        $sql = "SELECT 
                   ccan.ccan_id as id,
                   ccan.ccan_nombre as name
                FROM 
                   " . $con->dbname . ".conocimiento_canal  ccan ";
        $sql .= "  WHERE
                   ccan.ccan_conocimiento = :opcion or ccan.ccan_canal = :opcion AND
                   ccan.ccan_estado = :estado AND
                   ccan.ccan_estado_logico = :estado
                ORDER BY name asc";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":opcion", $opcion, \PDO::PARAM_STR);
        $resultData = $comando->queryAll();
        return $resultData;
    }

    /**
     * Function consulta los medios de conocimiento y canal. 
     * @author Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarEstadoGestion($limite, $cierre) {
        $con = \Yii::$app->db_crm;
        $filtro = '';
        $estado = 1;
        if ($cierre != 3) {
            $filtro .= "eges.eges_estado_sierre = :cierre AND";
        }
        $sql = "SELECT 
                   eges.eges_id as id,
                   eges.eges_nombre as name
                FROM 
                   " . $con->dbname . ".estado_gestion  eges ";
        $sql .= "  WHERE  ";

        $sql .= $filtro;
        $sql .= "  eges.eges_estado = :estado AND
                   eges.eges_estado_logico = :estado
                -- ORDER BY name asc 
                ";
        if ($limite > 0) {
            $sql .= "  LIMIT 0, :limite ";
        }
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":limite", $limite, \PDO::PARAM_INT);
        if ($cierre != 3) {
            $comando->bindParam(":cierre", $cierre, \PDO::PARAM_INT);
        }
        $resultData = $comando->queryAll();
        return $resultData;
    }

    /**
     * Function consulta los medios de conocimiento y canal. 
     * @author Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarOportunidadPerdida() {
        $con = \Yii::$app->db_crm;
        $estado = 1;
        $sql = "SELECT 
                   oper.oper_id as id,
                   oper.oper_nombre as name
                FROM 
                   " . $con->dbname . ".oportunidad_perdida  oper ";
        $sql .= "  WHERE                   
                   oper.oper_estado = :estado AND
                   oper.oper_estado_logico = :estado
                ORDER BY name asc";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $resultData = $comando->queryAll();
        return $resultData;
    }

    /**
     * Function consultar las gestiones. 
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param 
     * @return
     */
    public function consultarGestion($arrFiltro = array(), $resultado, $onlyData = false) {
        $con = \Yii::$app->db_crm;
        $con1 = \Yii::$app->db;
        $con2 = \Yii::$app->db_academico;
        $estado = 1;

        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            if ($arrFiltro['interesado'] != "") {
                $str_search = "(interesado like :interesado) AND ";
            }
            if ($arrFiltro['agente'] != "") {
                $str_search .= "(agente like :agente OR cod_agente like :agente) AND ";
            }
            if ($arrFiltro['f_atencion'] != "") {
                $str_search .= "(fecha_atencion >= :fec_atencion_ini and fecha_atencion <= :fec_atencion_fin) AND ";
            }
            if ($arrFiltro['estado'] > 0) {
                $str_search .= "estado = :estado_ate AND";
            }
        }

        $sql = "SELECT * FROM (
                 SELECT  concat(ifnull(pges_pri_apellido,''), ' ',ifnull(pges_seg_apellido,''), ' ', ifnull(pges_pri_nombre,''), ' ', ifnull(pges_seg_nombre,'')) as interesado,
                         gc.pben_id,
                         gc.gcrm_id,
                         pges_correo,
                         pges_celular,
                         
                         ifnull((select pai_nombre from " . $con1->dbname . ".pais p 
                          where p.pai_id = pg.pai_id_nacimiento
                                and p.pai_estado = :estado
                                and p.pai_estado_logico = :estado),'') as pais,
                         
			 (select concat(ifnull(per_pri_nombre,''), ' ', ifnull(per_pri_apellido,''))
                          from  " . $con->dbname . ".hist_seguimiento_contac hsc inner join " . $con->dbname . ".personal_admision pa on pa.padm_id = hsc.padm_id
                                inner join " . $con1->dbname . ".persona per on per.per_id = pa.per_id
                          where hsc.gcrm_id = gc.gcrm_id
                                and hsc.hsco_estado = :estado
                                and hsc.hsco_estado_logico = :estado
                                and pa.padm_estado = :estado
                                and pa.padm_estado_logico = :estado
                                and per.per_estado = :estado
                                and per.per_estado_logico = :estado				
                          order by hsco_id desc
                          limit 1) as agente,
                          
                          (select concat(padm_codigo,'-',m.mod_nombre) as codigo
                          from  " . $con->dbname . ".hist_seguimiento_contac hsc inner join " . $con->dbname . ".personal_admision pa on pa.padm_id = hsc.padm_id
                                inner join " . $con->dbname . ".personal_admision_cargo pac on pa.padm_id = pac.padm_id
                                inner join " . $con->dbname . ".personal_nivel_modalidad pnm on pnm.paca_id = pac.paca_id
                                inner join " . $con2->dbname . ".modalidad m on m.mod_id = pnm.mod_id
                          where hsc.gcrm_id = gc.gcrm_id
                                and hsc.hsco_estado = :estado
                                and hsc.hsco_estado_logico = :estado
                                and pa.padm_estado = :estado
                                and pa.padm_estado_logico = :estado
                                and pac.paca_estado = :estado
                                and pac.paca_estado_logico = :estado
                                and pnm.pnmo_estado = :estado
                                and pnm.pnmo_estado_logico = :estado
                                and m.mod_estado = :estado
                                and m.mod_estado_logico = :estado			
                          order by hsco_id desc
                          limit 1) as cod_agente,
                          
                          (select hsc.hsco_fecha_atenc
                           from " . $con->dbname . ".hist_seguimiento_contac hsc 
                           where  hsc.gcrm_id = gc.gcrm_id
                                  and hsc.hsco_estado = :estado
                                  and hsc.hsco_estado_logico = :estado							
                           order by hsco_id desc
                           limit 1) as fecha_atencion,
                           
                           (select ifnull(hsc.hsco_fecha_proxima, '')
                           from " . $con->dbname . ".hist_seguimiento_contac hsc 
                           where  hsc.gcrm_id = gc.gcrm_id
                                  and hsc.hsco_estado = :estado
                                  and hsc.hsco_estado_logico = :estado							
                           order by hsco_id desc
                           limit 1) as fecha_proxima_atencion,
                           
                          (select eg.eges_nombre
                           from " . $con->dbname . ".hist_seguimiento_contac hsc inner join " . $con->dbname . ".estado_gestion eg on eg.eges_id =  hsc.eges_id
                           where hsc.gcrm_id = gc.gcrm_id
                                 and hsc.hsco_estado = :estado
                                 and hsc.hsco_estado_logico = :estado
                                 and eg.eges_estado = :estado
                                 and eg.eges_estado_logico = :estado
                           order by hsco_id desc
                           limit 1) as estado_des,
                           
                          (select eg.eges_id
                           from " . $con->dbname . ".hist_seguimiento_contac hsc inner join " . $con->dbname . ".estado_gestion eg on eg.eges_id =  hsc.eges_id
                           where hsc.gcrm_id = gc.gcrm_id
                                 and hsc.hsco_estado = :estado
                                 and hsc.hsco_estado_logico = :estado
                                 and eg.eges_estado = :estado
                                 and eg.eges_estado_logico = :estado
                           order by hsco_id desc
                           limit 1) as estado
                FROM " . $con->dbname . ".gestion_crm gc inner join " . $con->dbname . ".persona_beneficiario pb on pb.pben_id = gc.pben_id
                         inner join " . $con->dbname . ".persona_gestion pg on pg.pges_id = pb.pges_id         
                WHERE 	gc.gcrm_estado = :estado
                        and gc.gcrm_estado_logico = :estado
                        and pb.pben_estado = :estado
                        and pb.pben_estado_logico = :estado
                        and pg.pges_estado = :estado
                        and pg.pges_estado_logico = :estado
                ORDER BY gc.gcrm_id desc) a ";

        If (!empty($str_search)) {
            $sql .= "WHERE $str_search "
                    . "gcrm_id = gcrm_id";
        }

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);

        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $search_cond = "%" . $arrFiltro["interesado"] . "%";
            $fecha_atencion_ini = $arrFiltro["f_atencion"] . " 00:00:00";
            $fecha_atencion_fin = $arrFiltro["f_atencion"] . " 23:59:59";
            $agente = "%" . $arrFiltro["agente"] . "%";
            $estado_ate = $arrFiltro["estado"];

            if ($arrFiltro['interesado'] != "") {
                $comando->bindParam(":interesado", $search_cond, \PDO::PARAM_STR);
            }
            if ($arrFiltro['agente'] != "") {
                $comando->bindParam(":agente", $agente, \PDO::PARAM_STR);
            }
            if ($arrFiltro['f_atencion'] != "") {
                $comando->bindParam(":fec_atencion_ini", $fecha_atencion_ini, \PDO::PARAM_STR);
                $comando->bindParam(":fec_atencion_fin", $fecha_atencion_fin, \PDO::PARAM_STR);
            }
            if ($arrFiltro['estado'] > 0) {
                $comando->bindParam(":estado_ate", $estado_ate, \PDO::PARAM_INT);
            }
        }
        $resultData = $comando->queryAll();

        if ($resultado == 1) {
            return $resultData;
        } else {
            $dataProvider = new ArrayDataProvider([
                'key' => 'id',
                'allModels' => $resultData,
                'pagination' => [
                    'pageSize' => Yii::$app->params["pageSize"],
                ],
                'sort' => [
                    'attributes' => [
                    ],
                ],
            ]);
            return $dataProvider;
        }
    }

    /**
     * Function insertarPersonaContratante grabar a personas contratantes.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function insertarPersonaContratante($pges_id, $pcon_observacion) {
        $con = \Yii::$app->db_crm;
        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        $param_sql = "pcon_estado";
        $bdet_sql = "1";

        $param_sql .= ", pcon_estado_logico";
        $bdet_sql .= ", 1";

        if (isset($pges_id)) {
            $param_sql .= ", pges_id";
            $bdet_sql .= ", :pges_id";
        }
        if (isset($pcon_observacion)) {
            $param_sql .= ", pcon_observacion";
            $bdet_sql .= ", :pcon_observacion";
        }

        try {
            $sql = "INSERT INTO " . $con->dbname . ".persona_contratante ($param_sql) VALUES($bdet_sql)";
            $comando = $con->createCommand($sql);

            if (isset($pges_id)) {
                $comando->bindParam(':pges_id', $pges_id, \PDO::PARAM_INT);
            }
            if (!empty((isset($pcon_observacion)))) {
                $comando->bindParam(':pcon_observacion', $pcon_observacion, \PDO::PARAM_STR);
            }

            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.persona_contratante');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }

    /**
     * Function insertarPersonaBeneficiaria grabar a personas contratantes.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function insertarPersonaBeneficiaria($pges_id, $pben_observacion) {
        $con = \Yii::$app->db_crm;
        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        $param_sql = "pben_estado";
        $bdet_sql = "1";

        $param_sql .= ", pben_estado_logico";
        $bdet_sql .= ", 1";

        if (isset($pges_id)) {
            $param_sql .= ", pges_id";
            $bdet_sql .= ", :pges_id";
        }
        if (isset($pben_observacion)) {
            $param_sql .= ", pben_observacion";
            $bdet_sql .= ", :pben_observacion";
        }

        try {
            $sql = "INSERT INTO " . $con->dbname . ".persona_beneficiario ($param_sql) VALUES($bdet_sql)";
            $comando = $con->createCommand($sql);

            if (isset($pges_id)) {
                $comando->bindParam(':pges_id', $pges_id, \PDO::PARAM_INT);
            }
            if (!empty((isset($pben_observacion)))) {
                $comando->bindParam(':pben_observacion', $pben_observacion, \PDO::PARAM_STR);
            }

            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.persona_beneficiario');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }

    /** Function consulta los agentes segun unidad academcica. 
     * @author Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarAgente($nivel, $modalidad, $agenteaun, $per_id) {
        $con = \Yii::$app->db_crm;
        $con1 = \Yii::$app->db_asgard;
        $estado = 1;
        $cargo = 3;
        $sql = "SELECT 
                   pa.padm_id as id,
                   CONCAT (per.per_pri_nombre, ' ', per.per_pri_apellido) as name
                FROM 
                   " . $con->dbname . ".personal_nivel_modalidad psm "
                . "INNER JOIN " . $con->dbname . ".personal_admision_cargo pac ON pac.paca_id = psm.paca_id "
                . "INNER JOIN " . $con->dbname . ".personal_admision pa ON pa.padm_id = pac.padm_id "
                . "INNER JOIN " . $con1->dbname . ".persona per ON per.per_id = pa.per_id ";
        $sql .= "  WHERE ";

        if ($agenteaun == 1 || $agenteaun == 2 || $per_id == 1) {
            $sql .= "  psm.nint_id = :nivel AND
                   psm.mod_id = :modalidad AND
                   -- pac.car_id = :cargo AND ";
        }
        $sql .= "  pnmo_estado = :estado AND 
                   pnmo_estado_logico = :estado AND 
                   paca_estado = :estado AND 
                   paca_estado_logico = :estado AND 
                   padm_estado = :estado AND 
                   padm_estado_logico = :estado AND
                   per_estado = :estado AND 
                   per_estado_logico = :estado
                ORDER BY name asc";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":nivel", $nivel, \PDO::PARAM_INT);
        $comando->bindParam(":modalidad", $modalidad, \PDO::PARAM_INT);
        $comando->bindParam(":cargo", $cargo, \PDO::PARAM_INT);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
        $resultData = $comando->queryAll();
        return $resultData;
    }

    /** Function consulta los agentes segun unidad academica. 
     * @author Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarTipoCarrera() {
        $con = \Yii::$app->db_crm;
        $estado = 1;
        $sql = "SELECT 
                   tcar.tcar_id as id,
                   tcar.tcar_nombre as name
                FROM 
                   " . $con->dbname . ".tipo_carrera tcar 
                WHERE 
                   tcar.tcar_estado = :estado AND 
                   tcar.tcar_estado_logico = :estado 
                ORDER BY name asc";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $resultData = $comando->queryAll();
        return $resultData;
    }

    /** Function consulta las subcarreras segun su carrera. 
     * @author Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarSubCarrera($tcar_id) {
        $con = \Yii::$app->db_crm;
        $estado = 1;
        $sql = "SELECT 
                   tscar.tsca_id as id,
                   tscar.tsca_nombre as name
                FROM 
                   " . $con->dbname . ".tipo_sub_carrera tscar 
                WHERE 
                   tscar.tcar_id = :tcar_id AND
                   tscar.tsca_estado = :estado AND 
                   tscar.tsca_estado_logico = :estado 
                ORDER BY name asc";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":tcar_id", $tcar_id, \PDO::PARAM_INT);
        $resultData = $comando->queryAll();
        return $resultData;
    }

    /**
     * Function obtener carreras segun unidad academica y modalidad
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @property       
     * @return  
     */
    public function consultarCarreraModalidad($unidad, $modalidad) {

        $con = \Yii::$app->db_academico;
        $estado = 1;

        $sql = "SELECT 
          car.car_id as id,
          car.car_nombre as name
          FROM
          " . $con->dbname . ".modalidad_carrera_nivel as mcn
          INNER JOIN db_academico.carrera as car on car.car_id = mcn.car_id
          WHERE 
          mcn.nint_id =:unidad AND
          mcn.mod_id =:modalidad AND          
          car.car_estado_logico=:estado AND
          car.car_estado=:estado AND
          mcn.mcni_estado_logico = :estado AND
          mcn.mcni_estado = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":unidad", $unidad, \PDO::PARAM_INT);
        $comando->bindParam(":modalidad", $modalidad, \PDO::PARAM_INT);
        $resultData = $comando->queryAll();
        return $resultData;
    }

    /**
     * Function insertarPersonaContratante grabar a personas contratantes.
     * @author Jefferson Conde <analistadesarrollo03@uteg.edu.ec>;
     * @param
     * @return
     */
    public function insertarGestionCrm($gcrm_codigo, $pcon_id, $pben_id, $gcrm_estado_sierre, $gcrm_id_usuario) {
        $con = \Yii::$app->db_crm;
        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        $param_sql = "gcrm_estado";
        $bdet_sql = "1";

        $param_sql .= ", gcrm_estado_logico";
        $bdet_sql .= ", 1";

        if (isset($gcrm_codigo)) {
            $param_sql .= ", gcrm_codigo";
            $bdet_sql .= ", :gcrm_codigo";
        }
        if (isset($pcon_id)) {
            $param_sql .= ", pcon_id";
            $bdet_sql .= ", :pcon_id";
        }
        if (isset($pben_id)) {
            $param_sql .= ", pben_id";
            $bdet_sql .= ", :pben_id";
        }

        if (isset($gcrm_estado_sierre)) {
            $param_sql .= ", gcrm_estado_sierre";
            $bdet_sql .= ", :gcrm_estado_sierre";
        }

        if (isset($gcrm_id_usuario)) {
            $param_sql .= ", gcrm_id_usuario";
            $bdet_sql .= ", :gcrm_id_usuario";
        }

        try {
            $sql = "INSERT INTO " . $con->dbname . ".gestion_crm ($param_sql) VALUES($bdet_sql)";
            $comando = $con->createCommand($sql);

            if (isset($gcrm_codigo)) {
                $comando->bindParam(':gcrm_codigo', $gcrm_codigo, \PDO::PARAM_INT);
            }
            if (!empty((isset($pcon_id)))) {
                $comando->bindParam(':pcon_id', $pcon_id, \PDO::PARAM_INT);
            }
            if (!empty((isset($pben_id)))) {
                $comando->bindParam(':pben_id', $pben_id, \PDO::PARAM_INT);
            }
            if (!empty((isset($gcrm_estado_sierre)))) {
                $comando->bindParam(':gcrm_estado_sierre', $gcrm_estado_sierre, \PDO::PARAM_INT);
            }
            if (!empty((isset($gcrm_id_usuario)))) {
                $comando->bindParam(':gcrm_id_usuario', $gcrm_id_usuario, \PDO::PARAM_INT);
            }

            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.gestion_crm');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }

    /**
     * Function insertarPersonaContratante grabar a personas contratantes.
     * @author Jefferson Conde <analistadesarrollo03@uteg.edu.ec>;
     * @param
     * @return
     */
    public function insertarHistSeguimientoCrm($gcrm_id, $padm_id, $iccr_id, $tccr_id, $hsco_fecha_recepcion, $hsco_fecha_atenc, $eges_id, $hsco_fecha_proxima, $oper_id, $hsco_observacion, $tsca_id, $ccan_id, $mcon_id) {
        $con = \Yii::$app->db_crm;
        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        $param_sql = "hsco_estado";
        $bdet_sql = "1";

        $param_sql .= ", hsco_estado_logico";
        $bdet_sql .= ", 1";

        if (isset($gcrm_id)) {
            $param_sql .= ", gcrm_id";
            $bdet_sql .= ", :gcrm_id";
        }
        if (isset($padm_id)) {
            $param_sql .= ", padm_id";
            $bdet_sql .= ", :padm_id";
        }
        if (isset($iccr_id)) {
            $param_sql .= ", iccr_id";
            $bdet_sql .= ", :iccr_id";
        }
        if (isset($tccr_id)) {
            $param_sql .= ", tccr_id";
            $bdet_sql .= ", :tccr_id";
        }
        if (isset($hsco_fecha_recepcion)) {
            $param_sql .= ", hsco_fecha_recepcion";
            $bdet_sql .= ", :hsco_fecha_recepcion";
        }
        if (isset($hsco_fecha_atenc)) {
            $param_sql .= ", hsco_fecha_atenc";
            $bdet_sql .= ", :hsco_fecha_atenc";
        }
        if (isset($eges_id)) {
            $param_sql .= ", eges_id";
            $bdet_sql .= ", :eges_id";
        }
        if (isset($hsco_fecha_proxima)) {
            $param_sql .= ", hsco_fecha_proxima";
            $bdet_sql .= ", :hsco_fecha_proxima";
        }
        if (isset($oper_id)) {
            $param_sql .= ", oper_id";
            $bdet_sql .= ", :oper_id";
        }
        if (isset($hsco_observacion)) {
            $param_sql .= ", hsco_observacion";
            $bdet_sql .= ", :hsco_observacion";
        }
        if (isset($tsca_id)) {
            $param_sql .= ", tsca_id";
            $bdet_sql .= ", :tsca_id";
        }
        if (isset($ccan_id)) {
            $param_sql .= ", ccan_id";
            $bdet_sql .= ", :ccan_id";
        }
        if (isset($mcon_id)) {
            $param_sql .= ", mcon_id";
            $bdet_sql .= ", :mcon_id";
        }
        try {
            $sql = "INSERT INTO " . $con->dbname . ".hist_seguimiento_contac ($param_sql) VALUES($bdet_sql)";
            $comando = $con->createCommand($sql);

            if (isset($gcrm_id)) {
                $comando->bindParam(':gcrm_id', $gcrm_id, \PDO::PARAM_INT);
            }
            if (!empty((isset($padm_id)))) {
                $comando->bindParam(':padm_id', $padm_id, \PDO::PARAM_INT);
            }
            if (!empty((isset($iccr_id)))) {
                $comando->bindParam(':iccr_id', $iccr_id, \PDO::PARAM_INT);
            }
            if (!empty((isset($tccr_id)))) {
                $comando->bindParam(':tccr_id', $tccr_id, \PDO::PARAM_INT);
            }
            if (!empty((isset($hsco_fecha_recepcion)))) {
                $comando->bindParam(':hsco_fecha_recepcion', $hsco_fecha_recepcion, \PDO::PARAM_STR);
            }
            if (!empty((isset($hsco_fecha_atenc)))) {
                $comando->bindParam(':hsco_fecha_atenc', $hsco_fecha_atenc, \PDO::PARAM_STR);
            }
            if (!empty((isset($eges_id)))) {
                $comando->bindParam(':eges_id', $eges_id, \PDO::PARAM_INT);
            }
            if (!empty((isset($hsco_fecha_proxima)))) {
                $comando->bindParam(':hsco_fecha_proxima', $hsco_fecha_proxima, \PDO::PARAM_STR);
            }
            if (!empty((isset($oper_id)))) {
                $comando->bindParam(':oper_id', $oper_id, \PDO::PARAM_INT);
            }
            if (!empty((isset($hsco_observacion)))) {
                $comando->bindParam(':hsco_observacion', $hsco_observacion, \PDO::PARAM_STR);
            }
            if (!empty((isset($tsca_id)))) {
                $comando->bindParam(':tsca_id', $tsca_id, \PDO::PARAM_INT);
            }
            if (!empty((isset($ccan_id)))) {
                $comando->bindParam(':ccan_id', $ccan_id, \PDO::PARAM_INT);
            }
            if (!empty((isset($mcon_id)))) {
                $comando->bindParam(':mcon_id', $mcon_id, \PDO::PARAM_INT);
            }
            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.hist_seguimiento_contac');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }

    /**
     * Function insertarPersonaBeneficiaria grabar a personas contratantes.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function insertarInforCurricularCrm($gcrm_id, $car_id, $nint_id, $mod_id) {
        $con = \Yii::$app->db_crm;
        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        $param_sql = "iccr_estado";
        $bdet_sql = "1";

        $param_sql .= ", iccr_estado_logico";
        $bdet_sql .= ", 1";

        if (isset($gcrm_id)) {
            $param_sql .= ", gcrm_id";
            $bdet_sql .= ", :gcrm_id";
        }
        if (isset($car_id)) {
            $param_sql .= ", car_id";
            $bdet_sql .= ", :car_id";
        }
        if (isset($nint_id)) {
            $param_sql .= ", nint_id";
            $bdet_sql .= ", :nint_id";
        }
        if (isset($mod_id)) {
            $param_sql .= ", mod_id";
            $bdet_sql .= ", :mod_id";
        }

        try {
            $sql = "INSERT INTO " . $con->dbname . ".info_curricular_crm ($param_sql) VALUES($bdet_sql)";
            $comando = $con->createCommand($sql);

            if (isset($gcrm_id)) {
                $comando->bindParam(':gcrm_id', $gcrm_id, \PDO::PARAM_INT);
            }
            if (!empty((isset($car_id)))) {
                $comando->bindParam(':car_id', $car_id, \PDO::PARAM_STR);
            }
            if (!empty((isset($nint_id)))) {
                $comando->bindParam(':nint_id', $nint_id, \PDO::PARAM_STR);
            }
            if (!empty((isset($mod_id)))) {
                $comando->bindParam(':mod_id', $mod_id, \PDO::PARAM_STR);
            }

            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.info_curricular_crm');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }

    /**
     * Function consultarGestionHistorial consultar historial de las gestiones por Id. 
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param 
     * @return
     */
    public function consultarGestionHistorial($gcrm_id) {
        $con = \Yii::$app->db_crm;
        $con1 = \Yii::$app->db;
        $estado = 1;

        $sql = " SELECT hsco_id, pb.pben_id,
                        concat(ifnull(pges_pri_apellido,''), ' ',ifnull(pges_seg_apellido,''), ' ', ifnull(pges_pri_nombre,''), ' ', ifnull(pges_seg_nombre,'')) as interesado,	   
                        concat(ifnull(per_pri_nombre,''), ' ', ifnull(per_pri_apellido,'')) as agente,
                        hsco_fecha_atenc as fecha_atencion,
                        ifnull(hsco_fecha_proxima, '') as proxima_atencion,
                        eg.eges_nombre as estado,
                        hsc.padm_id agente_id
                 FROM " . $con->dbname . ".gestion_crm gc inner join " . $con->dbname . ".persona_beneficiario pb on pb.pben_id = gc.pben_id
                         inner join " . $con->dbname . ".persona_gestion pg on pg.pges_id = pb.pges_id
                         inner join " . $con->dbname . ".hist_seguimiento_contac hsc on gc.gcrm_id = hsc.gcrm_id
                         inner join " . $con->dbname . ".personal_admision pa on pa.padm_id = hsc.padm_id
                         inner join " . $con1->dbname . ".persona per on per.per_id = pa.per_id
                         inner join " . $con->dbname . ".estado_gestion eg on eg.eges_id =  hsc.eges_id
                 WHERE 	gc.gcrm_id = :gcrm_id
                        and gc.gcrm_estado = :estado
                        and gc.gcrm_estado_logico = :estado
                        and pb.pben_estado = :estado
                        and pb.pben_estado_logico = :estado
                        and pg.pges_estado = :estado
                        and pg.pges_estado_logico = :estado
                        and hsc.hsco_estado = :estado
                        and hsc.hsco_estado_logico = :estado
                        and pa.padm_estado = :estado
                        and pa.padm_estado_logico = :estado
                        and per.per_estado = :estado
                        and per.per_estado_logico = :estado
                        and eg.eges_estado = :estado
                        and eg.eges_estado_logico = :estado
                ORDER BY hsc.hsco_id desc";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":gcrm_id", $gcrm_id, \PDO::PARAM_INT);
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
     * Function consulta segun id de gestion en hist_seguimiento_contac. 
     * @author Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarGestionBeneficiario($gestion) {
        $con = \Yii::$app->db_crm;
        $estado = 1;
        $sql = "SELECT                    
                    iccr_id,
                    tsca_id,
                    ccan_id,
                    mcon_id
                FROM 
                   " . $con->dbname . ".hist_seguimiento_contac ";
        $sql .= "  WHERE  
                   gcrm_id = :gcrm_id AND
                   hsco_estado = :estado AND
                   hsco_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":gcrm_id", $gestion, \PDO::PARAM_INT);
        $resultData = $comando->queryOne();
        return $resultData;
    }

    /**
     * Function consulta id de agente autenticado segun per_id. 
     * @author Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarAgenteAutenticado($per_id) {
        $con = \Yii::$app->db_crm;
        $estado = 1;
        $sql = "SELECT                    
                    padm_id
                    
                FROM 
                   " . $con->dbname . ".personal_admision ";
        $sql .= "  WHERE  
                   per_id = :per_id AND
                   padm_estado = :estado AND
                   padm_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
        $resultData = $comando->queryOne();
        return $resultData;
    }

    /**
     * Function consulta id de agente autenticado segun per_id. 
     * @author Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarCargoAgente($padm_id) {
        $con = \Yii::$app->db_crm;
        $estado = 1;
        $sql = "SELECT
                    padm_id,
                    car_id
                    
                FROM 
                   " . $con->dbname . ".personal_admision_cargo ";
        $sql .= "  WHERE  
                   padm_id = :padm_id AND
                   paca_estado = :estado AND
                   paca_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":padm_id", $padm_id, \PDO::PARAM_INT);
        $resultData = $comando->queryOne();
        return $resultData;
    }

    /**
     * Function consulta el ultimo codigo de gestion generado. 
     * @author Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarUltimoCodcrm() {
        $con = \Yii::$app->db_crm;
        $estado = 1;
        $sql = "SELECT MAX(gcrm_codigo) AS id                     
                FROM 
                   " . $con->dbname . ".gestion_crm ";
        $sql .= "  WHERE                     
                   gcrm_estado = :estado AND
                   gcrm_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
        $resultData = $comando->queryOne();
        return $resultData;
    }

    /**
     * Function consulta los datos generales del benificiario. 
     * @author Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarDatosBeni($gcrm_id) {
        $con = \Yii::$app->db_crm;
        $estado = 1;
        $sql = "SELECT 
                    pges.pges_id,
                    pges_pri_nombre,
                    pges_seg_nombre,
                    pges_pri_apellido,
                    pges_seg_apellido,
                    pges.pai_id_nacimiento,
                    pges.pges_celular,
                    pges.pges_correo,
                    pges.pges_domicilio_telefono,
                    pges.pges_domicilio_celular2                     
                FROM 
                   " . $con->dbname . ".gestion_crm gcrm
                       INNER JOIN persona_beneficiario pben on pben.pben_id = gcrm.pben_id
                       INNER JOIN persona_gestion pges on pges.pges_id = pben.pges_id
                WHERE                     
                   gcrm_id = :gcrm_id AND
                   gcrm.gcrm_estado_logico = :estado AND
                   gcrm.gcrm_estado = :estado AND
                   pges.pges_estado_logico = :estado AND
                   pges.pges_estado = :estado AND
                   pben.pben_estado_logico AND
                   pben.pben_estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":gcrm_id", $gcrm_id, \PDO::PARAM_INT);
        $resultData = $comando->queryOne();
        return $resultData;
    }

    /**
     * Function consulta el ultimo codigo de gestion generado. 
     * @author Jefferson Conde <analistadesarrollo033@uteg.edu.ec>;
     * @param
     * @return
     */
    public function DatosPersonGestion($gcrm_id, $valor) {
        $con = \Yii::$app->db_crm;
        $estado = 1;
        $str_search = "";

        if ($valor == 0) {

            $str_search .= "Join " . $con->dbname . ".persona_beneficiario pb 
                          ON pg.pges_id = pb.pges_id 
                          where pb.pben_id = :gcrm_id
                          and pb.pben_estado = :estado
                          and pb.pben_estado_logico= :estado ";
        }
        if ($valor == 1) {
            $str_search .= "Join " . $con->dbname . ".persona_contratante pc 
                             ON pg.pges_id = pc.pges_id
                          where pc.pcon_id = :gcrm_id
                            and pc.pcon_estado = :estado
                            and pc.pcon_estado_logico = :estado ";
        }

        $sql = "SELECT pg.pges_pri_nombre AS primer_nombre, 
                       pg.pges_seg_nombre AS segundo_nombre,
                       pg.pges_pri_apellido AS primer_apellido,
                       pg.pges_seg_apellido AS segundo_apellido,
                       pg.pai_id_nacimiento AS pai_id_nacimiento,
                       pg.pro_id_nacimiento AS pro_id_nacimiento,
                       pg.can_id_nacimiento AS can_id_nacimiento,
                       pg.pges_celular AS celular,
                       pg.pges_domicilio_telefono AS pges_domicilio_telefono,
                       pg.pges_domicilio_celular2 AS pges_domicilio_celular2,
                       pg.pges_correo AS correo
                FROM 
                   " . $con->dbname . ". persona_gestion pg  ";
        $sql .= $str_search; /* "  WHERE    gcrm_id = :gcrm_id AND           
          gcrm_estado = :estado AND
          gcrm_estado_logico = :estado"; */

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":gcrm_id", $gcrm_id, \PDO::PARAM_INT);
        $resultData = $comando->queryOne();
        return $resultData;
    }

    /**
     * Function consulta la última gestión generada. 
     * @author Jefferson Conde <analistadesarrollo03@uteg.edu.ec>;  
     *         Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function ConsultarDatosGestion($hsco_id) {
        $con = \Yii::$app->db_crm;
        $estado = 1;
        $sql = "SELECT  h.hsco_fecha_recepcion, 
                        h.hsco_fecha_atenc,
                        h.hsco_fecha_proxima,
                        h.oper_id,
                        h.hsco_observacion,
                        h.eges_id,
                        h.ccan_id,
                        h.iccr_id,
                        h.tsca_id,
                        h.mcon_id, 
                        g.pben_id, 
                        g.pcon_id,
                        i.mod_id,
                        i.nint_id,
                        i.car_id,
                        h.tccr_id,
                        (case when h.tsca_id>0 then 
                                (select tcar_id from tipo_sub_carrera tsc 
                                where tsc.tsca_id = h.tsca_id 
                                      and tsc.tsca_estado = :estado 
                                      and tsc.tsca_estado_logico = :estado) else 0 end) as tipo_carrera
                FROM " . $con->dbname . ".hist_seguimiento_contac h INNER JOIN " . $con->dbname . ".gestion_crm g                    
                    ON g.gcrm_id = h.gcrm_id
                    INNER JOIN " . $con->dbname . ".info_curricular_crm i on i.iccr_id = h.iccr_id
                WHERE hsco_id = :hsco_id
                      AND hsco_estado = :estado
                      AND hsco_estado_logico = :estado
                      AND gcrm_estado = :estado
                      AND gcrm_estado_logico = :estado
                      AND iccr_estado = :estado
                      AND iccr_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":hsco_id", $hsco_id, \PDO::PARAM_INT);
        $resultData = $comando->queryOne();
        return $resultData;
    }

    /**
     * Function consultarGestiontodas consulta todas las gestiones. 
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param 
     * @return
     */
    public function consultarGestiontodas($arrFiltro = array()) {
        $con = \Yii::$app->db_crm;
        $con1 = \Yii::$app->db;
        $con2 = \Yii::$app->db_academico;
        $estado = 1;

        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            if ($arrFiltro['interesado'] != "") {
                $str_search = "(interesado like :interesado) AND ";
            }
            if ($arrFiltro['agente'] != "") {
                $str_search .= "(agente like :agente OR cod_agente like :agente) AND ";
            }
            if ($arrFiltro['f_atencion'] != "") {
                $str_search .= "(fecha_atencion >= :fec_atencion_ini and fecha_atencion <= :fec_atencion_fin) AND ";
            }
            if ($arrFiltro['estado'] > 0) {
                $str_search .= "estado = :estado_ate AND";
            }
        }

        $sql = "SELECT * FROM
                (SELECT  concat(ifnull(pges_pri_apellido,''), ' ',ifnull(pges_seg_apellido,''), ' ', ifnull(pges_pri_nombre,''), ' ', ifnull(pges_seg_nombre,'')) as interesado,                        
                        gc.gcrm_id,                        
                        pges_correo,
                        pges_celular,
                         
                        ifnull((select pai_nombre from " . $con1->dbname . ".pais p 
                                where p.pai_id = pg.pai_id_nacimiento
                                and p.pai_estado = :estado
                                and p.pai_estado_logico = :estado),'') as pais,
                         
                        concat(ifnull(per_pri_nombre,''), ' ', ifnull(per_pri_apellido,'')) as agente,                          
                        concat(padm_codigo,'-',m.mod_nombre) as cod_agente,                          
                        hsc.hsco_fecha_atenc as fecha_atencion,                                                      
			hsc.hsco_fecha_proxima as fecha_proxima_atencion,                           
                        eg.eges_nombre as estado_des,                           
			eg.eges_id as estado
                FROM " . $con->dbname . ".hist_seguimiento_contac hsc inner join " . $con->dbname . ".gestion_crm gc on gc.gcrm_id = hsc.gcrm_id
		     inner join " . $con->dbname . ".persona_beneficiario pb on pb.pben_id = gc.pben_id
                     inner join " . $con->dbname . ".persona_gestion pg on pg.pges_id = pb.pges_id    
                     inner join " . $con->dbname . ".estado_gestion eg on eg.eges_id =  hsc.eges_id
                     inner join " . $con->dbname . ".personal_admision pa on pa.padm_id = hsc.padm_id
                     inner join " . $con1->dbname . ".persona per on per.per_id = pa.per_id
                     inner join " . $con->dbname . ".personal_admision_cargo pac on pa.padm_id = pac.padm_id
                     inner join " . $con->dbname . ".info_curricular_crm icc on icc.iccr_id = hsc.iccr_id
                     inner join " . $con->dbname . ".personal_nivel_modalidad pnm on (pnm.paca_id = pac.paca_id and pnm.nint_id = icc.nint_id and pnm.mod_id = icc.mod_id)                     
                     inner join " . $con2->dbname . ".modalidad m on m.mod_id = pnm.mod_id
                WHERE 	hsc.hsco_estado = :estado
                        and hsc.hsco_estado_logico = :estado
                        and gc.gcrm_estado = :estado
                        and gc.gcrm_estado_logico = :estado
                        and pb.pben_estado = :estado
                        and pb.pben_estado_logico = :estado
                        and pg.pges_estado = :estado
                        and pg.pges_estado_logico = :estado
                        and eg.eges_estado = :estado
                        and eg.eges_estado_logico = :estado
                        and pa.padm_estado = :estado
                        and pa.padm_estado_logico = :estado
                        and per.per_estado = :estado
                        and per.per_estado_logico = :estado
                        and pac.paca_estado = :estado
                        and pac.paca_estado_logico = :estado
                        and pnm.pnmo_estado = :estado
                        and pnm.pnmo_estado_logico = :estado
                        and m.mod_estado = :estado
                        and m.mod_estado_logico = :estado
                        and icc.iccr_estado = :estado
                        and icc.iccr_estado_logico = :estado
                ORDER BY hsc.hsco_id desc) a ";

        If (!empty($str_search)) {
            $sql .= "WHERE $str_search "
                    . "gcrm_id = gcrm_id";
        }

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);

        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $search_cond = "%" . $arrFiltro["interesado"] . "%";
            $fecha_atencion_ini = $arrFiltro["f_atencion"] . " 00:00:00";
            $fecha_atencion_fin = $arrFiltro["f_atencion"] . " 23:59:59";
            $agente = "%" . $arrFiltro["agente"] . "%";
            $estado_ate = $arrFiltro["estado"];

            if ($arrFiltro['interesado'] != "") {
                $comando->bindParam(":interesado", $search_cond, \PDO::PARAM_STR);
            }
            if ($arrFiltro['agente'] != "") {
                $comando->bindParam(":agente", $agente, \PDO::PARAM_STR);
            }
            if ($arrFiltro['f_atencion'] != "") {
                $comando->bindParam(":fec_atencion_ini", $fecha_atencion_ini, \PDO::PARAM_STR);
                $comando->bindParam(":fec_atencion_fin", $fecha_atencion_fin, \PDO::PARAM_STR);
            }
            if ($arrFiltro['estado'] > 0) {
                $comando->bindParam(":estado_ate", $estado_ate, \PDO::PARAM_INT);
            }
        }
        $resultData = $comando->queryAll();
        return $resultData;
    }

    /** Function consulta si es un etado de cierre. 
     * @author Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @param
     * @return
     */
    public function ConsultarEstadoCierre($eges_id) {
        $con = \Yii::$app->db_crm;
        $estado = 1;
        $sql = "SELECT 
                   eges_estado_sierre estado_cierre
                FROM 
                   " . $con->dbname . ".estado_gestion  
                WHERE 
                   eges_id = :eges_id AND
                   eges_estado = :estado AND 
                   eges_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":eges_id", $eges_id, \PDO::PARAM_INT);
        $resultData = $comando->queryOne();
        return $resultData;
    }

    /**
     * Function modifica el estado en la gestión por si es de cierre.
     * @author Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @param
     * @return
     */
    public function modificaEstadoCierre($gcrm_id, $gcrm_estado_sierre, $gcrm_fecha_estad_sierre) {

        $con = \Yii::$app->db_crm;
        $estado = 1;

        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".gestion_crm		       
                      SET gcrm_estado_sierre = :gcrm_estado_sierre,                      
                        gcrm_fecha_estad_sierre = :gcrm_fecha_estad_sierre                                  
                      WHERE 
                        gcrm_id = :gcrm_id AND                        
                        gcrm_estado = :estado AND
                        gcrm_estado_logico = :estado");

            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
            $comando->bindParam(":gcrm_id", $gcrm_id, \PDO::PARAM_INT);
            $comando->bindParam(":gcrm_estado_sierre", $gcrm_estado_sierre, \PDO::PARAM_STR);
            $comando->bindParam(":gcrm_fecha_estad_sierre", $gcrm_fecha_estad_sierre, \PDO::PARAM_STR);
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
     * Function consulta el estado de la ultima gestion del beneficiario
     * @author Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @param
     * @return
     */
    public function ConsultarEstadoBloqueo($gcrm_id) {
        $con = \Yii::$app->db_crm;
        $estado = 1;
        $sql = "SELECT 
                   gcrm_estado_sierre as est_cierre
                FROM 
                   " . $con->dbname . ".gestion_crm  
                WHERE 
                   gcrm_id = :gcrm_id AND
                   gcrm_estado = :estado AND 
                   gcrm_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":gcrm_id", $gcrm_id, \PDO::PARAM_INT);
        $resultData = $comando->queryOne();
        return $resultData;
    }

}
