<?php

namespace app\modules\academico\models;

use Yii;
use \yii\data\ActiveDataProvider;
use \yii\data\ArrayDataProvider;

/**
 * This is the model class for table "asignatura".
 *
 * @property integer $asi_id
 * @property string $scon_id
 * @property string $asi_nombre
 * @property string $asi_descripcion
 * @property string $asi_usuario_ingreso
 * @property string $asi_usuario_modifica
 * @property string $asi_estado
 * @property string $asi_fecha_creacion
 * @property string $asi_fecha_modificacion
 * @property string $asi_estado_logico
 *
 */

class Asignatura extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'asignatura';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb() {
        return Yii::$app->get('db_academico');
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['scon_id','asi_estado', 'asi_estado_logico'], 'required'],
            [['scon_id'], 'integer'],
            [['asi_fecha_creacion', 'asi_fecha_modificacion'], 'safe'],            
            [['asi_nombre'], 'string', 'max' => 300],
            [['asi_descripcion'], 'string', 'max' => 500],
            [['asi_estado', 'asi_estado_logico'], 'string', 'max' => 1],
            [['scon_id'], 'exist', 'skipOnError' => true, 'targetClass' => SubareaConocimiento::className(), 'targetAttribute' => ['scon_id' => 'scon_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'asi_id' => 'Asignatura ID',
            'scon_id' => 'SubareaConocimiento ID',
            'asi_nombre' => 'Asignatura Nombre',
            'asi_descripcion' => 'Asignatura Descripcion',            
            'asi_estado' => 'Asignatura Estado',
            'asi_fecha_creacion' => 'Asignatura Fecha Creacion',
            'asi_fecha_modificacion' => 'Asignatura Fecha Modificacion',
            'asi_estado_logico' => 'Asignatura Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    
    function getAllAsignaturasGrid($search = NULL, $dataProvider = false){
        $iduser = Yii::$app->session->get('PB_iduser', FALSE);
        $search_cond = "%".$search."%";
        $str_search = "";
        if(isset($search)){
            $str_search = "(asi.asi_nombre like :search OR ";
            $str_search .= "scon.scon_nombre like :search OR ";
            $str_search .= "acon.acon_nombre like :search) AND";
        }
        $sql = "SELECT
                    asi.asi_id AS id,
                    asi.asi_nombre AS Nombre,
                    scon.scon_nombre AS SubAreaConocimiento,
                    acon.acon_nombre AS AreaConocimiento,
                    asi.asi_estado AS Estado
                FROM
                    asignatura as asi
                    INNER JOIN subarea_conocimiento as scon on scon.scon_id=asi.scon_id
                    INNER JOIN area_conocimiento as acon on acon.acon_id=scon.acon_id
                WHERE
                    $str_search
                    asi.asi_estado_logico = 1
                    AND scon.scon_estado_logico = 1
                    AND acon.acon_estado_logico = 1
                ORDER BY asi.asi_id;";
        $comando = Yii::$app->db_academico->createCommand($sql);
        if(isset($search)){
            $comando->bindParam(":search",$search_cond, \PDO::PARAM_STR);
        }
        $res = $comando->queryAll();
        if($dataProvider){
            $dataProvider = new ArrayDataProvider([
                'key' => 'asi_id',
                'allModels' => $res,
                'pagination' => [
                    'pageSize' => Yii::$app->params["pageSize"],
                ],
                'sort' => [
                    'attributes' => ['Nombre', 'SubAreaConocimiento', 'AreaConocimiento', 'Estado'],
                ],
            ]);
            return $dataProvider;
        }
        return $res;
    }
}