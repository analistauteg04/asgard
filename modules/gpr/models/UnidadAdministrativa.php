<?php

namespace app\modules\gpr\models;

use Yii;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\base\Exception;

/**
 * This is the model class for table "unidad_administrativa".
 *
 * @property int $uadm_id
 * @property int $ent_id
 * @property string $uadm_nombre
 * @property string $uadm_descripcion
 * @property int $uadm_usuario_ingreso
 * @property int|null $uadm_usuario_modifica
 * @property string $uadm_estado
 * @property string $uadm_fecha_creacion
 * @property string|null $uadm_fecha_modificacion
 * @property string $uadm_estado_logico
 *
 * @property ObjetivoEspecifico[] $objetivoEspecificos
 * @property Entidad $ent
 */
class UnidadAdministrativa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'unidad_administrativa';
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
            [['ent_id', 'uadm_nombre', 'uadm_descripcion', 'uadm_usuario_ingreso', 'uadm_estado', 'uadm_estado_logico'], 'required'],
            [['ent_id', 'uadm_usuario_ingreso', 'uadm_usuario_modifica'], 'integer'],
            [['uadm_fecha_creacion', 'uadm_fecha_modificacion'], 'safe'],
            [['uadm_nombre'], 'string', 'max' => 300],
            [['uadm_descripcion'], 'string', 'max' => 500],
            [['uadm_estado', 'uadm_estado_logico'], 'string', 'max' => 1],
            [['ent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Entidad::className(), 'targetAttribute' => ['ent_id' => 'ent_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'uadm_id' => 'Uadm ID',
            'ent_id' => 'Ent ID',
            'uadm_nombre' => 'Uadm Nombre',
            'uadm_descripcion' => 'Uadm Descripcion',
            'uadm_usuario_ingreso' => 'Uadm Usuario Ingreso',
            'uadm_usuario_modifica' => 'Uadm Usuario Modifica',
            'uadm_estado' => 'Uadm Estado',
            'uadm_fecha_creacion' => 'Uadm Fecha Creacion',
            'uadm_fecha_modificacion' => 'Uadm Fecha Modificacion',
            'uadm_estado_logico' => 'Uadm Estado Logico',
        ];
    }

    /**
     * Gets query for [[ObjetivoEspecificos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getObjetivoEspecificos()
    {
        return $this->hasMany(ObjetivoEspecifico::className(), ['uadm_id' => 'uadm_id']);
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

    public function getAllUnidadAdminGrid($search = NULL, $entidad = NULL, $dataProvider = false){
        $search_cond = "%".$search."%";
        $str_search = "";
        $con = Yii::$app->db_gpr;
        if(isset($search)){
            $str_search  = "(s.uadm_nombre like :search OR ";
            $str_search .= "s.uadm_descripcion like :search) AND ";
        }
        if(isset($entidad) && $entidad > 0){
            $str_search .= "e.ent_id = :entidad AND ";
        }
        $sql = "SELECT 
                    s.uadm_id as id,
                    s.uadm_nombre as Nombre,
                    s.uadm_descripcion as Descripcion,
                    e.ent_nombre as Entidad,
                    s.uadm_estado as Estado
                FROM 
                    ".$con->dbname.".unidad_administrativa as s
                    INNER JOIN ".$con->dbname.".entidad as e ON e.ent_id = s.ent_id
                WHERE 
                    $str_search
                    s.uadm_estado_logico=1 AND
                    e.ent_estado_logico=1 AND
                    e.ent_estado=1
                ORDER BY s.uadm_id;";
        $comando = Yii::$app->db->createCommand($sql);
        if(isset($search)){
            $comando->bindParam(":search",$search_cond, \PDO::PARAM_STR);
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
                    'attributes' => ['Nombre', 'Estado', 'Descripcion', 'Entidad'],
                ],
            ]);
            return $dataProvider;
        }
        return $res;
    }
}
