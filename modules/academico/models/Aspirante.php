<?php

namespace app\modules\academico\models;

use Yii;
use yii\data\ArrayDataProvider;

/**
 * This is the model class for table "aspirante".
 *
 * @property integer $asp_id
 * @property integer $int_id
 * @property string $asp_estado
 * @property string $asp_fecha_creacion
 * @property string $asp_fecha_modificacion
 * @property string $asp_estado_logico
 *
 * @property Interesado $int
 * @property InteresadoEjecutivo[] $interesadoEjecutivos
 */
class Aspirante extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        //return 'aspirante';
        return \Yii::$app->db_captacion->dbname . '.aspirante';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['int_id', 'asp_estado', 'asp_estado_logico'], 'required'],
            [['int_id'], 'integer'],
            [['asp_fecha_creacion', 'asp_fecha_modificacion'], 'safe'],
            [['asp_estado', 'asp_estado_logico'], 'string', 'max' => 1],
            [['int_id'], 'exist', 'skipOnError' => true, 'targetClass' => Interesado::className(), 'targetAttribute' => ['int_id' => 'int_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'asp_id' => 'Asp ID',
            'int_id' => 'Int ID',
            'asp_estado' => 'Asp Estado',
            'asp_fecha_creacion' => 'Asp Fecha Creacion',
            'asp_fecha_modificacion' => 'Asp Fecha Modificacion',
            'asp_estado_logico' => 'Asp Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInt() {
        return $this->hasOne(Interesado::className(), ['int_id' => 'int_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInteresadoEjecutivos() {
        return $this->hasMany(InteresadoEjecutivo::className(), ['asp_id' => 'asp_id']);
    }

    /**
     * Function getAspirantes
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  $resultData (información del aspirante)
     */
    public static function getAspirantes($arrFiltro = array(), $onlyData = false) {
        $con = \Yii::$app->db_captacion;
        $con2 = \Yii::$app->db;
        $con3 = \Yii::$app->db_academico;
        $con1 = \Yii::$app->db_facturacion;
        $estado = 1;
        $columnsAdd = "";
        $estado_opago = "S";

        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $str_search = "(per.per_pri_nombre like :search OR ";
            $str_search .= "per.per_seg_nombre like :search OR ";
            $str_search .= "per.per_pri_apellido like :search OR ";
            $str_search .= "per.per_cedula like :search) AND ";
            // YA NO EXISTE TABLA CARRERA MODICAR 
            if ($arrFiltro['carrera'] != "" && $arrFiltro['carrera'] > 0) {
                $str_search .= "sins.eaca_id = :carrera AND ";
            }
            if ($arrFiltro['f_ini'] != "" && $arrFiltro['f_fin'] != "") {
                $str_search .= "sins.sins_fecha_solicitud >= :fec_ini AND ";
                $str_search .= "sins.sins_fecha_solicitud <= :fec_fin AND ";
            }         
        } else {
            $columnsAdd = "sins.sins_id as solicitud_id,
                    per.per_id as persona, 
                    per.per_pri_nombre as per_pri_nombre, 
                    per.per_seg_nombre as per_seg_nombre,
                    per.per_pri_apellido as per_pri_apellido,
                    per.per_seg_apellido as per_seg_apellido,";
        }

        $sql = "SELECT  distinct lpad(sins.sins_id,4,'0') as solicitud,
                        sins.sins_id,
                        sins.int_id,
                        SUBSTRING(sins.sins_fecha_solicitud,1,10) as sins_fecha_solicitud, 
                        per.per_id as per_id,
                        per.per_cedula as per_dni,
                        per.per_pri_nombre as per_nombres,
                        per.per_pri_apellido as per_apellidos,
                        ming.ming_id, 
                        (
                        CASE 
                        WHEN ming.ming_id = 1 THEN 'CAN'
                        WHEN ming.ming_id = 2 THEN 'EXA'
                        WHEN ming.ming_id = 3 THEN 'HOM'
                        WHEN ming.ming_id = 4 THEN 'PRO'
                        ELSE 'N/A'
                        END) AS abr_metodo,
                        ming.ming_nombre, 
                        sins.eaca_id,
                        car.eaca_nombre as carrera,
                        $columnsAdd                                                             
                        asp.asp_id,                                               
                       (case when sins_beca = 1 then 'ICF' else 'No Aplica' end) as beca 
                FROM " . $con->dbname . ".aspirante asp INNER JOIN " . $con->dbname . ".interesado inte on inte.int_id = asp.int_id                     
                     INNER JOIN " . $con2->dbname . ".persona per on inte.per_id = per.per_id
                     INNER JOIN " . $con->dbname . ".solicitud_inscripcion sins on sins.int_id = inte.int_id
                     INNER JOIN " . $con->dbname . ".metodo_ingreso ming on ming.ming_id = sins.ming_id
                     INNER JOIN " . $con3->dbname . ".estudio_academico car on car.eaca_id = sins.eaca_id
                     INNER JOIN " . $con1->dbname . ".orden_pago opag on opag.sins_id = sins.sins_id                     
                WHERE  
                       $str_search 
                       opag.opag_estado_pago = :estado_opago AND
                       asp.asp_estado_logico = :estado AND
                       asp.asp_estado = :estado AND 
                       inte.int_estado_logico = :estado AND
                       inte.int_estado = :estado AND                       
                       per.per_estado_logico = :estado AND
                       per.per_estado = :estado AND
                       sins.sins_estado = :estado AND
                       sins.sins_estado_logico = :estado AND
                       ming.ming_estado_logico = :estado AND
                       ming.ming_estado = :estado AND
                       car.eaca_estado_logico = :estado AND
                       car.eaca_estado = :estado                         
                ORDER BY SUBSTRING(sins.sins_fecha_solicitud,1,10) desc";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":estado_opago", $estado_opago, \PDO::PARAM_STR);        
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $search_cond = "%" . $arrFiltro["search"] . "%";
            $fecha_ini = $arrFiltro["f_ini"] . " 00:00:00";
            $fecha_fin = $arrFiltro["f_fin"] . " 23:59:59";
            $carrera = $arrFiltro["carrera"];
            $codigocan = "%" . $arrFiltro["codigocan"] . "%";
            $comando->bindParam(":search", $search_cond, \PDO::PARAM_STR);
            if ($arrFiltro['carrera'] != "" && $arrFiltro['carrera'] > 0) {
                $comando->bindParam(":carrera", $carrera, \PDO::PARAM_INT);
            }
            if ($arrFiltro['f_ini'] != "" && $arrFiltro['f_fin'] != "") {
                $comando->bindParam(":fec_ini", $fecha_ini, \PDO::PARAM_STR);
                $comando->bindParam(":fec_fin", $fecha_fin, \PDO::PARAM_STR);
            }
           // $comando->bindParam(":codigocan", $codigocan, \PDO::PARAM_STR);
        }        
        $resultData = $comando->queryAll();
        $dataProvider = new ArrayDataProvider([
            'key' => 'id',
            'allModels' => $resultData,
            'pagination' => [
                'pageSize' => Yii::$app->params["pageSize"],
            ],
            'sort' => [
                'attributes' => [
                    'per_dni',
                    'per_nombres',
                    'per_apellidos',
                ],
            ],
        ]);
        if ($onlyData) {
            return $resultData;
        } else {
            return $dataProvider;
        }
    }

}
