<?php

namespace app\modules\academico\models;

use Yii;
use yii\data\ArrayDataProvider;

/**
 * This is the model class for table "diploma".
 *
 * @property int $dip_id
 * @property string $dip_codigo
 * @property string $dip_nombres
 * @property string $dip_apellidos
 * @property string $dip_cedula
 * @property string $dip_carrera
 * @property string $dip_modalidad
 * @property string $dip_programa
 * @property string $dip_fecha_inicio
 * @property string $dip_fecha_fin
 * @property string $dip_horas
 * @property string $dip_estado
 * @property string $dip_descargado
 * @property string $dip_fecha_creacion
 * @property string $dip_fecha_modificacion
 * @property string $dip_estado_logico
 */
class Diploma extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'diploma';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_academico');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dip_nombres', 'dip_apellidos', 'dip_estado', 'dip_estado_logico'], 'required'],
            [['dip_fecha_inicio', 'dip_fecha_fin', 'dip_fecha_creacion', 'dip_fecha_modificacion'], 'safe'],
            [['dip_codigo', 'dip_nombres', 'dip_apellidos', 'dip_horas'], 'string', 'max' => 100],
            [['dip_cedula'], 'string', 'max' => 10],
            [['dip_carrera'], 'string', 'max' => 150],
            [['dip_modalidad'], 'string', 'max' => 50],
            [['dip_programa'], 'string', 'max' => 200],
            [['dip_estado', 'dip_estado_logico', 'dip_descargado'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'dip_id' => 'Dip ID',
            'dip_codigo' => 'Dip Codigo',
            'dip_nombres' => 'Dip Nombres',
            'dip_apellidos' => 'Dip Apellidos',
            'dip_cedula' => 'Dip Cedula',
            'dip_carrera' => 'Dip Carrera',
            'dip_modalidad' => 'Dip Modalidad',
            'dip_programa' => 'Dip Programa',
            'dip_fecha_inicio' => 'Dip Fecha Inicio',
            'dip_fecha_fin' => 'Dip Fecha Fin',
            'dip_horas' => 'Dip Horas',
            'dip_estado' => 'Dip Estado',
            'dip_descargado' => 'Dip Downloaded',
            'dip_fecha_creacion' => 'Dip Fecha Creacion',
            'dip_fecha_modificacion' => 'Dip Fecha Modificacion',
            'dip_estado_logico' => 'Dip Estado Logico',
        ];
    }

    function getAllDiplomasGrid($search = NULL, $onlyData = false){
        $con_academico = \Yii::$app->db_academico;
        $search_cond = "%" . $search . "%";
        $condition = "";
        $str_search = "";

        if (isset($search) && $search != "") {
            $str_search = "(d.dip_nombres like :search OR ";
            $str_search .= "d.dip_apellidos like :search OR ";
            $str_search .= "d.dip_cedula like :search) AND ";
        }

        $sql = "SELECT 
                    d.dip_id AS Id, 
                    d.dip_nombres AS Nombres,
                    d.dip_apellidos AS Apellidos,
                    d.dip_cedula AS Cedula,
                    d.dip_carrera AS Carrera,
                    d.dip_modalidad AS Modalidad,
                    d.dip_programa AS Programa,
                    d.dip_fecha_inicio AS FechaInicio,
                    d.dip_fecha_fin AS FechaFin,
                    d.dip_horas AS Horas,
                    d.dip_descargado AS Descarga
                FROM " . $con_academico->dbname . ".diploma AS d
                WHERE $str_search d.dip_estado_logico = 1 and d.dip_estado_logico = 1";
        $comando = $con_academico->createCommand($sql);
        if(isset($search)){
            $comando->bindParam(":search",$search_cond, \PDO::PARAM_STR);
        }
        $res = $comando->queryAll();
        if($onlyData)   return $res;
        $dataProvider = new ArrayDataProvider([
            'key' => 'Id',
            'allModels' => $res,
            'pagination' => [
                'pageSize' => Yii::$app->params["pageSize"],
            ],
            'sort' => [
                'attributes' => ['Nombres', 'Apellidos',"Cedula","Carrera","Modalidad","Programa"],
            ],
        ]);

        return $dataProvider;
    }
}
