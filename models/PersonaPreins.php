<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "persona_preins".
 *
 * @property integer $ppre_id
 * @property string $ppre_pri_nombre
 * @property string $ppre_seg_nombre
 * @property string $ppre_pri_apellido
 * @property string $ppre_seg_apellido
 * @property string $ppre_cedula
 * @property string $ppre_ruc
 * @property string $ppre_pasaporte
 * @property integer $etn_id
 * @property integer $eciv_id
 * @property string $ppre_genero
 * @property string $ppre_nacionalidad
 * @property integer $pai_id_nacimiento
 * @property integer $pro_id_nacimiento
 * @property integer $can_id_nacimiento
 * @property string $ppre_nac_ecuatoriano
 * @property string $ppre_fecha_nacimiento
 * @property string $ppre_celular
 * @property string $ppre_correo
 * @property string $ppre_foto
 * @property integer $tsan_id
 * @property string $ppre_domicilio_sector
 * @property string $ppre_domicilio_cpri
 * @property string $ppre_domicilio_csec
 * @property string $ppre_domicilio_num
 * @property string $ppre_domicilio_ref
 * @property string $ppre_domicilio_telefono
 * @property integer $pai_id_domicilio
 * @property integer $pro_id_domicilio
 * @property integer $can_id_domicilio
 * @property string $ppre_trabajo_nombre
 * @property string $ppre_trabajo_direccion
 * @property string $ppre_trabajo_telefono
 * @property string $ppre_trabajo_ext
 * @property integer $pai_id_trabajo
 * @property integer $pro_id_trabajo
 * @property integer $can_id_trabajo
 * @property string $ppre_tipo_formulario
 * @property string $ppre_fecha_registro
 * @property string $ppre_estado
 * @property string $ppre_fecha_creacion
 * @property string $ppre_fecha_modificacion
 * @property string $ppre_estado_logico
 *
 * @property Pais $paiIdNacimiento
 * @property TipoSangre $tsan
 * @property Provincia $proIdNacimiento
 * @property Pais $paiIdDomicilio
 * @property Provincia $proIdDomicilio
 * @property Canton $canIdDomicilio
 * @property Pais $paiIdTrabajo
 * @property Provincia $proIdTrabajo
 * @property Canton $canIdTrabajo
 * @property Etnia $etn
 */
