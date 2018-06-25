<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "accion".
 *
 * @property integer $acc_id
 * @property string $acc_nombre
 * @property string $acc_url_accion
 * @property string $acc_tipo
 * @property string $acc_descripcion
 * @property string $acc_lang_file
 * @property string $acc_dir_imagen
 * @property string $acc_estado
 * @property string $acc_fecha_creacion
 * @property string $acc_fecha_modificacion
 * @property string $acc_estado_logico
 *
 * @property ObmoAcci[] $obmoAccis
 */
class Accion extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'accion';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['acc_estado', 'acc_estado_logico'], 'required'],
            [['acc_fecha_creacion', 'acc_fecha_modificacion'], 'safe'],
            [['acc_nombre', 'acc_url_accion', 'acc_tipo', 'acc_lang_file', 'acc_dir_imagen'], 'string', 'max' => 250],
            [['acc_descripcion'], 'string', 'max' => 500],
            [['acc_estado', 'acc_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'acc_id' => 'Acc ID',
            'acc_nombre' => 'Acc Nombre',
            'acc_url_accion' => 'Acc Url Accion',
            'acc_tipo' => 'Acc Tipo',
            'acc_descripcion' => 'Acc Descripcion',
            'acc_lang_file' => 'Acc Lang File',
            'acc_dir_imagen' => 'Acc Dir Imagen',
            'acc_estado' => 'Acc Estado',
            'acc_fecha_creacion' => 'Acc Fecha Creacion',
            'acc_fecha_modificacion' => 'Acc Fecha Modificacion',
            'acc_estado_logico' => 'Acc Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObmoAccis() {
        return $this->hasMany(ObmoAcci::className(), ['acc_id' => 'acc_id']);
    }
    
    /**
     * @inheritdoc
     * @return AccionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AccionQuery(get_called_class());
    }
    
    /**
     * Función para Obtener el menu de acciones 
     * Los Tipos de botones registrados en el Objeto Modulo son:
     * 0=>Botones normales que ejecutan un accion o entidad
     * 1=>Botones que ejecutan una funcion javascript
     * 
     * Los tipos de objetos modulos son:
     * P=>Principal
     * S=>Secundario
     * A=>Accion
     * 
     * Los tipos de botones son:
     * 1=>Botones que ejecutan la accion de un enlace
     * 2=>Botones que ejecutan una funcion javascript
     *
     * @author Eduardo Cueva <ecueva@penblu.com>
     * @access public
     * @param  int        $id_omodpadre     Id del Objeto Modulo Padre
     * @param  int        $omod_id          Id del Objeto Modulo
     * @return mixed                        Devuelve un array para construccion de Menus
     */
    public function getAccionesXObjModulo($id_omodpadre, $omod_id){
        $usu_id    = Yii::$app->session->get('PB_iduser', FALSE);
        
        $sql = "SELECT 
                    om.omod_id,
                    om.omod_padre_id,
                    om.omod_nombre,
                    om.omod_entidad,
                    om.omod_lang_file,
                    om.omod_tipo,
                    om.omod_tipo_boton,
                    om.omod_accion,
                    om.omod_function,
                    om.omod_dir_imagen,
                    om.omod_orden,
                    ac.acc_id,
                    ac.acc_nombre,
                    ac.acc_url_accion,
                    ac.acc_tipo,
                    ac.acc_lang_file,
                    ac.acc_dir_imagen,
                    oa.oacc_tipo_boton,
                    oa.oacc_function,
                    oa.oacc_cont_accion
                FROM 
                    objeto_modulo AS om 
                    INNER JOIN grup_obmo AS go ON om.omod_id = go.omod_id 
                    INNER JOIN grup_obmo_grup_rol AS gg ON go.gmod_id = gg.gmod_id
                    INNER JOIN grup_rol AS gr ON gg.grol_id = gr.grol_id
                    INNER JOIN usua_grol AS ug ON gr.grol_id = ug.grol_id
                    INNER JOIN usuario AS us ON ug.usu_id = us.usu_id
                    INNER JOIN obmo_acci AS oa ON om.omod_id = oa.omod_id 
                    INNER JOIN accion AS ac ON oa.acc_id = ac.acc_id 
                WHERE 
                    om.omod_padre_id=:omodp_id AND 
                    om.omod_id=:omod_id AND
                    -- om.omod_tipo='A' AND 
                    us.usu_id=:usu_id AND 
                    go.gmod_estado_logico=1 AND 
                    gg.gogr_estado_logico=1 AND 
                    gr.grol_estado_logico=1 AND 
                    us.usu_estado_logico=1 AND 
                    om.omod_estado_logico=1 AND 
                    om.omod_estado_visible=1 AND
                    oa.oacc_estado_logico=1 AND 
                    ac.acc_estado_logico=1 
                ORDER BY om.omod_nombre;";
        $comando = Yii::$app->db->createCommand($sql);
        $comando->bindParam(":omodp_id", $id_omodpadre, \PDO::PARAM_INT);
        $comando->bindParam(":usu_id", $usu_id, \PDO::PARAM_INT);
        $comando->bindParam(":omod_id", $omod_id, \PDO::PARAM_INT);
        
        return $comando->queryAll();
    }
    
    public static function generateBehaviorByActions($objmod_id = NULL){
        if(!isset($objmod_id)){
            $session = Yii::$app->session;
            $objmod_id = $session->get('PB_objmodule_id');
        }
        $usu_id    = Yii::$app->session->get('PB_iduser', FALSE);
        
        $sql = "SELECT 
                    om.omod_entidad AS route
                FROM 
                    objeto_modulo AS om 
                    INNER JOIN grup_obmo AS go ON om.omod_id = go.omod_id 
                    INNER JOIN grup_obmo_grup_rol AS gg ON go.gmod_id = gg.gmod_id
                    INNER JOIN grup_rol AS gr ON gg.grol_id = gr.grol_id
                    INNER JOIN usua_grol AS ug ON gr.grol_id = ug.grol_id
                    INNER JOIN usuario AS us ON ug.usu_id = us.usu_id
                    INNER JOIN obmo_acci AS oa ON om.omod_id = oa.omod_id 
                    INNER JOIN accion AS ac ON oa.acc_id = ac.acc_id 
                WHERE 
                    om.omod_padre_id=:omod_id AND 
                    om.omod_tipo='A' AND 
                    us.usu_id=:usu_id AND 
                    go.gmod_estado_logico=1 AND 
                    gg.gogr_estado_logico=1 AND 
                    gr.grol_estado_logico=1 AND 
                    us.usu_estado_logico=1 AND 
                    om.omod_estado_logico=1 AND 
                    om.omod_estado_visible=1 AND
                    oa.oacc_estado_logico=1 AND 
                    ac.acc_estado_logico=1 
                UNION
                SELECT 
                    om.omod_entidad AS route
                FROM 
                    objeto_modulo AS om 
                    INNER JOIN grup_obmo AS go ON om.omod_id = go.omod_id 
                    INNER JOIN grup_obmo_grup_rol AS gg ON go.gmod_id = gg.gmod_id
                    INNER JOIN grup_rol AS gr ON gg.grol_id = gr.grol_id
                    INNER JOIN usua_grol AS ug ON gr.grol_id = ug.grol_id
                    INNER JOIN usuario AS us ON ug.usu_id = us.usu_id
                WHERE 
                    om.omod_padre_id=:omod_id AND 
                    om.omod_tipo='P' AND 
                    us.usu_id=:usu_id AND 
                    go.gmod_estado_logico=1 AND 
                    gg.gogr_estado_logico=1 AND 
                    gr.grol_estado_logico=1 AND 
                    us.usu_estado_logico=1 
                ORDER BY route;";
        $comando = Yii::$app->db->createCommand($sql);
        $comando->bindParam(":omod_id", $objmod_id, \PDO::PARAM_INT);
        $comando->bindParam(":usu_id", $usu_id, \PDO::PARAM_INT);
        $result = $comando->queryAll();
        $actions = array();
        $actionsArr = "";
        
        foreach($result as $key => $value){
            $link = $value["route"];
            $arr_link = explode("/",$link);
            $cont = count($arr_link) - 1;
            $actions[] = $arr_link[$cont];
        }
        if(count($actions)>0){
            return [
                "access" => [
                    'class' => \yii\filters\AccessControl::className(),
                    'rules' => [
                        [
                            'allow'   => true,
                            'actions' => $actions,
                            'roles'   => ['@'],
                        ],
                    ],
            ]];
        }else{
            return [
                "access" => [
                    'class' => \yii\filters\AccessControl::className(),
                    'rules' => [
                        [
                            'allow'   => false,
                            'roles'   => ['@'],
                        ],
                    ],
            ]];
        }
    }
}
