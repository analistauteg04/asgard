<?php

namespace app\modules\repositorio\models;
use yii\data\ArrayDataProvider;
use Yii;

/**
 * This is the model class for table "documento_repositorio".
 *
 * @property int $dre_id
 * @property int $est_id
 * @property int $dre_tipo
 * @property string $dre_codificacion
 * @property string $dre_ruta
 * @property string $dre_imagen
 * @property int $dre_usu_modifica
 * @property string $dre_estado
 * @property string $dre_fecha_archivo
 * @property string $dre_fecha_creacion
 * @property string $dre_fecha_modificacion
 * @property string $dre_estado_logico
 *
 * @property Estandar $est
 */
class DocumentoRepositorio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'documento_repositorio';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_repositorio');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['est_id', 'dre_codificacion', 'dre_ruta', 'dre_imagen', 'dre_estado', 'dre_estado_logico'], 'required'],
            [['est_id', 'dre_tipo', 'dre_usu_modifica'], 'integer'],
            [['dre_fecha_archivo', 'dre_fecha_creacion', 'dre_fecha_modificacion'], 'safe'],
            [['dre_codificacion', 'dre_imagen'], 'string', 'max' => 100],
            [['dre_ruta'], 'string', 'max' => 200],
            [['dre_estado', 'dre_estado_logico'], 'string', 'max' => 1],
            [['est_id'], 'exist', 'skipOnError' => true, 'targetClass' => Estandar::className(), 'targetAttribute' => ['est_id' => 'est_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'dre_id' => 'Dre ID',
            'est_id' => 'Est ID',
            'dre_tipo' => 'Dre Tipo',
            'dre_codificacion' => 'Dre Codificacion',
            'dre_ruta' => 'Dre Ruta',
            'dre_imagen' => 'Dre Imagen',
            'dre_usu_modifica' => 'Dre Usu Modifica',
            'dre_estado' => 'Dre Estado',
            'dre_fecha_archivo' => 'Dre Fecha Archivo',
            'dre_fecha_creacion' => 'Dre Fecha Creacion',
            'dre_fecha_modificacion' => 'Dre Fecha Modificacion',
            'dre_estado_logico' => 'Dre Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEst()
    {
        return $this->hasOne(Estandar::className(), ['est_id' => 'est_id']);
    }
    
    
     /**
     * Function consultarDocumentos consultar documentos
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param 
     * @return
     */
    public function consultarDocumentos($arrFiltro = array(), $onlyData = false) {
        $con = \Yii::$app->db_repositorio;        
        $estado = 1;
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            if (($arrFiltro['est_id'] != "") && ($arrFiltro['est_id'] > 0)) {
                $str_search = "and dr.est_id = :est_id ";
            }
            if ($arrFiltro['search'] != "") {
                $str_search .= "and dr.dre_imagen like :archivo ";                
            }
            if ($arrFiltro['f_ini'] != "" && $arrFiltro['f_fin'] != "") {
                $str_search .= "and dr.dre_fecha_archivo >= :fec_ini and ";
                $str_search .= "dr.dre_fecha_archivo <= :fec_fin ";
            }            
            if (($arrFiltro['mod_id'] != "") && ($arrFiltro['mod_id'] > 0)){
                $str_search .= "and f.mod_id = :mod_id ";
            }
            if (($arrFiltro['cat_id'] != "") && ($arrFiltro['cat_id'] > 0)){
                $str_search .= "and e.fun_id = :fun_id ";
            }
            if (($arrFiltro['comp_id'] != "") && ($arrFiltro['comp_id'] > 0)){
                $str_search .= "and e.com_id = :comp_id ";
            }
        }
        $sql = "SELECT	dre_imagen, case when dre_tipo='1' then 'Público' else 'Privado' end tipo,  
                        dre_descripcion, dre_fecha_archivo, dre_fecha_creacion ";
        if ($onlyData==false) {
            $sql .= ", dre_ruta ";
        } 
        $sql .= "FROM " . $con->dbname . ".documento_repositorio dr inner join " . $con->dbname . ".estandar e on e.est_id = dr.est_id
                    left join " . $con->dbname . ".componente c on c.com_id = e.com_id
                    inner join " . $con->dbname . ".funcion f on f.fun_id = e.fun_id
                WHERE dre_estado = :estado
                      and dre_estado_logico = :estado ";              
        if (!empty($str_search)) {
            $sql .= " $str_search  
                    ORDER BY dre_fecha_creacion desc ";
        } else {
            $sql .= " ORDER BY dre_fecha_creacion desc";
        }
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $est_id = $arrFiltro["est_id"];
            $archivo = "%" . $arrFiltro["search"] . "%";   
            $fecha_ini = $arrFiltro["f_ini"];
            $fecha_fin = $arrFiltro["f_fin"];
            $mod_id = $arrFiltro["mod_id"];
            $fun_id = $arrFiltro["cat_id"];
            $comp_id = $arrFiltro["comp_id"];
            if (($arrFiltro['est_id'] != "") or ($arrFiltro['est_id'] > 0)) {
                $comando->bindParam(":est_id", $est_id, \PDO::PARAM_INT);
            }
            if ($arrFiltro['search'] != "") {
                $comando->bindParam(":archivo", $archivo, \PDO::PARAM_STR);
            } 
            if ($arrFiltro['f_ini'] != "" && $arrFiltro['f_fin'] != "") {
                $comando->bindParam(":fec_ini", $fecha_ini, \PDO::PARAM_STR);
                $comando->bindParam(":fec_fin", $fecha_fin, \PDO::PARAM_STR);
            }
            if (($arrFiltro['mod_id'] != "") && ($arrFiltro['mod_id'] > 0)){
                $comando->bindParam(":mod_id", $mod_id, \PDO::PARAM_INT);
            }
            if (($arrFiltro['cat_id'] != "") && ($arrFiltro['cat_id'] > 0)){
                $comando->bindParam(":fun_id", $fun_id, \PDO::PARAM_INT);
            }
            if (($arrFiltro['comp_id'] != "") && ($arrFiltro['comp_id'] > 0)){
                $comando->bindParam(":comp_id", $comp_id, \PDO::PARAM_INT);
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
                ],
            ],
        ]);
        if ($onlyData) {
            return $resultData;
        } else {
            return $dataProvider;
        }
    }
    
    /* INSERTAR DATOS */
    public function insertarMedicos($data) {
        $arroout = array();
        $con = \Yii::$app->db;
        $trans = $con->beginTransaction();
        try {
            $data = isset($data['DATA']) ? $data['DATA'] : array();
            Persona::insertarDataPerfil($con, $data);
            $per_id=$con->getLastInsertID();//IDS de la Persona            
            Persona::insertarDataPerfilDatoAdicional($con, $data, $per_id);
            $this->insertarDataMedico($con, $data, $per_id);
            $med_id=$con->getLastInsertID();
            Especialidad::insertarDataEspecialidad($con, $data[0]['especialidades'], $med_id);
            Empresa::insertarDataEmpresa($con, $data[0]['emp_id'], $med_id); 
            
            //Inserta Datos de Usuario
            $password=Utilities::generarCodigoKey(8);//Passw Generado Automaticamente
            $linkActiva=Usuario::crearLinkActivacion();
            Usuario::insertarDataUser($con, $data[0]['per_correo'], $password, $per_id,$linkActiva); 
            $usu_id=$con->getLastInsertID();//IDS de la Persona
            Rol::saveEmpresaRol($con, $usu_id, $data[0]['emp_id'], $this->rolDefault);
            //###############################
            
            Utilities::insertarLogs($con, $med_id, 'medico', 'Insert -> Med_id');
            $trans->commit();
            $con->close();
            //RETORNA DATOS 
            //$arroout["ids"]= $ftem_id;
            $arroout["status"]= true;
            //$arroout["secuencial"]= $doc_numero;
            
            //Enviar correo electronico para activacion de cuenta
                $nombres = $data[0]['per_nombre'];
                $tituloMensaje = Yii::t("register","Successful Registration");
                $asunto = Yii::t("register", "User Register") . " " . Yii::$app->params["siteName"];
                $body = Utilities::getMailMessage("registerPaciente", array("[[user]]" => $nombres, "[[username]]" => $data[0]['per_correo'],"[[clave]]" => $password, "[[link_verification]]" => $linkActiva), Yii::$app->language);
                Utilities::sendEmail($tituloMensaje, Yii::$app->params["adminEmail"], 
                                    [$data[0]['per_correo'] => $data[0]['per_nombre'] . " " . $data[0]['per_apellido']],
                                    [],//Bcc
                                    $asunto, $body);
            //Find Datos Mail
            
            return $arroout;
        } catch (\Exception $e) {
            $trans->rollBack();
            $con->close();
            //throw $e;
            $arroout["status"]= false;
            return $arroout;
        }
    }
    
     public static function insertarDataPerfil($con,$data) { 
        //Datos de Perfil
        $sql = "INSERT INTO " . $con->dbname . ".persona
        (per_ced_ruc,per_nombre,per_apellido,per_genero,per_fecha_nacimiento,per_estado_civil,per_correo,per_tipo_sangre,per_foto,per_estado_activo,per_est_log)VALUES
        (:per_ced_ruc,:per_nombre,:per_apellido,:per_genero,:per_fecha_nacimiento,:per_estado_civil,:per_correo,:per_tipo_sangre,:per_foto,1,1 ); ";
        $command = $con->createCommand($sql);
        //$command->bindParam(":per_id", $data[0]['per_id'], \PDO::PARAM_INT);//Id Comparacion
        $command->bindParam(":per_nombre", $data[0]['per_nombre'], \PDO::PARAM_STR);
        $command->bindParam(":per_apellido", $data[0]['per_apellido'], \PDO::PARAM_STR);
        $command->bindParam(":per_ced_ruc", $data[0]['per_ced_ruc'], \PDO::PARAM_STR);        
        $command->bindParam(":per_genero", $data[0]['per_genero'], \PDO::PARAM_STR);
        $command->bindParam(":per_fecha_nacimiento", $data[0]['per_fecha_nacimiento'], \PDO::PARAM_STR);
        $command->bindParam(":per_estado_civil", $data[0]['per_estado_civil'], \PDO::PARAM_STR);
        $command->bindParam(":per_correo", $data[0]['per_correo'], \PDO::PARAM_STR);
        $command->bindParam(":per_tipo_sangre", $data[0]['per_tipo_sangre'], \PDO::PARAM_STR);
        $command->bindParam(":per_foto", $data[0]['per_foto'], \PDO::PARAM_STR);
        $command->execute();
    }
    
    
    
}
