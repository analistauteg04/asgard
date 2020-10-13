<?php

namespace app\modules\gpr\models;

use Yii;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\base\Exception;

/**
 * This is the model class for table "unidad_gpr".
 *
 * @property int $ugpr_id
 * @property int $ent_id
 * @property string $ugpr_nombre
 * @property string $ugpr_descripcion
 * @property int $ugpr_usuario_ingreso
 * @property int|null $ugpr_usuario_modifica
 * @property string $ugpr_estado
 * @property string $ugpr_fecha_creacion
 * @property string|null $ugpr_fecha_modificacion
 * @property string $ugpr_estado_logico
 *
 * @property SubunidadGpr[] $subunidadGprs
 * @property Entidad $ent
 */
class UnidadGpr extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'unidad_gpr';
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
            [['ent_id', 'ugpr_nombre', 'ugpr_descripcion', 'ugpr_usuario_ingreso', 'ugpr_estado', 'ugpr_estado_logico'], 'required'],
            [['ent_id', 'ugpr_usuario_ingreso', 'ugpr_usuario_modifica'], 'integer'],
            [['ugpr_fecha_creacion', 'ugpr_fecha_modificacion'], 'safe'],
            [['ugpr_nombre'], 'string', 'max' => 300],
            [['ugpr_descripcion'], 'string', 'max' => 500],
            [['ugpr_estado', 'ugpr_estado_logico'], 'string', 'max' => 1],
            [['ent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Entidad::className(), 'targetAttribute' => ['ent_id' => 'ent_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ugpr_id' => 'Ugpr ID',
            'ent_id' => 'Ent ID',
            'ugpr_nombre' => 'Ugpr Nombre',
            'ugpr_descripcion' => 'Ugpr Descripcion',
            'ugpr_usuario_ingreso' => 'Ugpr Usuario Ingreso',
            'ugpr_usuario_modifica' => 'Ugpr Usuario Modifica',
            'ugpr_estado' => 'Ugpr Estado',
            'ugpr_fecha_creacion' => 'Ugpr Fecha Creacion',
            'ugpr_fecha_modificacion' => 'Ugpr Fecha Modificacion',
            'ugpr_estado_logico' => 'Ugpr Estado Logico',
        ];
    }

    /**
     * Gets query for [[SubunidadGprs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubunidadGprs()
    {
        return $this->hasMany(SubunidadGpr::className(), ['ugpr_id' => 'ugpr_id']);
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

    public function getAllUnidadGprGrid($search = NULL, $categoria = NULL, $entidad = NULL, $dataProvider = false){
        $search_cond = "%".$search."%";
        $str_search = "";
        $con = Yii::$app->db_gpr;
        if(isset($search)){
            $str_search  = "(u.ugpr_nombre like :search OR ";
            $str_search .= "u.ugpr_descripcion like :search OR ";
            $str_search .= "e.ent_nombre like :search OR ";
            $str_search .= "c.cat_nombre like :search) AND ";
        }
        if(isset($categoria) && $categoria > 0){
            $str_search .= "c.cat_id = :categoria AND ";
        }
        if(isset($entidad) && $entidad > 0){
            $str_search .= "e.ent_id = :entidad AND ";
        }
        $sql = "SELECT 
                    u.ugpr_id as id,
                    u.ugpr_nombre as Nombre,
                    u.ugpr_descripcion as Descripcion,
                    e.ent_nombre as Entidad,
                    c.cat_nombre as Categoria,
                    u.ugpr_estado as Estado
                FROM 
                    ".$con->dbname.".unidad_gpr as u
                    INNER JOIN ".$con->dbname.".entidad as e ON e.ent_id = u.ent_id
                    INNER JOIN ".$con->dbname.".categoria as c ON c.cat_id = e.cat_id
                WHERE 
                    $str_search
                    u.ugpr_estado_logico=1 AND
                    e.ent_estado_logico=1 AND
                    c.cat_estado_logico=1
                ORDER BY u.ugpr_id;";
        $comando = Yii::$app->db->createCommand($sql);
        if(isset($search)){
            $comando->bindParam(":search",$search_cond, \PDO::PARAM_STR);
        }
        if(isset($categoria) && $categoria > 0){
            $comando->bindParam(":categoria",$categoria, \PDO::PARAM_INT);
        }
        if(isset($entidad) && $entidad > 0){
            $comando->bindParam(":entidad",$entidad, \PDO::PARAM_INT);
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
                    'attributes' => ['Nombre', 'Estado', 'Descripcion', 'Entidad', 'Categoria'],
                ],
            ]);
            return $dataProvider;
        }
        return $res;
    }
}
