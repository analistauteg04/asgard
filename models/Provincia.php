<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "provincia".
 *
 * @property integer $pro_id
 * @property integer $pai_id
 * @property string $pro_nombre
 * @property string $pro_descripcion
 * @property string $pro_estado
 * @property string $pro_fecha_creacion
 * @property string $pro_fecha_modificacion
 * @property string $pro_estado_logico
 *
 * @property Canton[] $cantons
 * @property Persona[] $personas
 * @property Persona[] $personas0
 * @property Persona[] $personas1
 * @property Pais $pai
 */
class Provincia extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        //return 'provincia';
        return \Yii::$app->db_asgard->dbname . '.provincia';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['pai_id', 'pro_estado', 'pro_estado_logico'], 'required'],
                [['pai_id'], 'integer'],
                [['pro_fecha_creacion', 'pro_fecha_modificacion'], 'safe'],
                [['pro_nombre', 'pro_descripcion'], 'string', 'max' => 100],
                [['pro_estado', 'pro_estado_logico'], 'string', 'max' => 1],
                [['pai_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pais::className(), 'targetAttribute' => ['pai_id' => 'pai_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'pro_id' => Yii::t('etnia', 'Pro ID'),
            'pai_id' => Yii::t('etnia', 'Pai ID'),
            'pro_nombre' => Yii::t('etnia', 'Pro Nombre'),
            'pro_descripcion' => Yii::t('etnia', 'Pro Descripcion'),
            'pro_estado' => Yii::t('etnia', 'Pro Estado'),
            'pro_fecha_creacion' => Yii::t('etnia', 'Pro Fecha Creacion'),
            'pro_fecha_modificacion' => Yii::t('etnia', 'Pro Fecha Modificacion'),
            'pro_estado_logico' => Yii::t('etnia', 'Pro Estado Logico'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCantons() {
        return $this->hasMany(Canton::className(), ['pro_id' => 'pro_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonas() {
        return $this->hasMany(Persona::className(), ['pro_id_nacimiento' => 'pro_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonas0() {
        return $this->hasMany(Persona::className(), ['pro_id_domicilio' => 'pro_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonas1() {
        return $this->hasMany(Persona::className(), ['pro_id_trabajo' => 'pro_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPai() {
        return $this->hasOne(Pais::className(), ['pai_id' => 'pai_id']);
    }

    /**
     * Función 
     *
     * @author Diana López
     * @param $model
     */
    public static function provinciaXPais($id_pais) {
        $con = \Yii::$app->db_asgard;
        $estado = 1;
        $sql = "
                    SELECT 
                        pro.pro_id AS id,
                        pro.pro_nombre AS value
                    FROM 
                         " . $con->dbname . ".provincia as pro
                        INNER JOIN " . $con->dbname . ".pais as pai on pai.pai_id=pro.pai_id
                    WHERE 
                        pro.pai_id=:id_pais AND
                        pro.pro_estado=:estado AND
                        pro.pro_estado_logico=:estado AND
                        pai.pai_estado=:estado AND
                        pai.pai_estado_logico=:estado 
                    ORDER BY pro_nombre ASC
                ";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":id_pais", $id_pais, \PDO::PARAM_INT);
        $resultData = $comando->queryAll();
        return $resultData;
    }

}
