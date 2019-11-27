<?php

namespace app\modules\academico\models;

use Yii;
use yii\data\ArrayDataProvider;

/**
 * This is the model class for table "profesor_publicacion".
 *
 * @property int $ppub_id
 * @property int $pro_id
 * @property string $ppub_produccion
 * @property string $ppub_titulo
 * @property string $ppub_editorial
 * @property string $ppub_isbn
 * @property string $ppub_autoria
 * @property int $ppub_usuario_ingreso
 * @property int $ppub_usuario_modifica
 * @property string $ppub_estado
 * @property string $ppub_fecha_creacion
 * @property string $ppub_fecha_modificacion
 * @property string $ppub_estado_logico
 *
 * @property Profesor $pro
 */
class ProfesorPublicacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profesor_publicacion';
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
            [['pro_id', 'ppub_produccion', 'ppub_titulo', 'ppub_editorial', 'ppub_isbn', 'ppub_autoria', 'ppub_usuario_ingreso', 'ppub_estado', 'ppub_estado_logico'], 'required'],
            [['pro_id', 'ppub_usuario_ingreso', 'ppub_usuario_modifica'], 'integer'],
            [['ppub_fecha_creacion', 'ppub_fecha_modificacion'], 'safe'],
            [['ppub_produccion'], 'string', 'max' => 100],
            [['ppub_titulo', 'ppub_autoria'], 'string', 'max' => 200],
            [['ppub_editorial', 'ppub_isbn'], 'string', 'max' => 50],
            [['ppub_estado', 'ppub_estado_logico'], 'string', 'max' => 1],
            [['pro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profesor::className(), 'targetAttribute' => ['pro_id' => 'pro_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ppub_id' => 'Ppub ID',
            'pro_id' => 'Pro ID',
            'ppub_produccion' => 'Ppub Produccion',
            'ppub_titulo' => 'Ppub Titulo',
            'ppub_editorial' => 'Ppub Editorial',
            'ppub_isbn' => 'Ppub Isbn',
            'ppub_autoria' => 'Ppub Autoria',
            'ppub_usuario_ingreso' => 'Ppub Usuario Ingreso',
            'ppub_usuario_modifica' => 'Ppub Usuario Modifica',
            'ppub_estado' => 'Ppub Estado',
            'ppub_fecha_creacion' => 'Ppub Fecha Creacion',
            'ppub_fecha_modificacion' => 'Ppub Fecha Modificacion',
            'ppub_estado_logico' => 'Ppub Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPro()
    {
        return $this->hasOne(Profesor::className(), ['pro_id' => 'pro_id']);
    }

    function getAllPublicacionGrid($pro_id){
        $con_academico = \Yii::$app->db_academico;
        $sql = "SELECT 
                    p.ppub_id as Ids,
                    pro.pro_id,
                    pro.per_id,
                    p.ppub_produccion as TipoProduccion,
                    p.ppub_titulo as Titulo,
                    p.ppub_editorial as Editorial, 
                    p.ppub_isbn as ISBN, 
                    p.ppub_autoria as Autor
                FROM " . $con_academico->dbname . ".profesor AS pro
                inner JOIN " . $con_academico->dbname . ".profesor_publicacion as p on pro.pro_id = p.pro_id
                WHERE pro.pro_estado_logico = 1 and pro.pro_estado = 1 and p.ppub_estado_logico = 1 
                and p.ppub_estado = 1 and pro.pro_id =:proId";
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
                'attributes' => ['TipoProduccion', 'Titulo',"Editorial","ISBN","Autor"],
            ],
        ]);

        return $dataProvider;
    }
}
