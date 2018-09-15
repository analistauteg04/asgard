<?php

namespace app\models;

use Yii;
/**
 * This is the model class for table "interesado".
 *
 * @property integer $int_id
 * @property integer $per_id
 * @property string $int_nombres
 * @property string $int_apellidos
 * @property string $int_estado
 * @property string $int_fecha_creacion
 * @property string $int_fecha_modificacion
 * @property string $int_estado_logico
 *
 * @property Aspirante[] $aspirantes
 * @property InformacionAcademica[] $informacionAcademicas
 * @property InformacionDiscapacidad[] $informacionDiscapacidads
 * @property InformacionEnfermedad[] $informacionEnfermedads
 * @property InformacionFamilia[] $informacionFamilias
 * @property SolicitudInscripcion[] $solicitudInscripcions
 */
use yii\data\ArrayDataProvider;

class Interesado extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        //return 'interesado';
        return \Yii::$app->db_captacion->dbname . '.interesado';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['per_id', 'int_nombres', 'int_apellidos', 'int_estado', 'int_estado_logico'], 'required'],
            [['per_id'], 'integer'],
            [['int_fecha_creacion', 'int_fecha_modificacion'], 'safe'],
            [['int_nombres', 'int_apellidos'], 'string', 'max' => 100],
            [['int_estado', 'int_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'int_id' => 'Int ID',
            'per_id' => 'Per ID',
            'int_nombres' => 'Int Nombres',
            'int_apellidos' => 'Int Apellidos',
            'int_estado' => 'Int Estado',
            'int_fecha_creacion' => 'Int Fecha Creacion',
            'int_fecha_modificacion' => 'Int Fecha Modificacion',
            'int_estado_logico' => 'Int Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAspirantes() {
        return $this->hasMany(Aspirante::className(), ['int_id' => 'int_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInformacionAcademicas() {
        return $this->hasMany(InformacionAcademica::className(), ['int_id' => 'int_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInformacionDiscapacidads() {
        return $this->hasMany(InformacionDiscapacidad::className(), ['int_id' => 'int_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInformacionEnfermedads() {
        return $this->hasMany(InformacionEnfermedad::className(), ['int_id' => 'int_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInformacionFamilias() {
        return $this->hasMany(InformacionFamilia::className(), ['int_id' => 'int_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudInscripcions() {
        return $this->hasMany(SolicitudInscripcion::className(), ['int_id' => 'int_id']);
    }

    /**
     * Function findByCondition
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>
     * @property integer $pint_id
     * @property string $pcon_nombre
     * @property integer $tpar_id
     * @property string $pcon_telefono
     * @property string $pcon_celular 
     * @property string $pcon_estado 
     * @property string $pcon_estado_logico 
     *  
     */
    public function crearInteresado($pint_id, $user_id) {
        $con = \Yii::$app->db_captacion;
        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }
        $param_sql = "int_estado_logico";
        $bsol_sql = "1";

        $param_sql .= ", int_estado";
        $bsol_sql .= ", 1";

        $param_sql .= ", int_estado_interesado";
        $bsol_sql .= ", 1";

        if (isset($pint_id)) {
            $param_sql .= ", pint_id";
            $bsol_sql .= ", :pint_id";
        }

        if (isset($user_id)) {
            $param_sql .= ", int_usuario_ingreso";
            $bsol_sql .= ", :int_usuario_ingreso";
        }
        try {
            $sql = "INSERT INTO " . $con->dbname . ".interesado ($param_sql) VALUES($bsol_sql)";
            $comando = $con->createCommand($sql);

            if (isset($pint_id))
                $comando->bindParam(':pint_id', $pint_id, \PDO::PARAM_INT);

            if (isset($user_id))
                $comando->bindParam(':int_usuario_ingreso', $user_id, \PDO::PARAM_INT);

            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.interesado');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }

    /**
     * Function consultaDatosinteresado
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   $usuario_id (id del usuario).  
     * @return  $resultData (id del interesado).
     */
    public function consultaDatosinteresado($per_id) {
        $con = \Yii::$app->db_captacion;
        $estado = 1;

        $sql = "SELECT int_id FROM " . $con->dbname . ".interesado inte                    
                INNER JOIN " . $con->dbname . ".pre_interesado prei ON prei.pint_id = inte.pint_id
                WHERE  prei.per_id = :per_id AND
                    inte.int_estado_logico = :estado AND 
                    inte.int_estado = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
        $resultData = $comando->queryOne();
        return $resultData;
    }

    public function consultaInteresadoById($per_id) {
        $con = \Yii::$app->db_captacion;
        $estado = 1;
        $sql = "
                    SELECT
                    ifnull(int_id,0) as int_id
                    FROM db_captacion.interesado
                    WHERE 
                    per_id = $per_id
                    and int_estado = $estado
                    and int_estado_logico=$estado
                ";
        $comando = $con->createCommand($sql);
        $resultData = $comando->queryOne();
        if (empty($resultData['int_id']))
            return 0;
        else {
            return $resultData['int_id'];
        }
    }
    public function insertarInteresado($con, $parameters, $keys, $name_table) {
        $trans = $con->getTransaction();
        $param_sql .= "" . $keys[0];
        $bdet_sql .= "'" . $parameters[0] . "'";
        for ($i = 1; $i < count($parameters); $i++) {
            if (isset($parameters[$i])) {
                $param_sql .= ", " . $keys[$i];
                $bdet_sql .= ", '" . $parameters[$i] . "'";
            }
        }
        try {
            $sql = "INSERT INTO " . $con->dbname . '.' . $name_table . " ($param_sql) VALUES($bdet_sql);";
            $comando = $con->createCommand($sql);
            $result = $comando->execute();
            $idtable = $con->getLastInsertID($con->dbname . '.' . $name_table);
            if ($trans !== null)
                $trans->commit();
            return $idtable;
        } catch (Exception $ex) {
            if ($trans !== null) {
                $trans->rollback();
            }
            return 0;
        }
    }

    public function crearInfoAcaInteresado($int_id, $pai_id, $pro_id, $can_id, $tiac_id, $tnes_id, $iaca_institucion, $iaca_titulo, $iaca_anio_grado) {

        $con = \Yii::$app->db_captacion;
        //$estado = 1;
        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }
        $param_sql = "iaca_estado_logico";
        $bsol_sql = "1";

        $param_sql .= ", iaca_estado";
        $bsol_sql .= ", 1";
        if (isset($int_id)) {
            $param_sql .= ", int_id";
            $bsol_sql .= ", :int_id";
        }

        if (isset($pai_id)) {
            $param_sql .= ", pai_id";
            $bsol_sql .= ", :pai_id";
        }

        if (isset($pro_id)) {
            $param_sql .= ", pro_id";
            $bsol_sql .= ", :pro_id";
        }

        if (isset($can_id)) {
            $param_sql .= ", can_id";
            $bsol_sql .= ", :can_id";
        }

        if (isset($tiac_id)) {
            $param_sql .= ", tiac_id";
            $bsol_sql .= ", :tiac_id";
        }
        if (isset($tnes_id)) {
            $param_sql .= ", tnes_id";
            $bsol_sql .= ", :tnes_id";
        }

        if (isset($iaca_institucion)) {
            $param_sql .= ", iaca_institucion";
            $bsol_sql .= ", :iaca_institucion";
        }

        if (isset($iaca_titulo)) {
            $param_sql .= ", iaca_titulo";
            $bsol_sql .= ", :iaca_titulo";
        }

        if (isset($iaca_anio_grado)) {
            $param_sql .= ", iaca_anio_grado";
            $bsol_sql .= ", :iaca_anio_grado";
        }
        try {
            $sql = "INSERT INTO " . $con->dbname . ".info_academico ($param_sql) VALUES($bsol_sql)";
            $comando = $con->createCommand($sql);

            if (isset($int_id))
                $comando->bindParam(':int_id', $int_id, \PDO::PARAM_INT);

            if (isset($pai_id))
                $comando->bindParam(':pai_id', $pai_id, \PDO::PARAM_INT);

            if (isset($pro_id))
                $comando->bindParam(':pro_id', $pro_id, \PDO::PARAM_INT);

            if (isset($can_id))
                $comando->bindParam(':can_id', $can_id, \PDO::PARAM_INT);

            if (isset($tiac_id))
                $comando->bindParam(':tiac_id', $tiac_id, \PDO::PARAM_INT);

            if (isset($tnes_id))
                $comando->bindParam(':tnes_id', $tnes_id, \PDO::PARAM_INT);

            if (isset($iaca_institucion))
                $comando->bindParam(':iaca_institucion', ucwords(strtolower($iaca_institucion)), \PDO::PARAM_STR);

            if (isset($iaca_titulo))
                $comando->bindParam(':iaca_titulo', ucwords(strtolower($iaca_titulo)), \PDO::PARAM_STR);

            if (isset($iaca_anio_grado))
                $comando->bindParam(':iaca_anio_grado', $iaca_anio_grado, \PDO::PARAM_STR);

            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.info_academico');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }

    public function crearInfoFamInteresado($int_id, $nins_padre, $nins_madre, $ifam_miembro, $ifam_salario) {

        $con = \Yii::$app->db_captacion;
        //$estado = 1;
        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }
        $param_sql = "ifam_estado_logico";
        $bsol_sql = "1";

        $param_sql .= ", ifam_estado";
        $bsol_sql .= ", 1";

        if (isset($int_id)) {
            $param_sql .= ", int_id";
            $bsol_sql .= ", :int_id";
        }
        if (isset($nins_padre)) {
            $param_sql .= ", nins_padre";
            $bsol_sql .= ", :nins_padre";
        }
        if (isset($nins_madre)) {
            $param_sql .= ", nins_madre";
            $bsol_sql .= ", :nins_madre";
        }
        if (isset($ifam_miembro)) {
            $param_sql .= ", ifam_miembro";
            $bsol_sql .= ", :ifam_miembro";
        }

        if (isset($ifam_salario)) {
            $param_sql .= ", ifam_salario";
            $bsol_sql .= ", :ifam_salario";
        }
        try {
            $sql = "INSERT INTO " . $con->dbname . ".informacion_familia ($param_sql) VALUES($bsol_sql)";
            $comando = $con->createCommand($sql);

            if (isset($int_id))
                $comando->bindParam(':int_id', $int_id, \PDO::PARAM_INT);

            if (isset($nins_padre))
                $comando->bindParam(':nins_padre', $nins_padre, \PDO::PARAM_INT);

            if (isset($nins_madre))
                $comando->bindParam(':nins_madre', $nins_madre, \PDO::PARAM_INT);

            if (isset($ifam_miembro))
                $comando->bindParam(':ifam_miembro', $ifam_miembro, \PDO::PARAM_STR);

            if (isset($ifam_salario))
                $comando->bindParam(':ifam_salario', $ifam_salario, \PDO::PARAM_STR);

            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.informacion_familia');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }

    public function crearInfoDisInteresado($int_id, $tdis_id, $idis_discapacidad, $idis_porcentaje, $idis_archivo) {

        $con = \Yii::$app->db_captacion;
        //$estado = 1;
        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }
        $param_sql = "idis_estado_logico";
        $bsol_sql = "1";

        $param_sql .= ", idis_estado";
        $bsol_sql .= ", 1";

        if (isset($int_id)) {
            $param_sql .= ", int_id";
            $bsol_sql .= ", :int_id";
        }

        if (isset($tdis_id)) {
            $param_sql .= ", tdis_id";
            $bsol_sql .= ", :tdis_id";
        }

        if (isset($idis_discapacidad)) {
            $param_sql .= ", idis_discapacidad";
            $bsol_sql .= ", :idis_discapacidad";
        }

        if (isset($idis_porcentaje)) {
            $param_sql .= ", idis_porcentaje";
            $bsol_sql .= ", :idis_porcentaje";
        }

        if (isset($idis_archivo)) {
            $param_sql .= ", idis_archivo";
            $bsol_sql .= ", :idis_archivo";
        }
        try {
            $sql = "INSERT INTO " . $con->dbname . ".info_discapacidad ($param_sql) VALUES($bsol_sql)";
            $comando = $con->createCommand($sql);

            if (isset($int_id))
                $comando->bindParam(':int_id', $int_id, \PDO::PARAM_INT);

            if (isset($tdis_id))
                $comando->bindParam(':tdis_id', $tdis_id, \PDO::PARAM_INT);

            if (isset($idis_discapacidad))
                $comando->bindParam(':idis_discapacidad', $idis_discapacidad, \PDO::PARAM_STR);

            if (isset($idis_porcentaje))
                $comando->bindParam(':idis_porcentaje', $idis_porcentaje, \PDO::PARAM_STR);

            if (isset($idis_archivo))
                $comando->bindParam(':idis_archivo', $idis_archivo, \PDO::PARAM_STR);

            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.info_discapacidad');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }

    public function crearInfoEnfInteresado($int_id, $ienf_enfermedad, $ienf_tipoenfermedad, $ienf_archivo) {

        $con = \Yii::$app->db_captacion;
        //$estado = 1;
        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }
        $param_sql = "ienf_estado_logico";
        $bsol_sql = "1";

        $param_sql .= ", ienf_estado";
        $bsol_sql .= ", 1";

        if (isset($int_id)) {
            $param_sql .= ", int_id";
            $bsol_sql .= ", :int_id";
        }

        if (isset($ienf_enfermedad)) {
            $param_sql .= ", ienf_enfermedad";
            $bsol_sql .= ", :ienf_enfermedad";
        }

        if (isset($ienf_tipoenfermedad)) {
            $param_sql .= ", ienf_tipoenfermedad";
            $bsol_sql .= ", :ienf_tipoenfermedad";
        }

        if (isset($ienf_archivo)) {
            $param_sql .= ", ienf_archivo";
            $bsol_sql .= ", :ienf_archivo";
        }
        try {
            $sql = "INSERT INTO " . $con->dbname . ".info_enfermedad ($param_sql) VALUES($bsol_sql)";
            $comando = $con->createCommand($sql);

            if (isset($int_id))
                $comando->bindParam(':int_id', $int_id, \PDO::PARAM_INT);

            if (isset($ienf_enfermedad))
                $comando->bindParam(':ienf_enfermedad', $ienf_enfermedad, \PDO::PARAM_STR);

            if (isset($ienf_tipoenfermedad))
                $comando->bindParam(':ienf_tipoenfermedad', $ienf_tipoenfermedad, \PDO::PARAM_STR);

            if (isset($ienf_archivo))
                $comando->bindParam(':ienf_archivo', $ienf_archivo, \PDO::PARAM_STR);

            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.info_enfermedad');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }

    public function crearInfoEnfFamiliadisc($int_id, $tpar_id, $tdis_id, $ifdi_discapacidad, $ifdi_porcentaje, $ifdi_archivo) {

        $con = \Yii::$app->db_captacion;
        //$estado = 1;
        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }
        $param_sql = "ifdi_estado_logico";
        $bsol_sql = "1";

        $param_sql .= ", ifdi_estado";
        $bsol_sql .= ", 1";

        if (isset($int_id)) {
            $param_sql .= ", int_id";
            $bsol_sql .= ", :int_id";
        }

        if (isset($tpar_id)) {
            $param_sql .= ", tpar_id";
            $bsol_sql .= ", :tpar_id";
        }

        if (isset($tdis_id)) {
            $param_sql .= ", tdis_id";
            $bsol_sql .= ", :tdis_id";
        }

        if (isset($ifdi_discapacidad)) {
            $param_sql .= ", ifdi_discapacidad";
            $bsol_sql .= ", :ifdi_discapacidad";
        }

        if (isset($ifdi_porcentaje)) {
            $param_sql .= ", ifdi_porcentaje";
            $bsol_sql .= ", :ifdi_porcentaje";
        }

        if (isset($ifdi_archivo)) {
            $param_sql .= ", ifdi_archivo";
            $bsol_sql .= ", :ifdi_archivo";
        }
        try {
            $sql = "INSERT INTO " . $con->dbname . ".info_familia_discapacidad ($param_sql) VALUES($bsol_sql)";
            $comando = $con->createCommand($sql);

            if (isset($int_id))
                $comando->bindParam(':int_id', $int_id, \PDO::PARAM_INT);

            if (isset($tpar_id))
                $comando->bindParam(':tpar_id', $tpar_id, \PDO::PARAM_INT);

            if (isset($tdis_id))
                $comando->bindParam(':tdis_id', $tdis_id, \PDO::PARAM_STR);

            if (isset($ifdi_discapacidad))
                $comando->bindParam(':ifdi_discapacidad', $ifdi_discapacidad, \PDO::PARAM_STR);

            if (isset($ifdi_porcentaje))
                $comando->bindParam(':ifdi_porcentaje', $ifdi_porcentaje, \PDO::PARAM_STR);

            if (isset($ifdi_archivo))
                $comando->bindParam(':ifdi_archivo', $ifdi_archivo, \PDO::PARAM_STR);

            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.info_familia_discapacidad');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }

    public function crearInfoEnfFamilia($int_id, $tpar_id, $ifen_tipoenfermedad, $ifen_enfermedad, $ifen_archivo) {

        $con = \Yii::$app->db_captacion;
        //$estado = 1;
        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }
        $param_sql = "ifen_estado_logico";
        $bsol_sql = "1";

        $param_sql .= ", ifen_estado";
        $bsol_sql .= ", 1";

        if (isset($int_id)) {
            $param_sql .= ", int_id";
            $bsol_sql .= ", :int_id";
        }

        if (isset($tpar_id)) {
            $param_sql .= ", tpar_id";
            $bsol_sql .= ", :tpar_id";
        }

        if (isset($ifen_tipoenfermedad)) {
            $param_sql .= ", ifen_tipoenfermedad";
            $bsol_sql .= ", :ifen_tipoenfermedad";
        }

        if (isset($ifen_enfermedad)) {
            $param_sql .= ", ifen_enfermedad";
            $bsol_sql .= ", :ifen_enfermedad";
        }

        if (isset($ifen_archivo)) {
            $param_sql .= ", ifen_archivo";
            $bsol_sql .= ", :ifen_archivo";
        }
        try {
            $sql = "INSERT INTO " . $con->dbname . ".info_familia_enfermedad ($param_sql) VALUES($bsol_sql)";
            $comando = $con->createCommand($sql);

            if (isset($int_id))
                $comando->bindParam(':int_id', $int_id, \PDO::PARAM_INT);

            if (isset($tpar_id))
                $comando->bindParam(':tpar_id', $tpar_id, \PDO::PARAM_INT);

            if (isset($ifen_tipoenfermedad))
                $comando->bindParam(':ifen_tipoenfermedad', $ifen_tipoenfermedad, \PDO::PARAM_STR);

            if (isset($ifen_enfermedad))
                $comando->bindParam(':ifen_enfermedad', $ifen_enfermedad, \PDO::PARAM_STR);

            if (isset($ifen_archivo))
                $comando->bindParam(':ifen_archivo', $ifen_archivo, \PDO::PARAM_STR);

            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.info_familia_enfermedad');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }

    public static function getInteresados() {
        $con = \Yii::$app->db_captacion;
        $con2 = \Yii::$app->db;
        $estado = 1;

        $sql = "SELECT 
                    per.per_cedula as per_dni,
                    per.per_pri_nombre as per_pri_nombre,                    
                    per.per_seg_nombre as per_seg_nombre,
                    per.per_pri_apellido as per_pri_apellido,
                    per.per_seg_apellido as per_seg_apellido,
                    concat(per.per_pri_nombre ,' ', ifnull(per.per_seg_nombre,' ')) as per_nombres,
                    concat(per.per_pri_apellido ,' ', ifnull(per.per_seg_apellido,' ')) as per_apellidos,
                FROM 
                    " . $con->dbname . ".interesado as inte
                    INNER JOIN " . $con->dbname . ".pre_interesado as pint on inte.pint_id = pint.pint_id
                    INNER JOIN " . $con2->dbname . ".persona as per on pint.per_id = per.per_id 
                WHERE 
                    inte.int_estado_logico=:estado AND 
                    pint.pint_estado_logico=:estado AND
                    per.per_estado_logico=:estado AND 
                    inte.int_estado=:estado AND 
                    pint.pint_estado=:estado AND
                    per.per_estado=:estado";


        $comando = $con->createCommand($sql);
        $estado = 1;
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
                    'per_dni',
                    'per_pri_nombre',
                    'per_seg_nombre',
                    'per_pri_apellido',
                    'per_seg_apellido',
                    'per_nombres',
                    'per_apellidos',
                ],
            ],
        ]);
        return $dataProvider;
    }

    public function consultaDatosPreInteresado($per_id) {
        $con = \Yii::$app->db_captacion;
        $con1 = \Yii::$app->db_asgard;
        $estado = 1;
        $sql = "SELECT  
                  pint.pint_id as id                
                FROM 
                  " . $con1->dbname . ".usuario usu,  
                  " . $con->dbname . ".pre_interesado pint 
                WHERE 
                  usu.per_id = :per_id " . " AND 
                  usu.per_id = pint.per_id AND
                  pint.pint_estado = :estado AND
                  pint.pint_estado_logico = :estado";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
        $resultData = $comando->queryOne();
        return $resultData;
    }

    public function consultaInfofamilia($per_id) {
        $con = \Yii::$app->db_captacion;
        $estado = 1;
        $sql = "SELECT 
                    inte.pint_id as persona, 
                    inte.int_id as interesado, 
                    infa.nins_padre as inst_padre, 
                    infa.nins_madre as inst_madre, 
                    infa.ifam_miembro as miembro, 
                    infa.ifam_salario as salario                    
                FROM 
                    " . $con->dbname . ".interesado inte                 
                    INNER JOIN informacion_familia infa ON infa.int_id = inte.int_id
                    INNER JOIN pre_interesado prei ON prei.pint_id = inte.pint_id
                WHERE  
                    prei.per_id = :per_id AND
                    inte.int_estado_logico = :estado AND 
                    inte.int_estado = :estado AND 
                    infa.ifam_estado_logico = :estado AND 
                    infa.ifam_estado = :estado";


        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
        $resultData = $comando->queryOne();
        return $resultData;
    }

    public function consultaInfoacademico($per_id, $tnes_id) {
        $con = \Yii::$app->db_captacion;
        $estado = 1;
        $sql = "SELECT 
                   inte.pint_id AS  persona, 
                   inte.int_id AS interesado, 
                   infa.pai_id AS pais, 
                   infa.pro_id AS provincia, 
                   infa.can_id AS canton, 
                   infa.tiac_id AS tipo_instituto, 
                   infa.tnes_id AS tipo_estudio, 
                   infa.iaca_institucion AS instituto, 
                   infa.iaca_titulo AS titulo, 
                   infa.iaca_anio_grado AS grado                   
                FROM 
                   " . $con->dbname . ".interesado inte                 
                   INNER JOIN info_academico infa ON infa.int_id = inte.int_id
                   INNER JOIN pre_interesado prei ON prei.pint_id = inte.pint_id
                WHERE 
                   prei.per_id = :per_id AND
                   inte.int_estado_logico = :estado AND 
                   inte.int_estado = :estado AND 
                   infa.iaca_estado_logico = :estado AND 
                   infa.iaca_estado = :estado AND 
                   infa.tnes_id = :tnes_id";
        //inte.pint_id = :per_id AND 
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
        $comando->bindParam(":tnes_id", $tnes_id, \PDO::PARAM_INT);
        $resultData = $comando->queryOne();
        return $resultData;
    }

    public function consultaInfodiscapacidad($per_id) {
        $con = \Yii::$app->db_captacion;
        $estado = 1;
        $sql = "SELECT 
                    inte.pint_id AS persona, 
                    inte.int_id AS interesado,
                    infd.tdis_id AS tipo_discapacidad,
                    infd.idis_discapacidad AS discapacidad,
                    infd.idis_porcentaje AS porcentaje, 
                    infd.idis_archivo AS img_discapacidad
                    
                FROM 
                   " . $con->dbname . ".interesado inte                 
                    INNER JOIN info_discapacidad infd ON infd.int_id = inte.int_id                     
                    INNER JOIN pre_interesado prei ON prei.pint_id = inte.pint_id
                WHERE 
                    prei.per_id = :per_id AND
                    inte.int_estado_logico = :estado AND 
                    inte.int_estado = :estado AND
                    infd.idis_estado_logico = :estado AND 
                    infd.idis_estado = :estado";
        //inte.pint_id = :per_id AND 
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
        $resultData = $comando->queryOne();
        return $resultData;
    }

    public function consultaInfoenfermedad($per_id) {
        $con = \Yii::$app->db_captacion;
        $estado = 1;
        $sql = "SELECT 
                    inte.pint_id AS persona, 
                    inte.int_id AS interesado,               
                    infe.ienf_enfermedad AS enfermedad, 
                    infe.ienf_archivo AS img_enfermedad
                    
                FROM 
                   " . $con->dbname . ".interesado inte 
                    INNER JOIN info_enfermedad infe ON infe.int_id = inte.int_id                     
                    INNER JOIN pre_interesado prei ON prei.pint_id = inte.pint_id
                WHERE 
                    prei.per_id = :per_id AND
                    inte.int_estado_logico = :estado AND 
                    inte.int_estado = :estado AND                    
                    infe.ienf_estado_logico = :estado AND 
                    infe.ienf_estado = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
        $resultData = $comando->queryOne();
        return $resultData;
    }

    public function consultaInfofamailiadisc($per_id) {
        $con = \Yii::$app->db_captacion;
        $estado = 1;
        $sql = "SELECT 
                    inte.pint_id AS persona, 
                    inte.int_id AS interesado,                    
                    infdf.tpar_id AS parentescofa, 
                    infdf.tdis_id AS tipo_descapacidadfa,
                    infdf.ifdi_discapacidad AS discapacidadfa,
                    infdf.ifdi_porcentaje AS porcentajefa,
                    infdf.ifdi_archivo AS img_discapacidadfam
                FROM 
                   " . $con->dbname . ".interesado inte
                    INNER JOIN info_familia_discapacidad infdf ON infdf.int_id = inte.int_id 
                    INNER JOIN pre_interesado prei ON prei.pint_id = inte.pint_id
                WHERE 
                    prei.per_id = :per_id AND
                    inte.int_estado_logico = :estado AND 
                    inte.int_estado = :estado AND                      
                    infdf.ifdi_estado_logico = :estado AND 
                    infdf.ifdi_estado = :estado";
        //inte.pint_id = :per_id AND 
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
        $resultData = $comando->queryOne();
        return $resultData;
    }

    public function consultaInfoenfermedadfam($per_id) {
        $con = \Yii::$app->db_captacion;
        $estado = 1;
        $sql = "SELECT 
                    inte.pint_id AS persona, 
                    inte.int_id AS interesado,                   
                    infef.tpar_id AS parentescoen,
                    infef.ifen_enfermedad AS enfermedaden,
                    infef.ifen_tipoenfermedad AS tipoenfermedaden,
                    infef.ifen_archivo AS img_enfermedadfam
                FROM 
                   " . $con->dbname . ".interesado inte
                    INNER JOIN info_familia_enfermedad infef ON infef.int_id = inte.int_id 
                    INNER JOIN pre_interesado prei ON prei.pint_id = inte.pint_id
                WHERE 
                    prei.per_id = :per_id AND
                    inte.int_estado_logico = :estado AND 
                    inte.int_estado = :estado AND                     
                    infef.ifen_estado_logico = :estado AND 
                    infef.ifen_estado = :estado";
        //inte.pint_id = :per_id AND 
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
        $resultData = $comando->queryOne();
        return $resultData;
    }

    public function consultaInfoadicional($per_id) {
        $con = \Yii::$app->db_captacion;
        $estado = 1;
        $sql = "SELECT 
                    inte.pint_id AS persona, 
                    inte.int_id AS interesado,
                    infd.tdis_id AS tipo_discapacidad,
                    infd.idis_discapacidad AS discapacidad,
                    infd.idis_porcentaje AS porcentaje, 
                    infd.idis_archivo AS img_discapacidad,
                    infe.ienf_enfermedad AS enfermedad, 
                    infe.ienf_archivo AS img_enfermedad,
                    infdf.tpar_id AS parentescofa, 
                    infdf.tdis_id AS tipo_descapacidadfa,
                    infdf.ifdi_discapacidad AS discapacidadfa,
                    infdf.ifdi_porcentaje AS porcentajefa,
                    infdf.ifdi_archivo AS img_discapacidadfam,
                    infef.tpar_id AS parentescoen,
                    infef.ifen_enfermedad AS enfermedaden,
                    infef.ifen_tipoenfermedad AS tipoenfermedaden,
                    infef.ifen_archivo AS img_enfermedadfam
                FROM 
                   " . $con->dbname . ".interesado inte                 
                    INNER JOIN info_discapacidad infd ON infd.int_id = inte.int_id 
                    INNER JOIN info_enfermedad infe ON infe.int_id = inte.int_id 
                    INNER JOIN info_familia_discapacidad infdf ON infdf.int_id = inte.int_id 
                    INNER JOIN info_familia_enfermedad infef ON infef.int_id = inte.int_id 
                    INNER JOIN pre_interesado prei ON prei.pint_id = inte.pint_id
                WHERE 
                    prei.per_id = :per_id AND
                    inte.int_estado_logico = :estado AND 
                    inte.int_estado = :estado AND 
                    infd.idis_estado_logico = :estado AND 
                    infd.idis_estado = :estado AND 
                    infe.ienf_estado_logico = :estado AND 
                    infe.ienf_estado = :estado AND 
                    infdf.ifdi_estado_logico = :estado AND 
                    infdf.ifdi_estado = :estado AND 
                    infef.ifen_estado_logico = :estado AND 
                    infef.ifen_estado = :estado";
        //inte.pint_id = :per_id AND 
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
        $resultData = $comando->queryOne();
        return $resultData;
    }

    public function getInteresadoxIdPersona($per_id) {
        $con = \Yii::$app->db_asgard;
        $con2 = \Yii::$app->db_captacion;
        $estado = 1;
        $sql = "SELECT 
                    inte.int_id AS int_id                            
                FROM 
                   " . $con2->dbname . ".interesado inte                  
                INNER JOIN " . $con->dbname . ".persona per on inte.per_id = per.per_id               
                WHERE                    
                    inte.int_estado_logico=:estado AND
                    inte.int_estado=:estado AND                    
                    per.per_estado_logico=:estado AND 
                    per.per_estado=:estado AND
                    per.per_id =:per_id";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
        $resultData = $comando->queryOne();
        return $resultData;
    }

    public static function consultaInteresadoxejecutivo($per_id, $resp_gruporol, $arrFiltro = array(), $onlyData = false) {

        $con = \Yii::$app->db_captacion;
        $con2 = \Yii::$app->db;
        $con3 = \Yii::$app->db_facturacion;
        $estado = 1;
        $columnsAdd = "";

        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $str_search = "(base.per_pri_nombre like :search OR ";
            $str_search .= "base.per_seg_nombre like :search OR ";
            $str_search .= "base.per_pri_apellido like :search OR ";
            $str_search .= "base.per_dni like :search) ";
            if ($arrFiltro['estadosol'] != "" && $arrFiltro['estadosol'] > 0) {
                $str_search .= " AND base.id_estado = :estadosol ";
            }
            if ($arrFiltro['f_ini'] != "" && $arrFiltro['f_fin'] != "") {
                $str_search .= "  AND fecha_registro >= :fec_ini ";
                $str_search .= "  AND fecha_registro <= :fec_fin ";
            }
        } else {
            $columnsAdd = "
                    per.per_id as per_id";
        }

        $sql = "
                SELECT
                    base.*, 8 grupo_rol
                    from (
                            SELECT 
                                    '0000' as num_solicitud,
                                    'N/A' as fecha_solicitud,
                                    per.per_id as per_id,
                                    per.per_cedula as per_dni,
                                    per.per_pri_nombre as per_pri_nombre, 
                                    per.per_seg_nombre as per_seg_nombre,
                                    per.per_pri_apellido as per_pri_apellido,
                                    per.per_seg_apellido as per_seg_apellido,
                                    concat(per.per_pri_nombre ,' ', ifnull(per.per_seg_nombre,' ')) as per_nombres,
                                    concat(per.per_pri_apellido ,' ', ifnull(per.per_seg_apellido,' ')) as per_apellidos,
                                    per.per_nac_ecuatoriano as nacionalidad,			
                                    inte.int_id,
                                    null as asp_id,
                                    (SELECT ieje.per_id FROM " . $con->dbname . ".interesado_ejecutivo ieje WHERE (ieje.int_id = inte.int_id) AND ieje.ieje_estado = :estado AND ieje.ieje_estado_logico = :estado) as idejecutivo,
                                    (SELECT concat(per.per_pri_apellido ,' ', per.per_seg_apellido, ' ', per.per_pri_nombre ,' ', per.per_seg_nombre) as ejecutivo 
                                            FROM " . $con->dbname . ".interesado_ejecutivo ieje INNER JOIN " . $con2->dbname . ".persona per on ieje.per_id = per.per_id
                                            WHERE ieje.int_id = inte.int_id AND	ieje.ieje_estado = :estado AND ieje.ieje_estado_logico = :estado) as ejecutivo,
                                    6 as id_estado,
                                    'Pendiente Crear Solicitud' as estado_proceso,
                                    'N' as id_estado_pago,
                                    'N/A' as estado_pago,
                                    Date_format(inte.int_fecha_creacion,'%Y-%m %d') as fecha_registro
                            FROM " . $con->dbname . ".interesado as inte		
                            INNER JOIN " . $con2->dbname . ".persona as per on inte.per_id = per.per_id 		
                            WHERE inte.int_estado_interesado=:estado AND
                                    not exists(select 'S' from " . $con->dbname . ".solicitud_inscripcion as soli where soli.int_id = inte.int_id and soli.sins_estado = :estado and soli.sins_estado_logico = :estado) AND 
                                    inte.int_estado_logico=:estado AND		
                                    per.per_estado_logico=:estado AND
                                    inte.int_estado=:estado AND 
                                    per.per_estado=:estado
                            UNION 
                            SELECT
                                    lpad(soli.sins_id,4,'0') as num_solicitud,
                                    Date_format(soli.sins_fecha_solicitud,'%Y-%m-%d') as fecha_solicitud,
                                    per.per_id as per_id,
                                    per.per_cedula as per_dni,
                                    per.per_pri_nombre as per_pri_nombre, 
                                    per.per_seg_nombre as per_seg_nombre,
                                    per.per_pri_apellido as per_pri_apellido,
                                    per.per_seg_apellido as per_seg_apellido,
                                    concat(per.per_pri_nombre ,' ', ifnull(per.per_seg_nombre,' ')) as per_nombres,
                                    concat(per.per_pri_apellido ,' ', ifnull(per.per_seg_apellido,' ')) as per_apellidos,
                                    per.per_nac_ecuatoriano as nacionalidad,			
                                    inte.int_id,
                                    null as asp_id,
                                    (SELECT ieje.per_id FROM " . $con->dbname . ".interesado_ejecutivo ieje WHERE ieje.int_id = inte.int_id AND	ieje.ieje_estado = :estado AND ieje.ieje_estado_logico = :estado) as idejecutivo,			
                                    (SELECT concat(per.per_pri_apellido ,' ', per.per_seg_apellido, ' ', per.per_pri_nombre ,' ', per.per_seg_nombre) as ejecutivo 
                                         FROM " . $con->dbname . ".interesado_ejecutivo ieje INNER JOIN " . $con2->dbname . ".persona per on ieje.per_id = per.per_id
                                             WHERE ieje.int_id = inte.int_id AND ieje.ieje_estado =:estado AND ieje.ieje_estado_logico = :estado) as ejecutivo,
                                    rsol.rsin_id as id_estado,
                                    concat('Solicitud ',rsol.rsin_nombre) as estado_proceso, 
                                    (SELECT opag_estado_pago from " . $con3->dbname . ".orden_pago op where op.sins_id = soli.sins_id and op.opag_estado= :estado and op.opag_estado_logico= :estado) as id_estado_pago,
                                    (CASE when (select opag_estado_pago from " . $con3->dbname . ".orden_pago op where op.sins_id = soli.sins_id and op.opag_estado= :estado and op.opag_estado_logico= :estado) ='P' then 'Generada Pendiente'
                                            when ifnull((select opag_estado_pago from " . $con3->dbname . ".orden_pago op where op.sins_id = soli.sins_id and op.opag_estado= :estado and op.opag_estado_logico= :estado),'N') = 'N' then 'N/A'
                                            else 'Generada Pagada' end) estado_pago,
                                    Date_format(inte.int_fecha_creacion,'%Y-%m %d') as fecha_registro
                            FROM " . $con->dbname . ".interesado as inte		
                                INNER JOIN " . $con2->dbname . ".persona as per on inte.per_id = per.per_id
                                INNER JOIN " . $con->dbname . ".solicitud_inscripcion as soli on soli.int_id = inte.int_id
                                INNER JOIN " . $con->dbname . ".res_sol_inscripcion rsol on rsol.rsin_id = soli.rsin_id		
                            WHERE 
                                inte.int_estado_interesado=:estado AND
                                inte.int_estado_logico=:estado AND		
                                soli.sins_estado_logico=:estado AND 
                                rsol.rsin_estado_logico = :estado AND		
                                per.per_estado_logico=:estado AND
                                inte.int_estado=:estado AND 
                                per.per_estado=:estado AND
                                soli.sins_estado=:estado AND
                                rsol.rsin_estado = :estado
                            UNION
                            SELECT 
                                    lpad(solic.sins_id,4,'0') as num_solicitud,
                                    Date_format(solic.sins_fecha_solicitud,'%Y-%m-%d') as fecha_solicitud,
                                    per.per_id as per_id,
                                    per.per_cedula as per_dni,
                                    per.per_pri_nombre as per_pri_nombre, 
                                    per.per_seg_nombre as per_seg_nombre,
                                    per.per_pri_apellido as per_pri_apellido,
                                    per.per_seg_apellido as per_seg_apellido,
                                    concat(per.per_pri_nombre ,' ', ifnull(per.per_seg_nombre,' ')) as per_nombres,
                                    concat(per.per_pri_apellido ,' ', ifnull(per.per_seg_apellido,' ')) as per_apellidos,
                                    per.per_nac_ecuatoriano as nacionalidad,		
                                    inte.int_id,
                                    asp.asp_id,
                                    (SELECT ieje.per_id FROM " . $con->dbname . ".interesado_ejecutivo ieje 
                                        WHERE (ieje.int_id = inte.int_id or ieje.asp_id = asp.asp_id) AND ieje.ieje_estado = :estado AND ieje.ieje_estado_logico =:estado) as idejecutivo,
                                    (SELECT concat(per.per_pri_apellido ,' ', per.per_seg_apellido, ' ', per.per_pri_nombre ,' ', per.per_seg_nombre) as ejecutivo 
                                        FROM " . $con->dbname . ".interesado_ejecutivo ieje INNER JOIN " . $con2->dbname . ".persona per on ieje.per_id = per.per_id 
                                        WHERE (ieje.int_id = inte.int_id or ieje.asp_id = asp.asp_id) AND ieje.ieje_estado = :estado AND ieje.ieje_estado_logico = :estado) as ejecutivo,	
                                    rsol.rsin_id as id_estado,
                                    CONCAT('Solicitud ',rsol.rsin_nombre) as estado_proceso, 
                                    ifnull((select opag_estado_pago from " . $con3->dbname . ".orden_pago op where op.sins_id = solic.sins_id and op.opag_estado= :estado and op.opag_estado_logico= :estado),'N') as id_estado_pago,
                                    (CASE when ifnull((select opag_estado_pago from " . $con3->dbname . ".orden_pago op where op.sins_id = solic.sins_id and op.opag_estado= :estado and op.opag_estado_logico= :estado),'N') ='N' then 'No Aplica'
                                          when (select opag_estado_pago from " . $con3->dbname . ".orden_pago op where op.sins_id = solic.sins_id and op.opag_estado= :estado and op.opag_estado_logico= :estado) ='P' then 'Generada Pendiente' 
                                          else 'Generada Pagada' end) estado_pago,
                                    Date_format(inte.int_fecha_creacion,'%Y-%m %d') as fecha_registro
                            FROM " . $con->dbname . ".aspirante as asp
                                INNER JOIN " . $con->dbname . ".interesado as inte on inte.int_id = asp.int_id
                                INNER JOIN " . $con2->dbname . ".persona as per on inte.per_id = per.per_id
                                INNER JOIN " . $con->dbname . ".solicitud_inscripcion as solic on solic.int_id = inte.int_id
                                INNER JOIN " . $con->dbname . ".res_sol_inscripcion rsol on rsol.rsin_id = solic.rsin_id 
                            WHERE asp.asp_estado_logico = :estado AND
                                inte.int_estado_logico=:estado AND 
                                per.per_estado_logico= :estado AND
                                solic.sins_estado_logico=:estado AND
                                rsol.rsin_estado_logico = :estado AND
                                asp.asp_estado = :estado AND
                                per.per_estado=:estado AND
                                solic.sins_estado=:estado AND
                                rsol.rsin_estado = :estado
                    ) base ";
        // if ($resp_gruporol != '5' && $resp_gruporol != '6' && $resp_gruporol != '7' && $resp_gruporol != '1' && $resp_gruporol != '14' && $resp_gruporol != '15' ) {
        if ($resp_gruporol == '8') {
            $sql1 = "  where base.idejecutivo = :per_id ";
        }

        if (empty($sql1)) {
            if (!empty($str_search)) {
                $sql .= " where " . $str_search . " ORDER BY fecha_registro DESC";
            } else {
                $sql .= " ORDER BY fecha_registro DESC";
            }
        } else {
            if (!empty($str_search)) {
                $sql .= $sql1 . "AND " . $str_search . " ORDER BY fecha_registro DESC";
            } else {
                $sql .= $sql1 . " ORDER BY fecha_registro DESC";
            }
        }

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
        $comando->bindParam(":resp_gruporol", $resp_gruporol, \PDO::PARAM_INT);

        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $search_cond = "%" . $arrFiltro["search"] . "%";
            $fecha_ini = $arrFiltro["f_ini"] . " 00:00:00";
            $fecha_fin = $arrFiltro["f_fin"] . " 23:59:59";
            $estadoSol = $arrFiltro["estadosol"];
            $comando->bindParam(":search", $search_cond, \PDO::PARAM_STR);

            if ($arrFiltro['estadosol'] != "" && $arrFiltro['estadosol'] > 0) {
                $comando->bindParam(":estadosol", $estadoSol, \PDO::PARAM_STR);
            }
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
                    'num_solicitud',
                    'fecha_solicitud',
                    'per_dni',
                    'per_nombres',
                    'per_apellidos',
                    'persona_id',
                    'estado',
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
     * Function consultagruporol
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>
     * @param     
     * @return  
     */
    public function consultagruporol($per_id) {
        $con = \Yii::$app->db_asgard;
        $estado = 1;
        $sql = "SELECT                   
                  grur.grol_id as grol_id
                FROM " . $con->dbname . ".usuario usu 
                  INNER JOIN " . $con->dbname . ".usua_grol_eper usug ON usug.usu_id = usu.usu_id
                  INNER JOIN " . $con->dbname . ".grup_rol grur ON grur.grol_id = usug.grol_id
                  INNER JOIN " . $con->dbname . ".rol rol ON rol.rol_id = grur.grol_id
                WHERE 
                  per_id = :per_id AND
                  usu.usu_estado_logico = :estado AND
                  usu.usu_estado = :estado AND
                  grur.grol_estado_logico = :estado AND
                  grur.grol_estado = :estado AND
                  usug.ugep_estado_logico = :estado AND
                  usug.ugep_estado = :estado AND
                  rol.rol_estado_logico = :estado AND
                  rol.rol_estado = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);

        $resultData = $comando->queryOne();
        return $resultData;
    }

    /**
     * Function modifica el estado de pre interesado cuando ya es interesado
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>
     * @property integer $userid       
     * @return  
     */
    public function modificaPreInteresado($pint_id) {
        $con = \Yii::$app->db_captacion;
        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }
        $estado_preinteresado = 0;
        $estado = 1;
        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".pre_interesado 		       
                      SET pint_estado_preinteresado = :estado_preinteresado
                      WHERE pint_id = :pint_id AND 
                      pint_estado = :estado AND
                      pint_estado_logico = :estado");

            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
            $comando->bindParam(":estado_preinteresado", $estado_preinteresado, \PDO::PARAM_STR);
            $comando->bindParam(":pint_id", $pint_id, \PDO::PARAM_INT);
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
     * Function modificaGruporol (modifica el grupo rol id)
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @property integer $per_id       
     * @return  
     */
    public function modificaGruporol($per_id, $grol_id) {
        $con = \Yii::$app->db;
        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        $estado = 1;
        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".usua_grol_eper ugrol INNER JOIN " . $con->dbname . ".usuario usu 
		             ON ugrol.usu_id = usu.usu_id
                      SET ugrol.grol_id = :grol_id
                      WHERE usu.per_id = :per_id AND 
                            usu.usu_estado = :estado AND
                            usu.usu_estado_logico = :estado AND
                            ugrol.ugep_estado = :estado AND
                            ugrol.ugep_estado_logico = :estado");

            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
            $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
            $comando->bindParam(":grol_id", $grol_id, \PDO::PARAM_STR);
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
     * Function consultaPreinteresadas (consulta las personas pre-interesadas que no han 
     *                                  activado cuenta en asgard.)
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @property      
     * @return  
     */
    public static function consultaPreinteresadas($arrFiltro = array(), $onlyData = false) {
        $con = \Yii::$app->db;
        $estado = 1;

        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $str_search = "(ppre.ppre_pri_nombre  like :search OR ";
            $str_search .= "ppre.ppre_pri_apellido like :search OR ";
            $str_search .= "ppre.ppre_cedula like :search) AND ";
            if ($arrFiltro['f_ini'] != "" && $arrFiltro['f_fin'] != "") {
                $str_search .= "ppre.ppre_fecha_registro >= :fec_ini AND ";
                $str_search .= "ppre.ppre_fecha_registro <= :fec_fin AND ";
            }
        }

        $sql = "SELECT ppre.ppre_fecha_registro as fecha_registro, 
                        ppre.ppre_cedula as dni, 
                        ppre.ppre_pri_nombre as nombres, 
                        ppre.ppre_pri_apellido as apellidos,
                        ppre_celular as celular, ppre_correo  as correo
                 FROM " . $con->dbname . ".persona_preins ppre
                 WHERE $str_search
                       not ppre_cedula in (select per_cedula
                                           from persona per
                                            where per_estado = :estado and
                                                  per_estado_logico = :estado) and
                       ppre_estado = :estado and
                       ppre_estado_logico = :estado 
                 ORDER BY ppre.ppre_fecha_registro desc";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);

        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $search_cond = "%" . $arrFiltro["search"] . "%";
            $fecha_ini = $arrFiltro["f_ini"] . " 00:00:00";
            $fecha_fin = $arrFiltro["f_fin"] . " 23:59:59";
            $comando->bindParam(":search", $search_cond, \PDO::PARAM_STR);

            if ($arrFiltro['estadosol'] != "" && $arrFiltro['estadosol'] > 0) {
                $comando->bindParam(":estadosol", $estadoSol, \PDO::PARAM_STR);
            }
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
                    'ppre_fecha_registro',
                    'ppre_cedula',
                    'per_dni',
                    'ppre_pri_nombre',
                    'ppre_pri_apellido'
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
     * Function modificarInfoAcaInteresado
     * @author  Grace Viteri
     * @property      
     * @return  
     */
    public function modificarInfoAcaInteresado($int_id, $pai_id, $pro_id, $can_id, $tiac_id, $tnes_id, $iaca_institucion, $iaca_titulo, $iaca_anio_grado) {
        $con = \Yii::$app->db_captacion;
        $iaca_fecha_modificacion = date("Y-m-d H:i:s");
        $estado = 1;

        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".info_academico 		       
                      SET 
                        pai_id = :pai_id,    
                        pro_id = :pro_id,
                        can_id = :can_id,
                        tiac_id = :tiac_id,
                        tnes_id = :tnes_id, 
                        iaca_institucion = :iaca_institucion,
                        iaca_titulo = :iaca_titulo,
                        iaca_anio_grado = :iaca_anio_grado,
                        iaca_fecha_modificacion = :iaca_fecha_modificacion
                      WHERE 
                        int_id = :int_id AND
                        iaca_estado = :estado AND
                        iaca_estado_logico = :estado");
            $comando->bindParam(":int_id", $int_id, \PDO::PARAM_INT);
            $comando->bindParam(":pai_id", $pai_id, \PDO::PARAM_INT);
            $comando->bindParam(":pro_id", $pro_id, \PDO::PARAM_INT);
            $comando->bindParam(":can_id", $can_id, \PDO::PARAM_INT);
            $comando->bindParam(":tiac_id", $tiac_id, \PDO::PARAM_INT);
            $comando->bindParam(":tnes_id", $tnes_id, \PDO::PARAM_INT);
            $comando->bindParam(":iaca_institucion", $iaca_institucion, \PDO::PARAM_STR);
            $comando->bindParam(":iaca_titulo", $iaca_titulo, \PDO::PARAM_STR);
            $comando->bindParam(":iaca_anio_grado", $iaca_anio_grado, \PDO::PARAM_STR);
            $comando->bindParam(":iaca_fecha_modificacion", $iaca_fecha_modificacion, \PDO::PARAM_STR);
            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
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
     * Function modificarInfoFamInteresado
     * @author  Grace Viteri
     * @property      
     * @return  
     */
    public function modificarInfoFamInteresado($int_id, $nins_padre, $nins_madre, $ifam_miembro, $ifam_salario) {
        $con = \Yii::$app->db_captacion;
        $ifam_fecha_modificacion = date("Y-m-d H:i:s");
        $estado = 1;

        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".informacion_familia 		       
                      SET 
                        nins_padre = :nins_padre,    
                        nins_madre = :nins_madre,
                        ifam_miembro = :ifam_miembro,
                        ifam_salario = :ifam_salario,                        
                        ifam_fecha_modificacion = :ifam_fecha_modificacion
                      WHERE 
                        int_id = :int_id AND
                        ifam_estado = :estado AND
                        ifam_estado_logico = :estado");
            $comando->bindParam(":int_id", $int_id, \PDO::PARAM_INT);
            $comando->bindParam(":nins_padre", $nins_padre, \PDO::PARAM_INT);
            $comando->bindParam(":nins_madre", $nins_madre, \PDO::PARAM_INT);
            $comando->bindParam(":ifam_miembro", $ifam_miembro, \PDO::PARAM_STR);
            $comando->bindParam(":ifam_salario", $ifam_salario, \PDO::PARAM_STR);
            $comando->bindParam(":ifam_fecha_modificacion", $ifam_fecha_modificacion, \PDO::PARAM_STR);
            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
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
     * Function modificarInfoDisInteresado
     * @author  Grace Viteri
     * @property      
     * @return  
     */
    public function modificarInfoDisInteresado($int_id, $tdis_id, $idis_discapacidad, $idis_porcentaje, $idis_archivo) {
        $con = \Yii::$app->db_captacion;
        $idis_fecha_modificacion = date("Y-m-d H:i:s");
        $estado = 1;

        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".info_discapacidad		       
                      SET 
                        tdis_id = :tdis_id,    
                        idis_discapacidad = :idis_discapacidad,
                        idis_porcentaje = :idis_porcentaje,
                        idis_archivo = :idis_archivo,                        
                        idis_fecha_modificacion = :idis_fecha_modificacion
                      WHERE 
                        int_id = :int_id AND
                        idis_estado = :estado AND
                        idis_estado_logico = :estado");
            $comando->bindParam(":int_id", $int_id, \PDO::PARAM_INT);
            $comando->bindParam(":tdis_id", $tdis_id, \PDO::PARAM_INT);
            $comando->bindParam(":idis_discapacidad", $idis_discapacidad, \PDO::PARAM_STR);
            $comando->bindParam(":idis_porcentaje", $idis_porcentaje, \PDO::PARAM_STR);
            $comando->bindParam(":idis_archivo", $idis_archivo, \PDO::PARAM_STR);
            $comando->bindParam(":idis_fecha_modificacion", $idis_fecha_modificacion, \PDO::PARAM_STR);
            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
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
     * Function modificarInfoEnfInteresado
     * @author  Grace Viteri
     * @property      
     * @return  
     */
    public function modificarInfoEnfInteresado($int_id, $ienf_enfermedad, $ienf_tipoenfermedad, $ienf_archivo) {
        $con = \Yii::$app->db_captacion;
        $ienf_fecha_modificacion = date("Y-m-d H:i:s");
        $estado = 1;

        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".info_enfermedad		       
                      SET 
                        ienf_enfermedad = :ienf_enfermedad,    
                        ienf_tipoenfermedad = :ienf_tipoenfermedad,
                        ienf_archivo = :ienf_archivo,                        
                        ienf_fecha_modificacion = :ienf_fecha_modificacion
                      WHERE 
                        int_id = :int_id AND
                        ienf_estado = :estado AND
                        ienf_estado_logico = :estado");
            $comando->bindParam(":int_id", $int_id, \PDO::PARAM_INT);
            $comando->bindParam(":ienf_enfermedad", $ienf_enfermedad, \PDO::PARAM_STR);
            $comando->bindParam(":ienf_tipoenfermedad", $ienf_tipoenfermedad, \PDO::PARAM_STR);
            $comando->bindParam(":ienf_archivo", $ienf_archivo, \PDO::PARAM_STR);
            $comando->bindParam(":ienf_fecha_modificacion", $ienf_fecha_modificacion, \PDO::PARAM_STR);
            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
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
     * Function modificarInfoEnfFamiliadisc
     * @author  Grace Viteri
     * @property      
     * @return  
     */
    public function modificarInfoEnfFamiliadisc($int_id, $tpar_id, $tdis_id, $ifdi_discapacidad, $ifdi_porcentaje, $ifdi_archivo) {
        $con = \Yii::$app->db_captacion;
        $ifdi_fecha_modificacion = date("Y-m-d H:i:s");
        $estado = 1;

        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".info_familia_discapacidad		       
                      SET 
                        tpar_id = :tpar_id,    
                        tdis_id = :tdis_id,
                        ifdi_discapacidad = :ifdi_discapacidad,
                        ifdi_porcentaje = :ifdi_porcentaje,
                        ifdi_archivo = :ifdi_archivo,                        
                        ifdi_fecha_modificacion = :ifdi_fecha_modificacion
                      WHERE 
                        int_id = :int_id AND
                        ifdi_estado = :estado AND
                        ifdi_estado_logico = :estado");
            $comando->bindParam(":int_id", $int_id, \PDO::PARAM_INT);
            $comando->bindParam(":tpar_id", $tpar_id, \PDO::PARAM_INT);
            $comando->bindParam(":tdis_id", $tdis_id, \PDO::PARAM_INT);
            $comando->bindParam(":ifdi_discapacidad", $ifdi_discapacidad, \PDO::PARAM_STR);
            $comando->bindParam(":ifdi_porcentaje", $ifdi_porcentaje, \PDO::PARAM_STR);
            $comando->bindParam(":ifdi_archivo", $ifdi_archivo, \PDO::PARAM_STR);
            $comando->bindParam(":ifdi_fecha_modificacion", $ifdi_fecha_modificacion, \PDO::PARAM_STR);
            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
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
     * Function modificarInfoEnfFamilia
     * @author  Grace Viteri
     * @property      
     * @return  
     */
    public function modificarInfoEnfFamilia($int_id, $tpar_id, $ifen_tipoenfermedad, $ifen_enfermedad, $ifen_archivo) {
        $con = \Yii::$app->db_captacion;
        $ifen_fecha_modificacion = date("Y-m-d H:i:s");
        $estado = 1;

        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".info_familia_enfermedad		       
                      SET 
                        tpar_id = :tpar_id,    
                        ifen_tipoenfermedad = :ifen_tipoenfermedad,
                        ifen_enfermedad = :ifen_enfermedad,                        
                        ifen_archivo = :ifen_archivo,                        
                        ifen_fecha_modificacion = :ifen_fecha_modificacion
                      WHERE 
                        int_id = :int_id AND
                        ifdi_estado = :estado AND
                        ifdi_estado_logico = :estado");
            $comando->bindParam(":int_id", $int_id, \PDO::PARAM_INT);
            $comando->bindParam(":tpar_id", $tpar_id, \PDO::PARAM_INT);
            $comando->bindParam(":ifen_tipoenfermedad", $ifen_tipoenfermedad, \PDO::PARAM_INT);
            $comando->bindParam(":ifen_enfermedad", $ifen_enfermedad, \PDO::PARAM_STR);
            $comando->bindParam(":ifen_archivo", $ifen_archivo, \PDO::PARAM_STR);
            $comando->bindParam(":ifen_fecha_modificacion", $ifen_fecha_modificacion, \PDO::PARAM_STR);
            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
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
     * Function inactivarInfoDisInteresado
     * @author  Grace Viteri
     * @property      
     * @return  
     */
    public function inactivarInfoDisInteresado($int_id) {
        $con = \Yii::$app->db_captacion;
        $idis_fecha_modificacion = date("Y-m-d H:i:s");
        $estado = 1;
        $estado_inactiva = 0;

        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".info_discapacidad            
                      SET 
                        idis_estado = :estado_inactiva,
                        idis_fecha_modificacion = :idis_fecha_modificacion
                      WHERE 
                        int_id = :int_id AND
                        idis_estado = :estado AND
                        idis_estado_logico = :estado");
            $comando->bindParam(":int_id", $int_id, \PDO::PARAM_INT);
            $comando->bindParam(":idis_fecha_modificacion", $idis_fecha_modificacion, \PDO::PARAM_STR);
            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
            $comando->bindParam(":estado_inactiva", $estado_inactiva, \PDO::PARAM_STR);
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
     * Function inactivarInfoEnfInteresado
     * @author  Grace Viteri
     * @property      
     * @return  
     */
    public function inactivarInfoEnfInteresado($int_id) {
        $con = \Yii::$app->db_captacion;
        $ienf_fecha_modificacion = date("Y-m-d H:i:s");
        $estado = 1;
        $estado_inactiva = 0;

        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".info_enfermedad              
                      SET 
                        ienf_estado = :estado_inactiva,
                        ienf_fecha_modificacion = :ienf_fecha_modificacion
                      WHERE 
                        int_id = :int_id AND
                        ienf_estado = :estado AND
                        ienf_estado_logico = :estado");
            $comando->bindParam(":int_id", $int_id, \PDO::PARAM_INT);
            $comando->bindParam(":ienf_fecha_modificacion", $ienf_fecha_modificacion, \PDO::PARAM_STR);
            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
            $comando->bindParam(":estado_inactiva", $estado_inactiva, \PDO::PARAM_STR);
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
     * Function inactivarInfoEnfFamiliadisc
     * @author  Grace Viteri
     * @property      
     * @return  
     */
    public function inactivarInfoEnfFamiliadisc($int_id) {
        $con = \Yii::$app->db_captacion;
        $ifdi_fecha_modificacion = date("Y-m-d H:i:s");
        $estado = 1;
        $estado_inactiva = 0;

        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".info_familia_discapacidad            
                      SET 
                        ifdi_estado = :estado_inactiva,
                        ifdi_fecha_modificacion = :ifdi_fecha_modificacion
                      WHERE 
                        int_id = :int_id AND
                        ifdi_estado = :estado AND
                        ifdi_estado_logico = :estado");
            $comando->bindParam(":int_id", $int_id, \PDO::PARAM_INT);
            $comando->bindParam(":ifdi_fecha_modificacion", $ifdi_fecha_modificacion, \PDO::PARAM_STR);
            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
            $comando->bindParam(":estado_inactiva", $estado_inactiva, \PDO::PARAM_STR);
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
     * Function inactivarInfoEnfFamilia
     * @author  Grace Viteri
     * @property      
     * @return  
     */
    public function inactivarInfoEnfFamilia($int_id) {
        $con = \Yii::$app->db_captacion;
        $ifen_fecha_modificacion = date("Y-m-d H:i:s");
        $estado = 1;
        $estado_inactiva = 0;

        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".info_familia_enfermedad              
                      SET 
                        ifdi_estado = :estado_inactiva,        
                        ifen_fecha_modificacion = :ifen_fecha_modificacion
                      WHERE 
                        int_id = :int_id AND
                        ifdi_estado = :estado AND
                        ifdi_estado_logico = :estado");
            $comando->bindParam(":int_id", $int_id, \PDO::PARAM_INT);
            $comando->bindParam(":ifen_fecha_modificacion", $ifen_fecha_modificacion, \PDO::PARAM_STR);
            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
            $comando->bindParam(":estado_inactiva", $estado_inactiva, \PDO::PARAM_STR);
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
     * Function consultaGruporol (consulta el grupo rol id)
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @property integer $per_id       
     * @return  
     */
    public function consultaGruporolinteresado($per_id) {
        $con = \Yii::$app->db_asgard;
        $estado = 1;

        $sql = "SELECT ugrol.grol_id 
                FROM " . $con->dbname . ".usua_grol_eper ugrol INNER JOIN " . $con->dbname . ".usuario usu 
                        ON ugrol.usu_id = usu.usu_id
                 WHERE usu.per_id = :per_id AND 
                       usu.usu_estado = :estado AND
                       usu.usu_estado_logico = :estado AND
                       ugrol.ugep_estado = :estado AND
                       ugrol.ugep_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
        $comando->bindParam(":grol_id", $grol_id, \PDO::PARAM_STR);

        $resultData = $comando->queryOne();
        return $resultData;
    }

    public function enviarCorreoBienvenida($email_info) {
        $tituloMensaje = Yii::t("register", "Successful Registration");
        $asunto = Yii::t("BienvenidaADContacto", "User Register");
        $body = Utilities::getMailMessage("register", array(
                    "[[nombres]]" => $data_to_send["nombre"],
                    "[[apellidos]]" => $data_to_send["apellido"],
                ), Yii::$app->language);
        Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], [ $data_to_send["correo"] => $data_to_send["nombre"] . " " . $data_to_send["apellido"]], $asunto, $body);
        
        $message = array(
            "wtmessage" => Yii::t("notificaciones", "La infomación ha sido grabada. Por favor para activar su cuenta revise su correo electrónico y siga los pasos."),
            "title" => Yii::t('jslang', 'Success'),
        );
        echo Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
    }

    /**
     * Function consultapermisoopcion.
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param     
     * @return  
     */
    public function consultapermisoopcion($per_id, $opcion) {
        $con = \Yii::$app->db_asgard;
        $estado = 1;
        $sql = "SELECT                   
                    gogr.gmod_id as gmod_id
                FROM " . $con->dbname . ".usuario usu 
                    INNER JOIN " . $con->dbname . ".usua_grol_eper ug ON ug.usu_id = usu.usu_id
                    INNER JOIN " . $con->dbname . ".grup_rol gr ON gr.grol_id = ug.grol_id
                    INNER JOIN " . $con->dbname . ".grup_obmo go ON go.gru_id = gr.gru_id
                    INNER JOIN " . $con->dbname . ".grup_obmo_grup_rol gogr ON (gogr.gmod_id = go.gmod_id and gogr.grol_id = gr.grol_id)	 
                WHERE 
                    usu.per_id = :per_id AND
                    go.omod_id = :opcion AND
                    usu.usu_estado_logico = :estado AND
                    usu.usu_estado = :estado AND
                    gr.grol_estado_logico = :estado AND
                    gr.grol_estado = :estado AND
                    ug.ugep_estado_logico = :estado AND
                    ug.ugep_estado = :estado AND
                    go.gmod_estado = :estado AND
                    go.gmod_estado_logico = :estado AND
                    gogr.gogr_estado = :estado AND
                    gogr.gogr_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
        $comando->bindParam(":opcion", $opcion, \PDO::PARAM_INT);

        $resultData = $comando->queryOne();
        return $resultData;
    }

}
