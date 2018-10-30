<?php

namespace app\modules\academico\models;

use Yii;
use yii\data\ArrayDataProvider;

/**
 * This is the model class for table "matriculados_reprobado".
 *
 * @property int $mre_id
 * @property int $adm_id
 * @property int $mre_usuario_ingreso
 * @property int $mreusuario_modifica
 * @property string $mre_estado
 * @property string $mre_fecha_creacion
 * @property string $mre_fecha_modificacion
 * @property string $mre_estado_logico
 *
 * @property Admitido $adm
 */
class MatriculadosReprobado extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'matriculados_reprobado';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb() {
        return Yii::$app->get('db_captacion');
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['adm_id', 'mre_usuario_ingreso', 'mre_estado', 'mre_estado_logico'], 'required'],
            [['adm_id', 'mre_usuario_ingreso', 'mreusuario_modifica'], 'integer'],
            [['mre_fecha_creacion', 'mre_fecha_modificacion'], 'safe'],
            [['mre_estado', 'mre_estado_logico'], 'string', 'max' => 1],
            [['adm_id'], 'exist', 'skipOnError' => true, 'targetClass' => Admitido::className(), 'targetAttribute' => ['adm_id' => 'adm_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'mre_id' => 'Mre ID',
            'adm_id' => 'Adm ID',
            'mre_usuario_ingreso' => 'Mre Usuario Ingreso',
            'mreusuario_modifica' => 'Mreusuario Modifica',
            'mre_estado' => 'Mre Estado',
            'mre_fecha_creacion' => 'Mre Fecha Creacion',
            'mre_fecha_modificacion' => 'Mre Fecha Modificacion',
            'mre_estado_logico' => 'Mre Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdm() {
        return $this->hasOne(Admitido::className(), ['adm_id' => 'adm_id']);
    }

    /**
     * Function getMatriculados
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>
     * @param   
     * @return  $resultData (información del admitido)
     */
    public static function getMatriculados($search = NULL) {
        $con = \Yii::$app->db_captacion;
        $con2 = \Yii::$app->db;
        $con3 = \Yii::$app->db_academico;
        $con1 = \Yii::$app->db_facturacion;
        $estado = 1;
        $columnsAdd = "";
        $estado_opago = "S";
        $search_cond = $search;
        $str_search = "";

        if (isset($search)) {
            $str_search .= "per.per_cedula = :search AND ";
        }

        $sql = " SELECT  distinct lpad(ifnull(sins.num_solicitud, sins.sins_id),9,'0') as solicitud,
                        sins.sins_id,
                        sins.int_id,
                        SUBSTRING(sins.sins_fecha_solicitud,1,10) as sins_fecha_solicitud, 
                        per.per_id as persona, 
                        per.per_pri_nombre as per_pri_nombre, 
                        per.per_seg_nombre as per_seg_nombre,
                        per.per_pri_apellido as per_pri_apellido,
                        per.per_seg_apellido as per_seg_apellido, 
                        per.per_cedula as per_cedula, 
                        per.per_correo as per_correo, 
                        per_celular as per_celular,
                        admi.adm_id,  
                        sins.ming_id, 
                        ifnull((select min.ming_alias from " . $con->dbname . ".metodo_ingreso min where min.ming_id = sins.ming_id),'N/A') as abr_metodo,
                        ifnull((select min.ming_nombre from " . $con->dbname . ".metodo_ingreso min where min.ming_id = sins.ming_id),'N/A') as ming_nombre,
                        ifnull((select uaca.uaca_nombre from " . $con3->dbname . ".unidad_academica uaca where uaca.uaca_id = sins.uaca_id),'N/A') as uaca_nombre,
                        ifnull((select moda.mod_nombre from " . $con3->dbname . ".modalidad moda where moda.mod_id = sins.mod_id),'N/A') as mod_nombre,
                        sins.eaca_id,
                        sins.mest_id,
                        case when (ifnull(sins.eaca_id,0)=0) then
                                (select mest_nombre from " . $con3->dbname . ".modulo_estudio me where me.mest_id = sins.mest_id and me.mest_estado = '1' and me.mest_estado_logico = '1')
                                else
                            (select eaca_nombre from " . $con3->dbname . ".estudio_academico ea where ea.eaca_id = sins.eaca_id and ea.eaca_estado = '1' and ea.eaca_estado_logico = '1')
                        end as carrera,                             
                       (case when sins_beca = 1 then 'ICF' else 'No Aplica' end) as beca,
                       ifnull((select 'SI' existe from " . $con3->dbname . ".matriculacion m where m.adm_id = admi.adm_id and m.sins_id = sins.sins_id and m.mat_estado = :estado and m.mat_estado_logico = :estado),'NO') as matriculado
                FROM " . $con->dbname . ".admitido admi INNER JOIN " . $con->dbname . ".interesado inte on inte.int_id = admi.int_id                     
                     INNER JOIN " . $con2->dbname . ".persona per on inte.per_id = per.per_id
                     INNER JOIN " . $con->dbname . ".solicitud_inscripcion sins on sins.int_id = inte.int_id                                          
                     INNER JOIN " . $con1->dbname . ".orden_pago opag on opag.sins_id = sins.sins_id                       
                WHERE  
                       $str_search 
                       sins.rsin_id = 2 AND
                       opag.opag_estado_pago = :estado_opago AND
                       admi.adm_estado_logico = :estado AND
                       admi.adm_estado = :estado AND 
                       inte.int_estado_logico = :estado AND
                       inte.int_estado = :estado AND     
                       per.per_estado_logico = :estado AND
                       per.per_estado = :estado AND
                       sins.sins_estado = :estado AND
                       sins.sins_estado_logico = :estado                                                    
                ORDER BY SUBSTRING(sins.sins_fecha_solicitud,1,10) desc";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":estado_opago", $estado_opago, \PDO::PARAM_STR);
        if (isset($search)) {
            $comando->bindParam(":search", $search_cond, \PDO::PARAM_STR);
        }
        $resultData = $comando->queryAll();
        $dataProvider = new ArrayDataProvider([
            'key' => 'id',
            'allModels' => $resultData,
            'pagination' => [
                'pageSize' => Yii::$app->params["pageSize"],
            ],
            'sort' => [
                'attributes' => [],
            ],
        ]);
        return $dataProvider;
    }

    /**
     * Function getMatriculadosreprobados
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>
     * @param   
     * @return  $resultData (información del matriculado no aprobado)
     */
    public static function getMatriculadosreprobados($arrFiltro = array(), $onlyData = false) {
        $con = \Yii::$app->db_captacion;
        $con2 = \Yii::$app->db;
        $con3 = \Yii::$app->db_academico;
        $con1 = \Yii::$app->db_facturacion;
        $estado = 1;
        $columnsAdd = "";
        $estado_opago = "S";
        //$esp = "SET lc_time_names = 'es_ES';";

        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $str_search = "(per.per_pri_nombre like :search OR ";
            $str_search .= "per.per_seg_nombre like :search OR ";
            $str_search .= "per.per_pri_apellido like :search OR ";
            $str_search .= "per.per_cedula like :search) AND ";

            if ($arrFiltro['f_ini'] != "" && $arrFiltro['f_fin'] != "") {
                $str_search .= "mre.mre_fecha_creacion >= :fec_ini AND ";
                $str_search .= "mre.mre_fecha_creacion <= :fec_fin AND ";
            }
        } else {
            $columnsAdd = "-- sins.sins_id as solicitud_id,
                    per.per_id as persona, 
                    per.per_pri_nombre as per_pri_nombre, 
                    per.per_seg_nombre as per_seg_nombre,
                    per.per_pri_apellido as per_pri_apellido,
                    per.per_seg_apellido as per_seg_apellido,";
        }

        $sql = " 
                
                SELECT 
                    SUBSTRING(mre.mre_fecha_creacion,1,10) as mre_fecha_creacion,
                    per.per_cedula, 
                    per.per_pri_nombre, 
                    per.per_pri_apellido,
                    sins.ming_id, 
                    ifnull((select min.ming_alias from " . $con->dbname . ".metodo_ingreso min where min.ming_id = sins.ming_id),'N/A') as abr_metodo,
                    ifnull((select min.ming_nombre from " . $con->dbname . ".metodo_ingreso min where min.ming_id = sins.ming_id),'N/A') as ming_nombre,
                    ifnull((select uaca.uaca_nombre from " . $con3->dbname . ".unidad_academica uaca where uaca.uaca_id = sins.uaca_id),'N/A') as uaca_nombre,
                    ifnull((select moda.mod_nombre from " . $con3->dbname . ".modalidad moda where moda.mod_id = sins.mod_id),'N/A') as mod_nombre,
                    sins.eaca_id,
                    sins.mest_id,
                    case when (ifnull(sins.eaca_id,0)=0) then
                               (select mest_nombre from " . $con3->dbname . ".modulo_estudio me where me.mest_id = sins.mest_id and me.mest_estado = '1' and me.mest_estado_logico = '1')
                                else
                           (select eaca_nombre from " . $con3->dbname . ".estudio_academico ea where ea.eaca_id = sins.eaca_id and ea.eaca_estado = '1' and ea.eaca_estado_logico = '1')
                    end as carrera,
                    -- MONTHNAME(CONCAT('00','-',ami.mes_id_academico,'-','0000')) as mes_id_academico               
                    case mes_id_academico 
                        when 1 then 'Enero' 
                        when 2 then 'Febrero'
                        when 3 then 'Marzo'
                        when 4 then 'Abril' 
                        when 5 then 'Mayo'
                        when 6 then 'Junio'
                        when 7 then 'Julio' 
                        when 8 then 'Agosto'
                        when 9 then 'Septiembre'
                        when 10 then 'Octubre' 
                        when 11 then 'Noviembre'
                        when 12 then 'Diciembre'
                 end as mes_id_academico,
                    0 as aprobada,
                    0 as reprobada
                FROM " . $con->dbname . ".matriculados_reprobado mre 
                     INNER JOIN " . $con->dbname . ".admitido adm ON adm.adm_id = mre.adm_id
                     INNER JOIN " . $con->dbname . ".interesado inte on inte.int_id = adm.int_id                     
                     INNER JOIN " . $con2->dbname . ".persona per on inte.per_id = per.per_id 
                     INNER JOIN " . $con->dbname . ".solicitud_inscripcion sins on sins.int_id = inte.int_id 
                     INNER JOIN " . $con3->dbname . ".periodo_academico_met_ingreso ami on ami.pami_id = mre.pami_id
                WHERE  
                       $str_search   
                       adm.adm_estado_logico = :estado AND
                       adm.adm_estado = :estado AND 
                       inte.int_estado_logico = :estado AND
                       inte.int_estado = :estado AND     
                       per.per_estado_logico = :estado AND
                       per.per_estado = :estado AND
                       ami.pami_estado = :estado AND
                       ami.pami_estado_logico = :estado                                                   
                ORDER BY SUBSTRING(mre.mre_fecha_creacion,1,10) desc";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":estado_opago", $estado_opago, \PDO::PARAM_STR);
        //$comando->bindParam(":esp",$esp, \PDO::PARAM_STR); 
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $search_cond = "%" . $arrFiltro["search"] . "%";
            $fecha_ini = $arrFiltro["f_ini"] . " 00:00:00";
            $fecha_fin = $arrFiltro["f_fin"] . " 23:59:59";
            $comando->bindParam(":search", $search_cond, \PDO::PARAM_STR);
            if ($arrFiltro['f_ini'] != "" && $arrFiltro['f_fin'] != "") {
                $comando->bindParam(":fec_ini", $fecha_ini, \PDO::PARAM_STR);
                $comando->bindParam(":fec_fin", $fecha_fin, \PDO::PARAM_STR);
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
     * Function consultarMatriculareprueba
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>
     * @param   
     * @return  $resultData (información del matriculado no aprobado)
     */
    public static function consultarMatriculareprueba($arrFiltro = array(), $onlyData = false) {
        $con = \Yii::$app->db_captacion;
        $con2 = \Yii::$app->db;
        $con3 = \Yii::$app->db_academico;
        $con1 = \Yii::$app->db_facturacion;
        $estado = 1;
        $columnsAdd = "";
        $estado_opago = "S";

        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $str_search = "(per.per_pri_nombre like :search OR ";
            $str_search .= "per.per_seg_nombre like :search OR ";
            $str_search .= "per.per_pri_apellido like :search OR ";
            $str_search .= "per.per_cedula like :search) AND ";

            if ($arrFiltro['f_ini'] != "" && $arrFiltro['f_fin'] != "") {
                $str_search .= "mre.mre_fecha_creacion >= :fec_ini AND ";
                $str_search .= "mre.mre_fecha_creacion <= :fec_fin AND ";
            }
        } else {
            $columnsAdd = "-- sins.sins_id as solicitud_id,
                    per.per_id as persona, 
                    per.per_pri_nombre as per_pri_nombre, 
                    per.per_seg_nombre as per_seg_nombre,
                    per.per_pri_apellido as per_pri_apellido,
                    per.per_seg_apellido as per_seg_apellido,";
        }

        $sql = " 
                SELECT                  
                    per.per_cedula, 
                    per.per_pri_nombre, 
                    per.per_seg_nombre,
                    per.per_pri_apellido, 
                    per.per_seg_apellido,
                    per.per_correo,
                    per.per_celular,
                    ifnull((select uaca.uaca_nombre from " . $con3->dbname . ".unidad_academica uaca where uaca.uaca_id = sins.uaca_id),'N/A') as uaca_nombre,
                    ifnull((select moda.mod_nombre from " . $con3->dbname . ".modalidad moda where moda.mod_id = sins.mod_id),'N/A') as mod_nombre, 
                    case mes_id_academico 
                        when 1 then 'Enero' 
                        when 2 then 'Febrero'
                        when 3 then 'Marzo'
                        when 4 then 'Abril' 
                        when 5 then 'Mayo'
                        when 6 then 'Junio'
                        when 7 then 'Julio' 
                        when 8 then 'Agosto'
                        when 9 then 'Septiembre'
                        when 10 then 'Octubre' 
                        when 11 then 'Noviembre'
                        when 12 then 'Diciembre'
                    end as mes_id_academico, 
                    case when (ifnull(sins.eaca_id,0)=0) then
                               (select mest_nombre from " . $con3->dbname . ".modulo_estudio me where me.mest_id = sins.mest_id and me.mest_estado = '1' and me.mest_estado_logico = '1')
                                else
                           (select eaca_nombre from " . $con3->dbname . ".estudio_academico ea where ea.eaca_id = sins.eaca_id and ea.eaca_estado = '1' and ea.eaca_estado_logico = '1')
                    end as carrera,
                    ifnull((select min.ming_nombre from " . $con->dbname . ".metodo_ingreso min where min.ming_id = sins.ming_id),'N/A') as ming_nombre,
                    0 as aprobada,
                    0 as reprobada
                FROM " . $con->dbname . ".matriculados_reprobado mre 
                     INNER JOIN " . $con->dbname . ".admitido adm ON adm.adm_id = mre.adm_id
                     INNER JOIN " . $con->dbname . ".interesado inte on inte.int_id = adm.int_id                     
                     INNER JOIN " . $con2->dbname . ".persona per on inte.per_id = per.per_id 
                     INNER JOIN " . $con->dbname . ".solicitud_inscripcion sins on sins.int_id = inte.int_id 
                     INNER JOIN " . $con3->dbname . ".periodo_academico_met_ingreso ami on ami.pami_id = mre.pami_id
                WHERE  
                       $str_search   
                       adm.adm_estado_logico = :estado AND
                       adm.adm_estado = :estado AND 
                       inte.int_estado_logico = :estado AND
                       inte.int_estado = :estado AND     
                       per.per_estado_logico = :estado AND
                       per.per_estado = :estado AND
                       ami.pami_estado = :estado AND
                       ami.pami_estado_logico = :estado                                                   
                ORDER BY SUBSTRING(mre.mre_fecha_creacion,1,10) desc";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":estado_opago", $estado_opago, \PDO::PARAM_STR);
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $search_cond = "%" . $arrFiltro["search"] . "%";
            $fecha_ini = $arrFiltro["f_ini"] . " 00:00:00";
            $fecha_fin = $arrFiltro["f_fin"] . " 23:59:59";
            $comando->bindParam(":search", $search_cond, \PDO::PARAM_STR);
            if ($arrFiltro['f_ini'] != "" && $arrFiltro['f_fin'] != "") {
                $comando->bindParam(":fec_ini", $fecha_ini, \PDO::PARAM_STR);
                $comando->bindParam(":fec_fin", $fecha_fin, \PDO::PARAM_STR);
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
     * Function insertarReprobado crea reprobado matriculado.
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @param
     * @return
     */
    public function insertarMatricureprobado($adm_id, $pami_id, $mre_usuario_ingreso, $mre_fecha_creacion) {
        $con = \Yii::$app->db_captacion;
        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        $param_sql = "mre_estado";
        $bdet_sql = "1";

        $param_sql .= ", mre_estado_logico";
        $bdet_sql .= ", 1";

        if (isset($adm_id)) {
            $param_sql .= ", adm_id";
            $bdet_sql .= ", :adm_id";
        }
        if (isset($pami_id)) {
            $param_sql .= ", pami_id";
            $bdet_sql .= ", :pami_id";
        }
        if (isset($mre_usuario_ingreso)) {
            $param_sql .= ", mre_usuario_ingreso";
            $bdet_sql .= ", :mre_usuario_ingreso";
        }
        if (isset($mre_fecha_creacion)) {
            $param_sql .= ", mre_fecha_creacion";
            $bsol_sql .= ", :mre_fecha_creacion";
        }

        try {
            $sql = "INSERT INTO " . $con->dbname . ".matriculados_reprobado ($param_sql) VALUES($bdet_sql)";
            $comando = $con->createCommand($sql);

            if (isset($adm_id)) {
                $comando->bindParam(':adm_id', $adm_id, \PDO::PARAM_INT);
            }
            if (isset($pami_id)) {
                $comando->bindParam(':pami_id', $pami_id, \PDO::PARAM_INT);
            }
            if (!empty((isset($mre_usuario_ingreso)))) {
                $comando->bindParam(':mre_usuario_ingreso', $mre_usuario_ingreso, \PDO::PARAM_INT);
            }
            if (!empty((isset($mre_fecha_creacion)))) {
                $comando->bindParam(':mre_fecha_creacion', $mre_fecha_creacion, \PDO::PARAM_STR);
            }

            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.matriculados_reprobado');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }

}
