<?php

namespace app\modules\academico\models;

use Yii;
use yii\data\ArrayDataProvider;

/**
 * This is the model class for table "profesor_idiomas".
 *
 * @property int $pidi_id
 * @property int $pro_id
 * @property int $idi_id
 * @property string $pidi_nivel_escrito
 * @property string $pidi_nivel_oral
 * @property string $pidi_certificado
 * @property string $pidi_institucion
 * @property int $pidi_usuario_ingreso
 * @property int $pidi_usuario_modifica
 * @property string $pidi_estado
 * @property string $pidi_fecha_creacion
 * @property string $pidi_fecha_modificacion
 * @property string $pidi_estado_logico
 *
 * @property Profesor $pro
 */
class ProfesorIdiomas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profesor_idiomas';
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
            [['pro_id', 'idi_id', 'pidi_nivel_escrito', 'pidi_nivel_oral', 'pidi_certificado', 'pidi_institucion', 'pidi_usuario_ingreso', 'pidi_estado', 'pidi_estado_logico'], 'required'],
            [['pro_id', 'idi_id', 'pidi_usuario_ingreso', 'pidi_usuario_modifica'], 'integer'],
            [['pidi_fecha_creacion', 'pidi_fecha_modificacion'], 'safe'],
            [['pidi_nivel_escrito', 'pidi_certificado', 'pidi_institucion'], 'string', 'max' => 200],
            [['pidi_nivel_oral'], 'string', 'max' => 100],
            [['pidi_estado', 'pidi_estado_logico'], 'string', 'max' => 1],
            [['pro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profesor::className(), 'targetAttribute' => ['pro_id' => 'pro_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pidi_id' => 'Pidi ID',
            'pro_id' => 'Pro ID',
            'idi_id' => 'Idi ID',
            'pidi_nivel_escrito' => 'Pidi Nivel Escrito',
            'pidi_nivel_oral' => 'Pidi Nivel Oral',
            'pidi_certificado' => 'Pidi Certificado',
            'pidi_institucion' => 'Pidi Institucion',
            'pidi_usuario_ingreso' => 'Pidi Usuario Ingreso',
            'pidi_usuario_modifica' => 'Pidi Usuario Modifica',
            'pidi_estado' => 'Pidi Estado',
            'pidi_fecha_creacion' => 'Pidi Fecha Creacion',
            'pidi_fecha_modificacion' => 'Pidi Fecha Modificacion',
            'pidi_estado_logico' => 'Pidi Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPro()
    {
        return $this->hasOne(Profesor::className(), ['pro_id' => 'pro_id']);
    }

    public function getIdiomas($search = NULL, $dataProvider = false){
        $iduser = Yii::$app->session->get('PB_iduser', FALSE);
        $search_cond = "%".$search."%";
        $str_search = "";
        if(isset($search)){
            $str_search = "(idi_nombre like :search AND ";
        }
        $sql = "SELECT
                    idi_id AS id,
                    idi_nombre AS nombre
                FROM
                    idioma
                WHERE
                    $str_search
                    idi_estado_logico = 1
                    AND idi_estado_logico = 1
                ORDER BY idi_id;";
        $comando = Yii::$app->db_general->createCommand($sql);
        if(isset($search)){
            $comando->bindParam(":search",$search_cond, \PDO::PARAM_STR);
        }
        $res = $comando->queryAll();
        if($dataProvider){
            $dataProvider = new ArrayDataProvider([
                'key' => 'idi_id',
                'allModels' => $res,
                'pagination' => [
                    'pageSize' => Yii::$app->params["pageSize"],
                ],
                'sort' => [
                    'attributes' => ['nombre'],
                ],
            ]);
            return $dataProvider;
        }
        return $res;
    }

    function getAllIdiomasGrid($pro_id){
        $con_academico = \Yii::$app->db_academico;
        $con_general = \Yii::$app->db_general;
        $sql = "SELECT 
                    p.pidi_id as Ids,
                    pro.pro_id,
                    pro.per_id,
                    i.idi_id,
                    p.pidi_nivel_escrito as NivelEscrito,
                    p.pidi_nivel_oral as NivelOral,
                    p.pidi_certificado as Certificado, 
                    p.pidi_institucion as Institucion, 
                    i.idi_nombre as Languages
                FROM " . $con_academico->dbname . ".profesor AS pro
                inner JOIN " . $con_academico->dbname . ".profesor_idiomas as p on pro.pro_id = p.pro_id
                inner JOIN " . $con_general->dbname . ".idioma as i on p.idi_id = i.idi_id
                WHERE pro.pro_estado_logico = 1 and pro.pro_estado = 1 and p.pidi_estado_logico = 1 
                and p.pidi_estado = 1 and pro.pro_id =:proId";
        $comando = $con_academico->createCommand($sql);
        $comando->bindParam(':proId', $pro_id, \PDO::PARAM_INT);
        $res = $comando->queryAll();
        $dataProvider = new ArrayDataProvider([
            'key' => 'Ids',
            'allModels' => $res,
            'pagination' => [
                'pageSize' => Yii::$app->params["pageSize"],
            ],
            'sort' => [
                'attributes' => ['NivelEscrito', 'NivelOral',"Certificado","Institucion","Languages"],
            ],
        ]);

        return $dataProvider;
    }
}
