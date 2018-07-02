<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "empresa".
 *
 * @property integer $emp_id
 * @property integer $temp_id
 * @property string $emp_razon_social
 * @property string $emp_nombre_comercial
 * @property string $emp_alias
 * @property string $emp_ruc
 * @property string $emp_dominio
 * @property string $emp_imap_domain
 * @property string $emp_imap_port
 * @property string $emp_imap_user
 * @property string $emp_imap_pass
 * @property string $emp_direccion
 * @property string $emp_telefono
 * @property string $emp_descripcion
 * @property string $emp_estado
 * @property string $emp_fecha_creacion
 * @property string $emp_fecha_modificacion
 * @property string $emp_estado_logico
 *
 * @property TipoEmpresa $temp
 * @property EmpresaPersona[] $empresaPersonas
 */
class Empresa extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'empresa';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['temp_id', 'emp_nombre_comercial'], 'required'],
            [['temp_id'], 'integer'],
            [['emp_fecha_creacion', 'emp_fecha_modificacion'], 'safe'],
            [['emp_razon_social', 'emp_nombre_comercial', 'emp_alias', 'emp_imap_domain', 'emp_imap_pass'], 'string', 'max' => 200],
            [['emp_ruc', 'emp_imap_port'], 'string', 'max' => 20],
            [['emp_dominio', 'emp_imap_user'], 'string', 'max' => 100],
            [['emp_direccion'], 'string', 'max' => 45],
            [['emp_telefono', 'emp_descripcion'], 'string', 'max' => 50],
            [['emp_estado', 'emp_estado_logico'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'emp_id' => 'Emp ID',
            'temp_id' => 'Temp ID',
            'emp_razon_social' => 'Emp Razon Social',
            'emp_nombre_comercial' => 'Emp Nombre Comercial',
            'emp_alias' => 'Emp Alias',
            'emp_ruc' => 'Emp Ruc',
            'emp_dominio' => 'Emp Dominio',
            'emp_imap_domain' => 'Emp Imap Domain',
            'emp_imap_port' => 'Emp Imap Port',
            'emp_imap_user' => 'Emp Imap User',
            'emp_imap_pass' => 'Emp Imap Pass',
            'emp_direccion' => 'Emp Direccion',
            'emp_telefono' => 'Emp Telefono',
            'emp_descripcion' => 'Emp Descripcion',
            'emp_estado' => 'Emp Estado',
            'emp_fecha_creacion' => 'Emp Fecha Creacion',
            'emp_fecha_modificacion' => 'Emp Fecha Modificacion',
            'emp_estado_logico' => 'Emp Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTemp() {
        return $this->hasOne(TipoEmpresa::className(), ['temp_id' => 'temp_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresaPersonas() {
        return $this->hasMany(EmpresaPersona::className(), ['emp_id' => 'emp_id']);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {
        return static::findOne($id);
    }

    /**
     * Get all empresas by user_id
     *
     * @access public
     * 
     * @param  int     $user_id     Id user
     * @return mixed                Get Array of a empresas
     */
    public static function getEmpresasXUsuario($user_id) {
        if($user_id != 1){
            $fromTo = " JOIN empresa_persona AS ep ON ep.emp_id = e.emp_id
                    JOIN persona AS p ON ep.per_id = p.per_id
                    JOIN usuario AS u ON u.per_id = p.per_id ";
            $where = " AND u.usu_id=:id AND 
                    u.usu_estado_logico=1 AND 
                    u.usu_estado=1 AND 
                    p.per_estado_logico=1 AND 
                    p.per_estado=1 AND 
                    ep.eper_estado_logico=1 AND 
                    ep.eper_estado=1";
        }
        $sql = "SELECT 
                    e.*
                FROM 
                    empresa AS e
                    $fromTo
                WHERE 
                    e.emp_estado_logico=1 AND 
                    e.emp_estado=1
                    $where";

        $command = Yii::$app->db->createCommand($sql);
        
        if($user_id != 1){
            $command->bindParam(':id', $user_id, \PDO::PARAM_INT);
        }
        return $command->queryAll();
    }
    
    /**
     * Get all empresas by user_id
     *
     * @access public
     * 
     * @param  int     $user_id     Id user
     * @return mixed                Get Array of a empresas
     */
    public static function getListaEmpresasxUserID($user_id) {
        $grupo = new Grupo();
        $rol   = new Rol();
        $user = Usuario::findIdentity($user_id);
        $mainGrupo = $grupo->getMainGrupo($user->usu_user);
        $mainRol   = $rol->getMainRol($user->usu_user);
        $fromTo = $where = "";
        if($mainGrupo['id'] != 1 && $mainRol['id'] != 1){
            $fromTo = " INNER JOIN empresa_persona AS ep ON ep.emp_id = e.emp_id
                    INNER JOIN persona AS p ON ep.per_id = p.per_id
                    INNER JOIN usuario AS u ON u.per_id = p.per_id ";
            $where = " AND u.usu_id=:id AND 
                    u.usu_estado_logico=1 AND 
                    u.usu_estado=1 AND 
                    p.per_estado_logico=1 AND 
                    p.per_estado=1 AND 
                    ep.eper_estado_logico=1 AND 
                    ep.eper_estado=1";
        }
        $sql = "SELECT 
                    e.emp_id as id,
                    e.emp_nombre_comercial as name
                FROM 
                    empresa AS e
                    $fromTo
                WHERE 
                    e.emp_estado_logico=1 AND 
                    e.emp_estado=1
                    $where";

        $command = Yii::$app->db->createCommand($sql);
        
        if($user_id != 1){
            $command->bindParam(':id', $user_id, \PDO::PARAM_INT);
        }
        return $command->queryAll();
    }
}
