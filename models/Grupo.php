<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "grupo".
 *
 * @property integer $gru_id
 * @property string $gru_nombre
 * @property string $gru_descripcion
 * @property string $gru_observacion
 * @property string $gru_estado
 * @property string $gru_fecha_creacion
 * @property string $gru_fecha_actualizacion
 * @property string $gru_estado_logico
 *
 * @property GrupObmo[] $grupObmos
 * @property GrupRol[] $grupRols
 */
class Grupo extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'grupo';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['gru_estado', 'gru_estado_logico'], 'required'],
            [['gru_fecha_creacion', 'gru_fecha_actualizacion'], 'safe'],
            [['gru_nombre'], 'string', 'max' => 250],
            [['gru_descripcion', 'gru_observacion'], 'string', 'max' => 500],
            [['gru_estado', 'gru_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'gru_id' => 'Gru ID',
            'gru_nombre' => 'Gru Nombre',
            'gru_descripcion' => 'Gru Descripcion',
            'gru_observacion' => 'Gru Observacion',
            'gru_estado' => 'Gru Estado',
            'gru_fecha_creacion' => 'Gru Fecha Creacion',
            'gru_fecha_actualizacion' => 'Gru Fecha Actualizacion',
            'gru_estado_logico' => 'Gru Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupObmos() {
        return $this->hasMany(GrupObmo::className(), ['gru_id' => 'gru_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupRols() {
        return $this->hasMany(GrupRol::className(), ['gru_id' => 'gru_id']);
    }

    /**
     * Function to get array 
     * @author  Diana Lopez <dlopez@uteg.edu.ec>
     * @param   string  $username    
     * @return  mixed   $res        New array 
     */
    public function getMainGrupo($username) {
        $user = Usuario::findByUsername($username);
        $con = Yii::$app->db;
        $trans = $con->getTransaction();
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction();
        }
        $sql = "SELECT 
                    g.gru_id AS id,
                    p.per_cedula AS dni
                FROM 
                    usuario AS u 
                    INNER JOIN usua_grol_eper AS ug ON u.usu_id = ug.usu_id
                    INNER JOIN empresa_persona AS ep ON ug.eper_id = ep.eper_id
                    INNER JOIN empresa AS e ON ep.emp_id = e.emp_id
                    INNER JOIN grup_rol AS gr ON gr.grol_id = ug.grol_id 
                    INNER JOIN grupo AS g ON g.gru_id = gr.gru_id 
                    INNER JOIN persona AS p ON p.per_id = u.per_id 
                WHERE 
                    u.usu_user = :user AND 
                    ug.ugep_estado_logico=1 AND 
                    ug.ugep_estado=1 AND 
                    ep.eper_estado_logico=1 AND 
                    ep.eper_estado=1 AND
                    e.emp_estado_logico=1 AND 
                    e.emp_estado=1 AND
                    gr.grol_estado_logico=1 AND 
                    gr.grol_estado=1 AND 
                    p.per_estado_logico=1 AND 
                    p.per_estado=1 AND 
                    g.gru_estado = 1 AND 
                    g.gru_estado_logico=1 AND 
                    u.usu_estado=1 AND 
                    u.usu_estado_logico=1";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":user", $username, \PDO::PARAM_STR);
        $result = $comando->queryOne();
        return $result;
    }

}
