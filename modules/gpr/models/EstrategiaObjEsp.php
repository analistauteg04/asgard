<?php

namespace app\modules\gpr\models;

use Yii;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\base\Exception;

/**
 * This is the model class for table "estrategia_objespe".
 *
 * @property int $eoep_id
 * @property int $oesp_id
 * @property string $eoep_nombre
 * @property string $eoep_descripcion
 * @property int $eoep_usuario_ingreso
 * @property int|null $eoep_usuario_modifica
 * @property string $eoep_estado
 * @property string $eoep_fecha_creacion
 * @property string|null $eoep_fecha_modificacion
 * @property string $eoep_estado_logico
 *
 * @property ObjetivoEspecifico $oesp
 */
class EstrategiaObjEsp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estrategia_objespe';
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
            [['oesp_id', 'eoep_nombre', 'eoep_descripcion', 'eoep_usuario_ingreso', 'eoep_estado', 'eoep_estado_logico'], 'required'],
            [['oesp_id', 'eoep_usuario_ingreso', 'eoep_usuario_modifica'], 'integer'],
            [['eoep_fecha_creacion', 'eoep_fecha_modificacion'], 'safe'],
            [['eoep_nombre'], 'string', 'max' => 300],
            [['eoep_descripcion'], 'string', 'max' => 500],
            [['eoep_estado', 'eoep_estado_logico'], 'string', 'max' => 1],
            [['oesp_id'], 'exist', 'skipOnError' => true, 'targetClass' => ObjetivoEspecifico::className(), 'targetAttribute' => ['oesp_id' => 'oesp_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'eoep_id' => 'Eoep ID',
            'oesp_id' => 'Oesp ID',
            'eoep_nombre' => 'Eoep Nombre',
            'eoep_descripcion' => 'Eoep Descripcion',
            'eoep_usuario_ingreso' => 'Eoep Usuario Ingreso',
            'eoep_usuario_modifica' => 'Eoep Usuario Modifica',
            'eoep_estado' => 'Eoep Estado',
            'eoep_fecha_creacion' => 'Eoep Fecha Creacion',
            'eoep_fecha_modificacion' => 'Eoep Fecha Modificacion',
            'eoep_estado_logico' => 'Eoep Estado Logico',
        ];
    }

    /**
     * Gets query for [[Oesp]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOesp()
    {
        return $this->hasOne(ObjetivoEspecifico::className(), ['oesp_id' => 'oesp_id']);
    }

    public function getAllEstrategiasEspGrid($search = NULL, $objetivo = NULL, $dataProvider = false){
        $search_cond = "%".$search."%";
        $str_search = "";
        $con = Yii::$app->db_gpr;
        if(isset($search)){
            $str_search  = "(es.eoep_nombre like :search OR ";
            $str_search .= "es.eoep_descripcion like :search) AND ";
        }
        if(isset($objetivo) && $objetivo > 0){
            $str_search .= "oe.oesp_id = :objetivo AND ";
        }
        $sql = "SELECT 
                    es.eoep_id as id,
                    es.eoep_nombre as Nombre,
                    es.eoep_descripcion as Descripcion,
                    oe.oesp_nombre as Objetivo,
                    es.eoep_estado as Estado
                FROM 
                    ".$con->dbname.".estrategia_objespe as es
                    INNER JOIN ".$con->dbname.".objetivo_especifico as oe ON oe.oesp_id = es.oesp_id
                    INNER JOIN ".$con->dbname.".objetivo_estrategico as ob ON ob.oest_id = oe.oest_id
                    INNER JOIN ".$con->dbname.".planificacion_pedi AS pl ON pl.pped_id = ob.pped_id
                    INNER JOIN ".$con->dbname.".entidad AS ent ON ent.ent_id = pl.ent_id
                WHERE 
                    $str_search
                    oe.oesp_estado_logico=1 AND
                    oe.oesp_estado=1 AND
                    es.eoep_estado_logico=1 
                ORDER BY es.eoep_id;";
        $comando = Yii::$app->db->createCommand($sql);
        if(isset($search)){
            $comando->bindParam(":search",$search_cond, \PDO::PARAM_STR);
        }
        if(isset($objetivo) && $objetivo > 0){
            $comando->bindParam(":objetivo",$objetivo, \PDO::PARAM_INT);
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
