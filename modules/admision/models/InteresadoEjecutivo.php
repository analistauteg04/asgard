<?php

namespace app\modules\admision\models;

use Yii;
use yii\data\ArrayDataProvider;

/**
 * This is the model class for table "interesado_ejecutivo".
 *
 * @property integer $ieje_id
 * @property integer $int_id
 * @property integer $per_id
 * @property string $ieje_estado
 * @property string $ieje_fecha_creacion
 * @property string $ieje_fecha_modificacion
 * @property string $ieje_estado_logico
 *
 * @property Interesado $int
 */
class InteresadoEjecutivo extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        //return 'interesado_ejecutivo';
        return \Yii::$app->db_captacion->dbname . '.interesado_ejecutivo';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb() {
        return Yii::$app->get('db_captacion');
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['int_id', 'per_id', 'ieje_estado', 'ieje_estado_logico'], 'required'],
            [['int_id', 'per_id'], 'integer'],
            [['ieje_fecha_creacion', 'ieje_fecha_modificacion'], 'safe'],
            [['ieje_estado', 'ieje_estado_logico'], 'string', 'max' => 1],
            [['int_id'], 'exist', 'skipOnError' => true, 'targetClass' => Interesado::className(), 'targetAttribute' => ['int_id' => 'int_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'ieje_id' => 'Ieje ID',
            'int_id' => 'Int ID',
            'per_id' => 'Per ID',
            'ieje_estado' => 'Ieje Estado',
            'ieje_fecha_creacion' => 'Ieje Fecha Creacion',
            'ieje_fecha_modificacion' => 'Ieje Fecha Modificacion',
            'ieje_estado_logico' => 'Ieje Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInt() {
        return $this->hasOne(Interesado::className(), ['int_id' => 'int_id']);
    }

    /**
     * Function consultarInteresados
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  $resultData (información diferenciando cuando es pre-interesado, interesado y aspirante)
     */
    public static function consultarInteresados($arrFiltro = array(), $onlyData = false) {
        $con = \Yii::$app->db_captacion;
        $con2 = \Yii::$app->db;
        $con3 = \Yii::$app->db_facturacion;
        $con4 = \Yii::$app->db_academico;
        $estado = 1;
        $columnsAdd = "";
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $str_search = "(base.per_pri_nombre like :search OR ";
            $str_search .= "base.per_seg_nombre like :search OR ";
            $str_search .= "base.per_pri_apellido like :search OR ";
            $str_search .= "base.per_dni like :search) ";
            if ($arrFiltro['ejecutivo'] != "" && $arrFiltro['ejecutivo'] > 0) {
                $str_search .= " AND base.idejecutivo = :ejecutivo ";
            }
            if ($arrFiltro['f_ini'] != "" && $arrFiltro['f_fin'] != "") {
                $str_search .= " AND base.fecha_registro >= :fec_ini AND ";
                $str_search .= " base.fecha_registro <= :fec_fin ";
            }
        } else {
            $columnsAdd = "
                    per.per_id as persona";
        }

        $sql = "SELECT * FROM
                (SELECT 
                    '0000' as solicitud,
                    'N/A' as sins_fecha_solicitud,
                    per.per_cedula as per_dni,
                    per.per_pri_nombre as per_pri_nombre,                    
                    per.per_seg_nombre as per_seg_nombre,
                    per.per_pri_apellido as per_pri_apellido,
                    per.per_seg_apellido as per_seg_apellido,
                    concat(per.per_pri_nombre ,' ', ifnull(per.per_seg_nombre,' ')) as per_nombres,
                    concat(per.per_pri_apellido ,' ', ifnull(per.per_seg_apellido,' ')) as per_apellidos,
                    concat(per.per_pri_nombre ,' ', ifnull(per.per_pri_apellido,' ')) as per_nombresc,
                    pint.pint_id,
                    null as int_id,
                    null as asp_id,
                    (SELECT ieje.per_id
                     FROM " . $con->dbname . ".interesado_ejecutivo ieje 
                     WHERE ieje.pint_id = pint.pint_id AND			   
                           ieje.ieje_estado = :estado AND 
                           ieje.ieje_estado_logico = :estado) as idejecutivo,               
                    (case when ifnull((SELECT concat(per.per_pri_apellido,' ',per.per_pri_nombre) as ejecutivo				
                                        FROM " . $con->dbname . ".interesado_ejecutivo ieje INNER JOIN " . $con2->dbname . ".persona per on ieje.per_id = per.per_id
					WHERE ieje.pint_id = pint.pint_id AND			   
                                              ieje.ieje_estado = :estado AND 
                                              ieje.ieje_estado_logico = :estado),'') ='' then 'Pendiente por Asignar' 
                        else (SELECT concat(per.per_pri_apellido,' ',per.per_pri_nombre) as ejecutivo				
                                FROM " . $con->dbname . ".interesado_ejecutivo ieje "
                .                    "INNER JOIN " . $con2->dbname . ".persona per on ieje.per_id = per.per_id
                                WHERE ieje.pint_id = pint.pint_id AND			   
                                      ieje.ieje_estado = :estado AND 
                                      ieje.ieje_estado_logico = :estado) end )as ejecutivo,
                    'Pendiente Ficha Datos' as estado,
                    per.per_id as persona,
                    solic.rcap_fecha_ingreso as fecha_registro,
                    uni.uaca_nombre as unidad,
                    moda.mod_nombre as modalidad
                FROM " . $con->dbname . ".pre_interesado as pint "
                . " INNER JOIN " . $con2->dbname . ".persona as per on pint.per_id = per.per_id 
                    INNER JOIN " . $con2->dbname . ".persona_preins as perp on perp.ppre_cedula = per.per_cedula
                    INNER JOIN " . $con->dbname . ".solicitud_captacion as solic on solic.per_id = per.per_id 
                    INNER JOIN " . $con4->dbname . ".unidad_academica as uni on uni.uaca_id = solic.uaca_id
                    INNER JOIN " . $con4->dbname . ".modalidad as moda on moda.mod_id = solic.ming_id    
                WHERE 	                       
                        pint_estado_preinteresado=:estado AND
                        pint.pint_estado_logico=:estado AND
                        per.per_estado_logico=:estado AND 
                        perp.ppre_estado=:estado AND 
                        perp.ppre_estado_logico=:estado AND  
                        pint.pint_estado=:estado AND
                        per.per_estado=:estado AND
                        uni.uaca_estado=:estado AND 
                        uni.uaca_estado_logico=:estado AND 
                        moda.mod_estado=:estado AND 
                        moda.mod_estado_logico=:estado 
                UNION    
                SELECT  '0000' as solicitud,
                        'N/A' as sins_fecha_solicitud,
                        per.per_cedula as per_dni,
                        per.per_pri_nombre as per_pri_nombre, 
                        per.per_seg_nombre as per_seg_nombre,
                        per.per_pri_apellido as per_pri_apellido,
                        per.per_seg_apellido as per_seg_apellido,
                        concat(per.per_pri_nombre ,' ', ifnull(per.per_seg_nombre,' ')) as per_nombres,
                        concat(per.per_pri_apellido ,' ', ifnull(per.per_seg_apellido,' ')) as per_apellidos,
                        concat(per.per_pri_nombre ,' ', ifnull(per.per_pri_apellido,' ')) as per_nombresc,
                        pint.pint_id,
                        inte.int_id,
                        null as asp_id,
                        (SELECT ieje.per_id
                            FROM " . $con->dbname . ".interesado_ejecutivo ieje 
                            WHERE (ieje.int_id = inte.int_id or ieje.pint_id = inte.pint_id) AND	
                            ieje.ieje_estado = :estado AND 
                            ieje.ieje_estado_logico = :estado) as idejecutivo,
                        (case when ifnull(
                        (SELECT concat(per.per_pri_apellido,' ',per.per_pri_nombre) as ejecutivo 
                            FROM " . $con->dbname . ".interesado_ejecutivo ieje INNER JOIN " . $con2->dbname . ".persona per on ieje.per_id = per.per_id
                            WHERE (ieje.int_id = inte.int_id or ieje.pint_id = inte.pint_id) AND	
                            ieje.ieje_estado = :estado AND 
                            ieje.ieje_estado_logico = :estado),'') ='' then 'Pendiente por Asignar' 
                        else (SELECT concat(per.per_pri_apellido,' ',per.per_pri_nombre) as ejecutivo 
                            FROM " . $con->dbname . ".interesado_ejecutivo ieje INNER JOIN " . $con2->dbname . ".persona per on ieje.per_id = per.per_id
                        WHERE (ieje.int_id = inte.int_id or ieje.pint_id = inte.pint_id) AND	
                            ieje.ieje_estado = :estado AND 
                            ieje.ieje_estado_logico = :estado) end) as ejecutivo,
                            'Pendiente Crear Solicitud' as estado,
                        per.per_id as persona,
                        solic.rcap_fecha_ingreso as fecha_registro,
                        uni.uaca_nombre as unidad,
                        moda.mod_nombre as modalidad
                        FROM " . $con->dbname . ".interesado as inte
                            INNER JOIN " . $con->dbname . ".pre_interesado as pint on inte.pint_id = pint.pint_id
                            INNER JOIN " . $con2->dbname . ".persona as per on pint.per_id = per.per_id                             
                            INNER JOIN " . $con->dbname . ".solicitud_captacion as solic on solic.per_id = per.per_id     
                            INNER JOIN " . $con2->dbname . ".persona_preins as perp on perp.ppre_cedula = per.per_cedula                    
                            INNER JOIN " . $con4->dbname . ".unidad_academica as uni on uni.uaca_id = solic.uaca_id
                            INNER JOIN " . $con4->dbname . ".modalidad as moda on moda.mod_id = solic.ming_id     
                        WHERE inte.int_estado_interesado='1' AND
                            not exists(select 'S' from " . $con->dbname . ".solicitud_inscripcion as soli where soli.int_id = inte.int_id) AND                                                       
                            inte.int_estado_logico=:estado AND
                            pint.pint_estado_logico=:estado AND
                            pint.pint_estado=:estado AND
                            perp.ppre_estado=:estado AND 
                            perp.ppre_estado_logico=:estado AND
                            per.per_estado_logico=:estado AND
                            inte.int_estado=:estado AND 
                            per.per_estado=:estado AND
                            uni.uaca_estado=:estado AND 
                            uni.uaca_estado_logico=:estado AND 
                            moda.mod_estado=:estado AND 
                            moda.mod_estado_logico=:estado 
                UNION
                SELECT 
                    lpad(soli.sins_id,4,'0') as solicitud,
                    soli.sins_fecha_solicitud,
                    per.per_cedula as per_dni,
                    per.per_pri_nombre as per_pri_nombre,                    
                    per.per_seg_nombre as per_seg_nombre,
                    per.per_pri_apellido as per_pri_apellido,
                    per.per_seg_apellido as per_seg_apellido,
                    concat(per.per_pri_nombre ,' ', ifnull(per.per_seg_nombre,' ')) as per_nombres,
                    concat(per.per_pri_apellido ,' ', ifnull(per.per_seg_apellido,' ')) as per_apellidos,
                    concat(per.per_pri_nombre ,' ', ifnull(per.per_pri_apellido,' ')) as per_nombresc,
                    pint.pint_id,
                    inte.int_id,
                    null as asp_id,
                    (SELECT ieje.per_id
                    FROM " . $con->dbname . ".interesado_ejecutivo ieje 
                    WHERE (ieje.int_id = inte.int_id or ieje.pint_id = inte.pint_id) AND		   
                          ieje.ieje_estado = :estado AND 
                          ieje.ieje_estado_logico = :estado) as idejecutivo,
                    (case when ifnull(
                       (SELECT concat(per.per_pri_apellido,' ',per.per_pri_nombre) as ejecutivo  
                        FROM " . $con->dbname . ".interesado_ejecutivo ieje INNER JOIN " . $con2->dbname . ".persona per on ieje.per_id = per.per_id
                        WHERE (ieje.int_id = inte.int_id or ieje.pint_id = inte.pint_id) AND	   
                              ieje.ieje_estado = :estado AND 
                              ieje.ieje_estado_logico = :estado),'') ='' then 'Pendiente por Asignar' 
                        else (SELECT concat(per.per_pri_apellido,' ',per.per_pri_nombre) as ejecutivo  
                        FROM " . $con->dbname . ".interesado_ejecutivo ieje INNER JOIN " . $con2->dbname . ".persona per on ieje.per_id = per.per_id
                        WHERE (ieje.int_id = inte.int_id or ieje.pint_id = inte.pint_id) AND		   
                              ieje.ieje_estado = :estado AND 
                              ieje.ieje_estado_logico = :estado) end) as ejecutivo,
                    concat('Solicitud ',rsol.rsin_nombre) as estado,
                    per.per_id as persona,
                    solic.rcap_fecha_ingreso as fecha_registro,
                    uni.uaca_nombre as unidad,
                    moda.mod_nombre as modalidad
                FROM 
                    " . $con->dbname . ".interesado as inte
                    INNER JOIN " . $con->dbname . ".pre_interesado as pint on inte.pint_id = pint.pint_id
                    INNER JOIN " . $con2->dbname . ".persona as per on pint.per_id = per.per_id 
                    INNER JOIN " . $con->dbname . ".solicitud_inscripcion as soli on soli.int_id = inte.int_id
                    INNER JOIN " . $con->dbname . ".res_sol_inscripcion rsol on rsol.rsin_id = soli.rsin_id                    
                    INNER JOIN " . $con->dbname . ".solicitud_captacion as solic on solic.per_id = per.per_id     
                    INNER JOIN " . $con2->dbname . ".persona_preins as perp on perp.ppre_cedula = per.per_cedula
                    INNER JOIN " . $con4->dbname . ".unidad_academica as uni on uni.uaca_id = solic.uaca_id
                    INNER JOIN " . $con4->dbname . ".modalidad as moda on moda.mod_id = solic.ming_id                            
                WHERE
                    inte.int_estado_interesado=:estado AND
                    inte.int_estado_logico=:estado AND
                    pint.pint_estado_logico=:estado AND
                    soli.sins_estado_logico=:estado AND                    
                    rsol.rsin_estado_logico = :estado AND
                    pint.pint_estado=:estado AND
                    per.per_estado_logico=:estado AND
                    perp.ppre_estado=:estado AND 
                    perp.ppre_estado_logico=:estado AND
                    inte.int_estado=:estado AND                    
                    per.per_estado=:estado AND
                    soli.sins_estado=:estado AND
                    rsol.rsin_estado = :estado AND
                    uni.uaca_estado=:estado AND 
                    uni.uaca_estado_logico=:estado AND 
                    moda.mod_estado=:estado AND 
                    moda.mod_estado_logico=:estado 
         UNION
                SELECT  lpad(soli.sins_id,4,'0') as solicitud,
                        soli.sins_fecha_solicitud,
                        per.per_cedula as per_dni,
                        per.per_pri_nombre as per_pri_nombre,                    
                        per.per_seg_nombre as per_seg_nombre,
                        per.per_pri_apellido as per_pri_apellido,
                        per.per_seg_apellido as per_seg_apellido,
                        concat(per.per_pri_nombre ,' ', ifnull(per.per_seg_nombre,' ')) as per_nombres,
                        concat(per.per_pri_apellido ,' ', ifnull(per.per_seg_apellido,' ')) as per_apellidos,
                        concat(per.per_pri_nombre ,' ', ifnull(per.per_pri_apellido,' ')) as per_nombresc,
                        pint.pint_id,
                        inte.int_id,
                        asp.asp_id,
                        (SELECT ieje.per_id
                         FROM " . $con->dbname . ".interesado_ejecutivo ieje 
                         WHERE (ieje.int_id = inte.int_id or ieje.pint_id = inte.pint_id or ieje.asp_id = asp.asp_id) AND			   
                               ieje.ieje_estado = :estado AND 
                               ieje.ieje_estado_logico = :estado) as idejecutivo,
                        (case when ifnull((SELECT concat(per.per_pri_apellido,' ',per.per_pri_nombre) as ejecutivo  
                                            FROM " . $con->dbname . ".interesado_ejecutivo ieje INNER JOIN " . $con2->dbname . ".persona per on ieje.per_id = per.per_id
                                            WHERE (ieje.int_id = inte.int_id or ieje.pint_id = inte.pint_id or ieje.asp_id = asp.asp_id) AND		   
                                                  ieje.ieje_estado = :estado AND 
                                                  ieje.ieje_estado_logico = :estado),'') ='' then 'Pendiente por Asignar' 
                                else (SELECT concat(per.per_pri_apellido,' ',per.per_pri_nombre) as ejecutivo  
                                    FROM " . $con->dbname . ".interesado_ejecutivo ieje INNER JOIN " . $con2->dbname . ".persona per on ieje.per_id = per.per_id
                                    WHERE (ieje.int_id = inte.int_id or ieje.pint_id = inte.pint_id or ieje.asp_id = asp.asp_id) AND		   
                                          ieje.ieje_estado = :estado AND 
                                          ieje.ieje_estado_logico = :estado) end) as ejecutivo,	
                        (case when ifnull((select (CASE WHEN ordp.opag_estado_pago = 'S' THEN 'Solicitud Pagada' ELSE 'Solicitud Pendiente Pago' END) as estado
                                            from " . $con3->dbname . ".orden_pago ordp
                                            where ordp.sins_id = soli.sins_id and
                                                   ordp.opag_estado_logico= :estado and
                                                   ordp.opag_estado =:estado),' ') = ' ' then
                                    concat('Solicitud ',rsol.rsin_nombre)
                              else (select (CASE WHEN ordp.opag_estado_pago = 'S' THEN 'Solicitud Pagada' ELSE 'Solicitud Pendiente Pago' END) as estado
                                            from " . $con3->dbname . ".orden_pago ordp
                                            where ordp.sins_id = soli.sins_id and
                                                   ordp.opag_estado_logico=:estado and
                                                   ordp.opag_estado =:estado) end) as estado,
                        per.per_id as persona,
                        solic.rcap_fecha_ingreso as fecha_registro,                        
                        uni.uaca_nombre as unidad,
                        moda.mod_nombre as modalidad
                FROM " . $con->dbname . ".aspirante as asp
                        INNER JOIN " . $con->dbname . ".interesado as inte on inte.int_id = asp.int_id
                        INNER JOIN " . $con->dbname . ".pre_interesado as pint on inte.pint_id = pint.pint_id
                        INNER JOIN " . $con2->dbname . ".persona as per on pint.per_id = per.per_id
                        INNER JOIN " . $con->dbname . ".solicitud_inscripcion as soli on soli.int_id = inte.int_id                        
                        INNER JOIN " . $con->dbname . ".res_sol_inscripcion rsol on rsol.rsin_id = soli.rsin_id                            
                        INNER JOIN " . $con->dbname . ".solicitud_captacion as solic on solic.per_id = per.per_id    
                        INNER JOIN " . $con2->dbname . ".persona_preins as perp on perp.ppre_cedula = per.per_cedula
                        INNER JOIN " . $con4->dbname . ".unidad_academica as uni on uni.uaca_id = solic.uaca_id
                        INNER JOIN " . $con4->dbname . ".modalidad as moda on moda.mod_id = solic.ming_id    
                WHERE   
                        asp.asp_estado_logico = :estado AND
                        inte.int_estado_logico=:estado AND 	
                        per.per_estado_logico= :estado AND
                        soli.sins_estado_logico=:estado AND
                        rsol.rsin_estado_logico = :estado AND
                        asp.asp_estado = :estado AND
                        per.per_estado=:estado AND
                        perp.ppre_estado=:estado AND 
                        perp.ppre_estado_logico=:estado AND
                        soli.sins_estado=:estado AND
                        rsol.rsin_estado = :estado AND
                        uni.uaca_estado=:estado AND 
                        uni.uaca_estado_logico=:estado AND 
                        moda.mod_estado=:estado AND 
                        moda.mod_estado_logico=:estado) as base";
        if (!empty($str_search)) {
            $sql .= " where " . $str_search . " ORDER BY fecha_registro desc";
        } else {
            $sql .= " ORDER BY fecha_registro desc";
        }

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $search_cond = "%" . $arrFiltro["search"] . "%";
            $fecha_ini = $arrFiltro["f_ini"] . " 00:00:00";
            $fecha_fin = $arrFiltro["f_fin"] . " 23:59:59";
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
                    'per_dni',
                    'per_pri_nombre',
                    'per_seg_nombre',
                    'per_pri_apellido',
                    'per_seg_apellido',
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
     * Function consultarEjecutivos
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  $resultData (información de las personas tipo agente o ejecutivo)
     */
    public function consultarEjecutivos($per_id) {
        $con = \Yii::$app->db_crm;
        $estado = 1;

        $sql = "SELECT distinct pa.per_id id, pa.padm_codigo value
                FROM " . $con->dbname . ".personal_admision pa INNER JOIN " . $con->dbname . ".personal_admision_cargo pac on pac.padm_id = pa.padm_id
                     INNER JOIN " . $con->dbname . ".personal_nivel_modalidad pnm on pnm.paca_id = pac.paca_id
                WHERE pa.per_id != :per_id
                      and pnm.mod_id in (SELECT mod_id
					 FROM " . $con->dbname . ".personal_admision pa INNER JOIN " . $con->dbname . ".personal_admision_cargo pac on pac.padm_id = pa.padm_id
					      INNER JOIN " . $con->dbname . ".personal_nivel_modalidad pnm on pnm.paca_id = pac.paca_id
					 WHERE pa.per_id = :per_id)
                      and pnm.nint_id in (SELECT nint_id
                                          FROM " . $con->dbname . ".personal_admision pa INNER JOIN " . $con->dbname . ".personal_admision_cargo pac on pac.padm_id = pa.padm_id
                                               INNER JOIN " . $con->dbname . ".personal_nivel_modalidad pnm on pnm.paca_id = pac.paca_id
                                          WHERE pa.per_id = :per_id)";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);

        $resultData = $comando->queryAll();
        return $resultData;
    }

    /**
     * Function consultarAsignacion
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  $resultData (Encuentra el ejecutivo o agente asignado.)
     */
    public function consultarAsignacion($pint_id, $int_id) {
        $con = \Yii::$app->db_captacion;
        $estado = 1;
        $id = $int_id;
        $pid = $pint_id;
        if (empty(isset($int_id))) {
            $id = 0;
        }
        if (empty(isset($pint_id))) {
            $pid = 0;
        }
        $sql = "SELECT ieje.per_id, ieje.ieje_id
                FROM " . $con->dbname . ".interesado_ejecutivo ieje
                WHERE (ieje.pint_id = :pid OR ieje.int_id = :id) AND
                       ieje.ieje_estado = :estado AND
                       ieje.ieje_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":pid", $pid, \PDO::PARAM_INT);
        $comando->bindParam(":id", $id, \PDO::PARAM_INT);

        $resultData = $comando->queryOne();
        return $resultData;
    }

    /**
     * Function insertarAsignacion
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  Id del ingreso de la asignación
     */
    public function insertarAsignacion($pint_id, $int_id, $asp_id, $per_id, $ieje_usuario) {
        $con = \Yii::$app->db_captacion;

        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        $param_sql = "ieje_estado_logico";
        $binteje_sql = "1";

        $param_sql .= ", ieje_estado";
        $binteje_sql .= ", 1";

        $param_sql .= ", ieje_estado_asignacion";
        $binteje_sql .= ", 1";

        if (!empty($pint_id)) {
            if (isset($pint_id)) {
                $param_sql .= ", pint_id";
                $binteje_sql .= ", :pint_id";
            }
        }

        if (!empty($int_id)) {
            if (isset($int_id)) {
                $param_sql .= ", int_id";
                $binteje_sql .= ", :int_id";
            }
        }

        if (!empty($asp_id)) {
            if (isset($asp_id)) {
                $param_sql .= ", asp_id";
                $binteje_sql .= ", :asp_id";
            }
        }

        if (isset($per_id)) {
            $param_sql .= ", per_id";
            $binteje_sql .= ", :per_id";
        }

        if (isset($ieje_usuario)) {
            $param_sql .= ", ieje_usuario";
            $binteje_sql .= ", :ieje_usuario";
        }

        try {
            $sql = "INSERT INTO " . $con->dbname . ".interesado_ejecutivo ($param_sql) VALUES($binteje_sql)";
            $comando = $con->createCommand($sql);

            if (!empty($pint_id)) {
                if (isset($pint_id))
                    $comando->bindParam(':pint_id', $pint_id, \PDO::PARAM_INT);
            }

            if (!empty($int_id)) {
                if (isset($int_id))
                    $comando->bindParam(':int_id', $int_id, \PDO::PARAM_INT);
            }

            if (!empty($asp_id)) {
                if (isset($asp_id))
                    $comando->bindParam(':asp_id', $asp_id, \PDO::PARAM_INT);
            }

            if (isset($per_id)) {
                $comando->bindParam(':per_id', $per_id, \PDO::PARAM_INT);
            }

            if (isset($ieje_usuario)) {
                $comando->bindParam(':ieje_usuario', $ieje_usuario, \PDO::PARAM_INT);
            }

            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.interesado_ejecutivo');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }

    /**
     * Function consultarListaEjecutivos
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  $resultData (Lista los ejecutivos, supervisor y jefe según nivel de interés y modalidad.)
     */
    public function consultarListaEjecutivos($nivel, $modalidad, $per_id) {
        $con = \Yii::$app->db_crm;
        $estado = 1;

        $sql = "SELECT per_id id, padm_codigo name
                FROM " . $con->dbname . ".personal_nivel_modalidad pnm inner join " . $con->dbname . ".personal_admision_cargo pac on pac.paca_id = pnm.paca_id
                inner join " . $con->dbname . ".personal_admision pad on pad.padm_id = pac.padm_id
                WHERE uaca_id = :nint_id and
                      mod_id = :mod_id and
                      per_id != :per_id and
                      padm_estado = :estado and
                      padm_estado_logico = :estado and
                      paca_estado = :estado and
                      paca_estado_logico = :estado and
                      pnmo_estado = :estado and
                      pnmo_estado_logico= :estado
                ORDER BY 2";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
        $comando->bindParam(":mod_id", $modalidad, \PDO::PARAM_INT);
        $comando->bindParam(":nint_id", $nivel, \PDO::PARAM_INT);

        $resultData = $comando->queryAll();
        return $resultData;
    }

    /**
     * Function consultarNivelAgente
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  $resultData (Encuentra el nivel de interés a la que pertenece la 
     *          persona logueada: "el que asigna".)
     */
    public function consultarNivelAgente($per_id) {
        $con = \Yii::$app->db_crm;
        $con1 = \Yii::$app->db_academico;
        $estado = 1;

        $sql = "SELECT distinct pnm.uaca_id as id, uaca.uaca_nombre as value
                FROM " . $con->dbname . ".personal_admision pad inner join " . $con->dbname . ".personal_admision_cargo pac  
                     on pad.padm_id = pac.padm_id inner join " . $con->dbname . ".personal_nivel_modalidad pnm  
                     on pac.paca_id = pnm.paca_id inner join " . $con1->dbname . ".unidad_academica uaca
                     on uaca.uaca_id = pnm.uaca_id
                WHERE per_id = :per_id and
                      padm_estado = :estado and
                      padm_estado_logico = :estado and
                      paca_estado = :estado and
                      paca_estado_logico = :estado and
                      pnmo_estado = :estado and
                      pnmo_estado_logico= :estado and
                      uaca_estado = :estado and
                      uaca_estado_logico = :estado ";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);

        $resultData = $comando->queryAll();
        return $resultData;
    }

    /**
     * Function consultarModalidad
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  $resultData (Encuentra la modalidad a la que pertenece la 
     *          persona logueada: "el que asigna".)
     */
    public function consultarModalidad($per_id) {
        $con = \Yii::$app->db_crm;
        $con1 = \Yii::$app->db_academico;
        $estado = 1;

        $sql = "SELECT pnm.mod_id as id, m.mod_nombre as value
                FROM " . $con->dbname . ".personal_admision pad inner join " . $con->dbname . ".personal_admision_cargo pac  
                     on pad.padm_id = pac.padm_id inner join " . $con->dbname . ".personal_nivel_modalidad pnm  
                     on pac.paca_id = pnm.paca_id inner join " . $con1->dbname . ".modalidad m
                     on m.mod_id = pnm.mod_id
                WHERE per_id = :per_id and
                      padm_estado = :estado and
                      padm_estado_logico = :estado and
                      paca_estado = :estado and
                      paca_estado_logico = :estado and
                      pnmo_estado = :estado and
                      pnmo_estado_logico= :estado and
                      mod_estado = :estado and
                      mod_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);

        $resultData = $comando->queryAll();
        return $resultData;
    }

    /**
     * Function inactivarAsignacion que inactiva el registro anterior de asignación.
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function inactivarAsignacion($ejecutivo_id) {
        $con = \Yii::$app->db_captacion;
        $estado = 1;
        $estado_inactiva = 0;
        $fecha_modificacion = date("Y-m-d H:i:s");

        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una.
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una.
        }

        try {
            $comando = $con->createCommand
                    ("UPDATE " . $con->dbname . ".interesado_ejecutivo		       
                      SET ieje_estado_asignacion = :estado_inactiva,
                          ieje_estado = :estado_inactiva,
                          ieje_fecha_modificacion = ifnull(:fecha_modificacion,ieje_fecha_modificacion)
                      WHERE 
                        ieje_id = :ieje_id AND                        
                        ieje_estado = :estado AND
                        ieje_estado_logico = :estado");

            $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
            $comando->bindParam(":fecha_modificacion", $fecha_modificacion, \PDO::PARAM_STR);
            $comando->bindParam(":ieje_id", $ejecutivo_id, \PDO::PARAM_INT);
            $comando->bindParam(":estado_inactiva", $estado_inactiva, \PDO::PARAM_STR);

            $response = $comando->execute();

            if ($trans !== null)
                $trans->commit();
            return $response;
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }

    public function consultarInteresadoEjecutivoById($int_id) {
        $con = \Yii::$app->db_captacion;
        $estado = 1;
        $sql = "
                    SELECT
                    ifnull(ieje_id,0) as ieje_id
                    FROM db_captacion.interesado_ejecutivo
                    WHERE 
                    int_id = $int_id
                    and ieje_estado = $estado
                    and ieje_estado_logico=$estado
                ";
        $comando = $con->createCommand($sql);
        $resultData = $comando->queryOne();
        if (empty($resultData['ieje_id']))
            return 0;
        else {
            return $resultData['ieje_id'];
        }
    }

    public function insertarInteresadoEjecutivo($con, $parameters, $keys, $name_table) {
        $trans = $con->getTransaction();
        $param_sql .= "" . $keys[0];
        $bdet_sql .= "'" . $parameters[0] . "'";
        for ($i = 1; $i < count($parameters); $i++) {
            if (isset($parameters[$i])) {
                $param_sql .= ", " . $keys[$i];
                $bdet_sql .= ", '" . $parameters[$i] . "'";
            }
        }
        try {
            $sql = "INSERT INTO " . $con->dbname . '.' . $name_table . " ($param_sql) VALUES($bdet_sql);";
            $comando = $con->createCommand($sql);
            $result = $comando->execute();
            $idtable = $con->getLastInsertID($con->dbname . '.' . $name_table);
            if ($trans !== null)
                $trans->commit();
            return $idtable;
        } catch (Exception $ex) {
            if ($trans !== null) {
                $trans->rollback();
            }
            return 0;
        }
    }

    /**
     * Function consultarNivelModal
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  $resultData (Encuentra la modalidad y nivel de interés a la que pertenece la 
     *          persona logueada: "el que asigna", sólo obtiene un registro.)
     */
    public function consultarNivelModal($per_id) {
        $con = \Yii::$app->db_crm;
        $estado = 1;

        $sql = "SELECT pnm.uaca_id, pnm.mod_id
                FROM " . $con->dbname . ".personal_admision pad inner join " . $con->dbname . ".personal_admision_cargo pac  
                     on pad.padm_id = pac.padm_id inner join " . $con->dbname . ".personal_nivel_modalidad pnm  
                     on pac.paca_id = pnm.paca_id 
                WHERE per_id = :per_id and
                      padm_estado = :estado and
                      padm_estado_logico = :estado and
                      paca_estado = :estado and
                      paca_estado_logico = :estado and
                      pnmo_estado = :estado and
                      pnmo_estado_logico= :estado
                ORDER BY 1,2
                LIMIT 1 ";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);

        $resultData = $comando->queryOne();
        return $resultData;
    }

    public static function consultarAgentes() {
        $con = \Yii::$app->db_crm;
        $con1 = \Yii::$app->db_asgard;
        $estado = 1;
        $sql = "SELECT 
                    per.per_id AS id,
                    concat(per.per_pri_apellido,' ',per.per_pri_nombre) AS name
                FROM 
                     " . $con->dbname . ".personal_admision as pad
                     INNER JOIN " . $con1->dbname . ".persona per on per.per_id = pad.per_id
                WHERE 
                    pad.padm_estado_logico=:estado AND
                    pad.padm_estado=:estado AND
                    per.per_estado_logico=:estado AND
                    per.per_estado=:estado
                ORDER BY name ASC";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);       
        $resultData = $comando->queryAll();
        return $resultData;
    }

}
