<?php

namespace app\models;

use app\models\Persona;
use Yii;
use yii\data\ArrayDataProvider;

/**
 * This is the model class for table "expediente_profesor".
 *
 * @property int $epro_id
 * @property int $per_id
 * @property int $cgen_id
 * @property string $epro_acepta
 * @property string $epro_fecha_acepta
 * @property int $epro_estado_expediente
 * @property int $usu_id
 * @property string $epro_fecha_revision
 * @property string $epro_estado
 * @property string $epro_fecha_creacion
 * @property string $epro_fecha_modificacion
 * @property string $epro_estado_logico
 */
class ExpedienteProfesor extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'expediente_profesor';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb() {
        return Yii::$app->get('db_claustro');
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['per_id', 'epro_estado', 'epro_estado_logico'], 'required'],
            [['per_id', 'cgen_id', 'epro_estado_expediente', 'usu_id'], 'integer'],
            [['epro_fecha_acepta', 'epro_fecha_revision', 'epro_fecha_creacion', 'epro_fecha_modificacion'], 'safe'],
            [['epro_acepta', 'epro_estado', 'epro_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'epro_id' => 'Epro ID',
            'per_id' => 'Per ID',
            'cgen_id' => 'Cgen ID',
            'epro_acepta' => 'Epro Acepta',
            'epro_fecha_acepta' => 'Epro Fecha Acepta',
            'epro_estado_expediente' => 'Epro Estado Expediente',
            'usu_id' => 'Usu ID',
            'epro_fecha_revision' => 'Epro Fecha Revision',
            'epro_estado' => 'Epro Estado',
            'epro_fecha_creacion' => 'Epro Fecha Creacion',
            'epro_fecha_modificacion' => 'Epro Fecha Modificacion',
            'epro_estado_logico' => 'Epro Estado Logico',
        ];
    }

    /**
     * Function Obtiene datos principales del profesor.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarExpedienteProfesor($per_id) {
        $con = \Yii::$app->db_claustro;
        $estado = 1;
        $sql = "SELECT epro_id, cgen_id
                FROM 
                   " . $con->dbname . ".expediente_profesor  
                WHERE 
                   per_id = :per_id  AND
                   epro_estado = :estado AND
                   epro_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);

        $resultData = $comando->queryOne();
        return $resultData;
    }    

    /**
     * Function grabar la inserción 
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function insertarExpediente($per_id) {
        $con = \Yii::$app->db_claustro;

        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        $param_sql = "epro_estado_logico";
        $bexp_sql = "1";

        $param_sql .= ", epro_estado";
        $bexp_sql .= ", 1";

        if (isset($per_id)) {
            $param_sql .= ", per_id";
            $bexp_sql .= ", :per_id";
        }

        try {
            $sql = "INSERT INTO " . $con->dbname . ".expediente_profesor ($param_sql) VALUES($bexp_sql)";
            $comando = $con->createCommand($sql);

            if (isset($per_id)) {
                $comando->bindParam(':per_id', $per_id, \PDO::PARAM_INT);
            }
            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.expediente_profesor');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }

    /**
     * Function grabar la inserción del detalle de antecedentes familiares.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function insertarDet_antecedentesfam($per_id, $tpar_id, $tafam_id, $dafa_nombres, $dafa_apellidos, $dafa_fecha_nacimiento, $dafa_ocupacion, $dafa_genero, $dafa_carga_actual, $ipdi_id, $dafa_archivo) {
        $con = \Yii::$app->db_general;

        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        $param_sql = "dafa_estado_logico";
        $bdet_sql = "1";

        $param_sql .= ", dafa_estado";
        $bdet_sql .= ", 1";

        if (isset($per_id)) {
            $param_sql .= ", per_id";
            $bdet_sql .= ", :per_id";
        }

        if (isset($tpar_id)) {
            $param_sql .= ", tpar_id";
            $bdet_sql .= ", :tpar_id";
        }

        if (isset($tafam_id)) {
            $param_sql .= ", tafa_id";
            $bdet_sql .= ", :tafa_id";
        }

        if (isset($ipdi_id)) {
            $param_sql .= ", ipdi_id";
            $bdet_sql .= ", :ipdi_id";
        }

        if (isset($dafa_nombres)) {
            $param_sql .= ", dafa_nombres";
            $bdet_sql .= ", :dafa_nombres";
        }

        if (isset($dafa_apellidos)) {
            $param_sql .= ", dafa_apellidos";
            $bdet_sql .= ", :dafa_apellidos";
        }

        if (isset($dafa_fecha_nacimiento)) {
            $param_sql .= ", dafa_fecha_nacimiento";
            $bdet_sql .= ", :dafa_fecha_nacimiento";
        }

        if (isset($dafa_ocupacion)) {
            $param_sql .= ", dafa_ocupacion";
            $bdet_sql .= ", :dafa_ocupacion";
        }

        if (isset($dafa_genero)) {
            $param_sql .= ", dafa_genero";
            $bdet_sql .= ", :dafa_genero";
        }

        if (isset($dafa_carga_actual)) {
            $param_sql .= ", dafa_carga_actual";
            $bdet_sql .= ", :dafa_carga_actual";
        }

        if (isset($dafa_archivo)) {
            $param_sql .= ", dafa_archivo";
            $bdet_sql .= ", :dafa_archivo";
        }
        try {
            $sql = "INSERT INTO " . $con->dbname . ".detalle_antecedentes_fam ($param_sql) VALUES($bdet_sql)";
            $comando = $con->createCommand($sql);

            if (isset($per_id))
                $comando->bindParam(':per_id', $per_id, \PDO::PARAM_INT);

            if (isset($tpar_id))
                $comando->bindParam(':tpar_id', $tpar_id, \PDO::PARAM_INT);

            if (isset($tafam_id))
                $comando->bindParam(':tafa_id', $tafam_id, \PDO::PARAM_INT);

            if (!empty((isset($ipdi_id))))
                $comando->bindParam(':ipdi_id', $ipdi_id, \PDO::PARAM_INT);

            if (isset($dafa_nombres))
                $comando->bindParam(':dafa_nombres', $dafa_nombres, \PDO::PARAM_STR);

            if (isset($dafa_apellidos))
                $comando->bindParam(':dafa_apellidos', $dafa_apellidos, \PDO::PARAM_STR);

            if (!empty((isset($dafa_fecha_nacimiento))))
                $comando->bindParam(':dafa_fecha_nacimiento', $dafa_fecha_nacimiento, \PDO::PARAM_STR);

            if (!empty((isset($dafa_ocupacion))))
                $comando->bindParam(':dafa_ocupacion', $dafa_ocupacion, \PDO::PARAM_STR);

            if (!empty((isset($dafa_genero))))
                $comando->bindParam(':dafa_genero', $dafa_genero, \PDO::PARAM_STR);

            if (!empty((isset($dafa_carga_actual))))
                $comando->bindParam(':dafa_carga_actual', $dafa_carga_actual, \PDO::PARAM_STR);

            if (!empty((isset($dafa_archivo))))
                $comando->bindParam(':dafa_archivo', $dafa_archivo, \PDO::PARAM_STR);

            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.detalle_antecedentes_fam');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }

    /**
     * Function grabar la inserción de las discapacitaciones.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function insertarDiscapacidad($tdis_id, $per_id, $ipdi_carnet_conadis, $ipdi_discapacidad, $ipdi_porcentaje, $ipdi_archivo, $ipdi_ruta) {
        $con = \Yii::$app->db_general;
        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una.
        }

        $param_sql = "ipdi_estado_logico";
        $bdet_sql = "1";

        $param_sql .= ", ipdi_estado";
        $bdet_sql .= ", 1";

        if (isset($tdis_id)) {
            $param_sql .= ", tdis_id";
            $bdet_sql .= ", :tdis_id";
        }

        if (isset($per_id)) {
            $param_sql .= ", per_id";
            $bdet_sql .= ", :per_id";
        }

        if (isset($ipdi_carnet_conadis)) {
            $param_sql .= ", ipdi_carnet_conadis";
            $bdet_sql .= ", :ipdi_carnet_conadis";
        }

        if (isset($ipdi_discapacidad)) {
            $param_sql .= ", ipdi_discapacidad";
            $bdet_sql .= ", :ipdi_discapacidad";
        }

        if (isset($ipdi_porcentaje)) {
            $param_sql .= ", ipdi_porcentaje";
            $bdet_sql .= ", :ipdi_porcentaje";
        }

        if (isset($ipdi_archivo)) {
            $param_sql .= ", ipdi_archivo";
            $bdet_sql .= ", :ipdi_archivo";
        }

        if (isset($ipdi_ruta)) {
            $param_sql .= ", ipdi_ruta";
            $bdet_sql .= ", :ipdi_ruta";
        }

        try {
            $sql = "INSERT INTO " . $con->dbname . ".info_per_discapacidad ($param_sql) VALUES($bdet_sql)";
            $comando = $con->createCommand($sql);

            if (isset($tdis_id)) {
                $comando->bindParam(':tdis_id', $tdis_id, \PDO::PARAM_INT);
            }
            if (isset($per_id)) {
                $comando->bindParam(':per_id', $per_id, \PDO::PARAM_INT);
            }
            if (!empty((isset($ipdi_carnet_conadis)))) {
                $comando->bindParam(':ipdi_carnet_conadis', $ipdi_carnet_conadis, \PDO::PARAM_STR);
            }
            if (!empty((isset($ipdi_discapacidad)))) {
                $comando->bindParam(':ipdi_discapacidad', $ipdi_discapacidad, \PDO::PARAM_STR);
            }
            if (!empty((isset($ipdi_porcentaje)))) {
                $comando->bindParam(':ipdi_porcentaje', $ipdi_porcentaje, \PDO::PARAM_STR);
            }
            if (!empty((isset($ipdi_archivo)))) {
                $comando->bindParam(':ipdi_archivo', $ipdi_archivo, \PDO::PARAM_STR);
            }
            if (!empty((isset($ipdi_ruta)))) {
                $comando->bindParam(':ipdi_ruta', $ipdi_ruta, \PDO::PARAM_STR);
            }
            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.info_per_discapacidad');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }

    /**
     * Function modificaExpediente que actualiza los datos de expediente del profesor.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function modificaExpediente($per_id, $cgen_id, $usu_id, $estado_expediente, $observacion) {

        $con = \Yii::$app->db_claustro;
        $estado = 1;
        $cgen_fecha_modificacion = date("Y-m-d H:i:s");
        if (!empty($estado_expediente)) {
            $epro_fecha_revision = date("Y-m-d H:i:s");
        }

        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".expediente_profesor		       
                      SET   usu_id = ifnull(:usu_id,usu_id),
                            epro_fecha_revision = ifnull(:epro_fecha_revision,epro_fecha_revision),
                            epro_estado_expediente = ifnull(:epro_estado_expediente,epro_estado_expediente),
                            epro_observacion = ifnull(:epro_observacion,epro_observacion),
                            cgen_id = ifnull(:cgen_id,cgen_id),
                            epro_fecha_modificacion = :epro_fecha_modificacion
                      WHERE 
                        per_id = :per_id AND                        
                        epro_estado = :estado AND
                        epro_estado_logico = :estado");

            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
            $comando->bindParam(":epro_fecha_modificacion", $cgen_fecha_modificacion, \PDO::PARAM_STR);
            $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
            $comando->bindParam(":cgen_id", $cgen_id, \PDO::PARAM_INT);
            $comando->bindParam(":epro_fecha_revision", $epro_fecha_revision, \PDO::PARAM_STR);
            $comando->bindParam(":usu_id", $usu_id, \PDO::PARAM_INT);
            $comando->bindParam(":epro_estado_expediente", $estado_expediente, \PDO::PARAM_INT);
            $comando->bindParam(":epro_observacion", $observacion, \PDO::PARAM_STR);

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
     * Function grabar la inserción del detalle de información curricular.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function insertarDet_infocurricular($per_id, $nins_id, $ins_id, $tcur_id, $dicu_otra_institucion, $dicu_titulo, $dicu_fecha_registro, $dicu_numero_registro, $dicu_documento, $areacon, $subareacon) {
        $con = \Yii::$app->db_general;

        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        $param_sql = "dicu_estado_logico";
        $bdet_sql = "1";

        $param_sql .= ", dicu_estado";
        $bdet_sql .= ", 1";

        if (isset($per_id)) {
            $param_sql .= ", per_id";
            $bdet_sql .= ", :per_id";
        }
        if (!empty((isset($nins_id)))) {
            $param_sql .= ", dicu_nivel_instruccion";
            $bdet_sql .= ", :dicu_nivel_instruccion";
        }
        if (isset($ins_id)) {
            $param_sql .= ", ins_id";
            $bdet_sql .= ", :ins_id";
        }
        if (isset($tcur_id)) {
            $param_sql .= ", tcur_id";
            $bdet_sql .= ", :tcur_id";
        }
        if (!empty((isset($dicu_otra_institucion)))) {
            $param_sql .= ", dicu_otra_institucion";
            $bdet_sql .= ", :dicu_otra_institucion";
        }
        if (!empty((isset($dicu_titulo)))) {
            $param_sql .= ", dicu_titulo";
            $bdet_sql .= ", :dicu_titulo";
        }
        if (isset($dicu_fecha_registro)) {
            $param_sql .= ", dicu_fecha_registro";
            $bdet_sql .= ", :dicu_fecha_registro";
        }
        if (!empty((isset($dicu_numero_registro)))) {
            $param_sql .= ", dicu_numero_registro";
            $bdet_sql .= ", :dicu_numero_registro";
        }
        if (!empty((isset($dicu_documento)))) {
            $param_sql .= ", dicu_documento";
            $bdet_sql .= ", :dicu_documento";
        }
        if (!empty((isset($areacon)))) {
            $param_sql .= ", acon_id";
            $bdet_sql .= ", :acon_id";
        }
        if (!empty((isset($subareacon)))) {
            $param_sql .= ", scon_id";
            $bdet_sql .= ", :scon_id";
        }

        try {
            $sql = "INSERT INTO " . $con->dbname . ".detalle_informacion_curricular ($param_sql) VALUES($bdet_sql)";
            $comando = $con->createCommand($sql);

            if (isset($per_id)) {
                $comando->bindParam(':per_id', $per_id, \PDO::PARAM_INT);
            }

            if (!empty((isset($nins_id))))
                $comando->bindParam(':dicu_nivel_instruccion', $nins_id, \PDO::PARAM_INT);

            if (isset($ins_id))
                $comando->bindParam(':ins_id', $ins_id, \PDO::PARAM_INT);

            if (isset($tcur_id))
                $comando->bindParam(':tcur_id', $tcur_id, \PDO::PARAM_INT);

            if (!empty((isset($dicu_otra_institucion))))
                $comando->bindParam(':dicu_otra_institucion', $dicu_otra_institucion, \PDO::PARAM_STR);

            if (!empty((isset($dicu_titulo))))
                $comando->bindParam(':dicu_titulo', $dicu_titulo, \PDO::PARAM_STR);

            if (isset($dicu_fecha_registro))
                $comando->bindParam(':dicu_fecha_registro', $dicu_fecha_registro, \PDO::PARAM_STR);

            if (!empty((isset($dicu_numero_registro))))
                $comando->bindParam(':dicu_numero_registro', $dicu_numero_registro, \PDO::PARAM_STR);

            if (!empty((isset($dicu_documento))))
                $comando->bindParam(':dicu_documento', $dicu_documento, \PDO::PARAM_STR);

            if (!empty((isset($areacon))))
                $comando->bindParam(':acon_id', $areacon, \PDO::PARAM_INT);

            if (!empty((isset($subareacon))))
                $comando->bindParam(':scon_id', $subareacon, \PDO::PARAM_INT);

            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.detalle_informacion_curricular');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }

    public function insertarDet_experiencialab($per_id, $temp_id, $pai_id, $dela_empresa, $dela_cargo, $dela_inicio_labores, $dela_fin_labores, $dela_actualidad, $icon_id) {

        $con = \Yii::$app->db_general;

        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        $param_sql = "dela_estado_logico";
        $bdet_sql = "1";

        $param_sql .= ", dela_estado";
        $bdet_sql .= ", 1";

        if (isset($per_id)) {
            $param_sql .= ", per_id";
            $bdet_sql .= ", :per_id";
        }
        if (isset($temp_id)) {
            $param_sql .= ", temp_id";
            $bdet_sql .= ", :temp_id";
        }
        if (isset($pai_id)) {
            $param_sql .= ", pai_id";
            $bdet_sql .= ", :pai_id";
        }
        if (isset($dela_empresa)) {
            $param_sql .= ", dela_empresa";
            $bdet_sql .= ", :dela_empresa";
        }
        if (isset($dela_cargo)) {
            $param_sql .= ", dela_cargo";
            $bdet_sql .= ", :dela_cargo";
        }
        if (isset($dela_inicio_labores)) {
            $param_sql .= ", dela_inicio_labores";
            $bdet_sql .= ", :dela_inicio_labores";
        }
        if (isset($dela_fin_labores)) {
            $param_sql .= ", dela_fin_labores";
            $bdet_sql .= ", :dela_fin_labores";
        }
        if (isset($dela_actualidad)) {
            $param_sql .= ", dela_actualidad";
            $bdet_sql .= ", :dela_actualidad";
        }
        if (isset($icon_id)) {
            $param_sql .= ", icon_id";
            $bdet_sql .= ", :icon_id";
        }
        try {
            $sql = "INSERT INTO " . $con->dbname . ".detalle_experiencia_laboral ($param_sql) VALUES($bdet_sql)";
            $comando = $con->createCommand($sql);

            if (isset($per_id)) {
                $comando->bindParam(':per_id', $per_id, \PDO::PARAM_INT);
            }
            if (isset($temp_id)) {
                $comando->bindParam(':temp_id', $temp_id, \PDO::PARAM_INT);
            }
            if (isset($pai_id)) {
                $comando->bindParam(':pai_id', $pai_id, \PDO::PARAM_INT);
            }
            if (isset($dela_empresa)) {
                $comando->bindParam(':dela_empresa', $dela_empresa, \PDO::PARAM_STR);
            }
            if (isset($dela_cargo)) {
                $comando->bindParam(':dela_cargo', $dela_cargo, \PDO::PARAM_STR);
            }
            if (!empty((isset($dela_inicio_labores)))) {
                $comando->bindParam(':dela_inicio_labores', $dela_inicio_labores, \PDO::PARAM_STR);
            }
            if (!empty((isset($dela_fin_labores)))) {
                $comando->bindParam(':dela_fin_labores', $dela_fin_labores, \PDO::PARAM_STR);
            }
            if (!empty((isset($dela_actualidad)))) {
                $comando->bindParam(':dela_actualidad', $dela_actualidad, \PDO::PARAM_STR);
            }
            if (!empty((isset($icon_id)))) {
                $comando->bindParam(':icon_id', $icon_id, \PDO::PARAM_INT);
            }
            $result = $comando->execute();
            if ($trans !== null) {
                $trans->commit();
            }

            return $con->getLastInsertID($con->dbname . '.detalle_experiencia_laboral');
        } catch (Exception $ex) {
            if ($trans !== null) {
                $trans->rollback();
            }
            return FALSE;
        }
    }

    public function insertarInf_contacto($per_id, $icon_nombres, $icon_direccion, $icon_telefono, $icon_cargo, $icon_correo, $tcge_id) {
        $con = \Yii::$app->db_general;

        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        $param_sql = "icon_estado";
        $bdet_sql = "1";

        $param_sql .= ", icon_estado_logico";
        $bdet_sql .= ", 1";

        if (isset($per_id)) {
            $param_sql .= ", per_id";
            $bdet_sql .= ", :per_id";
        }
        if (isset($tcge_id)) {
            $param_sql .= ", tcge_id";
            $bdet_sql .= ", :tcge_id";
        }
        if (!empty((isset($icon_nombres)))) {
            $param_sql .= ", icon_nombres";
            $bdet_sql .= ", :icon_nombres";
        }

        if (!empty((isset($icon_direccion)))) {
            $param_sql .= ", icon_direccion";
            $bdet_sql .= ", :icon_direccion";
        }

        if (!empty((isset($icon_telefono)))) {
            $param_sql .= ", icon_telefono";
            $bdet_sql .= ", :icon_telefono";
        }

        if (!empty((isset($icon_correo)))) {
            $param_sql .= ", icon_correo";
            $bdet_sql .= ", :icon_correo";
        }

        if (!empty((isset($icon_cargo)))) {
            $param_sql .= ", icon_cargo";
            $bdet_sql .= ", :icon_cargo";
        }

        try {
            $sql = "INSERT INTO " . $con->dbname . ".informacion_contacto ($param_sql) VALUES($bdet_sql)";
            $comando = $con->createCommand($sql);

            if (isset($per_id)) {
                $comando->bindParam(':per_id', $per_id, \PDO::PARAM_INT);
            }
            if (isset($tcge_id)) {
                $comando->bindParam(':tcge_id', $tcge_id, \PDO::PARAM_INT);
            }
            if (!empty((isset($icon_nombres)))) {
                $comando->bindParam(':icon_nombres', $icon_nombres, \PDO::PARAM_STR);
            }

            if (!empty((isset($icon_direccion)))) {
                $comando->bindParam(':icon_direccion', $icon_direccion, \PDO::PARAM_STR);
            }

            if (!empty((isset($icon_telefono)))) {
                $comando->bindParam(':icon_telefono', $icon_telefono, \PDO::PARAM_STR);
            }

            if (!empty((isset($icon_correo)))) {
                $comando->bindParam(':icon_correo', $icon_correo, \PDO::PARAM_STR);
            }

            if (!empty((isset($icon_cargo)))) {
                $comando->bindParam(':icon_cargo', $icon_cargo, \PDO::PARAM_STR);
            }

            $result = $comando->execute();

            if ($trans !== null) {
                $trans->commit();
            }
            return $con->getLastInsertID($con->dbname . '.informacion_contacto');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }

    /**
     * Function grabar la inserción del detalle de Experiencia Docente.
     * @author Jefferson Conde <analistadesarrollo03@uteg.edu.ec>;     
     */
    public function insertarDet_expdocencia($per_id, $ins_id, $dedo_otra_institucion, $acon_id, $deco_catedra_impartida, $deco_tipo_dedicacion, $deco_tip_relacion_lab, $deco_direccion_emp, $deco_telefono_emp, $dedo_fecha_inicio, $dedo_fecha_fin, $dedo_actual, $icon_id, $subareacon) {
        $con = \Yii::$app->db_general;

        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        $param_sql = "dedo_estado";
        $bdet_sql = "1";

        $param_sql .= ", dedo_estado_logico";
        $bdet_sql .= ", 1";

        if (isset($per_id)) {
            $param_sql .= ", per_id";
            $bdet_sql .= ", :per_id";
        }
        if (isset($ins_id)) {
            $param_sql .= ", ins_id";
            $bdet_sql .= ", :ins_id";
        }
        if (isset($dedo_otra_institucion)) {
            $param_sql .= ", dedo_otra_institucion";
            $bdet_sql .= ", :dedo_otra_institucion";
        }
        if (isset($acon_id)) {
            $param_sql .= ", acon_id";
            $bdet_sql .= ", :acon_id";
        }
        if (isset($deco_catedra_impartida)) {
            $param_sql .= ", dedo_catedra_impartida";
            $bdet_sql .= ", :dedo_catedra_impartida";
        }
        if (isset($deco_tipo_dedicacion)) {
            $param_sql .= ", dedo_tipo_dedicacion";
            $bdet_sql .= ", :dedo_tipo_dedicacion";
        }
        if (isset($deco_tip_relacion_lab)) {
            $param_sql .= ", dedo_tip_relacion_lab";
            $bdet_sql .= ", :dedo_tip_relacion_lab";
        }
        if (isset($deco_direccion_emp)) {
            $param_sql .= ", dedo_direccion_emp";
            $bdet_sql .= ", :dedo_direccion_emp";
        }
        if (isset($deco_telefono_emp)) {
            $param_sql .= ", dedo_telefono_emp";
            $bdet_sql .= ", :dedo_telefono_emp";
        }
        if (isset($dedo_fecha_inicio)) {
            $param_sql .= ", dedo_fecha_inicio";
            $bdet_sql .= ", :dedo_fecha_inicio";
        }
        if (isset($dedo_fecha_fin)) {
            $param_sql .= ", dedo_fecha_fin";
            $bdet_sql .= ", :dedo_fecha_fin";
        }
        if (isset($dedo_actual)) {
            $param_sql .= ", dedo_actual";
            $bdet_sql .= ", :dedo_actual";
        }
        if (isset($icon_id)) {
            $param_sql .= ", icon_id";
            $bdet_sql .= ", :icon_id";
        }
        if (isset($subareacon)) {
            $param_sql .= ", scon_id";
            $bdet_sql .= ", :scon_id";
        }
        try {
            $sql = "INSERT INTO " . $con->dbname . ".detalle_experiencia_docencia ($param_sql) VALUES($bdet_sql)";
            $comando = $con->createCommand($sql);

            if (isset($per_id)) {
                $comando->bindParam(':per_id', $per_id, \PDO::PARAM_INT);
            }
            if (isset($ins_id)) {
                $comando->bindParam(':ins_id', $ins_id, \PDO::PARAM_INT);
            }
            if (!empty((isset($dedo_otra_institucion)))) {
                $comando->bindParam(':dedo_otra_institucion', $dedo_otra_institucion, \PDO::PARAM_STR);
            }
            if (isset($acon_id)) {
                $comando->bindParam(':acon_id', $acon_id, \PDO::PARAM_INT);
            }
            if (!empty((isset($deco_catedra_impartida)))) {
                $comando->bindParam(':dedo_catedra_impartida', $deco_catedra_impartida, \PDO::PARAM_STR);
            }
            if (isset($deco_tipo_dedicacion)) {
                $comando->bindParam(':dedo_tipo_dedicacion', $deco_tipo_dedicacion, \PDO::PARAM_INT);
            }
            if (isset($deco_tip_relacion_lab)) {
                $comando->bindParam(':dedo_tip_relacion_lab', $deco_tip_relacion_lab, \PDO::PARAM_INT);
            }
            if (!empty((isset($deco_direccion_emp)))) {
                $comando->bindParam(':dedo_direccion_emp', $deco_direccion_emp, \PDO::PARAM_STR);
            }
            if (!empty((isset($deco_telefono_emp)))) {
                $comando->bindParam(':dedo_telefono_emp', $deco_telefono_emp, \PDO::PARAM_STR);
            }
            if (!empty((isset($dedo_fecha_inicio)))) {
                $comando->bindParam(':dedo_fecha_inicio', $dedo_fecha_inicio, \PDO::PARAM_STR);
            }
            if (!empty((isset($dedo_fecha_fin)))) {
                $comando->bindParam(':dedo_fecha_fin', $dedo_fecha_fin, \PDO::PARAM_STR);
            }
            if (isset($dedo_actual)) {
                $comando->bindParam(':dedo_actual', $dedo_actual, \PDO::PARAM_STR);
            }
            if (!empty((isset($icon_id)))) {
                $comando->bindParam(':icon_id', $icon_id, \PDO::PARAM_INT);
            }
            if (!empty((isset($subareacon)))) {
                $comando->bindParam(':scon_id', $subareacon, \PDO::PARAM_INT);
            }
            $result = $comando->execute();
            if ($trans !== null) {
                $trans->commit();
            }
            return $con->getLastInsertID($con->dbname . '.detalle_experiencia_docencia');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }

    public function insertarDet_capacitacion($per_id, $tcap_id, $tdip_id, $modalidad, $dcap_nombre_curso, $dcap_institucion_organiza, $dcap_duracion, $dcap_fecha_inicio, $dcap_fecha_fin, $dcap_documento_capacitacion, $dcap_actual) {
        $con = \Yii::$app->db_general;

        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        $param_sql = "dcap_estado";
        $bdet_sql = "1";

        $param_sql .= ", dcap_estado_logico";
        $bdet_sql .= ", 1";

        if (isset($per_id)) {
            $param_sql .= ", per_id";
            $bdet_sql .= ", :per_id";
        }

        if (isset($tcap_id)) {
            $param_sql .= ", dcap_tipo_capacitacion";
            $bdet_sql .= ", :dcap_tipo_capacitacion";
        }

        if (isset($tdip_id)) {
            $param_sql .= ", dcap_tipo_diploma";
            $bdet_sql .= ", :dcap_tipo_diploma";
        }

        if (isset($modalidad)) {
            $param_sql .= ", dcap_modalidad";
            $bdet_sql .= ", :dcap_modalidad";
        }

        if (isset($dcap_nombre_curso)) {
            $param_sql .= ", dcap_nombre_curso";
            $bdet_sql .= ", :dcap_nombre_curso";
        }

        if (isset($dcap_institucion_organiza)) {
            $param_sql .= ", dcap_institucion_organiza";
            $bdet_sql .= ", :dcap_institucion_organiza";
        }

        if (isset($dcap_duracion)) {
            $param_sql .= ", dcap_duracion";
            $bdet_sql .= ", :dcap_duracion";
        }

        if (isset($dcap_fecha_inicio)) {
            $param_sql .= ", dcap_fecha_inicio";
            $bdet_sql .= ", :dcap_fecha_inicio";
        }

        if (isset($dcap_fecha_fin)) {
            $param_sql .= ", dcap_fecha_fin";
            $bdet_sql .= ", :dcap_fecha_fin";
        }

        if (isset($dcap_documento_capacitacion)) {
            $param_sql .= ", dcap_documento_capacitacion";
            $bdet_sql .= ", :dcap_documento_capacitacion";
        }
        if (isset($dcap_actual)) {
            $param_sql .= ", dcap_actual";
            $bdet_sql .= ", :dcap_actual";
        }
        try {
            $sql = "INSERT INTO " . $con->dbname . ".detalle_capacitacion ($param_sql) VALUES($bdet_sql)";
            $comando = $con->createCommand($sql);

            if (isset($per_id))
                $comando->bindParam(':per_id', $per_id, \PDO::PARAM_INT);

            if (isset($tcap_id))
                $comando->bindParam(':dcap_tipo_capacitacion', $tcap_id, \PDO::PARAM_INT);

            if (isset($tdip_id))
                $comando->bindParam(':dcap_tipo_diploma', $tdip_id, \PDO::PARAM_INT);

            if ((isset($modalidad)))
                $comando->bindParam(':dcap_modalidad', $modalidad, \PDO::PARAM_INT);

            if (isset($dcap_nombre_curso))
                $comando->bindParam(':dcap_nombre_curso', $dcap_nombre_curso, \PDO::PARAM_STR);

            if ((isset($dcap_institucion_organiza)))
                $comando->bindParam(':dcap_institucion_organiza', $dcap_institucion_organiza, \PDO::PARAM_STR);

            if ((isset($dcap_duracion)))
                $comando->bindParam(':dcap_duracion', $dcap_duracion, \PDO::PARAM_STR);

            if (!empty((isset($dcap_fecha_inicio))))
                $comando->bindParam(':dcap_fecha_inicio', $dcap_fecha_inicio, \PDO::PARAM_STR);

            if (!empty((isset($dcap_fecha_fin))))
                $comando->bindParam(':dcap_fecha_fin', $dcap_fecha_fin, \PDO::PARAM_STR);

            if (!empty((isset($dcap_documento_capacitacion))))
                $comando->bindParam(':dcap_documento_capacitacion', $dcap_documento_capacitacion, \PDO::PARAM_STR);

            if (!empty((isset($dcap_actual))))
                $comando->bindParam(':dcap_actual', $dcap_actual, \PDO::PARAM_STR);

            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.detalle_capacitacion');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }

    public function insertarDet_publicacion($per_id, $tpub_id, $dpub_titulo, $dpub_fecha_publicacion, $dpub_publicacion, $dpub_nombre_publicacion, $dpub_numero_isbn, $dpub_actual, $dpub_url, $dpub_link_publicacion) {
        $con = \Yii::$app->db_general;

        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        $param_sql = "dpub_estado";
        $bdet_sql = "1";

        $param_sql .= ", dpub_estado_logico";
        $bdet_sql .= ", 1";

        if (isset($per_id)) {
            $param_sql .= ", per_id";
            $bdet_sql .= ", :per_id";
        }
        if (isset($tpub_id)) {
            $param_sql .= ", tpub_id";
            $bdet_sql .= ", :tpub_id";
        }
        if (isset($dpub_titulo)) {
            $param_sql .= ", dpub_titulo";
            $bdet_sql .= ", :dpub_titulo";
        }
        if (isset($dpub_fecha_publicacion)) {
            $param_sql .= ", dpub_fecha_publicacion";
            $bdet_sql .= ", :dpub_fecha_publicacion";
        }
        if (isset($dpub_publicacion)) {
            $param_sql .= ", dpub_publicacion";
            $bdet_sql .= ", :dpub_publicacion";
        }
        if (isset($dpub_nombre_publicacion)) {
            $param_sql .= ", dpub_nombre_publicacion";
            $bdet_sql .= ", :dpub_nombre_publicacion";
        }
        if (isset($dpub_numero_isbn)) {
            $param_sql .= ", dpub_numero_isbn";
            $bdet_sql .= ", :dpub_numero_isbn";
        }
        if (isset($dpub_actual)) {
            $param_sql .= ", dpub_actual";
            $bdet_sql .= ", :dpub_actual";
        }
        if (isset($dpub_url)) {
            $param_sql .= ", dpub_url";
            $bdet_sql .= ", :dpub_url";
        }
        if (isset($dpub_link_publicacion)) {
            $param_sql .= ", dpub_link_publicacion";
            $bdet_sql .= ", :dpub_link_publicacion";
        }

        try {
            $sql = "INSERT INTO " . $con->dbname . ".detalle_publicacion ($param_sql) VALUES($bdet_sql)";
            $comando = $con->createCommand($sql);

            if (isset($per_id)) {
                $comando->bindParam(':per_id', $per_id, \PDO::PARAM_INT);
            }
            if (isset($tpub_id)) {
                $comando->bindParam(':tpub_id', $tpub_id, \PDO::PARAM_INT);
            }
            if (isset($dpub_titulo)) {
                $comando->bindParam(':dpub_titulo', $dpub_titulo, \PDO::PARAM_STR);
            }
            if (!empty((isset($dpub_fecha_publicacion)))) {
                $comando->bindParam(':dpub_fecha_publicacion', $dpub_fecha_publicacion, \PDO::PARAM_STR);
            }
            if (isset($dpub_publicacion)) {
                $comando->bindParam(':dpub_publicacion', $dpub_publicacion, \PDO::PARAM_INT);
            }
            if (isset($dpub_nombre_publicacion)) {
                $comando->bindParam(':dpub_nombre_publicacion', $dpub_nombre_publicacion, \PDO::PARAM_STR);
            }
            if (isset($dpub_numero_isbn)) {
                $comando->bindParam(':dpub_numero_isbn', $dpub_numero_isbn, \PDO::PARAM_STR);
            }
            if (isset($dpub_actual)) {
                $comando->bindParam(':dpub_actual', $dpub_actual, \PDO::PARAM_STR);
            }
            if (!empty((isset($dpub_url)))) {
                $comando->bindParam(':dpub_url', $dpub_url, \PDO::PARAM_STR);
            }
            if (!empty((isset($dpub_link_publicacion)))) {
                $comando->bindParam(':dpub_link_publicacion', $dpub_link_publicacion, \PDO::PARAM_STR);
            }

            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.detalle_publicacion');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }

    public function insertarInf_tutorias($per_id, $pai_id, $ins_id, $itut_otra_institucion, 
                                         $itut_tipocodireccion, $itut_nombre, $itut_anio_aprob,
                                         $acon_id) {
        //DETALLE.-
        $con = \Yii::$app->db_general;

        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        $param_sql = "itut_estado";
        $bdet_sql = "1";

        $param_sql .= ", itut_estado_logico";
        $bdet_sql .= ", 1";

        if (isset($per_id)) {
            $param_sql .= ", per_id";
            $bdet_sql .= ", :per_id";
        }
        if (isset($pai_id)) {
            $param_sql .= ", pai_id";
            $bdet_sql .= ", :pai_id";
        }
        if (isset($ins_id)) {
            $param_sql .= ", ins_id";
            $bdet_sql .= ", :ins_id";
        }
        if (isset($itut_otra_institucion)) {
            $param_sql .= ", itut_otra_institucion";
            $bdet_sql .= ", :itut_otra_institucion";
        }
        if (isset($itut_tipocodireccion)) {
            $param_sql .= ", itut_tipo_codireccion";
            $bdet_sql .= ", :itut_tipo_codireccion";
        }
        if (isset($itut_nombre)) {
            $param_sql .= ", itut_nombre";
            $bdet_sql .= ", :itut_nombre";
        }
        if (isset($itut_anio_aprob)) {
            $param_sql .= ", itut_anio_aprob";
            $bdet_sql .= ", :itut_anio_aprob";
        }
        if (isset($acon_id)) {
            $param_sql .= ", acon_id";
            $bdet_sql .= ", :acon_id";
        }
        try {
            $sql = "INSERT INTO " . $con->dbname . ".info_tutorias ($param_sql) VALUES($bdet_sql)";
            $comando = $con->createCommand($sql);

            if (isset($per_id)) {
                $comando->bindParam(':per_id', $per_id, \PDO::PARAM_INT);
            }
            if (isset($pai_id)) {
                $comando->bindParam(':pai_id', $pai_id, \PDO::PARAM_INT);
            }
            if (isset($ins_id)) {
                $comando->bindParam(':ins_id', $ins_id, \PDO::PARAM_INT);
            }
            if (!empty((isset($itut_otra_institucion)))) {
                $comando->bindParam(':itut_otra_institucion', $itut_otra_institucion, \PDO::PARAM_STR);
            }
            if (isset($itut_tipocodireccion)) {
                $comando->bindParam(':itut_tipo_codireccion', $itut_tipocodireccion, \PDO::PARAM_INT);
            }
            if (!empty((isset($itut_nombre)))) {
                $comando->bindParam(':itut_nombre', $itut_nombre, \PDO::PARAM_STR);
            }
            if (isset($itut_anio_aprob)) {
                $comando->bindParam(':itut_anio_aprob', $itut_anio_aprob, \PDO::PARAM_STR);
            }
            if (isset($acon_id)) {
                $comando->bindParam(':acon_id', $acon_id, \PDO::PARAM_INT);
            }
            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.info_tutorias');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }

    public function insertarInf_conferencias($per_id, $pai_id, $icon_institucion, 
                                             $icon_nombre_evento, $icon_ponencia, 
                                             $acon_id, $icon_tipo_participacion,
                                             $icon_archivo) {
        $con = \Yii::$app->db_general;

        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una.
        }

        $param_sql = "icon_estado";
        $bdet_sql = "1";

        $param_sql .= ", icon_estado_logico";
        $bdet_sql .= ", 1";

        if (isset($per_id)) {
            $param_sql .= ", per_id";
            $bdet_sql .= ", :per_id";
        }
        if (isset($pai_id)) {
            $param_sql .= ", pai_id";
            $bdet_sql .= ", :pai_id";
        }
        if (isset($icon_institucion)) {
            $param_sql .= ", icon_institucion";
            $bdet_sql .= ", :icon_institucion";
        }
        
        if (isset($icon_nombre_evento)) {
            $param_sql .= ", icon_nombre_evento";
            $bdet_sql .= ", :icon_nombre_evento";
        }
        if (isset($icon_ponencia)) {
            $param_sql .= ", icon_ponencia";
            $bdet_sql .= ", :icon_ponencia";
        }
        if (isset($acon_id)) {
            $param_sql .= ", acon_id";
            $bdet_sql .= ", :acon_id";
        }
        if (isset($icon_tipo_participacion)) {
            $param_sql .= ", icon_tipo_participacion";
            $bdet_sql .= ", :icon_tipo_participacion";
        }   
        if (isset($icon_archivo)) {
            $param_sql .= ", icon_archivo";
            $bdet_sql .= ", :icon_archivo";
        }  

        try {
            $sql = "INSERT INTO " . $con->dbname . ".info_conferencias ($param_sql) VALUES($bdet_sql)";
            $comando = $con->createCommand($sql);

            if (isset($per_id)) {
                $comando->bindParam(':per_id', $per_id, \PDO::PARAM_INT);
            }
            if (isset($pai_id)) {
                $comando->bindParam(':pai_id', $pai_id, \PDO::PARAM_INT);
            }
            if (isset($icon_institucion)) {
                $comando->bindParam(':icon_institucion', $icon_institucion, \PDO::PARAM_STR);
            }            
            if (isset($icon_nombre_evento)) {
                $comando->bindParam(':icon_nombre_evento', $icon_nombre_evento, \PDO::PARAM_STR);
            }
            if (isset($icon_ponencia)) {
                $comando->bindParam(':icon_ponencia', $icon_ponencia, \PDO::PARAM_STR);
            }
            if (isset($acon_id)) {
                $comando->bindParam(':acon_id', $acon_id, \PDO::PARAM_INT);
            }
            if (isset($icon_tipo_participacion)) {
                $comando->bindParam(':icon_tipo_participacion', $icon_tipo_participacion, \PDO::PARAM_INT);
            }
            if (isset($icon_archivo)) {
                $comando->bindParam(':icon_archivo', $icon_archivo, \PDO::PARAM_STR);
            }
            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.info_conferencias');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }

    public function insertarDet_investigacion($per_id, $dinv_nombre_proyecto, $dinv_rol_proyecto, 
                                              $dinv_fecha_inicio, $dinv_fecha_fin, $dinv_actual, 
                                              $dinv_documento, $dinv_financiado, $dinv_institucion_financia) {
        $con = \Yii::$app->db_general;

        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una.
        }

        $param_sql = "dinv_estado";
        $bdet_sql = "1";

        $param_sql .= ", dinv_estado_logico";
        $bdet_sql .= ", 1";

        if (isset($per_id)) {
            $param_sql .= ", per_id";
            $bdet_sql .= ", :per_id";
        }

        if (isset($dinv_nombre_proyecto)) {
            $param_sql .= ", dinv_nombre_proyecto";
            $bdet_sql .= ", :dinv_nombre_proyecto";
        }

        if (isset($dinv_rol_proyecto)) {
            $param_sql .= ", dinv_rol";
            $bdet_sql .= ", :dinv_rol";
        }

        if (isset($dinv_fecha_inicio)) {
            $param_sql .= ", dinv_fecha_inicio";
            $bdet_sql .= ", :dinv_fecha_inicio";
        }

        if (isset($dinv_fecha_fin)) {
            $param_sql .= ", dinv_fecha_fin";
            $bdet_sql .= ", :dinv_fecha_fin";
        }

        if (isset($dinv_actual)) {
            $param_sql .= ", dinv_actual";
            $bdet_sql .= ", :dinv_actual";
        }

        if (isset($dinv_documento)) {
            $param_sql .= ", dinv_documento";
            $bdet_sql .= ", :dinv_documento";
        }
        
        if (isset($dinv_financiado)) {
            $param_sql .= ", dinv_financiado";
            $bdet_sql .= ", :dinv_financiado";
        }
        
        if (isset($dinv_institucion_financia)) {
            $param_sql .= ", dinv_institucion_financia";
            $bdet_sql .= ", :dinv_institucion_financia";
        }
        try {
            $sql = "INSERT INTO " . $con->dbname . ".detalle_investigacion ($param_sql) VALUES($bdet_sql)";
            $comando = $con->createCommand($sql);

            if (isset($per_id)) {
                $comando->bindParam(':per_id', $per_id, \PDO::PARAM_INT);
            }
            if (isset($dinv_nombre_proyecto)) {
                $comando->bindParam(':dinv_nombre_proyecto', $dinv_nombre_proyecto, \PDO::PARAM_STR);
            }
            if (isset($dinv_rol_proyecto)) {
                $comando->bindParam(':dinv_rol', $dinv_rol_proyecto, \PDO::PARAM_INT);
            }
            if (!empty((isset($dinv_fecha_inicio)))) {
                $comando->bindParam(':dinv_fecha_inicio', $dinv_fecha_inicio, \PDO::PARAM_STR);
            }
            if (!empty((isset($dinv_fecha_fin)))) {
                $comando->bindParam(':dinv_fecha_fin', $dinv_fecha_fin, \PDO::PARAM_STR);
            }
            if (isset($dinv_actual)) {
                $comando->bindParam(':dinv_actual', $dinv_actual, \PDO::PARAM_STR);
            }
            if (!empty((isset($dinv_documento)))) {
                $comando->bindParam(':dinv_documento', $dinv_documento, \PDO::PARAM_STR);
            }
            if (isset($dinv_financiado)) {
                $comando->bindParam(':dinv_financiado', $dinv_financiado, \PDO::PARAM_STR);
            }
            if (!empty((isset($dinv_institucion_financia)))) {
                $comando->bindParam(':dinv_institucion_financia', $dinv_institucion_financia, \PDO::PARAM_STR);
            }

            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.detalle_investigacion');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }

    /**
     * Function consultarAreaConocimiento
     * @author  
     * @property       
     * @return  
     */
    public function consultarAreaConocimiento() {
        $con = \Yii::$app->db_academico;
        $estado = 1;
        $sql = "SELECT 
                    aco.acon_id as id,
                    aco.acon_nombre as name
                FROM 
                    " . $con->dbname . ".area_conocimiento as aco             
                WHERE                     
                    aco.acon_estado_logico=:estado AND 
                    aco.acon_estado=:estado";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $resultData = $comando->queryAll();
        return $resultData;
    }

    /**
     * Function consultarInstituto
     * @author  
     * @property       
     * @return  
     */
    public function consultarInstituto($pais) {
        $con = \Yii::$app->db_general;
        $estado = 1;
        $sql = "SELECT 
                    inst.ins_id as id,
                    inst.ins_nombre as name
                FROM 
                    " . $con->dbname . ".institucion as inst            
                WHERE   
                    inst.pai_id=:pais AND
                    inst.ins_estado_logico=:estado AND 
                    inst.ins_estado=:estado";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":pais", $pais, \PDO::PARAM_INT);
        $resultData = $comando->queryAll();
        return $resultData;
    }

    /**
     * Function consultarIdiomas
     * @author  
     * @property       
     * @return  
     */
    public function consultarIdiomas() {
        $con = \Yii::$app->db_general;
        $estado = 1;
        $sql = "SELECT 
                    idi.idi_id as id,
                    idi.idi_nombre as name
                FROM 
                    " . $con->dbname . ".idioma as idi
                WHERE                     
                    idi.idi_estado_logico=:estado AND 
                    idi.idi_estado=:estado";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $resultData = $comando->queryAll();
        return $resultData;
    }

    /**
     * Function grabar los resultados de los idiomas conocidos.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function insertarResultadoxidioma($per_id, $idi_id, $cidi_id, $nidi_id, $rxid_institucion, $rxid_documento, $rxid_otro_idioma) {
        $con = \Yii::$app->db_general;

        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        $param_sql = "rxid_estado";
        $bdet_sql = "1";

        $param_sql .= ", rxid_estado_logico";
        $bdet_sql .= ", 1";

        if (isset($per_id)) {
            $param_sql .= ", per_id";
            $bdet_sql .= ", :per_id";
        }

        if (isset($idi_id)) {
            $param_sql .= ", idi_id";
            $bdet_sql .= ", :idi_id";
        }

        if (isset($cidi_id)) {
            $param_sql .= ", cidi_id";
            $bdet_sql .= ", :cidi_id";
        }

        if (isset($nidi_id)) {
            $param_sql .= ", nidi_id";
            $bdet_sql .= ", :nidi_id";
        }

        if (isset($rxid_institucion)) {
            $param_sql .= ", rxid_institucion";
            $bdet_sql .= ", :rxid_institucion";
        }

        if (isset($rxid_documento)) {
            $param_sql .= ", rxid_documento";
            $bdet_sql .= ", :rxid_documento";
        }

        if (isset($rxid_otro_idioma)) {
            $param_sql .= ", rxid_otro_idioma";
            $bdet_sql .= ", :rxid_otro_idioma";
        }
        try {
            $sql = "INSERT INTO " . $con->dbname . ".resultado_x_idioma ($param_sql) VALUES($bdet_sql)";
            $comando = $con->createCommand($sql);

            if (isset($per_id)) {
                $comando->bindParam(':per_id', $per_id, \PDO::PARAM_INT);
            }

            if (isset($idi_id)) {
                $comando->bindParam(':idi_id', $idi_id, \PDO::PARAM_INT);
            }

            if (isset($cidi_id)) {
                $comando->bindParam(':cidi_id', $cidi_id, \PDO::PARAM_INT);
            }

            if (isset($nidi_id)) {
                $comando->bindParam(':nidi_id', $nidi_id, \PDO::PARAM_INT);
            }

            if (isset($rxid_institucion)) {
                $comando->bindParam(':rxid_institucion', $rxid_institucion, \PDO::PARAM_STR);
            }

            if (isset($rxid_documento)) {
                $comando->bindParam(':rxid_documento', $rxid_documento, \PDO::PARAM_STR);
            }

            if (!empty((isset($rxid_otro_idioma)))) {
                $comando->bindParam(':rxid_otro_idioma', $rxid_otro_idioma, \PDO::PARAM_STR);
            }
            $result = $comando->execute();

            if ($trans !== null) {
                $trans->commit();
            }
            return $con->getLastInsertID($con->dbname . '.resultado_x_idioma');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }

    /**
     * Function consultarParametros para llenar los combox en expediente profesor
     * @author  
     * @property       
     * @return  
     */
    public function consultarParametros($valor, $condicion) {
        $con = \Yii::$app->db_general;
        $estado = 1;
        $sql = "SELECT 
                    par.par_id as id,
                    par.par_nombre as name
                FROM 
                    " . $con->dbname . ".parametros as par             
                WHERE 
                    par.par_valor=:valor AND
                    par.par_estado_logico=:estado AND 
                    par.par_estado=:estado ";
        if (!empty($condicion)) {
            $sql .= "AND par.par_codigo != :condicion";
        }
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":valor", $valor, \PDO::PARAM_STR);
        $comando->bindParam(":condicion", $condicion, \PDO::PARAM_STR);

        $resultData = $comando->queryAll();
        return $resultData;
    }

    /**
     * Function consutarTipopublicacion 
     * @author  
     * @property       
     * @return  
     */
    public function consutarTipopublicacion() {
        $con = \Yii::$app->db_general;
        $estado = 1;
        $sql = "SELECT 
                    tpub.tpub_id as id,
                    tpub.tpub_nombre as name
                FROM 
                    " . $con->dbname . ".tipo_publicacion as tpub             
                WHERE                     
                    tpub.tpub_estado_logico=:estado AND 
                    tpub.tpub_estado=:estado";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $resultData = $comando->queryAll();
        return $resultData;
    }

    /**
     * Function consultarInfopersona 
     * @author  Grace Viteri
     * @property       
     * @return  
     */
    public function consultarInfopersona($per_id) {
        $con = \Yii::$app->db_asgard;
        $estado = 1;
        $sql = "SELECT 
                    per_pri_nombre, per_seg_nombre, per_pri_apellido, per_seg_apellido, 
                    per_cedula, per_ruc,per_pasaporte, etn_id, eciv_id, per_genero, per_nacionalidad, 
                    pai_id_nacimiento, pro_id_nacimiento, can_id_nacimiento,
                    per_fecha_nacimiento, per_celular, per_correo, per_foto, tsan_id, 
                    per_domicilio_sector, per_domicilio_cpri, per_domicilio_csec,
                    per_domicilio_num, per_domicilio_ref, per_domicilio_telefono, 
                    pai_id_domicilio, pro_id_domicilio, can_id_domicilio, usu.usu_user as correo
                FROM 
                   " . $con->dbname . ".persona per INNER JOIN " . $con->dbname . ".usuario usu on usu.per_id = per.per_id
                WHERE 
                   per.per_id = :per_id  AND
                   per.per_estado = :estado AND
                   per.per_estado_logico = :estado AND
                   usu.usu_estado = :estado AND
                   usu.usu_estado_logico = :estado ";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);

        $resultData = $comando->queryOne();
        return $resultData;
    }

    /**
     * Function Obtiene listado de profesores que han llenado el expediente.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function listadoExpediente($arrFiltro = array(), $onlyData = false) {
        $con = \Yii::$app->db_claustro;
        $con1 = \Yii::$app->db;
        $con2 = \Yii::$app->db_general;
        $estado = 1;

        $columnsAdd = "";
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $str_search .= "(per.per_pri_nombre like :search OR ";
            $str_search .= "per.per_seg_nombre like :search OR ";
            $str_search .= "per.per_pri_apellido like :search OR ";
            $str_search .= "per.per_seg_apellido like :search OR ";
            $str_search .= "per.per_cedula like :search) ";
            if ($arrFiltro['estado'] != "" && $arrFiltro['estado'] > 0) {
                $str_search .= " AND exp.epro_estado_expediente = :estadoexp AND ";
            }
        } else {
            $columnsAdd = "     
                        per.per_pri_nombre as per_pri_nombre,
                        per.per_seg_nombre as per_seg_nombre,
                        per.per_pri_apellido as per_pri_apellido,
                        per.per_seg_apellido as per_seg_apellido,";
        }

        $sql = "SELECT  exp.per_id as id, 
                        exp.epro_estado_expediente as estado,
                        exp.epro_observacion as observacion,
                        par.par_nombre as des_estado,
                        concat(per.per_pri_nombre,' ', ifnull(per.per_seg_nombre,'')) as nombres,
                        concat(per.per_pri_apellido, ' ', ifnull(per.per_seg_apellido,'')) as apellidos,
                        $columnsAdd
                        per.per_cedula as dni                     
                FROM "
                . $con->dbname . ".expediente_profesor exp INNER JOIN " . $con1->dbname . ".persona per ON per.per_id = exp.per_id
                        INNER JOIN " . $con2->dbname . ".parametros par ON par.par_id = exp.epro_estado_expediente
                WHERE   $str_search                      
                        exp.epro_estado = :estado AND
                        exp.epro_estado_logico = :estado AND
                        per.per_estado = :estado AND
                        per.per_estado_logico = :estado AND
                        par.par_estado = :estado AND
                        par.par_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);

        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $search_cond = "%" . $arrFiltro["search"] . "%";
            $estadoexp = $arrFiltro["estado"];
            $comando->bindParam(":search", $search_cond, \PDO::PARAM_STR);

            if ($arrFiltro['estado'] != "" && $arrFiltro['estado'] > 0) {
                $comando->bindParam(":estadoexp", $estadoexp, \PDO::PARAM_INT);
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
     * Function consultarDiscapacidad consulta de datos de discapacidad del profesor. 
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarDiscapacidad($per_id) {
        $con = \Yii::$app->db_general;
        $estado = 1;
        $sql = "SELECT 
                   tdis_id as tipo_discapacidad,
                   ipdi_discapacidad,
                   ipdi_carnet_conadis as carnet,
                   ipdi_porcentaje as porcentaje,
                   ipdi_archivo as archivo,
                   ipdi_ruta as ruta,
                   ipdi_id
                FROM 
                   " . $con->dbname . ".info_per_discapacidad  
                WHERE 
                   per_id = :per_id  AND
                   ipdi_estado = :estado AND
                   ipdi_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);

        $resultData = $comando->queryOne();
        return $resultData;
    }

    /**
     * Function consultarDatosFamiliares Consulta de datos familiares.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarDatosFamiliares($per_id, $tafa_id, $opcion) {
        $con = \Yii::$app->db_general;
        $con1 = \Yii::$app->db;
        $estado = 1;
        $sql = "SELECT 
                    dafa_nombres,
                    dafa_apellidos,
                    date_format(dafa_fecha_nacimiento,'%d/%m/%Y') as dafa_fecha_nacimiento,                    
                    daf.tpar_id,
                    dafa_carga_actual as dafa_carga_familiar,
                    (case when ipdi_id > 0 then (select i.tdis_id from " . $con->dbname . ".info_per_discapacidad i where i.ipdi_id= daf.ipdi_id and i.ipdi_estado=:estado and i.ipdi_estado_logico = :estado) end) as tdis_id,
                    (case when ipdi_id > 0 then (select i.ipdi_porcentaje from " . $con->dbname . ".info_per_discapacidad i where i.ipdi_id= daf.ipdi_id and i.ipdi_estado=:estado and i.ipdi_estado_logico = :estado) else '' end) as idis_porcentaje,
                    (case when ipdi_id > 0 then (select i.ipdi_carnet_conadis from " . $con->dbname . ".info_per_discapacidad i where i.ipdi_id= daf.ipdi_id and i.ipdi_estado=:estado and i.ipdi_estado_logico = :estado) else '' end) as idis_carnet_conadis,   
                    dafa_archivo as idis_ruta,
                    dafa_ocupacion,
                    (case when ipdi_id > 0 then 'SI' else 'NO' end) as idis_discapacidad,
                    (case when ipdi_id > 0 then (select tdis_nombre from " . $con->dbname . ".info_per_discapacidad i inner join " . $con1->dbname . ".tipo_discapacidad tp  on tp.tdis_id = i.tdis_id where i.ipdi_id= daf.ipdi_id and i.ipdi_estado=:estado and i.ipdi_estado_logico = :estado)                        
                        else '' end) as txt_tip_discap_fam,
                    tp.tpar_nombre as des_parentesco,      
                    @rownum:=@rownum+1 as dafa_clave,
                    daf.dafa_id,
                    (case when ipdi_id > 0 then (select i.tdis_id from " . $con->dbname . ".info_per_discapacidad i where i.ipdi_id= daf.ipdi_id and i.ipdi_estado=:estado and i.ipdi_estado_logico = :estado)
                        else '' end) as codtipodiscapacidad,                                                                                                                           
                    (case when dafa_carga_actual=0 then 'NO' else 'SI' end) as carga_actual,                                      
                    (case when ipdi_id > 0 then (select i.ipdi_archivo from " . $con->dbname . ".info_per_discapacidad i where i.ipdi_id= daf.ipdi_id and i.ipdi_estado=:estado and i.ipdi_estado_logico = :estado)
                        else '' end) as archivo_discapacidad                             
                FROM 
                   " . $con->dbname . ".detalle_antecedentes_fam daf INNER JOIN " . $con1->dbname . ".tipo_parentesco tp"
                . " ON tp.tpar_id = daf.tpar_id, (SELECT @rownum:=0) R
                WHERE 
                   per_id = :per_id  AND
                   tafa_id = :tafa_id AND
                   dafa_estado = :estado AND
                   dafa_estado_logico = :estado AND
                   tpar_estado = :estado AND
                   tpar_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
        $comando->bindParam(":tafa_id", $tafa_id, \PDO::PARAM_INT);

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
        if ($opcion == 1) {
            return $resultData;
        } else {
            return $dataProvider;
        }
    }

    /**
     * Function consultarDatosAcademicos Consulta de datos académicos.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarDatosAcademicos($per_id, $tcur_id, $opcion) {
        $con = \Yii::$app->db_general;
        $con1 = \Yii::$app->db;
        $estado = 1;
        $sql = "SELECT  dicu_id,
                        (select ifnull(p.par_nombre,'') from " . $con->dbname . ".parametros p where dic.dicu_nivel_instruccion = p.par_id and par_estado = :estado and par_estado_logico = :estado) as dicu_nivel_des,
                        ins_id,
                        (case when ifnull(dicu_otra_institucion,'') = '' then 
                        (select ins_nombre from " . $con->dbname . ".institucion i where i.ins_id = dic.ins_id)
                                else dicu_otra_institucion end) as dicu_nombre_institucion,
                        dicu_titulo,
                        date_format(dicu_fecha_registro,'%d/%m/%Y') as dicu_fecha_registro,                           
                        dicu_numero_registro,
                        (select p.pai_nombre from " . $con->dbname . ".institucion i inner join " . $con1->dbname . ".pais p on p.pai_id = i.pai_id where i.ins_id = dic.ins_id) as dicu_des_pais,
                        dicu_documento, 
                        @rownum:=@rownum+1 as dicu_clave
                FROM " . $con->dbname . ".detalle_informacion_curricular dic, (SELECT @rownum:=0) R 
                WHERE per_id = :per_id AND
                      tcur_id = :tcur_id AND
                      dicu_estado = :estado AND
                      dicu_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
        $comando->bindParam(":tcur_id", $tcur_id, \PDO::PARAM_INT);

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
        if ($opcion == 1) {
            return $resultData;
        } else {
            return $dataProvider;
        }
    }

    /**
     * Function consultarDatosIdiomas Consulta de datos de idiomas.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarDatosIdiomas($per_id, $opcion) {
        $con = \Yii::$app->db_general;
        $estado = 1;
        $sql = "SELECT A.*, @rownum:=@rownum+1 as rix_clave from 
                (               
                SELECT  CASE WHEN ifnull(rxi.idi_id,0) = 0 then 
                            rxi.rxid_otro_idioma else 
                            (select i.idi_nombre from " . $con->dbname . ".idioma i where i.idi_id = rxi.idi_id and i.idi_estado = :estado and i.idi_estado_logico = :estado) end as rxi_des_idioma,
                        rxid_institucion as rxi_institucion, 
                        rxid_documento, per_id, idi_id, count(*) rxi_id,
                        GROUP_CONCAT(if(rxi.cidi_id=1, n.nidi_descripcion, NULL)) as rxi_nivel_hablado,
                        GROUP_CONCAT(if(rxi.cidi_id=2, n.nidi_descripcion, NULL)) as rxi_nivel_escrito,
                        GROUP_CONCAT(if(rxi.cidi_id=3, n.nidi_descripcion, NULL)) as rxi_nivel_lectura,
                        GROUP_CONCAT(if(rxi.cidi_id=4, n.nidi_descripcion, NULL)) as rxi_nivel_auditiva       
                FROM " . $con->dbname . ".resultado_x_idioma rxi INNER JOIN " . $con->dbname . ".nivel_idioma n ON n.nidi_id = rxi.nidi_id
                WHERE per_id = :per_id AND
                      rxid_estado = :estado AND
                      rxid_estado_logico = :estado AND                      
                      nidi_estado = :estado AND
                      nidi_estado_logico = :estado
                GROUP BY 1,2,3,4,5) A, (SELECT @rownum:=0) R";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);

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

        if ($opcion == 1) {
            return $resultData;
        } else {
            return $dataProvider;
        }
    }

    /**
     * Function consultarDatosCapacitacion Consulta de información de capacitaciones.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarDatosCapacitacion($per_id, $opcion) {
        $con = \Yii::$app->db_general;
        $estado = 1;
        $sql = " SELECT dcap_id as cap_id, dcap_tipo_diploma, dcap_modalidad, dcap_tipo_capacitacion,
                    (select par_nombre from " . $con->dbname . ".parametros p where dcap_tipo_diploma = p.par_id) as cap_des_tipodiploma,
                    (select par_nombre from " . $con->dbname . ".parametros p where dcap_modalidad = p.par_id) as cap_des_modalidad,
                    (select par_nombre from " . $con->dbname . ".parametros p where dcap_tipo_capacitacion = p.par_id) as cap_des_tipocurso,
                    dcap_nombre_curso as cap_nombre_curso,
                    dcap_institucion_organiza cap_nombre_institucion,
                    dcap_duracion as cap_duracion,
                    date_format(dcap_fecha_inicio,'%d/%m/%Y') as cap_fecha_inicio,
                    ifnull(date_format(dcap_fecha_fin,'%d/%m/%Y'),'') as cap_fecha_fin,                    
                    dcap_documento_capacitacion,
                    dcap_actual,
                    @rownum:=@rownum+1 as cap_clave
                 FROM " . $con->dbname . ".detalle_capacitacion cap, (SELECT @rownum:=0) R 
                    where per_id = :per_id AND
                    dcap_estado = :estado AND
                    dcap_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);

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
        if ($opcion == 1) {
            return $resultData;
        } else {
            return $dataProvider;
        }
    }

    /**
     * Function consultarDatoslaborales Consulta de información de trabajos de profesión.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarDatoslaborales($per_id, $opcion) {
        $con = \Yii::$app->db_general;
        $con1 = \Yii::$app->db;
        $estado = 1;
        $sql = "SELECT dela_id, del.temp_id, pai_id, icon_id,
                       te.temp_nombre as dela_des_emp,
                       dela_empresa,
                       dela_cargo,
                       date_format(dela_inicio_labores,'%d/%m/%Y') as dela_fecha_inicio,
                       ifnull(date_format(dela_fin_labores,'%d/%m/%Y'),'') as dela_fecha_fin,
                       dela_actualidad,
                       (case when ifnull(del.icon_id,0) > 0 then
						  (select ifnull(icon_telefono,'') from " . $con->dbname . ".informacion_contacto ic where ic.icon_id = del.icon_id)
						else '' end) as dela_telef_empresa,
                       (case when ifnull(dela_fin_labores,curdate()) = curdate() then
							datediff(curdate(),dela_inicio_labores)
							else datediff(dela_fin_labores,dela_inicio_labores) end) as dias,
                        @rownum:=@rownum+1 as dela_clave
                FROM " . $con->dbname . ".detalle_experiencia_laboral del INNER JOIN " . $con1->dbname . ".tipo_empresa te ON te.temp_id = del.temp_id,  (SELECT @rownum:=0) R 
                WHERE   per_id = :per_id AND
                        dela_estado = :estado AND
                        dela_estado_logico = :estado AND
                        temp_estado = :estado AND
                        temp_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);

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
        if ($opcion == 1) {
            return $resultData;
        } else {
            return $dataProvider;
        }
    }

    /**
     * Function consultarDatosdocencia Consulta de información de trabajos de docencia.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarDatosdocencia($per_id, $opcion) {
        $con = \Yii::$app->db_general;
        $con1 = \Yii::$app->db_academico;
        $estado = 1;
        $sql = "SELECT dedo_id, ins_id, acon_id, icon_id, dedo_tipo_dedicacion, dedo_tip_relacion_lab,
                    (case when ifnull(dedo_otra_institucion,'')='' then
                        (select ins_nombre from " . $con->dbname . ".institucion i where i.ins_id = ded.ins_id)
                         else dedo_otra_institucion end) as dedo_des_institucion, 
                    dedo_catedra_impartida, 
                    (select acon_nombre from " . $con1->dbname . ".area_conocimiento where acon_id = ded.acon_id and acon_estado = :estado and acon_estado_logico = :estado) dedo_des_areaconoc,
                    (select par_nombre from " . $con->dbname . ".parametros p where p.par_id = dedo_tipo_dedicacion) as dedo_des_tiempodedica,
                    (select par_nombre from " . $con->dbname . ".parametros p where p.par_id = dedo_tip_relacion_lab) as tipo_relacion,		
                    dedo_direccion_emp, 
                    dedo_telefono_emp as dedo_telefono, 
                    date_format(dedo_fecha_inicio,'%d/%m/%Y') as dedo_fecha_inicio, 
                    ifnull(date_format(dedo_fecha_fin,'%d/%m/%Y'),'') as dedo_fecha_fin,
                    dedo_actual,
                    (case when ifnull(dedo_fecha_fin,curdate()) = curdate() then
                                datediff(curdate(),dedo_fecha_inicio)
                                else datediff(dedo_fecha_fin,dedo_fecha_inicio) end) as dias,
                    @rownum:=@rownum+1 as dedo_clave
                FROM " . $con->dbname . ".detalle_experiencia_docencia ded, (SELECT @rownum:=0) R 
                WHERE   per_id = :per_id AND
                        dedo_estado = :estado AND
                        dedo_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);

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
        if ($opcion == 1) {
            return $resultData;
        } else {
            return $dataProvider;
        }
    }

    /**
     * Function consultarDatosinvestigacion Consulta de datos de investigación.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarDatosinvestigacion($per_id, $opcion) {
        $con = \Yii::$app->db_general;
        $estado = 1;
        $sql = "SELECT dinv_id, dinv_nombre_proyecto, 
                       par_nombre as div_des_rolproyecto,                         
                       date_format(dinv_fecha_inicio,'%d/%m/%Y') as dinv_fechainicio, 
                       ifnull(date_format(dinv_fecha_fin,'%d/%m/%Y'), '') as dinv_fechafin, 
                       dinv_actual,
                       dinv_documento,
                       (case when (dinv_financiado=1) then 'Si' else 'No' end) as dinv_des_financiada,
                       @rownum:=@rownum+1 as dinv_clave
                FROM " . $con->dbname . ".detalle_investigacion di INNER JOIN " . $con->dbname . ".parametros par on par.par_id = di.dinv_rol, (SELECT @rownum:=0) R 
                WHERE per_id = :per_id AND
                      dinv_estado = :estado AND
                      dinv_estado_logico = :estado AND 
                      par.par_estado = :estado AND
                      par.par_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);

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
        if ($opcion == 1) {
            return $resultData;
        } else {
            return $dataProvider;
        }
    }

    /**
     * Function consultarDatospublicacion Consulta de datos de publicación.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarDatospublicacion($per_id, $opcion) {
        $con = \Yii::$app->db_general;
        $estado = 1;
        $sql = "SELECT  dpub_id, tpub_id, 
                        (select tpub_nombre from " . $con->dbname . ".tipo_publicacion tp where tp.tpub_id = dp.tpub_id) as dpub_des_tipopublicacion,	
                        dpub_titulo,
                        ifnull(date_format(dpub_fecha_publicacion,'%d/%m/%Y'),'') as dpub_fecha_publicacion,
                        dpub_publicacion,
                        (select par_nombre from " . $con->dbname . ".parametros p where dpub_publicacion = p.par_id) as dpub_des_publicacion,
                        dpub_nombre_publicacion,
                        dpub_numero_isbn as dpub_numero_issn_isbn,
                        dpub_actual,
                        dpub_url,                        
                        dpub_link_publicacion,
                        @rownum:=@rownum+1 as dpub_clave
                FROM " . $con->dbname . ".detalle_publicacion dp, (SELECT @rownum:=0) R 
                WHERE per_id = :per_id AND
                      dpub_estado = :estado AND
                      dpub_estado_logico = :estado ";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);

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
        if ($opcion == 1) {
            return $resultData;
        } else {
            return $dataProvider;
        }
    }

    /**
     * Function consultarDatoscodireccion Consulta de datos de coodirección.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarDatoscodireccion($per_id, $opcion) {
        $con = \Yii::$app->db_general;
        $con1 = \Yii::$app->db;
        $con2 = \Yii::$app->db_academico;
        $estado = 1;
        $sql = "SELECT itut_id,
                       it.pai_id,
                       (select pai_nombre from " . $con1->dbname . ".pais p where p.pai_id = it.pai_id) as itut_des_pais,
                       ins_id,
                       (case when ifnull(itut_otra_institucion,'')='' then
                       (select ins_nombre from " . $con->dbname . ".institucion i where i.ins_id = it.ins_id)
                         else itut_otra_institucion end) as itut_des_institucion, 
                       (select par_nombre from " . $con->dbname . ".parametros p where itut_tipo_codireccion = p.par_id) as itut_des_tipocodireccion,       
                       itut_nombre,
                       ac.acon_nombre des_area_conocimiento,
                       itut_anio_aprob as itut_anio_aprobacion,
                       @rownum:=@rownum+1 as itut_clave
                FROM " . $con->dbname . ".info_tutorias it INNER JOIN " . $con2->dbname . ".area_conocimiento ac on ac.acon_id = it.acon_id, (SELECT @rownum:=0) R
                WHERE per_id = :per_id AND
                      itut_estado = :estado AND
                      itut_estado_logico = :estado AND
                      ac.acon_estado = :estado AND
                      ac.acon_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);

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
        if ($opcion == 1) {
            return $resultData;
        } else {
            return $dataProvider;
        }
    }

    /**
     * Function Consulta de datos de ponencias.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarDatosponencias($per_id, $opcion) {
        $con = \Yii::$app->db_general;
        $con1 = \Yii::$app->db;
        $con2 = \Yii::$app->db_academico;
        $estado = 1;
        $sql = "SELECT  ic.icon_id,
                        ic.pai_id,
                        (select pai_nombre from " . $con1->dbname . ".pais p where p.pai_id = ic.pai_id) as icon_des_pais,
                        ic.icon_institucion as icon_institucion, 
                        icon_nombre_evento,
                        ac.acon_nombre icon_des_areacon,
                        icon_ponencia,
                        icon_archivo,
                        @rownum:=@rownum+1 as icon_clave
                FROM " . $con->dbname . ".info_conferencias ic INNER JOIN " . $con2->dbname . ".area_conocimiento ac on ac.acon_id = ic.acon_id, (SELECT @rownum:=0) R
                WHERE per_id = :per_id AND
                      icon_estado = :estado AND
                      icon_estado_logico = :estado AND
                      ac.acon_estado = :estado AND
                      ac.acon_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);

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
        if ($opcion == 1) {
            return $resultData;
        } else {
            return $dataProvider;
        }
    }

    /**
     * Function consulta los profesores. 
     * @author Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultaProfesor() {
        $con = \Yii::$app->db_academico;
        $con1 = \Yii::$app->db_asgard;
        $estado = 1;
        $sql = "SELECT 
                   profe.pro_id  as id,
                   CONCAT (per.per_pri_apellido, ' ', per.per_pri_nombre) as name
                FROM 
                   " . $con->dbname . ".profesor  profe
                       INNER JOIN " . $con1->dbname . ".persona as per on per.per_id = profe.per_id
                WHERE 
                   profe.pro_estado = :estado AND
                   profe.pro_estado_logico = :estado AND
                   per.per_estado = :estado AND
                   per.per_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $resultData = $comando->queryAll();
        return $resultData;
    }

    /**
     * Function consulta los datos de los profesores para el grid. 
     * @author Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultaDatosprofesor($arrFiltro = array(), $onlyData = false) {
        $con = \Yii::$app->db_claustro;
        $con1 = \Yii::$app->db_asgard;
        $estado = 1;
        $columnsAdd = "";
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $str_search = "(per.per_pri_nombre like :search OR ";
            $str_search .= "per.per_seg_nombre like :search OR ";
            $str_search .= "per.per_pri_apellido like :search OR ";
            $str_search .= "per.per_cedula like :search) AND ";
        }
        $sql = "SELECT 
                   expro.epro_id  as id,
                   CONCAT (per.per_pri_apellido, ' ', per.per_pri_nombre) as name
                FROM 
                   " . $con->dbname . ".expediente_profesor  expro
                       INNER JOIN " . $con1->dbname . ".persona as per on per.per_id = expro.per_id
                WHERE ";
        if ($str_search != "") {
            $sql .= " $str_search ";
        }
        $sql .= " expro.epro_estado = :estado AND
                  expro.epro_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $search_cond = "%" . $arrFiltro["search"] . "%";
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
                'attributes' => [
                    'id',
                    'name',
                ],
            ],
        ]);
        return $dataProvider;
    }

    /**
     * Function modificarDetantecedentesfam que actualiza los datos de antecedentes familiares.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function modificarDetantecedentesfam($dafa_id, $tpar_id, $tafa_id, $ipdi_id, $dafa_nombres, $dafa_apellidos, $dafa_fecha_nacimiento, $dafa_ocupacion, $dafa_genero, $dafa_carga_actual, $dafa_archivo) {

        $con = \Yii::$app->db_general;
        $estado = 1;
        $dafa_fecha_modificacion = date("Y-m-d H:i:s");

        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una.
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".detalle_antecedentes_fam		       
                      SET tpar_id = ifnull(:tpar_id,tpar_id),
                        tafa_id = ifnull(:tafa_id,tafa_id),
                        ipdi_id = ifnull(:ipdi_id,ipdi_id),
                        dafa_nombres = ifnull(:dafa_nombres,dafa_nombres),
                        dafa_apellidos = ifnull(:dafa_apellidos,dafa_apellidos),
                        dafa_fecha_nacimiento = ifnull(:dafa_fecha_nacimiento,dafa_fecha_nacimiento),
                        dafa_ocupacion = ifnull(:dafa_ocupacion,dafa_ocupacion),
                        dafa_genero = ifnull(:dafa_genero,dafa_genero),
                        dafa_carga_actual = ifnull(:dafa_carga_actual,dafa_carga_actual),
                        dafa_archivo = ifnull(:dafa_archivo,dafa_archivo),
                        dafa_fecha_modificacion = ifnull(:dafa_fecha_modificacion,dafa_fecha_modificacion)
                      WHERE 
                        dafa_id = :dafa_id AND                        
                        dafa_estado = :estado AND
                        dafa_estado_logico = :estado");

            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
            $comando->bindParam(":dafa_id", $dafa_id, \PDO::PARAM_INT);
            $comando->bindParam(":tpar_id", $tpar_id, \PDO::PARAM_INT);
            $comando->bindParam(":tafa_id", $tafa_id, \PDO::PARAM_INT);
            $comando->bindParam(":ipdi_id", $ipdi_id, \PDO::PARAM_INT);
            $comando->bindParam(":dafa_nombres", $dafa_nombres, \PDO::PARAM_STR);
            $comando->bindParam(":dafa_apellidos", $dafa_apellidos, \PDO::PARAM_STR);
            $comando->bindParam(":dafa_fecha_nacimiento", $dafa_fecha_nacimiento, \PDO::PARAM_STR);
            $comando->bindParam(":dafa_ocupacion", $dafa_ocupacion, \PDO::PARAM_STR);
            $comando->bindParam(":dafa_genero", $dafa_genero, \PDO::PARAM_STR);
            $comando->bindParam(":dafa_carga_actual", $dafa_carga_actual, \PDO::PARAM_STR);
            $comando->bindParam(":dafa_archivo", $dafa_archivo, \PDO::PARAM_STR);
            $comando->bindParam(":dafa_fecha_modificacion", $dafa_fecha_modificacion, \PDO::PARAM_STR);

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
     * Function consultarParentesco Obtiene datos de parentesco de primer grado.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarParentesco($grado) {
        $con = \Yii::$app->db;
        $estado = 1;
        $sql = "SELECT tpar_id id, tpar_nombre value 
                FROM 
                   " . $con->dbname . ".tipo_parentesco  
                WHERE 
                   tpar_grado = :grado  AND
                   tpar_estado = :estado AND                   
                   tpar_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":grado", $grado, \PDO::PARAM_STR);

        $resultData = $comando->queryAll();
        return $resultData;
    }

    public function modificarDiscapacidad($ipdi_id, $tdis_id, $per_id, $ipdi_carnet_conadis, $ipdi_discapacidad, $ipdi_porcentaje, $ipdi_archivo, $ipdi_ruta) {

        $con = \Yii::$app->db_general;
        $estado = 1;
        $ipdi_fecha_modificacion = date("Y-m-d H:i:s");

        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una.
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".info_per_discapacidad		       
                      SET tdis_id = ifnull(:tdis_id,tdis_id),
                        ipdi_carnet_conadis = ifnull(:ipdi_carnet_conadis,ipdi_carnet_conadis),
                        ipdi_discapacidad = ifnull(:ipdi_discapacidad,ipdi_discapacidad),
                        ipdi_porcentaje = ifnull(:ipdi_porcentaje,ipdi_porcentaje),
                        ipdi_archivo = ifnull(:ipdi_archivo,ipdi_archivo),
                        ipdi_ruta = ifnull(:ipdi_ruta,ipdi_ruta),
                        ipdi_fecha_modificacion = ifnull(:ipdi_fecha_modificacion,ipdi_fecha_modificacion)
                      WHERE 
                        ipdi_id = :ipdi_id AND
                        per_id = :per_id AND
                        ipdi_estado = :estado AND
                        ipdi_estado_logico = :estado");

            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
            $comando->bindParam(":ipdi_id", $ipdi_id, \PDO::PARAM_INT);
            $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
            $comando->bindParam(":tdis_id", $tdis_id, \PDO::PARAM_INT);
            $comando->bindParam(":ipdi_carnet_conadis", $ipdi_carnet_conadis, \PDO::PARAM_STR);
            $comando->bindParam(":ipdi_discapacidad", $ipdi_discapacidad, \PDO::PARAM_STR);
            $comando->bindParam(":ipdi_porcentaje", $ipdi_porcentaje, \PDO::PARAM_STR);
            $comando->bindParam(":ipdi_archivo", $ipdi_archivo, \PDO::PARAM_STR);
            $comando->bindParam(":ipdi_ruta", $ipdi_ruta, \PDO::PARAM_STR);
            $comando->bindParam(":ipdi_fecha_modificacion", $ipdi_fecha_modificacion, \PDO::PARAM_STR);

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

    public function modificarDet_infocurricular($dicu_id, $per_id, $dicu_nivel_instruccion, $ins_id, $tcur_id, $dicu_otra_institucion, $dicu_titulo, $dicu_fecha_registro, $dicu_numero_registro, $dicu_documento) {

        $con = \Yii::$app->db_general;
        $estado = 1;
        $dicu_fecha_modificacion = date("Y-m-d H:i:s");
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una.
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }
        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".detalle_informacion_curricular		       
                      SET dicu_nivel_instruccion = ifnull(:dicu_nivel_instruccion,dicu_nivel_instruccion), 
                        ins_id = ifnull(:ins_id,ins_id),
                        tcur_id = ifnull(:tcur_id,tcur_id),                        
                        dicu_otra_institucion = ifnull(:dicu_otra_institucion,dicu_otra_institucion),
                        dicu_titulo = ifnull(:dicu_titulo,dicu_titulo),
                        dicu_fecha_registro = ifnull(:dicu_fecha_registro,dicu_fecha_registro),
                        dicu_numero_registro = ifnull(:dicu_numero_registro,dicu_numero_registro),
                        dicu_documento = ifnull(:dicu_documento,dicu_documento),
                        dicu_fecha_modificacion = ifnull(:dicu_fecha_modificacion,dicu_fecha_modificacion)
                      WHERE 
                        dicu_id = :dicu_id AND
                        per_id = :per_id AND
                        dicu_estado = :estado AND
                        dicu_estado_logico = :estado");

            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
            $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
            $comando->bindParam(":dicu_id", $dicu_id, \PDO::PARAM_INT);
            $comando->bindParam(":dicu_nivel_instruccion", $dicu_nivel_instruccion, \PDO::PARAM_INT);
            $comando->bindParam(":ins_id", $ins_id, \PDO::PARAM_INT);
            $comando->bindParam(":tcur_id", $tcur_id, \PDO::PARAM_INT);
            $comando->bindParam(":dicu_otra_institucion", $dicu_otra_institucion, \PDO::PARAM_STR);
            $comando->bindParam(":dicu_titulo", $dicu_titulo, \PDO::PARAM_STR);
            $comando->bindParam(":dicu_fecha_registro", $dicu_fecha_registro, \PDO::PARAM_STR);
            $comando->bindParam(":dicu_numero_registro", $dicu_numero_registro, \PDO::PARAM_STR);
            $comando->bindParam(":dicu_documento", $dicu_documento, \PDO::PARAM_STR);
            $comando->bindParam(":dicu_fecha_modificacion", $dicu_fecha_modificacion, \PDO::PARAM_STR);

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

    public function modificarDet_experiencialab($dela_id, $per_id, $temp_id, $pai_id, $dela_empresa, $dela_cargo, $dela_inicio_labores, $dela_fin_labores, $dela_actualidad, $icon_id) {

        $con = \Yii::$app->db_general;
        $estado = 1;
        $dela_fecha_modificacion = date("Y-m-d H:i:s");
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una.
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }
        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".detalle_experiencia_laboral		       
                      SET 
                        temp_id = ifnull(:temp_id,temp_id),
                        pai_id = ifnull(:pai_id,pai_id),
                        icon_id = ifnull(:icon_id,icon_id),
                        dela_empresa = ifnull(:dela_empresa,dela_empresa),
                        dela_cargo = ifnull(:dela_cargo,dela_cargo),
                        dela_inicio_labores = ifnull(:dela_inicio_labores,dela_inicio_labores),
                        dela_fin_labores = ifnull(:dela_fin_labores,dela_fin_labores),
                        dela_actualidad = ifnull(:dela_actualidad,dela_actualidad),
                        dela_fecha_modificacion = ifnull(:dela_fecha_modificacion,dela_fecha_modificacion)
                      WHERE 
                        dela_id = :dela_id AND
                        per_id = :per_id AND
                        dela_estado = :estado AND
                        dela_fecha_modificacion = :estado");

            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
            $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
            $comando->bindParam(":dela_id", $dela_id, \PDO::PARAM_INT);
            $comando->bindParam(":temp_id", $temp_id, \PDO::PARAM_INT);
            $comando->bindParam(":pai_id", $pai_id, \PDO::PARAM_INT);
            $comando->bindParam(":icon_id", $icon_id, \PDO::PARAM_INT);
            $comando->bindParam(":dela_empresa", $dela_empresa, \PDO::PARAM_STR);
            $comando->bindParam(":dela_cargo", $dela_cargo, \PDO::PARAM_STR);
            $comando->bindParam(":dela_inicio_labores", $dela_inicio_labores, \PDO::PARAM_STR);
            $comando->bindParam(":dela_fin_labores", $dela_fin_labores, \PDO::PARAM_STR);
            $comando->bindParam(":dela_actualidad", $dela_actualidad, \PDO::PARAM_STR);
            $comando->bindParam(":dela_fecha_modificacion", $dela_fecha_modificacion, \PDO::PARAM_STR);

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

    public function modificarInf_contacto($icon_id, $per_id, $icon_nombres, $icon_direccion, $icon_telefono, $icon_cargo, $icon_correo, $tcge_id) {

        $con = \Yii::$app->db_general;
        $estado = 1;
        $icon_fecha_modificacion = date("Y-m-d H:i:s");
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una.
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }
        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".informacion_contacto		       
                      SET 
                        tcge_id = ifnull(:tcge_id,tcge_id),
                        icon_nombres = ifnull(:icon_nombres,icon_nombres),
                        icon_id = ifnull(:icon_id,icon_id),
                        icon_direccion = ifnull(:icon_direccion,icon_direccion),
                        icon_telefono = ifnull(:icon_telefono,icon_telefono),
                        icon_correo = ifnull(:icon_correo,icon_correo),
                        icon_cargo = ifnull(:icon_cargo,icon_cargo),
                        icon_fecha_modificacion = ifnull(:icon_fecha_modificacion,icon_fecha_modificacion)
                      WHERE 
                        icon_id = :icon_id AND
                        per_id = :per_id AND
                        icon_estado = :estado AND
                        icon_estado_logico = :estado");

            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
            $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
            $comando->bindParam(":icon_id", $icon_id, \PDO::PARAM_INT);
            $comando->bindParam(":tcge_id", $tcge_id, \PDO::PARAM_INT);
            $comando->bindParam(":icon_nombres", $icon_nombres, \PDO::PARAM_STR);
            $comando->bindParam(":icon_id", $icon_id, \PDO::PARAM_STR);
            $comando->bindParam(":icon_direccion", $icon_direccion, \PDO::PARAM_STR);
            $comando->bindParam(":icon_telefono", $icon_telefono, \PDO::PARAM_STR);
            $comando->bindParam(":icon_correo", $icon_correo, \PDO::PARAM_STR);
            $comando->bindParam(":icon_cargo", $icon_cargo, \PDO::PARAM_STR);
            $comando->bindParam(":icon_fecha_modificacion", $icon_fecha_modificacion, \PDO::PARAM_STR);

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

    public function modificarDet_expdocencia($dedo_id, $per_id, $ins_id, $dedo_otra_institucion, $acon_id, $deco_catedra_impartida, $deco_tipo_dedicacion, $deco_tip_relacion_lab, $deco_direccion_emp, $deco_telefono_emp, $dedo_fecha_inicio, $dedo_fecha_fin, $dedo_actual, $icon_id) {

        $con = \Yii::$app->db_general;
        $estado = 1;
        $dedo_fecha_modificacion = date("Y-m-d H:i:s");
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una.
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }
        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".detalle_experiencia_docencia		       
                      SET 
                        ins_id = ifnull(:ins_id,ins_id),
                        icon_id = ifnull(:icon_id,icon_id),
                        dedo_otra_institucion = ifnull(:dedo_otra_institucion,dedo_otra_institucion),
                        acon_id = ifnull(:acon_id,acon_id),
                        dedo_catedra_impartida = ifnull(:dedo_catedra_impartida,dedo_catedra_impartida),
                        dedo_tipo_dedicacion = ifnull(:dedo_tipo_dedicacion,dedo_tipo_dedicacion),
                        dedo_tip_relacion_lab = ifnull(:dedo_tip_relacion_lab,dedo_tip_relacion_lab),
                        dedo_direccion_emp = ifnull(:dedo_direccion_emp,dedo_direccion_emp),
                        dedo_telefono_emp = ifnull(:dedo_telefono_emp,dedo_telefono_emp),
                        dedo_fecha_inicio = ifnull(:dedo_fecha_inicio,dedo_fecha_inicio),
                        dedo_fecha_fin = ifnull(:dedo_fecha_fin,dedo_fecha_fin),
                        dedo_actual = ifnull(:dedo_actual,dedo_actual)
                      WHERE 
                        dedo_id = :dedo_id AND
                        per_id = :per_id AND
                        dedo_estado = :estado AND
                        dedo_estado_logico = :estado");

            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
            $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
            $comando->bindParam(":dedo_id", $dedo_id, \PDO::PARAM_INT);
            $comando->bindParam(":ins_id", $ins_id, \PDO::PARAM_INT);
            $comando->bindParam(":icon_id", $icon_id, \PDO::PARAM_INT);
            $comando->bindParam(":dedo_otra_institucion", $dedo_otra_institucion, \PDO::PARAM_STR);
            $comando->bindParam(":acon_id", $acon_id, \PDO::PARAM_INT);
            $comando->bindParam(":dedo_catedra_impartida", $dedo_catedra_impartida, \PDO::PARAM_STR);
            $comando->bindParam(":dedo_tipo_dedicacion", $dedo_tipo_dedicacion, \PDO::PARAM_INT);
            $comando->bindParam(":dedo_tip_relacion_lab", $dedo_tip_relacion_lab, \PDO::PARAM_INT);
            $comando->bindParam(":dedo_direccion_emp", $dedo_direccion_emp, \PDO::PARAM_STR);
            $comando->bindParam(":dedo_telefono_emp", $dedo_telefono_emp, \PDO::PARAM_STR);
            $comando->bindParam(":dedo_fecha_inicio", $dedo_fecha_inicio, \PDO::PARAM_STR);
            $comando->bindParam(":dedo_fecha_fin", $dedo_fecha_fin, \PDO::PARAM_STR);
            $comando->bindParam(":dedo_actual", $dedo_actual, \PDO::PARAM_STR);
            $comando->bindParam(":dedo_fecha_modificacion", $dedo_fecha_modificacion, \PDO::PARAM_STR);

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

    public function modificarDet_capacitacion($per_id, $tcap_id, $tdip_id, $modalidad, $dcap_nombre_curso, $dcap_institucion_organiza, $dcap_duracion, $dcap_fecha_inicio, $dcap_fecha_fin, $dcap_documento_capacitacion, $dcap_actual) {

        $con = \Yii::$app->db_general;
        $estado = 1;
        $dedo_fecha_modificacion = date("Y-m-d H:i:s");
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una.
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }
        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".detalle_capacitacion		       
                      SET 
                        dcap_tipo_diploma = ifnull(:dcap_tipo_diploma,dcap_tipo_diploma),
                        dcap_modalidad = ifnull(:dcap_modalidad,dcap_modalidad),
                        dcap_tipo_capacitacion = ifnull(:dcap_tipo_capacitacion,dcap_tipo_capacitacion),
                        dcap_nombre_curso = ifnull(:dcap_nombre_curso,dcap_nombre_curso),
                        dcap_institucion_organiza = ifnull(:dcap_institucion_organiza,dcap_institucion_organiza),
                        dcap_duracion = ifnull(:dcap_duracion,dcap_duracion),
                        dcap_fecha_inicio = ifnull(:dcap_fecha_inicio,dcap_fecha_inicio),
                        dcap_fecha_fin = ifnull(:dcap_fecha_fin,dcap_fecha_fin),
                        dcap_documento_capacitacion = ifnull(:dcap_documento_capacitacion,dcap_documento_capacitacion),
                        dcap_actual = ifnull(:dcap_actual,dcap_actual),                        
                        dcap_fecha_modificacion = ifnull(:dcap_fecha_modificacion,dcap_fecha_modificacion)
                      WHERE 
                        dcap_id = :dcap_id AND
                        per_id = :per_id AND
                        dcap_estado = :estado AND
                        dcap_estado_logico = :estado");

            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
            $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
            $comando->bindParam(":dcap_id", $dcap_id, \PDO::PARAM_INT);
            $comando->bindParam(":dcap_tipo_diploma", $dcap_tipo_diploma, \PDO::PARAM_INT);
            $comando->bindParam(":dcap_modalidad", $dcap_modalidad, \PDO::PARAM_INT);
            $comando->bindParam(":dcap_tipo_capacitacion", $dcap_tipo_capacitacion, \PDO::PARAM_INT);
            $comando->bindParam(":dcap_nombre_curso", $dcap_nombre_curso, \PDO::PARAM_STR);
            $comando->bindParam(":dcap_institucion_organiza", $dcap_institucion_organiza, \PDO::PARAM_STR);
            $comando->bindParam(":dcap_duracion", $dcap_duracion, \PDO::PARAM_STR);
            $comando->bindParam(":dcap_fecha_inicio", $dcap_fecha_inicio, \PDO::PARAM_STR);
            $comando->bindParam(":dcap_fecha_fin", $dcap_fecha_fin, \PDO::PARAM_STR);
            $comando->bindParam(":dcap_documento_capacitacion", $dcap_documento_capacitacion, \PDO::PARAM_STR);
            $comando->bindParam(":dcap_actual", $dcap_actual, \PDO::PARAM_STR);
            $comando->bindParam(":dedo_fecha_modificacion", $dedo_fecha_modificacion, \PDO::PARAM_STR);

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

    public function modificarDet_publicacion($dpub_id, $per_id, $tpub_id, $dpub_titulo, $dpub_fecha_publicacion, $dpub_publicacion, $dpub_nombre_publicacion, $dpub_numero_isbn, $dpub_actual, $dpub_url, $dpub_link_publicacion, $dpub_acepta) {

        $con = \Yii::$app->db_general;
        $estado = 1;
        $dpub_fecha_modificacion = date("Y-m-d H:i:s");
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una.
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }
        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".detalle_publicacion		       
                      SET 
                        tpub_id = ifnull(:tpub_id,tpub_id),
                        dpub_titulo = ifnull(:dpub_titulo,dpub_titulo),
                        dpub_fecha_publicacion = ifnull(:dpub_fecha_publicacion,dpub_fecha_publicacion),
                        dpub_publicacion = ifnull(:dpub_publicacion,dpub_publicacion),
                        dpub_nombre_publicacion = ifnull(:dpub_nombre_publicacion,dpub_nombre_publicacion),
                        dpub_numero_isbn = ifnull(:dpub_numero_isbn,dpub_numero_isbn),
                        dpub_actual = ifnull(:dpub_actual,dpub_actual),
                        dpub_url = ifnull(:dpub_url,dpub_url),
                        dpub_link_publicacion = ifnull(:dpub_link_publicacion,dpub_link_publicacion),
                        dpub_acepta_responsabilidad = ifnull(:dpub_acepta_responsabilidad,dpub_acepta_responsabilidad),                        
                        dpub_fecha_modificacion = ifnull(:dpub_fecha_modificacion,dpub_fecha_modificacion)
                      WHERE 
                        dpub_id = :dpub_id AND
                        per_id = :per_id AND
                        dpub_estado = :estado AND
                        dpub_estado_logico = :estado");

            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
            $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
            $comando->bindParam(":dpub_id", $dpub_id, \PDO::PARAM_INT);
            $comando->bindParam(":tpub_id", $tpub_id, \PDO::PARAM_INT);
            $comando->bindParam(":dpub_titulo", $dpub_titulo, \PDO::PARAM_STR);
            $comando->bindParam(":dpub_fecha_publicacion", $dpub_fecha_publicacion, \PDO::PARAM_STR);
            $comando->bindParam(":dpub_publicacion", $dpub_publicacion, \PDO::PARAM_INT);
            $comando->bindParam(":dpub_nombre_publicacion", $dpub_nombre_publicacion, \PDO::PARAM_STR);
            $comando->bindParam(":dpub_numero_isbn", $dpub_numero_isbn, \PDO::PARAM_STR);
            $comando->bindParam(":dpub_actual", $dpub_actual, \PDO::PARAM_STR);
            $comando->bindParam(":dpub_url", $dpub_url, \PDO::PARAM_STR);
            $comando->bindParam(":dpub_link_publicacion", $dpub_link_publicacion, \PDO::PARAM_STR);
            $comando->bindParam(":dpub_acepta_responsabilidad", $dpub_acepta_responsabilidad, \PDO::PARAM_STR);
            $comando->bindParam(":dpub_fecha_modificacion", $dedo_fecha_modificacion, \PDO::PARAM_STR);

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

    public function modificarInf_tutorias($itut_id, $per_id, $pai_id, $ins_id, $itut_otra_institucion, $itut_tipocodireccion, $itut_nombre, $itut_anio_aprob, $itut_acepta) {

        $con = \Yii::$app->db_general;
        $estado = 1;
        $itut_modificacion = date("Y-m-d H:i:s");
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una.
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }
        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".info_tutorias		       
                      SET 
                        pai_id = ifnull(:pai_id,pai_id),
                        ins_id = ifnull(:ins_id,ins_id),
                        itut_tipo_codireccion = ifnull(:itut_tipo_codireccion,itut_tipo_codireccion),
                        itut_otra_institucion = ifnull(:itut_otra_institucion,itut_otra_institucion),
                        itut_nombre = ifnull(:itut_nombre,itut_nombre),
                        itut_anio_aprob = ifnull(:itut_anio_aprob,itut_anio_aprob),
                        itut_acepta_responsabilidad = ifnull(:itut_acepta_responsabilidad,itut_acepta_responsabilidad),
                        itut_modificacion = ifnull(:itut_modificacion,itut_modificacion)
                      WHERE 
                        itut_id = :itut_id AND
                        per_id = :per_id AND
                        itut_estado = :estado AND
                        itut_estado_logico = :estado");

            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
            $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
            $comando->bindParam(":itut_id", $itut_id, \PDO::PARAM_INT);
            $comando->bindParam(":pai_id", $pai_id, \PDO::PARAM_INT);
            $comando->bindParam(":ins_id", $ins_id, \PDO::PARAM_INT);
            $comando->bindParam(":itut_tipo_codireccion", $itut_tipo_codireccion, \PDO::PARAM_INT);
            $comando->bindParam(":itut_otra_institucion", $itut_otra_institucion, \PDO::PARAM_STR);
            $comando->bindParam(":itut_nombre", $itut_nombre, \PDO::PARAM_STR);
            $comando->bindParam(":itut_anio_aprob", $itut_anio_aprob, \PDO::PARAM_STR);
            $comando->bindParam(":itut_acepta_responsabilidad", $itut_acepta_responsabilidad, \PDO::PARAM_STR);
            $comando->bindParam(":itut_modificacion", $itut_modificacion, \PDO::PARAM_STR);

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

    public function modificarInf_conferencias($icon_id, $per_id, $pai_id, $ins_id, $icon_otra_institucion, $icon_nombre_evento, $icon_ponencia, $icon_acepta) {

        $con = \Yii::$app->db_general;
        $estado = 1;
        $icon_modificacion = date("Y-m-d H:i:s");
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una.
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }
        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".info_conferencias		       
                      SET 
                        pai_id = ifnull(:pai_id,pai_id),
                        ins_id = ifnull(:ins_id,ins_id),
                        icon_otra_institucion = ifnull(:icon_otra_institucion,icon_otra_institucion),
                        icon_nombre_evento = ifnull(:icon_nombre_evento,icon_nombre_evento),
                        icon_ponencia = ifnull(:icon_ponencia,icon_ponencia),
                        icon_acepta_responsabilidad = ifnull(:icon_acepta_responsabilidad,icon_acepta_responsabilidad),                        
                        icon_modificacion = ifnull(:icon_modificacion,icon_modificacion)
                      WHERE 
                        icon_id = :icon_id AND
                        per_id = :per_id AND
                        icon_estado = :estado AND
                        icon_estado_logico = :estado");

            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
            $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
            $comando->bindParam(":itut_id", $itut_id, \PDO::PARAM_INT);
            $comando->bindParam(":pai_id", $pai_id, \PDO::PARAM_INT);
            $comando->bindParam(":ins_id", $ins_id, \PDO::PARAM_INT);
            $comando->bindParam(":icon_otra_institucion", $icon_otra_institucion, \PDO::PARAM_STR);
            $comando->bindParam(":icon_nombre_evento", $icon_nombre_evento, \PDO::PARAM_STR);
            $comando->bindParam(":icon_ponencia", $icon_ponencia, \PDO::PARAM_STR);
            $comando->bindParam(":icon_acepta_responsabilidad", $icon_acepta_responsabilidad, \PDO::PARAM_STR);
            $comando->bindParam(":icon_modificacion", $icon_modificacion, \PDO::PARAM_STR);

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

    public function modificarDet_investigacion($dinv_id, $per_id, $dinv_nombre_proyecto, $dinv_responsabilidad, $dinv_fecha_inicio, $dinv_fecha_fin, $dinv_actual, $dinv_documento) {

        $con = \Yii::$app->db_general;
        $estado = 1;
        $dinv_fecha_modificacion = date("Y-m-d H:i:s");
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una.
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }
        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".detalle_investigacion		       
                      SET 
                        dinv_nombre_proyecto = ifnull(:dinv_nombre_proyecto,dinv_nombre_proyecto),
                        dinv_rol = ifnull(:dinv_rol,dinv_rol),
                        dinv_fecha_inicio = ifnull(:dinv_fecha_inicio,dinv_fecha_inicio),
                        dinv_fecha_fin = ifnull(:dinv_fecha_fin,dinv_fecha_fin),
                        dinv_documento = ifnull(:dinv_documento,dinv_documento),
                        dinv_actual = ifnull(:dinv_actual,dinv_actual),                        
                        icon_modificacion = ifnull(:icon_modificacion,icon_modificacion)
                      WHERE 
                        dinv_id = :dinv_id AND
                        per_id = :per_id AND
                        dinv_estado = :estado AND
                        dinv_estado_logico = :estado");

            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
            $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
            $comando->bindParam(":dinv_id", $dinv_id, \PDO::PARAM_INT);
            $comando->bindParam(":dinv_nombre_proyecto", $dinv_nombre_proyecto, \PDO::PARAM_STR);
            $comando->bindParam(":dinv_responsabilidad", $dinv_responsabilidad, \PDO::PARAM_STR);
            $comando->bindParam(":dinv_fecha_inicio", $dinv_fecha_inicio, \PDO::PARAM_STR);
            $comando->bindParam(":dinv_fecha_fin", $dinv_fecha_fin, \PDO::PARAM_STR);
            $comando->bindParam(":dinv_documento", $dinv_documento, \PDO::PARAM_STR);
            $comando->bindParam(":dinv_actual", $dinv_actual, \PDO::PARAM_STR);
            $comando->bindParam(":dinv_fecha_modificacion", $dinv_fecha_modificacion, \PDO::PARAM_STR);

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

    public function modificarResultadoxidioma($rxid_id, $per_id, $idi_id, $cidi_id, $nidi_id, $rxid_institucion, $rxid_documento, $rxid_otro_idioma) {

        $con = \Yii::$app->db_general;
        $estado = 1;
        $dinv_fecha_modificacion = date("Y-m-d H:i:s");
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una.
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }
        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".resultado_x_idioma		       
                      SET 
                        idi_id = ifnull(:idi_id,idi_id),
                        rxid_otro_idioma = ifnull(:rxid_otro_idioma,rxid_otro_idioma ),
                        cidi_id = ifnull(:cidi_id,cidi_id),
                        nidi_id = ifnull(:nidi_id,nidi_id),
                        rxid_institucion = ifnull(:rxid_institucion,rxid_institucion),
                        rxid_documento = ifnull(:rxid_documento,rxid_documento),                        
                        rxid_fecha_modificacion = ifnull(:rxid_fecha_modificacion,rxid_fecha_modificacion)
                      WHERE 
                        rxid_id = :rxid_id AND
                        per_id = :per_id AND
                        icon_estado = :estado AND
                        dinv_fecha_modificacion = :estado");

            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
            $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
            $comando->bindParam(":rxid_id", $rxid_id, \PDO::PARAM_INT);
            $comando->bindParam(":idi_id", $idi_id, \PDO::PARAM_INT);
            $comando->bindParam(":rxid_otro_idioma", $rxid_otro_idioma, \PDO::PARAM_STR);
            $comando->bindParam(":cidi_id", $cidi_id, \PDO::PARAM_INT);
            $comando->bindParam(":nidi_id", $nidi_id, \PDO::PARAM_INT);
            $comando->bindParam(":rxid_institucion", $rxid_institucion, \PDO::PARAM_STR);
            $comando->bindParam(":rxid_documento", $rxid_documento, \PDO::PARAM_STR);
            $comando->bindParam(":rxid_fecha_modificacion", $rxid_fecha_modificacion, \PDO::PARAM_STR);

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
     * Function inactivarDetantecedentesfam  que inactiva los datos de antecedentes familiares.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function inactivarDetantecedentesfam($dafa_id) {
        $con = \Yii::$app->db_general;
        $estado = 1;
        $estadoInactiva = 0;
        $dafa_fecha_modificacion = date("Y-m-d H:i:s");

        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una.
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".detalle_antecedentes_fam             
                      SET dafa_estado = :estadoInactiva,
                        dafa_fecha_modificacion = :dafa_fecha_modificacion
                      WHERE 
                        dafa_id = :dafa_id AND                        
                        dafa_estado = :estado AND
                        dafa_estado_logico = :estado");

            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
            $comando->bindParam(":dafa_id", $dafa_id, \PDO::PARAM_INT);
            $comando->bindParam(":estadoInactiva", $estadoInactiva, \PDO::PARAM_STR);
            $comando->bindParam(":dafa_fecha_modificacion", $dafa_fecha_modificacion, \PDO::PARAM_STR);

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
     * Function inactivarDetestudios  que inactiva los datos de estudios.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function inactivarDetestudios($dicu_id) {
        $con = \Yii::$app->db_general;
        $estado = 1;
        $estadoInactiva = 0;
        $dicu_fecha_modificacion = date("Y-m-d H:i:s");

        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una.
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".detalle_informacion_curricular             
                      SET dicu_estado = :estadoInactiva,
                        dicu_fecha_modificacion = :dicu_fecha_modificacion
                      WHERE 
                        dicu_id = :dicu_id AND                        
                        dicu_estado = :estado AND
                        dicu_estado_logico = :estado");

            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
            $comando->bindParam(":dicu_id", $dicu_id, \PDO::PARAM_INT);
            $comando->bindParam(":estadoInactiva", $estadoInactiva, \PDO::PARAM_STR);
            $comando->bindParam(":dicu_fecha_modificacion", $dicu_fecha_modificacion, \PDO::PARAM_STR);

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
     * Function inactivarDetidioma  que inactiva los datos de idiomas.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function inactivarDetidioma($per_id, $idi_id) {
        $con = \Yii::$app->db_general;
        $estado = 1;
        $estadoInactiva = 0;
        $fecha_modificacion = date("Y-m-d H:i:s");

        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una.
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".resultado_x_idioma             
                      SET rxid_estado = :estadoInactiva,
                        rxid_fecha_modificacion = :rxid_fecha_modificacion
                      WHERE 
                        per_id = :per_id AND                        
                        idi_id = :idi_id AND 
                        rxid_estado = :estado AND
                        rxid_estado_logico = :estado");

            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
            $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
            $comando->bindParam(":idi_id", $idi_id, \PDO::PARAM_INT);
            $comando->bindParam(":estadoInactiva", $estadoInactiva, \PDO::PARAM_STR);
            $comando->bindParam(":rxid_fecha_modificacion", $fecha_modificacion, \PDO::PARAM_STR);

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
     * Function inactivarDetcapacitaciones  que inactiva los datos de capacitaciones.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function inactivarDetcapacitaciones($dcap_id) {
        $con = \Yii::$app->db_general;
        $estado = 1;
        $estadoInactiva = 0;
        $fecha_modificacion = date("Y-m-d H:i:s");

        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una.
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".detalle_capacitacion             
                      SET dcap_estado = :estadoInactiva,
                        dcap_fecha_modificacion = :fecha_modificacion
                      WHERE 
                        dcap_id = :dcap_id AND                        
                        dcap_estado = :estado AND
                        dcap_estado_logico = :estado");

            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
            $comando->bindParam(":dcap_id", $dcap_id, \PDO::PARAM_INT);
            $comando->bindParam(":estadoInactiva", $estadoInactiva, \PDO::PARAM_STR);
            $comando->bindParam(":fecha_modificacion", $fecha_modificacion, \PDO::PARAM_STR);

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
     * Function inactivarDetexplaboral  que inactiva los datos de experiencia laboral.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function inactivarDetexplaboral($dela_id) {
        $con = \Yii::$app->db_general;
        $estado = 1;
        $estadoInactiva = 0;
        $fecha_modificacion = date("Y-m-d H:i:s");

        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una.
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".detalle_experiencia_laboral             
                      SET dela_estado = :estadoInactiva,
                        dela_fecha_modificacion = :fecha_modificacion
                      WHERE 
                        dela_id = :dcap_id AND                        
                        dela_estado = :estado AND
                        dela_estado_logico = :estado");

            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
            $comando->bindParam(":dcap_id", $dela_id, \PDO::PARAM_INT);
            $comando->bindParam(":estadoInactiva", $estadoInactiva, \PDO::PARAM_STR);
            $comando->bindParam(":fecha_modificacion", $fecha_modificacion, \PDO::PARAM_STR);

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
     * Function inactivarDetexpdocente  que inactiva los datos de experiencia en docencia.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function inactivarDetexpdocente($dedo_id) {
        $con = \Yii::$app->db_general;
        $estado = 1;
        $estadoInactiva = 0;
        $fecha_modificacion = date("Y-m-d H:i:s");

        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una.
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".detalle_experiencia_docencia             
                      SET dedo_estado = :estadoInactiva,
                        dedo_fecha_modificacion = :fecha_modificacion
                      WHERE 
                        dedo_id = :dedo_id AND                        
                        dedo_estado = :estado AND
                        dedo_estado_logico = :estado");

            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
            $comando->bindParam(":dedo_id", $dedo_id, \PDO::PARAM_INT);
            $comando->bindParam(":estadoInactiva", $estadoInactiva, \PDO::PARAM_STR);
            $comando->bindParam(":fecha_modificacion", $fecha_modificacion, \PDO::PARAM_STR);

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
     * Function inactivarDetinvestigacion  que inactiva los datos de investigación.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function inactivarDetinvestigacion($dinv_id) {
        $con = \Yii::$app->db_general;
        $estado = 1;
        $estadoInactiva = 0;
        $fecha_modificacion = date("Y-m-d H:i:s");

        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una.
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".detalle_investigacion             
                      SET dinv_estado = :estadoInactiva,
                        dinv_fecha_modificacion = :fecha_modificacion
                      WHERE 
                        dinv_id = :dinv_id AND                        
                        dinv_estado = :estado AND
                        dinv_estado_logico = :estado");

            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
            $comando->bindParam(":dinv_id", $dinv_id, \PDO::PARAM_INT);
            $comando->bindParam(":estadoInactiva", $estadoInactiva, \PDO::PARAM_STR);
            $comando->bindParam(":fecha_modificacion", $fecha_modificacion, \PDO::PARAM_STR);

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
     * Function inactivarDetpublicacion  que inactiva los datos de publicación.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function inactivarDetpublicacion($dpub_id) {
        $con = \Yii::$app->db_general;
        $estado = 1;
        $estadoInactiva = 0;
        $fecha_modificacion = date("Y-m-d H:i:s");

        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una.
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".detalle_publicacion             
                      SET dpub_estado = :estadoInactiva,
                        dpub_fecha_modificacion = :fecha_modificacion
                      WHERE 
                        dpub_id = :dpub_id AND                        
                        dpub_estado = :estado AND
                        dpub_estado_logico = :estado");

            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
            $comando->bindParam(":dpub_id", $dpub_id, \PDO::PARAM_INT);
            $comando->bindParam(":estadoInactiva", $estadoInactiva, \PDO::PARAM_STR);
            $comando->bindParam(":fecha_modificacion", $fecha_modificacion, \PDO::PARAM_STR);

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
     * Function inactivarDetcodireccion  que inactiva los datos de tutorías o codirección.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function inactivarDetcodireccion($itut_id) {
        $con = \Yii::$app->db_general;
        $estado = 1;
        $estadoInactiva = 0;
        $fecha_modificacion = date("Y-m-d H:i:s");

        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una.
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".info_tutorias             
                      SET   itut_estado = :estadoInactiva,
                            itut_fecha_modificacion = :fecha_modificacion
                      WHERE 
                        itut_id = :itut_id AND                        
                        itut_estado = :estado AND
                        itut_estado_logico = :estado");

            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
            $comando->bindParam(":itut_id", $itut_id, \PDO::PARAM_INT);
            $comando->bindParam(":estadoInactiva", $estadoInactiva, \PDO::PARAM_STR);
            $comando->bindParam(":fecha_modificacion", $fecha_modificacion, \PDO::PARAM_STR);

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
     * Function inactivarDetconferencia  que inactiva los datos de ponencias.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function inactivarDetconferencia($icon_id) {
        $con = \Yii::$app->db_general;
        $estado = 1;
        $estadoInactiva = 0;
        $fecha_modificacion = date("Y-m-d H:i:s");

        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una.
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".info_conferencias             
                      SET   icon_estado = :estadoInactiva,
                            icon_fecha_modificacion = :fecha_modificacion
                      WHERE 
                        icon_id = :icon_id AND                        
                        icon_estado = :estado AND
                        icon_estado_logico = :estado");

            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
            $comando->bindParam(":icon_id", $icon_id, \PDO::PARAM_INT);
            $comando->bindParam(":estadoInactiva", $estadoInactiva, \PDO::PARAM_STR);
            $comando->bindParam(":fecha_modificacion", $fecha_modificacion, \PDO::PARAM_STR);

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
     * Function inactivarInfoDiscapacidad  que inactiva los datos de discapacidad.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function inactivarInfoDiscapacidad($ipdi_id) {
        $con = \Yii::$app->db_general;
        $estado = 1;
        $estadoInactiva = 0;
        $fecha_modificacion = date("Y-m-d H:i:s");

        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una.
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".info_per_discapacidad             
                      SET ipdi_estado = :estadoInactiva,
                          ipdi_fecha_modificacion = :fecha_modificacion
                      WHERE 
                        ipdi_id = :ipdi_id AND                        
                        ipdi_estado = :estado AND
                        ipdi_estado_logico = :estado");

            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
            $comando->bindParam(":ipdi_id", $ipdi_id, \PDO::PARAM_INT);
            $comando->bindParam(":estadoInactiva", $estadoInactiva, \PDO::PARAM_STR);            
            $comando->bindParam(":fecha_modificacion", $fecha_modificacion, \PDO::PARAM_STR);

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
     * Function consulta de datos del familiar, si existiere familiar con discapacidad. 
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarDiscapacidadFamiliar($dafa_id) {
        $con = \Yii::$app->db_general;
        $estado = 1;
        $sql = "SELECT 
                   ipdi_id
                FROM 
                   " . $con->dbname . ".detalle_antecedentes_fam  
                WHERE 
                   dafa_id = :dafa_id  AND
                   dafa_estado = :estado AND
                   dafa_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":dafa_id", $dafa_id, \PDO::PARAM_INT);

        $resultData = $comando->queryOne();
        return $resultData;
    }
    
    /**
     * Function consulta de datos de contacto registrado en experiencia en docencia. 
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarInfoContactoExpDoc($dedo_id) {
        $con = \Yii::$app->db_general;
        $estado = 1;
        $sql = "SELECT 
                   icon_id
                FROM 
                   " . $con->dbname . ".detalle_experiencia_docencia  
                WHERE 
                   dedo_id = :dedo_id  AND
                   dedo_estado = :estado AND
                   dedo_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":dedo_id", $dedo_id, \PDO::PARAM_INT);

        $resultData = $comando->queryOne();
        return $resultData;
    }
    
        /**
     * Function consulta de datos de contacto registrado en experiencia laboral. 
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarInfoContactoExpLab($dela_id) {
        $con = \Yii::$app->db_general;
        $estado = 1;
        $sql = "SELECT 
                   icon_id
                FROM 
                   " . $con->dbname . ".detalle_experiencia_laboral  
                WHERE 
                   dela_id = :dela_id  AND
                   dela_estado = :estado AND
                   dela_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":dela_id", $dela_id, \PDO::PARAM_INT);

        $resultData = $comando->queryOne();
        return $resultData;
    }
    
    /**
     * Function inactivarInfoContacto  que inactiva los datos de contacto registrados 
     *          en experiencia laboral y docente.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function inactivarInfoContacto($icon_id) {
        $con = \Yii::$app->db_general;
        $estado = 1;
        $estadoInactiva = 0;
        $fecha_modificacion = date("Y-m-d H:i:s");

        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una.
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".informacion_contacto             
                      SET icon_estado = :estadoInactiva,
                          icon_fecha_modificacion = :fecha_modificacion
                      WHERE 
                        icon_id = :icon_id AND                        
                        icon_estado = :estado AND
                        icon_estado_logico = :estado");

            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
            $comando->bindParam(":icon_id", $icon_id, \PDO::PARAM_INT);
            $comando->bindParam(":estadoInactiva", $estadoInactiva, \PDO::PARAM_STR);            
            $comando->bindParam(":fecha_modificacion", $fecha_modificacion, \PDO::PARAM_STR);

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
     * Function consulta los profesores. 
     * @author Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultaProfesorgrid($search = NULL) {
        $con = \Yii::$app->db_academico;
        $con1 = \Yii::$app->db_asgard;
        $estado = 1;
        $search_cond = "%" . $search . "%";    
        $str_search = "";

        if (isset($search)) {
            $str_search = "(per.per_pri_nombre like :search OR ";
            $str_search .= "per.per_seg_nombre like :search OR ";
            $str_search .= "per.per_pri_apellido like :search OR ";
            $str_search .= "per.per_seg_apellido like :search) AND ";
        }
        $sql = "SELECT 
                   profe.pro_id  as id,
                   per.per_pri_nombre as nombre,
                   per.per_pri_apellido as apellido,
                   per.per_cedula as dni
                FROM 
                   " . $con->dbname . ".profesor  profe
                       INNER JOIN " . $con1->dbname . ".persona as per on per.per_id = profe.per_id
                WHERE 
                   $str_search
                   profe.pro_estado = :estado AND
                   profe.pro_estado_logico = :estado AND
                   per.per_estado = :estado AND
                   per.per_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
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
}
