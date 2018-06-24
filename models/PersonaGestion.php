<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "persona_gestion".
 *
 * @property integer $pges_id
 * @property string $pges_pri_nombre
 * @property string $pges_seg_nombre
 * @property string $pges_pri_apellido
 * @property string $pges_seg_apellido
 * @property string $pges_cedula
 * @property string $pges_ruc
 * @property string $pges_pasaporte
 * @property integer $etn_id
 * @property integer $eciv_id
 * @property string $pges_genero
 * @property string $pges_nacionalidad
 * @property integer $pai_id_nacimiento
 * @property integer $pro_id_nacimiento
 * @property integer $can_id_nacimiento
 * @property string $pges_nac_ecuatoriano
 * @property string $pges_fecha_nacimiento
 * @property string $pges_celular
 * @property string $pges_correo
 * @property string $pges_foto
 * @property integer $tsan_id
 * @property string $pges_domicilio_sector
 * @property string $pges_domicilio_cpri
 * @property string $pges_domicilio_csec
 * @property string $pges_domicilio_num
 * @property string $pges_domicilio_ref
 * @property string $pges_domicilio_telefono
 * @property string $pges_domicilio_celular2
 * @property integer $pai_id_domicilio
 * @property integer $pro_id_domicilio
 * @property integer $can_id_domicilio
 * @property string $pges_trabajo_nombre
 * @property string $pges_trabajo_direccion
 * @property string $pges_trabajo_telefono
 * @property string $pges_trabajo_ext
 * @property integer $pai_id_trabajo
 * @property integer $pges_id_trabajo
 * @property integer $pro_id_trabajo
 * @property integer $can_id_trabajo
 * @property string $pges_estado
 * @property string $pges_fecha_creacion
 * @property string $pges_fecha_modificacion
 * @property string $pges_estado_logico
 */
