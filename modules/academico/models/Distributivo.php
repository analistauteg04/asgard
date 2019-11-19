<?php

namespace app\modules\academico\models;
use yii\data\ArrayDataProvider;

use Yii;

/**
 * This is the model class for table "distributivo".
 *
 * @property int $dis_id
 * @property int $pro_id
 * @property int $asi_id
 * @property int $saca_id
 * @property string $dis_estado
 * @property string $dis_fecha_creacion
 * @property string $dis_fecha_modificacion
 * @property string $dis_estado_logico
 *
 * @property SemestreAcademico $saca
 * @property Profesor $pro
 * @property Asignatura $asi
 */
class Distributivo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'distributivo';
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
            [['pro_id', 'asi_id', 'saca_id', 'dis_estado', 'dis_estado_logico'], 'required'],
            [['pro_id', 'asi_id', 'saca_id'], 'integer'],
            [['dis_fecha_creacion', 'dis_fecha_modificacion'], 'safe'],
            [['dis_estado', 'dis_estado_logico'], 'string', 'max' => 1],
            [['saca_id'], 'exist', 'skipOnError' => true, 'targetClass' => SemestreAcademico::className(), 'targetAttribute' => ['saca_id' => 'saca_id']],
            [['pro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profesor::className(), 'targetAttribute' => ['pro_id' => 'pro_id']],
            [['asi_id'], 'exist', 'skipOnError' => true, 'targetClass' => Asignatura::className(), 'targetAttribute' => ['asi_id' => 'asi_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'dis_id' => 'Dis ID',
            'pro_id' => 'Pro ID',
            'asi_id' => 'Asi ID',
            'saca_id' => 'Saca ID',
            'dis_estado' => 'Dis Estado',
            'dis_fecha_creacion' => 'Dis Fecha Creacion',
            'dis_fecha_modificacion' => 'Dis Fecha Modificacion',
            'dis_estado_logico' => 'Dis Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaca()
    {
        return $this->hasOne(SemestreAcademico::className(), ['saca_id' => 'saca_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPro()
    {
        return $this->hasOne(Profesor::className(), ['pro_id' => 'pro_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsi()
    {
        return $this->hasOne(Asignatura::className(), ['asi_id' => 'asi_id']);
    }
    
     /**
     * Function Obtiene información de distributivo.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function consultarDistributivo() {
        $con = \Yii::$app->db_academico;
        $con1 = \Yii::$app->db_asgard;
        $estado = 1;
        
        $sql = "SELECT d.dis_id,
                p.pro_id,
                per.per_cedula,
                per.per_pri_nombre,
                per.per_seg_nombre,
                per.per_pri_apellido,
                per.per_seg_apellido,
                concat(per.per_pri_nombre,per.per_pri_apellido) as docente,
                d.asi_id,
                a.asi_nombre as asignatura,
                ua.uaca_nombre as unidad,
                dd.ddoc_nombre as dedicacion
         FROM ". $con->dbname . ".distributivo d inner join ". $con->dbname . ".profesor p on p.pro_id = d.pro_id
         inner join ". $con1->dbname . ".persona per on per.per_id = p.per_id
         inner join ". $con->dbname . ".asignatura a on a.asi_id = d.asi_id
         inner join ". $con->dbname . ".unidad_academica ua on ua.uaca_id = a.uaca_id 
         inner join ". $con->dbname . ".dedicacion_docente dd on dd.ddoc_id = p.ddoc_id 
         WHERE d.dis_estado = '1'
               and d.dis_estado_logico = '1'
               and p.pro_estado = '1'
               and p.pro_estado_logico = '1'
               and per.per_estado = '1'
               and per.per_estado_logico = '1'
               and a.asi_estado = '1'
               and a.asi_estado_logico = '1'
               and ua.uaca_estado = '1'
               and ua.uaca_estado_logico = '1'
               and dd.ddoc_estado = '1'
               and dd.ddoc_estado_logico = '1'";
                
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $resultData = $comando->queryAll();
        $dataProvider = new ArrayDataProvider([
            'key' => 'id',
            'allModels' => $resultData,
            'pagination' => [
                'pageSize' => Yii::$app->params["pageSize"],
            ],
            'sort' => [
                'attributes' => [],
            ],
        ]);        
        return $dataProvider;        
    }    
}
