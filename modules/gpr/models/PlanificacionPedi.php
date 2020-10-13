<?php

namespace app\modules\gpr\models;

use Yii;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\base\Exception;

/**
 * This is the model class for table "planificacion_pedi".
 *
 * @property int $pped_id
 * @property int $ent_id
 * @property string $pped_nombre
 * @property string $pped_descripcion
 * @property string|null $pped_fecha_inicio
 * @property string|null $pped_fecha_fin
 * @property string|null $pped_fecha_actualizacion
 * @property string $pped_estado_cierre
 * @property int $pped_usuario_ingreso
 * @property int|null $pped_usuario_modifica
 * @property string $pped_estado
 * @property string $pped_fecha_creacion
 * @property string|null $pped_fecha_modificacion
 * @property string $pped_estado_logico
 *
 * @property ObjetivoEstrategico[] $objetivoEstrategicos
 * @property Entidad $ent
 * @property PlanificacionPoa[] $planificacionPoas
 */
class PlanificacionPedi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'planificacion_pedi';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_gpr');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ent_id', 'pped_nombre', 'pped_descripcion', 'pped_usuario_ingreso', 'pped_estado', 'pped_estado_logico'], 'required'],
            [['ent_id', 'pped_usuario_ingreso', 'pped_usuario_modifica'], 'integer'],
            [['pped_fecha_inicio', 'pped_fecha_fin', 'pped_fecha_actualizacion', 'pped_fecha_creacion', 'pped_fecha_modificacion'], 'safe'],
            [['pped_nombre'], 'string', 'max' => 300],
            [['pped_descripcion'], 'string', 'max' => 500],
            [['pped_estado_cierre', 'pped_estado', 'pped_estado_logico'], 'string', 'max' => 1],
            [['ent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Entidad::className(), 'targetAttribute' => ['ent_id' => 'ent_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pped_id' => 'Pped ID',
            'ent_id' => 'Ent ID',
            'pped_nombre' => 'Pped Nombre',
            'pped_descripcion' => 'Pped Descripcion',
            'pped_fecha_inicio' => 'Pped Fecha Inicio',
            'pped_fecha_fin' => 'Pped Fecha Fin',
            'pped_fecha_actualizacion' => 'Pped Fecha Actualizacion',
            'pped_estado_cierre' => 'Pped Estado Cierre',
            'pped_usuario_ingreso' => 'Pped Usuario Ingreso',
            'pped_usuario_modifica' => 'Pped Usuario Modifica',
            'pped_estado' => 'Pped Estado',
            'pped_fecha_creacion' => 'Pped Fecha Creacion',
            'pped_fecha_modificacion' => 'Pped Fecha Modificacion',
            'pped_estado_logico' => 'Pped Estado Logico',
        ];
    }

    /**
     * Gets query for [[ObjetivoEstrategicos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getObjetivoEstrategicos()
    {
        return $this->hasMany(ObjetivoEstrategico::className(), ['pped_id' => 'pped_id']);
    }

    /**
     * Gets query for [[Ent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEnt()
    {
        return $this->hasOne(Entidad::className(), ['ent_id' => 'ent_id']);
    }

    /**
     * Gets query for [[PlanificacionPoas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlanificacionPoas()
    {
        return $this->hasMany(PlanificacionPoa::className(), ['pped_id' => 'pped_id']);
    }

    public function getAllPlanPediGrid($search = NULL, $entidad = NULL, $cierre = NULL, $dataProvider = false){
        $search_cond = "%".$search."%";
        $str_search = "";
        $con = Yii::$app->db_gpr;
        if(isset($search)){
            $str_search  = "(p.pped_nombre like :search OR ";
            $str_search .= "p.pped_descripcion like :search OR ";
            $str_search .= "e.ent_nombre like :search) AND ";
        }
        if(isset($entidad) && $entidad > 0){
            $str_search .= "e.ent_id = :entidad AND ";
        }
        if(isset($cierre) && $cierre >= 0){
            $str_search .= "p.pped_estado_cierre = :cierre AND ";
        }
        $sql = "SELECT 
                    p.pped_id as id,
                    p.pped_nombre as Nombre,
                    p.pped_descripcion as Descripcion,
                    e.ent_nombre as Entidad,
                    p.pped_fecha_inicio as FechaInicio,
                    p.pped_fecha_fin as FechaFin,
                    p.pped_fecha_actualizacion as FechaActualizacion,
                    p.pped_estado_cierre as Cierre,
                    p.pped_estado as Estado
                FROM 
                    ".$con->dbname.".planificacion_pedi as p
                    INNER JOIN ".$con->dbname.".entidad as e ON e.ent_id = p.ent_id
                WHERE 
                    $str_search
                    p.pped_estado_logico=1 
                ORDER BY p.pped_id desc;";
        $comando = Yii::$app->db->createCommand($sql);
        if(isset($search)){
            $comando->bindParam(":search",$search_cond, \PDO::PARAM_STR);
        }
        if(isset($entidad) && $entidad > 0){
            $comando->bindParam(":entidad",$entidad, \PDO::PARAM_INT);
        }
        if(isset($cierre) && $cierre >= 0){
            $comando->bindParam(":cierre",$cierre, \PDO::PARAM_STR);
        }
        $res = $comando->queryAll();
        if($dataProvider){
            $dataProvider = new ArrayDataProvider([
                'key' => 'id',
                'allModels' => $res,
                'pagination' => [
                    'pageSize' => Yii::$app->params["pageSize"],
                ],
                'sort' => [
                    'attributes' => ['Nombre', 'Estado', 'Descripcion'],
                ],
            ]);
            return $dataProvider;
        }
        return $res;
    }
}
