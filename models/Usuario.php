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
 * @property string $usu_estado
 * @property string $usu_fecha_creacion
 * @property string $usu_fecha_modificacion
 * @property string $usu_estado_logico
 *
 * @property ConfiguracionCuenta[] $configuracionCuentas
 * @property UsuaGrol[] $usuaGrols
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
                [['usu_estado', 'usu_estado_logico'], 'string', 'max' => 1],
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
    public function getUsuaGrols() {
        return $this->hasMany(UsuaGrol::className(), ['usu_id' => 'usu_id']);
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
    public function createSession() {
        $session = Yii::$app->session;
        if ($session->isActive) {
            $session->open();
            //$session->close();
            $model_persona = Persona::findIdentity($this->per_id);
            $nombre_persona = $model_persona->per_pri_nombre;
            $apellido_persona = $model_persona->per_pri_apellido;
            $session->set('PB_isuser', true);
            $session->set('PB_username', $this->usu_user);
            $session->set('PB_nombres', $nombre_persona . " " . $apellido_persona);
            $session->set('PB_perid', $this->per_id);
            $session->set('PB_iduser', $this->usu_id);
            $session->set('PB_yii_lang', Yii::$app->language);
            $session->set('PB_yii_theme', Yii::$app->view->theme->themeName);
        } else {
            $session->destroy();
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
            $str_search = "(per.per_pri_nombre like :search OR ";
            $str_search .= "per.per_pri_apellido like :search OR ";
            $str_search .= "usu.usu_user like :search) AND ";
        }
        $sql = "SELECT                                       
                    DISTINCT(usu.usu_user) as Username,
                    usu.usu_id as id,
                    per.per_pri_nombre as Nombres,
                    per.per_pri_apellido as Apellidos,
                    gru.gru_nombre as Grupo,
                    rol.rol_nombre as Rol
                FROM 
                    usuario as usu 
                    INNER JOIN persona as per on per.per_id=usu.per_id                   
                    INNER JOIN usua_grol as ug on usu.usu_id = ug.usu_id
                    INNER JOIN grup_rol AS grol ON grol.grol_id = ug.grol_id 
                    INNER JOIN grupo AS gru ON gru.gru_id = grol.gru_id 
                    INNER JOIN rol AS rol ON rol.rol_id = grol.rol_id  
                    


               WHERE                   
                    $str_search
                    usu.usu_estado_logico=1 AND 
                    per.per_estado_logico=1 AND                 
                    rol.rol_estado_logico=1 AND
                    gru.gru_estado_logico=1  
                ORDER BY usu.usu_user;";
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

}
