<?php

namespace app\modules\academico\models;

use yii\data\ArrayDataProvider;
use Yii;

/**
 * This is the model class for table "distributivo_cabecera".
 *
 * @property int $dcab_id
 * @property int $paca_id
 * @property int $pro_id
 * @property string $dcab_estado_aprobacion
 * @property string $dcab_fecha_aprobacion
 * @property int $dcab_usuario_aprobacion
 * @property string $dcab_fecha_registro
 * @property int $dcab_usuario_ingreso
 * @property int $dcab_usuario_modifica
 * @property string $dcab_estado
 * @property string $dcab_fecha_creacion
 * @property string $dcab_fecha_modificacion
 * @property string $dcab_estado_logico
 *
 * @property Profesor $pro
 * @property PeriodoAcademico $paca
 */
class DistributivoCabecera extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'distributivo_cabecera';
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
            [['paca_id', 'pro_id', 'dcab_usuario_aprobacion', 'dcab_usuario_ingreso', 'dcab_usuario_modifica'], 'integer'],
            [['pro_id', 'dcab_usuario_ingreso', 'dcab_estado', 'dcab_estado_logico'], 'required'],
            [['dcab_fecha_aprobacion', 'dcab_fecha_registro', 'dcab_fecha_creacion', 'dcab_fecha_modificacion'], 'safe'],
            [['dcab_estado_aprobacion', 'dcab_estado', 'dcab_estado_logico'], 'string', 'max' => 1],
            [['pro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profesor::className(), 'targetAttribute' => ['pro_id' => 'pro_id']],
            [['paca_id'], 'exist', 'skipOnError' => true, 'targetClass' => PeriodoAcademico::className(), 'targetAttribute' => ['paca_id' => 'paca_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'dcab_id' => 'Dcab ID',
            'paca_id' => 'Paca ID',
            'pro_id' => 'Pro ID',
            'dcab_estado_aprobacion' => 'Dcab Estado Aprobacion',
            'dcab_fecha_aprobacion' => 'Dcab Fecha Aprobacion',
            'dcab_usuario_aprobacion' => 'Dcab Usuario Aprobacion',
            'dcab_fecha_registro' => 'Dcab Fecha Registro',
            'dcab_usuario_ingreso' => 'Dcab Usuario Ingreso',
            'dcab_usuario_modifica' => 'Dcab Usuario Modifica',
            'dcab_estado' => 'Dcab Estado',
            'dcab_fecha_creacion' => 'Dcab Fecha Creacion',
            'dcab_fecha_modificacion' => 'Dcab Fecha Modificacion',
            'dcab_estado_logico' => 'Dcab Estado Logico',
        ];
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
    public function getPaca()
    {
        return $this->hasOne(PeriodoAcademico::className(), ['paca_id' => 'paca_id']);
    }
    
    public function getListadoDistributivoCab($search = NULL, $periodoAcademico = NULL, $estado_aprobacion = NULL, $onlyData = false){
        $con_academico = \Yii::$app->db_academico;
        $con_db = \Yii::$app->db;
        $search_cond = "%" . $search . "%";
        $estado = "1";
        $str_search = "";        
        $str_periodo = "";
        
        // array("0" => "Todos", "1" => "(M) Matutino", "2" => "(N) Nocturno", "3" => "(S) Semipresencial", "4" => "(D) Distancia")

        if (isset($search) && $search != "") {
            $str_search = "(pe.per_pri_nombre like :search OR ";
            $str_search .= "pe.per_pri_apellido like :search OR ";
            $str_search .= "pe.per_cedula like :search) AND ";
        }
        
        if (isset($periodoAcademico) && $periodoAcademico > 0) {
            $str_periodo = "pa.paca_id = :periodo AND ";
        }        
        if (isset($estado_aprobacion) && $estado_aprobacion > 0) {
            $str_estado_probacion = "da.dcab_estado_aprobacion = :estado_aprobacion AND ";
        }   
        if (!$onlyData) {
            $select = " da.dcab_id AS Id,";
        }
        $sql = "SELECT 
                    $select
                    CONCAT(pe.per_pri_nombre, ' ', pe.per_pri_apellido) AS Nombres,
                    pe.per_cedula AS Cedula,                    
                    ifnull(CONCAT(blq.baca_anio,' (',blq.baca_nombre,'-',sem.saca_nombre,')'),blq.baca_anio) AS Periodo,                    
                    CASE
                        WHEN da.dcab_estado_aprobacion = 1 THEN 'Por aprobar'
                        WHEN da.dcab_estado_aprobacion = 2 THEN 'Aprobado'
                        ELSE 'No Aprobado'
                    END AS estado
                   
                FROM 
                    " . $con_academico->dbname . ".distributivo_cabecera AS da                     
                    INNER JOIN " . $con_academico->dbname . ".profesor AS p ON da.pro_id = p.pro_id                    
                    INNER JOIN " . $con_academico->dbname . ".periodo_academico AS pa ON da.paca_id = pa.paca_id
                    INNER JOIN " . $con_db->dbname . ".persona AS pe ON p.per_id = pe.per_id
                    LEFT JOIN " . $con_academico->dbname . ".semestre_academico sem  ON sem.saca_id = pa.saca_id 
                    LEFT JOIN " . $con_academico->dbname . ".bloque_academico blq ON blq.baca_id = pa.baca_id
                WHERE 
                    $str_search                    
                    $str_periodo    
                    $str_estado_probacion
                    pa.paca_activo = 'A' AND
                    pa.paca_estado = :estado AND
                    da.dcab_estado_logico = :estado AND 
                    da.dcab_estado = :estado AND
                    p.pro_estado_logico = :estado AND 
                    p.pro_estado = :estado AND                    
                    pa.paca_estado_logico = :estado";
                    
        $comando = $con_academico->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        if (isset($search) && $search != "") {
            $comando->bindParam(":search", $search_cond, \PDO::PARAM_STR);
        }        
        if (isset($periodoAcademico) && $periodoAcademico != "") {
            $comando->bindParam(":periodo", $periodoAcademico, \PDO::PARAM_INT);
        }
        if (isset($estado_aprobacion) && $estado_aprobacion != "") {
            $comando->bindParam(":estado_aprobacion", $estado_aprobacion, \PDO::PARAM_INT);
        }

        $res = $comando->queryAll();
        if ($onlyData)
            return $res;
        $dataProvider = new ArrayDataProvider([
            'key' => 'Id',
            'allModels' => $res,
            'pagination' => [
                'pageSize' => Yii::$app->params["pageSize"],
            ],
            'sort' => [
                'attributes' => ['Nombres', "Cedula", "Periodo"],
            ],
        ]);

        return $dataProvider;
    }
}
