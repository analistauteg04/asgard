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

}
