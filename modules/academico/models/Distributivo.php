<?php

namespace app\modules\academico\models;
use yii\data\ArrayDataProvider;

use Yii;

/**
 * This is the model class for table "distributivo".
 *
 * @property int $dis_id
 * @property int $pro_id
 * @property int $asi_id
 * @property int $saca_id
 * @property string $dis_estado
 * @property string $dis_fecha_creacion
 * @property string $dis_fecha_modificacion
 * @property string $dis_estado_logico
 *
 * @property SemestreAcademico $saca
 * @property Profesor $pro
 * @property Asignatura $asi
 */
class Distributivo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'distributivo';
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
            [['pro_id', 'asi_id', 'saca_id', 'dis_estado', 'dis_estado_logico'], 'required'],
            [['pro_id', 'asi_id', 'saca_id'], 'integer'],
            [['dis_fecha_creacion', 'dis_fecha_modificacion'], 'safe'],
            [['dis_estado', 'dis_estado_logico'], 'string', 'max' => 1],
            [['saca_id'], 'exist', 'skipOnError' => true, 'targetClass' => SemestreAcademico::className(), 'targetAttribute' => ['saca_id' => 'saca_id']],
            [['pro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profesor::className(), 'targetAttribute' => ['pro_id' => 'pro_id']],
            [['asi_id'], 'exist', 'skipOnError' => true, 'targetClass' => Asignatura::className(), 'targetAttribute' => ['asi_id' => 'asi_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'dis_id' => 'Dis ID',
            'pro_id' => 'Pro ID',
            'asi_id' => 'Asi ID',
            'saca_id' => 'Saca ID',
            'dis_estado' => 'Dis Estado',
            'dis_fecha_creacion' => 'Dis Fecha Creacion',
            'dis_fecha_modificacion' => 'Dis Fecha Modificacion',
            'dis_estado_logico' => 'Dis Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaca()
    {
        return $this->hasOne(SemestreAcademico::className(), ['saca_id' => 'saca_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPro()
    {
        return $this->hasOne(Profesor::className(), ['pro_id' => 'pro_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsi()
    {
        return $this->hasOne(Asignatura::className(), ['asi_id' => 'asi_id']);
    }
    
     /**
     * Function Obtiene información de distributivo.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarDistributivo($arrFiltro = array()) {
        $con = \Yii::$app->db_academico;
        $con1 = \Yii::$app->db_asgard;
        $estado = 1;
        
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $str_search .= "(per.per_pri_nombre like :search OR ";
            $str_search .= "per.per_seg_nombre like :search OR ";
            $str_search .= "per.per_pri_apellido like :search OR ";
            $str_search .= "per.per_seg_apellido like :search OR ";
            $str_search .= "per.per_cedula like :search) AND ";
                        
            if ($arrFiltro['unidad'] != "" && $arrFiltro['unidad'] > 0) {
                $str_search .= " ua.uaca_id = :unidad AND ";
            }
            if ($arrFiltro['semestre'] != "" && $arrFiltro['semestre'] > 0) {
                $str_search .= "d.saca_id = :semestre AND ";
            }        
        }        
        $sql = "SELECT  d.dis_id,
                        p.pro_id,
                        per.per_cedula,
                        per.per_pri_nombre,
                        per.per_seg_nombre,
                        per.per_pri_apellido,
                        per.per_seg_apellido,
                        concat(per.per_pri_nombre,' ', per.per_pri_apellido) as docente,
                        d.asi_id,
                        a.asi_nombre as asignatura,
                        ua.uaca_id,
                        ua.uaca_nombre as unidad,
                        dd.ddoc_nombre as dedicacion,
                        d.saca_id,
                        concat(sa.saca_nombre,sa.saca_anio) as semestre,
                        d.dis_descripcion
                FROM ". $con->dbname . ".distributivo d inner join ". $con->dbname . ".profesor p on p.pro_id = d.pro_id
                inner join ". $con1->dbname . ".persona per on per.per_id = p.per_id
                inner join ". $con->dbname . ".asignatura a on a.asi_id = d.asi_id
                inner join ". $con->dbname . ".unidad_academica ua on ua.uaca_id = a.uaca_id 
                inner join ". $con->dbname . ".dedicacion_docente dd on dd.ddoc_id = d.ddoc_id 
                inner join ". $con->dbname . ".semestre_academico sa on sa.saca_id = d.saca_id
                WHERE $str_search
                      d.dis_estado = '1'
                      and d.dis_estado_logico = '1'
                      and p.pro_estado = '1'
                      and p.pro_estado_logico = '1'
                      and per.per_estado = '1'
                      and per.per_estado_logico = '1'
                      and a.asi_estado = '1'
                      and a.asi_estado_logico = '1'
                      and ua.uaca_estado = '1'
                      and ua.uaca_estado_logico = '1'
                      and dd.ddoc_estado = '1'
                      and dd.ddoc_estado_logico = '1'
                      and sa.saca_estado = '1'
                      and sa.saca_estado_logico = '1' 
                ORDER BY d.dis_id desc"; 
        
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $search_cond = "%" . $arrFiltro["search"] . "%";
            $comando->bindParam(":search", $search_cond, \PDO::PARAM_STR);
            
            if ($arrFiltro['unidad'] != "" && $arrFiltro['unidad'] > 0) {
                $search_uni = $arrFiltro["unidad"];
                $comando->bindParam(":unidad", $search_uni, \PDO::PARAM_INT);
            }
            if ($arrFiltro['semestre'] != "" && $arrFiltro['semestre'] > 0) {
                $search_semestre = $arrFiltro["semestre"];
                $comando->bindParam(":semestre", $search_semestre, \PDO::PARAM_INT);
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
                'attributes' => [],
            ],
        ]);        
        return $dataProvider;        
    }    
    
    /**
     * Function Obtiene información de distributivo para excel.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarDistributivoReporte($arrFiltro = array()) {
        $con = \Yii::$app->db_academico;
        $con1 = \Yii::$app->db_asgard;
        $estado = 1;
        
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $str_search .= "(per.per_pri_nombre like :search OR ";
            $str_search .= "per.per_seg_nombre like :search OR ";
            $str_search .= "per.per_pri_apellido like :search OR ";
            $str_search .= "per.per_seg_apellido like :search OR ";
            $str_search .= "per.per_cedula like :search) AND ";
                        
            if ($arrFiltro['unidad'] != "" && $arrFiltro['unidad'] > 0) {
                $str_search .= " ua.uaca_id = :unidad AND ";
            }
            if ($arrFiltro['semestre'] != "" && $arrFiltro['semestre'] > 0) {
                $str_search .= "d.saca_id = :semestre AND ";
            }        
        }        
        $sql = "SELECT  per.per_cedula,                        
                        concat(per.per_pri_nombre,' ', per.per_pri_apellido) as docente,   
                        dd.ddoc_nombre as dedicacion,                        
                        ua.uaca_nombre as unidad,
                        a.asi_nombre as asignatura,                                                
                        concat(sa.saca_nombre,' ',sa.saca_anio) as semestre,
                        d.dis_descripcion
                FROM ". $con->dbname . ".distributivo d inner join ". $con->dbname . ".profesor p on p.pro_id = d.pro_id
                inner join ". $con1->dbname . ".persona per on per.per_id = p.per_id
                inner join ". $con->dbname . ".asignatura a on a.asi_id = d.asi_id
                inner join ". $con->dbname . ".unidad_academica ua on ua.uaca_id = a.uaca_id 
                inner join ". $con->dbname . ".dedicacion_docente dd on dd.ddoc_id = d.ddoc_id 
                inner join ". $con->dbname . ".semestre_academico sa on sa.saca_id = d.saca_id
                WHERE $str_search
                      d.dis_estado = '1'
                      and d.dis_estado_logico = '1'
                      and p.pro_estado = '1'
                      and p.pro_estado_logico = '1'
                      and per.per_estado = '1'
                      and per.per_estado_logico = '1'
                      and a.asi_estado = '1'
                      and a.asi_estado_logico = '1'
                      and ua.uaca_estado = '1'
                      and ua.uaca_estado_logico = '1'
                      and dd.ddoc_estado = '1'
                      and dd.ddoc_estado_logico = '1'
                      and sa.saca_estado = '1'
                      and sa.saca_estado_logico = '1' 
                ORDER BY d.dis_id desc"; 
        
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $search_cond = "%" . $arrFiltro["search"] . "%";
            $comando->bindParam(":search", $search_cond, \PDO::PARAM_STR);
            
            if ($arrFiltro['unidad'] != "" && $arrFiltro['unidad'] > 0) {
                $search_uni = $arrFiltro["unidad"];
                $comando->bindParam(":unidad", $search_uni, \PDO::PARAM_INT);
            }
            if ($arrFiltro['semestre'] != "" && $arrFiltro['semestre'] > 0) {
                $search_semestre = $arrFiltro["semestre"];
                $comando->bindParam(":semestre", $search_semestre, \PDO::PARAM_INT);
            }
        }
        $resultData = $comando->queryAll();        
        return $resultData;        
    } 
    
     /**
     * Function Obtiene información de carga horaria.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarCargaHoraria($arrFiltro = array()) {
        $con = \Yii::$app->db_academico;
        $con1 = \Yii::$app->db_asgard;
        $estado = 1;
        
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $str_search .= "(per.per_pri_nombre like :search OR ";
            $str_search .= "per.per_seg_nombre like :search OR ";
            $str_search .= "per.per_pri_apellido like :search OR ";
            $str_search .= "per.per_seg_apellido like :search OR ";
            $str_search .= "per.per_cedula like :search) AND ";
                        
            if ($arrFiltro['tipo'] != "" && $arrFiltro['tipo'] > 0) {
                $str_search .= " d.tdis_id = :tipo AND d.dcho_horas > 0 AND ";
            }
            if ($arrFiltro['semestre'] != "" && $arrFiltro['semestre'] > 0) {
                $str_search .= "d.saca_id = :semestre AND ";
            }        
        }        
        $sql = "SELECT  p.pro_id,
                        ifnull(per.per_cedula,'') as per_cedula,
                        per.per_pri_nombre,
                        per.per_seg_nombre,
                        per.per_pri_apellido,
                        per.per_seg_apellido,
                        ifnull(concat(per.per_pri_nombre,' ', per.per_pri_apellido),'') as docente,
                        d.saca_id,
                        (case when d.saca_id > 0 then
                            CONCAT(sa.saca_nombre,' ',sa.saca_anio)
                            else '' end) as semestre,
                        ifnull(GROUP_CONCAT(CASE
                            WHEN d.tdis_id = 1 THEN dcho_horas end),'') as docencia,
                        ifnull(GROUP_CONCAT(CASE
                            WHEN d.tdis_id = 2 THEN dcho_horas end),'') as tutoria,
			ifnull(GROUP_CONCAT(CASE
                            WHEN d.tdis_id = 3 THEN dcho_horas end),'') as investigacion,
			ifnull(GROUP_CONCAT(CASE
                            WHEN d.tdis_id = 4 THEN dcho_horas end),'') as vinculacion,
			ifnull(GROUP_CONCAT(CASE
                            WHEN d.tdis_id = 5 THEN dcho_horas end),'') as administrativa,
			ifnull(GROUP_CONCAT(CASE
                            WHEN d.tdis_id = 6 THEN dcho_horas end),'') as otras,
                        ifnull(SUM(dcho_horas),'') as total
                FROM ". $con->dbname . ".distributivo_carga_horaria d
                inner join ". $con->dbname . ".profesor p on p.pro_id = d.pro_id
                inner join ". $con1->dbname . ".persona per on per.per_id = p.per_id						
                inner join ". $con->dbname . ".semestre_academico sa on sa.saca_id = d.saca_id
                inner join ". $con->dbname . ".tipo_distributivo t on t.tdis_id = d.tdis_id
                WHERE $str_search					  
                      d.dcho_estado = :estado
                      and d.dcho_estado_logico = :estado
                      and p.pro_estado = :estado
                      and p.pro_estado_logico = :estado
                      and per.per_estado = :estado
                      and per.per_estado_logico = :estado                      
                      and sa.saca_estado = :estado
                      and sa.saca_estado_logico = :estado
                GROUP BY  d.saca_id, d.pro_id";                 
        
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $search_cond = "%" . $arrFiltro["search"] . "%";
            $comando->bindParam(":search", $search_cond, \PDO::PARAM_STR);            
            if ($arrFiltro['tipo'] != "" && $arrFiltro['tipo'] > 0) {
                $search_tipo = $arrFiltro["tipo"];
                $comando->bindParam(":tipo", $search_tipo, \PDO::PARAM_INT);
            }
            if ($arrFiltro['semestre'] != "" && $arrFiltro['semestre'] > 0) {
                $search_semestre = $arrFiltro["semestre"];
                $comando->bindParam(":semestre", $search_semestre, \PDO::PARAM_INT);
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
                'attributes' => [],
            ],
        ]);        
        return $dataProvider;        
    }  
    
     /**
     * Function Obtiene información de carga horaria.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarCargaHorariaReporte($arrFiltro = array()) {
        $con = \Yii::$app->db_academico;
        $con1 = \Yii::$app->db_asgard;
        $estado = 1;
        
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $str_search .= "(per.per_pri_nombre like :search OR ";
            $str_search .= "per.per_seg_nombre like :search OR ";
            $str_search .= "per.per_pri_apellido like :search OR ";
            $str_search .= "per.per_seg_apellido like :search OR ";
            $str_search .= "per.per_cedula like :search) AND ";
                        
            if ($arrFiltro['tipo'] != "" && $arrFiltro['tipo'] > 0) {
                $str_search .= " d.tdis_id = :tipo AND d.dcho_horas > 0 AND ";
            }
            if ($arrFiltro['semestre'] != "" && $arrFiltro['semestre'] > 0) {
                $str_search .= "d.saca_id = :semestre AND ";
            }        
        }        
        $sql = "SELECT  per.per_cedula,                        
                        IFNULL(concat(per.per_pri_nombre,' ', per.per_pri_apellido),'') as docente,                        
                        (CASE WHEN d.saca_id > 0 then
                            CONCAT(sa.saca_nombre,' ',sa.saca_anio)
                            else '' END) as semestre,
                        IFNULL(GROUP_CONCAT(CASE
                            WHEN d.tdis_id = 1 THEN dcho_horas end),'') as docencia,
			IFNULL(GROUP_CONCAT(CASE
                            WHEN d.tdis_id = 2 THEN dcho_horas end),'') as tutoria,
			IFNULL(GROUP_CONCAT(CASE
                            WHEN d.tdis_id = 3 THEN dcho_horas end),'') as investigacion,
			IFNULL(GROUP_CONCAT(CASE
                            WHEN d.tdis_id = 4 THEN dcho_horas end),'') as vinculacion,
			IFNULL(GROUP_CONCAT(CASE
                            WHEN d.tdis_id = 5 THEN dcho_horas end),'') as administrativa,
			IFNULL(GROUP_CONCAT(CASE
                            WHEN d.tdis_id = 6 THEN dcho_horas end),'') as otras,
			SUM(dcho_horas) as total
                FROM ". $con->dbname . ".distributivo_carga_horaria d
                inner join ". $con->dbname . ".profesor p on p.pro_id = d.pro_id
                inner join ". $con1->dbname . ".persona per on per.per_id = p.per_id						
                inner join ". $con->dbname . ".semestre_academico sa on sa.saca_id = d.saca_id
                inner join ". $con->dbname . ".tipo_distributivo t on t.tdis_id = d.tdis_id
                WHERE $str_search					  
                      d.dcho_estado = :estado
                      and d.dcho_estado_logico = :estado
                      and p.pro_estado = :estado
                      and p.pro_estado_logico = :estado
                      and per.per_estado = :estado
                      and per.per_estado_logico = :estado                      
                      and sa.saca_estado = :estado
                      and sa.saca_estado_logico = :estado
                GROUP BY  d.saca_id, d.pro_id";                 
        
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $search_cond = "%" . $arrFiltro["search"] . "%";
            $comando->bindParam(":search", $search_cond, \PDO::PARAM_STR);            
            if ($arrFiltro['tipo'] != "" && $arrFiltro['tipo'] > 0) {
                $search_tipo = $arrFiltro["tipo"];
                $comando->bindParam(":tipo", $search_tipo, \PDO::PARAM_INT);
            }
            if ($arrFiltro['semestre'] != "" && $arrFiltro['semestre'] > 0) {
                $search_semestre = $arrFiltro["semestre"];
                $comando->bindParam(":semestre", $search_semestre, \PDO::PARAM_INT);
            }
        }
        $resultData = $comando->queryAll();
        return $resultData;
    } 
    
    /**
     * Function Obtiene información de distributivo por profesor.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarDistributivoxProfesor($arrFiltro = array(), $id_profesor, $reporte) {
        $con = \Yii::$app->db_academico;
        $con1 = \Yii::$app->db_asgard;
        $estado = 1;
        
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $str_search .= "(p.per_pri_nombre like :search OR ";
            $str_search .= "p.per_seg_nombre like :search OR ";
            $str_search .= "p.per_pri_apellido like :search OR ";
            $str_search .= "p.per_seg_apellido like :search OR ";
            $str_search .= "p.per_cedula like :search) AND ";
                        
            if ($arrFiltro['unidad'] != "" && $arrFiltro['unidad'] > 0) {
                $str_search .= "a.uaca_id = :unidad AND ";
            }
            if ($arrFiltro['modalidad'] != "" && $arrFiltro['modalidad'] > 0) {
                $str_search .= "a.mod_id = :modalidad AND ";
            }
            if ($arrFiltro['periodo'] != "" && $arrFiltro['periodo'] > 0) {
                $str_search .= "a.paca_id = :periodo AND ";
            } 
        }        
        $sql = "SELECT  d.uaca_nombre as unidad, e.mod_nombre as modalidad,
                        p.per_cedula as identificacion, 
                        concat(p.per_pri_nombre, ' ', p.per_pri_apellido, ' ', ifnull(p.per_seg_apellido,'')) as estudiante,
                        concat(saca_nombre, '-', baca_nombre,'-',baca_anio) as periodo,
                        z.asi_nombre as asignatura,
                        case when m.eppa_estado_pago = 'N' then 'Pagado' else 'Pendiente' end as pago
                FROM ". $con->dbname . ".distributivo_academico a inner join ". $con->dbname . ".profesor b
                    on b.pro_id = a.pro_id 
                    inner join ". $con1->dbname . ".persona c on c.per_id = b.per_id
                    inner join ". $con->dbname . ".unidad_academica d on d.uaca_id = a.uaca_id
                    inner join ". $con->dbname . ".modalidad e on e.mod_id = a.mod_id
                    inner join ". $con->dbname . ".periodo_academico f on f.paca_id = a.paca_id
                    inner join ". $con->dbname . ".distributivo_academico_estudiante g on g.daca_id = a.daca_id
                    inner join ". $con->dbname . ".estudiante h on h.est_id = g.est_id
                    inner join ". $con1->dbname . ".persona p on p.per_id = h.per_id
                    inner join ". $con->dbname . ".semestre_academico s on s.saca_id = f.saca_id
                    inner join ". $con->dbname . ".bloque_academico t on t.baca_id = f.baca_id
                    inner join ". $con->dbname . ".asignatura z on a.asi_id = z.asi_id
                    left join ". $con->dbname . ".estudiante_periodo_pago m on (m.est_id = g.est_id and m.paca_id = f.paca_id)
                WHERE $str_search c.per_id = :profesor
                    and f.paca_activo = 'A'
                    and a.daca_estado = :estado
                    and a.daca_estado_logico = :estado
                    and g.daes_estado = :estado
                    and g.daes_estado_logico = :estado"; 
        
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":profesor", $id_profesor, \PDO::PARAM_INT);
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $search_cond = "%" . $arrFiltro["search"] . "%";
            $comando->bindParam(":search", $search_cond, \PDO::PARAM_STR);
            
            if ($arrFiltro['unidad'] != "" && $arrFiltro['unidad'] > 0) {
                $search_uni = $arrFiltro["unidad"];
                $comando->bindParam(":unidad", $search_uni, \PDO::PARAM_INT);
            }
            if ($arrFiltro['modalidad'] != "" && $arrFiltro['modalidad'] > 0) {
                $search_mod = $arrFiltro["modalidad"];
                $comando->bindParam(":modalidad", $search_mod, \PDO::PARAM_INT);
            }
            if ($arrFiltro['periodo'] != "" && $arrFiltro['periodo'] > 0) {
                $search_per = $arrFiltro["periodo"];
                $comando->bindParam(":periodo", $search_per, \PDO::PARAM_INT);
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
                'attributes' => [],
            ],
        ]);        
        if ($reporte ==1) {
            return $dataProvider;        
        } else {
            return $resultData;
        }
    }    
}
