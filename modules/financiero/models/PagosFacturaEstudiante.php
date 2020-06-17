<?php

namespace app\modules\financiero\models;
use yii\data\ArrayDataProvider;
use Yii;

/**
 * This is the model class for table "pagos_factura_estudiante".
 *
 * @property int $pfes_id
 * @property int $est_id
 * @property string $pfes_referencia
 * @property int $fpag_id
 * @property double $pfes_valor_pago
 * @property string $pfes_fecha_pago
 * @property string $pfes_observacion
 * @property string $pfes_archivo_pago
 * @property string $pfes_fecha_registro
 * @property int $pfes_usu_ingreso
 * @property string $pfes_estado
 * @property string $pfes_fecha_creacion
 * @property string $pfes_fecha_modificacion
 * @property string $pfes_estado_logico
 *
 * @property FormaPago $fpag
 */
class PagosFacturaEstudiante extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pagos_factura_estudiante';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_facturacion');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pfes_id', 'est_id', 'fpag_id', 'pfes_valor_pago', 'pfes_archivo_pago', 'pfes_usu_ingreso', 'pfes_estado', 'pfes_estado_logico'], 'required'],
            [['pfes_id', 'est_id', 'fpag_id', 'pfes_usu_ingreso'], 'integer'],
            [['pfes_valor_pago'], 'number'],
            [['pfes_fecha_pago', 'pfes_fecha_registro', 'pfes_fecha_creacion', 'pfes_fecha_modificacion'], 'safe'],
            [['pfes_referencia'], 'string', 'max' => 50],
            [['pfes_observacion'], 'string', 'max' => 500],
            [['pfes_archivo_pago'], 'string', 'max' => 200],
            [['pfes_estado', 'pfes_estado_logico'], 'string', 'max' => 1],
            [['pfes_id'], 'unique'],
            [['fpag_id'], 'exist', 'skipOnError' => true, 'targetClass' => FormaPago::className(), 'targetAttribute' => ['fpag_id' => 'fpag_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pfes_id' => 'Pfes ID',
            'est_id' => 'Est ID',
            'pfes_referencia' => 'Pfes Referencia',
            'fpag_id' => 'Fpag ID',
            'pfes_valor_pago' => 'Pfes Valor Pago',
            'pfes_fecha_pago' => 'Pfes Fecha Pago',
            'pfes_observacion' => 'Pfes Observacion',
            'pfes_archivo_pago' => 'Pfes Archivo Pago',
            'pfes_fecha_registro' => 'Pfes Fecha Registro',
            'pfes_usu_ingreso' => 'Pfes Usu Ingreso',
            'pfes_estado' => 'Pfes Estado',
            'pfes_fecha_creacion' => 'Pfes Fecha Creacion',
            'pfes_fecha_modificacion' => 'Pfes Fecha Modificacion',
            'pfes_estado_logico' => 'Pfes Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFpag()
    {
        return $this->hasOne(FormaPago::className(), ['fpag_id' => 'fpag_id']);
    }
    
        
    /**
     * Function getPagos
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return 
     */
    public static function getPagos($arrFiltro = array(), $onlyData = false) {
        $con = \Yii::$app->db_academico;
        $con1 = \Yii::$app->db_asgard;
        $con2 = \Yii::$app->db_facturacion;
        $sql = "SELECT 	p.per_cedula as identificacion, 
                        concat(p.per_pri_nombre, ' ', p.per_pri_apellido, ' ', ifnull(p.per_seg_apellido,'')) as estudiante,
                        u.uaca_nombre as unidad,
                        mo.mod_nombre as modalidad,
                        ea.eaca_nombre as carrera,
                        f.fpag_nombre as forma_pago,
                        d.dpfa_num_cuota,
                        d.dpfa_factura,
                        pfe.pfes_valor_pago valor_pago,
                        pfe.pfes_fecha_registro,                
                        case d.dpfa_estado_pago  
                            when 1 then 'Pendiente'  
                            when 2 then 'Aprobado'                                
                            when 3 then 'Rechazado'   
                        end as estado_pago,                        
                        dpfa_id
                from " . $con2->dbname . ".pagos_factura_estudiante pfe inner join " . $con2->dbname . ".detalle_pagos_factura d on d.pfes_id = pfe.pfes_id
                inner join " . $con->dbname . ".estudiante e on e.est_id = pfe.est_id
                inner join " . $con1->dbname . ".persona p on p.per_id = e.per_id
                inner join " . $con->dbname . ".estudiante_carrera_programa ec on ec.est_id = e.est_id
                inner join " . $con->dbname . ".modalidad_estudio_unidad m on m.meun_id = ec.meun_id
                inner join " . $con->dbname . ".unidad_academica u on u.uaca_id = m.uaca_id
                inner join " . $con->dbname . ".modalidad mo on mo.mod_id = m.mod_id
                inner join " . $con->dbname . ".estudio_academico ea on ea.eaca_id = m.eaca_id
                inner join " . $con2->dbname . ".forma_pago f on f.fpag_id = pfe.fpag_id ";

        $comando = $con->createCommand($sql);        
        $resultData = $comando->queryAll();
        $dataProvider = new ArrayDataProvider([
            'key' => 'id',
            'allModels' => $resultData,
            'pagination' => [
                'pageSize' => Yii::$app->params["pageSize"],
            ],
            'sort' => [
                'attributes' => [
                    'egen_id',
                    'fecha_creacion',
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
     * Function getPagospendientexest
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @param
     * @return 
     */
    public static function getPagospendientexest($cedula, $onlyData = false) {
        $con = \Yii::$app->db_sea;
        $sql = "SELECT 
                  A.TIP_NOF,
                  A.NUM_NOF,
                  A.COD_CLI,
                  A.C_TRA_E,
                  A.NUM_DOC,
                  A.F_SUS_D,
                  A.F_VEN_D,
                  A.VALOR_D,
                  (A.VALOR_D-A.VALOR_C-A.VAL_DEV) SALDO,
                  CASE 
                    WHEN A.NUM_DOC = A.NUM_NOF THEN '01'                    
                    ELSE SUBSTRING(A.NUM_DOC,1,3)
                  END  as cuota,
                  (SELECT GROUP_CONCAT( NOM_ART) FROM pruebasea.VD010101 B WHERE A.TIP_NOF=B.TIP_NOF AND A.NUM_NOF=B.NUM_NOF AND A.COD_CLI=B.COD_CLI) MOTIVO,               
                  CASE 
                    WHEN A.NUM_DOC = A.NUM_NOF THEN '01'                    
                    ELSE SUBSTRING(A.NUM_DOC,-3)
                  END  as cantidad               
                FROM " . $con->dbname . ".CC0002 A
                WHERE A.COD_CLI= :cedula AND A.CANCELA='N' AND A.COD_PTO='001' AND TIP_NOF='FE'";        
        $comando = $con->createCommand($sql);
        $comando->bindParam(":cedula", $cedula, \PDO::PARAM_STR);
 
        $resultData = $comando->queryAll();
        $dataProvider = new ArrayDataProvider([
            'key' => 'id',
            'allModels' => $resultData,
            'pagination' => [
                'pageSize' => Yii::$app->params["pageSize"],
            ],
            'sort' => [
                'attributes' => [                    
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
     * Function consultarPago
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return 
     */
    
    public function consultarPago($dpfa_id) {
        $con = \Yii::$app->db_academico;
        $con1 = \Yii::$app->db_asgard;
        $con2 = \Yii::$app->db_facturacion;
        $estado = 1;
        $sql = "SELECT 	p.per_cedula as identificacion, 
                        concat(p.per_pri_nombre, ' ', p.per_pri_apellido, ' ', ifnull(p.per_seg_apellido,'')) as estudiante,
                        p.per_correo,
                        u.uaca_id,
                        mo.mod_id,
                        ea.eaca_nombre as carrera,
                        f.fpag_nombre as forma_pago,
                        d.dpfa_num_cuota,
                        d.dpfa_valor_cuota as valor_cuota,
                        d.dpfa_factura,
                        pfe.pfes_fecha_registro,   
                        pfe.pfes_valor_pago valor_pago,                        
                        case d.dpfa_estado_pago  
                            when 1 then 'Pendiente'  
                            when 2 then 'Aprobado'                                
                            when 3 then 'Rechazado'   
                        end as estado_pago,
                        dpfa_id
                from " . $con2->dbname . ".pagos_factura_estudiante pfe inner join " . $con2->dbname . ".detalle_pagos_factura d on d.pfes_id = pfe.pfes_id
                    inner join " . $con->dbname . ".estudiante e on e.est_id = pfe.est_id
                    inner join " . $con1->dbname . ".persona p on p.per_id = e.per_id
                    inner join " . $con->dbname . ".estudiante_carrera_programa ec on ec.est_id = e.est_id
                    inner join " . $con->dbname . ".modalidad_estudio_unidad m on m.meun_id = ec.meun_id
                    inner join " . $con->dbname . ".unidad_academica u on u.uaca_id = m.uaca_id
                    inner join " . $con->dbname . ".modalidad mo on mo.mod_id = m.mod_id
                    inner join " . $con->dbname . ".estudio_academico ea on ea.eaca_id = m.eaca_id
                    inner join " . $con2->dbname . ".forma_pago f on f.fpag_id = pfe.fpag_id                        
                where dpfa_id = :dpfa_id
                    and pfes_estado = :estado
                    and pfes_estado_logico = :estado
                    and dpfa_estado = :estado
                    and dpfa_estado_logico = :estado
                    and est_estado = :estado
                    and est_estado_logico = :estado
                    and per_estado = :estado
                    and per_estado_logico = :estado";
        
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":dpfa_id", $dpfa_id, \PDO::PARAM_INT);
        return $comando->queryOne();
    }
    
    /**
     * Function grabarRechazo (Actualiza el estado del pago)
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  
     */
    public function grabarRechazo($dpfa_id, $resultado, $observacion) {
        $con = \Yii::$app->db_academico;
        $estado = 1;
        $fecha_autorizacion = date(Yii::$app->params["dateTimeByDefault"]);
        $usuario_autoriza = @Yii::$app->user->identity->usu_id; 
        $comando = $con->createCommand
                ("UPDATE " . $con->dbname . ".certificados_generadas
                SET cgen_observacion_autorizacion = :cgen_observacion,
                    cgen_fecha_autorizacion = :cgen_fecha_autoriza,                   
                    cgen_estado_certificado = :cgen_resultado,
                    cgen_usuario_autorizacion = :cgen_usuario_autoriza,
                    cgen_fecha_modificacion = :cgen_fecha_autoriza
                WHERE cgen_id = :cgen_id AND 
                      cgen_estado =:estado AND
                      cgen_estado_logico = :estado");

        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":cgen_id", $cgen_id, \PDO::PARAM_INT);
        $comando->bindParam(":cgen_observacion", $observacion, \PDO::PARAM_STR);
        $comando->bindParam(":cgen_resultado", $resultado, \PDO::PARAM_INT);
        $comando->bindParam(":cgen_fecha_autoriza", $fecha_autorizacion, \PDO::PARAM_STR);        
        $comando->bindParam(":cgen_usuario_autoriza", $usuario_autoriza, \PDO::PARAM_INT);        
        $response = $comando->execute();
        return $response;
    }
    /**
     * Function insertarPagospendientes
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @param
     * @return pfes_id
     */
    public function insertarPagospendientes($est_id, $pfes_referencia, $fpag_id, $pfes_valor_pago, $pfes_fecha_pago, $pfes_observacion, $pfes_archivo_pago, $pfes_usu_ingreso) {
        $con = \Yii::$app->db_facturacion;
        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }
        $fecha = date(Yii::$app->params["dateTimeByDefault"]);
        $param_sql = "pfes_estado";
        $bdet_sql = "1";

        $param_sql .= ", pfes_estado_logico";
        $bdet_sql .= ", 1";
        
        $param_sql .= ", pfes_fecha_registro";
        $bdet_sql .= ", :pfes_fecha_registro";

        if (isset($est_id)) {
            $param_sql .= ", est_id";
            $bdet_sql .= ", :est_id";
        }
        if (isset($pfes_referencia)) {
            $param_sql .= ", pfes_referencia";
            $bdet_sql .= ", :pfes_referencia";
        }
        if (isset($fpag_id)) {
            $param_sql .= ", fpag_id";
            $bdet_sql .= ", :fpag_id";
        }
        if (isset($pfes_valor_pago)) {
            $param_sql .= ", pfes_valor_pago";
            $bdet_sql .= ", :pfes_valor_pago";
        }
        if (isset($pfes_fecha_pago)) {
            $param_sql .= ", pfes_fecha_pago";
            $bdet_sql .= ", :pfes_fecha_pago";
        }
        if (isset($pfes_observacion)) {
            $param_sql .= ", pfes_observacion";
            $bdet_sql .= ", :pfes_observacion";
        }
        if (isset($pfes_archivo_pago)) {
            $param_sql .= ", pfes_archivo_pago";
            $bdet_sql .= ", :pfes_archivo_pago";
        }
        if (isset($pfes_usu_ingreso)) {
            $param_sql .= ", pfes_usu_ingreso";
            $bdet_sql .= ", :pfes_usu_ingreso";
        }
        try {
            $sql = "INSERT INTO " . $con->dbname . ".pagos_factura_estudiante ($param_sql) VALUES($bdet_sql)";
            $comando = $con->createCommand($sql);            
            if (isset($est_id)) {
                $comando->bindParam(':est_id', $est_id, \PDO::PARAM_INT);
            }
            if (isset($pfes_referencia)) {
                $comando->bindParam(':pfes_referencia', $pfes_referencia, \PDO::PARAM_STR);
            }
            if (!empty((isset($fpag_id)))) {
                $comando->bindParam(':fpag_id', $fpag_id, \PDO::PARAM_INT);
            }
            if (!empty((isset($pfes_valor_pago)))) {
                $comando->bindParam(':pfes_valor_pago', $pfes_valor_pago, \PDO::PARAM_STR);
            }
            if (!empty((isset($pfes_fecha_pago)))) {
                $comando->bindParam(':pfes_fecha_pago', $pfes_fecha_pago, \PDO::PARAM_STR);
            }
            if (!empty((isset($pfes_observacion)))) {
                $comando->bindParam(':pfes_observacion', ucfirst(mb_strtolower($pfes_observacion, 'UTF-8')), \PDO::PARAM_STR);
            }
            if (!empty((isset($pfes_archivo_pago)))) {
                $comando->bindParam(':pfes_archivo_pago', $pfes_archivo_pago, \PDO::PARAM_STR);
            }
            if (!empty((isset($pfes_usu_ingreso)))) {
                $comando->bindParam(':pfes_usu_ingreso', $pfes_usu_ingreso, \PDO::PARAM_INT);
            }           
            $comando->bindParam(":pfes_fecha_registro", $fecha, \PDO::PARAM_STR);
            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.pagos_factura_estudiante');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }
}