class PersonaGestion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'persona_gestion';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_crm');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['etn_id', 'eciv_id', 'pai_id_nacimiento', 'pro_id_nacimiento', 'can_id_nacimiento', 'tsan_id', 'pai_id_domicilio', 'pro_id_domicilio', 'can_id_domicilio', 'pai_id_trabajo', 'pges_id_trabajo', 'pro_id_trabajo', 'can_id_trabajo'], 'integer'],
            [['pges_fecha_nacimiento', 'pges_fecha_creacion', 'pges_fecha_modificacion'], 'safe'],
            [['pges_estado', 'pges_estado_logico'], 'required'],
            [['pges_pri_nombre', 'pges_seg_nombre', 'pges_pri_apellido', 'pges_seg_apellido', 'pges_nacionalidad', 'pges_correo', 'pges_domicilio_sector', 'pges_trabajo_nombre'], 'string', 'max' => 250],
            [['pges_cedula', 'pges_ruc'], 'string', 'max' => 15],
            [['pges_pasaporte', 'pges_celular', 'pges_domicilio_telefono', 'pges_domicilio_celular2', 'pges_trabajo_telefono', 'pges_trabajo_ext'], 'string', 'max' => 50],
            [['pges_genero', 'pges_nac_ecuatoriano', 'pges_estado', 'pges_estado_logico'], 'string', 'max' => 1],
            [['pges_foto', 'pges_domicilio_cpri', 'pges_domicilio_csec', 'pges_domicilio_ref', 'pges_trabajo_direccion'], 'string', 'max' => 500],
            [['pges_domicilio_num'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pges_id' => 'Pges ID',
            'pges_pri_nombre' => 'Pges Pri Nombre',
            'pges_seg_nombre' => 'Pges Seg Nombre',
            'pges_pri_apellido' => 'Pges Pri Apellido',
            'pges_seg_apellido' => 'Pges Seg Apellido',
            'pges_cedula' => 'Pges Cedula',
            'pges_ruc' => 'Pges Ruc',
            'pges_pasaporte' => 'Pges Pasaporte',
            'etn_id' => 'Etn ID',
            'eciv_id' => 'Eciv ID',
            'pges_genero' => 'Pges Genero',
            'pges_nacionalidad' => 'Pges Nacionalidad',
            'pai_id_nacimiento' => 'Pai Id Nacimiento',
            'pro_id_nacimiento' => 'Pro Id Nacimiento',
            'can_id_nacimiento' => 'Can Id Nacimiento',
            'pges_nac_ecuatoriano' => 'Pges Nac Ecuatoriano',
            'pges_fecha_nacimiento' => 'Pges Fecha Nacimiento',
            'pges_celular' => 'Pges Celular',
            'pges_correo' => 'Pges Correo',
            'pges_foto' => 'Pges Foto',
            'tsan_id' => 'Tsan ID',
            'pges_domicilio_sector' => 'Pges Domicilio Sector',
            'pges_domicilio_cpri' => 'Pges Domicilio Cpri',
            'pges_domicilio_csec' => 'Pges Domicilio Csec',
            'pges_domicilio_num' => 'Pges Domicilio Num',
            'pges_domicilio_ref' => 'Pges Domicilio Ref',
            'pges_domicilio_telefono' => 'Pges Domicilio Telefono',
            'pges_domicilio_celular2' => 'Pges Domicilio Celular2',
            'pai_id_domicilio' => 'Pai Id Domicilio',
            'pro_id_domicilio' => 'Pro Id Domicilio',
            'can_id_domicilio' => 'Can Id Domicilio',
            'pges_trabajo_nombre' => 'Pges Trabajo Nombre',
            'pges_trabajo_direccion' => 'Pges Trabajo Direccion',
            'pges_trabajo_telefono' => 'Pges Trabajo Telefono',
            'pges_trabajo_ext' => 'Pges Trabajo Ext',
            'pai_id_trabajo' => 'Pai Id Trabajo',
            'pges_id_trabajo' => 'Pges Id Trabajo',
            'pro_id_trabajo' => 'Pro Id Trabajo',
            'can_id_trabajo' => 'Can Id Trabajo',
            'pges_estado' => 'Pges Estado',
            'pges_fecha_creacion' => 'Pges Fecha Creacion',
            'pges_fecha_modificacion' => 'Pges Fecha Modificacion',
            'pges_estado_logico' => 'Pges Estado Logico',
        ];
    }
    

    /**
     * Function insertarPersonaGestion grabar la inserción personas.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function insertarPersonaGestion($pges_pri_nombre, $pges_seg_nombre, $pges_pri_apellido, $pges_seg_apellido, $pges_cedula, $pges_ruc, $pges_pasaporte, $etn_id, $eciv_id, $pges_genero, $pges_nacionalidad, $pai_id_nacimiento, $pro_id_nacimiento, $can_id_nacimiento, $pges_nac_ecuatoriano, $pges_fecha_nacimiento, $pges_celular, $pges_correo, $pges_foto, $tsan_id, $pges_domicilio_sector, $pges_domicilio_cpri, $pges_domicilio_csec, $pges_domicilio_num, $pges_domicilio_ref, $pges_domicilio_telefono, $pges_domicilio_celular2, $pai_id_domicilio, $pro_id_domicilio, $can_id_domicilio, $pges_trabajo_nombre, $pges_trabajo_direccion, $pges_trabajo_telefono, $pges_trabajo_ext, $pges_id_trabajo, $pro_id_trabajo, $can_id_trabajo) {
        $con = \Yii::$app->db_crm;

        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        $param_sql = "pges_estado";
        $bdet_sql = "1";

        $param_sql .= ", pges_estado_logico";
        $bdet_sql .= ", 1";

        if (isset($pges_pri_nombre)) {
            $param_sql .= ", pges_pri_nombre";
            $bdet_sql .= ", :pges_pri_nombre";
        }
        if (isset($pges_seg_nombre)) {
            $param_sql .= ", pges_seg_nombre";
            $bdet_sql .= ", :pges_seg_nombre";
        }
        if (isset($pges_pri_apellido)) {
            $param_sql .= ", pges_pri_apellido";
            $bdet_sql .= ", :pges_pri_apellido";
        }
        if (isset($pges_seg_apellido)) {
            $param_sql .= ", pges_seg_apellido";
            $bdet_sql .= ", :pges_seg_apellido";
        }
        if (isset($pges_cedula)) {
            $param_sql .= ", pges_cedula";
            $bdet_sql .= ", :pges_cedula";
        }
        if (isset($pges_ruc)) {
            $param_sql .= ", pges_ruc";
            $bdet_sql .= ", :pges_ruc";
        }
        if (isset($pges_pasaporte)) {
            $param_sql .= ", pges_pasaporte";
            $bdet_sql .= ", :pges_pasaporte";
        }
        if (isset($etn_id)) {
            $param_sql .= ", etn_id";
            $bdet_sql .= ", :etn_id";
        }
        if (isset($eciv_id)) {
            $param_sql .= ", eciv_id";
            $bdet_sql .= ", :eciv_id";
        }
        if (isset($pges_genero)) {
            $param_sql .= ", pges_genero";
            $bdet_sql .= ", :pges_genero";
        }
        if (isset($pges_nacionalidad)) {
            $param_sql .= ", pges_nacionalidad";
            $bdet_sql .= ", :pges_nacionalidad";
        }
        if (isset($pai_id_nacimiento)) {
            $param_sql .= ", pai_id_nacimiento";
            $bdet_sql .= ", :pai_id_nacimiento";
        }
        if (isset($pro_id_nacimiento)) {
            $param_sql .= ", pro_id_nacimiento";
            $bdet_sql .= ", :pro_id_nacimiento";
        }
        if (isset($can_id_nacimiento)) {
            $param_sql .= ", can_id_nacimiento";
            $bdet_sql .= ", :can_id_nacimiento";
        }
        if (isset($pges_nac_ecuatoriano)) {
            $param_sql .= ", pges_nac_ecuatoriano";
            $bdet_sql .= ", :pges_nac_ecuatoriano";
        }
        if (isset($pges_fecha_nacimiento)) {
            $param_sql .= ", pges_fecha_nacimiento";
            $bdet_sql .= ", :pges_fecha_nacimiento";
        }
        if (isset($pges_celular)) {
            $param_sql .= ", pges_celular";
            $bdet_sql .= ", :pges_celular";
        }
        if (isset($pges_correo)) {
            $param_sql .= ", pges_correo";
            $bdet_sql .= ", :pges_correo";
        }
        if (isset($pges_foto)) {
            $param_sql .= ", pges_foto";
            $bdet_sql .= ", :pges_foto";
        }
        if (isset($tsan_id)) {
            $param_sql .= ", tsan_id";
            $bdet_sql .= ", :tsan_id";
        }
        if (isset($pges_domicilio_sector)) {
            $param_sql .= ", pges_domicilio_sector";
            $bdet_sql .= ", :pges_domicilio_sector";
        }
        if (isset($pges_domicilio_cpri)) {
            $param_sql .= ", pges_domicilio_cpri";
            $bdet_sql .= ", :pges_domicilio_cpri";
        }
        if (isset($pges_domicilio_csec)) {
            $param_sql .= ", pges_domicilio_csec";
            $bdet_sql .= ", :pges_domicilio_csec";
        }
        if (isset($pges_domicilio_num)) {
            $param_sql .= ", pges_domicilio_num";
            $bdet_sql .= ", :pges_domicilio_num";
        }
        if (isset($pges_domicilio_ref)) {
            $param_sql .= ", pges_domicilio_ref";
            $bdet_sql .= ", :pges_domicilio_ref";
        }
        if (isset($pges_domicilio_telefono)) {
            $param_sql .= ", pges_domicilio_telefono";
            $bdet_sql .= ", :pges_domicilio_telefono";
        }
        if (isset($pges_domicilio_celular2)) {
            $param_sql .= ", pges_domicilio_celular2";
            $bdet_sql .= ", :pges_domicilio_celular2";
        }
        if (isset($pai_id_domicilio)) {
            $param_sql .= ", pai_id_domicilio";
            $bdet_sql .= ", :pai_id_domicilio";
        }
        if (isset($pro_id_domicilio)) {
            $param_sql .= ", pro_id_domicilio";
            $bdet_sql .= ", :pro_id_domicilio";
        }
        if (isset($can_id_domicilio)) {
            $param_sql .= ", can_id_domicilio";
            $bdet_sql .= ", :can_id_domicilio";
        }
        if (isset($pges_trabajo_nombre)) {
            $param_sql .= ", pges_trabajo_nombre";
            $bdet_sql .= ", :pges_trabajo_nombre";
        }
        if (isset($pges_trabajo_direccion)) {
            $param_sql .= ", pges_trabajo_direccion";
            $bdet_sql .= ", :pges_trabajo_direccion";
        }
        if (isset($pges_trabajo_telefono)) {
            $param_sql .= ", pges_trabajo_telefono";
            $bdet_sql .= ", :pges_trabajo_telefono";
        }
        if (isset($pges_trabajo_ext)) {
            $param_sql .= ", pges_trabajo_ext";
            $bdet_sql .= ", :pges_trabajo_ext";
        }
        if (isset($pges_id_trabajo)) {
            $param_sql .= ", pges_id_trabajo";
            $bdet_sql .= ", :pges_id_trabajo";
        }
        if (isset($pro_id_trabajo)) {
            $param_sql .= ", pro_id_trabajo";
            $bdet_sql .= ", :pro_id_trabajo";
        }
        if (isset($can_id_trabajo)) {
            $param_sql .= ", can_id_trabajo";
            $bdet_sql .= ", :can_id_trabajo";
        }
        try {
            $sql = "INSERT INTO " . $con->dbname . ".persona_gestion ($param_sql) VALUES($bdet_sql)";
            $comando = $con->createCommand($sql);

            if (isset($pges_pri_nombre)) {
                $comando->bindParam(':pges_pri_nombre', $pges_pri_nombre, \PDO::PARAM_STR);
            }
            if (!empty((isset($pges_seg_nombre)))) {
                $comando->bindParam(':pges_seg_nombre', $pges_seg_nombre, \PDO::PARAM_STR);
            }
            if (isset($pges_pri_apellido)) {
                $comando->bindParam(':pges_pri_apellido', $pges_pri_apellido, \PDO::PARAM_STR);
            }
            if (!empty((isset($pges_seg_apellido)))) {
                $comando->bindParam(':pges_seg_apellido', $pges_seg_apellido, \PDO::PARAM_STR);
            }
            if (isset($pges_cedula)) {
                $comando->bindParam(':pges_cedula', $pges_cedula, \PDO::PARAM_STR);
            }
            if (!empty((isset($pges_ruc)))) {
                $comando->bindParam(':pges_ruc', $pges_ruc, \PDO::PARAM_STR);
            }
            if (!empty((isset($pges_pasaporte)))) {
                $comando->bindParam(':pges_pasaporte', $pges_pasaporte, \PDO::PARAM_STR);
            }
            if (!empty((isset($etn_id)))) {
                $comando->bindParam(':etn_id', $etn_id, \PDO::PARAM_INT);
            }
            if (!empty((isset($eciv_id)))) {
                $comando->bindParam(':eciv_id', $eciv_id, \PDO::PARAM_INT);
            }
            if (!empty((isset($pges_genero)))) {
                $comando->bindParam(':pges_genero', $pges_genero, \PDO::PARAM_STR);
            }
            if (!empty((isset($pges_nacionalidad)))) {
                $comando->bindParam(':pges_nacionalidad', $pges_nacionalidad, \PDO::PARAM_STR);
            }
            if (!empty((isset($pai_id_nacimiento)))) {
                $comando->bindParam(':pai_id_nacimiento', $pai_id_nacimiento, \PDO::PARAM_INT);
            }
            if (!empty((isset($pro_id_nacimiento)))) {
                $comando->bindParam(':pro_id_nacimiento', $pro_id_nacimiento, \PDO::PARAM_INT);
            }
            if (!empty((isset($can_id_nacimiento)))) {
                $comando->bindParam(':can_id_nacimiento', $can_id_nacimiento, \PDO::PARAM_INT);
            }
            if (!empty((isset($pges_nac_ecuatoriano)))) {
                $comando->bindParam(':pges_nac_ecuatoriano', $pges_nac_ecuatoriano, \PDO::PARAM_STR);
            }
            if (!empty((isset($pges_fecha_nacimiento)))) {
                $comando->bindParam(':pges_fecha_nacimiento', $pges_fecha_nacimiento, \PDO::PARAM_STR);
            }
            if (!empty((isset($pges_celular)))) {
                $comando->bindParam(':pges_celular', $pges_celular, \PDO::PARAM_STR);
            }
            if (!empty((isset($pges_correo)))) {
                $comando->bindParam(':pges_correo', $pges_correo, \PDO::PARAM_STR);
            }
            if (!empty((isset($pges_foto)))) {
                $comando->bindParam(':pges_foto', $pges_foto, \PDO::PARAM_STR);
            }
            if (!empty((isset($tsan_id)))) {
                $comando->bindParam(':tsan_id', $tsan_id, \PDO::PARAM_INT);
            }
            if (!empty((isset($pges_domicilio_sector)))) {
                $comando->bindParam(':pges_domicilio_sector', $pges_domicilio_sector, \PDO::PARAM_STR);
            }
            if (!empty((isset($pges_domicilio_cpri)))) {
                $comando->bindParam(':pges_domicilio_cpri', $pges_domicilio_cpri, \PDO::PARAM_STR);
            }
            if (!empty((isset($pges_domicilio_csec)))) {
                $comando->bindParam(':pges_domicilio_csec', $pges_domicilio_csec, \PDO::PARAM_STR);
            }
            if (!empty((isset($pges_domicilio_num)))) {
                $comando->bindParam(':pges_domicilio_num', $pges_domicilio_num, \PDO::PARAM_STR);
            }
            if (!empty((isset($pges_domicilio_ref)))) {
                $comando->bindParam(':pges_domicilio_ref', $pges_domicilio_ref, \PDO::PARAM_STR);
            }
            if (!empty((isset($pges_domicilio_telefono)))) {
                $comando->bindParam(':pges_domicilio_telefono', $pges_domicilio_telefono, \PDO::PARAM_STR);
            }
            if (!empty((isset($pges_domicilio_celular2)))) {
                $comando->bindParam(':pges_domicilio_celular2', $pges_domicilio_celular2, \PDO::PARAM_STR);
            }
            if (!empty((isset($pai_id_domicilio)))) {
                $comando->bindParam(':pai_id_domicilio', $pai_id_domicilio, \PDO::PARAM_INT);
            }
            if (!empty((isset($pro_id_domicilio)))) {
                $comando->bindParam(':pro_id_domicilio', $pro_id_domicilio, \PDO::PARAM_INT);
            }
            if (!empty((isset($can_id_domicilio)))) {
                $comando->bindParam(':can_id_domicilio', $can_id_domicilio, \PDO::PARAM_INT);
            }
            if (!empty((isset($pges_trabajo_nombre)))) {
                $comando->bindParam(':pges_trabajo_nombre', $pges_trabajo_nombre, \PDO::PARAM_STR);
            }
            if (!empty((isset($pges_trabajo_direccion)))) {
                $comando->bindParam(':pges_trabajo_direccion', $pges_trabajo_direccion, \PDO::PARAM_STR);
            }
            if (!empty((isset($pges_trabajo_telefono)))) {
                $comando->bindParam(':pges_trabajo_telefono', $pges_trabajo_telefono, \PDO::PARAM_STR);
            }
            if (!empty((isset($pges_trabajo_ext)))) {
                $comando->bindParam(':pges_trabajo_ext', $pges_trabajo_ext, \PDO::PARAM_STR);
            }
            if (!empty((isset($pges_id_trabajo)))) {
                $comando->bindParam(':pges_id_trabajo', $pges_id_trabajo, \PDO::PARAM_INT);
            }
            if (!empty((isset($pro_id_trabajo)))) {
                $comando->bindParam(':pro_id_trabajo', $pro_id_trabajo, \PDO::PARAM_INT);
            }
            if (!empty((isset($can_id_trabajo)))) {
                $comando->bindParam(':can_id_trabajo', $can_id_trabajo, \PDO::PARAM_INT);
            }
            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.persona_gestion');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }

    /**
     * Function modifica datos generales del benificiario.
     * @author Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @param
     * @return
     */
    public function modificaDatoGeneral($pges_pri_nombre, $pges_seg_nombre, $pges_pri_apellido, $pges_seg_apellido, $pges_id, $pges_celular, $pges_domicilio_celular2, $pges_domicilio_telefono, $pges_correo) {

        $con = \Yii::$app->db_crm;
        $estado = 1;
        $filtro = '';
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }
        if (!empty($pges_celular)) {
            $filtro .= 'pges_celular = :pges_celular, ';
        }
        if (!empty($pges_seg_nombre)) {
            $filtro .= 'pges_seg_nombre = :pges_seg_nombre, ';
        }
        if (!empty($pges_seg_apellido)) {
            $filtro .= ' pges_seg_apellido = :pges_seg_apellido, ';
        }
        if (!empty($pges_domicilio_celular2)) {
            $filtro .= ' pges_domicilio_celular2 = :pges_domicilio_celular2, ';
        }
        if (!empty($pges_domicilio_telefono)) {
            $filtro .= ' pges_domicilio_telefono = :pges_domicilio_telefono, ';
        }
        if (!empty($pges_correo)) {
            $filtro .= ' pges_correo = :pges_correo, ';
        }
        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".persona_gestion		       
                      SET pges_pri_nombre = :pges_pri_nombre,
                        $filtro
                        pges_pri_apellido = :pges_pri_apellido
                      WHERE 
                        pges_id = :pges_id AND                        
                        pges_estado = :estado AND
                        pges_estado_logico = :estado");
            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
            $comando->bindParam(":pges_id", $pges_id, \PDO::PARAM_INT);
            $comando->bindParam(":pges_pri_nombre", $pges_pri_nombre, \PDO::PARAM_STR);
            $comando->bindParam(":pges_pri_apellido", $pges_pri_apellido, \PDO::PARAM_STR);
            if (!empty($pges_seg_nombre)) {
                $comando->bindParam(":pges_seg_nombre", $pges_seg_nombre, \PDO::PARAM_STR);
            }
            if (!empty($pges_seg_apellido)) {
                $comando->bindParam(":pges_seg_apellido", $pges_seg_apellido, \PDO::PARAM_STR);
            }
            if (!empty($pges_celular)) {
                $comando->bindParam(":pges_celular", $pges_celular, \PDO::PARAM_STR);
            }
            if (!empty($pges_domicilio_celular2)) {
                $comando->bindParam(":pges_domicilio_celular2", $pges_domicilio_celular2, \PDO::PARAM_STR);
            }
            if (!empty($pges_domicilio_telefono)) {
                $comando->bindParam(":pges_domicilio_telefono", $pges_domicilio_telefono, \PDO::PARAM_STR);
            }
            if (!empty($pges_correo)) {
                $comando->bindParam(":pges_correo", $pges_correo, \PDO::PARAM_STR);
            }
            $este = "UPDATE db_crm.persona_gestion		       
                      SET pges_pri_nombre = $pges_pri_nombre,
                        $filtro
                        pges_pri_apellido = $pges_pri_apellido
                      WHERE 
                        pges_id = $pges_id AND                        
                        pges_estado = 1 AND
                        pges_estado_logico = 1";           
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
     * Function consulta si existe los numeros de telefonos o correo en algun otro contacto. 
     * @author Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarDatosExiste($pges_celular, $pges_correo, $pges_domicilio_telefono, $pges_domicilio_celular2) {
        $con = \Yii::$app->db_crm;
        $estado = 1;

        if (!empty($pges_celular)) {
            $filtro .= "pges_celular = :pges_celular ";
        }
        if (!empty($pges_correo)) {
            if (!empty($pges_celular)) {
                $filtro .= " OR ";
            }
            $filtro .= " pges_correo = :pges_correo ";
        }
        if (!empty($pges_domicilio_telefono)) {
            if (!empty($pges_correo)) {
                $filtro .= " OR ";
            }
            $filtro .= " pges_domicilio_telefono = :pges_domicilio_telefono ";
        }
        if (!empty($pges_domicilio_celular2)) {
            if (!empty($pges_domicilio_telefono)) {
                $filtro .= " OR ";
            }
            $filtro .= " pges_domicilio_celular2 = :pges_domicilio_celular2";
        }
        $sql = "SELECT                    
                    count(*) as registro                   
                FROM 
                   " . $con->dbname . ".persona_gestion "
                . "WHERE ";
        if (!empty($filtro)) {
            $sql .= "(";
            $sql .= $filtro;
            $sql .= ") AND ";
        }
        $sql .= "pges_estado_logico = :estado AND
                 pges_estado = :estado";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        if (!empty(($pges_celular))) {
            $comando->bindParam(':pges_celular', $pges_celular, \PDO::PARAM_STR);
        }
        if (!empty($pges_correo)) {
            $comando->bindParam(':pges_correo', $pges_correo, \PDO::PARAM_STR);
        }
        if (!empty($pges_domicilio_telefono)) {
            $comando->bindParam(':pges_domicilio_telefono', $pges_domicilio_telefono, \PDO::PARAM_STR);
        }
        if (!empty($pges_domicilio_celular2)) {
            $comando->bindParam(':pges_domicilio_celular2', $pges_domicilio_celular2, \PDO::PARAM_STR);
        }
        $resultData = $comando->queryOne();
        return $resultData;
    }

    
}