class PersonaPreins extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'persona_preins';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_asgard');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ppre_cedula', 'ppre_estado', 'ppre_estado_logico'], 'required'],
            [['etn_id', 'eciv_id', 'pai_id_nacimiento', 'pro_id_nacimiento', 'can_id_nacimiento', 'tsan_id', 'pai_id_domicilio', 'pro_id_domicilio', 'can_id_domicilio', 'pai_id_trabajo', 'pro_id_trabajo', 'can_id_trabajo'], 'integer'],
            [['ppre_fecha_nacimiento', 'ppre_fecha_registro', 'ppre_fecha_creacion', 'ppre_fecha_modificacion'], 'safe'],
            [['ppre_pri_nombre', 'ppre_seg_nombre', 'ppre_pri_apellido', 'ppre_seg_apellido', 'ppre_nacionalidad', 'ppre_correo', 'ppre_domicilio_sector', 'ppre_trabajo_nombre'], 'string', 'max' => 250],
            [['ppre_cedula', 'ppre_ruc'], 'string', 'max' => 15],
            [['ppre_pasaporte', 'ppre_celular', 'ppre_domicilio_telefono', 'ppre_trabajo_telefono', 'ppre_trabajo_ext'], 'string', 'max' => 50],
            [['ppre_genero', 'ppre_nac_ecuatoriano', 'ppre_estado', 'ppre_estado_logico'], 'string', 'max' => 1],
            [['ppre_foto', 'ppre_domicilio_cpri', 'ppre_domicilio_csec', 'ppre_domicilio_ref', 'ppre_trabajo_direccion'], 'string', 'max' => 500],
            [['ppre_domicilio_num'], 'string', 'max' => 100],
            [['ppre_tipo_formulario'], 'string', 'max' => 2],
            [['ppre_cedula'], 'unique'],
            [['pai_id_nacimiento'], 'exist', 'skipOnError' => true, 'targetClass' => Pais::className(), 'targetAttribute' => ['pai_id_nacimiento' => 'pai_id']],
            [['tsan_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoSangre::className(), 'targetAttribute' => ['tsan_id' => 'tsan_id']],
            [['pro_id_nacimiento'], 'exist', 'skipOnError' => true, 'targetClass' => Provincia::className(), 'targetAttribute' => ['pro_id_nacimiento' => 'pro_id']],
            [['pai_id_domicilio'], 'exist', 'skipOnError' => true, 'targetClass' => Pais::className(), 'targetAttribute' => ['pai_id_domicilio' => 'pai_id']],
            [['pro_id_domicilio'], 'exist', 'skipOnError' => true, 'targetClass' => Provincia::className(), 'targetAttribute' => ['pro_id_domicilio' => 'pro_id']],
            [['can_id_domicilio'], 'exist', 'skipOnError' => true, 'targetClass' => Canton::className(), 'targetAttribute' => ['can_id_domicilio' => 'can_id']],
            [['pai_id_trabajo'], 'exist', 'skipOnError' => true, 'targetClass' => Pais::className(), 'targetAttribute' => ['pai_id_trabajo' => 'pai_id']],
            [['pro_id_trabajo'], 'exist', 'skipOnError' => true, 'targetClass' => Provincia::className(), 'targetAttribute' => ['pro_id_trabajo' => 'pro_id']],
            [['can_id_trabajo'], 'exist', 'skipOnError' => true, 'targetClass' => Canton::className(), 'targetAttribute' => ['can_id_trabajo' => 'can_id']],
            [['etn_id'], 'exist', 'skipOnError' => true, 'targetClass' => Etnia::className(), 'targetAttribute' => ['etn_id' => 'etn_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ppre_id' => 'Ppre ID',
            'ppre_pri_nombre' => 'Ppre Pri Nombre',
            'ppre_seg_nombre' => 'Ppre Seg Nombre',
            'ppre_pri_apellido' => 'Ppre Pri Apellido',
            'ppre_seg_apellido' => 'Ppre Seg Apellido',
            'ppre_cedula' => 'Ppre Cedula',
            'ppre_ruc' => 'Ppre Ruc',
            'ppre_pasaporte' => 'Ppre Pasaporte',
            'etn_id' => 'Etn ID',
            'eciv_id' => 'Eciv ID',
            'ppre_genero' => 'Ppre Genero',
            'ppre_nacionalidad' => 'Ppre Nacionalidad',
            'pai_id_nacimiento' => 'Pai Id Nacimiento',
            'pro_id_nacimiento' => 'Pro Id Nacimiento',
            'can_id_nacimiento' => 'Can Id Nacimiento',
            'ppre_nac_ecuatoriano' => 'Ppre Nac Ecuatoriano',
            'ppre_fecha_nacimiento' => 'Ppre Fecha Nacimiento',
            'ppre_celular' => 'Ppre Celular',
            'ppre_correo' => 'Ppre Correo',
            'ppre_foto' => 'Ppre Foto',
            'tsan_id' => 'Tsan ID',
            'ppre_domicilio_sector' => 'Ppre Domicilio Sector',
            'ppre_domicilio_cpri' => 'Ppre Domicilio Cpri',
            'ppre_domicilio_csec' => 'Ppre Domicilio Csec',
            'ppre_domicilio_num' => 'Ppre Domicilio Num',
            'ppre_domicilio_ref' => 'Ppre Domicilio Ref',
            'ppre_domicilio_telefono' => 'Ppre Domicilio Telefono',
            'pai_id_domicilio' => 'Pai Id Domicilio',
            'pro_id_domicilio' => 'Pro Id Domicilio',
            'can_id_domicilio' => 'Can Id Domicilio',
            'ppre_trabajo_nombre' => 'Ppre Trabajo Nombre',
            'ppre_trabajo_direccion' => 'Ppre Trabajo Direccion',
            'ppre_trabajo_telefono' => 'Ppre Trabajo Telefono',
            'ppre_trabajo_ext' => 'Ppre Trabajo Ext',
            'pai_id_trabajo' => 'Pai Id Trabajo',
            'pro_id_trabajo' => 'Pro Id Trabajo',
            'can_id_trabajo' => 'Can Id Trabajo',
            'ppre_tipo_formulario' => 'Ppre Tipo Formulario',
            'ppre_fecha_registro' => 'Ppre Fecha Registro',
            'ppre_estado' => 'Ppre Estado',
            'ppre_fecha_creacion' => 'Ppre Fecha Creacion',
            'ppre_fecha_modificacion' => 'Ppre Fecha Modificacion',
            'ppre_estado_logico' => 'Ppre Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaiIdNacimiento()
    {
        return $this->hasOne(Pais::className(), ['pai_id' => 'pai_id_nacimiento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTsan()
    {
        return $this->hasOne(TipoSangre::className(), ['tsan_id' => 'tsan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProIdNacimiento()
    {
        return $this->hasOne(Provincia::className(), ['pro_id' => 'pro_id_nacimiento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaiIdDomicilio()
    {
        return $this->hasOne(Pais::className(), ['pai_id' => 'pai_id_domicilio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProIdDomicilio()
    {
        return $this->hasOne(Provincia::className(), ['pro_id' => 'pro_id_domicilio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCanIdDomicilio()
    {
        return $this->hasOne(Canton::className(), ['can_id' => 'can_id_domicilio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaiIdTrabajo()
    {
        return $this->hasOne(Pais::className(), ['pai_id' => 'pai_id_trabajo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProIdTrabajo()
    {
        return $this->hasOne(Provincia::className(), ['pro_id' => 'pro_id_trabajo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCanIdTrabajo()
    {
        return $this->hasOne(Canton::className(), ['can_id' => 'can_id_trabajo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEtn()
    {
        return $this->hasOne(Etnia::className(), ['etn_id' => 'etn_id']);
    }
    
    /**
     * Function ConsultaRegistropreins
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @property    $cedula, $pasaporte    
     * @return  
     */
    public function ConsultaRegistropreins($cedula, $pasaporte) {
        $con = \Yii::$app->db_asgard;
        $estado = 1;
        $sql = "SELECT
                    per.ppre_id 
                FROM " . $con->dbname . ".persona_preins per                    
                WHERE (per.ppre_cedula = :cedula or per.ppre_pasaporte =:pasaporte) AND
                       per.ppre_estado = :estado AND
                       per.ppre_estado_logico=:estado";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":cedula", $cedula, \PDO::PARAM_STR);
        $comando->bindParam(":pasaporte", $pasaporte, \PDO::PARAM_STR);
        $resultData = $comando->queryOne();
        return $resultData;
    }

    /**
     * Function ConsultaRegistropreinscorreo
     * @author      Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @property    $correo   
     * @return  
     */
    public function ConsultaRegistropreinscorreo($correo) {
        $con = \Yii::$app->db_asgard;
        $estado = 1;
        $sql = "SELECT
                    per.ppre_id 
                FROM " . $con->dbname . ".persona_preins per                    
                WHERE per.ppre_correo = :correo AND
                      per.ppre_estado = :estado AND
                      per.ppre_estado_logico=:estado";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":correo", $correo, \PDO::PARAM_STR);
        $resultData = $comando->queryOne();
        return $resultData;
    }

    /**
     * Function consultaDatosRegion
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>
     * @property integer $pais       
     * @return  
     */
    public function consultaDatosRegion($pai_id) {
        $con = \Yii::$app->db_asgard;
        $estado = 1;
        $sql = "SELECT                     
                pai_nacionalidad,
                pai_codigo_fono,
                pai_nombre
               FROM " . $con->dbname . ".pais                     
               WHERE 
                    pai_id = :pai_id AND
                    pai_estado = :estado AND
                    pai_estado_logico=:estado";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":pai_id", $pai_id, \PDO::PARAM_INT);
        $resultData = $comando->queryOne();
        return $resultData;
    }

    public function encuentraPersonapreins($per_id) {
        $con = \Yii::$app->db_asgard;
        $estado = 1;
        $sql = "SELECT  per.ppre_pri_nombre as pri_nombre,                  
                        per.ppre_pri_apellido as pri_apellido,
                        per.ppre_cedula as cedula,
                        per.ppre_pasaporte as pasaporte,
                        per.ppre_nacionalidad as nacionalidad,
                        per.pai_id_nacimiento as pais_nac,
                        per.ppre_celular as celular,
                        per.ppre_correo as correo,
                        per.pai_id_domicilio as pais,
                        per.ppre_fecha_registro as fecha_registro
                FROM " . $con->dbname . ".persona_preins per                    
                WHERE per.ppre_id = :per_id AND
                      per.ppre_estado = :estado AND
                      per.ppre_estado_logico=:estado";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
        $resultData = $comando->queryOne();
        return $resultData;
    }

    /**
     * Function actualizaPreinscripcion
     * @author      Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @property    $per_id, $ppre_pri_nombre, $ppre_pri_apellido, $ppre_nacionalidad, $pai_id_nacimiento, 
     *             $pai_id_domicilio, $ppre_celular, $ppre_correo.
     * @return  
     */
    public function actualizaPreinscripcion($per_id, $ppre_pri_nombre, $ppre_pri_apellido, $ppre_nacionalidad, $pai_id_nacimiento, $pai_id_domicilio, $ppre_celular, $ppre_correo) {
        $con = \Yii::$app->db;
        $estado = 1;
        $fecha_modificacion = date(Yii::$app->params["dateTimeByDefault"]); //date("Y-m-d H:i:s");//

        $comando = $con->createCommand
                ("UPDATE " . $con->dbname . ".persona_preins 
                SET ppre_pri_nombre = :ppre_pri_nombre,
                    ppre_pri_apellido = :ppre_pri_apellido,
                    ppre_nacionalidad = :ppre_nacionalidad,
                    pai_id_nacimiento = :pai_id_nacimiento,
                    pai_id_domicilio = :pai_id_domicilio,
                    ppre_celular = :ppre_celular,
                    ppre_correo = :ppre_correo,
                    ppre_fecha_modificacion = :ppre_fecha_modificacion
                WHERE ppre_id = :per_id AND 
                      ppre_estado =:estado AND
                      ppre_estado_logico = :estado");

        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
        $comando->bindParam(":ppre_pri_nombre", $ppre_pri_nombre, \PDO::PARAM_STR);
        $comando->bindParam(":ppre_pri_apellido", $ppre_pri_apellido, \PDO::PARAM_STR);
        $comando->bindParam(":ppre_nacionalidad", $ppre_nacionalidad, \PDO::PARAM_STR);
        $comando->bindParam(":pai_id_nacimiento", $pai_id_nacimiento, \PDO::PARAM_INT);
        $comando->bindParam(":pai_id_domicilio", $pai_id_domicilio, \PDO::PARAM_INT);
        $comando->bindParam(":ppre_celular", $ppre_celular, \PDO::PARAM_STR);
        $comando->bindParam(":ppre_correo", $ppre_correo, \PDO::PARAM_STR);
        $comando->bindParam(":ppre_fecha_modificacion", $fecha_modificacion, \PDO::PARAM_STR);

        $response = $comando->execute();
        return $response;
    }
}
