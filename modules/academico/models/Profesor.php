<?php

namespace app\modules\academico\models;

use Yii;
use \yii\data\ActiveDataProvider;
use \yii\data\ArrayDataProvider;
use app\models\Persona;
/**
 * This is the model class for table "profesor".
 *
 * @property integer $pro_id
 * @property integer $per_id
 * @property integer $usu_id
 * @property integer $eper_id
 * @property integer $grol_id
 * 
 * @property string $per_pri_nombre
 * @property string $per_seg_nombre
 * @property string $per_pri_apellido
 * @property string $per_seg_apellido
 * @property string $per_cedula
 * @property string $per_ruc
 * @property string $per_pasaporte
 * @property string $per_correo
 * 
 * @property integer $pai_id_domicilio
 * @property integer $pro_id_domicilio
 * @property integer $can_id_domicilio
 * @property string $per_domicilio_sector
 * @property string $per_domicilio_cpri
 * @property string $per_domicilio_csec
 * @property string $per_domicilio_num
 * @property string $per_domicilio_ref
 * 
 * @property string $usu_user
 * @property string $usu_password
 * 
 * @property UsuaGrolEper[] $usuaGrolsEper
 * @property Persona $per
 *
 */

class Profesor extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'profesor';
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
            [['per_id', 'pro_estado','pro_estado_logico'], 'required'],            
            [['pro_fecha_creacion','pro_fecha_modificacion'], 'safe'],            
            [['pro_estado_logico','pro_estado'], 'string', 'max' => 1],
            [['per_id'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['per_id' => 'per_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'pro_id' => 'Pro ID',
            'per_id' => 'Per ID',
            'pro_usuario_ingreso' => 'Pro Usuario Ingreso',
            'pro_usuario_modifica' => 'Pro Usuario Modifica',
            'pro_estado' => 'Pro Estado',
            'pro_fecha_creacion' => 'Pro Fecha Creacion',
            'pro_fecha_modificacion' => 'Pro Fecha Modificacion',
            'pro_estado_logico' => 'Pro Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    
    function getAllProfesorGrid($search = NULL){
        $con_asgard = \Yii::$app->db_asgard;
        $con_academico = \Yii::$app->db_academico;
        $search_cond = "%" . $search . "%";
        $condition = "";
        $str_search = "";

        if (isset($search)) {
            $str_search = "(pe.per_pri_nombre like :search OR ";
            $str_search .= "pe.per_pri_apellido like :search) AND";
        }

        $sql = "SELECT pro.pro_id, pe.per_id,
                    pe.per_pri_nombre as PrimerNombre,
                    pe.per_seg_nombre as SegundoNombre, 
                    pe.per_pri_apellido as PrimerApellido, 
                    pe.per_seg_apellido as SegundoApellido, 
                    pe.per_celular as Celular, 
                    pe.per_correo as Correo, 
                    pe.per_cedula as Cedula
                FROM " . $con_academico->dbname . ".profesor AS pro
                inner JOIN " . $con_asgard->dbname . ".persona as pe on pro.per_id = pe.per_id
                WHERE $str_search pro.pro_estado_logico = 1 and pe.per_estado_logico = 1";
        $comando = $con_academico->createCommand($sql);
        if(isset($search)){
            $comando->bindParam(":search",$search_cond, \PDO::PARAM_STR);
        }
        $res = $comando->queryAll();
        $dataProvider = new ArrayDataProvider([
            'key' => 'Ids',
            'allModels' => $res,
            'pagination' => [
                'pageSize' => Yii::$app->params["pageSize"],
            ],
            'sort' => [
                'attributes' => ['PrimerNombre', 'SegundoNombre',"PrimerApellido","SegundoApellido","Celular","Correo","Cedula"],
            ],
        ]);

        return $dataProvider;
    }
}
