<?php

namespace app\modules\academico\models;

use Yii;
use yii\data\ArrayDataProvider;
use yii\base\Exception;

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
        if (isset($peac_id)) {
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

            if (isset($peac_id))
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
     * Function consultarPeriodoAcadMing
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  $resultData (Retornar los períodos académicos de los métodos de ingreso).
     */
    public function consultarPeriodoAcadMing($uaca_id, $mod_id, $ming_id) {
        $con = \Yii::$app->db_academico;
        $estado = 1;

        $sql = "SELECT pmi.pami_id id, pmi.pami_codigo name
                FROM " . $con->dbname . ".periodo_academico_met_ingreso pmi                     
                WHERE pmi.uaca_id = :uaca_id AND
                      pmi.mod_id = :mod_id AND
                      pmi.ming_id = :ming_id AND
                      pmi.pami_estado_logico = :estado AND
                      pmi.pami_estado = :estado                    
                ";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":ming_id", $ming_id, \PDO::PARAM_INT);
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
    public function consultarParalelo($pami_id) {
        $con = \Yii::$app->db_academico;
        $estado = 1;

        $sql = "SELECT par_id id, par_nombre name
                FROM " . $con->dbname . ".paralelo
                WHERE pami_id = :pami_id AND
                      par_estado = :estado AND
                      par_estado_logico = :estado
                ORDER BY 2 asc";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);       
        $comando->bindParam(":pami_id", $pami_id, \PDO::PARAM_INT);       
        $resultData = $comando->queryAll();
        return $resultData;
    }

    /**
     * Function consultaPeriodoAcademico
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  $resultData (Retornar los períodos académicos de los métodos de ingreso).
     */
    public function consultarMatriculaxId($adm_id, $sins_id) {
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
    
    /**
     * Function consultarPlanificacion
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  $resultData (Retornar el código de planificación académica.).
     */
    public function consultarPlanificacion($sins_id, $periodo_id) {
        $con = \Yii::$app->db_academico;
        $con1 = \Yii::$app->db_captacion;
        $estado = 1;

        $sql = "SELECT pea.peac_id 
                FROM " . $con1->dbname . ".solicitud_inscripcion si inner join " . $con->dbname . ".malla_academica ma 
                           on (si.uaca_id = ma.uaca_id and si.mod_id = ma.mod_id and si.eaca_id = ma.eaca_id)
                       inner join " . $con->dbname . ".planificacion_estudio_academico pea 
                           on (pea.maca_id = ma.maca_id and pea.pami_id = :periodo_id)
                where si.sins_id = :sins_id
                and si.sins_estado = :estado
                and si.sins_estado_logico = :estado
                and ma.maca_estado = :estado
                and ma.maca_estado_logico = :estado
                and pea.peac_estado = :estado
                and pea.peac_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":periodo_id", $periodo_id, \PDO::PARAM_INT);
        $comando->bindParam(":sins_id", $sins_id, \PDO::PARAM_INT);        
        $resultData = $comando->queryOne();
        return $resultData;
    }

    /**************************************** FUNCIONES AGREGADAS PARA REGISTRO EN LINEA ********************************************/

    /**
     * Function to check if today is between process inscription dates
     * @author Emilio Moran <emiliojmp9@gmail.com>
     * @param $date
     * @return $resultData
     */
    public function checkToday($date)
    {
        $con = \Yii::$app->db_academico;
        $estado = 1;

        $sql = "
            SELECT rco_id, pla_id, rco_num_bloques
            FROM " . $con->dbname . ".registro_configuracion as reg_conf
            WHERE :date
            BETWEEN reg_conf.rco_fecha_inicio AND reg_conf.rco_fecha_fin
            AND rco_estado =:estado
            AND rco_estado_logico =:estado
        ";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":date", $date, \PDO::PARAM_STR);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $resultData = $comando->queryAll();
        return $resultData;
    }


    /**
     * Function to get data student from planificacion, planificacion_estudiante and persona
     * @author Emilio Moran <emiliojmp9@gmail.com>
     * @param $per_id, $pla_id, $pes_id
     * @return $resultData
     */

    public function getDataStudent($per_id, $pla_id, $pes_id)
    {
        $con_academico = \Yii::$app->db_academico;
        $con_asgard = \Yii::$app->db_asgard;
        /*$con_utegsea = \Yii::$app->utegsea;*/
        $estado = 1;

        $sql = "
            SELECT pla.pla_periodo_academico, pes.pes_nombres, pes.pes_dni, moda.mod_nombre, pes.pes_carrera, per.per_celular
            FROM " . $con_academico->dbname . ".planificacion as pla,
            " . $con_academico->dbname . ".planificacion_estudiante as pes,
            " . $con_academico->dbname . ".modalidad as moda,
            " . $con_asgard->dbname . ".persona as per
            WHERE pla.mod_id = moda.mod_id
            AND pes.per_id = per.per_id            
            AND per.per_id =:per_id
            AND pla.pla_id =:pla_id
            AND pes.pes_id =:pes_id;
        ";

        $comando = $con_academico->createCommand($sql);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
        $comando->bindParam(":pla_id", $pla_id, \PDO::PARAM_INT);
        $comando->bindParam(":pes_id", $pes_id, \PDO::PARAM_INT);
        $resultData = $comando->queryOne();

        return $resultData;
    }

    /**
     * Function to get data from planificacion_estudiante
     * @author Emilio Moran <emiliojmp9@gmail.com>
     * @param $per_id, $pla_id, $rco_num_bloques
     * @return $dataPlanificacion
     */
    public function getAllDataPlanificacionEstudiante($per_id, $pla_id)
    {
        $con_academico = \Yii::$app->db_academico;
        $estado = 1;

        $str_bloques = "pes.pes_mat_b1_h1_nombre, pes.pes_mat_b1_h2_nombre, pes.pes_mat_b1_h3_nombre, pes.pes_mat_b1_h4_nombre, pes.pes_mat_b1_h5_nombre, pes.pes_mat_b2_h1_nombre, pes.pes_mat_b2_h2_nombre, pes.pes_mat_b2_h3_nombre, pes.pes_mat_b2_h4_nombre, pes.pes_mat_b2_h5_nombre";

        $sql = "
            SELECT pes_dni, " . $str_bloques . "
            FROM " . $con_academico->dbname . ".planificacion_estudiante as pes            
            WHERE pes.per_id =:per_id
            AND pes.pla_id =:pla_id;
        ";

        $comando = $con_academico->createCommand($sql);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
        $comando->bindParam(":pla_id", $pla_id, \PDO::PARAM_INT);
        $resultData = $comando->queryOne();
        $dataPlanificacion = $this->parseDataSubject($resultData);

        return $dataPlanificacion;
    }

    /**
     * Function to get parse into array the information about subjects
     * @author Emilio Moran <emiliojmp9@gmail.com>
     * @param $dict, $num
     * @return $arrData
     */

    public function parseDataSubject($dict)
    {
        $arrData = array();

        if (!is_null($dict['pes_mat_b1_h1_nombre']) && trim($dict['pes_mat_b1_h1_nombre']) != "") {
            $arrRow11 = array(
                "Subject" => trim($dict['pes_mat_b1_h1_nombre']),
                "Block" => "B1",
                "Hour" => "H1",
            );
            array_push($arrData, $arrRow11);
        }

        if (!is_null($dict['pes_mat_b1_h2_nombre']) && trim($dict['pes_mat_b1_h2_nombre']) != "") {
            $arrRow12 = array(
                "Subject" => trim($dict['pes_mat_b1_h2_nombre']),
                "Block" => "B1",
                "Hour" => "H2",
            );
            array_push($arrData, $arrRow12);
        }

        if (!is_null($dict['pes_mat_b1_h3_nombre']) && trim($dict['pes_mat_b1_h3_nombre']) != "") {
            $arrRow13 = array(
                "Subject" => trim($dict['pes_mat_b1_h3_nombre']),
                "Block" => "B1",
                "Hour" => "H3",
            );
            array_push($arrData, $arrRow13);
        }

        if (!is_null($dict['pes_mat_b1_h4_nombre']) && trim($dict['pes_mat_b1_h4_nombre']) != "") {
            $arrRow14 = array(
                "Subject" => trim($dict['pes_mat_b1_h4_nombre']),
                "Block" => "B1",
                "Hour" => "H4",
            );
            array_push($arrData, $arrRow14);
        }

        if (!is_null($dict['pes_mat_b1_h5_nombre']) && trim($dict['pes_mat_b1_h5_nombre']) != "") {
            $arrRow15 = array(
                "Subject" => trim($dict['pes_mat_b1_h5_nombre']),
                "Block" => "B1",
                "Hour" => "H5",
            );
            array_push($arrData, $arrRow15);
        }

        if (!is_null($dict['pes_mat_b2_h1_nombre']) && trim($dict['pes_mat_b2_h1_nombre']) != "") {
            $arrRow21 = array(
                "Subject" => trim($dict['pes_mat_b2_h1_nombre']),
                "Block" => "B2",
                "Hour" => "H1",
            );
            array_push($arrData, $arrRow21);
        }

        if (!is_null($dict['pes_mat_b2_h2_nombre']) && trim($dict['pes_mat_b2_h2_nombre']) != "") {
            $arrRow22 = array(
                "Subject" => trim($dict['pes_mat_b2_h2_nombre']),
                "Block" => "B2",
                "Hour" => "H2",
            );
            array_push($arrData, $arrRow22);
        }

        if (!is_null($dict['pes_mat_b2_h3_nombre']) && trim($dict['pes_mat_b2_h3_nombre']) != "") {
            $arrRow23 = array(
                "Subject" => trim($dict['pes_mat_b2_h3_nombre']),
                "Block" => "B2",
                "Hour" => "H3",
            );
            array_push($arrData, $arrRow23);
        }

        if (!is_null($dict['pes_mat_b2_h4_nombre']) && trim($dict['pes_mat_b2_h4_nombre']) != "") {
            $arrRow24 = array(
                "Subject" => trim($dict['pes_mat_b2_h4_nombre']),
                "Block" => "B2",
                "Hour" => "H4",
            );
            array_push($arrData, $arrRow24);
        }

        if (!is_null($dict['pes_mat_b2_h5_nombre']) && trim($dict['pes_mat_b2_h5_nombre']) != "") {
            $arrRow25 = array(
                "Subject" => trim($dict['pes_mat_b2_h5_nombre']),
                "Block" => "B2",
                "Hour" => "H5",
            );
            array_push($arrData, $arrRow25);
        }
        return $arrData;
    }
    
    /**
     * Function to get the id from planificacion_estudiante
     * @author Emilio Moran <emiliojmp9@gmail.com>
     * @param $per_id, $pla_id
     * @return $resultData
     */
    public function getIdPlanificacionEstudiante($per_id, $pla_id)
    {
        $con_academico = \Yii::$app->db_academico;
        $estado = 1;

        $sql = "
            SELECT pes_id, pla_id
            FROM " . $con_academico->dbname . ".planificacion_estudiante as pes
            WHERE pes.per_id=:per_id
            -- AND pes.pla_id=:pla_id
            AND pes.pes_estado=:estado
            AND pes.pes_estado_logico=:estado;
        ";

        $comando = $con_academico->createCommand($sql);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
        $comando->bindParam(":pla_id", $pla_id, \PDO::PARAM_INT);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $resultData = $comando->queryAll();

        return $resultData;
    }

    /**
     * Function to check if a exist a planificacion_estudianto in registro_online to /matriculacion/index without import the ron_estado_registro value
     * @author Emilio Moran <emiliojmp9@gmail.com>
     * @param $per_id, $pes_id
     * @return $resultData
     */
    public function checkPlanificacionEstudianteRegisterConfiguracion($per_id, $pes_id, $pla_id)
    {
        $con_academico = \Yii::$app->db_academico;
        $estado = 1;

        $sql = "
            SELECT ron_id, ron_estado_registro
            FROM " . $con_academico->dbname . ".registro_online as ron,
            " . $con_academico->dbname . ".registro_configuracion as rco
            WHERE ron.ron_fecha_registro
            BETWEEN rco.rco_fecha_inicio AND rco.rco_fecha_fin
            AND rco.pla_id = :pla_id
            AND ron.per_id=:per_id
            AND ron.pes_id=:pes_id
            AND ron.ron_estado=:estado
            AND ron.ron_estado_logico=:estado;
        ";

        $comando = $con_academico->createCommand($sql);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
        $comando->bindParam(":pes_id", $pes_id, \PDO::PARAM_INT);
        $comando->bindParam(":pla_id", $pla_id, \PDO::PARAM_INT);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $resultData = $comando->queryAll();

        return $resultData;
    }

    /**
     * Function to check if a exist a planificacion_estudianto in registro_online to /matriculacion/register with ron_estado_registro equals 1
     * @author Emilio Moran <emiliojmp9@gmail.com>
     * @param $per_id, $pes_id
     * @return $resultData
     */
    public function checkPlanificacionEstudianteRegisterConfiguracionRegistro($per_id, $pes_id)
    {
        $con_academico = \Yii::$app->db_academico;
        $estado = 1;

        $sql = "
            SELECT ron_id, ron_estado_registro
            FROM " . $con_academico->dbname . ".registro_online as ron,
            " . $con_academico->dbname . ".registro_configuracion as rco
            WHERE ron.ron_fecha_registro
            BETWEEN rco.rco_fecha_inicio AND rco.rco_fecha_fin
            AND ron.per_id=:per_id
            AND ron.pes_id=:pes_id
            AND ron.ron_estado_registro=:estado
            AND ron.ron_estado=:estado
            AND ron.ron_estado_logico=:estado;
        ";

        $comando = $con_academico->createCommand($sql);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
        $comando->bindParam(":pes_id", $pes_id, \PDO::PARAM_INT);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $resultData = $comando->queryAll();

        return $resultData;
    }

    /**
     * Function to check if a exist a planificacion_estudianto in registro_online to /matriculacion/register with ron_estado_registro equals 1
     * @author Emilio Moran <emiliojmp9@gmail.com>
     * @param $per_id, $pes_id
     * @return $resultData
     */
    public function checkPlanificacionEstudianteRegisterConfiguracionSolicitud($per_id, $pes_id)
    {
        $con_academico = \Yii::$app->db_academico;
        $estado = 1;
        $estado_registro = 0;

        $sql = "
            SELECT ron_id, ron_estado_registro
            FROM " . $con_academico->dbname . ".registro_online as ron,
            " . $con_academico->dbname . ".registro_configuracion as rco
            WHERE ron.ron_fecha_registro
            BETWEEN rco.rco_fecha_inicio AND rco.rco_fecha_fin
            AND ron.per_id=:per_id
            AND ron.pes_id=:pes_id
            AND ron.ron_estado_registro=:estado_registro
            AND ron.ron_estado=:estado
            AND ron.ron_estado_logico=:estado;
        ";

        $comando = $con_academico->createCommand($sql);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
        $comando->bindParam(":pes_id", $pes_id, \PDO::PARAM_INT);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":estado_registro", $estado_registro, \PDO::PARAM_STR);
        $resultData = $comando->queryAll();

        return $resultData;
    }

    /**
     * Function to get data student when exist a register into registro_online
     * @author Emilio Moran <emiliojmp9@gmail.com>
     * @param $ron_id
     * @return $resultData
     */
    public function getDataStudenFromRegistroOnline($per_id, $pes_id)
    {
        $con_asgard = \Yii::$app->db_asgard;
        $con_academico = \Yii::$app->db_academico;
        $estado = 1;
        $sql = "
            SELECT ron.ron_id, pla.pla_periodo_academico, pes.pes_nombres, pes.pes_dni, ron.ron_modalidad as mod_nombre, ron.ron_carrera as pes_carrera, per.per_celular, per.per_correo
            FROM " . $con_academico->dbname . ".planificacion as pla,
            " . $con_academico->dbname . ".planificacion_estudiante as pes,
            " . $con_asgard->dbname . ".persona as per,
            " . $con_academico->dbname . ".registro_online as ron
            WHERE ron.pes_id = pes.pes_id
            AND ron.per_id = per.per_id
            AND pes.pla_id = pla.pla_id
            AND ron.per_id =:per_id
            AND ron.pes_id =:pes_id
            AND ron.ron_estado =:estado
            AND ron.ron_estado_logico =:estado
        ";

        $comando = $con_academico->createCommand($sql);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
        $comando->bindParam(":pes_id", $pes_id, \PDO::PARAM_INT);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $resultData = $comando->queryOne();

        return $resultData;
    }

    public function getDataStudenbyRonId($ron_id)
    {
        $con_asgard = \Yii::$app->db_asgard;
        $con_academico = \Yii::$app->db_academico;
        $estado = 1;
        $sql = "
            SELECT pla.pla_periodo_academico, pes.pes_nombres, pes.pes_dni, ron.ron_modalidad as mod_nombre, ron.ron_carrera as pes_carrera, per.per_celular, per.per_correo
            FROM " . $con_academico->dbname . ".planificacion as pla,
            " . $con_academico->dbname . ".planificacion_estudiante as pes,
            " . $con_asgard->dbname . ".persona as per,
            " . $con_academico->dbname . ".registro_online as ron
            WHERE ron.pes_id = pes.pes_id
            AND ron.per_id = per.per_id
            AND pes.pla_id = pla.pla_id            
            AND ron.ron_id =:ron_id
            AND ron.ron_estado =:estado
            AND ron.ron_estado_logico =:estado
        ";

        $comando = $con_academico->createCommand($sql);
        $comando->bindParam(":ron_id", $ron_id, \PDO::PARAM_INT);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $resultData = $comando->queryOne();

        return $resultData;
    }

    /**
     * Function to get cost register when exist a register into registro_online
     * @author Emilio Moran <emiliojmp9@gmail.com>
     * @param $ron_id
     * @return $resultData['roc_costo']
     */
    public function getCostFromRegistroOnline($ron_id)
    {
        $con_academico = \Yii::$app->db_academico;
        $estado = 1;
        $sql = "
            SELECT SUM(roc.roc_costo) AS costo
            FROM " . $con_academico->dbname . ".registro_online_cuota AS roc
            WHERE ron_id =:ron_id
            AND roc_estado =:estado
            AND roc_estado_logico =:estado
        ";

        $comando = $con_academico->createCommand($sql);
        $comando->bindParam(":ron_id", $ron_id, \PDO::PARAM_INT);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $resultData = $comando->queryOne();

        return $resultData['costo'];
    }

    /**
     * Function to get planification data when exist a register into registro_online
     * @author Emilio Moran <emiliojmp9@gmail.com>
     * @param $ron_id
     * @return $resultData
     */
    public function getPlanificationFromRegistroOnline($ron_id)
    {
        $con_academico = \Yii::$app->db_academico;
        $estado = 1;
        $sql = "
            SELECT roi.roi_id,                
                roi.roi_materia_nombre as Subject
            FROM " . $con_academico->dbname . ".registro_online_item as roi
            WHERE ron_id =:ron_id
            AND roi_estado =:estado
            AND roi_estado_logico =:estado
        ";

        $comando = $con_academico->createCommand($sql);
        $comando->bindParam(":ron_id", $ron_id, \PDO::PARAM_INT);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $resultData = $comando->queryAll();

        return $resultData;
    }

    /**
     * Function to get the last registro_online to show in /matriculacion/registro when is non-registering time
     * @author Emilio Moran <emiliojmp9@gmail.com>
     * @param
     * @return $resultData
     */
    public function getLastIdRegistroOnline()
    {
        $con_academico = \Yii::$app->db_academico;
        $estado = 1;
        $sql = "
            SELECT ron.ron_id, ron.pes_id
            FROM " . $con_academico->dbname . ".registro_online as ron
            WHERE ron.ron_estado_registro =:estado
            ORDER BY ron.ron_fecha_registro DESC;
        ";

        $comando = $con_academico->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $resultData = $comando->queryAll();

        return $resultData;
    }

    public static function getPlanificacionPago($per_id)
    {
        $con_academico = \Yii::$app->db_academico;
        $estado = 1;
        $sql = "SELECT pla.pla_id, pla.pla_periodo_academico, moda.mod_nombre, pes.pes_id
            FROM " . $con_academico->dbname . ".planificacion as pla 
                    inner join " . $con_academico->dbname . ".planificacion_estudiante pes on pes.pla_id = pla.pla_id
                    inner join " . $con_academico->dbname . ".modalidad as moda on moda.mod_id = pla.mod_id
            WHERE pes.per_id = :per_id
            AND pla.pla_estado =:estado
            AND pla.pla_estado_logico =:estado 
            and moda.mod_estado = :estado
            and moda.mod_estado_logico = :estado";
                
        $comando = $con_academico->createCommand($sql);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $resultData = $comando->queryOne();

        return $resultData;
    }

    public static function getEstudiantesPagoMatricula($estudiante, $pla_periodo_academico, $mod_id, $aprobacion = -1)
    {
        $filter = "";
        $search = "%" . $estudiante . "%";
        if (!is_null($estudiante) || $estudiante != "") {
            if($mod_id > 0){
                 $filter = 'AND pes.pes_nombres like :search AND pla.mod_id = :mod_id';
            }else{
                $filter = 'AND pes.pes_nombres like :search';
            }
            if($aprobacion > -1){
                $filter .= ' AND rpm.rpm_estado_aprobacion = :aprobacion';
            }
           
        }       
        $con_academico = \Yii::$app->db_academico;
        $estado = 1;
        $sql = "
            Select  ron.per_id,
                    rpm.rpm_id as id,
                    pla.pla_id AS PlaId, 
                    pes.pes_id AS PesId, 
                    pes.pes_nombres AS Estudiante,
                    rpm.rpm_archivo AS Archivo,
                    rpm.rpm_estado_aprobacion AS EstadoAprobacion
            from " . $con_academico->dbname . ".registro_online as ron
                 INNER JOIN " . $con_academico->dbname . ".registro_pago_matricula rpm  ON rpm.per_id = ron.per_id
                 INNER JOIN " . $con_academico->dbname . ".planificacion pla ON pla.pla_id = rpm.pla_id
                 INNER JOIN " . $con_academico->dbname . ".planificacion_estudiante pes ON pes.per_id =  ron.per_id
            WHERE pla.pla_estado =:estado
                AND pla.pla_estado_logico =:estado
                AND pes.pes_estado = :estado
                AND pes.pes_estado_logico = :estado
                AND ron.ron_estado = :estado
                AND ron.ron_estado_logico = :estado
                AND rpm.rpm_estado = :estado
                AND rpm.rpm_estado_logico = :estado
            $filter        
        ";
        $comando = $con_academico->createCommand($sql);
        $comando->bindParam(":pla_periodo_academico", $pla_periodo_academico, \PDO::PARAM_STR);
        $comando->bindParam(":mod_id", $mod_id, \PDO::PARAM_INT);
        $comando->bindParam(":search", $search, \PDO::PARAM_STR);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        if($aprobacion > -1){
            $comando->bindParam(":aprobacion", $aprobacion, \PDO::PARAM_INT);
        }
        $resultData = $comando->queryAll();

        return $resultData;
    }

}
