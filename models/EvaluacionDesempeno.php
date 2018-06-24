<?php

namespace app\models;

use yii\data\ArrayDataProvider;
use Yii;

/**
 * This is the model class for table "evaluacion_desempeno".
 *
 * @property int $edes_id
 * @property int $pro_id
 * @property int $paca_id
 * @property int $asi_id
 * @property int $nint_id
 * @property int $mod_id
 * @property int $acon_id
 * @property int $blo_id
 * @property int $scon_id
 * @property int $edes_paralelo
 * @property string $car_id
 * @property int $gru_id
 * @property int $edes_mes
 * @property double $edes_heteroevaluacion
 * @property double $edes_autoevaluacion
 * @property double $edes_coevaluacion
 * @property double $edes_directivo
 * @property double $edes_promedio
 * @property int $edes_usuario
 * @property int $edes_usuario_modifica
 * @property string $edes_estado
 * @property string $edes_fecha_creacion
 * @property string $edes_fecha_modificacion
 * @property string $edes_estado_logico
 *
 * @property Asignatura $asi
 * @property Modalidad $mod
 * @property AreaConocimiento $acon
 * @property SubareaConocimiento $scon
 * @property Horario[] $horarios
 */
class EvaluacionDesempeno extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'evaluacion_desempeno';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb() {
        return Yii::$app->get('db_academico');
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['pro_id', 'asi_id', 'nint_id', 'mod_id', 'acon_id', 'scon_id', 'edes_paralelo', 'edes_estado', 'edes_estado_logico'], 'required'],
            [['pro_id', 'paca_id', 'asi_id', 'nint_id', 'mod_id', 'acon_id', 'blo_id', 'scon_id', 'edes_paralelo', 'gru_id', 'edes_mes', 'edes_usuario', 'edes_usuario_modifica'], 'integer'],
            [['edes_heteroevaluacion', 'edes_autoevaluacion', 'edes_coevaluacion', 'edes_directivo', 'edes_promedio'], 'number'],
            [['edes_fecha_creacion', 'edes_fecha_modificacion'], 'safe'],
            [['car_id'], 'string', 'max' => 200],
            [['edes_estado', 'edes_estado_logico'], 'string', 'max' => 1],
            [['asi_id'], 'exist', 'skipOnError' => true, 'targetClass' => Asignatura::className(), 'targetAttribute' => ['asi_id' => 'asi_id']],
            [['mod_id'], 'exist', 'skipOnError' => true, 'targetClass' => Modalidad::className(), 'targetAttribute' => ['mod_id' => 'mod_id']],
            [['acon_id'], 'exist', 'skipOnError' => true, 'targetClass' => AreaConocimiento::className(), 'targetAttribute' => ['acon_id' => 'acon_id']],
            [['scon_id'], 'exist', 'skipOnError' => true, 'targetClass' => SubareaConocimiento::className(), 'targetAttribute' => ['scon_id' => 'scon_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'edes_id' => 'Edes ID',
            'pro_id' => 'Pro ID',
            'paca_id' => 'Paca ID',
            'asi_id' => 'Asi ID',
            'nint_id' => 'Nint ID',
            'mod_id' => 'Mod ID',
            'acon_id' => 'Acon ID',
            'blo_id' => 'Blo ID',
            'scon_id' => 'Scon ID',
            'edes_paralelo' => 'Edes Paralelo',
            'car_id' => 'Car ID',
            'gru_id' => 'Gru ID',
            'edes_mes' => 'Edes Mes',
            'edes_heteroevaluacion' => 'Edes Heteroevaluacion',
            'edes_autoevaluacion' => 'Edes Autoevaluacion',
            'edes_coevaluacion' => 'Edes Coevaluacion',
            'edes_directivo' => 'Edes Directivo',
            'edes_promedio' => 'Edes Promedio',
            'edes_usuario' => 'Edes Usuario',
            'edes_usuario_modifica' => 'Edes Usuario Modifica',
            'edes_estado' => 'Edes Estado',
            'edes_fecha_creacion' => 'Edes Fecha Creacion',
            'edes_fecha_modificacion' => 'Edes Fecha Modificacion',
            'edes_estado_logico' => 'Edes Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsi() {
        return $this->hasOne(Asignatura::className(), ['asi_id' => 'asi_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMod() {
        return $this->hasOne(Modalidad::className(), ['mod_id' => 'mod_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcon() {
        return $this->hasOne(AreaConocimiento::className(), ['acon_id' => 'acon_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScon() {
        return $this->hasOne(SubareaConocimiento::className(), ['scon_id' => 'scon_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHorarios() {
        return $this->hasMany(Horario::className(), ['edes_id' => 'edes_id']);
    }

    /**
     * Function insertarEvaluacion (Registro de la evluación de los profesores)
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>
     * @param   
     * @return  
     */
    public function insertarEvaluacion($profesor, $periodo, $asignatura, $nivelestudio, $modalidad, $areaconoce, $bloque, $subarea, $paralelo, $carrera, $grupo, $mes, $hevaluacion, $aevaluacion, $cevaluacion, $directivo, $promedio, $usu_id) {
        $con = \Yii::$app->db_academico;
        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        $param_sql = "edes_estado_logico";
        $bcur_sql = "1";

        $param_sql .= ", edes_estado";
        $bcur_sql .= ", 1";

        if (isset($profesor)) {
            $param_sql .= ", pro_id";
            $bcur_sql .= ", :pro_id";
        }

        if (isset($periodo)) {
            $param_sql .= ", paca_id";
            $bcur_sql .= ", :paca_id";
        }

        if (isset($asignatura)) {
            $param_sql .= ", asi_id";
            $bcur_sql .= ", :asi_id";
        }

        if (isset($nivelestudio)) {
            $param_sql .= ", nint_id";
            $bcur_sql .= ", :nint_id";
        }

        if (isset($modalidad)) {
            $param_sql .= ", mod_id";
            $bcur_sql .= ", :mod_id";
        }

        if (isset($areaconoce)) {
            $param_sql .= ", acon_id";
            $bcur_sql .= ", :acon_id";
        }

        if (isset($bloque)) {
            $param_sql .= ", blo_id";
            $bcur_sql .= ", :blo_id";
        }

        if (isset($subarea)) {
            $param_sql .= ", scon_id";
            $bcur_sql .= ", :scon_id";
        }

        if (isset($paralelo)) {
            $param_sql .= ", edes_paralelo";
            $bcur_sql .= ", :edes_paralelo";
        }

        if (isset($carrera)) {
            $param_sql .= ", car_id";
            $bcur_sql .= ", :car_id";
        }

        if (isset($grupo)) {
            $param_sql .= ", gru_id";
            $bcur_sql .= ", :gru_id";
        }

        if (isset($mes)) {
            $param_sql .= ", edes_mes";
            $bcur_sql .= ", :edes_mes";
        }

        if (isset($hevaluacion)) {
            $param_sql .= ", edes_heteroevaluacion";
            $bcur_sql .= ", :edes_heteroevaluacion";
        }

        if (isset($aevaluacion)) {
            $param_sql .= ", edes_autoevaluacion";
            $bcur_sql .= ", :edes_autoevaluacion";
        }

        if (isset($cevaluacion)) {
            $param_sql .= ", edes_coevaluacion";
            $bcur_sql .= ", :edes_coevaluacion";
        }
        if (isset($directivo)) {
            $param_sql .= ", edes_directivo";
            $bcur_sql .= ", :edes_directivo";
        }

        if (isset($promedio)) {
            $param_sql .= ", edes_promedio";
            $bcur_sql .= ", :edes_promedio";
        }

        if (isset($usu_id)) {
            $param_sql .= ", edes_usuario";
            $bcur_sql .= ", :edes_usuario";
        }

        try {
            $sql = "INSERT INTO " . $con->dbname . ".evaluacion_desempeno ($param_sql) VALUES($bcur_sql)";
            $comando = $con->createCommand($sql);

            if (isset($profesor)) {
                $comando->bindParam(':pro_id', $profesor, \PDO::PARAM_INT);
            }

            if (isset($periodo)) {
                $comando->bindParam(':paca_id', $periodo, \PDO::PARAM_INT);
            }

            if (isset($asignatura)) {
                $comando->bindParam(':asi_id', $asignatura, \PDO::PARAM_INT);
            }

            if (isset($nivelestudio)) {
                $comando->bindParam(':nint_id', $nivelestudio, \PDO::PARAM_INT);
            }

            if (isset($modalidad)) {
                $comando->bindParam(':mod_id', $modalidad, \PDO::PARAM_INT);
            }

            if (isset($areaconoce)) {
                $comando->bindParam(':acon_id', $areaconoce, \PDO::PARAM_INT);
            }

            if (isset($bloque)) {
                $comando->bindParam(':blo_id', $bloque, \PDO::PARAM_INT);
            }

            if (isset($subarea)) {
                $comando->bindParam(':scon_id', $subarea, \PDO::PARAM_INT);
            }

            if (isset($paralelo)) {
                $comando->bindParam(':edes_paralelo', $paralelo, \PDO::PARAM_INT);
            }

            if (isset($carrera)) {
                $comando->bindParam(':car_id', $carrera, \PDO::PARAM_INT);
            }

            if (isset($grupo)) {
                $comando->bindParam(':gru_id', $grupo, \PDO::PARAM_INT);
            }

            if (isset($mes)) {
                $comando->bindParam(':edes_mes', $mes, \PDO::PARAM_INT);
            }

            if (isset($hevaluacion)) {
                $comando->bindParam(':edes_heteroevaluacion', $hevaluacion, \PDO::PARAM_STR);
            }

            if (isset($aevaluacion)) {
                $comando->bindParam(':edes_autoevaluacion', $aevaluacion, \PDO::PARAM_STR);
            }

            if (isset($cevaluacion)) {
                $comando->bindParam(':edes_coevaluacion', $cevaluacion, \PDO::PARAM_STR);
            }
            if (isset($directivo)) {
                $comando->bindParam(':edes_directivo', $directivo, \PDO::PARAM_STR);
            }

            if (isset($promedio)) {
                $comando->bindParam(':edes_promedio', $promedio, \PDO::PARAM_STR);
            }

            if (isset($usu_id)) {
                $comando->bindParam(':edes_usuario', $usu_id, \PDO::PARAM_STR);
            }
            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.evaluacion_desempeno');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }

    /**
     * Function consultarEvaluaciones
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>
     * @param   
     * @return  $resultData (información de los profesores evaluados.)
     */
    public function consultarEvaluaciones($arrFiltro = array(), $onlyData = false) {
        $con = \Yii::$app->db_academico;
        $con1 = \Yii::$app->db_asgard;
        $con2 = \Yii::$app->db_claustro;
        $con3 = \Yii::$app->db_captacion;
        $estado = 1;
        $columnsAdd = "";
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $str_search = "(per.per_pri_nombre like :search OR per.per_seg_nombre like :search OR per.per_pri_apellido like :search OR per.per_seg_apellido like :search) AND ";
            if ($arrFiltro['nivelestudio'] != "" && $arrFiltro['nivelestudio'] > 0) {
                $str_search .= "evd.nint_id = :nivelestudio AND ";
            }
            if ($arrFiltro['facultadest'] != "" && $arrFiltro['facultadest'] > 0) {
                $str_search .= "evd.mod_id = :facultadest AND ";
            }
            if ($arrFiltro['carreraest'] != "" && $arrFiltro['carreraest'] > 0) {
                $str_search .= "evd.car_id = :carreraest AND ";
            }
            if ($arrFiltro['materiaest'] != "" && $arrFiltro['materiaest'] > 0) {
                $str_search .= "evd.asi_id = :materiaest AND ";
            }
        }
        $sql = "SELECT                 
                    CONCAT(per.per_pri_apellido, ' ', per.per_pri_nombre) as nombre,                    
                    nivi.nint_nombre as nivel_estudio,  
                    moda.mod_nombre as modalidad,
                    asig.asi_nombre,  
                    CONCAT(SUBSTRING(asig.asi_nombre, 1,10),'','...' )as materia,                    
                    evd.edes_promedio   
                FROM " . $con->dbname . ".evaluacion_desempeno evd  "
                . "INNER JOIN  " . $con->dbname . ".asignatura asig ON evd.asi_id = asig.asi_id "
                . "INNER JOIN  " . $con->dbname . ".profesor profe ON  profe.pro_id = evd.pro_id "
                . "INNER JOIN  " . $con1->dbname . ".persona per ON per.per_id = profe.per_id "
                . "INNER JOIN  " . $con->dbname . ".modalidad moda ON moda.mod_id= evd.mod_id "
                . "INNER JOIN  " . $con3->dbname . ".nivel_interes nivi ON nivi.nint_id = evd.nint_id "
                . "WHERE ";
        if ($str_search != "") {
            $sql .= " $str_search ";
        }
        $sql .= "
                edes_estado = :estado AND 
                edes_estado_logico = :estado AND
                asi_estado = :estado AND
                asi_estado_logico = :estado AND
                pro_estado = :estado AND
                pro_estado_logico = :estado AND               
                nint_estado = :estado AND
                nint_estado_logico = :estado AND  
                mod_estado = :estado AND
                mod_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);

        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $search_cond = "%" . $arrFiltro["search"] . "%";
            $asignatura = $arrFiltro["asignatura"];
            $nivelestudio = $arrFiltro["nivelestudio"];
            $facultadest = $arrFiltro["facultadest"];
            $materiaest = $arrFiltro["materiaest"];
            $comando->bindParam(":search", $search_cond, \PDO::PARAM_STR);
            if ($arrFiltro['nivelestudio'] != "" && $arrFiltro['nivelestudio'] > 0) {
                $comando->bindParam(":nivelestudio", $nivelestudio, \PDO::PARAM_INT);
            }
            if ($arrFiltro['facultadest'] != "" && $arrFiltro['facultadest'] > 0) {
                $comando->bindParam(":facultadest", $facultadest, \PDO::PARAM_INT);
            }
            if ($arrFiltro['materiaest'] != "" && $arrFiltro['materiaest'] > 0) {
                $comando->bindParam(":materiaest", $materiaest, \PDO::PARAM_INT);
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
                    'nombre',
                    'nivel_estudio',
                    'modalidad',
                    'asi_nombre',
                    'horario',
                    'edes_promedio',
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
     * Function execel de evaluaciones
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>
     * @param   
     * @return  $resultData (información de los profesores evaluados para exportar en execl.)
     */
    public function EvaluacionExcel($arrFiltro = array()) {
        $con = \Yii::$app->db_academico;
        $con1 = \Yii::$app->db_asgard;
        $con2 = \Yii::$app->db_claustro;
        $con3 = \Yii::$app->db_captacion;
        $estado = 1;
        $columnsAdd = "";
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $str_search = "(per.per_pri_nombre like :search OR per.per_seg_nombre like :search OR per.per_pri_apellido like :search OR per.per_seg_apellido like :search) AND ";
            if ($arrFiltro['nivelestudio'] != "" && $arrFiltro['nivelestudio'] > 0) {
                $str_search .= "evd.nint_id = :nivelestudio AND ";
            }
            if ($arrFiltro['facultadest'] != "" && $arrFiltro['facultadest'] > 0) {
                $str_search .= "evd.mod_id = :facultadest AND ";
            }
            if ($arrFiltro['carreraest'] != "" && $arrFiltro['carreraest'] > 0) {
                $str_search .= "evd.car_id = :carreraest AND ";
            }
            if ($arrFiltro['materiaest'] != "" && $arrFiltro['materiaest'] > 0) {
                $str_search .= "evd.asi_id = :materiaest AND ";
            }
        }
        $sql = "SELECT                 
                    CONCAT(per.per_pri_apellido, ' ', per.per_pri_nombre) as nombre,                    
                    nivi.nint_nombre as nivel_estudio,  
                    moda.mod_nombre as modalidad,
                    asig.asi_nombre,                                        
                    evd.edes_promedio   
                FROM " . $con->dbname . ".evaluacion_desempeno evd  "
                . "INNER JOIN  " . $con->dbname . ".asignatura asig ON evd.asi_id = asig.asi_id "
                . "INNER JOIN  " . $con->dbname . ".profesor profe ON  profe.pro_id = evd.pro_id "
                . "INNER JOIN  " . $con1->dbname . ".persona per ON per.per_id = profe.per_id "
                . "INNER JOIN  " . $con->dbname . ".modalidad moda ON moda.mod_id= evd.mod_id "
                . "INNER JOIN  " . $con3->dbname . ".nivel_interes nivi ON nivi.nint_id = evd.nint_id "
                . "WHERE ";
        if ($str_search != "") {
            $sql .= " $str_search ";
        }
        $sql .= "
                edes_estado = :estado AND 
                edes_estado_logico = :estado AND
                asi_estado = :estado AND
                asi_estado_logico = :estado AND
                pro_estado = :estado AND
                pro_estado_logico = :estado AND               
                nint_estado = :estado AND
                nint_estado_logico = :estado AND  
                mod_estado = :estado AND
                mod_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);

        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $search_cond = "%" . $arrFiltro["search"] . "%";
            $asignatura = $arrFiltro["asignatura"];
            $nivelestudio = $arrFiltro["nivelestudio"];
            $facultadest = $arrFiltro["facultadest"];
            $materiaest = $arrFiltro["materiaest"];
            $comando->bindParam(":search", $search_cond, \PDO::PARAM_STR);
            if ($arrFiltro['nivelestudio'] != "" && $arrFiltro['nivelestudio'] > 0) {
                $comando->bindParam(":nivelestudio", $nivelestudio, \PDO::PARAM_INT);
            }
            if ($arrFiltro['facultadest'] != "" && $arrFiltro['facultadest'] > 0) {
                $comando->bindParam(":facultadest", $facultadest, \PDO::PARAM_INT);
            }
            if ($arrFiltro['materiaest'] != "" && $arrFiltro['materiaest'] > 0) {
                $comando->bindParam(":materiaest", $materiaest, \PDO::PARAM_INT);
            }
        }
        $resultData = $comando->queryAll();
        return $resultData;
    }

    /**
     * Function consulta los periodos. 
     * @author Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarPeriodo($anio) {
        $con = \Yii::$app->db_academico;
        if ($anio != "" && $anio > 0) {
            $anio_academico = $anio;
        }
        $estado = 1;
        $sql = "SELECT 
                   pera.paca_id as id,
                   CONCAT (pera.paca_nombre) as name
                FROM 
                   " . $con->dbname . ".periodo_academico  pera "
                . "INNER JOIN  " . $con->dbname . ".    anio_academico ani ON ani.aaca_id = pera.aaca_id
                WHERE ";
        if ($anio != "" && $anio > 0) {
            $sql .= "pera.aaca_id=:anio_academico AND ";
        }
        $sql .= "  pera.paca_estado = :estado AND
                   pera.paca_estado_logico = :estado AND
                   ani.aaca_estado = :estado AND
                   ani.aaca_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        if ($anio != "" && $anio > 0) {
            $comando->bindParam(":anio_academico", $anio_academico, \PDO::PARAM_INT);
        }
        $resultData = $comando->queryAll();
        return $resultData;
    }

    /**
     * Function insertarHorarioevalua (Registro de horarios en evaluaciones)
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>
     * @param   
     * @return  
     */
    public function insertarHorarioevalua($edes_id, $hora_inicio, $hora_fin, $dia, $usu_id) {
        $con = \Yii::$app->db_academico;
        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        $param_sql = "hor_estado_logico";
        $bcur_sql = "1";

        $param_sql .= ", hor_estado";
        $bcur_sql .= ", 1";

        if (isset($edes_id)) {
            $param_sql .= ", edes_id";
            $bcur_sql .= ", :edes_id";
        }

        if (isset($hora_inicio)) {
            $param_sql .= ", hor_inicio";
            $bcur_sql .= ", :hor_inicio";
        }

        if (isset($hora_fin)) {
            $param_sql .= ", hor_fin";
            $bcur_sql .= ", :hor_fin";
        }

        if (isset($dia)) {
            $param_sql .= ", hor_dia";
            $bcur_sql .= ", :hor_dia";
        }

        if (isset($usu_id)) {
            $param_sql .= ", hor_usuario_ingreso";
            $bcur_sql .= ", :hor_usuario_ingreso";
        }

        try {
            $sql = "INSERT INTO " . $con->dbname . ".horario ($param_sql) VALUES($bcur_sql)";
            $comando = $con->createCommand($sql);

            if (isset($edes_id)) {
                $comando->bindParam(':edes_id', $edes_id, \PDO::PARAM_INT);
            }

            if (isset($hora_inicio)) {
                $comando->bindParam(':hor_inicio', $hora_inicio, \PDO::PARAM_STR);
            }

            if (isset($hora_fin)) {
                $comando->bindParam(':hor_fin', $hora_fin, \PDO::PARAM_STR);
            }

            if (isset($dia)) {
                $comando->bindParam(':hor_dia', $dia, \PDO::PARAM_STR);
            }

            if (isset($usu_id)) {
                $comando->bindParam(':hor_usuario_ingreso', $usu_id, \PDO::PARAM_INT);
            }

            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.horario');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }

    /**
     * Function consulta los grupos de posgrado. 
     * @author Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarGruposgrado() {
        $con = \Yii::$app->db_academico;
        $estado = 1;
        $sql = "SELECT 
                   gpos.gru_id as id,
                   gpos.gru_nombre as name
                FROM 
                   " . $con->dbname . ".grupo  gpos ";
        $sql .= "  WHERE
                   gpos.gru_estado = :estado AND
                   gpos.gru_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $resultData = $comando->queryAll();
        return $resultData;
    }

}
