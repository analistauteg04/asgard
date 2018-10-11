<?php

namespace app\modules\academico\models;

use Yii;
use yii\data\ArrayDataProvider;

/**
 * This is the model class for table "matriculacion".
 *
 * @property int $mat_id
 * @property int $daca_id
 * @property int $asp_id
 * @property int $est_id
 * @property int $sins_id
 * @property string $mat_fecha_matriculacion
 * @property int $mat_usuario_ingreso
 * @property int $mat_usuario_modifica
 * @property string $mat_estado
 * @property string $mat_fecha_creacion
 * @property string $mat_fecha_modificacion
 * @property string $mat_estado_logico
 *
 * @property AsignacionParalelo[] $asignacionParalelos
 * @property DistributivoAcademico $daca
 * @property Estudiante $est
 */
class Matriculacion extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'matriculacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['daca_id', 'asp_id', 'est_id', 'sins_id', 'mat_usuario_ingreso', 'mat_usuario_modifica'], 'integer'],
            [['mat_fecha_matriculacion', 'mat_fecha_creacion', 'mat_fecha_modificacion'], 'safe'],
            [['mat_usuario_ingreso', 'mat_estado', 'mat_estado_logico'], 'required'],
            [['mat_estado', 'mat_estado_logico'], 'string', 'max' => 1],
            [['daca_id'], 'exist', 'skipOnError' => true, 'targetClass' => DistributivoAcademico::className(), 'targetAttribute' => ['daca_id' => 'daca_id']],
            [['est_id'], 'exist', 'skipOnError' => true, 'targetClass' => Estudiante::className(), 'targetAttribute' => ['est_id' => 'est_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'mat_id' => 'Mat ID',
            'daca_id' => 'Daca ID',
            'asp_id' => 'Asp ID',
            'est_id' => 'Est ID',
            'sins_id' => 'Sins ID',
            'mat_fecha_matriculacion' => 'Mat Fecha Matriculacion',
            'mat_usuario_ingreso' => 'Mat Usuario Ingreso',
            'mat_usuario_modifica' => 'Mat Usuario Modifica',
            'mat_estado' => 'Mat Estado',
            'mat_fecha_creacion' => 'Mat Fecha Creacion',
            'mat_fecha_modificacion' => 'Mat Fecha Modificacion',
            'mat_estado_logico' => 'Mat Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function consultarMetodosIngreso($arrFiltro = array(), $onlyData = false) {
        $con_aca = \Yii::$app->db_academico;
        $con_cap = \Yii::$app->db_captacion;
        $estado = 1;

        $columnsAdd = "";
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $str_search .= "pg.pges_seg_apellido like :search)  AND ";
            if ($arrFiltro['estado'] != "" && $arrFiltro['estado'] > 0) {
                $str_search .= " pg.econ_id = :estcontacto AND ";
            }
        } else {
            $columnsAdd = "                
                pg.pges_pri_nombre as pges_pri_nombre,
                pg.pges_seg_nombre as pges_seg_nombre,
                pg.pges_pri_apellido as pges_pri_apellido,
                pg.pges_seg_apellido as pges_seg_apellido,";
        }
        $sql = "
                ";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);

        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $search_cond = "%" . $arrFiltro["search"] . "%";
            $comando->bindParam(":search", $search_cond, \PDO::PARAM_STR);

            if ($arrFiltro['estado'] != "" && $arrFiltro['estado'] > 0) {
                $estcontacto = $arrFiltro["estado"];
                $comando->bindParam(":estcontacto", $estcontacto, \PDO::PARAM_INT);
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

        if ($onlyData) {
            return $resultData;
        } else {
            return $dataProvider;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsignacionParalelos() {
        return $this->hasMany(AsignacionParalelo::className(), ['mat_id' => 'mat_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDaca() {
        return $this->hasOne(DistributivoAcademico::className(), ['daca_id' => 'daca_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEst() {
        return $this->hasOne(Estudiante::className(), ['est_id' => 'est_id']);
    }
    
    public function insertarMatriculacion($peac_id, $adm_id, $est_id, $sins_id, $mat_fecha_matriculacion, $mat_usuario_ingreso) {

        $con = \Yii::$app->db_academico;       
        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }
        $param_sql = "mat_estado_logico";
        $bsol_sql = "1";

        $param_sql .= ", mat_estado";
        $bsol_sql .= ", 1";
        if (isset($daca_id)) {
            $param_sql .= ", peac_id";
            $bsol_sql .= ", :peac_id";
        }

        if (isset($adm_id)) {
            $param_sql .= ", adm_id";
            $bsol_sql .= ", :adm_id";
        }

        if (isset($est_id)) {
            $param_sql .= ", est_id";
            $bsol_sql .= ", :est_id";
        }

        if (isset($sins_id)) {
            $param_sql .= ", sins_id";
            $bsol_sql .= ", :sins_id";
        }

        if (isset($mat_fecha_matriculacion)) {
            $param_sql .= ", mat_fecha_matriculacion";
            $bsol_sql .= ", :mat_fecha_matriculacion";
        }
        if (isset($mat_usuario_ingreso)) {
            $param_sql .= ", mat_usuario_ingreso";
            $bsol_sql .= ", :mat_usuario_ingreso";
        }        
        
        try {
            $sql = "INSERT INTO " . $con->dbname . ".matriculacion ($param_sql) VALUES($bsol_sql)";
            $comando = $con->createCommand($sql);

            if (isset($daca_id))
                $comando->bindParam(':peac_id', $peac_id, \PDO::PARAM_INT);

            if (isset($adm_id))
                $comando->bindParam(':adm_id', $adm_id, \PDO::PARAM_INT);

            if (isset($est_id))
                $comando->bindParam(':est_id', $est_id, \PDO::PARAM_INT);

            if (isset($sins_id))
                $comando->bindParam(':sins_id', $sins_id, \PDO::PARAM_INT);

            if (isset($mat_fecha_matriculacion))
                $comando->bindParam(':mat_fecha_matriculacion', $mat_fecha_matriculacion, \PDO::PARAM_STR);

            if (isset($mat_usuario_ingreso))
                $comando->bindParam(':mat_usuario_ingreso', $mat_usuario_ingreso, \PDO::PARAM_INT);

            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.matriculacion');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }
    
    
    public function insertarAsignacionxMeting($par_id, $mat_id, $mest_id, $apar_descripcion, $apar_fecha_asignacion, $apar_usuario_asignacion) {

        $con = \Yii::$app->db_academico;       
        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }
                
        $param_sql = "apar_estado_logico";
        $bsol_sql = "1";

        $param_sql .= ", apar_estado";
        $bsol_sql .= ", 1";
        if (isset($par_id)) {
            $param_sql .= ", par_id";
            $bsol_sql .= ", :par_id";
        }

        if (isset($mat_id)) {
            $param_sql .= ", mat_id";
            $bsol_sql .= ", :mat_id";
        }

        if (isset($mest_id)) {
            $param_sql .= ", mest_id";
            $bsol_sql .= ", :mest_id";
        }

        if (isset($apar_descripcion)) {
            $param_sql .= ", apar_descripcion";
            $bsol_sql .= ", :apar_descripcion";
        }

        if (isset($apar_fecha_asignacion)) {
            $param_sql .= ", apar_fecha_asignacion";
            $bsol_sql .= ", :apar_fecha_asignacion";
        }
        if (isset($apar_usuario_asignacion)) {
            $param_sql .= ", apar_usuario_asignacion";
            $bsol_sql .= ", :apar_usuario_asignacion";
        }        
        
        try {
            $sql = "INSERT INTO " . $con->dbname . ".asignacion_paralelo ($param_sql) VALUES($bsol_sql)";
            $comando = $con->createCommand($sql);   
            if (isset($par_id))
                $comando->bindParam(':par_id', $par_id, \PDO::PARAM_INT);

            if (isset($mat_id))
                $comando->bindParam(':mat_id', $mat_id, \PDO::PARAM_INT);

            if (isset($mest_id))
                $comando->bindParam(':mest_id', $mest_id, \PDO::PARAM_INT);

            if (isset($apar_descripcion))
                $comando->bindParam(':apar_descripcion', $apar_descripcion, \PDO::PARAM_STR);

            if (isset($apar_fecha_asignacion))
                $comando->bindParam(':apar_fecha_asignacion', $apar_fecha_asignacion, \PDO::PARAM_STR);

            if (isset($apar_usuario_asignacion))
                $comando->bindParam(':apar_usuario_asignacion', $apar_usuario_asignacion, \PDO::PARAM_INT);

            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.asignacion_paralelo');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }
    
     /**
     * Function consultaPeriodoAcademico
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  $resultData (Retornar los períodos académicos de los métodos de ingreso).
     */
    public function consultaPeriodoAcademico($uaca_id, $mod_id, $eaca_id) {
        $con = \Yii::$app->db_academico;
        $estado = 1;

        $sql = "SELECT pmi.pami_id id, pmi.pami_codigo value
                FROM " . $con->dbname . ".periodo_academico_met_ingreso pmi inner join " . $con->dbname . ".planificacion_estudio_academico pea
                        on pea.pami_id = pmi.pami_id 
                    INNER JOIN " . $con->dbname . ".malla_academica ma on ma.maca_id = pea.maca_id
                WHERE pea.uaca_id = :uaca_id AND
                      pea.mod_id = :mod_id AND
                      ma.eaca_id = :eaca_id AND
                      pmi.pami_estado_logico = :estado AND
                      pmi.pami_estado = :estado AND
                      pea.peac_estado = :estado AND
                      pea.peac_estado_logico = :estado
                ORDER BY pmi.pami_id";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":eaca_id", $eaca_id, \PDO::PARAM_INT);
        $comando->bindParam(":mod_id", $mod_id, \PDO::PARAM_INT);
        $comando->bindParam(":uaca_id", $uaca_id, \PDO::PARAM_INT);
        $resultData = $comando->queryAll();
        return $resultData;
    }
    
    /**
     * Function consultaPeriodoAcademico
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  $resultData (Retornar los períodos académicos).
     */
    public function consultaParalelo() {
        $con = \Yii::$app->db_academico;
        $estado = 1;

        $sql = "SELECT par_id id, par_nombre value
                FROM " . $con->dbname . ".paralelo
                WHERE pami_id is not null AND
                      par_estado = :estado AND
                      par_estado_logico = :estado
                ORDER BY value asc";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);       
        $resultData = $comando->queryAll();
        return $resultData;
    }

    /**
     * Function consultaPeriodoAcademico
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  $resultData (Retornar los períodos académicos de los métodos de ingreso).
     */
    public function consultaMatriculaxId($adm_id, $sins_id) {
        $con = \Yii::$app->db_academico;
        $estado = 1;

        $sql = "SELECT 'S' existe 
                FROM " . $con->dbname . ".matriculacion m
                WHERE adm_id = :adm_id
                    and sins_id = :sins_id
                    and mat_estado = :estado
                    and mat_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":adm_id", $adm_id, \PDO::PARAM_INT);
        $comando->bindParam(":sins_id", $sins_id, \PDO::PARAM_INT);        
        $resultData = $comando->queryOne();
        return $resultData;
    }
}
