<?php

namespace app\modules\academico\models;

use Yii;
use yii\data\ArrayDataProvider;

/**
 * This is the model class for table "periodo_academico_met_ingreso".
 *
 * @property int $pami_id
 * @property int $pami_anio
 * @property int $pami_mes
 * @property int $ming_id
 * @property string $pami_fecha_inicio
 * @property string $pami_fecha_fin
 * @property string $pami_codigo
 * @property int $pami_usuario_ingreso
 * @property int $pami_usuario_modifica
 * @property string $pami_estado
 * @property string $pami_fecha_creacion
 * @property string $pami_fecha_modificacion
 * @property string $pami_estado_logico
 *
 * @property Paralelo[] $paralelos
 * @property PlanificacionEstudioAcademico[] $planificacionEstudioAcademicos
 */
class PeriodoAcademicoMetIngreso extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'periodo_academico_met_ingreso';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb() {
        return Yii::$app->get('db_academico');
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['pami_anio', 'pami_mes', 'ming_id', 'pami_usuario_ingreso', 'pami_usuario_modifica'], 'integer'],
            [['ming_id', 'pami_codigo', 'pami_usuario_ingreso', 'pami_estado', 'pami_estado_logico'], 'required'],
            [['pami_fecha_inicio', 'pami_fecha_fin', 'pami_fecha_creacion', 'pami_fecha_modificacion'], 'safe'],
            [['pami_codigo'], 'string', 'max' => 10],
            [['pami_estado', 'pami_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'pami_id' => 'Pami ID',
            'pami_anio' => 'Pami Anio',
            'pami_mes' => 'Pami Mes',
            'ming_id' => 'Ming ID',
            'pami_fecha_inicio' => 'Pami Fecha Inicio',
            'pami_fecha_fin' => 'Pami Fecha Fin',
            'pami_codigo' => 'Pami Codigo',
            'pami_usuario_ingreso' => 'Pami Usuario Ingreso',
            'pami_usuario_modifica' => 'Pami Usuario Modifica',
            'pami_estado' => 'Pami Estado',
            'pami_fecha_creacion' => 'Pami Fecha Creacion',
            'pami_fecha_modificacion' => 'Pami Fecha Modificacion',
            'pami_estado_logico' => 'Pami Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParalelos() {
        return $this->hasMany(Paralelo::className(), ['pami_id' => 'pami_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlanificacionEstudioAcademicos() {
        return $this->hasMany(PlanificacionEstudioAcademico::className(), ['pami_id' => 'pami_id']);
    }

    /**
     * Function listarPeriodos
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  $resultData (información de los períodos por método de ingreso en online.)
     */
    public function listarPeriodos($arrFiltro = array(), $onlyData = false) {
        $con = \Yii::$app->db_academico;
        $con1 = \Yii::$app->db_captacion;
        $estado = 1;

        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $str_search = "(pami_codigo like :search OR ";
            $str_search .= "pami_anio like :search) AND";
            if ($arrFiltro['mes'] != "" && $arrFiltro['mes'] > 0) {
                $str_search .= " pami_mes = :mes AND";
            }
            if ($arrFiltro['f_ini'] != "" && $arrFiltro['f_fin'] != "") {
                $str_search .= "  pami_fecha_inicio >= :fec_ini AND";
                $str_search .= "  pami_fecha_fin <= :fec_fin AND";
            }
        }

        $sql = "SELECT  pami_id, 
                        pami_anio anio, 
                        pami_mes mes, 
                        pami_codigo codigo,
                        ming.ming_descripcion metodo, 	   
                        Date_format(pami_fecha_inicio, '%Y-%m-%d') fecha_inicial, 
                        Date_format(pami_fecha_fin, '%Y-%m-%d') fecha_final,
                        ifnull((select count(*) FROM db_academico.paralelo par WHERE par.pami_id = pami.pami_id),0) paralelos
                FROM " . $con->dbname . ".periodo_academico_met_ingreso pami inner join " . $con1->dbname . ".metodo_ingreso ming on ming.ming_id = pami.ming_id
                WHERE 
                           $str_search
                           pami_estado = :estado AND 
                           pami_estado_logico = :estado AND
                           ming_estado = :estado AND 
                           ming_estado_logico = :estado
                ORDER BY pami_fecha_inicio DESC";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $search_cond = "%" . $arrFiltro["search"] . "%";
            $fecha_ini = $arrFiltro["f_ini"];
            $fecha_fin = $arrFiltro["f_fin"];
            $mes = $arrFiltro["mes"];
            $comando->bindParam(":search", $search_cond, \PDO::PARAM_STR);
            if ($arrFiltro['mes'] != "" && $arrFiltro['mes'] > 0) {
                $comando->bindParam(":mes", $mes, \PDO::PARAM_INT);
            }
            if ($arrFiltro['f_ini'] != "" && $arrFiltro['f_fin'] != "") {
                $comando->bindParam(":fec_ini", $fecha_ini, \PDO::PARAM_STR);
                $comando->bindParam(":fec_fin", $fecha_fin, \PDO::PARAM_STR);
            }
        }
        $resultData = $comando->queryall();
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
        if ($onlyData) {
            return $resultData;
        } else {
            return $dataProvider;
        }
    }

    /**
     * Function insertarPeriodo (Registro de los períodos por método de ingreso)
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  
     */
    public function insertarPeriodo($anio, $mes, $uaca_id, $mod_id, $ming, $codigo, $fec_inicial, $fec_final, $usu_ingreso) {
        $con = \Yii::$app->db_academico;

        $param_sql = "pami_estado_logico";
        $bper_sql = "1";

        $param_sql .= ", pami_estado";
        $bper_sql .= ", 1";

        if (isset($anio)) {
            $param_sql .= ", pami_anio";
            $bper_sql .= ", :pami_anio";
        }

        if (isset($mes)) {
            $param_sql .= ", pami_mes";
            $bper_sql .= ", :pami_mes";
        }

        if (isset($uaca_id)) {
            $param_sql .= ", uaca_id";
            $bper_sql .= ", :uaca_id";
        }

        if (isset($mod_id)) {
            $param_sql .= ", mod_id";
            $bper_sql .= ", :mod_id";
        }

        if (isset($ming)) {
            $param_sql .= ", ming_id";
            $bper_sql .= ", :ming_id";
        }

        if (isset($codigo)) {
            $param_sql .= ", pami_codigo";
            $bper_sql .= ", :pami_codigo";
        }

        if (isset($fec_inicial)) {
            $param_sql .= ", pami_fecha_inicio";
            $bper_sql .= ", :pami_fecha_inicio";
        }

        if (isset($fec_final)) {
            $param_sql .= ", pami_fecha_fin";
            $bper_sql .= ", :pami_fecha_fin";
        }

        if (isset($usu_ingreso)) {
            $param_sql .= ", pami_usuario_ingreso";
            $bper_sql .= ", :pami_usuario_ingreso";
        }

        try {
            $sql = "INSERT INTO " . $con->dbname . ".periodo_academico_met_ingreso ($param_sql) VALUES($bper_sql)";
            $comando = $con->createCommand($sql);

            if (isset($anio))
                $comando->bindParam(':pami_anio', $anio, \PDO::PARAM_INT);

            if (isset($mes))
                $comando->bindParam(':pami_mes', $mes, \PDO::PARAM_INT);

            if (isset($uaca_id))
                $comando->bindParam(':uaca_id', $uaca_id, \PDO::PARAM_INT);

            if (isset($mod_id))
                $comando->bindParam(':mod_id', $mod_id, \PDO::PARAM_INT);

            if (isset($ming))
                $comando->bindParam(':ming_id', $ming, \PDO::PARAM_INT);

            if (isset($codigo))
                $comando->bindParam(':pami_codigo', $codigo, \PDO::PARAM_STR);

            if (isset($fec_inicial))
                $comando->bindParam(':pami_fecha_inicio', $fec_inicial, \PDO::PARAM_STR);

            if (isset($fec_final))
                $comando->bindParam(':pami_fecha_fin', $fec_final, \PDO::PARAM_STR);

            if (isset($usu_ingreso))
                $comando->bindParam(':pami_usuario_ingreso', $usu_ingreso, \PDO::PARAM_INT);

            $result = $comando->execute();
            return $con->getLastInsertID($con->dbname . '.periodo_academico_met_ingreso');
        } catch (Exception $ex) {
            return FALSE;
        }
    }

    /**
     * Function VerificarPeriodo
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  $resultData (Verificar que no se repita los datos principales de período por método ingreso.)
     */
    public function VerificarPeriodo($anio, $mes, $uaca, $mod, $ming) {
        $con = \Yii::$app->db_academico;
        $estado = 1;

        $sql = "SELECT 'S' existe
                FROM " . $con->dbname . ".periodo_academico_met_ingreso pmin
                WHERE pmin.pami_anio = :anio
                and pmin.pami_mes = :mes
                and pmin.uaca_id = :uaca
                and pmin.mod_id = :mod
                and pmin.ming_id = :ming                
                and pmin.pami_estado_logico = :estado
                and pmin.pami_estado = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":anio", $anio, \PDO::PARAM_INT);
        $comando->bindParam(":mes", $mes, \PDO::PARAM_INT);
        $comando->bindParam(":uaca", $uaca, \PDO::PARAM_INT);
        $comando->bindParam(":mod", $mod, \PDO::PARAM_INT);
        $comando->bindParam(":ming", $ming, \PDO::PARAM_INT);

        $resultData = $comando->queryOne();
        return $resultData;
    }

    /**
     * Function consulta los periodos. 
     * @author Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarPeriodo() {
        $con = \Yii::$app->db_academico;
        $estado = 1;
        $sql = "SELECT 
                   pera.pami_id as id,
                   pera.pami_codigo as name
                FROM 
                   " . $con->dbname . ".periodo_academico_met_ingreso  pera WHERE ";
        $sql .= "  pera.pami_estado = :estado AND
                   pera.pami_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $resultData = $comando->queryAll();
        return $resultData;
    }

}
