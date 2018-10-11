<?php

namespace app\modules\academico\models;

use Yii;
use yii\data\ArrayDataProvider;

/**
 * This is the model class for table "admitido".
 *
 * @property int $adm_id
 * @property int $int_id
 * @property string $adm_estado_admitido
 * @property string $adm_estado
 * @property string $adm_fecha_creacion
 * @property string $adm_fecha_modificacion
 * @property string $adm_estado_logico
 *
 * @property Interesado $int
 */
class Admitido extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'admitido';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb() {
        return Yii::$app->get('db_captacion');
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['int_id', 'adm_estado', 'adm_estado_logico'], 'required'],
            [['int_id'], 'integer'],
            [['adm_fecha_creacion', 'adm_fecha_modificacion'], 'safe'],
            [['adm_estado_admitido', 'adm_estado', 'adm_estado_logico'], 'string', 'max' => 1],
            [['int_id'], 'exist', 'skipOnError' => true, 'targetClass' => Interesado::className(), 'targetAttribute' => ['int_id' => 'int_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'adm_id' => 'Adm ID',
            'int_id' => 'Int ID',
            'adm_estado_admitido' => 'Adm Estado Admitido',
            'adm_estado' => 'Adm Estado',
            'adm_fecha_creacion' => 'Adm Fecha Creacion',
            'adm_fecha_modificacion' => 'Adm Fecha Modificacion',
            'adm_estado_logico' => 'Adm Estado Logico',
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
     * Function getAdmitidos
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  $resultData (información del aspirante)
     */
    public static function getAdmitidos($arrFiltro = array(), $onlyData = false) {
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

        $sql = "
                   SELECT  distinct ifnull(sins.num_solicitud, lpad(sins.sins_id,9,'0')) as solicitud,
                        sins.sins_id,
                        sins.int_id,
                        SUBSTRING(sins.sins_fecha_solicitud,1,10) as sins_fecha_solicitud, 
                        per.per_id as per_id,
                        per.per_cedula as per_dni,
                        per.per_pri_nombre as per_nombres,
                        per.per_pri_apellido as per_apellidos,
                        sins.ming_id, 
                        ifnull((select min.ming_alias from " . $con->dbname . ".metodo_ingreso min where min.ming_id = sins.ming_id),'N/A') as abr_metodo,
                        ifnull((select min.ming_nombre from " . $con->dbname . ".metodo_ingreso min where min.ming_id = sins.ming_id),'N/A') as ming_nombre,
                        sins.eaca_id,
                        sins.mest_id,
                        case when (ifnull(sins.eaca_id,0)=0) then
                                (select mest_nombre from " . $con3->dbname . ".modulo_estudio me where me.mest_id = sins.mest_id and me.mest_estado = '1' and me.mest_estado_logico = '1')
                                else
                            (select eaca_nombre from " . $con3->dbname . ".estudio_academico ea where ea.eaca_id = sins.eaca_id and ea.eaca_estado = '1' and ea.eaca_estado_logico = '1')
                        end as carrera,

                        $columnsAdd                                                             
                        admi.adm_id,                                               
                       (case when sins_beca = 1 then 'ICF' else 'No Aplica' end) as beca,
                       ifnull((select 'SI' existe from " . $con3->dbname . ".matriculacion m where m.adm_id = admi.adm_id and m.sins_id = sins.sins_id and m.mat_estado = :estado and m.mat_estado_logico = :estado),'NO') as matriculado
                FROM " . $con->dbname . ".admitido admi INNER JOIN " . $con->dbname . ".interesado inte on inte.int_id = admi.int_id                     
                     INNER JOIN " . $con2->dbname . ".persona per on inte.per_id = per.per_id
                     INNER JOIN " . $con->dbname . ".solicitud_inscripcion sins on sins.int_id = inte.int_id                                          
                     INNER JOIN " . $con1->dbname . ".orden_pago opag on opag.sins_id = sins.sins_id                     
                WHERE  
                       $str_search 
                       sins.rsin_id = 2 AND
                       opag.opag_estado_pago = :estado_opago AND
                       admi.adm_estado_logico = :estado AND
                       admi.adm_estado = :estado AND 
                       inte.int_estado_logico = :estado AND
                       inte.int_estado = :estado AND     
                       per.per_estado_logico = :estado AND
                       per.per_estado = :estado AND
                       sins.sins_estado = :estado AND
                       sins.sins_estado_logico = :estado                                                    
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

    /**
     * Function consultarReportAspirantes.
     * @author  Kleber Loayza <analistadesarrollo03@uteg.edu.ec>
     * @param     
     * @return  
     */
    public function consultarReportAdmitidos($arrFiltro = array(), $onlyData = false) {
        $con = \Yii::$app->db_captacion;
        $con2 = \Yii::$app->db;
        $con3 = \Yii::$app->db_academico;
        $con1 = \Yii::$app->db_facturacion;
        $estado = 1;
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
        }
        $sql = "SELECT  distinct ifnull(sins.num_solicitud, lpad(sins.sins_id,4,'0')) as solicitud,                        
                        SUBSTRING(sins.sins_fecha_solicitud,1,10) as sins_fecha_solicitud,                       
                        per.per_cedula as per_dni,
                        per.per_pri_nombre as per_nombres,
                        per.per_pri_apellido as per_apellidos,                        
                        ifnull((select min.ming_alias from " . $con->dbname . ".metodo_ingreso min where min.ming_id = sins.ming_id),'N/A') as abr_metodo,
                        case when (ifnull(sins.eaca_id,0)=0) then
                                (select mest_nombre from " . $con3->dbname . ".modulo_estudio me where me.mest_id = sins.mest_id and me.mest_estado = '1' and me.mest_estado_logico = '1')
                                else
                            (select eaca_nombre from " . $con3->dbname . ".estudio_academico ea where ea.eaca_id = sins.eaca_id and ea.eaca_estado = '1' and ea.eaca_estado_logico = '1')
                        end as carrera,                                                                                                                       
                       (case when sins_beca = 1 then 'ICF' else 'No Aplica' end) as beca,
                       ifnull((select 'SI' existe from " . $con3->dbname . ".matriculacion m where m.adm_id = admi.adm_id and m.sins_id = sins.sins_id and m.mat_estado = :estado and m.mat_estado_logico = :estado),'NO') as matriculado
                FROM " . $con->dbname . ".admitido admi INNER JOIN " . $con->dbname . ".interesado inte on inte.int_id = admi.int_id                     
                     INNER JOIN " . $con2->dbname . ".persona per on inte.per_id = per.per_id
                     INNER JOIN " . $con->dbname . ".solicitud_inscripcion sins on sins.int_id = inte.int_id                                          
                     INNER JOIN " . $con1->dbname . ".orden_pago opag on opag.sins_id = sins.sins_id                     
                WHERE  
                       $str_search 
                       opag.opag_estado_pago = :estado_opago AND
                       admi.adm_estado_logico = :estado AND
                       admi.adm_estado = :estado AND 
                       inte.int_estado_logico = :estado AND
                       inte.int_estado = :estado AND                       
                       per.per_estado_logico = :estado AND
                       per.per_estado = :estado AND
                       sins.sins_estado = :estado AND
                       sins.sins_estado_logico = :estado                                                    
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
