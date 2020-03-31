<?php

namespace app\models;

use Yii;
use yii\base\Security;
use yii\web\IdentityInterface;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\Url;
use yii\data\ArrayDataProvider;

/**
 * This is the model class for table "usuario".
 *
 * @property integer $usu_id
 * @property integer $per_id
 * @property string $usu_user
 * @property string $usu_password
 * @property string $usu_time_pass
 * @property string $usu_sha
 * @property string $usu_session
 * @property string $usu_last_login
 * @property string $usu_link_activo
 * @property string $usu_upreg
 * @property string $usu_estado
 * @property string $usu_fecha_creacion
 * @property string $usu_fecha_modificacion
 * @property string $usu_estado_logico
 *
 * @property ConfiguracionCuenta[] $configuracionCuentas
 * @property UsuaGrolEper[] $usuaGrolsEper
 * @property Persona $per
 * @property UsuarioCorreo[] $usuarioCorreos
 */
class Usuario extends \yii\db\ActiveRecord implements IdentityInterface {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['per_id', 'usu_estado', 'usu_estado_logico'], 'required'],
                [['per_id'], 'integer'],
                [['usu_time_pass', 'usu_last_login', 'usu_fecha_creacion', 'usu_fecha_modificacion'], 'safe'],
                [['usu_sha', 'usu_session', 'usu_link_activo'], 'string'],
                [['usu_user'], 'string', 'max' => 45],
                [['usu_password'], 'string', 'max' => 255],
                [['usu_upreg','usu_estado', 'usu_estado_logico'], 'string', 'max' => 1],
                [['per_id'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['per_id' => 'per_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'usu_id' => 'Usu ID',
            'per_id' => 'Per ID',
            'usu_user' => 'Usu User',
            'usu_password' => 'Usu Password',
            'usu_time_pass' => 'Usu Time Pass',
            'usu_sha' => 'Usu Sha',
            'usu_session' => 'Usu Session',
            'usu_last_login' => 'Usu Last Login',
            'usu_link_activo' => 'Usu Link Activo',
            'usu_estado' => 'Usu Estado',
            'usu_fecha_creacion' => 'Usu Fecha Creacion',
            'usu_fecha_modificacion' => 'Usu Fecha Modificacion',
            'usu_estado_logico' => 'Usu Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConfiguracionCuentas() {
        return $this->hasMany(ConfiguracionCuenta::className(), ['usu_id' => 'usu_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuaGrolEpers() {
        return $this->hasMany(UsuaGrolEper::className(), ['usu_id' => 'usu_id']);
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->getPrimaryKey();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPer() {
        return $this->hasOne(Persona::className(), ['per_id' => 'per_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioCorreos() {
        return $this->hasMany(UsuarioCorreo::className(), ['usu_id' => 'usu_id']);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        return static::findOne(['Hash' => $token]);
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->Hash;
    }

    public static function findIdentity($id) {
        return static::findOne($id);
    }

    public static function findByCondition($condition) {
        return parent::findByCondition($condition);
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username) {
        $user = static::findOne(['usu_user' => $username, 'usu_estado' => 1]);
        if (isset($user->usu_id))
            return $user;
        else
            return NULL;
    }

    /**
     * Validates password
     *
     * @author Eduardo Cueva <ecueva@penblu.com>
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password) {
        $security = new Security();
        return ($this->usu_sha === $security->decryptByPassword(base64_decode($this->usu_password), $password));
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @author Eduardo Cueva <ecueva@penblu.com>
     * @param string $password
     */
    public function setPassword($password) {
        $security = new Security();
        $hash = (isset($this->usu_sha) ? $this->usu_sha : ($this->generateAuthKey()));
        $this->usu_password = base64_encode($security->encryptByPassword($hash, $password));
    }

    /**
     * Función para generar el Salt o token de clave de manera aleatoria
     *
     * @author Eduardo Cueva <ecueva@penblu.com>
     * @access public
     * 
     */
    public function generateAuthKey() {
        $security = new Security();
        $this->usu_sha = $security->generateRandomString();
        return $this->usu_sha;
    }

    /**
     * Function createSession
     * @author  Diana Lopez <dlopez@uteg.edu.ec>
     * @param      
     * @return  
     */
    public function createSession($id_empresa = NULL) {
        $session = Yii::$app->session;
        if ($session->isActive) {
            $session->open();
            //$session->close();
            $model_persona = Persona::findIdentity($this->per_id);
            $model_empresa = Empresa::getEmpresasXUsuario($this->usu_id);
            $nombre_empresa = "";
            if(!isset($id_empresa) || array_search($id_empresa, array_column($model_empresa, 'emp_id')) === FALSE){
                $id_empresa = $model_empresa[0]["emp_id"];
                $nombre_empresa = $model_empresa[0]["emp_nombre_comercial"];
            }else{
                $empresa_model = Empresa::findIdentity($id_empresa);
                $nombre_empresa = $empresa_model->emp_nombre_comercial;
            }
            
            $nombre_persona = $model_persona->per_pri_nombre;
            $apellido_persona = $model_persona->per_pri_apellido;
            $session->set('PB_isuser', true);
            $session->set('PB_username', $this->usu_user);
            $session->set('PB_nombres', $nombre_persona . " " . $apellido_persona);
            $session->set('PB_idempresa', $id_empresa);
            $session->set('PB_empresa', $nombre_empresa);
            $session->set('PB_perid', $this->per_id);
            $session->set('PB_iduser', $this->usu_id);
            $session->set('PB_yii_lang', Yii::$app->language);
            $session->set('PB_yii_theme', Yii::$app->view->theme->themeName);
        } else {
            $session->destroy();
        }
    }
    
    public static function addVarSession($alias, $value){
        $session = Yii::$app->session;
        if ($session->isActive) {
            $session->set($alias, $value);
        }
    }

    /**
     * Function regenerateSession
     * @author  Diana Lopez <dlopez@uteg.edu.ec>
     * @param      
     * @return  
     */
    public function regenerateSession() {
        $session = Yii::$app->session;
        if ($session->isActive) {
            $id = Yii::$app->session->getId();
            Yii::$app->session->regenerateID($id);
        }
    }

    /**
     * Function destroySession
     * @author  Diana Lopez <dlopez@uteg.edu.ec>
     * @param      
     * @return  
     */
    public function destroySession() {
        $usuario = $this->findIdentity(Yii::$app->session->get("PB_iduser"));
        $session = Yii::$app->session;
        $session->close();
        $session->destroy();
    }

    /**
     * Function crearUsuario
     * @author  Diana Lopez <dlopez@uteg.edu.ec>
     * @param      
     * @return  
     */
    public function crearUsuario($username, $password, $id_persona) {
        // se debe verificar de que el usuario no exista
        $this->usu_user = $username;
        $this->generateAuthKey(); // generacion de hash
        $this->setPassword($password);
        $this->per_id = $id_persona;
        if ($this->save())
            return true;
        return false;
    }
    /**
     * Function crearUsuario
     * @author  Diana Lopez <dlopez@uteg.edu.ec>
     * @param      
     * @return  
     */
    public function crearUsuarioTemporal($con,$parameters,$keys,$name_table) {
        $trans = $con->getTransaction(); 
        $param_sql .= "" . $keys[0];
        $bdet_sql .= "'" . $parameters[0]."'";
        for ($i = 1; $i < count($parameters); $i++) {
            if (isset($parameters[$i])) {
                $param_sql .= ", " . $keys[$i];
                $bdet_sql .= ", '" . $parameters[$i]."'";
            }
        }
        try {
            $sql = "INSERT INTO " . $con->dbname.'.'.$name_table . " ($param_sql) VALUES($bdet_sql);";                        
            $comando = $con->createCommand($sql);
            $result = $comando->execute();
            $idtable=$con->getLastInsertID($con->dbname . '.' . $name_table);
            if ($trans !== null)
                $trans->commit();
            return $idtable;
        } catch (Exception $ex) {
            if ($trans !== null){
                $trans->rollback();            
            }
            return 0;
        }
    }
    /**
     * Function consultarIdPersona 
     * @author  Kleber Loayza
     * @property      
     * @return  
     */
    public function consultarIdUsuario($per_id=null, $usuario=null) {
        $con = \Yii::$app->db_asgard;
        $estado = 1;
        $sql = "
                SELECT ifnull(usu_id,0) as usu_id
                FROM usuario
                WHERE 
                per_id=$per_id and usu_user='$usuario' and
                usu_estado = $estado AND
                usu_estado_logico=$estado
              ";
        $comando = $con->createCommand($sql);
        $resultData = $comando->queryOne();
        if(empty($resultData['usu_id']))
            return 0;
        else {
            return $resultData['usu_id'];    
        }
    }
    /**
     * Función genera un link de acceso para ser enviado por correo
     *
     * @access  public
     * @author  Eduard Cueva <ecueva@penblu.com>
     * @return  string         Link de acceso
     */
    public function generarLinkActivacion() {
        $security = new Security();
        $hash = $security->generateRandomString();
        $sublink = urlencode($hash);
        $sublink = str_replace("/", "", $sublink);
        $sublink = str_replace("+", "", $sublink);
        $sublink = str_replace("-", "", $sublink);
        $sublink = str_replace("_", "", $sublink);
        $sublink = str_replace(" ", "", $sublink);
        $sublink = str_replace("?", "", $sublink);
        $link = Url::base(true) . "/site/activation?wg=" . $sublink;
        $this->usu_link_activo = $link;
        $this->usu_estado = "0";
        $this->usu_estado_logico = "1";
        $this->save();
        return $link;
    }

    /**
     * Function activarLinkCuenta
     * @author  Diana Lopez <dlopez@uteg.edu.ec>
     * @param      
     * @return  
     */
    public function activarLinkCuenta($link) {
        $user = static::findOne(['usu_link_activo' => $link]);
        $dbLink = $user->usu_link_activo;
        if (isset($dbLink) && $dbLink != "") {
            if ($dbLink == $link) {
                $user->usu_link_activo = "";
                $user->usu_estado = "1";
                $id = $user->usu_id;
                $user->update(true, array("usu_link_activo", "usu_estado"));
                return true;
            }
        }
        return false;
    }

    /**
     * Function listadoUsuarios
     * @author  Diana Lopez <dlopez@uteg.edu.ec>
     *          Byron Villacreses <developer@uteg.edu.ec>
     * @param      //Funcion pendiente revisar el query
     * @return  
     */
    public static function listadoUsuarios($search = NULL) {
        $iduser = Yii::$app->session->get('PB_iduser', FALSE);
        $idempresa = Yii::$app->session->get('PB_idempresa', FALSE);
        $search_cond = "%" . $search . "%";
        $condition = "";
        $str_search = "";

        if (isset($search)) {
            $str_search = "(B.per_pri_nombre like :search OR ";
            $str_search .= "B.per_pri_apellido like :search OR ";
            $str_search .= "A.usu_user like :search) AND ";
        }

        $sql = "SELECT A.usu_id id,F.ugep_id,A.usu_user Username,B.per_pri_nombre Nombres,B.per_pri_apellido Apellidos,
                    C.emp_id,E.emp_razon_social Empresa,D.gru_id,H.gru_nombre Grupo,D.rol_id,R.rol_nombre Rol
                    FROM " . $con->dbname . ".usuario A
                    INNER JOIN " . $con->dbname . ".persona B ON A.per_id=B.per_id
                            INNER JOIN (" . $con->dbname . ".usua_grol_eper F 
                                INNER JOIN (" . $con->dbname . ".empresa_persona C
                                            INNER JOIN " . $con->dbname . ".empresa E ON C.emp_id=E.emp_id)						
                                        ON F.eper_id=C.eper_id
                                INNER JOIN (" . $con->dbname . ".grup_rol D 
                                            INNER JOIN " . $con->dbname . ".grupo H ON H.gru_id=D.gru_id
                                            INNER JOIN " . $con->dbname . ".rol R ON R.rol_id=D.rol_id)
                                        ON D.grol_id=F.grol_id)
                                    ON F.usu_id=A.usu_id
                    WHERE A.usu_estado_logico=1 AND A.usu_estado=1 
                            ORDER BY A.usu_user; ";
        
        $comando = Yii::$app->db->createCommand($sql);
        if ($iduser == 1) {
            $comando->bindParam(":emp_id", $idempresa, \PDO::PARAM_INT);
        }
        if (isset($search)) {
            $comando->bindParam(":search", $search_cond, \PDO::PARAM_STR);
        }
        $res = $comando->queryAll();
        $dataProvider = new ArrayDataProvider([
            'key' => 'Ids',
            'allModels' => $res,
            'pagination' => [
                'pageSize' => Yii::$app->params["pageSize"],
            ],
            'sort' => [
                'attributes' => ['Username', 'Nombres', 'Apellidos', 'Empresa'],
            ],
        ]);

        return $dataProvider;
    }

    /**
     * Function listadoUsuariosP
     * @author  Diana Lopez <dlopez@uteg.edu.ec>
     * @param      
     * @return  
     */
    public static function listadoUsuariosP($search = NULL) {
        $iduser = Yii::$app->session->get('PB_iduser', FALSE);
        $idempresa = Yii::$app->session->get('PB_idempresa', FALSE);
        $search_cond = "%" . $search . "%";
        $condition = "";
        $str_search = "";
        if ($iduser == 1) {
            $condition = "eper.emp_id=:emp_id AND ";
        }
        if (isset($search)) {
            $str_search = "(per.per_nombres like :search OR ";
            $str_search .= "per.per_apellidos like :search OR ";
            $str_search .= "usu.usu_username like :search) AND ";
        }
        $sql = "SELECT 
                    DISTINCT(usu.usu_username) as Username,
                    usu.usu_id as id,
                    per.per_nombres as Nombres,
                    per.per_apellidos as Apellidos,
                    emp.emp_nombre_comercial as Empresa,
                    gru.gru_nombre as Grupo,
                    rol.rol_nombre as Rol
                FROM 
                    usua_grol_eper as ugep 
                    INNER JOIN empresa_persona as eper on ugep.eper_id=eper.eper_id 
                    INNER JOIN empresa as emp on emp.emp_id=eper.emp_id
                    INNER JOIN usuario as usu on ugep.usu_id=usu.usu_id 
                    INNER JOIN persona as per on per.per_id=eper.per_id
                    INNER JOIN grupo_rol as grol on ugep.grol_id=grol.grol_id 
                    INNER JOIN rol as rol on rol.rol_id=grol.rol_id
                    INNER JOIN grupo as gru on gru.gru_id=grol.gru_id
                WHERE 
                    $condition 
                    $str_search
                    usu.usu_estado_logico=1 AND 
                    usu.usu_estado_activo=1 AND 
                    per.per_estado_logico=1 AND
                    per.per_estado_activo=1 AND
                    eper.eper_estado_logico=1 AND 
                    eper.eper_estado_activo=1 AND 
                    ugep.ugep_estado_logico=1 AND 
                    ugep.ugep_estado_activo=1 AND
                    rol.rol_estado_activo=1 AND
                    rol.rol_estado_logico=1 AND
                    gru.gru_estado_logico=1 AND
                    gru.gru_estado_activo=1 
                ORDER BY usu.usu_username, emp.emp_nombre_comercial;";
        $comando = Yii::$app->db->createCommand($sql);
        if ($iduser == 1) {
            $comando->bindParam(":emp_id", $idempresa, \PDO::PARAM_INT);
        }
        if (isset($search)) {
            $comando->bindParam(":search", $search_cond, \PDO::PARAM_STR);
        }
        $res = $comando->queryAll();
        $dataProvider = new ArrayDataProvider([
            'key' => 'id',
            'allModels' => $res,
            'pagination' => [
                'pageSize' => Yii::$app->params["pageSize"],
            ],
            'sort' => [
                'attributes' => ['Username', 'Nombres', 'Apellidos', 'Empresa'],
            ],
        ]);

        return $dataProvider;
    }
    
     /**
     * Function inactivarUsuarioId  que inactiva los datos de experiencia en docencia.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function inactivarUsuarioId($usu_id) {
        $con = \Yii::$app->db;
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
                    ("UPDATE " . $con->dbname . ".usuario             
                      SET usu_estado = :estadoInactiva,
                          usu_fecha_modificacion = :fecha_modificacion
                      WHERE 
                        usu_id = :usu_id AND                        
                        usu_estado = :estado AND
                        usu_estado_logico = :estado");

            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
            $comando->bindParam(":usu_id", $usu_id, \PDO::PARAM_INT);
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
    
    public function consultarUsuario($ids){
        $con = \Yii::$app->db;          
        $sql = "SELECT A.usu_id,A.per_id,G.grol_id,A.usu_user,B.per_pri_nombre,B.per_pri_apellido,B.per_cedula,
                                B.per_genero,B.per_fecha_nacimiento,B.per_correo,B.per_celular,
                                C.emp_id,E.emp_razon_social,D.gru_id,H.gru_nombre,D.rol_id,R.rol_nombre,D.eper_id
                        FROM " . $con->dbname . ".usuario A
                        INNER JOIN " . $con->dbname . ".persona B ON A.per_id=B.per_id
                                INNER JOIN (" . $con->dbname . ".usua_grol_eper F 
                                                INNER JOIN (" . $con->dbname . ".empresa_persona C
                                                                        INNER JOIN " . $con->dbname . ".empresa E ON C.emp_id=E.emp_id)						
                                                        ON F.eper_id=C.eper_id)
                                        ON F.usu_id=A.usu_id
                                INNER JOIN (" . $con->dbname . ".usua_grol_eper G 
                                                INNER JOIN (" . $con->dbname . ".grup_rol D 
                                                                INNER JOIN " . $con->dbname . ".grupo H ON H.gru_id=D.gru_id
                                        INNER JOIN " . $con->dbname . ".rol R ON R.rol_id=D.rol_id)
                                                        ON D.grol_id=G.grol_id)
                            ON G.usu_id=A.usu_id
                WHERE $str_search A.usu_estado_logico=1 AND A.usu_estado=1 "
                . "  AND A.usu_id=:usu_id ";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":usu_id", $ids, \PDO::PARAM_INT);
        return $comando->queryAll();
    }
    
    
    public function consultarEmpGruRol($ids){
        $con = \Yii::$app->db;          
        $sql = "SELECT A.eper_id,A.emp_id,B.emp_razon_social,H.gru_id,H.gru_nombre,R.rol_id,R.rol_nombre
                    FROM " . $con->dbname . ".empresa_persona A
                            INNER JOIN " . $con->dbname . ".empresa B ON A.emp_id=B.emp_id
                    INNER JOIN (" . $con->dbname . ".grup_rol C
                                            INNER JOIN " . $con->dbname . ".grupo H ON H.gru_id=C.gru_id
                                            INNER JOIN " . $con->dbname . ".rol R ON R.rol_id=C.rol_id)
                                    ON C.eper_id=A.eper_id
                WHERE A.eper_estado_logico=1 AND A.per_id=:per_id; ";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":per_id", $ids, \PDO::PARAM_INT);
        return $comando->queryAll();
    }
    
    
    /**
     * Function listadoUsuariosP
     * @author  Byron Villacreses <developer@uteg.edu.ec>
     * @param      
     * @return  
     */
    public function insertarUsuarioEmpRolGru($data) {
        $arroout = array();
        $persona=new Persona();
        $empPers=new EmpresaPersona();
        $usuGREP=new UsuaGrolEper();
        $gruRol=new GrupRol();                
        $con = \Yii::$app->db;
        $trans = $con->beginTransaction();
        try {
            $data = isset($data['DATA']) ? $data['DATA'] : array();
            $per_id=$persona->insertarDataPersona($con, $data);
            $data[0]['per_id']=$per_id;            
            $usu_id= $this->insertarDataUsuario($con, $data);
            $data[0]['usu_id']=$usu_id;            
            $persona->insertarDataCorreo($con, $data);
            
            $dts=json_decode($data[0]['data_Empresa']);
            for ($i = 0; $i < sizeof($dts); $i++) {
                $data[0]['emp_id']=$dts[$i]->emp_id;
                $data[0]['gru_id']=$dts[$i]->gru_id;
                $data[0]['rol_id']=$dts[$i]->rol_id;
                $eper_id=$empPers->consultarIdEmpresaPersona($data[0]['per_id'],$data[0]['emp_id']);
                if ($eper_id==0) {//Si es 0 No existe en la tabla
                    if($dts[$i]->eper_id==0){//Verifica que No tenga Ids para que no se duplicquen los Ids
                        $eper_id=$empPers->insertarDataEmpresaPersona($con, $data);//Inserto Empresa Persona 
                        $this->actualizarArrayEmpresa($dts, $data[0]['emp_id'], $eper_id);
                    }else{
                        $eper_id=$dts[$i]->eper_id;
                    }
                    
                }                
                $data[0]['eper_id']=$eper_id;  
                $grol_id=$gruRol->existeGrupoRol($data[0]['gru_id'], $data[0]['rol_id']);
                if ($grol_id==0) {
                    $grol_id=$gruRol->insertarDataGrupRol($con, $data);
                }                
                $data[0]['grol_id']=$grol_id; 
                $usuGREP->insertarDataUsuaGrolEper($con, $data);
            }
            $trans->commit();
            $con->close();
            //RETORNA DATOS 
            $arroout["status"]= true;

            return $arroout;
        } catch (\Exception $e) {
            $trans->rollBack();
            $con->close();
            //throw $e;
            $arroout["status"]= false;
            return $arroout;
        }
    }
    private function actualizarArrayEmpresa($dts,$emp_id,$eper_id) {
        for ($i = 0; $i < sizeof($dts); $i++) {
            if($dts[$i]->emp_id==$emp_id){
                $dts[$i]->eper_id=$eper_id;
            }
        }
    }
    /**
     * Function listadoUsuariosP
     * @author  Byron Villacreses <developer@uteg.edu.ec>
     * @param      
     * @return  
     */
    
    /* ACTUALIZAR DATOS */
    public function actualizarUsuarioEmpRolGru($data) {
        $arroout = array();
        $con = \Yii::$app->db;
        $trans = $con->beginTransaction();
        try {
            $data = isset($data['DATA']) ? $data['DATA'] : array();
            //$usu_id=$data[0]['usu_id'];
            $this->actualizarDataPersona($con, $data);
            $this->deletePersGrupRol($con, $data);
            //$this->actualizarDataGrupoRol($con, $data);
            $dts=json_decode($data[0]['data_Empresa']);
            for ($i = 0; $i < sizeof($dts); $i++) {
                $data[0]['emp_id']=$dts[$i]->emp_id;
                $data[0]['gru_id']=$dts[$i]->gru_id;
                $data[0]['rol_id']=$dts[$i]->rol_id;
                $eper_id=$empPers->insertarDataEmpresaPersona($con, $data);
                $data[0]['eper_id']=$eper_id;                
                $grol_id=$gruRol->insertarDataGrupRol($con, $data);
                $data[0]['grol_id']=$grol_id; 
                $usuGREP->insertarDataUsuaGrolEper($con, $data);
            }
            
            $trans->commit();
            $con->close();
            //RETORNA DATOS 
            $arroout["status"]= true;
            return $arroout;
        } catch (\Exception $e) {
            $trans->rollBack();
            $con->close();
            //throw $e;
            $arroout["status"]= false;
            return $arroout;
        }
    }
    
    /**
     * Function listadoUsuariosP
     * @author  Byron Villacreses <developer@uteg.edu.ec>
     * @param      
     * @return  
     */
    public function actualizarDataPersona($con, $data) {
        $sql = "UPDATE " . $con->dbname . ".persona
                    SET per_pri_nombre = :per_pri_nombre,per_pri_apellido = :per_pri_apellido,
                    per_fecha_nacimiento=:per_fecha_nacimiento,per_celular=:per_celular,
                    per_genero=:per_genero,per_correo=:per_correo,per_fecha_modificacion=CURRENT_TIMESTAMP()
                  WHERE per_id = :per_id ; ";
        
        $command = $con->createCommand($sql);
        $command->bindParam(":per_id", $data[0]['per_id'], \PDO::PARAM_INT); //Id Comparacion
        $command->bindParam(":per_pri_nombre", $data[0]['per_pri_nombre'], \PDO::PARAM_STR);
        $command->bindParam(":per_pri_apellido", $data[0]['per_pri_apellido'], \PDO::PARAM_STR);        
        $command->bindParam(":per_fecha_nacimiento", $data[0]['per_fecha_nacimiento'], \PDO::PARAM_STR);
        $command->bindParam(":per_celular", $data[0]['per_celular'], \PDO::PARAM_STR);
        $command->bindParam(":per_genero", $data[0]['per_genero'], \PDO::PARAM_STR);
        $command->bindParam(":per_correo", $data[0]['per_correo'], \PDO::PARAM_STR);        
        $command->execute();
    }
    public function actualizarDataGrupoRol($con, $data) {
        $sql = "UPDATE " . $con->dbname . ".grup_rol
                        SET gru_id = :gru_id,rol_id = :rol_id,grol_fecha_modificacion = CURRENT_TIMESTAMP()
                    WHERE grol_id = :grol_id; ";
        $command = $con->createCommand($sql);
        $command->bindParam(":grol_id", $data[0]['grol_id'], \PDO::PARAM_INT); //Id Comparacion
        $command->bindParam(":gru_id", $data[0]['gru_id'], \PDO::PARAM_INT);
        $command->bindParam(":rol_id", $data[0]['rol_id'], \PDO::PARAM_INT);
        $command->execute();
    }
    
    private function deletePersGrupRol($con,$data) {        
        $sql = "DELETE FROM " . $con->dbname . ".usua_grol_eper WHERE usu_id=:usu_id";
        $command = $con->createCommand($sql);
        //$command->bindParam(":eper_id", $dts[$i]->eper_id, PDO::PARAM_INT);
        $command->bindParam(":usu_id", $data[0]['usu_id'], PDO::PARAM_INT);
        $command->execute();
        
        $sql = "DELETE FROM " . $con->dbname . ".grup_rol "
                    . " WHERE eper_id IN "
                    . "  (SELECT eper_id FROM db_asgard.empresa_persona WHERE per_id=:per_id);" ;                     
        $command = $con->createCommand($sql);
        $command->bindParam(":per_id", $data[0]['per_id'], PDO::PARAM_INT);
        $command->execute();
        

        $sql = "DELETE FROM " . $con->dbname . ".empresa_persona WHERE per_id=:per_id ";
        $command = $con->createCommand($sql);
        $command->bindParam(":per_id", $data[0]['per_id'], PDO::PARAM_INT);
        $command->execute();
    }
    
    /**
     * Function eliminar Grupo ROl
     * @author  Byron Villacreses <developer@uteg.edu.ec>
     * @param      
     * @return  
     */
    public static function eliminarUsuarioGruRol($data) {
        $con = \Yii::$app->db;
        $trans = $con->beginTransaction();
        try {
            //$ids = isset($data['ids']) ? base64_decode($data['ids']) :NULL;
            $ids = isset($data['id']) ? $data['id'] :NULL;
            $sql = "UPDATE " . $con->dbname . ".usua_grol_eper "
                    . "SET ugep_estado=0 WHERE ugep_id=:ugep_id; ";            
            $command = $con->createCommand($sql);
            $command->bindParam(":ugep_id", $ids, \PDO::PARAM_INT);
            $command->execute();
            $trans->commit();
            $con->close();
            return true;
        } catch (\Exception $e) {
            $trans->rollBack();
            $con->close();
            //throw $e;
            return false;
        }
    }
    
    /**
     * Function listadoUsuariosP
     * @author  Byron Villacreses <developer@uteg.edu.ec>
     * @param      
     * @return  
     */
    
    public function insertarDataUsuario($con,$data) {
        //usu_id
        $security = new Security();
        $hash = $this->generateAuthKey();
        $password = base64_encode($security->encryptByPassword($hash, $data[0]['usu_clave'])); 
        $sql = "INSERT INTO " . $con->dbname . ".usuario
            (per_id,usu_user,usu_sha,usu_password,usu_fecha_creacion,usu_estado,usu_estado_logico)VALUES
            (:per_id,:usu_user,:usu_sha,:usu_password,CURRENT_TIMESTAMP(),1,1) ";
        
        $command = $con->createCommand($sql);
        $command->bindParam(":per_id",$data[0]['per_id'], \PDO::PARAM_INT);
        $command->bindParam(":usu_user",$data[0]['usu_user'], \PDO::PARAM_STR);
        $command->bindParam(":usu_sha",$hash, \PDO::PARAM_STR);  
        $command->bindParam(":usu_password",$password, \PDO::PARAM_STR);        
        $command->execute();
        return $con->getLastInsertID();
    }
    
    /**
     * Function consultarDataUsuario para profesores.
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param      
     * @return  
     */    
    public function consultarDataUsuario($id_inicio, $id_final) {
        $con = \Yii::$app->db;          
        $sql = "select usu_id, p.per_cedula from " . $con->dbname . ".usuario u inner join " . $con->dbname . ".persona p on (p.per_id = u.per_id) 
               -- where usu_id between :id_inicio and :id_final
               where usu_id in (1811	,
3068	,
3765	,
2447	,
2448	,
3317	,
1316	,
1320	,
3537	,
1443	,
1846	,
1489	,
1117	,
1826	,
3654	,
1771	,
1772	,
1773	,
1909	,
1753	,
1926	,
2508	,
1554	,
1969	,
1329	,
1344	,
1456	,
3768	,
1356	,
1313	,
2133	,
1331	,
1523	,
3539	,
1815	,
1859	,
1799	,
1827	,
3342	,
1459	,
3655	,
3749	,
1930	,
1474	,
1467	,
3656	,
1323	,
3657	,
1974	,
1908	,
1620	,
1865	,
1965	,
3500	,
1749	,
3405	,
1417	,
3365	,
1462	,
1463	,
1768	,
1760	,
3659	,
1321	,
1486	,
1942	,
3425	,
1100	,
1789	,
1863	,
1824	,
1756	,
3680	,
1880	,
3729	,
1635	,
1881	,
2972	,
3683	,
3286	,
1857	,
1769	,
1496	,
3684	,
2520	,
3326	,
3685	,
1362	,
1809	,
1531	,
3431	,
1921	,
1400	,
1917	,
3771	,
3148	,
3748	,
3347	,
3348	,
3349	,
3350	,
3351	,
2450	,
1941	,
1837	,
1274	,
3689	,
3690	,
3627	,
3691	,
1759	,
3344	,
2506	,
1148	,
1102	,
1927	,
3330	,
3694	,
3695	,
3696	,
3399	,
1925	,
1761	,
3066	,
3688	,
1777	,
3702	,
1858	,
3394	,
3343	,
1796	,
3707	,
1791	,
3700	,
3710	,
1818	,
3582	,
3701	,
1440	,
3705	,
1916	,
1935	,
3346	,
1806	,
3398	,
3752	,
2499	,
1866	,
1978	,
1945	,
3790	,
1755	,
1074	,
1461	,
3387	,
3715	,
3388	,
1778	,
1699	,
1831	,
1460	,
1758	,
1779	,
3325	,
3297	,
3713	,
3361	,
3555	,
1302	,
3542	,
3706	,
1083	,
3502	,
1944	,
1058	,
1832	,
3450	,
1634	,
1844	,
1821	,
3711	,
3056	,
1947	,
3704	,
3530	,
3697	,
1700	,
3454	,
3340	,
3393	,
1862	,
3356	,
3764	,
3440	,
3633	,
3672	,
3446	,
1748	,
1546	,
3438	,
2067	,
1801	,
1637	,
3724	,
3323	,
1613	,
1009	,
1485	,
1820	,
1630	,
1975	,
1066	,
1082	,
3674	,
3504	,
3630	,
3648	,
1590	,
3663	,
3746	,
3636	,
3744	,
1203	,
3720	,
1023	,
2049	,
3456	,
3501	,
1558	,
1107	,
1973	,
3576	,
1114	,
1163	,
3381	,
1701	,
3508	,
1538	,
1750	,
1201	,
1033	,
1106	,
1604	,
1147	,
3791	,
3369	,
3793	,
1160	,
3649	,
2050	,
1647	,
1043	,
2118	,
1006	,
1976	,
1795	,
1311	,
2129	,
1533	,
3668	,
1843	,
2131	,
1877	,
1135	,
3422	,
1522	,
2684	,
1439	,
1492	,
1506	,
1510	,
3796	,
1792	,
3716	,
1953	,
3644	,
3725	,
3482	,
1920	,
3638	,
1781	,
1137	,
1258	,
1738	,
3652	,
1115	,
1143	,
1822	,
1471	,
1770	,
1154	,
1219	,
1189	,
3391	,
1348	,
3434	,
3754	,
1466	,
3027	,
1563	,
3417	,
1139	,
3432	,
3382	,
1986	,
1594	,
1026	,
3426	,
1052	,
3679	,
1902	,
1899	,
1900	,
1108	,
3435	,
1963	,
3339	,
3580	,
1887	,
1793	,
1089	,
3670	,
3423	,
1919	,
1548	,
1889	,
1266	,
1740	,
1376	,
1936	,
1719	,
1104	,
3653	,
3767	,
3639	,
1204	,
3676	,
1518	,
1616	,
3373	,
1971	,
1407	,
1861	,
1645	,
3667	,
1151	,
1741	,
1851	,
3731	,
3666	,
1746	,
1119	,
1886	,
3640	,
3677	,
1049	,
2478	,
1129	,
1358	,
1038	,
1665	,
3383	,
1162	,
3631	,
1099	,
3444	,
1823	,
3581	,
1037	,
1011	,
1631	,
1214	,
2477	,
3506	,
3408	,
1149	,
1633	,
2989	,
1810	,
1078	,
1977	,
3439	,
1688	,
2982	,
3779	,
3276	,
3002	,
3650	,
3437	,
3577	,
2153	,
3675	,
2413	,
1528	,
1134	,
1728	,
3669	,
1072	,
3645	,
1566	,
3641	,
1465	,
3595	,
3678	,
3665	,
1588	,
1111	,
3481	,
1457	,
1504	,
3719	,
3692	,
1572	,
1597	,
1232	,
3496	,
1511	,
1283	,
1304	,
1158	,
2053	,
1580	,
3372	,
1547	,
3763	,
1468	,
1878	,
3336	,
3671	,
1095	,
1737	,
1047	,
1092	,
1305	,
1879	,
3544	,
1536	,
3629	,
3647	,
2987	,
1093	,
3761	,
2147	,
1896	,
1704	,
1705	,
1727	,
1869	,
1951	,
1690	,
3723	,
3792	,
3794	,
1922	,
1658	,
1867	,
1600	,
1638	,
1641	,
3613	,
3756	,
3392	,
3313	,
1957	,
1355	,
1786	,
1571	,
1816	,
1434	,
1840	,
1836	,
1895	,
1804	,
1805	,
1661	,
1735	,
1966	,
3366	,
1995	,
3777	,
3742	,
3743	,
3600	,
1315	,
1898	,
3730	,
1871	,
1952	,
1732	,
1640	,
1950	,
1652	,
1721	,
2967	,
3737	,
3358	,
1264	,
1639	,
1707	,
1833	,
1981	,
3363	,
1852	,
3362	,
1018	,
1545	,
1617	,
1912	)
                -- and u.usu_estado = '1' and p.per_estado = '1'
                ";
        $command = $con->createCommand($sql);
        $command->bindParam(":id_inicio", $id_inicio, \PDO::PARAM_INT);
        $command->bindParam(":id_final", $id_final, \PDO::PARAM_INT); 
        return $command->queryAll();        
    }
    
    /**
     * Function actualizarDataUsuario para profesores.
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param      
     * @return  
     */    
    public function actualizarDataUsuario($usu_sha, $usu_pass, $usu_id) {
        $con = \Yii::$app->db;
        $trans = $con->beginTransaction();
        try {            
            
            $sql = "UPDATE " . $con->dbname . ".usuario 
                    SET usu_sha = :usu_sha,
                    usu_password= :usu_password
                    WHERE usu_id=:usu_id; ";
            $command = $con->createCommand($sql);
            $command->bindParam(":usu_id", $usu_id, \PDO::PARAM_INT);
            $command->bindParam(":usu_sha", $usu_sha, \PDO::PARAM_STR);
            $command->bindParam(":usu_password", $usu_pass, \PDO::PARAM_STR);
            $command->execute();
            $trans->commit();
            $con->close();
            return true;
        } catch (\Exception $e) {
            $trans->rollBack();
            $con->close();            
            return false;
        }
    }    
}
