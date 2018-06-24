<?php

namespace app\models;

use Yii;
use yii\data\ArrayDataProvider;

/**
 * This is the model class for table "solicitud_inscripcion".
 *
 * @property integer $sins_id
 * @property integer $int_id
 * @property integer $nint_id
 * @property integer $ming_id
 * @property integer $car_id
 * @property integer $rsin_id
 * @property string $sins_fecha_solicitud
 * @property string $sins_fecha_preaprobacion
 * @property string $sins_fecha_aprobacion
 * @property string $sins_fecha_reprobacion
 * @property string $sins_fecha_prenoprobacion
 * @property string $sins_preobservacion
 * @property string $sins_observacion
 * @property integer $sins_usuario_preaprueba
 * @property integer $sins_usuario_aprueba
 * @property string $sins_estado
 * @property string $sins_fecha_creacion
 * @property string $sins_fecha_modificacion
 * @property string $sins_estado_logico
 *
 * @property Interesado $int
 * @property NivelInteres $nint
 * @property MetodoIngreso $ming
 * @property ResSolInscripcion $rsin
 * @property SolicitudinsDocumento[] $solicitudinsDocumentos
 */
class SolicitudInscripcion extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return \Yii::$app->db_captacion->dbname . '.solicitud_inscripcion';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['int_id', 'nint_id', 'ming_id', 'car_id', 'rsin_id', 'sins_estado', 'sins_estado_logico'], 'required'],
            [['int_id', 'nint_id', 'ming_id', 'car_id', 'rsin_id', 'sins_usuario_preaprueba', 'sins_usuario_aprueba'], 'integer'],
            [['sins_fecha_solicitud', 'sins_fecha_preaprobacion', 'sins_fecha_aprobacion', 'sins_fecha_reprobacion', 'sins_fecha_prenoprobacion', 'sins_fecha_creacion', 'sins_fecha_modificacion'], 'safe'],
            [['sins_preobservacion', 'sins_observacion'], 'string', 'max' => 1000],
            [['sins_estado', 'sins_estado_logico'], 'string', 'max' => 1],
            [['int_id'], 'exist', 'skipOnError' => true, 'targetClass' => Interesado::className(), 'targetAttribute' => ['int_id' => 'int_id']],
            [['nint_id'], 'exist', 'skipOnError' => true, 'targetClass' => NivelInteres::className(), 'targetAttribute' => ['nint_id' => 'nint_id']],
            [['ming_id'], 'exist', 'skipOnError' => true, 'targetClass' => MetodoIngreso::className(), 'targetAttribute' => ['ming_id' => 'ming_id']],
            [['rsin_id'], 'exist', 'skipOnError' => true, 'targetClass' => ResSolInscripcion::className(), 'targetAttribute' => ['rsin_id' => 'rsin_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'sins_id' => 'Sins ID',
            'int_id' => 'Int ID',
            'nint_id' => 'Nint ID',
            'ming_id' => 'Ming ID',
            'car_id' => 'Car ID',
            'rsin_id' => 'Rsin ID',
            'sins_fecha_solicitud' => 'Sins Fecha Solicitud',
            'sins_fecha_preaprobacion' => 'Sins Fecha Preaprobacion',
            'sins_fecha_aprobacion' => 'Sins Fecha Aprobacion',
            'sins_fecha_reprobacion' => 'Sins Fecha Reprobacion',
            'sins_fecha_prenoprobacion' => 'Sins Fecha Prenoprobacion',
            'sins_preobservacion' => 'Sins Preobservacion',
            'sins_observacion' => 'Sins Observacion',
            'sins_usuario_preaprueba' => 'Sins Usuario Preaprueba',
            'sins_usuario_aprueba' => 'Sins Usuario Aprueba',
            'sins_estado' => 'Sins Estado',
            'sins_fecha_creacion' => 'Sins Fecha Creacion',
            'sins_fecha_modificacion' => 'Sins Fecha Modificacion',
            'sins_estado_logico' => 'Sins Estado Logico',
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
    public function getNint() {
        return $this->hasOne(NivelInteres::className(), ['nint_id' => 'nint_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMing() {
        return $this->hasOne(MetodoIngreso::className(), ['ming_id' => 'ming_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRsin() {
        return $this->hasOne(ResSolInscripcion::className(), ['rsin_id' => 'rsin_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudinsDocumentos() {
        return $this->hasMany(SolicitudinsDocumento::className(), ['sins_id' => 'sins_id']);
    }

    public static function getSolicitudes($estado_inscripcion1, $estado_inscripcion2, $per_id, $resp_gruporol, $arrFiltro = array(), $onlyData = false) {
        $con = \Yii::$app->db_captacion;
        $con1 = \Yii::$app->db_academico;
        $con2 = \Yii::$app->db;
        $estado = 1;
        $columnsAdd = "";
        //$resp_gruporol = $resp_gruporol['grol_id'];

        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $str_search = "(per.per_pri_nombre like :search OR ";
            $str_search .= "per.per_seg_nombre like :search OR ";
            $str_search .= "per.per_pri_apellido like :search OR ";
            $str_search .= "per.per_cedula like :search) AND ";
            if ($arrFiltro['ejecutivo'] != "" && $arrFiltro['ejecutivo'] > 0) {
                $str_search .= "intej.per_id  = :ejecutivo AND ";
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

        $sql = "SELECT
                    lpad(sins_id,4,'0') as num_solicitud,
                    sins_fecha_solicitud as fecha_solicitud,
                    per.per_id as persona,
                    inte.int_id as int_id,
                    per.per_cedula as per_dni,
                    per.per_pri_nombre as per_pri_nombre,                    
                    per.per_seg_nombre as per_seg_nombre,
                    per.per_pri_apellido as per_pri_apellido,
                    per.per_seg_apellido as per_seg_apellido,
                    nint.nint_nombre as nint_nombre,
                    ming.ming_nombre as ming_nombre,
                    car.car_nombre,
                    concat(per.per_pri_nombre ,' ', ifnull(per.per_seg_nombre,' ')) as per_nombres,
                    concat(per.per_pri_apellido ,' ', ifnull(per.per_seg_apellido,' ')) as per_apellidos,
                    sins.sins_fecha_solicitud as fecha_solicitud,
                    rsol.rsin_nombre as estado,
                    sins.sins_id,                    
                    intej.per_id as ejecutivo,
                    (Select concat(pers.per_pri_nombre ,' ', pers.per_pri_apellido) as ejecutivo_asignado 
                     from " . $con2->dbname . ".persona pers where pers.per_id = ejecutivo) as ejecutivo_asignado,
                    sins_fecha_preaprobacion,
                    sins_fecha_aprobacion,
                    sins_fecha_reprobacion,
                    sins_fecha_prenoprobacion,
                    sins_observacion,
                    $columnsAdd
                    :resp_gruporol as roladmin,
                    sins.sins_usuario_preaprueba as usu_preaprueba,
                    $per_id as 'usu_autenticado'
                FROM 
                    " . $con->dbname . ".solicitud_inscripcion as sins
                    INNER JOIN " . $con->dbname . ".interesado as inte on sins.int_id = inte.int_id
                    INNER JOIN " . $con->dbname . ".pre_interesado as pint on inte.pint_id = pint.pint_id
                    INNER JOIN " . $con2->dbname . ".persona as per on pint.per_id = per.per_id 
                    INNER JOIN " . $con->dbname . ".nivel_interes as nint on sins.nint_id = nint.nint_id 
                    INNER JOIN " . $con->dbname . ".metodo_ingreso as ming on sins.ming_id = ming.ming_id
                    INNER JOIN " . $con->dbname . ".res_sol_inscripcion as rsol on rsol.rsin_id = sins.rsin_id
                    INNER JOIN " . $con->dbname . ".interesado_ejecutivo as intej on (intej.int_id = inte.int_id or intej.pint_id = pint.pint_id)
                    INNER JOIN " . $con1->dbname . ".carrera as car on car.car_id = sins.car_id 
                WHERE 
                    $str_search
                    sins.rsin_id in(:pendiente, :noaprobado) AND
                    sins.sins_estado_logico=:estado AND
                    inte.int_estado_logico=:estado AND
                    pint.pint_estado_logico=:estado AND
                    per.per_estado_logico=:estado AND
                    sins.sins_estado=:estado AND
                    inte.int_estado=:estado AND
                    pint.pint_estado=:estado AND
                    per.per_estado=:estado AND
                    car.car_estado=:estado AND
                    car.car_estado_logico=:estado ";

        if (($estado_inscripcion1 != 1) and ( !empty($resp_gruporol))) {
            $sql .= " AND intej.per_id <> :per_id";
        }

        if (($estado_inscripcion1 == 1) and ( !empty($resp_gruporol)) and ( $resp_gruporol != 61)) {
            $sql .= "AND intej.per_id = :per_id";
        }
        $sql .= " ORDER BY fecha_solicitud DESC";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":pendiente", $estado_inscripcion1, \PDO::PARAM_INT);
        $comando->bindParam(":noaprobado", $estado_inscripcion2, \PDO::PARAM_INT);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
        $comando->bindParam(":resp_gruporol", $resp_gruporol, \PDO::PARAM_INT);

        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $search_cond = "%" . $arrFiltro["search"] . "%";
            $fecha_ini = $arrFiltro["f_ini"];
            $fecha_fin = $arrFiltro["f_fin"];
            $ejecutivo = $arrFiltro["ejecutivo"];
            $comando->bindParam(":search", $search_cond, \PDO::PARAM_STR);
            if ($arrFiltro['ejecutivo'] != "" && $arrFiltro['ejecutivo'] > 0) {
                $comando->bindParam(":ejecutivo", $ejecutivo, \PDO::PARAM_STR);
            }
            if ($arrFiltro['f_ini'] != "" && $arrFiltro['f_fin'] != "") {
                $comando->bindParam(":fec_ini", $fecha_ini, \PDO::PARAM_STR);
                $comando->bindParam(":fec_fin", $fecha_fin, \PDO::PARAM_STR);
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
                    'num_solicitud',
                    'fecha_solicitud',
                    'per_dni',
                    'per_pri_nombre',
                    'per_seg_nombre',
                    'per_pri_apellido',
                    'per_seg_apellido',
                    'nint_nombre',
                    'ming_nombre',
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

    public static function ConsultarSolInteresado($int_id, $arrFiltro = array(), $onlyData = false) {
        $con = \Yii::$app->db_captacion;
        $con1 = \Yii::$app->db_academico;
        $con2 = \Yii::$app->db;
        $con3 = \Yii::$app->db_facturacion;
        $estado = 1;
        $columnsAdd = "";

        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $str_search = "(per.per_pri_nombre like :search OR ";
            $str_search .= "per.per_seg_nombre like :search OR ";
            $str_search .= "per.per_pri_nombre like :search OR ";
            $str_search .= "per.per_cedula like :search) AND ";
            if ($arrFiltro['modalidad'] != "" && $arrFiltro['modalidad'] > 0) {
                $str_search .= "sins.mod_id = :modalidad AND ";
            }            
            if ($arrFiltro['carrera'] != "" && $arrFiltro['carrera'] > 0) {
                $str_search .= "car.car_id = :carrera AND ";
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

        $sql = "SELECT 
                    lpad(sins.sins_id,4,'0') as num_solicitud,
                    sins.sins_fecha_solicitud as fecha_solicitud,
                    per.per_cedula as per_dni,                    
                    concat(per.per_pri_apellido ,' ', ifnull(per.per_pri_nombre,' ')) as per_nombre,
                    nint.uaca_nombre as nint_nombre,                    
                    (
                        CASE 
                            WHEN ming.ming_id = 1 THEN 'CAN'
                            WHEN ming.ming_id = 2 THEN 'EXA'
                            WHEN ming.ming_id = 3 THEN 'HOM'
                            WHEN ming.ming_id = 4 THEN 'PRO'
                            ELSE 'N/A'
                        END) AS abr_metodo,
                    modali.mod_nombre as modalidad,
                    ming.ming_nombre as ming_nombre,
                    CONCAT(SUBSTRING(car.car_nombre, 1,10),'','...' )as abre_carrera,
                    car.car_nombre as carrera,                    
                    rsol.rsin_nombre as estado,
                    $columnsAdd
                    (CASE when ifnull((SELECT (CASE WHEN ord.opag_estado_pago = 'P' 
                                                    THEN 'Pendiente'  WHEN ord.opag_estado_pago = 'S' 
                                                    THEN 'Pagado' else 'No Disponible' END) as estado_pago 
                                           FROM " . $con3->dbname . ".orden_pago as ord 
                                           WHERE ord.sins_id = sins.sins_id AND ord.opag_estado_logico=:estado AND  ord.opag_estado=:estado), ' ')= ' ' 
                    THEN 'No Disponible' 
                    ELSE  (SELECT (CASE WHEN ord.opag_estado_pago = 'P' 
                                            THEN 'Pendiente' else 'Pagado' END) as estado_pago 
                                   FROM " . $con3->dbname . ".orden_pago as ord 
                                   WHERE ord.sins_id = sins.sins_id AND ord.opag_estado_logico=:estado AND  ord.opag_estado=:estado) END) as estado_pago                                 
                FROM 
                    " . $con->dbname . ".solicitud_inscripcion as sins
                    INNER JOIN " . $con->dbname . ".interesado as inte on sins.int_id = inte.int_id
                    INNER JOIN " . $con->dbname . ".pre_interesado as pint on inte.pint_id = pint.pint_id
                    INNER JOIN " . $con2->dbname . ".persona as per on pint.per_id = per.per_id 
                    INNER JOIN " . $con1->dbname . ".unidad_academica as nint on sins.nint_id = nint.uaca_id 
                    INNER JOIN " . $con->dbname . ".metodo_ingreso as ming on sins.ming_id = ming.ming_id
                    INNER JOIN " . $con->dbname . ".res_sol_inscripcion as rsol on rsol.rsin_id = sins.rsin_id
                    INNER JOIN " . $con1->dbname . ".carrera as car on sins.car_id = car.car_id
                    INNER JOIN " . $con1->dbname . ".modalidad as modali on sins.mod_id = modali.mod_id
                WHERE  
                    $str_search 
                    sins.sins_estado_logico=:estado AND 
                    inte.int_estado_logico=:estado AND 
                    pint.pint_estado_logico=:estado AND
                    per.per_estado_logico=:estado AND 
                    car.car_estado_logico =:estado AND 
                    nint.uaca_estado_logico =:estado AND 
                    sins.sins_estado=:estado AND 
                    inte.int_estado=:estado AND 
                    pint.pint_estado=:estado AND
                    per.per_estado=:estado AND
                    car.car_estado =:estado AND
                    nint.uaca_estado =:estado AND
                    pint.per_id =:int_id
                    ORDER BY fecha_solicitud DESC";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":int_id", $int_id, \PDO::PARAM_INT);
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $search_cond = "%" . $arrFiltro["search"] . "%";
            $fecha_ini = $arrFiltro["f_ini"];
            $fecha_fin = $arrFiltro["f_fin"];
            $modalidad = $arrFiltro["modalidad"];
            $carrera = $arrFiltro["carrera"];
            $comando->bindParam(":search", $search_cond, \PDO::PARAM_STR);
            if ($arrFiltro['modalidad'] != "" && $arrFiltro['modalidad'] > 0) {
                $comando->bindParam(":modalidad", $modalidad, \PDO::PARAM_INT);
            }
            if ($arrFiltro['carrera'] != "" && $arrFiltro['carrera'] > 0) {
                $comando->bindParam(":carrera", $carrera, \PDO::PARAM_INT);
            }
            if ($arrFiltro['f_ini'] != "" && $arrFiltro['f_fin'] != "") {
                $comando->bindParam(":fec_ini", $fecha_ini, \PDO::PARAM_STR);
                $comando->bindParam(":fec_fin", $fecha_fin, \PDO::PARAM_STR);
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
                    'num_solicitud',
                    'fecha_solicitud',
                    'per_dni',
                    'per_nombres',
                    'nint_nombre',
                    'modalidad',
                    'ming_nombre',                    
                    'carrera',
                    'estado',
                    'estado_pago',
                ],
            ],
        ]);
        if ($onlyData) {
            return $resultData;
        } else {
            return $dataProvider;
        }
    }

    public static function obtenerSolInteresado($int_id) {
        $con = \Yii::$app->db_captacion;
        $con2 = \Yii::$app->db;
        $estado = 1;
        $sql = "SELECT 
                    per.per_cedula as per_dni,
                    per.per_pri_nombre as per_pri_nombre,                    
                    per.per_seg_nombre as per_seg_nombre,
                    per.per_pri_apellido as per_pri_apellido,
                    per.per_seg_apellido as per_seg_apellido,
                    nint.nint_nombre as nint_nombre,
                    ming.ming_nombre as ming_nombre,
                    concat(per.per_pri_nombre ,' ', per.per_seg_nombre) as per_nombres,
                    concat(per.per_pri_apellido ,' ', per.per_seg_apellido) as per_apellidos,
                    sins_fecha_solicitud as fecha_solicitud
                    
                FROM 
                    " . $con->dbname . ".solicitud_inscripcion as sins
                    INNER JOIN " . $con->dbname . ".interesado as inte on sins.int_id = inte.int_id
                    INNER JOIN " . $con->dbname . ".pre_interesado as pint on inte.pint_id = pint.pint_id
                    INNER JOIN " . $con2->dbname . ".persona as per on pint.per_id = per.per_id 
                    INNER JOIN " . $con->dbname . ".nivel_interes as nint on sins.nint_id = nint.nint_id 
                    INNER JOIN " . $con->dbname . ".metodo_ingreso as ming on sins.ming_id = ming.ming_id 
                WHERE 
                    sins.sins_estado_logico=:estado AND 
                    inte.int_estado_logico=:estado AND 
                    pint.pint_estado_logico=:estado AND
                    per.per_estado_logico=:estado AND 
                    sins.sins_estado=:estado AND 
                    inte.int_estado=:estado AND 
                    pint.pint_estado=:estado AND
                    per.per_estado=:estado AND
                    inte.int_id=:int_id";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":int_id", $int_id, \PDO::PARAM_INT);
        $resultData = $comando->queryOne();
        return $resultData;
    }

    /**
     * Function Obtenerdocumentosxsolicitud
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  $resultData (nombres de archivos adjuntos por solicitud)
     */
    public function Obtenerdocumentosxsolicitud($sins_id, $dadj_id) {
        $con = \Yii::$app->db_captacion;
        $estado = 1;

        $sql = "SELECT dadj_id, sdoc_archivo	
                FROM " . $con->dbname . ".solicitudins_documento sdoc
                WHERE sdoc.sins_id = :sins_id AND     
                      sdoc.dadj_id = :dadj_id AND    
                      sdoc.sdoc_estado = :estado AND
                      sdoc.sdoc_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":sins_id", $sins_id, \PDO::PARAM_INT);
        $comando->bindParam(":dadj_id", $dadj_id, \PDO::PARAM_INT);
        $resultData = $comando->queryOne();
        return $resultData;
    }

    /**
     * Function apruebaSolicitud (PreAprueba y Aprueba Solicitud)
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  
     */
    public function apruebaSolicitud($sins_id, $rsin_id, $observacion, $banderapreaprueba, $usuario) {
        $con = \Yii::$app->db_captacion;
        $estado = 1;
        $fecha_modificacion = date(Yii::$app->params["dateTimeByDefault"]); //date("Y-m-d H:i:s");//$hoy = date("Y-m-d H:i:s"); 

        if ($banderapreaprueba == 1) {
            $usu_preaprueba = $usuario;
        } else {
            $usu_aprueba = $usuario;
        }

        if ($rsin_id == 3) {  //Pre-aprobacion
            $fecha_preaprobacion = date(Yii::$app->params["dateTimeByDefault"]);
            error_log("entro2" . date("Y-m-d H:i:s"));
            $obs_pre = $observacion;
        }
        if ($rsin_id == 4) { //No aprueba
            if ($banderapreaprueba == 1) {
                $fecha_prenoprobacion = date(Yii::$app->params["dateTimeByDefault"]);
                $obs_pre = $observacion;
            } else {
                $fecha_reprobacion = date(Yii::$app->params["dateTimeByDefault"]);
                $obs_apro = $observacion;
            }
        }
        if ($rsin_id == 2) {   //Aprueba
            $fecha_aprobacion = date(Yii::$app->params["dateTimeByDefault"]);
            error_log("entro3" . date("Y-m-d H:i:s"));
            $obs_apro = $observacion;
        }
        $comando = $con->createCommand
                ("UPDATE " . $con->dbname . ".solicitud_inscripcion 
                SET sins_fecha_preaprobacion = ifnull(:fecha_preaprobacion,sins_fecha_preaprobacion),
                    sins_fecha_aprobacion = ifnull(:fecha_aprobacion,sins_fecha_aprobacion),
                    sins_fecha_reprobacion = ifnull(:fecha_reprobacion,sins_fecha_reprobacion),
                    sins_fecha_prenoprobacion = ifnull(:fecha_prenoprobacion,sins_fecha_prenoprobacion),
                    sins_observacion = ifnull(:observacion,sins_observacion),
                    sins_preobservacion = ifnull(:preobservacion,sins_preobservacion),
                    sins_usuario_preaprueba = ifnull(:usu_preaprueba,sins_usuario_preaprueba),
                    sins_usuario_aprueba = ifnull(:usu_aprueba,sins_usuario_aprueba),
                    rsin_id = :rsin_id,
                    sins_fecha_modificacion = :fecha_modificacion
                WHERE sins_id = :sins_id AND 
                      sins_estado =:estado AND
                      sins_estado_logico = :estado");

        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":sins_id", $sins_id, \PDO::PARAM_INT);
        $comando->bindParam(":rsin_id", $rsin_id, \PDO::PARAM_INT);
        $comando->bindParam(":fecha_preaprobacion", $fecha_preaprobacion, \PDO::PARAM_STR);
        $comando->bindParam(":fecha_aprobacion", $fecha_aprobacion, \PDO::PARAM_STR);
        $comando->bindParam(":fecha_reprobacion", $fecha_reprobacion, \PDO::PARAM_STR);
        $comando->bindParam(":fecha_prenoprobacion", $fecha_prenoprobacion, \PDO::PARAM_STR);
        $comando->bindParam(":observacion", $obs_apro, \PDO::PARAM_STR);
        $comando->bindParam(":preobservacion", $obs_pre, \PDO::PARAM_STR);
        $comando->bindParam(":fecha_modificacion", $fecha_modificacion, \PDO::PARAM_STR);
        $comando->bindParam(":usu_preaprueba", $usu_preaprueba, \PDO::PARAM_INT);
        $comando->bindParam(":usu_aprueba", $usu_aprueba, \PDO::PARAM_INT);

        $response = $comando->execute();
        return $response;
    }

    /**
     * Function Obtenerdatosolicitud
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  $resultData (el precio del curso por metodo de ingreso y nivel de interes y otros datos de solicitud)
     */
    public function Obtenerdatosolicitud($sins_id) {
        $con = \Yii::$app->db_captacion;
        $con2 = \Yii::$app->db_facturacion;
        $estado = 1;
        $estado_precio = 'A';

        $sql = "SELECT imni.imni_id, 
                       (case when sins.sins_beca = '1' then 0 
                            else format(ipre.ipre_precio+(ipre.ipre_precio*ifnull(ipre.ipre_porcentaje_iva,0)),2) end) as precio,
                       sins.nint_id as nivel_interes,
                       sins.ming_id as metodo_ingreso,
                       ming.ming_nombre as nombre_metodo_ingreso,
                       nint.nint_nombre as nombre_nivel_interes
                FROM " . $con->dbname . ".solicitud_inscripcion sins INNER JOIN " . $con2->dbname . ".item_metodo_nivel imni 
                    on (sins.ming_id = imni.ming_id and sins.nint_id = imni.nint_id)
                    INNER JOIN " . $con2->dbname . ".item_precio ipre on imni.ite_id = ipre.ite_id
                    INNER JOIN " . $con->dbname . ".metodo_ingreso ming on ming.ming_id = sins.ming_id
                    INNER JOIN " . $con->dbname . ".nivel_interes nint on nint.nint_id = sins.nint_id
                WHERE ipre.ipre_estado_precio = :estado_precio AND
                      sins.sins_id = :sins_id AND
                      sins.sins_estado = :estado AND
                      sins.sins_estado_logico = :estado AND
                      imni.imni_estado = :estado AND
                      imni.imni_estado_logico = :estado AND
                      ipre.ipre_estado = :estado AND
                      ipre.ipre_estado_logico = :estado AND 
                      ming.ming_estado = :estado AND
                      ming.ming_estado_logico = :estado AND
                      nint.nint_estado = :estado AND
                      nint.nint_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":sins_id", $sins_id, \PDO::PARAM_INT);
        $comando->bindParam(":estado_precio", $estado_precio, \PDO::PARAM_STR);
        $resultData = $comando->queryOne();
        return $resultData;
    }

    /**
     * Function Validarsolicitud
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  $resultData (Verificar si existe una solicitud igual a la que se quiere crear siempre y cuando 
     *          no tenga estado "No Aprobado").
     */
    public function Validarsolicitud($int_id, $nint_id, $ming_id, $car_id) {
        $con = \Yii::$app->db_captacion;
        $estado = 1;

        $sql = "SELECT 'S' existe
                FROM " . $con->dbname . ".solicitud_inscripcion sins
                WHERE sins.int_id = :int_id AND
                      sins.nint_id = :nint_id AND
                      sins.ming_id = :ming_id AND
                      sins.car_id = :car_id AND
                      sins.rsin_id <> 4 AND
                      sins.sins_estado = :estado AND
                      sins.sins_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":int_id", $int_id, \PDO::PARAM_INT);
        $comando->bindParam(":nint_id", $nint_id, \PDO::PARAM_INT);
        $comando->bindParam(":ming_id", $ming_id, \PDO::PARAM_INT);
        $comando->bindParam(":car_id", $car_id, \PDO::PARAM_INT);
        $resultData = $comando->queryOne();
        return $resultData;
    }

    /**
     * Function Consultarconsideraciondoc
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  $resultData (Retornar las consideraciones a tomar en cuenta en la revisión de documentos según 
     *                      el documento y la nacionalidad).
     */
    public function Consultarconsideraciondoc($dadj_id, $tiponacext) {
        $con = \Yii::$app->db_captacion;
        $estado = 1;

        $sql = "SELECT cdoc.con_id id, con.con_nombre name
                FROM " . $con->dbname . ".consideracion_documento cdoc INNER JOIN " . $con->dbname . ".consideracion con on cdoc.con_id = con.con_id
                WHERE cdoc.dadj_id = :dadj_id AND
                      cdoc.cdoc_tiponacext = :tiponacext AND
                      cdoc.cdoc_estado_logico = :estado AND
                      cdoc.cdoc_estado = :estado AND
                      con.con_estado_logico = :estado AND
                      con.con_estado = :estado
                ORDER BY cdoc.con_id";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":dadj_id", $dadj_id, \PDO::PARAM_INT);
        $comando->bindParam(":tiponacext", $tiponacext, \PDO::PARAM_STR);
        $resultData = $comando->queryAll();
        return $resultData;
    }

    /**
     * Function consultaDatosusuario
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  $resultData (usuario id de la persona con logon).
     */
    public function consultaDatosusuario($per_id) {
        $con = \Yii::$app->db;
        $estado = 1;

        $sql = "select  usu.usu_id
                from " . $con->dbname . ".usuario usu
                where usu.per_id = :per_id                    
                      and usu.usu_estado = :estado
                      and usu.usu_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
        $resultData = $comando->queryOne();
        return $resultData;
    }

    /**
     * Function Insertarsolicitudrechazada
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  Id del registro insertado.
     */
    public function Insertarsolicitudrechazada($sins_id, $dadj_id, $con_id, $srec_etapa, $srec_observacion, $usu_id) {
        $con = \Yii::$app->db_captacion;

        $trans = $con->getTransaction(); // se obtiene la transacción actual.
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una.
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una.
        }

        $param_sql = "srec_estado_logico";
        $bsrec_sql = "1";

        $param_sql .= ", srec_estado";
        $bsrec_sql .= ", 1";

        if (isset($sins_id)) {
            $param_sql .= ", sins_id";
            $bsrec_sql .= ", :sins_id";
        }

        if (isset($dadj_id)) {
            $param_sql .= ", dadj_id";
            $bsrec_sql .= ", :dadj_id";
        }

        if (isset($con_id)) {
            $param_sql .= ", con_id";
            $bsrec_sql .= ", :con_id";
        }

        if (isset($srec_etapa)) {
            $param_sql .= ", srec_etapa";
            $bsrec_sql .= ", :srec_etapa";
        }

        if (isset($srec_observacion)) {
            $param_sql .= ", srec_observacion";
            $bsrec_sql .= ", :srec_observacion";
        }

        if (isset($usu_id)) {
            $param_sql .= ", usu_id";
            $bsrec_sql .= ", :usu_id";
        }

        try {
            $sql = "INSERT INTO " . $con->dbname . ".solicitud_rechazada ($param_sql) VALUES($bsrec_sql)";
            $comando = $con->createCommand($sql);

            if (isset($sins_id))
                $comando->bindParam(':sins_id', $sins_id, \PDO::PARAM_INT);

            if (isset($dadj_id))
                $comando->bindParam(':dadj_id', $dadj_id, \PDO::PARAM_INT);

            if (isset($con_id))
                $comando->bindParam(':con_id', $con_id, \PDO::PARAM_INT);

            if (isset($srec_etapa))
                $comando->bindParam(':srec_etapa', $srec_etapa, \PDO::PARAM_STR);

            if (isset($srec_observacion))
                $comando->bindParam(':srec_observacion', $srec_observacion, \PDO::PARAM_STR);

            if (isset($usu_id))
                $comando->bindParam(':usu_id', $usu_id, \PDO::PARAM_INT);

            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.solicitud_rechazada');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }

    /**
     * Function consultaSolicitudRechazada
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  $resultData Datos de solicitud rechazada.
     */
    public function consultaSolicitudRechazada($sins_id, $srec_etapa) {
        $con = \Yii::$app->db_captacion;
        $estado = 1;

        $sql = "SELECT srec_observacion observacion, con.con_nombre condicion
                FROM " . $con->dbname . ".solicitud_rechazada srec INNER JOIN " . $con->dbname . ".consideracion con on con.con_id = srec.con_id
                WHERE   srec.sins_id = :sins_id AND
                        srec.srec_etapa = :etapa AND
                        srec.srec_estado = :estado AND
                        con.con_estado = :estado AND
                        srec.srec_estado_logico = :estado AND
                        con.con_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":etapa", $srec_etapa, \PDO::PARAM_STR);
        $comando->bindParam(":sins_id", $sins_id, \PDO::PARAM_INT);
        $resultData = $comando->queryAll();
        return $resultData;
    }

    /**
     * Function Consultaestadosolicitud
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  $resultData (Retornar los estados de las solicitudes).
     */
    public function Consultaestadosolicitud() {
        $con = \Yii::$app->db_captacion;
        $estado = 1;

        $sql = "SELECT rsin.rsin_id id, rsin.rsin_nombre value
                FROM " . $con->dbname . ".res_sol_inscripcion rsin 
                WHERE rsin.rsin_estado_logico = :estado AND
                      rsin.rsin_estado = :estado
                ORDER BY rsin.rsin_id";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $resultData = $comando->queryAll();
        return $resultData;
    }

    /**
     * Function Solicitudesaprobadas
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  $resultData (Retornar las solicitudes aprobadas).
     */
    public function Solicitudesaprobadas($arrFiltro = array(), $onlyData = false) {
        $con = \Yii::$app->db_captacion;
        $con1 = \Yii::$app->db_academico;
        $con2 = \Yii::$app->db;
        $estado = 1;
        $estadoaprobada = 2;
        $columnsAdd = "";

        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $str_search = "(per.per_pri_nombre like :search OR ";
            $str_search .= "per.per_seg_nombre like :search OR ";
            $str_search .= "per.per_pri_apellido like :search OR ";
            $str_search .= "per.per_cedula like :search) AND ";
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

        $sql = "SELECT
                    lpad(sins_id,4,'0') as num_solicitud,
                    sins_fecha_solicitud as fecha_solicitud,
                    per.per_id as persona,
                    inte.int_id as int_id,
                    per.per_cedula as per_dni,
                    per.per_pri_nombre as per_pri_nombre,                    
                    per.per_seg_nombre as per_seg_nombre,
                    per.per_pri_apellido as per_pri_apellido,
                    per.per_seg_apellido as per_seg_apellido,
                    nint.nint_nombre as nint_nombre,
                    ming.ming_nombre as ming_nombre,
                    car.car_nombre,
                    concat(per.per_pri_nombre ,' ', ifnull(per.per_seg_nombre,' ')) as per_nombres,
                    concat(per.per_pri_apellido ,' ', ifnull(per.per_seg_apellido,' ')) as per_apellidos,
                    sins.sins_fecha_solicitud as fecha_solicitud,
                    rsol.rsin_nombre as estado,
                    sins.sins_id,                    
                    intej.per_id as ejecutivo,
                    (Select concat(pers.per_pri_nombre ,' ', pers.per_pri_apellido) as ejecutivo_asignado 
                     from " . $con2->dbname . ".persona pers where pers.per_id = ejecutivo) as ejecutivo_asignado,
                    sins_fecha_preaprobacion,
                    sins_fecha_aprobacion,
                    sins_fecha_reprobacion,
                    sins_fecha_prenoprobacion,
                    sins_observacion,
                    $columnsAdd                    
                    sins.sins_usuario_preaprueba as usu_preaprueba                    
                FROM 
                    " . $con->dbname . ".solicitud_inscripcion as sins
                    INNER JOIN " . $con->dbname . ".interesado as inte on sins.int_id = inte.int_id
                    INNER JOIN " . $con->dbname . ".pre_interesado as pint on inte.pint_id = pint.pint_id
                    INNER JOIN " . $con2->dbname . ".persona as per on pint.per_id = per.per_id 
                    INNER JOIN " . $con->dbname . ".nivel_interes as nint on sins.nint_id = nint.nint_id 
                    INNER JOIN " . $con->dbname . ".metodo_ingreso as ming on sins.ming_id = ming.ming_id
                    INNER JOIN " . $con->dbname . ".res_sol_inscripcion as rsol on rsol.rsin_id = sins.rsin_id                    
                    INNER JOIN " . $con->dbname . ".interesado_ejecutivo as intej on (intej.int_id = sins.int_id) or (intej.pint_id = pint.pint_id)                     
                    INNER JOIN " . $con1->dbname . ".carrera as car on car.car_id = sins.car_id 
                WHERE 
                    $str_search
                    sins.rsin_id = :aprobada AND
                    sins.sins_estado_logico=:estado AND
                    inte.int_estado_logico=:estado AND
                    pint.pint_estado_logico=:estado AND
                    per.per_estado_logico=:estado AND
                    sins.sins_estado=:estado AND
                    inte.int_estado=:estado AND
                    pint.pint_estado=:estado AND
                    per.per_estado=:estado AND
                    intej.ieje_estado = :estado AND
                    intej.ieje_estado_logico = :estado AND
                    car.car_estado=:estado AND
                    car.car_estado_logico=:estado 
                ORDER BY fecha_solicitud DESC";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":aprobada", $estadoaprobada, \PDO::PARAM_INT);

        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $search_cond = "%" . $arrFiltro["search"] . "%";
            $fecha_ini = $arrFiltro["f_ini"];
            $fecha_fin = $arrFiltro["f_fin"];
            $comando->bindParam(":search", $search_cond, \PDO::PARAM_STR);
            if ($arrFiltro['f_ini'] != "" && $arrFiltro['f_fin'] != "") {
                $comando->bindParam(":fec_ini", $fecha_ini, \PDO::PARAM_STR);
                $comando->bindParam(":fec_fin", $fecha_fin, \PDO::PARAM_STR);
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
                    'num_solicitud',
                    'fecha_solicitud',
                    'per_dni',
                    'per_pri_nombre',
                    'per_seg_nombre',
                    'per_pri_apellido',
                    'per_seg_apellido',
                    'nint_nombre',
                    'ming_nombre',
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
