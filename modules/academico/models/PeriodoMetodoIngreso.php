<?php

namespace app\modules\academico\models;

use Yii;
use yii\data\ArrayDataProvider;

/**
 * This is the model class for table "periodo_metodo_ingreso".
 *
 * @property integer $pmin_id
 * @property integer $pmin_anio
 * @property integer $pmin_mes
 * @property integer $nint_id
 * @property integer $ming_id
 * @property string $pmin_codigo
 * @property string $pmin_descripcion
 * @property string $pmin_fecha_desde
 * @property string $pmin_fecha_hasta
 * @property integer $pmin_usuario_ingreso
 * @property integer $pmin_usuario_modifica
 * @property string $pmin_estado
 * @property string $pmin_fecha_creacion
 * @property string $pmin_fecha_modificacion
 * @property string $pmin_estado_logico
 *
 * @property Curso[] $cursos
 */
class PeriodoMetodoIngreso extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'periodo_metodo_ingreso';
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
            [['pmin_anio', 'pmin_mes', 'nint_id', 'ming_id', 'pmin_codigo', 'pmin_descripcion', 'pmin_usuario_ingreso', 'pmin_estado', 'pmin_estado_logico'], 'required'],
            [['pmin_anio', 'pmin_mes', 'nint_id', 'ming_id', 'pmin_usuario_ingreso', 'pmin_usuario_modifica'], 'integer'],
            [['pmin_fecha_desde', 'pmin_fecha_hasta', 'pmin_fecha_creacion', 'pmin_fecha_modificacion'], 'safe'],
            [['pmin_codigo'], 'string', 'max' => 10],
            [['pmin_descripcion'], 'string', 'max' => 100],
            [['pmin_estado', 'pmin_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'pmin_id' => 'Pmin ID',
            'pmin_anio' => 'Pmin Anio',
            'pmin_mes' => 'Pmin Mes',
            'nint_id' => 'Nint ID',
            'ming_id' => 'Ming ID',
            'pmin_codigo' => 'Pmin Codigo',
            'pmin_descripcion' => 'Pmin Descripcion',
            'pmin_fecha_desde' => 'Pmin Fecha Desde',
            'pmin_fecha_hasta' => 'Pmin Fecha Hasta',
            'pmin_usuario_ingreso' => 'Pmin Usuario Ingreso',
            'pmin_usuario_modifica' => 'Pmin Usuario Modifica',
            'pmin_estado' => 'Pmin Estado',
            'pmin_fecha_creacion' => 'Pmin Fecha Creacion',
            'pmin_fecha_modificacion' => 'Pmin Fecha Modificacion',
            'pmin_estado_logico' => 'Pmin Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCursos() {
        return $this->hasMany(Curso::className(), ['pmin_id' => 'pmin_id']);
    }

    /**
     * Function insertarRegistrocurso (Registro al curso segun metodo de ingreso y nivel de interes)
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  
     */
    public function insertarRegistrocurso($cur_id, $asp_id, $usu_id, $sins_id) {
        $con = \Yii::$app->db_academico;
        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }
        $fecha_asigna = date(Yii::$app->params["dateTimeByDefault"]);

        $param_sql = "acur_estado_logico";
        $brcur_sql = "1";

        $param_sql .= ", acur_estado";
        $brcur_sql .= ", 1";

        if (isset($cur_id)) {
            $param_sql .= ", cur_id";
            $brcur_sql .= ", :cur_id";
        }

        if (isset($asp_id)) {
            $param_sql .= ", asp_id";
            $brcur_sql .= ", :asp_id";
        }

        if (isset($usu_id)) {
            $param_sql .= ", acur_usuario_asignacion";
            $brcur_sql .= ", :acur_usuario_asignacion";
        }

        if (isset($fecha_asigna)) {
            $param_sql .= ", acur_fecha_asignacion";
            $brcur_sql .= ", :acur_fecha_asignacion";
        }

        if (isset($sins_id)) {
            $param_sql .= ", sins_id";
            $brcur_sql .= ", :sins_id";
        }

        try {
            $sql = "INSERT INTO " . $con->dbname . ".asignacion_curso ($param_sql) VALUES($brcur_sql)";
            $comando = $con->createCommand($sql);

            if (isset($cur_id))
                $comando->bindParam(':cur_id', $cur_id, \PDO::PARAM_INT);

            if (isset($asp_id))
                $comando->bindParam(':asp_id', $asp_id, \PDO::PARAM_INT);

            if (isset($usu_id))
                $comando->bindParam(':acur_usuario_asignacion', $usu_id, \PDO::PARAM_INT);

            if (isset($fecha_asigna))
                $comando->bindParam(':acur_fecha_asignacion', $fecha_asigna, \PDO::PARAM_STMT);

            if (isset($sins_id))
                $comando->bindParam(':sins_id', $sins_id, \PDO::PARAM_INT);

            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.asignacion_curso');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }

    /**
     * Function insertarPeriodo (Registro de los períodos por método de ingreso)
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  
     */
    public function insertarPeriodo($anio, $mes, $uaca_id, $mod_id, $ming, $codigo, $descripcion, $fec_inicial, $fec_final, $usu_ingreso) {
        $con = \Yii::$app->db_academico;
        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        $param_sql = "pmin_estado_logico";
        $bper_sql = "1";

        $param_sql .= ", pmin_estado";
        $bper_sql .= ", 1";

        if (isset($anio)) {
            $param_sql .= ", pmin_anio";
            $bper_sql .= ", :pmin_anio";
        }

        if (isset($mes)) {
            $param_sql .= ", pmin_mes";
            $bper_sql .= ", :pmin_mes";
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
            $param_sql .= ", pmin_codigo";
            $bper_sql .= ", :pmin_codigo";
        }

        if (isset($descripcion)) {
            $param_sql .= ", pmin_descripcion";
            $bper_sql .= ", :pmin_descripcion";
        }

        if (isset($fec_inicial)) {
            $param_sql .= ", pmin_fecha_desde";
            $bper_sql .= ", :pmin_fecha_desde";
        }

        if (isset($fec_final)) {
            $param_sql .= ", pmin_fecha_hasta";
            $bper_sql .= ", :pmin_fecha_hasta";
        }

        if (isset($usu_ingreso)) {
            $param_sql .= ", pmin_usuario_ingreso";
            $bper_sql .= ", :pmin_usuario_ingreso";
        }

        try {
            $sql = "INSERT INTO " . $con->dbname . ".periodo_metodo_ingreso ($param_sql) VALUES($bper_sql)";
            $comando = $con->createCommand($sql);

            if (isset($anio))
                $comando->bindParam(':pmin_anio', $anio, \PDO::PARAM_INT);

            if (isset($mes))
                $comando->bindParam(':pmin_mes', $mes, \PDO::PARAM_INT);

            if (isset($uaca_id))
                $comando->bindParam(':uaca_id', $uaca_id, \PDO::PARAM_INT);

            if (isset($mod_id))
                $comando->bindParam(':mod_id', $mod_id, \PDO::PARAM_INT);

            if (isset($ming))
                $comando->bindParam(':ming_id', $ming, \PDO::PARAM_INT);

            if (isset($codigo))
                $comando->bindParam(':pmin_codigo', $codigo, \PDO::PARAM_STR);

            if (isset($descripcion))
                $comando->bindParam(':pmin_descripcion', $descripcion, \PDO::PARAM_STR);

            if (isset($fec_inicial))
                $comando->bindParam(':pmin_fecha_desde', $fec_inicial, \PDO::PARAM_STR);

            if (isset($fec_final))
                $comando->bindParam(':pmin_fecha_hasta', $fec_final, \PDO::PARAM_STR);

            if (isset($usu_ingreso))
                $comando->bindParam(':pmin_usuario_ingreso', $usu_ingreso, \PDO::PARAM_INT);

            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.periodo_metodo_ingreso');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
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
            $str_search = "(pmin_codigo like :search OR ";
            $str_search .= "pmin_anio like :search) AND";
            if ($arrFiltro['mes'] != "" && $arrFiltro['mes'] > 0) {
                $str_search .= " pmin_mes = :mes AND";
            }
            if ($arrFiltro['f_ini'] != "" && $arrFiltro['f_fin'] != "") {
                $str_search .= "  pmin_fecha_desde >= :fec_ini AND";
                $str_search .= "  pmin_fecha_hasta <= :fec_fin AND";
            }
        }

        $sql = "SELECT 
                       pmin.pmin_id, 
                       pmin_anio anio, 
                       pmin_mes mes, 
                       ming.ming_descripcion metodo, 
                       pmin_codigo codigo,
                       Date_format(pmin_fecha_desde, '%Y-%m-%d') fecha_inicial, 
                       Date_format(pmin_fecha_hasta, '%Y-%m-%d') fecha_final -- , 
                      -- ifnull((select count(*) 
                      --         FROM " . $con->dbname . ".paralelo par 
                      --         WHERE par.pmin_id = pmin.pmin_id),0) paralelos
                FROM " . $con->dbname . ".periodo_metodo_ingreso pmin "
                . "INNER JOIN " . $con1->dbname . ".metodo_ingreso ming
                     ON ming.ming_id = pmin.ming_id
                WHERE 
                      $str_search
                      pmin.pmin_estado = :estado AND 
                      pmin.pmin_estado_logico = :estado AND
                      ming.ming_estado = :estado AND 
                      ming.ming_estado_logico = :estado                      
                ORDER BY pmin_fecha_desde DESC";

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
        //return $dataProvider;
    }

    /**
     * Function listarParalelos
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  $resultData (información de los paralelos por período (para Online))
     */
    public function listarParalelos($pmin_id) {
        $con = \Yii::$app->db_academico;
        $estado = 1;
        // OJO AQUI SE REGISTRABAN CUPOS Y NUMEROS INSCRITOS ESTO DEBE IR NUEVAMENTE EN LA TABLA?
        $sql = "SELECT 	par.par_descripcion descripcion -- , 
                        -- par.par_num_cupo cupo, 
                        -- ifnull(par_num_inscritos,0) inscritos
                FROM " . $con->dbname . ".paralelo par
                WHERE par.pmin_id = :pmin_id
                      and par.par_estado = :estado
                      and par.par_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":pmin_id", $pmin_id, \PDO::PARAM_INT);

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
        return $dataProvider;
    }

    /**
     * Function insertarParalelo (Registro de los paralelos)
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  
     */
    public function insertarParalelo($pmin_id, $descripcion, $cupo, $usu_id) {
        $con = \Yii::$app->db_academico;
        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        $param_sql = "cur_estado_logico";
        $bcur_sql = "1";

        $param_sql .= ", cur_estado";
        $bcur_sql .= ", 1";

        if (isset($pmin_id)) {
            $param_sql .= ", pmin_id";
            $bcur_sql .= ", :pmin_id";
        }

        if (isset($descripcion)) {
            $param_sql .= ", cur_descripcion";
            $bcur_sql .= ", :cur_descripcion";
        }

        if (isset($cupo)) {
            $param_sql .= ", cur_num_cupo";
            $bcur_sql .= ", :cur_num_cupo";
        }

        if (isset($usu_id)) {
            $param_sql .= ", cur_usuario_ingreso";
            $bcur_sql .= ", :cur_usuario_ingreso";
        }

        try {
            $sql = "INSERT INTO " . $con->dbname . ".curso ($param_sql) VALUES($bcur_sql)";
            $comando = $con->createCommand($sql);

            if (isset($pmin_id))
                $comando->bindParam(':pmin_id', $pmin_id, \PDO::PARAM_INT);

            if (isset($descripcion))
                $comando->bindParam(':cur_descripcion', $descripcion, \PDO::PARAM_STR);

            if (isset($cupo))
                $comando->bindParam(':cur_num_cupo', $cupo, \PDO::PARAM_INT);

            if (isset($usu_id))
                $comando->bindParam(':cur_usuario_ingreso', $usu_id, \PDO::PARAM_INT);

            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.curso');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }

    /**
     * Function VerificarPeriodo
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  $resultData (Verificar que no se repita los datos principales de período (para Online).)
     */
    public function VerificarPeriodo($anio, $mes, $ming) {
        $con = \Yii::$app->db_academico;
        $estado = 1;

        $sql = "SELECT 'S' existe
                FROM " . $con->dbname . ".periodo_metodo_ingreso pmin
                WHERE pmin.pmin_anio = :anio
                and pmin.pmin_mes = :mes
                and pmin.ming_id = :ming
                and pmin.pmin_estado_logico = :estado
                and pmin.pmin_estado = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":anio", $anio, \PDO::PARAM_INT);
        $comando->bindParam(":mes", $mes, \PDO::PARAM_INT);
        $comando->bindParam(":ming", $ming, \PDO::PARAM_INT);

        $resultData = $comando->queryOne();
        return $resultData;
    }

    /**
     * Function consultaPeriodoId
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>
     * @property integer $perid       
     * @return  
     */
    public function consultaPeriodoId($pmin_id) {
        $con = \Yii::$app->db_academico;
        $estado = 1;

        $sql = "SELECT pmin_anio, 
	        pmin_mes, 
                uaca_id, 
                mod_id,
                ming_id,
                pmin_descripcion, 
                DATE(pmin_fecha_desde) as fecha_desde, 
                DATE(pmin_fecha_hasta) as fecha_hasta 
                FROM " . $con->dbname . ".periodo_metodo_ingreso 
                WHERE pmin_id = :pmin_id AND
                pmin_estado = :estado AND
                pmin_estado_logico = :estado ";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":pmin_id", $pmin_id, \PDO::PARAM_INT);

        $resultData = $comando->queryOne();
        return $resultData;
    }

    /**
     * Function modificaPeriodo
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>
     * @property integer $userid       
     * @return  
     */
    public function modificaPeriodo($pmin_id, $anio, $mes, $uaca_id, $mod, $ming, $codigo, $descripcion, $fec_desde, $fec_hasta, $usuario_modifica) {
        $con = \Yii::$app->db_academico;
        $trans = $con->getTransaction(); // se obtiene la transacción actual
        $estado = 1;
        $pmin_fecha_modificacion = date("Y-m-d H:i:s");
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }
        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".periodo_metodo_ingreso 		       
                      SET 
                        pmin_anio = :anio,
                        pmin_mes = :mes,
                        uaca_id = :uaca_id,
                        mod_id = :mod,
                        ming_id = :ming,
                        pmin_codigo = :codigo, 
                        pmin_descripcion = :descripcion,
                        pmin_fecha_desde = :fec_desde,
                        pmin_fecha_hasta = :fec_hasta,
                        pmin_usuario_modifica = :usuario_modifica,
                        pmin_fecha_modificacion = :pmin_fecha_modificacion
                      WHERE 
                        pmin_id = :pmin_id AND 
                        pmin_estado = :estado AND
                        pmin_estado_logico = :estado");

            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
            $comando->bindParam(":anio", $anio, \PDO::PARAM_INT);
            $comando->bindParam(":mes", $mes, \PDO::PARAM_INT);
            $comando->bindParam(":uaca_id", $uaca_id, \PDO::PARAM_INT);
            $comando->bindParam(":mod", $mod, \PDO::PARAM_INT);
            $comando->bindParam(":ming", $ming, \PDO::PARAM_INT);
            $comando->bindParam(":codigo", $codigo, \PDO::PARAM_STR);
            $comando->bindParam(":descripcion", ucwords(mb_strtolower($descripcion)), \PDO::PARAM_STR);
            $comando->bindParam(":fec_desde", $fec_desde, \PDO::PARAM_STR);
            $comando->bindParam(":fec_hasta", $fec_hasta, \PDO::PARAM_STR);
            $comando->bindParam(":usuario_modifica", $usuario_modifica, \PDO::PARAM_INT);
            $comando->bindParam(":pmin_fecha_modificacion", $pmin_fecha_modificacion, \PDO::PARAM_STR);
            $comando->bindParam(":pmin_id", $pmin_id, \PDO::PARAM_INT);
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
     * Function VerificarAsignacion
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  $resultData (Verificar que no se repita los datos principales de período (para Online).)
     */
    public function VerificarAsignacion($asp, $solicitud) {
        $con = \Yii::$app->db_academico;
        $estado = 1;

        $sql = "SELECT 'S' existe
                FROM " . $con->dbname . ".asignacion_curso acur
                WHERE acur.asp_id = :asp   
                and acur.sins_id = :solicitud
                and acur.acur_estado_logico = :estado
                and acur.acur_estado = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":asp", $asp, \PDO::PARAM_INT);
        $comando->bindParam(":solicitud", $solicitud, \PDO::PARAM_INT);

        $resultData = $comando->queryOne();
        return $resultData;
    }

    /**
     * Function modificAsignacion
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @property integer $userid       
     * @return  
     */
    public function modificAsignacion($asp_id, $sins_id, $usuario_modifica) {
        $con = \Yii::$app->db_academico;
        $trans = $con->getTransaction(); // se obtiene la transacción actual
        $estado = 1;
        $estado_inactiva = 0;
        $fecha_modificacion = date("Y-m-d H:i:s");
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }
        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".asignacion_curso 		       
                      SET 
                        acur_usuario_modificacion = :usuario_modifica,
                        acur_fecha_modificacion = :fecha_modificacion,
                        acur_estado = :estado_inactiva                      
                      WHERE 
                        asp_id = :asp_id AND 
                        sins_id = :sins_id AND                        
                        acur_estado = :estado AND
                        acur_estado_logico = :estado");

            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
            $comando->bindParam(":estado_inactiva", $estado_inactiva, \PDO::PARAM_STR);
            $comando->bindParam(":usuario_modifica", $usuario_modifica, \PDO::PARAM_INT);
            $comando->bindParam(":fecha_modificacion", $fecha_modificacion, \PDO::PARAM_STR);
            $comando->bindParam(":asp_id", $asp_id, \PDO::PARAM_INT);
            $comando->bindParam(":sins_id", $sins_id, \PDO::PARAM_INT);
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
