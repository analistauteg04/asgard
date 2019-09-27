<?php

namespace app\modules\academico\models;

use Yii;
use yii\data\ArrayDataProvider;

/**
 * This is the model class for table "promocion_programa".
 *
 * @property int $ppro_id
 * @property string $ppro_anio
 * @property string $ppro_mes
 * @property string $ppro_codigo
 * @property int $uaca_id
 * @property int $mod_id
 * @property int $eaca_id
 * @property int $ppro_num_paralelo
 * @property int $ppro_cupo
 * @property int $ppro_usuario_ingresa
 * @property string $ppro_estado
 * @property string $ppro_fecha_creacion
 * @property int $ppro_usuario_modifica
 * @property string $ppro_fecha_modificacion
 * @property string $ppro_estado_logico
 *
 * @property MatriculacionProgramaInscrito[] $matriculacionProgramaInscritos
 * @property ParaleloPromocionPrograma[] $paraleloPromocionProgramas
 * @property UnidadAcademica $uaca
 * @property Modalidad $mod
 * @property EstudioAcademico $eaca
 */
class PromocionPrograma extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'promocion_programa';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb() {
        return Yii::$app->get('db_academico');
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['ppro_anio', 'ppro_mes', 'ppro_codigo', 'uaca_id', 'mod_id', 'eaca_id', 'ppro_num_paralelo', 'ppro_cupo', 'ppro_estado', 'ppro_estado_logico'], 'required'],
            [['uaca_id', 'mod_id', 'eaca_id', 'ppro_num_paralelo', 'ppro_cupo', 'ppro_usuario_ingresa', 'ppro_usuario_modifica'], 'integer'],
            [['ppro_fecha_creacion', 'ppro_fecha_modificacion'], 'safe'],
            [['ppro_anio'], 'string', 'max' => 4],
            [['ppro_mes'], 'string', 'max' => 2],
            [['ppro_codigo'], 'string', 'max' => 20],
            [['ppro_estado', 'ppro_estado_logico'], 'string', 'max' => 1],
            [['uaca_id'], 'exist', 'skipOnError' => true, 'targetClass' => UnidadAcademica::className(), 'targetAttribute' => ['uaca_id' => 'uaca_id']],
            [['mod_id'], 'exist', 'skipOnError' => true, 'targetClass' => Modalidad::className(), 'targetAttribute' => ['mod_id' => 'mod_id']],
            [['eaca_id'], 'exist', 'skipOnError' => true, 'targetClass' => EstudioAcademico::className(), 'targetAttribute' => ['eaca_id' => 'eaca_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'ppro_id' => 'Ppro ID',
            'ppro_anio' => 'Ppro Anio',
            'ppro_mes' => 'Ppro Mes',
            'ppro_codigo' => 'Ppro Codigo',
            'uaca_id' => 'Uaca ID',
            'mod_id' => 'Mod ID',
            'eaca_id' => 'Eaca ID',
            'ppro_num_paralelo' => 'Ppro Num Paralelo',
            'ppro_cupo' => 'Ppro Cupo',
            'ppro_usuario_ingresa' => 'Ppro Usuario Ingresa',
            'ppro_estado' => 'Ppro Estado',
            'ppro_fecha_creacion' => 'Ppro Fecha Creacion',
            'ppro_usuario_modifica' => 'Ppro Usuario Modifica',
            'ppro_fecha_modificacion' => 'Ppro Fecha Modificacion',
            'ppro_estado_logico' => 'Ppro Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatriculacionProgramaInscritos() {
        return $this->hasMany(MatriculacionProgramaInscrito::className(), ['ppro_id' => 'ppro_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParaleloPromocionProgramas() {
        return $this->hasMany(ParaleloPromocionPrograma::className(), ['ppro_id' => 'ppro_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUaca() {
        return $this->hasOne(UnidadAcademica::className(), ['uaca_id' => 'uaca_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMod() {
        return $this->hasOne(Modalidad::className(), ['mod_id' => 'mod_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEaca() {
        return $this->hasOne(EstudioAcademico::className(), ['eaca_id' => 'eaca_id']);
    }

    /**
     * Function getPromocion
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>
     * @param   
     * @return  $resultData (información del aspirante)
     */
    public static function getPromocion($arrFiltro = array(), $onlyData = false) {
        $con = \Yii::$app->db_captacion;
        $con2 = \Yii::$app->db;
        $con3 = \Yii::$app->db_academico;
        $con1 = \Yii::$app->db_facturacion;
        $estado = 1;
        $columnsAdd = "";
        $estado_opago = "S";

        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            if ($arrFiltro['search'] != "") {
                $str_search = "(a.per_pri_nombre like :search OR ";
                $str_search .= "a.per_seg_nombre like :search OR ";
                $str_search .= "a.per_pri_apellido like :search OR ";
                $str_search .= "a.per_cedula like :search) AND ";
            }
            if ($arrFiltro['unidad'] != "" && $arrFiltro['unidad'] > 0) {
                $str_search .= "a.uaca_id = :unidad AND ";
            }
            if ($arrFiltro['modalidad'] != "" && $arrFiltro['modalidad'] > 0) {
                $str_search .= "a.mod_id = :modalidad AND ";
            }
            if ($arrFiltro['programa'] != "" && $arrFiltro['programa'] > 0) {
                $str_search .= "a.eaca_id = :carrera AND ";
            }            
        } else {
            $columnsAdd = "sins.sins_id as solicitud_id,
                    per.per_id as persona, 
                    per.per_pri_nombre as per_pri_nombre, 
                    per.per_seg_nombre as per_seg_nombre,
                    per.per_pri_apellido as per_pri_apellido,
                    per.per_seg_apellido as per_seg_apellido,";
        }
        $sql = "SELECT * FROM (
                SELECT  distinct lpad(ifnull(sins.num_solicitud, sins.sins_id),9,'0') as solicitud,
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
                        sins.mod_id,
                        moda.mod_nombre,
                        uaca.uaca_nombre,
                        sins.uaca_id,
                        case when (ifnull(sins.eaca_id,0)=0) then
                                (select mest_nombre from " . $con3->dbname . ".modulo_estudio me where me.mest_id = sins.mest_id and me.mest_estado = '1' and me.mest_estado_logico = '1')
                                else
                            (select eaca_nombre from " . $con3->dbname . ".estudio_academico ea where ea.eaca_id = sins.eaca_id and ea.eaca_estado = '1' and ea.eaca_estado_logico = '1')
                        end as carrera,
                        per.per_pri_nombre as per_pri_nombre, 
                        per.per_seg_nombre as per_seg_nombre,
                        per.per_pri_apellido as per_pri_apellido,
                        per.per_seg_apellido as per_seg_apellido,   
                        per.per_cedula,
                        admi.adm_id,                                               
                       (case when sins_beca = 1 then 'ICF' else 'No Aplica' end) as beca,
                       ifnull((select pa.pami_codigo
                               from " . $con3->dbname . ".matriculacion m inner join " . $con3->dbname . ".asignacion_paralelo ap on ap.mat_id = m.mat_id
                                    inner join " . $con3->dbname . ".paralelo p on p.par_id = ap.par_id
                                    inner join " . $con3->dbname . ".periodo_academico_met_ingreso pa on pa.pami_id = p.pami_id
                               where m.adm_id = admi.adm_id and m.sins_id = sins.sins_id and m.mat_estado = :estado and m.mat_estado_logico = :estado
                                and p.par_estado = :estado and p.par_estado_logico = :estado
                                and ap.apar_estado = :estado and ap.apar_estado_logico = :estado
                                and pa.pami_estado = :estado and pa.pami_estado_logico = :estado),'N/A') as pami_codigo,
                        sins.emp_id
                FROM " . $con->dbname . ".admitido admi INNER JOIN " . $con->dbname . ".solicitud_inscripcion sins on sins.sins_id = admi.sins_id                 
                     INNER JOIN " . $con->dbname . ".interesado inte on sins.int_id = inte.int_id 
                     INNER JOIN " . $con2->dbname . ".persona per on inte.per_id = per.per_id                     
                     INNER JOIN " . $con3->dbname . ".modalidad moda on moda.mod_id=sins.mod_id
                     INNER JOIN " . $con3->dbname . ".unidad_academica uaca on uaca.uaca_id=sins.uaca_id
                     INNER JOIN " . $con1->dbname . ".orden_pago opag on opag.sins_id = sins.sins_id    
                WHERE                          
                       sins.rsin_id = 2 AND
                       opag.opag_estado_pago = :estado_opago AND
                       admi.adm_estado_logico = :estado AND
                       admi.adm_estado = :estado AND 
                       inte.int_estado_logico = :estado AND
                       inte.int_estado = :estado AND     
                       per.per_estado_logico = :estado AND
                       per.per_estado = :estado AND
                       sins.sins_estado = :estado AND
                       sins.sins_estado_logico = :estado  AND
                       opag.opag_estado = :estado AND
                       opag.opag_estado_logico = :estado                  
                ORDER BY SUBSTRING(sins.sins_fecha_solicitud,1,10) desc) a
                WHERE $str_search  
                      a.sins_id = a.sins_id";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":estado_opago", $estado_opago, \PDO::PARAM_STR);
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            if ($arrFiltro['search'] != "") {
                $search_cond = "%" . $arrFiltro["search"] . "%";
                $comando->bindParam(":search", $search_cond, \PDO::PARAM_STR);
            }
            $unidad = $arrFiltro["unidad"];
            if ($arrFiltro['unidad'] != "" && $arrFiltro['unidad'] > 0) {
                $comando->bindParam(":unidad", $unidad, \PDO::PARAM_INT);
            }
            $modalidad = $arrFiltro["modalidad"];
            if ($arrFiltro['modalidad'] != "" && $arrFiltro['modalidad'] > 0) {
                $comando->bindParam(":modalidad", $modalidad, \PDO::PARAM_INT);
            }
            $programa = $arrFiltro["programa"];
            if ($arrFiltro['programa'] != "" && $arrFiltro['programa'] > 0) {
                $comando->bindParam(":programa", $programa, \PDO::PARAM_INT);
            }            
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
