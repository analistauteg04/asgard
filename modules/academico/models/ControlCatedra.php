<?php

namespace app\modules\academico\models;
use Yii;
use yii\data\ArrayDataProvider;


/**
 * This is the model class for table "control_catedra".
 *
 * @property int $ccat_id
 * @property int $hape_id
 * @property int $eaca_id
 * @property string $ccat_fecha_registro
 * @property string $ccat_titulo_unidad
 * @property string $ccat_tema
 * @property string $ccat_trabajo_autopractico
 * @property string $ccat_logro_aprendizaje
 * @property string $ccat_observacion
 * @property string $ccat_direccion_ip
 * @property int $usu_id
 * @property string $ccat_estado
 * @property string $ccat_fecha_creacion
 * @property string $ccat_fecha_modificacion
 * @property string $ccat_estado_logico
 *
 * @property HorarioAsignaturaPeriodo $hape
 * @property EstudioAcademico $eaca
 * @property DetalleCatedraActividad[] $detalleCatedraActividads
 * @property DetalleValorDesarrollo[] $detalleValorDesarrollos
 */
class ControlCatedra extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'control_catedra';
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
            [['hape_id', 'ccat_titulo_unidad', 'ccat_tema', 'ccat_trabajo_autopractico', 'ccat_logro_aprendizaje', 'usu_id', 'ccat_estado', 'ccat_estado_logico'], 'required'],
            [['hape_id', 'eaca_id', 'usu_id'], 'integer'],
            [['ccat_fecha_registro', 'ccat_fecha_creacion', 'ccat_fecha_modificacion'], 'safe'],
            [['ccat_titulo_unidad'], 'string', 'max' => 500],
            [['ccat_tema', 'ccat_trabajo_autopractico', 'ccat_logro_aprendizaje', 'ccat_observacion'], 'string', 'max' => 2000],
            [['ccat_direccion_ip'], 'string', 'max' => 20],
            [['ccat_estado', 'ccat_estado_logico'], 'string', 'max' => 1],
            [['hape_id'], 'exist', 'skipOnError' => true, 'targetClass' => HorarioAsignaturaPeriodo::className(), 'targetAttribute' => ['hape_id' => 'hape_id']],
            [['eaca_id'], 'exist', 'skipOnError' => true, 'targetClass' => EstudioAcademico::className(), 'targetAttribute' => ['eaca_id' => 'eaca_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ccat_id' => 'Ccat ID',
            'hape_id' => 'Hape ID',
            'eaca_id' => 'Eaca ID',
            'ccat_fecha_registro' => 'Ccat Fecha Registro',
            'ccat_titulo_unidad' => 'Ccat Titulo Unidad',
            'ccat_tema' => 'Ccat Tema',
            'ccat_trabajo_autopractico' => 'Ccat Trabajo Autopractico',
            'ccat_logro_aprendizaje' => 'Ccat Logro Aprendizaje',
            'ccat_observacion' => 'Ccat Observacion',
            'ccat_direccion_ip' => 'Ccat Direccion Ip',
            'usu_id' => 'Usu ID',
            'ccat_estado' => 'Ccat Estado',
            'ccat_fecha_creacion' => 'Ccat Fecha Creacion',
            'ccat_fecha_modificacion' => 'Ccat Fecha Modificacion',
            'ccat_estado_logico' => 'Ccat Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHape()
    {
        return $this->hasOne(HorarioAsignaturaPeriodo::className(), ['hape_id' => 'hape_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEaca()
    {
        return $this->hasOne(EstudioAcademico::className(), ['eaca_id' => 'eaca_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetalleCatedraActividads()
    {
        return $this->hasMany(DetalleCatedraActividad::className(), ['ccat_id' => 'ccat_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetalleValorDesarrollos()
    {
        return $this->hasMany(DetalleValorDesarrollo::className(), ['ccat_id' => 'ccat_id']);
    }
    
    /**
     * Function consultarMateriasMarcabyPro
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>    
     * @property integer $userid
     * @return  
     */
    public function consultarHorarioxhapeid($hape_id, $onlyData = false) {
        $con = \Yii::$app->db_academico;
        $con1 = \Yii::$app->db_asgard;
        $estado = 1;
        $sql = "
                    SELECT
                        hap.hape_hora_entrada as entrada,
                        hap.hape_hora_salida as salida,
                        hap.dia_id as dia,
                        hap.uaca_id as unidad,
                        hap.mod_id as modalidad,
                        asig.asi_nombre as materia,
                        hap.pro_id as profesor,
                        concat(pers.per_pri_nombre, ' ',pers.per_pri_apellido) as docente,
                        ifnull(CONCAT(sem.saca_anio,' (',blq.baca_nombre,'-',sem.saca_nombre,')'),sem.saca_anio) as periodo
                        FROM
                        db_academico.horario_asignatura_periodo hap
                        INNER JOIN " . $con->dbname . ".profesor prof ON prof.pro_id = hap.pro_id
                        INNER JOIN " . $con->dbname . ".asignatura asig ON asig.asi_id = hap.asi_id
                        INNER JOIN " . $con->dbname . ".periodo_academico paca ON paca.paca_id = hap.paca_id
                        LEFT JOIN " . $con->dbname . ".semestre_academico sem ON sem.saca_id = paca.saca_id
                        LEFT JOIN " . $con->dbname . ".bloque_academico blq ON blq.baca_id = paca.baca_id
                        INNER JOIN " . $con1->dbname . ".persona pers ON pers.per_id = prof.per_id
                        WHERE
                        DATE_FORMAT(hap.hape_fecha_clase,'%Y-%m-%d') is null AND paca_fecha_fin > now() AND paca_fecha_inicio <= now() AND
                        hap.hape_id = :hape_id AND
                        hap.hape_estado = :estado AND
                        hap.hape_estado_logico = :estado AND
                        prof.pro_estado = :estado AND
                        prof.pro_estado_logico = :estado AND
                        asig.asi_estado = :estado AND
                        asig.asi_estado_logico = :estado AND
                        paca.paca_activo = 'A' 
               ";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":hape_id", $hape_id, \PDO::PARAM_INT);
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
     * Function obtener Modalidad segun nivel interes estudio
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @property       
     * @return  
     */
    public function consultarActividadevaluacion() {
        $con = \Yii::$app->db_academico;
        $estado = 1;
        $sql = "SELECT ace.aeva_id as id,
                       ace.aeva_nombre as value
                    FROM " . $con->dbname . ".actividad_evaluacion ace                 
                    WHERE 
                    ace.aeva_estado_logico = :estado
                    and ace.aeva_estado = :estado                    
                    -- ORDER BY name asc";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $resultData = $comando->queryAll();
        return $resultData;
    }

    /**
     * Function obtener Modalidad segun nivel interes estudio
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @property       
     * @return  
     */
    public function consultarValordesarrollo() {
        $con = \Yii::$app->db_academico;
        $estado = 1;
        $sql = "SELECT vde.vdes_id as id,
                       vde.vdes_nombre as value
                    FROM " . $con->dbname . ".valor_desarrollo vde                 
                    WHERE 
                    vde.vdes_estado_logico = :estado
                    and vde.vdes_estado = :estado                    
                    -- ORDER BY name asc";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $resultData = $comando->queryAll();
        return $resultData;
    }

    /**
     * Function consultarControlCatedra
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>    
     * @property  
     * @return  
     */
    public function consultarControlCatedra($arrFiltro = array(), $onlyData = false) {
        $con = \Yii::$app->db_academico;
        $con1 = \Yii::$app->db_asgard;
        $estado_logico = 1;
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            \app\models\Utilities::putMessageLogFile('ingresa en filtros');
            $str_search .= "(per.per_pri_nombre like :profesor OR ";
            $str_search .= "per.per_seg_nombre like :profesor OR ";
            $str_search .= "per.per_pri_apellido like :profesor OR ";
            $str_search .= "per.per_seg_nombre like :profesor )  AND ";
            $str_search .= "asig.asi_nombre like :materia  AND ";

            if ($arrFiltro['f_ini'] != "" && $arrFiltro['f_fin'] != "") {
                 \app\models\Utilities::putMessageLogFile('ingresa fechas');
                $str_search .= "r.rmtm_fecha_transaccion >= :fec_ini AND ";
                $str_search .= "r.rmtm_fecha_transaccion <= :fec_fin AND ";
            }
            if ($arrFiltro['periodo'] != "" && $arrFiltro['periodo'] > 0) {
                \app\models\Utilities::putMessageLogFile('ingresa periodo');
                $str_search .= " h.paca_id = :periodo AND ";
            }
            if ($arrFiltro['unidad'] != "" && $arrFiltro['unidad'] > 0) {
                \app\models\Utilities::putMessageLogFile('ingresa unidad');
                $str_search .= " h.uaca_id = :unidad AND ";
            }
            if ($arrFiltro['modalidad'] != "" && $arrFiltro['modalidad'] > 0) {
                \app\models\Utilities::putMessageLogFile('ingresa modalidad');
                $str_search .= " h.mod_id = :modalidad AND ";
            }
            if ($arrFiltro['estado'] != "0") {
                \app\models\Utilities::putMessageLogFile('ingresa estado');
                $str_search .= " ifnull(c.ccat_id,'2') = :estadoM AND ";
            }
        }
        if ($onlyData == false) {
            $periodoacademico = 'h.paca_id as periodo, ';
            $grupoperi = ',periodo';
        }
        $sql = "SELECT  $periodoacademico
			CONCAT(ifnull(per.per_pri_nombre,' '), ' ', ifnull(per.per_pri_apellido,' ')) as nombres,
			asig.asi_nombre as materia,
                        u.uaca_nombre as unidad,
                        m.mod_nombre as modalidad,
                        concat(sa.saca_nombre, ' ', ba.baca_nombre, '-', ba.baca_anio) as periodo,
                        date_format(r.rmtm_fecha_transaccion,'%Y-%m-%d') as fecha,                
                        case when (ifnull(c.ccat_id, '2')) = '2' then 'Sin Registrar'                     
                             else 'Registrado' end as tipo              
                FROM " . $con->dbname . ".registro_marcacion_generada r left join " . $con->dbname . ".control_catedra c
                    on (r.hape_id = c.hape_id and date_format(r.rmtm_fecha_transaccion,'%Y-%m-%d') = date_format(c.ccat_fecha_registro,'%Y-%m-%d'))
                    INNER JOIN " . $con->dbname . ".horario_asignatura_periodo h on h.hape_id = r.hape_id
                    INNER JOIN " . $con->dbname . ".asignatura asig on asig.asi_id = h.asi_id
                    INNER JOIN " . $con->dbname . ".profesor profe on profe.pro_id = h.pro_id
                    INNER JOIN " . $con1->dbname . ".persona per on per.per_id = profe.per_id
                    INNER JOIN " . $con->dbname . ".periodo_academico peri on peri.paca_id = h.paca_id
                    INNER JOIN " . $con->dbname . ".unidad_academica u on u.uaca_id = h.uaca_id
                    INNER JOIN " . $con->dbname . ".modalidad m on m.mod_id = h.mod_id
                    INNER JOIN " . $con->dbname . ".semestre_academico sa on sa.saca_id = peri.saca_id
                    INNER JOIN " . $con->dbname . ".bloque_academico ba on ba.baca_id = peri.baca_id
                WHERE $str_search              
                      ((date_format(r.rmtm_fecha_transaccion, '%Y-%m-%d') <= date_format(curdate(),'%Y-%m-%d')
                      and date_format(r.rmtm_fecha_transaccion, '%Y-%m-%d') between peri.paca_fecha_inicio and peri.paca_fecha_fin))
                      and h.hape_estado = :estadologico and h.hape_estado_logico = :estadologico
                      and asig.asi_estado = :estadologico and asig.asi_estado_logico = :estadologico
                      and u.uaca_estado = :estadologico and u.uaca_estado_logico = :estadologico
                      and m.mod_estado = :estadologico and m.mod_estado_logico = :estadologico
                      and profe.pro_estado = :estadologico and profe.pro_estado_logico = :estadologico
                ORDER BY 6,7 asc";        
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estadologico", $estado_logico, \PDO::PARAM_STR);
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $search_cond = "%" . $arrFiltro["profesor"] . "%";
            $comando->bindParam(":profesor", $search_cond, \PDO::PARAM_STR);
            $fecha_ini = $arrFiltro["f_ini"] . " 00:00:00";
            $fecha_fin = $arrFiltro["f_fin"] . " 23:59:59";
            $materia = "%" . $arrFiltro["materia"] . "%";
            $comando->bindParam(":materia", $materia, \PDO::PARAM_STR);

            if ($arrFiltro['f_ini'] != "" && $arrFiltro['f_fin'] != "") {
                $comando->bindParam(":fec_ini", $fecha_ini, \PDO::PARAM_STR);
                $comando->bindParam(":fec_fin", $fecha_fin, \PDO::PARAM_STR);
            }
            if ($arrFiltro['periodo'] != "" && $arrFiltro['periodo'] > 0) {
                $periodo = $arrFiltro["periodo"];
                $comando->bindParam(":periodo", $periodo, \PDO::PARAM_INT);
            }
            if ($arrFiltro['unidad'] != "" && $arrFiltro['unidad'] > 0) {
                $unidad = $arrFiltro["unidad"];
                $comando->bindParam(":unidad", $unidad, \PDO::PARAM_INT);
            }
            if ($arrFiltro['modalidad'] != "" && $arrFiltro['modalidad'] > 0) {
                $modalidad = $arrFiltro["modalidad"];
                $comando->bindParam(":modalidad", $modalidad, \PDO::PARAM_INT);
            }
            if ($arrFiltro['estado'] != "0") {
                $estadoM = $arrFiltro["estado"];
                $comando->bindParam(":estadoM", $estadoM, \PDO::PARAM_STR);
            }
        }
        \app\models\Utilities::putMessageLogFile('query:' . $sql);
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
}
