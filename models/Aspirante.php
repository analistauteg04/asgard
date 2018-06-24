<?php

namespace app\models;

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
     * Function consultarAspirantes
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  $resultData (información del aspirante)
     */

    public static function consultarAspirantes($resp_gruporol, $arrFiltro = array(), $onlyData = false) {

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
            if ($arrFiltro['carrera'] != "" && $arrFiltro['carrera'] > 0) {
                $str_search .= "car.car_id = :carrera AND ";
            }
            if ($arrFiltro['f_ini'] != "" && $arrFiltro['f_fin'] != "") {
                $str_search .= "sins.sins_fecha_solicitud >= :fec_ini AND ";
                $str_search .= "sins.sins_fecha_solicitud <= :fec_fin AND ";
            }
            $str_search .= "(SELECT pmin_codigo 
                        FROM db_academico.asignacion_curso ascu
                        INNER JOIN db_academico.curso cur on cur.cur_id = ascu.cur_id
                        INNER JOIN db_academico.periodo_metodo_ingreso pmi on pmi.pmin_id = cur.pmin_id
                        WHERE asp_id = asp.asp_id AND 
                        pmi.nint_id = sins.nint_id AND
                        pmi.ming_id = sins.ming_id AND
                        ascu.sins_id = sins.sins_id AND
                        ascu.acur_estado = :estado AND
                        ascu.acur_estado_logico = :estado AND
                        cur.cur_estado = :estado AND
                        cur.cur_estado_logico = :estado AND
                        pmi.pmin_estado = :estado AND
                        pmi.pmin_estado_logico = :estado) like :codigocan AND ";
        } else {
            $columnsAdd = "sins.sins_id as solicitud_id,
                    per.per_id as persona, 
                    per.per_pri_nombre as per_pri_nombre, 
                    per.per_seg_nombre as per_seg_nombre,
                    per.per_pri_apellido as per_pri_apellido,
                    per.per_seg_apellido as per_seg_apellido,";
        }

        $sql = "SELECT distinct lpad(sins.sins_id,4,'0') as solicitud,
                       sins.sins_id as id_solicitud,
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
                       car.car_nombre as carrera,
                       $columnsAdd
                       ifnull((SELECT cur.cur_descripcion 
                                FROM " . $con3->dbname . ".asignacion_curso ascu
                                INNER JOIN  " . $con3->dbname . ".curso cur on cur.cur_id = ascu.cur_id
                                WHERE asp_id = asp.asp_id AND
                                    ascu.sins_id = sins.sins_id AND
                                    ascu.acur_estado = :estado AND
                                    ascu.acur_estado_logico = :estado AND
                                    cur.cur_estado = :estado AND
                                    cur.cur_estado_logico = :estado	
                                   ), 'N/A') as curso,
                       ifnull((SELECT pmin_codigo 
                                FROM " . $con3->dbname . ".asignacion_curso ascu
                                INNER JOIN  " . $con3->dbname . ".curso cur on cur.cur_id = ascu.cur_id
                                INNER JOIN  " . $con3->dbname . ".periodo_metodo_ingreso pmi on pmi.pmin_id = cur.pmin_id
                                WHERE   asp_id = asp.asp_id AND                                       
                                        pmi.nint_id = sins.nint_id AND
                                        pmi.ming_id = sins.ming_id AND
                                        ascu.sins_id = sins.sins_id AND
                                        ascu.acur_estado = :estado AND
                                        ascu.acur_estado_logico = :estado AND
                                        cur.cur_estado = :estado AND
                                        cur.cur_estado_logico = :estado AND
                                        pmi.pmin_estado = :estado AND
                                        pmi.pmin_estado_logico = :estado    
                                     ), 'N/A') as can,            
                       ifnull((SELECT concat ('Período ', DATE(pmi.pmin_fecha_desde), ' / ', DATE(pmi.pmin_fecha_hasta)) 
                                FROM " . $con3->dbname . ".asignacion_curso ascu
                                INNER JOIN  " . $con3->dbname . ".curso cur on cur.cur_id = ascu.cur_id
                                INNER JOIN  " . $con3->dbname . ".periodo_metodo_ingreso pmi on pmi.pmin_id = cur.pmin_id
                                WHERE   asp_id = asp.asp_id AND                                       
                                        pmi.nint_id = sins.nint_id AND
                                        pmi.ming_id = sins.ming_id AND
                                        ascu.sins_id = sins.sins_id AND
                                        ascu.acur_estado = :estado AND
                                        ascu.acur_estado_logico = :estado AND
                                        cur.cur_estado = :estado AND
                                        cur.cur_estado_logico = :estado AND
                                        pmi.pmin_estado = :estado AND
                                        pmi.pmin_estado_logico = :estado    
                                     ), 'N/A') as periodo,                     
                        asp.asp_id,                        
                       $resp_gruporol as rol
                FROM " . $con->dbname . ".aspirante asp INNER JOIN " . $con->dbname . ".interesado inte on inte.int_id = asp.int_id
                     INNER JOIN " . $con->dbname . ".pre_interesado pint on pint.pint_id = inte.pint_id
                     INNER JOIN " . $con2->dbname . ".persona per on pint.per_id = per.per_id
                     INNER JOIN " . $con->dbname . ".solicitud_inscripcion sins on sins.int_id = inte.int_id
                     INNER JOIN " . $con->dbname . ".metodo_ingreso ming on ming.ming_id = sins.ming_id
                     INNER JOIN " . $con3->dbname . ".carrera car on car.car_id = sins.car_id
                     INNER JOIN " . $con1->dbname . ".orden_pago opag on opag.sins_id = sins.sins_id                     
                     
                WHERE  
                       $str_search 
                       opag.opag_estado_pago = :estado_opago AND
                       asp.asp_estado_logico = :estado AND
                       asp.asp_estado = :estado AND 
                       inte.int_estado_logico = :estado AND
                       inte.int_estado = :estado AND
                       pint.pint_estado_logico = :estado AND
                       pint.pint_estado = :estado AND
                       per.per_estado_logico = :estado AND
                       per.per_estado = :estado AND
                       sins.sins_estado = :estado AND
                       sins.sins_estado_logico = :estado AND
                       ming.ming_estado_logico = :estado AND
                       ming.ming_estado = :estado AND
                       car.car_estado_logico = :estado AND
                       car.car_estado = :estado                         
                ORDER BY SUBSTRING(sins.sins_fecha_solicitud,1,10) desc";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":estado_opago", $estado_opago, \PDO::PARAM_STR);
        $comando->bindParam(":resp_gruporol", $resp_gruporol, \PDO::PARAM_INT);
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $search_cond = "%" . $arrFiltro["search"] . "%";
            $fecha_ini = $arrFiltro["f_ini"];
            $fecha_fin = $arrFiltro["f_fin"];
            $carrera = $arrFiltro["carrera"];
            $codigocan = "%" . $arrFiltro["codigocan"] . "%";
            $comando->bindParam(":search", $search_cond, \PDO::PARAM_STR);
            if ($arrFiltro['carrera'] != "" && $arrFiltro['carrera'] > 0) {
                $comando->bindParam(":carrera", $carrera, \PDO::PARAM_STR);
            }
            if ($arrFiltro['f_ini'] != "" && $arrFiltro['f_fin'] != "") {
                $comando->bindParam(":fec_ini", $fecha_ini, \PDO::PARAM_STR);
                $comando->bindParam(":fec_fin", $fecha_fin, \PDO::PARAM_STR);
            }
            $comando->bindParam(":codigocan", $codigocan, \PDO::PARAM_STR);
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
